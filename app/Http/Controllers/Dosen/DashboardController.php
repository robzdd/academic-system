<?php

namespace App\Http\Controllers\Dosen;

use Illuminate\Http\Request;
use App\Models\TahunAkademik;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;



class DashboardController extends Controller
{
    public function index()
    {
        $dosen = Auth::user()->dosen;
        $tahunAktif = TahunAkademik::where('is_active', true)->first();

        $totalKelas = $dosen->kelas()
            ->where('tahun_akademik_id', $tahunAktif->id)
            ->count();

        $totalMahasiswa = $dosen->kelas()
            ->where('tahun_akademik_id', $tahunAktif->id)
            ->sum('jumlah_mahasiswa');

        $kelasList = $dosen->kelas()
            ->where('tahun_akademik_id', $tahunAktif->id)
            ->with(['mataKuliah', 'jadwalKuliah'])
            ->get();

        return view('dosen.dashboard', compact('dosen', 'tahunAktif', 'totalKelas', 'totalMahasiswa', 'kelasList'));
    }
}
