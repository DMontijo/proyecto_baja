<?php

namespace App\Controllers\client;

use App\Controllers\BaseController;

use App\Models\DenunciantesModel;
use App\Models\SesionesDenunciantesModel;
use GuzzleHttp\Client;

class AuthController extends BaseController
{

	private $_denunciantesModel;
	private $_sesionesDenunciantesModel;

	function __construct()
	{
		$this->_denunciantesModel = new DenunciantesModel();
		$this->_sesionesDenunciantesModel = new SesionesDenunciantesModel();
	}

	public function index()
	{
		if ($this->_isAuth()) {
			return redirect()->to(base_url('/denuncia/dashboard'));
		} else {
			session()->destroy;
			$this->_loadView('Login', [], 'index');
		}
	}

	public function login_auth()
	{
		$session = session();
		$email = $this->request->getPost('correo');
		$password = $this->request->getPost('password');
		$email = trim($email);
		$password = trim($password);
		$data = $this->_denunciantesModel->where('CORREO', $email)->first();
		if ($data) {
			$control_session = $this->_sesionesDenunciantesModel->asObject()->where('ID_DENUNCIANTE', $data['DENUNCIANTEID'])->where('ACTIVO', 1)->first();
			if ($control_session) {
				return redirect()->to(base_url('/denuncia'))->with('message_session', 'Ya tienes sesiones activas, cierralas para continuar.')->with('id',  $data['DENUNCIANTEID']);
			}
			if (validatePassword($password, $data['PASSWORD'])) {
				$data['logged_in'] = TRUE;
				$data['type'] = 'user';
				$data['uuid'] = uniqid();
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

	public function logout()
	{
		$session = session();
		$sesion_data = [
			'ACTIVO' => 0,
			'ID_DENUNCIANTE' => $session->get('ID'),
		];
		$session_denunciante =  $this->_sesionesDenunciantesModel->where('ID_DENUNCIANTE', $session->get('DENUNCIANTEID'))->where('ID', session('uuid'))->where('ACTIVO', 1)->orderBy('FECHAINICIO', 'DESC')->first();
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

	public function change_password()
	{
		$id = $this->request->getGet('id');
		$token = $this->request->getGet('token');
		$email = $this->request->getGet('email');

		$data = (object)array();

		if ($id || $token || $email) {
			$data = $this->_denunciantesModel->asObject()->where('DENUNCIANTEID', $id)->orWhere('CORREO', $email)->first();
			$this->_loadView('Cambiar contraseña', $data, 'change_password');
		}
	}

	public function change_password_post()
	{
		$id = $this->request->getPost('id');
		$password = $this->request->getPost('password');
		$this->_denunciantesModel->set('PASSWORD', hashPassword($password))->where('DENUNCIANTEID', $id)->update();
		return redirect()->to(base_url('/denuncia'))->with('message_success', 'Contraseña modificada con éxito.');
	}

	public function sendEmailChangePassword()
	{
		$password = $this->_generatePassword(6);
		$to = $this->request->getPost('correo_reset_password');
		$user = $this->_denunciantesModel->asObject()->where('CORREO', $to)->first();
		$this->_denunciantesModel->set('PASSWORD', hashPassword($password))->where('DENUNCIANTEID', $user->DENUNCIANTEID)->update();

		$email = \Config\Services::email();
		$email->setTo($to);
		$email->setSubject('Cambio de contraseña.');
		$body = view('email_template/reset_password_template.php', ['password' => $password]);
		$email->setMessage($body);
		$email->setAltMessage('Usted ha solicitado un cambio de contraseña. Su nueva contraseña es: ' .$password);
		$sendSMS = $this->sendSMS("Cambio de contraseña", $user->TELEFONO, 'Notificaciones FGE/Estimado usuario, tu contraseña es: ' .$password);
		if ($email->send() && $sendSMS == "") {
			return redirect()->to(base_url('/denuncia'))->with('message_success', 'Verifica tu nueva contraseña en tu correo o en tus SMS.');
		}
	}

	private function _isAuth()
	{
		if (session('logged_in') && session('type') == 'user') {
			return true;
		};
	}

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
	private function _loadView($title, $data, $view)
	{
		$data = [
			'header_data' => (object)['title' => $title],
			'body_data' => $data
		];
		echo view("client/auth/$view", $data);
	}
	public function sendSMS($tipo, $celular, $mensaje)
	{

		$endpoint = "http://enviosms.ddns.net/API/";
		$data = array();
		$data['UsuarioID'] = 1;
		$data['Nombre'] = $tipo;
		$lstMensajes = array();
		$obj = array("Celular" => $celular , "Mensaje" => $mensaje);
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
