<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ $title }}</title>

        {{-- FavIcon --}}
        <link rel="icon" type="image/x-icon" href="{{ URL::asset('img/software.png') }}">

        {{-- Bootstrap 5.3 - CSS --}}
        <link href="{{ URL::asset('bootstrap-5.3.0-alpha3/css/bootstrap.min.css') }}" 
        rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">

        {{-- Custom Style CSS Login --}}
        <link rel="stylesheet" href="{{ URL::asset('css/login/sign-in.css') }}">

    </head>

    <body>

        <div class="container">
            @yield('container')
        </div>

        {{-- Bootstrap 5.3 - JS --}}
        <script src="{{ URL::asset('bootstrap-5.3.0-alpha3/js/bootstrap.bundle.min.js') }}" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    </body>
</html>