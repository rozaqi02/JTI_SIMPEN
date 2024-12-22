<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Api\AlpakuModel;

class AlpaController extends Controller
{
    /**
     * Display a listing of the resource with optional query parameter.
     */
    public function index(Request $request)
{
    // Cek jika ada query parameter 'user_id'
    $userId = $request->query('id_user');

    // Jika ada 'user_id', maka filter berdasarkan 'user_id'
    if ($userId) {
        $alpas = AlpakuModel::with(['mahasiswa', 'periode'])
            ->whereHas('mahasiswa', function ($query) use ($userId) {
                $query->where('id_user', $userId);
            })
            ->get();
    } else {
        // Jika tidak ada 'user_id', ambil semua alpa beserta relasi mahasiswa dan periode
        $alpas = AlpakuModel::with(['mahasiswa', 'periode'])->get();
    }

    return response()->json([
        'success' => true,
        'message' => 'Daftar Alpa',
        'data' => $alpas
    ], 200);
}


    /**
     * Display the specified resource.
     */
    public function show($alpa)
    {
        // Menampilkan data admin berdasarkan ID
        $alpa = AlpakuModel::find($alpa);

        if (!$alpa) {
            return response()->json([
                'success' => false,
                'message' => 'Alpa tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Detail Admin',
            'data' => $alpa
        ], 200);
    }
}
