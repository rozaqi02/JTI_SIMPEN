<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProgressTugas extends Model
{
    use HasFactory;

    protected $table = 't_progress_tugas'; // Nama tabel yang sesuai dengan tabel di database
    protected $fillable = ['id_tugas', 'status_progress', 'deskripsi', 'tanggal_update']; // Kolom yang dapat diisi
}
