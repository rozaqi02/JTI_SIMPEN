<div class="sidebar">
    <!-- SidebarSearch Form -->
    <div class="form-inline mt-2">
        <div class="input-group" data-widget="sidebar-search">
            <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
            <div class="input-group-append">
                <button class="btn btn-sidebar">
                    <i class="fas fa-search fa-fw"></i>
                </button>
            </div>
        </div>
    </div>

    <!-- Sidebar Menu-->
    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            
            <!-- Dashboard Menu -->
            <li class="nav-item">
                <a href="{{ url('/') }}" class="nav-link {{ $activeMenu == 'dashboard' ? 'active' : '' }}">
                    <i class="nav-icon fas fa-tachometer-alt"></i>
                    <p>Dashboard</p>
                </a>
            </li>

            <!-- Profile Menu -->
            <li class="nav-item">
                <a href="{{ url('/profile') }}" class="nav-link {{ $activeMenu == 'profile' ? 'active' : '' }}">
                    <i class="nav-icon far fa-address-card"></i>
                    <p>Profile</p>
                </a>
            </li>

            <!-- Menu untuk Mahasiswa -->
            @if(auth()->user()->level_id == '4')
                <li class="nav-header">Tugasku</li>
                <li class="nav-item {{ $activeMenu == 'tugasku' ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ $activeMenu == 'tugasku' ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tasks"></i>
                        <p>Tugasku <i class="right fas fa-angle-left"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ url('/daftar-tugas') }}" class="nav-link {{ $activeMenu == 'daftar-tugas' ? 'active' : '' }}">
                                <i class="nav-icon fas fa-list-alt"></i>
                                <p>Daftar Tugas</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('/progress-tugas') }}" class="nav-link {{ $activeMenu == 'progress-tugas' ? 'active' : '' }}">
                                <i class="nav-icon fas fa-cogs"></i>
                                <p>Progress Tugas</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('/riwayat-tugas') }}" class="nav-link {{ $activeMenu == 'riwayat-tugas' ? 'active' : '' }}">
                                <i class="nav-icon fas fa-history"></i>
                                <p>Riwayat Tugas</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="{{ url('/alpa') }}" class="nav-link {{ $activeMenu == 'alpa' ? 'active' : '' }}">
                        <i class="nav-icon fas fa-clock"></i>
                        <p>Alpaku</p>
                    </a>
                </li>
            @endif

            <!-- Menu untuk Dosen dan Tendik -->
            @if(auth()->user()->level_id == '2' || auth()->user()->level_id == '3')
                <li class="nav-header">Penugasanku</li>
                <li class="nav-item {{ $activeMenu == 'penugasanku' ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ $activeMenu == 'penugasanku' ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tasks"></i>
                        <p>Penugasanku <i class="right fas fa-angle-left"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ url('/daftar-tugas') }}" class="nav-link {{ $activeMenu == 'daftar-tugas' ? 'active' : '' }}">
                                <i class="nav-icon fas fa-list-alt"></i>
                                <p>Daftar Tugas</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('/riwayat-tugas') }}" class="nav-link {{ $activeMenu == 'riwayat-tugas' ? 'active' : '' }}">
                                <i class="nav-icon fas fa-history"></i>
                                <p>Riwayat Tugas</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="{{ url('/info-mahasiswa') }}" class="nav-link {{ $activeMenu == 'info-mahasiswa' ? 'active' : '' }}">
                        <i class="nav-icon fas fa-graduation-cap"></i>
                        <p>Info Mahasiswa</p>
                    </a>
                </li>
            @endif

            <!-- Menu untuk Admin -->
            @if(auth()->user()->level_id == '1')
                <li class="nav-header">Manajemen</li>
                <li class="nav-item {{ $activeMenu == 'manajemen' ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ $activeMenu == 'manajemen' ? 'active' : '' }}">
                        <i class="nav-icon fas fa-users"></i>
                        <p>Manajemen <i class="right fas fa-angle-left"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ url('/user') }}" class="nav-link {{ $activeMenu == 'data-pengguna' ? 'active' : '' }}">
                                <i class="nav-icon fas fa-layer-group"></i>
                                <p>Data Pengguna</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('/kompetensi') }}" class="nav-link {{ $activeMenu == 'kompetensi' ? 'active' : '' }}">
                                <i class="nav-icon fas fa-cogs"></i>
                                <p>Data Bidang Kompetensi</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('/jenis-kompen') }}" class="nav-link {{ $activeMenu == 'jenis-kompen' ? 'active' : '' }}">
                                <i class="nav-icon fas fa-cogs"></i>
                                <p>Data Jenis Kompen</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('/tugas') }}" class="nav-link {{ $activeMenu == 'tugas' ? 'active' : '' }}">
                                <i class="nav-icon fas fa-tasks"></i>
                                <p>Data Tugas A, D, T</p>
                            </a>
                        </li>
                    </ul>
                </li>
            @endif

            <!-- Logout Menu -->
            <li class="nav-item">
                <a href="{{ url('logout') }}" class="nav-link"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="nav-icon fas fa-sign-out-alt"></i>
                    <p>Logout</p>
                </a>
                <form id="logout-form" action="{{ url('logout') }}" method="GET" style="display: none;"></form>
            </li>
        </ul>
    </nav>
</div>