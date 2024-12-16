@extends('layouts.template')

@section('content')

<<<<<<< HEAD
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
=======
            
            <!-- Statistik Alpa Mahasiswa berdasarkan Periode -->
            <div class="row mt-4">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h5>Jumlah Alpa Mahasiswa Berdasarkan Periode</h5>
                        </div>
                        <div class="card-body">
                            <!-- Dropdown Pilih Periode -->
                            <div class="form-group">
                                <label for="periode">Pilih Periode</label>
                                <select id="periode" class="form-control">
                                    <option value="">-- Pilih Periode --</option>
                                    @foreach ($periode as $p)
                                        <option value="{{ $p->id_periode }}">{{ $p->nama_periode }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Tabel Data Alpa Mahasiswa -->
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Mahasiswa</th>

                                        <th>Jumlah Alpa</th>
                                    </tr>
                                </thead>
                                <tbody id="alpaData">
                                    @foreach ($alpaMahasiswa as $index => $alpa)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $alpa->mahasiswa->nama }}</td>
                                            <td>{{ $alpa->total_alpa }} jam</td>
                                        </tr>
                                    @endforeach
                                    @if ($alpaMahasiswa->isEmpty())
                                        <tr>
                                            <td colspan="4" class="text-center">Data Alpa Tidak Tersedia</td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Grafik Line Tugas yang Diselesaikan -->
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h5>Grafik Line Tugas yang Diselesaikan</h5>
                        </div>
                        <div class="card-body">
                            <div id="lineChartContainer">
                                <canvas id="lineChart"></canvas>
                            </div>
                        </div>
                    </div>
>>>>>>> 63c1ec1e85600b5210a4f6bbca73b9a6fddc0a4e
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
