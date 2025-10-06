@extends('layouts.dosen')

@section('title', 'Detail Kelas')

@section('content')
<div class="bg-white rounded-2xl shadow-sm p-6 border border-gray-100">
    <!-- Header Kelas -->
    <div class="border-b pb-5 mb-6">
        <h2 class="text-2xl font-bold text-gray-800 mb-1">{{ $kelas->mataKuliah->nama_mk }}</h2>
        <div class="flex flex-wrap gap-4 text-sm text-gray-600">
            <p><span class="font-medium">{{ $kelas->mataKuliah->kode_mk }}</span> — Kelas {{ $kelas->nama_kelas }}</p>
            <p>{{ $kelas->mataKuliah->sks }} SKS</p>
            <p>Kapasitas: <span class="font-medium">{{ $kelas->jumlah_mahasiswa }}</span> / {{ $kelas->kapasitas }}</p>
        </div>
    </div>

    <!-- Jadwal Perkuliahan -->
    <div class="mb-8">
        <h3 class="text-lg font-semibold text-gray-800 mb-4">Jadwal Perkuliahan</h3>
        @if($kelas->jadwalKuliah->count())
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
            @foreach($kelas->jadwalKuliah as $jadwal)
            <div class="bg-indigo-50 p-4 rounded-xl border border-indigo-100">
                <p class="font-semibold text-indigo-800">{{ $jadwal->hari }}</p>
                <p class="text-indigo-600 text-sm">
                    {{ date('H:i', strtotime($jadwal->jam_mulai)) }} - {{ date('H:i', strtotime($jadwal->jam_selesai)) }}
                </p>
                <p class="text-xs text-indigo-500 mt-1">Ruangan: {{ $jadwal->ruangan }}</p>
            </div>
            @endforeach
        </div>
        @else
        <p class="text-gray-500 text-sm italic">Belum ada jadwal yang ditentukan</p>
        @endif
    </div>

    <!-- Daftar Mahasiswa -->
    <div>
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-lg font-semibold text-gray-800">Daftar Mahasiswa</h3>
            <p class="text-sm text-gray-500">
                Total: <span class="font-medium text-gray-700">{{ $mahasiswaList->count() }}</span> mahasiswa
            </p>
        </div>

        <div class="overflow-x-auto rounded-lg border border-gray-200">
            <table class="min-w-full text-sm">
                <thead class="bg-gray-100 text-gray-700 uppercase text-xs font-semibold">
                    <tr>
                        <th class="px-4 py-3 text-left">No</th>
                        <th class="px-4 py-3 text-left">NIM</th>
                        <th class="px-4 py-3 text-left">Nama</th>
                        <th class="px-4 py-3 text-left">Program Studi</th>
                        <th class="px-4 py-3 text-center">Status Nilai</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse($mahasiswaList as $index => $krs)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-4 py-3">{{ $index + 1 }}</td>
                        <td class="px-4 py-3 font-medium text-gray-700">{{ $krs->mahasiswa->nim }}</td>
                        <td class="px-4 py-3">{{ $krs->mahasiswa->user->username }}</td>
                        <td class="px-4 py-3">{{ $krs->mahasiswa->programStudi->nama_prodi }}</td>
                        <td class="px-4 py-3 text-center">
                            @if($krs->nilai)
                                <span class="px-3 py-1 text-xs font-semibold rounded-full
                                    {{ $krs->nilai->nilai_huruf == 'E' ? 'bg-red-100 text-red-700' : 'bg-green-100 text-green-700' }}">
                                    {{ $krs->nilai->nilai_huruf }}
                                </span>
                            @else
                                <span class="px-3 py-1 text-xs font-semibold bg-yellow-100 text-yellow-700 rounded-full">
                                    Belum dinilai
                                </span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-4 py-6 text-center text-gray-500 italic">
                            Belum ada mahasiswa yang terdaftar
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
