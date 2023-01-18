<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PlantillasModel;
use App\Models\FolioModel;
use App\Models\UsuariosModel;
use App\Models\HechoLugarModel;
use App\Models\MunicipiosModel;
use App\Models\EstadosModel;
use App\Models\PersonaTipoIdentificacionModel;

use App\Models\ConstanciaExtravioModel;

class PDFController extends BaseController
{
	private $_plantillasModel;
	private $_folioModel;
	private $_usuariosModel;
	private $_hechoLugarModel;
	private $_municipiosModel;
	private $_estadosModel;
	private $_constanciaExtravioModel;
	private $_tipoIdentificacionModel;
	private $db;
	
	function __construct()
	{
		$this->_plantillasModel = new PlantillasModel();
		$this->_folioModel = new FolioModel();
		$this->_usuariosModel = new UsuariosModel();
		$this->_hechoLugarModel = new HechoLugarModel();
		$this->_municipiosModel = new MunicipiosModel();
		$this->_estadosModel = new EstadosModel();
		$this->_constanciaExtravioModel = new ConstanciaExtravioModel();
		$this->_tipoIdentificacionModel = new PersonaTipoIdentificacionModel();
		$this->db = \Config\Database::connect();
	}
	public function certificadoMedico()
	{
		$data = (object) array();
		$data->certificadoMedico = $this->_plantillasModel->asObject()->findAll();
		$this->_loadView('Documentos', $data, 'certificadoMedico');
	}
	public function constanciaVideoDenuncia()
	{
		$data = (object) array();
		$data->constanciaVideoD = $this->_plantillasModel->asObject()->findAll();
		$this->_loadView('Documentos', $data, 'constanciaVideoDenuncia');
	}
	public function proteccionAlbergue()
	{
		$data = (object) array();
		$data->constanciaAlbergue = $this->_plantillasModel->asObject()->findAll();
		$this->_loadView('Documentos', $data, 'proteccionAlbergue');
	}
	public function proteccionPertenencia()
	{
		$data = (object) array();
		$data->constanciaPertenencia = $this->_plantillasModel->asObject()->findAll();
		$this->_loadView('Documentos', $data, 'proteccionPertenencia');
	}
	public function proteccionRondines()
	{
		$data = (object) array();
		$data->constanciaRondines = $this->_plantillasModel->asObject()->findAll();
		$this->_loadView('Documentos', $data, 'proteccionRondines');
	}

	private function _loadView($title, $data, $view)
	{
		$data = [
			'header_data' => (object)['title' => $title],
			'body_data' => $data
		];

		echo view("documentos/$view", $data);
	}
}