<?php

namespace App\Http\Controllers;

use App\Models\LevelModel;
use App\Models\UserModel;
use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;


class UserController extends Controller
{
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Daftar Pengguna Kompen',
            'list' => ['JTI SIMPEN  ', 'Pengguna']
        ];

        $page = (object) [
            'title' => 'Daftar Pengguna yang Terdaftar dalam Sistem Kompen'
        ];

        $activeMenu = 'user';

        $level = LevelModel::all();

        return view('admin.user.index', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'level' => $level,
            'activeMenu' => $activeMenu
        ]);
    }

    public function list(Request $request)
    {
        $users = UserModel::select('id_user', 'username', 'level_id', 'password')
            ->with('level');
        
        // Menggunakan when untuk filter berdasarkan level_id jika ada
        if ($request->level_id) {
            $users->where('level_id', $request->level_id);
        }
    
        return DataTables::of($users)
            ->addIndexColumn()
            ->editColumn('password', function ($user) {
                return '******';  // Menyembunyikan password
            })
            ->addColumn('aksi', function ($user) {
                // Tombol Detail
                $btn = '<button onclick="modalAction(\'' . url('/user/' . $user->id_user . '/show_ajax') . '\')" class="btn btn-info btn-sm">Detail</button> ';
                $btn .= '<button onclick="modalAction(\'' . url('/user/' . $user->id_user . '/edit_ajax') . '\')" class="btn btn-warning btn-sm">Edit</button> ';
                $btn .= '<button onclick="modalAction(\'' . url('/user/' . $user->id_user . '/delete_ajax') . '\')" class="btn btn-danger btn-sm">Hapus</button> '; // Tombol Hapus menjadi merah
                return $btn;
            })
            ->rawColumns(['aksi'])  // Menandai kolom aksi untuk diproses sebagai HTML
            ->make(true);
    }
    
    


    public function create_ajax()
{
    $level = LevelModel::all();  // Ambil data level untuk dropdown
    return view('admin.user.create_ajax', compact('level'));
}

public function edit_ajax($id)
{
    // Ambil data user berdasarkan ID yang dikirimkan
    $user = UserModel::find($id);
    if ($user) {
        // Ambil data level untuk dropdown
        $level = LevelModel::all();
        // Kembalikan view untuk form edit user
        return view('admin.user.edit_ajax', ['user' => $user, 'level' => $level]);
    }
    
    // Jika data user tidak ditemukan
    return response()->json([
        'status' => false,
        'message' => 'User tidak ditemukan'
    ]);
}


    public function update_ajax(Request $request, $id)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $rules = [
                'level_id' => 'required|integer',
                'username' => 'required|max:20|unique:m_user,username,' . $id . ',id_user',
                'password' => 'nullable|min:5|max:20',
            ];

            // use Illuminate\Support\Facades\Validator
            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Validasi gagal!',
                    'msgField' => $validator->errors()
                ]);
            }

            $user = UserModel::find($id);
            if ($user) {
                $data = [
                    'username' => $request->username,
                    'level_id' => $request->level_id,
                ];

                if ($request->filled('password')) {
                    $data['password'] = bcrypt($request->password);
                }

                $user->update($data);

                return response()->json([
                    'status' => true,
                    'message' => 'Data berhasil diupdate!'
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Data tidak ditemukan!'
                ]);
            }
        }

        return redirect('/user');   
    }

    public function store_ajax(Request $request) {
        // Cek apakah request berupa AJAX
        if ($request->ajax() || $request->wantsJson()) {
            // Validasi data
            $rules = [
                'level_id' => 'required|integer',
                'username' => 'required|string|min:3|unique:m_user,username',
                'password' => 'required|min:6'
            ];
    
            $validator = Validator::make($request->all(), $rules);
    
            if ($validator->fails()) {
                return response()->json([
                    'status' => false, // Response status, false: error/gagal, true: berhasil
                    'message' => 'Validasi Gagal',
                    'msgField' => $validator->errors(), // Pesan error validasi
                ]);
            }
    
            // Menyimpan data
            UserModel::create([
                'username' => $request->username,
                'password' => bcrypt($request->password),
                'level_id' => $request->level_id,
            ]);
    
            return response()->json([
                'status' => true,
                'message' => 'Data user berhasil disimpan'
            ]);
        }
    
        return redirect('/');
    }

    public function show_ajax($id)
{
    // Mengambil data User berdasarkan ID
    $user = UserModel::find($id);

    // Pastikan data ditemukan
    if ($user) {
        // Mengembalikan view show_ajax dengan membawa data User
        return view('admin.user.show_ajax', ['user' => $user]);
    }

    // Jika data tidak ditemukan, mengembalikan response JSON dengan pesan error
    return response()->json([
        'status' => false,
        'message' => 'User tidak ditemukan',
    ]);
}

    
 // Menampilkan konfirmasi penghapusan di modal
 public function confirm_ajax(string $id){
    $user = UserModel::find($id);

    return view('admin.user.confirm_ajax', ['user' => $user]);
}

//Menghapus data user AJAX
public function delete_ajax(Request $request, $id)
{
    if ($request->ajax() || $request->wantsJson()) {
        $user = UserModel::find($id);
        if ($user) {
            $user->delete();
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
