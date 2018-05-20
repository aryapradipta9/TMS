@extends('layouts.main')

@section('judul-halaman')
Database Routing
@endsection

@section('additional-header')
@if(count($newRouting) > 0)
<a class="btn btn-danger" href="{{ route('routing-showDelete')}}"> Hapus </a>
@else
<a class="btn btn-danger" href="{{ route('routing-showDelete')}}" disabled> Hapus </a>
@endif
<a class="btn btn-primary" href="{{ route('order') }}" type="button"> Input </a>
@endsection

@section('main-content')

<?php $id = 1; ?>
{{-- {{ Form::open(['route' => 'order-select', 'class' => "form-horizontal"]) }} --}}
  <table class="table table-responsive border" id="order-table">
      <thead>
          <tr>
              {{-- <th> </th> --}}
              <th> No</th>
              <th> Customer</th>
              <th> T. Jarak (km)</th>
              <th> T. Berat (kg)</th>
              <th> Deliv Date</th>
              <th> Keterangan</th>
              <th> Truck</th>
          </tr>
      </thead>
      <tbody>
           @foreach($newRouting as $routing)
            <tr>
                {{-- <td> {{ Form::checkbox('pick[]', $order->id, false) }} </td> --}}
            <td> <a href="routing/details/{{$routing->groupId}}"><?php echo $id ?></a> </td>
                <td> {{$routing->orderNumber}} </td>
                <td> {{$routing->totalJarak}} </td>
                <td> {{$routing->totalBerat}} </td>
                <td> {{$routing->deliveryDate}} </td>
                <td> {{$routing->keterangan}} </td>
                <td> {{$routing->truck}} </td>
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