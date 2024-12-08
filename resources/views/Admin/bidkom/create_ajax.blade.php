<!-- resources/views/admin/bidkom/create_ajax.blade.php -->
<form action="{{ url('/bidkom/store_ajax') }}" method="POST" id="form-tambah">
    @csrf
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Bidang Kompetensi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="kode_bidkom">Kode Bidkom</label>
                    <input type="text" name="kode_bidkom" id="kode_bidkom" class="form-control" required>
                    <small id="error-kode_bidkom" class="error-text form-text text-danger"></small>
                </div>
                <div class="form-group">
                    <label for="nama_bidkom">Nama Bidkom</label>
                    <input type="text" name="nama_bidkom" id="nama_bidkom" class="form-control" required>
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
        // Form validation dan ajax submit
        $("#form-tambah").validate({
            rules: {
                kode_bidkom: { required: true, maxlength: 255 },
                nama_bidkom: { required: true, maxlength: 255 }
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
                            // Refresh tabel (misalnya menggunakan dataBidkom) 
                            dataBidkom.ajax.reload();
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
