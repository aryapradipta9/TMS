@extends('layouts.main')

@section('judul-halaman')
Warehouse
@endsection

@section('main-content')
{{ Form::open(['route' => 'vendor-add', 'class' => "form-horizontal"]) }}
<div class="form-group">
    {!! Form::label('nama', 'Nama', ['class' => 'control-label col-sm-1']) !!}
    <div class="col-sm-11">
    {!! Form::text('nama', null, ['class' => 'form-control']) !!}
    </div>
</div>
<div class="form-group">
        {!! Form::label('alamat', 'Alamat', ['class' => 'control-label col-sm-1']) !!}
        <div class="col-sm-11">
        {!! Form::text('alamat', null, ['class' => 'form-control']) !!}
        </div>
</div>
<div class="form-group">
        {!! Form::label('mail', 'Mail', ['class' => 'control-label col-sm-1']) !!}
        <div class="col-sm-11">
        {!! Form::text('mail', null, ['class' => 'form-control']) !!}
        </div>
</div>
<div class="form-group">
        {!! Form::label('telp', 'No. Telp', ['class' => 'control-label col-sm-1']) !!}
        <div class="col-sm-11">
        {!! Form::text('telp', null, ['class' => 'form-control']) !!}
        </div>
</div>
<div class="form-group">
        {!! Form::label('contact', 'Contact', ['class' => 'control-label col-sm-1']) !!}
        <div class="col-sm-11">
        {!! Form::text('contact', null, ['class' => 'form-control']) !!}
        </div>
</div>
<div class="col-sm-10"></div>
<div class="col-sm-2">
        {{ Form::submit('Submit', ['class' => 'btn btn-info']) }}</div>
{{ Form::close() }}

@endsection