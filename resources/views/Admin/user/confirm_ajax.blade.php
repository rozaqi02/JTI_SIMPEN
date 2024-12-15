@empty($user)
    <div id="modal-master" class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Kesalahan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <div class="alert alert-danger">
                    <h5><i class="icon fas fa-ban"></i> Kesalahan!!!</h5>
                    Data yang anda cari tidak ditemukan
                </div>
                <a href="{{ url('/user') }}" class="btn btn-warning">Kembali</a>
            </div>
        </div>
    </div>
@else
    <!-- Form Konfirmasi Penghapusan -->
    <form action="{{ url('/user/' . $user->id_user . '/delete_ajax') }}" method="POST" id="form-delete">
        @csrf
        @method('DELETE')

        <div id="modal-master" class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Hapus Data User</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-warning">
                        <h5><i class="icon fas fa-exclamation-circle"></i> Konfirmasi !!!</h5>
                        Apakah Anda ingin menghapus data seperti di bawah ini?
                    </div>
                    <table class="table table-sm table-bordered table-striped">
                        <tr><th class="text-right col-3">Level Pengguna :</th><td class="col-9">{{ $user->level->level_nama }}</td></tr>
                        <tr><th class="text-right col-3">Username :</th><td class="col-9">{{ $user->username }}</td></tr>
                        <tr><th class="text-right col-3">Nama :</th><td class="col-9">{{ $user->nama }}</td></tr>
                    </table>

                    <!-- Tambahkan kode ini untuk menampilkan data tambahan -->
                    <table class="table table-sm table-bordered table-striped">
                        @if ($admin)
                            <tr><th class="text-right col-4">Nama Admin:</th><td class="col-9">{{ $admin->nama_admin }}</td></tr>
                            <tr><th class="text-right col-4">NIP:</th><td class="col-9">{{ $admin->nip }}</td></tr>
                            <tr><th class="text-right col-4">Email:</th><td class="col-9">{{ $admin->email }}</td></tr>
                            <tr><th class="text-right col-4">No Telepon:</th><td class="col-9">{{ $admin->no_telepon }}</td></tr>
                        @elseif ($dosen)
                            <tr><th class="text-right col-4">Nama Dosen:</th><td class="col-9">{{ $dosen->nama_dosen }}</td></tr>
                            <tr><th class="text-right col-4">NIP:</th><td class="col-9">{{ $dosen->nip }}</td></tr>
                            <tr><th class="text-right col-4">Email:</th><td class="col-9">{{ $dosen->email }}</td></tr>
                            <tr><th class="text-right col-4">No Telepon:</th><td class="col-9">{{ $dosen->no_telepon }}</td></tr>
                        @elseif ($tendik)
                            <tr><th class="text-right col-4">Nama Tendik:</th><td class="col-9">{{ $tendik->nama_tendik }}</td></tr>
                            <tr><th class="text-right col-4">NIP:</th><td class="col-9">{{ $tendik->nip }}</td></tr>
                            <tr><th class="text-right col-4">Email:</th><td class="col-9">{{ $tendik->email }}</td></tr>
                            <tr><th class="text-right col-4">No Telepon:</th><td class="col-9">{{ $tendik->no_telepon }}</td></tr>
                        @elseif ($mahasiswa)
                            <tr><th class="text-right col-4">Nama Mahasiswa:</th><td class="col-9">{{ $mahasiswa->nama_mahasiswa }}</td></tr>
                            <tr><th class="text-right col-4">NIM:</th><td class="col-9">{{ $mahasiswa->nim }}</td></tr>
                            <tr><th class="text-right col-4">Email:</th><td class="col-9">{{ $mahasiswa->email }}</td></tr>
                            <tr><th class="text-right col-4">Program Studi:</th><td class="col-9">{{ $mahasiswa->program_studi }}</td></tr>
                            <tr><th class="text-right col-4">Tahun Masuk:</th><td class="col-9">{{ $mahasiswa->tahun_masuk }}</td></tr>
                        @else
                            <tr><td colspan="2" class="text-center">Data tambahan tidak ditemukan.</td></tr>
                        @endif
                    </table>
                    <!-- Akhir dari kode tambahan -->
                </div>
                <div class="modal-footer">
                    <button type="button" data-dismiss="modal" class="btn btn-warning">Batal</button>
                    <button type="submit" class="btn btn-danger">Ya, Hapus</button>
                </div>
            </div>
        </div>
    </form>

    <script>
        $(document).ready(function() {
            $("#form-delete").validate({
                rules: {},  // Bisa ditambahkan aturan validasi jika diperlukan
                submitHandler: function(form) {
                    $.ajax({
                        url: form.action,
                        type: form.method,
                        data: $(form).serialize(),
                        success: function(response) {
                            if(response.status) {
                                $('#modal-master').modal('hide');  // Menutup modal setelah berhasil
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Berhasil',
                                    text: response.message
                                });
                                // Mengambil DataTable dan me-refresh
                                $('#data-table').DataTable().ajax.reload();
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
                        },
                        error: function(xhr, status, error) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Terjadi Kesalahan',
                                text: 'Gagal menghubungi server.'
                            });
                        }
                    });
                    return false;  // Mencegah form submit biasa
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
@endempty
