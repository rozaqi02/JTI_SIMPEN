<?php

namespace App\Http\Controllers;

use App\Models\TugasPendidik;
use Illuminate\Http\Request;

class TugasPendidikController extends Controller
{
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Manajemen Daftar Tugas',
            'list' => ['Home', 'Manajemen', 'Daftar Tugas Pendidik']
        ];

        $page = (object) [
            'title' => 'Daftar Tugas'
        ];

        $activeMenu = 'daftar-tugas';

        // Mengambil data dari model
        $TugasPendidik = TugasPendidik::latest()->get();

        return view('admin.daftar-tugas.index', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'activeMenu' => $activeMenu,
            'TugasPendidik' => $TugasPendidik
        ]);
    }

    public function create()
    {
        return view('admin.daftar-tugas.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_tugas' => 'required|string|max:255',
            'deskripsi_tugas' => 'nullable|string',
            'kuota' => 'required|integer|min:1',
            'nilai_kompen' => 'required|numeric|min:0',
            'jumlah_jam' => 'required|numeric|min:0'
        ]);

        TugasPendidik::create($validated);

        return redirect('/daftar-tugas')->with('success', 'Tugas berhasil ditambahkan.');
    }
}
