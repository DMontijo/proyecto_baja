<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('client\MainController');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'HomeController::index');

$routes->group('justicia', function ($routes) {

});

$routes->group('denuncia', function ($routes) {
    $routes->get('/login', 'client/LoginController::index');
    $routes->get('/', 'client/LoginController::index');
<<<<<<< Updated upstream
    $routes->get('/registro', 'client/RegistroController::index');
=======
    $routes->get('login', 'client/LoginController::index');
<<<<<<< Updated upstream
    $routes->get('registro', 'client/RegistroController::index');  
    $routes->get('formularioDenuncia', 'client/RegistroController::formularioDenuncia');
>>>>>>> Stashed changes
=======
    $routes->get('registro', 'client/RegistroController::index');
    $routes->get('formularioDenuncia', 'client/RegistroController::index');
});
$routes->group('admin', function ($routes) {
    $routes->get('/', 'admin/LoginAdminController::index');
    $routes->get('login', 'admin/LoginAdminController::index');
    $routes->get('dashboard', 'Dashboard::index');
>>>>>>> Stashed changes
});
/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
