@extends('layouts.app')

@section('content')
<div class="container-fluid" style="height:100%; min-height:100%;">
  <div class="row">
    <div class="col-md-10"><h2 style="margin-top:15px;">@yield('judul-halaman')</h2></div>
    <div class="col-md-2" style="margin-top:15px; margin-bottom:20px;">@yield('additional-header')</div>
  </div>
<div class="row" style="height:100%; min-height:100%;">  
        <nav class="col-md-2 d-none d-md-block bg-light sidebar" id="navigation-panel" style="height:100%; min-height:100%;background-color: rgba(0, 0, 0, .10);">
                <div class="sidebar-sticky">
                  <ul class="nav flex-column" >
                    <li class="nav-item">
                    <a class="nav-link active nav-side" href="{{route('home')}}" id="home-click">
                        Home
                      </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active nav-side" href={{route('customer')}} id="home-click">
                            Customer
                        </a>
                    </li>
                  </ul>
                
                  
                </div>
              </nav>

      
              <main role="main" class="col-md-8 ml-sm-auto col-lg-10 pt-3 px-4">
                  {{-- <h3 style="margin-top:15px; margin-left:5%;margin-bottom:22px">Database Customer</h3> --}}
                    @yield('main-content')
              </main>
            
</div>
</div>
@endsection