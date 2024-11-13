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
        Schema::create('t_periode_alpa', function (Blueprint $table) {
            $table->id('id_periodeAlpa'); // Primary key
            $table->string('semester'); // Kolom untuk semester
            $table->integer('jumlah_alpa'); // Kolom untuk jumlah alpa
            $table->timestamps(); // Kolom untuk timestamp
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('t_periode_alpa');
    }
};