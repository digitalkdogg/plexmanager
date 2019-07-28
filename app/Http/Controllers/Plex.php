<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

//use nathanmac\parser\Facades\Parser as XmlParser2; 

class Plex extends Controller
{
    public function getXml() {

        $setting = new Settings();
        $url = $setting->getOneSetting(1);

        $token = $setting->getOneSetting(2);

        $xml = simplexml_load_file($url->value .'/library/sections/1/all?X-Plex-Token=' . $token->value);


        $moviesarr = array();
        $title = null;
        $index = 0;
        foreach($xml->Video as $video) {
            $index = $index + 1;
            $title = (string)$video->attributes()->title;
            $key = (string)$video->attributes()->key;
            $titlearr = array('key' => str_replace("/", "-", $key), 'title'=>$title);
            $movies[$title] = $titlearr;
        
        }

        return view('scan', ['movies'=>$movies]);
    }

}
