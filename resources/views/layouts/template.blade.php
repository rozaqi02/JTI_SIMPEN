<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'PWL Laravel Starter Code') }}</title>

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Untuk mengirimkan token Laravel CSRF pada setiap request ajax -->

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('adminlte/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
    {{-- Sweet Alert2 --}}
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('adminlte/dist/css/adminlte.min.css') }}">

    <style>
    /* Sidebar styling */
.sidebar-dark-primary {
    background-color: #2d2d2d;
}

/* Gaya menu aktif */
.sidebar-dark-primary .nav-link.active {
    background-color: #e87817 !important;
    color: #ffffff !important;
    border-radius: 8px;
}

/* Hover pada menu */
.sidebar-dark-primary .nav-link:hover {
    background-color: #e87817;
    color: white;
    border-radius: 8px;
    transform: translateX(5px); /* Efek sedikit gerakan ke kanan */
}

/* Gaya default untuk nav-link */
.sidebar-dark-primary .nav-link {
    color: #c2c7d0;
}

/* Brand logo styling */
.brand-link {
    background-color: #2b2b2b;
    text-align: center;
    display: flex; /* Flexbox untuk mengatur logo dan teks */
    align-items: center; /* Pusatkan secara vertikal */
    padding: 10px;
}

/* Logo styling */
#logo-polinema {
    width: auto; /* Lebar otomatis agar proporsional */
    height: 60px; /* Tinggi tetap */
    max-width: 100%; /* Tidak melebihi ukuran gambar asli */
    margin-right: 10px; /* Spasi antara logo dan teks */
    object-fit: contain; /* Pastikan logo tidak terdistorsi */
}

/* Teks branding */
.brand-text {
    font-size: 1.5rem;
    font-weight: bold;
    color: white;
}

/* Highlight teks "SIMPEN" */
.brand-highlight {
    color: #e87817;
    text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.3);
}

/* Small-box styling */
.small-box {
    border-radius: 10px;
    padding: 20px;
    color: #fff;
    position: relative;
    overflow: hidden;
}

.small-box .icon {
    position: absolute;
    top: 15px;
    right: 15px;
    font-size: 60px;
    opacity: 0.5;
}

.small-box-footer {
    display: block;
    text-align: center;
    color: #fff;
    padding: 10px 0;
    background: rgba(0, 0, 0, 0.1);
    text-decoration: none;
    border-radius: 0 0 10px 10px;
}

/* Navbar styling */
.navbar {
    background-color: #ffffff;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

/* Styling table for consistency */
.table {
    border-radius: 8px;
    overflow: hidden;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
}

.table th,
.table td {
    vertical-align: middle;
    text-align: center;
    font-size: 0.9rem;
}

.table thead th {
    background-color: #e87817;
    color: white;
    border: none;
}

/* Styling modal */
.modal-content {
    border-radius: 10px;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
}

.modal-header {
    background-color: #e87817;
    color: white;
    border-bottom: none;
}

.modal-footer .btn {
    border-radius: 5px;
}

/* Custom scrollbar styling */
::-webkit-scrollbar {
    width: 8px;
}

::-webkit-scrollbar-thumb {
    background-color: #e87817;
    border-radius: 10px;
}

::-webkit-scrollbar-thumb:hover {
    background-color: #d56710;
}





    </style>

    @stack('css')
    <!-- Digunakan untuk memanggil custom css dari perintah push('css') pada masing-masing view -->
</head>

<body class="hold-transition sidebar-mini">
    <!-- Site wrapper -->
    <div class="wrapper">
        <!-- Navbar -->
        @include('layouts.header')
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="{{ url('/') }}" class="brand-link">
                <img src="{{ asset('image/polinema.png') }}" alt="Polinema Logo"
                    class="brand-image img-circle elevation-3" id="logo-polinema">
                <span class="brand-text">JTI-<span class="brand-highlight">SIMPEN</span></span>
            </a>
            

            <!-- Sidebar -->
            @include('layouts.sidebar')
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            @include('layouts.breadcrumb')

            <!-- Main content -->
            <section class="content">
                @yield('content')
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
        @include('layouts.footer')
        <!-- ./wrapper -->

        <!-- jQuery -->
        <script src="{{ asset('adminlte/plugins/jquery/jquery.min.js') }}"></script>
        <!-- Bootstrap 4 -->
        <script src="{{ asset('adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
        <!-- DataTables & Plugins -->
        <script src="{{ asset('adminlte/plugins/datatables/jquery.dataTables.min.js') }}"></script>
        <script src="{{ asset('adminlte/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
        <script src="{{ asset('adminlte/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
        <script src="{{ asset('adminlte/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
        <script src="{{ asset('adminlte/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
        <script src="{{ asset('adminlte/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
        <script src="{{ asset('adminlte/plugins/jszip/jszip.min.js') }}"></script>
        <script src="{{ asset('adminlte/plugins/pdfmake/pdfmake.min.js') }}"></script>
        <script src="{{ asset('adminlte/plugins/pdfmake/vfs_fonts.js') }}"></script>
        <script src="{{ asset('adminlte/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
        <script src="{{ asset('adminlte/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
        <script src="{{ asset('adminlte/plugins/datatables-buttons/js/buttons.colvis.min.js') }}"></script>
        <!-- jquery-validation-->
        <script src="{{ asset('adminlte/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
        <script src="{{ asset('adminlte/plugins/jquery-validation/additional-methods.min.js') }}"></script>
        <!-- SweetAlert2 -->
        <script src="{{ asset('adminlte/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
        <!-- AdminLTE App -->
        <script src="{{ asset('adminlte/dist/js/adminlte.min.js') }}"></script>
        <script>
            // Untuk mengirimkan token Laravel CSRF pada setiap request ajax
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            // Animasi Klik pada Sidebar
document.querySelectorAll('.nav-link').forEach(link => {
    link.addEventListener('click', function (e) {
        // Buat animasi lingkaran di sekitar klik
        let ripple = document.createElement('span');
        ripple.className = 'ripple-effect';
        ripple.style.left = `${e.clientX - link.getBoundingClientRect().left}px`;
        ripple.style.top = `${e.clientY - link.getBoundingClientRect().top}px`;
        link.appendChild(ripple);

        // Hapus animasi setelah selesai
        setTimeout(() => ripple.remove(), 600);
    });
});

// Simpan Status Menu yang Dibuka
document.querySelectorAll('.nav-item > a').forEach(link => {
    link.addEventListener('click', function () {
        localStorage.setItem('sidebarMenuOpen', link.parentElement.classList.contains('menu-open') ? '' : link.getAttribute('href'));
    });
});

// Memuat Status Menu Setelah Refresh
document.addEventListener('DOMContentLoaded', function () {
    const menuOpen = localStorage.getItem('sidebarMenuOpen');
    if (menuOpen) {
        document.querySelectorAll('.nav-item').forEach(item => {
            if (item.querySelector(`[href="${menuOpen}"]`)) {
                item.classList.add('menu-open');
                item.querySelector('.nav-link').classList.add('active');
            }
        });
    }
});

        </script>
        
        @stack('js')
        <!-- Digunakan untuk memanggil custom js dari perintah push('js') pada masing-masing view-->
</body>

</html>