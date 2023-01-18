<?php

namespace App\Controllers\admin;

use App\Controllers\BaseController;

use App\Models\UsuariosModel;
use App\Models\SesionesModel;
use App\Models\BitacoraActividadModel;
use App\Models\RolesPermisosModel;
use App\Models\RolesUsuariosModel;

class LoginController extends BaseController
{

	private $_usuariosModel;
	private $_sesionesModel;
	private $_bitacoraActividadModel;
	private $_rolesPermisosModel;
	private $_rolesUsuariosModel;
	
	function __construct()
	{
		$this->_usuariosModel = new UsuariosModel();
		$this->_sesionesModel = new SesionesModel();
		$this->_bitacoraActividadModel = new BitacoraActividadModel();
		$this->_rolesPermisosModel = new rolesPermisosModel();
		$this->_rolesUsuariosModel = new RolesUsuariosModel();
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
		$email = trim($email);
		$password = trim($password);
		$data = $this->_usuariosModel->where('CORREO', $email)->first();
		if ($data && validatePassword($password, $data['PASSWORD'])) {
			$data['permisos'] = $this->_rolesPermisosModel->select('PERMISOS.PERMISODESCR AS NOMBRE')->where('ROLID', $data['ROLID'])->join('PERMISOS', 'PERMISOS.PERMISOID = ROLESPERMISOS.PERMISOID', 'left')->findAll();
			$data['permisos'] = array_column($data['permisos'], ('NOMBRE'));
			$data['rol'] = $this->_rolesUsuariosModel->asObject()->where('ID',$data['ROLID'])->first();
			$data['logged_in'] = TRUE;
			$data['type'] = 'admin';
			$session->set($data);
			$sesion_data = [
				'ID' => session_id(),
				'ID_USUARIO' => $data['ID'],
				'IP_USUARIO' => $this->_get_client_ip(),
				'IP_PUBLICA' => $this->_get_public_ip(),
				'AGENTE_HTTP' => $_SERVER['HTTP_USER_AGENT'],
			];
			$this->_sesionesModel->insert($sesion_data);
			$datosBitacora = [
				'ACCION' => 'Ha iniciado sesión',
			];
			$this->_bitacoraActividad($datosBitacora);
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
		$datosBitacora = [
			'ACCION' => 'Ha cerrado sesión',
		];
		$this->_bitacoraActividad($datosBitacora);
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
	private function _bitacoraActividad($data)
	{
		$data = $data;
		$data['ID'] = uniqid();
		$data['USUARIOID'] = session('ID');


		$this->_bitacoraActividadModel->insert($data);
	}
}
/* End of file LoginController.php */
/* Location: ./app/Controllers/admin/LoginController.php */