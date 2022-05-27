<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
	require SYSTEMPATH . 'Config/Routes.php';
}

/**
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Welcome');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/**
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'HomeController::index');
$routes->get('derivaciones', 'DerivacionesController::index');

/**
 *  Admin Routes
 * */
$routes->group('admin', function ($routes) {
	$routes->get('/', 'admin/LoginController::index');
	$routes->post('login', 'admin/LoginController::login_auth');

	$routes->group('dashboard', function ($routes) {
		$routes->get('/', 'admin/DashboardController::index');
		$routes->get('registrar-usuario', 'admin/DashboardController::registrar_usuario');
		$routes->get('video-denuncia', 'admin/DashboardController::video_denuncia');
		$routes->get('folios', 'admin/DashboardController::folios');
	});
});

/**
 *  Client Routes
 * */
$routes->group('denuncia', function ($routes) {

	$routes->get('/', 'client/AuthController::index', ['as' => 'ciudadano_login_get']);
	$routes->post('login_auth', 'client/AuthController::login_auth');
	$routes->post('logout', 'client/AuthController::logout');

	$routes->resource('denunciante', ['controller' => 'client/UserController']);

	$routes->get('recuperar', 'client/AuthController::change_password');

	$routes->group('dashboard', function ($routes) {
		$routes->get('/', 'client/DashboardController::index');
		$routes->get('video-denuncia', 'client/DashboardController::video_denuncia');
		$routes->get('denuncias', 'client/DashboardController::denuncias');
	});
});

/**
 *  Client Routes
 * */
$routes->get('email', 'CorreoOTPController::index');

$routes->group('data', function ($routes) {
	$routes->post('get-municipios-by-estado', 'client/UserController::getMunicipiosByEstado');
	$routes->post('get-localidades-by-municipio', 'client/UserController::getLocalidadesByMunicipio');
	$routes->post('get-colonias-by-estado-and-municipio', 'client/UserController::getColoniasByEstadoAndMunicipio');

	$routes->post('sendOTP', 'OTPController::sendEmailOTP');
	$routes->post('getLastOTP', 'OTPController::getLastOTP');
});

/**
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
