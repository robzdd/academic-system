<?php

namespace App\Http\Controllers\Mahasiswa;

use Illuminate\Http\Request;
use App\Models\TahunAkademik;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\PembimbingAkademik;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $mahasiswa = Auth::user()->mahasiswa;
        $tahunAktif = TahunAkademik::where('is_active', true)->first();

        // Ambil pembimbing akademik aktif
        $pembimbingAkademik = PembimbingAkademik::where('mahasiswa_id', $mahasiswa->id)
            ->where('is_active', true)
            ->with(['dosen.user'])
            ->first();

        // Hitung total SKS disetujui pada tahun akademik aktif
        $totalSks = $mahasiswa->krs()
            ->where('tahun_akademik_id', $tahunAktif->id)
            ->where('status', 'disetujui')
            ->with('kelas.mataKuliah')
            ->get()
            ->sum(function ($krs) {
                return $krs->kelas->mataKuliah->sks;
            });

        // Ambil IPK terakhir
        $ipk = $mahasiswa->khs()->latest()->first()->ip_kumulatif ?? 0;

        // ======== Tambahan: Ambil data IPS per semester untuk grafik ========
        $ipsPerSemester = $mahasiswa->khs()
            ->join('tahun_akademik', 'khs.tahun_akademik_id', '=', 'tahun_akademik.id')
            ->select('tahun_akademik.semester', 'khs.ip_semester')
            ->orderBy('tahun_akademik.semester', 'asc')
            ->get();

        // Kalau tidak ada data KHS, inisialisasi kosong
        $labels = $ipsPerSemester->pluck('semester')->toArray();
        $dataIps = $ipsPerSemester->pluck('ip_semester')->toArray();

        // ======== Kalender Akademik Interaktif ========
        $tanggalDipilih = $request->input('tanggal') ?: now()->format('Y-m-d');
        $hariDipilih = Carbon::parse($tanggalDipilih)->locale('id')->isoFormat('dddd');

        // Ambil jadwal kuliah hari yang dipilih
        $jadwalHariIni = $mahasiswa->krs()
            ->where('tahun_akademik_id', $tahunAktif->id)
            ->where('status', 'disetujui')
            ->with([
                'kelas.mataKuliah',
                'kelas.dosen.user',
                'kelas.jadwalKuliah' => function ($q) use ($hariDipilih) {
                    $q->where('hari', $hariDipilih);
                }
            ])
            ->get()
            ->flatMap(function ($krs) {
                return $krs->kelas->jadwalKuliah->map(function ($jadwal) use ($krs) {
                    $jadwal->kelas = $krs->kelas;
                    return $jadwal;
                });
            })
            ->sortBy('jam_mulai');

        // Kirim semua variabel ke view
        return view('mahasiswa.dashboard', compact(
            'mahasiswa',
            'tahunAktif',
            'totalSks',
            'ipk',
            'pembimbingAkademik',
            'jadwalHariIni',
            'hariDipilih',
            'tanggalDipilih',
            'labels',
            'dataIps'
        ));
    }
}
