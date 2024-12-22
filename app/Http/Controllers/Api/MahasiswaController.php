<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Api\MahasiswaModel;

class MahasiswaController extends Controller
{
    /**
     * Display a listing of the resource with optional query parameter.
     */
    public function index(Request $request)
    {
        // Cek jika ada query parameter '
        $userId = $request->query('id_user');

        // Jika ada '', maka filter berdasarkan ''
        if ($userId) {
            $mahasiswas = MahasiswaModel::where('id_user', $userId)->get();
        } else {
            // Jika tidak ada, ambil semua admin
            $mahasiswas = MahasiswaModel::all();
        }
        
        return response()->json([
            'success' => true,
            'message' => 'Daftar Mahasiswa',
            'data' => $mahasiswas
        ], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show($mahasiswa)
    {
        // Menampilkan data admin berdasarkan ID
        $mahasiswa = MahasiswaModel::find($mahasiswa);

        if (!$mahasiswa) {
            return response()->json([
                'success' => false,
                'message' => 'Mahasiswa tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Detail Mahasiswa',
            'data' => $mahasiswa
        ], 200);
    }
}