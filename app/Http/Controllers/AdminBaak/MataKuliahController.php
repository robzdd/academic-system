<?php

namespace App\Http\Controllers\AdminBaak;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MataKuliah;
use App\Models\ProgramStudi;

class MataKuliahController extends Controller
{
    public function index()
    {
        $mataKuliahList = MataKuliah::with('programStudi')->orderBy('kode_mk')->get();
        return view('admin_baak.mata_kuliah.index', compact('mataKuliahList'));
    }

    public function create()
    {
        $prodiList = ProgramStudi::orderBy('nama_prodi')->get();
        return view('admin_baak.mata_kuliah.create', compact('prodiList'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'kode_mk' => 'required|string|max:50|unique:mata_kuliah,kode_mk',
            'nama_mk' => 'required|string|max:255',
            'sks' => 'required|integer|min:1|max:10',
            'semester' => 'required|integer|min:1|max:14',
            'program_studi_id' => 'required|exists:program_studi,id',
        ]);
        MataKuliah::create($validated);
        return redirect()->route('admin.mata-kuliah.index')->with('success', 'Mata kuliah berhasil ditambahkan');
    }

    public function edit(MataKuliah $mataKuliah)
    {
        $prodiList = ProgramStudi::orderBy('nama_prodi')->get();
        return view('admin_baak.mata_kuliah.edit', compact('mataKuliah', 'prodiList'));
    }

    public function update(Request $request, MataKuliah $mataKuliah)
    {
        $validated = $request->validate([
            'kode_mk' => 'required|string|max:50|unique:mata_kuliah,kode_mk,' . $mataKuliah->id,
            'nama_mk' => 'required|string|max:255',
            'sks' => 'required|integer|min:1|max:10',
            'semester' => 'required|integer|min:1|max:14',
            'program_studi_id' => 'required|exists:program_studi,id',
        ]);
        $mataKuliah->update($validated);
        return redirect()->route('admin.mata-kuliah.index')->with('success', 'Mata kuliah berhasil diperbarui');
    }

    public function destroy(MataKuliah $mataKuliah)
    {
        $mataKuliah->delete();
        return redirect()->route('admin.mata-kuliah.index')->with('success', 'Mata kuliah berhasil dihapus');
    }
}
