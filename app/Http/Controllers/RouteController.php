<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\GeoCode;

class RouteController extends Controller
{
    public function showRoute(Request $request)
    {        
        try {
            $response = [];

            $geocode = new GeoCode();

            $response['origem'] = $geocode->getCodeFromCep($request['cep_origem']);
            $response['destino'] = $geocode->getCodeFromCep($request['cep_destino']);

            $response['route'] = $geocode->route($response['origem'], $response['destino']);

            return response()->json($response);
        } catch (\Exception $e) {
            
            //se no caminho até aqui foi lançada uma \Exception, irá estourar aqui
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

    public function test(Request $request)
    {

    }
}