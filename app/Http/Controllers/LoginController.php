<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only('username', 'password');
        
        if (Auth::attempt($credentials)) {
            return response()->json(['success' => true, 'redirect_url' => route('home')]);
        }
        
        return response()->json(['success' => false, 'message' => 'Nama pengguna atau kata sandi salah.']);
    }
}
