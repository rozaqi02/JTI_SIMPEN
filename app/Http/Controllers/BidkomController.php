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
        return DataTables::of($bidkoms)
            ->addIndexColumn()
            ->addColumn('aksi', function ($bidkom) {
                $btn = '<button onclick="modalAction(\''.url('/bidkom/' . $bidkom->id_bidkom . '/show_ajax').'\')" class="btn btn-info btn-sm">Detail</button> ';
                $btn .= '<button onclick="modalAction(\''.url('/bidkom/' . $bidkom->id_bidkom . '/edit_ajax').'\')" class="btn btn-warning btn-sm">Edit</button> ';
                $btn .= '<button onclick="modalAction(\''.url('/bidkom/' . $bidkom->id_bidkom . '/delete_ajax').'\')" class="btn btn-danger btn-sm">Hapus</button> ';
                return $btn;
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }
    

    public function create_ajax()
    {
        return view('admin.bidkom.create_ajax');
    }

    public function store_ajax(Request $request)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $rules = [
                'kode_bidkom' => 'required|string|max:10|unique:t_bidkom,kode_bidkom',
                'nama_bidkom' => 'required|string|max:255'
            ];

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Validasi Gagal',
                    'msgField' => $validator->errors(),
                ]);
            }

            BidkomModel::create($request->all());
            return response()->json([
                'status' => true,
                'message' => 'Data bidang kompetensi berhasil disimpan'
            ]);
        }
    }

    public function edit_ajax($id)
    {
        $bidkom = BidkomModel::find($id);
        return view('admin.bidkom.edit_ajax')->with('bidkom', $bidkom);
    }

    public function update_ajax(Request $request, $id)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $rules = [
                'kode_bidkom' => 'required|string|max:10|unique:t_bidkom,kode_bidkom,' . $id . ',id_bidkom',
                'nama_bidkom' => 'required|string|max:255'
            ];

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Validasi Gagal',
                    'msgField' => $validator->errors(),
                ]);
            }

            $bidkom = BidkomModel::find($id);
            $bidkom->update($request->all());

            return response()->json([
                'status' => true,
                'message' => 'Data bidang komunikasi berhasil diperbarui'
            ]);
        }
    }

    public function delete_ajax($id)
    {
        $bidkom = BidkomModel::find($id);
        if ($bidkom) {
            $bidkom->delete();
            return response()->json([
                'status' => true,
                'message' => 'Data bidang komunikasi berhasil dihapus'
            ]);
        }
        return response()->json([
            'status' => false,
            'message' => 'Data tidak ditemukan'
        ]);
    }

    public function show_ajax($id)
    {
        $bidkom = BidkomModel::find($id);
        return view('admin.bidkom.show_ajax')->with('bidkom', $bidkom);
    }
}
