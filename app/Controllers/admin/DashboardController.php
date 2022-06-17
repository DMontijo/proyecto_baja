<?php

namespace App\Controllers\admin;

use App\Controllers\BaseController;
use App\Database\Migrations\PERSONACALIDADJURIDICA;
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
use App\Models\PersonaCalidadJuridicaModel;

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
		$this->_folioPersonaCalidadJuridica = new PersonaCalidadJuridicaModel();
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
	public function findPersonaFisicaById()
	{
		$data = (object)array();
		$id = $this->request->getPost('id');
		$folio = $this->request->getPost('folio');
		$idcalidad = $this->request->getPost('idcalidad');
		$data->personaid = $this->_folioPersonaFisicaModel->where('FOLIOID', $folio)->where('PERSONAFISICAID', $id)->first();
		
		// $data['data'] = $data;
		$data->calidadjuridica = $this->_folioPersonaFisicaModel->join('PERSONACALIDADJURIDICA', 'PERSONACALIDADJURIDICA.PERSONACALIDADJURIDICAID =FOLIOPERSONAFISICA.CALIDADJURIDICAID')->where('FOLIOID', $folio)->where('PERSONAFISICAID', $id)->where('CALIDADJURIDICAID', $idcalidad)->first();
	//	return view('admin/dashboard/video_denuncia_modals/info_folio_modal', $data);
		return json_encode($data);
		
		
		
	}
	public function joinFisico()
	{
		$data =  $this->_folioPersonaFisicaModel->join('PERSONACALIDADJURIDICA', 'PERSONACALIDADJURIDICA.PERSONACALIDADJURIDICAID =FOLIOPERSONAFISICA.CALIDADJURIDICAID')
		->where('FOLIOID', 402004202200001)->where('PERSONAFISICAID', 1)->first();
		return json_encode($data);
	}
	public function findPersonadDomicilioById()
	{	
		$data = (object)array();
		$id = $this->request->getPost('id');
		$folio = $this->request->getPost('folio');
		$idestado = $this->request->getPost('idestado');
		$idmunicipio = $this->request->getPost('idmunicipio');
		$data->persondom = $this->_folioPersonaFisicaDomicilioModel->where('FOLIOID', $folio)->where('PERSONAFISICAID', $id)->first();
		$data->estado =$this->_folioPersonaFisicaDomicilioModel->join('CATEGORIA_ESTADO', 'CATEGORIA_ESTADO.ESTADOID =FOLIOPERSONAFISDOMICILIO.ESTADOID')->where('FOLIOID', $folio)->where('PERSONAFISICAID', $id)->first();
		$data->municipio =$this->_folioPersonaFisicaDomicilioModel->join('CATEGORIA_MUNICIPIO', 'CATEGORIA_MUNICIPIO.MUNICIPIOID =FOLIOPERSONAFISDOMICILIO.MUNICIPIOID')->where('FOLIOID', $folio)->where('PERSONAFISICAID', $id)->first();
		$data->localidad =$this->_folioPersonaFisicaDomicilioModel->join('CATEGORIA_LOCALIDAD', 'CATEGORIA_LOCALIDAD.LOCALIDADID =FOLIOPERSONAFISDOMICILIO.LOCALIDADID')->where('FOLIOID', $folio)->where('PERSONAFISICAID', $id)->first();

		return json_encode($data);
	}
	public function findPersonadVehiculoById()
	{
		$data = (object)array();
		$id = $this->request->getPost('id');
		$folio = $this->request->getPost('folio');
		$data->vehiculo = $this->_folioVehiculoModel->where('FOLIOID', $folio)->first();
		$data->color =$this->_folioVehiculoModel->join('CATEGORIA_VEHICULOCOLOR', 'CATEGORIA_VEHICULOCOLOR.VEHICULOCOLORID  =FOLIOVEHICULO.PRIMERCOLORID')->where('FOLIOID', $folio)->first();
		$data->estadov =$this->_folioVehiculoModel->join('CATEGORIA_ESTADO', 'CATEGORIA_ESTADO.ESTADOID  =FOLIOVEHICULO.ESTADOIDPLACA')->where('FOLIOID', $folio)->first();
		$data->tipov =$this->_folioVehiculoModel->join('CATEGORIA_VEHICULOTIPO', 'CATEGORIA_VEHICULOTIPO.VEHICULOTIPOID   =FOLIOVEHICULO.TIPOID')->where('FOLIOID', $folio)->first();

		return json_encode($data);
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
