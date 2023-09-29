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

	/**Funcion que se ejecuta antes de que se maneje una solicitud */
	public function before(RequestInterface $request, $arguments = null)
	{
		$sessionModel = new SesionesModel();
		$control_session = $sessionModel->asObject()->where('ID_USUARIO', session('ID'))->where('ACTIVO', 1)->first();
		$session = session();
		// Verificar si existe una marca de tiempo de "last_activity" en la sesión
		if(session("last_activity")){
			// Calcular la diferencia de tiempo desde la última actividad
			$date1 = new DateTime(session("last_activity"));
			$date2 = new DateTime(date("Y-m-d H:i:s"));	
			$diff = $date1->diff($date2);
			// Si han pasado al menos 2 horas o 1 día, cerrar la sesión por inactividad
			if(intval($diff->format('%H')) >= 2 || intval($diff->format('%d')) >= 1){
				$this->logout();
			}else{
				// Actualizar la marca de tiempo de última actividad
				$session->set('last_activity', date("Y-m-d H:i:s"));
			}
		}else{
			// Si no existe la marca de tiempo, crearla
			$session->set('last_activity', date("Y-m-d H:i:s"));
		}
		if ($control_session) {
			// Si el ID de sesión no coincide con el UUID de sesión, cerrar la sesión
			if ($control_session->ID != session('uuid')) {
				session()->destroy;
				session_unset();
				return redirect()->to(base_url('/admin'));
			}
		} else {
			 // Si no hay una sesión de control activa, cerrar la sesión
			session()->destroy;
			session_unset();
			return redirect()->to(base_url('/admin'));
		}
    	// Verificar si el usuario está autenticado
		if (!session('logged_in')) {
			return redirect()->to(base_url('/admin'));
		} else if (session('type') == 'user' || session('type') == 'user_constancias') {
			// Si el usuario tiene es user o user_constancias, cerrar la sesión
			session()->destroy;
			session_unset();
			return redirect()->to(base_url('/admin'));
		}
	}


	/**Funcion para cerrar la sesion activa */
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

	/**Funcion para registar en la bitacora */
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
