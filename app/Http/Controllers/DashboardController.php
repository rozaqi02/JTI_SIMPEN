<?php



namespace App\Http\Controllers;

use App\Models\TugasPendidik; // Untuk tabel m_detail_tugas
use App\Models\MahasiswaModel; // Untuk tabel m_mahasiswa
use App\Models\AlpakuModel; // Untuk tabel m_mahasiswa
use App\Models\PeriodeModel; // Untuk tabel m_mahasiswa
use App\Models\JenisKompen; // Untuk tabel m_jenis_kompen

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Ambil data user yang sedang login
        $user = Auth::user();
        $levelId = $user->level_id;

        // Data breadcrumb umum
        $breadcrumb = (object) [
            'title' => 'Dashboard',
            'list' => ['Home', 'Dashboard']
        ];

        // Data untuk Chart
        $chartData = TugasPendidik::join('m_jenis_kompen', 'm_detail_tugas.id_jenis_kompen', '=', 'm_jenis_kompen.id_jenis_kompen')
            ->selectRaw('m_jenis_kompen.nama_jenis_kompen as jenis, COUNT(*) as jumlah')
            ->groupBy('m_jenis_kompen.nama_jenis_kompen')
            ->pluck('jumlah', 'jenis');

        // Inisialisasi variabel
        $totalTugas = TugasPendidik::count();  // Hitung total tugas
        $totalKompen = TugasPendidik::where('id_jenis_kompen', 1)->count();  // Hitung total kompen berdasarkan id_jenis_kompen

        // Ambil data mahasiswa
        $mahasiswa = MahasiswaModel::select('nama_mahasiswa as nama', 'nim', 'program_studi as prodi', 'tahun_masuk as semester')
            ->get();

        // Set active menu
        $activeMenu = 'dashboard';  // Set menu aktif untuk dashboard

        // Admin Dashboard
        if ($levelId == 1) {
            return view('admin.dashboard', compact('breadcrumb', 'chartData', 'totalTugas', 'totalKompen', 'mahasiswa', 'activeMenu'));
        }

        // Dosen Dashboard
        if ($levelId == 2) {
            $dosenData = TugasPendidik::where('dosen_id', $user->id) // Mengambil tugas dosen berdasarkan ID dosen
                ->select('nama_tugas', 'deadline')
                ->get();

            return view('dosen.dashboard', compact('breadcrumb', 'chartData', 'dosenData', 'activeMenu'));
        }

        // Tendik Dashboard
        if ($levelId == 3) {
            $tendikData = MahasiswaModel::where('tendik_id', $user->id) // Misalnya ada relasi tendik
                ->select('nama_mahasiswa', 'nim')
                ->get();

            return view('tendik.dashboard', compact('breadcrumb', 'chartData', 'tendikData', 'activeMenu'));
        }

        // Mahasiswa Dashboard
        if ($levelId == 4) {
            // Ambil data mahasiswa berdasarkan ID user yang sedang login
            $mahasiswa = MahasiswaModel::where('nim', $user->nim)->first();

            // Ambil data alpa mahasiswa berdasarkan periode
            $periode = PeriodeModel::all();  // Mengambil semua data periode
            $alpaMahasiswa = AlpakuModel::where('id_mahasiswa', $user->id)
                ->selectRaw('id_periode, SUM(jam_alpa) as total_alpa')
                ->groupBy('id_periode')
                ->get();

            return view('mahasiswa.dashboard', compact('breadcrumb', 'chartData', 'mahasiswa', 'periode', 'alpaMahasiswa', 'activeMenu'));
        }
    }
}

