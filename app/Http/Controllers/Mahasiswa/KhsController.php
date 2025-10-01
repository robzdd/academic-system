<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Models\Khs;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class KhsController extends Controller
{
    public function index()
    {
        $mahasiswa = Auth::user()->mahasiswa;

        $khsList = $mahasiswa->khs()
            ->with('tahunAkademik')
            ->orderBy('tahun_akademik_id', 'desc')
            ->get();

        return view('mahasiswa.khs', compact('khsList'));
    }

    public function download($tahunAkademikId)
    {
        $mahasiswa = Auth::user()->mahasiswa;

        $khs = Khs::where('mahasiswa_id', $mahasiswa->id)
            ->where('tahun_akademik_id', $tahunAkademikId)
            ->with('tahunAkademik')
            ->firstOrFail();

        $nilaiList = $mahasiswa->krs()
            ->where('tahun_akademik_id', $tahunAkademikId)
            ->with(['kelas.mataKuliah', 'nilai'])
            ->whereHas('nilai')
            ->get();

        $pdf = Pdf::loadView('mahasiswa.khs-pdf', compact('mahasiswa', 'khs', 'nilaiList'));

        return $pdf->download('KHS-' . $khs->tahunAkademik->kode_tahun . '.pdf');
    }
}
