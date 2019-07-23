<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

//use nathanmac\parser\Facades\Parser as XmlParser2; 

class Plex extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
       // return view('scan');
    }

    public function getXml() {

        $xml = simplexml_load_file('http://kevin-nas:32400/library/sections/1/all?X-Plex-Token=rLDsHXX_9Q52ePjdkPZm');

        $moviesarr = array();
        $title = null;
        foreach($xml->Video as $video) {
            //var_dump($video->attributes()->title);
            $title = (string)$video->attributes()->title;
            $titlearr = array('title'=>$title);
            $movies[$title] = $titlearr;
        
        }

        return view('scan', ['movies'=>$movies]);
    }

}
