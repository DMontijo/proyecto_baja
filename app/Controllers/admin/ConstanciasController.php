<?php

namespace App\Controllers\admin;

use App\Controllers\BaseController;

use App\Models\UsuariosModel;
use App\Models\ZonasUsuariosModel;
use App\Models\RolesUsuariosModel;
use App\Models\ConstanciaExtravioModel;
use App\Models\DenunciantesModel;
use App\Models\PlantillasModel;
use App\Models\HechoLugarModel;
use App\Models\MunicipiosModel;
use App\Models\EstadosModel;
use App\Models\RolesPermisosModel;

class ConstanciasController extends BaseController
{
	private $_constanciaExtravioModel;
	private $_plantillasModel;
	private $_denunciantesModel;
	private $_hechoLugarModel;
	private $_municipiosModel;
	private $_estadosModel;
	private $_rolesPermisosModel;

	function __construct()
	{
		//Models
		$this->_constanciaExtravioModel = new ConstanciaExtravioModel();

		$this->_plantillasModel = new PlantillasModel();
		$this->_denunciantesModel = new DenunciantesModel();
		$this->_hechoLugarModel = new HechoLugarModel();
		$this->_municipiosModel = new MunicipiosModel();
		$this->_estadosModel = new EstadosModel();
		$this->_rolesPermisosModel = new RolesPermisosModel();
	}

	public function index()
	{
		if (!$this->permisos('CONSTANCIAS DE EXTRAVIOS')) {
			return redirect()->back()->with('message_error', 'Acceso denegado, no tienes los permisos necesarios.');
		}
		$data = (object)array();
		$data->abiertas = $this->_constanciaExtravioModel->asObject()->where('STATUS', 'ABIERTO')->countAllResults();
		$data->proceso = $this->_constanciaExtravioModel->asObject()->where('STATUS', 'EN PROCESO')->countAllResults();
		$data->firmadas = $this->_constanciaExtravioModel->asObject()->where('STATUS', 'FIRMADO')->where('FECHAACTUALIZACION BETWEEN "' . date('Y-m-d') . ' 00:00:00' . '" and "' . date('Y-m-d', strtotime("+ 1 day")) . ' 00:00:00' . '"')->countAllResults();
		$data->rolPermiso = $this->_rolesPermisosModel->asObject()->where('ROLID', session('ROLID'))->findAll();

		$this->_loadView('Constancias extravío', 'constancias', '', $data, 'index');
	}

	public function constancias_abiertas()
	{
		if (!$this->permisos('CONSTANCIAS DE EXTRAVIOS')) {
			return redirect()->back()->with('message_error', 'Acceso denegado, no tienes los permisos necesarios.');
		}
		$data = (object)array();
		$data->constancia = $this->_constanciaExtravioModel
			->asObject()
			->select(
				'CONSTANCIAEXTRAVIO.CONSTANCIAEXTRAVIOID,
				CONSTANCIAEXTRAVIO.ANO,
				CONSTANCIAEXTRAVIO.FECHAFIRMA,
				CONSTANCIAEXTRAVIO.HORAFIRMA,
				CONSTANCIAEXTRAVIO.LUGARFIRMA,
				CONSTANCIAEXTRAVIO.EXTRAVIO,
				CONSTANCIAEXTRAVIO.TIPODOCUMENTO,
				CONSTANCIAEXTRAVIO.RAZONSOCIALFIRMA,
				CONSTANCIAEXTRAVIO.STATUS,
				CONSTANCIAEXTRAVIO.FECHAACTUALIZACION,
								CONCAT(EXTRACT(DAY FROM CONSTANCIAEXTRAVIO.FECHAREGISTRO),"-",EXTRACT(MONTH FROM CONSTANCIAEXTRAVIO.FECHAREGISTRO),"-",EXTRACT(YEAR FROM CONSTANCIAEXTRAVIO.FECHAREGISTRO)) AS FECHA,
								TIME(CONSTANCIAEXTRAVIO.FECHAREGISTRO) AS HORA,
								CONCAT (DENUNCIANTES.NOMBRE," ",DENUNCIANTES.APELLIDO_PATERNO," ",DENUNCIANTES.APELLIDO_MATERNO) AS NOMBRE,
								DENUNCIANTES.CORREO,
								DENUNCIANTES.TELEFONO'
			)
			->join('DENUNCIANTES', 'DENUNCIANTES.DENUNCIANTEID = CONSTANCIAEXTRAVIO.DENUNCIANTEID')
			->where('STATUS', 'ABIERTO')
			->orderBy('CONSTANCIAEXTRAVIO.FECHAREGISTRO', 'ASC')
			->findAll();
		$data->rolPermiso = $this->_rolesPermisosModel->asObject()->where('ROLID', session('ROLID'))->findAll();

		$this->_loadView('Constancias extravío abiertas', 'constancias', '', $data, 'constancias_abiertas');
	}

	public function getAllConstanciasAbiertas()
	{
		$data = $this->_constanciaExtravioModel
			->asObject()
			->select(
				'CONSTANCIAEXTRAVIO.CONSTANCIAEXTRAVIOID,
				CONSTANCIAEXTRAVIO.ANO,
				CONSTANCIAEXTRAVIO.FECHAFIRMA,
				CONSTANCIAEXTRAVIO.HORAFIRMA,
				CONSTANCIAEXTRAVIO.LUGARFIRMA,
				CONSTANCIAEXTRAVIO.EXTRAVIO,
				CONSTANCIAEXTRAVIO.TIPODOCUMENTO,
				CONSTANCIAEXTRAVIO.RAZONSOCIALFIRMA,
				CONSTANCIAEXTRAVIO.STATUS,
				CONSTANCIAEXTRAVIO.FECHAACTUALIZACION,
								CONCAT(EXTRACT(DAY FROM CONSTANCIAEXTRAVIO.FECHAREGISTRO),"-",EXTRACT(MONTH FROM CONSTANCIAEXTRAVIO.FECHAREGISTRO),"-",EXTRACT(YEAR FROM CONSTANCIAEXTRAVIO.FECHAREGISTRO)) AS FECHA,
								TIME(CONSTANCIAEXTRAVIO.FECHAREGISTRO) AS HORA,
								CONCAT (DENUNCIANTES.NOMBRE," ",DENUNCIANTES.APELLIDO_PATERNO," ",DENUNCIANTES.APELLIDO_MATERNO) AS NOMBRE,
								DENUNCIANTES.CORREO,
								DENUNCIANTES.TELEFONO'
			)
			->join('DENUNCIANTES', 'DENUNCIANTES.DENUNCIANTEID = CONSTANCIAEXTRAVIO.DENUNCIANTEID')
			->where('STATUS', 'ABIERTO')
			->orderBy('CONSTANCIAEXTRAVIO.FECHAREGISTRO', 'ASC')
			->findAll();
		return json_encode($data);
	}

	public function constancias_proceso()
	{
		if (!$this->permisos('CONSTANCIAS DE EXTRAVIOS')) {
			return redirect()->back()->with('message_error', 'Acceso denegado, no tienes los permisos necesarios.');
		}
		$data = (object)array();
		$data->constancia = $this->_constanciaExtravioModel
			->asObject()
			->select(
				'CONSTANCIAEXTRAVIO.CONSTANCIAEXTRAVIOID,
				CONSTANCIAEXTRAVIO.ANO,
				CONSTANCIAEXTRAVIO.FECHAFIRMA,
				CONSTANCIAEXTRAVIO.HORAFIRMA,
				CONSTANCIAEXTRAVIO.LUGARFIRMA,
				CONSTANCIAEXTRAVIO.EXTRAVIO,
				CONSTANCIAEXTRAVIO.TIPODOCUMENTO,
				CONSTANCIAEXTRAVIO.RAZONSOCIALFIRMA,
				CONSTANCIAEXTRAVIO.STATUS,
				CONSTANCIAEXTRAVIO.FECHAACTUALIZACION,
								CONCAT(EXTRACT(DAY FROM CONSTANCIAEXTRAVIO.FECHAREGISTRO),"-",EXTRACT(MONTH FROM CONSTANCIAEXTRAVIO.FECHAREGISTRO),"-",EXTRACT(YEAR FROM CONSTANCIAEXTRAVIO.FECHAREGISTRO)) AS FECHA,
								TIME(CONSTANCIAEXTRAVIO.FECHAREGISTRO) AS HORA,
								CONCAT (DENUNCIANTES.NOMBRE," ",DENUNCIANTES.APELLIDO_PATERNO," ",DENUNCIANTES.APELLIDO_MATERNO) AS NOMBRE,
								DENUNCIANTES.CORREO,
								DENUNCIANTES.TELEFONO'
			)
			->join('DENUNCIANTES', 'DENUNCIANTES.DENUNCIANTEID = CONSTANCIAEXTRAVIO.DENUNCIANTEID')
			->where('STATUS', 'EN PROCESO')
			->orderBy('CONSTANCIAEXTRAVIO.FECHAREGISTRO', 'ASC')
			->findAll();
		$data->rolPermiso = $this->_rolesPermisosModel->asObject()->where('ROLID', session('ROLID'))->findAll();

		$this->_loadView('Constancias extravío en proceso', 'constancias', '', $data, 'constancias_proceso');
	}

	public function constancias_firmadas()
	{
		if (!$this->permisos('CONSTANCIAS DE EXTRAVIOS')) {
			return redirect()->back()->with('message_error', 'Acceso denegado, no tienes los permisos necesarios.');
		}
		$data = (object)array();
		$data->constancia = $this->_constanciaExtravioModel
			->asObject()
			->select(
				'CONSTANCIAEXTRAVIO.CONSTANCIAEXTRAVIOID,
				CONSTANCIAEXTRAVIO.ANO,
				CONSTANCIAEXTRAVIO.FECHAFIRMA,
				CONSTANCIAEXTRAVIO.HORAFIRMA,
				CONSTANCIAEXTRAVIO.LUGARFIRMA,
				CONSTANCIAEXTRAVIO.EXTRAVIO,
				CONSTANCIAEXTRAVIO.TIPODOCUMENTO,
				CONSTANCIAEXTRAVIO.RAZONSOCIALFIRMA,
				CONSTANCIAEXTRAVIO.STATUS,
				CONSTANCIAEXTRAVIO.FECHAACTUALIZACION,
					CONCAT(EXTRACT(DAY FROM CONSTANCIAEXTRAVIO.FECHAREGISTRO),"-",EXTRACT(MONTH FROM CONSTANCIAEXTRAVIO.FECHAREGISTRO),"-",EXTRACT(YEAR FROM CONSTANCIAEXTRAVIO.FECHAREGISTRO)) AS FECHA,
					TIME(CONSTANCIAEXTRAVIO.FECHAREGISTRO) AS HORA,
					CONCAT (DENUNCIANTES.NOMBRE," ",DENUNCIANTES.APELLIDO_PATERNO," ",DENUNCIANTES.APELLIDO_MATERNO) AS NOMBRE,
					DENUNCIANTES.CORREO,
					DENUNCIANTES.TELEFONO'
			)
			->join('DENUNCIANTES', 'DENUNCIANTES.DENUNCIANTEID = CONSTANCIAEXTRAVIO.DENUNCIANTEID')
			->where('STATUS', 'FIRMADO')
			->where('CONSTANCIAEXTRAVIO.FECHAACTUALIZACION BETWEEN "' . date('Y-m-d') . ' 00:00:00' . '" and "' . date('Y-m-d', strtotime("+ 1 day")) . ' 00:00:00' . '"')
			->orderBy('CONSTANCIAEXTRAVIO.FECHAFIRMA', 'DESC')
			->findAll();
		$data->rolPermiso = $this->_rolesPermisosModel->asObject()->where('ROLID', session('ROLID'))->findAll();

		$this->_loadView('Constancias extravío firmadas', 'constancias', '', $data, 'constancias_firmadas');
	}

	public function constancia_extravio_liberar()
	{
		if (!$this->permisos('CONSTANCIAS DE EXTRAVIOS')) {
			return redirect()->back()->with('message_error', 'Acceso denegado, no tienes los permisos necesarios.');
		}

		$folio = $this->request->getPost('folio');
		$year = $this->request->getPost('year');
		if (!$this->request->getPost('folio') || !$this->request->getPost('year')) {
			return redirect()->back()->with('message_error', 'La constancia no existe o no enviaste todos los parámetros.');
		}

		$constancia = $this->_constanciaExtravioModel->asObject()->where('CONSTANCIAEXTRAVIOID', $folio)->where('ANO', $year)->first();
		if (!$constancia) {
			return redirect()->back()->with('message_error', 'Constancia no liberada.');
		}
		$update = $this->_constanciaExtravioModel->set(['STATUS' => 'ABIERTO'])->where('CONSTANCIAEXTRAVIOID', $folio)->where('ANO', $year)->where('STATUS', 'EN PROCESO')->update();
		if ($update) {
			return redirect()->back()->with('message_success', 'Constancia liberada con éxito.');
		}
		return redirect()->back()->with('message_error', 'Constancia no liberada.');
	}

	public function constancia_extravio_show()
	{
		if (!$this->permisos('CONSTANCIAS DE EXTRAVIOS')) {
			return redirect()->back()->with('message_error', 'Acceso denegado, no tienes los permisos necesarios.');
		}
		$data = (object)array();
		$data->folio = $this->request->getGet('folio');
		$data->year = $this->request->getGet('year');
		$year = $this->request->getGet('year');

		if (!$this->request->getGet('folio') || !$this->request->getGet('year')) {
			return redirect()->back()->with('message_error', 'La constancia no existe o no enviaste todos los parámetros.');
		}

		$constancia = $this->_constanciaExtravioModel->asObject()->where('CONSTANCIAEXTRAVIOID', $data->folio)->where('ANO', $year)->first();
		$constancia_update = $this->_constanciaExtravioModel->set(['STATUS' => 'EN PROCESO'])->where('CONSTANCIAEXTRAVIOID', $data->folio)->where('ANO', $year)->update();

		if (!$constancia) {
			return redirect()->back()->with('message_error', 'La constancia no existe.');
		}

		$data->constanciaExtravio = $this->_plantillasModel->asObject()->where('TITULO', 'CONSTANCIA DE EXTRAVIO')->first();
		$data->rolPermiso = $this->_rolesPermisosModel->asObject()->where('ROLID', session('ROLID'))->findAll();

		$solicitante = $this->_denunciantesModel->asObject()->where('DENUNCIANTEID ', $constancia->DENUNCIANTEID)->first();
		$lugar = $this->_hechoLugarModel->asObject()->where('HECHOLUGARID', $constancia->HECHOLUGARID)->first();
		$municipio = (object)[];
		if ($constancia->MUNICIPIOIDCITA) {
			$municipio = $this->_municipiosModel->asObject()->where('MUNICIPIOID', $constancia->MUNICIPIOIDCITA)->where('ESTADOID', $constancia->ESTADOID)->first();
		} else {
			$municipio = $this->_municipiosModel->asObject()->where('MUNICIPIOID', $constancia->MUNICIPIOID)->where('ESTADOID', $constancia->ESTADOID)->first();
		}
		$estado = $this->_estadosModel->asObject()->where('ESTADOID', $constancia->ESTADOID)->first();
		$meses = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");

		$timestamp = strtotime($constancia->HECHOFECHA);
		$dia_extravio = date('d', $timestamp);
		$mes_extravio = $meses[date('n') - 1];
		$ano_extravio = date('Y', $timestamp);

		$data->constanciaExtravio->PLACEHOLDER = str_replace('[FOLIO_NUMERO]', $constancia->CONSTANCIAEXTRAVIOID, $data->constanciaExtravio->PLACEHOLDER);
		$data->constanciaExtravio->PLACEHOLDER = str_replace('[DOMICILIO_COMPARECIENTE]', $constancia->DOMICILIO, $data->constanciaExtravio->PLACEHOLDER);
		$data->constanciaExtravio->PLACEHOLDER = str_replace('[NOMBRE_COMPARECIENTE]', $solicitante->NOMBRE . " " . $solicitante->APELLIDO_PATERNO . " " . $solicitante->APELLIDO_MATERNO, $data->constanciaExtravio->PLACEHOLDER);
		if ($constancia->DUENONOMBREDOC) {
			$data->constanciaExtravio->PLACEHOLDER = str_replace('[NOMBRE_DUENO]', $constancia->DUENONOMBREDOC . " " . $constancia->DUENOAPELLIDOPDOC . " " . $constancia->DUENOAPELLIDOMDOC, $data->constanciaExtravio->PLACEHOLDER);
		} else {
			$data->constanciaExtravio->PLACEHOLDER = str_replace('[NOMBRE_DUENO]', $solicitante->NOMBRE . " " . $solicitante->APELLIDO_PATERNO . " " . $solicitante->APELLIDO_MATERNO, $data->constanciaExtravio->PLACEHOLDER);
		}
		$data->constanciaExtravio->PLACEHOLDER = str_replace('[LUGAR_EXTRAVIO]', $lugar->HECHODESCR, $data->constanciaExtravio->PLACEHOLDER);
		$data->constanciaExtravio->PLACEHOLDER = str_replace('[NOMBRE_CIUDAD]', $municipio->MUNICIPIODESCR . ", " . $estado->ESTADODESCR, $data->constanciaExtravio->PLACEHOLDER);
		$data->constanciaExtravio->PLACEHOLDER = str_replace('[FECHA_EXTRAVIO]', $dia_extravio . '/' . strtoupper($mes_extravio) . '/' . $ano_extravio, $data->constanciaExtravio->PLACEHOLDER);
		$data->constanciaExtravio->PLACEHOLDER = str_replace('[DIA]', date('d'), $data->constanciaExtravio->PLACEHOLDER);
		$data->constanciaExtravio->PLACEHOLDER = str_replace('[MES]', strtoupper($meses[date('m') - 1]), $data->constanciaExtravio->PLACEHOLDER);
		$data->constanciaExtravio->PLACEHOLDER = str_replace('[ANIO_FIRMA]', strtoupper(date('Y')), $data->constanciaExtravio->PLACEHOLDER);
		$data->constanciaExtravio->PLACEHOLDER = str_replace('[ANIO]', $year, $data->constanciaExtravio->PLACEHOLDER);
		$data->constanciaExtravio->PLACEHOLDER = str_replace('[HORA]', date('H:i'), $data->constanciaExtravio->PLACEHOLDER);

		switch ($constancia->EXTRAVIO) {
			case 'BOLETOS DE SORTEO':
				$data->constanciaExtravio->PLACEHOLDER = str_replace('[NOMBRE_CERTIFICADO]', 'BOLETOS', $data->constanciaExtravio->PLACEHOLDER);

				$timestamp_sorteo = strtotime($constancia->SORTEOFECHA);
				$dia_sorteo = date('d', $timestamp_sorteo);
				$ano_sorteo = date('Y', $timestamp_sorteo);
				$mes_sorteo = $meses[date('n') - 1];

				$descr = 'EXTRAVÍO DE BOLETO CON NÚMERO: [NBOLETO] Y TALÓN CON NÚMERO: [NTALON] DEL SORTEO: [NOMBRESORTEO] A CELEBRARSE EL DÍA: [SORTEOFECHA], CON PERMISO DE GOBERNACIÓN: [PERMISOGOBERNACION], Y PERMISO DE GOBERNACIÓN DE COLABORADORES: [PERMISOGOBCOLABORADORES].';
				$descr = str_replace('[NBOLETO]', $constancia->NBOLETO, $descr);
				$descr = str_replace('[NTALON]', $constancia->NTALON, $descr);
				$descr = str_replace('[NOMBRESORTEO]', $constancia->NOMBRESORTEO, $descr);
				$descr = str_replace('[PERMISOGOBERNACION]', $constancia->PERMISOGOBERNACION, $descr);
				$descr = str_replace('[PERMISOGOBCOLABORADORES]', $constancia->PERMISOGOBCOLABORADORES, $descr);
				$descr = str_replace('[SORTEOFECHA]', $dia_sorteo . '/' . strtoupper($mes_sorteo) . '/' . $ano_sorteo, $descr);
				$data->constanciaExtravio->PLACEHOLDER = str_replace('[DESCRIPCION_EXTRAVIO]', $descr, $data->constanciaExtravio->PLACEHOLDER);
				$data->constanciaExtravio->PLACEHOLDER = str_replace('[NO_DOCUMENTO]', $constancia->NBOLETO, $data->constanciaExtravio->PLACEHOLDER);
				break;
			case 'PLACAS':
				$perdido = '';
				if ($constancia->POSICIONPLACA == 'PLACA DELANTERA' || $constancia->POSICIONPLACA == 'PLACA TRASERA') {
					$perdido = $constancia->POSICIONPLACA;
					$ext = $constancia->POSICIONPLACA . '  FEDERAL';
				} else {
					$perdido = 'PLACAS';
					$ext = $constancia->POSICIONPLACA . '  FEDERALES';
				}
				$descr = 'EXTRAVÍO DE: [POSICIONPLACA]<br>NÚMERO: [NPLACA]<br><br>RESPECTO DE UN VEHÍCULO:<br>MARCA:[MARCA]<br>LINEA: [MODELO]<br>MODELO: [ANIOVEHICULO]<br>NÚMERO DE SERIE: [SERIEVEHICULO]';
				$descr = str_replace('[POSICIONPLACA]', $ext, $descr);
				$descr = str_replace('[NPLACA]', $constancia->NPLACA, $descr);
				$descr = str_replace('[MARCA]', $constancia->MARCA, $descr);
				$descr = str_replace('[MODELO]', $constancia->MODELO, $descr);
				$descr = str_replace('[ANIOVEHICULO]', $constancia->ANIOVEHICULO, $descr);
				$descr = str_replace('[SERIEVEHICULO]', $constancia->SERIEVEHICULO, $descr);
				$data->constanciaExtravio->PLACEHOLDER = str_replace('[DESCRIPCION_EXTRAVIO]', $descr, $data->constanciaExtravio->PLACEHOLDER);
				$data->constanciaExtravio->PLACEHOLDER = str_replace('[NOMBRE_CERTIFICADO]', $perdido, $data->constanciaExtravio->PLACEHOLDER);
				$data->constanciaExtravio->PLACEHOLDER = str_replace('[NO_DOCUMENTO]', $constancia->NPLACA, $data->constanciaExtravio->PLACEHOLDER);
				$data->constanciaExtravio->PLACEHOLDER = str_replace('[DESCRIPCION]', $constancia->NPLACA, $data->constanciaExtravio->PLACEHOLDER);
				break;
			case 'DOCUMENTOS':
				$descr = 'EXTRAVÍO ORIGINAL DE: [TIPODOCUMENTO] A NOMBRE DE: [NOMBRE_DUENO] CON NÚMERO DE FOLIO: [NDOCUMENTO]';
				if (!$constancia->NDOCUMENTO) {
					$descr = str_replace('CON NÚMERO DE FOLIO: [NDOCUMENTO]', '', $descr);
					$data->constanciaExtravio->PLACEHOLDER = str_replace(', N&Uacute;MERO: <strong>[NO_DOCUMENTO]</strong>,', '', $data->constanciaExtravio->PLACEHOLDER);
				}
				$descr = str_replace('[TIPODOCUMENTO]', $constancia->TIPODOCUMENTO, $descr);
				$descr = str_replace('[NOMBRE_DUENO]', $constancia->DUENONOMBREDOC . " " . $constancia->DUENOAPELLIDOPDOC . " " . $constancia->DUENOAPELLIDOMDOC, $descr);
				$descr = str_replace('[NDOCUMENTO]', $constancia->NDOCUMENTO, $descr);
				$data->constanciaExtravio->PLACEHOLDER = str_replace('[DESCRIPCION_EXTRAVIO]', $descr, $data->constanciaExtravio->PLACEHOLDER);
				$data->constanciaExtravio->PLACEHOLDER = str_replace('[NO_DOCUMENTO]', $constancia->NDOCUMENTO, $data->constanciaExtravio->PLACEHOLDER);
				$data->constanciaExtravio->PLACEHOLDER = str_replace('[NOMBRE_CERTIFICADO]', $constancia->TIPODOCUMENTO, $data->constanciaExtravio->PLACEHOLDER);
				break;
			default:
				$data->constanciaExtravio->PLACEHOLDER = str_replace('[NO_DOCUMENTO]', '', $data->constanciaExtravio->PLACEHOLDER);
				$data->constanciaExtravio->PLACEHOLDER = str_replace('[NOMBRE_CERTIFICADO]', '', $data->constanciaExtravio->PLACEHOLDER);
				break;
		}

		$data2 = [
			'header_data' => (object)['title' => 'Constancia extravío'],
			'body_data' => $data
		];

		echo view("admin/dashboard/documentos/constancia_extravio", $data2);
	}

	public function download_constancia_pdf()
	{
		$folio = $this->request->getPost('folio');
		$year = $this->request->getPost('year');

		$constancia = $this->_constanciaExtravioModel->asObject()->where('CONSTANCIAEXTRAVIOID', $folio)->where('ANO', $year)->first();

		$filename = urlencode("Constancia_" . $folio . '_' . $year . '.pdf');
		header("Content-type: application/pdf");
		header("Content-Disposition: inline; filename=\"$filename\"");
		echo $constancia->PDF;
	}

	public function download_constancia_xml()
	{
		$folio = $this->request->getPost('folio');
		$year = $this->request->getPost('year');

		$constancia = $this->_constanciaExtravioModel->asObject()->where('CONSTANCIAEXTRAVIOID', $folio)->where('ANO', $year)->first();

		$filename = "Constancia_" . $folio . '_' . $year . '.xml';
		header("Content-type: application/xml");
		header("Content-Disposition: attachment; filename=\"$filename\"");
		echo $constancia->XML;
	}

	private function _loadView($title, $menu, $submenu, $data, $view)
	{
		$data2 = [
			'header_data' => (object)['title' => $title, 'menu' => $menu, 'submenu' => $submenu],
			'body_data' => $data
		];

		echo view("admin/dashboard/constancias/$view", $data2);
	}

	private function permisos($permiso)
	{
		return in_array($permiso, session('permisos'));
	}
}

/* End of file FoliosController.php */
/* Location: ./app/Controllers/admin/FoliosController.php */
