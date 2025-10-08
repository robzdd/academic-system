    @extends('layouts.mahasiswa')

    @section('title', 'Dashboard')

    @section('content')
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        {{-- BAGIAN KIRI: Jadwal Kuliah --}}
        <div class="lg:col-span-2 bg-white rounded-lg shadow-md p-6">
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-xl font-bold text-gray-800">Jadwal Kuliah</h2>
                <form method="GET" action="">
                    <input type="date" id="tanggal" name="tanggal" value="{{ $tanggalDipilih }}"
                        class="border rounded px-2 py-1 text-sm" onchange="this.form.submit()">
                </form>
            </div>

            <p class="text-gray-500 text-sm mb-4">
                {{ ucfirst($hariDipilih) }}, {{ \Carbon\Carbon::parse($tanggalDipilih)->translatedFormat('d F Y') }}
            </p>

            @if($jadwalHariIni->count() > 0)
                @foreach($jadwalHariIni as $jadwal)
                    <div class="border rounded-lg p-4 mb-4 flex flex-col md:flex-row md:items-center md:justify-between hover:shadow">
                        <div>
                            <div class="font-bold text-lg text-blue-800 mb-1">
                                {{ $jadwal->kelas->mataKuliah->nama_mk }} ({{ $jadwal->kelas->mataKuliah->kode_mk }})
                            </div>
                            <div class="text-sm text-gray-600 mb-1">
                                Kelas {{ $jadwal->kelas->nama_kelas }} | {{ $jadwal->kelas->mataKuliah->sks }} SKS
                            </div>
                            <div class="text-sm text-gray-600 mb-1">
                                Dosen: {{ $jadwal->kelas->dosen->user->username }}
                            </div>
                            <div class="text-sm text-gray-600 mb-1">
                                Ruangan: {{ $jadwal->ruangan }}
                            </div>
                        </div>
                        <div class="flex flex-col items-end mt-2 md:mt-0">
                            <span class="text-sm text-gray-700 font-semibold">
                                {{ date('H:i', strtotime($jadwal->jam_mulai)) }} - {{ date('H:i', strtotime($jadwal->jam_selesai)) }} WIB
                            </span>
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
