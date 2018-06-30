@extends('layouts.main')

@section('judul-halaman')
Tabel Sales Order
@endsection

@section('additional-header')
@if($orders->count() > 0)
<a class="btn btn-danger" href="{{ route('order-showDelete')}}"> Hapus </a>
@else
<a class="btn btn-danger" disabled> Hapus </a>
@endif
<a class="btn btn-primary" href="{{ route('order-form') }}" type="button"> Input </a>
@endsection

@section('main-content')

<?php $id = 1; ?>
{{ Form::open(['route' => 'order-select', 'class' => "form-horizontal"]) }}
  <table class="table table-responsive border" id="order-table">
      <thead>
          <tr>
              <th> </th>
              <th> No</th>
              <th> SO Number</th>
              <th> Customer</th>
              <th> Alamat</th>
              <th> Kecamatan</th>
              <th> Kab / Kota</th>
              <th> Provinsi</th>
              <th> Quantity (unit)</th>
              <th> Volume (cm<sup>3</sup>)</th>
              <th> SO Date</th>
              <th> Keterangan</th>
              <th> Status</th>
          </tr>
      </thead>
      <tbody>
           @foreach($orders as $order)
            <tr>
                <td>
                    @if ($order->status != 1) 
                    {{ Form::checkbox('pick[]', $order->id, false) }} 
                    @endif
                </td>
                <td> <?php echo $id ?> </td>
                <td> SO_{{$order->orderNumber}} </td>
                <td> {{$order->customer}} </td>
                <td> {{$order->alamat}} </td>
                <td> {{$order->kecamatan}} </td>
                <td> {{$order->kabupaten}} </td>
                <td> {{$order->provinsi}} </td>
                <td> {{$order->quantity}} </td>
                <td> {{$order->berat}} </td>
                <td> {{$order->deliveryDate}} </td>
                <td> {{$order->keterangan}} </td>
                <td> 
                    @if($order->status == 1)
                        In Delivery
                       @else
                      Outstanding
                       @endif
                </td>
            </tr>
            <?php $id++; ?>
           @endforeach
     </tbody>
  </table>
  {{ Form::submit('Submit', ['class' => 'btn btn-info']) }}</div>
  {{Form::close()}}
  <script>
    //   $(document).ready(function() {
        $('#order-table').dynatable();
    //   });
      
  </script>
@endsection