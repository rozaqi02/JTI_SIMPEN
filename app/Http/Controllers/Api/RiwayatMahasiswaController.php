<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Api\RiwayatPenugasanMahasiswa;

class RiwayatMahasiswaController extends Controller
{
    /**
     * Menampilkan semua riwayat tugas mahasiswa.
     */
    public function index(Request $request)
    {
        // Ambil query parameter 
        $userId = $request->query('id_user');

        // Query riwayat tugas dengan relasi
        $query = RiwayatPenugasanMahasiswa::with([
            'tugas.detailTugas.jenisKompen', // Relasi ke jenis_kompen
            'tugas.detailTugas.user',       // Relasi ke user (pemberi tugas)
            'tugas.alpa.mahasiswa'          // Relasi ke alpa dan mahasiswa
        ]);

        
        if ($userId) {
            $query->whereHas('tugas.alpa.mahasiswa', function ($q) use ($userId) {
                $q->where('id_user', $userId);
            });
        }
        $jumlahRiwayat = $query->count(); // Menghitung jumlah tugas
        // Eksekusi query
        $riwayatTugas = $query->get();

        // Manipulasi data untuk format JSON
        $result = $riwayatTugas->map(function ($riwayat) {
            $tugas = $riwayat->tugas;
            $detailTugas = $tugas->detailTugas ?? null;
            $jenisKompen = $detailTugas->jenisKompen ?? null;
            $user = $detailTugas->user ?? null;
            $alpa = $tugas->alpa ?? null;
            $mahasiswa = $alpa->mahasiswa ?? null;

            return [
                'id_riwayat_tugas' => $riwayat->id_riwayat_tugas,
                'tugas' => [
                    'id_tugas' => $tugas->id_tugas ?? null,
                    'alpa' => [
                        'id_alpa' => $alpa->id_alpa ?? null,
                        'mahasiswa' => [
                            'id_user' => $mahasiswa->id_user ?? null,
                        ],
                    ],
                    'detail_tugas' => [
                        'id_detail_tugas' => $detailTugas->id_detail_tugas ?? null,
                        'nama_tugas' => $detailTugas->nama_tugas ?? null,
                        'nilai_kompen' => $detailTugas->nilai_kompen ?? null,
                        'jenis_kompen' => [
                            'id_jenis_kompen' => $jenisKompen->id_jenis_kompen ?? null,
                            'nama_jenis_kompen' => $jenisKompen->nama_jenis_kompen ?? null,
                        ],
                        'user' => [
                            'username' => $user->username ?? null,
                        ],
                    ],
                    'tanggal_selesai' => $riwayat->tanggal_selesai ?? null,
                    'created_at' => $riwayat->created_at,
                    'updated_at' => $riwayat->updated_at,
                ],
            ];
        });

        // Return response JSON
        return response()->json([
            'success' => true,
            'message' => 'Daftar Riwayat Tugas Mahasiswa',
            'jumlah_riwayat' => $jumlahRiwayat, // Menambahkan jumlah tugas ke dalam response
            'data' => $result
        ], 200);
    }
}
