
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard IQRA</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans">

    <!-- Header -->
    <header class="bg-blue-900 text-white">
        <div class="max-w-7xl mx-auto flex items-center justify-between p-4">
            <div class="flex items-center space-x-3">
                <img src="file-QadSz7BRW96SpV8GNZmPk9.png" alt="Logo" class="w-10 h-10">
                <div>
                    <div class="text-sm">SIM Akademik</div>
                    <div class="text-lg font-bold">IQRA BURU</div>
                </div>
            </div>
            <div class="flex items-center space-x-4">
                <div class="relative">
                    <button class="relative">
                        🔔
                        <span class="absolute -top-2 -right-2 bg-red-500 text-white rounded-full text-xs px-1">26</span>
                    </button>
                </div>
                <div>
                    <img src="https://i.pravatar.cc/40" alt="User" class="w-10 h-10 rounded-full">
                </div>
            </div>
        </div>

        <!-- Navbar -->
        <nav class="bg-blue-800">
            <div class="max-w-7xl mx-auto flex space-x-4 p-3 text-white">
                <a href="#" class="border-b-2 border-white pb-1">Beranda</a>
                <a href="#">Jadwal</a>
                <a href="#">Akademik</a>
                <a href="#">Tingkat Akhir</a>
                <a href="#">Hasil Studi</a>
            </div>
        </nav>
    </header>

    <!-- Main Content -->
    <main class="max-w-7xl mx-auto p-6 grid grid-cols-1 md:grid-cols-3 gap-6">

        <!-- Jadwal Kuliah -->
        <div class="md:col-span-2 space-y-4">
            <div class="bg-white p-6 rounded-lg shadow">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="font-bold text-lg">Jadwal Kuliah</h2>
                    <div>Rabu, 1 Oktober 2025 ▼</div>
                </div>

                <!-- Kelas 1 -->
                <div class="border p-4 rounded-lg mb-4">
                    <div class="flex justify-between items-center mb-2">
                        <span class="font-bold">PROYEK 3 (32)</span>
                    </div>
                    <div class="text-sm text-gray-600 mb-1">10:00 - 11:40 WIB | 3 SKS</div>
                    <div class="text-sm text-gray-600 mb-1">Nidan</div>
                    <div class="text-sm text-gray-600 mb-1">Pertemuan ke 13 | Hadir (9 / 48)</div>
                    <div class="text-sm text-gray-600">LAB. DATA SCIENCE</div>
                </div>

                <!-- Kelas 2 -->
                <div class="border p-4 rounded-lg">
                    <div class="flex justify-between items-center mb-2">
                        <span class="font-bold">PEMELIHARAAN PERANGKAT LUNAK (32)</span>
                    </div>
                    <div class="text-sm text-gray-600 mb-1">13:30 - 16:00 WIB | 3 SKS</div>
                    <div class="text-sm text-gray-600 mb-1">Robi</div>
                    <div class="text-sm text-gray-600 mb-1">Pertemuan ke 9 | Hadir (9 / 48)</div>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="space-y-4">
            <!-- Profil -->
            <div class="bg-white p-4 rounded-lg shadow">
                <div class="flex items-center space-x-4">
                    <img src="https://i.pravatar.cc/50" alt="Avatar" class="w-12 h-12 rounded-full">
                    <div>
                        <p class="font-bold">Hai, Mahasiswa</p>
                        <p class="text-sm text-gray-600">Saat ini Anda berada di Semester 5 dengan IPK 3.50. <a href="#" class="text-blue-600 underline">Lihat detail</a></p>
                    </div>
                </div>
                <div class="mt-3 p-2 bg-yellow-100 text-yellow-900 rounded text-sm">
                    Mahasiswa belum melengkapi biodata. <a href="#" class="underline">Lengkapi di sini</a>
                </div>
            </div>

            <!-- Tagihan -->
            <div class="bg-white p-4 rounded-lg shadow">
                <p class="font-bold">Total Tagihan</p>
                <p class="text-2xl font-bold text-blue-800">Rp 5.000.000</p>
                <p class="text-sm text-gray-600">Kamu sudah membayar Rp 10.000.000 dari Rp 15.000.000</p>
                <a href="#" class="text-blue-600 underline text-sm">Lihat Rincian</a>
            </div>

            <!-- Kalender -->
            <div class="bg-white p-4 rounded-lg shadow">
                <p class="font-bold mb-2">Kalender Akademik</p>
                <div class="text-center text-gray-600">October, 2025</div>
                <!-- Contoh kalender -->
                <div class="grid grid-cols-7 gap-1 mt-2 text-sm text-gray-600">
                    <div>Sun</div><div>Mon</div><div>Tue</div><div>Wed</div><div>Thu</div><div>Fri</div><div>Sat</div>
                    <!-- tanggal 1-31 -->
                    <div></div><div></div><div></div><div>1</div><div>2</div><div>3</div><div>4</div>
                    <div>5</div><div>6</div><div>7</div><div>8</div><div>9</div><div>10</div><div>11</div>
                    <div>12</div><div>13</div><div>14</div><div>15</div><div>16</div><div>17</div><div>18</div>
                    <div>19</div><div>20</div><div>21</div><div>22</div><div>23</div><div>24</div><div>25</div>
                    <div>26</div><div>27</div><div>28</div><div>29</div><div>30</div><div>31</div><div></div>
                </div>
            </div>
        </div>
    </main>

</body>
</html>
=======
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
        <div>
            <p class="text-gray-600 text-sm">Pembimbing Akademik</p>
            <p class="font-semibold">
                @if($pembimbingAkademik)
                    {{ $pembimbingAkademik->dosen->user->username }}
                @else
                    Belum ditentukan
                @endif
            </p>
        </div>
    </div>
</div>
@endsection
