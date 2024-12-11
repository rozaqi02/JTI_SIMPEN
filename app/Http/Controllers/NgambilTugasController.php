<?php

namespace App\Http\Controllers;
use App\Models\UserModel;
use App\Models\JenisKompen;
use App\Models\NgambilTugas;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class NgambilTugasController extends Controller
{
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Daftar Tugas',
            'list' => ['Home', 'Tugasku', 'Daftar Tugas']
        ];
    
        $page = (object) [
            'title' => 'Daftar Tugas'
        ];
    
        $activeMenu = 'daftar-tugas';
    
        return view('mahasiswa.daftar-tugas.index', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'activeMenu' => $activeMenu
        ]);
    }
    

    public function show($id)
{
    $tugas = NgambilTugas::with(['user', 'jenisKompen'])->findOrFail($id);
    return response()->json([
        'pemberi_tugas' => $tugas->user->username,
        'judul_tugas' => $tugas->nama_tugas,
        'jenis_tugas' => $tugas->jenisKompen->nama_jenis_kompen,
        'jumlah_jam' => $tugas->nilai_kompen,
        'deskripsi_tugas' => explode("\n", $tugas->deskripsi_tugas),
    ]);
}

public function list(Request $request)
{
    $tugasMahasiswa = NgambilTugas::with(['jenisKompen'])
        ->select(
            'id_detail_tugas',
            'nama_tugas',
            'id_jenis_kompen',
            'kuota',
            'nilai_kompen'
        );

    return DataTables::of($tugasMahasiswa)
        ->addIndexColumn()
        ->addColumn('jenis_kompen', function ($tugas) {
            return $tugas->jenisKompen ? $tugas->jenisKompen->nama_jenis_kompen : 'Tidak Ada';
        })
        ->addColumn('aksi', function ($tugas) {
            return '<button onclick="ambilTugas(' . $tugas->id_detail_tugas . ')" class="btn btn-primary btn-sm">Ambil</button>';
        })
        ->rawColumns(['aksi'])
        ->make(true);
}


    public function create_ajax()
    {
    // Mengambil data level dan jenis kompensasi untuk dropdown
    $jenisKompen = JenisKompen::all(); // Ambil data jenis kompensasi untuk dropdown
    $users = UserModel::all(); // Ambil data user untuk dropdown
    
    // Mengembalikan view dengan data yang diperlukan
    return view('admin.tugas-pendidik.create_ajax', compact('jenisKompen', 'users'));
    }

    public function store_ajax(Request $request)
{
    // Cek apakah request berupa AJAX
    if ($request->ajax() || $request->wantsJson()) {
        // Validasi data
        $rules = [
            'nama_tugas' => 'required|string|min:3',
            'deskripsi_tugas' => 'required|string|min:5',
            'kuota' => 'required|integer|min:1',
            'nilai_kompen' => 'required|numeric|min:0',
            'user_id' => 'required|exists:m_user,id_user',
            'jenis_kompen_id' => 'required|exists:m_jenis_kompen,id_jenis_kompen',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'status' => false, // Response status, false: error/gagal, true: berhasil
                'message' => 'Validasi Gagal',
                'msgField' => $validator->errors(), // Pesan error validasi
            ]);
        }

        // Menyimpan data tugas pendidik
        TugasPendidik::create([
            'nama_tugas' => $request->nama_tugas,
            'deskripsi_tugas' => $request->deskripsi_tugas,
            'kuota' => $request->kuota,
            'nilai_kompen' => $request->nilai_kompen,
            'user_id' => $request->user_id, // ID user yang terkait
            'jenis_kompen_id' => $request->jenis_kompen_id, // ID jenis kompensasi
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Tugas Pendidik berhasil disimpan'
        ]);
    }

    return redirect('/');
}


        

}
