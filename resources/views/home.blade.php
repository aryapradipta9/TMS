@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row" style="height:100px;">
        <div class="col-md-4">
        <a href="{{route('customer')}}" class="btn btn-lg btn-primary"> Customer </a>
        </div>
        <div class="col-md-4">
        <a href="{{route('vendor')}}" class="btn btn-lg btn-primary"> Vendor </a>
        </div>
        <div class="col-md-4">
        <a href="{{route('routing')}}" class="btn btn-lg btn-primary"> Routing </a>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <a href="{{route('order')}}" class="btn btn-lg btn-primary"> Sales Order </a>
        </div>
        <div class="col-md-4">
            <a href="{{route('moda')}}" class="btn btn-lg btn-primary"> Moda Transportasi </a>
        </div>
        <div class="col-md-4">
            <a href="{{route('dist')}}" class="btn btn-lg btn-primary"> Jarak </a>
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
@endsection
