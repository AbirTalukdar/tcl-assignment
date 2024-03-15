<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>TCL ASSIGNMENT</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="">
    <link rel="stylesheet" href="{{ asset('assets/vendors/mdi/css/materialdesignicons.min.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/css/vendor.bundle.base.css')}}">
    <!-- End layout styles -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css')}}">
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico')}}" />
    <!-- <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1"> -->

    <!-- CSRF Token -->
    <!-- <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'TCL ASSIGNMENT') }}</title> -->

    <!-- Scripts -->
    <!-- <script src="{{ asset('js/app.js') }}" defer></script> -->
    
    <!-- <link rel="stylesheet" href="../../vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="../../vendors/css/vendor.bundle.base.css"> -->
    <!-- Fonts -->
    <!-- <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet"> -->

    <!-- Styles -->
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous"> -->
    <!-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> -->

    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
</head>
<body>
<div id="app">
        <div class="page-body-wrapper">
            @include('layouts.partials.navbar')
            <div class="container-fluid page-body-wrapper">
                <div class="content-wrapper">
                    <div class="row">
                        <div class="col-lg-3">
                            @include('layouts.partials.sidebar')
                        </div>
                        <div class="col-lg-9">
                            @yield('content')
                        </div>
                    </div>
                </div>
            </div>
            @include('layouts.partials.footer')
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" 
        integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" 
        crossorigin="anonymous">
    </script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
</body>

</html>
