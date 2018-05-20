@extends('layouts.main')

@section('judul-halaman')
Database Sales Order
@endsection

@section('additional-header')
<a class="btn btn-danger"> Hapus </a>
<a class="btn btn-primary" href="{{ route('order-form') }}" type="button"> Input </a>
@endsection

@section('main-content')

@if($orders->count() > 0)
<?php $id = 1; ?>
{{ Form::open(['route' => 'order-delete', 'class' => "form-horizontal"]) }}
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
              <th> Berat (kg)</th>
              <th> Date</th>
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
                        <label class="switch">
                           <input type="checkbox" checked disabled>
                           <span class="slider round"></span>
                       </label>
                       @else
                       <label class="switch">
                           <input type="checkbox" disabled>
                           <span class="slider round"></span>
                       </label>
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
@else
  <p> No sales order found..</p>
@endif
@endsection