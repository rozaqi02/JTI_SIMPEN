<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DetailTugasModel;
use App\Models\Api\JenisKompen;

class DetailTugasAdtController extends Controller
{
    public function index(Request $request)
    {
        // Ambil query parameter 'user_id'
        $userId = $request->query('id_user');

        // Query data dengan relasi ke UserModel dan JenisKompen
        $query = DetailTugasModel::with(['user', 'jenisKompen']);

        // Jika ada 'user_id', filter berdasarkan 'user_id'
        if ($userId) {
            $query->where('id_user', $userId);
        }

        // Menghitung jumlah total tugas berdasarkan  (jika ada)
        $jumlahTugas = $query->count();

        // Ambil semua jenis kompen
        $allJenisKompen = JenisKompen::all()->keyBy('id_jenis_kompen');

        // Menghitung jumlah jenis kompen berdasarkan '' (jika ada)
        $jenisKompenCounts = DetailTugasModel::selectRaw('id_jenis_kompen, COUNT(*) as count')
            ->when($userId, function ($query) use ($userId) {
                $query->where('id_user', $userId); // Filter berdasarkan 
            })
            ->groupBy('id_jenis_kompen')
            ->pluck('count', 'id_jenis_kompen')
            ->toArray();

        // Format output jenis kompen counts
        $formattedJenisKompenCounts = $allJenisKompen->map(function ($jenisKompen) use ($jenisKompenCounts) {
            return [
                'id_jenis_kompen' => $jenisKompen->id_jenis_kompen,
                'nama_jenis_kompen' => $jenisKompen->nama_jenis_kompen,
                'count' => $jenisKompenCounts[$jenisKompen->id_jenis_kompen] ?? 0, // Default ke 0 jika tidak ditemukan
            ];
        })->values();

        // Ambil hasil query data detail tugas
        $details = $query->get();

        // Manipulasi data untuk format JSON yang diinginkan
        $result = $details->map(function ($detail) {
            return [
                'id_detail_tugas' => $detail->id_detail_tugas,
                'user' => [
                    'id_user' => $detail->user->id_user ?? null,
                    'username' => $detail->user->username ?? null,
                ],
                'jenis_kompen' => [
                    'id_jenis_kompen' => $detail->jenisKompen->id_jenis_kompen ?? null,
                    'nama_jenis_kompen' => $detail->jenisKompen->nama_jenis_kompen ?? null,
                ],
                'nama_tugas' => $detail->nama_tugas,
                'deskripsi_tugas' => $detail->deskripsi_tugas,
                'kuota' => $detail->kuota,
                'nilai_kompen' => $detail->nilai_kompen,
                'created_at' => $detail->created_at,
                'updated_at' => $detail->updated_at,
            ];
        });

        return response()->json([
            'success' => true,
            'message' => 'Daftar Detail',
            'jumlah_tugas' => $jumlahTugas,
            'jenis_kompen_counts' => $formattedJenisKompenCounts, // Count jenis kompen berdasarkan user_id
            'data' => $result,
        ], 200);
    }
}
