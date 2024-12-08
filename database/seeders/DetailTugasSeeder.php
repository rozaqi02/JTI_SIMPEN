<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class DetailTugasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Dummy data for m_detail_tugas
        DB::table('m_detail_tugas')->insert([
            [
                'id_user' => 1, // id_user refers to a user in m_user table
                'id_jenis_kompen' => 1, // id_jenis_kompen refers to a jenis kompen in m_jenis_kompen table
                'nama_tugas' => 'Penelitian Proyek A',
                'deskripsi_tugas' => 'Melakukan riset dan pengumpulan data untuk proyek A yang berkaitan dengan teknologi terbaru.',
                'kuota' => 10,
                'nilai_kompen' => 20,
                'jumlah_jam' => 5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_user' => 2, 
                'id_jenis_kompen' => 2,
                'nama_tugas' => 'Penelitian Proyek B',
                'deskripsi_tugas' => 'Melakukan analisis dan penulisan laporan terkait proyek B dengan fokus pada efisiensi.',
                'kuota' => 15,
                'nilai_kompen' => 30,
                'jumlah_jam' => 8,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
