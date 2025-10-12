<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - SIAKAD Admin BAAK</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="//unpkg.com/alpinejs" defer></script>
    <link rel="icon" type="image/x-icon" href="{{ asset('images/logo/Universitas_Iqra_Buru.png') }}">
</head>
<body class="bg-gray-50 font-sans">

    <!-- Navbar -->
<!-- Navbar -->
<nav x-data="{ open:false, dropdown:false }" 
     class="bg-gradient-to-r from-indigo-600 via-blue-600 to-cyan-600 text-white shadow-md">
    <div class="max-w-7xl mx-auto px-4">
        <div class="flex justify-between items-center h-16">
            
            <!-- Kiri: Logo & Menu -->
            <div class="flex items-center space-x-6">
                <!-- Logo -->
                <div class="flex items-center space-x-2">
                    <img src="{{ asset('images/logo/Universitas_Iqra_Buru.png') }}" 
                         alt="Logo" class="h-10 w-10 rounded-full bg-white p-1">
                    <h1 class="text-lg font-semibold tracking-wide">SIAKAD IQRA Buru - Admin BAAK</h1>
                </div>

                <!-- Menu Desktop -->
                <div class="hidden md:flex space-x-2 ml-6">
                    <a href="{{ route('admin.dashboard') }}"
                       class="px-3 py-2 rounded-md transition font-medium {{ request()->routeIs('admin.dashboard') ? 'bg-white text-indigo-700' : 'hover:bg-blue-700/40' }}">
                        Dashboard
                    </a>
                    <a href="{{ route('admin.jadwal.index') }}"
                       class="px-3 py-2 rounded-md transition font-medium {{ request()->routeIs('admin.jadwal.index') ? 'bg-white text-indigo-700' : 'hover:bg-blue-700/40' }}">
                        Kelola Jadwal
                    </a>
                    <a href="{{ route('admin.mata-kuliah.index') }}"
                       class="px-3 py-2 rounded-md transition font-medium {{ request()->routeIs('admin.mata-kuliah.index') ? 'bg-white text-indigo-700' : 'hover:bg-blue-700/40' }}">
                        Mata Kuliah
                    </a>
                    <a href="{{ route('admin.tagihan.index') }}"
                       class="px-3 py-2 rounded-md transition font-medium {{ request()->routeIs('admin.tagihan.index') ? 'bg-white text-indigo-700' : 'hover:bg-blue-700/40' }}">
                       Tagihan UKT
                    </a>
                </div>
            </div>
            <!-- Kanan: Profil -->
            <div class="relative" x-data="{ dropdown:false }">
                <button @click="dropdown = !dropdown" 
                        class="flex items-center space-x-2 hover:bg-blue-700/40 px-3 py-2 rounded-md transition">
                    <span class="text-sm font-medium">{{ auth()->user()->nama_lengkap ?? 'Admin' }}</span>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M19 9l-7 7-7-7"/>
                    </svg>
                </button>

                <!-- Dropdown -->
                <div x-show="dropdown" @click.away="dropdown=false"
                     class="absolute right-0 mt-2 w-40 bg-white text-gray-700 rounded-md shadow-lg overflow-hidden z-50">
                    <a href="#" class="block px-4 py-2 hover:bg-gray-100">Profil</a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="w-full text-left px-4 py-2 hover:bg-gray-100">Logout</button>
                    </form>
                </div>
            </div>

            <!-- Tombol Hamburger (Mobile) -->
            <div class="md:hidden flex items-center">
                <button @click="open=!open" class="focus:outline-none">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path x-show="!open" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M4 6h16M4 12h16M4 18h16"/>
                        <path x-show="open" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
        </div>

        <!-- Menu Mobile -->
        <div x-show="open" class="md:hidden bg-blue-700/90 rounded-md mt-2">
            <a href="{{ route('admin.dashboard') }}" class="block px-4 py-2 hover:bg-blue-800/50">Dashboard</a>
            <a href="{{ route('admin.jadwal.index') }}" class="block px-4 py-2 hover:bg-blue-800/50">Kelola Jadwal</a>
            <a href="{{ route('admin.mata-kuliah.index') }}" class="block px-4 py-2 hover:bg-blue-800/50">Mata Kuliah</a>
            <a href="{{ route('admin.tagihan.index') }}" class="block px-4 py-2 hover:bg-blue-800/50">Tagihan UKT</a>
            <form method="POST" action="{{ route('logout') }}" class="border-t border-blue-600">
                @csrf
                <button type="submit" class="w-full text-left px-4 py-2 hover:bg-blue-800/50">Logout</button>
            </form>
        </div>
    </div>
</nav>

    <!-- Konten -->
    <main class="max-w-7xl mx-auto px-4 py-8">
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

</body>
</html>
