@extends('layouts.dosen')

@section('title', 'Mahasiswa Bimbingan & ACC KRS')

@section('content')
<div class="bg-white rounded-2xl shadow-sm p-6 border border-gray-100 mb-8">
    <h2 class="text-2xl font-bold text-gray-800 mb-4">
        Mahasiswa Bimbingan (PA) - {{ $tahunAktif->kode_tahun }}
    </h2>

    <div class="overflow-x-auto rounded-lg border border-gray-200">
        <table class="min-w-full divide-y divide-gray-200 text-sm">
            <thead class="bg-gray-100 text-gray-700 uppercase text-xs font-semibold">
                <tr>
                    <th class="px-4 py-3 text-left">NIM</th>
                    <th class="px-4 py-3 text-left">Nama</th>
                    <th class="px-4 py-3 text-left">KRS Diajukan</th>
                </tr>
            </thead>

            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($mahasiswaBimbingan as $bimbingan)
                <tr class="hover:bg-gray-50 transition">
                    <td class="px-4 py-3 font-medium text-gray-700">{{ $bimbingan->mahasiswa->nim }}</td>
                    <td class="px-4 py-3">{{ $bimbingan->mahasiswa->user->username }}</td>
                    <td class="px-4 py-3">
                        @php
                            $krsList = $krsDiajukan->where('mahasiswa_id', $bimbingan->mahasiswa->id);
                        @endphp

                        @if($krsList->count() > 0)
                        <div class="border border-gray-200 rounded-lg overflow-hidden shadow-sm">
                            <table class="min-w-full text-xs">
                                <thead class="bg-indigo-50 text-indigo-700">
                                    <tr>
                                        <th class="px-2 py-2 text-left font-semibold">Kode MK</th>
                                        <th class="px-2 py-2 text-left font-semibold">Mata Kuliah</th>
                                        <th class="px-2 py-2 text-left font-semibold">Kelas</th>
                                        <th class="px-2 py-2 text-center font-semibold">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-100">
                                    @foreach($krsList as $krs)
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-2 py-2">{{ $krs->kelas->mataKuliah->kode_mk }}</td>
                                        <td class="px-2 py-2">{{ $krs->kelas->mataKuliah->nama_mk }}</td>
                                        <td class="px-2 py-2">{{ $krs->kelas->nama_kelas }}</td>
                                        <td class="px-2 py-2 text-center">
                                            <form method="POST" action="{{ route('dosen.krs.acc', $krs->id) }}">
                                                @csrf
                                                <button
                                                    class="bg-green-600 hover:bg-green-700 text-white px-3 py-1 rounded-lg text-xs font-semibold transition"
                                                    onclick="return confirm('ACC KRS ini?')">
                                                    ACC
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        @else
                        <span class="text-gray-400 italic text-xs">Tidak ada KRS diajukan</span>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="3" class="px-4 py-8 text-center text-gray-500 italic">
                        Belum ada mahasiswa bimbingan
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
