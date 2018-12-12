<!DOCTYPE html>
<html>
<head>
    <link rel="shortcut icon" type="image/x-icon" href="/images/alveare.png" />
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <meta http-equiv="UA-X-Compatible" content="IE=Edge">
    <!-- personalized css -->
    <link rel="stylesheet" type="text/css" href="/css/style.css">
    <!-- font awesome -->
    <script defer src="https://use.fontawesome.com/releases/v5.5.0/js/all.js" integrity="sha384-GqVMZRt5Gn7tB9D9q7ONtcp4gtHIUEW/yG7h98J7IpE3kpi+srfFyyB/04OV6pG0" crossorigin="anonymous"></script>
    <!-- bootstrap css -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Julius+Sans+One|Monda" rel="stylesheet">
    <!-- UIkit CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/uikit/3.0.0-rc.24/css/uikit.min.css" />
    <!-- bootstrap dependencies -->
    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

<!--  offline ver uikit, bootstrap, jquery 
<script type="text/javascript" src="/js/uikit.min.js"></script>
<script type="text/javascript" src="/js/uikit-icons.min.js"></script>
<script type="text/javascript" src="/js/bootstrap.js"></script>
<script type="text/javascript" src="/js/jquery-3.3.1.min.js"></script>
<link rel="stylesheet" type="text/css" href="/css/uikit.css">
<link rel="stylesheet" type="text/css" href="/css/bootstrap.css"> -->
<!-- CSRF Token -->

<meta name="csrf-token" content="{{ csrf_token() }}">

<title>@yield('title')</title>

<!-- Styles -->
<link href="{{ asset('css/style.css') }}" rel="stylesheet">
</head>

<body>
    <div class="container-fluid p-0 m-0" id="header">
        @include('layouts/header')
    </div>
    @guest
    <div class="container-fluid p-0 m-0" id="main-content">
        @yield('content')
    </div>
    @else
    <div class="container-fluid p-0 m-0">
        <div class="row m-0 p-0" uk-grid>
            <div class="col-lg-2 bg-light uk-grid-item-match" id="sidenav">
                @include('layouts/sidenav')
            </div>
            <div class="col mr-0" id="main-content">
                @yield('content')
            </div>
        </div>
    </div>
    @endguest
    <div class="container-fluid p-0" id="footer">
        @include('layouts/footer')
    </div>
    <!-- Scripts -->
</body>
    <script src="{{ asset('js/app.js') }}"></script>
    <!-- personalized script -->
    <script type="text/javascript" src="/js/script.js"></script>
    <!-- UIkit JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/uikit/3.0.0-rc.24/js/uikit.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/uikit/3.0.0-rc.24/js/uikit-icons.min.js"></script>
</html>