<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Models\Krs;
use App\Models\Kelas;
use Illuminate\Http\Request;
use App\Models\TahunAkademik;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class KrsController extends Controller
{
    public function index()
    {
        $mahasiswa = Auth::user()->mahasiswa;
        $tahunAktif = TahunAkademik::where('is_active', true)->first();

        $krsList = $mahasiswa->krs()
            ->where('tahun_akademik_id', $tahunAktif->id)
            ->with(['kelas.mataKuliah', 'kelas.dosen.user', 'kelas.jadwalKuliah'])
            ->get();

        $kelasTersedia = Kelas::where('tahun_akademik_id', $tahunAktif->id)
            ->whereColumn('jumlah_mahasiswa', '<', 'kapasitas')
            ->with(['mataKuliah', 'dosen.user', 'jadwalKuliah'])
            ->get();

        return view('mahasiswa.krs', compact('krsList', 'kelasTersedia', 'tahunAktif'));
    }

    public function store(Request $request)
    {
        $mahasiswa = Auth::user()->mahasiswa;
        $tahunAktif = TahunAkademik::where('is_active', true)->first();

        $request->validate([
            'kelas_id' => 'required|exists:kelas,id'
        ]);

        $kelas = Kelas::findOrFail($request->kelas_id);

        // Cek kapasitas
        if ($kelas->jumlah_mahasiswa >= $kelas->kapasitas) {
            return back()->with('error', 'Kelas sudah penuh!');
        }

        // Cek apakah sudah mengambil kelas yang sama
        $exists = Krs::where('mahasiswa_id', $mahasiswa->id)
            ->where('kelas_id', $request->kelas_id)
            ->where('tahun_akademik_id', $tahunAktif->id)
            ->exists();

        if ($exists) {
            return back()->with('error', 'Anda sudah mengambil kelas ini!');
        }

        Krs::create([
            'mahasiswa_id' => $mahasiswa->id,
            'kelas_id' => $request->kelas_id,
            'tahun_akademik_id' => $tahunAktif->id,
            'status' => 'draft'
        ]);

        $kelas->increment('jumlah_mahasiswa');

        return back()->with('success', 'Mata kuliah berhasil ditambahkan ke KRS!');
    }

    public function destroy(Krs $krs)
    {
        if ($krs->status !== 'draft') {
            return back()->with('error', 'KRS yang sudah diajukan tidak dapat dihapus!');
        }

        $krs->kelas->decrement('jumlah_mahasiswa');
        $krs->delete();

        return back()->with('success', 'Mata kuliah berhasil dihapus dari KRS!');
    }

    public function submit()
    {
        $mahasiswa = Auth::user()->mahasiswa;
        $tahunAktif = TahunAkademik::where('is_active', true)->first();

        $mahasiswa->krs()
            ->where('tahun_akademik_id', $tahunAktif->id)
            ->where('status', 'draft')
            ->update(['status' => 'diajukan']);

        return back()->with('success', 'KRS berhasil diajukan!');
    }

    public function riwayat()
{
    $mahasiswa = Auth::user()->mahasiswa;

    // Ambil semua KRS mahasiswa (termasuk semester sebelumnya)
    $riwayatKrs = $mahasiswa->krs()
        ->with([
            'kelas.mataKuliah',
            'kelas.jadwalKuliah',
            'kelas.tahunAkademik'
        ])
        ->get()
        // Kelompokkan berdasarkan semester atau tahun akademik
        ->groupBy(function ($item) {
            return $item->kelas->tahunAkademik->kode_tahun . ' - ' . ucfirst($item->kelas->tahunAkademik->semester);
        });

    return view('mahasiswa.riwayat-krs', compact('riwayatKrs'));
}

}
