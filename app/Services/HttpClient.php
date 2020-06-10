<?php

namespace App\Services;

use \Illuminate\Support\Facades\Http;

class HttpClient 
{
    private  $base_url;

    public function __construct($opts = [])
    {
        if(isset($opts['base_uri'])) $this->base_url = $opts['base_uri'];
    }

    public function get($url,$haveBaseUrl)
    {   

        if($haveBaseUrl){
            $url = "$this->base_url$url/json";
        }

        $res = Http::get($url);

        return $res;
    }
}