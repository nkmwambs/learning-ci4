<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

$routes->group('api', function($routes){
    $routes->post('users/getAll', 'User::index');
    $routes->post('users/create', 'User::createUser');
    $routes->get('users/(:num)', 'User::getSingleUser/$1');
});
