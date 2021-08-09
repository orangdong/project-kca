<?php

namespace App\Http\Controllers;

use App\Models\Toko;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Actions\Fortify\PasswordValidationRules;
use App\Models\DataBarang;
use App\Models\MetodePembayaran;
use App\Models\User;
use PhpParser\Node\Expr\FuncCall;

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

    public function edit_barang_barcode(Request $request){
        $barcode = $request->input('barcode');
        $toko_id = $request->input('toko_id');
        $barang = DataBarang::where([['barcode', $barcode], ['toko_id', $toko_id]])->first();
        
        if(!$barang){
            return back()->with('danger', 'barang tidak ditemukan');
        }

        return redirect(route('edit-barang').'?id='.$toko_id.'&barang_id='.$barang->id);
    }

    public function edit_barang(Request $request){
        $data = $request->all();
        $barang = DataBarang::where('id', $request->input('barang_id'))->first();
        if(!$barang){
            return back()->with('danger', 'pilih barang terlebih dahulu');
        }
        $barang->update($data);

        return back()->with('success', 'update barang success');
    }

    public function editbarang(Request $request){
        $user = Auth::user();
        $id = $request->input('id');
        $toko = Toko::where('id', $id)->first();

        if(!$id || !$toko){
            return redirect(route('navigasi'))->with('danger', 'invalid toko');
        }

        $barang_id = $request->input('barang_id');
        $barang = DataBarang::where([['id', $barang_id], ['toko_id', $id]])->first();
        $barangs = DataBarang::where('toko_id', $id)->get();

        return view('admin.edit-barang', [
            'user' => $user,
            'toko' => $toko,
            'barang' => $barang,
            'barangs' => $barangs,
            'title' => 'Edit Barang'
        ]);
    }

    public function editmetode(Request $request){
        $id = $request->input('id');
        $toko = Toko::where('id', $id)->first();
        $metodes = MetodePembayaran::where('toko_id', $id)->get();

        if(!$id || !$toko){
            return redirect(route('navigasi'))->with('danger', 'invalid toko');
        }
        $user = Auth::user();

        return view('admin.edit-metode', [
            'user' => $user,
            'toko' => $toko,
            'metodes' => $metodes,
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

    public function delete_metode(Request $request,$id){
        $toko_id = $request->input('toko_id');
        MetodePembayaran::where('id', $id)->delete();

        return redirect(route('edit-metode').'?id='.$toko_id)->with('success','Delete metode berhasil');
    }

    public function insert_metode(Request $request, $id){
        $data = $request->all();

        MetodePembayaran::create($data);

        return redirect(route('edit-metode').'?id='.$id)->with('success','Insert metode berhasil');
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
