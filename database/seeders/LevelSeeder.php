<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;


class LevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('m_level')->insert([
            // Admin Data (akses penuh)
            [
                'level_kode' => 'ADM',
                'level_nama' => 'admin',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'level_kode' => 'DSN',
                'level_nama' => 'dosen',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'level_kode' => 'TDK',
                'level_nama' => 'tendik',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'level_kode' => 'MHS',
                'level_nama' => 'mahasiswa',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
