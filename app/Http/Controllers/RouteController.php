<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\GeoCode;

class RouteController extends Controller
{
    public function showRoute(Request $request)
    {
        $response = [];

        $geocode = new GeoCode();

        $response['origem'] = $geocode->getCodeFromCep($request['cep_origem']);
        $response['destino'] = $geocode->getCodeFromCep($request['cep_destino']);

        return response()->json($response);
    }

    public function route()
    {
        $geocode = new GeoCode();

        $response = $geocode->route();

        //var_dump($response);
    }
}