<?php

use App\Http\Controllers\Auth\AdminAuthController;
use App\Http\Controllers\Auth\DosenAuthController;
use App\Http\Controllers\Auth\MahasiswaAuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Dosen\KelasController;
use App\Http\Controllers\Mahasiswa\KhsController;
use App\Http\Controllers\Mahasiswa\KrsController;
use App\Http\Controllers\Dosen\NilaiController as DosenNilai;
use App\Http\Controllers\AdminBaak\PembimbingAkademikController;
use App\Http\Controllers\AdminBaak\JadwalController as AdminJadwal;
use App\Http\Controllers\Dosen\DashboardController as DosenDashboard;
use App\Http\Controllers\Mahasiswa\NilaiController as MahasiswaNilai;
use App\Http\Controllers\Mahasiswa\JadwalController as MahasiswaJadwal;
use App\Http\Controllers\AdminBaak\DashboardController as AdminDashboard;
use App\Http\Controllers\Mahasiswa\DashboardController as MahasiswaDashboard;

// ==========================================================
// ROOT ROUTE
// ==========================================================
Route::get('/', function () {
    if (auth()->check()) {
        $user = auth()->user();

        if ($user->role === 'mahasiswa') {
            return redirect()->route('mahasiswa.dashboard');
        } elseif ($user->role === 'dosen') {
            return redirect()->route('dosen.dashboard');
        } elseif ($user->role === 'admin_baak') {
            return redirect()->route('admin.dashboard');
        }
    }

    return redirect()->route('login');
});

// ==========================================================
// MAHASISWA LOGIN
// ==========================================================
Route::get('/mahasiswa/login', [MahasiswaAuthController::class, 'showLoginForm'])
    ->name('login.mahasiswa');
Route::post('/mahasiswa/login', [MahasiswaAuthController::class, 'login'])
    ->name('login.mahasiswa.post');
Route::post('/mahasiswa/logout', [MahasiswaAuthController::class, 'logout'])
    ->name('logout.mahasiswa');

// ==========================================================
// ADMIN LOGIN
// ==========================================================
Route::get('/admin/login', [AdminAuthController::class, 'showLoginForm'])
    ->name('login.admin');
Route::post('/admin/login', [AdminAuthController::class, 'login'])
    ->name('login.admin.post');
Route::post('/admin/logout', [AdminAuthController::class, 'logout'])
    ->name('logout.admin');

// ==========================================================
// GENERAL LOGIN
// ==========================================================
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
});
Route::post('/logout', [AuthController::class, 'logout'])
    ->name('logout')
    ->middleware('auth');

// ==========================================================
// MAHASISWA ROUTES
// ==========================================================
Route::middleware(['auth', 'role:mahasiswa'])->prefix('mahasiswa')->name('mahasiswa.')->group(function () {
    Route::get('/dashboard', [MahasiswaDashboard::class, 'index'])->name('dashboard');
    Route::get('/krs', [KrsController::class, 'index'])->name('krs.index');
    Route::post('/krs/tambah', [KrsController::class, 'store'])->name('krs.store');
    Route::delete('/krs/{krs}', [KrsController::class, 'destroy'])->name('krs.destroy');
    Route::post('/krs/ajukan', [KrsController::class, 'submit'])->name('krs.submit');

    Route::get('/khs', [KhsController::class, 'index'])->name('khs.index');
    Route::get('/khs/{tahunAkademik}/download', [KhsController::class, 'download'])->name('khs.download');

    Route::get('/jadwal', [MahasiswaJadwal::class, 'index'])->name('jadwal.index');
    Route::get('/nilai', [MahasiswaNilai::class, 'index'])->name('nilai.index');
});

// ==========================================================
// DOSEN ROUTES
// ==========================================================
Route::middleware(['auth', 'role:dosen'])->prefix('dosen')->name('dosen.')->group(function () {
    Route::get('/dashboard', [DosenDashboard::class, 'index'])->name('dashboard');
    Route::get('/kelas', [KelasController::class, 'index'])->name('kelas.index');
    Route::get('/kelas/{kelas}', [KelasController::class, 'show'])->name('kelas.show');

    Route::get('/kelas/{kelas}/nilai', [DosenNilai::class, 'index'])->name('nilai.index');
    Route::post('/nilai/update', [DosenNilai::class, 'update'])->name('nilai.update');
    Route::post('/nilai/update-batch', [DosenNilai::class, 'updateBatch'])->name('nilai.update.batch');
});

// ==========================================================
// ADMIN BAAK ROUTES
// ==========================================================
Route::middleware(['auth', 'role:admin_baak'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboard::class, 'index'])->name('dashboard');

    Route::get('/jadwal', [AdminJadwal::class, 'index'])->name('jadwal.index');
    Route::get('/jadwal/create', [AdminJadwal::class, 'create'])->name('jadwal.create');
    Route::post('/jadwal', [AdminJadwal::class, 'store'])->name('jadwal.store');
    Route::get('/jadwal/{jadwal}/edit', [AdminJadwal::class, 'edit'])->name('jadwal.edit');
    Route::put('/jadwal/{jadwal}', [AdminJadwal::class, 'update'])->name('jadwal.update');
    Route::delete('/jadwal/{jadwal}', [AdminJadwal::class, 'destroy'])->name('jadwal.destroy');

    Route::resource('pembimbing', PembimbingAkademikController::class);
});
