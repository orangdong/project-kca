@extends('layouts.app')
@section('isi_halaman')

<link href="{{ asset('plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css"/>
<script src="{{ asset('plugins/custom/datatables/datatables.bundle.js') }}"></script>
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="false">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Insert Kasir</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            
          <form action="{{route('insert-user-form')}}" method="POST">
            @csrf
            <div class="mb-3">
                <label class="form-label required">Nama</label>
                <input type="text" class="form-control form-control-solid" name="name" placeholder="Nama" required autocomplete="off"/>
            </div>
            <div class="mb-3">
                <label class="form-label required">Username</label>
                <input type="text" class="form-control form-control-solid" name="username" placeholder="Username" required autocomplete="off"/>
            </div>
            <div class="mb-3">
                <label class="form-label required">Phone</label>
                <input type="number" class="form-control form-control-solid" name="phone" placeholder="Nomor telepon" required autocomplete="off"/>
            </div>
            <div class="mb-3">
                <label class="form-label required">Role</label>
                <select name="role" class="form-select">
                    <option value="user">User</option>
                    <option value="admin">Admin</option>
                </select>
            </div>
            
            <div class="mb-3">
                <label class="form-label required">Password</label>
                <input type="password" class="form-control form-control-solid" name="password" required autocomplete="off"/>
            </div>
            <div class="mb-3">
                <label class="form-label required">Confirm Password</label>
                <input type="password" class="form-control form-control-solid" name="password_confirmation" required autocomplete="off"/>
            </div>
                <input type="hidden" name="toko_id" value="{{request()->input('id')}}">
          
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Insert</button>
        </form>
        </div>
      </div>
    </div>
</div>
<div class="card card-body">
    @if ($errors->any())
    	<div class="alert alert-danger" role="alert">
		<p class="fw-bolder text-gray-800 fs-6">Something Went Wrong</p>
        @foreach ($errors->all() as $error)
		<span style="color: rgb(187, 8, 8)" class="text-mute fw-bold d-block">{{$error}}</span>
    @endforeach	
		</div>
	@endif
<h2>Untuk Toko {{$toko->name}}</h2>
    <br>
<table id="user_data" class="table table-striped table-row-bordered gy-5 gs-7 border rounded">
    @php
        $i = 1;
    @endphp
    <thead>
        <tr class="fw-bolder fs-6 text-gray-800 px-7">
            <th>No</th>
            <th>Username</th>
            <th>Phone</th>
            <th>Edit</th>
            <th>Password Baru</th>
            <th>Konfirmasi Password Baru</th>
            <th>Ganti Password</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($users->where('id', '!=', $user->id) as $item)
        <tr>
            <td>{{$i++}}</td>
            <form action="{{route('edit-user-form', $item->id)}}" method="post">
                @csrf
                <td><input type="text" name="username" class="form-control" value="{{$item->username}}" /></td>
                <td><input type="number" name="phone" class="form-control" value="{{$item->phone}}" /></td>
                <td><button style="border: none;" type="submit" class="badge badge-success" >Edit</button></td>
                <input name="toko_id" type="hidden" value="{{request()->input('id')}}">
            </form>
            <form action="{{route('edit-user-password', $item->id)}}" method="post">
                @csrf
                <td><input class="form-control form-control-lg" type="password" name="password" required autocomplete="current-password" /></td>
                <td><input class="form-control form-control-lg" type="password" name="password_confirmation" required autocomplete="current-password" /></td>
                <td><button style="border: none;" type="submit" class="badge badge-danger" >Ganti Password</button></td>
                <input name="toko_id" type="hidden" value="{{request()->input('id')}}">
            </form>
        </tr>
        @endforeach
    </tbody>
</table>
</div>

<script>
    $("#user_data").DataTable({
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
<button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">Add User</button>
<!-- Modal -->
@endsection('isi_action')