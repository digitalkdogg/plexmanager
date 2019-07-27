<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

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

Route::get('/get_settings', 'Settings@getJustSettings');

Route::post('/save_settings', function() {
	
	$inputs = Input::all();
	$inputs = json_decode($inputs['data'], true);

	$returnarr = array('status'=>'Nothing To Update');

	$settings = new \App\Settings();
	foreach($inputs as $data) {

		$oldrec = DB::table('settings')->where('id', $data['id'])->first();

		if($data['value'] != '' && isset($data['value'])) { 
			if($oldrec->value != $data['value']) {
				$settings->exists = true;
				$settings->value = $data['value'];
				$settings->id = $data['id'];
				try {
					$settings->save();
					$returnarr['status'] = 'Settings Updated';
				} catch(exception $e) {
					$returnarr['status'] = 'error';
					$returnarr['msg'] = json_encode($e);
					$returnarr['id']= $data['id'];
				}
			}
		}
	}
	return json_encode($returnarr);
});