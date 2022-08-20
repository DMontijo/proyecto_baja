<?php

namespace App\Controllers\admin;

use App\Controllers\BaseController;

use App\Models\DenunciantesModel;

use App\Models\EstadosModel;
use App\Models\MunicipiosModel;
use App\Models\LocalidadesModel;
use App\Models\ColoniasModel;
use App\Models\HechoLugarModel;
use App\Models\VehiculoColorModel;
use App\Models\VehiculoTipoModel;
use App\Models\PaisesModel;
use App\Models\DelitosUsuariosModel;
use App\Models\PersonaIdiomaModel;

use App\Models\FolioPreguntasModel;
use App\Models\FolioModel;
use App\Models\FolioPersonaFisicaModel;
use App\Models\FolioPersonaFisicaDomicilioModel;
use App\Models\FolioPersonaFisicaDesaparecidaModel;
use App\Models\FolioVehiculoModel;
use App\Models\UsuariosModel;
use App\Models\ZonasUsuariosModel;
use App\Models\RolesUsuariosModel;
use App\Models\OficinasModel;
use App\Models\EmpleadosModel;
use App\Models\PersonaCalidadJuridicaModel;
use App\Models\PersonaTipoIdentificacionModel;

use App\Models\EscolaridadModel;
use App\Models\OcupacionModel;
use App\Models\PersonaEstadoCivilModel;
use App\Models\PersonaNacionalidadModel;

use App\Models\ConstanciaExtravioModel;

class FoliosController extends BaseController
{
	function __construct()
	{
		//Models
		$this->_constanciaExtravioModel = new ConstanciaExtravioModel();

		$this->_usuariosModel = new UsuariosModel();
		$this->_zonasUsuariosModel = new ZonasUsuariosModel();
		$this->_rolesUsuariosModel = new RolesUsuariosModel();

		$this->_paisesModel = new PaisesModel();
		$this->_estadosModel = new EstadosModel();
		$this->_municipiosModel = new MunicipiosModel();
		$this->_localidadesModel = new LocalidadesModel();
		$this->_coloniasModel = new ColoniasModel();
		$this->_hechoLugarModel = new HechoLugarModel();
		$this->_coloresVehiculoModel = new VehiculoColorModel();
		$this->_tipoVehiculoModel = new VehiculoTipoModel();
		$this->_delitosUsuariosModel = new DelitosUsuariosModel();
		$this->_denunciantesModel = new DenunciantesModel();
		$this->_idiomaModel = new PersonaIdiomaModel();

		$this->_folioModel = new FolioModel();
		$this->_folioPreguntasModel = new FolioPreguntasModel();
		$this->_folioPersonaFisicaModel = new FolioPersonaFisicaModel();
		$this->_folioPersonaFisicaDomicilioModel = new FolioPersonaFisicaDomicilioModel();
		$this->_folioPersonaFisicaDesaparecidaModel = new FolioPersonaFisicaDesaparecidaModel();
		$this->_folioVehiculoModel = new FolioVehiculoModel();

		$this->_usuariosModel = new UsuariosModel();
		$this->_zonasUsuariosModel = new ZonasUsuariosModel();
		$this->_rolesUsuariosModel = new RolesUsuariosModel();
		$this->_oficinasModel = new OficinasModel();
		$this->_empleadosModel = new EmpleadosModel();
		$this->_folioPersonaCalidadJuridica = new PersonaCalidadJuridicaModel();
		$this->_tipoIdentificacionModel = new PersonaTipoIdentificacionModel();

		$this->_escolaridadModel = new EscolaridadModel();
		$this->_ocupacionModel = new OcupacionModel();
		$this->_estadoCivilModel = new PersonaEstadoCivilModel();
		$this->_nacionalidadModel = new PersonaNacionalidadModel();
	}

	public function index()
	{
		$data = (object)array();
		$agente = $this->_usuariosModel->asObject()->where('ID', session('ID'))->first();
		$roles = [1, 3];
		$data->abiertos = count($this->_folioModel->where('STATUS', 'ABIERTO')->findAll());
		if (in_array($agente->ROLID, $roles)) {
			$data->derivados = count($this->_folioModel->asObject()->where('STATUS', 'DERIVADO')->findAll());
			$data->canalizados = count($this->_folioModel->asObject()->where('STATUS', 'CANALIZADO')->findAll());
			$data->expedientes = count($this->_folioModel->asObject()->where('EXPEDIENTEID !=', NULL)->where('AGENTEATENCIONID !=', NULL)->where('AGENTEFIRMAID !=', NULL)->findAll());
			$data->proceso = count($this->_folioModel->asObject()->where('STATUS', 'EN PROCESO')->findAll());
			$data->expedientes_no_firmados = count($this->_folioModel->asObject()->where('EXPEDIENTEID !=', NULL)->where('AGENTEATENCIONID !=', NULL)->where('AGENTEFIRMAID', NULL)->findAll());
		} else {
			$data->derivados = count($this->_folioModel->asObject()->where('AGENTEATENCIONID', session('ID'))->where('STATUS', 'DERIVADO')->findAll());
			$data->canalizados = count($this->_folioModel->asObject()->where('AGENTEATENCIONID', session('ID'))->where('STATUS', 'CANALIZADO')->findAll());
			$data->expedientes = count($this->_folioModel->asObject()->where('AGENTEATENCIONID', session('ID'))->where('EXPEDIENTEID !=', NULL)->where('AGENTEATENCIONID !=', NULL)->where('AGENTEFIRMAID !=', NULL)->findAll());
			$data->proceso = count($this->_folioModel->asObject()->where('STATUS', 'EN PROCESO')->findAll());
			$data->expedientes_no_firmados = count($this->_folioModel->asObject()->where('AGENTEATENCIONID', session('ID'))->where('EXPEDIENTEID !=', NULL)->where('AGENTEATENCIONID !=', NULL)->where('AGENTEFIRMAID', NULL)->findAll());
		}
		$this->_loadView('Folios', 'folios', '', $data, 'index');
	}

	public function folios_abiertos()
	{
		$data = (object)array();
		$data = $this->_folioModel->asObject()->where('STATUS', 'ABIERTO')->join('DENUNCIANTES', 'DENUNCIANTES.DENUNCIANTEID = FOLIO.DENUNCIANTEID')->findAll();
		$this->_loadView('Folios abiertos', 'folios', '', $data, 'folios_abiertos');
	}

	public function folios_derivados()
	{
		$data = (object)array();
		$agente = $this->_usuariosModel->asObject()->where('ID', session('ID'))->first();
		$roles = [1, 3];
		if (in_array($agente->ROLID, $roles)) {
			$data = $this->_folioModel->asObject()->where('STATUS', 'DERIVADO')->join('USUARIOS', 'USUARIOS.ID = FOLIO.AGENTEATENCIONID')->join('ROLES', 'ROLES.ID = USUARIOS.ROLID')->findAll();
		} else {
			$data = $this->_folioModel->asObject()->where('STATUS', 'DERIVADO')->where('AGENTEATENCIONID', session('ID'))->join('USUARIOS', 'USUARIOS.ID = FOLIO.AGENTEATENCIONID')->join('ROLES', 'ROLES.ID = USUARIOS.ROLID')->findAll();
		}
		$this->_loadView('Folios derivados', 'folios', '', $data, 'folios_derivados');
	}

	public function folios_canalizados()
	{
		$data = (object)array();
		$agente = $this->_usuariosModel->asObject()->where('ID', session('ID'))->first();
		$roles = [1, 3];
		if (in_array($agente->ROLID, $roles)) {
			$data = $this->_folioModel->asObject()->where('STATUS', 'CANALIZADO')->join('USUARIOS', 'USUARIOS.ID = FOLIO.AGENTEATENCIONID')->join('ROLES', 'ROLES.ID = USUARIOS.ROLID')->findAll();
		} else {
			$data = $this->_folioModel->asObject()->where('STATUS', 'CANALIZADO')->where('AGENTEATENCIONID', session('ID'))->join('USUARIOS', 'USUARIOS.ID = FOLIO.AGENTEATENCIONID')->join('ROLES', 'ROLES.ID = USUARIOS.ROLID')->findAll();
		}
		$this->_loadView('Folios canalizados', 'folios', '', $data, 'folios_canalizados');
	}

	public function folios_en_proceso()
	{
		$data = (object)array();
		$data = $this->_folioModel->asObject()->where('STATUS', 'EN PROCESO')->join('USUARIOS', 'USUARIOS.ID = FOLIO.AGENTEATENCIONID')->findAll();
		$this->_loadView('Folios en proceso', 'folios', '', $data, 'folios_en_proceso');
	}

	public function liberar_folio()
	{
		$folio = $this->request->getVar('folio');
		$year = $this->request->getVar('year');

		$data = ['EXPEDIENTEID' => NULL, 'AGENTEATENCIONID' => NULL, 'AGENTEFIRMAID' => NULL, 'STATUS' => 'ABIERTO'];
		$this->_folioModel->set($data)->where('FOLIOID', $folio)->where('ANO', $year)->update();
		return redirect()->to(base_url('/admin/dashboard/folios_en_proceso'));
	}

	public function folios_expediente()
	{
		$data = (object)array();
		$agente = $this->_usuariosModel->asObject()->where('ID', session('ID'))->first();
		$roles = [1, 3];
		if (in_array($agente->ROLID, $roles)) {
			$data = $this->_folioModel->asObject()->where('EXPEDIENTEID !=', NULL)->where('AGENTEATENCIONID !=', NULL)->where('AGENTEFIRMAID !=', NULL)->join('USUARIOS', 'USUARIOS.ID = FOLIO.AGENTEATENCIONID')->join('ROLES', 'ROLES.ID = USUARIOS.ROLID')->findAll();
		} else {
			$data = $this->_folioModel->asObject()->where('EXPEDIENTEID !=', NULL)->where('AGENTEATENCIONID', session('ID'))->where('AGENTEFIRMAID !=', NULL)->join('USUARIOS', 'USUARIOS.ID = FOLIO.AGENTEATENCIONID')->join('ROLES', 'ROLES.ID = USUARIOS.ROLID')->findAll();
		}

		$this->_loadView('Folios expediente', 'folios', '', $data, 'folios_expediente');
	}

	public function folios_sin_firma()
	{
		$data = (object)array();
		$data = $this->_folioModel->asObject()->where('EXPEDIENTEID !=', NULL)->where('AGENTEATENCIONID !=', NULL)->where('AGENTEFIRMAID', NULL)->join('USUARIOS', 'USUARIOS.ID = FOLIO.AGENTEATENCIONID')->join('ROLES', 'ROLES.ID = USUARIOS.ROLID')->findAll();
		$this->_loadView('Expedientes sin firmar', 'folios', '', $data, 'folios_sin_firma');
	}

	public function firmar_folio()
	{
		$folio = $this->request->getVar('folio');
		$data = ['AGENTEFIRMAID' => session('ID')];
		$this->_folioModel->set($data)->where('FOLIOID', $folio)->update();
		return redirect()->to(base_url('/admin/dashboard/folios_sin_firma'));
	}

	public function getAllFolios()
	{
		$data = (object)array();
		$data = [
			'fechaInicio' => date("Y-m-d", strtotime('-1 month')),
			'fechaFin' => date("Y-m-d"),
		];

		foreach ($data as $clave => $valor) {
			if (empty($valor)) unset($data[$clave]);
		}

		$municipio = $this->_municipiosModel->asObject()->where('ESTADOID', 2)->findAll();
		$resultFilter = $this->_folioModel->filterDates($data);
		$empleado = $this->_usuariosModel->asObject()->where('ROLID', 2)->orderBy('NOMBRE', 'ASC')->findAll();

		$dataView = (object)array();
		$dataView->result = $resultFilter->result;
		$dataView->municipios = $municipio;
		$dataView->empleados = $empleado;
		$dataView->filterParams = (object)$data;

		$this->_loadView('Folios', 'folios', '', $dataView, 'buscar_folio');
	}

	public function getFilterFolios()
	{
		$data = (object)array();
		$data = [
			'FOLIOID' => $this->request->getPost('folio'),
			'ANO' => $this->request->getPost('year'),
			'MUNICIPIOID' => $this->request->getPost('municipio'),
			'AGENTEATENCIONID' => $this->request->getPost('agente'),
			'STATUS' => $this->request->getPost('status'),
			'fechaInicio' => $this->request->getPost('fecha_inicio'),
			'fechaFin' => $this->request->getPost('fecha_fin'),
			'horaInicio' => $this->request->getPost('horaInicio'),
			'horaFin' => $this->request->getPost('horaFin'),
		];

		foreach ($data as $clave => $valor) {
			if (empty($valor)) unset($data[$clave]);
		}
		if (count($data) <= 0) {
			$data = [
				'fechaInicio' => date("Y-m-d", strtotime('-1 month')),
				'fechaFin' => date("Y-m-d"),
			];
		}

		$municipio = $this->_municipiosModel->asObject()->where('ESTADOID', 2)->findAll();
		$resultFilter = $this->_folioModel->filterDates($data);
		$empleado = $this->_usuariosModel->asObject()->where('ROLID', 2)->orderBy('NOMBRE', 'ASC')->findAll();

		$dataView = (object)array();
		$dataView->result = $resultFilter->result;
		$dataView->municipios = $municipio;
		$dataView->empleados = $empleado;
		$dataView->filterParams = (object)$data;

		$this->_loadView('Folios', 'folios', '', $dataView, 'buscar_folio');
	}

	public function viewFolio()
	{
		$data = (object)array();
		$data->folio = $this->request->getPost('folio');

		// Catálogos
		$data->delitosUsuarios = $this->_delitosUsuariosModel->asObject()->orderBy('DELITO', 'ASC')->findAll();
		$lugares = $this->_hechoLugarModel->orderBy('HECHODESCR', 'ASC')->findAll();
		$lugares_sin = [];
		$lugares_fuego = [];
		$lugares_blanca = [];
		foreach ($lugares as $lugar) {
			if (strpos($lugar['HECHODESCR'], 'ARMA DE FUEGO')) {
				array_push($lugares_fuego, (object)$lugar);
			}
			if (strpos($lugar['HECHODESCR'], 'ARMA BLANCA')) {
				array_push($lugares_blanca, (object)$lugar);
			}
			if (!strpos($lugar['HECHODESCR'], 'ARMA BLANCA') && !strpos($lugar['HECHODESCR'], 'ARMA DE FUEGO')) {
				array_push($lugares_sin, (object)$lugar);
			}
		}
		$data->lugares = [];
		$data->lugares = (object)array_merge($lugares_sin, $lugares_blanca, $lugares_fuego);

		$data->edoCiviles = $this->_estadoCivilModel->asObject()->findAll();
		$data->nacionalidades = $this->_nacionalidadModel->asObject()->findAll();
		$data->calidadJuridica = $this->_folioPersonaCalidadJuridica->asObject()->findAll();
		$data->idiomas = $this->_idiomaModel->asObject()->findAll();

		$data->municipios = $this->_municipiosModel->asObject()->where('ESTADOID', 2)->findAll();

		$data->paises = $this->_paisesModel->asObject()->findAll();
		$data->estados = $this->_estadosModel->asObject()->findAll();
		$data->tiposIdentificaciones = $this->_tipoIdentificacionModel->asObject()->findAll();
		$data->escolaridades = $this->_escolaridadModel->asObject()->findAll();
		$data->ocupaciones = $this->_ocupacionModel->asObject()->findAll();
		$data->colorVehiculo = $this->_coloresVehiculoModel->asObject()->findAll();
		$data->tipoVehiculo = $this->_tipoVehiculoModel->asObject()->orderBy('VEHICULOTIPODESCR', 'ASC')->findAll();

		$this->_loadView('Video denuncia', 'videodenuncia', '', $data, 'ver_folio');
	}

	private function _loadView($title, $menu, $submenu, $data, $view)
	{
		$data2 = [
			'header_data' => (object)['title' => $title, 'menu' => $menu, 'submenu' => $submenu],
			'body_data' => $data
		];

		echo view("admin/dashboard/folios/$view", $data2);
	}
}

/* End of file FoliosController.php */
/* Location: ./app/Controllers/admin/FoliosController.php */
