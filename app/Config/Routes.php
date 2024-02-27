<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Admin\DashboardController::index');


// route admin dashboard
$routes->get('dashboard', 'Admin\DashboardController::index');

// route produk admin
$routes->get('daftar-produk', 'Admin\ProdukController::index');

// route admin kategori 
$routes->get('daftar-kategori', 'Admin\ProdukController::kategori');

$routes->post('daftar-kategori/tambah', 'Admin\ProdukController::store');
