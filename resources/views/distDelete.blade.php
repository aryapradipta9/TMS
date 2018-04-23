@extends('layouts.main')

@section('judul-halaman')
Database Distance
@endsection

@section('additional-header')
<a class="btn btn-danger"> Hapus </a>
<a class="btn btn-primary" href="{{ route('dist-form') }}" type="button"> Input </a>
@endsection

@section('main-content')

<?php $id = 1; ?>
@if($distances->count() > 0)
{{ Form::open(['route' => 'dist-delete']) }}
  <table class="table table-responsive border" id="dist-table">
      <thead>
          <tr>
              <th> </th>
              <th> Origin</th>
              <th> Destination</th>
              <th> Distance</th>
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
@else
  <p> Tidak ada data jarak </p>
@endif
@endsection