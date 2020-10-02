<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use App\Services\HttpClient;

class ViaCep
{
    public $client;

    public function __construct()
    {
        $this->client = new HttpClient([
            'base_uri'=>'http://viacep.com.br/ws/'
        ]);
    }

    public function checkCep($cep)
    {
        $res = $this->client->get($cep,true);

        $resJson = json_decode($res);
        
        if(isset($resJson->erro) == true || $resJson == null) 
            throw new \Exception("Um ou mais CEPs não foram encontrados na base de dados", 21);
    
        return $res;
    }
}