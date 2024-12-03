<!-- resources/views/dosen_tendik/sidebar.blade.php -->
<ul>
    <li><a href="{{ route('dosen_tendik.dashboard') }}">Dashboard</a></li>
    <li><a href="{{ route('dosen_tendik.penugasanku') }}">Penugasanku</a>
        <ul>
            <li><a href="{{ route('dosen_tendik.daftar_tugas') }}">Daftar Tugas</a></li>
            <li><a href="{{ route('dosen_tendik.riwayat_tugas') }}">Riwayat Tugas</a></li>
        </ul>
    </li>
    <li><a href="{{ route('dosen_tendik.info_mahasiswa') }}">Info Mahasiswa</a></li>
</ul>
