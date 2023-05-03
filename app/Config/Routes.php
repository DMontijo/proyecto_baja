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
$routes->get('salas_virtuales', 'DerivacionesController::salas_virtuales');
$routes->get('validar_constancia', 'extravio/DashboardController::validar_constancia');
$routes->get('validar_documento', 'admin/DocumentosController::validar_documento');


/**
 *  Admin Routes
 * */

$routes->group('admin', function ($routes) {
	$routes->get('/', 'admin/LoginController::index');
	$routes->post('login', 'admin/LoginController::login_auth');
	$routes->get('logout', 'admin/LoginController::logout');
	$routes->post('cerrar-sesion', 'admin/LoginController::cerrar_sesiones');

	$routes->group('dashboard', ['filter' => 'adminAuth'], function ($routes) {
		$routes->get('/', 'admin/DashboardController::index');
		$routes->get('videos', 'admin/DashboardController::videos_expediente');
		$routes->get('bandeja', 'admin/DashboardController::bandeja_salida');
		$routes->get('bandeja_remision', 'admin/DashboardController::bandeja_remision');
		$routes->post('bandeja_remision', 'admin/DashboardController::bandeja_remision_post');
		$routes->post('bandeja_rac', 'admin/DashboardController::bandeja_rac');
		$routes->get('sesiones_activas', 'admin/DashboardController::sesiones_activas');
		$routes->get('cerrar_sesiones_general', 'admin/DashboardController::cerrar_sesiones_general');

		$routes->get('usuarios', 'admin/DashboardController::usuarios');
		$routes->get('asignacion_permisos', 'admin/DashboardController::asignacion_permisos');
		$routes->get('nuevo_asignacion_permisos', 'admin/DashboardController::nuevo_asignacion_permiso');
		$routes->post('create_asignacion_permiso', 'admin/DashboardController::create_asignacion_permiso');
		$routes->post('create_rol', 'admin/DashboardController::create_rol');

		$routes->get('eliminar_asignacion_permiso', 'admin/DashboardController::eliminar_asignacion_permiso');
		$routes->get('nuevo_rol', 'admin/DashboardController::nuevo_rol');


		$routes->get('generarqr', 'admin/FirmaController::generarqr');
		$routes->get('usuarios_activos', 'admin/DashboardController::usuarios_activos');
		$routes->get('usuarios_en_llamada', 'admin/DashboardController::usuarios_en_llamada');
		$routes->get('lista_prioridad', 'admin/DashboardController::lista_prioridad');

		$routes->get('firmas', 'admin/DashboardController::firmas');

		$routes->get('nuevo_usuario', 'admin/DashboardController::nuevo_usuario');
		$routes->post('nuevo_usuario', 'admin/DashboardController::crear_usuario');
		$routes->get('editar_usuario', 'admin/DashboardController::editar_usuario');
		$routes->post('editar_usuario', 'admin/DashboardController::update_usuario');
		$routes->post('editar_password', 'admin/DashboardController::editar_password');

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
		$routes->get('ver_folio', 'admin/FoliosController::viewFolio');

		$routes->get('constancias', 'admin/ConstanciasController::index');
		$routes->post('firmar_constancia_extravio', 'admin/FirmaController::firmar_constancia_extravio');
		$routes->get('constancias_extravio_abiertas', 'admin/ConstanciasController::constancias_abiertas');
		$routes->get('constancias_extravio_proceso', 'admin/ConstanciasController::constancias_proceso');
		$routes->get('constancias_extravio_firmadas', 'admin/ConstanciasController::constancias_firmadas');
		$routes->post('constancia_extravio_liberar', 'admin/ConstanciasController::constancia_extravio_liberar');
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
		$routes->get('registro_diario', 'admin/ReportesController::getRegistroDiario');
		$routes->post('registro_diario', 'admin/ReportesController::postRegistroDiario');
		$routes->get('reporte_fiel', 'admin/ReportesController::getFielReport');
		$routes->get('reporte_llamadas', 'admin/ReportesController::getReporteLlamadas');
		$routes->post('reporte_llamadas', 'admin/ReportesController::postReporteLlamadas');
		$routes->get('registro_conavim', 'admin/ReportesController::getRegistroConavim');
		$routes->post('registro_conavim', 'admin/ReportesController::postRegistroConavim');
		$routes->get('registro_candev', 'admin/ReportesController::getRegistroCanDev');
		$routes->post('registro_candev', 'admin/ReportesController::postRegistroCanDev');
		$routes->get('registro_atenciones', 'admin/ReportesController::getRegistroAtenciones');
		$routes->post('registro_atenciones', 'admin/ReportesController::postRegistroAtenciones');
		$routes->get('registro_ceeiav', 'admin/ReportesController::getComisionEstatal');
		$routes->post('registro_ceeiav', 'admin/ReportesController::postComisionEstatal');

		$routes->post('generar_excel_folios', 'admin/ReportesController::createFoliosXlsx');
		$routes->post('generar_excel_constancias', 'admin/ReportesController::createConstanciasXlsx');
		$routes->post('generar_excel_registro_diario', 'admin/ReportesController::createRegistroDiarioXlsx');
		$routes->post('generar_excel_llamadas', 'admin/ReportesController::createLlamadasXlsx');
		$routes->post('generar_excel_conavim', 'admin/ReportesController::createOrdenXlsx');
		$routes->post('generar_excel_canadev', 'admin/ReportesController::createCanaDevXlsx');
		$routes->post('generar_excel_registro_atenciones', 'admin/ReportesController::createRegistroAtencionesXlsx');
		$routes->post('generar_excel_ceeaiv', 'admin/ReportesController::createComisionEstatalXlsx');

		$routes->get('documentos', 'admin/DocumentosController::index');
		$routes->post('documentos', 'admin/DocumentosController::postDocumentos');

		$routes->get('documentos_abiertos', 'admin/DocumentosController::documentos_abiertas');
		$routes->get('documentos_firmados', 'admin/DocumentosController::documentos_firmados');

		$routes->get('documentos_show', 'admin/DocumentosController::documentos_show');
		$routes->post('firmar_documentos', 'admin/FirmaController::firmar_documentos');
		$routes->post('firmar_documentos_id', 'admin/FirmaController::firmar_documentos_by_id');

		$routes->post('insert-documentosWSYWSG', 'admin/DashboardController::insertFolioDoc');
		$routes->post('send-documentos-correo', 'admin/FirmaController::sendEmailDocumentos');

		$routes->post('send-documentos-correo-by-id', 'admin/FirmaController::sendEmailDocumentoByID');
	});
});

/**
 *  Client Routes
 * */

$routes->group('denuncia', function ($routes) {
	$routes->get('/', 'client/AuthController::index');
	$routes->post('login_auth', 'client/AuthController::login_auth');
	$routes->get('logout', 'client/AuthController::logout');
	$routes->post('cerrar-sesion', 'client/AuthController::cerrar_sesiones');

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
		$routes->post('video-llamada', 'client/DashboardController::video_llamada');
		$routes->get('end-videocall', 'client/DashboardController::endVideoCall');

		$routes->get('perfil', 'client/DashboardController::profile');
		$routes->post('actualizar-perfil', 'client/DashboardController::update_profile');
		$routes->post('actualizar-password', 'client/DashboardController::update_password');

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
	$routes->post('get-folio-information-denuncia', 'admin/DashboardController::getFolioInformationDenunciaAnonima');

	$routes->post('update-status-folio', 'admin/DashboardController::updateStatusFolio');
	$routes->post('update-salida-folio', 'admin/DashboardController::updateFolioSalida');
	$routes->post('update-folio-asignacion', 'admin/DashboardController::updateFolioAsignacion');


	$routes->post('get-oficinas-by-municipio', 'admin/DashboardController::getOficinasByMunicipio');
	$routes->post('get-empleados-by-municipio-and-oficina', 'admin/DashboardController::getEmpleadosByMunicipioAndOficina');

	$routes->post('get-derivacion-by-municipio', 'admin/DashboardController::getDerivacionByMunicipio');
	$routes->post('get-canalizacion-by-municipio', 'admin/DashboardController::getCanalizacionByMunicipio');

	//OTP
	$routes->post('sendOTP', 'OTPController::sendEmailOTP');
	$routes->post('validateOTP', 'OTPController::validateOTP');
	$routes->post('getLastOTP', 'OTPController::getLastOTP');

	//Constancias extravío
	$routes->post('get-all-constancias-abiertas', 'admin/ConstanciasController::getAllConstanciasAbiertas');

	//Link
	$routes->post('get-video-link', 'admin/DashboardController::getVideoLink');
	$routes->post('get-link-from-call', 'admin/DashboardController::getLinkFromCall');
	$routes->post('get-active-users', 'admin/DashboardController::getActiveUsers');
	$routes->get('get-duration-video', 'admin/DashboardController::getTimeVideo');

	//VEHÍCULOS
	$routes->post('get-marca-by-dist', 'client/DashboardController::getMarcaByDist');
	$routes->post('get-modelo-by-marca', 'client/DashboardController::getModeloByMarca');
	$routes->post('get-version-by-modelo', 'client/DashboardController::getVersionByModelo');

	//OBJETOS
	$routes->post('get-objeto-sub-by-cat', 'admin/DashboardController::getObjetoSubclasificacion');
	$routes->post('create-objeto-involucrado-by-folio', 'admin/DashboardController::createObjetoInvolucradoByFolio');
	$routes->post('delete-objeto-involucrado-by-folio', 'admin/DashboardController::deleteObjetoInvolucrado');
	$routes->post('get-objeto-involucrado-by-id', 'admin/DashboardController::getObjetoInvolucrado');
	$routes->post('update-objeto-involucrado-by-id', 'admin/DashboardController::updateObjetosInvolucradosById');

	//SAVE IN JUSTICIA DATABASE
	$routes->post('save-in-justicia', 'admin/DashboardController::saveInJusticia');
	$routes->post('restore-folio', 'admin/DashboardController::restoreFolio');
	$routes->post('restore-folio-to-process', 'admin/DashboardController::restoreFolioProcess');
	$routes->post('save-archivos-externos', 'admin/DashboardController::crearArchivo');

	//GET, UPDATE, INSERT WITH AJAX
	$routes->post('get-persona-fisica-by-id', 'admin/DashboardController::getPersonaFisicaById');
	$routes->post('get-persona-domicilio-by-id', 'admin/DashboardController::findPersonadDomicilioById');
	$routes->post('get-persona-vehiculo-by-id', 'admin/DashboardController::findPersonadVehiculoById');

	$routes->post('update-denuncia-by-id', 'admin/DashboardController::updateFolio');
	$routes->post('update-denuncia-by-id-anonima', 'admin/DashboardController::updateFolioDenuncia');

	$routes->post('update-preguntas-by-id', 'admin/DashboardController::updatePreguntasIniciales');
	$routes->post('update-persona-fisica-by-id', 'admin/DashboardController::updatePersonaFisicaById');
	$routes->post('update-persona-fisica-domicilio-by-id', 'admin/DashboardController::updatePersonaFisicaDomicilioById');
	$routes->post('update-media-filiacion-by-id', 'admin/DashboardController::updateMediaFiliacionById');
	$routes->post('update-vehiculo-by-id', 'admin/DashboardController::updateVehiculoByFolio');
	$routes->post('create-vehiculo-by-id', 'admin/DashboardController::createVehiculoByFolio');
	$routes->post('delete-vehiculo-by-id', 'admin/DashboardController::deleteVehiculoByFolio');
	$routes->post('delete-archivo-by-id', 'admin/DashboardController::deleteArchivoById');

	$routes->post('delete-parentesco-by-id', 'admin/DashboardController::deleteParentescoById');
	$routes->post('delete-persona-fisica-by-id', 'admin/DashboardController::deletePersonaFisicaById');

	$routes->post('create-parentesco-by-id', 'admin/DashboardController::createParentescoByFolio');
	$routes->post('update-parentesco-by-id', 'admin/DashboardController::updateParentescoByFolio');
	$routes->post('get-parentesco-by-id', 'admin/DashboardController::getRelacionParentesco');
	$routes->post('get-personafisicofiltro', 'admin/DashboardController::getPersonaFisicaFiltro');
	$routes->post('create-persona_fisica-by-folio', 'admin/DashboardController::createPersonaFisicaByFolio');
	$routes->post('create-relacion_ido-by-folio', 'admin/DashboardController::createRelacionIDOByFolio');
	$routes->post('create-fisimpdelito-by-folio', 'admin/DashboardController::createFisImpDelitoByFolio');
	$routes->post('get-fisimpdelito-by-folio', 'admin/DashboardController::getImputadoDelito');
	$routes->post('delete-fisimpdelito-by-folio', 'admin/DashboardController::deleteImpDelitoByFolio');
	$routes->post('delete-arbol_delictivo-by-folio', 'admin/DashboardController::deleteArbolByFolio');
	$routes->post('get-plantilla', 'admin/DashboardController::get_Plantillas');

	$routes->post('get-documento-by-id', 'admin/DashboardController::getDocumentoById');
	$routes->post('update-documento-by-id', 'admin/DashboardController::updateDocumentoByFolio');
	$routes->post('get-documentos', 'admin/DocumentosController::obtenDocumentos');
	$routes->post('get-documento-tabla', 'admin/DocumentosController::getDocumento');


	$routes->post('delete-documento', 'admin/DocumentosController::borrarDocumento');


	$routes->post('get-denunciante-folio-by-id', 'admin/DashboardController::getFolioDenunciante');

	$routes->post('download-pdf-documento', 'admin/DocumentosController::download_documento_pdf');
	$routes->post('download-xml-documento', 'admin/DocumentosController::download_documento_xml');
	$routes->post('create-folio-denuncia-anonima', 'admin/DashboardController::crearFolioDenunciaAnonima');
	$routes->post('create-persona_fisica-by-denuncia-anonima', 'admin/DashboardController::createPersonaFisicaByDenunciaAnonima');

	//Archivos externos

	$routes->post('create_archivos', 'client/DashboardController::crear_archivos_externos');
	$routes->post('create_archivos_admin', 'admin/DashboardController::crear_archivos_externos');

	$routes->post('refresh_archivos', 'admin/DashboardController::refreshArchivosExternos');

	//delitos 
	$routes->post('delitos-iterado', 'admin/DashboardController::getDelitosModalidad');

	//Clear videodenuncia users Jitsi
	$routes->post('clear-users-video', 'admin/DashboardController::clearUsersVideo');

	//RAC
	$routes->post('get-modulos', 'admin/DashboardController::getModulos');
	$routes->post('change-status-doc', 'admin/DashboardController::changeStatusDoc');

	$routes->post('get-documentos-by-folio', 'admin/DashboardController::getDocumentosByFolio');

	//Encargados
	$routes->post('update-encargado', 'admin/DocumentosController::actualizarDocumentoEncargado');
	$routes->post('update-agente-asignado', 'admin/DocumentosController::actualizarDocumentoAgenteAsignado');

	$routes->post('email-alerts', 'admin/FirmaController::sendEmailAlertas');

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

		$routes->get('perfil', 'extravio/ExtravioController::profile');
		$routes->post('actualizar-perfil', 'extravio/ExtravioController::update_profile');
		$routes->post('actualizar-password', 'extravio/ExtravioController::update_password');
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
