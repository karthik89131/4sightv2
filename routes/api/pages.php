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

$app->group(['namespace' => 'App\Http\Controllers', 'prefix' => 'api/v1/pages'], function () use ($app) {
    $app->get('/tables', ['middleware' => 'auth:admin', 'uses' => 'PagesJSONController@listTables']);
    $app->get('/table/{table_name}', ['middleware' => 'auth:api', 'uses' => 'PagesJSONController@getTable']);
    $app->post('/table/{table_name}', ['middleware' => 'auth:api', 'uses' => 'PagesJSONController@setTable']);
});

