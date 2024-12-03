<!-- resources/views/mahasiswa/sidebar.blade.php -->
<ul>
    <li><a href="{{ route('mahasiswa.dashboard') }}">Dashboard</a></li>
    <li><a href="{{ route('mahasiswa.alpa') }}">Alpaku</a></li>
    <li><a href="{{ route('mahasiswa.tugas') }}">Tugasku</a>
        <ul>
            <li><a href="{{ route('mahasiswa.daftar_tugas') }}">Daftar Tugas</a></li>
            <li><a href="{{ route('mahasiswa.progress_tugas') }}">Progress Tugas</a></li>
            <li><a href="{{ route('mahasiswa.riwayat_tugas') }}">Riwayat Tugas</a></li>
        </ul>
    </li>
</ul>
