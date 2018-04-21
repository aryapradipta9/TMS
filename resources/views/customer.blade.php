@extends('layouts.main')

@section('judul-halaman')
Customer
@endsection

@section('main-content')
{{ Form::open(['route' => 'customer-add', 'class' => "form-horizontal"]) }}
<div class="form-group">
    {!! Form::label('nama', 'Nama', ['class' => 'control-label col-sm-1']) !!}
    <div class="col-sm-11">
    {!! Form::text('nama', null, ['class' => 'form-control']) !!}
    </div>
</div>
<div class="form-group">
        {!! Form::label('jenis', 'Jenis', ['class' => 'control-label col-sm-1']) !!}
        <div class="col-sm-11">
        {!! Form::text('jenis', null, ['class' => 'form-control']) !!}
        </div>
</div>
<div class="form-group">
        {!! Form::label('alamat', 'Alamat', ['class' => 'control-label col-sm-1']) !!}
        <div class="col-sm-11">
        {!! Form::text('alamat', null, ['class' => 'form-control']) !!}
        </div>
</div>
<div class="form-group">
        {!! Form::label('kecamatan', 'Kecamatan', ['class' => 'control-label col-sm-1']) !!}
        <div class="col-sm-11">
        {!! Form::text('kecamatan', null, ['class' => 'form-control']) !!}
        </div>
</div>
<div class="form-group">
        {!! Form::label('kabupaten', 'Kab / Kota', ['class' => 'control-label col-sm-1']) !!}
        <div class="col-sm-11">
        {!! Form::text('kabupaten', null, ['class' => 'form-control']) !!}
        </div>
</div>
<div class="form-group">
        {!! Form::label('provinsi', 'Provinsi', ['class' => 'control-label col-sm-1']) !!}
        <div class="col-sm-11">
        {!! Form::text('provinsi', null, ['class' => 'form-control']) !!}
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