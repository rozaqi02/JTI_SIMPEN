<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KategoriUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('t_kategori_user')->insert([
            // Admin Data (akses penuh)
            [
                'kategori_user_kode' => 'ADM',
                'kategori_nama' => 'admin',
                'level' => 'admin',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kategori_user_kode' => 'DSN',
                'kategori_nama' => 'dosen',
                'level' => 'user',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kategori_user_kode' => 'TDK',
                'kategori_nama' => 'tendik',
                'level' => 'user',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kategori_user_kode' => 'MHS',
                'kategori_nama' => 'mahasiswa',
                'level' => 'user',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
