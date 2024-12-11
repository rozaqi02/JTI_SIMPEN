<div class="sidebar">
    <!-- Sidebar Search Form -->
    <div class="form-inline mt-3 mb-3 px-3">
        <div class="input-group" data-widget="sidebar-search">
            <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
            <div class="input-group-append">
                <button class="btn btn-sidebar">
                    <i class="fas fa-search fa-fw"></i>
                </button>
            </div>
        </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Dashboard Menu -->
            <li class="nav-item">
                <a href="{{ url('/dashboard') }}" class="nav-link {{ $activeMenu == 'dashboard' ? 'active' : '' }}">
                    <i class="nav-icon fas fa-tachometer-alt text-primary"></i>
                    <p>Dashboard</p>
                </a>
            </li>

            <!-- Profile Menu -->
            @if(auth()->check() && (auth()->user()->level_id == '4' || in_array(auth()->user()->level_id, ['1', '2', '3'])))
                <li class="nav-item">
                    <a href="{{ url('/profile') }}" class="nav-link {{ $activeMenu == 'profile' ? 'active' : '' }}">
                        <i class="nav-icon far fa-address-card text-secondary"></i>
                        <p>Profil</p>
                    </a>
                </li>
            @endif

            <!-- Menu untuk Mahasiswa -->
            @if(auth()->check() && auth()->user()->level_id == '4')
                <li class="nav-item {{ $activeMenu == 'tugasku' ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ $activeMenu == 'tugasku' ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tasks text-success"></i>
                        <p>
                            Tugasku
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ url('list-tugas') }}" class="nav-link {{ $activeMenu == 'list-tugas' ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>List Tugas</p>
                            </a>
                        </li>   
                        <li class="nav-item">
                            <a href="{{ url('/progress-tugas') }}" class="nav-link {{ $activeMenu == 'progress-tugas' ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Progress Tugas</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('/riwayat-tugas') }}" class="nav-link {{ $activeMenu == 'riwayat-tugas' ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Riwayat Tugas</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="{{ url('/alpaku') }}" class="nav-link {{ $activeMenu == 'alpaku' ? 'active' : '' }}">
                        <i class="nav-icon fas fa-clock text-info"></i>
                        <p>Alpaku</p>
                    </a>
                </li>
            @endif

            <!-- Menu untuk Admin -->
            @if(auth()->check() && auth()->user()->level_id == '1')
                <li class="nav-item {{ $activeMenu == 'manajemen' ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ $activeMenu == 'manajemen' ? 'active' : '' }}">
                        <i class="nav-icon fas fa-users text-warning"></i>
                        <p>
                            Manajemen
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ url('/user') }}" class="nav-link {{ $activeMenu == 'data-pengguna' ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Data Pengguna</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('/bidkom') }}" class="nav-link {{ $activeMenu == 'kompetensi' ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Data Bidang Kompetensi</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('/jenis-kompen') }}" class="nav-link {{ $activeMenu == 'jenis-kompen' ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Data Jenis Kompen</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('/daftar-tugas') }}" class="nav-link {{ $activeMenu == 'tugas' ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Data Tugas Pendidik</p>
                            </a>
                        </li>
                    </ul>
                </li>
            @endif

            <!-- Menu untuk Dosen dan Tendik dan Admin -->
            @if(auth()->check() && in_array(auth()->user()->level_id, ['2', '3', '1']))
                <li class="nav-item {{ $activeMenu == 'penugasanku' ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ $activeMenu == 'penugasanku' ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tasks text-primary"></i>
                        <p>
                            Penugasanku
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ url('/input-tugas') }}" class="nav-link {{ $activeMenu == 'daftar-tugas' ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Daftar Tugas</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('/riwayat-tugas') }}" class="nav-link {{ $activeMenu == 'riwayat-tugas' ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Riwayat Tugas</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="{{ url('/info-mahasiswa') }}" class="nav-link {{ $activeMenu == 'info-mahasiswa' ? 'active' : '' }}">
                        <i class="nav-icon fas fa-graduation-cap text-success"></i>
                        <p>Info Mahasiswa</p>
                    </a>
                </li>
            @endif

            <!-- Logout Menu -->
            <li class="nav-item">
                <a href="{{ url('logout') }}" class="nav-link text-danger"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="nav-icon fas fa-sign-out-alt"></i>
                    <p>Logout</p>
                </a>
                <form id="logout-form" action="{{ url('logout') }}" method="GET" style="display: none;">
                    @csrf
                </form>
            </li>
        </ul>
    </nav>
</div>
