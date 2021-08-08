@extends('layouts.app')
@section('isi_halaman')
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="false">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Insert Toko</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="{{route('insert-toko-form')}}" method="POST">
            @csrf
            <div class="mb-3">
                <label class="form-label required">Nama toko</label>
                <input type="text" class="form-control form-control-solid" name="name" placeholder="Nama toko" required autocomplete="off"/>
            </div>
            <div class="mb-3">
                <label class="form-label required">Lokasi toko</label>
                <textarea class="form-control form-control-solid" name="lokasi"  rows="3" placeholder="Lokasi toko" required></textarea>
            </div>
            <div class="mb-3">
                <label class="form-label required">Nomor telepon</label>
                <input type="number" class="form-control form-control-solid" name="phone" placeholder="Nomor telepon" required autocomplete="off"/>
            </div>
                
          
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
    <table class="table table-row-dashed table-row-gray-300 gy-7">
        <thead>
            <tr>
                @php
                    $i = 1;
                @endphp
                <td>No</td>
                <td>Toko</td>
                <td>Lokasi</td>
                <td>Phone</td>
                <td>Action</td>
            </tr>
        </thead>
        <tbody>
                @foreach ($tokos as $toko)
            <tr>
                <td style="text-align: center">{{$i++}}</td>
                <form action="{{route('edit-toko-form', $toko->id)}}" method="POST">
                    @csrf
                <td><input type="text" class="form-control form-control-solid" name="name" value="{{$toko->name}}"/></td>
                <td><input type="text" class="form-control form-control-solid" name="lokasi" value="{{$toko->lokasi}}"/></td>
                <td><input type="number" class="form-control form-control-solid" name="phone" value="{{$toko->phone}}"/></td>
                <td><button type="submit" style="border: none" class="badge badge-success">Edit</button></td>
            </form>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection('isi_halaman')

@section('isi_action')
<button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
    Insert Toko
  </button>
  
@endsection