<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TugasPendidik; // Untuk tabel m_detail_tugas
use App\Models\MahasiswaModel; // Untuk tabel m_mahasiswa
use App\Models\JenisKompen; // Untuk tabel m_jenis_kompen

class WelcomeController extends Controller
{
    

    public function Landing()
    {
        return view('landing');
}
}
