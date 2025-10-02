<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MataKuliah extends Model
{
    use HasFactory;
    protected $table = "mata_kuliah";
    protected $fillable = ['kode_mk', 'nama_mk', 'sks', 'semester', 'program_studi_id'];

    public function jadwal() {
        return $this->hasMany(JadwalKuliah::class);
    }
    public function programStudi()
{
    return $this->belongsTo(ProgramStudi::class, 'program_studi_id');
}

}
