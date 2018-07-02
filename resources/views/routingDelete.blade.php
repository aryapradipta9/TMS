@extends('layouts.main')

@section('judul-halaman')
Tabel Routing
@endsection

@section('additional-header')
@if(count($newRouting) > 0)
<a class="btn btn-danger" href="{{ route('routing-showDeliv')}}"> Delivered </a>
<a class="btn btn-danger" href="{{ route('routing-showDelete')}}"> Hapus </a>
@else
<a class="btn btn-danger" href="{{ route('routing-showDeliv')}}" disabled> Delivered </a>
<a class="btn btn-danger" href="{{ route('routing-showDelete')}}" disabled> Hapus </a>
@endif
<a class="btn btn-primary" href="{{ route('order-form') }}" type="button"> Input </a>
@endsection

@section('main-content')

<?php $id = 1; ?>
{{ Form::open(['route' => 'routing-delete', 'class' => "form-horizontal"]) }}
  <table class="table table-responsive border" id="order-table">
      <thead>
          <tr>
              {{-- <th> </th> --}}
              <th> </th>
              <th> Customer</th>
              <th> T. Jarak (km)</th>
              <th> T. Volume (cm<sup>3</sup>)</th>
              <th> Deliv Date</th>
              
              <th> Truck</th>
          </tr>
      </thead>
      <tbody>
           @foreach($newRouting as $routing)
            <tr>
                {{-- <td> {{ Form::checkbox('pick[]', $order->id, false) }} </td> --}}
                <td> {{ Form::checkbox('pick[]', $routing->groupId, false) }} </td>
                <td> {{$routing->orderNumber}} </td>
                <td> {{$routing->totalJarak}} </td>
                <td> {{$routing->totalBerat}} </td>
                <td> {{$routing->deliveryDate}} </td>
                
                <td> {{$routing->truck}} </td>
            </tr>
            <?php $id++; ?>
           @endforeach
     </tbody>
  </table>
  {{ Form::submit('Remove', ['class' => 'btn btn-danger']) }}</div>
  {{ Form::close() }}
  <script>
    //   $(document).ready(function() {
        $('#order-table').dynatable();
    //   });
      
  </script>
  @endsection