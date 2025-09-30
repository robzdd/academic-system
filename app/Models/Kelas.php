<?php

namespace App\Models;

use App\Models\Mahasiswa;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Kelas extends Model
{
    use HasFactory;

    protected $table = 'kelas';
    protected $fillable = ['mata_kuliah_id', 'dosen_id', 'tahun_akademik_id', 'nama_kelas', 'kapasitas', 'jumlah_mahasiswa'];

    public function mahasiswa() {
        return $this->hasMany(Mahasiswa::class);
    }
}

