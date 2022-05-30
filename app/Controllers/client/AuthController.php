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
		$this->_loadView('Login', [], 'index');
	}

	public function change_password()
	{
		$this->_loadView('Recuperar', [], 'change_password');
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
