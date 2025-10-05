<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;   // ini harus ada
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function index()
    {
        $mahasiswa = Auth::user()->mahasiswa; // ambil data mahasiswa dari user login
        return view('mahasiswa.profile-mahasiswa', compact('mahasiswa'));
    }
}
