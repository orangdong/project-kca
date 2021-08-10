@extends('layouts.app')
@section('isi_halaman')

<link href="{{ asset('plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css"/>
<script src="{{ asset('plugins/custom/datatables/datatables.bundle.js') }}"></script>

<div class="card card-body">
    @if ($errors->any())
    	<div class="alert alert-danger" role="alert">
		<p class="fw-bolder text-gray-800 fs-6">Something Went Wrong</p>
        @foreach ($errors->all() as $error)
		<span style="color: rgb(187, 8, 8)" class="text-mute fw-bold d-block">{{$error}}</span>
    @endforeach	
		</div>
	@endif
<h2>Untuk {{$toko->name}}</h2>
    <br>
<table id="view_barang" class="table table-striped table-row-bordered gy-5 gs-7 border rounded">
    @php
        $i = 1;
    @endphp
    <thead>
        <tr class="fw-bolder fs-6 text-gray-800 px-7">
            <th>No</th>
            <th>Barcode</th>
            <th>Nama</th>
            <th>Harga</th>
            <th>Satuan</th>
            <th>Stok</th>
            <th>Edit</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($data_barang as $db)
        <tr>
            <td>{{$i++}}</td>
            <td>{{ $db->barcode }}</td>
            <td>{{ $db->name }}</td>
            <td>{{ $db->harga_satuan }}</td>
            <td>{{ $db->satuan }}</td>
            <td>{{ $db->stok }}</td>
            <td><a href="{{ route('edit-barang').'?id='.$toko->id.'&barang_id='.$db->id }}" class="btn btn-sm btn-primary">Edit</a></td>
        </tr>
        @endforeach
        @foreach ($parcel as $p)
        <tr>
            <td>{{$i++}}</td>
            <td>{{ $p->barcode }}</td>
            <td>{{ $p->name }}</td>
            <td>{{ $p->harga_satuan }}</td>
            <td>pcs</td>
            <td>{{ $p->stok }}</td>
            <td><a href="{{ route('edit-barang').'?id='.$toko->id.'&barang_id='.$p->id }}" class="btn btn-sm btn-primary">Edit</a></td>
        </tr>
        @endforeach
    </tbody>
</table>
</div>

<script>
    $("#view_barang").DataTable({
 "language": {
  "lengthMenu": "Show _MENU_",
 },
 "dom":
  "<'row'" +
  "<'col-sm-6 d-flex align-items-center justify-conten-start'l>" +
  "<'col-sm-6 d-flex align-items-center justify-content-end'f>" +
  ">" +

  "<'table-responsive'tr>" +

  "<'row'" +
  "<'col-sm-12 col-md-5 d-flex align-items-center justify-content-center justify-content-md-start'i>" +
  "<'col-sm-12 col-md-7 d-flex align-items-center justify-content-center justify-content-md-end'p>" +
  ">"
});
</script>

@endsection('isi_halaman')
