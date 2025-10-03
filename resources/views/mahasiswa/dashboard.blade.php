@extends('layouts.mahasiswa')

@section('title', 'Dashboard')

@section('content')

    <!-- Statistik Utama -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <!-- Semester Aktif -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm">Semester Aktif</p>
                    <p class="text-3xl font-bold text-blue-600">
                        {{ $mahasiswa->semester_aktif }}
                    </p>
                </div>
                <div class="bg-blue-100 p-3 rounded-full">
                    <x-heroicon-o-academic-cap class="w-8 h-8 text-blue-600"/>
                </div>
            </div>
        </div>

        <!-- Total SKS -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm">Total SKS Semester Ini</p>
                    <p class="text-3xl font-bold text-green-600">
                        {{ $totalSks }}
                    </p>
                </div>
                <div class="bg-green-100 p-3 rounded-full">
                    <x-heroicon-o-clipboard-document-list class="w-8 h-8 text-green-600"/>
                </div>
            </div>
        </div>

        <!-- IPK -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm">IPK</p>
                    <p class="text-3xl font-bold text-purple-600">
                        {{ number_format($ipk, 2) }}
                    </p>
                </div>
                <div class="bg-purple-100 p-3 rounded-full">
                    <x-heroicon-o-star class="w-8 h-8 text-purple-600"/>
                </div>
            </div>
        </div>
    </div>

    <!-- Informasi Mahasiswa -->
    <div class="bg-white rounded-lg shadow-md p-6 mb-8">
        <h2 class="text-xl font-bold text-gray-800 mb-4">Informasi Mahasiswa</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <p class="text-gray-600 text-sm">NIM</p>
                <p class="font-semibold">{{ $mahasiswa->nim }}</p>
            </div>
            <div>
                <p class="text-gray-600 text-sm">Nama Lengkap</p>
                <p class="font-semibold">{{ Auth::user()->username }}</p>
            </div>
            <div>
                <p class="text-gray-600 text-sm">Program Studi</p>
                <p class="font-semibold">{{ $mahasiswa->programStudi->nama_prodi }}</p>
            </div>
            <div>
                <p class="text-gray-600 text-sm">Angkatan</p>
                <p class="font-semibold">{{ $mahasiswa->angkatan }}</p>
            </div>
            <div>
                <p class="text-gray-600 text-sm">Tahun Akademik Aktif</p>
                <p class="font-semibold">
                    {{ $tahunAktif->kode_tahun }} - {{ ucfirst($tahunAktif->semester) }}
                </p>
            </div>
            <div>
                <p class="text-gray-600 text-sm">Pembimbing Akademik</p>
                <p class="font-semibold">
                    @if($pembimbingAkademik)
                        {{ $pembimbingAkademik->dosen->user->username }}
                    @else
                        Belum ditentukan
                    @endif
                </p>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

        <!-- Jadwal Kuliah -->
        <div class="lg:col-span-2 bg-white rounded-lg shadow-md p-6">

            <!-- Input tanggal filter -->
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-xl font-bold text-gray-800">Jadwal Kuliah Mingguan</h2>
                <form method="GET" action="{{ route('mahasiswa.jadwal.index') }}">
                    <input type="date" name="tanggal"
                           value="{{ $selectedDate ?? \Carbon\Carbon::now()->toDateString() }}"
                           class="border rounded-lg px-3 py-1 text-sm focus:ring focus:ring-blue-300">
                    <button type="submit"
                            class="ml-2 bg-blue-600 text-white px-3 py-1 rounded-lg text-sm">Lihat</button>
                </form>
            </div>

            @if($jadwalList->isEmpty())
                <p class="text-gray-500">Belum ada jadwal kuliah untuk semester ini.</p>
            @else
                <div class="space-y-4">
                    @foreach($jadwalList as $jadwal)
                        <div class="border rounded-lg p-4 hover:shadow-md transition">
                            <div class="flex items-center justify-between">
                                <div>
                                    <h3 class="font-bold text-lg text-blue-700">
                                        {{ $jadwal->kelas->mataKuliah->nama }}
                                        <span class="text-sm text-gray-500">({{ $jadwal->kelas->nama }})</span>
                                    </h3>
                                    <p class="text-sm text-gray-600">
                                        {{ $jadwal->hari }}, 
                                        {{ \Carbon\Carbon::parse($jadwal->jam_mulai)->format('H:i') }} - 
                                        {{ \Carbon\Carbon::parse($jadwal->jam_selesai)->format('H:i') }} WIB
                                    </p>
                                    <p class="text-sm text-gray-600">
                                        Dosen: {{ $jadwal->kelas->dosen->user->username }}
                                    </p>
                                    <p class="text-sm text-gray-600">
                                        Ruang: {{ $jadwal->ruangan ?? 'Belum ditentukan' }}
                                    </p>
                                </div>
                                <div class="text-right">
                                    <span class="inline-block bg-blue-100 text-blue-700 text-xs px-3 py-1 rounded-full">
                                        {{ $jadwal->kelas->mataKuliah->sks }} SKS
                                    </span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>

        <!-- Kalender Akademik -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <h2 class="text-xl font-bold text-gray-800 mb-4">Kalender Akademik</h2>
            <div id="calendar"></div>
        </div>
    </div>
@endsection

@push('scripts')
    <!-- FullCalendar CSS & JS -->
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.9/main.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.9/main.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let calendarEl = document.getElementById('calendar');

            let calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                height: 550,
                locale: 'id',
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay'
                },
                events: [
                    @foreach($jadwalList as $jadwal)
                        {
                            title: "{{ $jadwal->kelas->mataKuliah->nama }} ({{ $jadwal->kelas->nama }})",
                            start: "{{ $jadwal->tanggal_real }}T{{ \Carbon\Carbon::parse($jadwal->jam_mulai)->format('H:i:s') }}",
                            end: "{{ $jadwal->tanggal_real }}T{{ \Carbon\Carbon::parse($jadwal->jam_selesai)->format('H:i:s') }}",
                            color: '#2563eb'
                        },
                    @endforeach
                ]
            });

            calendar.render();
        });
    </script>
@endpush
