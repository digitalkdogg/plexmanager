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
        foreach($xml->Video as $video) {
            $title = (string)$video->attributes()->title;
            $titlearr = array('title'=>$title);
            $movies[$title] = $titlearr;
        
        }

        return view('scan', ['movies'=>$movies]);
    }

}
