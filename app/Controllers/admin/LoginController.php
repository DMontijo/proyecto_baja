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

	//Modelos de escritura
	private $_usuariosModel;
	private $_sesionesModel;
	private $_bitacoraActividadModel;
	private $_rolesPermisosModel;
	private $_rolesUsuariosModel;
	//Modelos de lectura
	private $_sesionesModelRead;
	private $_rolesPermisosModelReader;
	private $_rolesUsuariosModelRead;
	private $_usuariosModelRead;


	private $db_read;

	function __construct()
	{

		$this->db_read = ENVIRONMENT == 'production' ? db_connect('default_read') : db_connect('development_read');

		$this->_usuariosModel = new UsuariosModel();
		$this->_sesionesModel = new SesionesModel();
		$this->_bitacoraActividadModel = new BitacoraActividadModel();
		$this->_rolesPermisosModel = new RolesPermisosModel();
		$this->_rolesUsuariosModel = new RolesUsuariosModel();

		$this->_sesionesModelRead = model('SesionesModel', true, $this->db_read);
		$this->_rolesPermisosModelReader = model('RolesPermisosModel', true, $this->db_read);
		$this->_rolesUsuariosModelRead = model('RolesUsuariosModel', true, $this->db_read);
		$this->_usuariosModelRead = model('UsuariosModel', true, $this->db_read);

	}

	/**
	 * Vista de Login-Admin
	 * Autentica que no tenga sesion iniciada, y si tiene sesion lo redirige al dashboard
	 */
	public function index()
	{
		if ($this->_isAuth()) {
			return redirect()->to(base_url('/admin/dashboard'));
		} else {
			session()->destroy;
			$this->_loadView('Login', [], 'index');
		}
	}

	/**
	 * Función para autenticar el ingreso a la plataforma desde el admin
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
		$data = $this->_usuariosModelRead->where('CORREO', $email)->first();

		if ($data) {
			// Verifica que no tenga sesiones activas
			$control_session = $this->_sesionesModelRead->asObject()->where('ID_USUARIO', $data['ID'])->where('ACTIVO', 1)->first();
			if ($control_session) {
				return redirect()->to(base_url('/admin'))->with('message_session', 'Ya tienes sesiones activas, cierralas para continuar.')->with('id',  $data['ID']);
			}
			// Valida la contraseña ingresada con la de su usuario
			if (validatePassword($password, $data['PASSWORD'])) {
				$data['permisos'] = $this->_rolesPermisosModelReader->select('PERMISOS.PERMISODESCR AS NOMBRE')->where('ROLID', $data['ROLID'])->join('PERMISOS', 'PERMISOS.PERMISOID = ROLESPERMISOS.PERMISOID', 'left')->findAll();
				$data['permisos'] = array_column($data['permisos'], ('NOMBRE'));
				$data['rol'] = $this->_rolesUsuariosModelRead->asObject()->where('ID', $data['ROLID'])->first();
				$data['logged_in'] = TRUE;
				$data['type'] = 'admin';
				$data['uuid'] = uniqid();
				//Ingresa en variable session los datos del usuario
				$session->set($data);
				$agent = $this->request->getUserAgent();
				//Datos para guardar en la tabla de sesiones
				$sesion_data = [
					'ID' => $data['uuid'],
					'ID_USUARIO' => $data['ID'],
					'IP_USUARIO' => $this->_get_client_ip(),
					'IP_PUBLICA' => $this->_get_public_ip(),
					'AGENTE_HTTP' => $agent->getBrowser(),
					'AGENTE_SO' => $agent->getPlatform(),
					'AGENTE_MOBILE' => $agent->isMobile() ? 1 : 0,
					'ACTIVO' => 1,
				];

				$this->_sesionesModel->insert($sesion_data);
				$datosBitacora = [
					'ACCION' => 'Ha iniciado sesión',
				];
				$this->_bitacoraActividad($datosBitacora);
				return redirect()->to(base_url('/admin/dashboard'));
			} else {
				$session->setFlashdata('message', 'La contraseña es incorrecta, verifica con informática.');
				return redirect()->back();
			}
		} else {
			$session->setFlashdata('message', 'El correo no esta registrado, verifica con informática.');
			return redirect()->back();
		}
	}

	/**
	 * Función para cerrar sesión desde el admin
	 *
	 */
	public function logout()
	{
		$session = session();
		$sesion_data = [
			'ACTIVO' => 0,
			'ID_USUARIO' => $session->get('ID'),
		];

		// Verifica que tenga sesiones activas
		$session_user =  $this->_sesionesModelRead->where('ID_USUARIO', $session->get('ID'))->where('ID', session('uuid'))->where('ACTIVO', 1)->orderBy('FECHAINICIO', 'DESC')->first();

		if ($session_user) {
			// Las cierra
			$update = $this->_sesionesModel->set($sesion_data)->where('ID', $session_user['ID'])->update();
			if ($update) {
				$datosBitacora = [
					'ACCION' => 'Ha cerrado sesión',
				];
				$this->_bitacoraActividad($datosBitacora);
				// Destruye sesion
				$session->destroy();
				return redirect()->to(base_url('admin'));
			}
		} else {
			$datosBitacora = [
				'ACCION' => 'Ha cerrado sesión',
			];
			$this->_bitacoraActividad($datosBitacora);
			$session->destroy();
			return redirect()->to(base_url('/admin'))->with('message_error', 'No hay sesiones activas');
		}
	}


	/**
	 * Función para cerrar todas las sesiones activas del usuario al momento de querer ingresar a la plataforma
	 * Recibe por metodo POST el id del usuario
	 *
	 */
	public function cerrar_sesiones()
	{
		$session = session();
		$id_usuario = $this->request->getPost('id');
		$sesion_data = [
			'ACTIVO' => 0,
		];
		$update = $this->_sesionesModel->set($sesion_data)->where('ID_USUARIO', $id_usuario)->update();
		if ($update) {
			//Destruye seion
			$session->destroy();
			return json_encode(['status' => 1]);
		}
	}

	/**
	 * Función para verifica si el usuario ha iniciado sesión y es un administrador. 
	 *
	 */
	private function _isAuth()
	{
		if (session('logged_in') && session('type') == 'admin') {
			return true;
		};
	}

	/**
	 * Función para cargar cualquier vista en cualquier función.
	 *
	 * @param  mixed $title
	 * @param  mixed $data
	 * @param  mixed $view
	 * @return void
	 */
	private function _loadView($title, $data, $view)
	{
		$data = [
			'header_data' => (object)['title' => $title],
			'body_data' => $data
		];

		echo view("admin/login/$view", $data);
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
	 * Función para agregar información a la bitacora diaria.
	 *
	 * @param  mixed $data
	 */
	private function _bitacoraActividad($data)
	{
		$data = $data;
		$data['ID'] = uniqid();
		$data['USUARIOID'] = session('ID');


		if ($data['USUARIOID']) {
			$this->_bitacoraActividadModel->insert($data);
		}
	}
}
/* End of file LoginController.php */
/* Location: ./app/Controllers/admin/LoginController.php */
