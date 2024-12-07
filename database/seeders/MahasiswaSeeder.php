<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
class MahasiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('m_mahasiswa')->insert([
            [
                'id_user'=> '4',
                'id_bidkom'=> '1',
                'nama_mahasiswa' => 'Amanda Jasmyne',
                'nim' => 2241760123,
                'email' => 'amandajbp04@gmail.com',
                'program_studi' => 'Sistem Informasi Bisnis',
                'tahun_masuk' => 2024,
                'created_at' => now(),
                'updated_at' => now(),
            ]
               ]);
    }
}