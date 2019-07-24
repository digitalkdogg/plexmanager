<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;




class Settings extends Controller
{
    function getSettings() {
    	$settings = \App\Settings::all();
    	return view('settings', ['settings'=> $settings]);
    }

    function getOneSetting($id) {
    	$setting = \App\Settings::find($id);
    	return $setting;
    }
}