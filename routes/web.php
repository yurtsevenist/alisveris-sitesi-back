<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UyeController;
use App\Http\Controllers\ProductController;
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
    return view('auth.login');
});
Route::get('register', function () {
    return view('auth.register');
});
Route::get('forget', function () {
    return view('auth.forget');
});

Route::post('loginPost',[AdminController::class,'loginPost'])->name('loginPost');
Route::post('registerPost',[AdminController::class,'registerPost'])->name('registerPost');
Route::get('/',[AdminController::class,'login'])->name('login');
Route::post('/forget-password', [AdminController::class,'postEmail'])->name('postEmail');
Route::get('/{token}/reset-password', [AdminController::class,'getPassword'])->name('getPassword');
Route::post('/reset-password', [AdminController::class,'updatePassword'])->name('updatePassword');

//bu kısımdaki route yetkisi olanların ulaşacağı kısımlar
Route::group(['middleware'=>['auth','verified']],function()
{
    Route::get('dashboard',[AdminController::class,'dashboard'])->name('dashboard');
    Route::get('profil',[AdminController::class,'profil'])->name('profil');
    Route::get('uyeler',[UyeController::class,'uyeler'])->name('uyeler');
    Route::get('urunler',[ProductController::class,'index'])->name('urunler');
    Route::get('urun/{id}',[ProductController::class,'urun'])->name('urun');
    Route::get('deleteAllProduct',[ProductController::class,'deleteAllProduct'])->name('deleteAllProduct');
    Route::post('deleteProduct',[ProductController::class,'deleteProduct'])->name('deleteProduct');
    Route::post('photoAdd',[ProductController::class,'photoAdd'])->name('photoAdd');
    Route::post('photoDelete',[ProductController::class,'photoDelete'])->name('photoDelete');
    Route::post('productUpdate',[ProductController::class,'productUpdate'])->name('productUpdate');
    Route::get('logout',[AdminController::class,'logout'])->name('logout');
});
