@extends('layouts.mahasiswa')

@section('title', 'Jadwal Kuliah')

@section('content')
<div class="bg-white rounded-lg shadow-md p-6">
    <h2 class="text-2xl font-bold text-gray-800 mb-6">Jadwal Kuliah Mingguan</h2>

    <div class="overflow-x-auto">
        <table class="w-full">
            <thead class="bg-gradient-to-r from-blue-600 to-indigo-600 text-white">
                <tr>
                    <th class="px-4 py-3 text-left text-sm font-semibold">Hari</th>
                    <th class="px-4 py-3 text-left text-sm font-semibold">Jam</th>
                    <th class="px-4 py-3 text-left text-sm font-semibold">Mata Kuliah</th>
                    <th class="px-4 py-3 text-left text-sm font-semibold">Kode MK</th>
                    <th class="px-4 py-3 text-left text-sm font-semibold">SKS</th>
                    <th class="px-4 py-3 text-left text-sm font-semibold">Dosen</th>
                    <th class="px-4 py-3 text-left text-sm font-semibold">Ruangan</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse($jadwalList as $jadwal)
                <tr class="hover:bg-gray-50">
                    <td class="px-4 py-3 text-sm font-semibold text-gray-800">{{ $jadwal->hari }}</td>
                    <td class="px-4 py-3 text-sm">{{ date('H:i', strtotime($jadwal->jam_mulai)) }} - {{ date('H:i', strtotime($jadwal->jam_selesai)) }}</td>
                    <td class="px-4 py-3 text-sm">{{ $jadwal->kelas->mataKuliah->nama_mk }}</td>
                    <td class="px-4 py-3 text-sm">{{ $jadwal->kelas->mataKuliah->kode_mk }}</td>
                    <td class="px-4 py-3 text-sm">{{ $jadwal->kelas->mataKuliah->sks }}</td>
                    <td class="px-4 py-3 text-sm">{{ $jadwal->kelas->dosen->user->username }}</td>
                    <td class="px-4 py-3 text-sm">
                        <span class="bg-blue-100 text-blue-800 px-2 py-1 rounded text-xs font-semibold">
                            {{ $jadwal->ruangan }}
                        </span>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="px-4 py-8 text-center text-gray-500">Belum ada jadwal kuliah</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
