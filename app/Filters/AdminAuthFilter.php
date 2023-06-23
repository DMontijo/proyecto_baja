<?php

namespace App\Filters;

use App\Models\SesionesModel;
use App\Models\BitacoraActividadModel;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

use DateTime;


class AdminAuthFilter implements FilterInterface
{
	//Modelos de escritura
	private $_sesionesModel;
	private $_bitacoraActividadModel;
	//Modelos de lectura
	private $_sesionesModelRead;
	


	private $db_read;

	function __construct()
	{

		$this->db_read = ENVIRONMENT == 'production' ? db_connect('default_read') : db_connect('development_read');

		
		$this->_sesionesModel = new SesionesModel();
		$this->_bitacoraActividadModel = new BitacoraActividadModel();
		
		$this->_sesionesModelRead = model('SesionesModel', true, $this->db_read);
	}

	public function before(RequestInterface $request, $arguments = null)
	{
		$sessionModel = new SesionesModel();
		$control_session = $sessionModel->asObject()->where('ID_USUARIO', session('ID'))->where('ACTIVO', 1)->first();
		$session = session();
		if(session("last_activity")){
			$date1 = new DateTime(session("last_activity"));
			$date2 = new DateTime(date("Y-m-d H:i:s"));	
			$diff = $date1->diff($date2);
			if(intval($diff->format('%i')) >= 120){
				session()->destroy;
				session_unset();
				return redirect()->to(base_url('/admin'));
			}
		}else{
			$session->set('last_activity', date("Y-m-d H:i:s"));
		}
		if ($control_session) {
			if ($control_session->ID != session('uuid')) {
				session()->destroy;
				session_unset();
				return redirect()->to(base_url('/admin'));
			}
		} else {
			session()->destroy;
			session_unset();
			return redirect()->to(base_url('/admin'));
		}

		if (!session('logged_in')) {
			return redirect()->to(base_url('/admin'));
		} else if (session('type') == 'user' || session('type') == 'user_constancias') {
			session()->destroy;
			session_unset();
			return redirect()->to(base_url('/admin'));
		}
	}

	public function logout()
	{
		$session = session();
		$sesion_data = [
			'ACTIVO' => 0,
			'ID_USUARIO' => $session->get('ID'),
		];
		var_dump('logout');

		// Verifica que tenga sesiones activas
		$session_user =  $this->_sesionesModelRead->where('ID_USUARIO', $session->get('ID'))->where('ID', session('uuid'))->where('ACTIVO', 1)->orderBy('FECHAINICIO', 'DESC')->first();

		if ($session_user) {
			var_dump('actualizacion');
			// Las cierra
			$update = $this->_sesionesModel->set($sesion_data)->where('ID', $session_user['ID'])->update();
			if ($update) {
				$datosBitacora = [
					'ACCION' => 'Ha cerrado sesión',
				];
				$this->_bitacoraActividad($datosBitacora);
				// Destruye sesion
				session()->destroy;
				session_unset();
				return redirect()->to(base_url('/admin'));
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

	private function _bitacoraActividad($data)
	{
		$data = $data;
		$data['ID'] = uniqid();
		$data['USUARIOID'] = session('ID');


		if ($data['USUARIOID']) {
			$this->_bitacoraActividadModel->insert($data);
		}
	}

	//--------------------------------------------------------------------

	public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
	{
	}
}
