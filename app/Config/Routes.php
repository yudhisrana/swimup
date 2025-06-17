<?php

use App\Controllers\Auth;
use App\Controllers\Dashboard;
use App\Controllers\Event;
use App\Controllers\GayaRenang;
use App\Controllers\JarakRenang;
use App\Controllers\KategoriUmur;
use App\Controllers\User;
use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// auth
$routes->get('/login', [Auth::class, 'index']);
$routes->post('/login/attempt', [Auth::class, 'attemptLogin']);
$routes->post('/logout', [Auth::class, 'attemptLogout']);

$routes->group('', ['filter' => 'auth'], function ($routes) {
    //  index
    $routes->get('/', function () {
        return "Hello SwimUp";
    });

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

    // user
    $routes->get('/setting/user', [User::class, 'index']);
    $routes->get('/setting/user/create', [User::class, 'create']);
    $routes->post('/setting/user/store', [User::class, 'store']);
    $routes->get('/setting/user/edit/(:hash)', [User::class, 'edit']);
    $routes->post('/setting/user/update/(:hash)', [User::class, 'update']);
    $routes->post('/setting/user/delete/(:hash)', [User::class, 'destroy']);

    // event
    $routes->get('/menu/event', [Event::class, 'index']);
    $routes->get('/menu/event/create', [Event::class, 'create']);
    $routes->post('/menu/event/store', [Event::class, 'store']);
    $routes->get('/menu/event/edit/(:hash)', [Event::class, 'edit']);
    $routes->post('/menu/event/update/(:hash)', [Event::class, 'update']);
    $routes->post('/menu/event/delete/(:hash)', [Event::class, 'destroy']);
});
