@extends('layouts.admin_baak')

@section('title', 'Tambah Mata Kuliah')

@section('content')
<div class="bg-white rounded-lg shadow-md p-6">
    <h2 class="text-xl font-bold text-gray-800 mb-4">Tambah Mata Kuliah</h2>

    <form method="POST" action="{{ route('admin.mata-kuliah.store') }}" class="space-y-4">
        @csrf
        <div>
            <label class="block text-sm font-medium text-gray-700">Kode MK</label>
            <input type="text" name="kode_mk" value="{{ old('kode_mk') }}" class="mt-1 w-full border rounded px-3 py-2" required>
            @error('kode_mk')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700">Nama Mata Kuliah</label>
            <input type="text" name="nama_mk" value="{{ old('nama_mk') }}" class="mt-1 w-full border rounded px-3 py-2" required>
            @error('nama_mk')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700">SKS</label>
                <input type="number" name="sks" min="1" max="10" value="{{ old('sks', 3) }}" class="mt-1 w-full border rounded px-3 py-2" required>
                @error('sks')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Semester</label>
                <input type="number" name="semester" min="1" max="14" value="{{ old('semester', 1) }}" class="mt-1 w-full border rounded px-3 py-2" required>
                @error('semester')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Program Studi</label>
                <select name="program_studi_id" class="mt-1 w-full border rounded px-3 py-2" required>
                    <option value="">- Pilih Prodi -</option>
                    @foreach($prodiList as $prodi)
                        <option value="{{ $prodi->id }}" {{ old('program_studi_id') == $prodi->id ? 'selected' : '' }}>{{ $prodi->nama_prodi }}</option>
                    @endforeach
                </select>
                @error('program_studi_id')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
            </div>
        </div>
        <div class="flex gap-2">
            <a href="{{ route('admin.mata-kuliah.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded">Batal</a>
            <button class="bg-purple-600 hover:bg-purple-700 text-white px-4 py-2 rounded" type="submit">Simpan</button>
        </div>
    </form>
</div>
@endsection
