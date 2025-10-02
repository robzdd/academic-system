@extends('layouts.admin_baak')

@section('title', 'Dashboard')

@section('content')
<div class="mb-6">
    <h2 class="text-3xl font-bold text-gray-800">Dashboard Admin BAAK</h2>
    <p class="text-gray-600">Tahun Akademik: {{ $tahunAktif->kode_tahun }} - {{ ucfirst($tahunAktif->semester) }}</p>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <div class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-lg shadow-lg p-6 text-white">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-blue-100 text-sm mb-1">Total Mahasiswa</p>
                <p class="text-3xl font-bold">{{ $totalMahasiswa }}</p>
            </div>
            <div class="bg-blue-400 bg-opacity-50 p-3 rounded-full">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                </svg>
            </div>
        </div>
    </div>

    <div class="bg-gradient-to-br from-green-500 to-green-600 rounded-lg shadow-lg p-6 text-white">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-green-100 text-sm mb-1">Total Dosen</p>
                <p class="text-3xl font-bold">{{ $totalDosen }}</p>
            </div>
            <div class="bg-green-400 bg-opacity-50 p-3 rounded-full">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                </svg>
            </div>
        </div>
    </div>

    <div class="bg-gradient-to-br from-purple-500 to-purple-600 rounded-lg shadow-lg p-6 text-white">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-purple-100 text-sm mb-1">Total Kelas</p>
                <p class="text-3xl font-bold">{{ $totalKelas }}</p>
            </div>
            <div class="bg-purple-400 bg-opacity-50 p-3 rounded-full">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                </svg>
            </div>
        </div>
    </div>

    <div class="bg-gradient-to-br from-pink-500 to-pink-600 rounded-lg shadow-lg p-6 text-white">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-pink-100 text-sm mb-1">Total Jadwal</p>
                <p class="text-3xl font-bold">{{ $totalJadwal }}</p>
            </div>
            <div class="bg-pink-400 bg-opacity-50 p-3 rounded-full">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
            </div>
        </div>
    </div>
</div>

<div class="bg-white rounded-lg shadow-md p-6">
    <h3 class="text-xl font-bold text-gray-800 mb-4">Menu Utama</h3>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <a href="{{ route('admin.jadwal.index') }}" class="block p-6 bg-gradient-to-r from-purple-50 to-pink-50 border border-purple-200 rounded-lg hover:shadow-lg transition">
            <div class="flex items-center space-x-4">
                <div class="bg-purple-600 p-3 rounded-full text-white">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                </div>
                <div>
                    <h4 class="font-bold text-gray-800">Kelola Jadwal Kuliah</h4>
                    <p class="text-sm text-gray-600">Tambah, edit, dan hapus jadwal kuliah</p>
                </div>
            </div>
        </a>

        <a href="{{ route('admin.jadwal.create') }}" class="block p-6 bg-gradient-to-r from-green-50 to-teal-50 border border-green-200 rounded-lg hover:shadow-lg transition">
            <div class="flex items-center space-x-4">
                <div class="bg-green-600 p-3 rounded-full text-white">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                </div>
                <div>
                    <h4 class="font-bold text-gray-800">Tambah Jadwal Baru</h4>
                    <p class="text-sm text-gray-600">Buat jadwal kuliah untuk kelas baru</p>
                </div>
            </div>
        </a>
    </div>
</div>
@endsection
