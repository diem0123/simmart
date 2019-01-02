<?php

use Illuminate\Http\Request;

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

Route::group(['middleware' => ['web']], function () {

/* ========== > ADMIN < ========== */
	Route::get('/cauhinh', 'API_ghtk\ghtkController@cauhinhGet')->name('/cauhinh')->middleware('CheckAdmin');
	Route::post('/cauhinh', 'API_ghtk\ghtkController@cauhinhPost')->name('/cauhinh')->middleware('CheckAdmin');

	Route::get('/trangthai', 'API_ghtk\ghtkController@trangthaiGet')->name('/trangthai')->middleware('CheckAdmin');
	Route::post('/trangthai', 'API_ghtk\ghtkController@trangthaiPost')->name('/trangthai')->middleware('CheckAdmin');

	Route::get('/huydonhang', 'API_ghtk\ghtkController@huydonhangGet')->name('/huydonhang')->middleware('CheckAdmin');

	Route::get('/duyetdonhang', 'API_ghtk\ghtkController@duyetdonhangGet')->name('/duyetdonhang')->middleware('CheckAdmin');
	Route::get('/delduyetdonhang', 'API_ghtk\ghtkController@delduyetdonhangGet')->name('/delduyetdonhang')->middleware('CheckAdmin');
	Route::post('/duyetdonhang', 'API_ghtk\ghtkController@duyetdonhangPost')->name('/duyetdonhang')->middleware('CheckAdmin');

	Route::get('/taodonhang', 'API_ghtk\ghtkController@taodonhangGet')->name('/taodonhang');
	
	// Route::post('/tinhcuoc', 'api_tinh_cuoc_ghtkController@tinhcuoc')->name('/tinhcuoc');

	Route::get('/file', 'API_ghtk\ghtkController@file')->name('/file')->middleware('CheckAdmin');
/* ========== > / ADMIN < ========== */

/* ========== > PAGE < ========== */
	Route::get('/tinhcuocvanchuyen', 'API_ghtk\ghtkController@tinhcuocvanchuyenGet')->name('/tinhcuocvanchuyen');

	Route::get('/luudonhang', 'API_ghtk\ghtkController@luudonhangGet')->name('/luudonhang')/*->middleware('CheckAdmin')*/;
/* ========== > / PAGE < ========== */

});
