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
        Schema::create('mata_kuliah', function (Blueprint $table) {
            $table->id();
            $table->string('kode_mk', 10)->unique();
            $table->string('nama_mk');
            $table->integer('sks');
            $table->integer('semester'); // Semester berapa MK ini diajarkan
            $table->foreignId('program_studi_id')->constrained('program_studi');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('mata_kuliah');
    }
};
