@extends('layouts.mahasiswa')

@section('title', 'Kartu Hasil Studi')

@section('content')
<div class="bg-white rounded-lg shadow-md p-6">
    <h2 class="text-2xl font-bold text-gray-800 mb-6">Kartu Hasil Studi (KHS)</h2>
    @if($khsList->count() > 0)
    <div class="mb-6 bg-blue-50 border rounded-lg p-4">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-2 text-sm">
            <div><span class="font-semibold text-gray-700">NIM</span>: {{ $mahasiswa->nim }}</div>
            <div><span class="font-semibold text-gray-700">Nama Mahasiswa</span>: {{ $user->username }}</div>
            <div><span class="font-semibold text-gray-700">Program Studi</span>: {{ $prodi->nama_prodi }}</div>
            <div><span class="font-semibold text-gray-700">Status Mahasiswa</span>: Aktif</div>
            <div><span class="font-semibold text-gray-700">Angkatan</span>: {{ $mahasiswa->angkatan }}</div>
            <div><span class="font-semibold text-gray-700">Semester</span>: {{ $khsList->first()->mahasiswa->semester_aktif ?? '-' }}</div>
            <div><span class="font-semibold text-gray-700">Pembimbing Akademik</span>: {{ $pembimbingAkademik->dosen->user->username ?? '-' }}</div>
            <div><span class="font-semibold text-gray-700">SKS Lulus / IPK Lulus</span>: {{ $khsList->last()->total_sks_kumulatif ?? 0 }} / {{ number_format($khsList->last()->ipk ?? 0, 2) }}</div>
            <div><span class="font-semibold text-gray-700">Total SKS / IPK</span>: {{ $khsList->last()->total_sks_kumulatif ?? 0 }} / {{ number_format($khsList->last()->ipk ?? 0, 2) }}</div>
        </div>
    </div>
    <div class="mb-4">
        <label for="periode" class="font-semibold text-gray-700 mr-2">Periode</label>
        <select id="periode" class="border rounded px-2 py-1 text-sm" onchange="location.href='?periode='+this.value">
            @foreach($khsList as $khs)
                <option value="{{ $khs->tahunAkademik->kode_tahun }}" {{ $loop->first ? 'selected' : '' }}>
                    {{ $khs->tahunAkademik->kode_tahun }} - Semester {{ ucfirst($khs->tahunAkademik->semester) }}
                </option>
            @endforeach
        </select>
    </div>
    @foreach($khsList as $khs)
    <div class="mb-8">
        <div class="bg-blue-700 text-white px-4 py-2 rounded-t font-semibold flex items-center justify-between">
            <div>
                Periode {{ $khs->tahunAkademik->kode_tahun }} - Semester {{ ucfirst($khs->tahunAkademik->semester) }}
            </div>
            <a href="{{ route('mahasiswa.khs.download', $khs->tahun_akademik_id) }}"
               class="bg-white text-blue-700 px-3 py-1 rounded text-xs font-semibold hover:bg-blue-50 transition">
                Download PDF
            </a>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full border">
                <thead class="bg-blue-100">
                    <tr>
                        <th class="px-2 py-2 text-xs">No</th>
                        <th class="px-2 py-2 text-xs">Kode</th>
                        <th class="px-2 py-2 text-xs">Nama Mata Kuliah</th>
                        <th class="px-2 py-2 text-xs">SKS</th>
                        <th class="px-2 py-2 text-xs">Nilai Mutu</th>
                        <th class="px-2 py-2 text-xs">Bobot</th>
                        <th class="px-2 py-2 text-xs">Nilai</th>
                        <th class="px-2 py-2 text-xs">Keterangan</th>
                        <th class="px-2 py-2 text-xs">Transkrip</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($khs->nilaiList as $i => $krs)
                    <tr class="{{ $i % 2 == 0 ? 'bg-white' : 'bg-gray-50' }}">
                        <td class="px-2 py-1 text-xs text-center">{{ $i+1 }}</td>
                        <td class="px-2 py-1 text-xs text-center">{{ $krs->kelas->mataKuliah->kode_mk }}</td>
                        <td class="px-2 py-1 text-xs">{{ $krs->kelas->mataKuliah->nama_mk }}</td>
                        <td class="px-2 py-1 text-xs text-center">{{ $krs->kelas->mataKuliah->sks }}</td>
                        <td class="px-2 py-1 text-xs text-center">{{ number_format($krs->nilai->nilai_bobot, 2) }}</td>
                        <td class="px-2 py-1 text-xs text-center">{{ number_format($krs->nilai->nilai_bobot * $krs->kelas->mataKuliah->sks, 0) }}</td>
                        <td class="px-2 py-1 text-xs text-center">{{ $krs->nilai->nilai_huruf }}</td>
                        <td class="px-2 py-1 text-xs text-center">{{ $krs->nilai->nilai_huruf == 'E' ? 'Tidak Lulus' : 'Lulus' }}</td>
                        <td class="px-2 py-1 text-xs text-center">@if($krs->nilai->nilai_huruf != 'E') ✔ @endif</td>
                    </tr>
                    @empty
                    <tr><td colspan="9" class="text-center text-gray-400 py-4">Belum ada nilai untuk semester ini</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="flex flex-wrap justify-between items-center bg-gray-50 px-4 py-2 border-t">
            <div class="text-sm font-semibold">Total SKS: {{ $khs->total_sks_semester }}</div>
            <div class="text-sm font-semibold">Indeks Prestasi Semester: {{ number_format($khs->ips, 2) }}</div>
            <div class="text-sm font-semibold">Indeks Prestasi Kumulatif: {{ number_format($khs->ipk, 2) }}</div>
        </div>
    </div>
    @endforeach
    @else
    <div class="text-center py-8 text-gray-500">Belum ada data KHS</div>
    @endif
</div>
@endsection
