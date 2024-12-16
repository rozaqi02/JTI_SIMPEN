    @extends('layouts.template')

    @section('content')
    <div class="card card-outline card-primary shadow">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h3 class="card-title"><i class="fas fa-tasks"></i> {{ $page->title }}</h3>
            <button onclick="modalAction('{{ url('/Pendidik/create_ajax') }}')" class="btn btn-success btn-sm">
                <i class="fas fa-plus"></i> Tambah Tugas
            </button>            
        </div>
        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <!-- Filter Form -->
            <div class="mb-4 p-3 bg-light rounded">
                <h5 class="mb-3"><i class="fas fa-filter"></i> Filter Tugas</h5>
                <div class="row">
                    <div class="col-lg-4">
                        <label for="jenis_kompen_filter" class="form-label">Jenis Kompen:</label>
                        <select class="form-control form-select" id="jenis_kompen_filter">
                            <option value="">-- Pilih Jenis Kompen --</option>
                            @foreach ($jenisKompen as $jenis)
                                <option value="{{ $jenis->id_jenis_kompen }}">{{ $jenis->nama_jenis_kompen }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <!-- Table -->
            <div class="table-responsive">
                <table class="table table-hover table-striped table-bordered" id="table_tugas_pendidik">
                    <thead class="table-dark">
                        <tr>
                            <th>No</th>
                            <th>Jenis Kompen</th>
                            <th>Nama Tugas</th>
                            <th>Deskripsi Tugas</th>
                            <th>Kuota</th>
                            <th>Nilai Kompen</th>
                            <th>Tanggal</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal for show, edit, delete actions -->
    <div id="myModal" class="modal fade animate shake" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" data-width="75%" aria-hidden="true"></div>

    @empty($jenisKompen)
        <div class="alert alert-danger mt-4">
            <h5><i class="icon fas fa-ban"></i> Kesalahan!</h5>
            Data jenis kompen tidak ditemukan. Silakan tambahkan data terlebih dahulu.
        </div>
    @endempty

    @endsection

    @push('css')
    <style>
        .table-hover tbody tr:hover {
            background-color: #f8f9fa;
        }

        .table th, .table td {
            text-align: center;
            vertical-align: middle;
        }

        .card-header .btn-success {
            position: absolute;
            top: 10px;
            right: 10px;
        }
    </style>
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
        $(document).ready(function() {
            $('#table_tugas_pendidik').DataTable({
                serverSide: true,
                processing: true,
                ajax: {
                    url: "{{ url('Pendidik/list') }}",
                    type: "POST",
                    data: function(d) {
                        d._token = "{{ csrf_token() }}";
                        d.jenis_kompen = $('#jenis_kompen_filter').val();
                    },
                    error: function(xhr, status, error) {
                        console.log(xhr.responseText);
                    }
                },
                columns: [
                    { data: 'DT_RowIndex', className: "text-center", orderable: false, searchable: false },
                    { data: 'jenis_kompen', name: 'jenis_kompen' },
                    { data: 'nama_tugas', name: 'nama_tugas' },
                    { data: 'deskripsi_tugas', name: 'deskripsi_tugas' },
                    { data: 'kuota', name: 'kuota', className: "text-center" },
                    { data: 'nilai_kompen', name: 'nilai_kompen', className: "text-center" },
                    { data: 'created_at', name: 'created_at', className: "text-center" },
                    { data: 'aksi', orderable: false, searchable: false, className: "text-center" }
                ]
            });

            $('#jenis_kompen_filter').on('change', function() {
                $('#table_tugas_pendidik').DataTable().ajax.reload();
            });
        });

        // Function to trigger table reload
        function filterTable() {
            $('#table_tugas_pendidik').DataTable().ajax.reload(); // Reload DataTable
        }
    </script>
    @endpush
