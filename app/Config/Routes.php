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
	$routes->get('logout', 'admin/LoginController::logout');

	$routes->group('dashboard', ['filter' => 'adminAuth'], function ($routes) {
		$routes->get('/', 'admin/DashboardController::index');

		$routes->get('usuarios', 'admin/DashboardController::usuarios');
		$routes->get('firmas', 'admin/DashboardController::firmas');

		$routes->get('nuevo_usuario', 'admin/DashboardController::nuevo_usuario');
		$routes->post('nuevo_usuario', 'admin/DashboardController::crear_usuario');

		$routes->get('video-denuncia', 'admin/DashboardController::video_denuncia');

		$routes->get('folios', 'admin/FoliosController::index');
		$routes->get('folios_abiertos', 'admin/FoliosController::folios_abiertos');
		$routes->get('folios_derivados', 'admin/FoliosController::folios_derivados');
		$routes->get('folios_canalizados', 'admin/FoliosController::folios_canalizados');
		$routes->get('folios_expediente', 'admin/FoliosController::folios_expediente');
		$routes->get('folios_sin_firma', 'admin/FoliosController::folios_sin_firma');
		$routes->post('firmar_folio', 'admin/FoliosController::firmar_folio');

		$routes->get('certificadoMedico', 'PDFController::certificadoMedico');
		$routes->get('constancia-video-denuncia', 'PDFController::constanciaVideoDenuncia');
		$routes->get('orden-proteccion-albergue', 'PDFController::proteccionAlbergue');
		$routes->get('orden-proteccion-pertenencia', 'PDFController::proteccionPertenencia');
		$routes->get('orden-proteccion-rondines', 'PDFController::proteccionRondines');
	});
});

/**
 *  Client Routes
 * */

$routes->group('denuncia', function ($routes) {
	$routes->get('/', 'client/AuthController::index');
	$routes->post('login_auth', 'client/AuthController::login_auth');
	$routes->get('logout', 'client/AuthController::logout');

	// $routes->resource('denunciante', ['controller' => 'client/UserController']);
	$routes->get('denunciante/new', 'client/UserController::new');
	$routes->post('denunciante', 'client/UserController::create');

	$routes->get('change_password', 'client/AuthController::change_password');
	$routes->post('change_password', 'client/AuthController::change_password_post');
	$routes->post('send_email_change_password', 'client/AuthController::sendEmailChangePassword');

	$routes->group('dashboard', ['filter' => 'denuciantesAuth'], function ($routes) {
		$routes->get('/', 'client/DashboardController::index');
		$routes->get('video-denuncia', 'client/DashboardController::video_denuncia');
		$routes->get('denuncias', 'client/DashboardController::denuncias');
		$routes->post('create', 'client/DashboardController::create');
	});
});

/**
 *  Data get, emails and OTP
 * */

$routes->get('email', 'CorreoController::index');

$routes->group('data', function ($routes) {
	$routes->post('exist-email', 'client/UserController::existEmail');
	$routes->post('exist-email-admin', 'admin/DashboardController::existEmailAdmin');

	$routes->post('get-municipios-by-estado', 'client/UserController::getMunicipiosByEstado');
	$routes->post('get-localidades-by-municipio', 'client/UserController::getLocalidadesByMunicipio');
	$routes->post('get-colonias-by-estado-and-municipio', 'client/UserController::getColoniasByEstadoAndMunicipio');
	$routes->post('get-folios-user-unattended', 'client/UserController::getFoliosAbiertosById');
	$routes->post('get-clasificacion-by-lugar', 'client/UserController::getClasificacionByLugar');
	$routes->post('get-link-videodenuncia', 'client/DashboardController::getLinkVideodenuncia');

	$routes->post('get-folio-information', 'admin/DashboardController::getFolioInformation');
	$routes->post('get-persona-fisica-by-id', 'admin/DashboardController::findPersonaFisicaById');
	$routes->post('update-status-folio', 'admin/DashboardController::updateStatusFolio');

	$routes->post('get-oficinas-by-municipio', 'admin/DashboardController::getOficinasByMunicipio');
	$routes->post('get-empleados-by-municipio-and-oficina', 'admin/DashboardController::getEmpleadosByMunicipioAndOficina');

	$routes->post('sendOTP', 'OTPController::sendEmailOTP');
	$routes->post('getLastOTP', 'OTPController::getLastOTP');

	//VEHÍCULOS
	$routes->post('get-marca-by-dist', 'client/DashboardController::getMarcaByDist');
	$routes->post('get-modelo-by-marca', 'client/DashboardController::getModeloByMarca');
	$routes->post('get-version-by-modelo', 'client/DashboardController::getVersionByModelo');

	//SAVE IN JUSTICIA DATABASE
	$routes->post('save-in-justicia', 'admin/DashboardController::saveInJusticia');
	$routes->post('get-persona-fisica-by-id', 'admin/DashboardController::findPersonaFisicaById');
	$routes->post('get-persona-domicilio-by-id', 'admin/DashboardController::findPersonadDomicilioById');
	$routes->post('get-persona-vehiculo-by-id', 'admin/DashboardController::findPersonadVehiculoById');
	$routes->post('join', 'admin/DashboardController::joinFisico');
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
