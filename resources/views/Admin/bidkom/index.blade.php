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
            serverSide: true,
            processing: true,
            ajax: {
                "url": "{{ url('bidkom/list') }}",
                "dataType": "json",
                "type": "POST",
                "data": function(d) {
                    d._token = "{{ csrf_token() }}";
                },
                "error": function(xhr, status, error) {
                    console.log(xhr.responseText);
                }
            },
            columns: [
                {
                    data: "DT_RowIndex",
                    className: "text-center",
                    orderable: false,
                    searchable: false
                },
                {
                    data: "kode_bidkom",
                    className: "",
                    orderable: true,
                    searchable: true
                },
                {
                    data: "nama_bidkom",
                    className: "",
                    orderable: true,
                    searchable: true
                },
                {
                    data: "aksi",
                    className: "",
                    orderable: false,
                    searchable: false
                }
            ]
        });
    });
</script>
@endpush
