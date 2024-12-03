<!-- resources/views/admin/sidebar.blade.php -->
<ul>
    <li><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
    <li><a href="{{ route('admin.penugasanku') }}">Penugasanku</a></li>
    <li><a href="{{ route('admin.riwayat_tugas') }}">Riwayat Tugas</a></li>
    <li><a href="{{ route('admin.info_mahasiswa') }}">Info Mahasiswa</a></li>
    <li><a href="{{ route('admin.manajemen') }}">Manajemen</a>
        <ul>
            <li><a href="{{ route('admin.data_pengguna') }}">Data Pengguna</a></li>
            <li><a href="{{ route('admin.data_bidkom') }}">Data Bidkom</a></li>
            <li><a href="{{ route('admin.data_jenis_kompen') }}">Data Jenis Kompen</a></li>
            <li><a href="{{ route('admin.data_tugas') }}">Data Tugas</a></li>
        </ul>
    </li>
</ul>
