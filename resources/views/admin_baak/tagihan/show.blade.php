@extends('layouts.admin_baak')

@section('title', 'Detail Tagihan UKT')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="bg-white rounded-2xl shadow-lg border border-gray-200 overflow-hidden">
        
        <!-- Header -->
        <div class="bg-gradient-to-r from-blue-600 to-indigo-600 px-8 py-6">
            <h2 class="text-2xl font-bold text-white">Detail Tagihan UKT</h2>
            <p class="text-blue-100 text-sm mt-1">Data lengkap tagihan mahasiswa</p>
        </div>

        <!-- Isi Konten -->
        <div class="p-8">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                
                <div class="flex flex-col">
                    <span class="text-sm text-gray-500">Nama Mahasiswa</span>
                    <span class="font-semibold text-gray-800">{{ $tagihan->mahasiswa->user->username }}</span>
                </div>

                <div class="flex flex-col">
                    <span class="text-sm text-gray-500">Semester</span>
                    <span class="font-semibold text-gray-800">{{ $tagihan->semester }}</span>
                </div>

                <div class="flex flex-col">
                    <span class="text-sm text-gray-500">Jumlah Tagihan</span>
                    <span class="font-semibold text-gray-800">
                        Rp {{ number_format($tagihan->jumlah_tagihan, 0, ',', '.') }}
                    </span>
                </div>

                <div class="flex flex-col">
                    <span class="text-sm text-gray-500">Tanggal Tagihan</span>
                    <span class="font-semibold text-gray-800">{{ $tagihan->tanggal_tagihan }}</span>
                </div>

                @if ($tagihan->tanggal_pembayaran)
                <div class="flex flex-col">
                    <span class="text-sm text-gray-500">Tanggal Pembayaran</span>
                    <span class="font-semibold text-gray-800">{{ $tagihan->tanggal_pembayaran }}</span>
                </div>
                @endif

                <div class="flex flex-col">
                    <span class="text-sm text-gray-500">Status Pembayaran</span>
                    <span class="mt-1 inline-flex items-center px-3 py-1 text-xs font-semibold rounded-full 
                        @if($tagihan->status == 'lunas') bg-green-100 text-green-700 
                        @elseif($tagihan->status == 'menunggu konfirmasi') bg-yellow-100 text-yellow-700 
                        @else bg-red-100 text-red-700 @endif">
                        {{ ucfirst($tagihan->status) }}
                    </span>
                </div>
            </div>
        </div>

        <!-- Garis Pemisah -->
        <div class="border-t border-gray-200"></div>

        <!-- Tombol Kembali -->
        <div class="px-8 py-5 flex justify-end bg-gray-50">
            <a href="{{ route('admin.tagihan.index') }}" 
               class="px-5 py-2 bg-gray-200 hover:bg-gray-300 text-gray-800 font-medium rounded-lg transition">
                ← Kembali
            </a>
        </div>
    </div>
</div>
@endsection
