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
        Schema::create('m_tugas', function (Blueprint $table) {
            $table->id('id_tugas'); // Primary key
            $table->unsignedBigInteger('id_detail_tugas'); // 
            $table->foreign('id_detail_tugas')->references('id_detail_tugas')->on('m_detail_tugas')->onDelete('cascade');
            $table->unsignedBigInteger('id_alpa');
            $table->foreign('id_alpa')->references('id_alpa')->on('t_alpa')->onDelete('cascade');
            $table->string('progress_tugas', 50); // Progress tugas
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('m_tugas_pendidik');
    }
};
