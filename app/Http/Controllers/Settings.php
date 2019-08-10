<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


class Settings extends Controller
{
    function getSettings() {
    	$settings = \App\Settings::all();
    	return view('settings', ['settings'=> $settings]);
    }

    function getJustSettings() {
        return \App\Settings::all();


    }

    function getOneSetting($id) {
    	$setting = \App\Settings::find($id);
    	return $setting;
    }

    function updateOneSetting($returnarr, $settings, $data) {
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

		return $returnarr;
    }
}