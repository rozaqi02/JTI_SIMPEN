<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProgressTugas extends Model
{
    use HasFactory;

    protected $table = 'm_detail_tugas'; // Nama tabel yang sesuai dengan tabel di database
    protected $fillable = ['id_detail_tugas', 'status_progress', 'deskripsi', 'tanggal_update']; // Kolom yang dapat diisi
}
