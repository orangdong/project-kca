@extends('layouts.app')
@section('isi_halaman')

<link href="{{ asset('plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css"/>
<script src="{{ asset('plugins/global/plugins.bundle.js') }}"></script>

<div class="card card-body">
    <h2>Untuk Toko A</h2>
    <br>
    <ul>
        <li>Pemasukan hari ini: Rp 3.000</li>
        <li>Pemasukan bulan ini: Rp 4.000</li>
        <li>Pemasukan tahun ini: Rp 3.000</li>
    </ul>
    <br>
    <form action="">
        <label class="form-label">Masukkan Tanggal Analisa</label>
        <div class="input-group mb-3">
            <input class="form-control form-control-solid" name="tanggal_observasi" placeholder="Pilih Tanggal" id="kt_datepicker_2"/>
            <div class="input-group-append">
                <input type="submit" class="btn btn-success" value="Submit"/>
            </div>
        </div>
    </form>
    <br>
    <ul>
        <li>Pemasukan tanggal 26 Juli 2021: Rp 3.000</li>
        <li>Pemasukan bulan Juli 2021: Rp 4.000</li>
        <li>Pemasukan tahun 2021: Rp 3.000</li>
    </ul>
</div>
<script>
    $("#kt_datepicker_2").flatpickr();
</script>
@endsection('isi_halaman')