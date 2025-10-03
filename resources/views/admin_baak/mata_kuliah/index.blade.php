@extends('layouts.admin_baak')

@section('title', 'Mata Kuliah')

@section('content')
<div class="bg-white rounded-lg shadow-md p-6">
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-xl font-bold text-gray-800">Daftar Mata Kuliah</h2>
        <a href="{{ route('admin.mata-kuliah.create') }}" class="bg-purple-600 hover:bg-purple-700 text-white px-4 py-2 rounded">Tambah Mata Kuliah</a>
    </div>

    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Kode</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Mata Kuliah</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">SKS</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Semester</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Program Studi</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($mataKuliahList as $mk)
                <tr>
                    <td class="px-4 py-2 text-sm">{{ $mk->kode_mk }}</td>
                    <td class="px-4 py-2 text-sm">{{ $mk->nama_mk }}</td>
                    <td class="px-4 py-2 text-sm">{{ $mk->sks }}</td>
                    <td class="px-4 py-2 text-sm">{{ $mk->semester }}</td>
                    <td class="px-4 py-2 text-sm">{{ $mk->programStudi->nama_prodi ?? '-' }}</td>
                    <td class="px-4 py-2 text-sm">
                        <a href="{{ route('admin.mata-kuliah.edit', $mk->id) }}" class="text-blue-600 hover:text-blue-800 mr-3">Edit</a>
                        <form method="POST" action="{{ route('admin.mata-kuliah.destroy', $mk->id) }}" class="inline" onsubmit="return confirm('Hapus mata kuliah ini?')">
                            @csrf
                            @method('DELETE')
                            <button class="text-red-600 hover:text-red-800">Hapus</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-4 py-6 text-center text-gray-500">Belum ada data</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
