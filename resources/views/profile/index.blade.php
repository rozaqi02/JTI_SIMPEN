@extends('layouts.template')

@section('content')
    <div id="myModal" class="modal fade animate shake" tabindex="-1" role="dialog" data-backdrop="static"
        data-keyboard="false" data-width="75%" aria-hidden="true"></div>

    <div class="container rounded bg-white shadow-lg mt-5 mb-5 p-4">
        <div class="row" id="profile">
            <!-- Profile Picture and Edit Button -->
            <div class="col-md-4 border-right text-center">
                <div class="p-3 py-5">
                    <div class="d-flex flex-column align-items-center">
                        <img class="rounded-circle mb-4 shadow" width="200px" id="profile-image" src="{{ asset($user->foto) }}" alt="Profile Picture">
                        <button onclick="modalAction('{{ url('/profile/' . session('id_user') . '/edit_foto') }}')" class="btn btn-outline-primary btn-sm">Edit Foto</button>
                    </div>
                </div>
            </div>

            <!-- Profile Details Section -->
            <div class="col-md-8">
                <div class="p-3 py-4">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h4 class="font-weight-bold">Profil Anda</h4>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover table-sm">
                            <tbody>
                                <tr>
                                    <th>ID</th>
                                    <td id="profile-id">{{ $user->id_user }}</td>
                                </tr>
                                <tr>
                                    <th>Level</th>
                                    <td id="profile-level">{{ $user->level->level_nama }}</td>
                                </tr>
                                <tr>
                                    <th>Username</th>
                                    <td id="profile-username">{{ $user->username }}</td>
                                </tr>
                                <tr>
                                    <th>Password</th>
                                    <td>********</td>
                                </tr>

                                <!-- Displaying role-specific data -->
                                @if ($data['mahasiswa'])
                                    <tr>
                                        <th>NIM</th>
                                        <td>{{ $data['mahasiswa']->nim }}</td>
                                    </tr>
                                    <tr>
                                        <th>Program Studi</th>
                                        <td>{{ $data['mahasiswa']->program_studi }}</td>
                                    </tr>
                                    <tr>
                                        <th>Tahun Masuk</th>
                                        <td>{{ $data['mahasiswa']->tahun_masuk }}</td>
                                    </tr>
                                    <tr>
                                        <th>Bidkom</th>
                                        <td>{{ $data['mahasiswa']->bidkom }}</td>
                                    </tr>
                                @elseif ($data['admin'])
                                    <tr>
                                        <th>Email</th>
                                        <td>{{ $data['admin']->email }}</td>
                                    </tr>
                                    <tr>
                                        <th>No Telepon</th>
                                        <td>{{ $data['admin']->no_telepon }}</td>
                                    </tr>
                                    <tr>
                                        <th>Nama Admin</th>
                                        <td>{{ $data['admin']->nama_admin }}</td>
                                    </tr>
                                @elseif ($data['dosen'])
                                    <tr>
                                        <th>Email</th>
                                        <td>{{ $data['dosen']->email }}</td>
                                    </tr>
                                    <tr>
                                        <th>No Telepon</th>
                                        <td>{{ $data['dosen']->no_telepon }}</td>
                                    </tr>
                                    <tr>
                                        <th>Nama Dosen</th>
                                        <td>{{ $data['dosen']->nama_dosen }}</td>
                                    </tr>
                                @elseif ($data['tendik'])
                                    <tr>
                                        <th>Email</th>
                                        <td>{{ $data['tendik']->email }}</td>
                                    </tr>
                                    <tr>
                                        <th>No Telepon</th>
                                        <td>{{ $data['tendik']->no_telepon }}</td>
                                    </tr>
                                    <tr>
                                        <th>Nama Tendik</th>
                                        <td>{{ $data['tendik']->nama_tendik }}</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>

                    <!-- Edit Profile Button -->
                    <div class="text-center mt-4">
                        <button onclick="modalAction('{{ url('/profile/' . session('id_user') . '/edit_ajax') }}')" class="btn btn-primary profile-button">Edit Profile</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('css')
    <style>
        .profile-button {
            width: 200px;
            border-radius: 50px;
        }
        .table th, .table td {
            padding: 12px;
            text-align: left;
        }
        .table th {
            background-color: #f7f7f7;
        }
    </style>
@endpush

@push('js')
    <script>
        function modalAction(url = '') {
            $('#myModal').load(url, function() {
                $('#myModal').modal('show');
            });
        }

        $(document).ready(function() {
            $('#profile').on('change', function() {
                profile.ajax.reload();
            });

            // AJAX for updating profile
            $('#form-edit').submit(function(e) {
                e.preventDefault(); // prevent form from normal submit
                var form = $(this);
                var url = form.attr('action'); // get form action
                var formData = new FormData(form[0]); // get form data
                $.ajax({
                    url: url,
                    type: 'POST',
                    data: formData,
                    processData: false, // disable jQuery's automatic data processing
                    contentType: false, // disable jQuery's automatic content type
                    success: function(response) {
                        if (response.status) {
                            // Update profile data
                            $('#profile-username').text(response.data.username);
                            $('#profile-nama').text(response.data.nama);
                            $('#profile-level').text(response.data.level_nama);
                            $('#profile-id').text(response.data.id_user);
                            $('#profile-image').attr('src', response.data.foto);

                            // Update bidkom
                            if (response.data.bidkom) {
                                $('#profile-bidkom').text(response.data.bidkom);
                            }

                            $('#myModal').modal('hide');
                            Swal.fire({
                                icon: 'success',
                                title: 'Success',
                                text: response.message
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: response.message
                            });
                        }
                    }
                });
            });
        });
    </script>
@endpush
