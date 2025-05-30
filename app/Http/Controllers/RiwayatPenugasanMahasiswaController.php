<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RiwayatTugasMahasiswa;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class RiwayatPenugasanMahasiswaController extends Controller
{
    // Menampilkan halaman riwayat tugas mahasiswa
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Riwayat Tugas Saya',
            'list' => ['Home', 'Riwayat Tugas']
        ];

        $page = (object) ['title' => 'Histori Tugas'];
        $activeMenu = 'riwayat-tugas';

        return view('mahasiswa.riwayat.index', compact('breadcrumb', 'page', 'activeMenu'));
    }

    // Mengambil data histori tugas mahasiswa
    public function list(Request $request)
    {
        $userId = Auth::id();

        $riwayatTugas = RiwayatTugasMahasiswa::with(['tugas'])
            ->whereHas('tugas', function ($query) use ($userId) {
                $query->whereHas('mahasiswa', function ($subQuery) use ($userId) {
                    $subQuery->where('id_user', $userId);
                });
            });

        return DataTables::of($riwayatTugas)
            ->addIndexColumn()
            ->addColumn('nama_tugas', function ($row) {
                return $row->tugas ? $row->tugas->detailTugas->nama_tugas : '-';
            })
            ->addColumn('tanggal_dilaksanakan', function ($row) {
                return $row->tanggal_dilaksanakan ?? '-';
            })
            ->addColumn('tanggal_selesai', function ($row) {
                return $row->tanggal_selesai ?? '-';
            })
            ->addColumn('status', function ($row) {
                return $row->status ? '<span class="badge badge-success">Selesai</span>' : '<span class="badge badge-warning">Aktif</span>';
            })
            ->rawColumns(['status'])
            ->make(true);
    }
}
