<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DosenSeeder extends Seeder
{
    public function run()
    {
        DB::table('m_dosen')->insert([
            'id_dosen' => 1,  // ID dosen, pastikan sesuai atau auto-increment
            'id_user' => 2,  // ID user yang sudah ada di tabel users
            'nip' => '1986543210',  // Ganti dengan NIP yang sesuai
            'nama_dosen' => 'Afifah Rahma',
            'email' => 'afifah.rahma@example.com',  // Ganti dengan email yang sesuai
            'no_telepon' => '081234567891',  // Ganti dengan nomor telepon yang sesuai
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}
