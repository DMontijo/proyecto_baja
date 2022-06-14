<?php

namespace App\Controllers\admin;

use App\Controllers\BaseController;
use App\Models\FoliosAtencionModel;
use App\Models\DenunciantesModel;
use App\Models\FolioDenunciaModel;
use App\Models\Datos_del_responsableModel;
use App\Models\Datos_adultoModel;
use App\Models\Datos_menorModel;
use App\Models\Datos_desaparecidoModel;
use App\Models\Datos_vehiculoModel;

use App\Models\FolioPreguntasModel;
use App\Models\FolioCorrelativoModel;
use App\Models\FolioModel;
use App\Models\FolioPersonaFisicaModel;
use App\Models\FolioPersonaFisicaDomicilioModel;
use App\Models\FolioPersonaFisicaDesaparecidaModel;
use App\Models\FolioPersonaFisicaImputadoDelitoModel;
use App\Models\FolioPersonaFisicaImputadoModel;
use App\Models\FolioRelacionFisicaFisicaModel;
use App\Models\FolioObjetoModel;
use App\Models\FolioVehiculoModel;
use App\Models\FolioDocumentoModel;
use App\Models\FolioArchivoExternoModel;

class DashboardController extends BaseController
{
	function __construct()
	{
		//Models
		$this->_foliosAtencionModel = new FoliosAtencionModel();
		$this->_denunciantesModel = new DenunciantesModel();
		$this->_datosDelitoModel = new FolioDenunciaModel();
		$this->_datosResponsablesModel = new Datos_del_responsableModel();
		$this->_datosAdultoModel = new Datos_adultoModel;
		$this->_datosMenorModel = new Datos_menorModel;
		$this->_datosDesaparecidoModel = new Datos_desaparecidoModel;
		$this->_datosVehiculoModel = new Datos_vehiculoModel;

		$this->_folioCorrelativoModel = new FolioCorrelativoModel();
		$this->_folioModel = new FolioModel();
		$this->_folioPreguntasModel = new FolioPreguntasModel();
		$this->_folioPersonaFisicaModel = new FolioPersonaFisicaModel();
		$this->_folioPersonaFisicaDomicilioModel = new FolioPersonaFisicaDomicilioModel();
		$this->_folioPersonaFisicaDesaparecidaModel = new FolioPersonaFisicaDesaparecidaModel();
		$this->_folioPersonaFisicaImputadoDelitoModel = new FolioPersonaFisicaImputadoDelitoModel();
		$this->_folioPersonaFisicaImputadoModel = new FolioPersonaFisicaImputadoModel();
		$this->_folioRelacionFisicaFisicaModel = new FolioRelacionFisicaFisicaModel();
		$this->_folioObjetoModel = new FolioObjetoModel();
		$this->_folioVehiculoModel = new FolioVehiculoModel();
		$this->_folioDocumentoModel = new FolioDocumentoModel();
		$this->_folioArchivoExternoModel = new FolioArchivoExternoModel();
	}

	public function index()
	{
		$data = (object)array();
		$data->cantidad_folios = count($this->_folioModel->asObject()->findAll());
		$this->_loadView('Principal', 'dashboard', '', $data, 'index');
	}

	public function registrar_usuario()
	{
		$data = array();
		$this->_loadView('Registrar usuario', 'registrarusuario', '', $data, 'register_user');
	}

	public function folios()
	{
		$data = (object)array();
		$data = $this->_folioModel->asObject()->findAll();
		$this->_loadView('Folios no atendidos', 'folios', '', $data, 'folios');
	}

	public function getFolioInformation()
	{
		$data = (object)array();
		$numfolio = $this->request->getPost('folio');
		$data->folio = $this->_folioModel->asObject()->where('FOLIOID', $numfolio)->first();
		if ($data->folio) {
			$data->status = 1;
			$data->preguntas_iniciales = $this->_folioPreguntasModel->where('FOLIOID', $numfolio)->first();
			$data->personas = $this->_folioPersonaFisicaModel->where('FOLIOID', $numfolio)->findAll();
			$data->domicilio = $this->_folioPersonaFisicaDomicilioModel->where('FOLIOID', $numfolio)->findAll();
			$data->vehiculos = $this->_folioVehiculoModel->where('FOLIOID', $numfolio)->findAll();
			return json_encode($data);
		} else {
			return json_encode(['status' => 0]);
		}
	}

	public function video_denuncia()
	{
		$data = array();
		$this->_loadView('Video denuncia', 'videodenuncia', '', $data, 'video_denuncia');
	}

	private function _loadView($title, $menu, $submenu, $data, $view)
	{
		$data2 = [
			'header_data' => (object)['title' => $title, 'menu' => $menu, 'submenu' => $submenu],
			'body_data' => $data
		];

		echo view("admin/dashboard/$view", $data2);
	}
}

/* End of file DashboardController.php */
/* Location: ./app/Controllers/admin/DashboardController.php */
