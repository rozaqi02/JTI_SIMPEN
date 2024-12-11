<?php

namespace App\Http\Controllers;

use App\Models\PeriodeModel;
use App\Models\AlpakuModel;
use App\Models\MahasiswaModel;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class AlpakuController extends Controller
{
    public function index()
    {
        // Mengambil semua data periode
        $periode = PeriodeModel::all();

        $breadcrumb = (object) [
            'title' => 'Data Alpa Mahasiswa',
            'list' => ['Home', 'Absensi', 'Data Alpa Mahasiswa']
        ];

        $page = (object) [
            'title' => 'Data Alpa Mahasiswa'
        ];

        $activeMenu = 'data-alpa';

        return view('mahasiswa.alpaku.index', compact('breadcrumb', 'page', 'activeMenu', 'periode'));
    }

    public function list(Request $request)
    {
        // Pastikan tabel dan kolom yang digunakan benar
        $alpaku = AlpakuModel::with(['mahasiswa', 'periode'])
            ->select('t_alpa.id_alpa', 't_alpa.id_mahasiswa', 't_alpa.id_periode', 't_alpa.jam_alpa');

        // Filter berdasarkan nama mahasiswa
        if ($request->filled('nama_mahasiswa')) {
            $alpaku->whereHas('mahasiswa', function ($query) use ($request) {
                $query->where('nama_mahasiswa', 'like', '%' . $request->nama_mahasiswa . '%');
            });
        }

        // Filter berdasarkan periode
        if ($request->filled('periode')) {
            $alpaku->where('id_periode', $request->periode); // Filter berdasarkan ID periode
        }

        return DataTables::of($alpaku)
            ->addIndexColumn()
            // ->addColumn('nama_mahasiswa', function ($alpa) {
            //     return $alpa->mahasiswa ? $alpa->mahasiswa->nama_mahasiswa : 'Tidak Ada';
            // })
            // ->addColumn('nim', function ($alpa) {
            //     return $alpa->mahasiswa ? $alpa->mahasiswa->nim : 'Tidak Ada';
            // })
            // ->addColumn('program_studi', function ($alpa) {
            //     return $alpa->mahasiswa ? $alpa->mahasiswa->program_studi : 'Tidak Ada';
            // })
            ->addColumn('periode', function ($alpa) {
                return $alpa->periode ? $alpa->periode->nama_periode : 'Tidak Ada';
            })
            ->addColumn('jam_alpa', function ($alpa) {
                return $alpa->jam_alpa ?? '-';
            })
            ->rawColumns(['nama_mahasiswa', 'nim', 'program_studi', 'periode', 'jam_alpa'])
            ->make(true);
    }
}
