<?php

namespace App\Http\Controllers;

use App\Models\Toko;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Actions\Fortify\PasswordValidationRules;
use App\Models\BuyGet;
use App\Models\DataBarang;
use App\Models\Diskon;
use App\Models\HistoryExport;
use App\Models\MetodePembayaran;
use App\Models\SpecialPrice;
use App\Models\User;
use App\Models\Parcel;
use Carbon\Carbon;
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

    public function upload_csv(Request $request){
        $validatedData = $request->validate([
            'csv' => 'required|mimes:csv,txt|max:4096',
        ]);
        $name = $request->file('csv')->getClientOriginalName();
        $url =  $request->file('csv')->store('files', 'public');
        $toko_id = $request->input('toko_id');
        $data = [
            'toko_id' => $toko_id,
            'name' => $name,
            'url' => $url
        ];

        HistoryExport::create($data);
        return back()->with('success', 'upload csv success');
    }

    public function read_csv(Request $request, $id){

        $csvFile = storage_path('app\public/'. $request->url);
        // return $csvFile;
        $file_handle = fopen($csvFile, 'r');
        while (!feof($file_handle)) {
        $line_of_text[] = fgetcsv($file_handle, 0, ",");
        }
        fclose($file_handle);
        $barang = [];
        foreach($line_of_text as $line){
            if($line != false){
                $array = $line;
                $explode = explode(';', $array[0]);
                $push = [
                    'toko_id' => $id,
                    'barcode' => $explode[2],
                    'name' => $explode[3],
                    'satuan' => $explode[4],
                    'harga_satuan' => $explode[5],
                    'stok' => $explode[6]
                ];
                array_push($barang, $push);
            }
        }
        foreach($barang as $b){
            DataBarang::create($b);
        }

        $imported_at = [
            'imported_at' => Carbon::now('Asia/Jakarta')
        ];
        HistoryExport::where('id', $request->history_id)->update($imported_at);
        return back()->with('success', 'import barang success');
        // return $line_of_text;
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
        $diskon = $request->input('diskon');
        $diskon_until = $request->input('diskon_until');
        $special_price = $request->input('special_price');
        $special_until = $request->input('special_until');
        //buyget
        $buy = $request->input('buy');
        $get = $request->input('get');
        $item_get = $request->input('item_get_id');
        $valid_until = $request->input('valid_until'); 
        $barang->update($data);

        if($diskon){
            $value = Diskon::where('data_barang_id', $barang->id)->first();
            // return $value;
            if(!$value){
                if(!$diskon_until){
                    return back()->with('danger', 'diskon until is required');
                }
                Diskon::create([
                    'data_barang_id' => $barang->id,
                    'diskon' => $diskon,
                    'valid_until' => $diskon_until
                ]);
            }else{
                if(!$diskon_until){
                    return back()->with('danger', 'diskon until is required');
                }
                $value->update([
                    'diskon' => $diskon,
                    'valid_until' => $diskon_until
                ]);
            }
        }
        if($special_price){
            $value1 = SpecialPrice::where('data_barang_id', $barang->id)->first();
            // return $value;
            if(!$value1){
                if(!$special_until){
                    return back()->with('danger', 'special until is required');
                }
                SpecialPrice::create([
                    'data_barang_id' => $barang->id,
                    'special_price' => $special_price,
                    'valid_until' => $special_until
                ]);
            }else{
                if(!$special_until){
                    return back()->with('danger', 'special until is required');
                }
                $value1->update([
                    'special_price' => $special_price,
                    'valid_until' => $special_until
                ]);
            }
        }
        if($buy){
            if(!$get){
                return back()->with('danger', 'jumlah get is required');
            }
            if(!$item_get){
                return back()->with('danger', 'item get is required');
            }
            if(!$valid_until){
                return back()->with('danger', 'valid until is required');
            }

            $value2 = BuyGet::where('data_barang_id', $barang->id)->first();
            // return $value;
            if(!$value2){
                BuyGet::create([
                    'data_barang_id' => $barang->id,
                    'buy' => $buy,
                    'get' => $get,
                    'item_get_id' => $item_get,
                    'valid_until' => $valid_until
                ]);
            }else{
                $value2->update([
                    'buy' => $buy,
                    'get' => $get,
                    'item_get_id' => $item_get,
                    'valid_until' => $valid_until
                ]);
            }
        }

        return back()->with('success', 'update barang success');
    }

    public function viewbarang(Request $request){
        $user = Auth::user();
        $toko_id = $request->input('id');
        $toko = Toko::whereid($toko_id)->first();
        $data_barang = DataBarang::where('toko_id',$toko_id)->get();
        $parcel = Parcel::where('toko_id',$toko_id)->get();

        return view('admin.view-barang',[
            'title' => 'View Barang',
            'data_barang' => $data_barang,
            'parcel' => $parcel,
            'toko' => $toko,
            'user' => $user
        ]);
    }

    public function editbarang(Request $request){
        $user = Auth::user();
        $id = $request->input('id');
        $toko = Toko::where('id', $id)->first();

        if(!$id || !$toko){
            return redirect(route('navigasi'))->with('danger', 'invalid toko');
        }

        $barang_id = $request->input('barang_id');
        $barang = DataBarang::where([['id', $barang_id], ['toko_id', $id]])->with('buy_get', 'diskon', 'special_price')->first();
        $barangs = DataBarang::where('toko_id', $id)->get();
        $history_exports = HistoryExport::where('toko_id', $id)->get();

        // return $barang;
        return view('admin.edit-barang', [
            'user' => $user,
            'toko' => $toko,
            'barang' => $barang,
            'history_exports' => $history_exports,
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
