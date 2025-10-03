<?php

namespace App\Http\Controllers\Mahasiswa;

use Illuminate\Http\Request;
use App\Models\TahunAkademik;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth; // Tambahkan ini
use App\Models\User;
use App\Models\PembimbingAkademik; // Tambahkan ini

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $mahasiswa = Auth::user()->mahasiswa;
        $tahunAktif = TahunAkademik::where('is_active', true)->first();

        // Get active pembimbing akademik with proper eager loading
        $pembimbingAkademik = PembimbingAkademik::where('mahasiswa_id', $mahasiswa->id)
            ->where('is_active', true)
            ->with(['dosen.user'])
            ->first();

        // Get total SKS
        $totalSks = $mahasiswa->krs()
            ->where('tahun_akademik_id', $tahunAktif->id)
            ->where('status', 'disetujui')
            ->with('kelas.mataKuliah')
            ->get()
            ->sum(function($krs) {
                return $krs->kelas->mataKuliah->sks;
            });

        // Get IPK
        $ipk = $mahasiswa->khs()->latest()->first()->ip_kumulatif ?? 0;

        // Ambil tanggal dari request, default hari ini
        $tanggalDipilih = $request->input('tanggal') ?: now()->format('Y-m-d');
        $hariDipilih = \Carbon\Carbon::parse($tanggalDipilih)->locale('id')->isoFormat('dddd');
        // Ambil jadwal kuliah hari ini
        $jadwalHariIni = $mahasiswa->krs()
            ->where('tahun_akademik_id', $tahunAktif->id)
            ->where('status', 'disetujui')
            ->with(['kelas.mataKuliah', 'kelas.dosen.user', 'kelas.jadwalKuliah' => function($q) use ($hariDipilih) {
                $q->where('hari', $hariDipilih);
            }])
            ->get()
            ->flatMap(function($krs) {
                return $krs->kelas->jadwalKuliah->map(function($jadwal) use ($krs) {
                    $jadwal->kelas = $krs->kelas;
                    return $jadwal;
                });
            })
            ->sortBy('jam_mulai');

        // Pass all variables to view
        return view('mahasiswa.dashboard', compact(
            'mahasiswa',
            'tahunAktif',
            'totalSks',
            'ipk',
            'pembimbingAkademik',
            'jadwalHariIni',
            'hariDipilih',
            'tanggalDipilih'
        ));
    }
}
