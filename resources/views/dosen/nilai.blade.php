@extends('layouts.dosen')

@section('title', 'Input Nilai')

@section('content')
<div class="bg-white rounded-2xl shadow-sm p-6 border border-gray-100">
    <!-- Header -->
    <div class="mb-6 border-b pb-3">
        <h2 class="text-2xl font-bold text-gray-800">Input Nilai Mahasiswa</h2>
        <p class="text-gray-600 text-sm mt-1">
            {{ $kelas->mataKuliah->nama_mk }} — <span class="font-medium">Kelas {{ $kelas->nama_kelas }}</span>
        </p>
    </div>

    <!-- Form -->
    <form method="POST" action="{{ route('dosen.nilai.update.batch') }}">
        @csrf

        <div class="overflow-x-auto rounded-lg border border-gray-200">
            <table class="w-full text-sm">
                <thead class="bg-gray-100 text-gray-700 uppercase text-xs font-semibold">
                    <tr>
                        <th class="px-4 py-3 text-left">No</th>
                        <th class="px-4 py-3 text-left">NIM</th>
                        <th class="px-4 py-3 text-left">Nama Mahasiswa</th>
                        <th class="px-4 py-3 text-center">Nilai Angka</th>
                        <th class="px-4 py-3 text-center">Nilai Huruf</th>
                        <th class="px-4 py-3 text-center">Bobot</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse($mahasiswaList as $index => $krs)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-4 py-3">{{ $index + 1 }}</td>
                        <td class="px-4 py-3 font-medium text-gray-700">{{ $krs->mahasiswa->nim }}</td>
                        <td class="px-4 py-3">{{ $krs->mahasiswa->user->username }}</td>
                        <td class="px-4 py-3 text-center">
                            <input type="hidden" name="nilai[{{ $index }}][krs_id]" value="{{ $krs->id }}">
                            <input type="number"
                                name="nilai[{{ $index }}][nilai_angka]"
                                value="{{ $krs->nilai->nilai_angka ?? '' }}"
                                min="0" max="100" step="0.01"
                                class="w-24 text-center px-2 py-1 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500"
                                required>
                        </td>
                        <td class="px-4 py-3 text-center">
                            @if($krs->nilai)
                                <span class="px-3 py-1 rounded-full text-xs font-semibold
                                    @if($krs->nilai->nilai_huruf == 'A') bg-green-100 text-green-800
                                    @elseif($krs->nilai->nilai_huruf == 'B') bg-sky-100 text-sky-800
                                    @elseif($krs->nilai->nilai_huruf == 'C') bg-yellow-100 text-yellow-800
                                    @elseif($krs->nilai->nilai_huruf == 'D') bg-orange-100 text-orange-800
                                    @else bg-red-100 text-red-800 @endif">
                                    {{ $krs->nilai->nilai_huruf }}
                                </span>
                            @else
                                <span class="text-gray-400">-</span>
                            @endif
                        </td>
                        <td class="px-4 py-3 text-center font-medium text-gray-700">
                            {{ $krs->nilai ? number_format($krs->nilai->nilai_bobot, 2) : '-' }}
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-4 py-8 text-center text-gray-500 text-sm">
                            Belum ada mahasiswa terdaftar di kelas ini.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($mahasiswaList->count() > 0)
        <div class="mt-6 flex justify-end space-x-3">
            <a href="{{ route('dosen.kelas.index') }}"
                class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-5 py-2 rounded-md transition font-medium">
                Kembali
            </a>
            <button type="submit"
                class="bg-indigo-600 hover:bg-indigo-700 text-white px-5 py-2 rounded-md transition font-medium">
                Simpan Semua Nilai
            </button>
        </div>
        @endif
    </form>

    <!-- Info Nilai -->
    <div class="mt-8 p-5 bg-gray-50 rounded-xl border border-gray-200">
        <h3 class="font-semibold text-gray-800 mb-3">Keterangan Konversi Nilai</h3>
        <div class="grid grid-cols-2 md:grid-cols-5 gap-2 text-sm text-gray-700">
            <div><span class="font-semibold text-green-700">A (4.00)</span>: 85–100</div>
            <div><span class="font-semibold text-sky-700">B (3.00)</span>: 70–84</div>
            <div><span class="font-semibold text-yellow-700">C (2.00)</span>: 60–69</div>
            <div><span class="font-semibold text-orange-700">D (1.00)</span>: 50–59</div>
            <div><span class="font-semibold text-red-700">E (0.00)</span>: 0–49</div>
        </div>
    </div>
</div>
@endsection
