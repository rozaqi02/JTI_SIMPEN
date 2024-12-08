@extends('layouts.template')

@section('content')
<div class="card card-outline card-primary">
    <div class="card-header">
        <h3 class="card-title">{{ $page->title }}</h3>
        <div class="card-tools">
            <button onclick="modalAction('{{ url('/progress-tugas/create') }}')" class="btn btn-sm btn-success mt-1">Tambah Progress</button>
        </div>
    </div>
    <div class="card-body">
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <table class="table table-bordered table-striped table-hover table-sm" id="table_progress_tugas">
            <thead>
                <tr>
                    <th>ID Tugas</th>
                    <th>Status Progress</th>
                    <th>Deskripsi</th>
                    <th>Tanggal Update</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($progressTugas as $item)
                <tr>
                    <td>{{ $item->id_tugas }}</td>
                    <td>{{ $item->status_progress }}</td>
                    <td>{{ $item->deskripsi }}</td>
                    <td>{{ $item->tanggal_update }}</td>
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
