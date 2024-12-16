@extends('layouts.template')

@section('content')

<div class="container-fluid">
    <!-- Menampilkan pesan selamat datang -->
    <div class="row mb-3">
        <div class="col-12 text-center">
            <div class="card shadow-sm rounded-lg border-light">
                <div class="card-body">
                    <h4 class="font-weight-bold text-dark">
                        Selamat datang, <span class="text-capitalize text-primary">{{ $namaMahasiswa }}</span>!
                    </h4>
                    <p class="text-muted">Semoga Anda sukses dalam menyelesaikan tugas dan kegiatan yang ada.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Info Cards -->
    <div class="row">
        <!-- Total Jam Alpa Card -->
        <div class="col-lg-3 col-6 mb-3">
            <div class="small-box bg-info text-white rounded shadow-sm">
                <div class="inner">
                    <h3 class="font-weight-bold">{{ $totalJamAlpa }} Jam</h3>
                    <p>Total Jam Alpa Mahasiswa</p>
                </div>
                <div class="icon">
                    <i class="fas fa-clock"></i>
                </div>
                <a href="/alpaku" class="small-box-footer">
                    More info <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>

        <!-- Total Tugas Card -->
        <div class="col-lg-3 col-6 mb-3">
            <div class="small-box bg-success text-white rounded shadow-sm">
                <div class="inner">
                    <h3 class="font-weight-bold">{{ $totalTugas }}</h3>
                    <p>Total Seluruh Tugas</p>
                </div>
                <div class="icon">
                    <i class="fas fa-clipboard-check"></i>
                </div>
                <a href="/list-tugas" class="small-box-footer">
                    More info <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>

        <!-- Additional Cards if needed -->
    </div>

</div>

@endsection
