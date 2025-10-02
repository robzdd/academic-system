<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Models\Khs;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Http\Controllers\Controller;
use App\Models\PembimbingAkademik;
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

        // Get active pembimbing akademik
        $pembimbingAkademik = PembimbingAkademik::where('mahasiswa_id', $mahasiswa->id)
            ->where('is_active', true)
            ->with(['dosen.user'])
            ->first();

        return view('mahasiswa.khs', compact('khsList', 'pembimbingAkademik'));
    }

    public function download($tahunAkademikId)
    {
        $mahasiswa = Auth::user()->mahasiswa;

        $khs = Khs::where('mahasiswa_id', $mahasiswa->id)
            ->where('tahun_akademik_id', $tahunAkademikId)
            ->with('tahunAkademik')
            ->firstOrFail();

        // Get pembimbing akademik for PDF
        $pembimbingAkademik = PembimbingAkademik::where('mahasiswa_id', $mahasiswa->id)
            ->where('is_active', true)
            ->with(['dosen.user'])
            ->first();

        $nilaiList = $mahasiswa->krs()
            ->where('tahun_akademik_id', $tahunAkademikId)
            ->with(['kelas.mataKuliah', 'nilai'])
            ->whereHas('nilai')
            ->get();

        $pdf = Pdf::loadView('mahasiswa.khs-pdf', compact(
            'mahasiswa',
            'khs',
            'nilaiList',
            'pembimbingAkademik'
        ));

        return $pdf->download('KHS-' . $khs->tahunAkademik->kode_tahun . '.pdf');
    }
}
