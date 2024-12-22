<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Api\TugasModel;

class TugasMahasiswaController extends Controller
{
    /**
     * Display a listing of the resource with optional query parameter.
     */
    // Lanjutkan di dalam metode index()
public function index(Request $request)
{
    $userId = $request->query('id_user'); // Ambil query parameter 
    $idDetailTugas = $request->query('id_detail_tugas');
    $idAlpa = $request->query('id_alpa');

    // Query dengan semua relasi yang dibutuhkan
    $query = TugasModel::with([
        'detailTugas.jenisKompen',
        'detailTugas.user',
        'alpa.mahasiswa'
    ]);

    // Filter berdasarkan  melalui relasi alpa -> mahasiswa
    if ($userId) {
        $query->whereHas('alpa.mahasiswa', function ($q) use ($userId) {
            $q->where('id_user', $userId);
        });
    }

    // Filter berdasarkan 'id_detail_tugas' jika ada
    if ($idDetailTugas) {
        $query->where('id_detail_tugas', $idDetailTugas);
    }

    // Filter berdasarkan 'id_alpa' jika ada
    if ($idAlpa) {
        $query->where('id_alpa', $idAlpa);
    }

    // Ambil jumlah tugas sesuai filter yang diterapkan
    $jumlahTugas = $query->count(); // Menghitung jumlah tugas

    // Ambil hasil query untuk menampilkan detail tugas
    $tugasm = $query->get();

    // Manipulasi JSON sesuai format
    $result = $tugasm->map(function ($tugas) {
        return [
            'id_tugas' => $tugas->id_tugas,
            'detail_tugas' => [
                'id_detail_tugas' => $tugas->detailTugas->id_detail_tugas,
                'nama_tugas' => $tugas->detailTugas->nama_tugas,
                'deskripsi_tugas' => $tugas->detailTugas->deskripsi_tugas,
                'nilai_kompen' => $tugas->detailTugas->nilai_kompen,
                'user' => [
                    'username' => $tugas->detailTugas->user->username,
                ],
                'jenis_kompen' => [
                    'id_jenis_kompen' => $tugas->detailTugas->jenisKompen->id_jenis_kompen,
                    'nama_jenis_kompen' => $tugas->detailTugas->jenisKompen->nama_jenis_kompen,
                ],
            ],
            'progress_tugas' => $tugas->progress_tugas,
            'created_at' => $tugas->created_at,
            'updated_at' => $tugas->updated_at,
        ];
    });

    // Kembalikan data dalam format JSON
    return response()->json([
        'success' => true,
        'message' => 'Daftar Tugas',
        'jumlah_tugas' => $jumlahTugas, // Menambahkan jumlah tugas ke dalam response
        'data' => $result
    ]);
}

}