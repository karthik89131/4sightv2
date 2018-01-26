<?php

$app->group(['namespace' => 'App\Http\Controllers', 'prefix' => 'api/v1/internalprojects'], function () use ($app) {
    $app->get('/getprojects', ['middleware' => 'auth:api', 'uses' => 'InternalProjectsJSONController@getprojects']);
    $app->post('/addproject', ['middleware' => 'auth:api', 'uses' => 'InternalProjectsJSONController@addproject']);
    $app->post('/delproject', ['middleware' => 'auth:api', 'uses' => 'InternalProjectsJSONController@delproject']);
});

