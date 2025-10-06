<?php

namespace App\Http\Controllers\AdminBaak;

use App\Http\Controllers\Controller;
use App\Models\TahunAkademik;
use App\Models\Mahasiswa;
use App\Models\Dosen;
use App\Models\Kelas;
use App\Models\JadwalKuliah;

class DashboardController extends Controller
{
    public function index()
    {
        $tahunAktif = TahunAkademik::where('is_active', true)->first();

        $totalMahasiswa = Mahasiswa::count();
        $totalDosen = Dosen::count();
        $totalKelas = Kelas::where('tahun_akademik_id', $tahunAktif->id)->count();
        $totalJadwal = JadwalKuliah::whereHas('kelas', function($query) use ($tahunAktif) {
            $query->where('tahun_akademik_id', $tahunAktif->id);
        })->count();

        return view('admin_baak.dashboard', compact('tahunAktif', 'totalMahasiswa', 'totalDosen', 'totalKelas', 'totalJadwal'));
    }
}
