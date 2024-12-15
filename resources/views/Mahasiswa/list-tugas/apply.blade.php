<div class="card">
    <div class="card-header bg-warning">
        <h3 class="card-title">Detail Tugas</h3>
    </div>
    <div class="card-body">
        <table class="table table-bordered">
            <tr>
                <th>Pemberi Tugas:</th>
                <td>{{ $tugas->user->username ?? 'Tidak Ada' }}</td>
                <th>Kuota:</th>
                <td>{{ $tugas->kuota ?? '-' }}</td>
            </tr>
            <tr>
                <th>Judul Tugas:</th>
                <td>{{ $tugas->nama_tugas ?? 'Tidak Ada' }}</td>
                <th>Kuota Terisi:</th>
                <td>{{ $tugas->nilai_kompen ?? '-' }}</td>
            </tr>
            <tr>
                <th>Jenis Tugas:</th>
                <td>{{ $tugas->jenisKompen->nama_jenis_kompen ?? 'Tidak Ada' }}</td>
                <th>Tanggal Upload:</th>
                <td>{{ $tugas->created_at ?? '-' }}</td>
            </tr>
        </table>

        <hr>
        <h5>Deskripsi Tugas</h5>
        <ul>
            @foreach(explode("\n", $tugas->deskripsi_tugas) as $line)
                <li>{{ $line }}</li>
            @endforeach
        </ul>

        <div class="text-center mt-4">
            <button class="btn btn-danger" id="batalBtn" data-dismiss="modal">Batal</button>
            <button class="btn btn-success" id="ambilBtn" onclick="submitTugas({{ $tugas->id_detail_tugas }})">Ambil Tugas</button>
        </div>
    </div>
</div>
