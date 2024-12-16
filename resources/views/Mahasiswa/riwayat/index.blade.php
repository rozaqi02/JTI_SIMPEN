@extends('layouts.template')

@section('content')
<div class="card card-outline card-primary shadow">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h3 class="card-title"><i class="fas fa-history"></i> {{ $page->title }}</h3>
    </div>

    <div class="table-responsive p-3">
        <table id="table_riwayat_mahasiswa" class="table table-bordered table-striped">
            <thead class="table-primary">
                <tr>
                    <th>No</th>
                    <th>Nama Tugas</th>
                    <th>Tanggal Dilaksanakan</th>
                    <th>Tanggal Selesai</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
    </div>
</div>
@endsection

@push('css')
<link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
@endpush

@push('js')
<script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script>
    $(document).ready(function() {
        $('#table_riwayat_mahasiswa').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ url('riwayat-tugas/list') }}",
                type: "POST",
                data: {
                    _token: '{{ csrf_token() }}'
                }
            },
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                { data: 'nama_tugas', name: 'nama_tugas' },
                { data: 'tanggal_dilaksanakan', name: 'tanggal_dilaksanakan' },
                { data: 'tanggal_selesai', name: 'tanggal_selesai' },
                { data: 'status', name: 'status', orderable: false, searchable: false }
            ]
        });
    });
</script>
@endpush
