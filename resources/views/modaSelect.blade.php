@extends('layouts.main')

@section('judul-halaman')
Database Moda Transportasi
@endsection

@section('additional-header')
<a class="btn btn-danger"> Hapus </a>
<a class="btn btn-primary" href="{{ route('moda-form') }}" type="button"> Input </a>
@endsection

@section('main-content')

@if($modas->count() > 0)
<?php $id = 1; ?>
{{ Form::open(['route' => 'moda-select', 'class' => "form-horizontal"]) }}
  <table class="table table-responsive border" id="moda-table">
      <thead>
          <tr>
              <th> </th>
              <th> No</th>
              <th> Nama</th>
              <th> Vendor</th>
              <th> Contact</th>
              <th> Quantity</th>
              <th> Tonase</th>
              <th> Duration</th>
              <th> Start From</th>
              <th> End To</th>
              <th> Status</th>
          </tr>
      </thead>
      <tbody>
           @foreach($modas as $moda)
            <tr>
                <td>                     
                    @if ($moda->quantity > 0) 
                        {{ Form::radio('pickModa', $moda->id) }}
                        @endif
                         </td>
                <td> <?php echo $id ?> </td>
                <td> {{$moda->nama}} </td>
                <td> {{$moda->vendor}} </td>
                <td> {{$moda->contact}} </td>
                <td> {{$moda->quantity}} </td>
                <td> {{$moda->tonase}} </td>
                <td> {{$moda->duration}} </td>
                <td> {{$moda->startFrom}} </td>
                <td> {{$moda->endTo}} </td>
                <td>                    @if($moda->quantity == 0)
                        <label class="switch">
                           <input type="checkbox" checked disabled>
                           <span class="slider round"></span>
                       </label>
                       @else
                       <label class="switch">
                           <input type="checkbox" disabled>
                           <span class="slider round"></span>
                       </label>
                       @endif </td>
            </tr>
            <?php $id++; ?>
           @endforeach
     </tbody>
  </table>
  {{ Form::submit('Submit', ['class' => 'btn btn-info']) }}</div>
  {{ Form::close() }}
  <script>
    //   $(document).ready(function() {
        $('#moda-table').dynatable();
        @if (Session::has('alert-route'))
        var temp = '{{ Session::get('alert-route') }}'
        alert(temp);
            // alert("\'" +  {{ Session::get('alert-route') }});
        @endif
    //   });
      
  </script>
@else
  <p> No moda transportasi found..</p>
@endif
@endsection