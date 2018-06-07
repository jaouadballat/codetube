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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


Route::middleware(['auth'])->group(function() {

Route::get('/channel/{channel}/edit', 'ChannelSettingsController@edit')->name('channel.edit');
Route::put('/channel/{channel}/edit', 'ChannelSettingsController@update')->name('channel.update');

Route::get('/upload', 'UploadVideoController@index')->name('video.index');

	// Route::get('/channel/{channel}/edit', 'ChannelSettingsController@edit')->name('channel.edit');

});
