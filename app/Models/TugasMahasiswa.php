<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TugasMahasiswa extends Model
{
    use HasFactory;

    protected $table = 'm_detail_tugas'; // Nama tabel yang sesuai dengan tabel di database
    protected $fillable = ['id_detail_tugas', 'nama_tugas', 'deskripsi_tugas', 'kuota', 'nilai_kompen' ,'jumlah_jam ']; // Kolom yang dapat diisi
}
