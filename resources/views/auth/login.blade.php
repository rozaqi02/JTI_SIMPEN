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
        <form action="{{ url('login') }}" method="POST" id="form-login">
            @csrf
            <div class="input-group mb-3">
                <input type="text" id="username" name="username" class="form-control" placeholder="Nama Pengguna" required>
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-user"></span>
                    </div>
                </div>
                <small id="error-username" class="error-text text-danger"></small>
            </div>
            <div class="input-group mb-3">
                <input type="password" id="password" name="password" class="form-control" placeholder="Kata Sandi" required>
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-lock"></span>
                    </div>
                </div>
                <small id="error-password" class="error-text text-danger"></small>
            </div>
            <button type="submit" class="btn btn-primary btn-block">Masuk</button>
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
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $(document).ready(function() {
            $("#form-login").validate({
                rules: {
                    username: {
                        required: true,
                        minlength: 2,
                        maxlength: 20
                    },
                    password: {
                        required: true,
                        minlength: 5,
                        maxlength: 20
                    }
                },
                submitHandler: function(form) { // ketika valid, maka bagian yg akan dijalankan
                    $.ajax({
                        url: form.action,
                        type: form.method,
                        data: $(form).serialize(),
                        success: function(response) {
                            if (response.status) { // jika sukses
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Berhasil',
                                    text: response.message,
                                }).then(function() {
                                    window.location = response.redirect;
                                });
                            } else { // jika error
                                $('.error-text').text('');
                                $.each(response.msgField, function(prefix, val) {
                                    $('#error-' + prefix).text(val[0]);
                                });
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Terjadi Kesalahan',
                                    text: response.message
                                });
                            }
                        }
                    });
                    return false;
                },
                errorElement: 'span',
                errorPlacement: function(error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.input-group').append(error);
                },
                highlight: function(element, errorClass, validClass) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function(element, errorClass, validClass) {
                    $(element).removeClass('is-invalid');
                }
            });
        });
    </script>
</body>

</html>
