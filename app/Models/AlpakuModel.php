<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AlpakuModel extends Model
{
    use HasFactory;

    protected $table = 't_alpa'; // Nama tabel yang digunakan

    protected $fillable = [
        'id_mahasiswa',
        'id_periode',
        'jam_alpa',
    ];

    // Relasi dengan model Mahasiswa
    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'id_mahasiswa');
    }
}