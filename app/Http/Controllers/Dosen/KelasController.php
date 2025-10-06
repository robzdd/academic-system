<?php

namespace App\Http\Controllers\Dosen;

use App\Models\Kelas;
use Illuminate\Http\Request;
use App\Models\TahunAkademik;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class KelasController extends Controller
{
    public function index()
    {
        $dosen = Auth::user()->dosen;
        $tahunAktif = TahunAkademik::where('is_active', true)->first();

        $kelasList = $dosen->kelas()
            ->where('tahun_akademik_id', $tahunAktif->id)
            ->with(['mataKuliah', 'jadwalKuliah'])
            ->get();

        return view('dosen.kelas', compact('kelasList', 'tahunAktif'));
    }

    public function show(Kelas $kelas)
    {
        // Pastikan kelas ini milik dosen yang login
        if ($kelas->dosen_id !== Auth::user()->dosen->id) {
            abort(403);
        }

        $kelas->load(['mataKuliah', 'jadwalKuliah']);

        $mahasiswaList = $kelas->krs()
            ->with(['mahasiswa.user','mahasiswa.programStudi', 'nilai'])
            ->where('status', 'disetujui')
            ->get();

        return view('dosen.kelas-detail', compact('kelas', 'mahasiswaList'));
    }
}
