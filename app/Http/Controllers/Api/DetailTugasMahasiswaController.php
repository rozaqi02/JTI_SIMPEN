<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DetailTugasModel;
use App\Models\Api\JenisKompen; // Perbaiki penggunaan JenisKompen

class DetailTugasMahasiswaController extends Controller
{
    public function index(Request $request)
    {
        // Cek jika ada query parameter 
        $userId = $request->query('id_user');

        // Query data dengan relasi ke UserModel dan JenisKompen
        $query = DetailTugasModel::with(['user', 'jenisKompen']);

        // Jika ada ', maka filter berdasarkan 
        if ($userId) {
            $query->where('id_user', $userId);
        }

        // Menghitung jumlah total tugas
        $jumlahTugas = $query->count();

        // Ambil semua jenis kompen
        $allJenisKompen = JenisKompen::all()->keyBy('id_jenis_kompen');

        // Menghitung jumlah jenis kompen berdasarkan id_jenis_kompen
        $jenisKompenCounts = DetailTugasModel::selectRaw('id_jenis_kompen, COUNT(*) as count')
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

        // Ambil hasil query
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
            'jumlah_tugas' => $jumlahTugas, // Menambahkan jumlah tugas ke dalam response
            'jenis_kompen_counts' => $formattedJenisKompenCounts, // Menambahkan jumlah jenis kompen
            'data' => $result,
        ], 200);
    }
}
