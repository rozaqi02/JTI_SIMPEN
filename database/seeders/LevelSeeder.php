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
                'level_id' => '1',
                'level_kode' => 'ADM',
                'level_nama' => 'ADMIN',
            ],
            [
                'level_id' => '2',
                'level_kode' => 'DSN',
                'level_nama' => 'DOSEN',
            ],
            [
                'level_id' => '3',
                'level_kode' => 'TDK',
                'level_nama' => 'TENDIK',
            ],
            [
                'level_id' => '4',
                'level_kode' => 'MHS',
                'level_nama' => 'MAHASISWA',
            ]
        ]);
    }
}
