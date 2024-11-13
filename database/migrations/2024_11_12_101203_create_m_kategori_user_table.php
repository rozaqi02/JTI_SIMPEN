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
        Schema::create('t_kategori_user', function (Blueprint $table) {
            $table->id('kategori_user_id'); // Primary key
            $table->string('kategori_user_kode', 10)->unique(); // Unique code for kategori_user
            $table->enum('kategori_nama', ['dosen', 'mahasiswa', 'tendik', 'admin']); // Enum for kategori nama
            $table->enum('level', ['admin', 'user']); // Enum for user level
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('m_kategori_user');
    }
};
