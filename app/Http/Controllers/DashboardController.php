<?php



namespace App\Http\Controllers;

use App\Models\TugasPendidik; // Untuk tabel m_detail_tugas
use App\Models\MahasiswaModel; // Untuk tabel m_mahasiswa
use App\Models\AlpakuModel; // Untuk tabel m_mahasiswa
use App\Models\DosenModel;
use App\Models\PeriodeModel; // Untuk tabel m_mahasiswa
use App\Models\JenisKompen; // Untuk tabel m_jenis_kompen
use App\Models\TendikModel;
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
            'list' => ['JTI-SIMPEN', 'Dashboard']
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
        if ($levelId == 2){
            $totalTugasUser = TugasPendidik::where('id_user',2)->count();
            return view('dosen.dashboard', compact('breadcrumb', 'chartData', 'totalTugasUser', 'activeMenu'));
        }

        // Tendik Dashboard
        if ($levelId == 3) {

            return view('tendik.dashboard',  compact('breadcrumb', 'chartData', 'totalTugasUser', 'activeMenu'));
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

