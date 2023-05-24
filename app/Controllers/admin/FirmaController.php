<?php

namespace App\Controllers\admin;

use App\Controllers\BaseController;
use App\Models\BitacoraActividadModel;
use Dompdf\Dompdf;
use Dompdf\Options;
use App\Models\PlantillasModel;
use App\Models\UsuariosModel;
use App\Models\HechoLugarModel;
use App\Models\MunicipiosModel;
use App\Models\EstadosModel;
use App\Models\ConstanciaExtravioModel;
use App\Models\DenunciantesModel;
use App\Models\FolioDocModel;
use App\Models\FolioModel;
use App\Models\FolioPersonaFisicaModel;
use App\Models\TipoExpedienteModel;
use App\Models\FolioRelacionFisFisModel;
use Endroid\QrCode\Color\Color;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\ErrorCorrectionLevel\ErrorCorrectionLevelLow;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\RoundBlockSizeMode\RoundBlockSizeModeMargin;
use Endroid\QrCode\Writer\PngWriter;
use MailerSend\MailerSend;
use MailerSend\Helpers\Builder\Recipient;
use MailerSend\Helpers\Builder\EmailParams;
use MailerSend\Helpers\Builder\Attachment;
use MailerSend\Exceptions\MailerSendValidationException;
use MailerSend\Exceptions\MailerSendRateLimitException;

class FirmaController extends BaseController
{
	private $db_read;

	private $_plantillasModel;
	private $_usuariosModel;
	private $_denunciantesModel;
	private $_hechoLugarModel;
	private $_municipiosModel;
	private $_estadosModel;
	private $_constanciaExtravioModel;
	private $_bitacoraActividadModel;
	private $_folioDocModel;
	private $_folioModel;
	private $_folioPersonaFisicaModel;
	private $_tipoExpedienteModel;
	private $_folioRelacionFisFisModel;


	private $_plantillasModelRead;
	private $_usuariosModelRead;
	private $_denunciantesModelRead;
	private $_hechoLugarModelRead;
	private $_municipiosModelRead;
	private $_estadosModelRead;
	private $_constanciaExtravioModelRead;
	private $_folioDocModelRead;
	private $_folioModelRead;
	private $_folioPersonaFisicaModelRead;
	private $_tipoExpedienteModelRead;
	private $_folioRelacionFisFisModelRead;

	function __construct()
	{
		$this->db_read = ENVIRONMENT == 'production' ? db_connect('default_read') : db_connect('development_read');

		$this->_plantillasModel = new PlantillasModel();
		$this->_usuariosModel = new UsuariosModel();
		$this->_denunciantesModel = new DenunciantesModel();
		$this->_hechoLugarModel = new HechoLugarModel();
		$this->_municipiosModel = new MunicipiosModel();
		$this->_estadosModel = new EstadosModel();
		$this->_constanciaExtravioModel = new ConstanciaExtravioModel();
		$this->_bitacoraActividadModel = new BitacoraActividadModel();
		$this->_folioDocModel = new FolioDocModel();
		$this->_folioModel = new FolioModel();
		$this->_folioPersonaFisicaModel = new FolioPersonaFisicaModel();
		$this->_tipoExpedienteModel = new TipoExpedienteModel();
		$this->_folioRelacionFisFisModel = new FolioRelacionFisFisModel();

		$this->_plantillasModelRead = model('PlantillasModel', true, $this->db_read);
		$this->_usuariosModelRead = model('UsuariosModel', true, $this->db_read);
		$this->_denunciantesModelRead = model('DenunciantesModel', true, $this->db_read);
		$this->_hechoLugarModelRead = model('HechoLugarModel', true, $this->db_read);
		$this->_municipiosModelRead = model('MunicipiosModel', true, $this->db_read);
		$this->_estadosModelRead = model('EstadosModel', true, $this->db_read);
		$this->_constanciaExtravioModelRead = model('ConstanciaExtravioModel', true, $this->db_read);
		$this->_folioDocModelRead = model('FolioDocModel', true, $this->db_read);
		$this->_folioModelRead = model('FolioModel', true, $this->db_read);
		$this->_folioPersonaFisicaModelRead = model('FolioPersonaFisicaModel', true, $this->db_read);
		$this->_tipoExpedienteModelRead = model('TipoExpedienteModel', true, $this->db_read);
		$this->_folioRelacionFisFisModelRead = model('FolioRelacionFisFisModel', true, $this->db_read);
	}

	/**
	 * Función para firmar las constancias de extravio
	 * Recibe por metodo port el folio, año y contraseña de la FIEL
	 */
	public function firmar_constancia_extravio()
	{
		try {
			$numfolio = trim($this->request->getPost('folio'));
			$folio = $numfolio;
			$year = trim($this->request->getPost('year'));
			$password = str_replace(' ', '', trim($this->request->getPost('contrasena')));
			$user_id = session('ID');

			// Se busca las constancias que no esten firmadas
			$constancia = $this->_constanciaExtravioModelRead->asObject()->where('CONSTANCIAEXTRAVIOID', $numfolio)->where('ANO', $year)->where('STATUS !=', 'FIRMADO')->first();
			if (!$constancia) {
				return redirect()->to(base_url('/admin/dashboard/constancias_extravio_abiertas'))->with('message_error', 'No existe la constancia o ya fue firmada.');
			}

			//Info de la plantilla de cosntancias de extravio
			$plantilla = $this->_plantillasModelRead->asObject()->where('TITULO', 'CONSTANCIA DE EXTRAVIO')->first();

			// Info para la plantilla
			$solicitante = $this->_denunciantesModelRead->asObject()->where('DENUNCIANTEID', $constancia->DENUNCIANTEID)->first();

			$lugar = $this->_hechoLugarModelRead->asObject()->where('HECHOLUGARID', $constancia->HECHOLUGARID)->first();
			$municipio = (object)[];
			if ($constancia->MUNICIPIOIDCITA) {
				$municipio = $this->_municipiosModelRead->asObject()->where('MUNICIPIOID', $constancia->MUNICIPIOIDCITA)->where('ESTADOID', $constancia->ESTADOID)->first();
			} else {
				$municipio = $this->_municipiosModelRead->asObject()->where('MUNICIPIOID', $constancia->MUNICIPIOID)->where('ESTADOID', $constancia->ESTADOID)->first();
			}
			$estado = $this->_estadosModelRead->asObject()->where('ESTADOID', $constancia->ESTADOID)->first();
			$meses = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");

			$timestamp = strtotime($constancia->HECHOFECHA);
			$dia_extravio = date('d', $timestamp);
			$mes_extravio = $meses[date('n', $timestamp) - 1];
			$ano_extravio = date('Y', $timestamp);

			$document_name = $plantilla->TITULO;

			// Asignacion de fecha actual
			$FECHAFIRMA = date("Y-m-d");
			$HORAFIRMA = date("H:i");


			// Creacion de archivos PEM y autenticacion de contraseña
			if ($this->_crearArchivosPEMText($user_id, $password)) {
				// Validacion de que exista esa firma FIEL
				if ($this->_validarFiel($user_id)) {
					// Info de la firma
					$fiel_user = $this->_extractData($user_id);
					$razon_social = $fiel_user['razon_social'];
					$rfc = $fiel_user['rfc'];
					$num_certificado = $fiel_user['num_certificado'];
					// URL para los QR
					$url = base_url('/validar_constancia?folio=' . base64_encode($folio) . '&year=' . $year);

					//TEXTO *************************************************************************************************************************************************************************

					$plantilla->TEXTO = str_replace('[FOLIO_NUMERO]', $constancia->CONSTANCIAEXTRAVIOID, $plantilla->TEXTO);
					$plantilla->TEXTO = str_replace('[NOMBRE_AGENTE_FIRMA]', $razon_social, $plantilla->TEXTO);
					$plantilla->TEXTO = str_replace('[DOMICILIO_COMPARECIENTE]', $constancia->DOMICILIO, $plantilla->TEXTO);
					$plantilla->TEXTO = str_replace('[NOMBRE_COMPARECIENTE]', $solicitante->NOMBRE . " " . $solicitante->APELLIDO_PATERNO . " " . $solicitante->APELLIDO_MATERNO, $plantilla->TEXTO);
					if ($constancia->DUENONOMBREDOC) {
						$plantilla->TEXTO = str_replace('[NOMBRE_DUENO]', $constancia->DUENONOMBREDOC . " " . $constancia->DUENOAPELLIDOPDOC . " " . $constancia->DUENOAPELLIDOMDOC, $plantilla->TEXTO);
					} else {
						$plantilla->TEXTO = str_replace('[NOMBRE_DUENO]', $solicitante->NOMBRE . " " . $solicitante->APELLIDO_PATERNO . " " . $solicitante->APELLIDO_MATERNO, $plantilla->TEXTO);
					}
					$plantilla->TEXTO = str_replace('[LUGAR_EXTRAVIO]', $lugar->HECHODESCR, $plantilla->TEXTO);
					$plantilla->TEXTO = str_replace('[NOMBRE_CIUDAD]', $municipio->MUNICIPIODESCR . ", " . $estado->ESTADODESCR, $plantilla->TEXTO);
					$plantilla->TEXTO = str_replace('[FECHA_EXTRAVIO]', $dia_extravio . '/' . strtoupper($mes_extravio) . '/' . $ano_extravio, $plantilla->TEXTO);
					$plantilla->TEXTO = str_replace('[DIA]', date('d'), $plantilla->TEXTO);
					$plantilla->TEXTO = str_replace('[MES]', strtoupper($meses[date('m') - 1]), $plantilla->TEXTO);
					$plantilla->TEXTO = str_replace('[ANIO_FIRMA]', strtoupper(date('Y')), $plantilla->TEXTO);
					$plantilla->TEXTO = str_replace('[ANIO]', $year, $plantilla->TEXTO);
					$plantilla->TEXTO = str_replace('[HORA]', date('H:i'), $plantilla->TEXTO);

					switch ($constancia->EXTRAVIO) {
						case 'BOLETOS DE SORTEO':
							$plantilla->TEXTO = str_replace('[NOMBRE_CERTIFICADO]', 'BOLETOS', $plantilla->TEXTO);

							$timestamp_sorteo = strtotime($constancia->SORTEOFECHA);
							$dia_sorteo = date('d', $timestamp_sorteo);
							$ano_sorteo = date('Y', $timestamp_sorteo);
							$mes_sorteo = $meses[date('n') - 1];

							$descr = 'EXTRAVÍO DE BOLETO CON NÚMERO: [NBOLETO] Y TALÓN CON NÚMERO: [NTALON] DEL SORTEO: [NOMBRESORTEO] A CELEBRARSE EL DÍA: [SORTEOFECHA], CON PERMISO DE GOBERNACIÓN: [PERMISOGOBERNACION], Y PERMISO DE GOBERNACIÓN DE COLABORADORES: [PERMISOGOBCOLABORADORES].';
							$descr = str_replace('[NBOLETO]', $constancia->NBOLETO, $descr);
							$descr = str_replace('[NTALON]', $constancia->NTALON, $descr);
							$descr = str_replace('[NOMBRESORTEO]', $constancia->NOMBRESORTEO, $descr);
							$descr = str_replace('[PERMISOGOBERNACION]', $constancia->PERMISOGOBERNACION, $descr);
							$descr = str_replace('[PERMISOGOBCOLABORADORES]', $constancia->PERMISOGOBCOLABORADORES, $descr);
							$descr = str_replace('[SORTEOFECHA]', $dia_sorteo . '/' . strtoupper($mes_sorteo) . '/' . $ano_sorteo, $descr);
							$plantilla->TEXTO = str_replace('[DESCRIPCION_EXTRAVIO]', $descr, $plantilla->TEXTO);
							$plantilla->TEXTO = str_replace('[NO_DOCUMENTO]', $constancia->NBOLETO, $plantilla->TEXTO);
							break;
						case 'PLACAS':
							$perdido = '';
							if (str_contains($constancia->POSICIONPLACA, 'PLACA DELANTERA') || str_contains($constancia->POSICIONPLACA, 'PLACA TRASERA')) {
								$perdido = $constancia->POSICIONPLACA;
								if (str_contains($constancia->POSICIONPLACA, 'ESTATALES')) {
									$constancia->POSICIONPLACA = str_replace('ESTATALES', '', $constancia->POSICIONPLACA);
									$ext = $constancia->POSICIONPLACA . ' ESTATAL';
								} else if (str_contains($constancia->POSICIONPLACA, 'NACIONALES')) {
									$constancia->POSICIONPLACA = str_replace('NACIONALES', '', $constancia->POSICIONPLACA);
									$ext = $constancia->POSICIONPLACA . ' NACIONAL';
								} else {
									$constancia->POSICIONPLACA = str_replace('EXTRANJERAS', '', $constancia->POSICIONPLACA);
									$ext = $constancia->POSICIONPLACA . ' EXTRANJERA';
								}
							} else {
								$perdido = 'PLACAS';
								$ext = $constancia->POSICIONPLACA;
							}
							$descr = 'EXTRAVÍO DE: [POSICIONPLACA]<br>NÚMERO: [NPLACA]<br><br>RESPECTO DE UN VEHÍCULO:<br>MARCA:[MARCA]<br>LINEA: [MODELO]<br>MODELO: [ANIOVEHICULO]<br>NÚMERO DE SERIE: [SERIEVEHICULO]';
							$descr = str_replace('[POSICIONPLACA]', $ext, $descr);
							$descr = str_replace('[NPLACA]', $constancia->NPLACA, $descr);
							$descr = str_replace('[MARCA]', $constancia->MARCA, $descr);
							$descr = str_replace('[MODELO]', $constancia->MODELO, $descr);
							$descr = str_replace('[ANIOVEHICULO]', $constancia->ANIOVEHICULO, $descr);
							$descr = str_replace('[SERIEVEHICULO]', $constancia->SERIEVEHICULO, $descr);
							$plantilla->TEXTO = str_replace('[DESCRIPCION_EXTRAVIO]', $descr, $plantilla->TEXTO);
							$plantilla->TEXTO = str_replace('[NOMBRE_CERTIFICADO]', $perdido, $plantilla->TEXTO);
							$plantilla->TEXTO = str_replace('[NO_DOCUMENTO]', $constancia->NPLACA, $plantilla->TEXTO);
							$plantilla->TEXTO = str_replace('[DESCRIPCION]', $constancia->NPLACA, $plantilla->TEXTO);
							break;
						case 'DOCUMENTOS':
							$descr = 'EXTRAVÍO ORIGINAL DE: [TIPODOCUMENTO] A NOMBRE DE: [NOMBRE_DUENO] CON NÚMERO DE FOLIO: [NDOCUMENTO]';
							if (!$constancia->NDOCUMENTO) {
								$descr = str_replace('CON NÚMERO DE FOLIO: [NDOCUMENTO]', '', $descr);
								$plantilla->TEXTO = str_replace(', N&Uacute;MERO: <strong>[NO_DOCUMENTO]</strong>,', '', $plantilla->TEXTO);
							}
							$descr = str_replace('[TIPODOCUMENTO]', $constancia->TIPODOCUMENTO, $descr);
							$descr = str_replace('[NOMBRE_DUENO]', $constancia->DUENONOMBREDOC . " " . $constancia->DUENOAPELLIDOPDOC . " " . $constancia->DUENOAPELLIDOMDOC, $descr);
							$descr = str_replace('[NDOCUMENTO]', $constancia->NDOCUMENTO, $descr);
							$plantilla->TEXTO = str_replace('[DESCRIPCION_EXTRAVIO]', $descr, $plantilla->TEXTO);
							$plantilla->TEXTO = str_replace('[NO_DOCUMENTO]', $constancia->NDOCUMENTO, $plantilla->TEXTO);
							$plantilla->TEXTO = str_replace('[NOMBRE_CERTIFICADO]', $constancia->TIPODOCUMENTO, $plantilla->TEXTO);
							break;
						default:
							$plantilla->TEXTO = str_replace('[NO_DOCUMENTO]', '', $plantilla->TEXTO);
							$plantilla->TEXTO = str_replace('[NOMBRE_CERTIFICADO]', '', $plantilla->TEXTO);
							break;
					}

					// Generacion de la firma
					$signature = $this->_generateSignature($user_id, $document_name, $plantilla->TEXTO, $folio, $FECHAFIRMA, $HORAFIRMA);

					//PLACEHOLDER *************************************************************************************************************************************************************************

					$plantilla->PLACEHOLDER = str_replace('[FOLIO_NUMERO]', $constancia->CONSTANCIAEXTRAVIOID, $plantilla->PLACEHOLDER);
					$plantilla->PLACEHOLDER = str_replace('[NOMBRE_AGENTE_FIRMA]', $razon_social, $plantilla->PLACEHOLDER);
					$plantilla->PLACEHOLDER = str_replace('[DOMICILIO_COMPARECIENTE]', $constancia->DOMICILIO, $plantilla->PLACEHOLDER);
					$plantilla->PLACEHOLDER = str_replace('[NOMBRE_COMPARECIENTE]', $solicitante->NOMBRE . " " . $solicitante->APELLIDO_PATERNO . " " . $solicitante->APELLIDO_MATERNO, $plantilla->PLACEHOLDER);
					if ($constancia->DUENONOMBREDOC) {
						$plantilla->PLACEHOLDER = str_replace('[NOMBRE_DUENO]', $constancia->DUENONOMBREDOC . " " . $constancia->DUENOAPELLIDOPDOC . " " . $constancia->DUENOAPELLIDOMDOC, $plantilla->PLACEHOLDER);
					} else {
						$plantilla->PLACEHOLDER = str_replace('[NOMBRE_DUENO]', $solicitante->NOMBRE . " " . $solicitante->APELLIDO_PATERNO . " " . $solicitante->APELLIDO_MATERNO, $plantilla->PLACEHOLDER);
					}
					$plantilla->PLACEHOLDER = str_replace('[LUGAR_EXTRAVIO]', $lugar->HECHODESCR, $plantilla->PLACEHOLDER);
					$plantilla->PLACEHOLDER = str_replace('[NOMBRE_CIUDAD]', $municipio->MUNICIPIODESCR . ", " . $estado->ESTADODESCR, $plantilla->PLACEHOLDER);
					$plantilla->PLACEHOLDER = str_replace('[FECHA_EXTRAVIO]', $dia_extravio . '/' . strtoupper($mes_extravio) . '/' . $ano_extravio, $plantilla->PLACEHOLDER);
					$plantilla->PLACEHOLDER = str_replace('[DIA]', date('d'), $plantilla->PLACEHOLDER);
					$plantilla->PLACEHOLDER = str_replace('[MES]', strtoupper($meses[date('m') - 1]), $plantilla->PLACEHOLDER);
					$plantilla->PLACEHOLDER = str_replace('[ANIO_FIRMA]', strtoupper(date('Y')), $plantilla->PLACEHOLDER);
					$plantilla->PLACEHOLDER = str_replace('[ANIO]', $year, $plantilla->PLACEHOLDER);
					$plantilla->PLACEHOLDER = str_replace('[HORA]', date('H:i'), $plantilla->PLACEHOLDER);

					switch ($constancia->EXTRAVIO) {
						case 'BOLETOS DE SORTEO':
							$plantilla->PLACEHOLDER = str_replace('[NOMBRE_CERTIFICADO]', 'BOLETOS', $plantilla->PLACEHOLDER);

							$timestamp_sorteo = strtotime($constancia->SORTEOFECHA);
							$dia_sorteo = date('d', $timestamp_sorteo);
							$ano_sorteo = date('Y', $timestamp_sorteo);
							$mes_sorteo = $meses[date('n', $timestamp_sorteo) - 1];

							$descr = 'EXTRAVÍO DE BOLETO CON NÚMERO: [NBOLETO] Y TALÓN CON NÚMERO: [NTALON] DEL SORTEO: [NOMBRESORTEO] A CELEBRARSE EL DÍA: [SORTEOFECHA], CON PERMISO DE GOBERNACIÓN: [PERMISOGOBERNACION], Y PERMISO DE GOBERNACIÓN DE COLABORADORES: [PERMISOGOBCOLABORADORES].';
							$descr = str_replace('[NBOLETO]', $constancia->NBOLETO, $descr);
							$descr = str_replace('[NTALON]', $constancia->NTALON, $descr);
							$descr = str_replace('[NOMBRESORTEO]', $constancia->NOMBRESORTEO, $descr);
							$descr = str_replace('[PERMISOGOBERNACION]', $constancia->PERMISOGOBERNACION, $descr);
							$descr = str_replace('[PERMISOGOBCOLABORADORES]', $constancia->PERMISOGOBCOLABORADORES, $descr);
							$descr = str_replace('[SORTEOFECHA]', $dia_sorteo . '/' . strtoupper($mes_sorteo) . '/' . $ano_sorteo, $descr);
							$plantilla->PLACEHOLDER = str_replace('[DESCRIPCION_EXTRAVIO]', $descr, $plantilla->PLACEHOLDER);
							$plantilla->PLACEHOLDER = str_replace('[NO_DOCUMENTO]', $constancia->NBOLETO, $plantilla->PLACEHOLDER);
							break;
						case 'PLACAS':
							$perdido = '';
							if (str_contains($constancia->POSICIONPLACA, 'PLACA DELANTERA') || str_contains($constancia->POSICIONPLACA, 'PLACA TRASERA')) {
								$perdido = $constancia->POSICIONPLACA;
								if (str_contains($constancia->POSICIONPLACA, 'ESTATALES')) {
									$constancia->POSICIONPLACA = str_replace('ESTATALES', '', $constancia->POSICIONPLACA);
									$ext = $constancia->POSICIONPLACA . ' ESTATAL';
								} else if (str_contains($constancia->POSICIONPLACA, 'NACIONALES')) {
									$constancia->POSICIONPLACA = str_replace('NACIONALES', '', $constancia->POSICIONPLACA);
									$ext = $constancia->POSICIONPLACA . ' NACIONAL';
								} else {
									$constancia->POSICIONPLACA = str_replace('EXTRANJERAS', '', $constancia->POSICIONPLACA);
									$ext = $constancia->POSICIONPLACA . ' EXTRANJERA';
								}
							} else {
								$perdido = 'PLACAS';
								$ext = $constancia->POSICIONPLACA;
							}
							$descr = 'EXTRAVÍO DE: [POSICIONPLACA]<br>NÚMERO: [NPLACA]<br><br>RESPECTO DE UN VEHÍCULO:<br>MARCA:[MARCA]<br>LINEA: [MODELO]<br>MODELO: [ANIOVEHICULO]<br>NÚMERO DE SERIE: [SERIEVEHICULO]';
							$descr = str_replace('[POSICIONPLACA]', $ext, $descr);
							$descr = str_replace('[NPLACA]', $constancia->NPLACA, $descr);
							$descr = str_replace('[MARCA]', $constancia->MARCA, $descr);
							$descr = str_replace('[MODELO]', $constancia->MODELO, $descr);
							$descr = str_replace('[ANIOVEHICULO]', $constancia->ANIOVEHICULO, $descr);
							$descr = str_replace('[SERIEVEHICULO]', $constancia->SERIEVEHICULO, $descr);
							$plantilla->PLACEHOLDER = str_replace('[DESCRIPCION_EXTRAVIO]', $descr, $plantilla->PLACEHOLDER);
							$plantilla->PLACEHOLDER = str_replace('[NOMBRE_CERTIFICADO]', $perdido, $plantilla->PLACEHOLDER);
							$plantilla->PLACEHOLDER = str_replace('[NO_DOCUMENTO]', $constancia->NPLACA, $plantilla->PLACEHOLDER);
							$plantilla->PLACEHOLDER = str_replace('[DESCRIPCION]', $constancia->NPLACA, $plantilla->PLACEHOLDER);
							break;
						case 'DOCUMENTOS':
							$descr = 'EXTRAVÍO ORIGINAL DE: [TIPODOCUMENTO] A NOMBRE DE: [NOMBRE_DUENO] CON NÚMERO DE FOLIO: [NDOCUMENTO]';
							if (!$constancia->NDOCUMENTO) {
								$descr = str_replace('CON NÚMERO DE FOLIO: [NDOCUMENTO]', '', $descr);
								$plantilla->PLACEHOLDER = str_replace(', N&Uacute;MERO: <strong>[NO_DOCUMENTO]</strong>,', '', $plantilla->PLACEHOLDER);
							}
							$descr = str_replace('[TIPODOCUMENTO]', $constancia->TIPODOCUMENTO, $descr);
							$descr = str_replace('[NOMBRE_DUENO]', $constancia->DUENONOMBREDOC . " " . $constancia->DUENOAPELLIDOPDOC . " " . $constancia->DUENOAPELLIDOMDOC, $descr);
							$descr = str_replace('[NDOCUMENTO]', $constancia->NDOCUMENTO, $descr);
							$plantilla->PLACEHOLDER = str_replace('[DESCRIPCION_EXTRAVIO]', $descr, $plantilla->PLACEHOLDER);
							$plantilla->PLACEHOLDER = str_replace('[NO_DOCUMENTO]', $constancia->NDOCUMENTO, $plantilla->PLACEHOLDER);
							$plantilla->PLACEHOLDER = str_replace('[NOMBRE_CERTIFICADO]', $constancia->TIPODOCUMENTO, $plantilla->PLACEHOLDER);
							break;
						default:
							$plantilla->PLACEHOLDER = str_replace('[NO_DOCUMENTO]', '', $plantilla->PLACEHOLDER);
							$plantilla->PLACEHOLDER = str_replace('[NOMBRE_CERTIFICADO]', '', $plantilla->PLACEHOLDER);
							break;
					}

					$plantilla->PLACEHOLDER = str_replace('[NUMEROIDENTIFICADOR]', $constancia->CONSTANCIAEXTRAVIOID . '/' . $constancia->ANO, $plantilla->PLACEHOLDER);
					$plantilla->PLACEHOLDER = str_replace('[FIRMAELECTRONICA]', $signature->signature, $plantilla->PLACEHOLDER);
					$plantilla->PLACEHOLDER = str_replace('[RFCFIRMA_FIRMA]', $rfc, $plantilla->PLACEHOLDER);
					$plantilla->PLACEHOLDER = str_replace('[NCERTIFICADOFIRMA]', $num_certificado, $plantilla->PLACEHOLDER);
					$plantilla->PLACEHOLDER = str_replace('[FECHAFIRMA]', $FECHAFIRMA, $plantilla->PLACEHOLDER);
					$plantilla->PLACEHOLDER = str_replace('[HORAFIRMA]', $HORAFIRMA, $plantilla->PLACEHOLDER);
					$plantilla->PLACEHOLDER = str_replace('[LUGARFIRMA]', $municipio->MUNICIPIODESCR . ", " . $estado->ESTADODESCR, $plantilla->PLACEHOLDER);
					$plantilla->PLACEHOLDER = str_replace('[URL]', $url, $plantilla->PLACEHOLDER);

					// Si se creó bien la firma
					if ($signature->status == 1) {
						//Crea el XML
						$xml = $this->_createXMLSignature($signature->signed_chain, $signature->signature, $numfolio, $year);

						//QR de la URL de validacion
						$qr1 = $this->_generateQR($url);
						//QR del contenido de la FIRMA
						$qr2 = $this->_generateQR($signature->signed_chain);

						$plantilla->PLACEHOLDER = str_replace('[CODIGO_QR_1]', '<img src="' . $qr1 . '" width="50px" height="50px">', $plantilla->PLACEHOLDER);
						$plantilla->PLACEHOLDER = str_replace('[CODIGO_QR_2]', '<img src="' . $qr2 . '" width="120px" height="120px">', $plantilla->PLACEHOLDER);
						//Generacion del PDF de la constancia
						$pdf = $this->_generatePDF($plantilla->PLACEHOLDER);

						$datosInsert = [
							'AGENTEID' => $user_id,
							'NUMEROIDENTIFICADOR' => $constancia->CONSTANCIAEXTRAVIOID . '/' . $constancia->ANO,
							'RAZONSOCIALFIRMA' => $razon_social,
							'RFCFIRMA' => $rfc,
							'NCERTIFICADOFIRMA' => $num_certificado,
							'FECHAFIRMA' => $FECHAFIRMA,
							'HORAFIRMA' => $HORAFIRMA,
							'LUGARFIRMA' => $municipio->MUNICIPIODESCR . ", " . $estado->ESTADODESCR,
							'FIRMAELECTRONICA' => base64_decode($signature->signature),
							'CADENAFIRMADA' => $signature->signed_chain,
							'PLACEHOLDER' => $plantilla->PLACEHOLDER,
							'XML' => $xml,
							'PDF' => $pdf,
							'STATUS' => 'FIRMADO'
						];

						//Verifica que si este abierta esa constancia
						$constancia = $this->_constanciaExtravioModelRead->asObject()->where('CONSTANCIAEXTRAVIOID', $numfolio)->where('ANO', $year)->where('STATUS !=', 'FIRMADO')->first();
						if (!$constancia) {
							return redirect()->to(base_url('/admin/dashboard/constancias_extravio_abiertas'))->with('message_error', 'No existe la constancia o ya fue firmada.');
						}
						// Actualiza con los nuevos campos
						$update = $this->_constanciaExtravioModel->set($datosInsert)->where('CONSTANCIAEXTRAVIOID ', $numfolio)->where('ANO', $year)->update();

						if ($update) {
							$datosBitacora = [
								'ACCION' => 'Ha firmado una constancia',
								'NOTAS' => 'CONSTANCIA: ' . $numfolio . ' AÑO: ' . $year,
							];
							$this->_bitacoraActividad($datosBitacora);
							if ($this->_sendEmailConstanciaFirmada($solicitante->CORREO, $numfolio, $year, $xml, $pdf)) {
								return redirect()->to(base_url('/admin/dashboard/constancias_extravio_abiertas'))->with('message_success', 'Constancia firmada correctamente.');
							} else {
								return redirect()->to(base_url('/admin/dashboard/constancias_extravio_abiertas'))->with('message_success', 'Constancia firmada correctamente.');
							}
						} else {
							return redirect()->to(base_url('/admin/dashboard/constancia_extravio_show?folio=' . $numfolio . '&year=' . $year))->with('message_error', 'Hubo un error al guardar la firma electrónica. Intentelo de nuevo.');
						}
					} else {
						return redirect()->to(base_url('/admin/dashboard/constancia_extravio_show?folio=' . $numfolio . '&year=' . $year))->with('message_error', 'Fallo al firmar el documento. Intentelo de nuevo.');
					}
				} else {
					return redirect()->to(base_url('/admin/dashboard/constancia_extravio_show?folio=' . $numfolio . '&year=' . $year))->with('message_error', 'La FIEL no es válida o está vencida');
				}
			}
		} catch (\Exception $e) {
			return redirect()->to(base_url('/admin/dashboard/constancia_extravio_show?folio=' . $numfolio . '&year=' . $year))->with('message_error', $e->getMessage());
		}
	}
	/**
	 * Función para firmar los documentos de manera general
	 * Recibe por metodo POST el expediente, folio y año
	 */
	public function firmar_documentos()
	{
		$numexpediente = $this->request->getPost('expediente_modal');
		$folio = $this->request->getPost('folio');
		if ($numexpediente == null) {
			$numexpediente = $this->request->getPost('expediente');
		}
		$expediente = $numexpediente;
		$year = $this->request->getPost('year_modal');
		if ($year == null) {
			$year = $this->request->getPost('year');
		}
		$password = str_replace(' ', '', trim($this->request->getPost('contrasena')));
		$user_id = session('ID');
		$meses = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
		$FECHAFIRMA = date("Y-m-d");
		$HORAFIRMA = date("H:i");

		if ($folio == null || $folio == "undefined") {
			return json_encode((object)['status' => 0, 'message_error' => "El folio esta vacío y no se puede firmar el documento."]);
		}

		// Buscar documentos que no estan firmados.
		$documento = $this->_folioDocModelRead->asObject()->where('FOLIOID', $folio)->where('ANO', $year)->where('STATUS', 'ABIERTO')->findAll();
		if ($documento == null || count($documento) <= 0) {
			return json_encode((object)['status' => 0, 'message_error' => "No hay documentos por firmar, asegurate de haber agregado y firmado los documentos."]);
		}

		// Info folio
		$folioRow = $this->_folioModelRead->asObject()->where('FOLIOID', $folio)->where('ANO', $year)->first();
		if (!$folioRow) {
			return json_encode((object)['status' => 0, 'message_error' => "El folio no se encontro y no se pueden firmar los documentos."]);
		}

		try {
			// Creacion de archivos PEM y autenticacion de contraseña
			if ($this->_crearArchivosPEMText($user_id, $password)) {

				// Validacion de que exista esa firma FIEL
				if ($this->_validarFiel($user_id)) {

					// Info de la firma
					$fiel_user = $this->_extractData($user_id);
					$razon_social = $fiel_user['razon_social'];
					$rfc = $fiel_user['rfc'];
					$num_certificado = $fiel_user['num_certificado'];
					for ($i = 0; $i < count($documento); $i++) {
						$municipio = (object)[];

						// Validacion de que usuario puede firmar
						if (empty($documento[$i]->ENCARGADO_ASIGNADO) && isset($documento[$i]->AGENTE_ASIGNADO) && $documento[$i]->AGENTE_ASIGNADO != session('ID')) {
							return json_encode((object)['status' => 0, 'message_error' => "No tienes permiso para firmar en este folio."]);
						} else if (isset($documento[$i]->ENCARGADO_ASIGNADO) && $documento[$i]->ENCARGADO_ASIGNADO != session('ID')) {
							return json_encode((object)['status' => 0, 'message_error' => "Solo puede firmar el encargado asignado."]);
						} else if (isset($documento[$i]->ENCARGADO_ASIGNADO) && $documento[$i]->ENCARGADO_ASIGNADO != session('ID') && isset($documento[$i]->AGENTE_ASIGNADO)) {
							return json_encode((object)['status' => 0, 'message_error' => "Solo puede firmar el encargado asignado."]);
						}

						// Reemplazar variables de los documentos
						$documento[$i]->PLACEHOLDER = str_replace('[EXPEDIENTE_NOMBRE_DEL_RESPONSABLE]', $razon_social, $documento[$i]->PLACEHOLDER);
						$documento[$i]->PLACEHOLDER = str_replace('EXPEDIENTE_NOMBRE_DEL_RESPONSABLE', $razon_social, $documento[$i]->PLACEHOLDER);
						$documento[$i]->PLACEHOLDER = str_replace('[NOMBRE_LICENCIADO]', $razon_social, $documento[$i]->PLACEHOLDER);
						$documento[$i]->PLACEHOLDER = str_replace('[EXPEDIENTE_NOMBRE_MP_RESPONSABLE]', $razon_social, $documento[$i]->PLACEHOLDER);
						$text = $documento[$i]->PLACEHOLDER;
						$text = str_replace('<', ' <', $text);
						$text = strip_tags($text);
						$text = str_replace(chr(13), ' ', $text);
						$text = str_replace(chr(10), ' ', $text);
						$text = str_replace('  ', ' ', trim($text));

						//Municipio de acuerdo al documento o al folio
						$municipio = $this->_municipiosModelRead->asObject()->where('MUNICIPIOID', $documento[$i]->MUNICIPIOID)->where('ESTADOID', $documento[$i]->ESTADOID)->first();
						if (isset($municipio) == false) {
							$municipio = $this->_municipiosModelRead->asObject()->where('MUNICIPIOID', $folioRow->MUNICIPIOID)->where('ESTADOID', $folioRow->ESTADOID)->first();
						}
						$estado = $this->_estadosModel->asObject()->where('ESTADOID', $documento[$i]->ESTADOID)->first();

						// Generacion de la firma electrónica
						$signature = $this->_generateSignature($user_id, ($documento[$i]->TIPODOC ? $documento[$i]->PLACEHOLDER : " "), $text, $folio . '/' . $year, $FECHAFIRMA, $HORAFIRMA);

						// URL para los QR
						$urldoc = base_url('/validar_documento?folio=' . base64_encode($folio) . '&year=' . $year . '&foliodoc=' . base64_encode($documento[$i]->FOLIODOCID));

						//Comprimir firma
						if (strlen($signature->signed_chain) > 2930) {
							$signature->signed_chain = substr($signature->signed_chain, 0, 2930) . '...';
						}

						$datapdf = array(
							'placeholder' => $documento[$i]->PLACEHOLDER,
							'firma' => $signature->signature,
							'numeroident' => $documento[$i]->FOLIOID . '/' . $documento[$i]->ANO . '/' . $documento[$i]->FOLIODOCID,
							'agente' => $razon_social,
							'rfc' => $rfc,
							'certificado' => $num_certificado,
							'fecha' => $FECHAFIRMA,
							'hora' => $HORAFIRMA,
							'lugar' => $municipio->MUNICIPIODESCR . ", " . $estado->ESTADODESCR,
							'qr3' => $this->_generateQR($signature->signed_chain),
							'url' => $urldoc,
							'qrurl' => $this->_generateQR($urldoc)
						);

						//Generacion del PDF del documento
						$pdf = $this->_generatePDFDocumentos($datapdf);

						if ($signature->status == 1) {
							//Crea el XML de la firma
							$xmldocumentos = $this->_createXMLSignature($signature->signed_chain, $signature->signature, $expediente, $year);
							$datosInsert = [
								'NUMEROIDENTIFICADOR' => $documento[$i]->FOLIOID . '/' . $documento[$i]->ANO . '/' . $documento[$i]->FOLIODOCID,
								'RAZONSOCIALFIRMA' => $razon_social,
								'RFCFIRMA' => $rfc,
								'NCERTIFICADOFIRMA' => $num_certificado,
								'FECHAFIRMA' => $FECHAFIRMA,
								'HORAFIRMA' => $HORAFIRMA,
								'LUGARFIRMA' => $municipio->MUNICIPIODESCR . ", " . $estado->ESTADODESCR,
								'FIRMAELECTRONICA' => base64_decode($signature->signature),
								'CADENAFIRMADA' => $signature->signed_chain,
								'PDF' => $pdf,
								'XML' => $xmldocumentos,
								'STATUS' => 'FIRMADO',
								'PLACEHOLDER' => $documento[$i]->PLACEHOLDER,
							];

							// Actualiza con los nuevos campos
							$update = $this->_folioDocModel->set($datosInsert)->where('FOLIOID', $folio)->where('ANO', $year)->where('FOLIODOCID', $documento[$i]->FOLIODOCID)->update();

							if ($update) {
								$datosBitacora = [
									'ACCION' => 'Ha firmado un documento',
									'NOTAS' => 'Identificador: ' . $documento[$i]->FOLIOID . '/' . $documento[$i]->ANO . '/' . $documento[$i]->FOLIODOCID,
								];
								$this->_bitacoraActividad($datosBitacora);
							}
						} else {
							return json_encode((object)['status' => 0, 'message_error' => "Fallo al firmar el documento. Intentelo de nuevo."]);
						}
					}

					//Cargar documentos actualizados para imprimir en vista.
					$documentosExp = $this->_folioDocModelRead->get_by_folio($folio, $year);

					return json_encode((object)['status' => 1, 'documentos' => $documentosExp]);
				} else {
					return json_encode((object)['status' => 0, 'message_error' => "La FIEL no es válida o está vencida"]);
				}
			}
		} catch (\Exception $e) {
			return json_encode((object)['status' => 0, 'message_error' => $e->getMessage()]);
		}
	}

	/**
	 * Función para firmar un documento de acuerdo a su id
	 * Recibe por metodo POST el folio,año y id del documento
	 */
	public function firmar_documentos_by_id()
	{
		$folio = $this->request->getPost('folio_id');
		$year = $this->request->getPost('year_doc');
		$documento_id = $this->request->getPost('documento_id');
		$password = str_replace(' ', '', trim($this->request->getPost('contrasena_doc')));
		$user_id = session('ID');
		$meses = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
		$FECHAFIRMA = date("Y-m-d");
		$HORAFIRMA = date("H:i");

		if ($folio == null || $folio == "undefined") {
			return json_encode((object)['status' => 0, 'message_error' => "El folio esta vacío y no se puede firmar el documento."]);
		}

		// Info del documento y folio
		$documento = $this->_folioDocModelRead->asObject()->where('FOLIOID', $folio)->where('ANO', $year)->where('FOLIODOCID', $documento_id)->where('STATUS', 'ABIERTO')->findAll();
		if ($documento == null || count($documento) <= 0) {
			return json_encode((object)['status' => 0, 'message_error' => "No esta el documento a firmar."]);
		}

		// Info folio
		$folioRow = $this->_folioModelRead->asObject()->where('FOLIOID', $folio)->where('ANO', $year)->first();
		if (!$folioRow) {
			return json_encode((object)['status' => 0, 'message_error' => "El folio no se encontro y no se pueden firmar los documentos."]);
		}

		try {
			// Creacion de archivos PEM y autenticacion de contraseña
			if ($this->_crearArchivosPEMText($user_id, $password)) {

				// Validacion de que exista esa firma FIEL
				if ($this->_validarFiel($user_id)) {

					// Info de la firma
					$fiel_user = $this->_extractData($user_id);
					$razon_social = $fiel_user['razon_social'];
					$rfc = $fiel_user['rfc'];
					$num_certificado = $fiel_user['num_certificado'];

					for ($i = 0; $i < count($documento); $i++) {
						$municipio = (object)[];

						// Validacion de que usuario puede firmar
						if (empty($documento[$i]->ENCARGADO_ASIGNADO) && isset($documento[$i]->AGENTE_ASIGNADO) && $documento[$i]->AGENTE_ASIGNADO != session('ID')) {
							return json_encode((object)['status' => 0, 'message_error' => "No tienes permiso para firmar en este folio."]);
						} else if (isset($documento[$i]->ENCARGADO_ASIGNADO) && $documento[$i]->ENCARGADO_ASIGNADO != session('ID')) {
							return json_encode((object)['status' => 0, 'message_error' => "Solo puede firmar el encargado asignado."]);
						} else if (isset($documento[$i]->ENCARGADO_ASIGNADO) && $documento[$i]->ENCARGADO_ASIGNADO != session('ID') && isset($documento[$i]->AGENTE_ASIGNADO)) {
							return json_encode((object)['status' => 0, 'message_error' => "Solo puede firmar el encargado asignado."]);
						}

						// Reemplazar variables de los documentos
						$documento[$i]->PLACEHOLDER = str_replace('[EXPEDIENTE_NOMBRE_DEL_RESPONSABLE]', $razon_social, $documento[$i]->PLACEHOLDER);
						$documento[$i]->PLACEHOLDER = str_replace('EXPEDIENTE_NOMBRE_DEL_RESPONSABLE', $razon_social, $documento[$i]->PLACEHOLDER);
						$documento[$i]->PLACEHOLDER = str_replace('[NOMBRE_LICENCIADO]', $razon_social, $documento[$i]->PLACEHOLDER);
						$documento[$i]->PLACEHOLDER = str_replace('[EXPEDIENTE_NOMBRE_MP_RESPONSABLE]', $razon_social, $documento[$i]->PLACEHOLDER);
						$text = $documento[$i]->PLACEHOLDER;
						$text = str_replace('<', ' <', $text);
						$text = strip_tags($text);
						$text = str_replace(chr(13), ' ', $text);
						$text = str_replace(chr(10), ' ', $text);
						$text = str_replace('  ', ' ', trim($text));

						//Municipio de acuerdo al documento o al folio
						$municipio = $this->_municipiosModelRead->asObject()->where('MUNICIPIOID', $documento[$i]->MUNICIPIOID)->where('ESTADOID', $documento[$i]->ESTADOID)->first();
						if (isset($municipio) == false) {
							$municipio = $this->_municipiosModelRead->asObject()->where('MUNICIPIOID', $folioRow->MUNICIPIOID)->where('ESTADOID', $folioRow->ESTADOID)->first();
						}
						$estado = $this->_estadosModelRead->asObject()->where('ESTADOID', $documento[$i]->ESTADOID)->first();

						// Generacion de la firma
						$signature = $this->_generateSignature($user_id, "FIRMA DE DOCUMENTOS", $text, $folio, $FECHAFIRMA, $HORAFIRMA);

						// URL para los QR
						$urldoc = base_url('/validar_documento?folio=' . base64_encode($folio) . '&year=' . $year . '&foliodoc=' . base64_encode($documento_id));

						//Comprimir firma
						if (strlen($signature->signed_chain) > 2930) {
							$signature->signed_chain = substr($signature->signed_chain, 0, 2930) . '...';
						}

						$datapdf = array(
							'placeholder' => $documento[$i]->PLACEHOLDER,
							'firma' => $signature->signature,
							'numeroident' => $documento[$i]->FOLIOID . '/' . $documento[$i]->ANO . '/' . $documento[$i]->FOLIODOCID,
							'agente' => $razon_social,
							'rfc' => $rfc,
							'certificado' => $num_certificado,
							'fecha' => $FECHAFIRMA,
							'hora' => $HORAFIRMA,
							'lugar' => $municipio->MUNICIPIODESCR . ", " . $estado->ESTADODESCR,
							'qr3' => $this->_generateQR($signature->signed_chain),
							'url' => $urldoc,
							'qrurl' => $this->_generateQR($urldoc)
						);

						//Generacion del PDF del documento
						$pdf = $this->_generatePDFDocumentos($datapdf);

						if ($signature->status == 1) {

							//Crea el XML de la firma
							$xmldocumentos = $this->_createXMLSignature($signature->signed_chain, $signature->signature, $folio, $year);

							$datosInsert = [
								'NUMEROIDENTIFICADOR' => $documento[$i]->FOLIOID . '/' . $documento[$i]->ANO . '/' . $documento[$i]->FOLIODOCID,
								'RAZONSOCIALFIRMA' => $razon_social,
								'RFCFIRMA' => $rfc,
								'NCERTIFICADOFIRMA' => $num_certificado,
								'FECHAFIRMA' => $FECHAFIRMA,
								'HORAFIRMA' => $HORAFIRMA,
								'LUGARFIRMA' => $municipio->MUNICIPIODESCR . ", " . $estado->ESTADODESCR,
								'FIRMAELECTRONICA' => base64_decode($signature->signature),
								'CADENAFIRMADA' => $signature->signed_chain,
								'PDF' => $pdf,
								'XML' => $xmldocumentos,
								'STATUS' => 'FIRMADO',
								'PLACEHOLDER' => $documento[$i]->PLACEHOLDER,
							];

							// Actualiza con los nuevos campos
							$update = $this->_folioDocModel->set($datosInsert)->where('FOLIOID', $folio)->where('ANO', $year)->where('FOLIODOCID', $documento[$i]->FOLIODOCID)->update();

							if ($update) {
								$datosBitacora = [
									'ACCION' => 'Ha firmado un documento',
									'NOTAS' => 'Identificador: ' . $documento[$i]->FOLIOID . '/' . $documento[$i]->ANO . '/' . $documento[$i]->FOLIODOCID,
								];
								$this->_bitacoraActividad($datosBitacora);
							} else {
								return json_encode((object)['status' => 0, 'message_error' => "No se actualizo el archivo, por lo tanto no fue posible generar el pdf."]);
							}
						} else {
							return json_encode((object)['status' => 0, 'message_error' => "Fallo al firmar el documento. Intentelo de nuevo."]);
						}
					}

					//Cargar documentos actualizados para imprimir en vista.
					$documentosExp = $this->_folioDocModelRead->get_by_folio($folio, $year);

					return json_encode((object)['status' => 1, 'documentos' => $documentosExp]);
				} else {
					return json_encode((object)['status' => 0, 'message_error' => "La FIEL no es válida o está vencida"]);
				}
			}
		} catch (\Exception $e) {
			return json_encode((object)['status' => 0, 'message_error' => $e->getMessage()]);
		}
	}

	/**
	 * Funcion para crear los archivos PEM y validar de acuerdo a la contraseña ingresada y poder firmar documentos
	 * Crear archivos .key.pem, .cer.pem y .txt a partir de archivos .key y .cer 
	 * * Autenticación del usuario mediante la FIEL 
	 * @param  mixed $agenteId
	 * @param  mixed $pass
	 */
	private function _crearArchivosPEMText($agenteId, $pass)
	{
		$user_id = $agenteId;
		$password = $pass;
		if ($user_id) {
			$directory = FCPATH . 'uploads/FIEL/' . $user_id;
			$file_key = $user_id . '_key.key';
			$file_cer = $user_id . '_cer.cer';

			$file_key_pem = $user_id . '_key.key.pem';
			$file_cer_pem = $user_id . '_cer.cer.pem';

			$file_txt  = $user_id . "_data.txt";

			if (file_exists($directory)) {
				if (file_exists($directory . '/' . $file_key) && file_exists($directory . '/' . $file_cer)) {

					//CREAR ARCHIVO .KEY.PEM  ******************
					$comando_key_pem = "pkcs8 -inform DER -in " . $directory . '/' . $file_key . " -passin pass:$password -out " . $directory . '/' . $file_key_pem;
					exec('openssl ' . $comando_key_pem, $arr, $status);

					if ($status === 0) {
						chmod($directory . '/' . $file_key_pem, 0777);
					} else {
						throw new \Exception('La contraseña de la FIEL es incorrecta.');
					}

					//CREAR ARCHIVO .CER.PEM  ******************
					$comando_cer_pem = "x509 -inform DER -outform PEM -in " . $directory . '/' . $file_cer . " -passin pass:$password -out " . $directory . '/' . $file_cer_pem;
					exec('openssl ' . $comando_cer_pem, $arr, $status);

					if ($status === 0) {
						chmod($directory . '/' . $file_cer_pem, 0777);
					} else {
						throw new \Exception('La contraseña de la FIEL es incorrecta.');
					}

					//CREAR ARCHIVO .TXT CON INFO DEL .PEM  ******************
					$comandoOpenSSL = "x509 -in " . $directory . '/' . $file_cer_pem . " > " . $directory . '/' . $file_txt . " -text";
					exec('openssl ' . $comandoOpenSSL, $arr, $status);

					if ($status == 0) {
						chmod($directory . '/' . $file_txt, 0777);
					} else {
						throw new \Exception('La contraseña de la FIEL es incorrecta.');
					}

					if (file_exists($directory . '/' . $file_key_pem) && file_exists($directory . '/' . $file_cer_pem) && file_exists($directory . '/' . $file_txt)) {
						return true;
					} else {
						try {
							unlink($directory . '/' . $file_key_pem);
						} catch (\Exception $e) {
						}
						try {
							unlink($directory . '/' . $file_key_pem);
						} catch (\Exception $e) {
						}
						try {
							unlink($directory . '/' . $file_txt);
						} catch (\Exception $e) {
						}
						return false;
					}
				} else {
					throw new \Exception('No existe una FIEL del usuario, favor de subirla en la sección de perfil.');
				}
			} else {
				throw new \Exception('No existe una FIEL del usuario, favor de subirla en la sección de perfil.');
			}
		} else {
			throw new \Exception('No existe el id del agente.');
		}
	}

	/**
	 * Funcion para validar la firma FIEL
	 *
	 * @param  mixed $agentId
	 */
	private function _validarFiel($agentId)
	{
		$user_id = $agentId;
		$directory = FCPATH . 'uploads/FIEL/' . $user_id;
		$file_txt  = $user_id . "_data.txt";

		$sslcert = file_get_contents($directory . '/' . $file_txt);
		$sslcert = array(openssl_x509_parse($sslcert, TRUE));

		foreach ($sslcert as $name => $arrays) {
			foreach ($arrays as $title => $value) {
				if (is_array($value)) {
					foreach ($value as $subtitle => $subvalue) {
						if ($subtitle == "keyUsage") {
							$ArrayUsos = explode(",", $subvalue);
						}
					}
				}
			}
		}

		for ($i = 0; $i < count($ArrayUsos); $i++) {
			if (trim($ArrayUsos[$i]) == "Digital Signature") {
				$ResBus1 = 1;
			}
			if (trim($ArrayUsos[$i]) == "Data Encipherment") {
				$ResBus2 = 1;
			}
			if (trim($ArrayUsos[$i]) == "Key Agreement") {
				$ResBus3 = 1;
			}
		}

		$FechaActual = date("Y/m/d");

		$datosFIEL = file_get_contents($directory . '/' . $file_txt);

		$CadABusc1 = "Not Before:";
		$pos1 = strpos($datosFIEL, $CadABusc1);

		$CadABusc2 = "Not After :";
		$pos2 = strpos($datosFIEL, $CadABusc2);

		$Fecha1 = substr($datosFIEL, $pos1 + 12, 24);
		$Fecha2 = substr($datosFIEL, $pos2 + 12, 24);

		$PrimerFecha  = date("Y/m/d", strtotime($Fecha1));
		$SegundaFecha = date("Y/m/d", strtotime($Fecha2));

		//VERIFICAR SI ES UNA FIEL  ******************************************************
		if ($ResBus1 == 1 && $ResBus2 == 1 && $ResBus3 == 1) {
			# VERIFICAR VIGENCIA DE LA FIEL  ******************************************************
			if ($FechaActual >= $PrimerFecha && $FechaActual <= $SegundaFecha) {
				return true;
			} else {
				return false;
			}
		} else {
			return false;
		}
	}

	/**
	 * Función para extraer la información de la firma FIEL del usaurio
	 *
	 * @param  mixed $agentId
	 */
	private function _extractData($agentId)
	{
		$user_id = $agentId;
		$directory = FCPATH . 'uploads/FIEL/' . $user_id;
		$file_cer_pem = $user_id . '_cer.cer.pem';

		$Comando_NoCert = "x509 -in " . $directory . '/' . $file_cer_pem . " -noout -serial";
		$NoCert = exec('openssl ' . $Comando_NoCert, $arr, $status);
		//Convertir a numeros el certificado
		$NoCert = $this->_ConvANum($NoCert);
		//Extraer el numero de certificado
		$NoCert = trim($this->_ExtraeNoCer($NoCert));

		// Obtener la Razon social y RFC.

		$Comando_DatosContrib = "x509 -in " . $directory . '/' . $file_cer_pem . " -noout -subject -nameopt oneline,-esc_msb";
		$NomProp = exec('openssl ' . $Comando_DatosContrib, $arr, $status);

		if ($status === 0) {
			$ArraySubject = explode(",", $NomProp);
			$ArrayNom = explode("=", $ArraySubject[1]);
			$ArrayRFC = explode("=", $ArraySubject[5]);
			$razonSocial = trim($ArrayNom[1]);
			$rfc = trim($ArrayRFC[1]);
			return ['razon_social' => $razonSocial, 'rfc' => $rfc, 'num_certificado' => $NoCert];
		} else {
			return false;
		}
	}

	/**
	 * Función para generar una firma electronica
	 *
	 * @param  mixed $agentId
	 * @param  mixed $documentName
	 * @param  mixed $text
	 * @param  mixed $folio
	 * @param  mixed $fecha
	 * @param  mixed $hora
	 */
	private function _generateSignature($agentId, $documentName, $text, $folio, $fecha, $hora)
	{
		$fecha = $fecha;
		$hora  = $hora;
		$directory = FCPATH . 'uploads/FIEL/' . $agentId;
		$file_key_pem = $agentId . '_key.key.pem';
		$file_cer_pem = $agentId . '_cer.cer.pem';

		//Firmar cadena
		$cadena_a_firmar = $fecha . "|" . $hora . "|" . $folio . "|" . $documentName . "|" . $text;

		// traer la clave privada desde el archivo y prepararla. =======================
		$fp = fopen($directory . '/' . $file_key_pem, "r");
		$priv_key = fread($fp, 8192);
		fclose($fp);
		//Se obtiene un identificador de clave privada a partir de la clave privada del agente 
		$pkeyid = openssl_get_privatekey($priv_key);

		// Generar la firma ============================================================
		try {
			openssl_sign($cadena_a_firmar, $signature, $pkeyid, OPENSSL_ALGO_SHA512);
		} catch (\Exception $e) {
			throw new \Exception('No se pudo generar la firma electrónica. Intentelo de nuevo.');
		}

		// Liberar la clave de la memoria ==============================================
		// openssl_free_key($pkeyid);

		// Verificar que firma sea valida ==============================================
		// traer la clave pública desde el certifiado y prepararla
		$fp = fopen($directory . '/' . $file_cer_pem, "r");
		$cert = fread($fp, 8192);
		fclose($fp);
		//Se obtiene un identificador de clave pública a partir del certificado del agente
		$pubkeyid = openssl_get_publickey($cert);

		// Verifica que la firma electrónica sea válida utilizando la cadena original, la firma y la clave pública del agente.
		$ok = openssl_verify($cadena_a_firmar, $signature, $pubkeyid, OPENSSL_ALGO_SHA512);

		// Liberar la clave de la memoria ==============================================
		// openssl_free_key($pubkeyid);

		if ($ok == 1) {
			return (object)['status' => 1, 'signature' => base64_encode($signature), 'signed_chain' => $cadena_a_firmar, 'fecha' => $fecha, 'hora' => $hora];
		} else {
			throw new \Exception('No se pudo generar la firma electrónica. Intentelo de nuevo.');
		}
	}

	/**
	 * Función para crear el archivo XML de la firma
	 *
	 * @param  mixed $signed_chain
	 * @param  mixed $e_signature
	 * @param  mixed $folio
	 * @param  mixed $year
	 */
	private function _createXMLSignature($signed_chain, $e_signature, $folio, $year)
	{
		$xml  = new \DOMdocument('1.0', 'UTF-8');
		$root = $xml->createElement("documento");
		$root = $xml->appendChild($root);
		$datsDoc = $xml->createElement("DatosDelDocumento");
		$datsDoc = $root->appendChild($datsDoc);

		$firmaDigital = $xml->createElement("FirmaDigital");
		$firmaDigital = $root->appendChild($firmaDigital);
		// $file_xml = 'Constancia_' . $folio . '_' . $year . '.xml';
		// $directory = FCPATH . 'uploads/xml';

		$this->_loadAtt(
			$firmaDigital,
			array(
				"CadenaFirmada" => "$signed_chain",
				"FirmaBase64" => "$e_signature"
			)
		);

		$ArchXML = $xml->saveXML();
		// $xml->formatOutput = true;
		// if (!file_exists($directory)) {
		// 	mkdir($directory, 0777, true);
		// }
		// $xml->save($directory . '/' . $file_xml);
		unset($xml);

		return $ArchXML;
	}

	/**
	 * Función para convertir una cadena a numeros
	 *
	 * @param  mixed $str
	 */
	private function _ConvANum($str)
	{
		$legalChars = "%[^0-9\-\. ]%";
		$str        = preg_replace($legalChars, "", $str);
		return $str;
	}

	/**
	 * Funcion para extrar la caducidad
	 * Devuelve una nueva cadena de texto que contiene solo los caracteres que aparecen en las posiciones impares de la cadena original.
	 * @param  mixed $Cad
	 */
	private function _ExtraeNoCer($Cad)
	{
		$Cad1 = $Cad;
		$Cad2 = "";
		while (strlen($Cad1) > 0) {
			$Cad2 .= substr($Cad1, 1, 1);
			$Cad1 = substr($Cad1, 2, strlen($Cad1) - 2);
		}
		return $Cad2;
	}

	/**
	 * Función para cargar los atributos de un nodo XML
	 * $nodo es el objeto  $attr atributos asociativos
	 * @param  mixed $nodo
	 * @param  mixed $attr
	 */
	private function _loadAtt(&$nodo, $attr)
	{
		global $xml;
		foreach ($attr as $key => $val) {
			$val = trim($val);
			if (strlen($val) > 0) {
				$nodo->setAttribute($key, $val);
			}
		}
	}

	/**
	 * Genera el PDF de la constancia de extravio
	 *
	 * @param  mixed $placeholder
	 */
	private function _generatePDF($placeholder)
	{
		$arrContextOptions = array(
			"ssl" => array(
				"verify_peer" => false,
				"verify_peer_name" => false,
			),
		);

		$data = (object)array();
		$data->placeholder = $placeholder;
		$data->image1 = base64_encode(file_get_contents(base_url('assets/img/logo_fgebc.jpg'), false, stream_context_create($arrContextOptions)));
		$data->image2 = base64_encode(file_get_contents(base_url('assets/img/logo_sejap.jpg'), false, stream_context_create($arrContextOptions)));

		$options = new Options();
		$options->set('isRemoteEnabled', true);
		$options->set('isPhpEnabled', true);
		// $options->set('defaultFont', 'Arial');
		$dompdf = new Dompdf($options);
		$dompdf->loadHtml(view('doc_template/document', ['data' => $data]));
		$dompdf->setPaper('A4', 'portrait');
		$dompdf->render();
		$canvas = $dompdf->getCanvas();

		$canvas->page_script(function ($pageNumber, $pageCount, $canvas, $fontMetrics) {
			$font = $fontMetrics->getFont('arial', 'regular');
			$text = "PÁGINA $pageNumber DE $pageCount";
			$size = 8;
			$x = $canvas->get_width();
			$y = $canvas->get_height();
			$width = $fontMetrics->getTextWidth($text, $font, $size);
			$canvas->text($x - 60 - $width, $y - 50, $text, $font, $size, array(0, 0, 0));
		});
		return $dompdf->output();
	}

	/**
	 * Genera el PDF de los documentos
	 *
	 * @param  mixed $datapdf
	 */
	private function _generatePDFDocumentos($datapdf)
	{

		$arrContextOptions = array(
			"ssl" => array(
				"verify_peer" => false,
				"verify_peer_name" => false,
			),
		);

		$data = (object)array();

		$data->placeholder = $datapdf['placeholder'];
		$data->firmaelectronica = $datapdf['firma'];
		$data->numidenficador = $datapdf['numeroident'];

		$data->agentefirma = $datapdf['agente'];

		$data->rfcfirma = $datapdf['rfc'];
		$data->ncertificadofirma = $datapdf['certificado'];
		$data->fechaf = $datapdf['fecha'];

		$data->horaf = $datapdf['hora'];
		$data->lugarf = $datapdf['lugar'];
		$data->url = $datapdf['url'];

		$data->qr3 =  base64_encode(file_get_contents($datapdf['qr3'], false, stream_context_create($arrContextOptions)));
		$data->qrurl =  base64_encode(file_get_contents($datapdf['qrurl'], false, stream_context_create($arrContextOptions)));



		$data->image1 = base64_encode(file_get_contents(base_url('assets/img/logo_fgebc.jpg'), false, stream_context_create($arrContextOptions)));
		$data->image2 = base64_encode(file_get_contents(base_url('assets/img/logo_sejap.jpg'), false, stream_context_create($arrContextOptions)));

		$options = new Options();
		$options->set('isRemoteEnabled', true);
		$options->set('isPhpEnabled', true);
		// $options->set('defaultFont', 'Arial');
		$dompdf = new Dompdf($options);
		$dompdf->loadHtml(view('doc_template/template_document_generado', ['data' => $data]));
		$dompdf->setPaper('A4', 'portrait');
		$dompdf->render();
		$canvas = $dompdf->getCanvas();

		$canvas->page_script(function ($pageNumber, $pageCount, $canvas, $fontMetrics) {
			$font = $fontMetrics->getFont('arial', 'regular');
			$text = "PÁGINA $pageNumber DE $pageCount";
			$size = 8;
			$x = $canvas->get_width();
			$y = $canvas->get_height();
			$width = $fontMetrics->getTextWidth($text, $font, $size);
			$canvas->text($x - 60 - $width, $y - 50, $text, $font, $size, array(0, 0, 0));
		});
		return $dompdf->output();
	}

	/**
	 * Función para generar codigos qr
	 *
	 * @param  mixed $info
	 */
	private function _generateQR($info)
	{
		$writer = new PngWriter();

		// Create QR code
		$qrCode = QrCode::create($info)
			->setEncoding(new Encoding('UTF-8'))
			->setErrorCorrectionLevel(new ErrorCorrectionLevelLow())
			->setSize(300)
			->setMargin(1)
			->setRoundBlockSizeMode(new RoundBlockSizeModeMargin())
			->setForegroundColor(new Color(0, 0, 0))
			->setBackgroundColor(new Color(255, 255, 255));
		$result = $writer->write($qrCode);

		header('Content-Type: ' . $result->getMimeType());
		return $result->getDataUri();
	}

	/**
	 * Función para enviar por correo al denunciante la constancia firmada
	 *
	 * @param  mixed $to
	 * @param  mixed $folio
	 * @param  mixed $year
	 * @param  mixed $xml
	 * @param  mixed $pdf
	 */
	private function _sendEmailConstanciaFirmada($to, $folio, $year, $xml, $pdf)
	{

		$body = view('email_template/constancia_firmada_email_template.php');
		$mailersend = new MailerSend(['api_key' => EMAIL_TOKEN]);
		$recipients = [
			new Recipient($to, 'Your Client'),
		];
		$attachments = [
			new Attachment($pdf, 'Constancia_' . $folio . '_' . $year . '.pdf', 'attachment'),
			new Attachment($xml, 'Constancia_' . $folio . '_' . $year . '.xml', 'attachment')
		];

		$emailParams = (new EmailParams()) //check envio 
			->setFrom('notificacionfgebc@fgebc.gob.mx')
			->setFromName('FGEBC')
			->setRecipients($recipients)
			->setSubject('Constancia de extravío firmada')
			->setHtml($body)
			->setText('SE HA FIRMADO TU CONSTANCIA SOLICITADA:Ingrese a su cuenta en el Centro de Denuncia Tecnológica e inicie sesión para descargarla nuevamente')
			->setAttachments($attachments)
			->setReplyTo('notificacionfgebc@fgebc.gob.mx')
			->setReplyToName('FGEBC');

		try {
			$result = $mailersend->email->send($emailParams);
		} catch (MailerSendValidationException $e) {
			$result = false;
		} catch (MailerSendRateLimitException $e) {
			$result = false;
		}
		if ($result) {
			return true;
		} else {
			return false;
		}
	}

	/**
	 * Función para enviar por correo al denunciante un documento en especifico
	 *
	 */
	public function sendEmailDocumentoByID()
	{
		$to = trim($this->request->getPost('send_mail_select'));
		$year = $this->request->getPost('year_modal_correo');
		$folio = $this->request->getPost('folio');
		$expediente = $this->request->getPost('expediente_modal_correo');
		$folio_doc = $this->request->getPost('folio_doc');
		$meses = array("ENERO", "FEBRERO", "MARZO", "ABRIL", "MAYO", "JUNIO", "JULIO", "AGOSTO", "SEPTIEMBRE", "OCTUBRE", "NOVIEMBRE", "DICIEMBRE");

		if ($to && $year && $folio) {
			if ($expediente != "undefined" && $expediente != '') {
				$documento = $this->_folioDocModelRead->asObject()->where('FOLIOID', $folio)->where('ANO', $year)->where('STATUS', 'FIRMADO')->where('STATUSENVIO', 1)->where('ENVIADO', 'N')->where('FOLIODOCID', $folio_doc)->first();
				$folioM = $this->_folioModelRead->asObject()->where('ANO', $year)->where('EXPEDIENTEID', $expediente)->first();
				$tipoExpediente = $this->_tipoExpedienteModelRead->asObject()->where('TIPOEXPEDIENTEID',  $folioM->TIPOEXPEDIENTEID)->first();
				$delito = $this->_folioRelacionFisFisModelRead->get_by_folio($folio, $year);
				$delito =  $delito[0]['DELITOMODALIDADDESCR'];
			} else {

				$documento = $this->_folioDocModelRead->asObject()->where('FOLIOID', $folio)->where('ANO', $year)->where('STATUS', 'FIRMADO')->where('STATUSENVIO', 1)->where('ENVIADO', 'N')->where('FOLIODOCID', $folio_doc)->first();

				$folioM = $this->_folioModelRead->asObject()->where('ANO', $year)->where('FOLIOID', $folio)->first();
				$tipoExpediente = '';
				$delito = '';
			}
			if (empty($documento)) {
				return json_encode((object)['status' => 2]);
			}

			$imputado = $this->_folioPersonaFisicaModelRead->asObject()->where('ANO', $year)->where('FOLIOID', $folioM->FOLIOID)->where('CALIDADJURIDICAID', 2)->first();
			$agente = $this->_usuariosModelRead->asObject()->where('ID', session('ID'))->first();

			$folio = $folioM->FOLIOID;

			if ($folioM->MUNICIPIOASIGNADOID != null) {
				$municipio = $this->_municipiosModelRead->asObject()->where('MUNICIPIOID', $folioM->MUNICIPIOASIGNADOID)->where('ESTADOID', 2)->first();
			} else {
				$municipio = $this->_municipiosModelRead->asObject()->where('MUNICIPIOID', $folioM->INSTITUCIONREMISIONMUNICIPIOID)->where('ESTADOID', 2)->first();
			}
			$fecha_actual = date('d') . ' DE ' . $meses[date('n') - 1] . " DEL " . date('Y');
			$agente = trim($agente->NOMBRE . ' ' . $agente->APELLIDO_PATERNO . ' ' .  $agente->APELLIDO_MATERNO);
			$imputado = trim($imputado->NOMBRE . ' ' . $imputado->PRIMERAPELLIDO . ' ' .  $imputado->SEGUNDOAPELLIDO);

			$aviso_privacidad = file_get_contents(FCPATH . 'assets/documentos/Aviso_De_Privacidad_De_Datos.pdf');
			$derecho_ofendido = file_get_contents(FCPATH . 'assets/documentos/DerechosDeVictimaOfendido.pdf');
			$termino_condiciones = file_get_contents(FCPATH . 'assets/documentos/TerminosCondiciones.pdf');

			$body = view('email_template/documentos_firmados_email_template.php', ['municipio' => $municipio, 'fecha' => $fecha_actual, 'agente' => $agente, 'expediente' => $folioM->EXPEDIENTEID ? $expediente : 'SIN EXPEDIENTE', 'folio' => $folio, 'year' => $folioM->ANO, 'tipoexpediente' => $folioM->TIPOEXPEDIENTEID ? ($tipoExpediente  == "" ? $tipoExpediente : $tipoExpediente->TIPOEXPEDIENTEDESCR) : $folioM->STATUS, 'status' => $folioM->STATUS, 'delito' => $delito, 'imputado' => $imputado, 'claveexpediente' => $folioM->TIPOEXPEDIENTEID ? ($tipoExpediente  == "" ? $tipoExpediente : $tipoExpediente->TIPOEXPEDIENTECLAVE) : $folioM->STATUS]);

			$mailersend = new MailerSend(['api_key' => EMAIL_TOKEN]);
			$recipients = [
				new Recipient($to, 'Your Client'),
			];

			$emailParams = (new EmailParams())
				->setFrom('notificacionfgebc@fgebc.gob.mx')
				->setFromName('FGEBC')
				->setRecipients($recipients)
				->setSubject('FGEBC - Documentos folio: ' . $folio . '/' . $folioM->ANO)
				->setHtml($body);

			if ($folioM->STATUS == 'EXPEDIENTE') {
				$expediente_guiones = '';
				$arrayExpediente = str_split($folioM->EXPEDIENTEID);
				$expediente_guiones =  $arrayExpediente[1] . $arrayExpediente[2] . $arrayExpediente[4] . $arrayExpediente[5] . '-' . $arrayExpediente[6] . $arrayExpediente[7] . $arrayExpediente[8] . $arrayExpediente[9] . '-' . $arrayExpediente[10] . $arrayExpediente[11] . $arrayExpediente[12] . $arrayExpediente[13] . $arrayExpediente[14];
				$claveexpediente =  $folioM->TIPOEXPEDIENTEID ? ($tipoExpediente  == "" ? $tipoExpediente : $tipoExpediente->TIPOEXPEDIENTECLAVE) : $folioM->STATUS;

				$emailParams->setText('Estimado usuario, el Centro de Denuncia Tecnológica de la Fiscalía General del Estado de Baja California, tiene por recibido su folio' . $folio . '/' . $folioM->ANO . ', mediante el cual expone hechos presumiblemente como delito, por lo que se generó el expediente número' . $expediente_guiones . '/' . $claveexpediente .
					', por la probable comisión del delito ' . $delito . 'y/o lo que resulte en contra de' . $imputado . '. Se le informa que en el expediente generado se ordenaron los documentos que se adjuntan al presente correo. Para consultar el estado de su expediente puede ingresar a https://cdtec.fgebc.gob.mx. Lo anterior, con fundamento en lo dispuesto por los artículos 20 inciso C y 21 de la Constitución Política de los Estados Unidos Mexicanos, el numeral 131 fracción II del Código Nacional de Procedimientos Penales, así como el artículo 22 fracción II y demás relativos de la Ley Orgánica de la Fiscalía General del Estado de Baja California.' .
					isset($municipio) ? $municipio->MUNICIPIODESCR . ', ' : '' . 'BAJA CALIFORNIA' . $fecha_actual . 'LIC.' . $agente . 'AGENTE DEL MINISTERIO PÚBLICO CON ADSCRIPCIÓN CENTRO DE DENUNCIA TECNOLÓGICA DE LA FISCALÍA GENERAL DEL ESTADO DE BAJA CALIFORNIA');
			} else {
				$emailParams->setText('Estimado usuario, el Centro de Denuncia Tecnológica de la Fiscalía General del Estado de Baja California, tiene por recibido su folio' . $folio . '/' . $folioM->ANO . ',respecto del cual se generó derivación o canalización, misma que se adjunta al presente correo, lo anterior en virtud de que la solicitud planteada corresponde a diversa autoridad.' .
					isset($municipio) ? $municipio->MUNICIPIODESCR . ', ' : '' . 'BAJA CALIFORNIA' . $fecha_actual . 'LIC.' . $agente . 'AGENTE DEL MINISTERIO PÚBLICO CON ADSCRIPCIÓN CENTRO DE DENUNCIA TECNOLÓGICA DE LA FISCALÍA GENERAL DEL ESTADO DE BAJA CALIFORNIA');
			}
			$attachments = [];
			$sendPolice = false;
			$ordenesProteccion = [];

			if ($documento->TIPODOC == 'DENUNCIA ANONIMA') {
				$pdf = $documento->PDF;
				array_push($attachments, new Attachment($pdf, $documento->TIPODOC ? str_replace(" ", "_", $documento->TIPODOC) : '' . '_' . $expediente . '_' . $year . '_' . $documento->FOLIODOCID . '.pdf', 'attachment'));
			} else {
				$pdf = $documento->PDF;
				$xml = $documento->XML;
				array_push($attachments, new Attachment($pdf, $documento->TIPODOC ? str_replace(" ", "_", $documento->TIPODOC) : '' . '_' . $expediente . '_' . $year . '_' . $documento->FOLIODOCID . '.pdf', 'attachment'));
				array_push($attachments, new Attachment($xml, $documento->TIPODOC ? str_replace(" ", "_", $documento->TIPODOC) : '' . '_' . $expediente . '_' . $year . '_' . $documento->FOLIODOCID . '.xml', 'attachment'));
				
				if (strpos($documento->TIPODOC, "ORDEN DE PROTECCION") !== false) {
					array_push($ordenesProteccion, $documento);
					$sendPolice = true;
				}
			}

			array_push($attachments, new Attachment($termino_condiciones, 'Terminos y Condiciones.pdf', 'attachment'));
			array_push($attachments, new Attachment($aviso_privacidad, 'Aviso de Privacidad.pdf', 'attachment'));
			array_push($attachments, new Attachment($derecho_ofendido, 'Derechos de Víctima u Ofendido.pdf', 'attachment'));
			$emailParams->setAttachments($attachments);
			$emailParams->setReplyTo('notificacionfgebc@fgebc.gob.mx');
			$emailParams->setReplyToName('FGEBC');

			if ($sendPolice && count($ordenesProteccion) > 0) {
				$ordenes = $this->sendEmailOrdenesProteccion($folioM->MUNICIPIOASIGNADOID, $municipio, $fecha_actual, $ordenesProteccion);
				if($ordenes){
					try {
						$result = $mailersend->email->send($emailParams);
					} catch (MailerSendValidationException $e) {
						$result = false;
					} catch (MailerSendRateLimitException $e) {
						$result = false;
					}
					if ($result) {
						$datosUpdate = [
							'ENVIADO' => 'S',
						];
						$update = $this->_folioDocModel->set($datosUpdate)->where('FOLIOID', $folio)->where('ANO', $year)->where('FOLIODOCID', $documento->FOLIODOCID)->update();
		
						return json_encode((object)['status' => 1, 'sendpolice' => $sendPolice]);
					} else {
						return json_encode((object)['status' => 0]);
					}
				}
			} else {
				try {
					$result = $mailersend->email->send($emailParams);
				} catch (MailerSendValidationException $e) {
					$result = false;
				} catch (MailerSendRateLimitException $e) {
					$result = false;
				}
				if ($result) {
					$datosUpdate = [
						'ENVIADO' => 'S',
					];
					$update = $this->_folioDocModel->set($datosUpdate)->where('FOLIOID', $folio)->where('ANO', $year)->where('FOLIODOCID', $documento->FOLIODOCID)->update();
	
					return json_encode((object)['status' => 1, 'sendpolice' => $sendPolice]);
				} else {
					return json_encode((object)['status' => 0]);
				}
			}
		} else {
			return json_encode((object)['status' => 3]);
		}
	}

	/**
	 * Función para enviar por correo al denunciante todos los documentos de su folio
	 *
	 */
	public function sendEmailDocumentos()
	{
		$to = trim($this->request->getPost('send_mail_select'));
		$expediente = $this->request->getPost('expediente_modal_correo');
		$year = $this->request->getPost('year_modal_correo');
		$folio = $this->request->getPost('folio');
		$meses = array("ENERO", "FEBRERO", "MARZO", "ABRIL", "MAYO", "JUNIO", "JULIO", "AGOSTO", "SEPTIEMBRE", "OCTUBRE", "NOVIEMBRE", "DICIEMBRE");
		$sendPolice = false;
		$ordenesProteccion = [];

		if ($to && $year && $folio) {

			if ($expediente != "undefined" && $expediente != '') {
				$documento = $this->_folioDocModelRead->asObject()->where('FOLIOID', $folio)->where('ANO', $year)->where('STATUS', 'FIRMADO')->where('STATUSENVIO', 1)->where('ENVIADO', 'N')->findAll();
				$folioM = $this->_folioModelRead->asObject()->where('ANO', $year)->where('EXPEDIENTEID', $expediente)->first();
				$tipoExpediente = $this->_tipoExpedienteModelRead->asObject()->where('TIPOEXPEDIENTEID',  $folioM->TIPOEXPEDIENTEID)->first();
				$delito = $this->_folioRelacionFisFisModelRead->get_by_folio($folio, $year);
				$delito =  $delito[0]['DELITOMODALIDADDESCR'];
			} else {
				$documento = $this->_folioDocModelRead->asObject()->where('FOLIOID', $folio)->where('ANO', $year)->where('STATUS', 'FIRMADO')->where('STATUSENVIO', 1)->where('ENVIADO', 'N')->findAll();
				$folioM = $this->_folioModelRead->asObject()->where('ANO', $year)->where('FOLIOID', $folio)->first();
				$tipoExpediente = '';
				$delito = '';
			}

			if (empty($documento)) {
				return json_encode((object)['status' => 2]);
			}

			$imputado = $this->_folioPersonaFisicaModelRead->asObject()->where('ANO', $year)->where('FOLIOID', $folioM->FOLIOID)->where('CALIDADJURIDICAID', 2)->first();
			$agente = $this->_usuariosModelRead->asObject()->where('ID', session('ID'))->first();

			$folio = $folioM->FOLIOID;

			if ($folioM->MUNICIPIOASIGNADOID != null) {
				$municipio = $this->_municipiosModelRead->asObject()->where('MUNICIPIOID', $folioM->MUNICIPIOASIGNADOID)->where('ESTADOID', 2)->first();
			} else {
				$municipio = $this->_municipiosModelRead->asObject()->where('MUNICIPIOID', $folioM->INSTITUCIONREMISIONMUNICIPIOID)->where('ESTADOID', 2)->first();
			}
			$fecha_actual = date('d') . ' DE ' . $meses[date('n') - 1] . " DEL " . date('Y');
			$agente = trim($agente->NOMBRE . ' ' . $agente->APELLIDO_PATERNO . ' ' .  $agente->APELLIDO_MATERNO);
			$imputado = trim($imputado->NOMBRE . ' ' . $imputado->PRIMERAPELLIDO . ' ' .  $imputado->SEGUNDOAPELLIDO);

			$aviso_privacidad = file_get_contents(FCPATH . 'assets/documentos/Aviso_De_Privacidad_De_Datos.pdf');
			$derecho_ofendido = file_get_contents(FCPATH . 'assets/documentos/DerechosDeVictimaOfendido.pdf');
			$termino_condiciones = file_get_contents(FCPATH . 'assets/documentos/TerminosCondiciones.pdf');


			$body = view('email_template/documentos_firmados_email_template.php', ['municipio' => $municipio, 'fecha' => $fecha_actual, 'agente' => $agente, 'expediente' => $folioM->EXPEDIENTEID ? $expediente : 'SIN EXPEDIENTE', 'folio' => $folio, 'year' => $folioM->ANO, 'tipoexpediente' => $folioM->TIPOEXPEDIENTEID ? ($tipoExpediente  == "" ? $tipoExpediente : $tipoExpediente->TIPOEXPEDIENTEDESCR) : $folioM->STATUS, 'status' => $folioM->STATUS, 'delito' => $delito, 'imputado' => $imputado, 'claveexpediente' => $folioM->TIPOEXPEDIENTEID ? ($tipoExpediente  == "" ? $tipoExpediente : $tipoExpediente->TIPOEXPEDIENTECLAVE) : $folioM->STATUS]);

			$mailersend = new MailerSend(['api_key' => EMAIL_TOKEN]);
			$recipients = [
				new Recipient($to, 'Your Client'),
			];

			$emailParams = (new EmailParams())
				->setFrom('notificacionfgebc@fgebc.gob.mx')
				->setFromName('FGEBC')
				->setRecipients($recipients)
				->setSubject('FGEBC - Documentos folio: ' . $folio . '/' . $folioM->ANO)
				->setHtml($body);
			$attachments = [];

			if ($folioM->STATUS == 'EXPEDIENTE') {
				$expediente_guiones = '';
				$arrayExpediente = str_split($folioM->EXPEDIENTEID);
				$expediente_guiones =  $arrayExpediente[1] . $arrayExpediente[2] . $arrayExpediente[4] . $arrayExpediente[5] . '-' . $arrayExpediente[6] . $arrayExpediente[7] . $arrayExpediente[8] . $arrayExpediente[9] . '-' . $arrayExpediente[10] . $arrayExpediente[11] . $arrayExpediente[12] . $arrayExpediente[13] . $arrayExpediente[14];
				$claveexpediente =  $folioM->TIPOEXPEDIENTEID ? ($tipoExpediente  == "" ? $tipoExpediente : $tipoExpediente->TIPOEXPEDIENTECLAVE) : $folioM->STATUS;
				$emailParams->setText('Estimado usuario, el Centro de Denuncia Tecnológica de la Fiscalía General del Estado de Baja California, tiene por recibido su folio' . $folio . '/' . $year . ', mediante el cual expone hechos presumiblemente como delito, por lo que se generó el expediente número' . $expediente_guiones . '/' . $claveexpediente .
					', por la probable comisión del delito ' . $delito . 'y/o lo que resulte en contra de' . $imputado . '. Se le informa que en el expediente generado se ordenaron los documentos que se adjuntan al presente correo. Para consultar el estado de su expediente puede ingresar a https://cdtec.fgebc.gob.mx. Lo anterior, con fundamento en lo dispuesto por los artículos 20 inciso C y 21 de la Constitución Política de los Estados Unidos Mexicanos, el numeral 131 fracción II del Código Nacional de Procedimientos Penales, así como el artículo 22 fracción II y demás relativos de la Ley Orgánica de la Fiscalía General del Estado de Baja California.' .
					isset($municipio) ? $municipio->MUNICIPIODESCR . ', ' : '' . 'BAJA CALIFORNIA' . $fecha_actual . 'LIC.' . $agente . 'AGENTE DEL MINISTERIO PÚBLICO CON ADSCRIPCIÓN CENTRO DE DENUNCIA TECNOLÓGICA DE LA FISCALÍA GENERAL DEL ESTADO DE BAJA CALIFORNIA');
			} else {
				$emailParams->setText('Estimado usuario, el Centro de Denuncia Tecnológica de la Fiscalía General del Estado de Baja California, tiene por recibido su folio' . $folio . '/' . $year . ',respecto del cual se generó derivación o canalización, misma que se adjunta al presente correo, lo anterior en virtud de que la solicitud planteada corresponde a diversa autoridad.' .
					isset($municipio) ? $municipio->MUNICIPIODESCR . ', ' : '' . 'BAJA CALIFORNIA' . $fecha_actual . 'LIC.' . $agente . 'AGENTE DEL MINISTERIO PÚBLICO CON ADSCRIPCIÓN CENTRO DE DENUNCIA TECNOLÓGICA DE LA FISCALÍA GENERAL DEL ESTADO DE BAJA CALIFORNIA');
			}
			for ($i = 0; $i < count($documento); $i++) {
				if ($documento[$i]->TIPODOC == 'DENUNCIA ANONIMA') {
					$pdf = $documento[$i]->PDF;
					array_push($attachments, new Attachment($pdf,  $documento[$i]->TIPODOC ? str_replace("", "_", $documento[$i]->TIPODOC) : '' . '_' . $expediente . '_' . $year . '_' . $documento[$i]->FOLIODOCID . '.pdf', 'attachment'));
				} else {
					$pdf = $documento[$i]->PDF;
					$xml = $documento[$i]->XML;
					array_push($attachments, new Attachment($pdf, $documento[$i]->TIPODOC ? str_replace("", "_", $documento[$i]->TIPODOC) : '' . '_' . $expediente . '_' . $year . '_' . $documento[$i]->FOLIODOCID . '.pdf', 'attachment'));
					array_push($attachments, new Attachment($xml, $documento[$i]->TIPODOC ? str_replace("", "_", $documento[$i]->TIPODOC) : '' . '_' . $expediente . '_' . $year . '_' . $documento[$i]->FOLIODOCID . '.xml', 'attachment'));
					if (strpos($documento[$i]->TIPODOC, "ORDEN DE PROTECCION") !== false) {
						array_push($ordenesProteccion, $documento[$i]);
						$sendPolice = true;
					}
				}
			}

			array_push($attachments, new Attachment($termino_condiciones, 'Terminos y Condiciones.pdf', 'attachment'));
			array_push($attachments, new Attachment($aviso_privacidad, 'Aviso de Privacidad.pdf', 'attachment'));
			array_push($attachments, new Attachment($derecho_ofendido, 'Derechos de Victima u Ofendido.pdf', 'attachment'));
			$emailParams->setAttachments($attachments);
			$emailParams->setReplyTo('notificacionfgebc@fgebc.gob.mx');
			$emailParams->setReplyToName('FGEBC');
			if ($sendPolice && count($ordenesProteccion) > 0) {
				$ordenes = $this->sendEmailOrdenesProteccion($folioM->MUNICIPIOASIGNADOID, $municipio, $fecha_actual, $ordenesProteccion);
				if($ordenes){
					try {
						$result = $mailersend->email->send($emailParams);
					} catch (MailerSendValidationException $e) {
						$result = false;
					} catch (MailerSendRateLimitException $e) {
						$result = false;
					}
					if($result){
						$datosUpdate = [
							'ENVIADO' => 'S',
						];
						for ($i = 0; $i < count($documento); $i++) {
							$update = $this->_folioDocModel->set($datosUpdate)->where('FOLIOID', $folio)->where('ANO', $year)->where('FOLIODOCID', $documento[$i]->FOLIODOCID)->update();
						}
						return json_encode((object)['status' => 1]);
					} else {
						return json_encode((object)['status' => 0]);
					}
				}
			} else {
				try {
					$result = $mailersend->email->send($emailParams);
				} catch (MailerSendValidationException $e) {
					$result = false;
				} catch (MailerSendRateLimitException $e) {
					$result = false;
				}
				if($result){
					$datosUpdate = [
						'ENVIADO' => 'S',
					];
					for ($i = 0; $i < count($documento); $i++) {
						$update = $this->_folioDocModel->set($datosUpdate)->where('FOLIOID', $folio)->where('ANO', $year)->where('FOLIODOCID', $documento[$i]->FOLIODOCID)->update();
					}
					return json_encode((object)['status' => 1]);
				} else {
					return json_encode((object)['status' => 0]);
				}
			}
		} else {
			return json_encode((object)['status' => 3]);
		}
	}

	/**
	 * Función para enviar por correo a Isna y Sonia las alertas de un folio importante
	 *
	 */
	public function sendEmailAlertas()
	{
		$folio = $this->request->getPost('folio');
		$year = $this->request->getPost('year');

		if (ENVIRONMENT == 'development') {
			$to = ['andrea.solorzano@yocontigo-it.com', 'otoniel.f@yocontigo-it.com'];
		} else {
			$to = ['isnad.medel@fgebc.gob.mx', 'direcciongeneralsejap@fgebc.gob.mx'];
		}

		$body = view('email_template/alerta_email_template.php', ['folio' => $folio, 'year' => $year]);
		$mailersend = new MailerSend(['api_key' => EMAIL_TOKEN]);
		$recipients = [
			new Recipient($to[0], 'Your Client'),
			new Recipient($to[1], 'Your Client'),
		];

		$emailParams = (new EmailParams()) //check envio
			->setFrom('notificacionfgebc@fgebc.gob.mx')
			->setFromName('FGEBC')
			->setRecipients($recipients)
			->setSubject('Alerta, revisar folio')
			->setHtml($body)
			->setText('El folio ' . $folio . '/' . $year . 'es un caso de suma importancia. Favor de verificar en el sistema de videodenuncia')
			->setReplyTo('notificacionfgebc@fgebc.gob.mx')
			->setReplyToName('FGEBC');

		try {
			$result = $mailersend->email->send($emailParams);
		} catch (MailerSendValidationException $e) {
			$result = false;
		} catch (MailerSendRateLimitException $e) {
			$result = false;
		}

		if ($result) {
			return json_encode((object)['status' => 1]);
		} else {
			return json_encode((object)['status' => 0]);
		}
	}

	/**
	 * Función para enviar por correo a los policias cuando existen ordenes de proteccion en el folio
	 *
	 * @param  mixed $municipioid
	 * @param  mixed $municipiodescr
	 * @param  mixed $fecha
	 * @param  mixed $documentos
	 */
	public function sendEmailOrdenesProteccion($municipioid, $municipiodescr, $fecha, $documentos)
	{
		//var_dump('enviando ordenes de proteccion');
		if (ENVIRONMENT == 'development') {
			switch ($municipioid) {
				case 1:
					$to_orden_proteccion = ['sergio.v@yocontigo-it.com', 'otoniel.f@yocontigo-it.com'];
					break;
				case 2:
					$to_orden_proteccion = ['sergio.v@yocontigo-it.com', 'otoniel.f@yocontigo-it.com'];
					break;
				case 3:
					$to_orden_proteccion = ['sergio.v@yocontigo-it.com', 'otoniel.f@yocontigo-it.com'];
					break;
				case 4:
					$to_orden_proteccion = ['sergio.v@yocontigo-it.com', 'otoniel.f@yocontigo-it.com'];
					break;
				case 5:
					$to_orden_proteccion = ['sergio.v@yocontigo-it.com', 'otoniel.f@yocontigo-it.com'];
					break;
				case 6:
					$to_orden_proteccion = ['sergio.v@yocontigo-it.com', 'otoniel.f@yocontigo-it.com'];
					break;
				case 7:
					$to_orden_proteccion = ['sergio.v@yocontigo-it.com', 'otoniel.f@yocontigo-it.com'];
					break;
				default:
					$to_orden_proteccion = '';
					break;
			}
		}

		if (ENVIRONMENT == 'production') {
			switch ($municipioid) {
				case 1:
					$to_orden_proteccion = ['copmproteccion@ensenada.gob.mx', 'cdtec@fgebc.gob.mx'];
					break;
				case 2:
					$to_orden_proteccion = ['udai@mexicali.gob.mx', 'cdtec@fgebc.gob.mx'];
					break;
				case 3:
					$to_orden_proteccion = ['seguridad.juridico@tecate.gob.mx', 'cdtec@fgebc.gob.mx'];
					break;
				case 4:
					$to_orden_proteccion = ['enlace.secretaria@tijuana.gob.mx', 'cdtec@fgebc.gob.mx'];
					break;
				case 5:
					$to_orden_proteccion = ['sub.tecnica.ssc@gmail.com', 'cdtec@fgebc.gob.mx'];
					break;
				case 6:
					$to_orden_proteccion = ['dspm-fge@sanquintin.gob.mx', 'cdtec@fgebc.gob.mx'];
					break;
				case 7:
					$to_orden_proteccion = ['dspm@sanfelipe.gob.mx', 'cdtec@fgebc.gob.mx'];
					break;
				default:
					$to_orden_proteccion = '';
					break;
			}
		}

		$body = view('email_template/orden_proteccion_email_template.php', ['municipio' => $municipiodescr, 'fecha' => $fecha]);
		$mailersend = new MailerSend(['api_key' => EMAIL_TOKEN]);
		$recipients = [
			new Recipient($to_orden_proteccion[0], 'Your Client'),
			new Recipient($to_orden_proteccion[1], 'Your Client'),
		];

		$emailParams = (new EmailParams())
			->setFrom('notificacionfgebc@fgebc.gob.mx')
			->setFromName('FGEBC')
			->setRecipients($recipients)
			->setSubject('FGEBC - Ordenes de protección')
			->setHtml($body);
		$attachments = [];

		$emailParams->setText('Anteponiendo un cordial saludo, a través del presente se adjunta medida de protección emergente generada en el Centro de Denuncia Tecnológica de la Fiscalía General del Estado de Baja California, misma que se remite para su debida atención, agradeciendo de antemano su colaboración.' .
			isset($municipiodescr) ? $municipiodescr->MUNICIPIODESCR . ', ' : '' . 'BAJA CALIFORNIA,' . $fecha . 'CENTRO DE DENUNCIA TECNOLÓGICA DE LA FISCALÍA GENERAL DEL ESTADO DE BAJA CALIFORNIA');

		foreach ($documentos as $key => $documento) {
			$pdf = $documento->PDF;
			array_push($attachments, new Attachment($pdf, $documento->TIPODOC . '.pdf', 'attachment'));
		}

		$emailParams->setAttachments($attachments);
		$emailParams->setReplyTo('notificacionfgebc@fgebc.gob.mx');
		$emailParams->setReplyToName('FGEBC');

		try {
			$result = $mailersend->email->send($emailParams);
		} catch (MailerSendValidationException $e) {
			$result = false;
			$info = $e->getMessage();
		} catch (MailerSendRateLimitException $e) {
			$result = false;
			$info = $e->getMessage();
		}
		//var_dump($info);
		return $result;
	}

	/**
	 * Función para agregar información a la bitacora diaria.
	 *
	 * @param  mixed $data
	 */
	private function _bitacoraActividad($data)
	{
		$data = $data;
		$data['ID'] = uniqid();
		$data['USUARIOID'] = session('ID');

		if ($data['USUARIOID']) {
			$this->_bitacoraActividadModel->insert($data);
		}
	}
}
/* End of file FirmaController.php */
/* Location: ./app/Controllers/admin/FirmaController.php */
