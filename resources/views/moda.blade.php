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
{{-- </div>--}}

        {!! Form::label('tonase', 'Tonase', ['class' => 'control-label col-sm-1']) !!}
        <div class="col-sm-2">
                        <span class="input-group"> 
        {!! Form::number('tonase', 0, ['class' => 'form-control']) !!}
        <span class="input-group-addon">Text</span>
                        </span>
        </div>
{{-- 
<div class="form-group"> --}}
        {!! Form::label('duration', 'Duration', ['class' => 'control-label col-sm-2']) !!}
        <div class="col-sm-2">
                        <span class="input-group"> 
        {!! Form::number('duration', 0, ['class' => 'form-control']) !!}
        <span class="input-group-addon">hari</span>
                        </span>
        </div>
</div>
<div class="form-group">
        {!! Form::label('startFrom', 'Start From', ['class' => 'control-label col-sm-2']) !!}
        <div class="col-sm-4">
        {!! Form::date('startFrom', null, ['class' => 'form-control']) !!}
        </div>
{{-- </div>
<div class="form-group"> --}}
</div>
<div class="col-sm-10"></div>
<div class="col-sm-2">
        {{ Form::submit('Submit', ['class' => 'btn btn-info']) }}</div>
{{ Form::close() }}

@endsection