<?php

namespace App\Http\Controllers\AdminBaak;

use App\Models\Dosen;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use App\Models\TahunAkademik;
use App\Models\PembimbingAkademik;
use App\Http\Controllers\Controller;

class PembimbingAkademikController extends Controller
{
    public function index()
    {
        $tahunAktif = TahunAkademik::where('is_active', true)->first();

        $pembimbingList = PembimbingAkademik::where('tahun_akademik_id', $tahunAktif->id)
            ->with(['mahasiswa.user', 'dosen.user'])
            ->get();

        return view('admin_baak.jadwal.index', compact('pembimbingList', 'tahunAktif'));
    }

    public function create()
    {
        $dosenList = Dosen::with('user')->get();
        $mahasiswaList = Mahasiswa::with('user')
            ->whereDoesntHave('pembimbingAkademik', function($query) {
                $query->where('is_active', true);
            })->get();

        return view('admin_baak.jadwal.create', compact('dosenList', 'mahasiswaList'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'dosen_id' => 'required|exists:dosen,id',
            'mahasiswa_id' => 'required|array',
            'mahasiswa_id.*' => 'exists:mahasiswa,id'
        ]);

        $tahunAktif = TahunAkademik::where('is_active', true)->first();

        foreach($validated['mahasiswa_id'] as $mahasiswaId) {
            PembimbingAkademik::create([
                'dosen_id' => $validated['dosen_id'],
                'mahasiswa_id' => $mahasiswaId,
                'tahun_akademik_id' => $tahunAktif->id,
                'is_active' => true
            ]);
        }

        return redirect()
            ->route('admin_baak.jadwal.index')
            ->with('success', 'Pembimbing Akademik berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $jadwal = PembimbingAkademik::findOrFail($id);
        $dosenList = Dosen::with('user')->get();

        return view('admin_baak.jadwal.edit', compact('jadwal', 'dosenList'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'dosen_id' => 'required|exists:dosen,id'
        ]);

        $jadwal = PembimbingAkademik::findOrFail($id);
        $jadwal->update($validated);

        return redirect()
            ->route('admin_baak.jadwal.index')
            ->with('success', 'Pembimbing Akademik berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $jadwal = PembimbingAkademik::findOrFail($id);
        $jadwal->is_active = false;
        $jadwal->save();

        return redirect()
            ->route('admin_baak.jadwal.index')
            ->with('success', 'Pembimbing Akademik berhasil dinonaktifkan!');
    }
}
