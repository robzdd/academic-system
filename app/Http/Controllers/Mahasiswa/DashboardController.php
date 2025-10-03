<?php

namespace App\Http\Controllers\Mahasiswa;

use Illuminate\Http\Request;
use App\Models\TahunAkademik;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\PembimbingAkademik;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $mahasiswa = Auth::user()->mahasiswa;
        $tahunAktif = TahunAkademik::where('is_active', true)->first();

        // Ambil pembimbing akademik aktif
        $pembimbingAkademik = PembimbingAkademik::where('mahasiswa_id', $mahasiswa->id)
            ->where('is_active', true)
            ->with(['dosen.user'])
            ->first();

        // Total SKS semester aktif
        $totalSks = $mahasiswa->krs()
            ->where('tahun_akademik_id', $tahunAktif->id)
            ->where('status', 'disetujui')
            ->with('kelas.mataKuliah')
            ->get()
            ->sum(fn($krs) => $krs->kelas->mataKuliah->sks ?? 0);

        // IPK terakhir
        $ipk = $mahasiswa->khs()->latest()->first()->ip_kumulatif ?? 0;

        // Ambil tanggal dari input kalender
        $selectedDate = $request->input('tanggal');
        $selectedCarbon = $selectedDate ? Carbon::parse($selectedDate) : Carbon::now();

        // Ambil semua jadwal kelas mahasiswa di semester ini
        $jadwalList = $mahasiswa->krs()
            ->where('tahun_akademik_id', $tahunAktif->id)
            ->where('status', 'disetujui')
            ->with(['kelas.mataKuliah', 'kelas.dosen.user', 'kelas.jadwalKuliah'])
            ->get()
            ->pluck('kelas.jadwalKuliah')
            ->flatten()
            ->filter() // buang null
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

                if (!isset($hariMap[$jadwal->hari])) return null;

                // Hitung tanggal_real sesuai minggu tanggal yang dipilih
                $tanggal = $selectedCarbon->copy()->startOfWeek()->addDays($hariMap[$jadwal->hari])->toDateString();
                $jadwal->tanggal_real = $tanggal;

                return $jadwal;
            })
            ->filter() // buang null
            // Filter hanya jadwal hari yang dipilih
            ->filter(fn($jadwal) => $jadwal->tanggal_real == $selectedCarbon->toDateString())
            // Sort berdasarkan jam_mulai
            ->sortBy(fn($jadwal) => strtotime($jadwal->jam_mulai));

        return view('mahasiswa.dashboard', compact(
            'mahasiswa',
            'tahunAktif',
            'totalSks',
            'ipk',
            'pembimbingAkademik',
            'jadwalList',
            'selectedDate'
        ));
    }
}
