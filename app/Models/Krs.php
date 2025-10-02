<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Krs extends Model
{
    use HasFactory;

    protected $table = 'krs';
    protected $fillable = ['mahasiswa_id', 'mata_kuliah_id', 'tahun_akademik_id','kelas_id', 'status'];

    public function mahasiswa() {
        return $this->belongsTo(Mahasiswa::class);
    }

    public function mataKuliah() {
        return $this->belongsTo(MataKuliah::class);
    }
    // Add relationship to Kelas
    public function kelas()
    {
        return $this->belongsTo(Kelas::class);
    }
    public function nilai()
    {
        return $this->hasOne(Nilai::class);
    }
    public function tahunAkademik()
    {
        return $this->belongsTo(TahunAkademik::class);
    }
}

