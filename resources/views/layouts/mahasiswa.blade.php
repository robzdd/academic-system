<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - SIAKAD Mahasiswa</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="//unpkg.com/alpinejs" defer></script>
    <link rel="icon" type="image/x-icon" href="{{ asset('images/logo/Universitas_Iqra_Buru.png') }}">

      <style>
        /* ======== Efek Background Geometrik Halus ======== */
        .nav-geometry {
            position: relative;
            overflow: hidden;
            background: linear-gradient(to right, #2563eb, #1e3a8a); /* fallback warna dasar */
        }

        .nav-geometry::before {
            content: "";
            position: absolute;
            top: 0;
            right: 0;
            width: 100%;
            height: 100%;
            background: url('{{ asset('images/mahasiswa/bg/image.png') }}') no-repeat top right;
            background-size: cover;
            opacity: 0.12; /* ubah antara 0.1–0.25 sesuai keinginan */
            mix-blend-mode: overlay; /* atau try: soft-light / multiply / screen */
            filter: blur(2px) saturate(120%);
            transform: scale(1.05);
            z-index: 0;
        }

        .nav-content {
            position: relative;
            z-index: 10;
        }
    </style>
</head>
<body class="bg-gray-50">

    <!-- Logo + Nama Kampus -->
    <header class="nav-geometry text-white py-4 shadow">
        <div class="nav-content max-w-7xl mx-auto flex items-center space-x-4 px-4">
            <div class="bg-white rounded-full p-2 shadow">
                <img src="{{ asset('images/logo/Universitas_Iqra_Buru.png') }}"
                     alt="Logo Kampus" class="h-12 w-12 object-contain">
            </div>
            <div>
                <span class="block text-sm font-light">SIM Akademik</span>
                <h1 class="text-xl font-bold">Universitas Iqra Buru</h1>
            </div>
        </div>
    </header>

    <!-- Navbar -->
    <nav x-data="{ open:false }" class="bg-blue-700 text-white shadow-md">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex justify-between items-center h-12">

                <!-- Tombol Hamburger (Mobile) -->
                <div class="flex items-center sm:hidden">
                    <button @click="open=!open" class="text-white focus:outline-none">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path x-show="!open" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M4 6h16M4 12h16M4 18h16"/>
                            <path x-show="open" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>

                <!-- Menu Kiri (Desktop) -->
                <div class="hidden sm:flex space-x-6">
                    <a href="{{ route('mahasiswa.dashboard') }}"
                       class="px-3 py-2 border-b-2 {{ request()->routeIs('mahasiswa.dashboard') ? 'border-white font-semibold' : 'border-transparent hover:border-gray-200' }}">
                        Beranda
                    </a>

                    <!-- Dropdown Jadwal -->
                    <div class="relative" x-data="{ d1:false }">
                        <button @click="d1=!d1"
                                class="px-3 py-2 flex items-center border-b-2 {{ request()->is('mahasiswa/jadwal*') ? 'border-white font-semibold' : 'border-transparent hover:border-gray-200' }}">
                            Jadwal
                            <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M19 9l-7 7-7-7"/>
                            </svg>
                        </button>
                        <div x-show="d1" @click.away="d1=false"
                             class="absolute bg-white text-gray-700 mt-1 rounded shadow w-48">
                            <a href="{{ route('mahasiswa.jadwal.index') }}" class="block px-4 py-2 hover:bg-gray-100">Jadwal Mingguan</a>
                            <a href="#" class="block px-4 py-2 hover:bg-gray-100">Kalender Akademik</a>
                            <a href="#" class="block px-4 py-2 hover:bg-gray-100">Jadwal Semester</a>
                        </div>
                    </div>

                    <!-- Dropdown Akademik -->
                    <div class="relative" x-data="{ d2:false }">
                        <button @click="d2=!d2"
                                class="px-3 py-2 flex items-center border-b-2 {{ request()->is('mahasiswa/krs*') || request()->is('mahasiswa/nilai*') ? 'border-white font-semibold' : 'border-transparent hover:border-gray-200' }}">
                            Akademik
                            <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M19 9l-7 7-7-7"/>
                            </svg>
                        </button>
                        <div x-show="d2" @click.away="d2=false"
                             class="absolute bg-white text-gray-700 mt-1 rounded shadow w-56">
                            <a href="{{ route('mahasiswa.krs.index') }}" class="block px-4 py-2 hover:bg-gray-100">Pengisian KRS</a>
                            <a href="{{ route('mahasiswa.krs.riwayat') }}" class="block px-4 py-2 hover:bg-gray-100">Riwayat KRS</a>
                            <a href="#" class="block px-4 py-2 hover:bg-gray-100">Mengulang</a>
                            <a href="{{ route('mahasiswa.nilai.index') }}" class="block px-4 py-2 hover:bg-gray-100">Nilai Mahasiswa</a>
                        </div>
                    </div>

                    <!-- Dropdown Hasil Studi -->
                    <div class="relative" x-data="{ d3:false }">
                        <button @click="d3=!d3"
                                class="px-3 py-2 flex items-center border-b-2 {{ request()->is('mahasiswa/khs*') || request()->is('mahasiswa/transkrip*') ? 'border-white font-semibold' : 'border-transparent hover:border-gray-200' }}">
                            Hasil Studi
                            <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M19 9l-7 7-7-7"/>
                            </svg>
                        </button>
                        <div x-show="d3" @click.away="d3=false"
                             class="absolute bg-white text-gray-700 mt-1 rounded shadow w-48">
                            <a href="{{ route('mahasiswa.khs.index') }}" class="block px-4 py-2 hover:bg-gray-100">KHS</a>
                            <a href="#" class="block px-4 py-2 hover:bg-gray-100">Transkrip</a>
                        </div>
                    </div>

                    <!-- Dropdown Pembayaran -->
                    <div class="relative" x-data="{ d9:false }">
                        <button @click="d9=!d9"
                                class="px-3 py-2 flex items-center border-b-2 {{ request()->is('mahasiswa/khs*') || request()->is('mahasiswa/transkrip*') ? 'border-white font-semibold' : 'border-transparent hover:border-gray-200' }}">
                            Pembayaran
                            <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M19 9l-7 7-7-7"/>
                            </svg>
                        </button>
                        <div x-show="d9" @click.away="d9=false"
                             class="absolute bg-white text-gray-700 mt-1 rounded shadow w-48">
                            <a href="" class="block px-4 py-2 hover:bg-gray-100">Tagihan</a>
                            <a href="#" class="block px-4 py-2 hover:bg-gray-100">Riwayat Tagihan</a>
                        </div>
                    </div>
                </div>

                <!-- Menu Kanan -->
                <div class="relative" x-data="{ d4:false }">
                    <button @click="d4=!d4" class="flex items-center space-x-2 px-3 py-2 hover:bg-blue-600 rounded">
                        <img src="" alt="Profil" class="h-8 w-8 rounded-full border">
                        <span>{{ Auth::user()->name ?? 'Mahasiswa' }}</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>
                    <div x-show="d4" @click.away="d4=false"
                         class="absolute right-0 mt-2 w-40 bg-white text-gray-700 rounded shadow">
                        <a href="{{ route('mahasiswa.profil') }}" class="block px-4 py-2 hover:bg-gray-100">Profil</a>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="w-full text-left px-4 py-2 hover:bg-gray-100">Logout</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Menu Mobile -->
        <div x-show="open" class="sm:hidden bg-blue-800">
            <a href="{{ route('mahasiswa.dashboard') }}" class="block px-4 py-2 border-b border-blue-600 hover:bg-blue-600">Beranda</a>
            <a href="{{ route('mahasiswa.jadwal.index') }}" class="block px-4 py-2 border-b border-blue-600 hover:bg-blue-600">Jadwal</a>
            <a href="{{ route('mahasiswa.krs.index') }}" class="block px-4 py-2 border-b border-blue-600 hover:bg-blue-600">Akademik</a>
            <a href="{{ route('mahasiswa.khs.index') }}" class="block px-4 py-2 border-b border-blue-600 hover:bg-blue-600">Hasil Studi</a>
            <a href="" class="block px-4 py-2 border-b border-blue-600 hover:bg-blue-600">Pembayaran</a>
            <form action="{{ route('logout') }}" method="POST" class="px-4 py-2">
                @csrf
                <button type="submit" class="w-full text-left">Logout</button>
            </form>
        </div>
    </nav>

    <!-- Content -->
    <main class="max-w-7xl mx-auto px-4 py-8">
        @yield('content')
    </main>

</body>
</html>
