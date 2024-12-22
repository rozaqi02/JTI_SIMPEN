<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Api\DosenModel;

class DosenController extends Controller
{
    /**
     * Display a listing of the resource with optional query parameter.
     */
    public function index(Request $request)
    {
        // Cek jika ada query parameter 
        $userId = $request->query('id_user');

        // Jika ada ', maka filter berdasarkan 
        if ($userId) {
            $dosens = DosenModel::where('id_user', $userId)->get();
        } else {
            // Jika tidak ada ', ambil semua admin
            $dosens = DosenModel::all();
        }
        
        return response()->json([
            'success' => true,
            'message' => 'Daftar Dosen',
            'data' => $dosens
        ], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show($dosen)
    {
        // Menampilkan data admin berdasarkan ID
        $dosen = DosenModel::find($dosen);

        if (!$dosen) {
            return response()->json([
                'success' => false,
                'message' => 'Dosen tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Detail Admin',
            'data' => $dosen
        ], 200);
    }
}
