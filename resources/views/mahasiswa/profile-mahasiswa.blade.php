@extends('layouts.mahasiswa')

@section('title', 'Profil Mahasiswa')

@section('content')
<div class="bg-white shadow-md rounded-lg p-6">
    <!-- Header Profil -->
    <div class="flex items-center mb-6">
        <!-- Foto Profil -->
        <img src="{{ asset('images/mahasiswa-default.png') }}" alt="Foto Mahasiswa" 
             class="w-24 h-24 rounded-full border mr-6">

        <!-- Nama dan NIM -->
        <div>
            <h2 class="text-2xl font-bold text-gray-800">
                {{ $mahasiswa->nama ?? 'Nama Belum Diisi' }}
            </h2>
            <p class="text-gray-600">NIM: {{ $mahasiswa->nim ?? '-' }}</p>
        </div>
    </div>

    <!-- Detail Informasi -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- Identitas -->
        <div>
            <h3 class="text-lg font-semibold text-blue-900 mb-2">Identitas</h3>
            <ul class="text-gray-700 space-y-1">
                <li><span class="font-medium">Jenis Kelamin:</span> {{ $mahasiswa->jenis_kelamin ?? '-' }}</li>
                <li><span class="font-medium">Tempat, Tanggal Lahir:</span> 
                    {{ $mahasiswa->tempat_lahir ?? '-' }}, {{ $mahasiswa->tanggal_lahir ?? '-' }}
                </li>
                <li><span class="font-medium">Alamat:</span> {{ $mahasiswa->alamat ?? '-' }}</li>
                <li><span class="font-medium">No. HP:</span> {{ $mahasiswa->no_hp ?? '-' }}</li>
                <li><span class="font-medium">Email:</span> {{ $mahasiswa->email ?? '-' }}</li>
            </ul>
        </div>

        <!-- Akademik -->
        <div>
            <h3 class="text-lg font-semibold text-blue-900 mb-2">Akademik</h3>
            <ul class="text-gray-700 space-y-1">
                <li><span class="font-medium">Program Studi:</span> {{ $mahasiswa->prodi ?? '-' }}</li>
                <li><span class="font-medium">Fakultas:</span> {{ $mahasiswa->fakultas ?? '-' }}</li>
                <li><span class="font-medium">Jenjang:</span> {{ $mahasiswa->jenjang ?? '-' }}</li>
                <li><span class="font-medium">Angkatan:</span> {{ $mahasiswa->angkatan ?? '-' }}</li>
                <li><span class="font-medium">Status:</span> {{ $mahasiswa->status ?? '-' }}</li>
                <li><span class="font-medium">Dosen Wali:</span> {{ $mahasiswa->dosen_wali ?? 'Belum ditentukan' }}</li>
            </ul>
        </div>
    </div>
</div>
@endsection
