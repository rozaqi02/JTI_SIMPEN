<?php

namespace App\Http\Controllers;

use App\Models\Tugas;
use App\Models\RiwayatTugas;
use Illuminate\Http\Request;

class TugasController extends Controller
{
    // Fungsi untuk menampilkan tugas
    public function show($id)
    {
        $tugas = Tugas::findOrFail($id);

        // Mengecek apakah user adalah mahasiswa dan tidak memiliki jam alpa
        if (auth()->user()->role === 'mahasiswa' && auth()->user()->jam_alpa <= 0) {
            return redirect()->route('dashboard')->with('error', 'Anda tidak memiliki cukup jam alpa untuk mengambil tugas ini.');
        }

        return view('tugas.show', compact('tugas'));
    }

    // Fungsi untuk mengambil tugas
    public function takeTugas($id)
    {
        $tugas = Tugas::findOrFail($id);

        // Mengecek apakah mahasiswa memiliki jam alpa
        if (auth()->user()->role === 'mahasiswa' && auth()->user()->jam_alpa > 0) {
            // Menyimpan riwayat tugas yang diambil
            RiwayatTugas::create([
                'user_id' => auth()->id(),
                'tugas_id' => $tugas->id,
                'status' => 'in-progress',
            ]);

            // Mengurangi jam alpa mahasiswa
            auth()->user()->decrement('jam_alpa');
            return redirect()->route('mahasiswa.tugasku');
        }

        return redirect()->route('dashboard')->with('error', 'Anda tidak memiliki cukup jam alpa untuk mengambil tugas ini.');
    }
}
