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

Route::get('/', function () {
    return view('login');
});

Route::post('admin/login','LoginController@login')->name('postlogin');
Route::get('login', 'LoginController@index')->name('login');

Route::group(['middleware' => 'auth:admin'], function () {
    Route::get('logout','LoginController@logout')->name('logout');
    Route::get('home', 'HomeController@index');
    //
    Route::get('data/booking', 'BookingController@index')->name('databooking');
    Route::delete('data/booking/{id?}', 'BookingController@remove')->name('hapusbooking');
    Route::get('export/booking', 'BookingController@export')->name('exportbooking');
    //
    Route::get('data/laporan', 'LaporanController@index')->name('laporan');
    //
    Route::get('data/saran', 'SaranController@index')->name('saran');
    Route::delete('data/saran/{id?}', 'SaranController@remove')->name('hapussaran');
    //
    Route::get('data/member', 'MemberController@index')->name('datamember');
    Route::post('data/member', 'MemberController@add')->name('tambahmember');
    Route::delete('data/member/{id?}', 'MemberController@remove')->name('hapusmember');
    Route::get('data/member/{id?}', 'MemberController@get')->name('editmember');
    Route::put('data/member', 'MemberController@update')->name('updatemember');
    //
    Route::post('tambah/data/laporan', 'LaporanController@add')->name('tambahcatatan');
    Route::get('data/laporan/edit/{id?}', 'LaporanController@get')->name('editcatatan');
    Route::get('data/laporan/tambah/{id?}', 'LaporanController@formadd')->name('addcatatan');
    Route::put('data/laporan', 'LaporanController@update')->name('updatecatatan');
});
