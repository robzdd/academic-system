@extends('layouts.dosen')

@section('title', 'Kelas Saya')

@section('content')
<div class="bg-white rounded-lg shadow-md p-6">
    <h2 class="text-2xl font-bold text-gray-800 mb-6">Kelas yang Diampu - {{ $tahunAktif->kode_tahun }}</h2>

    <div class="grid grid-cols-1 gap-4">
        @forelse($kelasList as $kelas)
        <div class="border border-gray-200 rounded-lg p-6 hover:shadow-lg transition">
            <div class="flex justify-between items-start mb-4">
                <div>
                    <h3 class="text-xl font-bold text-gray-800">{{ $kelas->mataKuliah->nama_mk }}</h3>
                    <p class="text-sm text-gray-600">{{ $kelas->mataKuliah->kode_mk }} - Kelas {{ $kelas->nama_kelas }}</p>
                </div>
                <span class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-sm font-semibold">
                    {{ $kelas->mataKuliah->sks }} SKS
                </span>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-4">
                <div>
                    <p class="text-gray-600 text-sm">Kapasitas</p>
                    <p class="font-bold">{{ $kelas->jumlah_mahasiswa }}/{{ $kelas->kapasitas }}</p>
                </div>
                @foreach($kelas->jadwalKuliah as $jadwal)
                <div>
                    <p class="text-gray-600 text-sm">{{ $jadwal->hari }}</p>
                    <p class="font-bold text-sm">{{ date('H:i', strtotime($jadwal->jam_mulai)) }} - {{ date('H:i', strtotime($jadwal->jam_selesai)) }}</p>
                    <p class="text-xs text-gray-500">{{ $jadwal->ruangan }}</p>
                </div>
                @endforeach
            </div>

            <div class="flex space-x-3">
                <a href="{{ route('dosen.kelas.show', $kelas->id) }}"
                   class="flex-1 bg-blue-600 hover:bg-blue-700 text-white text-center py-2 rounded transition">
                    Lihat Detail
                </a>
                <a href="{{ route('dosen.nilai.index', $kelas->id) }}"
                   class="flex-1 bg-green-600 hover:bg-green-700 text-white text-center py-2 rounded transition">
                    Input Nilai
                </a>
            </div>
        </div>
        @empty
        <div class="text-center py-12 text-gray-500">
            Belum ada kelas yang diampu
        </div>
        @endforelse
    </div>
</div>
@endsection
