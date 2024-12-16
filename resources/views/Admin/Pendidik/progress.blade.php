@extends('layouts.template')

@section('content')
<div class="card card-outline card-primary shadow">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h3 class="card-title"><i class="fas fa-tasks"></i> Progress Penugasanku</h3>
    </div>

    <div class="table-responsive">
        <table id="table_progress" class="table table-bordered table-striped">
            <thead class="table-primary">
                <tr>
                    <th>No</th>
                    <th>Nama Mahasiswa</th>
                    <th>Nama Tugas</th>
                    <th>Jenis Kompen</th>
                    <th>Progress</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
    </div>   
</div>
<style>
    th, td {
        text-align: center;
        vertical-align: middle;
        white-space: nowrap; /* Cegah teks memanjang */
    }

    th.no, td.no { width: 5%; }
    th.nama_mahasiswa, td.nama_mahasiswa { width: 20%; }
    th.nama_tugas, td.nama_tugas { width: 25%; }
    th.jenis_kompen, td.jenis_kompen { width: 15%; }
    th.progress, td.progress { width: 15%; }
    th.aksi, td.aksi { width: 20%; }
</style>

<!-- Modal Konfirmasi -->
<div id="modalProgress" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title">Konfirmasi Progress</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Apakah Anda yakin ingin mengkonfirmasi progress tugas ini?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button id="btnConfirmProgress" class="btn btn-success">Konfirmasi</button>
            </div>
        </div>
    </div>
</div>
@endsection

@push('css')
<!-- DataTables CSS -->
<link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
@endpush

@push('js')
<!-- DataTables JS -->
<script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>

<script>
    $(document).ready(function() {
        // Setup CSRF Token for AJAX Requests
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        });

        // Initialize DataTables
        var table = $('#table_progress').DataTable({
    processing: true,
    serverSide: true,
    ajax: {
        url: "{{ route('progress.list') }}",
        type: "POST"
    },
    columns: [
        { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
        { data: 'nama_mahasiswa', name: 'nama_mahasiswa' },
        { data: 'nama_tugas', name: 'nama_tugas' },
        { data: 'jenis_kompen', name: 'jenis_kompen' },
        { data: 'progress', name: 'progress' },
        { data: 'aksi', name: 'aksi', orderable: false, searchable: false, className: 'text-center' }
    ]
});


        // Event Konfirmasi Progress
        var selectedUrl = '';
        $('#table_progress').on('click', '.btn-confirm', function() {
            selectedUrl = $(this).data('url');
            $('#modalProgress').modal('show');
        });

        // Confirm Action
        $('#btnConfirmProgress').click(function() {
            $.post(selectedUrl, function(response) {
                alert(response.message);
                $('#modalProgress').modal('hide');
                table.ajax.reload(); // Reload DataTable
            }).fail(function(xhr) {
                alert('Terjadi kesalahan: ' + xhr.responseJSON.message);
            });
        });

        // Event Hapus Progress
        $('#table_progress').on('click', '.btn-delete', function() {
            var deleteUrl = $(this).data('url');
            if (confirm('Apakah Anda yakin ingin menghapus progress ini?')) {
                $.ajax({
                    url: deleteUrl,
                    type: 'DELETE',
                    success: function(response) {
                        alert(response.message);
                        table.ajax.reload();
                    },
                    error: function(xhr) {
                        alert('Terjadi kesalahan: ' + xhr.responseJSON.message);
                    }
                });
            }
        });
    });
</script>
@endpush
