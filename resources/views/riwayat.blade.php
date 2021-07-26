@extends('layouts.app')
@section('isi_halaman')

<div class="card card-body">
<h2>Untuk Toko A</h2>
    <br>
                <div class="card">
                    <div class="card-header" style="background-color:#dee3ff;" id="heading">
                        
                        <button class="btn btn-link" style="color:#000000;" data-toggle="collapse" data-target="#collapse $order_id" aria-expanded="true" aria-controls="collapseOne">
                            Kode Order:  123 // Username:  kasir1
                        </button>
                        

                    </div>

                    <div id="collapse $order_id" class="collapse show" aria-labelledby="heading $order_id" data-parent="#accordion">
                        <div class="card-body">
                            <b>Tanggal: </b> 24 Agustus 2021  // <b>Jam: </b> 24:53:35
                            <table class="table table-striped">
                                <tr>
                                    <th>Nama</th>
                                    <th>Harga</th>
                                    <th>Jumlah</th>
                                    <th>Subtotal</th>
                                </tr>
                                    <tr>
                                        <td>Tepung Terigu</td>
                                        <td>Rp 1.000/pcs</td>
                                        <td>3</td>
                                        <td>Rp 3.000</td>
                                    </tr>
                            </table>
                            <b>
                                <span>Harga Total: Rp 300.000 <a style="float: right;" class="btn btn-success" href="struk.php?kode_order= $kode_order">Struk</a></span>
                                <br>
                                <span>Metode: QRIS</span>
                                    <br>
                                    <span>Harga: Rp 200.000</span>

                            </b>

                        </div>
                    </div>
                </div>
</div>

@endsection('isi_halaman')