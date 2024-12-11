<?php 

namespace App\Http\Controllers;

use App\Models\TugasPendidik;
use App\Models\JenisKompen;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
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
    if ($request->ajax() || $request->wantsJson()) {
        $rules = [
            'id_jenis_kompen' => 'required|exists:t_jenis_kompen,id_jenis_kompen',
            'nama_tugas' => 'required|string|max:255',
            'deskripsi_tugas' => 'required|string|max:1000',
            'kuota' => 'required|integer|min:1',
            'nilai_kompen' => 'required|numeric|min:0',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validasi Gagal',
                'msgField' => $validator->errors(),
            ]);
        }

        try {
            TugasPendidik::create([
                'id_user' => Auth::id(),
                'id_jenis_kompen' => $request->id_jenis_kompen,
                'nama_tugas' => $request->nama_tugas,
                'deskripsi_tugas' => $request->deskripsi_tugas,
                'kuota' => $request->kuota,
                'nilai_kompen' => $request->nilai_kompen,
            ]);

            return response()->json([
                'status' => true,
                'message' => 'Data Tugas berhasil disimpan',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Terjadi kesalahan saat menyimpan data.',
            ]);
        }
    }

    return redirect('/');
}


}