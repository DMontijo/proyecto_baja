<?php

namespace App\Controllers\admin;

use App\Controllers\BaseController;
use App\Models\BitacoraActividadModel;
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
	private $_bitacoraActividadModel;

	function __construct()
	{
		$this->_folioDocModel = new FolioDocModel();
		$this->_plantillasModel = new PlantillasModel();
		$this->_folioPersonaFisicaModel = new FolioPersonaFisicaModel();
		$this->_rolesPermisosModel = new RolesPermisosModel();
		$this->_folioModel = new FolioModel();
		$this->_usuariosModel = new UsuariosModel();
		$this->_municipiosModel = new MunicipiosModel();
		$this->_bitacoraActividadModel = new BitacoraActividadModel();
	}
	/**
	 * Vista de Folios Asignados para Firmar
	 * Se mandan datas diferentes de acuerdo al ROL
	 * Retorna toda la información de los documentos a firmar

	 */
	public function index()
	{
		$data = (object)array();
		if (!$this->permisos('DOCUMENTOS')) {
			return redirect()->back()->with('message_error', 'Acceso denegado, no tienes los permisos necesarios.');
		}
		if (session('ROLID') == 6) {
			$data = [
				'fechaInicio' => date("Y-m-d"),
				'fechaFin' => date("Y-m-d"),
				'ENCARGADO_ASIGNADO' => session('ID')
			];
		} else {
			$data = [
				'fechaInicio' => date("Y-m-d"),
				'fechaFin' => date("Y-m-d"),
				'AGENTE_ASIGNADO' => session('ID')
			];
		}
		// Destruye los valores limpios
		foreach ($data as $clave => $valor) {
			if (empty($valor)) unset($data[$clave]);
		}

		$municipio = $this->_municipiosModel->asObject()->where('ESTADOID', 2)->findAll();
		// $resultFilter = $this->_folioModel->filterDatesDocumentos($data);
		// Función para mostrar un filtro establecido
		$resultFilter = $this->_folioDocModel->filterDatesDocumentos($data);
		if (session('ROLID') == '2' || session('ROLID') == '3' || session('ROLID') == '6') {
			//Obtiene solo el empleado de la sesión
			$empleado = $this->_usuariosModel->asObject()->where('ID',	session('ID'))->orderBy('NOMBRE', 'ASC')->findAll();
		} else {
			// Obtiene todos los empleados
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
	/**
	 * Función para cambiar el filtro por otro que el usuario haya establecido
	 * Recibe los datos del formulario a través del metodo POST
	 * Se mandan datas diferentes de acuerdo al ROL
	 * Retorna toda la información de los documentos a firmar

	 */
	public function postDocumentos()
	{

		if (session('ROLID') == 6) {
			$data = [
				'ENCARGADO_ASIGNADO' => session('ID'),
				'STATUS' => $this->request->getPost('status'),
				'EXPEDIENTEID' => $this->request->getPost('expediente'),
				'fechaInicio' => $this->request->getPost('fechaInicio'),
				'fechaFin' => $this->request->getPost('fechaFin'),
				'horaInicio' => $this->request->getPost('horaInicio'),
				'horaFin' => $this->request->getPost('horaFin')
			];
		} else {
			$data = [
				'AGENTE_ASIGNADO' => session('ID'),
				'STATUS' => $this->request->getPost('status'),
				'EXPEDIENTEID' => $this->request->getPost('expediente'),
				'fechaInicio' => $this->request->getPost('fechaInicio'),
				'fechaFin' => $this->request->getPost('fechaFin'),
				'horaInicio' => $this->request->getPost('horaInicio'),
				'horaFin' => $this->request->getPost('horaFin')
			];
		}


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
		// Función para mostrar el filtro mandado

		$resultFilter = $this->_folioDocModel->filterDatesDocumentos($data);

		$empleado = $this->_usuariosModel->asObject()->where('ID',	session('ID'))->orderBy('NOMBRE', 'ASC')->findAll();

		// if (isset($data['AGENTEATENCIONID'])) {
		// 	$agente = $this->_usuariosModel->asObject()->where('ID', $data['AGENTEATENCIONID'])->orderBy('NOMBRE', 'ASC')->first();
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
	/**
	 * Vista de documetnos abiertos para firmar
	 * Retorna toda la información de los documentos abiertos a firmar
	 * ! Deprecated method, do not use.
	 */
	public function documentos_abiertas()
	{
		$data = (object)array();
		// $data = $this->_folioDocModel->asObject()->where('STATUS', 'ABIERTO')->distinct('NUMEROEXPEDIENTE')->first();
		$data->documento = $this->_folioDocModel->get_folio_abierto();
		$data->rolPermiso = $this->_rolesPermisosModel->asObject()->where('ROLID', session('ROLID'))->findAll();

		$this->_loadView('Documentos abiertos', $data, 'documentos_abiertas');
	}
	/**
	 * Vista de documetnos firmados
	 * Retorna toda la información de los documentos firmados
	 * ! Deprecated method, do not use.
	 */
	public function documentos_firmados()
	{
		$data = (object)array();
		// $data = $this->_folioDocModel->asObject()->where('STATUS', 'ABIERTO')->distinct('NUMEROEXPEDIENTE')->first();
		// $data->documento = $this->_folioDocModel->get_folio_firmado();
		$data->documento = $this->_folioModel->get_folio_expediente();
		$data->rolPermiso = $this->_rolesPermisosModel->asObject()->where('ROLID', session('ROLID'))->findAll();

		$this->_loadView('Documentos abiertos', $data, 'documentos_firmados');
	}
	/**
	 * Vista para visisualizar todos los documentos del folio.
	 * Recibe por metodo GET el folio, expediente y el año
	 * * Carga toda la informacion para dar seguimiento a los documentos
	 *
	 */
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
		//Info de los documentos
		$data->documentos = $this->_folioDocModel->asObject()->where('NUMEROEXPEDIENTE', $data->expediente)->where('ANO', $data->year)->findAll();
		$data->rolPermiso = $this->_rolesPermisosModel->asObject()->where('ROLID', session('ROLID'))->findAll();
		$data->foliorow = $this->_folioModel->asObject()->where('FOLIOID', $data->folio)->where('ANO', $data->year)->findAll();
		//Agentes activos
		$data->empleados = $this->_usuariosModel->asObject()
			->select('USUARIOS.*, SESIONES.ACTIVO')
			->join('SESIONES', 'USUARIOS.ID= SESIONES.ID_USUARIO')
			->where('ROLID', 3)
			->where('ACTIVO', 1)
			->findAll();
		$data->plantillas = $this->_plantillasModel->asObject()->where('TITULO !=', 'CONSTANCIA DE EXTRAVÍO')->orderBy('TITULO', 'ASC')->findAll();
		$data->institucionremision = $this->_municipiosModel->asObject()->where('MUNICIPIOID', $data->foliorow[0]->INSTITUCIONREMISIONMUNICIPIOID)->where('ESTADOID', 2)->first();
		$data->municipioasignado = $this->_municipiosModel->asObject()->where('MUNICIPIOID', $data->foliorow[0]->MUNICIPIOASIGNADOID)->where('ESTADOID', 2)->first();
		//Encargados activos

		$data->encargados =
			$this->_usuariosModel->asObject()
			->select('USUARIOS.*, SESIONES.ACTIVO')
			->join('SESIONES', 'USUARIOS.ID= SESIONES.ID_USUARIO')
			->where('ROLID', 6)
			->where('ACTIVO', 1)
			->findAll();

		$data2 = [
			'header_data' => (object)['title' => 'DOCUMENTOS'],
			'body_data' => $data
		];
		echo view("admin/dashboard/documentos/documentos_generados", $data2);
	}

	/**
	 * Función para cargar todos los select y rellenar las tablas visuales.
	 * Recibe por metodo POST el expediente, folio y año.
	 */
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
	/**
	 * Función para obtener el placeholder de un documento en especifico y poder editarlo antes de firmar
	 * Recibe por metodo POST el folio, año y id del documento
	 * Devuelve todos los datos necesarios para la actualizacion de las tablas visuales.
	 *
	 */
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

	/**
	 * Vista para que los denunciantes visualicen la validación de su documento.
	 *
	 */
	public function validar_documento()
	{
		$year = date('Y');
		$expediente = $this->request->getGet('expediente');
		$year = $this->request->getGet('year');
		$foliodocid = $this->request->getGet('foliodoc');
		$folio = $this->request->getGet('folio');

		if ($expediente) {
			$documento = $this->_folioDocModel->asObject()->where('NUMEROEXPEDIENTE', base64_decode($expediente))->where('ANO', $year)->where('FOLIODOCID', base64_decode($foliodocid))->first();
		} else {
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
	/**
	 * Function para descargar el documento en formato PDF
	 * Recibe por metodo POST el folio, año y id del documento.
	 */
	public function download_documento_pdf()
	{
		$docid = trim($this->request->getPost('docid'));
		$folio = trim($this->request->getPost('folio'));
		$year = trim($this->request->getPost('year'));

		// Info del documento
		$documento = $this->_folioDocModel->asObject()->where('FOLIOID', $folio)->where('ANO', $year)->where('FOLIODOCID', $docid)->first();

		$filename = urlencode($documento->TIPODOC . "_" . $folio . "_" . $year . '.pdf');
		header("Content-type: application/pdf");
		header('Content-Disposition: attachment; filename="' . $filename . '"');
		header('Content-Length: ' . strlen($documento->PDF));
		header('Expires: 0');
		header('Cache-Control: must-revalidate');
		header('Pragma: public');

		$fp = fopen('php://memory', 'r+');
		fwrite($fp, $documento->PDF);
		rewind($fp);
		fpassthru($fp);
		fclose($fp);
		exit();
		// echo $documento->PDF;
	}
	/**
	 * Function para descargar el documento en formato XML
	 * Recibe por metodo POST el folio, año y id del documento.
	 */
	public function download_documento_xml()
	{
		$docid = trim($this->request->getPost('docid'));
		$folio = trim($this->request->getPost('folio'));
		$year = trim($this->request->getPost('year'));
		// Info del documento
		$documento = $this->_folioDocModel->asObject()->where('FOLIOID', $folio)->where('ANO', $year)->where('FOLIODOCID', $docid)->first();

		$filename = urlencode($documento->TIPODOC . "_" . $folio . "_" . $year . ".xml");
		header("Content-type: application/xml");
		header("Content-Disposition: attachment; filename=\"$filename\"");
		header('Content-Length: ' . strlen($documento->XML));
		header('Expires: 0');
		header('Cache-Control: must-revalidate');
		header('Pragma: public');

		$fp = fopen('php://memory', 'r+');
		fwrite($fp, $documento->XML);
		rewind($fp);
		fpassthru($fp);
		fclose($fp);
		exit();
		// echo $documento->XML;
	}
	/**
	 * Function para borrar el documento del folio a traves de su id
	 * Recibe por metodo POST el folio, año y id del documento.
	 * Devuelve todos los datos necesarios para la actualizacion de las tablas visuales.

	 */
	public function borrarDocumento()
	{
		$docid = trim($this->request->getPost('docid'));
		$folio = trim($this->request->getPost('folio'));
		$year = trim($this->request->getPost('year'));

		// $data->documento = $this->_folioDocModel->where('FOLIOID', $folio)->where('ANO', $year)->where('FOLIODOCID', $docid)->first();
		// $data->documento = $this->_folioDocModel->delete_doc_by_folio($folio, $year, $docid);
		$deleteDoc = $this->_folioDocModel->where('FOLIOID', $folio)->where('ANO', $year)->where('FOLIODOCID', $docid)->delete();

		$documentos = $this->_folioDocModel->get_by_folio($folio, $year);

		if ($deleteDoc) {
			$datosBitacora = [
				'ACCION' => 'Ha borrado un documento',
				'NOTAS' => 'FOLIO: ' . $folio . ' AÑO: ' . $year . ' PLANTILLAID: ' .  $docid,
			];
			$this->_bitacoraActividad($datosBitacora);
			return json_encode((object)['status' => 1, 'documentos' => $documentos]);;
		} else {
			return json_encode(['status' => 0]);
		}
	}
	/**
	 * Function para asignar un documento a un agente en especifico para su firma
	 * Recibe por metodo POST el folio, año , id del documento y agente asignado.
	 * Devuelve todos los datos necesarios para la actualizacion de las tablas visuales.
	 */
	public function actualizarDocumentoAgenteAsignado()
	{
		$docid = trim($this->request->getPost('foliodocid'));
		$folio = trim($this->request->getPost('folio'));
		$year = trim($this->request->getPost('year'));
		$agenteid = trim($this->request->getPost('agenteid'));
		// Info a actualizar
		$dataAgente = array(
			'AGENTE_ASIGNADO' => $agenteid,
		);

		$updateDoc = $this->_folioDocModel->set($dataAgente)->where('FOLIOID', $folio)->where('ANO', $year)->where('FOLIODOCID', $docid)->update();

		$documentos = $this->_folioDocModel->get_by_folio($folio, $year);

		if ($updateDoc) {
			return json_encode((object)['status' => 1, 'documentos' => $documentos]);;
		} else {
			return json_encode(['status' => 0]);
		}
	}
	/**
	 * Function para asignar un documento a un encargado en especifico para su firma
	 * Recibe por metodo POST el folio, año , id del documento y agente asignado.
	 * Devuelve todos los datos necesarios para la actualizacion de las tablas visuales.
	 */
	public function actualizarDocumentoEncargado()
	{
		$docid = trim($this->request->getPost('foliodocid'));
		$folio = trim($this->request->getPost('folio'));
		$year = trim($this->request->getPost('year'));
		$encargadoid = trim($this->request->getPost('encargadoid'));
		$dataEncargado = array(
			'ENCARGADO_ASIGNADO' => $encargadoid,
		);

		$updateDoc = $this->_folioDocModel->set($dataEncargado)->where('FOLIOID', $folio)->where('ANO', $year)->where('FOLIODOCID', $docid)->update();

		$documentos = $this->_folioDocModel->get_by_folio($folio, $year);

		if ($updateDoc) {
			return json_encode((object)['status' => 1, 'documentos' => $documentos]);;
		} else {
			return json_encode(['status' => 0]);
		}
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

		echo view("admin/dashboard/wyswyg/$view", $data);
	}

	/**
	 * Función para revisar los permisos que tienen los usuarios y poder restringir el acceso
	 *
	 * @param  mixed $permiso
	 */
	private function permisos($permiso)
	{
		return in_array($permiso, session('permisos'));
	}
	/**
	 * Función para agregar información a la bitacora diaria.
	 *
	 * @param  mixed $data
	 */
	private function _bitacoraActividad($data)
	{
		$data = $data;
		$data['ID'] = uniqid();
		$data['USUARIOID'] = session('ID');

		if ($data['USUARIOID']) {
			$this->_bitacoraActividadModel->insert($data);
		}
	}
}
