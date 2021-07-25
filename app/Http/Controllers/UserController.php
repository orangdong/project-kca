<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    //
    public function index(){
        $user = Auth::user();

        return view('dashboard', [
            'user' => $user
        ]);
    }

    public function edit(){
        $user = Auth::user();

        return view('user-profile', [
            'title' => 'User Profile',
            'user' => $user
        ]);
    }
}
