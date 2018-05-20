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
{{ Form::open(['route' => 'moda-select', 'class' => "form-horizontal", 'id' => 'formModa']) }}
  <table class="table table-responsive border" id="moda-table">
      <thead>
          <tr>
              <th> </th>
              <th> No</th>
              <th> Nama</th>
              <th> Warehouse</th>
              <th> Contact</th>
              <th> Quantity (unit)</th>
              <th> Tonase (kg)</th>
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
                        @if ((Session::has('prev-number')) and (Session::get('prev-number') == $moda->id))
                            {{ Form::radio('pickModa', $moda->id, true) }}
                        @else
                            {{ Form::radio('pickModa', $moda->id) }}
                        @endif
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
  {{ Form::hidden('force', 0, ['id' => 'force']) }}
  {{ Form::submit('Submit', ['class' => 'btn btn-info']) }}</div>
  {{ Form::close() }}
  <script>
    //   $(document).ready(function() {
        $('#moda-table').dynatable();
        @if (Session::has('alert-route'))
            var temp = '{{ Session::get('alert-route') }}'
            var hwehwe = {{ Session::get('prev-number') }};
            var r = confirm(temp);
            if (r == true) {
                document.getElementById('force').value = 1;
                document.getElementById('formModa').submit();
            }
            // alert("\'" +  {{ Session::get('alert-route') }});
        @endif
    //   });
      
  </script>
@else
  <p> No moda transportasi found..</p>
@endif
@endsection