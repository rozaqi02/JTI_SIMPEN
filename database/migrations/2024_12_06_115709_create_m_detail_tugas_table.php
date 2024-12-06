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
        Schema::create('m_detail_tugas', function (Blueprint $table) {
            $table->id('id_detail_tugas'); // Primary key
            $table->unsignedBigInteger('id_user'); // 
            $table->foreign('id_user')->references('id_user')->on('m_user')->onDelete('cascade');
            $table->unsignedBigInteger('id_jenis_kompen');
            $table->foreign('id_jenis_kompen')->references('id_jenis_kompen')->on('m_jenis_kompen')->onDelete('cascade');
            $table->string('nama_tugas'); // Task name
            $table->text('deskripsi_tugas'); // Task description
            $table->integer('kuota'); // Task quota
            $table->integer('nilai_kompen'); // Task quota
            $table->integer('jumlah_jam'); // Hours spent on task
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('m_detail_tugas');
    }
};
