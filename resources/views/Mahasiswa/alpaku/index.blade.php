@extends('layouts.app')

@section('content')
<div class="container">
    <h2>{{ $page->title }}</h2>

    <!-- Tampilkan Breadcrumb -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            @foreach ($breadcrumb->list as $item)
                <li class="breadcrumb-item">{{ $item }}</li>
            @endforeach
        </ol>
    </nav>

    <!-- Tabel Data Alpa -->
    <table class="table">
        <thead>
            <tr>
                <th scope="col">Periode</th>
                <th scope="col">Jumlah Alpa</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($alpaData as $data)
                <tr>
                    <td>{{ $data->periode->periode_name }}</td>  <!-- Mengambil nama periode -->
                    <td>{{ $data->jumlah_alpa }}</td>  <!-- Menampilkan jumlah alpa -->
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
