@extends('layouts.template')

@section('content')

<div class="container-fluid">
    <!-- Menampilkan pesan selamat datang -->
    <div class="row mb-4">
        <div class="col-12 text-center">
            <div class="card shadow-lg rounded-lg border-light">
                <div class="card-body">
                    <h4 class="font-weight-bold text-dark">
                        Selamat datang, <span class="text-capitalize text-primary">{{ $namaTendik }}</span>!
                    </h4>
                    <p class="text-muted">Semoga Anda sukses dalam menyelesaikan tugas dan kegiatan yang ada.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Row untuk Card dan Grafik -->
    <div class="row">
        <!-- Total Tugas Card -->
        <div class="col-lg-3 col-6">
            <div class="small-box bg-info shadow rounded">
                <div class="inner">
                    <h3>{{ $totalTugasUser }}</h3>
                    <p>Total Tugas</p>
                </div>
                <div class="icon">
                    <i class="fas fa-tasks"></i>
                </div>
                <a href="/Pendidik" class="small-box-footer">
                    More info <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
@endsection
