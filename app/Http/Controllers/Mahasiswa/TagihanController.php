<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\TagihanUkt;

class TagihanController extends Controller
{
    public function index()
    {
        $mahasiswa = Auth::user()->mahasiswa; // pastikan relasi user ke mahasiswa sudah ada
        $tagihan = TagihanUkt::where('mahasiswa_id', $mahasiswa->id)->latest()->get();

        return view('mahasiswa.tagihan', compact('tagihan'));
    }
}
