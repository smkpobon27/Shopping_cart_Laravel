<?php

use Illuminate\Support\Facades\Route;

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

//Admin routes
Route::get('/admin/home', 'AdminController@index');
Route::resource('/admin/categories', 'CategoryController');
Route::resource('/admin/products', 'ProductController');
Route::get('/admin/orders', 'AdminController@showAllOrders');
Route::get('/admin/order/view/{id}', 'AdminController@viewSingleOrder');
Route::get('/admin/order/shipped/{id}', 'AdminController@orderShipped');
Route::get('/admin/order/cancelled/{id}', 'AdminController@orderCancelled');

//User routes
Route::get('/', 'ShopController@index');
Route::get('/products', 'ShopController@products');
Route::get('/product/single/{id}', 'ShopController@singleProduct');
Route::get('/product/cart', 'ShopController@cart');
Route::get('/product/add-to-cart/{id}', 'ShopController@addToCart');
Route::put('/update-cart', 'ShopController@updateCart');
Route::delete('/remove-from-cart', 'ShopController@removeFromCart');
Route::get('/checkout', 'ShopController@checkout');
Route::post('/order', 'ShopController@order');
