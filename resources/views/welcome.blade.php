@extends('layouts.template')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <!-- Total Tugas Card -->
            <div class="col-lg-3 col-6">
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>150</h3> <!-- Total Tugas (dummy data) -->
                        <p>Total Tugas</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-tasks"></i> <!-- Icon tugas -->
                    </div>
                    <a href="#" class="small-box-footer">
                        More info <i class="fas fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>

            <!-- Total Kompen Card -->
            <div class="col-lg-3 col-6">
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3>3</h3> <!-- Total Kompen (dummy data) -->
                        <p>Total Kompen</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-clipboard-check"></i> <!-- Icon kompen -->
                    </div>
                    <a href="#" class="small-box-footer">
                        More info <i class="fas fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
        </div>

        <!-- Filter Dropdown -->
        <div class="row mb-4">
            <div class="col-lg-4">
                <h4>Data Absensi dan Kompen Mahasiswa</h4>
                <!-- Form Filter (Hanya Tampilan Saja, belum terhubung ke backend) -->
                <form>
                    <div class="input-group">
                        <select name="semester" class="form-control">
                            <option value="2022/2023 Ganjil">2022/2023 Ganjil</option>
                            <option value="2022/2023 Genap">2022/2023 Genap</option>
                            <option value="2023/2024 Ganjil">2023/2024 Ganjil</option>
                            <option value="2023/2024 Genap">2023/2024 Genap</option>
                        </select>
                        <div class="input-group-append">
                            <button class="btn btn-success" type="button">Filter</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Table for Absensi and Kompen -->
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Daftar Absensi dan Kompen Mahasiswa</h3>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nama Mahasiswa</th>
                                    <th>NIM</th>
                                    <th>Prodi</th>
                                    <th>Semester</th>
                                    <th>Jumlah Alpha</th>
                                    <th>Kompen</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Contoh Data Dummy -->
                                <tr>
                                    <td>1</td>
                                    <td>Anas Nurhidayat</td>
                                    <td>2241760069</td>
                                    <td>D4 Sistem Informasi Bisnis</td>
                                    <td>Semester 5</td>
                                    <td>3</td>
                                    <td>1</td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>Rozaki</td>
                                    <td>2241760123</td>
                                    <td>D4 Teknik Informatika</td>
                                    <td>Semester 6</td>
                                    <td>2</td>
                                    <td>0</td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td>Chandra Bagus</td>
                                    <td>2241760079</td>
                                    <td>D4 Sistem Informasi Bisnis</td>
                                    <td>Semester 4</td>
                                    <td>0</td>
                                    <td>2</td>
                                </tr>
                                <tr>
                                    <td>4</td>
                                    <td>Amanda Jasmyne</td>
                                    <td>2241760081</td>
                                    <td>D4 Teknik Informatika</td>
                                    <td>Semester 7</td>
                                    <td>1</td>
                                    <td>0</td>
                                </tr>
                                <!-- Jika tidak ada data -->
                                <tr>
                                    <td colspan="7" class="text-center">Data tidak ditemukan</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection

@section('scripts')
    <!-- Chart.js CDN -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Data for the chart
        var ctx = document.getElementById('tugasChart').getContext('2d');
        var tugasChart = new Chart(ctx, {
            type: 'bar', // Type of chart (bar, line, pie, etc.)
            data: {
                labels: ['Penelitian', 'Pengabdian', 'Teknis'], // Task categories
                datasets: [{
                    label: 'Jumlah Tugas Mahasiswa',
                    data: [50, 30, 70], // Data for each category (dummy data)
                    backgroundColor: ['rgba(54, 162, 235, 0.2)', 'rgba(75, 192, 192, 0.2)', 'rgba(153, 102, 255, 0.2)'],
                    borderColor: ['rgba(54, 162, 235, 1)', 'rgba(75, 192, 192, 1)', 'rgba(153, 102, 255, 1)'],
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