<?php

namespace App\Controllers;

use CodeIgniter\Controller;

use App\Models\DerivacionesModel;

class DerivacionesController extends Controller
{
	
	function __construct()
	{
		$this->_derivacionesModel = new DerivacionesModel();
	}

	public function index()
	{
		$data = (object) array();
		$data->derivacionesEnsenada = $this->_derivacionesModel->asObject()->where('MUNICIPIO', 'ENSENADA')->orderBy('INSTITUCIONREMISIONDESCR','asc')->findAll();
		$data->derivacionesTijuana = $this->_derivacionesModel->asObject()->where('MUNICIPIO', 'TIJUANA-RTO')->orderBy('INSTITUCIONREMISIONDESCR','asc')->findAll();
		$data->derivacionesMexicali = $this->_derivacionesModel->asObject()->where('MUNICIPIO', 'MEXICALI-TKT')->orderBy('INSTITUCIONREMISIONDESCR','asc')->findAll();
		$this->_loadView('Catálogo derivaciones', $data, 'derivaciones');
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
