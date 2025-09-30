<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('khs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('mahasiswa_id')->constrained('mahasiswa')->onDelete('cascade');
            $table->foreignId('tahun_akademik_id')->constrained('tahun_akademik')->onDelete('cascade');
            $table->decimal('ip_semester', 3, 2)->nullable(); // IPS
            $table->decimal('ip_kumulatif', 3, 2)->nullable(); // IPK
            $table->integer('total_sks_semester')->default(0);
            $table->integer('total_sks_kumulatif')->default(0);
            $table->timestamps();

            $table->unique(['mahasiswa_id', 'tahun_akademik_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('khs');
    }
};
