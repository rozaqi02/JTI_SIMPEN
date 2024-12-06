<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TugasMahasiswa extends Model
{
    use HasFactory;

    protected $table = 'm_tugas'; // Nama tabel yang sesuai dengan tabel di database
    protected $fillable = ['id_tugas', 'judul_tugas', 'tanggal_dibuat']; // Kolom yang dapat diisi
}
