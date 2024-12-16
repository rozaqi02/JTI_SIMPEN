<?php

namespace App\Http\Controllers;

use App\Models\UserModel;
use App\Models\JenisKompen;
use App\Models\NgambilTugas;
use App\Models\ProgressTugas; // Model untuk tabel m_tugas
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Untuk user yang sedang login
use Yajra\DataTables\Facades\DataTables;
use Carbon\Carbon;

class NgambilTugasController extends Controller
{
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'List Tugas',
            'list' => ['JTI-SIMPEN', 'Tugasku', 'List Tugas']
        ];

        $page = (object) ['title' => 'List Tugas'];
        $activeMenu = 'list-tugas';

        return view('mahasiswa.list-tugas.index', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'activeMenu' => $activeMenu
        ]);
    }

    public function list(Request $request)
    {
        $tugas = NgambilTugas::with(['user', 'jenisKompen'])
            ->select('id_detail_tugas', 'id_user', 'id_jenis_kompen', 'nama_tugas', 'deskripsi_tugas', 'kuota', 'nilai_kompen');

        // Filter jika ada
        if ($request->filled('nama_tugas')) {
            $tugas->where('nama_tugas', 'like', '%' . $request->nama_tugas . '%');
        }

        return DataTables::of($tugas)
            ->addIndexColumn()
            ->addColumn('jenis_kompen', function ($tugas) {
                return $tugas->jenisKompen ? $tugas->jenisKompen->nama_jenis_kompen : '-';
            })
            ->addColumn('pemberi_tugas', function ($tugas) {
                return $tugas->user ? $tugas->user->username : '-';
            })
            ->addColumn('aksi', function ($tugas) {
                $url = url('list-tugas/' . $tugas->id_detail_tugas . '/apply_ajax');
                return '<button onclick="modalAction(\'' . $url . '\')" class="btn btn-primary btn-sm">Ambil</button>';
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }

    public function applyAjax($id)
    {
        try {
            $tugas = NgambilTugas::with(['user', 'jenisKompen'])->findOrFail($id);

            $html = view('mahasiswa.list-tugas.apply', [
                'tugas' => $tugas
            ])->render();

            return response()->json(['html' => $html]);
        } catch (\Exception $e) {
            return response()->json([
                'html' => '<p>Terjadi kesalahan, data tidak ditemukan.</p>',
                'error' => $e->getMessage()
            ], 404);
        }
    }

    public function submitTugas($id, Request $request)
    {
        try {
            $user = Auth::user();
            $mahasiswa = $user->mahasiswa; // Relasi mahasiswa di model UserModel

            if (!$mahasiswa) {
                return response()->json([
                    'status' => false,
                    'message' => 'Data mahasiswa tidak ditemukan.'
                ]);
            }

            $tugas = NgambilTugas::findOrFail($id);

            // Cek apakah mahasiswa sudah mengambil tugas ini
            $existing = ProgressTugas::where('id_detail_tugas', $id)
                ->where('id_alpa', $mahasiswa->id_mahasiswa)
                ->first();

            if ($existing) {
                return response()->json([
                    'status' => false,
                    'message' => 'Tugas ini sudah Anda ambil sebelumnya.'
                ]);
            }

            // Simpan ke tabel m_tugas
            ProgressTugas::create([
                'id_detail_tugas' => $tugas->id_detail_tugas,
                'id_alpa' => $mahasiswa->id_mahasiswa,
                'progress_tugas' => 'Dalam Proses'
            ]); 

            return response()->json([
                'status' => true,
                'message' => 'Tugas berhasil diambil!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Terjadi kesalahan di server. Silakan coba lagi.',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
