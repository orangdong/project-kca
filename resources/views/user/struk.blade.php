
<html>
<!-- Main -->

<body onload="window.print()" onclick="arah()">


    <div class="card card-body" style="font-size:12px;width:150px;">
        <center>
            <img style="width:auto;" src="{{ asset('media/logos/main-logo.svg') }}"><br><br>
            <span>{{ $toko->lokasi }}<br>DKI Jakarta</span><br>
            ------------------------------------
        </center>

        

        <table style="font-size:12px;">
            <thead>
                <tr>
                    <th>Barang</th>
                    <th>Qty</th>
                    <th>Price</th>
                </tr>
            </thead>
            <tbody>
                @php $total = 0 @endphp
                @foreach($orderan->barang_orders as $ob)
                    <!-- Cek Semua Kondisi Promo & Tidak Promo -->
                    @if($diskon->where('barang_order_id',$ob->id)->count() > 0)
                        @foreach($diskon->where('barang_order_id',$ob->id) as $d)
                        <tr>
                            <td style="word-break: break-all;">{{ $ob->name }}<br>@ {{ number_format($ob->harga_satuan , 0, ".", ".") }} </td>
                            <td>{{ $ob->jumlah }}</td>
                            <td>{{ number_format($ob->harga_subtotal , 0, ".", ".") }}</td>
                        </tr>
                        <tr>
                            <td style="word-break: break-all;" colspan="2">Diskon {{ $d->diskon."%" }}</td>
                            <td>{{ "-".number_format($d->diskon/100*$ob->harga_subtotal , 0, ".", ".") }}</td>
                        </tr>
                        @php $total = $total + (100-$d->diskon)/100*$ob->harga_subtotal @endphp
                        @endforeach

                    @elseif($special_price->where('barang_order_id',$ob->id)->count() > 0)
                        @foreach($special_price->where('barang_order_id',$ob->id) as $s)
                        <tr>
                            <td style="word-break: break-all;">{{ $ob->name }}<br>@ {{ number_format($s->special_price, 0, ".", ".") }} </td>
                            <td>{{ $ob->jumlah }}</td>
                            <td>{{ number_format($s->special_price*$ob->jumlah , 0, ".", ".") }}</td>
                        </tr>
                        @php $total = $total + $s->special_price*$ob->jumlah @endphp
                        @endforeach

                    @elseif($item_get->where('barang_order_id',$ob->id)->count() > 0)
                        @php $free = 0 @endphp
                        @foreach($item_get->where('barang_order_id',$ob->id) as $i)
                            @foreach($orderan->barang_orders->where('data_barang_id',$i->item_buy_id)->where('orderan_id',$orderan->id) as $k)
                                @php $sisa_bagi = $k->jumlah % $i->buy;
                                $kelipatan_bawah = ($k->jumlah - $sisa_bagi) / $i->buy;
                                $free = $free + ($i->get*$kelipatan_bawah); @endphp
                            @endforeach
                        @endforeach
                        @if($free > $ob->jumlah) @php $free = $ob->jumlah @endphp @endif
                        @php $no_free = $ob->jumlah-$free @endphp
                        <!-- Percantik View BuyGet -->
                        @if($free > 0 && $no_free > 0)
                            <tr>
                                <td style="word-break: break-all;">{{ $ob->name }}<br>@ 0</td>
                                <td>{{ $free }}</td>
                                <td>0</td>
                            </tr>
                            <tr>
                                <td style="word-break: break-all;">{{ $ob->name }}<br>@ {{ number_format($ob->harga_satuan , 0, ".", ".") }} </td>
                                <td>{{ $no_free }}</td>
                                <td>{{ number_format($ob->harga_satuan*$no_free , 0, ".", ".") }}</td>
                            </tr>
                            @php $total = $total + $ob->harga_satuan*$no_free @endphp
                        @elseif($free > 0 && $no_free <= 0)
                            <tr>
                                <td style="word-break: break-all;">{{ $ob->name }}<br>@ 0</td>
                                <td>{{ $free }}</td>
                                <td>0</td>
                            </tr>
                        @endif
                    @else
                        <tr>
                            <td style="word-break: break-all;">{{ $ob->name }}<br>@ {{ number_format($ob->harga_satuan , 0, ".", ".") }} </td>
                            <td>{{ $ob->jumlah }}</td>
                            <td>{{ number_format($ob->harga_subtotal , 0, ".", ".") }}</td>
                        </tr>
                        @php $total = $total + $ob->harga_subtotal @endphp
                    @endif
                @endforeach
            </tbody>
        </table>
        <center>------------------------------------</center>
        
        
            <span><b>Total: Rp {{ number_format($orderan->harga_total , 0, ".", ".") }}</b></span>
            @if($orderan->member_id !== 0)
                <br>
                Hemat Member: Rp {{ number_format($total-$orderan->harga_total , 0, ".", ".") }}
            @endif


	   <br><br>
        Metode: {{ $orderan->metode }}<br>
        Bayar: Rp {{ number_format($orderan->uang_masuk , 0, ".", ".") }}<br>
        Kembalian: Rp {{ number_format($orderan->uang_kembali , 0, ".", ".") }}
        <br><br>
        <center>
                -- Terima Kasih --
                <br>
                Telp {{ $toko->phone }}
                <br>
                {{ explode(" ",$orderan->created_at)[0] }}
                <br>
                {{ explode(" ",$orderan->created_at)[1] }}
        </center>
    </div>

        </body>


<script>

function arah(){
    document.location.href="{{ route('dashboard') }}";
}

</script>
</html>