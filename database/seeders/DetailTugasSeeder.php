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

                'id_detail_tugas' => 3,
                'id_user' => 1, // id_user refers to a user in m_user table
                'id_jenis_kompen' => 2, // id_jenis_kompen refers to a jenis kompen in m_jenis_kompen table
                'nama_tugas' => 'Pengabdian Desa Maibit',
                'deskripsi_tugas' => 'Melakukan Pengabdian desa guna membangun masyarakat yang solutif',
                'kuota' => 10,
                'nilai_kompen' => 10,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_detail_tugas' => 4,
                'id_user' => 2, 
                'id_jenis_kompen' => 3,
                'nama_tugas' => 'Penelitian P.DIddy',
                'deskripsi_tugas' => 'Melakukan analisis dan penulisan laporan terkait proyek B dengan fokus pada efisiensi.',
                'kuota' => 15,
                'nilai_kompen' => 30,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
