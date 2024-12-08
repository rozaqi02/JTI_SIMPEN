<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use Illuminate\Http\Request;

class MahasiswaController extends Controller
{
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Info Mahasiswa',
            'list' => ['Home', 'Manajemen', 'Info Mahasiswa']
        ];

        $page = (object) [
            'title' => 'Daftar Mahasiswa'
        ];

        $activeMenu = 'info-mahasiswa'; // Menu aktif untuk halaman ini

        // Mengambil data dari model
        $mahasiswa = Mahasiswa::all();

        return view('admin.info-mahasiswa.index', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'activeMenu' => $activeMenu,
            'mahasiswa' => $mahasiswa
        ]);
    }
}
