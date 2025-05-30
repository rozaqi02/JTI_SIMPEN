<!-- resources/views/admin/tugas-pendidik/create_ajax.blade.php -->
<form action="{{ url('/tugas-pendidik/store_ajax') }}" method="POST" id="form-tambah">
    @csrf
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Tugas Pendidik</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="nama_tugas">Nama Tugas</label>
                    <input type="text" name="nama_tugas" id="nama_tugas" class="form-control" required>
                    <small id="error-nama_tugas" class="error-text form-text text-danger"></small>
                </div>
                <div class="form-group">
                    <label for="deskripsi_tugas">Deskripsi Tugas</label>
                    <textarea name="deskripsi_tugas" id="deskripsi_tugas" class="form-control" required></textarea>
                    <small id="error-deskripsi_tugas" class="error-text form-text text-danger"></small>
                </div>
                <div class="form-group">
                    <label for="kuota">Kuota</label>
                    <input type="number" name="kuota" id="kuota" class="form-control" required min="1">
                    <small id="error-kuota" class="error-text form-text text-danger"></small>
                </div>
                <div class="form-group">
                    <label for="nilai_kompen">Nilai Kompensasi</label>
                    <input type="number" name="nilai_kompen" id="nilai_kompen" class="form-control" required min="0">
                    <small id="error-nilai_kompen" class="error-text form-text text-danger"></small>
                </div>
                <div class="form-group">
                    <label for="user_id">Pendidik</label>
                    <select name="user_id" id="user_id" class="form-control" required>
                        @foreach ($users as $user)
                            <option value="{{ $user->id_user }}">{{ $user->username }}</option>
                        @endforeach
                    </select>
                    <small id="error-user_id" class="error-text form-text text-danger"></small>
                </div>
                <div class="form-group">
                    <label for="jenis_kompen_id">Jenis Kompensasi</label>
                    <select name="jenis_kompen_id" id="jenis_kompen_id" class="form-control" required>
                        @foreach ($jenisKompen as $kompen)
                            <option value="{{ $kompen->id_jenis_kompen }}">{{ $kompen->nama_jenis_kompen }}</option>
                        @endforeach
                    </select>
                    <small id="error-jenis_kompen_id" class="error-text form-text text-danger"></small>
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
        // Form validation dan ajax submit
        $("#form-tambah").validate({
            rules: {
                nama_tugas: { required: true, maxlength: 255 },
                deskripsi_tugas: { required: true, minlength: 5 },
                kuota: { required: true, min: 1 },
                nilai_kompen: { required: true, min: 0 },
                user_id: { required: true },
                jenis_kompen_id: { required: true }
            },
            submitHandler: function(form) {
                $.ajax({
                    url: form.action,  // URL untuk route store_ajax
                    type: form.method,  // Method form yaitu POST
                    data: $(form).serialize(),  // Data form yang akan dikirim
                    success: function(response) {
                        if (response.status) {
                            $('#myModal').modal('hide'); // Menutup modal jika berhasil
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil',
                                text: response.message
                            });
                            // Refresh tabel (misalnya menggunakan dataTugasPendidik)
                            dataTugasPendidik.ajax.reload();
                        } else {
                            // Menampilkan pesan error
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
                    },
                    error: function(xhr, status, error) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Terjadi kesalahan saat menghubungi server.'
                        });
                    }
                });
                return false;  // Mencegah form di-submit secara tradisional
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
