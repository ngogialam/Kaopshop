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

// Route::get('/', function () {
//     return view('master');
// });
Route::get('index','PageController@getIndex')->name('trangchu');
Route::get('/','PageController@mot');
Route::get('loai-san-pham/{type}','PageController@getLoaiSp')->name('loaisp');
Route::get('chi-tiet-loai-san-pham/{id}','PageController@getChitiet')->name('chitietsanpham');
Route::get('lien-he','PageController@getlienhe')->name('lienhe');
Route::get('gioi-thieu','PageController@getgioithieu')->name('gioithieu');
Route::get('add-to-cart/{id}','PageController@getAddtoCart')->name('themgiohang');

Route::get('del-cart/{id}','PageController@getDelItemCart')->name('xoagiohang');
Route::post('dat-hang','PageController@postCheckout')->name('dathang');
Route::get('dat-hang','PageController@getCheckout')->name('dathang');
Route::get('dat-hang-thanh-cong','PageController@getdathang')->name('dathangthanhcong');
Route::get('dang-nhap','PageController@getLogin')->name('login');
Route::post('dang-nhap','PageController@postLogin')->name('login');
Route::get('dang-ky','PageController@getSignin')->name('signin');
Route::post('dang-ky','PageController@postSignin')->name('signin');
Route::get('youtube','PageController@getyoutube')->name('youtube');

