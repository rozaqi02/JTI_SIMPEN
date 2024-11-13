<?php

    namespace Database\Seeders;

    use Illuminate\Database\Seeder;
    use Illuminate\Support\Facades\DB;
    use Illuminate\Support\Facades\Hash;

    class PendidikSeeder extends Seeder
    {
        /**
         * Run the database seeds.
         */
        public function run(): void
        {
            DB::table('m_pendidik')->insert([
                [
                    'kategori_user_id' => 1, // Pastikan ini sesuai dengan ID kategori untuk dosen di t_kategori_user
                    'level' => 'admin',
                    'username' => 'Titis',
                    'nama' => 'Titis',
                    'no_telepon' => '08123456789',
                    'email' => 'titis@gmail.com',
                    'password' => Hash::make('akucapekhelp'), // Hash password
                    'tipe_user' => 'admin', // Perbaikan kolom user_type ke tipe_user
                    'nip' => 1987654321,
                    'foto' => 'adminlte/dist/image/default-avatar.jpg', // Path foto default
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'kategori_user_id' => 2, // Pastikan ini sesuai dengan ID kategori untuk dosen di t_kategori_user
                    'level' => 'user',
                    'username' => 'enggar',
                    'nama' => 'Enggar',
                    'no_telepon' => '08123748317',
                    'email' => 'septianenggar@gmail.com',
                    'password' => Hash::make('akuenggar'), // Hash password
                    'tipe_user' => 'dosen', // Perbaikan kolom user_type ke tipe_user
                    'nip' => 143231213,
                    'foto' => 'adminlte/dist/image/default-avatar.jpg', // Path foto default
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'kategori_user_id' => 3, // Pastikan ini sesuai dengan ID kategori untuk dosen di t_kategori_user
                    'level' => 'user',
                    'username' => 'erni',
                    'nama' => 'Erni',
                    'no_telepon' => '0898677534',
                    'email' => 'Erni@gmail.com',
                    'password' => Hash::make('akuenggar'), // Hash password
                    'tipe_user' => 'tendik', // Perbaikan kolom user_type ke tipe_user
                    'nip' => 143231213,
                    'foto' => 'adminlte/dist/image/default-avatar.jpg', // Path foto default
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            ]);
        }
    }
