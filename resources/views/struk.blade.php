
<html>
<!-- Main -->

<body onload="window.print()" onclick="arah()">


    <div class="card card-body" style="font-size:12px;width:150px;">
        <center>
            
            <b style="font-size:14px">House of Phyto Organic</b>
            <br><span style="font-size:12px">-PT Merpati Mahardika-</span><br><br>
            <span onclick="window.print()">Ruko L'Grande<br>Jakarta Selatan</span><br>
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
                @foreach($orderan->barang_orders as $o)
                <tr>
                    <td style="word-break: break-all;">{{ $o->name }}<br>@ {{ number_format($o->harga_satuan , 0, ".", ".") }} </td>
                    <td>{{ $o->jumlah }}</td>
                    <td>{{ number_format($o->harga_subtotal , 0, ".", ".") }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <center>------------------------------------</center>
        
        
            <span><b>Total: Rp {{ number_format($orderan->harga_total , 0, ".", ".") }}</b></span>

	   <br><br>
        Metode: {{ $orderan->metode }}<br>
        Bayar: Rp {{ number_format($orderan->uang_masuk , 0, ".", ".") }}<br>
        Kembalian: Rp {{ number_format($orderan->uang_kembali , 0, ".", ".") }}
        <br><br>
        <center>
                -- Terima Kasih --
                <br>
                Telp/WA {{ $toko->phone }}
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