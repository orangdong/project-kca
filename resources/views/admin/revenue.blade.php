@extends('layouts.app')
@section('isi_halaman')

<link href="{{ asset('plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css"/>
<script src="{{ asset('plugins/global/plugins.bundle.js') }}"></script>
@php $today = Carbon\Carbon::today() @endphp
<div class="row">
    <div class="col">
        <div class="card card-body">
            <h2>Keseluruhan</h2>
            <br>
            <ul>
                <li>Pemasukan {{ $today->format('l, d F Y') }}: Rp 3.000</li>
                <li>Pemasukan bulan {{ $today->format('F Y') }}: Rp 4.000</li>
                <li>Pemasukan tahun {{ $today->format('Y') }}: Rp 3.000</li>
            </ul>
            <br>
            <form action="{{ route('revenue') }}" method="get">
                <label class="form-label">Masukkan Tanggal Analisa</label>
                <div class="input-group mb-3">
                    <input class="form-control form-control-solid" name="tanggal1" placeholder="Pilih Tanggal" id="kt_datepicker_1"/>
                    <div class="input-group-append">
                        <input type="submit" class="btn btn-success" value="Submit"/>
                    </div>
                </div>
            </form>
            <br>
            @if(!empty($tanggal1))
            <ul>
                <li>Pemasukan tanggal 26 Juli 2021: Rp 3.000</li>
                <li>Pemasukan bulan Juli 2021: Rp 4.000</li>
                <li>Pemasukan tahun 2021: Rp 3.000</li>
            </ul>
            @endif
        </div>
    </div>
    <div class="col">
        <div class="card card-body">
            <form action="{{ route('revenue') }}" method="get">
                <label class="required form-label">Pilih Toko</label>
                <div class="row">
                    <div class="col-8">
                        <select name="toko_id" style="width:200px" data-control="select2" data-placeholder="-" class="form-select form-select-solid fw-bold select2-hidden-accessible">
                            <option value=""></option>
                            @foreach ($list_toko as $t)
                                <option value="{{$t->id}}">{{$t->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col">
                        <input type="submit" class="btn btn-success" value="Submit"/>
                    </div>
                </div>
                
                
                
            </form>
            <br>
            @if(!empty($toko))
            <ul>
                <li>Pemasukan {{ $today->format('l, d F Y') }}: Rp 3.000</li>
                <li>Pemasukan bulan {{ $today->format('F Y') }}: Rp 4.000</li>
                <li>Pemasukan tahun {{ $today->format('Y') }}: Rp 3.000</li>
            </ul>
            @endif
            <br>
            <form action="{{ route('revenue') }}" method="get">
                <label class="form-label">Masukkan Tanggal Analisa</label>
                <div class="input-group mb-3">
                    <input class="form-control form-control-solid" name="tanggal2" placeholder="Pilih Tanggal" id="kt_datepicker_2"/>
                    <div class="input-group-append">
                        <input type="submit" class="btn btn-success" value="Submit"/>
                    </div>
                </div>
            </form>
            <br>
            @if(!empty($tanggal2))
            <ul>
                <li>Pemasukan tanggal 26 Juli 2021: Rp 3.000</li>
                <li>Pemasukan bulan Juli 2021: Rp 4.000</li>
                <li>Pemasukan tahun 2021: Rp 3.000</li>
            </ul>
            @endif
        </div>
    </div>
</div>
<script>
    $("#kt_datepicker_1").flatpickr();
    $("#kt_datepicker_2").flatpickr();
</script>
@endsection('isi_halaman')

@section('isi_action')
<a href="{{ route('revenue') }}" class="btn btn-sm btn-info">Reset</a>
@endsection('isi_action')