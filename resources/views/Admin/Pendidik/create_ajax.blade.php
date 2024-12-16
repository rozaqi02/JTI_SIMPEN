<form action="{{ url('/Pendidik/store_ajax') }}" method="POST" id="form-tambah-tugas">
    @csrf
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="fas fa-plus-circle"></i> Tambah Tugas Baru
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Jenis Kompen -->
                <div class="form-group">
                    <label for="id_jenis_kompen" class="form-label">Jenis Kompen</label>
                    <select class="form-control form-select" id="id_jenis_kompen" name="id_jenis_kompen" required>
                        <option value="" selected disabled>Pilih Jenis Kompen</option>
                        @foreach ($jenisKompen as $kompen)
                            <option value="{{ $kompen->id_jenis_kompen }}">{{ $kompen->nama_jenis_kompen }}</option>
                        @endforeach
                    </select>
                    <small id="error-id_jenis_kompen" class="error-text form-text text-danger"></small>
                </div>

                <!-- Nama Tugas -->
                <div class="form-group">
                    <label for="nama_tugas" class="form-label">Nama Tugas</label>
                    <input type="text" name="nama_tugas" id="nama_tugas" class="form-control" placeholder="Masukkan nama tugas" required>
                    <small id="error-nama_tugas" class="error-text form-text text-danger"></small>
                </div>

                <!-- Deskripsi Tugas -->
                <div class="form-group">
                    <label for="deskripsi_tugas" class="form-label">Deskripsi Tugas</label>
                    <textarea name="deskripsi_tugas" id="deskripsi_tugas" class="form-control" rows="3" placeholder="Masukkan deskripsi tugas" required></textarea>
                    <small id="error-deskripsi_tugas" class="error-text form-text text-danger"></small>
                </div>

                <!-- Kuota -->
                <div class="form-group">
                    <label for="kuota" class="form-label">Kuota</label>
                    <input type="number" name="kuota" id="kuota" class="form-control" min="1" placeholder="Masukkan kuota" required>
                    <small id="error-kuota" class="error-text form-text text-danger"></small>
                </div>

                <!-- Nilai Kompen -->
                <div class="form-group">
                    <label for="nilai_kompen" class="form-label">Nilai Kompen</label>
                    <input type="number" name="nilai_kompen" id="nilai_kompen" class="form-control" min="0" placeholder="Masukkan nilai kompen" required>
                    <small id="error-nilai_kompen" class="error-text form-text text-danger"></small>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" data-dismiss="modal" class="btn btn-warning">
                    <i class="fas fa-times"></i> Batal
                </button>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Simpan
                </button>
            </div>
        </div>
    </div>
</form>

<script>
    $(document).ready(function() {
        // Form validation dan ajax submit
        $("#form-tambah-tugas").validate({
            rules: {
                id_jenis_kompen: { required: true },
                nama_tugas: { required: true, maxlength: 255 },
                deskripsi_tugas: { required: true, maxlength: 1000 },
                kuota: { required: true, min: 1 },
                nilai_kompen: { required: true, min: 0 }
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
                            $('#table_tugas_pendidik').DataTable().ajax.reload();
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
