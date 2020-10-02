<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\GeoCode;

class RouteController extends Controller
{
    public function showRoute(Request $request)
    {        
        try {
            $geocode = new GeoCode();

            $origem = $geocode->getCodeFromCep($request['cep_origem']);
            $destino = $geocode->getCodeFromCep($request['cep_destino']);
            $route = $geocode->route($origem, $destino)->response;

            $origemCep = $origem['dataCep'];
            $origemCoords = $origem['geoCode'];
            $destinoCep = $destino['dataCep'];
            $destinoCoords = $destino['geoCode'];


            $response = [
                'origin' => [
                    'postalCode' => $origemCep->cep,
                    'street' => $origemCep->logradouro,
                    'neighborhood' => $origemCep->bairro,
                    'city' => $origemCep->localidade,
                    'state' => $origemCep->uf,
                    'lat' => $origemCoords['Latitude'],
                    'lon' => $origemCoords['Longitude']
                ],

                'destiny' => [
                    'postalCode' => $destinoCep->cep,
                    'street' => $destinoCep->logradouro,
                    'neighborhood' => $destinoCep->bairro,
                    'city' => $destinoCep->localidade,
                    'state' => $destinoCep->uf,
                    'lat' => $destinoCoords['Latitude'],
                    'lon' => $destinoCoords['Longitude']
                ],

                'route' => [
                    'postaCodeOrigin' => $destinoCep->cep,
                    'postalCodeDestiny' => $origemCep->cep,
                    'distance' => $route->route[0]->summary->distance,
                    'vehicle' => $route->route[0]->mode->transportModes,
                    'baseTime' => $route->route[0]->summary->baseTime
                ]
            ];

            return response()->json($response);
        
        } catch (\Exception $e) {
        
            $error = [
                'error' => true,
                'message' => $e->getMessage(),
                'code' => $e->getCode(),
                'file' => $e->getFile(),
                'line' => $e->getLine()
            ];

            return response()->json($error);
        }   
    }

    public function route()
    {
        $geocode = new GeoCode();

        $response = $geocode->route();

        var_dump($response);
    }
}