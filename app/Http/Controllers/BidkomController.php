<?php

namespace App\Http\Controllers;

use App\Models\BidkomModel;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class BidkomController extends Controller
{
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Daftar Bidang Kompetensi',
            'list' => ['Home', 'Bidkom']
        ];

        $page = (object) [
            'title' => 'Daftar Bidang Kompetensi yang Terdaftar dalam Sistem'
        ];

        $activeMenu = 'bidkom';

        return view('admin.bidkom.index', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'activeMenu' => $activeMenu
        ]);
    }
    public function list(Request $request)
    {
        $bidkoms = BidkomModel::select('id_bidkom', 'kode_bidkom', 'nama_bidkom');
        
        // Filter berdasarkan id_bidkom jika ada
        if ($request->has('id_bidkom') && $request->id_bidkom) {
            $bidkoms->where('id_bidkom', 'like', '%' . $request->id_bidkom . '%');
        }
    
        return DataTables::of($bidkoms)
            ->addIndexColumn()
            ->addColumn('aksi', function ($bidkom) {
                $btn = '<button onclick="modalAction(\''.url('/bidkom/' . $bidkom->id_bidkom . '/show_ajax').'\')" class="btn btn-info btn-sm">Detail</button> ';
                $btn .= '<button onclick="modalAction(\''.url('/bidkom/' . $bidkom->id_bidkom . '/edit_ajax').'\')" class="btn btn-warning btn-sm">Edit</button> ';
                $btn .= '<button onclick="modalAction(\''.url('/bidkom/' . $bidkom->id_bidkom . '/delete_ajax').'\')" class="btn btn-danger btn-sm">Hapus</button>';
                return $btn;
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }
    
    
    
    public function create_ajax()
    {
        // Pada contoh ini, tidak ada data terkait yang perlu diambil untuk BidkomModel.
        // Jika ada data tambahan yang diperlukan (misalnya data untuk dropdown), bisa diproses di sini.
        return view('admin.bidkom.create_ajax');
    }

    public function store_ajax(Request $request)
    {
        // Cek apakah request berupa AJAX atau JSON
        if ($request->ajax() || $request->wantsJson()) {
            // Validasi data
            $rules = [
                'kode_bidkom' => 'required|string|max:255|unique:t_bidkom',
                'nama_bidkom' => 'required|string|max:255',
            ];

            // Lakukan validasi
            $validator = Validator::make($request->all(), $rules);

            // Jika validasi gagal
            if ($validator->fails()) {
                return response()->json([
                    'status' => false, // Response status, false jika gagal
                    'message' => 'Validasi Gagal', 
                    'msgField' => $validator->errors(), // Pesan error validasi
                ]);
            }

            // Menyimpan data Bidkom ke database
            try {
                BidkomModel::create([
                    'kode_bidkom' => $request->kode_bidkom,
                    'nama_bidkom' => $request->nama_bidkom,
                ]);

                // Jika berhasil
                return response()->json([
                    'status' => true, // Response status, true jika berhasil
                    'message' => 'Data Bidang Kompetensi berhasil disimpan',
                ]);
            } catch (\Exception $e) {
                // Jika terjadi error saat menyimpan data
                return response()->json([
                    'status' => false, // Response status, false jika gagal
                    'message' => 'Terjadi kesalahan saat menyimpan data',
                ]);
            }
        }

        // Jika bukan request AJAX, redirect ke halaman utama
        return redirect('/');
    }
public function edit_ajax($id)
{
    $bidkom = BidkomModel::find($id);
    if ($bidkom) {
        return view('admin.bidkom.edit_ajax', compact('bidkom'));
    }

    return response()->json([
        'status' => false,
        'message' => 'Bidkom tidak ditemukan'
    ]);
}



public function update_ajax(Request $request, $id)
{
    if ($request->ajax() || $request->wantsJson()) {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'kode_bidkom' => 'required|max:255',
            'nama_bidkom' => 'required|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validasi gagal!',
                'msgField' => $validator->errors()
            ]);
        }

        $bidkom = BidkomModel::find($id);
        if ($bidkom) {
            // Update data
            $bidkom->update([
                'kode_bidkom' => $request->kode_bidkom,
                'nama_bidkom' => $request->nama_bidkom,
            ]);

            return response()->json([
                'status' => true,
                'message' => 'Data Bidkom berhasil diupdate!'
            ]);
        }

        return response()->json([
            'status' => false,
            'message' => 'Data Bidkom tidak ditemukan!'
        ]);
    }

    return redirect()->route('bidkom.index');
}

public function show_ajax($id)
{
    // Mengambil data Bidkom berdasarkan ID
    $bidkom = BidkomModel::find($id);

    // Pastikan data ditemukan
    if ($bidkom) {
        // Mengembalikan view show_ajax dengan membawa data Bidkom
        return view('admin.bidkom.show_ajax', ['bidkom' => $bidkom]);
    }

    // Jika data tidak ditemukan, mengembalikan response JSON dengan pesan error
    return response()->json([
        'status' => false,
        'message' => 'Bidkom tidak ditemukan',
    ]);
}


public function confirm_ajax(string $id)
{
    $bidkom = BidkomModel::find($id);

    return view('admin.bidkom.confirm_ajax', ['bidkom' => $bidkom]);
}

// Fungsi untuk menghapus data Bidkom
public function delete_ajax(Request $request, $id)
{
    if ($request->ajax() || $request->wantsJson()) {
        $bidkom = BidkomModel::find($id);
        if ($bidkom) {
            $bidkom->delete();
            return response()->json([
                'status'    => true,
                'message'   => 'Data berhasil dihapus!'
            ]);
        } else {
            return response()->json([
                'status'    => false,
                'message'   => 'Data tidak ditemukan!'
            ]);
        }
    }
    return redirect('/');
}


}