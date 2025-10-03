@extends('layouts.dosen')

@section('title', 'Dashboard')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
    <div class="bg-white rounded-lg shadow-md p-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-500 text-sm">Total Kelas</p>
                <p class="text-3xl font-bold text-green-600">{{ $totalKelas }}</p>
            </div>
            <div class="bg-green-100 p-3 rounded-full">
                <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                </svg>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow-md p-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-500 text-sm">Total Mahasiswa</p>
                <p class="text-3xl font-bold text-blue-600">{{ $totalMahasiswa }}</p>
            </div>
            <div class="bg-blue-100 p-3 rounded-full">
                <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                </svg>
            </div>
        </div>
    </div>
</div>

<div class="bg-white rounded-lg shadow-md p-6 mb-6">
    <h2 class="text-xl font-bold text-gray-800 mb-4">Informasi Dosen</h2>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
            <p class="text-gray-600 text-sm">NIDN</p>
            <p class="font-semibold">{{ $dosen->nidn }}</p>
        </div>
        <div>
            <p class="text-gray-600 text-sm">Nama Lengkap</p>
            <p class="font-semibold">{{ Auth::user()->username }}</p>
        </div>
        <div>
            <p class="text-gray-600 text-sm">Program Studi</p>
            <p class="font-semibold">{{ $dosen->programStudi->nama_prodi }}</p>
        </div>
        <div>
            <p class="text-gray-600 text-sm">Tahun Akademik Aktif</p>
            <p class="font-semibold">{{ $tahunAktif->kode_tahun }} - {{ ucfirst($tahunAktif->semester) }}</p>
        </div>
    </div>
    <div class="mt-4">
        <a href="{{ route('dosen.bimbingan') }}" class="inline-block bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded transition">Lihat Mahasiswa Bimbingan & ACC KRS</a>
    </div>
</div>

<div class="bg-white rounded-lg shadow-md p-6">
    <h2 class="text-xl font-bold text-gray-800 mb-4">Kelas yang Diampu</h2>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
        @forelse($kelasList as $kelas)
        <div class="border border-gray-200 rounded-lg p-4 hover:shadow-lg transition">
            <h3 class="font-bold text-gray-800">{{ $kelas->mataKuliah->nama_mk }}</h3>
            <p class="text-sm text-gray-600 mb-2">Kelas {{ $kelas->nama_kelas }}</p>
            <div class="flex justify-between text-sm mb-3">
                <span class="text-gray-600">SKS: {{ $kelas->mataKuliah->sks }}</span>
                <span class="text-gray-600">{{ $kelas->jumlah_mahasiswa }}/{{ $kelas->kapasitas }} Mhs</span>
            </div>
            <a href="{{ route('dosen.nilai.index', $kelas->id) }}"
               class="block w-full bg-green-600 hover:bg-green-700 text-white text-center py-2 rounded transition">
                Input Nilai
            </a>
        </div>
        @empty
        <div class="col-span-3 text-center py-8 text-gray-500">
            Belum ada kelas yang diampu
        </div>
        @endforelse
    </div>
</div>
@endsection
