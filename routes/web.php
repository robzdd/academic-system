<?php

use App\Http\Controllers\Auth\AdminAuthController;
use App\Http\Controllers\Auth\DosenAuthController;
use App\Http\Controllers\Auth\MahasiswaAuthController;
use Illuminate\Support\Facades\Route;

// Tampil form login mahasiswa
Route::get('/mahasiswa/login', [MahasiswaAuthController::class, 'showLoginForm'])
    ->name('login.mahasiswa');

// Submit login mahasiswa
Route::post('/mahasiswa/login', [MahasiswaAuthController::class, 'login'])
    ->name('login.mahasiswa.post');

// Logout mahasiswa
Route::post('/mahasiswa/logout', [MahasiswaAuthController::class, 'logout'])
    ->name('logout.mahasiswa');

Route::get('/mahasiswa/dashboard', function () {
    // data dummy
    $mahasiswa = (object)[
        'name' => 'Mahasiswa Test'
    ];

    $ringkasan = [
        'semester' => 4,
        'ipk' => 3.75,
        'sks' => 110
    ];

    $pengumuman = [
        ['judul' => 'Pendaftaran KRS Dibuka', 'tanggal' => '2025-10-05'],
        ['judul' => 'Ujian Tengah Semester', 'tanggal' => '2025-10-15'],
        ['judul' => 'Pengumuman Libur Nasional', 'tanggal' => '2025-10-20'],
    ];

    return view('mahasiswa.dashboard', compact('mahasiswa', 'ringkasan', 'pengumuman'));
})->name('mahasiswa.dashboard');

Route::get('/admin/login', [AdminAuthController::class, 'showLoginForm'])
    ->name('login.admin');

// Submit login mahasiswa
Route::post('/admin/login', [AdminAuthController::class, 'login'])
    ->name('login.admin.post');

// Logout mahasiswa
Route::post('/admin/logout', [AdminAuthController::class, 'logout'])
    ->name('logout.admin');

