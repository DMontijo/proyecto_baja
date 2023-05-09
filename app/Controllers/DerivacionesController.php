<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class DerivacionesController extends Controller
{

	private $_derivacionesModelRead;
	private $_canalizacionesModelRead;
	private $db_read;

	function __construct()
	{
		$this->db_read = ENVIRONMENT == 'production' ? db_connect('default_read') : db_connect('development_read');

		$this->_derivacionesModelRead = model('DerivacionesModel', true, $this->db_read);
		$this->_canalizacionesModelRead = model('CanalizacionesModel', true, $this->db_read);
	}

	/**
	 * Vista para ver el directorio de derivaciones
	 *  Obtiene todas las oficinas de las derivaciones
	 *
	 */
	public function index()
	{
		$data = (object) array();
		$data->derivacionesEnsenada = $this->_derivacionesModelRead->asObject()->getByMunicipioId(1);
		$data->derivacionesMexicali = $this->_derivacionesModelRead->asObject()->getByMunicipioId(2);
		$data->derivacionesTecate = $this->_derivacionesModelRead->asObject()->getByMunicipioId(3);
		$data->derivacionesTijuana = $this->_derivacionesModelRead->asObject()->getByMunicipioId(4);
		$data->derivacionesRosarito = $this->_derivacionesModelRead->asObject()->getByMunicipioId(5);
		$this->_loadView('Directorio de derivaciones', $data, 'derivaciones');
	}

	/**
	 * Vista para ver el directorio de canalizaciones
	 *  Obtiene todas las oficinas de las canalizaciones
	 *
	 */
	public function canalizaciones()
	{
		$data = (object) array();
		$data->canalizacionesEnsenada = $this->_canalizacionesModelRead->asObject()->getByMunicipioId(1);
		$data->canalizacionesMexicali = $this->_canalizacionesModelRead->asObject()->getByMunicipioId(2);
		$data->canalizacionesTecate = $this->_canalizacionesModelRead->asObject()->getByMunicipioId(3);
		$data->canalizacionesTijuana = $this->_canalizacionesModelRead->asObject()->getByMunicipioId(4);
		$data->canalizacionesRosarito = $this->_canalizacionesModelRead->asObject()->getByMunicipioId(5);
		$this->_loadView('Directorio de canalizaciones', $data, 'canalizaciones');
	}
	/**
	 * Vista para ver el directorio de salas virtuales
	 *  Obtiene todas las oficinas de las salas virtuales
	 *
	 */
	public function salas_virtuales()
	{
		$data = (object) array();
		$this->_loadView('Directorio de salas virtuales', $data, 'salas_virtuales');
	}

	/**
	 * Función para cargar cualquier vista en cualquier función.
	 *
	 * @param  mixed $title
	 * @param  mixed $data
	 * @param  mixed $view
	 */
	private function _loadView($title, $data, $view)
	{
		$data = [
			'header_data' => (object)['title' => $title],
			'body_data' => $data
		];

		echo view("$view", $data);
	}
}
