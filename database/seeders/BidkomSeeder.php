<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BidkomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('t_bidkom')->insert([
            [
                'id_bidkom' => 1,
                'kode_bidkom' => 'WEB',
                'nama_bidkom' => 'WEB DEVELOPER',
            ],
            [
                'id_bidkom' => 2,
                'kode_bidkom' => 'MOBILE',
                'nama_bidkom' => 'MOBILE DEVELOPER',
            ],
            [
                'id_bidkom' => 3,
                'kode_bidkom' => 'VISUAL',
                'nama_bidkom' => 'VISUALISASI DESAIN',
            ],
            [
                'id_bidkom' => 4,
                'kode_bidkom' => 'UI',
                'nama_bidkom' => 'DESIGN',
            ],
            [
                'id_bidkom' => 5,
                'kode_bidkom' => 'SPEAK',
                'nama_bidkom' => 'PUBLIC SPEAKING',
            ],
        ]);
    }
}
