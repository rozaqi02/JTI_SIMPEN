<?php

namespace App\Http\Controllers;

use App\Models\LevelModel;
use App\Models\UserModel;
use App\Models\AdminModel;
use App\Models\DosenModel;
use App\Models\TendikModel;
use App\Models\MahasiswaModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    public function index()
    {
        $id = session('id_user'); // ambil id_user dari session
        $breadcrumb = (object) [
            'title' => 'Profil',
            'list' => ['JTI SIMPEN', 'profile']
        ];
        $page = (object) [
            'title' => 'Profile Anda'
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
        $user = UserModel::find($id); // Cari data user berdasarkan id_user
        if (!$user) {
            return abort(404, 'Data tidak ditemukan');
        }
    
        // Tentukan model yang digunakan berdasarkan level user
        $mahasiswa = MahasiswaModel::where('id_user', $id)->first();
        $admin = AdminModel::where('id_user', $id)->first();
        $dosen = DosenModel::where('id_user', $id)->first();
        $tendik = TendikModel::where('id_user', $id)->first();
    
        return view('profile.edit_ajax', [
            'user' => $user,
            'mahasiswa' => $mahasiswa,
            'admin' => $admin,
            'dosen' => $dosen,
            'tendik' => $tendik,
            'level' => LevelModel::select('level_id', 'level_nama')->get()
        ]);
    }
    


    public function update_ajax(Request $request, $id)
    {
        // Cek apakah request dari ajax
        if ($request->ajax() || $request->wantsJson()) {
            // Validasi data input
            $rules = [
                'level_id' => 'nullable|integer',
                'username' => 'nullable|max:20|unique:m_user,username,' . $id . ',id_user',
                'password' => 'nullable|min:6|max:20',
                // Aturan validasi untuk masing-masing role (Admin, Dosen, Tendik, Mahasiswa)
                'nama_admin' => 'nullable|max:255',
                'nip' => 'nullable|max:20',
                'no_telepon' => 'nullable|max:20',
                'email' => 'nullable|email|max:255',
                'nama_dosen' => 'nullable|max:255',
                'nama_tendik' => 'nullable|max:255',
                'nama_mahasiswa' => 'nullable|max:255',
                'program_studi' => 'nullable|max:100',
                'tahun_masuk' => 'nullable|integer'
            ];
    
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Validasi gagal.',
                    'msgField' => $validator->errors()
                ]);
            }
    
            // Mencari data user
            $check = UserModel::find($id);
            if ($check) {
                // Perbarui data user (username, password, level_id)
                if ($request->filled('password')) {
                    $request->merge(['password' => bcrypt($request->password)]);
                }
    
                $check->update([
                    'username' => $request->username,
                    'password' => $request->password ?? $check->password,
                    'level_id' => $request->level_id
                ]);
    
                // Update data berdasarkan level/role
                if ($request->level_id == 1 && $check->level->level_nama == 'Admin' && $request->filled('nama_admin')) {
                    // Update data untuk Admin
                    $admin = AdminModel::where('id_user', $id)->first();
                    if ($admin) {
                        $admin->update([
                            'nama_admin' => $request->nama_admin,
                            'nip' => $request->nip,
                            'email' => $request->email,
                            'no_telepon' => $request->no_telepon
                        ]);
                    }
                }
    
                if ($request->level_id == 2 && $check->level->level_nama == 'Dosen' && $request->filled('nama_dosen')) {
                    // Update data untuk Dosen
                    $dosen = DosenModel::where('id_user', $id)->first();
                    if ($dosen) {
                        $dosen->update([
                            'nama_dosen' => $request->nama_dosen,
                            'nip' => $request->nip,
                            'email' => $request->email,
                            'no_telepon' => $request->no_telepon
                        ]);
                    }
                }
    
                if ($request->level_id == 3 && $check->level->level_nama == 'Tendik' && $request->filled('nama_tendik')) {
                    // Update data untuk Tendik
                    $tendik = TendikModel::where('id_user', $id)->first();
                    if ($tendik) {
                        $tendik->update([
                            'nama_tendik' => $request->nama_tendik,
                            'nip' => $request->nip,
                            'email' => $request->email,
                            'no_telepon' => $request->no_telepon
                        ]);
                    }
                }
    
                if ($request->level_id == 4 && $check->level->level_nama == 'Mahasiswa' && $request->filled('nama_mahasiswa')) {
                    // Update data untuk Mahasiswa
                    $mahasiswa = MahasiswaModel::where('id_user', $id)->first();
                    if ($mahasiswa) {
                        $mahasiswa->update([
                            'nama_mahasiswa' => $request->nama_mahasiswa,
                            'nim' => $request->nim,
                            'email' => $request->email,
                            'program_studi' => $request->program_studi,
                            'tahun_masuk' => $request->tahun_masuk
                        ]);
                    }
                }
    
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
    
        // Jika bukan request AJAX atau JSON, redirect ke halaman utama
        return redirect('/');
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