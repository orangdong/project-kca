@extends('layouts.app')
@section('isi_halaman')

<div class="card">
    <div class="card-body">
        <form action="{{ route('insert-member') }}" method="post">
            @csrf
            <div class="mb-10">
                <label for="" class="form-label required">Nama</label>
                <input type="text" name="name" class="form-control form-control-solid" autocomplete="off" required>
            </div>
            <div class="mb-10">
                <label for="" class="form-label required">Nomor HP</label>
                <input type="text" name="phone" class="form-control form-control-solid" autocomplete="off" required>
            </div>
            <div class="mb-10">
                <label for="" class="form-label">Alamat</label>
                <textarea name="alamat" class="form-control form-control-solid" autocomplete="off"></textarea>
            </div>
            <div class="mb-10">
                <label for="" class="form-label ">NIK</label>
                <input type="number" name="nik" class="form-control form-control-solid" autocomplete="off">
            </div>
            <div class="mb-10">
                <label for="" class="form-label ">Email</label>
                <input type="text" name="email" class="form-control form-control-solid" autocomplete="off">
            </div>
            <div class="mb-10">
                <input type="hidden" name="orderan_id" value="{{ $orderan_id }}">
                <input type="submit" class="btn btn-success">
            </div>
        </form>
    </div>
</div>

@endsection('isi_halaman')