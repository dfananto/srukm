<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Auth::index');
$routes->post('login', 'Auth::login');

$routes->group('', ['filter' => 'auth'], function ($routes) {
    $routes->get('dashboard', 'Riwayat::index');
    $routes->get('logout', 'Auth::logout');
    $routes->get('user', 'User::index');
    $routes->post('user/store', 'User::store');
    $routes->post('user/delete/(:num)', 'User::delete/$1');
    $routes->get('profile/(:num)', 'User::profile/$1');
    $routes->get('profil/', 'User::profil');
    $routes->post('user/update/(:num)', 'User::update/$1');
    $routes->get('kriteria', 'Kriteria::index');
    $routes->post('kriteria/store', 'Kriteria::store');
    $routes->get('kriteria/getById/(:segment)', 'Kriteria::getById/$1');
    $routes->post('kriteria/update', 'Kriteria::update');
    $routes->post('kriteria/delete/(:segment)', 'Kriteria::delete/$1');
    $routes->get('ukm', 'Ukm::index');
    $routes->post('ukm/store', 'Ukm::store');
    $routes->get('ukm/getById/(:segment)', 'Ukm::getById/$1');
    $routes->post('ukm/update', 'Ukm::update/$1');
    $routes->post('ukm/delete/(:segment)', 'Ukm::delete/$1');
    $routes->get('rule', 'Rule::index');
    $routes->post('rule/store', 'Rule::store');
    $routes->get('rule/getKriteria', 'Rule::getKriteria');
    $routes->get('rule/getUkm', 'Rule::getUkm');
    $routes->post('rule/delete/(:segment)', 'Rule::delete/$1');
    $routes->get('rekomendasi', 'Rekomendasi::index');
    $routes->post('rekomendasi/proses', 'Rekomendasi::proses');
    $routes->get('laporan', 'Riwayat::riwayat');
    $routes->post('laporan/delete/(:num)', 'Riwayat::delete/$1');
    $routes->get('kelolamasukkan', 'Masukkan::index');
    $routes->post('masukkan/delete/(:num)', 'Masukkan::delete/$1');
    $routes->get('masukkan', 'Masukkan::create');
    $routes->post('masukkan/simpan', 'Masukkan::simpan');
    $routes->get('masukkanKritik', 'Masukkan::kritik');
    $routes->get('tentang', 'Auth::tentang');
});