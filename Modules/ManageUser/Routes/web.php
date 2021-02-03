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

Route::middleware('auth')->group(function() {
	require __DIR__.'/api.php';
});

Route::prefix('kelola-user')->namespace('View')->group(function() {
	Route::resource('grup-user', 'GrupUserController')->only([
	    'index', 'create', 'edit'
	]);

	Route::resource('user', 'UserController')->only([
	    'index', 'create', 'edit'
	]);

	Route::resource('member', 'MemberController')->only([
	    'index', 'create', 'edit'
	]);

});

Route::prefix('auth')->namespace('Auth')->group(function() {
	Route::namespace('Backend')->group(function() {
		Route::get('login', 'LoginController@showLoginForm')->name('login');
		Route::post('login', 'LoginController@login')->name('post-login');
		Route::match(['GET', 'POST'], 'logout', 'LoginController@logout')->name('logout');
		
		Route::prefix('password')->group(function() {
			Route::get('request', 'ForgotPasswordController@showForgotPasswordForm')->name('password.request');
			Route::post('email', 'ForgotPasswordController@forgotPassword')->name('password.email');
			
			Route::post('reset', 'ResetPasswordController@resetPassword')->name('password.update');
			Route::get('reset/{token}', 'ResetPasswordController@showResetPasswordForm')->name('password.reset');
		});
	});
});
