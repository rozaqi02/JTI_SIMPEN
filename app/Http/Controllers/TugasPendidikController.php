<?php

namespace App\Http\Controllers;
use App\Models\UserModel;
use App\Models\JenisKompen;
use App\Models\TugasPendidik;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Http\Request;

class TugasPendidikController extends Controller
{
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Manajemen Daftar Tugas',
            'list' => ['Home', 'Manajemen', 'Daftar Tugas Pendidik']
        ];

        $page = (object) [
            'title' => 'Daftar Tugas'
        ];

        $activeMenu = 'daftar-tugas';

        // Mengambil data dari model
        $TugasPendidik = TugasPendidik::latest()->get();

        return view('admin.tugas-pendidik.index', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'activeMenu' => $activeMenu,
            'TugasPendidik' => $TugasPendidik
        ]);
    }
    public function list(Request $request)
    {
        $tugasPendidiks = TugasPendidik::with(['user', 'jenisKompen'])
            // ->select('id_detail_tugas', 'nama_tugas', 'deskripsi_tugas', 'kuota', 'nilai_kompen', 'm_user.id_user', 'm_jenis_kompen.id_jenis_kompen')
            // ->join('m_user', 'm_user.id_user', '=', 'm_detail_tugas.id_user')
            // ->join('m_jenis_kompen', 'm_jenis_kompen.id_jenis_kompen', '=', 'm_detail_tugas.id_jenis_kompen');
            ->get();
            
        // Filter berdasarkan nama_tugas jika ada
        if ($request->has('nama_tugas') && $request->nama_tugas) {
            $tugasPendidiks->where('nama_tugas', 'like', '%' . $request->nama_tugas . '%');
        }
    
        // Filter berdasarkan kuota jika ada
        if ($request->has('kuota') && $request->kuota) {
            $tugasPendidiks->where('kuota', '>=', $request->kuota);
        }
    
        return DataTables::of($tugasPendidiks)
            ->addIndexColumn()
            ->addColumn('aksi', function ($tugasPendidik) {
                $btn = '<button onclick="modalAction(\''.url('/tugas-pendidik/' . $tugasPendidik->id_detail_tugas . '/show_ajax').'\')" class="btn btn-info btn-sm">Detail</button> ';
                $btn .= '<button onclick="modalAction(\''.url('/tugas-pendidik/' . $tugasPendidik->id_detail_tugas . '/edit_ajax').'\')" class="btn btn-warning btn-sm">Edit</button> ';
                $btn .= '<button onclick="modalAction(\''.url('/tugas-pendidik/' . $tugasPendidik->id_detail_tugas . '/delete_ajax').'\')" class="btn btn-danger btn-sm">Hapus</button>';
                return $btn;
            })
            ->addColumn('user_name', function ($tugasPendidik) {
                return $tugasPendidik->user ? $tugasPendidik->user->username : 'N/A';
            })
            ->addColumn('jenis_kompen', function ($tugasPendidik) {
                return $tugasPendidik->jenisKompen ? $tugasPendidik->jenisKompen->nama_jenis_kompen : 'N/A';
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }
        

}
