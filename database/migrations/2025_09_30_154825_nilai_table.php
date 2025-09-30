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
        Schema::create('nilai', function (Blueprint $table) {
            $table->id();
            $table->foreignId('krs_id')->constrained('krs')->onDelete('cascade');
            $table->enum('nilai_huruf', ['A', 'B', 'C', 'D', 'E'])->nullable();
            $table->decimal('nilai_bobot', 3, 2)->nullable(); // 0.00 - 4.00
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('nilai');
    }
};
