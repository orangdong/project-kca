<?php

namespace App\Http\Controllers;

use App\Models\Toko;
use App\Models\MetodePembayaran;
use App\Models\DataBarang;
use App\Models\BarangOrder;
use App\Models\Keranjang;
use App\Models\Orderan;
use App\Models\Diskon;
use App\Models\SpecialPrice;
use App\Models\BuyGet;
use App\Models\Member;
use App\Models\Parcel;
use App\Models\ParcelItem;
use App\Models\HistoryDiskon;
use App\Models\HistorySpecialPrice;
use App\Models\HistoryBuyGet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class UserController extends Controller
{
    public function index(Request $request){
        $user = Auth::user();
        $metode_pembayaran = MetodePembayaran::where('toko_id',$user->toko_id)->get();
        $phone_member = $request->input('phone_member');
        $member = Member::where('phone', $phone_member)->first();
        $keranjang = Keranjang::where('user_id', $user->id)->get();
        $today = Carbon::today()->toDateString();
        $diskon = Diskon::where('valid_until', '>=', $today)->get();
        $special_price = SpecialPrice::where('valid_until', '>=', $today)->get();
        $item_get = BuyGet::where('valid_until', '>=', $today)->get();

        if(!$member){
            return view('user.dashboard', [
                'user' => $user,
                'metode_pembayaran' => $metode_pembayaran,
                'title' => 'Dashboard',
                'keranjang' => $keranjang,
                'diskon' => $diskon,
                'special_price' => $special_price,
                'item_get' => $item_get
            ]);
        }else{
            return view('user.dashboard', [
                'user' => $user,
                'metode_pembayaran' => $metode_pembayaran,
                'member' => $member,
                'title' => 'Dashboard',
                'keranjang' => $keranjang,
                'diskon' => $diskon,
                'special_price' => $special_price,
                'item_get' => $item_get
            ]);
        }
        
        
    }

    public function struk(Request $request){
        $user = Auth::user();
        $orderan_id = $request->input('orderan_id');
        $ada_orderan = Orderan::whereid($orderan_id)->count();
        $orderan = Orderan::whereid($orderan_id)->with('barang_orders')->first();
        $toko = Toko::whereid($user->toko_id)->first();
        
        if(empty($orderan_id) or $orderan->user_id !== $user->id or $ada_orderan < 1){
            return redirect('dashboard');
        }

        $diskon = HistoryDiskon::get();
        $special_price = HistorySpecialPrice::get();
        $item_get = HistoryBuyGet::get();

        return view('user.struk',[
            'toko' => $toko,
            'diskon' => $diskon,
            'special_price' => $special_price,
            'item_get' => $item_get,
            'orderan' => $orderan
        ]);
    }

    public function checkout(Request $request){
        $user = Auth::user();
        $metode = $request->input('metode');
        $debit = $request->input('debit');

        $phone_member = $request->input('phone_member');
        $member = Member::where('phone', $phone_member)->first();
        if(!$member){
            $member_id = 0;
        }else{
            $member_id = $member->id;
        }

        $total = $request->input('total');
        $total_normal = $request->input('total_normal'); // cek member
        $keranjang = Keranjang::where('user_id', $user->id)->get(); // nnti cek stok

        if($total > $debit){
            return redirect('dashboard');
        }

        $insert_order = [
            'user_id' => $user->id,
            'member_id' => $member_id,
            'metode' => $metode,
            'harga_total' => $total,
            'uang_masuk' => $debit,
            'uang_kembali' => $debit - $total
        ];

        $order = Orderan::create($insert_order);

        foreach($keranjang as $k){
            if($k->parcel == 1){ // Jika parcel
                $parcel = 1;
                $barang_order = BarangOrder::create([
                    'orderan_id' => $order->id,
                    'data_barang_id' => $k->data_barang_id,
                    'parcel' => $parcel,
                    'name' => $k->name,
                    'harga_satuan' => $k->harga,
                    'jumlah' => $k->jumlah,
                    'harga_subtotal' => $k->jumlah*$k->harga
                ]);
                
                $stok_parcel = Parcel::where([['toko_id',$user->toko_id],['id',$k->data_barang_id]])->with('parcel_items')->get();
                Parcel::where([['toko_id',$user->toko_id],['id',$k->data_barang_id]])->update([ // Kurangi stok parcel
                    'stok' => $stok_parcel->stok - $k->jumlah
                ]);
                foreach($stok_parcel->parcel_items as $pi){
                    $barang = DataBarang::whereid($pi->data_barang_id)->first();
                    $sisa_barang = $barang->stok - ($k->jumlah*$pi->jumlah);
                    DataBarang::where([['toko_id',$user->toko_id],['id',$pi->data_barang_id]])->update([
                        'stok' => $sisa_barang // Kurangi stok parcel items
                    ]);
                    // HistoryParcelItems::create([
                    //     'barang_order_id' => $barang_order->id,
                    //     'data_barang_id' => $pi->data_barang_id,
                    //     'jumlah' => $pi->jumlah
                    // ]);
                }

            }else{ // Jika barang
                $parcel = 0;

                $barang_order = BarangOrder::create([
                    'orderan_id' => $order->id,
                    'data_barang_id' => $k->data_barang_id,
                    'parcel' => $parcel,
                    'name' => $k->name,
                    'harga_satuan' => $k->harga,
                    'jumlah' => $k->jumlah,
                    'harga_subtotal' => $k->jumlah*$k->harga
                ]);

                $stok_barang = DataBarang::where([['toko_id',$user->toko_id],['id',$k->data_barang_id]])->first();
                DataBarang::where([['toko_id',$user->toko_id],['id',$k->data_barang_id]])->update([
                    'stok' => $stok_barang->stok - $k->jumlah
                ]);

                $diskon = Diskon::get();
                $special_price = SpecialPrice::get();
                $item_get = BuyGet::get();

                if($diskon->where('data_barang_id',$k->data_barang_id)->count() > 0){ // Kalo barangnya diskon
                    foreach($diskon->where('data_barang_id',$k->data_barang_id) as $d){
                        HistoryDiskon::create([
                            'barang_order_id' => $barang_order->id,
                            'diskon' => $d->diskon,
                            'harga_diskon' => (100-$d->diskon)/100*$k->jumlah
                        ]);
                    }

                }elseif($special_price->where('data_barang_id',$k->data_barang_id)->count() > 0){ // Kalo barangnya special price
                    foreach($special_price->where('data_barang_id',$k->data_barang_id) as $s){
                        HistorySpecialPrice::create([
                            'barang_order_id' => $barang_order->id,
                            'special_price' => $s->special_price
                        ]);
                    }

                }elseif($item_get->where('item_get_id',$k->data_barang_id)->count() > 0){ // Kalo barangnya gratisan
                    foreach($item_get->where('item_get_id',$k->data_barang_id) as $i){
                        foreach($keranjang->where('data_barang_id',$i->data_barang_id) as $kk){
                            if($diskon->where('data_barang_id',$kk->data_barang_id)->count() < 1 && $special_price->where('data_barang_id',$kk->data_barang_id)->count() < 1){
                                $sisa_bagi = $kk->jumlah % $i->buy;
                                $kelipatan_bawah = ($kk->jumlah - $sisa_bagi) / $i->buy;
                                if($kelipatan_bawah >= 1){
                                    HistoryBuyGet::create([
                                        'barang_order_id' => $barang_order->id,
                                        'item_buy_id' => $i->data_barang_id,
                                        'buy' => $i->buy,
                                        'get' => $i->get,
                                        'item_get_id' => $i->item_get_id
                                    ]);
                                }
                            }
                        }
                    }
                }

            }

            
        }
        Keranjang::where('user_id', $user->id)->delete();

        if($total_normal >= 500000 && $member_id == 0){
            return redirect(route('create-member').'?orderan_id='.$orderan->id);
        }

        return redirect('dashboard/struk?orderan_id='.$order->id);
    }

    public function create_member(Request $request){
        $user = Auth::user();
        $orderan_id = $request->input('orderan_id');
        if(empty($orderan_id)){
            return redirect('dashboard')->with('danger','Forbidden');
        }
        return view('user.create-member',[
            'user' => $user,
            'orderan_id' => $orderan_id,
            'title' => 'Member Baru'
        ]);
    }

    public function insert_member(Request $request){
        $user = Auth::user();
        $orderan_id = $request->input('orderan_id');
        $name = $request->input('name');
        $urutan = Member::count() + 1;
        $str_urutan = str_pad($urutan, 5, '0', STR_PAD_LEFT);
        $kode_member = substr($name,0,3).$str_urutan;
        Member::create([
            'name' => $name,
            'kode_member' => $kode_member,
            'phone' => $request->input('phone'),
            'alamat' => $request->input('alamat'),
            'nik' => $request->input('nik'),
            'email' => $request->input('email'),
        ]);

        return redirect('dashboard/struk?orderan_id='.$orderan_id);
    }

    public function edit_basket(Request $request){
        $user = Auth::user();
        $barcode = $request->input('barcode');
        $action = $request->input('action');

        if(!$barcode || !$action){
            return redirect('dashboard');
        }
        $keranjang = Keranjang::where([['barcode', $barcode], ['user_id', $user->id]])->first();

        if($action == 'add'){
            $jumlah = $keranjang->jumlah + 1;
            $update = [
                'jumlah' => $jumlah
            ];
            $keranjang->update($update);
            return redirect('dashboard')->with('success','Tambah barang berhasil');
        }elseif($action == 'minus'){
            $jumlah = $keranjang->jumlah - 1;
            $update = [
                'jumlah' => $jumlah
            ];
            $keranjang->update($update);
            return redirect('dashboard')->with('warning','Kurangi barang berhasil');
        }elseif($action == 'delete'){
            $keranjang->delete();
            if(!empty($request->input('phone_member'))){
                return redirect('dashboard?phone_member='.$request->input('phone_member'))->with('warning','Hapus barang berhasil');
            }else{
                return redirect('dashboard')->with('warning','Hapus barang berhasil');
            }
        }
        
        return redirect('dashboard');
    }

    public function edit_jumlah(Request $request){
        $user = Auth::user();
        $keranjang_id = $request->input('keranjang_id');
        $phone_member = $request->input('phone_member');
        $jumlah = $request->input('jumlah');
        Keranjang::whereid($keranjang_id)->update([
            'jumlah' => $jumlah
        ]);
        if(!empty($phone_member)){
            return redirect('dashboard?phone_member='.$phone_member)->with('success','Edit jumlah berhasil');
        }else{
            return redirect('dashboard')->with('success','Edit jumlah berhasil');
        }
        
    }

    public function add_basket(Request $request){
        $user = Auth::user();
        $barcode = $request->input('barcode');
        $item = DataBarang::where([['barcode', $barcode], ['toko_id', $user->toko_id]])->first();
        $parcel = 0;
        if(!$item){
            $item = Parcel::where([['barcode', $barcode], ['toko_id', $user->toko_id]])->first();
            $parcel = 1;
            $item->satuan = "pcs";
        }

        if(!$item){
            return redirect('dashboard');
        }

        $keranjang = Keranjang::where([['barcode', $barcode], ['user_id', $user->id]])->first();

        if(!$keranjang){
            $data = [
                'user_id' => $user->id,
                'barcode' => $barcode,
                'data_barang_id'=> $item->id,
                'parcel'=> $parcel,
                'name' => $item->name,
                'satuan' => $item->satuan,
                'harga' => $item->harga_satuan,
                'jumlah' => 1
            ];

            Keranjang::create($data);
            return redirect('dashboard')->with('success','Barang baru berhasil');
        }else{
            $jumlah = $keranjang->jumlah + 1;

            $update = [
                'jumlah' => $jumlah
            ];

            $keranjang->update($update);

            return redirect('dashboard')->with('success','Tambah barang berhasil');
        }
        
        
    }

    public function edit(){
        $user = Auth::user();

        return view('user-profile', [
            'title' => 'User Profile',
            'user' => $user
        ]);
    }

    public function riwayat(Request $request){
        $user = Auth::user();
        $tanggal_observasi = $request->input('tanggal_observasi');
        if(!$tanggal_observasi){
            $orderan = Orderan::where('user_id',$user->id)->whereDate('created_at', Carbon::today()->toDateString())->with('barang_orders')->get();
        }else{
            $orderan = Orderan::where('user_id',$user->id)->whereDate('created_at', $tanggal_observasi)->with('barang_orders')->get();
        }
        $toko = Toko::whereid($user->id)->first();
        $metode_pembayaran = MetodePembayaran::where('toko_id', $user->toko_id)->get();

        $diskon = HistoryDiskon::get();
        $special_price = HistorySpecialPrice::get();
        $item_get = HistoryBuyGet::get();

        return view('user.riwayat', [
            'title' => 'Riwayat',
            'tanggal_observasi' => $tanggal_observasi,
            'orderan' => $orderan,
            'toko' => $toko,
            'metode_pembayaran' => $metode_pembayaran,
            'diskon' => $diskon,
            'special_price' => $special_price,
            'item_get' => $item_get,
            'user' => $user
        ]);
    }

    public function edit_metode(Request $request){
        $user = Auth::user();
        $orderan_id = $request->input('orderan_id');
        $metode = $request->input('metode');
        Orderan::whereid($orderan_id)->update([
            'metode' => $metode
        ]);
        return redirect(route('riwayat'))->with('success', 'Edit metode berhasil');
    }

    public function delete_orderan(Request $request){
        $user = Auth::user();
        $orderan_id = $request->input('orderan_id');
        $parcel = Parcel::get();
        $parcel_item = ParcelItem::get();
        $data_barang = DataBarang::get();

        $orderan = Orderan::where([['id',$orderan_id],['user_id', $user->id]])->with('barang_orders')->get();
        foreach($orderan[0]->barang_orders as $ob){
            if($ob->parcel == 1){
                foreach($parcel->whereid($ob->data_barang_id) as $p){
                    Parcel::whereid($ob->data_barang_id)->update([
                        'stok' => $p->stok + $ob->jumlah
                    ]);
                    foreach($parcel_item->where('parcel_id',$p->id) as $pi){
                        foreach($data_barang->whereid($pi->data_barang_id) as $di){ // 1x LOOP cari Data Barang
                            DataBarang::whereid($pi->data_barang_id)->update([
                                'stok' => $di->stok + ($ob->jumlah*$pi->jumlah)
                            ]);
                        }
                    }
                }
            }else{
                foreach($data_barang->where('id',$ob->data_barang_id) as $d){
                    DataBarang::where('id', $ob->data_barang_id)->update([
                        'stok' => $d->stok + $ob->jumlah
                    ]);
                }
            }
        }
        Orderan::where([['id',$orderan_id],['user_id', $user->id]])->delete();

        return redirect(route('riwayat'))->with('warning','Void berhasil');
    }

    public function migrasi(){
        $user = Auth::user();

        return redirect(route('dashboard'));
    }
}
