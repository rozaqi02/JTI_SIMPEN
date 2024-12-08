<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MahasiswaModel extends Model
{
    use HasFactory;

    protected $table = 'm_mahasiswa'; // Nama tabel yang sesuai dengan tabel di database
    protected $primaryKey = 'id_mahasiswa'; // Kolom primary key sesuai tabel
    protected $fillable = ['id_mahasiswa', 'nama_mahasiswa', 'nim', 'program_studi', 'foto']; // Kolom yang dapat diisi
}


