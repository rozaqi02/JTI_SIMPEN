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
        Schema::create('m_user', function (Blueprint $table) {
            $table->id('id_user'); // Primary key
            $table->unsignedBigInteger('level_id'); // Foreign key
            $table->string('username'); // username
            $table->string('password'); // Password
            $table->string('foto'); // Foto pengguna

            // Menambahkan foreign key constraint
            $table->foreign('level_id')->references('level_id')->on('m_level');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('m_user');
    }
};
	  