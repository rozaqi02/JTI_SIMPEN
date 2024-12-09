@empty($user)
    <div id="modal-master" class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Kesalahan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
                <div class="modal-body">
                    <div class="alert alert-danger">
                        <h5><i class="icon fas fa-ban"></i> Kesalahan!!!</h5>
                        Data yang anda cari tidak ditemukan
                    </div>
                    <a href="{{ url('/profile') }}" class="btn btn-warning">Kembali</a>
                </div>
            </div>
        </div>
    </div>
@else
    <form action="{{ url('/profile/' . session('id_user') . '/update_ajax') }}" method="POST" id="form-edit"
        enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div id="modal-master" class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Profile Anda</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <!-- Level Pengguna -->
                    <div class="form-group">
                        <label>Level Pengguna</label>
                        <select name="level_id" id="level_id" class="form-control" required>
                            <option value="">- Pilih Level -</option>
                            @foreach ($level as $l)
                                <option {{ $l->level_id == $user->level_id ? 'selected' : '' }}
                                    value="{{ $l->level_id }}">{{ $l->level_nama }}</option>
                            @endforeach
                        </select>
                        <small id="error-level_id" class="error-text form-text text-danger"></small>
                    </div>

                    <!-- Username -->
                    <div class="form-group">
                        <label>Username</label>
                        <input value="{{ $user->username }}" type="text" name="username" id="username"
                            class="form-control" required>
                        <small id="error-username" class="error-text form-text text-danger"></small>
                    </div>

                    <!-- Nama Berdasarkan Role -->
                    <div class="form-group">
                        <label>Nama</label>
                        @if ($user->level_id == 1) <!-- Admin -->
                            <input value="{{ $admin->nama_admin ?? '' }}" type="text" name="nama_admin" id="nama_admin"
                                class="form-control" required>
                        @elseif ($user->level_id == 2) <!-- Dosen -->
                            <input value="{{ $dosen->nama_dosen ?? '' }}" type="text" name="nama_dosen" id="nama_dosen"
                                class="form-control" required>
                        @elseif ($user->level_id == 3) <!-- Tendik -->
                            <input value="{{ $tendik->nama_tendik ?? '' }}" type="text" name="nama_tendik" id="nama_tendik"
                                class="form-control" required>
                        @elseif ($user->level_id == 4) <!-- Mahasiswa -->
                            <input value="{{ $mahasiswa->nama_mahasiswa ?? '' }}" type="text" name="nama_mahasiswa" id="nama_mahasiswa"
                                class="form-control" required>
                        @endif
                        <small id="error-nama" class="error-text form-text text-danger"></small>
                    </div>

                    <!-- Email -->
                    <div class="form-group">
                        <label>Email</label>
                        @if ($user->level_id == 1) <!-- Admin -->
                            <input value="{{ $admin->email ?? '' }}" type="email" name="email" id="email" class="form-control">
                        @elseif ($user->level_id == 2) <!-- Dosen -->
                            <input value="{{ $dosen->email ?? '' }}" type="email" name="email" id="email" class="form-control">
                        @elseif ($user->level_id == 3) <!-- Tendik -->
                            <input value="{{ $tendik->email ?? '' }}" type="email" name="email" id="email" class="form-control">
                        @elseif ($user->level_id == 4) <!-- Mahasiswa -->
                            <input value="{{ $mahasiswa->email ?? '' }}" type="email" name="email" id="email" class="form-control">
                        @endif
                        <small id="error-email" class="error-text form-text text-danger"></small>
                    </div>

                    <!-- No Telepon -->
                    <div class="form-group">
                        <label>No Telepon</label>
                        @if ($user->level_id == 1) <!-- Admin -->
                            <input value="{{ $admin->no_telepon ?? '' }}" type="text" name="no_telepon" id="no_telepon" class="form-control">
                        @elseif ($user->level_id == 2) <!-- Dosen -->
                            <input value="{{ $dosen->no_telepon ?? '' }}" type="text" name="no_telepon" id="no_telepon" class="form-control">
                        @elseif ($user->level_id == 3) <!-- Tendik -->
                            <input value="{{ $tendik->no_telepon ?? '' }}" type="text" name="no_telepon" id="no_telepon" class="form-control">
                        @elseif ($user->level_id == 4) <!-- Mahasiswa -->
                            <input value="{{ $mahasiswa->no_telepon ?? '' }}" type="text" name="no_telepon" id="no_telepon" class="form-control">
                        @endif
                        <small id="error-no_telepon" class="error-text form-text text-danger"></small>
                    </div>

                    <!-- Program Studi (Hanya untuk Mahasiswa) -->
                    @if ($user->level_id == 4) <!-- Mahasiswa -->
                        <div class="form-group">
                            <label>Program Studi</label>
                            <input value="{{ $mahasiswa->program_studi ?? '' }}" type="text" name="program_studi" id="program_studi" class="form-control">
                            <small id="error-program_studi" class="error-text form-text text-danger"></small>
                        </div>
                    @endif

                    <!-- Tahun Masuk (Hanya untuk Mahasiswa) -->
                    @if ($user->level_id == 4) <!-- Mahasiswa -->
                        <div class="form-group">
                            <label>Tahun Masuk</label>
                            <input value="{{ $mahasiswa->tahun_masuk ?? '' }}" type="number" name="tahun_masuk" id="tahun_masuk" class="form-control">
                            <small id="error-tahun_masuk" class="error-text form-text text-danger"></small>
                        </div>
                    @endif

                    <!-- Input Password -->
                    <div class="form-group">
                        <label>Password</label>
                        <input value="" type="password" name="password" id="password" class="form-control">
                        <small class="form-text text-muted">Abaikan jika tidak ingin ubah
                            password</small>
                        <small id="error-password" class="error-text form-text text-danger"></small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" data-dismiss="modal" class="btn btn-warning">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </div>
        </div>
    </form>
    <script>
        $(document).ready(function() {
            $("#form-edit").validate({
                rules: {
                    level_id: {
                        required: true,
                        number: true
                    },
                    username: {
                        required: true,
                        minlength: 3,
                        maxlength: 20
                    },
                    nama: {
                        required: true,
                        minlength: 3,
                        maxlength: 100
                    },
                    password: {
                        minlength: 6,
                        maxlength: 20
                    },
                },
                submitHandler: function(form) {
                    var formData = new FormData(form);
                    $.ajax({
                        url: form.action,
                        type: form.method,
                        data: formData,
                        processData: false,
                        contentType: false,
                        success: function(response) {
                            if (response.status) {
                                $('#myModal').modal('hide');
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Berhasil',
                                    text: response.message
                                });
                                profile.ajax.reload();
                            } else {
                                $('.error-text').text('');
                                $.each(response.msgField, function(prefix, val) {
                                    $('#error-' + prefix).text(val[0]);
                                });
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Terjadi Kesalahan',
                                    text: response.message
                                });
                            }
                        }
                    });
                    return false;
                },
                errorElement: 'span',
                errorPlacement: function(error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                },
                highlight: function(element, errorClass, validClass) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function(element, errorClass, validClass) {
                    $(element).removeClass('is-invalid');
                }
            });
        });
    </script>
@endempty
