@extends('layouts.template')

@section('content')
<div class="card card-outline card-primary">
    <div class="card-header">
        <h3 class="card-title">{{ $page->title }}</h3>
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
                        <input type="text" class="form-control" id="nama_jenis_kompen_filter" placeholder="Cari Nama Jenis Kompen">
                    </div>
                </div>
            </div>
        </div>

        <!-- Table -->
        <table class="table table-bordered table-striped table-hover table-sm" id="table_jenis_kompen">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama Jenis Kompen</th>
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
    var dataJenisKompen;
    $(document).ready(function() {
        dataJenisKompen = $('#table_jenis_kompen').DataTable({
            serverSide: true, // Memastikan DataTable menggunakan server-side processing
            processing: true, // Menunjukkan bahwa data sedang diproses
            ajax: {
                "url": "{{ url('jenis-kompen/list') }}", // Pastikan ini sesuai dengan URL route yang benar
                "dataType": "json",
                "type": "POST", // Pastikan method-nya POST, sesuai dengan controller
                "data": function(d) {
                    d._token = "{{ csrf_token() }}"; // Menambahkan CSRF token untuk keamanan
                    // Anda bisa menambahkan parameter lain di sini jika perlu filter tambahan
                    d.nama_jenis_kompen = $('#nama_jenis_kompen_filter').val(); // Misalnya mengambil filter nama_jenis_kompen dari input
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
                    data: "nama_jenis_kompen", // Data untuk kolom nama_jenis_kompen
                    className: "",
                    orderable: true,
                    searchable: true
                }
            ]
        });

        // Jika Anda menambahkan filter berdasarkan nama_jenis_kompen, Anda bisa menangkap event change
        $('#nama_jenis_kompen_filter').on('keyup', function() {
            dataJenisKompen.ajax.reload(); // Reload DataTable dengan filter baru
        });
    });

</script>
@endpush
