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

	public function index()
	{
		$data = (object) array();
		$data->derivacionesEnsenada = $this->_derivacionesModel->asObject()->getByMunicipioId(1);
		$data->derivacionesMexicali = $this->_derivacionesModel->asObject()->getByMunicipioId(2);
		$data->derivacionesTecate = $this->_derivacionesModel->asObject()->getByMunicipioId(3);
		$data->derivacionesTijuana = $this->_derivacionesModel->asObject()->getByMunicipioId(4);
		$data->derivacionesRosarito = $this->_derivacionesModel->asObject()->getByMunicipioId(5);
		$this->_loadView('Catálogo derivaciones', $data, 'derivaciones');
	}

	public function canalizaciones()
	{
		$data = (object) array();
		$data->canalizacionesEnsenada = $this->_canalizacionesModel->asObject()->getByMunicipioId(1);
		$data->canalizacionesMexicali = $this->_canalizacionesModel->asObject()->getByMunicipioId(2);
		$data->canalizacionesTecate = $this->_canalizacionesModel->asObject()->getByMunicipioId(3);
		$data->canalizacionesTijuana = $this->_canalizacionesModel->asObject()->getByMunicipioId(4);
		$data->canalizacionesRosarito = $this->_canalizacionesModel->asObject()->getByMunicipioId(5);
		$this->_loadView('Catálogo canalizaciones', $data, 'canalizaciones');
	}

	private function _loadView($title, $data, $view)
	{
		$data = [
			'header_data' => (object)['title' => $title],
			'body_data' => $data
		];

		echo view("$view", $data);
	}
}
