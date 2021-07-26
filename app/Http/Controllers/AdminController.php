<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index(){
        $user = Auth::user();
        
        if($user->role == "admin"){
            return redirect(route('pilih-toko'));
        }
        return view('dashboard', [
            'user' => $user,
            'title' => 'Dashboard'
        ]);
    }

    public function pilihtoko(){
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

    public function edittoko(){
        $user = Auth::user();

        return view('admin.edit-toko', [
            'user' => $user,
            'title' => 'Edit Toko'
        ]);
    }

    
}
