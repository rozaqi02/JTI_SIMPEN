<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\UserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    // Fungsi untuk login
    public function __invoke(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username'  => 'required',
            'password'  => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $credentials = $request->only('username','password');

        if (!$token = auth()->guard('api')->attempt($credentials)) {
            return response()->json([
                'success'   => false,
                'message'   => 'Username atau Password Anda Salah'
            ], 401);
        }

        return response()->json([
            'success'   => true,
            'user'      => auth()->guard('api')->user(),
            'token'     => $token
        ], 200);
    }

    // Fungsi untuk mengambil data user berdasarkan id_user
    public function getUser($id_user)
    {
        // Cek apakah user dengan id_user ditemukan
        $user = UserModel::find($id_user); // Mengambil user berdasarkan id_user

        // Jika user tidak ditemukan
        if (!$user) {
            return response()->json([
                'success'   => false,
                'message'   => 'User tidak ditemukan'
            ], 404);
        }

        // Kembalikan data user
        return response()->json([
            'success'   => true,
            'user'      => $user
        ], 200);
    }
}
