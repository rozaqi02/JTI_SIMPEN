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
        Schema::create('t_bidkom', function (Blueprint $table) {
            $table->id('id_bidkom'); // Primary key
            $table->string('kode_bidkom', 10); // Kolom untuk kode bidang komunikasi
            $table->string('nama_bidkom', 10); // Kolom untuk nama bidang komunikasi
            $table->timestamps(); // Kolom untuk timestamp
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('t_bidkom');
    }
};