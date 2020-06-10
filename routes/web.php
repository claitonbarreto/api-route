<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return 'Api Connected';
});

$router->get('/hello', 'ApiController@getApi');

$router->get('/code/{cep}', 'ApiController@getGeoCode');

$router->get('/route/{cep_origem}/{cep_destino}', 'RouteController@showRoute');
$router->get('/testroute', 'RouteController@route');