@extends('layouts.dosen')

@section('title', 'Dashboard')

@section('content')
<div class="space-y-8">

    {{-- Statistik Kelas & Mahasiswa --}}
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        {{-- Total Kelas --}}
        <div class="bg-white rounded-xl shadow-md p-6 hover:shadow-lg transition-shadow duration-200">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm">Total Kelas</p>
                    <p class="text-3xl font-bold text-indigo-600">{{ $totalKelas }}</p>
                </div>
                <div class="bg-indigo-100 p-3 rounded-full">
                    <svg class="w-8 h-8 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                    </svg>
                </div>
            </div>
        </div>

        {{-- Total Mahasiswa --}}
        <div class="bg-white rounded-xl shadow-md p-6 hover:shadow-lg transition-shadow duration-200">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm">Total Mahasiswa</p>
                    <p class="text-3xl font-bold text-sky-600">{{ $totalMahasiswa }}</p>
                </div>
                <div class="bg-sky-100 p-3 rounded-full">
                    <svg class="w-8 h-8 text-sky-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    {{-- Informasi Dosen --}}
    <div class="bg-white rounded-xl shadow-md p-6 hover:shadow-lg transition-shadow duration-200">
        <h2 class="text-xl font-bold text-gray-800 mb-4 border-b pb-2 flex items-center gap-2">
            <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M5.121 17.804A9 9 0 1118.88 6.197M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
            </svg>
            Informasi Dosen
        </h2>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 text-gray-700">
            <div>
                <p class="text-sm text-gray-500">NIDN</p>
                <p class="font-semibold">{{ $dosen->nidn }}</p>
            </div>
            <div>
                <p class="text-sm text-gray-500">Nama Lengkap</p>
                <p class="font-semibold">{{ Auth::user()->username }}</p>
            </div>
            <div>
                <p class="text-sm text-gray-500">Program Studi</p>
                <p class="font-semibold">{{ $dosen->programStudi->nama_prodi }}</p>
            </div>
            <div>
                <p class="text-sm text-gray-500">Tahun Akademik Aktif</p>
                <p class="font-semibold">{{ $tahunAktif->kode_tahun }} - {{ ucfirst($tahunAktif->semester) }}</p>
            </div>
        </div>

        <div class="mt-6">
            <a href="{{ route('dosen.bimbingan') }}"
               class="inline-block bg-gradient-to-r from-indigo-600 to-sky-600 hover:from-indigo-700 hover:to-sky-700 text-white px-5 py-2 rounded-lg shadow-md transition">
                Mahasiswa Bimbingan & ACC KRS
            </a>
        </div>
    </div>

    {{-- Kelas yang Diampu --}}
    <div class="bg-white rounded-xl shadow-md p-6 hover:shadow-lg transition-shadow duration-200">
        <h2 class="text-xl font-bold text-gray-800 mb-4 border-b pb-2 flex items-center gap-2">
            <svg class="w-6 h-6 text-sky-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M12 6v6l4 2m6-2a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            Kelas yang Diampu
        </h2>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">
            @forelse($kelasList as $kelas)
                <div class="border border-gray-200 rounded-lg p-5 hover:shadow-md hover:-translate-y-1 transition duration-200">
                    <h3 class="font-semibold text-gray-800">{{ $kelas->mataKuliah->nama_mk }}</h3>
                    <p class="text-sm text-gray-500 mb-2">Kelas {{ $kelas->nama_kelas }}</p>

                    <div class="flex justify-between text-sm mb-3">
                        <span class="text-gray-600">SKS: {{ $kelas->mataKuliah->sks }}</span>
                        <span class="text-gray-600">{{ $kelas->jumlah_mahasiswa }}/{{ $kelas->kapasitas }} Mhs</span>
                    </div>

                    <a href="{{ route('dosen.nilai.index', $kelas->id) }}"
                       class="block w-full text-center bg-gradient-to-r from-sky-600 to-indigo-600 hover:from-sky-700 hover:to-indigo-700 text-white py-2 rounded-lg transition">
                        Input Nilai
                    </a>
                </div>
            @empty
                <div class="col-span-3 text-center py-8 text-gray-500">
                    Belum ada kelas yang diampu.
                </div>
            @endforelse
        </div>
    </div>

    {{-- Jadwal Mengajar Hari Ini --}}
    <div class="bg-white rounded-xl shadow-md p-6 hover:shadow-lg transition-shadow duration-200">
        <h2 class="text-xl font-bold text-gray-800 mb-4 border-b pb-2 flex items-center gap-2">
            <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
            </svg>
            Jadwal Mengajar
        </h2>

        <form method="GET" action="" class="flex flex-col md:flex-row md:items-center md:justify-between mb-6 gap-3">
            <div class="flex items-center gap-2">
                <label for="tanggal" class="text-sm font-medium text-gray-700">Pilih Tanggal:</label>
                <input 
                    type="date" 
                    id="tanggal" 
                    name="tanggal" 
                    value="{{ $tanggalDipilih ?? now()->toDateString() }}" 
                    class="border border-gray-300 rounded-lg px-3 py-1.5 text-sm focus:ring-2 focus:ring-indigo-500 focus:outline-none transition"
                    onchange="this.form.submit()"
                >
            </div>
            <span class="text-sm text-gray-500">
                {{ ucfirst($hariDipilih ?? now()->translatedFormat('l')) }},
                {{ \Carbon\Carbon::parse($tanggalDipilih ?? now())->translatedFormat('d F Y') }}
            </span>
        </form>

        @if(isset($jadwalMengajar) && $jadwalMengajar->count() > 0)
            <div class="space-y-4">
                @foreach($jadwalMengajar as $jadwal)
                    <div class="border border-gray-100 hover:border-indigo-300 rounded-xl p-4 flex flex-col md:flex-row md:items-center md:justify-between transition">
                        <div>
                            <h3 class="font-semibold text-lg text-gray-800 mb-1">
                                {{ $jadwal->kelas->mataKuliah->nama_mk }}
                                <span class="text-sm text-gray-500">({{ $jadwal->kelas->mataKuliah->kode_mk }})</span>
                            </h3>
                            <p class="text-sm text-gray-600">
                                Kelas {{ $jadwal->kelas->nama_kelas }} • {{ $jadwal->kelas->mataKuliah->sks }} SKS
                            </p>
                            <p class="text-sm text-gray-600">Ruangan: {{ $jadwal->ruangan }}</p>
                        </div>

                        <div class="flex flex-col items-end mt-3 md:mt-0">
                            <span class="text-sm font-semibold text-indigo-700 bg-indigo-50 px-3 py-1.5 rounded-lg">
                                {{ date('H:i', strtotime($jadwal->jam_mulai)) }} - {{ date('H:i', strtotime($jadwal->jam_selesai)) }} WIB
                            </span>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center text-gray-400 py-10 text-sm">
                Tidak ada jadwal mengajar pada tanggal ini
            </div>
        @endif
    </div>

</div>
@endsection
