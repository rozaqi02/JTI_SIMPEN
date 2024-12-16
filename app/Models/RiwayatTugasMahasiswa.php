<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RiwayatTugasMahasiswa extends Model
{
    use HasFactory;

    protected $table = 't_riwayat_tugas'; // Nama tabel di database
    protected $primaryKey = 'id_riwayat_tugas';
    public $timestamps = true;

    protected $fillable = [
        'id_QRCode',
        'id_tugas',
        'tanggal_dilaksanakan',
        'tanggal_selesai',
        'status'
    ];

    // Relasi ke tabel m_tugas
    public function tugas()
    {
        return $this->belongsTo(ProgressTugas::class, 'id_tugas', 'id_tugas');
    }

    // Relasi ke tabel mahasiswa melalui t_alpa
    public function mahasiswa()
    {
        return $this->belongsTo(MahasiswaModel::class, 'id_QRCode', 'id_QRCode');
    }
}
