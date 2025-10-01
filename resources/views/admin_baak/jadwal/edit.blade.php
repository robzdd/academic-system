@extends('layouts.admin_baak')

@section('title', 'Edit Jadwal')

@section('content')
<div class="max-w-3xl mx-auto">
    <div class="bg-white rounded-lg shadow-md p-6">
        <h2 class="text-2xl font-bold text-gray-800 mb-6">Edit Jadwal Kuliah</h2>

        <form method="POST" action="{{ route('admin.jadwal.update', $jadwal->id) }}" class="space-y-6">
            @csrf
            @method('PUT')

            <div>
                <label class="block text-gray-700 text-sm font-semibold mb-2">Kelas</label>
                <select name="kelas_id" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500">
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

            <div>
                <label class="block text-gray-700 text-sm font-semibold mb-2">Hari</label>
                <select name="hari" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500">
                    @foreach($hariList as $hari)
                        <option value="{{ $hari }}" {{ $jadwal->hari == $hari ? 'selected' : '' }}>{{ $hari }}</option>
                    @endforeach
                </select>
                @error('hari')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-gray-700 text-sm font-semibold mb-2">Jam Mulai</label>
                    <input type="time" name="jam_mulai" value="{{ date('H:i', strtotime($jadwal->jam_mulai)) }}" required
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500">
                    @error('jam_mulai')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-gray-700 text-sm font-semibold mb-2">Jam Selesai</label>
                    <input type="time" name="jam_selesai" value="{{ date('H:i', strtotime($jadwal->jam_selesai)) }}" required
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500">
                    @error('jam_selesai')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div>
                <label class="block text-gray-700 text-sm font-semibold mb-2">Ruangan</label>
                <input type="text" name="ruangan" value="{{ $jadwal->ruangan }}" required
                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500">
                @error('ruangan')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex space-x-3">
                <a href="{{ route('admin.jadwal.index') }}"
                   class="flex-1 bg-gray-500 hover:bg-gray-600 text-white text-center py-3 rounded-lg transition font-semibold">
                    Batal
                </a>
                <button type="submit"
                        class="flex-1 bg-gradient-to-r from-purple-600 to-pink-600 hover:from-purple-700 hover:to-pink-700 text-white py-3 rounded-lg transition font-semibold">
                    Update Jadwal
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
