@extends('layouts.app')
@section('isi_halaman')

<div class="card card-body">
    <table class="table table-row-dashed table-row-gray-300 gy-7">
        <thead>
            <tr>
                <td>No</td>
                <td>Toko</td>
                <td>Lokasi</td>
                <td>Phone</td>
                <td>Action</td>
            </tr>
        </thead>
        <tbody>
            <tr>
                <form action="">
                    <td>1</td>
                    <td><input type="text" class="form-control form-control-solid" name="toko" value="Toko A"/></td>
                    <td><input type="text" class="form-control form-control-solid" name="lokasi" value="Jalan Jakarta"/></td>
                    <td><input type="number" class="form-control form-control-solid" name="phone" value="08612641246"/></td>
                    <td><a type="submit" class="badge badge-success">Edit</a></td>
                </form>
            </tr>
        </tbody>
        <tfoot>
            <tr>
                <form action="">
                    <td>Add</td>
                    <td><input type="text" class="form-control form-control-solid" name="toko"/></td>
                    <td><input type="text" class="form-control form-control-solid" name="lokasi" /></td>
                    <td><input type="number" class="form-control form-control-solid" name="phone"/></td>
                    <td><a type="submit" class="badge badge-primary">Tambahkan</a></td>
                </form>
            </tr>
        </tfoot>
    </table>
</div>

@endsection('isi_halaman')