<?php

use App\Controllers\Dashboard;
use App\Controllers\GayaRenang;
use App\Controllers\JarakRenang;
use App\Controllers\KategoriUmur;
use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

// dashboard
$routes->get('/dashboard', [Dashboard::class, 'index']);

// gaya renang
$routes->get('/master-data/gaya-renang', [GayaRenang::class, 'index']);
$routes->get('/master-data/gaya-renang/create', [GayaRenang::class, 'create']);
$routes->post('/master-data/gaya-renang/store', [GayaRenang::class, 'store']);
$routes->get('/master-data/gaya-renang/edit/(:num)', [GayaRenang::class, 'edit']);
$routes->post('/master-data/gaya-renang/update/(:num)', [GayaRenang::class, 'update']);
$routes->post('/master-data/gaya-renang/delete/(:num)', [GayaRenang::class, 'destroy']);

// kategori umur
$routes->get('/master-data/kategori-umur', [KategoriUmur::class, 'index']);
$routes->get('/master-data/kategori-umur/create', [KategoriUmur::class, 'create']);
$routes->post('/master-data/kategori-umur/store', [KategoriUmur::class, 'store']);
$routes->get('/master-data/kategori-umur/edit/(:num)', [KategoriUmur::class, 'edit']);
$routes->post('/master-data/kategori-umur/update/(:num)', [KategoriUmur::class, 'update']);
$routes->post('/master-data/kategori-umur/delete/(:num)', [KategoriUmur::class, 'destroy']);

// jarak renang
$routes->get('/master-data/jarak-renang', [JarakRenang::class, 'index']);
$routes->get('/master-data/jarak-renang/create', [JarakRenang::class, 'create']);
$routes->post('/master-data/jarak-renang/store', [JarakRenang::class, 'store']);
$routes->get('/master-data/jarak-renang/edit/(:num)', [JarakRenang::class, 'edit']);
$routes->post('/master-data/jarak-renang/update/(:num)', [JarakRenang::class, 'update']);
$routes->post('/master-data/jarak-renang/delete/(:num)', [JarakRenang::class, 'destroy']);
