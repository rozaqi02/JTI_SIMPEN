<?php 
namespace App\Http\Controllers;
use App\Models\TugasPendidik;
use App\Models\JenisKompen;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
class PenugasankuController extends Controller
{
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Penugasanku',
            'list' => ['Home', 'Penugasanku']
        ];
    
        $page = (object) [
            'title' => 'Daftar Tugas Saya'
        ];
    
        $activeMenu = 'penugasanku';
    
        // Ambil semua data JenisKompen
        $jenisKompen = JenisKompen::all(); // Pastikan model JenisKompen sudah benar
    
        return view('Admin.Pendidik.index', compact('breadcrumb', 'page', 'activeMenu', 'jenisKompen'));
    }
    
    public function list(Request $request)
    {
        $userId = Auth::id(); // Mendapatkan ID user yang sedang login
    
        $tugas = TugasPendidik::where('id_user', $userId)
            ->select(
                'id_detail_tugas',
                'id_jenis_kompen',
                'nama_tugas',
                'deskripsi_tugas',
                'kuota',
                'nilai_kompen',
                'created_at'
            )
            ->with('jenisKompen'); // Pastikan relasi jenisKompen ada di model TugasPendidik
    
        // Filter berdasarkan jenis_kompen jika ada
        if ($request->filled('jenis_kompen')) {
            $tugas->where('id_jenis_kompen', $request->jenis_kompen);
        }
    
        return DataTables::of($tugas)
            ->addIndexColumn()
            ->addColumn('jenis_kompen', function ($tugas) {
                return $tugas->jenisKompen ? $tugas->jenisKompen->nama_jenis_kompen : 'Tidak Ada';
            })
            ->editColumn('created_at', function ($tugas) {
                Carbon::setLocale('id'); // Set bahasa Indonesia
                return $tugas->created_at ? Carbon::parse($tugas->created_at)->translatedFormat('l, d F Y h:i A') : '-';
            })
            ->addColumn('aksi', function ($tugas) {
                return '<div class="btn-group" role="group">
                            <button onclick="modalAction(\''.url('/Pendidik/' . $tugas->id_detail_tugas . '/detail').'\')" 
                                class="btn btn-info btn-sm">
                                <i class="fas fa-eye"></i> Detail
                            </button>
                            <button onclick="modalAction(\''.url('/Pendidik/' . $tugas->id_detail_tugas . '/edit').'\')" 
                                class="btn btn-primary btn-sm">
                                <i class="fas fa-edit"></i> Edit
                            </button>
                            <button onclick="deleteAction(\''.url('/Pendidik/' . $tugas->id_detail_tugas . '/delete').'\')" 
                                class="btn btn-danger btn-sm">
                                <i class="fas fa-trash"></i> Hapus
                            </button>
                        </div>';
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }
}