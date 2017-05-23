<!doctype html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Test Project</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
    <style>
        .links {
            margin: auto 500px;
            margin-top: 300px;
            text-align: center;
        }

        .completed {
            text-decoration: line-through;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="row">

        @yield('content')
    </div>
</div>
</body>
</html>
