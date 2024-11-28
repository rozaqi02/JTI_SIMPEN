<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Data User</title>
</head>
<body>
    <h1>Data User</h1>
    {{-- <a href="user/tambah">+ Tambah User</a> --}}
    {{-- bisa pake salah satu, lebih baik yg bawah --}}
    <a href="{{ url('/user/tambah') }}">+ Tambah User</a>

    <table border="1" cellpadding="2" cellspacing="0">
        <tr>
            <th>ID</th>
            <th>Username</th>
            <th>Nama</th>
            <th>ID Level Pengguna</th>
        </tr>
        <tr>
            <td>{{$data->user_id}} </td>
            <td>{{$data->username}} </td>
            <td>{{$data->nama}} </td>
            <td>{{$data->level_id}} </td>
        </tr>
    @endforeach
    </table>
</body>
</html>