@extends('layouts.main')

@section('judul-halaman')
Distance
@endsection

@section('main-content')
{{ Form::open(['route' => 'dist-add', 'class' => "form-horizontal"]) }}
<div class="form-group">
        {!! Form::label('origin', 'Origin', ['class' => 'control-label col-sm-1']) !!}
        <div class="col-sm-11">
        {!! Form::select('origin', $customers, null, ['class' => 'form-control']) !!}
    </div>
</div>
<div class="form-group">
        {!! Form::label('dest', 'Destination', ['class' => 'control-label col-sm-1']) !!}
        <div class="col-sm-11">
        {!! Form::select('dest', $customers, null, ['class' => 'form-control']) !!}
        </div>
</div>
<div class="col-sm-10"></div>
<div class="col-sm-2">
        {{ Form::submit('Submit', ['class' => 'btn btn-info']) }}</div>
{{ Form::close() }}

@endsection