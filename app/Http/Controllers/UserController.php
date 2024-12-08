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
            'title' => 'Daftar Pengguna',
            'list' => ['Home', 'User']
        ];

        $page = (object) [
            'title' => 'Daftar Pengguna yang Terdaftar dalam Sistem Kompen'
        ];

        $activeMenu = 'user';

        $level = LevelModel::all();

        return view('user.index', [
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

        if ($request->level_id) {
            $users->where('level_id', $request->level_id);
        }

        return DataTables::of($users)
            ->addIndexColumn()
            ->editColumn('password', function ($user) {
                return '******';
            })
            ->addColumn('aksi', function ($user) {
                 /* $btn  = '<a href="'.url('/user/' . $user->user_id).'" class="btn btn-info btn-sm">Detail</a> ';  
            $btn .= '<a href="'.url('/user/' . $user->user_id . '/edit').'" class="btn btn-warning btn-sm">Edit</a> ';  
            $btn .= '<form class="d-inline-block" method="POST" action="'. url('/user/'.$user->user_id).'">'  
                    . csrf_field() . method_field('DELETE') .   
                    '<button type="submit" class="btn btn-danger btn-sm" onclick="returnconfirm(\'Apakah Anda yakit menghapus data ini?\');">Hapus</button></form>';*/ 
            $btn  = '<button onclick="modalAction(\''.url('/user/' . $user->user_id . '/show_ajax').'\')" class="btn btn-info btn-sm">Detail</button> '; 
            $btn .= '<button onclick="modalAction(\''.url('/user/' . $user->user_id . '/edit_ajax').'\')" class="btn btn-warning btn-sm">Edit</button> '; 
            $btn .= '<button onclick="modalAction(\''.url('/user/' . $user->user_id . '/delete_ajax').'\')"  class="btn btn-danger btn-sm">Hapus</button> '; 
            return $btn;  
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }

    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required|string|min:3|unique:m_user,username',
            'password' => 'required|min:5',
            'level_id' => 'required|integer'
        ]);

        UserModel::create([
            'username' => $request->username,
            'password' => bcrypt($request->password),
            'level_id' => $request->level_id
        ]);

        return redirect('/user')->with('success', 'Data user berhasil disimpan!');
    }

    public function create_ajax($id)
    {
        $level = LevelModel::select('level_id', 'level_nama')->get();

        return view('user.create_ajax')
        ->with('level', $level);
    }

    public function edit_ajax($id)
    {
        $user = UserModel::find($id);
        $level = LevelModel::select('level_id', 'level_nama')->get();

        return view('user.edit_ajax', ['user' => $user, 'level' => $level]);
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
        // cek apakah request berupa ajax
        if($request->ajax() || $request->wantsJson()){
        $rules = [
        'level_id' => 'required integer',
        'username' => 'required|string|min:3|unique:m_user, username',
        'password' => 'required min:6'
        ];
        // use Illuminate\Support\Facades\Validator;
        $validator = Validator:: make ($request->all(), $rules);
        if($validator->fails()){
        return response()->json([
        'status' => false, // response status, false: error/gagal, true: berhasil
        'message' => 'Validasi Gagal',
        'msgField' => $validator->errors(), // pesan error validasi
        ]);
        }
        UserModel::create($request->all());
        return response()->json([
        'status' => true,
        'message' => 'Data user berhasil disimpan'
        ]);
        }
        redirect('/');
    }

    public function confirm_ajax(string $id) {
        $user = UserModel::find($id);

        return view('user.confirm_ajax', ['user'=> $user]);
    }    

    public function delete_ajax (Request $request, $id)
{
// cek apakah request dari ajax
if ($request->ajax() || $request->wantsJson()) {
$user = UserModel::find($id);
if ($user) {
$user->delete();
return response()->json([
'status' => true,
'message' => 'Data berhasil dihapus'
]);
} else {
return response()->json ([
'status' => false,
'message' => 'Data tidak ditemukan'
]);
}
}
return redirect('/');
}
    public function destroy($id)
    {
        $user = UserModel::find($id);
        if ($user) {
            $user->delete();
            return response()->json([
                'status' => true,
                'message' => 'Data user berhasil dihapus!'
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Data user tidak ditemukan!'
            ]);
        }
    }
}
