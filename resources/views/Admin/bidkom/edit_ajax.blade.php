<form action="{{ url('/bidkom/update_ajax/'.$bidkom->id_bidkom) }}" method="POST" id="form-edit">
    @csrf
    @method('PUT') <!-- Metode PUT untuk update data -->
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Data Bidang Kompetensi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="kode_bidkom">Kode Bidang Kompetensi</label>
                    <input type="text" name="kode_bidkom" id="kode_bidkom" class="form-control" value="{{ old('kode_bidkom', $bidkom->kode_bidkom) }}" required>
                    <small id="error-kode_bidkom" class="error-text form-text text-danger"></small>
                </div>
                <div class="form-group">
                    <label for="nama_bidkom">Nama Bidang Kompetensi</label>
                    <input type="text" name="nama_bidkom" id="nama_bidkom" class="form-control" value="{{ old('nama_bidkom', $bidkom->nama_bidkom) }}" required>
                    <small id="error-nama_bidkom" class="error-text form-text text-danger"></small>
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
        // Menggunakan jQuery Validate untuk validasi form
        $("#form-edit").validate({
            rules: {
                kode_bidkom: { required: true, maxlength: 255 },
                nama_bidkom: { required: true, maxlength: 255 }
            },
            submitHandler: function(form) {
                // Cek apakah tombol submit tidak dalam kondisi disabled
                console.log('Form Submitted');
                $.ajax({
                    url: form.action,
                    type: form.method,
                    data: $(form).serialize(),
                    success: function(response) {
                        if(response.status) {
                            $('#myModal').modal('hide');
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil',
                                text: response.message
                            });
                            $('#bidkom-table').DataTable().ajax.reload();
                        } else {
                            // Jika ada error, tampilkan pesan kesalahan
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
                return false;  // Mencegah form reload
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
