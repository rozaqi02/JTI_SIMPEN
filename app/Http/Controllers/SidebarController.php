<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SidebarController extends Controller
{
    // Fungsi untuk mendapatkan sidebar berdasarkan level_id
    public function getSidebar()
    {
        $level_id = session('level_id');  // Ambil level_id dari session
        
        // Tentukan sidebar berdasarkan level_id
        if ($level_id == 1) { // Admin
            return view('sidebar.admin');
        } elseif ($level_id == 2) { // Dosen
            return view('sidebar.dosen');
        } elseif ($level_id == 3) { // Tendik
            return view('sidebar.tendik');
        } else { // Mahasiswa
            return view('sidebar.mahasiswa');
        }
    }
}
