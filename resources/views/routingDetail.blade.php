@extends('layouts.main')

@section('judul-halaman')
Tabel Routing
@endsection

@section('additional-header')
<a class="btn btn-danger" href="{{ route('routing-showDelete')}}"> Hapus </a>
<a class="btn btn-primary" href="{{ route('order-form') }}" type="button"> Input </a>
@endsection

@section('main-content')

@if(count($newRouting) > 0)
<?php $id = 1; ?>
{{-- {{ Form::open(['route' => 'order-select', 'class' => "form-horizontal"]) }} --}}
  <table class="table table-responsive border" id="order-table">
      <thead>
          <tr>
              {{-- <th> </th> --}}
              <th> No</th>
              <th> SO Number</th>
              <th> Customer</th>
              <th> Alamat</th>
              <th> Kecamatan</th>
              <th> Kab / Kota</th>
              <th> Provinsi</th>
          </tr>
      </thead>
      <tbody>
           @foreach($newRouting as $routing)
            <tr>
                {{-- <td> {{ Form::checkbox('pick[]', $order->id, false) }} </td> --}}
                <td> <?php echo $id ?> </td>
                <td> {{$routing->order}} </td>
                <td> {{$routing->customer}} </td>
                <td> {{$routing->alamat}} </td>
                <td> {{$routing->kecamatan}} </td>
                <td> {{$routing->kabupaten}} </td>
                <td> {{$routing->provinsi}} </td>
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