<?php

use App\Controllers\Dashboard;
use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

// dashboard
$routes->get('/dashboard', [Dashboard::class, 'index']);
