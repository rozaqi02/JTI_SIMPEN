@extends('layouts.template')

@section('content')
<div class="card card-outline card-primary">
    <div class="card-header">
        <h3 class="card-title">Data Alpa Mahasiswa</h3>
    </div>
    <div class="card-body">
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <!-- Filter Periode -->
        <div class="row mb-4">
            <div class="col-lg-4">
                <h5>Filter</h5>
                <form>
                    <div class="input-group">
                        <select id="periode_filter" name="periode" class="form-control">
                            <option value="">-- Semua Periode --</option>
                            @foreach ($periode as $p)
                                <option value="{{ $p->id_periode }}">{{ $p->nama_periode }}</option>
                            @endforeach
                        </select>
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="button" id="filter_button">Filter</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Table -->
        <table class="table table-bordered table-striped table-hover table-sm" id="table_alpa">
            <thead>
                <tr>
                    <th>No</th>
                    {{-- <th>Nama Mahasiswa</th>
                    <th>NIM</th>
                    <th>Program Studi</th> --}}
                    <th>Periode</th>
                    <th>Jam Alpa</th>
                </tr>
            </thead>
        </table>
    </div>
</div>

<!-- Modal -->
<div id="myModal" class="modal fade animate shake" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" data-width="75%" aria-hidden="true"></div>

@endsection

@push('css')
<!-- Add any custom CSS if necessary -->
@endpush

@push('js')
<script>
    $(document).ready(function() {
        // Initialize DataTable
        var dataAlpa = $('#table_alpa').DataTable({
            serverSide: true,
            processing: true,
            ajax: {
                url: "{{ url('mahasiswa/alpa/list') }}", // Pastikan URL sesuai rute controller
                dataType: "json",
                type: "POST",
                data: function(d) {
                    d._token = "{{ csrf_token() }}"; // CSRF Token
                    d.periode = $('#periode_filter').val(); // Filter periode
                },
                error: function(xhr, status, error) {
                    console.log(xhr.responseText);
                }
            },
            columns: [
                { data: "DT_RowIndex", className: "text-center", orderable: false, searchable: false },
                // { data: "nama_mahasiswa", name: "nama_mahasiswa" },
                // { data: "nim", name: "nim" },
                // { data: "program_studi", name: "program_studi" },
                { data: "periode", name: "periode" },
                { data: "jam_alpa", name: "jam_alpa", className: "text-center" }
            ]
        });

        // Event for filter
        $('#periode_filter, #filter_button').on('change click', function() {
            dataAlpa.ajax.reload();
        });
    });
</script>
@endpush
