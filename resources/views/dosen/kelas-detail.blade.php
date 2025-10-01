@extends('layouts.dosen')

@section('title', 'Detail Kelas')

@section('content')
<div class="bg-white rounded-lg shadow-md p-6">
    <!-- Class Header Information -->
    <div class="border-b pb-6 mb-6">
        <h2 class="text-2xl font-bold text-gray-800 mb-2">{{ $kelas->mataKuliah->nama_mk }}</h2>
        <div class="flex flex-wrap gap-4 text-sm text-gray-600">
            <p>{{ $kelas->mataKuliah->kode_mk }} - Kelas {{ $kelas->nama_kelas }}</p>
            <p>{{ $kelas->mataKuliah->sks }} SKS</p>
            <p>Kapasitas: {{ $kelas->jumlah_mahasiswa }}/{{ $kelas->kapasitas }}</p>
        </div>
    </div>

    <!-- Schedule Information -->
    <div class="mb-6">
        <h3 class="text-lg font-semibold text-gray-800 mb-4">Jadwal Perkuliahan</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            @forelse($kelas->jadwalKuliah as $jadwal)
                <div class="bg-blue-50 p-4 rounded-lg">
                    <p class="font-semibold text-blue-800">{{ $jadwal->hari }}</p>
                    <p class="text-blue-600">{{ date('H:i', strtotime($jadwal->jam_mulai)) }} - {{ date('H:i', strtotime($jadwal->jam_selesai)) }}</p>
                    <p class="text-sm text-blue-500">{{ $jadwal->ruangan }}</p>
                </div>
            @empty
                <p class="text-gray-500">Belum ada jadwal yang ditentukan</p>
            @endforelse
        </div>
    </div>

    <!-- Students List -->
    <div>
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-lg font-semibold text-gray-800">Daftar Mahasiswa</h3>
            <p class="text-sm text-gray-600">Total: {{ $mahasiswaList->count() }} mahasiswa</p>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">NIM</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Program Studi</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status Nilai</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($mahasiswaList as $index => $krs)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                {{ $index + 1 }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                {{ $krs->mahasiswa->nim }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                {{ $krs->mahasiswa->user->username }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                {{ $krs->mahasiswa->programStudi->nama_prodi }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm">
                                @if($krs->nilai)
                                    <span class="px-2 py-1 text-xs font-semibold rounded-full
                                        {{ $krs->nilai->nilai_huruf == 'E' ? 'bg-red-100 text-red-800' : 'bg-green-100 text-green-800' }}">
                                        {{ $krs->nilai->nilai_huruf }}
                                    </span>
                                @else
                                    <span class="px-2 py-1 text-xs font-semibold bg-yellow-100 text-yellow-800 rounded-full">
                                        Belum dinilai
                                    </span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-4 whitespace-nowrap text-sm text-center text-gray-500">
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
