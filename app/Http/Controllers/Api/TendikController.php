<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Api\TendikModel;

class TendikController extends Controller
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
            $tendiks = TendikModel::where('id_user', $userId)->get();
        } else {
            // Jika tidak ada , ambil semua admin
            $tendiks = TendikModel::all();
        }
        
        return response()->json([
            'success' => true,
            'message' => 'Daftar Dosen',
            'data' => $tendiks
        ], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show($tendik)
    {
        // Menampilkan data admin berdasarkan ID
        $tendik = DosenModel::find($tendik);

        if (!$tendik) {
            return response()->json([
                'success' => false,
                'message' => 'Tendik tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Detail Tendik',
            'data' => $tendik
        ], 200);
    }
}
