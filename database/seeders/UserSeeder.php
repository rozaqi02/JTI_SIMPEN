<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('m_user')->insert([
            [
                'id_user' => '1',
                'level_id' => '1', //admin
                'username' => 'Ahmad Abror',
                'password' => Hash::make('12345'), // Hash password
                'foto' => 'adminlte/dist/image/default-avatar.jpg', // Avatar default
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_user' => '2',
                'level_id' => 2, //dosen
                'username' => 'Afifah Rahma',
                'password' => Hash::make('12345'),
                'foto' => 'adminlte/dist/image/default-avatar.jpg', // Avatar default
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_user' => '3',
                'level_id' => 3, //tendik
                'username' => 'Anas Nur Hidayat',
                'password' => Hash::make('12345'),
                'foto' => 'adminlte/dist/image/default-avatar.jpg', // Avatar default
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_user' => '4',
                'level_id' => 4, //mahasiswa
                'username' => 'Amanda Jasmyne',
                'password' => Hash::make('12345'),
                'foto' => 'adminlte/dist/image/default-avatar.jpg', // Avatar default
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
