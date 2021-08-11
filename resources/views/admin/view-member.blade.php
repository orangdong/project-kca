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
<h2>Member List</h2>
    <br>
<table id="member_data" class="table table-striped table-row-bordered gy-5 gs-7 border rounded">
    @php
        $i = 1;
    @endphp
    <thead>
        <tr class="fw-bolder fs-6 text-gray-800 px-7">
            <th>No</th>
            <th>Kode Member</th>
            <th>Nama</th>
            <th>Phone</th>
            <th>Alamat</th>
            <th>NIK</th>
            <th>Email</th>
            <th>Jumlah Orderan</th>
            <th>Total Belanja</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($members as $item)
        <tr>
            <td>{{$i++}}</td>
            <td>{{$item->kode_member}}</td>
            <td>{{$item->name}}</td>
            <td>{{$item->phone}}</td>
            <td>{{$item->alamat}}</td>
            <td>{{$item->nik}}</td>
            <td>{{$item->email}}</td>
            <td>{{$item->orderans_count}}</td>
            <td>{{$item->orderans_sum_harga_total}}</td>
        </tr>
        @endforeach
    </tbody>
</table>
</div>

<script>
    $("#member_data").DataTable({
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

@section('isi_action')
<a href="#" class="btn btn-sm btn-primary">Download PDF</a>
<!-- Modal -->
@endsection('isi_action')