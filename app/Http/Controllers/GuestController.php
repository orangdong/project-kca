<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GuestController extends Controller
{
    public function call_admin(){
        return view('call_admin');
    }
}
