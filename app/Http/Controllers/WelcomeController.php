<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TugasPendidik; // Untuk tabel m_detail_tugas
use App\Models\MahasiswaModel; // Untuk tabel m_mahasiswa
use App\Models\JenisKompen; // Untuk tabel m_jenis_kompen

class WelcomeController extends Controller
{
    public function index()
    {
        // Hitung total tugas
        $totalTugas = TugasPendidik::count();

        // Hitung total kompen berdasarkan id_jenis_kompen untuk Kompen (contoh id 1)
        $totalKompen = TugasPendidik::where('id_jenis_kompen', 1)->count();

        // Ambil data mahasiswa
        $mahasiswa = MahasiswaModel::select('nama_mahasiswa as nama', 'nim', 'program_studi as prodi', 'tahun_masuk as semester')
            ->get();

        // Data untuk Chart
        $chartData = TugasPendidik::join('m_jenis_kompen', 'm_detail_tugas.id_jenis_kompen', '=', 'm_jenis_kompen.id_jenis_kompen')
            ->selectRaw('m_jenis_kompen.nama_jenis_kompen as jenis, COUNT(*) as jumlah')
            ->groupBy('m_jenis_kompen.nama_jenis_kompen')
            ->pluck('jumlah', 'jenis');

        $breadcrumb = (object) [
            'title' => 'Selamat Datang',
            'list' => ['JTI SIMPEN', 'Dashboard']
        ];

        $activeMenu = 'dashboard';

        return view('welcome', compact('breadcrumb', 'activeMenu', 'totalTugas', 'totalKompen', 'mahasiswa', 'chartData'));
    }

    public function Landing()
    {
        return view('landing');
}
}
