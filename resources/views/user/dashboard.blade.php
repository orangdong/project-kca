@extends('layouts.app')
@section('isi_halaman')

<style>
  .edit-button:hover{
    color: white !important;
  }
  
</style>

<div class="row">
    <div class="col-5">
      <!-- begin::Card -->
      <div class="card">
	    <div class="card-body">
        <div class="mb-10">
          <form action="{{ route('add-basket')}}" method="post">
            @csrf
            <label class="required form-label">Barcode</label>
            <input type="number" name="barcode" class="form-control form-control-solid" autocomplete="off" autofocus required />
          </form>
        </div>
        <div class="mb-10">
          <form action="{{ route('checkout') }}" method="post"> 
          @csrf
          <label class="required form-label">Metode Pembayaran</label>
          <div class="w-100 ">
						<select name="metode" required class="form-select form-select-solid" data-control="select2" data-placeholder="-" data-hide-search="true" data-select2-id="select2-data-18-0jcq" tabindex="-1" aria-hidden="true">
							<option value="" data-select2-id="select2-data-18-0jcq"></option>
							<option value="Tunai">Tunai</option>
              <option value="GoPay">GoPay</option>
							<option value="OVO">OVO</option>
							<option value="QRIS">QRIS</option>
						</select>
					</div>
        </div>
        <div class="mb-10">
            <label class="required form-label">Debit</label>
            <input type="text" name="debit" id="uang_masuk" class="form-control form-control-solid" autocomplete="off" required />
        </div>
        <div class="mb-10">
            <table>
            <tbody>
                <tr>
                    <td>
                    <a class="badge mb-3 badge-warning" href="#" id="uang_pas">Uang Pas</a>
                    <a class="badge badge-info" onclick="reset()" href="#">Reset</a>
                    </td>
                    <td>
                    <a class="badge mb-3 badge-danger" style="color:#ffffff;" onclick="tambah(100000)" href="#">+ 100K</a>
                    <a class="badge badge-primary" style="color:#ffffff;"  onclick="tambah(50000)" href="#">+ 50K</a>
                    </td>
                    <td>
                    <a class="badge mb-3 badge-success" style="color:#ffffff;" onclick="tambah(20000)" href="#">+ 20K</a>
                    <a class="badge" style="background-color:#5c0099;color:#ffffff;" onclick="tambah(10000)" href="#">+ 10K</a>
                    </td>
                    <td>
                    <a class="badge mb-3" style="background-color:#ab5e00;color:#ffffff;" onclick="tambah(5000)" href="#">+ 5K</a>
                    <a class="badge" style="background-color:#8f8f8f;color:#ffffff;" onclick="tambah(2000)" href="#">+ 2K</a>
                    </td>
                    <td>
                    <a class="badge mb-3" style="background-color:#014d00;color:#ffffff;" onclick="tambah(1000)" href="#">+ 1K</a>
                    <a class="badge" style="background-color:#dbdbdb;color:#000000;" onclick="tambah(500)" href="#">+ 500</a>
                    </td>
                    <td>
                    <a class="badge mb-3" style="background-color:#919191;color:#ffffff;" onclick="tambah(200)" href="#">+ 200</a>
                    <a class="badge" style="background-color:#000000;color:#ffffff;" onclick="tambah(100)" href="#">+ 100</a>
                    </td>
                </tr>
            </tbody>
            </table>
        </div>
        <div class="mb-10">
          <input type="hidden" id="total" name="total" value="">
            <input type="submit" class="btn btn-dark" value="Checkout"/>
            
            </form>
        </div>
      </div>
      </div>
      <!-- end::Card -->
    </div>
    <div class="col-7">
      <!-- begin::Card -->
      <div class="card">
	    <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-row-dashed table-row-gray-300 gy-7">
                    <thead>
                        <tr class="fw-bolder fs-6 text-gray-800">
                            <th>Nama</th>
                            <th>Harga</th>
                            <th>Qty</th>
                            <th style="width:160px;">Edit</th>
                            <th>Promo</th>
                        </tr>
                    </thead>
                    <tbody>
                    
                      <?php $total = 0 ?>
                      @forelse ($keranjang as $item)
                      <tr>
                          <td>{{$item->name}}</td>
                          <td>{{number_format($item->harga, 0, ".", ".")}}/{{$item->satuan}}</td>
                          <td>
                            {{$item->jumlah}}
                            <!--
                            <a href="{{ route('edit-basket') }}?barcode={{$item->barcode}}&action=add" class='edit-button plus-item badge badge-info input-group-addon'>+</a>
                            <a href="{{ route('edit-basket') }}?barcode={{$item->barcode}}&action=minus" class='edit-button minus-item input-group-addon badge badge-warning'>-</a>
                            <a href="{{ route('edit-basket') }}?barcode={{$item->barcode}}&action=delete" class='edit-button delete-item badge badge-danger'>X</a>
                            -->
                          </td>
                          <td>
                            <form action="{{ route('edit-jumlah') }}" method="post">
                              @csrf
                              <div class="input-group">
                                <input type="number" class="form-control" name="jumlah" value="{{$item->jumlah}}"/>
                                <input type="hidden" name="keranjang_id" value="{{$item->id}}"/>
                                <input type="submit" class="btn btn-sm btn-primary" style="width:5px;" value="U">
                                <a href="{{ route('edit-basket') }}?barcode={{$item->barcode}}&action=delete" class="btn btn-sm btn-danger" style="width:5px;">X</a>
                              </div>
                            </form>
                          </td>
                          <td style="word-break: break-all;">
                            
                            @if($diskon->where('data_barang_id',$item->data_barang_id)->count() > 0)
                              @foreach($diskon->where('data_barang_id',$item->data_barang_id) as $d)
                                {{ $d->diskon."%" }}
                              @endforeach
                            @elseif($special_price->where('data_barang_id',$item->data_barang_id)->count() > 0)
                              @foreach($special_price->where('data_barang_id',$item->data_barang_id) as $s)
                                {{ number_format($s->special_price, 0, ".", ".") }}
                              @endforeach
                            @elseif($item_get->where('item_get_id',$item->data_barang_id)->count() > 0) <!--barang di keranjang ini, ada nggak di tabel BuyGet? -->
                              @foreach($item_get->where('item_get_id',$item->data_barang_id) as $i) <!-- dari tabel BuyGet -->
                                <!-- begin::Buy Get -->
                                  @php $tinjau_keranjang = $keranjang->where('data_barang_id',$i->item_get_id) @endphp <!-- table Keranjang -->
                                  <!-- Nyari item gratisan di table Keranjang -->
                                  @foreach($tinjau_keranjang as $tk)
                                    <!-- $i->buy Jumlah barang yg hrs dibeli ATURAN PROMO-->
                                    <!-- $i->data_barang_id Barang apa yg hrs dibeli ATURAN PROMO-->

                                    @php $barang_dibeli_keranjang = $keranjang->where('data_barang_id',$i->data_barang_id) @endphp
                                    <!-- Apakah barang ATURAN PROMO ada di keranjang -->
                                    @foreach($barang_dibeli_keranjang as $bdk)
                                       <!-- $bdk->jumlah Jumlah brg ATURAN PROMO di keranjang -->
                                      @if($bdk->jumlah%$i->buy == 0) <!-- Kalo belinya sesuai ATURAN PROMO -->
                                        @php $sisa_bagi = $bdk->jumlah % $tk->jumlah;
                                        $hasil_bagi = ($bdk->jumlah - $sisa_bagi) / $tk->jumlah; @endphp

                                        @if($hasil_bagi > 0)
                                          @if($sisa_bagi == 0 && $bdk->jumlah !== $tk->jumlah)
                                            @php $pesan_promo = "free" @endphp
                                          @else
                                            @php $pesan_promo  = "free & no" @endphp
                                          @endif
                                        @else
                                          @php $pesan_promo  = "free & no" @endphp
                                        @endif

                                      @elseif($bdk->jumlah > $i->buy)
                                        @php $pesan_promo = "Free & No" @endphp
                                      @endif

                                    @endforeach

                                  @endforeach
                                <!-- end::BuyGet -->
                                @if(isset($pesan_promo))
                                  {{ $pesan_promo }}
                                @endif
                              @endforeach
                            @endif
                          </td>
                      </tr>
                      <?php $total = $total+($item->harga*$item->jumlah) ?>  
                      @empty
                        <tr>
                          <td colspan="6" class="text-center">Keranjang kosong</td>
                        </tr>
                      @endforelse
                                  
                    </tbody>
                    <tfoot>
                      <tr>
                        <td colspan="4">Total Belanja</td>
                        <td colspan="2"><?= "Rp ".number_format($total, 0, ".", ".") ?></td>
                      </tr>
                    </tfoot>
                </table>
            </div>
      </div>
      </div>
      <!-- end::Card -->
    </div>
</div>

<script type="text/javascript">

document.getElementById('total').value = <?= $total ?>;

document.getElementById("uang_pas").addEventListener('click',function(){
  document.getElementById("uang_masuk").value = <?= $total ?>;
})

// Reset
function reset(){
  document.getElementById("uang_masuk").value = 0;
}

// Tambah Uang
function tambah(uang){
  var uang_masuk = Number(document.getElementById("uang_masuk").value);
  document.getElementById("uang_masuk").value = uang_masuk + uang;
}

</script>

@endsection('isi_halaman')