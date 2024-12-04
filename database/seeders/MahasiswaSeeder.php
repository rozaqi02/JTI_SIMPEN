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
                'kategori_user_id' => 2, // Pastikan ini sesuai dengan ID kategori untuk mahasiswa di t_kategori_user
                'level' => 'user',
                'email' => 'rojak@gmail.com',
                'username' => 'abror',
                'nama' => 'Ahmad Abror Rozaqi Fatoni',
                'password' => Hash::make('12345'), // Hash password
                'nim' => 224176005,
                'foto' => 'adminlte/dist/image/default-avatar.jpg', // Avatar default
                'jumlah_alpa' => 2,
                'nama_bidkom' => '',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kategori_user_id' => 2,
                'level' => 'user',
                'email' => 'anasnh@ansaprem.my.id',
                'username' => 'anas',
                'nama' => 'Anas nur hidayat',
                'password' => Hash::make('12345'),
                'nim' => 224176004,
                'foto' => 'adminlte/dist/image/default-avatar.jpg',
                'jumlah_alpa' => 1,
                'nama_bidkom' => '',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kategori_user_id' => 2,
                'level' => 'user',
                'email' => 'chandra@gmail.com',
                'username' => 'chandra',
                'nama' => 'chandra',
                'password' => Hash::make('12345'),
                'nim' => 224176003,
                'foto' => 'adminlte/dist/image/default-avatar.jpg',
                'jumlah_alpa' => 0,
                'nama_bidkom' => '',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}