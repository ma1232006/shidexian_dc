<?php

use Illuminate\Routing\Router;

Admin::registerAuthRoutes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
], function (Router $router) {

    $router->get('/', 'HomeController@index');

    $router->resource('title', 'TitleController');
    $router->resource('answer', 'AnswerController');
    $router->resource('count-message', 'MessageCountController');

    $router->get('count-text', 'AnswerTextCountController@index');
    $router->get('count', 'CountController@index');

});
