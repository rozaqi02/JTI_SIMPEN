<?php

namespace App\Http\Controllers;

use App\Models\RiwayatTugas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class RiwayatPenugasankuController extends Controller
{
    // Menampilkan halaman riwayat penugasanku
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Riwayat Penugasanku',
            'list' => ['Home', 'Penugasanku', 'Riwayat Penugasanku']
        ];

        $page = (object) ['title' => 'Riwayat Penugasanku'];
        $activeMenu = 'riwayat-tugas';

        return view('Admin.Pendidik.riwayat', compact('breadcrumb', 'page', 'activeMenu'));
    }

    // Mengambil data riwayat tugas untuk ditampilkan dalam DataTables
    public function list(Request $request)
    {
        $userId = Auth::id(); // ID pemberi tugas yang sedang login

        $riwayatTugas = RiwayatTugas::with(['tugas'])
            ->whereHas('tugas.detailTugas', function ($query) use ($userId) {
                $query->where('id_user', $userId);
            });

        return DataTables::of($riwayatTugas)
            ->addIndexColumn()
            ->addColumn('nama_tugas', function ($row) {
                return $row->tugas ? $row->tugas->detailTugas->nama_tugas : '-';
            })
            ->addColumn('tanggal_dilaksanakan', function ($row) {
                return $row->tanggal_dilaksanakan ? $row->tanggal_dilaksanakan : '-';
            })
            ->addColumn('tanggal_selesai', function ($row) {
                return $row->tanggal_selesai ? $row->tanggal_selesai : '-';
            })
            ->addColumn('status', function ($row) {
                return $row->status ? '<span class="badge badge-success">Selesai</span>' : '<span class="badge badge-warning">Aktif</span>';
            })
            ->rawColumns(['status'])
            ->make(true);
    }
}
