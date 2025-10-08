@extends('layouts.mahasiswa')

@section('title', 'Dashboard')

@section('content')
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    {{-- BAGIAN KIRI: Jadwal Kuliah --}}
    <div class="lg:col-span-2 bg-white rounded-lg shadow-md p-6">
        <div class="flex items-center justify-between mb-6">
            <div>
                <h2 class="text-2xl font-bold text-gray-800 mb-1">Jadwal Kuliah</h2>
                <p class="text-gray-500 text-sm">
                    Anda memiliki <span class="font-semibold text-blue-600">{{ $jadwalHariIni->count() }}</span> aktivitas perkuliahan
                </p>
            </div>
            <form method="GET" action="">
                <input type="date" id="tanggal" name="tanggal" value="{{ $tanggalDipilih }}"
                    class="border border-gray-300 rounded-lg px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                    onchange="this.form.submit()">
            </form>
        </div>

        <div class="mb-6 pb-4 border-b border-gray-200">
            <p class="text-gray-700 font-medium">
                {{ ucfirst($hariDipilih) }}, {{ \Carbon\Carbon::parse($tanggalDipilih)->translatedFormat('d F Y') }}
            </p>
        </div>

        @if($jadwalHariIni->count() > 0)
            @foreach($jadwalHariIni as $jadwal)
    <div class="border border-blue-400 bg-white rounded-xl shadow-sm p-5 mb-4 hover:shadow-md transition-all duration-200">
        <div class="flex flex-col md:flex-row md:items-start md:justify-between">
            <!-- Info Mata Kuliah -->
            <div class="flex-1">
                <h3 class="font-bold text-lg text-gray-900 mb-2">
                    {{ $jadwal->kelas->mataKuliah->nama_mk }}
                    <span class="text-gray-500 text-sm">({{ $jadwal->kelas->mataKuliah->kode_mk }})</span>
                </h3>

                <div class="space-y-2 text-sm text-gray-600">
                    <div class="flex items-center">
                        <svg class="w-4 h-4 mr-2 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <span class="font-medium text-gray-800">
                            {{ date('H:i', strtotime($jadwal->jam_mulai)) }} - {{ date('H:i', strtotime($jadwal->jam_selesai)) }} WIB
                        </span>
                    </div>

                    <div class="flex items-center">
                        <svg class="w-4 h-4 mr-2 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                        {{ $jadwal->kelas->dosen->user->username }}
                    </div>

                    <div class="flex items-center">
                        <svg class="w-4 h-4 mr-2 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                        </svg>
                        {{ $jadwal->ruangan }}
                    </div>

                    <!-- Info Tambahan -->
                    <div class="flex flex-wrap gap-2 mt-3">
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                            {{ $jadwal->kelas->mataKuliah->sks }} SKS
                        </span>

                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                            Pertemuan ke {{ $loop->iteration }}
                        </span>

                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-600">
                            Kehadiran Belum Tercatat
                        </span>
                    </div>
                </div>
            </div>

            <!-- Tombol Aksi -->
            <div class="mt-4 md:mt-0">
                <button class="flex items-center justify-center gap-2 bg-white hover:bg-gray-50 text-gray-700 border border-gray-300 px-4 py-2 rounded-lg text-sm font-medium transition-colors duration-200">
                    Opsi Lainnya
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </button>
            </div>
        </div>
    </div>
@endforeach

        @else
            <div class="flex flex-col items-center justify-center py-16 text-gray-400">
                <img src="https://cdn-icons-png.flaticon.com/512/4076/4076432.png" alt="no schedule" class="w-32 mb-4 opacity-60">
                <p class="font-semibold text-gray-600">Tidak ada jadwal kuliah saat ini</p>
                <p class="text-sm text-gray-500 mt-1">Istirahat dulu ya, tetap semangat belajar!</p>
            </div>
        @endif
    </div>

    {{-- BAGIAN KANAN --}}
    <div class="space-y-6">
        {{-- INFORMASI MAHASISWA --}}
        <div class="bg-white rounded-lg shadow-md p-6">
            <div class="flex items-center space-x-3 mb-3">
                <img src="https://cdn-icons-png.flaticon.com/512/3135/3135768.png" alt="icon" class="w-10 h-10">
                <div>
                    <h2 class="text-lg font-bold text-gray-800">
                        Hai, {{ strtoupper(Auth::user()->username) }}
                    </h2>
                    <p class="text-sm text-gray-600">
                        Saat ini Anda berada di Semester {{ $mahasiswa->semester_aktif }}
                        dengan IPK <span class="font-semibold text-blue-700">{{ number_format($ipk, 2) }}</span>.
                        <a href="#" class="text-blue-600 hover:underline">Lihat detail</a>
                    </p>
                </div>
            </div>

            <div class="bg-yellow-50 border-l-4 border-yellow-400 p-3 text-sm text-gray-700 rounded">
                Mahasiswa belum melengkapi biodata.
                <a href="#" class="text-blue-600 hover:underline">Lengkapi di sini</a>
            </div>
        </div>

        {{-- GRAFIK IPS (REAL DATABASE) --}}
        <div class="bg-white rounded-lg shadow-md p-6">
            <h2 class="text-lg font-semibold text-gray-800 mb-4">Grafik IPS per Semester</h2>
            <canvas id="ipkChart" height="180"></canvas>
        </div>

        {{-- Kalender Akademik --}}
        <div class="bg-white p-4 rounded-xl shadow-md mt-6">
            <h3 class="text-lg font-semibold mb-4 text-gray-700">Kalender Akademik</h3>
            @php
                use Carbon\Carbon;
                $bulanSekarang = Carbon::parse($tanggalDipilih)->month;
                $tahunSekarang = Carbon::parse($tanggalDipilih)->year;
                $tanggalPertama = Carbon::createFromDate($tahunSekarang, $bulanSekarang, 1);
                $hariPertama = $tanggalPertama->dayOfWeekIso;
                $jumlahHari = $tanggalPertama->daysInMonth;
            @endphp

            <div class="grid grid-cols-7 text-center text-gray-600 font-semibold">
                <div>Sen</div>
                <div>Sel</div>
                <div>Rab</div>
                <div>Kam</div>
                <div>Jum</div>
                <div>Sab</div>
                <div>Min</div>
            </div>

            <div class="grid grid-cols-7 text-center mt-2">
                {{-- Kosongin slot sebelum tanggal 1 --}}
                @for ($i = 1; $i < $hariPertama; $i++)
                    <div></div>
                @endfor

                {{-- Isi tanggal --}}
                @for ($tanggal = 1; $tanggal <= $jumlahHari; $tanggal++)
                    @php
                        $tanggalSekarang = Carbon::createFromDate($tahunSekarang, $bulanSekarang, $tanggal)->format('Y-m-d');
                        $isToday = $tanggalSekarang === now()->format('Y-m-d');
                        $isSelected = $tanggalSekarang === $tanggalDipilih;
                    @endphp
                    <form method="GET" action="{{ route('mahasiswa.dashboard') }}">
                        <input type="hidden" name="tanggal" value="{{ $tanggalSekarang }}">
                        <button type="submit"
                            class="w-10 h-10 m-1 rounded-full
                            {{ $isSelected ? 'bg-blue-500 text-white' : ($isToday ? 'border border-blue-400 text-blue-500' : 'hover:bg-gray-100 text-gray-700') }}">
                            {{ $tanggal }}
                        </button>
                    </form>
                @endfor
            </div>
        </div>
    </div>
</div>

{{-- SCRIPT UNTUK GRAFIK IPS --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('ipkChart').getContext('2d');
    const ipkChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: @json(array_map(fn($s) => 'Semester '.$s, $labels)),
            datasets: [{
                label: 'IPS',
                data: @json($dataIps),
                borderColor: '#2563eb',
                backgroundColor: 'rgba(37, 99, 235, 0.1)',
                fill: true,
                tension: 0.4,
                pointRadius: 5,
                pointBackgroundColor: '#2563eb'
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: false,
                    min: 0,
                    max: 4,
                    ticks: {
                        stepSize: 0.5
                    }
                }
            },
            plugins: {
                legend: { display: false },
                tooltip: {
                    callbacks: {
                        label: ctx => `IPS: ${ctx.formattedValue}`
                    }
                }
            }
        }
    });
</script>
@endsection
