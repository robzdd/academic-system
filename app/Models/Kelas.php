<?php

namespace App\Models;

use App\Models\Mahasiswa;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Kelas extends Model
{
    use HasFactory;

    protected $table = 'kelas';
    protected $fillable = ['mata_kuliah_id', 'dosen_id', 'tahun_akademik_id','wali_dosen', 'nama_kelas', 'kapasitas', 'jumlah_mahasiswa'];

     protected $attributes = [
        'wali_dosen' => false,
        'jumlah_mahasiswa' => 0
    ];
    public function mahasiswa() {
        return $this->hasMany(Mahasiswa::class);
    }
     public function mataKuliah()
    {
        return $this->belongsTo(MataKuliah::class);
    }

    public function dosen()
    {
        return $this->belongsTo(Dosen::class);
    }

    public function krs()
    {
        return $this->hasMany(Krs::class);
    }
    public function jadwalKuliah()
    {
        return $this->hasMany(JadwalKuliah::class);
    }
}

