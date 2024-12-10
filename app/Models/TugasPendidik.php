<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TugasPendidik extends Model
{
    use HasFactory;

    protected $table = 'm_detail_tugas'; // Table name in the database
    protected $primaryKey = 'id_detail_tugas'; // Primary key of the table
    public $incrementing = false; // If the id_detail_tugas uses UUID or a non-incrementing value
    public $timestamps = true; // Use created_at and updated_at columns

    protected $fillable = [
        'id_detail_tugas',
        'id_user',
        'id_jenis_kompen',
        'nama_tugas',
        'deskripsi_tugas',
        'kuota',
        'nilai_kompen',
        'jumlah_jam',
    ];

    // Relationship with the 'm_user' model (assuming it's another model)
    public function user()
    {
        return $this->belongsTo(UserModel::class, 'id_user'); // Menggunakan relasi belongsTo
    }

    // Definisikan relasi dengan JenisKompenModel
    public function jenisKompen()
    {
        return $this->belongsTo(JenisKompen::class, 'id_jenis_kompen'); // Menggunakan relasi belongsTo
    }
}
    

