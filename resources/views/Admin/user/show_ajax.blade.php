<!-- resources/views/admin/user/show_ajax.blade.php -->

@empty($user)
    <div id="modal-master" class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Terjadi kesalahan!</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <div class="alert alert-danger">
                    <h5><i class="icon fas fa-ban"></i> Terjadi kesalahan!</h5>
                    Data yang Anda cari tidak ditemukan!
                </div>
                <a href="{{ url('/user') }}" class="btn btn-warning">Kembali</a>
            </div>
        </div>
    </div>
@else
    @csrf
    <div id="modal-master" class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Detil Data User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <table class="table table-sm table-bordered table-striped">
                    <tr><th class="text-right col-4">Level Pengguna:</th><td class="col-9">{{ $user->level->level_nama }}</td></tr>
                    <tr><th class="text-right col-4">Username:</th><td class="col-9">{{ $user->username }}</td></tr>

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
            </div>
            <div class="modal-footer">
                <button type="button" data-dismiss="modal" class="btn btn-warning">Tutup</button>
            </div>
        </div>
    </div>
@endempty
