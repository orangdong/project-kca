@extends('layouts.app')
@section('isi_halaman')

<div class="card card-body">
    <h2>Untuk Toko {{$toko->name}}</h2>
    <br>
    <form action="{{route('insert-metode', request()->input('id'))}}" method="POST">
        @csrf
        <div class="input-group mb-3">
            <input type="text" name="metode" class="form-control form-control-solid" autocomplete="off" required />
            <input type="hidden" name="toko_id" value="{{$toko->id}}">
            <div class="input-group-append">
                <button type="submit" class="ms-3 btn btn-success">Tambahkan</button>
            </div>
        </div>
    </form>
    <br>
    <div class="col-6">
    <table class="table table-striped">
        @php
            $i = 1;
        @endphp
        <thead>
            <tr>
                <td>No</td>
                <td>Metode Pembayaran</td>
                <td>Hapus</td>
            </tr>
        </thead>
        <tbody>
            @foreach ($metodes as $item)
            <tr>
                <td>{{$i++}}</td>
                <td>{{$item->metode}}</td>
                <td><a href="{{route('delete-metode', $item->id)}}?toko_id={{request()->input('id')}}" class="badge badge-danger">Hapus</a></td>
            </tr>
            @endforeach
            
        </tbody>
    </table>
    </div>
</div>

@endsection('isi_halaman')