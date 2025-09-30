<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dosen extends Model
{
    use HasFactory;
    protected $table = 'dosen';
    protected $fillable = ['user_id', 'nidn', 'program_studi_id', 'telepon'];

    public function jadwal() {
        return $this->hasMany(JadwalKuliah::class);
    }
    public function programStudi()
{
    return $this->belongsTo(ProgramStudi::class, 'program_studi_id');
}

}
