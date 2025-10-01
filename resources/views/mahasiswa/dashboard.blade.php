@extends('layouts.mahasiswa')

@section('title', 'Dashboard')

@section('content')

<div class="flex justify-center mb-8">
    <img src="{{ asset('images/logo/Universitas_Iqra_Buru.png') }}"
         alt="Logo STMIK Iqra Buru"
         class="h-24 w-auto">
</div>

<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
    <div class="bg-white rounded-lg shadow-md p-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-500 text-sm">Semester Aktif</p>
                <p class="text-3xl font-bold text-blue-600">{{ $mahasiswa->semester_aktif }}</p>
            </div>
            <div class="bg-blue-100 p-3 rounded-full">
                <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                </svg>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow-md p-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-500 text-sm">Total SKS Semester Ini</p>
                <p class="text-3xl font-bold text-green-600">{{ $totalSks }}</p>
            </div>
            <div class="bg-green-100 p-3 rounded-full">
                <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow-md p-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-500 text-sm">IPK</p>
                <p class="text-3xl font-bold text-purple-600">{{ number_format($ipk, 2) }}</p>
            </div>
            <div class="bg-purple-100 p-3 rounded-full">
                <svg class="w-8 h-8 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/>
                </svg>
            </div>
        </div>
    </div>
</div>

<div class="bg-white rounded-lg shadow-md p-6">
    <h2 class="text-xl font-bold text-gray-800 mb-4">Informasi Mahasiswa</h2>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
            <p class="text-gray-600 text-sm">NIM</p>
            <p class="font-semibold">{{ $mahasiswa->nim }}</p>
        </div>
        <div>
            <p class="text-gray-600 text-sm">Nama Lengkap</p>
            <p class="font-semibold">{{ Auth::user()->username }}</p>
        </div>
        <div>
            <p class="text-gray-600 text-sm">Program Studi</p>
            <p class="font-semibold">{{ $mahasiswa->programStudi->nama_prodi }}</p>
        </div>
        <div>
            <p class="text-gray-600 text-sm">Angkatan</p>
            <p class="font-semibold">{{ $mahasiswa->angkatan }}</p>
        </div>
        <div>
            <p class="text-gray-600 text-sm">Tahun Akademik Aktif</p>
            <p class="font-semibold">{{ $tahunAktif->kode_tahun }} - {{ ucfirst($tahunAktif->semester) }}</p>
        </div>
    </div>
</div>
@endsection
