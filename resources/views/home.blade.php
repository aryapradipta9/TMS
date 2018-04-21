@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-4">
        <a href="{{route('customer')}}"> Customer </a>
        </div>
        <div class="col-md-4">
        <a href="{{route('vendor')}}"> Vendor </a>
        </div>
        <div class="col-md-4">
            <a href="#"> Routing </a>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <a href="#"> Sales Order </a>
        </div>
        <div class="col-md-4">
            <a href="#"> Moda Transportasi </a>
        </div>
        <div class="col-md-4">
            <a href="#"> Jarak </a>
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
