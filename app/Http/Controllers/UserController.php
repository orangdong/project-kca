<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    //

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
