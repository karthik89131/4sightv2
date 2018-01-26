<?php


$app->group(['namespace' => 'App\Http\Controllers', 'prefix' => 'api/v1/project'], function () use ($app) {
    $app->get('/', ['middleware' => 'auth:api', 'uses' => 'ProjectsJSONController@index']);
    $app->post('/', ['middleware' => 'auth:api', 'uses' => 'ProjectsJSONController@save']);
    $app->get('/types', ['middleware' => 'auth:api', 'uses' => 'ProjectsJSONController@types']);
    $app->get('/classifications', ['middleware' => 'auth:api', 'uses' => 'ProjectsJSONController@classifications']);
    $app->get('/companies', ['middleware' => 'auth:api', 'uses' => 'ProjectsJSONController@companies']);
    $app->get('/plant_capacity_units', ['middleware' => 'auth:api', 'uses' => 'ProjectsJSONController@plant_capacity_units']);
    $app->get('/currencies', ['middleware' => 'auth:api', 'uses' => 'ProjectsJSONController@currencies']);
    $app->get('/contracting_modes', ['middleware' => 'auth:api', 'uses' => 'ProjectsJSONController@contracting_modes']);
    $app->get('/config_date_fields', ['middleware' => 'auth:api', 'uses' => 'ProjectsJSONController@config_date_fields']);
    $app->get('/by_id/{id}', ['middleware' => 'auth:api', 'uses' => 'ProjectsJSONController@get']);
    //$app->get('/project_date_fields', ['middleware' => 'auth:api', 'uses' => 'ProjectsJSONController@config_date_fields']);
});

