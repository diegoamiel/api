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
$router->post('user/login', ['uses'=>'UserController@getToken']);

$router->group(['middleware' => ['auth']], function () use ($router){
    $router->get('/user', ['uses'=>'UserController@index']);
    $router->post('/user', ['uses'=>'UserController@create']);
});







$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->get('/key', function () {
    $pool = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

    return substr(str_shuffle(str_repeat($pool, 5)), 0, 32);
});


//$router->get('/user', 'UserController@index');
//$router->post('/libros', 'libroController@guardar');




