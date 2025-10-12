@extends('layouts.admin_baak')

@section('title', 'Tambah Tagihan UKT')

@section('content')
<div class="max-w-4xl mx-auto py-10">
    <div class="bg-white rounded-2xl shadow-lg p-8 border border-gray-200">
        <h2 class="text-2xl font-bold text-gray-800 mb-8">🧾 Tambah Tagihan UKT</h2>

        <form method="POST" action="{{ route('admin.tagihan.store') }}" class="space-y-6">
            @csrf

            {{-- Mahasiswa --}}
            <div>
                <label class="block text-gray-700 font-medium mb-2">Mahasiswa</label>
                <select name="mahasiswa_id" 
                        class="w-full border border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-100 rounded-lg px-4 py-2 bg-white text-gray-800">
                    <option value="">-- Pilih Mahasiswa --</option>
                    @foreach ($mahasiswa as $m)
                        <option value="{{ $m->id }}">{{ $m->nama }} ({{ $m->nim }})</option>
                    @endforeach
                </select>
                @error('mahasiswa_id')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Semester --}}
            <div>
                <label class="block text-gray-700 font-medium mb-2">Semester</label>
                <input type="text" name="semester" 
                       placeholder="Contoh: Ganjil 2025" 
                       class="w-full border border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-100 rounded-lg px-4 py-2 bg-white text-gray-800">
                @error('semester')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Jumlah Tagihan --}}
            <div>
                <label class="block text-gray-700 font-medium mb-2">Jumlah Tagihan (Rp)</label>
                <input type="number" name="jumlah_tagihan" 
                       placeholder="Contoh: 3500000" 
                       class="w-full border border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-100 rounded-lg px-4 py-2 bg-white text-gray-800">
                @error('jumlah_tagihan')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex justify-end pt-4">
                <a href="{{ route('admin.tagihan.index') }}" 
                   class="px-5 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-100 transition mr-3">
                    Batal
                </a>
                <button type="submit" 
                        class="px-5 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg shadow-sm transition">
                    Simpan Tagihan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
