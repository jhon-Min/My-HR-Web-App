<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'My HR')</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css" />

    <!-- DataTable -->
    {{-- <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css"> --}}

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    @yield('head')
</head>

<body id="body-pd" class="bg-light">

    @auth
        @include('layouts.header')

        @include('layouts.sidebar')
    @endauth

    <!--Container Main start-->
    <div class="min-vh-100z">
        <div class="container-fluid">
            @yield('content')
        </div>
    </div>
    <!--Container Main End-->

    <script src="{{ asset('js/app.js') }}"></script>

    {{-- Datatable --}}
    <script type="text/javascript" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>

    {{-- Laravel Js Validation --}}
    <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js') }}"></script>

    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script> {{-- FlatPicker --}}
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script> {{-- Select 2 --}}

    <script src="{{ asset('js/dtable.js') }}"></script>
    @yield('scripts')

    @auth
        @include('layouts.toast')

        @include('layouts.create-alert')
    @endauth
</body>

</html>
