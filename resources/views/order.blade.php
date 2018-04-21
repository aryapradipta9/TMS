@extends('layouts.main')

@section('judul-halaman')
Sales Order
@endsection

@section('main-content')
{{ Form::open(['route' => 'order-add', 'class' => "form-horizontal"]) }}
<div class="form-group">
    {!! Form::label('orderNumber', 'SO Number', ['class' => 'control-label col-sm-2']) !!}
    <div class="col-sm-10">
    {!! Form::text('orderNumber', null, ['class' => 'form-control']) !!}
    </div>
</div>
<div class="form-group">
        {!! Form::label('customer', 'Customer', ['class' => 'control-label col-sm-2']) !!}
        <div class="col-sm-10">
        {!! Form::select('customer', $customers, null, ['class' => 'form-control']) !!}
        </div>
</div>
<div class="form-group">
        {!! Form::label('quantity', 'Quantity', ['class' => 'control-label col-sm-2']) !!}
        <div class="col-sm-4">
        {!! Form::number('quantity', 0, ['class' => 'form-control']) !!}
        </div>
{{-- </div>
<div class="form-group"> --}}
        {!! Form::label('berat', 'Berat', ['class' => 'control-label col-sm-2']) !!}
        <div class="col-sm-4">
        {!! Form::number('berat', 0, ['class' => 'form-control']) !!}
        </div>
</div>
<div class="form-group">
        {!! Form::label('deliveryDate', 'Delivery Date', ['class' => 'control-label col-sm-2']) !!}
        <div class="col-sm-4">
        {!! Form::date('deliveryDate', null, ['class' => 'form-control']) !!}
        </div>
</div>
<div class="form-group">
        {!! Form::label('keterangan', 'Keterangan', ['class' => 'control-label col-sm-2']) !!}
        <div class="col-sm-10">
        {!! Form::text('keterangan', null, ['class' => 'form-control']) !!}
        </div>
</div>
<div class="col-sm-10"></div>
<div class="col-sm-2">
        {{ Form::submit('Submit', ['class' => 'btn btn-info']) }}</div>
{{ Form::close() }}

@endsection