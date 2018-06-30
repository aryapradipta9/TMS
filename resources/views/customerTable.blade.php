@extends('layouts.main')

@section('judul-halaman')
Tabel Customer
@endsection

@section('additional-header')
<a class="btn btn-danger" href="{{ route('cust-showDelete') }}"> Hapus </a>
<a class="btn btn-primary" href="{{ route('customer-form') }}" type="button"> Input </a>
@endsection

@section('main-content')
<?php $id = 1; ?>
  <table class="table table-responsive border" id="cust-table">
      <thead>
          <tr>
              <th> No</th>
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
                <td> <?php echo $id; $id++; ?> </td>
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
  <script>
    //   $(document).ready(function() {
        $('#cust-table').dynatable();
    //   });
      
  </script>
@endsection