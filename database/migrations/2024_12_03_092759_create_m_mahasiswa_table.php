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
            $table->unsignedBigInteger('id_user'); // Foreign key ke tabel m_user
            $table->unsignedBigInteger('id_bidkom');
            $table->string('nim', 20)->unique(); // Nomor induk mahasiswa
            $table->string('email'); // Email mahasiswa
            $table->string('nama_mahasiswa', 100); // Nama mahasiswa
            $table->string('prodi', 100); // Jumlah alpa mahasiswa
            $table->string('tahun_masuk'); // Foto mahasiswa   
            $table->integer('jumlah_alpa'); // Jumlah alpa mahasiswa
            
            $table->timestamps();
            
            // Menambahkan foreign key constraint
            $table->foreign('id_user')->references('id_user')->on('m_user');
            $table->foreign('id_bidkom')->references('id_bidkom')->on('t_bidkom');
            
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
