@extends('layouts.main')

@section('judul-halaman')
Database Distance
@endsection

@section('additional-header')

@endsection

@section('main-content')

<?php $id = 1; ?>
{{ Form::open(['route' => 'dist-delete']) }}
  <table class="table table-responsive border" id="dist-table">
      <thead>
          <tr>
              <th> </th>
              <th> Origin</th>
              <th> Destination</th>
              <th> Distance (km)</th>
          </tr>
      </thead>
      <tbody>
           @foreach($distances as $distance)
            <tr>
                <td> {{ Form::checkbox('pick[]', $distance->id, false) }} </td>
                <td> {{$distance->origin}} </td>
                <td> {{$distance->dest}} </td>
                <td> {{$distance->distance}} </td>
            </tr>
           @endforeach
     </tbody>
  </table>
  {{ Form::submit('Remove', ['class' => 'btn btn-danger']) }}</div>
  {{ Form::close() }}
  <script>
    //   $(document).ready(function() {
        $('#dist-table').dynatable();
    //   });
      
  </script>
@endsection