<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProgressTugas;
use App\Models\TugasPendidik;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class ProgressPenugasankuController extends Controller
{
    // Menampilkan halaman utama
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Progress Penugasanku',
            'list' => ['JTI-SIMPEN', 'Penugasanku', 'Progress Penugasanku']
        ];

        $page = (object) ['title' => 'Progress Penugasanku'];
        $activeMenu = 'progress-penugasanku';

        return view('Admin.Pendidik.progress', compact('breadcrumb', 'page', 'activeMenu'));
    }

    // List Data untuk pemberi tugas (konfirmasi mahasiswa)
    public function list(Request $request)
    {
        $userId = Auth::id();
    
        // Ambil data progress tugas dengan relasi mahasiswa, detail tugas, dan jenis kompen
        $progressTugas = ProgressTugas::with(['mahasiswa', 'detailTugas', 'jenisKompen'])
            ->whereHas('detailTugas', function ($query) use ($userId) {
                $query->where('id_user', $userId);
            });
    
            return DataTables::of($progressTugas)
            ->addIndexColumn()
            ->addColumn('nama_mahasiswa', function ($row) {
                return $row->mahasiswa ? $row->mahasiswa->nama_mahasiswa : '-';
            })
            ->addColumn('nama_tugas', function ($row) {
                return $row->detailTugas ? $row->detailTugas->nama_tugas : '-';
            })
            ->addColumn('jenis_kompen', function ($row) {
                return $row->jenisKompen ? $row->jenisKompen->nama_jenis_kompen : '-';
            })
            ->addColumn('progress', function ($row) {
                return $row->progress_tugas;
            })
            ->addColumn('aksi', function ($row) {
                return '
                    <button class="btn btn-success btn-sm btn-confirm" data-url="' . url('/progress-penugasanku/confirm/' . $row->id_tugas) . '">Konfirmasi</button>
                    <button class="btn btn-danger btn-sm btn-delete" data-url="' . url('/progress-penugasanku/delete/' . $row->id_tugas) . '">Hapus</button>
                ';
            })
            ->rawColumns(['aksi'])
            ->make(true);
        }        
    
            
    // Konfirmasi progress tugas mahasiswa
    public function confirm($id)
    {
        $progress = ProgressTugas::findOrFail($id);
        $progress->progress_tugas = 'Dikonfirmasi';
        $progress->save();

        return response()->json(['status' => true, 'message' => 'Progress tugas berhasil dikonfirmasi']);
    }

    // Hapus progress tugas
    public function delete($id)
    {
        $progress = ProgressTugas::findOrFail($id);
        $progress->delete();

        return response()->json(['status' => true, 'message' => 'Progress tugas berhasil dihapus']);
    }
}
