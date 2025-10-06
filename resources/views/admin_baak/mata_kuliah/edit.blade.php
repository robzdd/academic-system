@extends('layouts.admin_baak')

@section('title', 'Edit Mata Kuliah')

@section('content')
<div class="bg-white rounded-2xl shadow-lg border border-gray-200 p-6">
    <!-- Header -->
    <h2 class="text-2xl font-bold bg-gradient-to-r from-indigo-600 to-cyan-600 bg-clip-text text-transparent mb-6">
        Edit Mata Kuliah
    </h2>

    <form method="POST" action="{{ route('admin.mata-kuliah.update', $mataKuliah->id) }}" class="space-y-5">
        @csrf
        @method('PUT')

        <div>
            <label class="block text-sm font-medium text-gray-700">Kode MK</label>
            <input type="text" name="kode_mk" value="{{ old('kode_mk', $mataKuliah->kode_mk) }}"
                class="mt-1 w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-indigo-600 focus:outline-none" required>
            @error('kode_mk')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">Nama Mata Kuliah</label>
            <input type="text" name="nama_mk" value="{{ old('nama_mk', $mataKuliah->nama_mk) }}"
                class="mt-1 w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-indigo-600 focus:outline-none" required>
            @error('nama_mk')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700">SKS</label>
                <input type="number" name="sks" min="1" max="10" value="{{ old('sks', $mataKuliah->sks) }}"
                    class="mt-1 w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-indigo-600 focus:outline-none" required>
                @error('sks')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Semester</label>
                <input type="number" name="semester" min="1" max="14" value="{{ old('semester', $mataKuliah->semester) }}"
                    class="mt-1 w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-cyan-600 focus:outline-none" required>
                @error('semester')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Program Studi</label>
                <select name="program_studi_id"
                    class="mt-1 w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-indigo-600 focus:outline-none" required>
                    @foreach($prodiList as $prodi)
                        <option value="{{ $prodi->id }}" {{ old('program_studi_id', $mataKuliah->program_studi_id) == $prodi->id ? 'selected' : '' }}>
                            {{ $prodi->nama_prodi }}
                        </option>
                    @endforeach
                </select>
                @error('program_studi_id')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
            </div>
        </div>

        <!-- Tombol -->
        <div class="flex gap-3">
            <a href="{{ route('admin.mata-kuliah.index') }}"
                class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg shadow">Batal</a>
            <button type="submit"
                class="bg-gradient-to-r from-indigo-600 to-cyan-600 hover:from-indigo-700 hover:to-cyan-700 text-white px-4 py-2 rounded-lg shadow">
                Simpan
            </button>
        </div>
    </form>
</div>
@endsection
