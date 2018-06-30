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
    background-size: cover;
    background-repeat: no-repeat;
    background-attachment: fixed;
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
<div class="container" style="background-color: #f5f8fa">
<div class="row">
    <div class="col">
        <h1 class="text-center" style="color: #636b6f;">Routing Management System</h1>
    </div>
</div>
<nav class="navbar navbar-inverse">
  <div class="container-fluid" >
    
    <ul class="nav navbar-nav">
      <li class="dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#">Master Data
        <span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a href="{{route('vendor')}}">Warehouse</a></li>
          <li><a href="{{route('customer')}}">Customer</a></li>
          <li><a href="{{route('moda')}}">Vehicles</a></li>
          <li><a href="{{route('dist')}}">Distance</a></li>
        </ul>
      </li>
      <li class="dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#">Transaction
        <span class="caret"></span></a>
        <ul class="dropdown-menu">
            <li><a href="{{route('order')}}">SO</a></li>
            <li><a href="{{route('routing')}}">Routing</a></li>
        </ul>
      </li>
    </ul>
    <div class="navbar-header navbar-right">
    <a class="navbar-brand" href="#">{{ $datas['nowDate'] }}</a>
    </div>
  </div>
</nav>


<h3 style="color: #636b6f;"> Good {{$datas['greeting']}}, {{Auth::user()->username}}</h3>
<br>
<h4> You have <a href="{{route('order')}}">{{$datas['outstanding']}}</a> outstanding sales order </h4>
<h4> You have <a href="{{route('moda')}}">{{$datas['expire']}}</a> vehicles contract will expired soon </h4>
<div class="row">
<div class="col-md-6">  <div id="MyStocks"></div></div>
<div class="col-md-6">  <div id="Handling"></div></div>
</div>
    
    </div>
</div>
@columnchart('MyStocks', 'MyStocks');
@columnchart('Handling', 'Handling');
</body>
</html>
