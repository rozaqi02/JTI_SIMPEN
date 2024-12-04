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
            $table->id('id_bidkom');
            $table->string('kode_bidkom', 10)->unique(); // Unique code for kategori_user
            $table->string('nama_bidkom');
            $table->timestamps();
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
