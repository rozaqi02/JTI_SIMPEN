<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DetailBidkomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Pastikan id_mahasiswa 4 ada di tabel m_mahasiswa dan id_bidkom 1 ada di tabel t_bidkom
        DB::table('t_detail_bidkom')->insert([
            [
                'id_detail_bidkom' => 1,
                'id_bidkom' => 1, // Refers to an existing periode in t_periode
                'id_mahasiswa' => 1, // Refers to an existing mahasiswa in m_mahasiswa
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_detail_bidkom' => 2,
                'id_bidkom' => 2, // Refers to an existing periode in t_periode
                'id_mahasiswa' => 1, // Refers to an existing mahasiswa in m_mahasiswa
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
