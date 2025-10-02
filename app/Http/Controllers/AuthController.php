<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLogin()
    {
        // Jika sudah login, redirect sesuai role
        if (Auth::check()) {
            return $this->redirectByRole(Auth::user());
        }

        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ], [
            'username.required' => 'Username wajib diisi',
            'password.required' => 'Password wajib diisi',
        ]);

        // Coba login
        if (Auth::attempt($credentials, $request->filled('remember'))) {
            $request->session()->regenerate();

            $user = Auth::user();

            // Cek apakah user aktif
            if (!$user->is_active) {
                Auth::logout();
                return back()->withErrors([
                    'username' => 'Akun Anda tidak aktif. Hubungi admin.',
                ])->onlyInput('username');
            }

            // Redirect berdasarkan role
            return $this->redirectByRole($user);
        }

        // Login gagal
        return back()->withErrors([
            'username' => 'Username atau password salah.',
        ])->onlyInput('username');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('success', 'Anda berhasil logout.');
    }

    private function redirectByRole($user)
    {
        switch ($user->role) {
            case 'mahasiswa':
                return redirect()->route('mahasiswa.dashboard')
                    ->with('success', 'Selamat datang, ' . $user->nama_lengkap);
            case 'dosen':
                return redirect()->route('dosen.dashboard')
                    ->with('success', 'Selamat datang, ' . $user->nama_lengkap);
            case 'admin_baak':
                return redirect()->route('admin.dashboard')
                    ->with('success', 'Selamat datang, ' . $user->nama_lengkap);
            default:
                Auth::logout();
                return redirect()->route('login')->withErrors([
                    'username' => 'Role tidak valid. Hubungi administrator.',
                ]);
        }
    }
}
