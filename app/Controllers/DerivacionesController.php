<?php

namespace App\Controllers;

use CodeIgniter\Controller;

use App\Models\DerivacionesModel;
use App\Models\CanalizacionesModel;

class DerivacionesController extends Controller
{
	private $_derivacionesModel;
	private $_canalizacionesModel;

	function __construct()
	{
		$this->_derivacionesModel = new DerivacionesModel();
		$this->_canalizacionesModel = new CanalizacionesModel();
	}

	/**
	 * Vista para ver el directorio de derivaciones
	 *  Obtiene todas las oficinas de las derivaciones
	 *
	 */
	public function index()
	{
		$data = (object) array();
		$data->derivacionesEnsenada = $this->_derivacionesModel->asObject()->getByMunicipioId(1);
		$data->derivacionesMexicali = $this->_derivacionesModel->asObject()->getByMunicipioId(2);
		$data->derivacionesTecate = $this->_derivacionesModel->asObject()->getByMunicipioId(3);
		$data->derivacionesTijuana = $this->_derivacionesModel->asObject()->getByMunicipioId(4);
		$data->derivacionesRosarito = $this->_derivacionesModel->asObject()->getByMunicipioId(5);
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
		$data->canalizacionesEnsenada = $this->_canalizacionesModel->asObject()->getByMunicipioId(1);
		$data->canalizacionesMexicali = $this->_canalizacionesModel->asObject()->getByMunicipioId(2);
		$data->canalizacionesTecate = $this->_canalizacionesModel->asObject()->getByMunicipioId(3);
		$data->canalizacionesTijuana = $this->_canalizacionesModel->asObject()->getByMunicipioId(4);
		$data->canalizacionesRosarito = $this->_canalizacionesModel->asObject()->getByMunicipioId(5);
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
