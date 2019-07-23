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
	$movies = \App\Movie::all();
    return view('home', ['movies' => $movies]);
});

Route::get('scan', 'Plex@getXml');
Route::get('settings', 'Settings@getSettings');
//Route::get('/scan', function () {
	//var_dump(\App\Plex::all());
   // return view('scan');

//});