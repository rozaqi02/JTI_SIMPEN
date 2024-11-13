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
        Schema::create('t_progress_tugas', function (Blueprint $table) {
            $table->id('id_tugas'); // Primary key
            $table->unsignedBigInteger('id_mahasiswa'); // Foreign key ke tabel mahasiswa
            $table->string('pemberi_tugas', 30); // Nama pemberi tugas
            $table->decimal('statusTugas', 5, 2); // Status tugas dalam format decimal
            $table->string('judul_tugas', 30); // Judul tugas
            $table->enum('jenis_tugas', ['pengabdian', 'penelitian', 'teknis']); // Enum untuk jenis tugas
            $table->string('progress_tugas', 50); // Progress tugas
            $table->integer('jumlah_jam'); // Jumlah jam yang dihabiskan
        
            // Menambahkan foreign key constraint
            $table->foreign('id_mahasiswa')->references('id_mahasiswa')->on('m_mahasiswa')->onDelete('cascade');
            
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('t_progress_tugas');
    }
};
