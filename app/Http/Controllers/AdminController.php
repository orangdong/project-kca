<?php

namespace App\Http\Controllers;

use App\Models\Toko;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Actions\Fortify\PasswordValidationRules;
use App\Models\User;

class AdminController extends Controller
{
    use PasswordValidationRules;

    public function index(){
        $user = Auth::user();
        $tokos = Toko::all();

        return view('admin.pilih-toko', [
            'user' => $user,
            'tokos' => $tokos,
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

    public function edituser(Request $request){
        $id = $request->input('id');
        $toko = Toko::where('id', $id)->first();

        if(!$id || !$toko){
            return redirect(route('navigasi'))->with('danger', 'invalid toko');
        }
        $user = Auth::user();
        $users = User::where('toko_id', $id)->get();

        return view('admin.edit-user', [
            'user' => $user,
            'users' => $users,
            'toko' => $toko,
            'title' => 'Edit User'
        ]);
    }

    public function insert_user(Request $request){
        $name = $request->input('name');
        $username = $request->input('username');
        $password = $request->input('password');
        $role = $request->input('role');
        $id = $request->input('toko_id');
        $phone = $request->input('phone');

        $request->validate([
            'password' => $this->passwordRules()
        ]);

        $data = [
            'name' => $name,
            'toko_id' => $id,
            'username' => $username,
            'password' => Hash::make($password),
            'role' => $role,
            'phone' => $phone
        ];

        User::create($data);

        return redirect(route('edit-user').'?id='.$id)->with('success','Inser user baru berhasil');
    }

    public function edit_user(Request $request, $id){
        $data = $request->all();
        $user = User::where('id', $id)->first();

        $user->update($data);
        return redirect(route('edit-user').'?id='.$request->toko_id)->with('success','Ubah data user berhasil');
    }

    public function edit_user_password(Request $request, $id){
        $user = User::where('id', $id)->first();

        $request->validate([
            'password' => $this->passwordRules()
        ]);

        $update = [
            'password' => Hash::make($request->input('password'))
        ];

        $user->update($update);

        return redirect(route('edit-user').'?id='.$request->toko_id)->with('success','Ubah password berhasil');
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
