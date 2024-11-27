<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Menambahkan data ke tabel m_level
        DB::table('m_level')->insert([
            [
                'level_kode' => 'ADM',
                'level_nama' => 'ADMIN',
            ],
            [
                'level_kode' => 'DSN',
                'level_nama' => 'DOSEN',
            ],
            [
                'level_kode' => 'TDK',
                'level_nama' => 'TENDIK',
            ],
            [
                'level_kode' => 'MHS',
                'level_nama' => 'MAHASISWA',
            ]
        ]);
    }
}
