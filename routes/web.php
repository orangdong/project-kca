<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Models\User;
use App\Http\Middleware\isAdmin;
use App\Http\Middleware\isUser;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect(route('login'));
});

// is login
Route::prefix('dashboard')
    ->middleware(['auth:sanctum'])
    ->group(function()
    {   
        
        Route::middleware(['isAdmin'])->group(function(){
            Route::get('view-barang', [AdminController::class, 'viewbarang'])->name('view-barang');
            Route::get('member', [AdminController::class, 'viewmember'])->name('view-member');
            Route::get('edit-barang', [AdminController::class, 'editbarang'])->name('edit-barang');
            Route::post('edit-barang', [AdminController::class, 'edit_barang'])->name('edit-barang-form');
            Route::post('upload-csv', [AdminController::class, 'upload_csv'])->name('upload-csv');
            Route::post('edit-barang-barcode', [AdminController::class, 'edit_barang_barcode'])->name('edit-barang-barcode');
            Route::get('edit-metode', [AdminController::class, 'editmetode'])->name('edit-metode');
            Route::post('edit-metode/{id}', [AdminController::class, 'insert_metode'])->name('insert-metode');
            Route::get('edit-toko', [AdminController::class, 'edittoko'])->name('edit-toko');
            Route::get('edit-user', [AdminController::class, 'edituser'])->name('edit-user');
            Route::post('edit-user/{id}', [AdminController::class, 'edit_user'])->name('edit-user-form');
            Route::post('edit-user-password/{id}', [AdminController::class, 'edit_user_password'])->name('edit-user-password');
            Route::get('navigasi', [AdminController::class, 'index'])->name('navigasi');
            Route::get('revenue', [AdminController::class, 'revenue'])->name('revenue');
            Route::get('read-csv/{id}', [AdminController::class, 'read_csv'])->name('read-csv');
            Route::post('edit-toko/{id}', [AdminController::class, 'edit'])->name('edit-toko-form');
            Route::post('insert-toko', [AdminController::class, 'insert'])->name('insert-toko-form');
            Route::post('insert-user', [AdminController::class, 'insert_user'])->name('insert-user-form');
            Route::get('delete-metode/{id}', [AdminController::class, 'delete_metode'])->name('delete-metode');
        });

        Route::middleware(['isUser'])->group(function(){
            Route::get('/', [UserController::class, 'index'])->name('dashboard');
            Route::post('/', [UserController::class, 'add_basket'])->name('add-basket');
            Route::get('keranjang', [UserController::class, 'edit_basket'])->name('edit-basket');
            Route::post('edit-jumlah', [UserController::class, 'edit_jumlah'])->name('edit-jumlah');
            Route::post('checkout', [UserController::class, 'checkout'])->name('checkout');
            Route::get('struk', [UserController::class, 'struk'])->name('struk');
            Route::get('riwayat', [UserController::class, 'riwayat'])->name('riwayat');
            Route::get('migrasi', [UserController::class, 'migrasi'])->name('migrasi');
            Route::get('create-member', [UserController::class, 'create_member'])->name('create-member');
            Route::post('insert-member', [UserController::class, 'insert_member'])->name('insert-member');
            Route::get('delete-orderan', [UserController::class, 'delete_orderan'])->name('delete-orderan');
            Route::post('edit-metode', [UserController::class, 'edit_metode'])->name('riwayat.edit-metode');
        });
        
        Route::get('user-profile', [UserController::class, 'edit'])->name('dashboard.profile');
        
    });

Route::get('/hubungiadmin', [GuestController::class, 'call_admin'])->name('call-admin');

// Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
//     return view('dashboard');
// })->name('dashboard');
