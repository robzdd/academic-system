<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - SIAKAD Mahasiswa</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50">

    <!-- Navbar -->
    <nav class="bg-gradient-to-r from-blue-700 to-indigo-700 text-white shadow-md">
        <div class="container mx-auto px-4">
            <div class="flex items-center justify-between h-16">

                <!-- Logo + Nama Kampus -->
                <div class="flex items-center space-x-3">
                    <img src="{{ asset('images/logo/Universitas_Iqra_Buru.png') }}" 
                         alt="Logo Kampus" 
                         class="h-10 w-10 rounded-full bg-white p-1 shadow">
                    <h1 class="text-lg md:text-xl font-bold tracking-wide">SIAKAD IQRA Buru</h1>
                </div>

                <!-- Menu Navigasi (Desktop) -->
                <div class="hidden md:flex space-x-6 font-medium">
                    <a href="{{ route('mahasiswa.dashboard') }}" 
                       class="px-3 py-2 rounded hover:bg-blue-800 transition">Dashboard</a>
                    <a href="{{ route('mahasiswa.krs.index') }}" 
                       class="px-3 py-2 rounded hover:bg-blue-800 transition">KRS</a>
                    <a href="{{ route('mahasiswa.jadwal.index') }}" 
                       class="px-3 py-2 rounded hover:bg-blue-800 transition">Jadwal</a>
                    <a href="{{ route('mahasiswa.nilai.index') }}" 
                       class="px-3 py-2 rounded hover:bg-blue-800 transition">Nilai</a>
                    <a href="{{ route('mahasiswa.khs.index') }}" 
                       class="px-3 py-2 rounded hover:bg-blue-800 transition">KHS</a>
                </div>

                <!-- User Dropdown -->
                <div class="relative group">
                    <button class="flex items-center space-x-2 focus:outline-none">
                        <span class="text-sm font-semibold hidden sm:block">
                            {{ auth()->user()->nama_lengkap }}
                        </span>
                        <svg class="w-5 h-5 text-gray-200 group-hover:text-white transition" 
                             fill="none" stroke="currentColor" 
                             viewBox="0 0 24 24">
                             <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                   d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <!-- Dropdown Menu -->
                    <div class="absolute right-0 mt-2 w-40 bg-white text-gray-700 rounded-lg shadow-lg opacity-0 group-hover:opacity-100 group-hover:translate-y-1 transform transition">
                        <div class="p-2">
                            <a href="#" class="block px-3 py-2 rounded hover:bg-gray-100">Profil</a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button class="w-full text-left px-3 py-2 rounded hover:bg-red-100 text-red-600 font-medium">
                                    Logout
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Mobile Menu Button -->
                <div class="md:hidden flex items-center">
                    <button id="menu-btn" class="focus:outline-none">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" 
                             viewBox="0 0 24 24">
                             <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                   d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                </div>

            </div>
        </div>

        <!-- Mobile Menu -->
        <div id="mobile-menu" class="hidden md:hidden bg-blue-700 text-white">
            <a href="{{ route('mahasiswa.dashboard') }}" class="block px-4 py-2 hover:bg-blue-800">Dashboard</a>
            <a href="{{ route('mahasiswa.krs.index') }}" class="block px-4 py-2 hover:bg-blue-800">KRS</a>
            <a href="{{ route('mahasiswa.jadwal.index') }}" class="block px-4 py-2 hover:bg-blue-800">Jadwal</a>
            <a href="{{ route('mahasiswa.nilai.index') }}" class="block px-4 py-2 hover:bg-blue-800">Nilai</a>
            <a href="{{ route('mahasiswa.khs.index') }}" class="block px-4 py-2 hover:bg-blue-800">KHS</a>
            <form method="POST" action="{{ route('logout') }}" class="px-4 py-2">
                @csrf
                <button class="w-full text-left hover:bg-red-600 px-3 py-2 rounded-lg bg-red-500 mt-2">
                    Logout
                </button>
            </form>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="container mx-auto px-4 py-8">
        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                {{ session('error') }}
            </div>
        @endif

        @yield('content')
    </main>

    <script>
        // Mobile menu toggle
        document.getElementById('menu-btn').addEventListener('click', function () {
            document.getElementById('mobile-menu').classList.toggle('hidden');
        });
    </script>

</body>
</html>
