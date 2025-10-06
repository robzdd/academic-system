@extends('layouts.mahasiswa')

@section('title', 'Riwayat Kartu Rencana Studi')

@section('content')
<div class="bg-white rounded-lg shadow-md p-6 mb-6">
    <h2 class="text-2xl font-bold text-gray-800 mb-6">Riwayat Kartu Rencana Studi</h2>

    @forelse($riwayatKrs as $semester => $krsList)
    <div class="mb-10">
        <h3 class="text-lg font-semibold mb-4 text-gray-700">
            Semester {{ $semester }}
        </h3>

        <div class="overflow-x-auto">
            <table class="w-full border border-gray-200">
                <thead class="bg-blue-900 text-white">
                    <tr>
                        <th class="px-4 py-3 text-left text-sm font-medium">No</th>
                        <th class="px-4 py-3 text-left text-sm font-medium">Kode</th>
                        <th class="px-4 py-3 text-left text-sm font-medium">Mata Kuliah</th>
                        <th class="px-4 py-3 text-left text-sm font-medium">Nama Kelas</th>
                        <th class="px-4 py-3 text-left text-sm font-medium">SKS</th>
                        <th class="px-4 py-3 text-left text-sm font-medium">Jadwal</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($krsList as $index => $krs)
                    <tr>
                        <td class="px-4 py-3 text-sm">{{ $index + 1 }}</td>
                        <td class="px-4 py-3 text-sm">{{ optional($krs->kelas->mataKuliah)->kode_mk }}</td>
                        <td class="px-4 py-3 text-sm">{{ optional($krs->kelas->mataKuliah)->nama_mk }}</td>
                        <td class="px-4 py-3 text-sm">{{ optional($krs->kelas)->nama_kelas }}</td>
                        <td class="px-4 py-3 text-sm">{{ optional($krs->kelas->mataKuliah)->sks }}</td>
                        <td class="px-4 py-3 text-sm">
                            @forelse($krs->kelas->jadwalKuliah as $jadwal)
                                {{ $jadwal->hari }}, {{ $jadwal->jam_mulai }} - {{ $jadwal->jam_selesai }} @ {{ $jadwal->ruangan }}<br>
                            @empty
                                <span class="text-gray-500">Belum ada jadwal</span>
                            @endforelse
                        </td>
                    </tr>
                    @endforeach
                </tbody>
                    <tfoot class="bg-gray-50">
                        <tr>
                            <td colspan="2" class="px-4 py-3 font-semibold text-left">
                                Total SKS : {{ $krsList->sum(fn($k) => optional($k->kelas->mataKuliah)->sks) }}
                            </td>
                            <td colspan="2" class="px-4 py-3 font-semibold text-left">
                                Batas SKS : {{ $batasSks ?? 24 }}
                            </td>
                            <td colspan="2"></td>
                        </tr>
                    </tfoot>
            </table>
        </div>
    </div>
    @empty
        <p class="text-gray-600">Belum ada riwayat KRS.</p>
    @endforelse
</div>
@endsection
