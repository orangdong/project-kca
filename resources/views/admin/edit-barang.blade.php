@extends('layouts.app')
@section('isi_halaman')
<h2>Untuk Toko A</h2>
    <br>
    <div class="row">
        <div class="col">
            <div class="card card-body">
                <form action="" method="post">
                    <div class="mb-10">
                        <label class="required form-label">Barcode</label>
                        <input type="number" name="barcode" class="form-control form-control-solid" autocomplete="off" autofocus required />
                    </div>
                    <div class="mb-10">
                        <input type="submit" class="btn btn-primary" value="Search by barcode"/>
                    </div>
                </form>
                <form action="" method="post">
                    <div class="mb-10">
                        <label class="required form-label">Nama Barang</label>
                        <select name="country" required data-control="select2" data-placeholder="-" class="form-select form-select-solid form-select-lg fw-bold select2-hidden-accessible">
                            <option value=""></option>
                            <option value="AF">Afghanistan</option>
                            <option value="AX">Aland Islands</option>
                            <option value="AL">Albania</option>
                        </select>
                    </div>
                    <div class="mb-10">
                        <input type="submit" class="btn btn-primary" value="Search by name"/>
                    </div>
                </form>
            </div>
        </div>
        <div class="col">
            <div class="card card-body">
                <form action="" method="post">
                    <div class="mb-10">
                        <label class="required form-label">Nama Barang</label>
                        <input type="text" name="nama" class="form-control form-control-solid" value="Tepung Terigu" autocomplete="off" required />
                    </div>
                    <div class="mb-10">
                        <label class="required form-label">Barcode</label>
                        <input type="number" name="barcode" class="form-control form-control-solid" value="123456789" autocomplete="off" required />
                    </div>
                    <div class="mb-10">
                        <label class="required form-label">Harga</label>
                        <input type="number" name="harga" class="form-control form-control-solid" value="11000" autocomplete="off" required />
                    </div>
                    <div class="mb-10">
                        <label class="required form-label">Satuan</label>
                        <input type="text" name="satuan" class="form-control form-control-solid" value="pcs" autocomplete="off" required />
                    </div>
                    <div class="mb-10">
                        <label class="required form-label">Stok</label>
                        <input type="number" name="stok" class="form-control form-control-solid" value="53" autocomplete="off" required />
                    </div>
                    <div class="mb-10">
                        <input type="submit" class="btn btn-success" value="Edit Barang"/>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection('isi_halaman')