<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AdminSeeder extends Seeder
{
    public function run()
    {
        DB::table('m_admin')->insert([
            'id_admin' => 1,
            'id_user' => 1,  // Sesuaikan dengan id_user yang ada di tabel users
            'nip' => '1987654321', // Ganti dengan NIP yang sesuai
            'email' => 'ahmad.abror@example.com', // Ganti dengan email yang sesuai
            'nama_admin' => 'Ahmad Abror',
            'no_telepon' => '081234567890', // Ganti dengan nomor telepon yang sesuai
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}
