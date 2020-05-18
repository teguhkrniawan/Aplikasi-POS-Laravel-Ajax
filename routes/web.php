<?php

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

Auth::routes(); //route autentikasi (login, register, logout)
Route::get('/', 'HomeController@index')->name('home'); //route home biasa

// Route middleware - hak akses admin
Route::group(['middleware' => ['web', 'cekuser:1']], function(){
    Route::get('kategori/data', 'KategoriController@listData')->name('kategori.data');
    Route::resource('kategori', 'kategoriController');
});