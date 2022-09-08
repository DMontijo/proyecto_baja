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
$routes->setDefaultController('HomeController');
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
$routes->get('canalizaciones', 'DerivacionesController::canalizaciones');
$routes->get('validar_constancia', 'extravio/DashboardController::validar_constancia');

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
		$routes->get('generarqr', 'admin/FirmaController::generarqr');
		$routes->get('usuarios_activos', 'admin/DashboardController::usuarios_activos');

		$routes->get('firmas', 'admin/DashboardController::firmas');

		$routes->get('nuevo_usuario', 'admin/DashboardController::nuevo_usuario');
		$routes->get('editar_usuario', 'admin/DashboardController::editar_usuario');
		$routes->post('nuevo_usuario', 'admin/DashboardController::crear_usuario');
		$routes->post('editar_usuario', 'admin/DashboardController::update_usuario');

		$routes->get('video-denuncia', 'admin/DashboardController::video_denuncia');
		$routes->get('denuncia-anonima', 'admin/DashboardController::denuncia_anonima');

		$routes->get('folios', 'admin/FoliosController::index');
		$routes->get('folios_abiertos', 'admin/FoliosController::folios_abiertos');
		$routes->get('folios_derivados', 'admin/FoliosController::folios_derivados');
		$routes->get('folios_canalizados', 'admin/FoliosController::folios_canalizados');
		$routes->get('folios_expediente', 'admin/FoliosController::folios_expediente');
		$routes->get('folios_sin_firma', 'admin/FoliosController::folios_sin_firma');
		$routes->get('folios_en_proceso', 'admin/FoliosController::folios_en_proceso');
		$routes->post('liberar_folio', 'admin/FoliosController::liberar_folio');
		$routes->post('firmar_folio', 'admin/FoliosController::firmar_folio');

		$routes->get('buscar_folio', 'admin/FoliosController::getAllFolios');
		$routes->post('buscar_folio', 'admin/FoliosController::getFilterFolios');
		$routes->post('ver_folio', 'admin/FoliosController::viewFolio');

		$routes->get('constancias', 'admin/ConstanciasController::index');
		$routes->post('firmar_constancia_extravio', 'admin/FirmaController::firmar_constancia_extravio');
		$routes->get('constancias_extravio_abiertas', 'admin/ConstanciasController::constancias_abiertas');
		$routes->get('constancias_extravio_firmadas', 'admin/ConstanciasController::constancias_firmadas');
		$routes->get('constancia_extravio_show', 'admin/ConstanciasController::constancia_extravio_show');
		$routes->post('download_constancia_pdf', 'admin/ConstanciasController::download_constancia_pdf');
		$routes->post('download_constancia_xml', 'admin/ConstanciasController::download_constancia_xml');

		$routes->get('perfil', 'admin/DashboardController::perfil');
		$routes->post('update_password', 'admin/DashboardController::update_password');
		$routes->post('charge_fiel', 'admin/DashboardController::charge_fiel');

		$routes->get('certificadoMedico', 'PDFController::certificadoMedico');
		$routes->get('constancia-video-denuncia', 'PDFController::constanciaVideoDenuncia');
		$routes->get('orden-proteccion-albergue', 'PDFController::proteccionAlbergue');
		$routes->get('orden-proteccion-pertenencia', 'PDFController::proteccionPertenencia');
		$routes->get('orden-proteccion-rondines', 'PDFController::proteccionRondines');

		$routes->get('constanciaFirmada', 'admin/FoliosController::constanciaExtravioFirmado');

		$routes->get('reportes', 'admin/ReportesController::index');
		$routes->get('reportes_folios', 'admin/ReportesController::getFolios');
		$routes->post('reportes_folios', 'admin/ReportesController::postFolios');
		$routes->get('reportes_constancias', 'admin/ReportesController::getConstancias');
		$routes->post('reportes_constancias', 'admin/ReportesController::postConstancias');

		$routes->post('generar_excel_folios', 'admin/ReportesController::createFoliosXlsx');
		$routes->post('generar_excel_constancias', 'admin/ReportesController::createConstanciasXlsx');
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

	$routes->get('actualizar_info', 'client/UserController::updateDenuncianteInfo');
	$routes->post('actualizar_info', 'client/UserController::updateDenuncianteInfoPost');

	$routes->group('dashboard', ['filter' => 'denuciantesAuth'], function ($routes) {
		$routes->get('/', 'client/DashboardController::index');
		$routes->get('video-denuncia', 'client/DashboardController::video_denuncia');

		$routes->get('denuncias', 'client/DashboardController::denuncias');

		$routes->post('create', 'client/DashboardController::create');
		$routes->post('descargarPDF', 'client/DashboardController::descargar_pdf');
	});
});

/**
 *  Data get, emails and OTP
 * */

// $routes->get('email', 'CorreoController::index');
// $routes->post('email', 'CorreoController::sendEmail');

$routes->group('data', function ($routes) {
	$routes->post('exist-email', 'client/UserController::existEmail');
	$routes->post('exist-email-admin', 'admin/DashboardController::existEmailAdmin');
	$routes->post('exist-email-solicitantes', 'extravio/ExtravioController::existEmailSolicitantes');

	$routes->post('get-municipios-by-estado', 'client/UserController::getMunicipiosByEstado');
	$routes->post('get-localidades-by-municipio', 'client/UserController::getLocalidadesByMunicipio');
	$routes->post('get-colonias-by-estado-and-municipio', 'client/UserController::getColoniasByEstadoAndMunicipio');
	$routes->post('get-colonias-by-estado-municipio-localidad', 'client/UserController::getColoniasByEstadoMunicipioLocalidad');
	$routes->post('get-folios-user-unattended', 'client/UserController::getFoliosAbiertosById');
	$routes->post('get-clasificacion-by-lugar', 'client/UserController::getClasificacionByLugar');
	$routes->post('get-link-videodenuncia', 'client/DashboardController::getLinkVideodenuncia');

	$routes->post('get-folio-information', 'admin/DashboardController::getFolioInformation');
	$routes->post('update-status-folio', 'admin/DashboardController::updateStatusFolio');

	$routes->post('get-oficinas-by-municipio', 'admin/DashboardController::getOficinasByMunicipio');
	$routes->post('get-empleados-by-municipio-and-oficina', 'admin/DashboardController::getEmpleadosByMunicipioAndOficina');

	$routes->post('sendOTP', 'OTPController::sendEmailOTP');
	$routes->post('getLastOTP', 'OTPController::getLastOTP');

	//Link
	$routes->post('get-video-link', 'admin/DashboardController::getVideoLink');
	$routes->post('get-active-users', 'admin/DashboardController::getActiveUsers');

	//VEHÍCULOS
	$routes->post('get-marca-by-dist', 'client/DashboardController::getMarcaByDist');
	$routes->post('get-modelo-by-marca', 'client/DashboardController::getModeloByMarca');
	$routes->post('get-version-by-modelo', 'client/DashboardController::getVersionByModelo');

	//SAVE IN JUSTICIA DATABASE
	$routes->post('save-in-justicia', 'admin/DashboardController::saveInJusticia');
	$routes->post('restore-folio', 'admin/DashboardController::restoreFolio');
	$routes->post('restore-folio-to-process', 'admin/DashboardController::restoreFolioProcess');

	$routes->post('get-persona-fisica-by-id', 'admin/DashboardController::getPersonaFisicaById');
	$routes->post('get-persona-domicilio-by-id', 'admin/DashboardController::findPersonadDomicilioById');
	$routes->post('get-persona-vehiculo-by-id', 'admin/DashboardController::findPersonadVehiculoById');

	$routes->post('update-denuncia-by-id', 'admin/DashboardController::updateFolio');
	$routes->post('update-preguntas-by-id', 'admin/DashboardController::updatePreguntasIniciales');
	$routes->post('update-persona-fisica-by-id', 'admin/DashboardController::updatePersonaFisicaById');
	$routes->post('update-persona-fisica-domicilio-by-id', 'admin/DashboardController::updatePersonaFisicaDomicilioById');
	$routes->post('update-media-filiacion-by-id', 'admin/DashboardController::updateMediaFiliacionById');
	$routes->post('update-vehiculo-by-id', 'admin/DashboardController::updateVehiculoByFolio');
	$routes->post('update-parentesco-by-id', 'admin/DashboardController::updateParentescoByFolio');
	$routes->post('create-parentesco-by-id', 'admin/DashboardController::createParentescoByFolio');
	$routes->post('get-parentesco-by-id', 'admin/DashboardController::getRelacionParentesco');
	$routes->post('get-personafisicofiltro', 'admin/DashboardController::getPersonaFisicaFiltro');

	$routes->post('create-persona_fisica-by-folio', 'admin/DashboardController::createPersonaFisicaByFolio');

});

/**
 * Extravio Routes
 */
$routes->group('constancia_extravio', function ($routes) {
	$routes->get('/', 'extravio/ExtravioController::index');
	$routes->get('login', 'extravio/ExtravioController::login');
	$routes->post('login_auth', 'extravio/ExtravioController::login_auth');

	$routes->post('send_email_change_password', 'extravio/ExtravioController::sendEmailChangePassword');
	$routes->post('descargarConstanciaRealizada', 'extravio/ExtravioController::descargar_pdf');

	$routes->get('register', 'extravio/ExtravioController::register');
	$routes->post('create', 'extravio/ExtravioController::create');

	$routes->group('dashboard', ['filter' => 'constanciasExtravioAuth'], function ($routes) {
		$routes->get('/', 'extravio/DashboardController::index');
		$routes->post('solicitar_constancia', 'extravio/DashboardController::solicitar_constancia');

		$routes->get('constancias', 'extravio/DashboardController::constancias');
		$routes->post('download_constancia_pdf', 'extravio/DashboardController::download_constancia_pdf');
		$routes->post('download_constancia_xml', 'extravio/DashboardController::download_constancia_xml');
	});
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
