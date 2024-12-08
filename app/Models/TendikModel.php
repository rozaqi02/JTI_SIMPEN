<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TendikModel extends Model
{
    use HasFactory;

    protected $table = 'm_tendik'; // Nama tabel yang sesuai dengan tabel di database
    protected $fillable = ['id_tendik', 'nip','email','nama_tendik', 'no_telepon']; // Kolom yang dapat diisi
}

