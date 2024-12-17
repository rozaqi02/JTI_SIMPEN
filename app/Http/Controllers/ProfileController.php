<?php

namespace App\Http\Controllers;

use App\Models\LevelModel;
use App\Models\UserModel;
use App\Models\AdminModel;
use App\Models\BidkomModel;
use App\Models\DosenModel;
use App\Models\TendikModel;
use App\Models\MahasiswaModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class ProfileController extends Controller
{
    public function index()
    {
        $id = session('id_user'); // ambil id_user dari session
        $breadcrumb = (object) [
            'title' => 'Profil',
            'list' => ['JTI-SIMPEN', 'Profil']
        ];
        $page = (object) [
            'title' => 'Profil Anda'
        ];
        $activeMenu = 'profile'; // set menu yang sedang aktif

        // Ambil data user lengkap dengan relasi level
        $user = UserModel::with('level')->find($id);

        // Ambil data terkait berdasarkan role pengguna
        $mahasiswa = MahasiswaModel::where('id_user', $id)->first();
        $admin = AdminModel::where('id_user', $id)->first();
        $dosen = DosenModel::where('id_user', $id)->first();
        $tendik = TendikModel::where('id_user', $id)->first();

        // Gabungkan data yang relevan berdasarkan role
        $data = [
            'user' => $user,
            'mahasiswa' => $mahasiswa,
            'admin' => $admin,
            'dosen' => $dosen,
            'tendik' => $tendik
        ];

        return view('profile.index', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'user' => $user,
            'data' => $data,  // data lengkap
            'activeMenu' => $activeMenu
        ]);
    }

    public function show(string $id)
    {
        $user = UserModel::with('level')->find($id);
        $breadcrumb = (object) ['title' => 'Detail User', 'list' => ['Home', 'User', 'Detail']];
        $page = (object) ['title' => 'Detail user'];
        $activeMenu = 'user'; // set menu yang sedang aktif
        return view('user.show', ['breadcrumb' => $breadcrumb, 'page' => $page, 'user' => $user, 'activeMenu' => $activeMenu]);
    }

    // public function edit_ajax(string $id)
    // {
    //     $user = UserModel::find($id);
    //     $level = LevelModel::select('level_id', 'level_nama')->get();
    //     return view('profile.edit_ajax', ['user' => $user, 'level' => $level]);
    // }


    public function edit_ajax(string $id)
    {
        $user = UserModel::findOrFail($id); // Gunakan findOrFail untuk menangani kasus tidak ditemukan
        
        // Ambil data sesuai tipe user
        $mahasiswa = MahasiswaModel::where('id_user', $id)->first();
        $admin = AdminModel::where('id_user', $id)->first();
        $dosen = DosenModel::where('id_user', $id)->first();
        $tendik = TendikModel::where('id_user', $id)->first();
        
        // Muat relasi yang diperlukan hanya jika mahasiswa tidak null
        if ($mahasiswa) {
            $mahasiswa->load('detailBidkom.bidkom');  // Memuat relasi bidkom
        } else {
            // Inisialisasi mahasiswa sebagai objek kosong jika null
            $mahasiswa = new MahasiswaModel();
        }
    
        // Ambil semua bidkom untuk dropdown
        $bidkoms = BidkomModel::all(); 
        
        // Mengambil data level untuk dropdown
        $levels = LevelModel::select('level_id', 'level_nama')->get();
    
        return view('profile.edit_ajax', [
            'user' => $user,
            'mahasiswa' => $mahasiswa,
            'admin' => $admin,
            'dosen' => $dosen,
            'tendik' => $tendik,
            'levels' => $levels,
            'bidkoms' => $bidkoms,  // Pastikan data bidkoms dikirim ke view
        ]);
    }

    public function update_ajax(Request $request, $id)
    {
        if (!$request->ajax() && !$request->wantsJson()) {
            return response()->json([
                'status' => false,
                'message' => 'Metode request tidak valid.'
            ], 405);
        }
    
        $user = UserModel::find($id);
    
        if (!$user) {
            return response()->json([
                'status' => false,
                'message' => 'User tidak ditemukan.'
            ]);
        }
    
        // Validasi input
        $rules = [
            'username' => 'required|max:20|unique:m_user,username,' . $id . ',id_user',
            'password' => 'nullable|min:5|max:20',
            'email' => 'nullable|email|max:255',
            'nip' => 'nullable|max:20',
            'nama_admin' => 'nullable|max:255',
            'nama_dosen' => 'nullable|max:255',
            'nama_tendik' => 'nullable|max:255',
            'no_telepon' => 'nullable|max:20',
        ];
    
        $validator = Validator::make($request->all(), $rules);
    
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validasi gagal.',
                'msgField' => $validator->errors()
            ]);
        }
    
        // Update data pengguna umum
        if ($request->filled('password')) {
            $user->password = bcrypt($request->password);
        }
    
        $user->username = $request->username;
        $user->save();
    
        // Update berdasarkan level_id dari user, bukan request
        if ($user->level_id == 1) { // Admin
            AdminModel::updateOrCreate(
                ['id_user' => $user->id_user], // Kondisi
                [
                    'nama_admin' => $request->nama_admin ?? $user->admin->nama_admin,
                    'nip' => $request->nip ?? $user->admin->nip,
                    'email' => $request->email ?? $user->admin->email,
                    'no_telepon' => $request->no_telepon ?? $user->admin->no_telepon,
                ]
            );
        } elseif ($user->level_id == 2) { // Dosen
            DosenModel::updateOrCreate(
                ['id_user' => $user->id_user],
                [
                    'nama_dosen' => $request->nama_dosen ?? $user->dosen->nama_dosen,
                    'nip' => $request->nip ?? $user->dosen->nip,
                    'email' => $request->email ?? $user->dosen->email,
                    'no_telepon' => $request->no_telepon ?? $user->dosen->no_telepon,
                ]
            );
        } elseif ($user->level_id == 3) { // Tendik
            TendikModel::updateOrCreate(
                ['id_user' => $user->id_user],
                [
                    'nama_tendik' => $request->nama_tendik ?? $user->tendik->nama_tendik,
                    'nip' => $request->nip ?? $user->tendik->nip,
                    'email' => $request->email ?? $user->tendik->email,
                    'no_telepon' => $request->no_telepon ?? $user->tendik->no_telepon,
                ]
            );
        }
        
    
        return response()->json([
            'status' => true,
            'message' => 'Data berhasil diperbarui.'
        ]);
    }
    
        public function edit_foto(string $id)
    {
        $user = UserModel::find($id);
        $level = LevelModel::select('level_id', 'level_nama')->get();
        return view('profile.edit_foto', ['user' => $user, 'level' => $level]);
    }


    public function update_foto(Request $request, $id)
    {
        // cek apakah request dari ajax
        if ($request->ajax() || $request->wantsJson()) {
            $rules = [
                'foto'   => 'required|mimes:jpeg,png,jpg|max:4096'
            ];
            // use Illuminate\Support\Facades\Validator;
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return response()->json([
                    'status' => false, // respon json, true: berhasil, false: gagal
                    'message' => 'Validasi gagal.',
                    'msgField' => $validator->errors() // menunjukkan field mana yang error
                ]);
            }
            $check = UserModel::find($id);
            if ($check) {
                if ($request->has('foto')) {

                    if (isset($check->foto)) {
                        $fileold = $check->foto;
                        if (Storage::disk('public')->exists($fileold)) {
                            Storage::disk('public')->delete($fileold);
                        }
                        $file = $request->file('foto');
                        $filename = $check->foto;
                        $path = 'image/profile/';
                        $file->move($path, $filename);
                        $pathname = $filename;
                    } else {
                        $file = $request->file('foto');
                        $extension = $file->getClientOriginalExtension();

                        $filename = time() . '.' . $extension;

                        $path = 'image/profile/';
                        $file->move($path, $filename);
                        $pathname = $path . $filename;
                    }
                }
                $check->update([
                    'foto'      => $pathname
                ]);
                return response()->json([
                    'status' => true,
                    'message' => 'Data berhasil diupdate'
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Data tidak ditemukan'
                ]);
            }
        }
        return redirect('/');
    }
}
