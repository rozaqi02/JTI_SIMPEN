<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mahasiswa; // Model Mahasiswa
use App\Models\Tugas; // Model Tugas
use App\Models\Alpa;
use Illuminate\Support\Facades\Auth;
class TugasController extends Controller
{
    public function ambilTugas($tugas_id)
    {
        $mahasiswa = auth()->user();

        $alpa = Alpa::where('id_mahasiswa', $mahasiswa->id)->first();

        if ($alpa && $alpa->jam_alpa > 0) {
            // Mahasiswa bisa mengambil tugas
            $tugas = Tugas::find($tugas_id);
            // Logika pengambilan tugas
        } else {
            return redirect()->back()->withErrors(['message' => 'Anda tidak memiliki jam alpa cukup untuk mengambil tugas.']);
        }
    }
}