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

$app->group(['namespace' => 'App\Http\Controllers', 'prefix' => 'api/v1/auth'], function () use ($app) {
    $app->post('/login', ['as' => 'auth', 'uses' => 'AuthJSONController@login']);
    $app->post('/logout', ['middleware' => 'auth:api', 'as' => 'auth', 'uses' => 'AuthJSONController@logout']);
    $app->get('/test', ['middleware' => 'auth:api', 'as' => 'users', 'uses' => 'UsersJSONController@test']);
});

