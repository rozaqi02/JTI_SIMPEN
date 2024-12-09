<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class TendikSeeder extends Seeder
{
    public function run()
    {
        DB::table('m_tendik')->insert([
            'id_tendik' => 1,  // ID tendik, pastikan sesuai atau auto-increment
            'id_user' => 3,  // ID user yang sudah ada di tabel users
            'nip' => '1987456123',  // Ganti dengan NIP yang sesuai
            'nama_tendik' => 'Anas Nurhidayat',
            'email' => 'anas.nurhidayat@example.com',  // Ganti dengan email yang sesuai
            'no_telepon' => '081234567892',  // Ganti dengan nomor telepon yang sesuai
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}
