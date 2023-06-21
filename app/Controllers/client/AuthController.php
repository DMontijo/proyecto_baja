<?php

namespace App\Controllers\client;

use App\Controllers\BaseController;

use App\Models\DenunciantesModel;
use App\Models\SesionesDenunciantesModel;
use GuzzleHttp\Client;
use MailerSend\MailerSend;
use MailerSend\Helpers\Builder\Recipient;
use MailerSend\Helpers\Builder\EmailParams;
use MailerSend\Exceptions\MailerSendValidationException;
use MailerSend\Exceptions\MailerSendRateLimitException;
use DateTime;

class AuthController extends BaseController
{
	private $db_read;

	private $_denunciantesModel;
	private $_sesionesDenunciantesModel;
	private $_denunciantesModelRead;
	private $_sesionesDenunciantesModelRead;

	function __construct()
	{
		$this->db_read = ENVIRONMENT == 'production' ? db_connect('default_read') : db_connect('development_read');

		$this->_denunciantesModel = new DenunciantesModel();
		$this->_sesionesDenunciantesModel = new SesionesDenunciantesModel();

		$this->_denunciantesModelRead = model('DenunciantesModel', true, $this->db_read);
		$this->_sesionesDenunciantesModelRead = model('SesionesDenunciantesModel', true, $this->db_read);
	}
	/**
	 * Vista de Login-Denuncia
	 * Autentica que no tenga sesion iniciada, y si tiene sesion lo redirige al dashboard
	 */
	public function index()
	{
		if ($this->_isAuth()) {
			return redirect()->to(base_url('/denuncia/dashboard'));
		} else {
			session()->destroy;
			$this->_loadView('Login', [], 'index');
		}
	}
	/**
	 * Función para autenticar el ingreso a la plataforma desde el denunciante
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
		// Encuentra un usuario con ese correo

		$data = $this->_denunciantesModelRead->where('CORREO', $email)->first();
		if ($data) {
			// Valida la contraseña ingresada con la de su usuario
			if (validatePassword($password, $data['PASSWORD'])) {
				// Verifica que no tenga sesiones activas
				$control_session = $this->_sesionesDenunciantesModelRead->asObject()->where('ID_DENUNCIANTE', $data['DENUNCIANTEID'])->where('ACTIVO', 1)->first();
				if ($control_session) {
					return redirect()->to(base_url('/denuncia'))->with('message_session', 'Ya tienes sesiones activas, cierralas para continuar.')->with('id',  $data['DENUNCIANTEID']);
				}
				$data['logged_in'] = TRUE;
				$data['type'] = 'user';
				$data['uuid'] = uniqid();
				//Ingresa en variable session los datos del usuario

				$session->set($data);
				$agent = $this->request->getUserAgent();
				//Datos para guardar en la tabla de sesiones

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
				return redirect()->to(base_url('/denuncia/dashboard'));
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
	 * Función para cerrar sesión desde el dashboard de denuncia
	 *
	 */
	public function logout()
	{
		$session = session();
		$sesion_data = [
			'ACTIVO' => 0
		];
		$session_denunciante =  $this->_sesionesDenunciantesModelRead->where('ID_DENUNCIANTE', $session->get('DENUNCIANTEID'))->where('ID', session('uuid'))->where('ACTIVO', 1)->orderBy('FECHAINICIO', 'DESC')->first();
		if ($session_denunciante) {
			$update = $this->_sesionesDenunciantesModel->set($sesion_data)->where('ID', $session_denunciante['ID'])->update();
			if ($update) {
				$session->destroy();
				return redirect()->to(base_url());
			}
		} else {
			$session->destroy();
			return redirect()->to(base_url())->with('message_error', 'No hay sesiones activas');
		}
		$session->destroy();
		return redirect()->to(base_url());
	}
	/**
	 * Función para cerrar todas las sesiones activas del denunciante al momento de querer ingresar a la plataforma
	 * Recibe por metodo POST el id del denunciante
	 *
	 */
	public function cerrar_sesiones()
	{
		$session = session();
		$id_denunciante = $this->request->getPost('id');
		$sesion_data = [
			'ACTIVO' => 0,
		];
		$update = $this->_sesionesDenunciantesModel->set($sesion_data)->where('ID_DENUNCIANTE', $id_denunciante)->update();
		if ($update) {

			$session->destroy();
			return json_encode(['status' => 1]);
		}
	}

	/**
	 * Revisa la variable de session 'last_activity'
	 *
	 * @param  mixed $placeholder
	 */
	public function checkLastActivity(){
		$session = session();
		if(session("last_activity")){
			$date1 = new DateTime(session("last_activity"));
			$date2 = new DateTime(date("Y-m-d H:i:s"));	
			$diff = $date1->diff($date2);
			
			if(intval($diff->format('%i')) < 120){
				$session->set('last_activity', date("Y-m-d H:i:s"));
				return json_encode(['result' => $diff->format('%H %i'), 'last_activity' => $date1, 'actual' => $date2, 'new' => session("last_activity") ]);

			}else{
				return json_encode(['result' => false]);
			}

		}else{
			$session->set('last_activity', date("Y-m-d H:i:s"));
		}
	}

	/**
	 * Vista para cambiar la contraseña dentro de la plataforma
	 * Manda por metodo GET los datos del denunciante
	 *
	 */
	public function change_password()
	{
		$id = $this->request->getGet('id');
		$token = $this->request->getGet('token');
		$email = $this->request->getGet('email');

		$data = (object)array();

		if ($id || $token || $email) {
			$data = $this->_denunciantesModelRead->asObject()->where('DENUNCIANTEID', $id)->orWhere('CORREO', $email)->first();
			$this->_loadView('Cambiar contraseña', $data, 'change_password');
		}
	}
	/**
	 * Función para cambiar la contraseña dentro de la plataforma
	 * Manda por metodo POST el id del denunciante y la nueva contraseña
	 *
	 */
	public function change_password_post()
	{
		$id = $this->request->getPost('id');
		$password = $this->request->getPost('password');
		$this->_denunciantesModel->set('PASSWORD', hashPassword($password))->where('DENUNCIANTEID', $id)->update();
		return redirect()->to(base_url('/denuncia'))->with('message_success', 'Contraseña modificada con éxito.');
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
		$emailParams = (new EmailParams())
			->setFrom('notificacionfgebc@fgebc.gob.mx')
			->setFromName('FGEBC')
			->setRecipients($recipients)
			->setSubject('Cambio de contraseña.')
			->setHtml($body)
			->setText('Usted ha solicitado un cambio de contraseña. Su nueva contraseña es: ' . $password)
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
			return redirect()->to(base_url('/denuncia'))->with('message_success', 'Verifica tu nueva contraseña en tus SMS.');
		} else {
			if ($sendSMS == "") {
				return redirect()->to(base_url('/denuncia'))->with('message_success', 'Verifica tu nueva contraseña en tus SMS.');
			} else {
				return redirect()->to(base_url('/denuncia'))->with('message_error', $sendSMS);
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
			//Concatena los pattern de modo aleatorio
			$password .= substr($pattern, mt_rand(0, $max), 1);
		}
		return $password;
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
		echo view("client/auth/$view", $data);
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
		$obj = array("Celular" => $celular, "Mensaje" => $mensaje);
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

/* End of file LoginController.php */
/* Location: ./app/Controllers/client/LoginController.php */
