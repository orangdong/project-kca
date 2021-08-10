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
        <div class="col-4">
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
        <div class="col-8">
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
                    <h2 class="mb-3">Promo</h2>
                    <div class="mb-10">
                        <div class="d-flex flex-row">
                            <div class="d-flex flex-column w-100">
                                <label class="required form-label">Diskon</label>
                                <div class="input-group">
                                    @if (!$barang->diskon)
                                    <input type="number" name="diskon" class="form-control form-control-solid" autocomplete="off" />
                                    @else
                                    <input type="number" name="diskon" class="form-control form-control-solid" value="{{$barang->diskon->diskon}}" autocomplete="off" />
                                    @endif
                                    <span class="btn btn-secondary">%</span>
                                </div>
                            </div>
                            <div class="d-flex flex-column w-100">
                                <label class="required form-label">Diskon Until</label>
                                @if (!$barang->diskon)
                                <input type="date" name="diskon_until" class="form-control form-control-solid ms-3"> 
                                @else
                                <input type="date" name="diskon_until" value="{{$barang->diskon->valid_until}}" class="form-control form-control-solid ms-3">
                                @endif
                                
                            </div>
                        </div>
                    </div>
                    <div class="mb-10">
                        <div class="d-flex flex-row">
                            <div class="d-flex flex-column w-100">
                                <label class="required form-label">Special Price</label>
                                @if (!$barang->special_price)
                                <input type="number" name="special_price" class="form-control form-control-solid" autocomplete="off" />
                                @else
                                <input type="number" name="special_price" class="form-control form-control-solid" value="{{$barang->special_price->special_price}}" autocomplete="off" />
                                @endif
                                
                            </div>
                            <div class="d-flex flex-column w-100">
                                
                                <label class="required form-label">Special Until</label>
                                @if (!$barang->special_price)
                                <input type="date" name="special_until" class="form-control form-control-solid ms-3">
                                @else
                                <input type="date" name="special_until" value="{{$barang->special_price->valid_until}}" class="form-control form-control-solid ms-3">
                                @endif
                                
                            </div>
                            
                        </div>
                        
                    </div>
                    <div class="mb-10 d-flex flex-row">
                        <div class="d-flex flex-row me-3 justify-content-between col-4">
                            <div class="d-flex flex-column w-100 me-3">
                                <label class="required form-label">Jumlah buy</label>
                                @if (!$barang->buy_get)
                                <input type="number" name="buy" class="form-control form-control-solid" autocomplete="off" />
                                @else
                                <input type="number" value="{{$barang->buy_get->buy}}" name="buy" class="form-control form-control-solid" autocomplete="off" />
                                @endif
                                
                            </div>
                            <div class="d-flex flex-column w-100">
                                <label class="required form-label">Jumlah get</label>
                                @if (!$barang->buy_get)
                                <input type="number" name="get" class="form-control form-control-solid" autocomplete="off" />
                                @else
                                <input type="number" name="get" value="{{$barang->buy_get->get}}" class="form-control form-control-solid" autocomplete="off" />
                                @endif
                                
                            </div>
                        </div>
                        <div class="d-flex flex-row justify-content-between col-8">
                            <div class="d-flex flex-column w-100">
                                <label class="required form-label">Item get</label>
                                <select name="item_get_id" data-control="select2" data-placeholder="-" class="form-select form-select-solid form-select-lg fw-bold select2-hidden-accessible">
                                    @if (!$barang->buy_get)
                                    <option value=""></option>
                                    @foreach ($barangs as $item)
                                        <option value="{{$item->id}}">{{$item->name}}</option>
                                    @endforeach
                                    @else
                                    <option value="{{$barang->buy_get->item_get_id}}">
                                    @foreach ($barangs->where('id', $barang->buy_get->item_get_id) as $b)
                                        {{$b->name}}
                                    @endforeach    
                                    
                                    </option>
                                    @foreach ($barangs->where('id', '!=',$barang->buy_get->item_get_id) as $item)
                                        <option value="{{$item->id}}">{{$item->name}}</option>
                                    @endforeach
                                    @endif
                                    
                                </select>
                            </div>
                            <div class="d-flex flex-column w-100 me-5">
                                <label class="required form-label">Valid Until</label>
                                @if (!$barang->buy_get)
                                <input type="date" name="valid_until" class="form-control form-control-solid ms-3">
                                @else
                                <input type="date" name="valid_until" value="{{$barang->buy_get->valid_until}}" class="form-control form-control-solid ms-3">
                                @endif
                                
                            </div>
                        </div>
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