<?php

namespace App\Http\Controllers;

use App\Models\TugasMahasiswa;
use App\Models\TugasPendidik;
use Illuminate\Http\Request;

class TugasPendidikController extends Controller
{
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Manajemen Daftar Tugas',
            'list' => ['Home', 'Manajemen', 'Daftar Tugas Pendidik']
        ];

        $page = (object) [
            'title' => 'Daftar Tugas'
        ];

        $activeMenu = 'daftar-tugas'; // Menu aktif untuk halaman ini

        // Mengambil data dari model
        $tugasMahasiswa = TugasPendidik::all();

        return view('admin.daftar-tugas.index', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'activeMenu' => $activeMenu,
            'tugasMahasiswa' => $tugasMahasiswa
        ]);
    }
}
