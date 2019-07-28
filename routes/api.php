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

/********** Post Save Settings *****************************
* Purpose : handle the post of the save settings api call  *
* Inputs : form posts of id, name, value                   *
* Returns : json of returnarray with status and/or error   *
*            message if it errors                          *
***********************************************************/
Route::post('/save_settings', function() {
	
	$inputs = Input::all();
	$inputs = json_decode($inputs['data'], true);

	$returnarr = array('status'=>'Nothing To Update');

	$settings = new \App\Settings();
	$settingctl = new \App\Http\Controllers\Settings();
	
	foreach($inputs as $data) {

		$oldrec = DB::table('settings')->where('id', $data['id'])->first();

		if($data['value'] != '' && isset($data['value'])) { 
			if($oldrec->value != $data['value']) {
				$returnarr = $settingctl->updateOneSetting($returnarr, $settings, $data);
			}
		}
	}
	return json_encode($returnarr);
});
//end post save settings

Route::post('/save_scan', function () {
	$inputs = Input::all();

	$returnarr = array('status'=>'Nothing To Update');
		$oldrec = DB::table('movies')->where('key', $inputs['key'])->first();
		$movie = new \App\Movie($inputs);
		
		if (is_null($oldrec)==true) {
			$movie->name = $inputs['name'];
			$movie->key = $inputs['key'];
			$movie->format = $inputs['format'];
			$movie->thumbnail = $inputs['thumbnail'];
			try {
				$movie->save();
				$returnarr['status'] = 'added';
			} catch (exception $e) {
				$returnarr['status'] = 'error';
			}
		} else {
			$inputs['id'] = $oldrec->id;
			$moviectl = new \App\Http\Controllers\Movies();
			$returnarr = $moviectl->updateOneMovie($movie, $returnarr, $inputs);
			$returnarr['status'] = 'updated';
		} 

		//var_dump($oldrec);
	//}

	return json_encode($returnarr);
});
//end post save scan