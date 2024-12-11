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
                    <th>Pemberi Tugas</th> <!-- Menambahkan kolom user -->
                    <th>Jenis Kompen</th> <!-- Menambahkan kolom jenis kompensasi -->
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

<!-- Modal for show, edit, delete actions -->
<div id="myModal" class="modal fade animate shake" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" data-width="75%" aria-hidden="true"></div>

@endsection

@push('css')
<!-- Add any custom CSS here -->
@endpush

@push('js')
<script>
    // Function to load modal for show, edit, or delete actions
    function modalAction(url = '') {
        $('#myModal').load(url, function() {
            $('#myModal').modal('show');
        });
    }

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
</script>
@endpush
