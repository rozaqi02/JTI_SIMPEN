<form action="{{ url('/user/store_ajax') }}" method="POST" id="form-tambah">
    @csrf
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Data User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <!-- Level Pengguna -->
                <div class="form-group">
                    <label for="level_id">Level Pengguna</label>
                    <select name="level_id" id="level_id" class="form-control" required>
                        <option value="">- Pilih Level -</option>
                        @foreach($level as $l)
                            <option value="{{ $l->level_id }}">{{ $l->level_nama }}</option>
                        @endforeach
                    </select>
                    <small id="error-level_id" class="error-text form-text text-danger"></small>
                </div>

                <!-- Username -->
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" name="username" id="username" class="form-control" required>
                    <small id="error-username" class="error-text form-text text-danger"></small>
                </div>

                <!-- Password -->
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" class="form-control" required>
                    <small id="error-password" class="error-text form-text text-danger"></small>
                </div>

                <!-- Nama Berdasarkan Role -->
                <div id="nama_field" class="form-group" style="display: none;">
                    <label for="nama">Nama</label>
                    <input type="text" name="nama" id="nama" class="form-control" required>
                    <small id="error-nama" class="error-text form-text text-danger"></small>
                </div>

                <!-- Field untuk Admin -->
                <div id="admin_fields" style="display: none;">
                    <div class="form-group">
                        <label for="nama_admin">Nama Admin</label>
                        <input type="text" name="nama_admin" id="nama_admin" class="form-control">
                        <small id="error-nama_admin" class="error-text form-text text-danger"></small>
                    </div>
                    <div class="form-group">
                        <label for="nip">NIP</label>
                        <input type="text" name="nip" id="nip" class="form-control">
                        <small id="error-nip" class="error-text form-text text-danger"></small>
                    </div>
                </div>

                <!-- Field untuk Dosen -->
                <div id="dosen_fields" style="display: none;">
                    <div class="form-group">
                        <label for="nama_dosen">Nama Dosen</label>
                        <input type="text" name="nama_dosen" id="nama_dosen" class="form-control">
                        <small id="error-nama_dosen" class="error-text form-text text-danger"></small>
                    </div>
                    <div class="form-group">
                        <label for="nip_dosen">NIP Dosen</label>
                        <input type="text" name="nip_dosen" id="nip" class="form-control">
                        <small id="error-nip_dosen" class="error-text form-text text-danger"></small>
                    </div>
                </div>

                <!-- Field untuk Tendik -->
                <div id="tendik_fields" style="display: none;">
                    <div class="form-group">
                        <label for="nama_tendik">Nama Tendik</label>
                        <input type="text" name="nama_tendik" id="nama_tendik" class="form-control">
                        <small id="error-nama_tendik" class="error-text form-text text-danger"></small>
                    </div>
                    <div class="form-group">
                        <label for="nip_tendik">NIP Tendik</label>
                        <input type="text" name="nip_tendik" id="nip_tendik" class="form-control">
                        <small id="error-nip_tendik" class="error-text form-text text-danger"></small>
                    </div>
                </div>

                <!-- Field untuk Mahasiswa -->
                <div id="mahasiswa_fields" style="display: none;">
                    <div class="form-group">
                        <label for="nama_mahasiswa">Nama Mahasiswa</label>
                        <input type="text" name="nama_mahasiswa" id="nama_mahasiswa" class="form-control">
                        <small id="error-nama_mahasiswa" class="error-text form-text text-danger"></small>
                    </div>
                    <div class="form-group">
                        <label for="nim">NIM</label>
                        <input type="text" name="nim" id="nim" class="form-control">
                        <small id="error-nim" class="error-text form-text text-danger"></small>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" data-dismiss="modal" class="btn btn-secondary">Batal</button>
                <button type="submit" class="btn btn-success">Simpan</button>
            </div>
        </div>
    </div>
</form>

<script>
    $(document).ready(function() {
        $("#level_id").change(function() {
            var levelId = $(this).val();

            // Sembunyikan semua field terkait peran
            $("#admin_fields").hide();
            $("#dosen_fields").hide();
            $("#tendik_fields").hide();
            $("#mahasiswa_fields").hide();

            // Sembunyikan nama field umum
            $("#nama_field").hide();

            // Menampilkan field sesuai dengan level
            if (levelId == 1) {  // Admin
                $("#admin_fields").show();
                $("#nama_field").show();
            } else if (levelId == 2) {  // Dosen
                $("#dosen_fields").show();
                $("#nama_field").show();
            } else if (levelId == 3) {  // Tendik
                $("#tendik_fields").show();
                $("#nama_field").show();
            } else if (levelId == 4) {  // Mahasiswa
                $("#mahasiswa_fields").show();
                $("#nama_field").show();
            }
        });

        // Inisialisasi tampilkan field jika level sudah dipilih sebelumnya
        $("#level_id").trigger('change');

        // Validasi form
        $("#form-tambah").validate({
            rules: {
                level_id: { required: true, number: true },
                username: { required: true, minlength: 3, maxlength: 20 },
                password: { required: true, minlength: 5, maxlength: 20 }
            },
            submitHandler: function(form) {
                $.ajax({
                    url: form.action,
                    type: form.method,
                    data: $(form).serialize(),
                    success: function(response) {
                        if(response.status){
                            $('#myModal').modal('hide');
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil',
                                text: response.message
                            });
                            dataUser.ajax.reload();  // Refresh data tabel
                        } else {
                            $('.error-text').text('');
                            $.each(response.msgField, function(prefix, val) {
                                $('#error-'+prefix).text(val[0]);
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
            errorPlacement: function (error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight: function (element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function (element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            }
        });
    });
</script>
