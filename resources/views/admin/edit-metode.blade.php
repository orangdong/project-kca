@extends('layouts.app')
@section('isi_halaman')

<div class="card card-body">
    <h2>Untuk Toko A</h2>
    <br>
    <form action="">
        <div class="input-group mb-3">
            <input type="text" name="metode_pembayaran" class="form-control form-control-solid" autocomplete="off" required />
            <div class="input-group-append">
                <input type="submit" class="btn btn-success" value="Tambahkan"/>
            </div>
        </div>
    </form>
    <br>
    <div class="col-6">
    <table class="table table-striped">
        <thead>
            <tr>
                <td>No</td>
                <td>Metode Pembayaran</td>
                <td>Hapus</td>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>1</td>
                <td>QRIS</td>
                <td><a class="badge badge-danger">Hapus</a></td>
            </tr>
        </tbody>
    </table>
    </div>
</div>

@endsection('isi_halaman')