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

Route::prefix('backend')->namespace('Api')->group(function() {
	Route::get('grup-user/table', 'GrupUserController@table')->name('grup-user.table');
	Route::get('grup-user/{grup_user}/data', 'GrupUserController@data')->name('grup-user.data');
	Route::apiResource('grup-user', 'GrupUserController')->only([
	    'store', 'update', 'destroy'
	]);

	Route::get('user/table', 'UserController@table')->name('user.table');
	Route::get('user/{user}/data', 'UserController@data')->name('user.data');
	Route::apiResource('user', 'UserController')->only([
	    'store', 'update', 'destroy'
	]);

	Route::get('member/table', 'MemberController@table')->name('member.table');
	Route::get('member/{member}/data', 'MemberController@data')->name('member.data');
	Route::apiResource('member', 'MemberController')->only([
	    'store', 'update', 'destroy'
	]);

});
