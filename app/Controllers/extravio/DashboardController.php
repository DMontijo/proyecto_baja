<?php

namespace App\Controllers\extravio;

use App\Controllers\BaseController;
use App\Models\ConstanciaExtravioModel;

class DashboardController extends BaseController
{

	private $db_read;

	private $_constanciaExtravioModel;
	private $_estadosModelRead;
	private $_municipiosModelRead;
	private $_hechoLugarModelRead;
	private $_denunciantesModelRead;
	private $_documentosExtravioTipoModelRead;
	private $_constanciaExtravioModelRead;
	private $_constanciaExtravioConsecutivoModelRead;


	public function __construct()
	{
		$this->db_read = ENVIRONMENT == 'production' ? db_connect('default_read') : db_connect('development_read');

		//Models

		$this->_constanciaExtravioModel = new ConstanciaExtravioModel();


		$this->_hechoLugarModelRead = model('HechoLugarModel', true, $this->db_read);
		$this->_estadosModelRead = model('EstadosModel', true, $this->db_read);
		$this->_municipiosModelRead = model('MunicipiosModel', true, $this->db_read);
		$this->_denunciantesModelRead = model('DenunciantesModel', true, $this->db_read);
		$this->_documentosExtravioTipoModelRead = model('DocumentosExtravioTipoModel', true, $this->db_read);
		$this->_constanciaExtravioModelRead = model('ConstanciaExtravioModel', true, $this->db_read);
		$this->_constanciaExtravioConsecutivoModelRead = model('ConstanciaExtravioConsecutivoModel', true, $this->db_read);
	}

	/**
	 * Vista para generar constancias de extravio.
	 * Carga todos los catalogos para su funcionamiento
	 *
	 */
	public function index()
	{
		$data = (object) array();
		$data->estados = $this->_estadosModelRead->asObject()->findAll();
		$data->municipios = $this->_municipiosModelRead->asObject()->where('ESTADOID', '2')->findAll();
		$data->lugares = $this->_hechoLugarModelRead->asObject()->orderBy('HECHODESCR', 'asc')->findAll();
		$data->identificacion = $this->_documentosExtravioTipoModelRead->asObject()->orderBy('DOCUMENTOEXTRAVIOTIPODESCR', 'asc')->where('VISIBLE', '1')->findAll();
		$data->denunciante = $this->_denunciantesModelRead->asObject()->where('DENUNCIANTEID', session('DENUNCIANTEID'))->first();
		$this->_loadView('Generar constancias', $data, 'index');
	}

	/**
	 * Funcion para crear una constancia de extravio
	 * Recibe por metodo POST los datos del formulario
	 *
	 */
	public function solicitar_constancia()
	{
		//Datos del formulario
		$data = [
			'DENUNCIANTEID' => session('DENUNCIANTEID'),

			'EXTRAVIO' => $this->request->getPost('extravio'),

			'ESTADOID' => 2,
			'MUNICIPIOID' => $this->request->getPost('municipio'),
			'MUNICIPIOIDCITA' => $this->request->getPost('municipio_cita'),
			'DOMICILIO' => $this->request->getPost('domicilio'),
			'HECHOLUGARID' => $this->request->getPost('lugar'),
			'HECHOFECHA' => $this->request->getPost('fecha'),

			'NBOLETO' => $this->request->getPost('noboletos'),
			'NTALON' => $this->request->getPost('notalon'),
			'NOMBRESORTEO' => $this->request->getPost('nombreSorteo'),
			'SORTEOFECHA' => empty($this->request->getPost('fechaSorteo')) ? null : $this->request->getPost('fechaSorteo'),
			'PERMISOGOBERNACION' => $this->request->getPost('permisoGobernacion'),
			'PERMISOGOBCOLABORADORES' => $this->request->getPost('permisoGColaboradores'),

			'TIPODOCUMENTO' => $this->request->getPost('tipodoc'),
			'NDOCUMENTO' => $this->request->getPost('nodocumento'),
			'DUENONOMBREDOC' => $this->request->getPost('duenonamedoc') ? $this->request->getPost('duenonamedoc') : null,
			'DUENOAPELLIDOPDOC' => $this->request->getPost('duenoapdoc') ? $this->request->getPost('duenoapdoc') : null,
			'DUENOAPELLIDOMDOC' => $this->request->getPost('duenoamdoc') ? $this->request->getPost('duenoamdoc') : null,
			'DUENOFECHANACIMIENTODOC' => empty($this->request->getPost('fecha_duenodoc')) ? null : $this->request->getPost('fecha_duenodoc'),

			'SERIEVEHICULO' => $this->request->getPost('serieV'),
			'NPLACA' => $this->request->getPost('noplaca'),
			'POSICIONPLACA' => $this->request->getPost('posicionPlaca'),
			'DISTRIBUIDORVEHICULO' => $this->request->getPost('distribuidor'),
			'MARCA' => $this->request->getPost('marca'),
			'MODELO' => $this->request->getPost('modelo'),
			'ANIOVEHICULO' => $this->request->getPost('anio'),
			'STATUS' => 'ABIERTO',
		];

		//Validacion cuando existen constancias del mismo tipo
		if (isset($data['EXTRAVIO']) && $data['EXTRAVIO'] == 'DOCUMENTOS' || $data['EXTRAVIO'] == 'BOLETOS DE SORTEO') {
			$constancias_abiertas = $this->_constanciaExtravioModelRead->asObject()->where('DENUNCIANTEID', session('DENUNCIANTEID'))->where('TIPODOCUMENTO', $data['TIPODOCUMENTO'])->where('STATUS', 'ABIERTO')->findAll();
			$constancias_proceso = $this->_constanciaExtravioModelRead->asObject()->where('DENUNCIANTEID', session('DENUNCIANTEID'))->where('TIPODOCUMENTO', $data['TIPODOCUMENTO'])->where('STATUS', 'EN PROCESO')->findAll();
			$constancias = (object) array_merge($constancias_abiertas, $constancias_proceso);
			if (isset($constancias) && $constancias) {
				foreach ($constancias as $key => $constancia) {
					if ($constancia->DUENONOMBREDOC == $data['DUENONOMBREDOC'] && $constancia->DUENOAPELLIDOPDOC == $data['DUENOAPELLIDOPDOC'] && $constancia->DUENOAPELLIDOMDOC == $data['DUENOAPELLIDOMDOC'] && $constancia->DUENOFECHANACIMIENTODOC == $data['DUENOFECHANACIMIENTODOC']) {
						return redirect()->to(base_url('/constancia_extravio/dashboard'))->with('message_warning', 'Ya existe una solicitud de "' . $data['TIPODOCUMENTO'] . '" con la misma información.');
					};
				}
			}
		}

		//Inserción de la constancia de extravio
		list($CONSECUTIVO, $year) = $this->_constanciaExtravioConsecutivoModelRead->get_consecutivo();
		$data['CONSTANCIAEXTRAVIOID'] = $CONSECUTIVO;
		$data['ANO'] = $year;
		if ($this->_constanciaExtravioModel->save($data)) {
			return redirect()->to(base_url('/constancia_extravio/dashboard'))->with('message_success', 'Se ha enviado la solicitud de constancia de extravío.');
		} else {
			return redirect()->back()->with('message_error', 'Hubo un error en los datos y no se guardo, intentalo de nuevo.');
		}
	}

	/**
	 * Vista para el listado de Mis constancias de acuerdo al denunciante en la sesion
	 *
	 */
	public function constancias()
	{
		$data = (object) array();
		$data->constancias = $this->_constanciaExtravioModelRead->asObject()->select('CONSTANCIAEXTRAVIOID,ANO,EXTRAVIO,TIPODOCUMENTO,STATUS')->where('DENUNCIANTEID', session('DENUNCIANTEID'))->orderBy('ANO', 'desc')->orderBy('CONSTANCIAEXTRAVIOID', 'desc')->findAll();
		$this->_loadView('Mis constancias de extravío', $data, 'lista_constancias');
	}

	/**
	 * Vista para cargar cuando la constancia sea firmada y el denunciante se asegure que es valido
	 *
	 */
	public function validar_constancia()
	{
		$year = date('Y');
		$folio = $this->request->getGet('folio');
		$year = $this->request->getGet('year');
		$constancia = $this->_constanciaExtravioModelRead->asObject()->where('CONSTANCIAEXTRAVIOID', base64_decode($folio))->where('ANO', $year)->first();
		if ($constancia) {
			$solicitante = $this->_denunciantesModelRead->asObject()->where('DENUNCIANTEID', $constancia->DENUNCIANTEID)->first();
			$constancia->NOMBRESOLICITANTE = $solicitante->NOMBRE . ' ' . $solicitante->APELLIDO_PATERNO . ' ' . $solicitante->APELLIDO_MATERNO;
		}
		$data2 = [
			'header_data' => (object) ['title' => 'Validar constancia', 'menu' => 'constancia realizada', 'submenu' => ''],
			'body_data' => (object) ['constancia' => $constancia],
		];
		echo view("constancia_extravio/dashboard/validar_constancia", $data2);
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
			'header_data' => (object) ['title' => $title],
			'body_data' => $data,
		];
		echo view("constancia_extravio/dashboard/$view", $data);
	}

	/**
	 * Función para que el denunciante descargue en formato PDF su constancia
	 * Recibe por metodo POST el folio y año de la constancia
	 *
	 */
	public function download_constancia_pdf()
	{
		$folio = $this->request->getPost('folio');
		$year = $this->request->getPost('year');

		$constancia = $this->_constanciaExtravioModelRead->asObject()->where('CONSTANCIAEXTRAVIOID', $folio)->where('ANO', $year)->first();
		$filename = urlencode("Constancia_" . $folio . '_' . $year . '.pdf');
		header("Content-type: application/pdf");
		header("Content-Disposition: attachment; filename=\"$filename\"");
		header('Content-Length: ' . strlen($constancia->PDF));
		header('Expires: 0');
		header('Cache-Control: must-revalidate');
		header('Pragma: public');

		$fp = fopen('php://memory', 'r+');
		fwrite($fp, $constancia->PDF);
		rewind($fp);
		fpassthru($fp);
		fclose($fp);
		exit();
		// echo $constancia->PDF;
	}
	/**
	 * Función para que el denunciante descargue en formato XML su constancia
	 * Recibe por metodo POST el folio y año de la constancia
	 *
	 */
	public function download_constancia_xml()
	{
		$folio = $this->request->getPost('folio');
		$year = $this->request->getPost('year');

		$constancia = $this->_constanciaExtravioModelRead->asObject()->where('CONSTANCIAEXTRAVIOID', $folio)->where('ANO', $year)->first();
		$filename = urlencode("Constancia_" . $folio . '_' . $year . '.xml');
		header("Content-type: application/xml");
		header("Content-Disposition: attachment; filename=\"$filename\"");
		header('Content-Length: ' . strlen($constancia->XML));
		header('Expires: 0');
		header('Cache-Control: must-revalidate');
		header('Pragma: public');

		$fp = fopen('php://memory', 'r+');
		fwrite($fp, $constancia->XML);
		rewind($fp);
		fpassthru($fp);
		fclose($fp);
		exit();
		// echo $constancia->XML;
	}
}

/* End of file DashboardController.php */
/* Location: ./app/Controllers/extravio/DashboardController.php */
