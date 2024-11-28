<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CekJamAlpa
{
    public function handle(Request $request, Closure $next)
    {
        // Mengecek apakah user adalah mahasiswa dan memiliki jam alpa lebih dari 0
        if (auth()->user()->role === 'mahasiswa' && auth()->user()->jam_alpa <= 0) {
            // Jika tidak cukup, redirect ke dashboard dengan pesan error
            return redirect()->route('dashboard')->with('error', 'Anda tidak memiliki cukup jam alpa untuk mengambil tugas.');
        }

        return $next($request);
    }
}
