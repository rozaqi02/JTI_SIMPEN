<?php

namespace App\Http\Controllers;

use App\Models\JenisKompen;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Http\Request;

class JenisKompenController extends Controller
{
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Manajemen Data Jenis Kompen',
            'list' => ['Home', 'Manajemen', 'Data Jenis Kompen']
        ];

        $page = (object) [
            'title' => 'Data Jenis Kompen'
        ];

        $activeMenu = 'jenis-kompen'; // Menu aktif untuk halaman ini

        // Mengambil data dari model
        $jenisKompen = JenisKompen::all();

        return view('admin.jenis-kompen.index', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'activeMenu' => $activeMenu,
            'jenisKompen' => $jenisKompen
        ]);

    }

    public function list(Request $request)
    {
        $jenisKompen = JenisKompen::select('id_jenis_kompen', 'nama_jenis_kompen');
    
        // Filter berdasarkan nama_jenis_kompen jika ada
        if ($request->has('nama_jenis_kompen') && $request->nama_jenis_kompen) {
            $jenisKompen->where('nama_jenis_kompen', 'like', '%' . $request->nama_jenis_kompen . '%');
        }
    
        return DataTables::of($jenisKompen)
            ->addIndexColumn() // Kolom index untuk nomor urut
            ->make(true); // Hanya mengembalikan data yang diperlukan tanpa kolom aksi
    }
    
    

}
