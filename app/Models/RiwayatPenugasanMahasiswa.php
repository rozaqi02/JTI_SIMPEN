<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RiwayatPenugasanMahasiswa extends Model
{
    use HasFactory;

    protected $table = 't_riwayat_tugas'; // Nama tabel yang sesuai dengan tabel di database

    protected $primaryKey = 'id_riwayat_tugas';
    public $incrementing = true;
    public $timestamps = true;

    protected $fillable = ['id_riwayat_tugas', 'nama_penugasan', 'tanggal_mulai', 'tanggal_selesai']; // Kolom yang dapat diisi
}
