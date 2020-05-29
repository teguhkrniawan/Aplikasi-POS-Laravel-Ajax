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
Route::group(['middleware' => ['auth', 'cekuser:1']], function(){
    Route::get('kategori/data', 'KategoriController@listData')->name('kategori.data');
    Route::resource('kategori', 'kategoriController');

    Route::get('produk/data', 'ProdukController@listData')->name('produk.data');
    Route::post('produk/hapus', 'ProdukController@deleteSelected');
    Route::post('produk/cetak', 'ProdukController@printBarcode');
    Route::resource('produk', 'ProdukController');

    Route::get('supplier/data', 'SupplierController@listData')->name('supplier.data');
    Route::resource('supplier', 'SupplierController');

    Route::get('member/data', 'MemberController@listData')->name('member.data');
    Route::post('member/cetak', 'MemberController@printCard');
    Route::resource('member', 'MemberController');

    Route::get('pengeluaran/data', 'PengeluaranController@listData')->name('pengeluaran.data');
    Route::resource('pengeluaran', 'PengeluaranController');

    // route untuk manipulasi data kasir
    Route::get('user/data', 'UserController@listData')->name('user.data');
    Route::resource('user', 'UserController');
});

// Route untuk edit profil ketika login
Route::group(['middleware' => 'web'], function(){
    Route::get('user/profil', 'UserController@profil')->name('user.profil');
    Route::patch('user/{id}/change', 'UserController@changeProfil');
});