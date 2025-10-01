@extends('layouts.mahasiswa')

@section('title', 'Kartu Hasil Studi')

@section('content')
<div class="bg-white rounded-lg shadow-md p-6">
    <h2 class="text-2xl font-bold text-gray-800 mb-6">Kartu Hasil Studi (KHS)</h2>

    <div class="grid gap-6">
        @forelse($khsList as $khs)
            <div class="border rounded-lg overflow-hidden">
                <div class="bg-gradient-to-r from-blue-600 to-indigo-600 p-4">
                    <div class="flex justify-between items-center">
                        <div>
                            <h3 class="text-white font-semibold">
                                {{ $khs->tahunAkademik->kode_tahun }} - Semester {{ ucfirst($khs->tahunAkademik->semester) }}
                            </h3>
                            <div class="mt-2 space-x-4">
                                <span class="text-white text-sm">IP Semester: {{ number_format($khs->ip_semester, 2) }}</span>
                                <span class="text-white text-sm">IPK: {{ number_format($khs->ip_kumulatif, 2) }}</span>
                                <span class="text-white text-sm">SKS Semester: {{ $khs->sks_semester }}</span>
                                <span class="text-white text-sm">Total SKS: {{ $khs->sks_total }}</span>
                            </div>
                        </div>
                        <a href="{{ route('mahasiswa.khs.download', $khs->tahun_akademik_id) }}"
                           class="bg-white text-blue-600 px-4 py-2 rounded-lg text-sm font-semibold hover:bg-blue-50 transition-colors">
                            Download PDF
                        </a>
                    </div>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500">Kode MK</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500">Mata Kuliah</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500">SKS</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500">Nilai Angka</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500">Nilai Huruf</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500">Bobot</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @forelse($khs->nilaiList ?? [] as $nilai)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-4 py-3 text-sm">{{ $nilai->krs->kelas->mataKuliah->kode_mk }}</td>
                                    <td class="px-4 py-3 text-sm">{{ $nilai->krs->kelas->mataKuliah->nama_mk }}</td>
                                    <td class="px-4 py-3 text-sm">{{ $nilai->krs->kelas->mataKuliah->sks }}</td>
                                    <td class="px-4 py-3 text-sm">{{ number_format($nilai->nilai_angka, 2) }}</td>
                                    <td class="px-4 py-3 text-sm">
                                        <span class="bg-blue-100 text-blue-800 px-2 py-1 rounded text-xs font-semibold">
                                            {{ $nilai->nilai_huruf }}
                                        </span>
                                    </td>
                                    <td class="px-4 py-3 text-sm">{{ number_format($nilai->nilai_bobot, 2) }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-4 py-8 text-center text-gray-500">
                                        Belum ada nilai untuk semester ini
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        @empty
            <div class="text-center py-8 text-gray-500">
                Belum ada data KHS
            </div>
        @endforelse
    </div>
</div>
@endsection
