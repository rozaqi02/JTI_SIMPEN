<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Api\AdminModel;

class AdminController extends Controller
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
            $admins = AdminModel::where('id_user', $userId)->get();
        } else {
            // Jika tidak ada 'user_id', ambil semua admin
            $admins = AdminModel::all();
        }
        
        return response()->json([
            'success' => true,
            'message' => 'Daftar Admin',
            'data' => $admins
        ], 200);
    }
    /**
     * Display the specified resource.
     */
    public function show($admin)
    {
        // Menampilkan data admin berdasarkan ID
        $admin = AdminModel::find($admin);
        if (!$admin) {
            return response()->json([
                'success' => false,
                'message' => 'Admin tidak ditemukan'
            ], 404);
        }
        return response()->json([
            'success' => true,
            'message' => 'Detail Admin',
            'data' => $admin
        ], 200);
    }
}
