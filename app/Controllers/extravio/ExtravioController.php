<?php

namespace App\Controllers\extravio;

use App\Controllers\BaseController;

use App\Models\EstadosModel;
use App\Models\MunicipiosModel;
use App\Models\DenunciantesModel;
use App\Models\ConstanciaExtravioModel;
use App\Models\UsuariosModel;
use App\Models\HechoLugarModel;
use Dompdf\Dompdf;
use Dompdf\Options;
use App\Models\SesionesDenunciantesModel;
use GuzzleHttp\Client;

use MailerSend\MailerSend;
use MailerSend\Helpers\Builder\Recipient;
use MailerSend\Helpers\Builder\EmailParams;
use MailerSend\Exceptions\MailerSendValidationException;
use MailerSend\Exceptions\MailerSendRateLimitException;

class ExtravioController extends BaseController
{
	private $db_read;

	private $_denunciantesModel;
	private $db;
	private $_sesionesDenunciantesModel;
	private $_sesionesDenunciantesModelRead;
	private $_denunciantesModelRead;
	private $_constanciaExtravioModelRead;
	private $_estadosModelRead;
	private $_municipiosModelRead;
	private $_hechoLugarModelRead;
	private $_usuariosModelRead;





	function __construct()
	{
		$this->db_read = ENVIRONMENT == 'production' ? db_connect('default_read') : db_connect('development_read');

		$this->_denunciantesModel = new DenunciantesModel();

		$this->_sesionesDenunciantesModel = new SesionesDenunciantesModel();
		$this->_sesionesDenunciantesModelRead = model('SesionesDenunciantesModel', true, $this->db_read);
		$this->_denunciantesModelRead = model('DenunciantesModel', true, $this->db_read);
		$this->_constanciaExtravioModelRead = model('ConstanciaExtravioModel', true, $this->db_read);
		$this->_usuariosModelRead = model('UsuariosModel', true, $this->db_read);
		$this->_hechoLugarModelRead = model('HechoLugarModel', true, $this->db_read);
		$this->_estadosModelRead = model('EstadosModel', true, $this->db_read);
		$this->_municipiosModelRead = model('MunicipiosModel', true, $this->db_read);

		$this->db = \Config\Database::connect();
	}

	/**
	 * Vista de Login-Constancia de extravio
	 * Autentica que no tenga sesion iniciada, y si tiene sesion lo redirige al dashboard de constancia de extravio
	 *
	 */
	public function index()
	{
		if ($this->_isAuth()) {
			return redirect()->to(base_url('/constancia_extravio/dashboard'));
		} else {
			session()->destroy;
			$this->_loadView('Login', [], 'index');
		}
	}
	/**
	 * Vista para generar un nuevo solicitante de constancia
	 *
	 */
	public function register()
	{
		$this->_loadView('Nuevo solicitante', [], 'register');
	}
	/**
	 * Función para autenticar el ingreso a la plataforma desde las constancias de extravio
	 * Recibe por metodo POST el correo y contraseña
	 *
	 */
	public function login_auth()
	{
		$session = session();
		$email = $this->request->getPost('correo');
		$password = $this->request->getPost('password');
		$email = trim($email);
		$password = trim($password);
		$data = $this->_denunciantesModelRead->where('CORREO', $email)->first();
		if ($data) {
			// Verifica que no tenga sesiones activas

			$control_session = $this->_sesionesDenunciantesModelRead->asObject()->where('ID_DENUNCIANTE', $data['DENUNCIANTEID'])->where('ACTIVO', 1)->first();
			if ($control_session) {
				return redirect()->to(base_url('/denuncia'))->with('message_session', 'Ya tienes sesiones activas, cierralas para continuar.')->with('id',  $data['DENUNCIANTEID']);
			}
			// Valida la contraseña ingresada con la de su usuario

			if (validatePassword($password, $data['PASSWORD'])) {
				$data['logged_in'] = TRUE;
				$data['type'] = 'user_constancias';
				$data['uuid'] = uniqid();

				//Datos de la sesion
				$session->set($data);
				$agent = $this->request->getUserAgent();

				$sesion_data = [
					'ID' => $data['uuid'],
					'ID_DENUNCIANTE' => $data['DENUNCIANTEID'],
					'IP_DENUNCIANTE' => $this->_get_client_ip(),
					'IP_PUBLICA' => $this->_get_public_ip(),
					'DENUNCIANTE_HTTP' => $agent->getBrowser(),
					'DENUNCIANTE_SO' => $agent->getPlatform(),
					'DENUNCIANTE_MOBILE' => $agent->isMobile() ? 1 : 0,
					'ACTIVO' => 1,
				];

				$this->_sesionesDenunciantesModel->insert($sesion_data);
				return redirect()->to(base_url('/constancia_extravio/dashboard'));
			} else {
				$session->setFlashdata('message', 'La contraseña es incorrecta, intentalo de nuevo o da clic en olvide mi contraseña.');
				return redirect()->back();
			}
		} else {
			$session->setFlashdata('message', 'El correo no está registrado, registrate para continuar.');
			return redirect()->back();
		}
	}
	/**
	 * Función para crear un nuevo solicitante
	 * Recibe con metodo POST los datos del formulario
	 *
	 */
	public function create()
	{
		//Genera contraseña para el usuario

		$password = $this->_generatePassword(6);
		//Datos del denunciante

		$data = [
			'NOMBRE' => $this->request->getPost('nombre'),
			'APELLIDO_PATERNO' => $this->request->getPost('apellido_paterno'),
			'APELLIDO_MATERNO' => $this->request->getPost('apellido_materno'),
			'CORREO' => $this->request->getPost('correo'),
			'PASSWORD' => hashPassword($password),
			'TELEFONO' => $this->request->getPost('telefono'),
			'TELEFONO2' => $this->request->getPost('telefono2'),
			'CODIGO_PAIS' => $this->request->getPost('codigo_pais'),
			'CODIGO_PAIS2' => $this->request->getPost('codigo_pais_2'),
			'FECHANACIMIENTO' => $this->request->getPost('fecha_nacimiento'),
			'SEXO' => $this->request->getPost('sexo'),
			'TIPO' => 2,
		];
		//Verifica que el correo sea unico

		if ($this->validate(['correo' => 'required|is_unique[DENUNCIANTES.CORREO]'])) {
			$dataApi2 = [
				'NOMBRE' => $this->request->getPost('nombre'),
				'APELLIDO_PATERNO' => $this->request->getPost('apellido_paterno'),
				'APELLIDO_MATERNO' => $this->request->getPost('apellido_materno'),
				'CORREO' => $this->request->getPost('correo'),
			];
			//Datos a enviar al servicio de videollamada
			$dataApi = array();
			$dataApi['name'] = $this->request->getPost('nombre') . ' ' . $this->request->getPost('apellido_paterno');
			$dataApi['details'] = $dataApi2;
			$dataApi['gender'] = $this->request->getPost('sexo') == 'F' ? "FEMALE" : 'MALE';
			$dataApi['languages'] = [22];
			$urlApi = VIDEOCALL_URL . "guests/";
			$response = $this->_curlPost($urlApi, $dataApi);
			$data['UUID'] = $response->uuid;
			//Respuesta del servicio de videollamada

			if ($response->uuid) {
				$this->_denunciantesModel->insert($data);
				$this->_sendEmailPassword($data['CORREO'], $password);
				return redirect()->to(base_url('/constancia_extravio'))->with('message_success', 'Inicia sesión con la contraseña que llegará a tus mensajes SMS e ingresa.');
			}
		} else {
			return redirect()->back()->with('message_error', 'Hubo un error en los datos o puede que ya exista un registro con el mismo correo');
		}
	}
	/**
	 * Vista de perfil, carga los datos del solicitante en la vista
	 *
	 */
	public function profile()
	{
		$data = (object) array();
		$data->user = $this->_denunciantesModelRead->asObject()->where('DENUNCIANTEID', session('DENUNCIANTEID'))->first();
		$this->_loadView('Perfil', $data, 'perfil');
	}
	/**
	 * Funcion para actualizar el perfil del solicitante.
	 * El formulario es recibido por metodo POST
	 *
	 */
	public function update_profile()
	{
		$session = session();
		$data = [
			'NOMBRE' => $this->request->getPost('nombre'),
			'APELLIDO_PATERNO' => $this->request->getPost('apellido_paterno'),
			'APELLIDO_MATERNO' => $this->request->getPost('apellido_materno'),
			'TELEFONO' => $this->request->getPost('telefono'),
			'TELEFONO2' => $this->request->getPost('telefono2'),
			'FECHANACIMIENTO' => $this->request->getPost('fecha_nacimiento'),
			'SEXO' => $this->request->getPost('sexo'),
		];
		$update = $this->_denunciantesModel->set($data)->where('DENUNCIANTEID', session('DENUNCIANTEID'))->update();
		if ($update) {
			$session->set('NOMBRE', $data['NOMBRE']);
			$session->set('APELLIDO_PATERNO', $data['APELLIDO_PATERNO']);
			$session->set('APELLIDO_MATERNO', $data['APELLIDO_MATERNO']);
			$session->set('TELEFONO', $data['TELEFONO']);
			$session->set('TELEFONO2', $data['TELEFONO2']);
			$session->set('FECHANACIMIENTO', $data['FECHANACIMIENTO']);
			$session->set('SEXO', $data['SEXO']);
			return redirect()->back()->with('message_success', 'Actualizado correctamente.');
		}
		return redirect()->back()->with('message_error', 'No se pudo actualizar el registro.');
	}
	/**
	 * Función para actualizar la contraseña del solicitante
	 * Se recibe la contraseña por metodo POST
	 *
	 */
	public function update_password()
	{
		$password = trim($this->request->getPost('password'));
		$data = [
			'PASSWORD' => hashPassword($password),
		];
		$this->_denunciantesModel->set($data)->where('DENUNCIANTEID', session('DENUNCIANTEID'))->update();

		return redirect()->back()->with('message_success', 'Contraseña actualizada correctamente');
	}
	/**
	 * Funcíon para generar una contraseña aleatoria.
	 * Como parametro se recibe el tamaño de la contraseña
	 *
	 * @param  mixed $length
	 */
	private function _generatePassword($length)
	{
		$password = "";
		$pattern = "1234567890abcdefghijklmnopqrstuvwxyz";
		$max = strlen($pattern) - 1;
		for ($i = 0; $i < $length; $i++) {
			$password .= substr($pattern, mt_rand(0, $max), 1);
		}
		return $password;
	}
	/**
	 * Función para verificar si este el email para evitar duplicidad en registro
	 * ! Deprecated method, do not use
	 */
	public function existEmail()
	{
		$email = $this->request->getPost('email');
		$data = $this->_denunciantesModelRead->where('CORREO', $email)->first();
		if ($data == NULL) {
			return json_encode((object)['exist' => 0]);
		} else if (count($data) > 0) {
			return json_encode((object)['exist' => 1]);
		} else {
			return json_encode((object)['exist' => 0]);
		}
	}
	/**
	 * Función para enviar un correo con la contraseña generada al solicitante
	 *
	 * @param  mixed $to
	 * @param  mixed $password
	 */
	private function _sendEmailPassword($to, $password)
	{
		$user = $this->_denunciantesModelRead->asObject()->where('CORREO', $to)->first();

		$body = view('email_template/password_email_constancia.php', ['email' => $to, 'password' => $password]);
		$mailersend = new MailerSend(['api_key' => EMAIL_TOKEN]);
		$recipients = [
			new Recipient($to, 'Your Client'),
		];
		$emailParams = (new EmailParams())
			->setFrom('notificacionfgebc@fgebc.gob.mx')
			->setFromName('FGEBC')
			->setRecipients($recipients)
			->setSubject('Te estamos atendiendo')
			->setHtml($body)
			->setText('Usted ha generado un nuevo registro en el Centro de Denuncia Tecnológica. Para acceder debes ingresar los siguientes datos. USUARIO: ' . $to . 'CONTRASEÑA' . $password)
			->setReplyTo('notificacionfgebc@fgebc.gob.mx')
			->setReplyToName('FGEBC');

		$sendSMS = $this->sendSMS("Te estamos atendiendo", $user->TELEFONO, 'Notificaciones FGEBC/Estimado usuario, tu contraseña es: ' . $password);

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
			if ($sendSMS == "") {
				return true;
			} else {
				return false;
			}
		}
	}
	/**
	 * Función para mandar por email o sms la nueva contraseña
	 *
	 */
	public function sendEmailChangePassword()
	{
		$password = $this->_generatePassword(6);
		$to = $this->request->getPost('correo_reset_password');
		$user = $this->_denunciantesModelRead->asObject()->where('CORREO', $to)->first();
		$this->_denunciantesModel->set('PASSWORD', hashPassword($password))->where('DENUNCIANTEID', $user->DENUNCIANTEID)->update();


		$body = view('email_template/reset_password_template.php', ['password' => $password]);
		$mailersend = new MailerSend(['api_key' => EMAIL_TOKEN]);
		$recipients = [
			new Recipient($to, 'Your Client'),
		];

		$emailParams = (new EmailParams()) //check envio
			->setFrom('notificacionfgebc@fgebc.gob.mx')
			->setFromName('FGEBC')
			->setRecipients($recipients)
			->setSubject('Cambio de contraseña')
			->setHtml($body)
			->setText('Usted ha generado un nuevo registro en el Centro de Denuncia Tecnológica. Para acceder debes ingresar los siguientes datos. USUARIO: ' . $to . 'CONTRASEÑA' . $password)
			->setReplyTo('notificacionfgebc@fgebc.gob.mx')
			->setReplyToName('FGEBC');
		$sendSMS = $this->sendSMS("Cambio de contraseña", $user->TELEFONO, 'Notificaciones FGEBC/Estimado usuario, tu contraseña es: ' . $password);
		try {
			$result = $mailersend->email->send($emailParams);
		} catch (MailerSendValidationException $e) {
			$result = false;
		} catch (MailerSendRateLimitException $e) {
			$result = false;
		}

		if ($result) {
			return redirect()->to(base_url('/constancia_extravio'))->with('message_success', 'Verifica tu nueva contraseña en tus SMS.');
		} else {
			if ($sendSMS == "") {
				return redirect()->to(base_url('/constancia_extravio'))->with('message_success', 'Verifica tu nueva contraseña en tus SMS.');
			} else {
				return redirect()->to(base_url('/constancia_extravio'))->with('message_error', 'Error');
			}
		}
	}
	/**
	 * Función para verifica si el usuario ha iniciado sesión y es un usuario. 
	 *
	 */
	private function _isAuth()
	{
		if (session('logged_in') && session('type') == 'user') {
			return true;
		};
	}
	/**
	 * Función para cargar cualquier vista en cualquier función.
	 *
	 * @param  mixed $title
	 * @param  mixed $data
	 * @param  mixed $view
	 */
	private function _loadView($title, $data, $view)
	{
		$data = [
			'header_data' => (object)['title' => $title],
			'body_data' => $data
		];
		echo view("constancia_extravio/register/$view", $data);
	}

	/**
	 * Función para descargar el PDF de la constancia de extravio
	 * ! Deprecated method, do not use
	 *
	 */
	function descargar_pdf()
	{
		$data = (object)array();
		$options = new Options();
		$options->set('isRemoteEnabled', true);
		$dompdf = new Dompdf($options);
		$data = $this->db->table("PLANTILLAS")->get()->getResult();
		$numfolio = $_POST['input_folio_atencion_pdf'];
		$constancias = $this->_constanciaExtravioModelRead->asObject()->where('CONSTANCIAEXTRAVIOID', base64_decode($numfolio))->first();

		$agente = $this->_usuariosModelRead->asObject()->where('ID', $constancias->AGENTEID)->first();
		$denunciante = $this->_denunciantesModelRead->asObject()->where('DENUNCIANTEID', $constancias->DENUNCIANTEID)->first();
		$lugar = $this->_hechoLugarModelRead->asObject()->where('HECHOLUGARID', $constancias->HECHOLUGARID)->first();
		$municipio = $this->_municipiosModelRead->asObject()->where('MUNICIPIOID', $constancias->MUNICIPIOID)->where('ESTADOID', $constancias->ESTADOID)->first();
		$estado = $this->_estadosModelRead->asObject()->where('ESTADOID', $constancias->ESTADOID)->first();
		$timestamp = strtotime($constancias->HECHOFECHA);
		$dia = date('d', $timestamp);
		$meses = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
		$mes = $meses[date('n') - 1];
		// $dir = base_url() . '/uploads/FIEL/qrcode_' . $numfolio . '.jpg';
		// $dirFirma = base_url() . '/uploads/FIEL/qrcode_firma_' . $numfolio . '.jpg';
		$dir = base_url() . '/uploads/qr/' . base64_decode($numfolio) . '/qrcode_' . base64_decode($numfolio) . '.jpg';
		$dirFirma = base_url() . '/uploads/qr/' . base64_decode($numfolio) . '/qrcode_firma_' . base64_decode($numfolio) . '.jpg';

		$url = base_url('/validar_constancia?folio=' . $numfolio);
		//replace placeholder
		$data[5]->PLACEHOLDER = str_replace('https://cdtec.fgebc.gob.mx/', ' ', $data[5]->PLACEHOLDER);

		$data[5]->PLACEHOLDER = str_replace('[FOLIO_NUMERO]', $constancias->CONSTANCIAEXTRAVIOID, $data[5]->PLACEHOLDER);
		$data[5]->PLACEHOLDER = str_replace('[NOMBRE_AGENTE]', $agente->NOMBRE . " " . $agente->APELLIDO_PATERNO . " " . $agente->APELLIDO_MATERNO, $data[5]->PLACEHOLDER);
		$data[5]->PLACEHOLDER = str_replace('[NOMBRE_CERTIFICADO]', $constancias->EXTRAVIO, $data[5]->PLACEHOLDER);
		$data[5]->PLACEHOLDER = str_replace('[NOMBRE_PERSONA]', $denunciante->NOMBRE . " " . $denunciante->APELLIDO_PATERNO . " " . $denunciante->APELLIDO_MATERNO, $data[5]->PLACEHOLDER);
		$data[5]->PLACEHOLDER = str_replace('[LUGAR_EXTRAVIO]', $lugar->HECHODESCR, $data[5]->PLACEHOLDER);
		//$data[5]->PLACEHOLDER = str_replace('[DESCRIPCION_EXTRAVIO]', $constancias->DESCRIPCION_EXTRAVIO, $data[5]->PLACEHOLDER);
		$data[5]->PLACEHOLDER = str_replace('[NOMBRE_CIUDAD]', $municipio->MUNICIPIODESCR . ", " . $estado->ESTADODESCR, $data[5]->PLACEHOLDER);
		$data[5]->PLACEHOLDER = str_replace('[FECHA_EXTRAVIO]', $constancias->HECHOFECHA, $data[5]->PLACEHOLDER);

		$data[5]->PLACEHOLDER = str_replace('[DIA]', $dia, $data[5]->PLACEHOLDER);
		$data[5]->PLACEHOLDER = str_replace('[MES]', strtoupper($mes), $data[5]->PLACEHOLDER);
		$data[5]->PLACEHOLDER = str_replace('[ANIO]', $constancias->ANO, $data[5]->PLACEHOLDER);
		$data[5]->PLACEHOLDER = str_replace('[HORA]', $constancias->HECHOHORA, $data[5]->PLACEHOLDER);

		$data[5]->PLACEHOLDER = str_replace('[NUMEROIDENTIFICADOR]', $constancias->NUMEROIDENTIFICADOR, $data[5]->PLACEHOLDER);
		$data[5]->PLACEHOLDER = str_replace('[RFCFIRMA]', $constancias->RFCFIRMA, $data[5]->PLACEHOLDER);
		$data[5]->PLACEHOLDER = str_replace('[NCERTIFICADOFIRMA]', $constancias->NCERTIFICADOFIRMA, $data[5]->PLACEHOLDER);
		$data[5]->PLACEHOLDER = str_replace('[FECHAFIRMA]', $constancias->FECHAFIRMA, $data[5]->PLACEHOLDER);
		$data[5]->PLACEHOLDER = str_replace('[HORAFIRMA]', $constancias->HORAFIRMA, $data[5]->PLACEHOLDER);
		$data[5]->PLACEHOLDER = str_replace('[LUGARFIRMA]', $constancias->LUGARFIRMA, $data[5]->PLACEHOLDER);
		$data[5]->PLACEHOLDER = str_replace('[FIRMAELECTRONICA]', $constancias->FIRMAELECTRONICA, $data[5]->PLACEHOLDER);
		$data[5]->PLACEHOLDER = str_replace('[URL]', $url, $data[5]->PLACEHOLDER);

		$data[5]->PLACEHOLDER = str_replace('[CODIGO_QR]', '<img src="' . $dir . '" width="50px" height="50px">', $data[5]->PLACEHOLDER);
		$data[5]->PLACEHOLDER = str_replace('[CODIGO_QRS]', '<img src="' . $dirFirma . '" width="120px" height="120px">', $data[5]->PLACEHOLDER);


		if ($constancias->EXTRAVIO == 'BOLETOS DE SORTEO') {
			$data[5]->PLACEHOLDER = str_replace('[NO_DOCUMENTO]', $constancias->NBOLETO, $data[5]->PLACEHOLDER);
		}
		if ($constancias->EXTRAVIO == 'PLACAS') {
			$data[5]->PLACEHOLDER = str_replace('[NO_DOCUMENTO]', $constancias->NPLACA, $data[5]->PLACEHOLDER);
		}
		if ($constancias->EXTRAVIO == 'DOCUMENTOS') {
			$data[5]->PLACEHOLDER = str_replace('[NO_DOCUMENTO]', $constancias->NDOCUMENTO, $data[5]->PLACEHOLDER);
		} else {
			$data[5]->PLACEHOLDER = str_replace('[NO_DOCUMENTO]', '', $data[5]->PLACEHOLDER);
		}
		$dompdf->loadHtml(view('pdf/constanciaE', ["certificadoMedico" => $data]));
		// setting paper to portrait, also we have landscape
		$dompdf->setPaper('A4', 'portrait');
		$dompdf->render();

		// Download pdf
		$dompdf->stream();
	}
	/**
	 * Función para devolver la dirección IP del cliente que está haciendo la petición HTTP
	 *
	 */
	private function _get_client_ip()
	{
		$ipaddress = '';
		if (getenv('HTTP_CLIENT_IP'))
			$ipaddress = getenv('HTTP_CLIENT_IP');

		else if (getenv('HTTP_X_FORWARDED_FOR'))
			$ipaddress = getenv('HTTP_X_FORWARDED_FOR');

		else if (getenv('HTTP_X_FORWARDED'))
			$ipaddress = getenv('HTTP_X_FORWARDED');

		else if (getenv('HTTP_FORWARDED_FOR'))
			$ipaddress = getenv('HTTP_FORWARDED_FOR');

		else if (getenv('HTTP_FORWARDED'))
			$ipaddress = getenv('HTTP_FORWARDED');

		else if (getenv('REMOTE_ADDR'))
			$ipaddress = getenv('REMOTE_ADDR');
		else
			$ipaddress = 'UNKNOWN';
		if (strpos($ipaddress, ",") !== false) :
			$ipaddress = strtok($ipaddress, ",");
		endif;
		return $ipaddress;
	}
	/**
	 * Función para devolver la ip publica del cliente que está haciendo la petición HTTP
	 *
	 */
	private function _get_public_ip()
	{
		try {
			$externalContent = file_get_contents('http://checkip.dyndns.com/');
			preg_match('/Current IP Address: \[?([:.0-9a-fA-F]+)\]?/', $externalContent, $m);
			$externalIp = $m[1];
		} catch (\Exception $e) {
			$externalIp = '127.0.0.1';
		}
		return $externalIp;
	}
	/**
	 * Función para verificar si este el email para evitar duplicidad en registro
	 */
	public function existEmailSolicitantes()
	{
		$email = $this->request->getPost('email');

		$data = $this->_denunciantesModelRead->where('CORREO', $email)->first();
		if ($data == NULL) {
			return json_encode((object)['exist' => 0]);
		} else if (count($data) > 0) {
			return json_encode((object)['exist' => 1]);
		} else {
			return json_encode((object)['exist' => 0]);
		}
	}
	/**
	 * Función CURL POST al servicio de videollamada
	 *
	 * @param  mixed $endpoint
	 * @param  mixed $data
	 */
	private function _curlPost($endpoint, $data)
	{
		$ch = curl_init();

		curl_setopt($ch, CURLOPT_URL, $endpoint);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
		$headers = array(
			'Content-Type: application/json',
			'Access-Control-Allow-Origin: *',
			'Access-Control-Allow-Credentials: true',
			'Access-Control-Allow-Headers: Content-Type',
			'X-API-KEY: ' . X_API_KEY
		);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

		$result = curl_exec($ch);

		if ($result === false) {
			$result = "{
                'status' => 401,
                'error' => 'Curl failed: '" . curl_error($ch) . "
            }";
		}
		curl_close($ch);
		return json_decode($result);
	}
	/**
	 * Función para enviar mensajes SMS
	 *
	 * @param  mixed $tipo
	 * @param  mixed $celular
	 * @param  mixed $mensaje
	 */
	public function sendSMS($tipo, $celular, $mensaje)
	{

		$endpoint = "http://enviosms.ddns.net/API/";
		$data = array();
		$data['UsuarioID'] = 1;
		$data['Nombre'] = $tipo;
		$lstMensajes = array();
		$obj = array("Celular" =>  $celular, "Mensaje" => $mensaje);
		$lstMensajes[] = $obj;
		$data['lstMensajes'] = $lstMensajes;

		$httpClient = new Client([
			'base_uri' => $endpoint
		]);

		$response = $httpClient->post('campañas/enviarSMS', [
			'json' => $data
		]);

		$respuestaServ = $response->getBody()->getContents();

		return json_decode($respuestaServ);
	}
}
