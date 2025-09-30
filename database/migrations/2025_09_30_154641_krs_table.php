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
        Schema::create('krs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('mahasiswa_id')->constrained('mahasiswa')->onDelete('cascade');
            $table->foreignId('kelas_id')->constrained('kelas')->onDelete('cascade');
            $table->foreignId('tahun_akademik_id')->constrained('tahun_akademik')->onDelete('cascade');
            $table->enum('status', ['draft', 'diajukan', 'disetujui', 'ditolak'])->default('draft');
            $table->timestamps();

            // Mahasiswa tidak bisa mengambil kelas yang sama lebih dari sekali di tahun akademik yang sama
            $table->unique(['mahasiswa_id', 'kelas_id', 'tahun_akademik_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('krs');
    }
};
