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
        /* ======== Background Geometrik Halus ======== */
        .nav-geometry {
            position: relative;
            overflow: hidden;
            background: linear-gradient(to right, #1e3a8a, #2563eb);
        }

        .nav-geometry::before {
            content: "";
            position: absolute;
            inset: 0;
            background: url('{{ asset('images/mahasiswa/bg/image.png') }}') center/cover no-repeat;
            opacity: 0.12;
            mix-blend-mode: soft-light;
            filter: blur(2px) saturate(120%);
            transform: scale(1.03);
            z-index: 0;
        }

        .nav-content {
            position: relative;
            z-index: 10;
        }

        /* ======== Border Style for Navbar ======== */
        .nav-link {
            position: relative;
            padding: 0.5rem 0.75rem;
            border-bottom: 2px solid rgba(255, 255, 255, 0.6);
            transition: all 0.4s ease;
        }

        .nav-link:hover {
            border-color: #ffffff;
            background-color: rgba(255, 255, 255, 0.12);
            transform: translateY(-1px);
        }

        /* ======== Dropdown Animation ======== */
        [x-cloak] { display: none !important; }

        .dropdown-menu {
            transition: all 0.25s ease-in-out;
            transform-origin: top;
        }
    </style>
</head>

<body class="bg-gray-50">

    <!-- ===== HEADER ===== -->
    <header class="nav-geometry text-white py-4 shadow-lg">
        <div class="nav-content max-w-7xl mx-auto flex items-center space-x-4 px-4">
            <div class="bg-white rounded-full p-2 shadow-md">
                <img src="{{ asset('images/logo/Universitas_Iqra_Buru.png') }}"
                     alt="Logo Kampus" class="h-12 w-12 object-contain">
            </div>
            <div>
                <span class="block text-sm font-light tracking-wide">SIM Akademik</span>
                <h1 class="text-xl font-bold">Universitas Iqra Buru</h1>
            </div>
        </div>
    </header>

    <!-- ===== NAVBAR ===== -->
    <nav x-data="{ open:false }" class="bg-blue-700 text-white shadow-md relative z-20">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex justify-between items-center h-12">

                <!-- Tombol Hamburger (Mobile) -->
                <div class="sm:hidden">
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
                <div class="hidden sm:flex space-x-4">
                    <a href="{{ route('mahasiswa.dashboard') }}" class="nav-link">Beranda</a>

                    <!-- Dropdown Jadwal -->
                    <div class="relative" x-data="{ d1:false }" @click.away="d1=false">
                        <button @click="d1=!d1" class="nav-link flex items-center">
                            Jadwal
                            <svg class="w-4 h-4 ml-1 transition-transform duration-200"
                                 :class="d1 ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M19 9l-7 7-7-7"/>
                            </svg>
                        </button>
                        <div x-show="d1" x-transition x-cloak
                             class="dropdown-menu absolute bg-white text-gray-700 mt-2 rounded-md shadow-lg w-48">
                            <a href="{{ route('mahasiswa.jadwal.index') }}" class="block px-4 py-2 hover:bg-gray-100">Jadwal Mingguan</a>
                            <a href="#" class="block px-4 py-2 hover:bg-gray-100">Kalender Akademik</a>
                            <a href="#" class="block px-4 py-2 hover:bg-gray-100">Jadwal Semester</a>
                        </div>
                    </div>

                    <!-- Dropdown Akademik -->
                    <div class="relative" x-data="{ d2:false }" @click.away="d2=false">
                        <button @click="d2=!d2" class="nav-link flex items-center">
                            Akademik
                            <svg class="w-4 h-4 ml-1 transition-transform duration-200"
                                 :class="d2 ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M19 9l-7 7-7-7"/>
                            </svg>
                        </button>
                        <div x-show="d2" x-transition x-cloak
                             class="dropdown-menu absolute bg-white text-gray-700 mt-2 rounded-md shadow-lg w-56">
                            <a href="{{ route('mahasiswa.krs.index') }}" class="block px-4 py-2 hover:bg-gray-100">Pengisian KRS</a>
                            <a href="{{ route('mahasiswa.krs.riwayat') }}" class="block px-4 py-2 hover:bg-gray-100">Riwayat KRS</a>
                            <a href="#" class="block px-4 py-2 hover:bg-gray-100">Mengulang</a>
                            <a href="{{ route('mahasiswa.nilai.index') }}" class="block px-4 py-2 hover:bg-gray-100">Nilai Mahasiswa</a>
                        </div>
                    </div>

                    <!-- Hasil Studi -->
                    <div class="relative" x-data="{ d3:false }" @click.away="d3=false">
                        <button @click="d3=!d3" class="nav-link flex items-center">
                            Hasil Studi
                            <svg class="w-4 h-4 ml-1 transition-transform duration-200"
                                 :class="d3 ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M19 9l-7 7-7-7"/>
                            </svg>
                        </button>
                        <div x-show="d3" x-transition x-cloak
                             class="dropdown-menu absolute bg-white text-gray-700 mt-2 rounded-md shadow-lg w-48">
                            <a href="{{ route('mahasiswa.khs.index') }}" class="block px-4 py-2 hover:bg-gray-100">KHS</a>
                            <a href="#" class="block px-4 py-2 hover:bg-gray-100">Transkrip</a>
                        </div>
                    </div>

                    <!-- Pembayaran -->
                    <div class="relative" x-data="{ d4:false }" @click.away="d4=false">
                        <button @click="d4=!d4" class="nav-link flex items-center">
                            Pembayaran
                            <svg class="w-4 h-4 ml-1 transition-transform duration-200"
                                 :class="d4 ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M19 9l-7 7-7-7"/>
                            </svg>
                        </button>
                        <div x-show="d4" x-transition x-cloak
                             class="dropdown-menu absolute bg-white text-gray-700 mt-2 rounded-md shadow-lg w-48">
                            <a href="{{ route('mahasiswa.tagihan.index') }}" class="block px-4 py-2 hover:bg-gray-100">Tagihan</a>
                            <a href="#" class="block px-4 py-2 hover:bg-gray-100">Riwayat Pembayaran</a>
                        </div>
                    </div>
                </div>

                <!-- Menu Kanan -->
                <div class="relative" x-data="{ akun:false }" @click.away="akun=false">
                    <button @click="akun=!akun" class="flex items-center space-x-2 px-3 py-2 hover:bg-blue-600 rounded-md transition-all duration-300">
                        <img src="{{ asset('images/default-avatar.png') }}" alt="Profil" class="h-8 w-8 rounded-full border border-white/50">
                        <span>{{ Auth::user()->name ?? 'Mahasiswa' }}</span>
                        <svg class="w-4 h-4 transition-transform duration-200"
                             :class="akun ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>
                    <div x-show="akun" x-transition x-cloak
                         class="absolute right-0 mt-2 w-40 bg-white text-gray-700 rounded-md shadow-lg">
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
        <div x-show="open" x-transition x-cloak class="sm:hidden bg-blue-800 border-t border-blue-600">
            <a href="{{ route('mahasiswa.dashboard') }}" class="block px-4 py-2 border-b border-blue-600 hover:bg-blue-600">Beranda</a>
            <a href="{{ route('mahasiswa.jadwal.index') }}" class="block px-4 py-2 border-b border-blue-600 hover:bg-blue-600">Jadwal</a>
            <a href="{{ route('mahasiswa.krs.index') }}" class="block px-4 py-2 border-b border-blue-600 hover:bg-blue-600">Akademik</a>
            <a href="{{ route('mahasiswa.khs.index') }}" class="block px-4 py-2 border-b border-blue-600 hover:bg-blue-600">Hasil Studi</a>
            <a href="#" class="block px-4 py-2 border-b border-blue-600 hover:bg-blue-600">Pembayaran</a>
            <form action="{{ route('logout') }}" method="POST" class="px-4 py-2">
                @csrf
                <button type="submit" class="w-full text-left">Logout</button>
            </form>
        </div>
    </nav>

    <!-- ===== MAIN CONTENT ===== -->
    <main class="max-w-7xl mx-auto px-4 py-8">
        @yield('content')
    </main>

</body>
</html>
