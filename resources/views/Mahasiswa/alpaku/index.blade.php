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

        <table class="table table-bordered table-striped table-hover table-sm" id="table_alpaku">
            <thead>
                <tr>
                    <th>ID Mahasiswa</th>
                    <th>Nama Mahasiswa</th>
                    <th>NIM</th>
                    <th>Jumlah Alpa</th>
                </tr>
            </thead>
            <tbody>
                @foreach($mahasiswa as $item)
                <tr>
                    <td>{{ $item->id_mahasiswa }}</td>
                    <td>{{ $item->nama_mahasiswa }}</td>
                    <td>{{ $item->nim }}</td>
                    <td>{{ $item->alpa_count }}</td> <!-- Menggunakan alpa_count untuk jumlah alpa -->
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection