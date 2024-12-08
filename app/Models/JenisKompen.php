<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisKompen extends Model
{
    use HasFactory;

    protected $table = 'm_jenis_kompen'; // Nama tabel yang sesuai dengan tabel di database
    protected $fillable = ['jenis_tugas', 'nama_jenis_tugas']; // Kolom yang dapat diisi
}