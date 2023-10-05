<?php

namespace App\Filters;

use App\Models\SesionesDenunciantesModel;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;
use DateTime;

class DenunciantesAuthFilter implements FilterInterface
{
	//Modelos de escritura
	private $_sesionesDenunciantesModel;
	//Modelos de lectura
	private $_sesionesDenunciantesModelRead;

	private $db_read;

	function __construct()
	{
		$this->db_read = ENVIRONMENT == 'production' ? db_connect('default_read') : db_connect('development_read');
		$this->_sesionesDenunciantesModel = new SesionesDenunciantesModel();
		$this->_sesionesDenunciantesModelRead = model('SesionesDenunciantesModel', true, $this->db_read);
	}
	public function before(RequestInterface $request, $arguments = null)
	{

		$sessionModel = new SesionesDenunciantesModel();
		$control_session = $sessionModel->asObject()->where('ID_DENUNCIANTE', session('DENUNCIANTEID'))->where('ACTIVO', 1)->first();
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
			// Actualizar la marca de tiempo de última actividad
			$session->set('last_activity', date("Y-m-d H:i:s"));
		}
		if ($control_session) {
			// Si el ID de sesión no coincide con el UUID de sesión, cerrar la sesión
			if ($control_session->ID != session('uuid')) {
				session()->destroy;
				session_unset();
				return redirect()->to(base_url('/denuncia'));
			}
		
		}
		else {
			// Si no hay una sesión de control activa, cerrar la sesión
			session()->destroy;
			session_unset();
			return redirect()->to(base_url('/denuncia'));
		}
		// Verificar si el usuario está autenticado
		if (!session('logged_in')) {
			return redirect()->to(base_url('/denuncia'));
		} else if (session('type') == 'admin') {
			session()->destroy;
			session_unset();
			return redirect()->to(base_url('/denuncia'));
		} else if (session('TIPO') == 2) {
			return redirect()->to(base_url('/denuncia/actualizar_info'));
		}
	}

	/**
	 * Función para cerrar sesión desde el dashboard de denuncia
	 *
	 */
	public function logout()
	{
		$session = session();
		$sesion_data = [
			'ACTIVO' => 0
		];
		$session_denunciante =  $this->_sesionesDenunciantesModelRead->where('ID_DENUNCIANTE', $session->get('DENUNCIANTEID'))->where('ID', session('uuid'))->where('ACTIVO', 1)->orderBy('FECHAINICIO', 'DESC')->first();
		if ($session_denunciante) {
			$update = $this->_sesionesDenunciantesModel->set($sesion_data)->where('ID', $session_denunciante['ID'])->update();
			if ($update) {
				// Destruye sesion
				session()->destroy;
				session_unset();
				return redirect()->to(base_url());
			}
		} else {
			// Destruye sesion
			session()->destroy;
			session_unset();
			return redirect()->to(base_url())->with('message_error', 'No hay sesiones activas');
		}
		// Destruye sesion
		session()->destroy;
		session_unset();
		return redirect()->to(base_url());
	}
	//--------------------------------------------------------------------

	public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
	{
		// Do something here
	}
}
