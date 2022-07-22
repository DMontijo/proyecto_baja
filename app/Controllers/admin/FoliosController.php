<?php

namespace App\Controllers\admin;

use App\Controllers\BaseController;

use App\Models\DenunciantesModel;

use App\Models\FolioPreguntasModel;
use App\Models\FolioModel;
use App\Models\FolioPersonaFisicaModel;
use App\Models\FolioPersonaFisicaDomicilioModel;
use App\Models\FolioPersonaFisicaDesaparecidaModel;
use App\Models\FolioVehiculoModel;
use App\Models\UsuariosModel;
use App\Models\ZonasUsuariosModel;
use App\Models\RolesUsuariosModel;

class FoliosController extends BaseController
{
	function __construct()
	{
		//Models
		$this->_denunciantesModel = new DenunciantesModel();

		$this->_folioModel = new FolioModel();
		$this->_folioPreguntasModel = new FolioPreguntasModel();
		$this->_folioPersonaFisicaModel = new FolioPersonaFisicaModel();
		$this->_folioPersonaFisicaDomicilioModel = new FolioPersonaFisicaDomicilioModel();
		$this->_folioPersonaFisicaDesaparecidaModel = new FolioPersonaFisicaDesaparecidaModel();
		$this->_folioVehiculoModel = new FolioVehiculoModel();

		$this->_usuariosModel = new UsuariosModel();
		$this->_zonasUsuariosModel = new ZonasUsuariosModel();
		$this->_rolesUsuariosModel = new RolesUsuariosModel();
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
			$data->expedientes_no_firmados = count($this->_folioModel->asObject()->where('EXPEDIENTEID !=', NULL)->where('AGENTEATENCIONID !=', NULL)->where('AGENTEFIRMAID', NULL)->findAll());
		} else {
			$data->derivados = count($this->_folioModel->asObject()->where('AGENTEATENCIONID', session('ID'))->where('STATUS', 'DERIVADO')->findAll());
			$data->canalizados = count($this->_folioModel->asObject()->where('AGENTEATENCIONID', session('ID'))->where('STATUS', 'CANALIZADO')->findAll());
			$data->expedientes = count($this->_folioModel->asObject()->where('AGENTEATENCIONID', session('ID'))->where('EXPEDIENTEID !=', NULL)->where('AGENTEATENCIONID !=', NULL)->where('AGENTEFIRMAID !=', NULL)->findAll());
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
