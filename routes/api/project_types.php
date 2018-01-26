<?php


$app->group(['namespace' => 'App\Http\Controllers', 'prefix' => 'api/v1/project_type'], function () use ($app) {
    $app->get('/', ['middleware' => 'auth:api', 'uses' => 'ProjectTypeJSONController@listing']);
    $app->post('/', ['middleware' => 'auth:api', 'uses' => 'ProjectTypeJSONController@save']);
    $app->get('/by_id/{id}', ['middleware' => 'auth:api', 'uses' => 'ProjectTypeJSONController@getByID']);
    $app->delete('/by_id/{id}', ['middleware' => 'auth:api', 'uses' => 'ProjectTypeJSONController@deleteByID']);
    $app->get('/activities', ['middleware' => 'auth:api', 'uses' => 'ProjectTypeJSONController@get_activities']);
    $app->post('/activities', ['middleware' => 'auth:api', 'uses' => 'ProjectTypeJSONController@add_activities']);
});

