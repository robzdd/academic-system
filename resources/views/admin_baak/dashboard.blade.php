@extends('layouts.admin_baak')

@section('title', 'Dashboard')

@section('content')
<div class="mb-8">
    <h2 class="text-3xl font-extrabold text-slate-800 tracking-tight">Dashboard Admin BAAK</h2>
    <p class="text-slate-600 mt-1">
        Tahun Akademik: 
        <span class="font-semibold text-indigo-600">{{ $tahunAktif->kode_tahun }}</span> - 
        <span class="capitalize">{{ $tahunAktif->semester }}</span>
    </p>
</div>

<!-- Statistik -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">
    <!-- Mahasiswa -->
    <div class="bg-gradient-to-br from-indigo-500 to-indigo-600 rounded-2xl shadow-md p-6 text-white hover:shadow-xl transform hover:-translate-y-1 transition">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-indigo-100 text-sm">Total Mahasiswa</p>
                <p class="text-4xl font-extrabold mt-1">{{ $totalMahasiswa }}</p>
            </div>
            <div class="bg-white/20 p-3 rounded-full">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                </svg>
            </div>
        </div>
    </div>

    <!-- Dosen -->
    <div class="bg-gradient-to-br from-emerald-500 to-emerald-600 rounded-2xl shadow-md p-6 text-white hover:shadow-xl transform hover:-translate-y-1 transition">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-emerald-100 text-sm">Total Dosen</p>
                <p class="text-4xl font-extrabold mt-1">{{ $totalDosen }}</p>
            </div>
            <div class="bg-white/20 p-3 rounded-full">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                </svg>
            </div>
        </div>
    </div>

    <!-- Kelas -->
    <div class="bg-gradient-to-br from-sky-500 to-sky-600 rounded-2xl shadow-md p-6 text-white hover:shadow-xl transform hover:-translate-y-1 transition">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sky-100 text-sm">Total Kelas</p>
                <p class="text-4xl font-extrabold mt-1">{{ $totalKelas }}</p>
            </div>
            <div class="bg-white/20 p-3 rounded-full">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                </svg>
            </div>
        </div>
    </div>

    <!-- Jadwal -->
    <div class="bg-gradient-to-br from-rose-500 to-rose-600 rounded-2xl shadow-md p-6 text-white hover:shadow-xl transform hover:-translate-y-1 transition">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-rose-100 text-sm">Total Jadwal</p>
                <p class="text-4xl font-extrabold mt-1">{{ $totalJadwal }}</p>
            </div>
            <div class="bg-white/20 p-3 rounded-full">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
            </div>
        </div>
    </div>
</div>

<!-- Menu Utama -->
<div class="bg-white rounded-2xl shadow-md p-8">
    <h3 class="text-2xl font-bold text-slate-800 mb-6 border-b pb-3">Menu Utama</h3>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- Kelola Jadwal -->
        <a href="{{ route('admin.jadwal.index') }}" 
           class="block p-6 bg-gradient-to-r from-indigo-50 to-slate-50 border border-indigo-100 rounded-xl hover:shadow-lg hover:-translate-y-1 transition">
            <div class="flex items-center space-x-4">
                <div class="bg-indigo-600 p-3 rounded-full text-white">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                </div>
                <div>
                    <h4 class="font-bold text-slate-800">Kelola Jadwal Kuliah</h4>
                    <p class="text-sm text-slate-600">Tambah, edit, dan hapus jadwal kuliah</p>
                </div>
            </div>
        </a>

        <!-- Tambah Jadwal -->
        <a href="{{ route('admin.jadwal.create') }}" 
           class="block p-6 bg-gradient-to-r from-emerald-50 to-slate-50 border border-emerald-100 rounded-xl hover:shadow-lg hover:-translate-y-1 transition">
            <div class="flex items-center space-x-4">
                <div class="bg-emerald-600 p-3 rounded-full text-white">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                </div>
                <div>
                    <h4 class="font-bold text-slate-800">Tambah Jadwal Baru</h4>
                    <p class="text-sm text-slate-600">Buat jadwal kuliah untuk kelas baru</p>
                </div>
            </div>
        </a>
    </div>
</div>
@endsection
