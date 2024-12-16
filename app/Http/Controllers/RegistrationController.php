<?php

namespace App\Http\Controllers;

use App\Models\LevelModel;
use App\Models\UserModel;
use App\Models\AdminModel;
use App\Models\DosenModel;
use App\Models\TendikModel;
use App\Models\MahasiswaModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class RegistrationController extends Controller
{
    // Menampilkan halaman form tambah user
    public function registration()
    {
        // Mendapatkan level yang ada untuk form registrasi
        $level = LevelModel::select('level_id', 'level_nama')->get();

        return view('auth.register')
                    ->with('level', $level);
    }

    // Menyimpan data user baru
    public function store(Request $request)
    {
        // Validasi data yang diterima
        $validator = Validator::make($request->all(), [
            'level_id' => 'required|integer',
            'username' => 'required|string|min:3|unique:m_user,username',
            'password' => 'required|min:5',
        ]);
    
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validasi gagal.',
                'msgField' => $validator->messages()
            ], 422);
        }
    
        // Cek apakah nim sudah ada untuk Mahasiswa
        if ($request->level_id == 4) {  // Mahasiswa
            $existingMahasiswa = MahasiswaModel::where('nim', $request->nim)->first();
            if ($existingMahasiswa) {
                return response()->json([
                    'status' => false,
                    'message' => 'NIM sudah terdaftar.'
                ], 422);
            }
        }
    
        // Menyimpan user baru
        $user = UserModel::create([
            'level_id' => $request->level_id,
            'username' => $request->username,
            'password' => bcrypt($request->password),
        ]);
    
        // Menyimpan data pengguna berdasarkan level
        if ($request->level_id == 1) {  // Admin
            AdminModel::create([
                'id_user' => $user->id_user,
                'nip' => $request->nip,
                'email' => $request->email,
                'nama_admin' => $request->nama_admin,

            ]);
        } elseif ($request->level_id == 2) {  // Dosen
            DosenModel::create([
                'id_user' => $user->id_user,
                'nip' => $request->nip,
                'email' => $request->email,
                'nama_dosen' => $request->nama_dosen,
                // 'no_telepon' => $request->no_telepon ?? null,
            ]);
        } elseif ($request->level_id == 3) {  // Tendik
            TendikModel::create([
                'id_user' => $user->id_user,
                'nip' => $request->nip,
                'email' => $request->email,
                'nama_tendik' => $request->nama_tendik,
                // 'no_telepon' => $request->no_telepon ?? null,
            ]);
        } elseif ($request->level_id == 4) {  // Mahasiswa
            MahasiswaModel::create([
                'id_user' => $user->id_user,
                'nim' => $request->nim,
                'email' => $request->email,
                'nama_mahasiswa' => $request->nama_mahasiswa,

            ]);
        }
    
        // Kirim respons sukses
        return response()->json([
            'status' => true,
            'message' => 'Registrasi berhasil dilakukan!',
            'redirect' => url('/login') 
        ]);
    }
    

    
}
