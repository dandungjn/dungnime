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

Route::prefix('konten')->namespace('Api')->group(function() {
	Route::get('anime/table', 'AnimeController@table')->name('anime.table');
	Route::get('anime/{anime}/data', 'AnimeController@data')->name('anime.data');
	Route::apiResource('anime', 'AnimeController')->parameters(['anime' => 'anime'])->only([
	    'store', 'update', 'destroy'
	])->shallow();

Route::get('anime/{anime}/episode/table', 'EpisodeController@table')->name('episode.table');
	Route::get('episode/{episode}/data', 'EpisodeController@data')->name('episode.data');
	Route::apiResource('anime.episode', 'EpisodeController')->parameters(['anime' => 'anime', 'episode' => 'episode'])->only([
	    'store', 'update', 'destroy'
	])->shallow();
});