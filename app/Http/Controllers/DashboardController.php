<?php



namespace App\Http\Controllers;

use App\Models\AdminModel;
use App\Models\TugasPendidik; // Untuk tabel m_detail_tugas
use App\Models\MahasiswaModel; // Untuk tabel m_mahasiswa
use App\Models\DetailTugasModel; // Untuk tabel m_detail_tugas
use App\Models\AlpakuModel; // Untuk tabel m_mahasiswa
use App\Models\DosenModel;
use App\Models\PeriodeModel; // Untuk tabel m_mahasiswa
use App\Models\JenisKompen; // Untuk tabel m_jenis_kompen
use App\Models\ProgressTugas;
use App\Models\TendikModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Ambil data user yang sedang login
        $user = Auth::user();
        

     
        // Data breadcrumb umum
        $breadcrumb = (object) [
            'title' => 'Dashboard',
            'list' => ['JTI-SIMPEN', 'Dashboard']
        ];
        

    // Ambil data jumlah tugas per jenis_kompen
    $chartData = TugasPendidik::join('m_jenis_kompen', 'm_detail_tugas.id_jenis_kompen', '=', 'm_jenis_kompen.id_jenis_kompen')
        ->selectRaw('m_jenis_kompen.nama_jenis_kompen as jenis_kompen, COUNT(*) as jumlah')
        ->groupBy('m_jenis_kompen.nama_jenis_kompen')
        ->get(); // Mengambil data dalam bentuk koleksi objek

    // Mengatur warna berdasarkan jenis kompen
    $colors = [
        'Penelitian' => '#FF0000', // Merah
        'Pengabdian' => '#FFA500', // Orange
        'Teknis' => '#FFFF00'      // Kuning
    ];

    // Menyiapkan data untuk pie chart
    $pieChartData = $chartData->map(function ($item) use ($colors) {
        return [
            'label' => $item->jenis_kompen,
            'value' => $item->jumlah,
            'color' => $colors[$item->jenis_kompen] ?? '#000000' // Default color jika tidak ada
        ];
    });

        // Inisialisasi variabel
        $totalTugas = TugasPendidik::count();  
        // Hitung total tugas
        $totalTugasUser = DB::table('m_detail_tugas')
        ->where('id_user', $user->id_user)
        ->count();

        $mahasiswa = MahasiswaModel::select('nama_mahasiswa as nama', 'nim', 'program_studi as prodi', 'tahun_masuk as semester')
        ->get();





        // Set active menu
        $activeMenu = 'dashboard';  // Set menu aktif untuk dashboard

        switch($user->level_id) {

        // Admin Dashboard
        // if ($levelId == 1) {
            case 1:
                $admin = AdminModel::where('id_user', $user->id_user)->first();
                $namaAdmin = $admin->nama_admin;
            return view('admin.dashboard', compact('breadcrumb', 'pieChartData','namaAdmin','totalTugas', 'totalTugasUser', 'mahasiswa', 'chartData', 'activeMenu'));
            case 2:
                $dosen = DosenModel::where('id_user', $user->id_user)->first();
                $namaDosen = $dosen->nama_dosen;
            return view('dosen.dashboard', compact('breadcrumb', 'chartData','namaDosen', 'totalTugasUser', 'activeMenu'));
            case 3:
                $tendik = TendikModel::where('id_user', $user->id_user)->first();
                $namaTendik = $tendik->nama_tendik;
            return view('tendik.dashboard',  compact('breadcrumb', 'chartData','namaTendik', 'totalTugasUser', 'activeMenu'));
            case 4:
                $mahasiswa = MahasiswaModel::where('id_user', $user->id_user)->first();
                $namaMahasiswa = $mahasiswa->nama_mahasiswa;
                $totalJamAlpa = AlpakuModel::where('id_mahasiswa', $mahasiswa->id_mahasiswa)
                ->sum(column: 'jam_alpa'); // Menghitung total jam alpa
            return view('mahasiswa.dashboard', compact('breadcrumb','namaMahasiswa', 'totalJamAlpa','totalTugas', 'activeMenu'));
        }
    }
}

