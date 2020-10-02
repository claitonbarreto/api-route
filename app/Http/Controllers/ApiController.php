<?php

namespace App\Http\Controllers;

use App\Services\GeoCode;


class ApiController extends Controller
{
    
    // Retorna dados sobre um unico Cep: Endereço, Latitude e Longitude
    public function getGeoCode($cep)
    {

        $geocode = new GeoCode();
        $response = $geocode->getCodeFromCep($cep);

        if(strlen($cep) !== 8) {
            
            return response([
                'message' => 'Cep precisa ter 8 caracteres',
                'cod' => 2000
            ]);

        }
        
       return $response;
    }
}
