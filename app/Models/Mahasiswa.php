<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    use HasFactory;

    protected $table = 'mahasiswa';
    protected $fillable = ['user_id', 'nim', 'program_studi_id', 'angkatan', 'semester_aktif', 'telepeon', 'alamat'];

    public function kelas() {
        return $this->belongsTo(Kelas::class);
    }

    public function krs() {
        return $this->hasMany(Krs::class);
    }

    public function nilai() {
        return $this->hasMany(Nilai::class);
    }
    public function programStudi()
    {
        return $this->belongsTo(ProgramStudi::class, 'program_studi_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function khs()
    {
        return $this->hasMany(Khs::class);
    }

}
