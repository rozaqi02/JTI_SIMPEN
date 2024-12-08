<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisKompen extends Model
{
    use HasFactory;

    protected $table = 'm_jenis_kompen'; // Nama tabel yang sesuai dengan tabel di database
    protected $fillable = ['id_jenis_kompen', 'nama_jenis_kompen']; // Kolom yang dapat diisi
}