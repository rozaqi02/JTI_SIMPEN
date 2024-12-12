@extends('layouts.template')

@section('content')
<div class="card card-outline card-primary">
    <div class="card-header">
        <h3 class="card-title">{{ $page->title }}</h3>
        <div class="card-tools">
        </div>
    </div>
    <div class="card-body">
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <!-- Filter Form -->
        <div class="row">
            <div class="col-md-12">
                <div class="form-group row">
                    <label class="col-1 control-label col-form-label">Filter: </label>
                    <div class="col-3">
                        <input type="text" class="form-control" id="nama_tugas_filter" placeholder="Cari Nama Tugas">
                    </div>
                    <div class="col-3">
                        <input type="number" class="form-control" id="kuota_filter" placeholder="Min. Kuota">
                    </div>
                    <div class="col-3">
                        <button onclick="filterTable()" class="btn btn-primary">Filter</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Table -->
        <table class="table table-bordered table-striped table-hover table-sm" id="table_tugas_pendidik">
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
    var dataTugasPendidik;
    $(document).ready(function() {
        dataTugasPendidik = $('#table_tugas_pendidik').DataTable({
            serverSide: true, // Memastikan DataTable menggunakan server-side processing
            processing: true, // Menunjukkan bahwa data sedang diproses
            ajax: {
                "url": "{{ url('tugas-pendidik/list') }}", // URL untuk list data tugas pendidik
                "dataType": "json",
                "type": "POST", // Pastikan method-nya POST, sesuai dengan controller
                "data": function(d) {
                    d._token = "{{ csrf_token() }}"; // Menambahkan CSRF token untuk keamanan
                    d.nama_tugas = $('#nama_tugas_filter').val(); // Menambahkan filter berdasarkan nama_tugas
                    d.kuota = $('#kuota_filter').val(); // Menambahkan filter berdasarkan kuota
                },
                "error": function(xhr, status, error) {
                    console.log(xhr.responseText); // Log error jika ada
                }
            },
            columns: [
                {
                    data: "DT_RowIndex", // Data untuk index otomatis
                    className: "text-center",
                    orderable: false,
                    searchable: false
                },
                {
                    data: "user_name", // Menampilkan nama user terkait
                    className: "",
                    orderable: true,
                    searchable: true
                },
                {
                    data: "jenis_kompen", // Menampilkan jenis kompensasi
                    className: "",
                    orderable: true,
                    searchable: true
                },
                {
                    data: "nama_tugas", // Data untuk kolom nama_tugas
                    className: "",
                    orderable: true,
                    searchable: true
                },
                {
                    data: "deskripsi_tugas", // Data untuk kolom deskripsi_tugas
                    className: "",
                    orderable: true,
                    searchable: true
                },
                {
                    data: "kuota", // Data untuk kolom kuota
                    className: "text-center",
                    orderable: true,
                    searchable: true
                },
                {
                    data: "nilai_kompen", // Data untuk kolom nilai_kompen
                    className: "text-center",
                    orderable: true,
                    searchable: true
                },
                {
                    data: "aksi", // Data untuk tombol aksi (Detail, Edit, Hapus)
                    className: "",
                    orderable: false,
                    searchable: false
                }
            ]
        });

        // Jika Anda menambahkan filter berdasarkan nama_tugas atau kuota, Anda bisa menangkap event change
        $('#nama_tugas_filter, #kuota_filter').on('input', function() {
            dataTugasPendidik.ajax.reload(); // Reload DataTable dengan filter baru
        });
    });

    // Function to trigger table filtering
    function filterTable() {
        dataTugasPendidik.ajax.reload(); // Reload DataTable with the updated filters
    }
</script>
@endpush
