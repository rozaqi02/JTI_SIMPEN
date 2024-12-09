<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PeriodeModel extends Model
{
    use HasFactory;

    protected $table = 't_periode'; // Nama tabel periode

    protected $fillable = [
        'nama_periode', // Kolom nama periode sesuai dengan struktur tabel di migrasi
    ];

    // Jika diperlukan, Anda bisa menambahkan relasi atau method lain sesuai kebutuhan
}
