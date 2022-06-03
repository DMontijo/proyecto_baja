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
		$this->_loadView('Login', [], 'index');
	}

	public function login_auth()
	{
		$session = session();
		$email = $this->request->getVar('correo');
		$password = $this->request->getVar('password');
		$data = $this->_denunciantesModel->where('CORREO', $email)->first();
		$data['logged_in'] = TRUE;

		if ($data && $password === $data['PASSWORD']) {
			$session = session();
			$session->set($data);
			return redirect()->to(base_url('/denuncia/dashboard'))->with('mensaje', '1');
		} else {
			$session->setFlashdata('message', 'Correo o contraseña incorrectos.');
			return redirect()->back();
		}
	}

	public function logout()
	{
		$session = session();
		$session->destroy();
		return redirect()->to('/index');
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

		$this->_denunciantesModel->set('PASSWORD', $password)->where('ID_DENUNCIANTE', $id)->update();

		return redirect()->to(base_url('/denuncia'))->with('created', 'Contraseña modificada con éxito.');
	}

	public function sendEmailChangePassword()
	{
		$to = $this->request->getPost('correo_reset_password');
		$user = $this->_denunciantesModel->asObject()->where('CORREO', $to)->first();
		$email = \Config\Services::email();
		$email->setTo($to);
		$email->setFrom('andrea.solorzano@yocontigo-it.com', 'FGEBC');
		$email->setSubject('Cambio de contraseña');
		$link = base_url('/denuncia/change_password?id=' . $user->ID_DENUNCIANTE);
		$body = view('email_template/reset_password_template.php', ['link' => $link]);
		$email->setMessage($body);

		if ($email->send()) {
			return redirect()->to(base_url('/denuncia'))->with('created', 'Verifica tu correo para recuperar tu contraseña.');
		}
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
