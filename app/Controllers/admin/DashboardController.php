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
	}

	public function index()
	{
		$data = (object)array();
		$data->cantidad_folios = count($this->_foliosAtencionModel->asObject()->findAll());
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
		$data = $this->_foliosAtencionModel->asObject()->join('DATOS_DEL_DELITO', 'DATOS_DEL_DELITO.ID_DELITO = FOLIOS_ATENCION.ID_DATOS_DELITO', 'right')->findAll();
		$this->_loadView('Folios no atendidos', 'folios', '', $data, 'folios');
	}

	public function getFolioInformation()
	{
		$data = (object)array();
		$numfolio = $this->request->getPost('folio');
		$data->folio = $this->_foliosAtencionModel->asObject()->where('FOLIO', $numfolio)->first();
		if ($data->folio) {
			$data->status = 1;
			$data->denunciante = $this->_denunciantesModel->asObject()->where('ID_DENUNCIANTE', $data->folio->IDCIUDADANO)->first();
			$data->delito = $this->_datosDelitoModel->asObject()->where('ID_DELITO', $data->folio->ID_DATOS_DELITO)->first();

			if ($data->folio->ID_DATOS_DEL_RESPONSABLE) {
				$data->responsable = $this->_datosResponsablesModel->asObject()->where('ID_RESPONSABLE', $data->folio->ID_DATOS_DEL_RESPONSABLE)->first();
			}
			if ($data->folio->ID_DATOS_ADULTO_ACOMPANANTE) {
				$data->adulto = $this->_datosAdultoModel->asObject()->where('ID_ACOMPANANTE', $data->folio->ID_DATOS_ADULTO_ACOMPANANTE)->first();
			}
			if ($data->folio->ID_DATOS_MENOR_EDAD) {
				$data->menor = $this->_datosMenorModel->asObject()->where('ID_MENOR', $data->folio->ID_DATOS_MENOR_EDAD)->first();
			}
			if ($data->folio->ID_DATOS_PERSONA_DESAPARECIDA) {
				$data->desaparecido = $this->_datosDesaparecidoModel->asObject()->where('ID_PERSONA_DESAPARECIDA', $data->folio->ID_DATOS_PERSONA_DESAPARECIDA)->first();
			}
			if ($data->folio->ID_DATOS_ROBO_VEHICULO) {
				$data->vehiculo = $this->_datosVehiculoModel->asObject()->where('ID_VEHICULO', $data->folio->ID_DATOS_ROBO_VEHICULO)->first();
			}
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
