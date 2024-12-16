<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NgambilTugas extends Model
{
    use HasFactory;

    protected $table = 'm_detail_tugas';
    protected $primaryKey = 'id_detail_tugas';
    public $incrementing = true;
    public $timestamps = true;

    protected $fillable = [
        'id_user',
        'id_jenis_kompen',
        'nama_tugas',
        'deskripsi_tugas',
        'kuota',
        'nilai_kompen'
    ];

    public function jenisKompen()
    {
        return $this->belongsTo(JenisKompen::class, 'id_jenis_kompen');
    }

    public function user()
    {
        return $this->belongsTo(UserModel::class, 'id_user'); // Menggunakan relasi belongsTo
    }
}
