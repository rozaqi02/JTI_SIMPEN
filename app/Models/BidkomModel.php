<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BidkomModel extends Model
{
    use HasFactory;

    // Tentukan nama tabel yang digunakan (jika tidak sesuai dengan konvensi Laravel)
    protected $table = 't_bidkom';

    // Tentukan primary key tabel
    protected $primaryKey = 'id_bidkom';

    // Tentukan kolom yang dapat diisi secara massal (fillable)
    protected $fillable = [
        'kode_bidkom', 
        'nama_bidkom'
    ];

    // Jika Anda menggunakan auto-increment dan tidak ingin memasukkan 'id_bidkom', tidak perlu mendeklarasikan 'id_bidkom' di sini.
    public $incrementing = true;

    // Jika Anda tidak menggunakan timestamp 'created_at' dan 'updated_at' dalam tabel, atur ke false
    public $timestamps = true;
}
