<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

//LOGIN
$routes->get('/', 'Login::login');
$routes->post('/dashboard', 'Login::authentication');
$routes->get('/login/forgotPass', 'Login::forgot');
$routes->get('/login/resetPass', 'Login::resetPass');

// DASHBOARD
$routes->get('/dashboard', 'Dashboard::index');

// PENGGUNA
$routes->get('/pengguna', 'Pengguna::index');
// PENGGUNA-POSISI
// $routes->post('/pengguna/tambah-posisi/save', 'Pengguna::save');
// $routes->get('/pengguna/tambah-posisi', 'Pengguna::tambah_posisi');
// $routes->get('/pengguna/update-posisi/(:segment)', 'Pengguna::update_posisi/$1');
$routes->get('/pengguna/detail-posisi/(:segment)', 'Pengguna::detail_posisi/$1');

// PENGGUNA-DIVISI
$routes->get('/pengguna/tambah-divisi', 'Pengguna::tambah_divisi');
$routes->post('/pengguna/tambah-divisi', 'Pengguna::save_divisi');
$routes->get('/pengguna/detail-divisi/(:segment)', 'Pengguna::detail_divisi/$1');
$routes->get('/pengguna/update-divisi/(:segment)', 'Pengguna::update_divisi/$1');
$routes->post('/pengguna/save-update-divisi/(:segment)', 'Pengguna::save_update_divisi/$1');
$routes->post('/pengguna/delete-divisi', 'Pengguna::delete_divisi');

// PENGGUNA-PENGGUNA
$routes->get('/pengguna/tambah-pengguna', 'Pengguna::tambah_pengguna');
$routes->get('/pengguna/detail-pengguna/(:segment)', 'Pengguna::detail_pengguna/$1');
$routes->get('/pengguna/update-pengguna/(:segment)', 'Pengguna::update_pengguna/$1');
$routes->post('/pengguna/save', 'Pengguna::save_pengguna');
$routes->post('/pengguna/update/(:segment)', 'Pengguna::save_update_pengguna/$1');
$routes->post('/pengguna/delete-pengguna', 'Pengguna::delete_user');
$routes->post('/pengguna/delete-user-role', 'Pengguna::delete_user_role');


// RENCANA
$routes->get('/rencana', 'Rencana::index');
$routes->get('/rencana/history', 'Rencana::history');
$routes->get('/rencana/history/detail', 'Rencana::detail');

// PROJEK
$routes->get('/projek', 'Projek::index');
$routes->get('/projek/detail/(:segment)', 'Projek::detail/$1');
$routes->get('/projek/tambah', 'Projek::tambah');
$routes->post('/projek/create-project', 'Projek::create_project');
$routes->get('/projek/update/(:segment)', 'Projek::update/$1');
$routes->post('/projek/save-update-project/(:segment)', 'Projek::update_plan/$1');


//PROFILE
$routes->get('/profile', 'Profile::index');
$routes->get('/profile/ganti-password', 'Profile::changePass');
$routes->get('/profile/reset-password', 'Profile::resetPass');
$routes->get('/profile/kode', 'Profile::sendCode');
$routes->get('/profile/new-pass', 'Profile::newPass');
$routes->post('profile/logout', 'Profile::logout');
