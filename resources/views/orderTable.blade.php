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
  <table class="table table-responsive border" id="order-table">
      <thead>
          <tr>
              <th> No</th>
              <th> SO Number</th>
              <th> Customer</th>
              <th> Alamat</th>
              <th> Kecamatan</th>
              <th> Kab / Kota</th>
              <th> Provinsi</th>
              <th> Quantity</th>
              <th> Berat</th>
              <th> Date</th>
              <th> Keterangan</th>
              <th> Status</th>
          </tr>
      </thead>
      <tbody>
           @foreach($orders as $order)
            <tr>
                <td> <?php echo $id ?> </td>
                <td> {{$order->orderNumber}} </td>
                <td> {{$order->customer}} </td>
                <td> {{$order->alamat}} </td>
                <td> {{$order->kecamatan}} </td>
                <td> {{$order->kabupaten}} </td>
                <td> {{$order->provinsi}} </td>
                <td> {{$order->quantity}} </td>
                <td> {{$order->berat}} </td>
                <td> {{$order->date}} </td>
                <td> {{$order->keterangan}} </td>
                <td> {{$order->status}} </td>
            </tr>
            <?php $id++; ?>
           @endforeach
     </tbody>
  </table>
  <script>
    //   $(document).ready(function() {
        $('#order-table').dynatable();
    //   });
      
  </script>
@else
  <p> No sales order found..</p>
@endif
@endsection