<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
// use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
// use App\Models\User;
use App\Models\ProgramStudi;
use App\Models\Mahasiswa;
use App\Models\Dosen;
use App\Models\MataKuliah;
use App\Models\TahunAkademik;
use App\Models\Kelas;
use App\Models\JadwalKuliah;
use App\Models\Krs;
use App\Models\Nilai;
use App\Models\Khs;
use App\Models\PembimbingAkademik;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Program Studi
        $prodi1 = ProgramStudi::create([
            'kode_prodi' => 'TI',
            'nama_prodi' => 'Teknik Informatika',
            'jenjang' => 'S1'
        ]);

        $prodi2 = ProgramStudi::create([
            'kode_prodi' => 'SI',
            'nama_prodi' => 'Sistem Informasi',
            'jenjang' => 'S1'
        ]);

        // 2. Tahun Akademik
        $tahunAkademik = TahunAkademik::create([
            'kode_tahun' => '2024/2025',
            'semester' => 'ganjil',
            'tanggal_mulai' => '2024-09-01',
            'tanggal_selesai' => '2025-01-31',
            'is_active' => true
        ]);

        // 3. Admin BAAK
        User::create([
            'username' => 'admin',
            'email' => 'admin@iqraburu.ac.id',
            'password' => Hash::make('admin123'),
            'role' => 'admin_baak',
            'is_active' => true
        ]);

        // 4. Dosen
        $userDosen1 = User::create([
            'username' => 'dosen1',
            'email' => 'dosen1@iqraburu.ac.id',
            'password' => Hash::make('dosen123'),
            'role' => 'dosen',
            // 'nama_lengkap' => 'Dr. Ahmad Fauzi, M.Kom',
            'is_active' => true
        ]);

        $dosen1 = Dosen::create([
            'user_id' => $userDosen1->id,
            'nidn' => '0123456789',
            'program_studi_id' => $prodi1->id,
            'telepon' => '081234567890'
        ]);

        $userDosen2 = User::create([
            'username' => 'dosen2',
            'email' => 'dosen2@iqraburu.ac.id',
            'password' => Hash::make('dosen123'),
            'role' => 'dosen',
            // 'nama_lengkap' => 'Prof. Siti Nurhaliza, M.T',
            'is_active' => true
        ]);

        $dosen2 = Dosen::create([
            'user_id' => $userDosen2->id,
            'nidn' => '0987654321',
            'program_studi_id' => $prodi1->id,
            'telepon' => '081234567891'
        ]);

        // 5. Mahasiswa
        $userMhs1 = User::create([
            'username' => 'mahasiswa1',
            'email' => 'mahasiswa1@iqraburu.ac.id',
            'password' => Hash::make('mhs123'),
            'role' => 'mahasiswa',
            // 'nama_lengkap' => 'Budi Santoso',
            'is_active' => true
        ]);

        $mahasiswa1 = Mahasiswa::create([
            'user_id' => $userMhs1->id,
            'nim' => '2021001',
            'program_studi_id' => $prodi1->id,
            'angkatan' => '2021',
            'semester_aktif' => 5,
            'telepon' => '082134567890',
            'alamat' => 'Jl. Kampus No. 1, Buru'
        ]);

        $userMhs2 = User::create([
            'username' => 'mahasiswa2',
            'email' => 'mahasiswa2@iqraburu.ac.id',
            'password' => Hash::make('mhs123'),
            'role' => 'mahasiswa',
            // 'nama_lengkap' => 'Dewi Lestari',
            'is_active' => true
        ]);

        $mahasiswa2 = Mahasiswa::create([
            'user_id' => $userMhs2->id,
            'nim' => '2021002',
            'program_studi_id' => $prodi1->id,
            'angkatan' => '2021',
            'semester_aktif' => 5,
            'telepon' => '082134567891',
            'alamat' => 'Jl. Kampus No. 2, Buru'
        ]);

        $userMhs3 = User::create([
            'username' => 'mahasiswa3',
            'email' => 'mahasiswa3@iqraburu.ac.id',
            'password' => Hash::make('mhs123'),
            'role' => 'mahasiswa',
            // 'nama_lengkap' => 'Andi Wijaya',
            'is_active' => true
        ]);

        $mahasiswa3 = Mahasiswa::create([
            'user_id' => $userMhs3->id,
            'nim' => '2021003',
            'program_studi_id' => $prodi1->id,
            'angkatan' => '2021',
            'semester_aktif' => 5,
            'telepon' => '082134567892',
            'alamat' => 'Jl. Kampus No. 3, Buru'
        ]);

        // 6. Mata Kuliah
        $mk1 = MataKuliah::create([
            'kode_mk' => 'TI101',
            'nama_mk' => 'Pemrograman Web',
            'sks' => 3,
            'semester' => 5,
            'program_studi_id' => $prodi1->id
        ]);

        $mk2 = MataKuliah::create([
            'kode_mk' => 'TI102',
            'nama_mk' => 'Basis Data',
            'sks' => 4,
            'semester' => 5,
            'program_studi_id' => $prodi1->id
        ]);

        $mk3 = MataKuliah::create([
            'kode_mk' => 'TI103',
            'nama_mk' => 'Jaringan Komputer',
            'sks' => 3,
            'semester' => 5,
            'program_studi_id' => $prodi1->id
        ]);

        $mk4 = MataKuliah::create([
            'kode_mk' => 'TI104',
            'nama_mk' => 'Algoritma dan Struktur Data',
            'sks' => 3,
            'semester' => 5,
            'program_studi_id' => $prodi1->id
        ]);

        // 7. Kelas
        $kelas1 = Kelas::create([
            'mata_kuliah_id' => $mk1->id,
            'dosen_id' => $dosen1->id,
            'tahun_akademik_id' => $tahunAkademik->id,
            'nama_kelas' => 'A',
            'kapasitas' => 40,
            'jumlah_mahasiswa' => 3
        ]);

        $kelas2 = Kelas::create([
            'mata_kuliah_id' => $mk2->id,
            'dosen_id' => $dosen2->id,
            'tahun_akademik_id' => $tahunAkademik->id,
            'nama_kelas' => 'A',
            'kapasitas' => 40,
            'jumlah_mahasiswa' => 3
        ]);

        $kelas3 = Kelas::create([
            'mata_kuliah_id' => $mk3->id,
            'dosen_id' => $dosen1->id,
            'tahun_akademik_id' => $tahunAkademik->id,
            'nama_kelas' => 'B',
            'kapasitas' => 35,
            'jumlah_mahasiswa' => 2
        ]);

        $kelas4 = Kelas::create([
            'mata_kuliah_id' => $mk4->id,
            'dosen_id' => $dosen2->id,
            'tahun_akademik_id' => $tahunAkademik->id,
            'nama_kelas' => 'A',
            'kapasitas' => 40,
            'jumlah_mahasiswa' => 0
        ]);
        $kelas5 = Kelas::create([
            'mata_kuliah_id' => $mk2->id,
            'dosen_id' => $dosen2->id,
            'tahun_akademik_id' => $tahunAkademik->id,
            'nama_kelas' => 'B',
            'kapasitas' => 30,
            'jumlah_mahasiswa' => 0
        ]);

        // 8. Jadwal Kuliah
        JadwalKuliah::create([
            'tahun_akademik_id' => $tahunAkademik->id,
            'mata_kuliah_id' => $mk1->id,     // Add this
            'dosen_id' => $dosen1->id,        // Add this
            'kelas_id' => $kelas1->id,
            'hari' => 'Senin',
            'jam_mulai' => '08:00',
            'jam_selesai' => '10:30',
            'ruangan' => 'R.101'
        ]);

        JadwalKuliah::create([
            'tahun_akademik_id' => $tahunAkademik->id,
            'mata_kuliah_id' => $mk2->id,     // Add this
            'dosen_id' => $dosen2->id,        // Add this
            'kelas_id' => $kelas2->id,
            'hari' => 'Selasa',
            'jam_mulai' => '10:00',
            'jam_selesai' => '12:30',
            'ruangan' => 'R.102'
        ]);

        JadwalKuliah::create([
            'tahun_akademik_id' => $tahunAkademik->id,
            'mata_kuliah_id' => $mk3->id,     // Add this
            'dosen_id' => $dosen1->id,        // Add this
            'kelas_id' => $kelas3->id,
            'hari' => 'Rabu',
            'jam_mulai' => '13:00',
            'jam_selesai' => '15:30',
            'ruangan' => 'Lab Jaringan'
        ]);

        JadwalKuliah::create([
            'tahun_akademik_id' => $tahunAkademik->id,
            'mata_kuliah_id' => $mk4->id,     // Add this
            'dosen_id' => $dosen2->id,        // Add this
            'kelas_id' => $kelas4->id,
            'hari' => 'Kamis',
            'jam_mulai' => '08:00',
            'jam_selesai' => '10:30',
            'ruangan' => 'R.103'
        ]);

        JadwalKuliah::create([
            'tahun_akademik_id' => $tahunAkademik->id,
            'mata_kuliah_id' => $mk2->id,     // Add this
            'dosen_id' => $dosen2->id,        // Add this
            'kelas_id' => $kelas5->id,
            'hari' => 'Jumat',
            'jam_mulai' => '08:00',
            'jam_selesai' => '10:30',
            'ruangan' => 'R.105'
        ]);
        // 9. KRS Mahasiswa 1
        $krs1_1 = Krs::create([
            'mahasiswa_id' => $mahasiswa1->id,
            'kelas_id' => $kelas1->id,
            'tahun_akademik_id' => $tahunAkademik->id,
            'status' => 'disetujui'
        ]);

        $krs1_2 = Krs::create([
            'mahasiswa_id' => $mahasiswa1->id,
            'kelas_id' => $kelas2->id,
            'tahun_akademik_id' => $tahunAkademik->id,
            'status' => 'disetujui'
        ]);

        // 10. KRS Mahasiswa 2
        $krs2_1 = Krs::create([
            'mahasiswa_id' => $mahasiswa2->id,
            'kelas_id' => $kelas1->id,
            'tahun_akademik_id' => $tahunAkademik->id,
            'status' => 'disetujui'
        ]);

        $krs2_2 = Krs::create([
            'mahasiswa_id' => $mahasiswa2->id,
            'kelas_id' => $kelas2->id,
            'tahun_akademik_id' => $tahunAkademik->id,
            'status' => 'disetujui'
        ]);

        $krs2_3 = Krs::create([
            'mahasiswa_id' => $mahasiswa2->id,
            'kelas_id' => $kelas3->id,
            'tahun_akademik_id' => $tahunAkademik->id,
            'status' => 'disetujui'
        ]);

        // 11. KRS Mahasiswa 3
        $krs3_1 = Krs::create([
            'mahasiswa_id' => $mahasiswa3->id,
            'kelas_id' => $kelas1->id,
            'tahun_akademik_id' => $tahunAkademik->id,
            'status' => 'disetujui'
        ]);

        $krs3_2 = Krs::create([
            'mahasiswa_id' => $mahasiswa3->id,
            'kelas_id' => $kelas2->id,
            'tahun_akademik_id' => $tahunAkademik->id,
            'status' => 'disetujui'
        ]);

        $krs3_3 = Krs::create([
            'mahasiswa_id' => $mahasiswa3->id,
            'kelas_id' => $kelas3->id,
            'tahun_akademik_id' => $tahunAkademik->id,
            'status' => 'disetujui'
        ]);

        // 12. Nilai (Contoh)
        Nilai::create([
            'krs_id' => $krs1_1->id,
            'nilai_angka' => 88.50,
            'nilai_huruf' => 'A',
            'nilai_bobot' => 4.00
        ]);

        Nilai::create([
            'krs_id' => $krs1_2->id,
            'nilai_angka' => 75.00,
            'nilai_huruf' => 'B',
            'nilai_bobot' => 3.00
        ]);

        Nilai::create([
            'krs_id' => $krs2_1->id,
            'nilai_angka' => 92.00,
            'nilai_huruf' => 'A',
            'nilai_bobot' => 4.00
        ]);

        // 13. KHS (Contoh)
        Khs::create([
            'mahasiswa_id' => $mahasiswa1->id,
            'tahun_akademik_id' => $tahunAkademik->id,
            'ip_semester' => 3.50,
            'ip_kumulatif' => 3.45,
            'total_sks_semester' => 7,
            'total_sks_kumulatif' => 80
        ]);

        Khs::create([
            'mahasiswa_id' => $mahasiswa2->id,
            'tahun_akademik_id' => $tahunAkademik->id,
            'ip_semester' => 3.75,
            'ip_kumulatif' => 3.68,
            'total_sks_semester' => 10,
            'total_sks_kumulatif' => 82
        ]);

        // 14. Pembimbing Akademik
        $mahasiswa1PA = PembimbingAkademik::create([
            'mahasiswa_id' => $mahasiswa1->id,
            'dosen_id' => $dosen1->id,
            'tahun_akademik_id' => $tahunAkademik->id,
            'is_active' => true
        ]);

        $mahasiswa2PA = PembimbingAkademik::create([
            'mahasiswa_id' => $mahasiswa2->id,
            'dosen_id' => $dosen2->id,
            'tahun_akademik_id' => $tahunAkademik->id,
            'is_active' => true
        ]);

        $mahasiswa3PA = PembimbingAkademik::create([
            'mahasiswa_id' => $mahasiswa3->id,
            'dosen_id' => $dosen1->id,
            'tahun_akademik_id' => $tahunAkademik->id,
            'is_active' => true
        ]);

        echo "✅ Database seeder berhasil dijalankan!\n";
        echo "\n📝 Akun Login:\n";
        echo "Admin BAAK: username=admin, password=admin123\n";
        echo "Dosen 1: username=dosen1, password=dosen123\n";
        echo "Dosen 2: username=dosen2, password=dosen123\n";
        echo "Mahasiswa 1: username=mahasiswa1, password=mhs123\n";
        echo "Mahasiswa 2: username=mahasiswa2, password=mhs123\n";
        echo "Mahasiswa 3: username=mahasiswa3, password=mhs123\n";

    }
}
