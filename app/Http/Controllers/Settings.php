<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;




class Settings extends Controller
{
    function getSettings() {

    	return view('settings');
    }
}