<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;

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

// login & register routes & verification routes
Route::middleware(['auth:sanctum',config('jetstream.auth_session'), 'verified'])->group(function () {
Route::get('/dashboard', function () { return view('dashboard');})->name('dashboard');});

// home page route
Route::get('/', 'HomeController@index')->name('home');

// product routes
Route::resource('products', ProductController::class);
Route::get('/category/{category}', 'HomeController@showByCategory')->name('category.products');

// cart routes
Route::get('/cart', 'CartController@index')->name('cart.index');
Route::post('/add/{product}', 'CartController@addProductToCart')->name('add.cart');
Route::put('/update/{product}/cart', 'CartController@updateProductOnCart')->name('cart.update');
Route::delete('/remove/{product}/cart', 'CartController@removeProductFromCart')->name('remove.cart');

