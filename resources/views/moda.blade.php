@extends('layouts.main')

@section('judul-halaman')
Moda
@endsection

@section('main-content')
{{ Form::open(['route' => 'moda-add', 'class' => "form-horizontal"]) }}
<div class="form-group">
    {!! Form::label('nama', 'Nama Kendaraan', ['class' => 'control-label col-sm-2']) !!}
    <div class="col-sm-10">
    {!! Form::text('nama', null, ['class' => 'form-control']) !!}
    </div>
</div>
<div class="form-group">
        {!! Form::label('vendor', 'Vendor', ['class' => 'control-label col-sm-2']) !!}
        <div class="col-sm-10">
        {!! Form::select('vendor', $vendors, null, ['class' => 'form-control']) !!}
        </div>
</div>
<div class="form-group">
        {!! Form::label('contact', 'Contact', ['class' => 'control-label col-sm-2']) !!}
        <div class="col-sm-10">
        {!! Form::text('contact', null, ['class' => 'form-control']) !!}
        </div>
</div>
<div class="form-group">
        {!! Form::label('quantity', 'Quantity', ['class' => 'control-label col-sm-2']) !!}
        <div class="col-sm-2">
        {!! Form::number('quantity', 0, ['class' => 'form-control']) !!}
        </div>
{{-- </div>
<div class="form-group"> --}}
        {!! Form::label('tonase', 'Tonase', ['class' => 'control-label col-sm-1']) !!}
        <div class="col-sm-2">
        {!! Form::number('tonase', 0, ['class' => 'form-control']) !!}
        </div>
{{-- </div>
<div class="form-group"> --}}
        {!! Form::label('duration', 'Duration', ['class' => 'control-label col-sm-1']) !!}
        <div class="col-sm-2">
        {!! Form::number('duration', 0, ['class' => 'form-control']) !!}
        </div>
</div>
<div class="form-group">
        {!! Form::label('startFrom', 'Start From', ['class' => 'control-label col-sm-2']) !!}
        <div class="col-sm-4">
        {!! Form::date('startFrom', null, ['class' => 'form-control']) !!}
        </div>
{{-- </div>
<div class="form-group"> --}}
        {!! Form::label('endTo', 'End To', ['class' => 'control-label col-sm-1']) !!}
        <div class="col-sm-4">
        {!! Form::date('endTo', null, ['class' => 'form-control']) !!}
        </div>
</div>
<div class="col-sm-10"></div>
<div class="col-sm-2">
        {{ Form::submit('Submit', ['class' => 'btn btn-info']) }}</div>
{{ Form::close() }}

@endsection