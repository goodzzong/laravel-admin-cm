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

    ]);

    $router->get('/', 'HomeController@index');
    $router->get('customer/detail/{customerId}', 'CustomerController@detail')->name('customer.detail');

    $router->get('/info', 'HomeController@info');

});
