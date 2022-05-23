<?php

namespace App\Controllers\client;

use App\Controllers\BaseController;

use App\Models\EstadosModel;
use App\Models\MunicipiosModel;
use App\Models\LocalidadesModel;
use App\Models\ColoniasModel;


class DashboardController extends BaseController
{
	function __construct()
	{
		//Models
		$this->_estadosModel = new EstadosModel();
		$this->_municipiosModel = new MunicipiosModel();
		$this->_localidadesModel = new LocalidadesModel();
		$this->_coloniasModel = new ColoniasModel();
	}

	public function index()
	{
		$data = (object)array();
		$data->estados = $this->_estadosModel->asObject()->findAll();
		$data->municipios = $this->_municipiosModel->asObject()->findAll();
		$data->localidades = $this->_localidadesModel->asObject()->findAll();
		$data->colonias = $this->_coloniasModel->asObject()->findAll();
		$this->_loadView('Dashboard', 'dashboard', '', $data, 'index');
	}

	public function video_denuncia()
	{
		$data = array();
		$this->_loadView('Video denuncia', 'video-denuncia', '', $data, 'video_denuncia');
	}

	public function denuncias()
	{
		$data = array();
		$this->_loadView('Mis denuncias', 'denuncias', '', $data, 'lista_denuncias');
	}

	private function _loadView($title, $menu, $submenu, $data, $view)
	{
		$data2 = [
			'header_data' => (object)['title' => $title, 'menu' => $menu, 'submenu' => $submenu],
			'body_data' => $data
		];

		echo view("client/dashboard/$view", $data2);
	}
}

/* End of file DashboardController.php */
/* Location: ./app/Controllers/client/DashboardController.php */
