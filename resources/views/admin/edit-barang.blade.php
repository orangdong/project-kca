@extends('layouts.app')
@section('isi_halaman')
<h2>Untuk Toko {{$toko->name}}[{{$toko->id}}]</h2>
    <br>
    <div class="row">
        @if($errors->any())
		<div style="border-radius: 8px; font-weight: 500" class="alert alert-danger" role="alert">
			@foreach ($errors->all() as $item)
			{{$item}}
			@endforeach
    	</div>
		@endif
    </div>
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
            <div class="card card-body mt-3">
                <h2 class="mb-3">Add by CSV</h2>
                <form enctype="multipart/form-data" action="{{route('upload-csv')}}" method="post">
                    @csrf
                    <div class="mb-10">
                        <label class="required form-label">CSV</label>
                        <input type="file" name="csv" class="form-control form-control-solid" autocomplete="off" autofocus required />
                    </div>
                    <input type="hidden" name="toko_id" value="{{request()->input('id')}}">
                    <div class="mb-10">
                        <input type="submit" class="btn btn-primary" value="Add CSV"/>
                    </div>
                </form>

                <table class="table table-row-dashed table-row-gray-300 gy-7">
                    <thead>
                        <tr> 
                            <td>Name</td>
                            <td>Imported at</td>
                            <td>Action</td>
                        </tr>
                    </thead>
                    <tbody>
                            @foreach ($history_exports as $history_export)
                        <tr>
                            <td>{{$history_export->name}}</td>
                            <td>{{$history_export->imported_at}}</td>
                            @if ($history_export->imported_at)
                            <td>Imported</td>
                            @else
                            <td><a href="{{route('read-csv', $toko->id)}}?url={{$history_export->url}}&history_id={{$history_export->id}}" class="badge badge-success">Import</a></td>    
                            @endif
                            
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                
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