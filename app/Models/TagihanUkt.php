<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TagihanUkt extends Model
{
    use HasFactory;

    protected $table = 'tagihan_ukt';

    protected $fillable = [
        'mahasiswa_id',
        'semester',
        'jumlah_tagihan',
        'tanggal_tagihan',
        'status',
        'tanggal_pembayaran',
        'order_id',
        'payment_token',
    ];

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class);
    }
}
