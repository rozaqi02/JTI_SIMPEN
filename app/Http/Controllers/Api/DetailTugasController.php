<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\DetailTugasModel;
use Illuminate\Http\Request;

class DetailTugasController extends Controller
{
    // Menampilkan daftar semua tugas
    public function index()
    {
        $details = DetailTugasModel::all();
        return response()->json($details, 200);
    }

    // Menyimpan tugas baru
    public function store(Request $request)
    {
        $request->validate([
            'id_user' => 'required|integer',
            'id_jenis_kompen' => 'required|integer',
            'nama_tugas' => 'required|string|max:255',
            'deskripsi_tugas' => 'nullable|string',
            'kuota' => 'required|integer',
            'nilai_kompen' => 'required|numeric',
            'jumlah_jam' => 'required|numeric',
        ]);

        $detailTugas = DetailTugasModel::create($request->all());

        return response()->json($detailTugas, 201);
    }

    // Menampilkan detail tugas berdasarkan ID
    public function show($id)
    {
        $detailTugas = DetailTugasModel::find($id);

        if (!$detailTugas) {
            return response()->json(['message' => 'Detail tugas tidak ditemukan'], 404);
        }

        return response()->json($detailTugas, 200);
    }

    // Memperbarui detail tugas
    public function update(Request $request, $id)
    {
        $request->validate([
            'id_user' => 'required|integer',
            'id_jenis_kompen' => 'required|integer',
            'nama_tugas' => 'required|string|max:255',
            'deskripsi_tugas' => 'nullable|string',
            'kuota' => 'required|integer',
            'nilai_kompen' => 'required|numeric',
            'jumlah_jam' => 'required|numeric',
        ]);

        $detailTugas = DetailTugasModel::find($id);

        if (!$detailTugas) {
            return response()->json(['message' => 'Detail tugas tidak ditemukan'], 404);
        }

        $detailTugas->update($request->all());

        return response()->json($detailTugas, 200);
    }

    // Menghapus detail tugas
    public function destroy($id)
    {
        $detailTugas = DetailTugasModel::find($id);

        if (!$detailTugas) {
            return response()->json(['message' => 'Detail tugas tidak ditemukan'], 404);
        }

        $detailTugas->delete();

        return response()->json(['message' => 'Detail tugas berhasil dihapus'], 200);
    }
}
