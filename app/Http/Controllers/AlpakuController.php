<?php

namespace App\Http\Controllers;

use App\Models\PeriodeModel;
use App\Models\AlpakuModel;
use App\Models\MahasiswaModel;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Auth;

class AlpakuController extends Controller
{
    public function index()
    {
        // Ambil data mahasiswa yang sedang login
        $user = Auth::user();
        $mahasiswa = MahasiswaModel::where('id_user', $user->id_user)->first();

        // Ambil data periode
        $periode = PeriodeModel::all();

        // Ambil data alpa mahasiswa berdasarkan id_mahasiswa
        $alpaku = AlpakuModel::where('id_mahasiswa', $mahasiswa->id_mahasiswa)
                             ->with('periode') // Pastikan relasi dengan periode
                             ->get(); 

        $breadcrumb = (object) [
            'title' => 'Data Alpa Mahasiswa',
            'list' => ['JTI-SIMPEN', 'Alpaku']
        ];

        $page = (object) [
            'title' => 'Data Alpa Mahasiswa'
        ];

        $activeMenu = 'data-alpa';

        // Pass data ke view
        return view('mahasiswa.alpaku.index', compact('breadcrumb', 'page', 'activeMenu', 'periode', 'alpaku'));
    }

    public function list(Request $request)
    {
        // Mengambil data mahasiswa yang sedang login
        $mahasiswa = MahasiswaModel::where('id_user', Auth::id())->first();

        // Pastikan mahasiswa ditemukan
        if (!$mahasiswa) {
            return response()->json(['error' => 'Mahasiswa tidak ditemukan'], 404);
        }

        // Mengambil data alpa berdasarkan id_mahasiswa dan periode yang dipilih
        $alpaku = AlpakuModel::where('id_mahasiswa', $mahasiswa->id_mahasiswa);

        // Filter berdasarkan periode
        if ($request->filled('periode')) {
            $alpaku->where('id_periode', $request->periode);
        }

        // Ambil data dan format menjadi JSON untuk DataTable
        return DataTables::eloquent($alpaku->with('periode'))
            ->addColumn('periode', function($row) {
                return $row->periode ? $row->periode->nama_periode : 'N/A';
            })
            ->addIndexColumn()
            ->make(true);
    }
}

