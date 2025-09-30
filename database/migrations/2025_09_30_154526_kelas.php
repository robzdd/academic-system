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
        Schema::create('kelas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('mata_kuliah_id')->constrained('mata_kuliah')->onDelete('cascade');
            $table->foreignId('dosen_id')->constrained('dosen')->onDelete('cascade');
            $table->foreignId('tahun_akademik_id')->constrained('tahun_akademik')->onDelete('cascade');
            $table->string('nama_kelas'); // A, B, C, dll
            $table->integer('kapasitas')->default(40);
            $table->integer('jumlah_mahasiswa')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kelas');
    }
};
