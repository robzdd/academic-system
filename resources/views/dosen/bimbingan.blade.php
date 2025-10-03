@extends('layouts.dosen')

@section('title', 'Mahasiswa Bimbingan & ACC KRS')

@section('content')
<div class="bg-white rounded-lg shadow-md p-6 mb-6">
    <h2 class="text-2xl font-bold text-gray-800 mb-4">Mahasiswa Bimbingan (PA) - {{ $tahunAktif->kode_tahun }}</h2>
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">NIM</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Nama</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">KRS Diajukan</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($mahasiswaBimbingan as $bimbingan)
                <tr>
                    <td class="px-4 py-2">{{ $bimbingan->mahasiswa->nim }}</td>
                    <td class="px-4 py-2">{{ $bimbingan->mahasiswa->user->username }}</td>
                    <td class="px-4 py-2">
                        @php
                            $krsList = $krsDiajukan->where('mahasiswa_id', $bimbingan->mahasiswa->id);
                        @endphp
                        @if($krsList->count() > 0)
                        <table class="min-w-full border divide-y divide-gray-200 mb-2">
                            <thead class="bg-gray-100">
                                <tr>
                                    <th class="px-2 py-1 text-xs">Kode MK</th>
                                    <th class="px-2 py-1 text-xs">Mata Kuliah</th>
                                    <th class="px-2 py-1 text-xs">Kelas</th>
                                    <th class="px-2 py-1 text-xs">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($krsList as $krs)
                                <tr>
                                    <td class="px-2 py-1 text-xs">{{ $krs->kelas->mataKuliah->kode_mk }}</td>
                                    <td class="px-2 py-1 text-xs">{{ $krs->kelas->mataKuliah->nama_mk }}</td>
                                    <td class="px-2 py-1 text-xs">{{ $krs->kelas->nama_kelas }}</td>
                                    <td class="px-2 py-1 text-xs">
                                        <form method="POST" action="{{ route('dosen.krs.acc', $krs->id) }}">
                                            @csrf
                                            <button class="bg-green-600 hover:bg-green-700 text-white px-3 py-1 rounded text-xs transition" onclick="return confirm('ACC KRS ini?')">ACC</button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @else
                        <span class="text-gray-400 text-xs">Tidak ada KRS diajukan</span>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="3" class="px-4 py-8 text-center text-gray-500">Belum ada mahasiswa bimbingan</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
