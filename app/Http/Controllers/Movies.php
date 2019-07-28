<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Movies extends Controller
{
    public function updateOneMovie($movie, $returnarr, $data) {
    	$movie->exists = true;
		$movie->key = $data['key'];
		$movie->name = $data['name'];
		$movie->id = $data['id'];
		try {
			$movie->save();
			$returnarr['status'] = 'updated';
		} catch(exception $e) {
			$returnarr['status'] = 'error';
			$returnarr['msg'] = json_encode($e);
			$returnarr['id']= $data['id'];
		}

		return $returnarr;
    }
}
