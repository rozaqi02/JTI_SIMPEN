@empty($user)
    <div id="modal-master" class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Kesalahan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <div class="alert alert-danger">
                    <h5><i class="icon fas fa-ban"></i> Kesalahan!</h5>
                    Data yang Anda cari tidak ditemukan!
                </div>
                <a href="{{ url('/user') }}" class="btn btn-warning">Kembali</a>
            </div>
        </div>
    </div>
@else
    <form action="{{ url('/user/' . $user->id_user . '/delete_ajax') }}" method="POST" id="form-delete">
        @csrf
        @method('DELETE')

        <div id="modal-master" class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Konfirmasi Hapus Data</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-warning">
                        <h5><i class="icon fas fa-exclamation-circle"></i> Konfirmasi !!!</h5>
                        Apakah Anda yakin ingin menghapus data di bawah ini?
                    </div>
                    <table class="table table-sm table-bordered table-striped">
                        <tr><th class="text-right col-3">Level Pengguna :</th><td>{{ $user->level->level_nama }}</td></tr>
                        <tr><th class="text-right col-3">Username :</th><td>{{ $user->username }}</td></tr>
                    </table>

                    <!-- Tambahan data berdasarkan level pengguna -->
                    @if ($admin)
                        <table class="table table-sm table-bordered">
                            <tr><th class="text-right col-3">Nama Admin:</th><td>{{ $admin->nama_admin }}</td></tr>
                            <tr><th class="text-right col-3">NIP:</th><td>{{ $admin->nip }}</td></tr>
                            <tr><th class="text-right col-3">Email:</th><td>{{ $admin->email }}</td></tr>
                            <tr><th class="text-right col-3">No Telepon:</th><td>{{ $admin->no_telepon }}</td></tr>
                        </table>
                    @elseif ($dosen)
                        <table class="table table-sm table-bordered">
                            <tr><th class="text-right col-3">Nama Dosen:</th><td>{{ $dosen->nama_dosen }}</td></tr>
                            <tr><th class="text-right col-3">NIP:</th><td>{{ $dosen->nip }}</td></tr>
                            <tr><th class="text-right col-3">Email:</th><td>{{ $dosen->email }}</td></tr>
                            <tr><th class="text-right col-3">No Telepon:</th><td>{{ $dosen->no_telepon }}</td></tr>
                        </table>
                    @elseif ($tendik)
                        <table class="table table-sm table-bordered">
                            <tr><th class="text-right col-3">Nama Tendik:</th><td>{{ $tendik->nama_tendik }}</td></tr>
                            <tr><th class="text-right col-3">NIP:</th><td>{{ $tendik->nip }}</td></tr>
                            <tr><th class="text-right col-3">Email:</th><td>{{ $tendik->email }}</td></tr>
                            <tr><th class="text-right col-3">No Telepon:</th><td>{{ $tendik->no_telepon }}</td></tr>
                        </table>
                    @elseif ($mahasiswa)
                        <table class="table table-sm table-bordered">
                            <tr><th class="text-right col-3">Nama Mahasiswa:</th><td>{{ $mahasiswa->nama_mahasiswa }}</td></tr>
                            <tr><th class="text-right col-3">NIM:</th><td>{{ $mahasiswa->nim }}</td></tr>
                            <tr><th class="text-right col-3">Email:</th><td>{{ $mahasiswa->email }}</td></tr>
                            <tr><th class="text-right col-3">Program Studi:</th><td>{{ $mahasiswa->program_studi }}</td></tr>
                            <tr><th class="text-right col-3">Tahun Masuk:</th><td>{{ $mahasiswa->tahun_masuk }}</td></tr>
                        </table>
                    @else
                        <div class="text-center">Data tambahan tidak ditemukan.</div>
                    @endif
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-danger">Ya, Hapus</button>
                </div>
            </div>
        </div>
    </form>
@endempty
