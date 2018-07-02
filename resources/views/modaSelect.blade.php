@extends('layouts.main')

@section('judul-halaman')
Tabel Moda Transportasi
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
              <th> Plat Nomor</th>
              <th>  Volume Karoseri (cm<sup>3</sup>) </th>
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
                <td> {{$moda->plat}} </td>
                <td> {{$moda->nama}} </td>
                <td> {{$moda->vendor}} </td>
                <td> {{$moda->contact}} </td>
                <td> {{$moda->tonase}} </td>
                <td> {{$moda->duration}} </td>
                <td> {{$moda->startFrom}} </td>
                <td> {{$moda->endTo}} </td>
                <td>                    @if($moda->quantity == 0)
                    Not Available
                   @else
                   Available
                   @endif </td>
            </tr>
            <?php $id++; ?>
           @endforeach
     </tbody>
  </table>
  {{ Form::hidden('force', 0, ['id' => 'force']) }}
  {{ Form::submit('Submit', ['class' => 'btn btn-info']) }}</div>
  {{ Form::close() }}
  
    @if (Session::has('alert-route'))
        <div id="dialog-confirm" title="Empty the recycle bin?">
            <p><span class="ui-icon ui-icon-alert" style="float:left; margin:12px 12px 20px 0;"></span>Ada moda yang dapat menampung.</p>
        </div>
        <script>
            $( function() {
              $( "#dialog-confirm" ).dialog({
                resizable: false,
                height: "auto",
                width: 400,
                modal: true,
                buttons: {
                  "Lanjutkan": function() {
                    $( this ).dialog( "close" );
                    document.getElementById('force').value = 1;
                    document.getElementById('formModa').submit();
                  },
                  "Ganti": function() {
                    $( this ).dialog( "close" );
                  }
                }
              });
            } );
        </script>
    @endif
  
  <script>
        $('#moda-table').dynatable();
  </script>
@else
  <p> No moda transportasi found..</p>
@endif
@endsection