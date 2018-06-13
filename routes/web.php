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

Route::get('/video/{video}/votes', 'VideoVoteController@show');

Route::get('/video/{video}/comment', 'CommentController@index');

Route::get('/video/{video}', 'VideoController@show');

Route::get('/search', 'SearchController@index');

Route::post('/video/{video}/views', 'VideoViewController@store');

Route::middleware(['auth'])->group(function() {

Route::post('/video/{video}/votes', 'VideoVoteController@createVote');
Route::delete('/video/{video}/votes', 'VideoVoteController@deleteVote');

Route::get('/channel/{channel}/edit', 'ChannelSettingsController@edit')->name('channel.edit');
Route::put('/channel/{channel}/edit', 'ChannelSettingsController@update')->name('channel.update');

Route::get('/upload', 'UploadVideoController@index')->name('video.index');
Route::post('/upload', 'UploadVideoController@store')->name('video.uploade');


Route::post('/video', 'VideoController@store')->name('video.store');
Route::get('/videos', 'VideoController@index');
Route::post('/video/{video}', 'VideoController@update')->name('video.update');
Route::get('/videos/{video}/edit', 'VideoController@edit')->name('video.edit');
Route::delete('/videos/{video}/delete', 'VideoController@delete')->name('video.delete');


	

});
