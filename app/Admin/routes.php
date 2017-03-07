<?php

use Illuminate\Routing\Router;

Route::group([
    'prefix'        => config('admin.prefix'),
    'namespace'     => Admin::controllerNamespace(),
    'middleware'    => ['web', 'admin'],
], function (Router $router) {

    $router->get('/', 'HomeController@index');
    $router->resource('categories', CategoryController::class);
    $router->resource('products', ProductController::class);
    $router->resource('activities', ActivityController::class);

});
