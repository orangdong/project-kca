<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\GuestController;
use Illuminate\Support\Facades\Route;
use App\Models\User;

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

Route::get('/user-profile', function () {
    return view('user-profile', [
        'title' => 'User Profile',
        'user' => [UserController::class, 'index']
    ]);
});

// is login
Route::prefix('dashboard')
    ->middleware(['auth:sanctum'])
    ->group(function(){
        Route::get('/', [AdminController::class, 'index'])->name('dashboard');
    });

Route::get('/hubungiadmin', [GuestController::class, 'call_admin'])->name('call-admin');

// Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
//     return view('dashboard');
// })->name('dashboard');
