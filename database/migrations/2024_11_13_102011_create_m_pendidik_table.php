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
        Schema::create('m_pendidik', function (Blueprint $table) {
            $table->id('id_user'); // Primary key
            $table->unsignedBigInteger('kategori_user_id'); // Foreign key ke tabel t_kategori_user
            $table->enum('level', ['admin', 'user']); // Enum untuk level
            $table->string('username'); // username
            $table->string('nama'); // nama
            $table->string('no_telepon'); // Nomor telepon
            $table->string('email'); // Email
            $table->string('password'); // Password
            $table->enum('tipe_user', ['dosen', 'tendik', 'admin']); // Enum untuk tipe pengguna
            $table->integer('nip'); // NIP
            $table->string('foto'); // Foto pengguna

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
        Schema::dropIfExists('m_pendidik');
    }
};
	