<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TendikModel extends Model
{
    use HasFactory;

    // Tentukan nama tabel jika tidak mengikuti konvensi penamaan
    protected $table = 'm_tendik';

    // Tentukan kolom yang bisa diisi
    protected $fillable = [
        'id_user',
        'nip',
        'email',
        'nama_tendik',
        'no_telepon',
    ];

    // Relasi dengan User (Many-to-One)
    public function user()
    {
        return $this->belongsTo(UserModel::class, 'id_user', 'id_user');
    }
}
