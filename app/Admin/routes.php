<?php

use Illuminate\Routing\Router;

Admin::registerAuthRoutes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
], function (Router $router) {

    $router->resources([
        'categories'           => CategoryController::class,
        'customers'            => CustomerController::class,
        'notices'              => NoticeController::class,
        'business'             => BusinessController::class,
        'free'                 => FreeController::class,
       // 'statistics/collect'   => CollectController::class,

    ]);
    $router->resource('comments', 'CommentsController', ['only' => ['update', 'destroy']]);
    $router->resource('business.comments', 'CommentsController', ['only' => 'store']);

    $router->get('/', 'HomeController@index');
    $router->get('customer/detail/{customerId}', 'CustomerController@detail')->name('customer.detail');
    //$router->get('/info', 'HomeController@info');
    //$router->get('statistics/collect', 'CollectController@index');
    //$router->get('api/users', 'CustomerController@users');
});
