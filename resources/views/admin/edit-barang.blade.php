@extends('layouts.app')
@section('isi_halaman')
<h2>Untuk Toko {{$toko->name}}</h2>
    <br>
    <div class="row">
        <div class="col">
            <div class="card card-body">
                <form action="{{route('edit-barang-barcode')}}" method="post">
                    @csrf
                    <div class="mb-10">
                        <label class="required form-label">Barcode</label>
                        <input type="number" name="barcode" class="form-control form-control-solid" autocomplete="off" autofocus required />
                    </div>
                    <input type="hidden" name="toko_id" value="{{request()->input('id')}}">
                    <div class="mb-10">
                        <input type="submit" class="btn btn-primary" value="Search by barcode"/>
                    </div>
                </form>
                <form action="{{route('edit-barang-barcode')}}" method="post">
                    @csrf
                    <div class="mb-10">
                        <label class="required form-label">Nama Barang</label>
                        <select name="barcode" required data-control="select2" data-placeholder="-" class="form-select form-select-solid form-select-lg fw-bold select2-hidden-accessible">
                            <option value=""></option>
                            @foreach ($barangs as $item)
                                <option value="{{$item->barcode}}">{{$item->name}}</option>
                            @endforeach
                        </select>
                        <input type="hidden" name="toko_id" value="{{request()->input('id')}}">
                    </div>
                    <div class="mb-10">
                        <input type="submit" class="btn btn-primary" value="Search by name"/>
                    </div>
                </form>
                <div class="mb-10">
                    <a href="#" class="btn btn-info">Add New Item</a>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card card-body">
                <form action="{{route('edit-barang-form')}}" method="post">
                    @csrf
                    @if ($barang)
                    <div class="mb-10">
                        <label class="required form-label">Nama Barang</label>
                        <input type="text" name="name" class="form-control form-control-solid" value="{{$barang->name}}" autocomplete="off" required />
                    </div>
                    <div class="mb-10">
                        <label class="required form-label">Barcode</label>
                        <input type="number" name="barcode" class="form-control form-control-solid" value="{{$barang->barcode}}" autocomplete="off" required />
                    </div>
                    <div class="mb-10">
                        <label class="required form-label">Harga</label>
                        <input type="number" name="harga" class="form-control form-control-solid" value="{{$barang->harga_satuan}}" autocomplete="off" required />
                    </div>
                    <div class="mb-10">
                        <label class="required form-label">Satuan</label>
                        <input type="text" name="satuan" class="form-control form-control-solid" value="{{$barang->satuan}}" autocomplete="off" required />
                    </div>
                    <div class="mb-10">
                        <label class="required form-label">Stok</label>
                        <input type="number" name="stok" class="form-control form-control-solid" value="{{$barang->stok}}" autocomplete="off" required />
                    </div>
                    <input type="hidden" value="{{$barang->id}}" name="barang_id">
                    @else
                    <div class="mb-10">
                        <label class="required form-label">Nama Barang</label>
                        <input type="text" name="name" class="form-control form-control-solid" autocomplete="off" required disabled/>
                    </div>
                    <div class="mb-10">
                        <label class="required form-label">Barcode</label>
                        <input type="number" name="barcode" class="form-control form-control-solid" autocomplete="off" required disabled/>
                    </div>
                    <div class="mb-10">
                        <label class="required form-label">Harga</label>
                        <input type="number" name="harga" class="form-control form-control-solid" autocomplete="off" required disabled/>
                    </div>
                    <div class="mb-10">
                        <label class="required form-label">Satuan</label>
                        <input type="text" name="satuan" class="form-control form-control-solid" autocomplete="off" required disabled/>
                    </div>
                    <div class="mb-10">
                        <label class="required form-label">Stok</label>
                        <input type="number" name="stok" class="form-control form-control-solid" autocomplete="off" required disabled/>
                    </div>    
                    @endif
                    
                    <div class="mb-10">
                        <input type="submit" class="btn btn-success" value="Edit Barang"/>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection('isi_halaman')