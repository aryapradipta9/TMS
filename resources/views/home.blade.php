<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" style="height:100%;">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Transportation Management System</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/slider.css') }}" rel="stylesheet">
    {{-- <link href="{{ asset('css/dashboard.css') }}" rel="stylesheet"> --}}
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.10/css/all.css" integrity="sha384-+d0P83n9kaQMCwj8F4RJB66tzIwOKmrdb46+porD/OvrJ+37WqIM7UoBtwHO6Nlg" crossorigin="anonymous">
    <link href="{{ asset('css/jquery.dynatable.css') }}" rel="stylesheet">
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/jquery.dynatable.js') }}"></script>
    <style>
        .bg { 
    /* The image used */
    background-image: url("background.jpg");

    /* Full height */
    height: 100%; 

    /* Center and scale the image nicely */
    background-position: center;
    background-repeat: no-repeat;
    background-size: cover;
        }

        .btn{
  margin:5%;
  margin-left:25%;
  margin-right: 25%;
  display:block;
}
    </style>
</head>
<body class="bg" style="height:100%;">
    <div id="app" style="height:100%; min-height: 100%;">
<div class="container-fluid">
<div class="row">
    <div class="col">
        <h1 class="text-center" style="color: white;">Selamat datang di Transportation Management System</h1>
    </div>
</div>
    <div class="row md-5">
        <div class="col-md-4">
        <a href="{{route('customer')}}" class="btn btn-lg btn-default"><img src="customer.png"><br> Customer </a>
        </div>
        <div class="col-md-4">
        <a href="{{route('vendor')}}" class="btn btn-lg btn-default"><img src="vendor.png"><br> Vendor </a>
        </div>
        <div class="col-md-4">
        <a href="{{route('routing')}}" class="btn btn-lg btn-default"><img src="route.png"><br> Routing </a>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <a href="{{route('order')}}" class="btn btn-lg btn-default"><img src="order.png"><br> Sales Order </a>
        </div>
        <div class="col-md-4">
            <a href="{{route('moda')}}" class="btn btn-lg btn-default"><img src="truck.png"><br> Moda Transportasi </a>
        </div>
        <div class="col-md-4">
            <a href="{{route('dist')}}" class="btn btn-lg btn-default"><img src="distance3.png"><br> Jarak </a>
        </div>
    </div>
        {{-- <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!
                </div>
            </div>
        </div> --}}
    </div>
</div>
</body>
</html>
