<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Models\User;
use App\Http\Middleware\isAdmin;

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
        Route::get('/', [UserController::class, 'index'])->name('dashboard');
        Route::post('/', [UserController::class, 'add_basket'])->name('add-basket');
        Route::get('keranjang', [UserController::class, 'edit_basket'])->name('edit-basket');
        Route::post('edit-jumlah', [UserController::class, 'edit_jumlah'])->name('edit-jumlah');
        Route::post('checkout', [UserController::class, 'checkout'])->name('checkout');
        Route::get('struk', [UserController::class, 'struk'])->name('struk');
        
        Route::middleware(['isAdmin'])->group(function(){
            Route::get('edit-barang', [AdminController::class, 'editbarang'])->name('edit-barang');
            Route::get('edit-metode', [AdminController::class, 'editmetode'])->name('edit-metode');
            Route::get('edit-toko', [AdminController::class, 'edittoko'])->name('edit-toko');
            Route::get('edit-user', [AdminController::class, 'edituser'])->name('edit-user');
            Route::get('navigasi', [AdminController::class, 'navigasi'])->name('navigasi');
            Route::get('revenue', [AdminController::class, 'revenue'])->name('revenue');
            Route::post('edit-toko/{id}', [AdminController::class, 'edit'])->name('edit-toko-form');
            Route::post('insert-toko', [AdminController::class, 'insert'])->name('insert-toko-form');
        });
        
        Route::get('user-profile', [UserController::class, 'edit'])->name('dashboard.profile');
        Route::get('riwayat', [UserController::class, 'riwayat'])->name('riwayat');
        Route::get('migrasi', [UserController::class, 'migrasi'])->name('migrasi');
    });

Route::get('/hubungiadmin', [GuestController::class, 'call_admin'])->name('call-admin');

// Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
//     return view('dashboard');
// })->name('dashboard');
