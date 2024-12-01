<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login Pengguna</title>
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
        body, html {
            height: 100%;
            margin: 0;
            font-family: 'Source Sans Pro', sans-serif;
            background-image: url('{{ asset('adminlte/dist/img/landingpages.png') }}');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .login-box {
            width: 100%;
            max-width: 550px;
            background-color: rgb(255, 255, 255);
            border-radius: 35px;
            padding: 1.9rem;
            box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.649);
        }

        .login-box img {
            display: block;
            margin: 0 auto 15px;
            width: 135px;
        }

        .login-box h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        .btn-primary {
            background-color: #f99d1c;
            border-radius: 13px;
            font-size: 16px;
            font-weight: bold;
        }

        .btn-primary:hover {
            background-color: #f99d1c;
        }

        .form-control {
            border-radius: 30px;
            padding: 10px 20px;
        }

        .input-group-text {
            border-radius: 30px;
            background-color: #f99d1c;
            border: none;
            color: #fff;
        }

        .footer-text {
            font-size: 0.85rem;
            text-align: center;
            margin-top: 15px;
        }

        .footer-text a {
            color: #7f4f0b;
            text-decoration: none;
        }
    </style>
</head>
    
<body>
    <div class="login-box">
        <img src="{{ asset('adminlte/dist/img/LOGO-JTI.png') }}" alt="Logo JTI">
        <h2>Silakan masuk untuk memulai sesi Anda</h2>
        <form action="{{ url('/login') }}" method="POST" id="login-form">
            @csrf
            <div class="form-group">
                <label for="username">Nama Pengguna</label>
                <input type="text" class="form-control" id="username" name="username" value="{{ old('username') }}" required>
                <small id="error-username" class="error-text form-text text-danger"></small>
            </div>
            <div class="form-group">
                <label for="password">Kata Sandi</label>
                <input type="password" class="form-control" id="password" name="password" required>
                <small id="error-password" class="error-text form-text text-danger"></small>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-block">MASUK</button>
            </div>
        </form>
            
        <p class="footer-text mt-3">
            <a href="#">Butuh Bantuan?</a> | <a href="{{ url('register') }}">Belum Punya Akun?</a>
        </p>
        <p class="footer-text">&copy; 2024 <a href="#">Coding Koala</a> - Politeknik Negeri Malang. All rights reserved.</p>
    </div>

    <!-- jQuery -->
    <script src="{{ asset('adminlte/plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- jquery-validation -->
    <script src="{{ asset('adminlte/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('adminlte/plugins/jquery-validation/additional-methods.min.js') }}"></script>
    <!-- SweetAlert2 -->
    <script src="{{ asset('adminlte/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('adminlte/dist/js/adminlte.min.js') }}"></script>

    <script>
        $(document).ready(function () {
            $('#loginForm').submit(function (event) {
                event.preventDefault();
                
                var email = $('#email').val();
                var password = $('#password').val();
    
                $.ajax({
                    url: "{{ route('login') }}",
                    method: 'POST',
                    data: {
                        email: email,
                        password: password,
                        _token: "{{ csrf_token() }}",
                    },
                    success: function (response) {
                        if(response.success) {
                            window.location.href = response.redirect_url; // Arahkan ke halaman utama setelah login berhasil
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Login Gagal',
                                text: response.message,
                            });
                        }
                    },
                    error: function (xhr, status, error) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Terjadi Kesalahan',
                            text: 'Tidak dapat memproses permintaan. Silakan coba lagi.',
                        });
                    }
                });
            });
        });
    </script>
    
</body>
</html>
