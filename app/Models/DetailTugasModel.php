<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailTugasModel extends Model
{
    use HasFactory;

    // Tentukan nama tabel yang digunakan (jika tidak sesuai dengan konvensi Laravel)
    protected $table = 'm_detail_tugas';

    // Tentukan primary key tabel
    protected $primaryKey = 'id_detail_tugas';

    // Tentukan kolom yang dapat diisi secara massal (fillable)
    protected $fillable = [
        'id_user', 
        'id_jenis_kompen',
        'nama_tugas', 
        'deskripsi_tugas',
        'kuota',
        'nilai_kompen',
        'jumlah_jam',
    ];

    // Jika Anda menggunakan auto-increment dan tidak ingin memasukkan 'id_bidkom', tidak perlu mendeklarasikan 'id_bidkom' di sini.
    public $incrementing = true;

    // Jika Anda tidak menggunakan timestamp 'created_at' dan 'updated_at' dalam tabel, atur ke false
    public $timestamps = true;
}
