<?php

use Illuminate\Http\Request;
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
Route::post('/savesettings', function (Request $request) {
//	$data = $request->validate([
//		'value' => 'required',
//		'name' => 'requered'
//	]);

//	$settings = new \App\Settings($data);
//	$settings->exists = true;
//	$settings->where('id', 1);
//	$settings->value = $data['value'];
//	$settings->id = 1;
//	$settings->save();

//	return redirect('/settings');
});
