<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckOutController;
use Illuminate\Support\Facades\Route;
use Gloudemans\Shoppingcart\Facades\Cart;

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


/* Products Routes*/
Route::get('/boutique','ProductController@index')->name('products.index');

Route::get('/boutique/{slug}','ProductController@show')->name('products.show');

/* Cart Routes */
Route::post('/panier/ajouter','CartController@store')->name('cart.store');
Route::get('/mon-panier','CartController@index')->name('cart.index');
Route::delete('/panier/{rowId}','CartController@destroy')->name('cart.destroy');
Route::get('/videpanier',function(){
    Cart::destroy();
});

/*Checkout Routes */
Route::get('/paiement','CheckOutController@index')->name('checkout.index');
Route::post('/paiement','CheckOutController@store')->name('checkout.store');
Route::get('/merci','CheckOutController@thankyou')->name('checkout.thankyou');

