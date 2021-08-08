<?php

namespace App\Http\Controllers;

use App\Models\Toko;
use App\Models\DataBarang;
use App\Models\BarangOrder;
use App\Models\Keranjang;
use App\Models\Orderan;
use App\Models\Diskon;
use App\Models\SpecialPrice;
use App\Models\BuyGet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index(){
        $user = Auth::user();
        
        $keranjang = Keranjang::where('toko_id', $user->toko_id)->get();

        $diskon = Diskon::get();
        $special_price = SpecialPrice::get();
        $item_get = BuyGet::get();
        
        return view('user.dashboard', [
            'user' => $user,
            'title' => 'Dashboard',
            'keranjang' => $keranjang,
            'diskon' => $diskon,
            'special_price' => $special_price,
            'item_get' => $item_get
        ]);
    }

    public function struk(Request $request){
        $user = Auth::user();
        $orderan_id = $request->input('orderan_id');
        $orderan = Orderan::where('id',$orderan_id)->with('barang_orders')->first();
        $toko = Toko::where('id',$user->toko_id)->first();
        
        if($orderan->user_id !== $user->id or !$orderan_id){
            return redirect('dashboard');
        }

        return view('user.struk',[
            'toko' => $toko,
            'orderan' => $orderan
        ]);
    }

    public function checkout(Request $request){
        $user = Auth::user();
        $metode = $request->input('metode');
        $debit = $request->input('debit');
        $total = $request->input('total');
        $keranjang = Keranjang::where('toko_id', $user->toko_id)->get();

        if($total > $debit){
            return redirect('dashboard');
        }

        $insert_order = [
            'user_id' => $user->id,
            'metode' => $metode,
            'harga_total' => $total,
            'uang_masuk' => $debit,
            'uang_kembali' => $debit - $total
        ];

        $order = Orderan::create($insert_order);

        foreach($keranjang as $k){
            $insert_barang_order = [
                'orderan_id' => $order->id,
                'data_barang_id' => $k->data_barang_id,
                'name' => $k->name,
                'harga_satuan' => $k->harga,
                'jumlah' => $k->jumlah,
                'harga_subtotal' => $k->jumlah*$k->harga
            ];

            BarangOrder::create($insert_barang_order);
        }
        Keranjang::where('toko_id', $user->toko_id)->delete();

        return redirect('dashboard/struk?orderan_id='.$order->id);
    }

    public function edit_basket(Request $request){
        $user = Auth::user();
        $barcode = $request->input('barcode');
        $action = $request->input('action');

        if(!$barcode || !$action){
            return redirect('dashboard');
        }
        $keranjang = Keranjang::where([['barcode', $barcode], ['toko_id', $user->toko_id]])->first();

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
            return redirect('dashboard')->with('warning','Hapus barang berhasil');
        }
        
        return redirect('dashboard');
    }

    public function edit_jumlah(Request $request){
        $user = Auth::user();
        $keranjang_id = $request->input('keranjang_id');
        $jumlah = $request->input('jumlah');
        Keranjang::whereid($keranjang_id)->update([
            'jumlah' => $jumlah
        ]);

        return redirect('dashboard')->with('success','Edit jumlah berhasil');
    }

    public function add_basket(Request $request){
        $user = Auth::user();
        $barcode = $request->input('barcode');
        $item = DataBarang::where([['barcode', $barcode], ['toko_id', $user->toko_id]])->first();

        if(!$item){
            return redirect('dashboard');
        }

        $keranjang = Keranjang::where([['barcode', $barcode], ['toko_id', $user->toko_id]])->first();

        if(!$keranjang){
            $data = [
                'toko_id' => $item->toko_id,
                'barcode' => $barcode,
                'data_barang_id'=> $item->id,
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

        return view('user.user-profile', [
            'title' => 'User Profile',
            'user' => $user
        ]);
    }

    public function riwayat(){
        $user = Auth::user();

        return view('user.riwayat', [
            'title' => 'Riwayat',
            'user' => $user
        ]);
    }

    public function migrasi(){
        $user = Auth::user();

        return view('user.migrasi', [
            'title' => 'Migrasi',
            'user' => $user
        ]);
    }
}
