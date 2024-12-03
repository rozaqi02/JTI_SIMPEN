<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class RegisterController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'level_id' => 'required|integer',
            'nama' => 'required|string|max:255',
        ]);
        
        // Logic untuk pendaftaran user baru
        $user = User::create([
            'level_id' => $request->level_id,
            'nama' => $request->nama,
            'username' => $request->username,
            'password' => bcrypt($request->password),
        ]);
        
        return response()->json(['success' => true, 'redirect_url' => route('login')]);
    }
}
