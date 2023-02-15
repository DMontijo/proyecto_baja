<?php

namespace App\Controllers\admin;

use App\Controllers\BaseController;
use App\Models\FolioDocModel;
use App\Models\FolioModel;
use App\Models\FolioPersonaFisicaModel;
use App\Models\MunicipiosModel;
use App\Models\PlantillasModel;
use App\Models\RolesPermisosModel;
use App\Models\UsuariosModel;

class DocumentosController extends BaseController
{

	private $_folioDocModel;
	private $_plantillasModel;
	private $_folioPersonaFisicaModel;
	private $_rolesPermisosModel;
	private $_folioModel;
	private $_usuariosModel;
	private $_municipiosModel;
	
	function __construct()
	{
		$this->_folioDocModel = new FolioDocModel();
		$this->_plantillasModel = new PlantillasModel();
		$this->_folioPersonaFisicaModel = new FolioPersonaFisicaModel();
		$this->_rolesPermisosModel = new RolesPermisosModel();
		$this->_folioModel = new FolioModel();
		$this->_usuariosModel = new UsuariosModel();
		$this->_municipiosModel = new MunicipiosModel();
	}
	public function index()
	{
		$data = (object)array();
		if (!$this->permisos('DOCUMENTOS')) {
			return redirect()->back()->with('message_error', 'Acceso denegado, no tienes los permisos necesarios.');
		}
		$data = [
			'fechaInicio' => date("Y-m-d"),
			'fechaFin' => date("Y-m-d"),
			'AGENTE_ASIGNADO'=> session('ID')
		];

		foreach ($data as $clave => $valor) {
			if (empty($valor)) unset($data[$clave]);
		}

		$municipio = $this->_municipiosModel->asObject()->where('ESTADOID', 2)->findAll();
		// $resultFilter = $this->_folioModel->filterDatesDocumentos($data);
		$resultFilter = $this->_folioDocModel->filterDatesDocumentos($data);

		if (session('ROLID') == '2' || session('ROLID') == '3' || session('ROLID') == '6') {
			$empleado = $this->_usuariosModel->asObject()->where('ID',	session('ID'))->orderBy('NOMBRE', 'ASC')->findAll();
		} else {
			$empleado = $this->_usuariosModel->asObject()->orderBy('NOMBRE', 'ASC')->findAll();
		}

		$dataView = (object)array();
		$dataView->result = $resultFilter->result;
		$dataView->municipios = $municipio;
		$dataView->empleados = $empleado;
		$dataView->filterParams = (object)$data;
		$dataView->rolPermiso = $this->_rolesPermisosModel->asObject()->where('ROLID', session('ROLID'))->findAll();

		$this->_loadView('Documentos', $dataView, 'index');
	}
	public function postDocumentos()
	{

		$data = [
			'AGENTE_ASIGNADO' => session('ID'),
			'STATUS' => $this->request->getPost('status'),
			'EXPEDIENTEID' => $this->request->getPost('expediente'),
			'fechaInicio' => $this->request->getPost('fechaInicio'),
			'fechaFin' => $this->request->getPost('fechaFin'),
			'horaInicio' => $this->request->getPost('horaInicio'),
			'horaFin' => $this->request->getPost('horaFin')
		];

		foreach ($data as $clave => $valor) {
			//Recorre el array y elimina los valores que nulos o vacíos
			if (empty($valor)) unset($data[$clave]);
		}
		if (count($data) <= 0) {
			$data = [
				'fechaInicio' => date("Y-m-d", strtotime('-1 month')),
				'fechaFin' => date("Y-m-d"),
			];
		}

		// $resultFilter = $this->_folioModel->filterDatesDocumentos($data);
		$resultFilter = $this->_folioDocModel->filterDatesDocumentos($data);

		$empleado = $this->_usuariosModel->asObject()->where('ID',	session('ID'))->orderBy('NOMBRE', 'ASC')->findAll();

		// if (isset($data['AGENTEATENCIONID'])) {
		// 	$agente = $this->_usuariosModel->asObject()->where('ROLID', 2)->where('ID', $data['AGENTEATENCIONID'])->orderBy('NOMBRE', 'ASC')->first();
		// 	$data['AGENTENOMBRE'] = $agente->NOMBRE . ' ' . $agente->APELLIDO_PATERNO . ' ' . $agente->APELLIDO_MATERNO;
		// }


		$dataView = (object)array();
		$dataView->result = $resultFilter->result;
		$dataView->empleados = $empleado;
		$dataView->filterParams = (object)$data;
		$dataView->documento = $this->_folioModel->get_folio_expediente();

		$dataView->rolPermiso = $this->_rolesPermisosModel->asObject()->where('ROLID', session('ROLID'))->findAll();

		$this->_loadView('Documentos', $dataView, 'index');
	}
	public function documentos_abiertas()
	{
		$data = (object)array();
		// $data = $this->_folioDocModel->asObject()->where('STATUS', 'ABIERTO')->distinct('NUMEROEXPEDIENTE')->first();
		$data->documento = $this->_folioDocModel->get_folio_abierto();
		$data->rolPermiso = $this->_rolesPermisosModel->asObject()->where('ROLID', session('ROLID'))->findAll();

		$this->_loadView('Documentos abiertos', $data, 'documentos_abiertas');
	}
	public function documentos_firmados()
	{
		$data = (object)array();
		// $data = $this->_folioDocModel->asObject()->where('STATUS', 'ABIERTO')->distinct('NUMEROEXPEDIENTE')->first();
		// $data->documento = $this->_folioDocModel->get_folio_firmado();
		$data->documento = $this->_folioModel->get_folio_expediente();
		$data->rolPermiso = $this->_rolesPermisosModel->asObject()->where('ROLID', session('ROLID'))->findAll();

		$this->_loadView('Documentos abiertos', $data, 'documentos_firmados');
	}

	public function documentos_show()
	{
		if (!$this->permisos('DOCUMENTOS')) {
			return redirect()->back()->with('message_error', 'Acceso denegado, no tienes los permisos necesarios.');
		}
		
		$data = (object)array();
		$data->folio = $this->request->getGet('folio');
		$data->expediente = $this->request->getGet('expediente');

		$data->foliodoc = $this->request->getGet('foliodoc');
		$data->tipodoc = $this->request->getGet('tipodoc');
		$data->year = $this->request->getGet('year');

		// $data->documento = $this->_plantillasModel->asObject()->where('TITULO', $data->tipodoc)->first();
		$data->documentos = $this->_folioDocModel->asObject()->where('NUMEROEXPEDIENTE', $data->expediente)->where('ANO', $data->year)->findAll();
		$data->rolPermiso = $this->_rolesPermisosModel->asObject()->where('ROLID', session('ROLID'))->findAll();
		$data->foliorow = $this->_folioModel->asObject()->where('FOLIOID', $data->folio)->where('ANO', $data->year)->findAll();
		$data->empleados = $this->_usuariosModel->asObject()->orderBy('NOMBRE', 'ASC')->where('ROLID', 3)->findAll();
		$data->plantillas = $this->_plantillasModel->asObject()->where('TITULO !=', 'CONSTANCIA DE EXTRAVÍO')->findAll();

		$data2 = [
			'header_data' => (object)['title' => 'DOCUMENTOS'],
			'body_data' => $data
		];
		echo view("admin/dashboard/documentos/documentos_generados", $data2);
	}
	public function obtenDocumentos()
	{
		$expediente = $this->request->getPost('expediente');
		$folio = $this->request->getPost('folio');
		$year = $this->request->getPost('year');
		if (isset($folio) && isset($year) && empty($expediente)) {
			$documentos = $this->_folioDocModel->get_by_folio($folio, $year);
			$imputados = $this->_folioPersonaFisicaModel->get_imputados($folio, $year);
			$victimas = $this->_folioPersonaFisicaModel->get_victimas($folio, $year);
			$correos = $this->_folioPersonaFisicaModel->get_correos_persona($folio, $year);

			return json_encode(['status' => 1, 'documentos' => $documentos, 'victimas' => $victimas, "imputados" => $imputados, 'correos' => $correos]);
		}
		if ($expediente) {
			$documentos = $this->_folioDocModel->get_by_folio($folio, $year);
			$imputados = $this->_folioPersonaFisicaModel->get_imputados($folio, $year);
			$victimas = $this->_folioPersonaFisicaModel->get_victimas($folio, $year);
			$correos = $this->_folioPersonaFisicaModel->get_correos_persona($folio, $year);

			return json_encode(['status' => 1, 'documentos' => $documentos, 'victimas' => $victimas, "imputados" => $imputados, 'correos' => $correos]);
		} else {
			return json_encode(['status' => 0]);
		}
	}
	public function getDocumento()
	{
		$docid = trim($this->request->getPost('docid'));
		$folio = trim($this->request->getPost('folio'));
		$year = trim($this->request->getPost('year'));


		$data = (object) array();

		// $data->documento = $this->_folioDocModel->where('FOLIOID', $folio)->where('ANO', $year)->where('FOLIODOCID', $docid)->first();
		$data->documento = $this->_folioDocModel->get_folio_by_first($folio, $year, $docid);

		if ($data->documento) {
			$documentos = $this->_folioDocModel->get_by_folio($folio, $year);
			return json_encode(['status' => 1, 'documentos' => $documentos, 'documentoporid' => $data->documento]);
		} else {
			return json_encode(['status' => 0]);
		}
	}
	public function validar_documento()
	{
		$year = date('Y');
		$expediente = $this->request->getGet('expediente');
		$year = $this->request->getGet('year');
		$foliodocid = $this->request->getGet('foliodoc');
		$folio = $this->request->getGet('folio');

		if ($expediente) {
			$documento = $this->_folioDocModel->asObject()->where('NUMEROEXPEDIENTE', base64_decode($expediente))->where('ANO', $year)->where('FOLIODOCID', base64_decode($foliodocid))->first();
		}else{
			$documento = $this->_folioDocModel->asObject()->where('FOLIOID', base64_decode($folio))->where('ANO', $year)->where('FOLIODOCID', base64_decode($foliodocid))->first();

		}
		if ($documento) {
			// $solicitante = $this->_folioPersonaFisicaModel->asObject()->where('PERSONAFISICAID', $documento->PERSONAFISICAID)->where('NUMEROEXPEDIENTE',$expediente)->where('ANO', $year)->first();
			// $documento->NOMBRESOLICITANTE = $solicitante->NOMBRE . ' ' . $solicitante->PRIMERAPELLIDO . ' ' . $solicitante->SEGUNDOAPELLIDO;
		}
		$data2 = [
			'header_data' => (object) ['title' => 'Validar documento', 'menu' => 'documento', 'submenu' => ''],
			'body_data' => (object) ['documento' => $documento],
		];
		echo view("admin/dashboard/wyswyg/validar_documento", $data2);
	}
	public function download_documento_pdf()
	{
		$docid = trim($this->request->getPost('docid'));
		$folio = trim($this->request->getPost('folio'));
		$year = trim($this->request->getPost('year'));

		$documento = $this->_folioDocModel->asObject()->where('FOLIOID', $folio)->where('ANO', $year)->where('FOLIODOCID', $docid)->first();

		header("Content-type: application/pdf");
		header("Content-Disposition: attachment; filename=" . $documento->TIPODOC . '_' . $folio . '_' . $year .  '_' . $docid . '.pdf');
		echo $documento->PDF;
	}

	public function download_documento_xml()
	{
		$docid = trim($this->request->getPost('docid'));
		$folio = trim($this->request->getPost('folio'));
		$year = trim($this->request->getPost('year'));

		$documento = $this->_folioDocModel->asObject()->where('FOLIOID', $folio)->where('ANO', $year)->where('FOLIODOCID', $docid)->first();
		header("Content-type: application/xml");
		header("Content-Disposition: attachment; filename=" . $documento->TIPODOC . $folio . '_' . $year .  '_' . $docid . '.xml');
		echo $documento->XML;
	}
	private function _loadView($title, $data, $view)
	{
		$data = [
			'header_data' => (object)['title' => $title],
			'body_data' => $data
		];

		echo view("admin/dashboard/wyswyg/$view", $data);
	}
	private function permisos($permiso)
	{
		return in_array($permiso, session('permisos'));
	}
}
