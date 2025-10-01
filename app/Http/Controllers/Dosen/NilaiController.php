<?php

namespace App\Http\Controllers\Dosen;

use App\Models\Kelas;
use App\Models\Nilai;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class NilaiController extends Controller
{
    public function index(Kelas $kelas)
    {
        // Pastikan kelas ini milik dosen yang login
        if ($kelas->dosen_id !== Auth::user()->dosen->id) {
            abort(403);
        }

        $kelas->load('mataKuliah');

        $mahasiswaList = $kelas->krs()
            ->with(['mahasiswa.user', 'nilai'])
            ->where('status', 'disetujui')
            ->get();

        return view('dosen.nilai', compact('kelas', 'mahasiswaList'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'krs_id' => 'required|exists:krs,id',
            'nilai_angka' => 'required|numeric|min:0|max:100',
        ]);

        $nilaiAngka = $request->nilai_angka;

        // Konversi nilai angka ke huruf dan bobot
        [$nilaiHuruf, $nilaiBobot] = $this->konversiNilai($nilaiAngka);

        Nilai::updateOrCreate(
            ['krs_id' => $request->krs_id],
            [
                'nilai_angka' => $nilaiAngka,
                'nilai_huruf' => $nilaiHuruf,
                'nilai_bobot' => $nilaiBobot,
            ]
        );

        return back()->with('success', 'Nilai berhasil disimpan!');
    }

    public function updateBatch(Request $request)
    {
        $request->validate([
            'nilai' => 'required|array',
            'nilai.*.krs_id' => 'required|exists:krs,id',
            'nilai.*.nilai_angka' => 'required|numeric|min:0|max:100',
        ]);

        foreach ($request->nilai as $data) {
            $nilaiAngka = $data['nilai_angka'];
            [$nilaiHuruf, $nilaiBobot] = $this->konversiNilai($nilaiAngka);

            Nilai::updateOrCreate(
                ['krs_id' => $data['krs_id']],
                [
                    'nilai_angka' => $nilaiAngka,
                    'nilai_huruf' => $nilaiHuruf,
                    'nilai_bobot' => $nilaiBobot,
                ]
            );
        }

        return back()->with('success', 'Semua nilai berhasil disimpan!');
    }

    private function konversiNilai($nilaiAngka)
    {
        if ($nilaiAngka >= 85) {
            return ['A', 4.00];
        } elseif ($nilaiAngka >= 70) {
            return ['B', 3.00];
        } elseif ($nilaiAngka >= 60) {
            return ['C', 2.00];
        } elseif ($nilaiAngka >= 50) {
            return ['D', 1.00];
        } else {
            return ['E', 0.00];
        }
    }
}
