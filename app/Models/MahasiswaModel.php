<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MahasiswaModel extends Model
{
    use HasFactory;

    // Nama tabel dalam database
    protected $table = 'm_mahasiswa';

    // Primary key tabel
    protected $primaryKey = 'id_mahasiswa';

    // Jika primary key bukan auto increment
    public $incrementing = false;

    // Tipe data primary key
    protected $keyType = 'bigint';

    // Kolom yang bisa diisi
    protected $fillable = [
        'id_user',
        'id_bidkom',
        'nama_mahasiswa',
        'nim',
        'email',
        'no_telepon',
        'program_studi',
        'tahun_masuk',
    ];

    // Relasi dengan User (Many-to-One)
    public function user()
    {
        return $this->belongsTo(UserModel::class, 'id_user', 'id_user');
    }

    // Relasi dengan Detail Bidkom (One-to-Many)
    public function detailBidkom()
    {
        return $this->hasMany(DetailBidkomModel::class, 'id_mahasiswa', 'id_mahasiswa');
    }

    // Relasi dengan Alpaku (One-to-Many)
    public function alpaku()
    {
        return $this->hasMany(AlpakuModel::class, 'id_mahasiswa', 'id_mahasiswa');
    }
}
