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
	/**
	 * Plantilla de una vista de certificado medico
	 * ! Deprecated method, do not use.
	 *
	 */
	public function certificadoMedico()
	{
		$data = (object) array();
		$data->certificadoMedico = $this->_plantillasModel->asObject()->findAll();
		$this->_loadView('Documentos', $data, 'certificadoMedico');
	}
	/**
	 * Plantilla de una vista de constancia videodenuncia
	 * ! Deprecated method, do not use.
	 *
	 */
	public function constanciaVideoDenuncia()
	{
		$data = (object) array();
		$data->constanciaVideoD = $this->_plantillasModel->asObject()->findAll();
		$this->_loadView('Documentos', $data, 'constanciaVideoDenuncia');
	}
	/**
	 * Plantilla de una vista de proteccion de albergue
	 * ! Deprecated method, do not use.
	 *
	 */
	public function proteccionAlbergue()
	{
		$data = (object) array();
		$data->constanciaAlbergue = $this->_plantillasModel->asObject()->findAll();
		$this->_loadView('Documentos', $data, 'proteccionAlbergue');
	}
	/**
	 * Plantilla de una vista de proteccion de pertenencias
	 * ! Deprecated method, do not use.
	 *
	 */
	public function proteccionPertenencia()
	{
		$data = (object) array();
		$data->constanciaPertenencia = $this->_plantillasModel->asObject()->findAll();
		$this->_loadView('Documentos', $data, 'proteccionPertenencia');
	}
	/**
	 * Plantilla de una vista de proteccion de rondines
	 * ! Deprecated method, do not use.
	 *
	 */
	public function proteccionRondines()
	{
		$data = (object) array();
		$data->constanciaRondines = $this->_plantillasModel->asObject()->findAll();
		$this->_loadView('Documentos', $data, 'proteccionRondines');
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

		echo view("documentos/$view", $data);
	}
}
