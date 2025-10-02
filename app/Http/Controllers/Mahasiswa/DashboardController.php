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
    public function index()
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

        // Pass all variables to view
        return view('mahasiswa.dashboard', compact(
            'mahasiswa',
            'tahunAktif',
            'totalSks',
            'ipk',
            'pembimbingAkademik'  // Make sure this is included
        ));
    }
}
