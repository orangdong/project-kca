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
						<select name="metode" required class="form-select form-select-solid" data-control="select2" data-placeholder="-" data-hide-search="true" tabindex="-1" aria-hidden="true">
							<option value=""></option>
              @foreach($metode_pembayaran as $mp)
                <option value="{{ $mp->metode }}">{{ $mp->metode }}</option>
              @endforeach
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
          <input type="hidden" id="total_normal" name="total_normal" value="">
          @if(!empty($member)) <input type="hidden" name="phone_member" value="{{ $member->phone }}"> @endif
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
                    
                      <?php $total = 0; $total_normal = 0; ?>
                      @forelse ($keranjang as $item)
                        @if($item->parcel == 1)
                          <tr>
                            <td>{{ $item->name }}</td>
                            <td>{{ number_format($item->harga, 0, ".", ".") }}</td>
                            <td><b>{{ $item->jumlah }}</b></td>
                            <td>
                              <form action="{{ route('edit-jumlah') }}" method="post">
                                @csrf
                                <div class="input-group">
                                  <input type="number" class="form-control" name="jumlah" value="{{$item->jumlah}}"/>
                                  <input type="hidden" name="keranjang_id" value="{{$item->id}}"/>
                                  <input type="submit" class="btn btn-sm btn-secondary" style="width:5px;" value="U">
                                  <a href="{{ route('edit-basket') }}?barcode={{$item->barcode}}&action=delete" class="btn btn-sm btn-danger" style="width:5px;">X</a>
                                </div>
                              </form>
                            </td>
                            <td>
                              @php $total_normal = $total_normal + ($item->harga*$item->jumlah);
                              $total = $total + ($item->harga*$item->jumlah) @endphp
                            </td>
                          </tr>
                        @else
                          <tr>
                              <td>{{$item->name}}</td>
                              <td>{{number_format($item->harga, 0, ".", ".")}}</td>
                              <td>
                                <b>{{$item->jumlah}}</b>
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
                                    @if(!empty($member))
                                      <input type="hidden" name="keranjang_id" value="{{$item->id}}"/>
                                      <input type="hidden" name="phone_member" value="{{$member->phone}}"/>
                                      <input type="submit" class="btn btn-sm btn-secondary" style="width:5px;" value="U">
                                      <a href="{{ route('edit-basket') }}?barcode={{$item->barcode}}&action=delete&member={{$member->phone}}" class="btn btn-sm btn-danger" style="width:5px;">X</a>
                                    @else
                                      <input type="hidden" name="keranjang_id" value="{{$item->id}}"/>
                                      <input type="submit" class="btn btn-sm btn-secondary" style="width:5px;" value="U">
                                      <a href="{{ route('edit-basket') }}?barcode={{$item->barcode}}&action=delete" class="btn btn-sm btn-danger" style="width:5px;">X</a>
                                    @endif
                                  </div>
                                </form>
                              </td>
                              <td style="word-break: break-all;">
                                <!-- Cek Semua Kondisi Promo & Tidak Promo -->
                                @if($diskon->where('data_barang_id',$item->data_barang_id)->count() > 0)
                                  @foreach($diskon->where('data_barang_id',$item->data_barang_id) as $d)
                                    {{ $d->diskon."%" }}
                                  @endforeach
                                  <?php $total = $total+($item->harga*$item->jumlah*((100-$d->diskon)/100)); ?>

                                @elseif($special_price->where('data_barang_id',$item->data_barang_id)->count() > 0)
                                  @foreach($special_price->where('data_barang_id',$item->data_barang_id) as $s)
                                    {{ number_format($s->special_price, 0, ".", ".") }}
                                  @endforeach
                                  <?php $total = $total+($s->special_price*$item->jumlah);?>

                                @elseif($item_get->where('item_get_id',$item->data_barang_id)->count() > 0)
                                  @php $free = 0 @endphp
                                  @foreach($item_get->where('item_get_id',$item->data_barang_id) as $i)
                                    @foreach($keranjang->where('data_barang_id',$i->data_barang_id) as $k)
                                      @if($diskon->where('data_barang_id',$k->data_barang_id)->count() < 1 && $special_price->where('data_barang_id',$k->data_barang_id)->count() < 1)
                                        @php $sisa_bagi = $k->jumlah % $i->buy;
                                        $kelipatan_bawah = ($k->jumlah - $sisa_bagi) / $i->buy;
                                        $free = $free + ($i->get*$kelipatan_bawah); @endphp
                                      @endif
                                    @endforeach
                                  @endforeach
                                  @if($free > $item->jumlah) @php $free = $item->jumlah @endphp @endif
                                  @php $no_free = $item->jumlah-$free @endphp
                                  <!-- Percantik View BuyGet -->
                                  @if($free > 0 && $no_free > 0)
                                    {{ $free." Free & ".$no_free." No" }}
                                    @if(!empty($member))
                                      <?php $total = $total+($item->harga*$no_free)*(95/100) ?>
                                    @else
                                      <?php $total = $total+($item->harga*$no_free) ?>
                                    @endif
                                    @php $total_normal = $total_normal + ($item->harga*$no_free) @endphp
                                  @elseif($free > 0 && $no_free <= 0)
                                    {{ $free." Free" }}
                                  @else
                                    @php $harga_normal = 0 @endphp
                                    <!-- Cek Barang ini punya GRatisan gak -->
                                    @foreach($item_get->where('data_barang_id', $item->data_barang_id) as $i)
                                      @php $kelipatan_bawah_buy = ($item->jumlah - ($item->jumlah % $i->buy)) / $i->buy;
                                      $harga_normal = $harga_normal + ($i->buy*$kelipatan_bawah_buy) @endphp
                                    @endforeach
                                    @if($item->jumlah > $harga_normal)
                                      @if(!empty($member))
                                        <?php $total = $total + ($item->harga*$harga_normal) + ($item->harga*($item->jumlah-$harga_normal)*(95/100)) ?>
                                      @else
                                        <?php $total = $total + ($item->harga*$harga_normal) + ($item->harga*($item->jumlah-$harga_normal)) ?>
                                      @endif
                                    @else
                                      <?php $total = $total + ($item->harga*$item->jumlah) ?>
                                    @endif
                                    <?php $total_normal = $total_normal + ($item->harga*($item->jumlah-$harga_normal)); ?>
                                  @endif
                                @else
                                  @php $harga_normal = 0 @endphp
                                  <!-- Cek Barang ini punya GRatisan gak -->
                                  @foreach($item_get->where('data_barang_id', $item->data_barang_id) as $i)
                                    @php $kelipatan_bawah_buy = ($item->jumlah - ($item->jumlah % $i->buy)) / $i->buy;
                                    $harga_normal = $harga_normal + ($i->buy*$kelipatan_bawah_buy) @endphp
                                  @endforeach
                                  @if($item->jumlah > $harga_normal)
                                    @if(!empty($member))
                                      <?php $total = $total + ($item->harga*$harga_normal) + ($item->harga*($item->jumlah-$harga_normal)*(95/100)) ?>
                                    @else
                                      <?php $total = $total + ($item->harga*$harga_normal) + ($item->harga*($item->jumlah-$harga_normal)) ?>
                                    @endif
                                  @else
                                    <?php $total = $total + ($item->harga*$item->jumlah) ?>
                                  @endif
                                  <?php $total_normal = $total_normal + ($item->harga*($item->jumlah-$harga_normal)); ?>
                                @endif

                              </td>
                          </tr>
                        @endif
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

<!-- end::Modal Member-->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="false">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Program Member</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="{{ route('dashboard') }}" method="get">
          @csrf
          <div class="mb-3">
              <label class="form-label required">Phone</label>
              <input type="number" class="form-control form-control-solid" name="phone_member" placeholder="Nomor telepon" required autocomplete="off"/>
          </div>
      </div>
      <div class="modal-footer">
        <a type="button" class="btn btn-secondary" href="{{ route('dashboard') }}">Reset</a>
        <button type="submit" class="btn btn-primary">Input</button>
      </form>
      </div>
    </div>
  </div>
</div>
<!-- end::Modal Member-->

<script type="text/javascript">

document.getElementById('total').value = <?= $total ?>;
document.getElementById('total_normal').value = <?= $total_normal ?>;

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

@section('isi_action')
@if(!empty($member))
<a href="#" class="btn btn-sm btn-success">{{ $member->name }}</a>
@endif
<button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">Member</button>
@endsection('isi_action')