<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTRiwayatPenugasanTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('t_riwayat_penugasan_mahasiswa', function (Blueprint $table) {
            $table->id('id_riwayat'); // Primary key
            $table->unsignedBigInteger('id_tugas'); // Foreign key ke tabel tugas
            $table->unsignedBigInteger('id_mahasiswa'); // Foreign key ke tabel mahasiswa
            $table->string('pemberi_tugas', 30); // Nama pemberi tugas
            $table->string('judul_tugas', 30); // Judul tugas
            $table->enum('jenis_tugas', ['pengabdian', 'penelitian', 'teknis']); // Enum untuk jenis tugas
            $table->string('jumlah_jam', 30); // Jumlah jam yang dihabiskan (varchar 30)
            $table->dateTime('tanggal_dilaksanakan'); // Tanggal pelaksanaan tugas
            $table->dateTime('tanggal_selesai'); // Tanggal selesai tugas
            $table->boolean('status'); // Status tugas (selesai/aktif)

            // Menambahkan foreign key constraint
            $table->foreign('id_tugas')->references('id_tugas')->on('t_progress_tugas')->onDelete('cascade');
            $table->foreign('id_mahasiswa')->references('id_mahasiswa')->on('m_mahasiswa')->onDelete('cascade');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('t_riwayat_penugasan_mahasiswa');
    }
}