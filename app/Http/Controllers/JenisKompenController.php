<?php

namespace App\Http\Controllers;

use App\Models\JenisKompen;
use Illuminate\Http\Request;

class JenisKompenController extends Controller
{
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Manajemen Data Jenis Kompen',
            'list' => ['Home', 'Manajemen', 'Data Jenis Kompen']
        ];

        $page = (object) [
            'title' => 'Data Jenis Kompen'
        ];

        $activeMenu = 'jenis-kompen'; // Menu aktif untuk halaman ini

        // Mengambil data dari model
        $jenisKompen = JenisKompen::all();

        return view('admin.jenis-kompen.index', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'activeMenu' => $activeMenu,
            'jenisKompen' => $jenisKompen
        ]);
    }
}
