<?php

namespace App\Http\Controllers\Mahasiswa;

use Illuminate\Http\Request;
use App\Models\TahunAkademik;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class NilaiController extends Controller
{
    public function index()
    {
        $mahasiswa =  Auth::user()->mahasiswa;

        $nilaiList = $mahasiswa->krs()
            ->with(['kelas.mataKuliah', 'kelas.dosen.user', 'nilai', 'tahunAkademik'])
            ->whereHas('nilai')
            ->orderBy('tahun_akademik_id', 'desc')
            ->get();

        return view('mahasiswa.nilai', compact('nilaiList'));
    }
}
