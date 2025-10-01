@extends('layouts.dosen')

@section('title', 'Input Nilai')

@section('content')
<div class="bg-white rounded-lg shadow-md p-6">
    <div class="mb-6">
        <h2 class="text-2xl font-bold text-gray-800">Input Nilai</h2>
        <p class="text-gray-600">{{ $kelas->mataKuliah->nama_mk }} - Kelas {{ $kelas->nama_kelas }}</p>
    </div>

    <form method="POST" action="{{ route('dosen.nilai.update.batch') }}">
        @csrf
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gradient-to-r from-green-600 to-teal-600 text-white">
                    <tr>
                        <th class="px-4 py-3 text-left text-sm font-semibold">No</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold">NIM</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold">Nama Mahasiswa</th>
                        <th class="px-4 py-3 text-center text-sm font-semibold">Nilai Angka</th>
                        <th class="px-4 py-3 text-center text-sm font-semibold">Nilai Huruf</th>
                        <th class="px-4 py-3 text-center text-sm font-semibold">Bobot</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse($mahasiswaList as $index => $krs)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-3 text-sm">{{ $index + 1 }}</td>
                        <td class="px-4 py-3 text-sm font-semibold">{{ $krs->mahasiswa->nim }}</td>
                        <td class="px-4 py-3 text-sm">{{ $krs->mahasiswa->user->nama_lengkap }}</td>
                        <td class="px-4 py-3">
                            <input type="hidden" name="nilai[{{ $index }}][krs_id]" value="{{ $krs->id }}">
                            <input type="number"
                                   name="nilai[{{ $index }}][nilai_angka]"
                                   value="{{ $krs->nilai->nilai_angka ?? '' }}"
                                   min="0" max="100" step="0.01"
                                   class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-green-500"
                                   required>
                        </td>
                        <td class="px-4 py-3 text-center">
                            @if($krs->nilai)
                                <span class="px-3 py-1 rounded-full text-sm font-bold
                                    @if($krs->nilai->nilai_huruf == 'A') bg-green-200 text-green-800
                                    @elseif($krs->nilai->nilai_huruf == 'B') bg-blue-200 text-blue-800
                                    @elseif($krs->nilai->nilai_huruf == 'C') bg-yellow-200 text-yellow-800
                                    @elseif($krs->nilai->nilai_huruf == 'D') bg-orange-200 text-orange-800
                                    @else bg-red-200 text-red-800 @endif">
                                    {{ $krs->nilai->nilai_huruf }}
                                </span>
                            @else
                                <span class="text-gray-400">-</span>
                            @endif
                        </td>
                        <td class="px-4 py-3 text-center font-bold">
                            {{ $krs->nilai ? number_format($krs->nilai->nilai_bobot, 2) : '-' }}
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-4 py-8 text-center text-gray-500">Belum ada mahasiswa</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($mahasiswaList->count() > 0)
        <div class="mt-6 flex justify-end space-x-3">
            <a href="{{ route('dosen.kelas.index') }}"
               class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-2 rounded transition">
                Kembali
            </a>
            <button type="submit"
                    class="bg-green-600 hover:bg-green-700 text-white px-6 py-2 rounded transition">
                Simpan Semua Nilai
            </button>
        </div>
        @endif
    </form>

    <div class="mt-6 p-4 bg-blue-50 rounded-lg">
        <h3 class="font-bold text-gray-800 mb-2">Keterangan Konversi Nilai:</h3>
        <div class="grid grid-cols-2 md:grid-cols-5 gap-2 text-sm">
            <div><span class="font-bold">A (4.00)</span>: 85-100</div>
            <div><span class="font-bold">B (3.00)</span>: 70-84</div>
            <div><span class="font-bold">C (2.00)</span>: 60-69</div>
            <div><span class="font-bold">D (1.00)</span>: 50-59</div>
            <div><span class="font-bold">E (0.00)</span>: 0-49</div>
        </div>
    </div>
</div>
@endsection
