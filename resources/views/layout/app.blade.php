<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>My Cart</title>

        <!-- Bootstrap -->
        <link href="/bootstrap/css/bootstrap.css" rel="stylesheet">
        <link rel="stylesheet" href="/bootstrap-icons/font/bootstrap-icons.css">
    </head>
    <body>
        <div>
            @include('layout.navbar')
            <div class="container">
                @yield('content')
            </div>
        </div>
    </body>
    <script src="/bootstrap/js/bootstrap.js"></script>
    <script src="/jquery.min.js"></script>
   
</html>
