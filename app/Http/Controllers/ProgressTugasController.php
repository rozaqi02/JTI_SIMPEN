<?php

namespace App\Http\Controllers;

use App\Models\ProgressTugas;
use Illuminate\Http\Request;

class ProgressTugasController extends Controller
{
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Progress Tugas',
            'list' => ['Home', 'Manajemen', 'Progress Tugas']
        ];

        $page = (object) [
            'title' => 'Daftar Progress Tugas'
        ];

        $activeMenu = 'progress-tugas'; // Menu aktif untuk halaman ini

        // Mengambil data dari model
        $progressTugas = ProgressTugas::all();

        return view('mahasiswa.progress-tugas.index', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'activeMenu' => $activeMenu,
            'progressTugas' => $progressTugas
        ]);
    }
}
