<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Toko Rozaqi</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f8f9fa;
        }       .container {
            text-align: center;
        }
        h1 {
            font-size: 3rem;
            margin-bottom: 20px;
        }
        .btn-login {
            font-size: 1.5rem;
            padding: 10px 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Selamat Datang di Toko Rozaqi</h1>
        <a href="{{ route('login') }}" class="btn btn-primary btn-login">Login</a>
    </div>
</body>
</html>
