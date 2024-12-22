<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Api\TugasModel;

class TugasAdtController extends Controller
{
    /**
     * Display a listing of the resource with optional query parameter.
     */
    public function index(Request $request)
    {
        $userId = $request->query('id_user'); // Ambil query parameter 

        // Query dengan semua relasi yang dibutuhkan
        $query = TugasModel::with([
            'detailTugas.jenisKompen',
            'detailTugas.user',
            'alpa.mahasiswa'
        ]);

        // Filter berdasarkan  melalui relasi alpa -> mahasiswa
        if ($userId) {
            $query->whereHas('detailTugas.user', function ($q) use ($userId) {
                $q->where('id_user', $userId);
            });
        }
        $jumlahTugas = $query->count(); // Menghitung jumlah tugas
        // Ambil hasil query
        $tugasadt = $query->get();
         
        // Manipulasi JSON sesuai format
        $result = $tugasadt->map(function ($tugas) {
            return [
                'id_tugas' => $tugas->id_tugas,
                'detail_tugas' => [
                    'id_detail_tugas' => $tugas->detailTugas->id_detail_tugas ?? null,
                    'nama_tugas' => $tugas->detailTugas->nama_tugas ?? null,
                    'deskripsi_tugas' => $tugas->detailTugas->deskripsi_tugas ?? null,
                    'nilai_kompen' => $tugas->detailTugas->nilai_kompen ?? null,
                    'user' => [
                        'id_user' => $tugas->detailTugas->user->id_user ?? null,
                        'username' => $tugas->detailTugas->user->username ?? null,
                    ],
                    'jenis_kompen' => [
                        'id_jenis_kompen' => $tugas->detailTugas->jenisKompen->id_jenis_kompen ?? null,
                        'nama_jenis_kompen' => $tugas->detailTugas->jenisKompen->nama_jenis_kompen ?? null,
                    ],
                ],
                'alpa' => [
                    'id_alpa' => $tugas->alpa->id_alpa ?? null,
                    'mahasiswa' => [
                        'id_mahasiswa' => $tugas->alpa->id_mahasiswa ?? null,
                        'nama_mahasiswa' => $tugas->alpa->mahasiswa->nama_mahasiswa ?? null,
                    ],
                ],
                'progress_tugas' => $tugas->progress_tugas ?? null,
                'created_at' => $tugas->created_at,
                'updated_at' => $tugas->updated_at,
            ];
        });
        
        // Return response JSON
        return response()->json([
            'success' => true,
            'message' => 'Daftar Tugas',
            'jumlah_tugas' => $jumlahTugas, // Menambahkan jumlah tugas ke dalam response
            'data' => $result
        ], 200);
    }
}
