@extends('layouts.template')

@section('content')
<div class="card card-outline card-primary">
    <div class="card-header">
        <h3 class="card-title">{{ $page->title }}</h3>
        <div class="card-tools">
            <button onclick="modalAction('{{ url('/daftar-tugas/create') }}')" class="btn btn-sm btn-success mt-1">Tambah Tugas</button>
        </div>
    </div>
    <div class="card-body">
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <table class="table table-bordered table-striped table-hover table-sm" id="table_daftar_tugas">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama Tugas</th>
                    <th>Deskripsi</th>
                    <th>Kuota</th>
                    <th>Nilai Kompen</th>
                    <th>Jumlah Jam</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($TugasPendidik as $item)
                <tr>
                    <td>{{ $item->id_detail_tugas }}</td>
                    <td>{{ $item->nama_tugas }}</td>
                    <td>{{ $item->deskripsi_tugas }}</td>
                    <td>{{ $item->kuota }}</td>
                    <td>{{ $item->nilai_kompen }}</td>
                    <td>{{ $item->jumlah_jam }}</td>
                    <td>
                        <button class="btn btn-sm btn-warning">Edit</button>
                        <button class="btn btn-sm btn-danger">Hapus</button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
