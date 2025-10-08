<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - SIAKAD Kampus IQRA Buru</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @keyframes float {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
        }
        .float { animation: float 5s ease-in-out infinite; }
    </style>
</head>
<body class="bg-gradient-to-br from-indigo-50 via-blue-50 to-white min-h-screen flex items-center justify-center p-4">

    <div class="relative w-full max-w-5xl bg-white shadow-2xl rounded-3xl overflow-hidden border border-gray-100 flex flex-col lg:flex-row">
        <!-- BAGIAN KIRI: Dekorasi Buku -->
        <div class="hidden lg:flex lg:w-1/2 bg-gradient-to-br from-indigo-600 via-blue-600 to-purple-600 items-center justify-center relative overflow-hidden">
            <div style="background-color: white; border-radius: 20px; padding: 20px; display: inline-block;">
    <img src="{{ asset('images/logo/buku1.webp') }}" alt="Logo Buku" style="width: 200px;">
</div>
            <div class="absolute inset-0 bg-black/10"></div>
            <div class="absolute bottom-10 text-center text-white px-6">
                <h2 class="text-3xl font-extrabold">Selamat Datang di</h2>
                <p class="text-lg text-indigo-100 mt-1 font-medium">SIAKAD Kampus IQRA Buru</p>
                <p class="text-sm text-indigo-200 mt-2">Sistem Informasi Akademik Terintegrasi</p>
            </div>
        </div>

        <!-- BAGIAN KANAN: Form Login -->
        <div class="w-full lg:w-1/2 px-8 py-10">
            <!-- Logo & Judul -->
            <div class="text-center mb-8">
                <div class="mx-auto w-20 h-20 bg-gradient-to-r from-indigo-600 to-blue-600 rounded-full flex items-center justify-center shadow-lg mb-4">
                    <img src="{{ asset('images/logo/Universitas_Iqra_Buru.png') }}" alt="Logo Kampus" class="w-14 h-14">
                </div>
                <h1 class="text-3xl font-extrabold text-gray-800 tracking-tight">SIAKAD</h1>
                <p class="text-gray-600 font-medium">Kampus IQRA Buru</p>
            </div>

            <!-- Pesan Sukses -->
            @if(session('success'))
                <div class="bg-green-50 border-l-4 border-green-500 text-green-700 px-4 py-3 rounded-lg mb-5 text-sm">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Pesan Error -->
            @if($errors->any())
                <div class="bg-red-50 border-l-4 border-red-500 text-red-700 px-4 py-3 rounded-lg mb-5 text-sm">
                    {{ $errors->first() }}
                </div>
            @endif

            <!-- FORM LOGIN -->
            <form method="POST" action="{{ route('login.post') }}" class="space-y-6">
                @csrf
                <!-- Username -->
                <div>
                    <label for="username" class="block text-sm font-semibold text-gray-700 mb-1">Username</label>
                    <div class="relative">
                        <input type="text" id="username" name="username"
                            placeholder="Masukkan username Anda"
                            value="{{ old('username') }}" required
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent text-gray-700">
                        <svg class="w-5 h-5 text-gray-400 absolute right-3 top-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                    </div>
                </div>

                <!-- Password -->
                <div>
                    <label for="password" class="block text-sm font-semibold text-gray-700 mb-1">Password</label>
                    <div class="relative">
                        <input type="password" id="password" name="password"
                            placeholder="Masukkan password Anda" required
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent text-gray-700">
                        <svg class="w-5 h-5 text-gray-400 absolute right-3 top-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                        </svg>
                    </div>
                </div>

                <!-- Remember & Forgot -->
                <div class="flex items-center justify-between text-sm">
                    <label class="flex items-center text-gray-600">
                        <input type="checkbox" name="remember"
                            class="h-4 w-4 text-indigo-600 border-gray-300 rounded mr-2 focus:ring-indigo-500">
                        Ingat saya
                    </label>
                    <a href="#" class="text-indigo-600 hover:text-indigo-800 font-medium">Lupa password?</a>
                </div>

                <!-- Tombol Login -->
                <button type="submit"
                    class="w-full bg-gradient-to-r from-indigo-600 via-blue-600 to-purple-600 text-white py-3 rounded-lg font-semibold hover:from-indigo-700 hover:via-blue-700 hover:to-purple-700 transition transform hover:scale-[1.02] shadow-md flex items-center justify-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M11 16l-4-4m0 0l4-4m-4 4h14"/>
                    </svg>
                    Masuk Aplikasi
                </button>
            </form>

            <!-- Demo Account -->
            <div class="mt-10 border-t border-gray-200 pt-5 text-xs text-gray-600 space-y-2">
                <p class="text-center font-semibold text-gray-700 mb-2">🔐 Akun Demo</p>
                <div class="space-y-2">
                    <div class="bg-blue-50 rounded-lg p-2">
                        👨‍🎓 <b>Mahasiswa:</b> mahasiswa1 | <b>mhs123</b>
                    </div>
                    <div class="bg-green-50 rounded-lg p-2">
                        👨‍🏫 <b>Dosen:</b> dosen1 | <b>dosen123</b>
                    </div>
                    <div class="bg-purple-50 rounded-lg p-2">
                        👨‍💼 <b>Admin:</b> admin | <b>admin123</b>
                    </div>
                </div>
            </div>

            <!-- Footer -->
            <p class="text-center text-gray-400 text-xs mt-6">
                © 2025 <span class="font-semibold text-indigo-600">Kampus IQRA Buru</span>. All rights reserved.
            </p>
        </div>
    </div>

</body>
</html>
