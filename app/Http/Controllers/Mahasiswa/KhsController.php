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
        $user = $mahasiswa->user;
        $prodi = $mahasiswa->programStudi;
        $khsList = $mahasiswa->khs()
            ->with('tahunAkademik')
            ->orderBy('tahun_akademik_id', 'desc')
            ->get();
        $pembimbingAkademik = \App\Models\PembimbingAkademik::where('mahasiswa_id', $mahasiswa->id)
            ->where('is_active', true)
            ->with(['dosen.user'])
            ->first();
        // Untuk IPK kumulatif
        $totalBobotKumulatif = 0;
        $totalSksKumulatif = 0;
        foreach ($khsList as $khs) {
            $nilaiList = $mahasiswa->krs()
                ->where('tahun_akademik_id', $khs->tahun_akademik_id)
                ->whereHas('nilai')
                ->with(['kelas.mataKuliah', 'nilai'])
                ->get();
            // IPS semester ini
            $totalBobotSemester = 0;
            $totalSksSemester = 0;
            $nilaiListForView = [];
            foreach ($nilaiList as $krs) {
                $sks = $krs->kelas->mataKuliah->sks;
                $bobot = $krs->nilai->nilai_bobot;
                $totalBobotSemester += $bobot * $sks;
                $totalSksSemester += $sks;
                $nilaiListForView[] = $krs;
            }
            $ips = $totalSksSemester > 0 ? round($totalBobotSemester / $totalSksSemester, 2) : 0;
            $khs->nilaiList = $nilaiListForView;
            $khs->ips = $ips;
            $khs->total_sks_semester = $totalSksSemester;
            // Kumulatif
            $totalBobotKumulatif += $totalBobotSemester;
            $totalSksKumulatif += $totalSksSemester;
            $khs->ipk = $totalSksKumulatif > 0 ? round($totalBobotKumulatif / $totalSksKumulatif, 2) : 0;
            $khs->total_sks_kumulatif = $totalSksKumulatif;
        }
        return view('mahasiswa.khs', compact('khsList', 'pembimbingAkademik', 'mahasiswa', 'user', 'prodi'));
    }

    public function download($tahunAkademikId)
    {
        $mahasiswa = Auth::user()->mahasiswa;
        $user = $mahasiswa->user;
        $prodi = $mahasiswa->programStudi;

        $khs = Khs::where('mahasiswa_id', $mahasiswa->id)
            ->where('tahun_akademik_id', $tahunAkademikId)
            ->with('tahunAkademik')
            ->firstOrFail();

        // Get pembimbing akademik for PDF
        $pembimbingAkademik = PembimbingAkademik::where('mahasiswa_id', $mahasiswa->id)
            ->where('is_active', true)
            ->with(['dosen.user'])
            ->first();

        // Nilai semester yang dipilih
        $nilaiKrsSemester = $mahasiswa->krs()
            ->where('tahun_akademik_id', $tahunAkademikId)
            ->with(['kelas.mataKuliah', 'nilai'])
            ->whereHas('nilai')
            ->get();

        // Hitung IPS semester ini
        $totalSksSemester = 0;
        $totalBobotSemester = 0;
        foreach ($nilaiKrsSemester as $krs) {
            $sks = $krs->kelas->mataKuliah->sks;
            $bobot = $krs->nilai->nilai_bobot;
            $totalSksSemester += $sks;
            $totalBobotSemester += ($bobot * $sks);
        }
        $ips = $totalSksSemester > 0 ? round($totalBobotSemester / $totalSksSemester, 2) : 0;

        // Hitung IPK kumulatif dari semua semester yang punya nilai
        $nilaiKrsAll = $mahasiswa->krs()
            ->with(['kelas.mataKuliah', 'nilai'])
            ->whereHas('nilai')
            ->get();
        $totalSksKumulatif = 0;
        $totalBobotKumulatif = 0;
        foreach ($nilaiKrsAll as $krs) {
            $sks = $krs->kelas->mataKuliah->sks;
            $bobot = $krs->nilai->nilai_bobot;
            $totalSksKumulatif += $sks;
            $totalBobotKumulatif += ($bobot * $sks);
        }
        $ipk = $totalSksKumulatif > 0 ? round($totalBobotKumulatif / $totalSksKumulatif, 2) : 0;

        $pdf = Pdf::loadView('mahasiswa.khs-pdf', [
            'mahasiswa' => $mahasiswa,
            'user' => $user,
            'prodi' => $prodi,
            'khs' => $khs,
            'nilaiList' => $nilaiKrsSemester,
            'pembimbingAkademik' => $pembimbingAkademik,
            'ips' => $ips,
            'ipk' => $ipk,
            'totalSksSemester' => $totalSksSemester,
            'totalSksKumulatif' => $totalSksKumulatif,
        ]);

        $kodeTahun = str_replace(['/', '\\'], '-', $khs->tahunAkademik->kode_tahun);

        return $pdf->download('KHS-' . $kodeTahun . '.pdf');
    }
}
