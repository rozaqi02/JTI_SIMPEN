<?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Factories\HasFactory;
    use Illuminate\Database\Eloquent\Model;

    class ProgressTugas extends Model
    {
        use HasFactory;

        protected $table = 'm_tugas'; // Nama tabel progress tugas
        protected $primaryKey = 'id_tugas';
        public $incrementing = true;
        public $timestamps = true;

        protected $fillable = [
            'id_detail_tugas',
            'id_alpa',
            'progress_tugas',
        ];

// Relasi ke tabel m_detail_tugas
public function detailTugas()
{
    return $this->belongsTo(DetailTugasModel::class, 'id_detail_tugas', 'id_detail_tugas');
}

public function jenisKompen()
{
    return $this->hasOneThrough(
        JenisKompen::class,
        DetailTugasModel::class,
        'id_detail_tugas',
        'id_jenis_kompen',
        'id_detail_tugas',
        'id_jenis_kompen'
    );
}

public function mahasiswa()
{
    return $this->belongsTo(MahasiswaModel::class, 'id_alpa', 'id_mahasiswa');
}
    }