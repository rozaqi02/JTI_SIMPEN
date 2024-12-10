<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailBidkomModel extends Model
{
    use HasFactory;

    // Tentukan nama tabel yang akan digunakan oleh model
    protected $table = 't_detail_bidkom';

    // Tentukan primary key jika tidak menggunakan 'id'
    protected $primaryKey = 'id_detail_bidkom';

    // Tentukan apakah kolom id akan diisi secara otomatis
    public $incrementing = true;

    // Tentukan apakah timestamp digunakan (created_at dan updated_at)
    public $timestamps = true;

    // Tentukan kolom yang boleh diisi (mass assignment)
    protected $fillable = [
        'id_bidkom',
        'id_mahasiswa',
        'created_at',
        'updated_at'
    ];

    /**
     * Relasi dengan model Bidkom
     */
// Dalam DetailBidkomModel
public function bidkom()
{
    return $this->belongsTo(BidkomModel::class, 'id_bidkom', 'id_bidkom');
}


    /**
     * Relasi dengan model Mahasiswa
     */
    public function mahasiswa()
    {
        return $this->belongsTo(MahasiswaModel::class, 'id_mahasiswa', 'id_mahasiswa');
    }
}
