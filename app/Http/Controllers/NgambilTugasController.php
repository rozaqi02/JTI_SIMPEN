<?php

namespace App\Http\Controllers;
use App\Models\UserModel;
use App\Models\JenisKompen;
use App\Models\NgambilTugas;
use App\Models\TugasPendidik;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class NgambilTugasController extends Controller
{
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'List Tugas',
            'list' => ['Home', 'Tugasku', 'List Tugas']
        ];
    
        $page = (object) [
            'title' => 'List Tugas'
        ];
    
        $activeMenu = 'list-tugas';
    
        return view('mahasiswa.list-tugas.index', [
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
    // Query builder untuk data NgambilTugas
    $NgambilTugass = NgambilTugas::with(['user', 'jenisKompen'])
        ->select('id_detail_tugas', 'id_user', 'id_jenis_kompen', 'nama_tugas', 'deskripsi_tugas', 'kuota', 'nilai_kompen');

    // Filter berdasarkan nama_tugas
    if ($request->filled('nama_tugas')) {
        $NgambilTugass->where('nama_tugas', 'like', '%' . $request->nama_tugas . '%');
    }

    // Filter berdasarkan kuota
    if ($request->filled('kuota')) {
        $NgambilTugass->where('kuota', '>=', $request->kuota);
    }

    return DataTables::of($NgambilTugass)
        ->addIndexColumn()
        ->addColumn('jenis_kompen', function ($tugas) {
            return $tugas->jenisKompen ? $tugas->jenisKompen->nama_jenis_kompen : 'Tidak Ada';
        })
        ->addColumn('pemberi_tugas', function ($tugas) {
            return $tugas->user ? $tugas->user->username : 'Tidak Ada';
        })
        ->addColumn('aksi', function ($tugas) {
            $btn = '<button onclick="modalAction(\''.url('/mahasiswa/list-tugas/' . $tugas->id_detail_tugas . '/apply_ajax').'\')" class="btn btn-primary btn-sm">Ambil</button>';
            return $btn;
        })
        ->rawColumns(['aksi'])
        ->make(true);
}
}
