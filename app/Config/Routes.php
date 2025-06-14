<?php

use App\Controllers\Dashboard;
use App\Controllers\GayaRenang;
use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

// dashboard
$routes->get('/dashboard', [Dashboard::class, 'index']);

// gaya renang
$routes->get('/master-data/gaya-renang', [GayaRenang::class, 'index']);
$routes->post('/master-data/gaya-renang/create', [GayaRenang::class, 'store']);
$routes->post('/master-data/gaya-renang/update/(:num)', [GayaRenang::class, 'update']);
$routes->post('/master-data/gaya-renang/delete/(:num)', [GayaRenang::class, 'destroy']);
