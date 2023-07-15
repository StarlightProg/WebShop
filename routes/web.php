<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/shop', [ShopController::class, 'index']);

Route::controller(ShopController::class)->group(function (){
    Route::get('/shop', 'index')->name('shop.index');
    // Route::get('/shop/{product}', 'show')->name('shop.show');
});

Route::get('/shop/{product}', [ProductController::class, 'index']);

Route::get('/product-single', function () {
    return view('product-single');
});

Route::get('/checkout', function () {
    return view('checkout');
});

Route::get('/cart', function () {
    return view('cart');
});

Route::controller(CartController::class)->group(function () {
    Route::get('/cart', 'index')->name("cart.index"); 
    Route::post('/cart', 'store')->name("cart.store");  
    Route::delete('/cart/{product}', 'delete')->name("cart.delete");  
});

Route::get('/login', 'App\Http\Controllers\AuthController@showLoginForm')->name('login');
Route::post('/login', 'App\Http\Controllers\AuthController@login');

Route::get('/register', 'App\Http\Controllers\AuthController@showRegistrationForm')->name('register');
Route::post('/register', 'App\Http\Controllers\AuthController@register');

Route::get('/logout', 'App\Http\Controllers\AuthController@logout')->name('logout');

Route::get('/admin','App\Http\Controllers\AdminController@index')->name('admin');

Route::group(['middleware' => 'admin'], function(){
    Route::controller(AdminController::class)->group(function () {
        Route::get('/admin', 'index')->name('admin.index');
        Route::post('/admin/addproduct', 'addproduct')->name('admin.addproduct');
    });
});

// Auth::routes();

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
