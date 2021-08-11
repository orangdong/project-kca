@extends('layouts.app')
@section('isi_halaman')
<link href="{{ asset('plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css"/>
<script src="{{ asset('plugins/global/plugins.bundle.js') }}"></script>

<?php $today = date("Y-m-d") ?>
<div class="card card-body">
<h2>Untuk {{ $toko->name }}</h2>
    <br>
    <form action="{{ route('riwayat') }}" method="get">
        <label class="form-label">Tanggal Observasi</label>
        <div class="input-group mb-3">
            <input class="form-control form-control-solid" name="tanggal_observasi" placeholder="Pilih Tanggal" id="kt_datepicker_2"/>
            <div class="input-group-append">
                <input type="submit" class="btn btn-success" value="Submit"/>
            </div>
        </div>
    </form>
<br>

            @foreach($orderan as $o)           
                <div class="card">
                    <div class="card-header" style="background-color:#dee3ff;" id="heading">
                        
                        <button class="btn btn-link" style="color:#000000;" data-toggle="collapse" data-target="#collapse $order_id" aria-expanded="true" aria-controls="collapseOne">
                            ID Order: {{ $o->id }} // Kasir:  {{ $user->name }}
                        </button>
                        @if($o->metode == "tunai" or $o->metode == "Tunai")
                        <a href="{{ route('delete-orderan').'?orderan_id='.$o->id }}" onclick="return confirm('Yakin void transaksi?')" class="btn btn-sm btn-danger mb-5 mt-5" style="float:right;">Void</a>
                        @endif

                    </div>

                    <div id="collapse $order_id" class="collapse show" aria-labelledby="heading $order_id" data-parent="#accordion">
                        <div class="card-body">
                            <b>Time: </b> {{ $o->created_at }}
                            <table class="table table-striped">
                                <tr>
                                    <th>Nama</th>
                                    <th>Harga</th>
                                    <th>Jumlah</th>
                                    <th>Promo</th>
                                </tr>
                                    @foreach($o->barang_orders as $ob)
                                        <tr>
                                            <td>{{ $ob->name }}</td>
                                            <td>{{ number_format($ob->harga_satuan, 0, ".", ".") }}</td>
                                            <td>{{ $ob->jumlah }}</td>
                                            <td>
                                                <!-- Cek Semua Kondisi Promo & Tidak Promo -->
                                                @if($diskon->where('barang_order_id',$ob->id)->count() > 0)
                                                    @foreach($diskon->where('barang_order_id',$ob->id) as $d)
                                                    {{ $d->diskon."%" }}
                                                    @endforeach

                                                @elseif($special_price->where('barang_order_id',$ob->id)->count() > 0)
                                                    @foreach($special_price->where('barang_order_id',$ob->id) as $s)
                                                    {{ number_format($s->special_price, 0, ".", ".") }}
                                                    @endforeach

                                                @elseif($item_get->where('barang_order_id',$ob->id)->count() > 0)
                                                    @php $free = 0 @endphp
                                                    @foreach($item_get->where('barang_order_id',$ob->id) as $i)
                                                        @foreach($o->barang_orders->where('data_barang_id',$i->item_buy_id)->where('orderan_id',$o->id) as $k)
                                                            @php $sisa_bagi = $k->jumlah % $i->buy;
                                                            $kelipatan_bawah = ($k->jumlah - $sisa_bagi) / $i->buy;
                                                            $free = $free + ($i->get*$kelipatan_bawah); @endphp
                                                        @endforeach
                                                    @endforeach
                                                    @if($free > $ob->jumlah) @php $free = $ob->jumlah @endphp @endif
                                                    @php $no_free = $ob->jumlah-$free @endphp
                                                    <!-- Percantik View BuyGet -->
                                                    @if($free > 0 && $no_free > 0)
                                                    {{ $free." Free & ".$no_free." No" }}
                                                    @elseif($free > 0 && $no_free <= 0)
                                                    {{ $free." Free" }}
                                                    @endif
                                                @endif    
                                            </td>
                                        </tr>
                                    @endforeach
                            </table>
                            <b>
                                <span>Harga Total: Rp {{ number_format($o->harga_total, 0, ".", ".") }} 
                                    <a style="float: right;" class="btn btn-success" href="{{ route('struk').'?orderan_id='.$o->id }}">Struk</a>
                                </span>
                                <br>
                                @if($o->metode == "pending" or $o->metode == "Pending")
                                    <form action="{{ route('riwayat.edit-metode') }}" method="post">
                                        @csrf
                                        <select class="form-select form-select-solid mb-5" name="metode" style="width:200px" >
                                            <option value="{{ $o->metode }}">{{ $o->metode }}</option>
                                            @foreach($metode_pembayaran as $tm)
                                                <option value="{{ $tm->metode }}">{{ $tm->metode }}</option>
                                            @endforeach
                                        </select>
                                        <input type="hidden" name="orderan_id" value="{{ $o->id }}">
                                        <input type="submit" class="btn btn-sm btn-warning" value="Update">
                                    </form>
                                @else
                                    <span>Metode: {{ $o->metode }}</span>
                                @endif

                            </b>

                        </div>
                    </div>
                </div>
                <br>
            @endforeach
</div>

<script>
$("#kt_datepicker_2").flatpickr();
</script>

@endsection('isi_halaman')

@section('isi_action')

    @if(!empty( $tanggal_observasi ))
    <a class="btn btn-sm btn-info" href="{{ route('riwayat') }}">Tinjau: {{ $tanggal_observasi }}</a>
    @endif
@endsection('isi_action')