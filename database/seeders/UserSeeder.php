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
                'level_id' => '1',
                'username' => 'admin',
                'password' => Hash::make('12345'), // Hash password
                'foto' => 'adminlte/dist/image/default-avatar.jpg', // Avatar default
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'level_id' => 2,
                'username' => 'dosen',
                'password' => Hash::make('12345'),
                'foto' => 'adminlte/dist/image/default-avatar.jpg', // Avatar default
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'level_id' => 3,
                'username' => 'tendik',
                'password' => Hash::make('12345'),
                'foto' => 'adminlte/dist/image/default-avatar.jpg', // Avatar default
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'level_id' => 4,
                'username' => 'mahasiswa',
                'password' => Hash::make('12345'),
                'foto' => 'adminlte/dist/image/default-avatar.jpg', // Avatar default
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
