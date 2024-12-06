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
        Schema::create('t_riwayat_tugas', function (Blueprint $table) {
            $table->id('id_riwayat_tugas'); // Primary key
            $table->unsignedBigInteger('id_tugas'); // Foreign key ke tabel tugas
            $table->unsignedBigInteger('id_mahasiswa'); // Foreign key ke tabel mahasiswa
            $table->unsignedBigInteger('id_detail_tugas');
            $table->unsignedBigInteger('id_jenis_kompen');
            $table->unsignedBigInteger('id_user');
            $table->string('judul_tugas', 30); // Judul tugas
            $table->string('jumlah_jam', 30); // Jumlah jam yang dihabiskan (varchar 30)
            $table->dateTime('tanggal_dilaksanakan'); // Tanggal pelaksanaan tugas
            $table->dateTime('tanggal_selesai'); // Tanggal selesai tugas
            $table->boolean('status'); // Status tugas (selesai/aktif)

            // Menambahkan foreign key constraint
            $table->foreign('id_tugas')->references('id_tugas')->on('m_tugas')->onDelete('cascade');
            $table->foreign('id_mahasiswa')->references('id_mahasiswa')->on('m_mahasiswa')->onDelete('cascade');
            $table->foreign('id_detail_tugas')->references('id_detail_tugas')->on('m_detail_tugas')->onDelete('cascade');
            $table->foreign('id_jenis_kompen')->references('id_jenis_kompen')->on('m_jenis_kompen')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('t_riwayat_tugas');
    }
};
