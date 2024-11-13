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
        Schema::create('m_mahasiswa', function (Blueprint $table) {
            $table->id('id_mahasiswa'); // Primary key
            $table->unsignedBigInteger('kategori_user_id'); // Foreign key ke tabel t_kategori_user
            $table->enum('level', ['admin', 'user']); // Enum untuk level
            $table->string('email'); // Email mahasiswa
            $table->string('password'); // Password mahasiswa
            $table->integer('nim'); // Nomor induk mahasiswa
            $table->string('foto'); // Foto mahasiswa
            $table->integer('jumlah_alpa'); // Jumlah alpa mahasiswa
            $table->string('nama_bidkom'); // Nama bidang komunikasi
            
            // Menambahkan foreign key constraint
            $table->foreign('kategori_user_id')->references('kategori_user_id')->on('t_kategori_user')->onDelete('cascade');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('m_mahasiswa');
    }
};
