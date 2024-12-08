<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AlpaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Dummy data for t_alpa
        DB::table('t_alpa')->insert([
            [
                'id_mahasiswa' => 1, // Refers to an existing mahasiswa in m_mahasiswa
                'id_periode' => 1, // Refers to an existing periode in t_periode
                'jam_alpa' => '3 Jam', // Jam alpa
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
