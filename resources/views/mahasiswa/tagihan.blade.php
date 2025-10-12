@extends('layouts.mahasiswa')

@section('title', 'Tagihan UKT Saya')

@section('content')
<div class="bg-white rounded-lg shadow-md p-6">
    <h2 class="text-2xl font-bold text-gray-800 mb-6">Tagihan UKT Saya</h2>

    <div class="overflow-x-auto">
        <table class="w-full">
            <thead class="bg-gradient-to-r from-blue-600 to-indigo-600 text-white">
                <tr>
                    <th class="px-4 py-3 text-left text-sm font-semibold">Semester</th>
                    <th class="px-4 py-3 text-left text-sm font-semibold">Jumlah Tagihan</th>
                    <th class="px-4 py-3 text-left text-sm font-semibold">Status</th>
                    <th class="px-4 py-3 text-left text-sm font-semibold">Tanggal Tagihan</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse($tagihan as $t)
                <tr class="hover:bg-gray-50">
                    <td class="px-4 py-3 text-sm font-semibold text-gray-800">{{ $t->semester }}</td>
                    <td class="px-4 py-3 text-sm">Rp {{ number_format($t->jumlah_tagihan, 0, ',', '.') }}</td>
                    <td class="px-4 py-3 text-sm">
                        <span class="
                            @if($t->status == 'berhasil') bg-green-100 text-green-800 
                            @elseif($t->status == 'menunggu_pembayaran') bg-yellow-100 text-yellow-800 
                            @elseif($t->status == 'belum_dibayar') bg-red-100 text-red-800 
                            @else bg-gray-100 text-gray-800 
                            @endif
                            px-2 py-1 rounded text-xs font-semibold">
                            {{ ucfirst(str_replace('_', ' ', $t->status)) }}
                        </span>
                    </td>
                    <td class="px-4 py-3 text-sm">{{ $t->tanggal_tagihan }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="px-4 py-8 text-center text-gray-500">Belum ada tagihan UKT</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
