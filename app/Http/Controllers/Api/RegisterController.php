<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\UserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class RegisterController extends Controller
{
    public function __invoke(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username'  => 'required',
            'password'  => 'required',
            'level_id'  => 'required',
            'foto'      => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // validasi foto
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // Mengupload gambar dengan nama unik
        if ($request->hasFile('foto')) {
            $image = $request->file('foto');
            
            // Buat nama file unik berdasarkan waktu + ekstensi file asli
            $fileName = time() . '.' . $image->getClientOriginalExtension();
            
            // Simpan file ke folder image/profile
            $image->storeAs('image/profile', $fileName);
        }

        $user = UserModel::create([
            'username'  => $request->username,
            'password'  => bcrypt($request->password),
            'level_id'  => $request->level_id,
            'foto'      => 'image/profile/' . $fileName, // Menyimpan path file
        ]);

        if ($user) {
            return response()->json([
                'success'   => true,
                'user'      => $user,
            ], 201);
        }

        return response()->json([
            'success'   => false,
        ], 409);
    }
}
