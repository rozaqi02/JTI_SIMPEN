<?php

namespace App\Http\Controllers;

use App\Models\LevelModel;
use App\Models\UserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function login()
    {
        if (Auth::check()) { // jika sudah login, maka redirect ke halaman home 
            return redirect('/dashboard ');
        }
        return view('auth.login');
    }

    public function postlogin(Request $request)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $credentials = $request->only('username', 'password');

            if (Auth::attempt($credentials)) {
                session([
                    'profile_img_path' => Auth::user()->foto,
                    'id_user' => Auth::user()->id_user
                ]);
                return response()->json([
                    'status' => true,
                    'message' => 'Login Berhasil',
                    'redirect' => url('/dashboard')
                ]);
            }

            return response()->json([
                'status' => false,
                'message' => 'Login Gagal'
            ]);
        }

        return redirect('login');
    }

    // public function register()
    // {
    //     $level = LevelModel::select('level_id', 'level_nama')->get();

    //     return view('auth.signup')
    //         ->with('level', $level);
    // }

    // public function store(Request $request)
    // {
    //     // cek apakah request berupa ajax
    //     if ($request->ajax() || $request->wantsJson()) {
    //         $rules = [
    //             'level_id'  => 'required|integer',
    //             'username'  => 'required|string|min:3|unique:m_user,username',
    //             'password'  => 'required|min:6'
    //         ];
            
    //         $validator = Validator::make($request->all(), $rules);

    //         if ($validator->fails()) {
    //             return response()->json([
    //                 'status'    => false, // response status, false: error/gagal, true: berhasil
    //                 'message'   => 'Validasi Gagal',
    //                 'msgField'  => $validator->errors(), // pesan error validasi
    //             ]);
    //         }
    //         UserModel::create($request->all());
    //         return response()->json([
    //             'status'    => true,
    //             'message'   => 'Data user berhasil disimpan',
    //             'redirect' => url('login')
    //         ]);
    //     }
    //     return redirect('login');
    // }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('login');
    }
}