@extends('layouts.dosen')

@section('title', 'Kelas Saya')

@section('content')
<div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
    <h2 class="text-2xl font-bold text-slate-800 mb-6 flex items-center gap-2">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"/>
        </svg>
        Kelas yang Diampu - {{ $tahunAktif->kode_tahun }}
    </h2>

    @if($kelasList->count() > 0)
    <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-5">
        @foreach($kelasList as $kelas)
        <div class="border border-gray-200 bg-white rounded-xl p-5 shadow-sm hover:shadow-md transition-all duration-300 hover:-translate-y-1">
            <!-- Header -->
            <div class="flex justify-between items-start mb-4">
                <div>
                    <h3 class="text-lg font-semibold text-gray-900">{{ $kelas->mataKuliah->nama_mk }}</h3>
                    <p class="text-sm text-gray-500">{{ $kelas->mataKuliah->kode_mk }} • Kelas {{ $kelas->nama_kelas }}</p>
                </div>
                <span class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-xs font-semibold">
                    {{ $kelas->mataKuliah->sks }} SKS
                </span>
            </div>

            <!-- Info Grid -->
            <div class="grid grid-cols-2 gap-4 mb-4 text-sm">
                <div>
                    <p class="text-gray-500">Kapasitas</p>
                    <p class="font-semibold">{{ $kelas->jumlah_mahasiswa }}/{{ $kelas->kapasitas }}</p>
                </div>
                @foreach($kelas->jadwalKuliah as $jadwal)
                <div>
                    <p class="text-gray-500">{{ $jadwal->hari }}</p>
                    <p class="font-semibold">{{ date('H:i', strtotime($jadwal->jam_mulai)) }} - {{ date('H:i', strtotime($jadwal->jam_selesai)) }}</p>
                    <p class="text-xs text-gray-400">{{ $jadwal->ruangan }}</p>
                </div>
                @endforeach
            </div>

            <!-- Tombol Aksi -->
            <div class="flex space-x-3">
                <a href="{{ route('dosen.kelas.show', $kelas->id) }}"
                   class="flex-1 bg-blue-600 hover:bg-blue-700 text-white text-center py-2.5 rounded-lg transition duration-200 font-medium">
                    Lihat Detail
                </a>
                <a href="{{ route('dosen.nilai.index', $kelas->id) }}"
                   class="flex-1 bg-slate-600 hover:bg-slate-700 text-white text-center py-2.5 rounded-lg transition duration-200 font-medium">
                    Input Nilai
                </a>
            </div>
        </div>
        @endforeach
    </div>
    @else
    <div class="text-center py-16 text-gray-500">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-12 h-12 mx-auto mb-3 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M9 13h6m-6 4h6M5 7h14M5 11h14M5 15h14M5 19h14M5 3h14"/>
        </svg>
        <p class="text-lg font-medium">Belum ada kelas yang diampu.</p>
    </div>
    @endif
</div>
@endsection
