<?php

namespace App\Controllers\client;

use App\Controllers\BaseController;


class UserController extends BaseController
{
	public function index()
	{
		$this->_loadView('Login', [], 'index');
	}

	public function login_post()
	{

	}

	public function logout()
	{
		
	}

	public function change_password()
	{
		$data = array();
		$this->_loadView('Recuperar', $data, 'change_password');
	}

	private function _loadView($title, $data, $view)
	{
		$data = [
			'header_data' => (object)['title' => $title],
			'body_data' => $data
		];

		echo view("client/login/$view", $data);
	}
}

/* End of file LoginController.php */
/* Location: ./app/Controllers/client/LoginController.php */
