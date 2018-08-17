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
    return $router->app->version();
});

$router->group(['prefix' => 'api'], function ($router) {
    $router->group(['prefix' => 'products'], function ($router) {
        $router->get('/', 'ProductController@index');
        $router->post('/', 'ProductController@store');

        $router->group(['prefix' => '/{id}', 'middleware' => 'findProduct'], function ($router) {
            $router->get('/', 'ProductController@show');
            $router->patch('/', 'ProductController@update');
            $router->delete('/', 'ProductController@destroy');
        });
    });
});
