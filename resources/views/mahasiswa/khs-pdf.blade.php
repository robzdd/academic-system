<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; }
        .title { font-size: 18px; font-weight: bold; margin-bottom: 10px; }
        .section { margin-bottom: 12px; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #444; padding: 6px; }
        th { background: #e8f0ff; font-weight: bold; }
        .meta td { border: none; padding: 3px 0; }
        .right { text-align: right; }
        .center { text-align: center; }
    </style>
</head>
<body>
    <div class="title">Kartu Hasil Studi (KHS)</div>

    <div class="section">
        <table class="meta">
            <tr>
                <td><strong>NIM</strong>: {{ $mahasiswa->nim }}</td>
                <td><strong>Nama</strong>: {{ $user->username }}</td>
            </tr>
            <tr>
                <td><strong>Program Studi</strong>: {{ $prodi->nama_prodi }}</td>
                <td><strong>Pembimbing Akademik</strong>: {{ $pembimbingAkademik->dosen->user->username ?? '-' }}</td>
            </tr>
            <tr>
                <td><strong>Periode</strong>: {{ $khs->tahunAkademik->kode_tahun }} - Semester {{ ucfirst($khs->tahunAkademik->semester) }}</td>
                <td><strong>Angkatan</strong>: {{ $mahasiswa->angkatan }}</td>
            </tr>
        </table>
    </div>

    <div class="section">
        <table>
            <thead>
                <tr>
                    <th class="center" style="width:30px">No</th>
                    <th class="center" style="width:90px">Kode</th>
                    <th>Nama Mata Kuliah</th>
                    <th class="center" style="width:40px">SKS</th>
                    <th class="center" style="width:60px">Nilai Mutu</th>
                    <th class="center" style="width:60px">Bobot</th>
                    <th class="center" style="width:60px">Nilai</th>
                    <th class="center" style="width:80px">Keterangan</th>
                </tr>
            </thead>
            <tbody>
                @foreach($nilaiList as $i => $krs)
                <tr>
                    <td class="center">{{ $i+1 }}</td>
                    <td class="center">{{ $krs->kelas->mataKuliah->kode_mk }}</td>
                    <td>{{ $krs->kelas->mataKuliah->nama_mk }}</td>
                    <td class="center">{{ $krs->kelas->mataKuliah->sks }}</td>
                    <td class="center">{{ number_format($krs->nilai->nilai_bobot, 2) }}</td>
                    <td class="center">{{ number_format($krs->nilai->nilai_bobot * $krs->kelas->mataKuliah->sks, 0) }}</td>
                    <td class="center">{{ $krs->nilai->nilai_huruf }}</td>
                    <td class="center">{{ $krs->nilai->nilai_huruf == 'E' ? 'Tidak Lulus' : 'Lulus' }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="section">
        <table class="meta">
            <tr>
                <td><strong>Total SKS Semester</strong>: {{ $totalSksSemester }}</td>
                <td><strong>IPS</strong>: {{ number_format($ips, 2) }}</td>
            </tr>
            <tr>
                <td><strong>Total SKS Kumulatif</strong>: {{ $totalSksKumulatif }}</td>
                <td><strong>IPK</strong>: {{ number_format($ipk, 2) }}</td>
            </tr>
        </table>
    </div>
</body>
</html>
