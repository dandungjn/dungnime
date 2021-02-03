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

Route::prefix('konten')->namespace('View')->group(function() {
	Route::resource('anime', 'AnimeController')->parameters(['anime' => 'anime'])->only([
	    'index', 'create', 'edit', 'show'
	]);

	Route::resource('anime.episode', 'EpisodeController')->parameters(['anime' => 'anime', 'episode' => 'episode'])->only([
	    'index', 'create', 'edit'
	])->shallow();
});
