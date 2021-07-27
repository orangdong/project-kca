<?php

namespace App\Http\Controllers;

use App\Models\DataBarang;
use App\Models\BarangOrder;
use App\Models\Keranjang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index(){
        $user = Auth::user();

        return view('dashboard', [
            'user' => $user,
            'title' => 'Dashboard'
        ]);
    }

    public function add_basket(Request $request){
        $user = Auth::user();
        $barcode = $request->input('barcode');
        $item = DataBarang::where([['barcode', $barcode], ['toko_id', $user->toko_id]])->first();

        if(!$item){
            return route('dashboard');
        }

        $keranjang = Keranjang::where([['barcode', $barcode], ['toko_id', $user->toko_id]])->first();

        if(!$keranjang){
            $data = [
                'toko_id' => $item->toko_id,
                'barcode' => $barcode,
                'name' => $item->name,
                'satuan' => $item->satuan,
                'harga' => $item->harga_satuan,
                'jumlah' => 1
            ];

            Keranjang::create($data);
            return redirect('dashboard');
        }else{
            $jumlah = $keranjang->jumlah + 1;

            $update = [
                'jumlah' => $jumlah
            ];

            $keranjang->update($update);

            return redirect('dashboard');
        }
        
        
    }

    public function edit(){
        $user = Auth::user();

        return view('user-profile', [
            'title' => 'User Profile',
            'user' => $user
        ]);
    }

    public function riwayat(){
        $user = Auth::user();

        return view('riwayat', [
            'title' => 'Riwayat',
            'user' => $user
        ]);
    }

    public function migrasi(){
        $user = Auth::user();

        return view('migrasi', [
            'title' => 'Migrasi',
            'user' => $user
        ]);
    }
}
