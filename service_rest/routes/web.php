<?php

use App\Http\Controllers\SoapController;
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

$router->group(['prefix' => 'api'], function () use ($router) {
    $router->get('/balance',  [SoapController::class, 'balance']);
    $router->get('balance',  [SoapController::class, 'balance']);
    $router->post('/client',  [SoapController::class, 'storeClient']);
    $router->post('/pay',  [SoapController::class, 'pay']);
    $router->post('/payConfirm',  [SoapController::class, 'payConfirm']);
    $router->post('/recharge',  [SoapController::class, 'recharge']);
});



$router->group(['prefix' => 'api'], function () use ($router) {
    $router->get('balance',  ['uses' => 'SoapController@balance']);
    $router->post('client',  ['uses' => 'SoapController@client']);
    $router->post('pay',  ['uses' => 'SoapController@pay']);
    $router->post('payConfirm',  ['uses' => 'SoapController@payConfirm']);
    $router->post('recharge',  ['uses' => 'SoapController@recharge']);
});