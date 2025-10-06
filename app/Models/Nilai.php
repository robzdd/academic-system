<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nilai extends Model
{
    use HasFactory;
    protected $table = 'nilai';
    protected $fillable = ['krs_id','nilai_angka', 'nilai_huruf', 'nilai_bobot'];

    public function krs()
    {
        return $this->belongsTo(Krs::class);
    }

    // Shortcut: akses langsung ke mahasiswa lewat KRS
    public function mahasiswa()
    {
        return $this->hasOneThrough(Mahasiswa::class, Krs::class, 'id', 'id', 'krs_id', 'mahasiswa_id');
    }
}
