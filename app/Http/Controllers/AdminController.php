<?php

namespace App\Http\Controllers;

use App\Models\Toko;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index(){
        $user = Auth::user();
        
        if($user->role == "admin"){
            return redirect(route('navigasi'));
        }
        return view('dashboard', [
            'user' => $user,
            'title' => 'Dashboard'
        ]);
    }

    public function navigasi(){
        $user = Auth::user();

        return view('admin.pilih-toko', [
            'user' => $user,
            'title' => 'Navigasi'
        ]);
    }

    public function editbarang(){
        $user = Auth::user();

        return view('admin.edit-barang', [
            'user' => $user,
            'title' => 'Edit Barang'
        ]);
    }

    public function editmetode(){
        $user = Auth::user();

        return view('admin.edit-metode', [
            'user' => $user,
            'title' => 'Edit Metode'
        ]);
    }

    public function edituser(){
        $user = Auth::user();

        return view('admin.edit-user', [
            'user' => $user,
            'title' => 'Edit User'
        ]);
    }

    public function revenue(){
        $user = Auth::user();

        return view('admin.revenue', [
            'user' => $user,
            'title' => 'Revenue'
        ]);
    }

    public function edit(Request $request, $id){
        $data = $request->all();
        $toko = Toko::where('id', $id)->first();

        $toko->update($data);
        return redirect(route('edit-toko'))->with('success','Edit toko berhasil');

    }

    public function insert(Request $request){
        $data = $request->all();

        Toko::create($data);
        return redirect(route('edit-toko'))->with('success','Create toko berhasil');
    }

    public function edittoko(){
        $user = Auth::user();
        $tokos = Toko::all();

        return view('admin.edit-toko', [
            'user' => $user,
            'tokos' => $tokos,
            'title' => 'Edit Toko'
        ]);
    }

    
}
