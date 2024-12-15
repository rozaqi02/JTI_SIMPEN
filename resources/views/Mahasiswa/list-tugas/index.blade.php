@extends('layouts.template')

@section('content')
<div class="card card-outline card-primary">
    <div class="card-header">
        <h3 class="card-title">Daftar Tugas</h3>
    </div>
    <div class="card-body">
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <!-- Table -->
        <table class="table table-bordered table-striped table-hover table-sm" id="table_ngambil_tugas">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Pemberi Tugas</th>
                    <th>Jenis Kompen</th>
                    <th>Nama Tugas</th>
                    <th>Deskripsi Tugas</th>
                    <th>Kuota</th>
                    <th>Nilai Kompen</th>
                    <th>Aksi</th>
                </tr>
            </thead>
        </table>
    </div>
</div>

<!-- Modal for AJAX Content -->
<div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <!-- Konten AJAX akan dimasukkan di sini -->
        </div>
    </div>
</div>

@endsection

@push('css')
<!-- Add any custom CSS here -->
@endpush

@push('js')
<script>
    // Initialize DataTable
    var dataNgambilTugas;
    $(document).ready(function() {
        dataNgambilTugas = $('#table_ngambil_tugas').DataTable({
            serverSide: true,
            processing: true,
            ajax: {
                url: "{{ url('list-tugas/mahasiswa/list') }}", // Pastikan URL sesuai dengan rute
                dataType: "json",
                type: "POST",
                data: function(d) {
                    d._token = "{{ csrf_token() }}"; // CSRF token
                    d.nama_tugas = $('#nama_tugas_filter').val(); // Filter nama tugas
                    d.kuota = $('#kuota_filter').val(); // Filter kuota
                },
                error: function(xhr, status, error) {
                    console.log(xhr.responseText);
                }
            },
            columns: [
                { data: "DT_RowIndex", className: "text-center", orderable: false, searchable: false },
                { data: "pemberi_tugas", orderable: true, searchable: true },
                { data: "jenis_kompen", orderable: true, searchable: true },
                { data: "nama_tugas", orderable: true, searchable: true },
                { data: "deskripsi_tugas", orderable: true, searchable: true },
                { data: "kuota", className: "text-center", orderable: true, searchable: true },
                { data: "nilai_kompen", className: "text-center", orderable: true, searchable: true },
                { data: "aksi", className: "text-center", orderable: false, searchable: false }
            ]
        });

        // Event untuk filter
        $('#nama_tugas_filter, #kuota_filter').on('input', function() {
            dataNgambilTugas.ajax.reload();
        });
    });

    // Fungsi untuk menampilkan modal AJAX
    function modalAction(url) {
        $.ajax({
            url: url,
            type: 'GET',
            success: function(response) {
                $('#myModal').html(response.html); // Isi modal dengan data dari server
                $('#myModal').modal('show'); // Tampilkan modal
            },
            error: function(xhr) {
                console.error('Error:', xhr.responseText);
                alert('Terjadi kesalahan. Silakan coba lagi.');
            }
        });
    }

    // Fungsi untuk mengirimkan permintaan pengambilan tugas
    function submitTugas(id) {
        $.ajax({
            url: '/list-tugas/' + id + '/submit', // Ganti dengan URL endpoint untuk submit
            type: 'POST',
            data: {
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                alert('Tugas berhasil diambil!');
                $('#myModal').modal('hide'); // Tutup modal
                location.reload(); // Reload halaman setelah berhasil
            },
            error: function(xhr) {
                console.error('Error:', xhr.responseText);
                alert('Terjadi kesalahan. Silakan coba lagi.');
            }
        });
    }
</script>
@endpush
