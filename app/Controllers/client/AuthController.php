<?php

namespace App\Controllers\client;

use App\Controllers\BaseController;

use App\Models\DenunciantesModel;

class AuthController extends BaseController
{

	private $_denunciantesModel;

	function __construct()
	{
		$this->_denunciantesModel = new DenunciantesModel();
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
		$data = $this->_denunciantesModel->where('CORREO', $email)->first();
		if ($data) {
			if (validatePassword($password, $data['PASSWORD'])) {
				$data['logged_in'] = TRUE;
				$data['type'] = 'user';
				$session->set($data);
				return redirect()->to(base_url('/denuncia/dashboard'));
			} else {
				$session->setFlashdata('message', 'La contraseña es incorrecta.');
				return redirect()->back();
			}
		} else {
			$session->setFlashdata('message', 'El correo no está registrado.');
			return redirect()->back();
		}
	}

	public function logout()
	{
		$session = session();
		$session->destroy();
		return redirect()->to(base_url('denuncia'));
	}

	public function change_password()
	{
		$id = $this->request->getGet('id');
		$token = $this->request->getGet('token');
		$email = $this->request->getGet('email');

		$data = (object)array();

		if ($id || $token || $email) {
			$data = $this->_denunciantesModel->asObject()->where('ID_DENUNCIANTE', $id)->orWhere('CORREO', $email)->first();
			$this->_loadView('Cambiar contraseña', $data, 'change_password');
		}
	}

	public function change_password_post()
	{
		$id = $this->request->getPost('id');
		$password = $this->request->getPost('password');
		$this->_denunciantesModel->set('PASSWORD', hashPassword($password))->where('ID_DENUNCIANTE', $id)->update();
		return redirect()->to(base_url('/denuncia'))->with('created', 'Contraseña modificada con éxito.');
	}

	public function sendEmailChangePassword()
	{
		$password = $this->_generatePassword(6);
		$to = $this->request->getPost('correo_reset_password');
		$user = $this->_denunciantesModel->asObject()->where('CORREO', $to)->first();
		$this->_denunciantesModel->set('PASSWORD', hashPassword($password))->where('ID_DENUNCIANTE', $user->ID_DENUNCIANTE)->update();

		$email = \Config\Services::email();
		$email->setTo($to);
		$email->setFrom('andrea.solorzano@yocontigo-it.com', 'FGEBC');
		$email->setSubject('Cambio de contraseña');
		// $link = base_url('/denuncia/change_password?id=' . $user->ID_DENUNCIANTE);
		$body = view('email_template/reset_password_template.php', ['password' => $password]);
		$email->setMessage($body);

		if ($email->send()) {
			return redirect()->to(base_url('/denuncia'))->with('created', 'Verifica tu nueva contraseña en tu correo.');
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

	private function _loadView($title, $data, $view)
	{
		$data = [
			'header_data' => (object)['title' => $title],
			'body_data' => $data
		];
		echo view("client/auth/$view", $data);
	}
}

/* End of file LoginController.php */
/* Location: ./app/Controllers/client/LoginController.php */
