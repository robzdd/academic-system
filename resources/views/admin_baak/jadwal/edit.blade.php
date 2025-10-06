@extends('layouts.admin_baak')

@section('title', 'Edit Jadwal')

@section('content')
<div class="max-w-3xl mx-auto">
    <div class="bg-white dark:bg-gray-900 rounded-2xl shadow-lg p-8 border border-gray-200 dark:border-gray-700">
        <h2 class="text-2xl font-bold text-gray-800 dark:text-white mb-8 border-b pb-3">Edit Jadwal Kuliah</h2>

        <form method="POST" action="{{ route('admin.jadwal.update', $jadwal->id) }}" class="space-y-6">
            @csrf
            @method('PUT')

            <!-- Kelas -->
            <div>
                <label class="block text-gray-700 dark:text-gray-200 text-sm font-semibold mb-2">Kelas</label>
                <select name="kelas_id" required
                        class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 dark:bg-gray-800 dark:text-white">
                    @foreach($kelasList as $kelas)
                        <option value="{{ $kelas->id }}" {{ $jadwal->kelas_id == $kelas->id ? 'selected' : '' }}>
                            {{ $kelas->mataKuliah->nama_mk }} - Kelas {{ $kelas->nama_kelas }} ({{ $kelas->dosen->user->nama_lengkap }})
                        </option>
                    @endforeach
                </select>
                @error('kelas_id')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Hari -->
            <div>
                <label class="block text-gray-700 dark:text-gray-200 text-sm font-semibold mb-2">Hari</label>
                <select name="hari" required
                        class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 dark:bg-gray-800 dark:text-white">
                    @foreach($hariList as $hari)
                        <option value="{{ $hari }}" {{ $jadwal->hari == $hari ? 'selected' : '' }}>{{ $hari }}</option>
                    @endforeach
                </select>
                @error('hari')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Jam -->
            <div class="grid grid-cols-2 gap-6">
                <div>
                    <label class="block text-gray-700 dark:text-gray-200 text-sm font-semibold mb-2">Jam Mulai</label>
                    <input type="time" name="jam_mulai" value="{{ date('H:i', strtotime($jadwal->jam_mulai)) }}" required
                           class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 dark:bg-gray-800 dark:text-white">
                    @error('jam_mulai')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-gray-700 dark:text-gray-200 text-sm font-semibold mb-2">Jam Selesai</label>
                    <input type="time" name="jam_selesai" value="{{ date('H:i', strtotime($jadwal->jam_selesai)) }}" required
                           class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 dark:bg-gray-800 dark:text-white">
                    @error('jam_selesai')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Ruangan -->
            <div>
                <label class="block text-gray-700 dark:text-gray-200 text-sm font-semibold mb-2">Ruangan</label>
                <input type="text" name="ruangan" value="{{ $jadwal->ruangan }}" required
                       class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 dark:bg-gray-800 dark:text-white">
                @error('ruangan')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Tombol -->
            <div class="flex space-x-3">
                <a href="{{ route('admin.jadwal.index') }}"
                   class="flex-1 bg-gray-500 hover:bg-gray-600 text-white text-center py-3 rounded-lg transition font-semibold">
                    Batal
                </a>
                <button type="submit"
                        class="flex-1 bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 text-white py-3 rounded-lg transition font-semibold">
                    Update Jadwal
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
