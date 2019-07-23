<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;




class Settings extends Controller
{
    function getSettings() {

    	$menu =  new Menu();
    	$menu = $menu->makemenu();

    	return view('settings', ['menunav' => $menu]);
    }
}