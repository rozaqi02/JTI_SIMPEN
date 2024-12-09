@extends('layouts.template')
@section('content')
    <div id="myModal" class="modal fade animate shake" tabindex="-1" role="dialog" data-backdrop="static"
        data-keyboard="false" data-width="75%" aria-hidden="true"></div>
    <div class="container rounded bg-white border">
        <div class="row" id="profile">
            <div class="col-md-4 border-right">
                <div class="p-3 py-5">
                    <div class="d-flex flex-column align-items-center text-center p-3 ">
                        <img class="rounded mt-3 mb-2" width="250px" id="profile-image" src=" {{ asset($user->foto) }}">
                    </div>
                    <div onclick="modalAction('{{ url('/profile/' . session('id_user') . '/edit_foto') }}')" class="mt-4 text-center">
                        <button class="btn btn-primary profile-button" type="button">Edit Foto</button>
                    </div>
                </div>
            </div>
            <div class="col-md-8 border-right">
                <div class="p-3 py-4">
                    <div class="d-flex align-items-center">
                        <h4 class="text-right">Profile Settings</h4>
                    </div>
                    <div class="row mt-3">
                        <table class="table table-bordered table-striped table-hover table-sm">
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
                                <th>Nama</th>
                                <td id="profile-nama">{{ $user->nama }}</td>
                            </tr>
                            <tr>
                                <th>Password</th>
                                <td>********</td>
                            </tr>

                            <!-- Menampilkan data berdasarkan role -->
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
                        </table>
                    </div>
                    <div class="mt-3 text-center">
                        <button onclick="modalAction('{{ url('/profile/' . session('id_user') . '/edit_ajax') }}')" class="btn btn-primary profile-button">Edit Profile</button>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
            </div>
        </div>
    </div>
@endsection

@push('css')
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

            // AJAX untuk update profile
            $('#form-edit').submit(function(e) {
                e.preventDefault(); // prevent form from normal submit
                var form = $(this);
                var url = form.attr('action'); // ambil action form
                var formData = new FormData(form[0]); // ambil data form
                $.ajax({
                    url: url,
                    type: 'POST',
                    data: formData,
                    processData: false, // disable jQuery's automatic data processing
                    contentType: false, // disable jQuery's automatic content type
                    success: function(response) {
                        if (response.status) {
                            // Update data di halaman profil
                            $('#profile-username').text(response.data.username);
                            $('#profile-nama').text(response.data.nama);
                            $('#profile-level').text(response.data.level_nama);
                            $('#profile-id').text(response.data.id_user);
                            $('#profile-image').attr('src', response.data.foto);

                            $('#myModal').modal('hide');
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil',
                                text: response.message
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Terjadi Kesalahan',
                                text: response.message
                            });
                        }
                    }
                });
            });
        });
    </script>
@endpush
