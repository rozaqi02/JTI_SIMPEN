<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JenisKompenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('m_jenis_kompen')->insert([
            [
                'id_jenis_kompen' => 1,
                'nama_jenis_kompen' => 'Pengabdian',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_jenis_kompen' => 2,
                'nama_jenis_kompen' => 'Penelitian',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_jenis_kompen' => 3,
                'nama_jenis_kompen' => 'Teknis',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
