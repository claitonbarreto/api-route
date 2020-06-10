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

        return $res;
    }
}