<?php

namespace App\Http\Controllers;

use App\Models\LevelModel;
use App\Models\UserModel;
use App\Models\MahasiswaModel;
use App\Models\AdminModel;
use App\Models\DosenModel;
use App\Models\TendikModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    public function index()
    {
        $id = session('id_user');
        $breadcrumb = (object) [
            'title' => 'Profile',
            'list' => ['JTI SIMPEN', 'profil']
        ];
        $page = (object) [
            'title' => 'Profil Anda'
        ];
        $activeMenu = 'profile'; // set menu yang sedang aktif
        $user = UserModel::with('level')->find($id);
        
        // Menentukan model berdasarkan level
        $levelCode = $user->getRole(); // Ambil kode level pengguna
        switch ($levelCode) {
            case 'MHS': // Mahasiswa
                $profileData = MahasiswaModel::where('id_mahasiswa', $id)->first();
                break;
            case 'DSN': // Dosen
                $profileData = DosenModel::find($id); 
                break;
            case 'ADM': // Admin
                $profileData = AdminModel::find($id); 
                break;
            case 'TDK': // Tendik
                $profileData = TendikModel::find($id);
                break;
            default:
                $profileData = null; // Jika tidak ada level yang cocok
                break;
        }

        $level = LevelModel::all(); // ambil data level untuk filter level
        return view('profile.index', [
            'breadcrumb' => $breadcrumb, 
            'page' => $page, 
            'level' => $level, 
            'user' => $user, 
            'profileData' => $profileData, // Mengirim data profil pengguna
            'activeMenu' => $activeMenu
        ]);
    }

    public function update_ajax(Request $request, $id)
    {
        // Validasi dan update data profil berdasarkan level
        $rules = [
            'level_id' => 'nullable|integer',
            'username' => 'nullable|max:20|unique:m_user,username,' . $id . ',id_user',
            'password' => 'nullable|min:6|max:20'
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validasi gagal.',
                'msgField' => $validator->errors()
            ]);
        }

        $check = UserModel::find($id);
        if ($check) {
            // Hapus data berdasarkan level yang relevan
            $levelCode = $check->getRole();
            $model = $this->getProfileModelByLevel($levelCode);
            $modelInstance = $model::find($id);
            if ($modelInstance) {
                // Update data untuk model sesuai level
                $modelInstance->update([
                    'username'  => $request->username,
                    'password'  => $request->password ? bcrypt($request->password) : $check->password,
                    // Tambahkan kolom spesifik jika ada di model masing-masing
                ]);
            }

            // Update tabel m_user untuk username dan password
            $check->update([
                'username'  => $request->username,
                'password'  => $request->password ? bcrypt($request->password) : $check->password,
                'level_id'  => $request->level_id
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

    // Fungsi untuk mendapatkan model berdasarkan level
    private function getProfileModelByLevel($levelCode)
    {
        switch ($levelCode) {
            case 'MHS': // Mahasiswa
                $profileData = MahasiswaModel::where('id_mahasiswa', $id)->first(); 
                break;
            case 'DSN': // Dosen
                $profileData = DosenModel::where('id_dosen', $id)->first(); 
                break;
            case 'ADM': // Admin
                $profileData = AdminModel::where('id_admin', $id)->first(); 
                break;
            case 'TDK': // Tendik
                $profileData = TendikModel::where('id_tendik', $id)->first();
                break;
            default:
                $profileData = null; // Jika tidak ada level yang cocok
                break;
        }        
    }
}