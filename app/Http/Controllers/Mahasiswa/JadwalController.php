<?php

namespace App\Http\Controllers\Mahasiswa;

use Illuminate\Http\Request;
use App\Models\TahunAkademik;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class JadwalController extends Controller
{
    public function index(Request $request)
    {
        $mahasiswa = Auth::user()->mahasiswa;
        $tahunAktif = TahunAkademik::where('is_active', true)->first();

        // Ambil tanggal dari input, default hari ini
        $selectedDate = $request->input('tanggal');
        $selectedCarbon = $selectedDate ? Carbon::parse($selectedDate) : Carbon::now();

        // Ambil semua jadwal KRS mahasiswa di tahun akademik aktif yang disetujui
        $jadwalList = $mahasiswa->krs()
            ->where('tahun_akademik_id', $tahunAktif->id)
            ->where('status', 'disetujui')
            ->with(['kelas.mataKuliah', 'kelas.dosen.user', 'kelas.jadwalKuliah'])
            ->get()
            ->pluck('kelas.jadwalKuliah')
            ->flatten()
            // Hitung tanggal_real tiap jadwal sesuai minggu dari tanggal yang dipilih
            ->map(function ($jadwal) use ($selectedCarbon) {
                $hariMap = [
                    'Senin' => 0,
                    'Selasa' => 1,
                    'Rabu' => 2,
                    'Kamis' => 3,
                    'Jumat' => 4,
                    'Sabtu' => 5,
                    'Minggu' => 6,
                ];

                if(!isset($hariMap[$jadwal->hari])) return null;

                // tanggal_real = start of week + offset hari
                $tanggal = $selectedCarbon->copy()->startOfWeek()->addDays($hariMap[$jadwal->hari])->toDateString();
                $jadwal->tanggal_real = $tanggal;

                return $jadwal;
            })
            ->filter() // buang null jika ada
            // Filter hanya jadwal hari yang dipilih
            ->filter(function ($jadwal) use ($selectedCarbon) {
                return $jadwal->tanggal_real == $selectedCarbon->toDateString();
            })
            // Sort by jam_mulai
            ->sortBy(function ($jadwal) {
                return strtotime($jadwal->jam_mulai);
            });

        return view('mahasiswa.jadwal', compact('jadwalList', 'selectedDate'));
    }
}
