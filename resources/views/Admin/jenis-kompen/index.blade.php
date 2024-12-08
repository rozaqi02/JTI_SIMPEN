@extends('layouts.template')

@section('content')
<div class="card card-outline card-primary">
    <div class="card-header">
        <h3 class="card-title">{{ $page->title }}</h3>
        <div class="card-tools">
            <button onclick="modalAction('{{ url('/jenis-kompen/create') }}')" class="btn btn-sm btn-success mt-1">Tambah Data</button>
        </div>
    </div>
    <div class="card-body">
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <table class="table table-bordered table-striped table-hover table-sm" id="table_jenis_kompen">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama Jenis Tugas</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($jenisKompen as $item)
                <tr>
                    <td>{{ $item->id_jenis_kompen }}</td>
                    <td>{{ $item->nama_jenis_kompen }}</td>
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
