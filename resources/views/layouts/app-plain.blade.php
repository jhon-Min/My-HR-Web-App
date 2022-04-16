<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'My HR')</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css" />
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap5.min.css">
    @yield('head')
</head>

<body class="bg-light">
    <!--Container Main start-->
    <div>
        <div class="container">
            @yield('content')
        </div>
    </div>
    <!--Container Main End-->

    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/pincode.js') }}"></script>
    @yield('scripts')

    @auth
        @include('layouts.toast')

        @include('layouts.create-alert')
    @endauth
</body>

</html>
