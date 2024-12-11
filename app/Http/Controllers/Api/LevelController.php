<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\LevelModel;

class LevelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Mengambil semua data level
        $levels = LevelModel::all();
        return response()->json($levels, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'level_nama' => 'required',
            'level_kode' => 'required', // Kode harus unik
        ]);

        // Menyimpan data level baru
        $level = LevelModel::create([
            'level_nama' => $request->level_nama,
            'level_kode' => $request->level_kode,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Level berhasil ditambahkan',
            'data' => $level
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($level)
    {
        // Menampilkan data level berdasarkan ID
        $level = LevelModel::find($level);

        if (!$level) {
            return response()->json(['message' => 'Level tidak ditemukan'], 404);
        }

        return response()->json($level, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $level)
    {
        // Validasi input
        $request->validate([
            'level_nama' => 'required',
            'level_kode' => 'required,' . $level, // Kode unik kecuali untuk ID saat ini
        ]);

        // Mencari level yang akan diupdate
        $level = LevelModel::find($level);

        if (!$level) {
            return response()->json(['message' => 'Level tidak ditemukan'], 404);
        }

        // Update data level
        $level->update([
            'level_nama' => $request->level_nama,
            'level_kode' => $request->level_kode,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Level berhasil diperbarui',
            'data' => $level
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($level)
    {
        // Mencari level yang akan dihapus
        $level = LevelModel::find($level);

        if (!$level) {
            return response()->json(['message' => 'Level tidak ditemukan'], 404);
        }

        // Hapus data level
        $level->delete();

        return response()->json([
            'success' => true,
            'message' => 'Level berhasil dihapus'
        ], 200);
    }
}
