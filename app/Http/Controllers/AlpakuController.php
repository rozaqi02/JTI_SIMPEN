<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use App\Models\AlpakuModel; // Import model AlpakuModel
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

        // Mengambil data mahasiswa dan menghitung jumlah alpa
        $mahasiswa = Mahasiswa::withCount('alpa')->get(); // Menggunakan relasi untuk menghitung jumlah alpa

        return view('mahasiswa.alpaku.index', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'activeMenu' => $activeMenu,
            'mahasiswa' => $mahasiswa
        ]);
    }
}