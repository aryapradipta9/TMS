@extends('layouts.main')

@section('judul-halaman')
Database Vendor
@endsection

@section('additional-header')
<a class="btn btn-danger"> Hapus </a>
<a class="btn btn-primary" href="{{ route('vendor-form') }}" type="button"> Input </a>
@endsection

@section('main-content')

@if($vendors->count() > 0)
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
                <td> {{$vendor->id}} </td>
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
@else
  <p> No vendor found..</p>
@endif
@endsection