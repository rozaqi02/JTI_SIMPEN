@extends('layouts.template')

@section('content')
<div class="card card-outline card-primary">
    <div class="card-header">
        <h3 class="card-title">Daftar Tugas</h3>
    </div>
    <div class="card-body">
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

<div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content"></div>
    </div>
</div>
@endsection

@push('js')
<script>
    $(document).ready(function() {
        $('#table_ngambil_tugas').DataTable({
            serverSide: true,
            processing: true,
            ajax: {
                url: "{{ url('list-tugas/mahasiswa/list') }}",
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}'
                }
            },
            columns: [
                { data: 'DT_RowIndex', orderable: false, searchable: false },
                { data: 'pemberi_tugas' },
                { data: 'jenis_kompen' },
                { data: 'nama_tugas' },
                { data: 'deskripsi_tugas' },
                { data: 'kuota', className: 'text-center' },
                { data: 'nilai_kompen', className: 'text-center' },
                { data: 'aksi', className: 'text-center' }
            ]
        });
    });

    function modalAction(url) {
        $.ajax({
            url: url,
            success: function(response) {
                $('#myModal .modal-content').html(response.html);
                $('#myModal').modal('show');
            },
            error: function(xhr) {
                alert('Terjadi kesalahan, silakan coba lagi.');
            }
        });
    }

    function submitTugas(id) {
        $.ajax({
            url: '/list-tugas/' + id + '/submit',
            type: 'POST',
            data: {
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                alert(response.message);
                $('#myModal').modal('hide');
                $('#table_ngambil_tugas').DataTable().ajax.reload();
            },
            error: function(xhr) {
                alert('Terjadi kesalahan, silakan coba lagi.');
            }
        });
    }
</script>
@endpush
