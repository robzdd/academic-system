<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TahunAkademik extends Model
{
    use HasFactory;

    protected $table = 'tahun_akademik';

    protected $fillable = ['tahun', 'semester','tanggal_mulai', 'tanggal_selesai', 'is_active'];

    public function jadwalKuliah()
    {
        return $this->hasMany(JadwalKuliah::class);
    }
}
