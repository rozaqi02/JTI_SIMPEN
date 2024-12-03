<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MahasiswaModel extends Model
{
    use HasFactory;

    // Relasi banyak-tugas
    public function tugas()
    {
        return $this->belongsToMany(Tugas::class, 'tugas_mahasiswa', 'mahasiswa_id', 'tugas_id');
    }

    // Relasi ke tabel user
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
