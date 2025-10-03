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

    public function bimbingan()
    {
        $dosen = Auth::user()->dosen;
        $tahunAktif = TahunAkademik::where('is_active', true)->first();
        // Ambil mahasiswa bimbingan aktif tahun ini
        $mahasiswaBimbingan = \App\Models\PembimbingAkademik::where('dosen_id', $dosen->id)
            ->where('tahun_akademik_id', $tahunAktif->id)
            ->where('is_active', true)
            ->with(['mahasiswa.user'])
            ->get();
        // Ambil KRS yang diajukan oleh mahasiswa bimbingan
        $krsDiajukan = collect();
        foreach ($mahasiswaBimbingan as $bimbingan) {
            $krs = $bimbingan->mahasiswa->krs()
                ->where('tahun_akademik_id', $tahunAktif->id)
                ->where('status', 'diajukan')
                ->with(['kelas.mataKuliah'])
                ->get();
            foreach ($krs as $item) {
                $krsDiajukan->push($item);
            }
        }
        return view('dosen.bimbingan', compact('mahasiswaBimbingan', 'krsDiajukan', 'tahunAktif'));
    }

    public function accKrs($krsId)
    {
        $dosen = Auth::user()->dosen;
        $tahunAktif = TahunAkademik::where('is_active', true)->first();
        $krs = \App\Models\Krs::with('mahasiswa')->findOrFail($krsId);
        // Pastikan mahasiswa ini adalah bimbingan dosen
        $isBimbingan = \App\Models\PembimbingAkademik::where('dosen_id', $dosen->id)
            ->where('mahasiswa_id', $krs->mahasiswa_id)
            ->where('tahun_akademik_id', $tahunAktif->id)
            ->where('is_active', true)
            ->exists();
        if (!$isBimbingan) {
            abort(403, 'Anda bukan pembimbing akademik mahasiswa ini.');
        }
        if ($krs->status !== 'diajukan') {
            return back()->with('error', 'KRS tidak dalam status diajukan!');
        }
        $krs->status = 'disetujui';
        $krs->save();
        return back()->with('success', 'KRS berhasil di-ACC!');
    }
}
