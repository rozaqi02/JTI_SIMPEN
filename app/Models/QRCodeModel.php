<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QRCodeModel extends Model
{
    use HasFactory;

    // Tentukan nama tabel jika tidak mengikuti konvensi penamaan
    protected $table = 't_qr_code';

    // Tentukan kolom yang bisa diisi
    protected $fillable = [
        'id_tugas',
        'id_mahasiswa',
        'image_qrcode'
    ];

    // Relasi dengan User (Many-to-One)
    public function riwayatTugas()
    {
        return $this->hasOne(RiwayatPenugasanMahasiswa::class, 'id_QRCode', 'id_QRCode');
    }
    
    public function tugas()
    {
        return $this->belongsTo(TugasModel::class, 'id_tugas', 'id_tugas');
    }
    
    
}
