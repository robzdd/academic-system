<?php

namespace App\Http\Controllers\Mahasiswa;

use Illuminate\Http\Request;
use App\Models\TahunAkademik;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class JadwalController extends Controller
{
    public function index()
    {
        $mahasiswa = Auth::user()->mahasiswa;
        $tahunAktif = TahunAkademik::where('is_active', true)->first();

        $jadwalList = $mahasiswa->krs()
            ->where('tahun_akademik_id', $tahunAktif->id)
            ->where('status', 'disetujui')
            ->with(['kelas.mataKuliah', 'kelas.dosen.user', 'kelas.jadwalKuliah'])
            ->get()
            ->pluck('kelas.jadwalKuliah')
            ->flatten()
            ->sortBy(function($jadwal) {
                $days = ['Senin' => 1, 'Selasa' => 2, 'Rabu' => 3, 'Kamis' => 4, 'Jumat' => 5, 'Sabtu' => 6];
                return ($days[$jadwal->hari] ?? 7) . $jadwal->jam_mulai;
            });

        return view('mahasiswa.jadwal', compact('jadwalList'));
    }
}
