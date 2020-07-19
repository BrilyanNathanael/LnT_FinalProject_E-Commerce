<?php

use Illuminate\Support\Facades\Route;
use App\Barang;
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
    $barang = Barang::all();
    return view('welcome',compact('barang'));
});

Auth::routes();
Route::group(['middleware' => ['auth']],function(){
    Route::resource('cart', 'CartController');
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/logout','Auth\LoginController@logout');
    Route::get('/show/{id}', 'ShowController@show');
    Route::get('/create-kategori', 'KategoriController@create');
    Route::post('/create-kategori', 'KategoriController@store');
    Route::get('/checkout', 'CartController@checkout');
    Route::post('/checkout', 'CartController@processing');
    Route::get('/invoice', 'CartController@invoice');
    Route::get('/detail-order/{id}', 'CartController@detail');
    Route::delete('/reimburse/{id}', 'CartController@reimburse');
});
Route::group(['middleware'=>['auth','admin']],function(){
    Route::get('/list', 'AdminController@index');
    Route::get('/pengguna', 'AdminController@pengguna');
    Route::get('/create', 'AdminController@create');
    Route::post('/store', 'AdminController@store');
    Route::get('terjual', 'AdminController@terjual');
    Route::get('/edit/{id}', 'AdminController@edit');
    Route::patch('/update/{id}', 'AdminController@update');
    Route::delete('/delete/{id}', 'AdminController@destroy');
});

