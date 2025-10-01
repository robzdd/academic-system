<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MahasiswaAuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.mahasiswa-login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required','email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // cek role
            if (auth()->user()->role !== 'mahasiswa') {
                Auth::logout();
                return back()->withErrors(['email' => 'Anda bukan mahasiswa']);
            }

            return redirect('/mahasiswa/dashboard');
        }

        return back()->withErrors(['email' => 'Email/password salah']);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/mahasiswa/login');
    }
}