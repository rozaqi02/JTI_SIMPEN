<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Models\Api\UserModel;

class LoginController extends Controller
{
    public function __invoke(Request $request)
    {
        // set validation
        $validator = Validator::make($request->all(), [
            'username' => 'required',
            'password' => 'required'
        ]);

        // if validation fails
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors' => $validator->errors()
            ], 422);
        }

        // get credentials from request
        $credentials = $request->only('username', 'password');

        // attempt to create a token
        if (!$token = JWTAuth::attempt($credentials)) {
            return response()->json([
                'success' => false,
                'message' => 'Username atau Password salah'
            ], 401);
        }

        // get authenticated user with level relation
        $user = UserModel::with('level')->find(auth()->user()->id_user);

        // if auth success
        return response()->json([
            'success' => true,
            'message' => 'Login berhasil',
            'user' => [
                'id_user' => $user->id_user,
                'username' => $user->username,
                'level' => [
                    'id' => $user->level->level_id,
                    'nama' => $user->level->level_nama,
                    'kode' => $user->level->level_kode
                ]
            ],
            'token' => $token,
            'token_type' => 'bearer'
        ], 200);
    }
}