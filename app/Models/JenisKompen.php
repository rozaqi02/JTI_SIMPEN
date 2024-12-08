<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisKompen extends Model
{
    use HasFactory;

    // Tentukan nama tabel yang digunakan (jika tidak sesuai dengan konvensi Laravel)
    protected $table = 'm_jenis_kompen'; // Nama tabel di database

    // Tentukan primary key tabel (jika tidak menggunakan 'id')
    protected $primaryKey = 'id_jenis_kompen';

    // Tentukan kolom yang dapat diisi secara massal (fillable)
    protected $fillable = [
        'nama_jenis_kompen' // Kolom yang dapat diisi
    ];

    // Jika Anda menggunakan auto-increment dan tidak ingin memasukkan 'id_jenis_kompen', tidak perlu mendeklarasikan 'id_jenis_kompen' di sini
    public $incrementing = true;

    // Jika Anda tidak menggunakan timestamp 'created_at' dan 'updated_at' dalam tabel, atur ke false
    public $timestamps = true;
}
