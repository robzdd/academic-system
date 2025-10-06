<?php

namespace App\Http\Controllers\AdminBaak;

use App\Http\Controllers\Controller;
use App\Models\JadwalKuliah;
use App\Models\Kelas;
use App\Models\TahunAkademik;
use Illuminate\Http\Request;

class JadwalController extends Controller
{
    public function index()
    {
        $tahunAktif = TahunAkademik::where('is_active', true)->first();

        $jadwalList = JadwalKuliah::whereHas('kelas', function($query) use ($tahunAktif) {
            $query->where('tahun_akademik_id', $tahunAktif->id);
        })
        ->with(['kelas.mataKuliah', 'kelas.dosen.user'])
        ->orderBy('hari')
        ->orderBy('jam_mulai')
        ->get();

        return view('admin_baak.jadwal.index', compact('jadwalList', 'tahunAktif'));
    }

    public function create()
    {
        $tahunAktif = TahunAkademik::where('is_active', true)->first();

        $kelasList = Kelas::where('tahun_akademik_id', $tahunAktif->id)
            ->with(['mataKuliah', 'dosen.user'])
            ->get();

        $hariList = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];

        return view('admin_baak.jadwal.create', compact('kelasList', 'hariList'));
    }

    public function store(Request $request)
    {
        $tahunAktif = TahunAkademik::where('is_active', true)->first();

        // Get kelas and its related data
        $kelas = Kelas::with(['mataKuliah', 'dosen'])->findOrFail($request->kelas_id);

        $validated = $request->validate([
            'kelas_id' => 'required|exists:kelas,id',
            'hari' => 'required|in:Senin,Selasa,Rabu,Kamis,Jumat,Sabtu',
            'jam_mulai' => 'required|date_format:H:i',
            'jam_selesai' => 'required|date_format:H:i|after:jam_mulai',
            'ruangan' => 'required|string|max:50',
        ]);

        // Add all required IDs to validated data
        $validated['tahun_akademik_id'] = $tahunAktif->id;
        $validated['mata_kuliah_id'] = $kelas->mata_kuliah_id;
        $validated['dosen_id'] = $kelas->dosen_id;

        if ($this->checkJadwalBentrok($request->hari, $request->ruangan, $request->jam_mulai, $request->jam_selesai)) {
            return back()->with('error', 'Jadwal bentrok dengan ruangan yang sama!')->withInput();
        }

        JadwalKuliah::create($validated);

        return redirect()
            ->route('admin.jadwal.index')
            ->with('success', 'Jadwal berhasil ditambahkan!');
    }

    public function edit(JadwalKuliah $jadwal)
    {
        $tahunAktif = TahunAkademik::where('is_active', true)->first();
        $kelasList = Kelas::where('tahun_akademik_id', $tahunAktif->id)
            ->with(['mataKuliah', 'dosen.user'])
            ->get();
        $hariList = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];

        return view('admin_baak.jadwal.edit', compact('jadwal', 'kelasList', 'hariList'));
    }

    public function update(Request $request, JadwalKuliah $jadwal)
    {
        $validated = $request->validate([
            'kelas_id' => 'required|exists:kelas,id',
            'hari' => 'required|in:Senin,Selasa,Rabu,Kamis,Jumat,Sabtu',
            'jam_mulai' => 'required|date_format:H:i',
            'jam_selesai' => 'required|date_format:H:i|after:jam_mulai',
            'ruangan' => 'required|string|max:50',
        ]);

        if ($this->checkJadwalBentrok($request->hari, $request->ruangan, $request->jam_mulai, $request->jam_selesai, $jadwal->id)) {
            return back()->with('error', 'Jadwal bentrok dengan ruangan yang sama!')->withInput();
        }

        $jadwal->update($validated);

        return redirect()
            ->route('admin.jadwal.index')
            ->with('success', 'Jadwal berhasil diupdate!');
    }

    public function destroy(JadwalKuliah $jadwal)
    {
        $jadwal->delete();
        return redirect()
            ->route('admin.jadwal.index')
            ->with('success', 'Jadwal berhasil dihapus!');
    }

    private function checkJadwalBentrok($hari, $ruangan, $jamMulai, $jamSelesai, $excludeId = null)
    {
        $query = JadwalKuliah::where('hari', $hari)
            ->where('ruangan', $ruangan)
            ->where(function($query) use ($jamMulai, $jamSelesai) {
                $query->whereBetween('jam_mulai', [$jamMulai, $jamSelesai])
                      ->orWhereBetween('jam_selesai', [$jamMulai, $jamSelesai])
                      ->orWhere(function($q) use ($jamMulai, $jamSelesai) {
                          $q->where('jam_mulai', '<=', $jamMulai)
                            ->where('jam_selesai', '>=', $jamSelesai);
                      });
            });

        if ($excludeId) {
            $query->where('id', '!=', $excludeId);
        }

        return $query->exists();
    }
}
