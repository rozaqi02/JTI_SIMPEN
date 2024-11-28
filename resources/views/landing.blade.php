<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sistem Informasi Kompensasi JTI</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body, html {
            height: 100%;
            margin: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-image: url('{{ asset('adminlte/dist/img/landingpages.png') }}');
            background-size: cover;
            background-position: center;
            position: relative;
            color: white;
        }

        /* Overlay */
        body::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 1;
        }

        .container {
            height: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 2;
            position: relative;
        }

        .card {
            background-color: white;
            border-radius: 15px;
            padding: 40px;
            box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.2);
            text-align: center;
            width: 400px;
        }

        .logo {
            display: block;
            margin: 0 auto 20px;
            width: 80px;
        }

        .card h1 {
            font-size: 1.5rem;
            color: #333;
            margin-bottom: 20px;
        }

        .card .btn {
            background-color: #ff9f43;
            border: none;
            padding: 10px 20px;
            font-size: 1rem;
            border-radius: 5px;
            color: white;
        }

        .card .btn:hover {
            background-color: #e68a3f;
        }

        .footer-text {
            font-size: 0.9rem;
            color: #999;
        }

        .footer-link {
            color: #ff9f43;
            text-decoration: none;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="card">
            <img src="{{ asset('adminlte/dist/img/LOGO-JTI.png') }}" alt="Logo JTI" class="logo">
            <h1>SISTEM INFORMASI KOMPENSASI JTI</h1>
            <a href="{{ url('/login') }}" class="btn">MASUK</a>
            <p class="mt-3 footer-text">&copy; 2024 <a href="#" class="footer-link">Coding Koala</a> - Politeknik Negeri Malang. All rights reserved.</p>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
