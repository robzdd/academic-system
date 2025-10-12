@extends('layouts.admin_baak')

@section('title', 'Daftar Tagihan UKT')

@section('content')
<div class="bg-white rounded-2xl shadow-lg border border-gray-200 p-6">
    <!-- Header -->
    <div class="flex justify-between items-center mb-6">
        <div>
            <h2 class="text-2xl font-bold text-gray-800">Daftar Tagihan UKT</h2>
            <p class="text-gray-500 text-sm">Manajemen data tagihan UKT mahasiswa</p>
        </div>
        <a href="{{ route('admin.tagihan.create') }}" 
           class="bg-gradient-to-r from-indigo-600 to-cyan-600 hover:from-indigo-700 hover:to-cyan-700 text-white px-5 py-2.5 rounded-lg shadow-md transition font-semibold">
            + Tambah Tagihan
        </a>
    </div>

    <!-- Notifikasi -->
    @if (session('success'))
        <div class="mb-6 px-4 py-3 bg-green-50 border border-green-200 text-green-800 rounded-lg">
            {{ session('success') }}
        </div>
    @endif

    <!-- Table -->
    <div class="overflow-x-auto rounded-xl border border-gray-200">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gradient-to-r from-indigo-600 to-cyan-600 text-white">
                <tr>
                    <th class="px-4 py-3 text-left text-sm font-semibold">Mahasiswa</th>
                    <th class="px-4 py-3 text-center text-sm font-semibold">Semester</th>
                    <th class="px-4 py-3 text-center text-sm font-semibold">Jumlah Tagihan</th>
                    <th class="px-4 py-3 text-center text-sm font-semibold">Status</th>
                    <th class="px-4 py-3 text-center text-sm font-semibold">Tanggal Tagihan</th>
                    <th class="px-4 py-3 text-center text-sm font-semibold">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse ($tagihan as $t)
                <tr class="hover:bg-gray-50 transition">
                    <td class="px-4 py-3 text-sm font-semibold text-gray-800">{{ $t->mahasiswa->user->username }}</td>
                    <td class="px-4 py-3 text-sm text-center text-gray-700">{{ $t->semester }}</td>
                    <td class="px-4 py-3 text-sm text-center font-semibold text-gray-800">
                        Rp {{ number_format($t->jumlah_tagihan, 0, ',', '.') }}
                    </td>
                    <td class="px-4 py-3 text-sm text-center">
                        @php
                            $color = match($t->status) {
                                'berhasil' => 'bg-green-100 text-green-800',
                                'menunggu_pembayaran' => 'bg-yellow-100 text-yellow-800',
                                'gagal', 'kedaluwarsa' => 'bg-red-100 text-red-800',
                                default => 'bg-gray-100 text-gray-800',
                            };
                        @endphp
                        <span class="px-3 py-1 rounded-full text-xs font-semibold {{ $color }}">
                            {{ ucfirst(str_replace('_', ' ', $t->status)) }}
                        </span>
                    </td>
                    <td class="px-4 py-3 text-sm text-center text-gray-700">
                        {{ \Carbon\Carbon::parse($t->tanggal_tagihan)->format('d M Y') }}
                    </td>
                    <td class="px-4 py-3 text-sm text-center">
                        <a href="{{ route('admin.tagihan.show', $t->id) }}" 
                           class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded text-xs font-semibold transition">
                           Detail
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-4 py-8 text-center text-gray-500 text-sm italic">
                        Belum ada data tagihan UKT
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
