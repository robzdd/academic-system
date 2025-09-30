<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProgramStudi extends Model
{
    use HasFactory;

    protected $table = 'program_studi';

    protected $fillable = [
        'kode',
        'nama_prodi',
        'jenjang', // S1, D3, dsb (opsional, sesuai migration Anda)
    ];

    // 🔹 Relasi ke Mahasiswa
    public function mahasiswa()
    {
        return $this->hasMany(Mahasiswa::class, 'program_studi_id');
    }

    // 🔹 Relasi ke Dosen
    public function dosen()
    {
        return $this->hasMany(Dosen::class, 'program_studi_id');
    }

    // 🔹 Relasi ke Mata Kuliah
    public function mataKuliah()
    {
        return $this->hasMany(MataKuliah::class, 'program_studi_id');
    }
}
