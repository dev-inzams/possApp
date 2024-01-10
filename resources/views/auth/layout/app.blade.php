<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    <link rel="stylesheet" href="{{ asset('css/preloader.css') }}">
    <link rel="stylesheet" href="{{ asset('css/tostify.css') }}">
    <script src="{{ asset('js/preloader.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <title>@yield('title')</title>
</head>

<body>
    <div id="overlay"></div>
    <div id="preloader">
        <div id="loader"></div>
    </div>
    @include('auth.layout.sidebar')
    @include('auth.layout.rightbar')
    <main>
        @yield('content')
    </main>
</div>

<script src="{{ asset('js/dashboard.js') }}"></script>
<script src="{{ asset('js/tostify.js') }}"></script>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
</body>
</html>
