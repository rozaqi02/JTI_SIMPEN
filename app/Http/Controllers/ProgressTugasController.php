<?php

namespace App\Http\Controllers;

use App\Models\ProgressTugas;
use App\Models\UserModel;
use App\Models\DetailTugasModel;
use Illuminate\Http\Request;

class ProgressTugasController extends Controller
{
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Progress Tugas',
            'list' => ['JTI-SIMPEN', 'Tugasku', 'Progress Tugas']
        ];

        $page = (object) [
            'title' => 'Daftar Progress Tugas'
        ];

        $activeMenu = 'progress-tugas';

        // Mengambil data progress tugas dengan join ke tabel user dan detail tugas
        $progressTugas = ProgressTugas::select(
            'm_tugas.*', 
            'm_detail_tugas.nama_tugas', 
            'm_user.username as pemberi_tugas'
        )
            ->join('m_detail_tugas', 'm_tugas.id_detail_tugas', '=', 'm_detail_tugas.id_detail_tugas')
            ->join('m_user', 'm_detail_tugas.id_user', '=', 'm_user.id_user')
            ->get();

        return view('mahasiswa.progress-tugas.index', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'activeMenu' => $activeMenu,
            'progressTugas' => $progressTugas
        ]);
    }
}
