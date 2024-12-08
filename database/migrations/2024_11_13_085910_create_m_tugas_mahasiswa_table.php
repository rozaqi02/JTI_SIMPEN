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
        Schema::create('m_tugas_mahasiswa', function (Blueprint $table) {
            $table->id('id_tugas'); // Primary key
            $table->unsignedBigInteger('id_mahasiswa'); // Foreign key to m_mahasiswa table
            $table->foreign('id_mahasiswa')->references('id_mahasiswa')->on('m_mahasiswa')->onDelete('cascade');

            $table->unsignedBigInteger('id_jenis_tugas');
            $table->foreign('id_jenis_tugas')->references('id_jenis_tugas')->on('m_jenis_kompen')->onDelete('cascade');
            $table->string('pemberi_tugas', 30); // Task giver, varchar(30) as per ERD
            $table->string('nama_tugas'); // Task name
            $table->text('deskripsi_tugas'); // Task description
            $table->integer('kuota'); // Task quota
            $table->boolean('statusTugas'); // Task status (active or completed)
            $table->dateTime('deadline'); // Task deadline
            $table->integer('jumlah_jam'); // Hours spent on task
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('m_tugas_mahasiswa');
    }
};
