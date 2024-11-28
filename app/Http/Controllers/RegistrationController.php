<?php
namespace App\Http\Controllers;

use App\Models\Level;
use App\Models\User;
use Illuminate\Http\Request;

class RegistrationController extends Controller
{
    public function showRegisterForm()
{
    return view('auth.register');
}

public function register(Request $request)
{
    // Validasi dan pendaftaran user
    $validated = $request->validate([
        'level_id' => 'required|string|max:255',
        'username' => 'required|string|email|max:255|unique:users',
        'password' => 'required|string|min:8|confirmed',
    ]);

    // Menyimpan data user
    User::create([
        'level_id' => $validated['level_id'],
        'username' => $validated['username'],
        'password' => bcrypt($validated['password']),
    ]);

    return redirect()->route('login');
}
}