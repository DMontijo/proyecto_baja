<?php

namespace App\Controllers\client;

use App\Controllers\BaseController;


class AuthController extends BaseController
{
	public function index()
	{
		$this->_loadView('Login', [], 'index');
	}

	public function login_post()
	{
		$this->_loadView('Login', [], 'index');
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
		echo session('message');
		echo view("client/auth/$view", $data);
	}
}

/* End of file LoginController.php */
/* Location: ./app/Controllers/client/LoginController.php */
