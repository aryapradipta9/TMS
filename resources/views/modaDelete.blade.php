@extends('layouts.main')

@section('judul-halaman')
Database Moda Transportasi
@endsection

@section('additional-header')
<a class="btn btn-danger"> Hapus </a>
<a class="btn btn-primary" href="{{ route('moda-form') }}" type="button"> Input </a>
@endsection

@section('main-content')


<?php $id = 1; ?>
{{ Form::open(['route' => 'moda-delete']) }}
  <table class="table table-responsive border" id="moda-table">
      <thead>
          <tr>
              <th> </th>
              <th> Nama</th>
              <th> Warehouse</th>
              <th> Contact</th>
              <th> Quantity (unit)</th>
              <th> Tonase (kg) </th>
              <th> Duration</th>
              <th> Start From</th>
              <th> End To</th>
              <th> Status</th>
          </tr>
      </thead>
      
      <tbody>
           @foreach($modas as $moda)
            <tr>
                <td> {{ Form::checkbox('pick[]', $moda->id, false) }} </td>
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
  {{ Form::submit('Remove', ['class' => 'btn btn-danger']) }}</div>
  {{ Form::close() }}
  <script>
    //   $(document).ready(function() {
        $('#moda-table').dynatable();
    //   });
      
  </script>
@endsection