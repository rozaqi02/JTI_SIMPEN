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
            $table->dateTime('tanggal_dilaksanakan'); // Tanggal pelaksanaan tugas
            $table->dateTime('tanggal_selesai'); // Tanggal selesai tugas
            $table->boolean('status'); // Status tugas (selesai/aktif)

            // Menambahkan foreign key constraint
            $table->foreign('id_tugas')->references('id_tugas')->on('m_tugas')->onDelete('cascade');
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
