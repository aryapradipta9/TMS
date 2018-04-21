@extends('layouts.main')

@section('judul-halaman')
Database Customer
@endsection

@section('additional-header')
<a class="btn btn-danger"> Hapus </a>
<a class="btn btn-primary" href="{{ route('customer-form') }}" type="button"> Input </a>
@endsection

@section('main-content')

@if($customers->count() > 0)
  <table class="table table-responsive border" id="cust-table">
      <thead>
          <tr>
              <th> No</th>
              <th> Nama Customer</th>
              <th> Jenis</th>
              <th> Alamat</th>
              <th> Mail</th>
              <th> No. Tlp</th>
              <th> Contact Person</th>
          </tr>
      </thead>
      <tbody>
           @foreach($customers as $customer)
            <tr>
                <td> {{$customer->id}} </td>
                <td> {{$customer->nama}} </td>
                <td> {{$customer->jenis}} </td>
                <td> {{$customer->alamat}} </td>
                <td> {{$customer->mail}} </td>
                <td> {{$customer->no_telp}} </td>
                <td> {{$customer->contact_person}} </td>
            </tr>
           @endforeach
     </tbody>
  </table>
  <script>
    //   $(document).ready(function() {
        $('#cust-table').dynatable();
    //   });
      
  </script>
@else
  <p> No users found..</p>
@endif
@endsection