<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TugasPendidik extends Model
{
    use HasFactory;

    protected $table = 'm_detail_tugas'; // Nama tabel di database
    protected $primaryKey = 'id_detail_tugas'; // Primary key tabel
    public $incrementing = false; // Non-incrementing jika id_detail_tugas menggunakan UUID
    public $timestamps = true; // Menggunakan kolom created_at dan updated_at

    protected $fillable = [
        'id_detail_tugas',
        'nama_tugas',
        'deskripsi_tugas',
        'kuota',
        'nilai_kompen',
        'jumlah_jam',
    ];

    // Relasi (jika ada)
    public function tugasMahasiswa()
    {
        return $this->hasMany(TugasPendidik::class, 'id_detail_tugas', 'id_detail_tugas');
    }
}
