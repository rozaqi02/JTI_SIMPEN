@extends('layouts.template')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <!-- Total Tugas Card -->
            <div class="col-lg-3 col-6">
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>{{ $totalTugasUser }}</h3>
                        <p>Total Tugas</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-tasks"></i>
                    </div>
                    <a href="/daftar-tugas" class="small-box-footer">
                        More info <i class="fas fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>

            <!-- Total Kompen Card -->
            <div class="col-lg-3 col-6">
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3>{{ $totalTugas }}</h3>
                        <p>Total Seluruh Tugas</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-clipboard-check"></i>
                    </div>
                    <a href="/info-mahasiswa" class="small-box-footer">
                        More info <i class="fas fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
        </div>

        <!-- Data Mahasiswa -->
        <div class="row mt-4">
            <div class="col-lg-12">
                <h4>Data Absensi dan Kompen Mahasiswa</h4>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Mahasiswa</th>
                            <th>NIM</th>
                            <th>Prodi</th>
                            <th>Semester</th>
                            <th>Jumlah Alpha</th>
                            <th>Kompen</th>
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
        <div class="row mt-4">
            <div class="col-lg-12">
                <canvas id="tugasChart"></canvas>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Menampilkan chart tugas
        var ctx = document.getElementById('tugasChart').getContext('2d');
        var tugasChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: {!! json_encode($chartData->keys()) !!},
                datasets: [{
                    label: 'Jumlah Tugas',
                    data: {!! json_encode($chartData->values()) !!},
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
@endsection
