<?php 
namespace App\Http\Controllers;

use App\Models\TugasPendidik;
use App\Models\JenisKompen;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
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
                // Format tanggal dengan Carbon
                Carbon::setLocale('id'); // Mengatur locale Indonesia
                return $tugas->created_at ? Carbon::parse($tugas->created_at)->translatedFormat('l, d F Y h:i A') : '-';
            })
            ->addColumn('aksi', function ($tugas) {
                $btn = '<button onclick="modalAction(\''.url('/Pendidik/' . $tugas->id_detail_tugas . '/detail').'\')" class="btn btn-info btn-sm">Detail</button> ';
                $btn .= '<button onclick="modalAction(\''.url('/Pendidik/' . $tugas->id_detail_tugas . '/edit').'\')" class="btn btn-warning btn-sm">Edit</button> ';
                $btn .= '<button onclick="modalAction(\''.url('/Pendidik/' . $tugas->id_detail_tugas . '/confirm_ajax').'\')" class="btn btn-danger btn-sm">Hapus</button>';
                return $btn;
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }
    
    public function create_ajax()
    {
        $jenisKompen = JenisKompen::all(); // Mengambil data JenisKompen untuk dropdown
        return view('Admin.Pendidik.create_ajax', compact('jenisKompen'));
    }
    

    public function store_ajax(Request $request)
    {
        // Debugging log input request (untuk memeriksa input)
        Log::info('Input Request: ', $request->all());
    
        $validator = Validator::make($request->all(), [
            'id_jenis_kompen' => 'required|exists:m_jenis_kompen,id_jenis_kompen',
            'nama_tugas' => 'required|string|max:255',
            'deskripsi_tugas' => 'required|string|max:1000',
            'kuota' => 'required|integer|min:1',
            'nilai_kompen' => 'required|integer|min:0',
        ]);
    
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validasi gagal!',
                'msgField' => $validator->errors(),
            ]);
        }
    
        try {
            // Simpan tugas
            TugasPendidik::create([
                'id_user' => Auth::id(), // Mendapatkan ID pengguna login
                'id_jenis_kompen' => $request->id_jenis_kompen,
                'nama_tugas' => $request->nama_tugas,
                'deskripsi_tugas' => $request->deskripsi_tugas,
                'kuota' => $request->kuota,
                'nilai_kompen' => $request->nilai_kompen,
                'created_at' => Carbon::now(), // Pastikan menggunakan waktu sekarang
            ]);
    
            return response()->json([
                'status' => true,
                'message' => 'Tugas berhasil ditambahkan!',
            ]);
        } catch (\Exception $e) {
            Log::error('Error Store Ajax: ', ['error' => $e->getMessage()]);
            return response()->json([
                'status' => false,
                'message' => 'Terjadi kesalahan saat menyimpan data.',
            ]);
        }
    }
}    