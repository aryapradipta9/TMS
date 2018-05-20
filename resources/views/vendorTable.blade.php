@extends('layouts.main')

@section('judul-halaman')
Database Warehouse
@endsection

@section('additional-header')
@if($vendors->count() > 0)
<a class="btn btn-danger" href="{{ route('vendor-showDelete')}}"> Hapus </a>
@else
<a class="btn btn-danger" href="{{ route('vendor-showDelete')}}" disabled> Hapus </a>
@endif
<a class="btn btn-primary" href="{{ route('vendor-form') }}" type="button"> Input </a>
@endsection

@section('main-content')
<?php $id = 1; ?>
  <table class="table table-responsive" id="vendor-table">
      <thead>
          <tr>
              <th> No</th>
              <th> Nama</th>
              <th> Alamat</th>
              <th> Mail</th>
              <th> No. Tlp</th>
              <th> Contact Person</th>
          </tr>
      </thead>
      <tbody>
           @foreach($vendors as $vendor)
            <tr>
                <td> <?php echo $id; $id++; ?> </td>
                <td> {{$vendor->nama}} </td>
                <td> {{$vendor->alamat}} </td>
                <td> {{$vendor->mail}} </td>
                <td> {{$vendor->telp}} </td>
                <td> {{$vendor->contact}} </td>
            </tr>
           @endforeach
     </tbody>
  </table>
  <script>
    //   $(document).ready(function() {
        $('#vendor-table').dynatable();
    //   });
      
  </script>
@endsection