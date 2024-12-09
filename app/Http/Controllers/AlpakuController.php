<?php
namespace App\Http\Controllers;

use App\Models\AlpakuModel; // Import model AlpakuModel
use App\Models\PeriodeModel;
use Illuminate\Http\Request;

class AlpakuController extends Controller
{
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Alpaku',
            'list' => ['Home', 'Manajemen', 'Alpaku']
        ];

        $page = (object) [
            'title' => 'Daftar Alpa Mahasiswa'
        ];

        $activeMenu = 'alpaku'; // Menu aktif untuk halaman ini

        // Mengambil data alpa dan periode, tanpa perlu menghitung jumlah alpa
        $alpaData = AlpakuModel::with('periode') // Memuat relasi periode
            ->get(); // Ambil semua data yang sudah ada (tidak perlu COUNT)

        return view('mahasiswa.alpaku.index', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'activeMenu' => $activeMenu,
            'alpaData' => $alpaData
        ]);
    }
}
