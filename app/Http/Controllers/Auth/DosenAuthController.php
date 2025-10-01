<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DosenAuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.dosen-login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required','email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt(array_merge($credentials, ['role' => 'dosen']))) {
            $request->session()->regenerate();
            return redirect('/dosen/dashboard');
        }

        return back()->withErrors(['email' => 'Email/password salah']);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/dosen/login');
    }
}
