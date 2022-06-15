<?php

namespace App\Controllers\admin;

use App\Controllers\BaseController;

use App\Models\UsuariosModel;

class LoginController extends BaseController
{
	function __construct()
	{
		$this->_usuariosModel = new UsuariosModel();
	}

	public function index()
	{
		if ($this->_isAuth()) {
			return redirect()->to(base_url('/admin/dashboard'));
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
		$data = $this->_usuariosModel->where('CORREO', $email)->first();
		if ($data && validatePassword($password, $data['PASSWORD'])) {
			$data['logged_in'] = TRUE;
			$data['type'] = 'admin';
			$session->set($data);
			return redirect()->to(base_url('/admin/dashboard'));
		} else {
			$session->setFlashdata('message', 'Correo o contraseña incorrectos.');
			return redirect()->back();
		}
	}

	public function logout()
	{
		$session = session();
		$session->destroy();
		return redirect()->to(base_url('admin'));
	}

	private function _isAuth()
	{
		if (session('logged_in') && session('type') == 'admin') {
			return true;
		};
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
