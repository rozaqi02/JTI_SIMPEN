@extends('layouts.template')

@section('content')
<div class="card card-outline card-primary">
    <div class="card-header">
        <h3 class="card-title">{{ $page->title }}</h3>
        <div class="card-tools">
            <button onclick="modalAction('{{ url('/bidkom/create_ajax') }}')" class="btn btn-sm btn-success mt-1">Tambah Data</button>
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
                        <input type="text" class="form-control" id="id_bidkom_filter" placeholder="Cari ID Bidkom">
                    </div>
                </div>
            </div>
        </div>

        <!-- Table -->
        <table class="table table-bordered table-striped table-hover table-sm" id="table_bidkom">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Kode Bidkom</th>
                    <th>Nama Bidkom</th>
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
    var dataBidkom;
$(document).ready(function() {
    dataBidkom = $('#table_bidkom').DataTable({
        serverSide: true, // Memastikan DataTable menggunakan server-side processing
        processing: true, // Menunjukkan bahwa data sedang diproses
        ajax: {
            "url": "{{ url('bidkom/list') }}", // Pastikan ini sesuai dengan URL route yang benar
            "dataType": "json",
            "type": "POST", // Pastikan method-nya POST, sesuai dengan controller
            "data": function(d) {
                d._token = "{{ csrf_token() }}"; // Menambahkan CSRF token untuk keamanan
                // Anda bisa menambahkan parameter lain di sini jika perlu filter tambahan
                d.id_bidkom = $('#id_bidkom').val(); // Misalnya mengambil filter id_bidkom dari input
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
                data: "kode_bidkom", // Data untuk kolom kode_bidkom
                className: "",
                orderable: true,
                searchable: true
            },
            {
                data: "nama_bidkom", // Data untuk kolom nama_bidkom
                className: "",
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

    // Jika Anda menambahkan filter berdasarkan id_bidkom, Anda bisa menangkap event change
    $('#id_bidkom').on('change', function() {
        dataBidkom.ajax.reload(); // Reload DataTable dengan filter baru
    });
});

</script>
@endpush
