<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Menu extends Controller
{

	public function __construct(array $arguments = array()) {
        if (!empty($arguments)) {
            foreach ($arguments as $property => $argument) {
                $this->{$property} = $argument;
            }
        }
    }

    public function __call($method, $arguments) {
        $arguments = array_merge(array("Menu" => $this), $arguments); // Note: method argument 0 will always referred to the main class ($this).
        if (isset($this->{$method}) && is_callable($this->{$method})) {
            return call_user_func_array($this->{$method}, $arguments);
        } else {
            throw new Exception("Fatal error: Call to undefined method stdObject::{$method}()");
        }
    }

    public function makemenu() {
    	 $menu = new Menu();
    	 $menu->home = array(
    	 	'name'=>'Home', 
   			'href'=>'/#',
   			'classlist'=>'pure-menu-item pure-menu-selected',
   			'aclasslist'=>'pure-menu-link'
   			);
    	$manage = new Menu();
    	$manage->scan = array(
    		'name'=>'Scan',
    		'href' => '/scan',
    		'classlist'=>'',
   			'aclasslist'=>'');
    	$manage->update = array(
    		'name'=>'Update',
    		'href'=>'#',
    		'classlist'=>'',
   			'aclasslist'=>'');
    	$manage->delete = array(
    		'name' => 'Delete',
    		'href'=>'#',
    		'classlist'=>'',
   			'aclasslist'=>'');

 	  	$menu->manage = array(
    		'name'=> 'Manage',
    		'href'=> '/#',
    		'sub' => $manage,
    		'classlist'=>'',
   			'aclasslist'=>''
    	);

    	$menu->settings = array(
    		'name'=>'Settings',
    		'href' => '/settings',
    		'classlist'=>'pure-menu-item pure-menu-selected',
   			'aclasslist'=>'pure-menu-link');
    	return $menu;
    }

}
