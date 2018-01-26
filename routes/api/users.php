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

$app->group(['namespace' => 'App\Http\Controllers', 'prefix' => 'api/v1/users'], function () use ($app) {
    $app->get('/', ['middleware' => 'auth:admin', 'as' => 'users', 'uses' => 'UsersJSONController@index']);
    $app->get('/me', ['middleware' => 'auth:api', 'uses' => 'UsersJSONController@me']);
    $app->get('/test', ['middleware' => 'auth:api', 'as' => 'users', 'uses' => 'UsersJSONController@test']);
    $app->get('/listing', ['middleware' => 'auth:api', 'as' => 'users', 'uses' => 'UsersJSONController@index']);
});

