<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//
Route::get('member/datatable', 'MemberController@datatable');

// Android
Route::post('register/member', 'MemberController@registerMember');
Route::post('login/member', 'LoginController@loginMember');
Route::group(["middleware" => "auth:member"], function() {
    //
    Route::post('antrian', 'BookingController@antrian');
    Route::post('register/booking', 'BookingController@registerBooking');
    Route::get('data/booking', 'BookingController@dataBooking');
    Route::get('data/laporan', 'LaporanController@dataLaporan');
    Route::post('saran', 'LaporanController@saranMember');
});
