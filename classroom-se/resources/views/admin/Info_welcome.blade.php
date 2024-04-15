{{-- @extends('layout')--}}
@section('title')
    Admin
@endsection
@section('content')
    <a class="bi bi-plus-circle-fill"style="float:right ; font-size: 3rem; color: rgb(0, 0, 0);" href="/about"></a>
@endsection 

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>

<body>
    <div class="container py-3">
        <h2 class="container">ข้อมูลผู้ใช้งาน</h2>
        <a class="bi bi-plus-circle-fill"style="float:right ; font-size: 3rem; color: rgb(0, 0, 0);" href="/Info_create"></a>
    </div>

</body>

</html>
