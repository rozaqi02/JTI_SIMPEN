<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    // Menampilkan form register
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    // Menangani proses registrasi
    public function register(Request $request)
    {
        // Validasi form
        $validator = Validator::make($request->all(), [
            'username' => 'required|string|unique:users,username|max:255',
            'password' => 'required|string|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        // Membuat user baru
        try {
            $user = User::create([
                'username' => $request->username,
                'password' => Hash::make($request->password),
            ]);
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan saat membuat akun: ' . $e->getMessage());
        }

        // Redirect ke login setelah berhasil registrasi
        return redirect()->route('login.form')->with('success', 'Akun berhasil dibuat, silakan login.');
    }

    // Menampilkan form login
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Menangani login
    public function login(Request $request)
    {
        $credentials = $request->only('username', 'password');

        if (auth()->attempt($credentials)) {
            return redirect()->intended('dashboard');
        }

        return back()->withErrors(['username' => 'Username atau password salah.']);
    }

    // Menangani logout
    public function logout()
    {
        auth()->logout();
        return redirect()->route('login.form');
    }
}
