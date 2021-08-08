@extends('layouts.app')
@section('isi_halaman')

<div class="row">
    <div class="col">
        <!-- begin::Card -->
        <div class="card">
	    <div class="card-body">
            <div class="mb-10">
                <form action="" method="post">
                <label class="required form-label">Barcode</label>
                <input type="number" name="barcode" class="form-control form-control-solid" autocomplete="off" autofocus required />
                </form>
            </div>
            <!-- <div class="mb-10">
                <label class="required form-label">Total Belanja</label>
                <input type="hidden" name="total_harga" value="<?= "30000" ?>"/>
                <input type="text" class="form-control form-control-solid" value="<?="Rp ".number_format("30000", 0, ".", ".") ?>" disabled required />
            </div> -->
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
                    <input type="submit" class="btn btn-primary" value="Add by name"/>
                </div>
            </form>
            <div class="separator border-3 my-10"></div>
            <form action="" method="post">
                <div class="mb-10">
                    <label class="required form-label">Toko Tujuan</label>
                    <select name="country" required data-control="select2" data-placeholder="-" class="form-select form-select-solid form-select-lg fw-bold select2-hidden-accessible">
                        <option value=""></option>
                        <option value="AF">PIK</option>
                        <option value="AX">Sunrise</option>
                        <option value="AL">Gading</option>
                    </select>
                </div>
                <div class="mb-10">
                    <input type="submit" class="btn btn-success" value="Migrasi"/>
                </div>
            </form>
        
      </div>
      </div>
      <!-- end::Card -->
    </div>
    <div class="col">
      <!-- begin::Card -->
      <div class="card">
	    <div class="card-body">
        <div class="table-responsive">
            <div class="">
                <table class="table table-striped table-row-dashed table-row-gray-300 gy-7">
                    <thead>
                        <tr class="fw-bolder fs-6 text-gray-800">
                            <th>No</th>
                            <th>Nama</th>
                            <th>Harga</th>
                            <th>Jumlah</th>
                            <th>+</th>
                            <th>-</th>
                            <th>Hapus</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>Tepung Terigu</td>
                            <td>Rp 9.000/pcs</td>
                            <td>2</td>
                            <td><button class='plus-item badge badge-info input-group-addon' id="tomboltambah" barcode="1">+</button></td>
                            <td><button class='minus-item input-group-addon badge badge-warning' id="tombolkurangi" barcode="2">-</button></td>
                            <td><button class='delete-item badge badge-danger' id="tombolhapus" barcode="3">X</button></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
      </div>
      </div>
      <!-- end::Card -->
    </div>
</div>

@endsection('isi_halaman')