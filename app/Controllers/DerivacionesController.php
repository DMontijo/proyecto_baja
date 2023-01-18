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
		$data->derivacionesEnsenada = $this->_derivacionesModel->asObject()->where('MUNICIPIO', 'ENSENADA')->orderBy('INSTITUCIONREMISIONDESCR', 'asc')->findAll();
		$data->derivacionesTijuana = $this->_derivacionesModel->asObject()->where('MUNICIPIO', 'TIJUANA-RTO')->orderBy('INSTITUCIONREMISIONDESCR', 'asc')->findAll();
		$data->derivacionesMexicali = $this->_derivacionesModel->asObject()->where('MUNICIPIO', 'MEXICALI-TKT')->orderBy('INSTITUCIONREMISIONDESCR', 'asc')->findAll();
		$this->_loadView('Catálogo derivaciones', $data, 'derivaciones');
	}

	public function canalizaciones()
	{
		$data = (object) array();
		$data->canalizacionesEnsenada = $this->_canalizacionesModel->asObject()->where('MUNICIPIO', 'ENSENADA')->findAll();
		$data->canalizacionesTijuana = $this->_canalizacionesModel->asObject()->where('MUNICIPIO', 'TIJUANA')->findAll();
		$data->canalizacionesMexicali = $this->_canalizacionesModel->asObject()->where('MUNICIPIO', 'MEXICALI')->findAll();
		$data->canalizacionesTecate = $this->_canalizacionesModel->asObject()->where('MUNICIPIO', 'TECATE')->findAll();
		$data->canalizacionesRosarito = $this->_canalizacionesModel->asObject()->where('MUNICIPIO', 'ROSARITO')->findAll();
		$this->_loadView('Canalizaciones', $data, 'canalizaciones');
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