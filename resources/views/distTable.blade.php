@extends('layouts.main')

@section('judul-halaman')
Tabel Distance
@endsection

@section('additional-header')
@if(count($distances) > 0)
<a class="btn btn-danger" href="{{ route('dist-showDelete') }}"> Hapus </a>
@else
<a class="btn btn-danger" href="{{ route('dist-showDelete') }}" disabled> Hapus </a>
@endif
<a class="btn btn-primary" href="{{ route('dist-form') }}" type="button"> Input </a>
@endsection

@section('main-content')

<?php $id = 1; ?>
  <table class="table table-responsive border" id="dist-table">
      <thead>
          <tr>
              <th> No</th>
              <th> Origin</th>
              <th> Destination</th>
              <th> Distance (km)</th>
          </tr>
      </thead>
      <tbody>
           @foreach($distances as $distance)
            <tr>
                <td> <?php echo $id; $id++; ?> </td>
                <td> {{$distance->origin}} </td>
                <td> {{$distance->dest}} </td>
                <td> {{$distance->distance}} </td>
            </tr>
           @endforeach
     </tbody>
  </table>
  <script>
    //   $(document).ready(function() {
        $('#dist-table').dynatable();
    //   });
      
  </script>
@endsection