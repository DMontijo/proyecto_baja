<?php

namespace App\Controllers\admin;

use App\Controllers\BaseController;

use App\Models\UsuariosModel;

class LoginController extends BaseController
{

	private $_usuariosModel;

	function __construct()
	{
		$this->_usuariosModel = new UsuariosModel();
	}
	
	public function index()
	{
		$data = array();
		$this->_loadView('Login', $data, 'index');
	}

	public function login_auth()
	{
		$session = session();
		$email = $this->request->getVar('correo');
		$password = $this->request->getVar('password');

		$data = $this->_usuariosModel->where('CORREO', $email)->first();

		if (count($data) > 0 && $password == $data['PASSWORD']) {
			$session = session();
			$session->set($data);
			return redirect()->to(base_url('/admin/dashboard'))->with('mensaje', '1');
		} else {
			$session->setFlashdata('message', 'Correo o contraseña incorrectos.');
			return redirect()->back()->withInput(); 
		}
	}

	private function _loadView($title, $data, $view)
	{
		$data = [
			'header_data' => (object)['title' => $title],
			'body_data' => $data
		];

		echo view("admin/login/$view", $data);
	}
}
/* End of file LoginController.php */
/* Location: ./app/Controllers/admin/LoginController.php */
