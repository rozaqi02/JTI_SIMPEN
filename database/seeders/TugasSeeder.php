<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TugasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Dummy data for m_tugas
        DB::table('m_tugas')->insert([
            [
                'id_detail_tugas' => 1, // Refers to an existing detail tugas in m_detail_tugas
                'id_alpa' => 1, // Refers to an existing alpa in t_alpa
                'progress_tugas' => 'Belum Mulai', // Progress status
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_detail_tugas' => 2, 
                'id_alpa' => 2, 
                'progress_tugas' => 'Dalam Progres', 
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_detail_tugas' => 3, 
                'id_alpa' => 3, 
                'progress_tugas' => 'Selesai', 
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
