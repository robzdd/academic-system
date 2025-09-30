<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Khs extends Model
{
    use HasFactory;

    protected $table = 'khs';
    protected $fillable = ['mahasiswa_id', 'tahun_akademik_id', 'ip_semester', 'ip_kumulatif', 'total_sks_semester', 'total_sks_kumulatif', 'total_sks_kumulatif'];

    public function mahasiswa() {
        return $this->belongsTo(Mahasiswa::class);
    }
}
