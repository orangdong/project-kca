@extends('layouts.app')
@section('isi_halaman')

<link href="{{ asset('plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css"/>
<script src="{{ asset('plugins/custom/datatables/datatables.bundle.js') }}"></script>

<div class="card card-body">
<h2>Untuk Toko A</h2>
    <br>
<table id="user_data" class="table table-striped table-row-bordered gy-5 gs-7 border rounded">
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
        <tr>
            <td>1</td>
            <form action="/edit_user_info?id=" method="post">
                <td><input type="text" name="username" class="form-control" value="kasir1" /></td>
                <td><input type="number" name="phone" class="form-control" value="08736587686" /></td>
                <td><a type="submit" class="badge badge-success" >Edit</a></td>
            </form>
            <form action="/ganti_password?id=" method="post">
                <td><input class="form-control form-control-lg" type="password" name="password_baru" required autocomplete="current-password" /></td>
                <td><input class="form-control form-control-lg" type="password" name="confirm_password_baru" required autocomplete="current-password" /></td>
                <td><a type="submit" class="badge badge-danger" >Ganti Password</a></td>
            </form>
        </tr>
    </tbody>
    <tfoot>
        <tr>
            <td>Add</td>
            <form action="/tambah_user" method="post">
                <td><input type="text" name="username" class="form-control" /></td>
                <td><input type="number" name="phone" class="form-control" /></td>
                <td>
                    <select required class="form-select form-select-solid" data-control="select2" data-placeholder="Role" data-hide-search="true" data-select2-id="select2-data-18-0jcq" tabindex="-1" aria-hidden="true">
                        <option value="" data-select2-id="select2-data-18-0jcq"></option>
                        <option value="user">User</option>
                        <option value="admin">Admin</option>
                    </select>
                </td>
                <td><input class="form-control form-control-lg" type="password" name="password_baru" required autocomplete="current-password" /></td>
                <td><input class="form-control form-control-lg" type="password" name="confirm_password_baru" required autocomplete="current-password" /></td>
                <td><a type="submit" class="badge badge-primary" >Tambah User</a></td>
            </form>
        </tr>
    </tfoot>
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