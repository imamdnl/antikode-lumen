<?php

/** @var \Laravel\Lumen\Routing\Router $router */

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

$router->group(['prefix' => 'brand'], function () use ($router) {
    $router->post('create', 'BrandController@create');
    $router->put('update', 'BrandController@update');
    $router->delete('delete', 'BrandController@delete');
    $router->get('/', 'BrandController@getBrands');
});

$router->group(['prefix' => 'outlet'], function () use ($router) {
    $router->post('create', 'OutletController@create');
    $router->put('update', 'OutletController@update');
    $router->delete('delete', 'OutletController@delete');
    $router->get('/', 'OutletController@getOutlets');
});

$router->group(['prefix' => 'product'], function () use ($router) {
    $router->post('create', 'ProductController@create');
    $router->put('update', 'ProductController@update');
    $router->delete('delete', 'ProductController@delete');
    $router->get('/', 'ProductController@getProducts');
});
