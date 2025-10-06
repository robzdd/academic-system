@extends('layouts.mahasiswa')

@section('title', 'Kartu Rencana Studi')

@section('content')
<div class="bg-white rounded-lg shadow-md p-6 mb-6">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-gray-800">KRS Semester {{ $tahunAktif->kode_tahun }} - {{ ucfirst($tahunAktif->semester) }}</h2>
        @if($krsList->where('status', 'draft')->count() > 0)
            <form method="POST" action="{{ route('mahasiswa.krs.submit') }}">
                @csrf
                <button class="bg-green-600 hover:bg-green-700 text-white px-6 py-2 rounded-lg transition">
                    Ajukan KRS
                </button>
            </form>
        @endif
    </div>

    <h3 class="text-lg font-semibold mb-4">Mata Kuliah yang Diambil</h3>
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Kode MK</th>
                    <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Mata Kuliah</th>
                    <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">SKS</th>
                    <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Kelas</th>
                    <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Dosen</th>
                    <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Status</th>
                    <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse($krsList as $krs)
                <tr>
                    <td class="px-4 py-3 text-sm">{{ $krs->kelas->mataKuliah->kode_mk }}</td>
                    <td class="px-4 py-3 text-sm">{{ $krs->kelas->mataKuliah->nama_mk }}</td>
                    <td class="px-4 py-3 text-sm">{{ $krs->kelas->mataKuliah->sks }}</td>
                    <td class="px-4 py-3 text-sm">{{ $krs->kelas->nama_kelas }}</td>
                    <td class="px-4 py-3 text-sm">{{ $krs->kelas->dosen->user->username }}</td>
                    <td class="px-4 py-3 text-sm">
                        <span class="px-2 py-1 rounded text-xs font-semibold
                            @if($krs->status == 'draft') bg-gray-200 text-gray-700
                            @elseif($krs->status == 'diajukan') bg-yellow-200 text-yellow-700
                            @elseif($krs->status == 'disetujui') bg-green-200 text-green-700
                            @else bg-red-200 text-red-700 @endif">
                            {{ ucfirst($krs->status) }}
                        </span>
                    </td>
                    <td class="px-4 py-3 text-sm">
                        @if($krs->status == 'draft')
                            <form method="POST" action="{{ route('mahasiswa.krs.destroy', $krs->id) }}" class="inline">
                                @csrf
                                @method('DELETE')
                                <button class="text-red-600 hover:text-red-800" onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                            </form>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="px-4 py-8 text-center text-gray-500">Belum ada mata kuliah yang diambil</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div class="bg-white rounded-lg shadow-md p-6">
    <h3 class="text-lg font-semibold mb-4">Daftar Mata Kuliah Tersedia</h3>
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Kode MK</th>
                    <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Mata Kuliah</th>
                    <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">SKS</th>
                    <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Kelas</th>
                    <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Dosen</th>
                    <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Kapasitas</th>
                    <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse($kelasTersedia as $kelas)
                <tr>
                    <td class="px-4 py-3 text-sm">{{ $kelas->mataKuliah->kode_mk }}</td>
                    <td class="px-4 py-3 text-sm">{{ $kelas->mataKuliah->nama_mk }}</td>
                    <td class="px-4 py-3 text-sm">{{ $kelas->mataKuliah->sks }}</td>
                    <td class="px-4 py-3 text-sm">{{ $kelas->nama_kelas }}</td>
                    <td class="px-4 py-3 text-sm">{{ $kelas->dosen->user->username }}</td>
                    <td class="px-4 py-3 text-sm">{{ $kelas->jumlah_mahasiswa }}/{{ $kelas->kapasitas }}</td>
                    <td class="px-4 py-3 text-sm">
                        <form method="POST" action="{{ route('mahasiswa.krs.store') }}">
                            @csrf
                            <input type="hidden" name="kelas_id" value="{{ $kelas->id }}">
                            <button class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-1 rounded text-xs transition">
                                Ambil
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="px-4 py-8 text-center text-gray-500">Tidak ada kelas tersedia</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
