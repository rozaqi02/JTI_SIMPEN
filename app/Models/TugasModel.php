<?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Model;

    class TugasModel extends Model
    {
        protected $table = 'm_tugas';

        // Menentukan bahwa id_tugas adalah primary key
        protected $primaryKey = 'id_tugas';

        // Kolom yang dapat diisi (fillable)
        protected $fillable = [
            'id_detail_tugas',
            'id_alpa',
            'progress_tugas'
        ];

        // Relasi ke model DetailTugas (One to Many)
        public function detailTugas()
        {
            return $this->belongsTo(DetailTugasModel::class, 'id_detail_tugas');
        }

        // Relasi ke model Alpa (One to Many)
        public function alpa()
        {
            return $this->belongsTo(AlpakuModel::class, 'id_alpa');
        }

        // Relasi ke model User (One to Many, jika diperlukan untuk relasi ke mahasiswa)
        public function mahasiswa()
        {
            return $this->belongsTo(UserModel::class, 'id_user');
        }


    }
