<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Providers\RouteServiceProvider;

class RegistrationController extends Controller
{
    public function registration()
    {
        // Menampilkan form registrasi
        // Jika Anda mengambil daftar level dari database, misalnya
        $level = \App\Models\Level::all(); // Atau sesuaikan dengan kebutuhan
        return view('auth.register', compact('level'));
    }

    public function store(Request $request)
    {
        // Validasi data yang diterima dari form registrasi
        $request->validate([
            'level_id' => 'required|integer', // Menambahkan validasi untuk 'level_id'
            'role' => 'required|in:mahasiswa,dosen,tendik,admin', // Validasi role
            'nama' => 'required|string|min:3|max:100', // Nama
            'username' => 'required|string|min:3|max:20|unique:users,username', // Username unik
            'password' => 'required|string|min:6|confirmed', // Password dengan konfirmasi
        ]);

        // Membuat user baru
        $user = User::create([
            'nama' => $request->nama,
            'username' => $request->username,
            'password' => bcrypt($request->password),
            'level_id' => $request->level_id,
            'role' => $request->role, // Menyimpan role
        ]);

        // Login otomatis setelah registrasi berhasil
        Auth::login($user);

        // Redirect setelah registrasi sukses
        return redirect(RouteServiceProvider::HOME);
    }
}
