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

$router->post('api/login', 'API\UserController@login');

$router->group(['prefix' => '/api', 'middleware' => 'jwt.auth'], function () use ($router) {
    $router->get('loans', 'API\LoanController@index');
    $router->post('loans', 'API\LoanController@store');
    $router->get('loans/{id}', 'API\LoanController@show');
    $router->put('loans/{id}', 'API\LoanController@update');
    $router->delete('loans/{id}', 'API\LoanController@delete');
});


