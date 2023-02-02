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
		$data->derivacionesEnsenada = $this->_derivacionesModel->asObject()->get_by_municipioid(1);
		var_dump($data->derivacionesEnsenada);
		exit;
		$data->derivacionesMexicali = $this->_derivacionesModel->asObject()->get_by_municipioid(2);
		$data->derivacionesTecate = $this->_derivacionesModel->asObject()->get_by_municipioid(3);
		$data->derivacionesTijuana = $this->_derivacionesModel->asObject()->get_by_municipioid(4);
		$data->derivacionesRosarito = $this->_derivacionesModel->asObject()->get_by_municipioid(5);

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
