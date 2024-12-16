@extends('layouts.template')

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">

            
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
                </div>
            </div>

        </div>
    </div>
</div>

@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Contoh data untuk grafik line
    var ctx = document.getElementById('lineChart').getContext('2d');
    var lineChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: ['Minggu 1', 'Minggu 2', 'Minggu 3', 'Minggu 4', 'Minggu 5'], // Label mingguan
            datasets: [{
                label: 'Tugas yang Diselesaikan',
                data: [5, 7, 8, 4, 6], // Jumlah tugas yang diselesaikan setiap minggu
                borderColor: 'rgba(75, 192, 192, 1)',
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                fill: true
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top',
                },
                tooltip: {
                    mode: 'index',
                    intersect: false,
                }
            },
            scales: {
                x: {
                    beginAtZero: true
                },
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    // Filter Periode
    $('#periode').change(function() {
        var periodeId = $(this).val();
        // Lakukan ajax untuk mendapatkan data alpa berdasarkan periode yang dipilih
        $.ajax({
            url: "{{ url('mahasiswa/alpa/list') }}", // Sesuaikan URL dengan rute di controller
            method: 'POST',
            data: {
                _token: "{{ csrf_token() }}",
                periode: periodeId
            },
            success: function(response) {
                var tbody = '';
                if(response.data.length > 0) {
                    $.each(response.data, function(index, alpa) {
                        tbody += `<tr>
                            <td>${index + 1}</td>
                            <td>${alpa.mahasiswa.nama}</td>
                            <td>${alpa.mahasiswa.program_studi}</td>
                            <td>${alpa.total_alpa} jam</td>
                        </tr>`;
                    });
                } else {
                    tbody = `<tr><td colspan="4" class="text-center">Data Alpa Tidak Tersedia</td></tr>`;
                }
                $('#alpaData').html(tbody);
            },
            error: function(xhr, status, error) {
                console.log(error);
            }
        });
    });
</script>
@endsection
