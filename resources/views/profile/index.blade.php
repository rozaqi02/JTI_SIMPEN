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
                        <img class="rounded-circle mb-4 shadow" width="200px" id="profile-image" src="{{ asset($user->foto ?? 'image/default.png') }}" alt="Profile Picture">
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
                                    <th>Level Pengguna</th>
                                    <td id="profile-level">{{ $user->level->level_nama }}</td>
                                </tr>
                                <tr>
                                    <th>Nama Pengguna</th>
                                    <td id="profile-username">{{ $user->username }}</td>
                                </tr>
                                <tr>
                                    <th>Kata Sandi</th>
                                    <td>********</td>
                                </tr>

                                <!-- Displaying role-specific data -->
                                @if ($data['mahasiswa'])
                                    <tr>
                                        <th>Nomor Induk Mahasiswa</th>
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
                                        <th>Bidang Kompetensi</th>
                                        <td>
                                            @if ($data['mahasiswa']->detailBidkom->count() > 0)
                                                <ul class="mb-0">
                                                    @foreach ($data['mahasiswa']->detailBidkom as $bidkomDetail)
                                                        <li>{{ $bidkomDetail->bidkom->nama_bidkom ?? 'Bidang Kompetensi Belum Dipilih   ' }}</li>
                                                    @endforeach
                                                </ul>
                                            @else
                                                <span class="text-muted">Belum memiliki Bidang Kompetensi</span>
                                            @endif
                                        </td>
                                    </tr>
                                @elseif ($data['admin'])
                                    <tr>
                                        <th>Email</th>
                                        <td>{{ $data['admin']->email }}</td>
                                    </tr>
                                    <tr>
                                        <th>Nomor Telepon</th>
                                        <td>{{ $data['admin']->no_telepon }}</td>
                                    </tr>
                                    <tr>
                                        <th>Nama Lengkap Admin</th>
                                        <td>{{ $data['admin']->nama_admin }}</td>
                                    </tr>
                                @elseif ($data['dosen'])
                                    <tr>
                                        <th>Email</th>
                                        <td>{{ $data['dosen']->email }}</td>
                                    </tr>
                                    <tr>
                                        <th>Nomor Telepon</th>
                                        <td>{{ $data['dosen']->no_telepon }}</td>
                                    </tr>
                                    <tr>
                                        <th>Nama Lengkap Dosen</th>
                                        <td>{{ $data['dosen']->nama_dosen }}</td>
                                    </tr>
                                @elseif ($data['tendik'])
                                    <tr>
                                        <th>Email</th>
                                        <td>{{ $data['tendik']->email }}</td>
                                    </tr>
                                    <tr>
                                        <th>Nomor Telepon</th>
                                        <td>{{ $data['tendik']->no_telepon }}</td>
                                    </tr>
                                    <tr>
                                        <th>Nama Lengkap Tendik</th>
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
    </script>
@endpush
