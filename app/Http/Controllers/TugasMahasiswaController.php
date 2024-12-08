<?php

namespace App\Http\Controllers;

use App\Models\TugasMahasiswa;
use Illuminate\Http\Request;

class TugasMahasiswaController extends Controller
{
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Manajemen Daftar Tugas',
            'list' => ['Home', 'Manajemen', 'Daftar Tugas']
        ];

        $page = (object) [
            'title' => 'Daftar Tugas'
        ];

        $activeMenu = 'daftar-tugas'; // Menu aktif untuk halaman ini

        // Mengambil data dari model
        $tugasMahasiswa = TugasMahasiswa::all();

        return view('admin.daftar-tugas.index', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'activeMenu' => $activeMenu,
            'tugasMahasiswa' => $tugasMahasiswa
        ]);
    }
}
