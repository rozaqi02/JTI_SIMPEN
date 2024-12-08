<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DosenModel extends Model
{
    use HasFactory;

    protected $table = 'm_dosen'; // Nama tabel yang sesuai dengan tabel di database
    protected $fillable = ['id_dosen', 'nip','email','nama_dosen', 'no_telepon']; // Kolom yang dapat diisi
}

