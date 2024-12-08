<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PeriodeSeeder extends Seeder
{
    /**
     * Jalankan seeder untuk tabel t_periode_alpa.
     */
    public function run(): void
    {
        // Menambahkan beberapa data contoh ke tabel t_periode_alpa
        DB::table('t_periode')->insert([
            [
                'nama_periode' => '2021 - Ganjil',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_periode' => '2021 - Genap',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_periode' => '2022 - Ganjil',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_periode' => '2022 - Genap',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_periode' => '2023 - Ganjil',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_periode' => '2023 - Genap',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_periode' => '2024 - Ganjil',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_periode' => '2024 - Genap',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
