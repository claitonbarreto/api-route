<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
//use Illuminate\Support\Facades\Config;
use App\Services\ViaCep;

class Geocode 
{   
    private $keys = [];
    private $baseUrl = 'https://geocoder.ls.hereapi.com/6.2/';
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

        $url = $this->baseUrl.'geocode.json?apiKey='.$this->keys['route_api_key'].'&searchtext='.$cep;

        $rawCodeResponse = Http::get($url);

        if(isset(json_decode($rawCodeResponse)->error)) 
            throw new \Exception('Credenciais HERE MAPS inválidas!', 23);

        $response['geoCode'] = $rawCodeResponse['Response']['View'][0]['Result'][0]['Location']['NavigationPosition'][0];
        
        return $response;
    }

    public function route($origem, $destino)
    {   
        $res = Http::get($this->routeUrl.'calculateroute.json?apiKey='.$this->keys['route_api_key'].'&waypoint0=geo!'.$origem['geoCode']['Latitude'].','.$origem['geoCode']['Longitude'].'&waypoint1=geo!'.$destino['geoCode']['Latitude'].','.$destino['geoCode']['Longitude'].'&mode=fastest;car;traffic:disabled');

        return json_decode($res);

    }
}