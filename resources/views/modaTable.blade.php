@extends('layouts.main')

@section('judul-halaman')
Tabel Moda Transportasi
@endsection

@section('additional-header')
@if($modas->count() > 0)
<a class="btn btn-danger" href="{{ route('moda-showDelete') }}"> Hapus </a>
@else
<a class="btn btn-danger" href="{{ route('moda-showDelete') }}" disabled> Hapus </a>
@endif
<a class="btn btn-primary" href="{{ route('moda-form') }}" type="button"> Input </a>
@endsection

@section('main-content')


<?php $id = 1; ?>
  <table class="table table-responsive border" id="moda-table">
      <thead>
          <tr>
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
  <script>
    //   $(document).ready(function() {
        $('#moda-table').dynatable();
    //   });
      
  </script>

@endsection