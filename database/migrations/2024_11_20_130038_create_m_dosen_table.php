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
        Schema::create('m_dosen', function (Blueprint $table) {
            $table->id('id_dosen'); // Primary key
            $table->unsignedBigInteger('id_user'); // Foreign key
            $table->string('nip',20)->unique(); // NIP
            $table->string('email'); // Email
            $table->string('nama_dosen'); // nama
            $table->string('no_telepon'); // Nomor telepon

            // Menambahkan foreign key constraint
            $table->foreign('id_user')->references('id_user')->on('m_user');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('m_dosen');
    }
};
