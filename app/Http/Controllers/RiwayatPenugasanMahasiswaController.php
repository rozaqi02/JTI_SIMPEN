<?php

namespace App\Http\Controllers;

use App\Models\RiwayatPenugasanMahasiswa;
use Illuminate\Http\Request;

class RiwayatPenugasanMahasiswaController extends Controller
{
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Manajemen Riwayat Penugasan Mahasiswa',
            'list' => ['Home', 'Manajemen', 'Riwayat Penugasan']
        ];

        $page = (object) [
            'title' => 'Riwayat Penugasan Mahasiswa'
        ];

        $activeMenu = 'riwayat-penugasan'; // Menu aktif untuk halaman ini

        // Mengambil data dari model
        $riwayatPenugasan = RiwayatPenugasanMahasiswa::all();

        return view('admin.riwayat-penugasan.index', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'activeMenu' => $activeMenu,
            'riwayatPenugasan' => $riwayatPenugasan
        ]);
    }
}
