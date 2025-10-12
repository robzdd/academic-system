<?php

namespace App\Http\Controllers\AdminBaak;

use App\Http\Controllers\Controller;
use App\Models\TagihanUkt;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;

class TagihanUktController extends Controller
{
    public function index()
    {
        $tagihan = TagihanUkt::with('mahasiswa')->latest()->get();
        return view('admin_baak.tagihan.index', compact('tagihan'));
    }

    public function create()
    {
        $mahasiswa = Mahasiswa::all();
        return view('admin_baak.tagihan.create', compact('mahasiswa'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'mahasiswa_id' => 'required|exists:mahasiswa,id',
            'semester' => 'required|string|max:10',
            'jumlah_tagihan' => 'required|numeric|min:0',
        ]);

        TagihanUkt::create([
            'mahasiswa_id' => $request->mahasiswa_id,
            'semester' => $request->semester,
            'jumlah_tagihan' => $request->jumlah_tagihan,
            'order_id' => 'UKT-' . strtoupper(uniqid()),
            'tanggal_tagihan' => now(),
            'status' => 'belum_dibayar',
        ]);

        return redirect()->route('admin_baak.tagihan.index')->with('success', 'Tagihan berhasil dibuat.');
    }

    public function show($id)
    {
        $tagihan = TagihanUkt::with('mahasiswa')->findOrFail($id);
        return view('admin_baak.tagihan.show', compact('tagihan'));
    }

    public function destroy($id)
    {
        TagihanUkt::findOrFail($id)->delete();
        return redirect()->route('admin_baak.tagihan.index')->with('success', 'Tagihan berhasil dihapus.');
    }
}
