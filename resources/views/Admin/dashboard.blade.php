@extends('layouts.template')

@section('content')

<div class="container-fluid">
    <!-- Menampilkan pesan selamat datang dengan desain yang elegan -->
    <div class="row mb-4">
        <div class="col-12 text-center">
            <div class="card shadow-lg rounded-lg border-light">
                <div class="card-body">
                    <h3 class="font-weight-bold text-dark mb-2">
                        Selamat datang, <span class="text-capitalize text-primary">{{ $namaAdmin }}</span>!
                    </h3>
                    <p class="text-muted mb-3">Semoga Anda sukses dalam menyelesaikan tugas dan aktivitas di platform ini.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Info Cards untuk menampilkan data -->
    <div class="row">
        <!-- Total Tugas Card -->
        <div class="col-lg-3 col-6 mb-4">
            <div class="small-box bg-info text-white rounded-lg shadow-lg">
                <div class="inner">
                    <h3 class="font-weight-bold">{{ $totalTugasUser }}</h3>
                    <p>Total Tugas</p>
                </div>
                <div class="icon">
                    <i class="fas fa-tasks"></i>
                </div>
                <a href="/Pendidik" class="small-box-footer text-white">
                    More info <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>

        <!-- Total Kompen Card -->
        <div class="col-lg-3 col-6 mb-4">
            <div class="small-box bg-success text-white rounded-lg shadow-lg">
                <div class="inner">
                    <h3 class="font-weight-bold">{{ $totalTugas }}</h3>
                    <p>Total Seluruh Tugas</p>
                </div>
                <div class="icon">
                    <i class="fas fa-clipboard-check"></i>
                </div>
                <a href="/list-tugas" class="small-box-footer text-white">
                    More info <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>

        <!-- Data Mahasiswa -->
        <div class="row mt-4">
            <div class="col-lg-12">
                <h4>Data Mahasiswa Alpa</h4>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Mahasiswa</th>
                            <th>NIM</th>
                            <th>Prodi</th>
                            <th>Semester</th>
                            <th>Jumlah Alpha</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($mahasiswa as $index => $mhs)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $mhs->nama }}</td>
                                <td>{{ $mhs->nim }}</td>
                                <td>{{ $mhs->prodi }}</td>
                                <td>{{ $mhs->semester }}</td>
                                <td>-</td> <!-- Kosongkan jika data kompen tidak tersedia -->
                            </tr>
                        @endforeach
                        @if ($mahasiswa->isEmpty())
                            <tr>
                                <td colspan="6" class="text-center">Data tidak ditemukan</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Grafik -->
        <!-- Pie Chart -->
        <!-- Pie Chart Section -->
        <div class="row mt-2">
            <div class="col-lg-8 offset-lg-2" style=>
                <h4>Distribusi Tugas Berdasarkan Jenis Kompen</h4>
                <div class="chart-container">
                    <!-- Menyesuaikan ukuran canvas agar lebih proporsional dan responsif -->
                    <canvas id="pieChart" style="max-width:90%; height: 200px;"></canvas>
                </div>
            </div>
        </div>


    <!-- Chart.js Script -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        var ctx = document.getElementById('pieChart').getContext('2d');
        var pieChartData = {!! json_encode($pieChartData) !!}; // Data dari controller

        var labels = pieChartData.map(function(item) {
            return item.label;
        });
        var data = pieChartData.map(function(item) {
            return item.value;
        });
        var colors = pieChartData.map(function(item) {
            return item.color;
        });

        var chart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: labels,
                datasets: [{
                    data: data,
                    backgroundColor: colors,
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    tooltip: {
                        callbacks: {
                            label: function(tooltipItem) {
                                return tooltipItem.label + ': ' + tooltipItem.raw;
                            }
                        }
                    }
                }
            }
        });
    </script>
@endsection
