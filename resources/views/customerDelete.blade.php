@extends('layouts.main')

@section('judul-halaman')
Tabel Customer
@endsection

@section('additional-header')

@endsection

@section('main-content')

@if($customers->count() > 0)
{{ Form::open(['route' => 'cust-delete']) }}
  <table class="table table-responsive border" id="cust-table">
      <thead>
          <tr>
              <th> </th>
              <th> Nama Customer</th>
              <th> Jenis</th>
              <th> Alamat</th>
              <th> Kecamatan</th>
              <th> Kab / Kota</th>
              <th> Provinsi</th>
              <th> Mail</th>
              <th> No. Tlp</th>
              <th> Contact Person</th>
          </tr>
      </thead>
      <tbody>
           @foreach($customers as $customer)
            <tr>
                <td> {{ Form::checkbox('pick[]', $customer->id, false) }} </td>
                <td> {{$customer->nama}} </td>
                <td> {{$customer->jenis}} </td>
                <td> {{$customer->alamat}} </td>
                <td> {{$customer->kecamatan}} </td>
                <td> {{$customer->kabupaten}} </td>
                <td> {{$customer->provinsi}} </td>
                <td> {{$customer->mail}} </td>
                <td> {{$customer->no_telp}} </td>
                <td> {{$customer->contact_person}} </td>
            </tr>
           @endforeach
     </tbody>
  </table>
  {{ Form::submit('Remove', ['class' => 'btn btn-danger']) }}</div>
  {{ Form::close() }}
  <script>
    //   $(document).ready(function() {
        $('#cust-table').dynatable();
    //   });
      
  </script>
@else
  <p> No users found..</p>
@endif
@endsection