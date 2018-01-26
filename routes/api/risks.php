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

$app->group(['namespace' => 'App\Http\Controllers', 'prefix' => 'api/v1/risks'], function () use ($app) {
    $app->get('/', ['middleware' => 'auth:admin', 'uses' => 'RiskJSONController@index']);
    $app->post('/', ['middleware' => 'auth:admin', 'uses' => 'RiskJSONController@save']);
    $app->post('/pra', ['middleware' => 'auth:admin', 'uses' => 'PraJSONController@save']);
    $app->get('/pra/{id}', ['middleware' => 'auth:admin', 'uses' => 'PraJSONController@getPRAFromActivity']);
    $app->delete('/{id}', ['middleware' => 'auth:admin', 'uses' => 'RiskJSONController@delete']);
});

