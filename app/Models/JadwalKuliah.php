<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JadwalKuliah extends Model
{
    use HasFactory;
    protected $table = 'jadwal_kuliah';
    protected $fillable = ['tahun_akademik_id','mata_kuliah_id', 'dosen_id', 'kelas_id', 'hari', 'jam_mulai', 'jam_selesai', 'ruangan'];

    public function mataKuliah() {
        return $this->belongsTo(MataKuliah::class);
    }

    public function dosen() {
        return $this->belongsTo(Dosen::class);
    }

    public function kelas() {
        return $this->belongsTo(Kelas::class);
    }
}
