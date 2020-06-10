<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
//use Illuminate\Support\Facades\Config;
use App\Services\ViaCep;

class Geocode 
{   
    private $keys = [];
    private $baseUrl = 'https://geocoder.api.here.com/6.2/';
    private $routeUrl = 'https://route.ls.hereapi.com/routing/7.2/';


    public function __construct()
    {
        $this->keys['route_api_key'] = env('ROUTE_API_KEY');//config('services.here.route_api_key');
        $this->keys['geocode_app_id'] = env('GEOCODE_APP_ID');//config('services.geocode_id');
        $this->keys['geocode_app_code'] = env('GEOCODE_APP_CODE');//config('services.geocode_appcode');
    }

    public function getCodeFromCep($cep)
    {   

        $response = [];

        $vcep = new ViaCep();

        $res = $vcep->checkCep($cep);

        $response['dataCep'] = json_decode($res);

        $url = $this->baseUrl.'geocode.json?app_id='.$this->keys['geocode_app_id'].'&app_code='.$this->keys['geocode_app_code'].'&searchtext='.$cep;

        $rawCodeResponse = Http::get($url);

        $response['geoCode'] = json_decode($rawCodeResponse);
        
        echo $url;
    }

    public function route()
    {   
        //$res = Http::get($this->routeUrl.'calculateroute.json?apiKey='.$this->keys['route_api_key'].'&waypoint0=geo!52.5,13.4&waypoint1=geo!52.5,13.45&mode=fastest;car;traffic:disabled');

        //return json_decode($res);

        var_dump($this->keys); //TODO = Definir Uso das API's KEYS dentro da aplicação
    }
}