<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    use HasFactory;

    protected $table = 'm_mahasiswa'; // Nama tabel yang sesuai dengan tabel di database
    protected $fillable = ['id_mahasiswa', 'nama_mahasiswa', 'nim' , 'program_studi']; // Kolom yang dapat diisi
}

