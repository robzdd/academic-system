@extends('layouts.admin_baak')

@section('title', 'Kelola Jadwal')

@section('content')
<div class="bg-white rounded-lg shadow-md p-6">
    <div class="flex justify-between items-center mb-6">
        <div>
            <h2 class="text-2xl font-bold text-gray-800">Daftar Jadwal Kuliah</h2>
            <p class="text-gray-600">{{ $tahunAktif->kode_tahun }} - {{ ucfirst($tahunAktif->semester) }}</p>
        </div>
        <a href="{{ route('admin.jadwal.create') }}"
           class="bg-gradient-to-r from-indigo-600 to-cyan-600 hover:from-indigo-700 hover:to-cyan-700 text-white px-6 py-3 rounded-lg transition font-semibold shadow-lg">
            + Tambah Jadwal
        </a>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full">
            <thead class="bg-gradient-to-r from-indigo-600 to-cyan-600 text-white">
                <tr>
                    <th class="px-4 py-3 text-left text-sm font-semibold">Hari</th>
                    <th class="px-4 py-3 text-left text-sm font-semibold">Jam</th>
                    <th class="px-4 py-3 text-left text-sm font-semibold">Mata Kuliah</th>
                    <th class="px-4 py-3 text-left text-sm font-semibold">Kelas</th>
                    <th class="px-4 py-3 text-left text-sm font-semibold">Dosen</th>
                    <th class="px-4 py-3 text-left text-sm font-semibold">Ruangan</th>
                    <th class="px-4 py-3 text-center text-sm font-semibold">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse($jadwalList as $jadwal)
                <tr class="hover:bg-gray-50">
                    <td class="px-4 py-3 text-sm font-semibold text-gray-800">{{ $jadwal->hari }}</td>
                    <td class="px-4 py-3 text-sm">
                        {{ date('H:i', strtotime($jadwal->jam_mulai)) }} - {{ date('H:i', strtotime($jadwal->jam_selesai)) }}
                    </td>
                    <td class="px-4 py-3 text-sm">
                        <div class="font-semibold">{{ $jadwal->kelas?->mataKuliah?->nama_mk ?? '-' }}</div>
                        <div class="text-xs text-gray-500">{{ $jadwal->kelas?->mataKuliah?->kode_mk ?? '-' }}</div>
                    </td>
                    <td class="px-4 py-3 text-sm">{{ $jadwal->kelas?->nama_kelas ?? '-' }}</td>
                    <td class="px-4 py-3 text-sm">
                        {{ $jadwal->dosen?->user?->username ?? 'Belum ada dosen' }}
                    </td>
                    <td class="px-4 py-3 text-sm">
                        <span class="bg-blue-100 text-blue-800 px-2 py-1 rounded text-xs font-semibold">
                            {{ $jadwal->ruangan ?? '-' }}
                        </span>
                    </td>
                    <td class="px-4 py-3 text-sm">
                        <div class="flex justify-center space-x-2">
                            <a href="{{ route('admin.jadwal.edit', $jadwal->id) }}"
                               class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded text-xs transition">
                                Edit
                            </a>
                            <form method="POST" action="{{ route('admin.jadwal.destroy', $jadwal->id) }}" class="inline">
                                @csrf
                                @method('DELETE')
                                <button class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-xs transition"
                                        onclick="return confirm('Yakin ingin menghapus jadwal ini?')">
                                    Hapus
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="px-4 py-8 text-center text-gray-500">Belum ada jadwal</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
