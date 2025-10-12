@extends('layouts.admin_baak')

@section('title', 'Mata Kuliah')

@section('content')
<div class="bg-white rounded-2xl shadow-lg border border-gray-200 p-6">
    <!-- Header -->
    <div class="flex justify-between items-center mb-6">
        <div>
            <h2 class="text-2xl font-bold text-gray-800">Daftar Mata Kuliah</h2>
            <p class="text-gray-500 text-sm">Manajemen data mata kuliah per program studi</p>
        </div>
        <a href="{{ route('admin.mata-kuliah.create') }}"
           class="bg-gradient-to-r from-indigo-600 to-cyan-600 hover:from-indigo-700 hover:to-cyan-700 text-white px-5 py-2.5 rounded-lg shadow-md transition font-semibold">
            + Tambah Mata Kuliah
        </a>
    </div>

    <!-- Table -->
    <div class="overflow-x-auto rounded-xl border border-gray-200">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gradient-to-r from-indigo-600 to-cyan-600 text-white">
                <tr>
                    <th class="px-4 py-3 text-left text-sm font-semibold">Kode</th>
                    <th class="px-4 py-3 text-left text-sm font-semibold">Mata Kuliah</th>
                    <th class="px-4 py-3 text-center text-sm font-semibold">SKS</th>
                    <th class="px-4 py-3 text-center text-sm font-semibold">Semester</th>
                    <th class="px-4 py-3 text-left text-sm font-semibold">Program Studi</th>
                    <th class="px-4 py-3 text-center text-sm font-semibold">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($mataKuliahList as $mk)
                <tr class="hover:bg-gray-50 transition">
                    <td class="px-4 py-3 text-sm font-semibold text-gray-800">{{ $mk->kode_mk }}</td>
                    <td class="px-4 py-3 text-sm text-gray-700">{{ $mk->nama_mk }}</td>
                    <td class="px-4 py-3 text-sm text-center">
                        <span class="bg-indigo-100 text-indigo-800 px-2 py-1 rounded text-xs font-semibold">
                            {{ $mk->sks }}
                        </span>
                    </td>
                    <td class="px-4 py-3 text-sm text-center">
                        <span class="bg-cyan-100 text-cyan-800 px-2 py-1 rounded text-xs font-semibold">
                            {{ $mk->semester }}
                        </span>
                    </td>
                    <td class="px-4 py-3 text-sm text-gray-700">{{ $mk->programStudi->nama_prodi ?? '-' }}</td>
                    <td class="px-4 py-3 text-sm">
                        <div class="flex justify-center space-x-2">
                            <a href="{{ route('admin.mata-kuliah.edit', $mk->id) }}"
                               class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded text-xs font-semibold transition">
                                Edit
                            </a>
                            <form method="POST" action="{{ route('admin.mata-kuliah.destroy', $mk->id) }}" class="inline"
                                  onsubmit="return confirm('Hapus mata kuliah ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-xs font-semibold transition">
                                    Hapus
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-4 py-8 text-center text-gray-500 text-sm italic">
                        Belum ada data
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
