<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    <link rel="stylesheet" href="{{ asset('css/preloader.css') }}">

    <title>f</title>
</head>

<body>
    <div id="overlay"></div>
    <div id="preloader">
        <div id="loader"></div>
    </div>
    @include('auth.layout.sidebar')
    @include('auth.layout.rightbar')
    @yield('content')

</div>
<script src="{{ asset('js/preloader.js') }}"></script>
<script src="{{ asset('js/dashboard.js') }}"></script>
</body>
</html>
