<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminModel extends Model
{
    use HasFactory;

    protected $table = 'm_admin'; // Nama tabel yang sesuai dengan tabel di database
    protected $fillable = ['id_admin', 'nip','email','nama_admin', 'no_telepon']; // Kolom yang dapat diisi
}

