<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->get('/', 'Auth::login');
$routes->get('login', 'Auth::login');
$routes->get('register', 'Auth::register');

$routes->post('auth/autenticar', 'Auth::autenticar');
$routes->post('auth/guardarRegistro', 'Auth::guardarRegistro');

$routes->get('logout', 'Auth::logout', ['filter' => 'auth']);
$routes->get('dashboard', 'Auth::dashboard', ['filter' => 'auth']);

$routes->group('usuarios', ['filter' => 'admin'], function($routes) {
    $routes->get('/', 'Usuarios::index');
    $routes->get('create', 'Usuarios::create');
    $routes->post('store', 'Usuarios::store');
});

$routes->group('categorias', ['filter' => 'admin'], function($routes) {
    $routes->get('/', 'Categorias::index');
    $routes->get('create', 'Categorias::create');
    $routes->post('store', 'Categorias::store');
});

$routes->group('productos', ['filter' => 'admin'], function($routes) {
    $routes->get('/', 'Productos::index');
    $routes->get('create', 'Productos::create');
    $routes->post('store', 'Productos::store');
});