<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailBidkomModel extends Model
{
    use HasFactory;

    protected $table = 't_detail_bidkom';
    protected $primaryKey = 'id_detail_bidkom';
    public $timestamps = true;

    protected $fillable = [
        'id_bidkom',
        'id_mahasiswa'
    ];

    // Relasi ke tabel Bidkom
    public function bidkom()
    {
        return $this->belongsTo(BidkomModel::class, 'id_bidkom', 'id_bidkom');
    }

    // Relasi ke tabel Mahasiswa
    public function mahasiswa()
    {
        return $this->belongsTo(MahasiswaModel::class, 'id_mahasiswa', 'id_mahasiswa');
    }
}
