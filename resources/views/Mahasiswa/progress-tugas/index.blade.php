@extends('layouts.template')

@section('content')
<div class="card card-outline card-primary">
    <div class="card-header">
        <h3 class="card-title">{{ $page->title }}</h3>
    </div>
    <div class="card-body">
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <table class="table table-bordered table-striped table-hover table-sm" id="table_tugas">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Pemberi Tugas</th>
                    <th>Judul Tugas</th>
                    <th>Jenis Tugas</th>
                    <th>Tanggal Upload</th>
                    <th>Progress</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($progressTugas as $index => $item)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $item->pemberi_tugas }}</td> <!-- Pemberi tugas -->
                    <td>{{ $item->nama_tugas }}</td> <!-- Judul tugas -->
                    <td>{{ $item->jenis_kompen}}</td> <!-- Jenis Kompen -->
                    <td>{{ $item->created_at }}</td> <!-- Tanggal upload -->
                    <td>{{ $item->progress_tugas }}</td> <!-- Progress -->
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
