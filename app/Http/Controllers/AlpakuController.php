<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use Illuminate\Http\Request;

class AlpakuController extends Controller
{
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Alpaku',
            'list' => ['Home', 'Manajemen', 'Alpaku']
        ];

        $page = (object) [
            'title' => 'Daftar Alpa Mahasiswa'
        ];

        $activeMenu = 'alpaku'; // Menu aktif untuk halaman ini

        // Mengambil data mahasiswa yang memiliki jumlah alpa
        $mahasiswa = Mahasiswa::select('id_mahasiswa', 'nama_mahasiswa', 'nim', 'jumlah_alpa')
            ->where('jumlah_alpa', '>', 0)  // Menampilkan mahasiswa yang memiliki alpa lebih dari 0
            ->get();

        return view('mahasiswa.alpaku.index', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'activeMenu' => $activeMenu,
            'mahasiswa' => $mahasiswa
        ]);
    }
}
