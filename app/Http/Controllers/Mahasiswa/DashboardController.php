<?php

namespace App\Http\Controllers\Mahasiswa;

use Illuminate\Http\Request;
use App\Models\TahunAkademik;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth; // Tambahkan ini
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $mahasiswa = Auth::user()->mahasiswa;
        $tahunAktif = TahunAkademik::where('is_active', true)->first();

        $totalSks = $mahasiswa->krs()
            ->where('tahun_akademik_id', $tahunAktif->id)
            ->where('status', 'disetujui')
            ->with('kelas.mataKuliah')
            ->get()
            ->sum(function($krs) {
                return $krs->kelas->mataKuliah->sks;
            });

        $ipk = $mahasiswa->khs()->latest()->first()->ip_kumulatif ?? 0;

        return view('mahasiswa.dashboard', compact('mahasiswa', 'tahunAktif', 'totalSks', 'ipk'));
    }
}
