<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ShopController;

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
Route::get('/product/{product}', 'HomeController@show')->name('product.show');


// cart routes
Route::get('/cart', 'CartController@index')->name('cart.index');
Route::post('/add/{product}', 'CartController@addProductToCart')->name('add.cart');
Route::put('/update/{product}/cart', 'CartController@updateProductOnCart')->name('cart.update');
Route::delete('/remove/{product}/cart', 'CartController@removeProductFromCart')->name('remove.cart');

//payment routes

Route::post('/pay', 'PaymentController@pay')->name('pay');
Route::get('/success', 'PaymentController@success');
Route::get('/error', 'PaymentController@error');

// shop routes
Route::get('/shop/register', [App\Http\Controllers\ShopController::class, 'register'])->name('shop.register');
Route::post('/shop/register', [App\Http\Controllers\ShopController::class, 'processRegister'])->name('shop.register.submit');
Route::get('/shop/dashboard', [App\Http\Controllers\DashController::class, 'index'])->middleware(['auth'])->name('dashboard.index');

// admin routes
Route::get('/admin', 'AdminController@index')->name('admin.index');
Route::get('/admin/login', 'AdminController@showAdminLoginForm')->name('admin.login');
Route::post('/admin/login', 'AdminController@admineLogin')->name('admin.login');
Route::get('/admin/logout', 'AdminController@adminLogout')->name('admin.logout');
Route::get('/admin/products', 'AdminController@getProducts')->name('admin.products');
Route::get('/admin/orders', 'AdminController@getOrders')->name('admin.orders');

//orders routes
Route::resource('orders', OrderController::class);

//category routes
Route::resource('categories', CategoryController::class);







