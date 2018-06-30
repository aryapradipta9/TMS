@extends('layouts.main')

@section('judul-halaman')
Tabel Warehouse
@endsection

@section('additional-header')
<a class="btn btn-danger"> Hapus </a>
<a class="btn btn-primary" href="{{ route('vendor-form') }}" type="button"> Input </a>
@endsection

@section('main-content')

@if($vendors->count() > 0)
{{ Form::open(['route' => 'vendor-delete']) }}
  <table class="table table-responsive" id="vendor-table">
      <thead>
          <tr>
              <th> </th>
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
                <td> {{ Form::checkbox('pick[]', $vendor->id, false) }} </td>
                <td> {{$vendor->nama}} </td>
                <td> {{$vendor->alamat}} </td>
                <td> {{$vendor->mail}} </td>
                <td> {{$vendor->telp}} </td>
                <td> {{$vendor->contact}} </td>
            </tr>
           @endforeach
     </tbody>
  </table>
  {{ Form::submit('Remove', ['class' => 'btn btn-danger']) }}</div>
  {{ Form::close() }}
  <script>
    //   $(document).ready(function() {
        $('#vendor-table').dynatable();
    //   });
      
  </script>
@else
  <p> No vendor found..</p>
@endif
@endsection