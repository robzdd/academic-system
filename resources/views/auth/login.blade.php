<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - SIAKAD Kampus IQRA Buru</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
        }
        .float-animation {
            animation: float 6s ease-in-out infinite;
        }
    </style>
</head>
<body class="bg-gradient-to-br from-blue-50 via-indigo-50 to-purple-50 min-h-screen flex items-center justify-center p-4">
    <!-- Background Decoration -->
    <div class="absolute inset-0 overflow-hidden pointer-events-none">
        <div class="absolute top-20 left-10 w-72 h-72 bg-blue-200 rounded-full mix-blend-multiply filter blur-xl opacity-70 float-animation"></div>
        <div class="absolute bottom-20 right-10 w-72 h-72 bg-purple-200 rounded-full mix-blend-multiply filter blur-xl opacity-70 float-animation" style="animation-delay: 2s;"></div>
        <div class="absolute top-1/2 left-1/2 w-72 h-72 bg-pink-200 rounded-full mix-blend-multiply filter blur-xl opacity-70 float-animation" style="animation-delay: 4s;"></div>
    </div>

    <div class="w-full max-w-md relative z-10">
        <!-- Logo & Title -->
        <div class="text-center mb-8">
            <div class="inline-block bg-white p-4 rounded-full shadow-lg mb-4">
                <svg class="w-16 h-16 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                </svg>
            </div>
            <h1 class="text-4xl font-bold text-gray-800 mb-2">SIAKAD</h1>
            <p class="text-lg text-gray-600 font-semibold">Kampus IQRA Buru</p>
            <p class="text-sm text-gray-500 mt-2">Sistem Informasi Akademik</p>
        </div>

        <!-- Login Card -->
        <div class="bg-white rounded-2xl shadow-2xl overflow-hidden backdrop-blur-sm bg-opacity-95">
            <div class="bg-gradient-to-r from-blue-600 via-indigo-600 to-purple-600 p-6 text-white text-center">
                <h2 class="text-2xl font-bold">Selamat Datang</h2>
                <p class="text-blue-100 text-sm mt-1">Silakan login dengan akun Anda</p>
            </div>

            <div class="p-8">
                <!-- Success Message -->
                @if(session('success'))
                    <div class="bg-green-50 border-l-4 border-green-500 text-green-700 px-4 py-3 rounded-lg mb-6">
                        <div class="flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                            {{ session('success') }}
                        </div>
                    </div>
                @endif

                <!-- Error Messages -->
                @if($errors->any())
                    <div class="bg-red-50 border-l-4 border-red-500 text-red-700 px-4 py-3 rounded-lg mb-6">
                        <div class="flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                            </svg>
                            {{ $errors->first() }}
                        </div>
                    </div>
                @endif

                <!-- Login Form -->
                <form method="POST" action="{{ route('login.post') }}" class="space-y-6">
                    @csrf

                    <!-- Username Input -->
                    <div>
                        <label class="block text-gray-700 text-sm font-semibold mb-2 flex items-center">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                            Username
                        </label>
                        <input type="text"
                               name="username"
                               value="{{ old('username') }}"
                               placeholder="Masukkan username Anda"
                               required
                               autofocus
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition @error('username') border-red-500 @enderror">
                    </div>

                    <!-- Password Input -->
                    <div>
                        <label class="block text-gray-700 text-sm font-semibold mb-2 flex items-center">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                            </svg>
                            Password
                        </label>
                        <input type="password"
                               name="password"
                               placeholder="Masukkan password Anda"
                               required
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition">
                    </div>

                    <!-- Remember Me -->
                    <div class="flex items-center">
                        <input type="checkbox"
                               name="remember"
                               id="remember"
                               class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                        <label for="remember" class="ml-2 text-sm text-gray-600">
                            Ingat saya
                        </label>
                    </div>

                    <!-- Login Button -->
                    <button type="submit"
                        class="w-full bg-gradient-to-r from-blue-600 via-indigo-600 to-purple-600 text-white py-3 rounded-lg font-semibold hover:from-blue-700 hover:via-indigo-700 hover:to-purple-700 transition transform hover:scale-105 shadow-lg flex items-center justify-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/>
                        </svg>
                        Login
                    </button>
                </form>

                <!-- Demo Accounts Info -->
                <div class="mt-8 pt-6 border-t border-gray-200">
                    <p class="text-center text-sm text-gray-600 mb-3 font-semibold">Akun Demo:</p>
                    <div class="space-y-2 text-xs">
                        <div class="bg-blue-50 p-3 rounded-lg">
                            <p class="font-semibold text-blue-700">👨‍🎓 Mahasiswa</p>
                            <p class="text-gray-600">Username: <span class="font-mono font-bold">mahasiswa1</span> | Password: <span class="font-mono font-bold">mhs123</span></p>
                        </div>
                        <div class="bg-green-50 p-3 rounded-lg">
                            <p class="font-semibold text-green-700">👨‍🏫 Dosen</p>
                            <p class="text-gray-600">Username: <span class="font-mono font-bold">dosen1</span> | Password: <span class="font-mono font-bold">dosen123</span></p>
                        </div>
                        <div class="bg-purple-50 p-3 rounded-lg">
                            <p class="font-semibold text-purple-700">👨‍💼 Admin BAAK</p>
                            <p class="text-gray-600">Username: <span class="font-mono font-bold">admin</span> | Password: <span class="font-mono font-bold">admin123</span></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <p class="text-center text-gray-600 mt-6 text-sm">
            © 2024 Kampus IQRA Buru. All rights reserved.
        </p>
    </div>
</body>
