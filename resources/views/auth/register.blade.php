<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Menu Registrasi</title>
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('adminlte/dist/css/adminlte.min.css') }}">
    <style>
        .register-box {
            width: 760px;
            margin: 7% auto;
        }
        .card {
            border-radius: 40px;
        }
        .card-header {
            background-color: #fff;
            border-bottom: none;
            border-radius: 40px;
        }
        .card-body {
            padding: 4rem;
        }
        .btn-primary {
            background-color: #ff9800;
            border-color: #ff9800;
        }
        .btn-primary:hover {
            background-color: #e68900;
            border-color: #e68900;
        }
        .login-box-msg {
            margin-bottom: 1rem;
            font-size: 1.2rem;
            font-weight: bold;
        }
        .form-control {
            border-radius: 5px;
        }
        .form-group label {
            font-weight: bold;
        }
        .error-text {
            font-size: 0.875rem;
        }
        .footer-text {
            text-align: center;
            margin-top: 1rem;
            font-size: 0.875rem;
        }
    </style>
</head>
<body class="hold-transition login-page">
<div class="register-box">
    <div class="card">
        <div class="card-header text-center">
            <h1>Menu Registrasi</h1>
        </div>
        <div class="card-body">
            <form action="{{ url('register') }}" method="POST" id="form-tambah">
                @csrf
                <div class="form-group">
                    <label for="level_id">Kategori User</label>
                    <select class="form-control" id="level_id" name="level_id" required>
                        <option value="">Pilih Kategori</option>
                        @foreach($level as $item)
                            <option value="{{ $item->level_id }}">{{ $item->level_nama }}</option>
                        @endforeach
                    </select>
                    <small id="error-level_id" class="error-text form-text text-danger"></small>
                </div>

                <!-- Input for Username and Password, visible after selecting category -->
                <div id="user-details" style="display: none;">
                    <div class="form-group">
                        <label for="username">Nama Pengguna</label>
                        <input type="text" class="form-control" id="username" name="username" required>
                        <small id="error-username" class="error-text form-text text-danger"></small>
                    </div>

                    <div class="form-group">
                        <label for="password">Kata Sandi</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                        <small id="error-password" class="error-text form-text text-danger"></small>
                    </div>
                </div>

                <!-- Dynamic input fields based on user category -->
                <div id="admin-fields" style="display: none;">
                    <div class="form-group">
                        <label for="nip">NIP</label>
                        <input type="text" class="form-control" id="nip" name="nip">
                    </div>
                    <div class="form-group">
                        <label for="email">Email Admin</label>
                        <input type="email" class="form-control" id="email_admin" name="email">
                    </div>
                    <div class="form-group">
                        <label for="nama_admin">Nama Admin</label>
                        <input type="text" class="form-control" id="nama_admin" name="nama_admin">
                    </div>
                </div>

                <div id="dosen-fields" style="display: none;">
                    <div class="form-group">
                        <label for="nip_dosen">NIP</label>
                        <input type="text" class="form-control" id="nip_dosen" name="nip">
                    </div>
                    <div class="form-group">
                        <label for="email_dosen">Email</label>
                        <input type="email" class="form-control" id="email_dosen" name="email">
                    </div>
                    <div class="form-group">
                        <label for="nama_dosen">Nama Dosen</label>
                        <input type="text" class="form-control" id="nama_dosen" name="nama_dosen">
                    </div>
                </div>

                <div id="tendik-fields" style="display: none;">
                    <div class="form-group">
                        <label for="nip_dosen">NIP</label>
                        <input type="text" class="form-control" id="nip_dosen" name="nip">
                    </div>
                    <div class="form-group">
                        <label for="email_dosen">Email</label>
                        <input type="email" class="form-control" id="email_tendik" name="email">
                    </div>
                    <div class="form-group">
                        <label for="nama_dosen">Nama Tendik</label>
                        <input type="text" class="form-control" id="nama_tendik" name="nama_tendik">
                    </div>
                </div>

                <div id="mahasiswa-fields" style="display: none;">
                    <div class="form-group">
                        <label for="nim">NIM</label>
                        <input type="text" class="form-control" id="nim" name="nim">
                    </div>
                    <div class="form-group">
                        <label for="email_mahasiswa">Email</label>
                        <input type="email" class="form-control" id="email_mahasiswa" name="email">
                    </div>
                    <div class="form-group">
                        <label for="nama_mahasiswa">Nama Mahasiswa</label>
                        <input type="text" class="form-control" id="nama_mahasiswa" name="nama_mahasiswa">
                    </div>
                </div>

                <button type="submit" class="btn btn-primary btn-block">Registrasi</button>
            </form>
        </div>
    </div>
</div>

<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    // JavaScript untuk menangani perubahan kategori user
    document.getElementById('level_id').addEventListener('change', function () {
        var selectedLevel = this.value;
        
        // Menyembunyikan semua field
        document.getElementById('user-details').style.display = 'block';
        document.getElementById('admin-fields').style.display = 'none';
        document.getElementById('dosen-fields').style.display = 'none';
        document.getElementById('tendik-fields').style.display = 'none';
        document.getElementById('mahasiswa-fields').style.display = 'none';

        // Menampilkan field yang sesuai dengan kategori
        if (selectedLevel == 1) {  // Admin
            document.getElementById('admin-fields').style.display = 'block';
        } else if (selectedLevel == 2) {  // Dosen
            document.getElementById('dosen-fields').style.display = 'block';
        } else if (selectedLevel == 3) {  // Mahasiswa
            document.getElementById('tendik-fields').style.display = 'block';
        } else if (selectedLevel == 4) {  // Mahasiswa
            document.getElementById('mahasiswa-fields').style.display = 'block';
        }
    });

    // Meng-handle submit form dengan AJAX
    document.getElementById('form-tambah').addEventListener('submit', function (e) {
        e.preventDefault(); // Mencegah reload halaman

        var formData = new FormData(this);

        // AJAX request
        fetch('{{ url("register") }}', {
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.status) {
                Swal.fire({
                    title: 'Registrasi Berhasil!',
                    text: data.message,
                    icon: 'success',
                    confirmButtonText: 'Ok',
                }).then(() => {
                    window.location.href = data.redirect; // Redirect ke halaman login
                });
            } else {
                Swal.fire({
                    title: 'Gagal!',
                    text: data.message,
                    icon: 'error',
                    confirmButtonText: 'Coba Lagi'
                });
            }
        })
        .catch(error => {
            Swal.fire({
                title: 'Error!',
                text: 'Terjadi kesalahan, coba lagi nanti.',
                icon: 'error',
                confirmButtonText: 'Ok'
            });
        });
    });
</script>
</body>
</html>
