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
        Schema::create('t_qr_code', function (Blueprint $table) {
            $table->string('id_QRCode')->primary(); // Primary key dengan tipe string
            $table->unsignedBigInteger('id_tugas'); // Foreign key ke tabel tugas
            $table->unsignedBigInteger('id_mahasiswa'); // Foreign key ke tabel mahasiswa
            $table->string('deskripsi_qrcode'); // Deskripsi QR code
            $table->string('image_qrcode'); // Nama file gambar QR code
            $table->dateTime('mulai_berlaku'); // Tanggal mulai berlaku
            $table->dateTime('akhir_berlaku'); // Tanggal akhir berlaku
            $table->enum('status', ['selesai', 'aktif']); // Enum untuk status QR code

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
        Schema::dropIfExists('t_qr_code');
    }
};