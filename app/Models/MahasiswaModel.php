<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MahasiswaModel extends Model
{
    use HasFactory;

    // Tentukan nama tabel jika tidak mengikuti konvensi penamaan
    protected $table = 'm_mahasiswa';

    // Tentukan kolom yang bisa diisi
    protected $fillable = [
        'id_user',
        'id_bidkom',
        'nama_mahasiswa',
        'nim',
        'email',
        'program_studi',
        'tahun_masuk',
    ];

    // Relasi dengan User (Many-to-One)
    public function user()
    {
        return $this->belongsTo(UserModel::class, 'id_user', 'id_user');
    }

    // Relasi dengan Bidang Komunikasi (Many-to-One)
    public function bidkom()
    {
        return $this->belongsTo(BidkomModel::class, 'id_bidkom', 'id_bidkom');
    }
    
}


