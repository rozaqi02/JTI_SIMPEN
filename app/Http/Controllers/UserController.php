<?php

namespace App\Http\Controllers;

use App\Models\LevelModel;
use App\Models\UserModel;
use App\Models\AdminModel;
use App\Models\DosenModel;
use App\Models\TendikModel;
use App\Models\MahasiswaModel;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use PhpOffice\PhpSpreadsheet\IOFactory; // Import PhpSpreadsheet
use PhpOffice\PhpSpreadsheet\Exception;
use Barryvdh\DomPDF\Facade\Pdf; // Import DomPDF
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;


class UserController extends Controller
{
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Data Pengguna JTI-SIMPEN',
            'list' => ['JTI-SIMPEN  ', 'Manajemen', 'Data Pengguna']
        ];

        $page = (object) [
            'title' => 'Daftar Pengguna yang Terdaftar Dalam Sistem Kompen'
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
                return '';  // Menyembunyikan password
            })
            ->addColumn('aksi', function ($user) {
                // Tombol Detail
                $btn = '<button onclick="modalAction(\'' . url('/user/' . $user->id_user . '/show_ajax') . '\')" class="btn btn-info btn-sm">Detail</button> ';
                $btn .= '<button onclick="modalAction(\'' . url('/user/' . $user->id_user . '/edit_ajax') . '\')" class="btn btn-warning btn-sm">Edit</button> ';
                $btn .= '<button onclick="modalAction(\'' . url('/user/' . $user->id_user . '/confirm_ajax') . '\')" class="btn btn-danger btn-sm">Hapus</button> '; // Tombol Hapus menjadi merah
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
                'password' => 'required|min:5'
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

    public function show_ajax(string $id)
    {
        $user = UserModel::find($id);

        if (!$user) {
            return response()->json([
                'status' => false,
                'message' => 'Data tidak ditemukan'
            ]);
        }

        // Ambil data berdasarkan level
        $admin = null;
        $dosen = null;
        $tendik = null;
        $mahasiswa = null;

        if ($user->level_id == 1) {
            $admin = AdminModel::where('id_user', $user->id_user)->first();
        } elseif ($user->level_id == 2) {
            $dosen = DosenModel::where('id_user', $user->id_user)->first();
        } elseif ($user->level_id == 3) {
            $tendik = TendikModel::where('id_user', $user->id_user)->first();
        } elseif ($user->level_id == 4) {
            $mahasiswa = MahasiswaModel::where('id_user', $user->id_user)->first();
        }

        return view('admin.user.show_ajax', compact('user', 'admin', 'dosen', 'tendik', 'mahasiswa'));
    }


 // Menampilkan konfirmasi penghapusan di modal
 public function confirm_ajax(string $id)
 {
     $user = UserModel::find($id);

     if (!$user) {
         return response()->json([
             'status' => false,
             'message' => 'Data tidak ditemukan'
         ]);
     }

     // Ambil data tambahan berdasarkan level_id
     $admin = null;
     $dosen = null;
     $tendik = null;
     $mahasiswa = null;

     if ($user->level_id == 1) {
         $admin = AdminModel::where('id_user', $user->id_user)->first();
     } elseif ($user->level_id == 2) {
         $dosen = DosenModel::where('id_user', $user->id_user)->first();
     } elseif ($user->level_id == 3) {
         $tendik = TendikModel::where('id_user', $user->id_user)->first();
     } elseif ($user->level_id == 4) {
         $mahasiswa = MahasiswaModel::where('id_user', $user->id_user)->first();
     }

     return view('admin.user.confirm_ajax', compact('user', 'admin', 'dosen', 'tendik', 'mahasiswa'));
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

// Import Data
public function import()
{
    return view('admin.user.import_ajax');
}

public function import_ajax(Request $request)
{
    if ($request->ajax() || $request->wantsJson()) {
        $rules = [
            // validasi file harus xls atau xlsx, max 1MB
            'file_user' => ['required', 'mimes:xlsx', 'max:1024']
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validasi Gagal',
                'msgField' => $validator->errors()
            ]);
        }
        $file = $request->file('file_user'); // ambil file dari request
        $reader = IOFactory::createReader('Xlsx'); // load reader file excel
        $reader->setReadDataOnly(true); // hanya membaca data
        $spreadsheet = $reader->load($file->getRealPath()); // load file excel
        $sheet = $spreadsheet->getActiveSheet(); // ambil sheet yang aktif
        $data = $sheet->toArray(null, false, true, true); // ambil data excel
        $insert = [];
        if (count($data) > 1) { // jika data lebih dari 1 baris
            foreach ($data as $baris => $value) {
                if ($baris > 1) { // baris ke 1 adalah header, maka lewati
                    $insert[] = [
                        'level_id' => $value['A'],
                        'username' => $value['B'],
                        'created_at' => now(),
                    ];
                }
            }
            if (count($insert) > 0) {
                // insert data ke database, jika data sudah ada, maka diabaikan
                UserModel::insertOrIgnore($insert);
            }
            return response()->json([
                'status' => true,
                'message' => 'Data berhasil di-import'
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Tidak ada data yang di-import'
            ]);
        }
    }
    return redirect('/');
}


public function export_pdf() {
    set_time_limit(600);
    $user = UserModel::select('level_id', 'username')
        ->orderBy('level_id')
        ->orderBy('username')
        ->with('level')
        ->get();

    // use Barryvdh\DomPDF\Facade\Pdf;
    $pdf = Pdf::loadView('admin.user.export_pdf', ['user' => $user]);

    $pdf->setPaper('a4', 'portrait'); // set ukuran kertas dan orientasi
    $pdf->setOption("isRemoteEnabled", true); // set true jika ada gambar dari uri
    $pdf->render();

    return $pdf->stream('Data user '.date('Y-m-d H:i:s').'.pdf');
}
}

