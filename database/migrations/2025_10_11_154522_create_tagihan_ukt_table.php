<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tagihan_ukt', function (Blueprint $table) {
            $table->id();
            $table->foreignId('mahasiswa_id')->constrained('mahasiswa')->onDelete('cascade');
            $table->string('semester', 10);
            $table->decimal('jumlah_tagihan', 12, 2);
            $table->string('order_id')->unique(); // ID unik dari Midtrans
            $table->string('payment_type')->nullable(); // contoh: bank_transfer, qris, e-wallet
            $table->string('transaction_id')->nullable(); // ID transaksi dari Midtrans
            $table->enum('status', [
                'belum_dibayar',
                'menunggu_pembayaran',
                'berhasil',
                'gagal',
                'kedaluwarsa'
            ])->default('belum_dibayar');
            $table->timestamp('tanggal_tagihan')->useCurrent();
            $table->timestamp('tanggal_pembayaran')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tagihan_ukt');
    }
};
