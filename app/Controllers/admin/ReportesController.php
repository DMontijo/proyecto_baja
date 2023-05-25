<?php

namespace App\Controllers\admin;

use App\Models\FolioModel;
use App\Controllers\BaseController;
use App\Models\ConstanciaExtravioModel;
use App\Models\MunicipiosModel;
use App\Models\RolesPermisosModel;
use App\Models\UsuariosModel;
use App\Models\PlantillasModel;
use App\Models\VideoCallReadModel;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
// use Aws\S3\S3Client;
// use FFMpeg\FFMpeg;
// use FFMpeg\FFProbe;
// use DateTime;
// use DateTimeZone;

class ReportesController extends BaseController
{

	private $urlApi;
	private $db_read;
	private $_folioModelRead;
	private $_municipiosModelRead;
	private $_usuariosModelRead;
	private $_constanciaExtravioModelRead;
	private $_rolesPermisosModelRead;
	private $_plantillasModelRead;
	private $_videoCallModelRead;

	function __construct()
	{
		//Conexion de lectura
		$this->db_read = ENVIRONMENT == 'production' ? db_connect('default_read') : db_connect('development_read');

		$this->urlApi = VIDEOCALL_URL;
		//Models reader
		$this->_folioModelRead = model('FolioModel', true, $this->db_read);
		$this->_municipiosModelRead = model('MunicipiosModel', true, $this->db_read);
		$this->_usuariosModelRead = model('UsuariosModel', true, $this->db_read);
		$this->_constanciaExtravioModelRead = model('ConstanciaExtravioModel', true, $this->db_read);
		$this->_rolesPermisosModelRead = model('RolesPermisosModel', true, $this->db_read);
		$this->_plantillasModelRead = model('PlantillasModel', true, $this->db_read);
		$this->_videoCallModelRead = new VideoCallReadModel();
	}

	/**
	 * Vista de reportes
	 *
	 */
	public function index()
	{
		if (!$this->permisos('REPORTES')) {
			return redirect()->back()->with('message_error', 'Acceso denegado, no tienes los permisos necesarios.');
		}
		$dataView = (object)array();
		$dataView->rolPermiso = $this->_rolesPermisosModelRead->asObject()->where('ROLID', session('ROLID'))->findAll();

		$this->_loadView('Reportes', 'Reportes', '', $dataView, 'index');
	}

	/**
	 * Vista para ingresar a los reportes de folios 
	 * Se carga con un filtro default
	 *
	 */
	public function getFolios()
	{
		// Datos del filtro
		$data = [
			'fechaInicio' => date("Y-m-d", strtotime('-1 month')),
			'fechaFin' => date("Y-m-d"),
		];

		$municipio = $this->_municipiosModelRead->asObject()->where('ESTADOID', 2)->findAll();
		//Filtro
		$resultFilter = $this->_folioModelRead->filterDates($data);
		$where = "ROLID = 2 OR ROLID = 3 OR ROLID = 4 OR ROLID = 6 OR ROLID = 7 OR ROLID = 8 OR ROLID = 9 OR ROLID = 10";
		$empleado = $this->_usuariosModelRead->asObject()->where($where)->orderBy('NOMBRE', 'ASC')->findAll();

		$dataView = (object)array();
		$dataView->result = $resultFilter->result;
		$dataView->municipios = $municipio;
		$dataView->empleados = $empleado;
		$dataView->filterParams = (object)$data;
		$dataView->rolPermiso = $this->_rolesPermisosModelRead->asObject()->where('ROLID', session('ROLID'))->findAll();
		$this->_loadView('Folios generados', 'folios', '', $dataView, 'folios');
	}

	/**
	 * Función para realizar un filtro en reporte de folios.
	 * Recibe por metodo POST los datos del formulario del filtro
	 *
	 */
	public function postFolios()
	{
		//Datos del filtro
		$data = [
			'MUNICIPIOID' => $this->request->getPost('municipio'),
			'AGENTEATENCIONID' => $this->request->getPost('agente'),
			'STATUS' => $this->request->getPost('status'),
			'TIPODENUNCIA' => $this->request->getPost('tipo'),
			'fechaInicio' => $this->request->getPost('fechaInicio'),
			'fechaFin' => $this->request->getPost('fechaFin'),
			'horaInicio' => $this->request->getPost('horaInicio'),
			'horaFin' => $this->request->getPost('horaFin')
		];

		foreach ($data as $clave => $valor) {
			//Recorre el array y elimina los valores que nulos o vacíos
			if (empty($valor)) unset($data[$clave]);
		}
		//Para cuando se borra el filtro
		if (count($data) <= 0) {
			$data = [
				'fechaInicio' => date("Y-m-d", strtotime('-1 month')),
				'fechaFin' => date("Y-m-d"),
			];
		}

		$municipio = $this->_municipiosModelRead->asObject()->where('ESTADOID', 2)->findAll();
		//Generacion del filtro
		$resultFilter = $this->_folioModelRead->filterDates($data);
		$where = "ROLID = 2 OR ROLID = 3 OR ROLID = 4 OR ROLID = 6 OR ROLID = 7 OR ROLID = 8 OR ROLID = 9 OR ROLID = 10";
		$empleado = $this->_usuariosModelRead->asObject()->where($where)->orderBy('NOMBRE', 'ASC')->findAll();

		if (isset($data['AGENTEATENCIONID'])) {
			$agente = $this->_usuariosModelRead->asObject()->where('ID', $data['AGENTEATENCIONID'])->orderBy('NOMBRE', 'ASC')->first();
			$data['AGENTENOMBRE'] = $agente->NOMBRE . ' ' . $agente->APELLIDO_PATERNO . ' ' . $agente->APELLIDO_MATERNO;
		}

		if (isset($data['MUNICIPIOID'])) {
			$mun = $this->_municipiosModelRead->asObject()->where('ESTADOID', 2)->where('MUNICIPIOID', $data['MUNICIPIOID'])->first();
			$data['MUNICIPIONOMBRE'] = $mun->MUNICIPIODESCR;
		}

		$dataView = (object)array();
		$dataView->result = $resultFilter->result;
		$dataView->municipios = $municipio;
		$dataView->empleados = $empleado;
		$dataView->filterParams = (object)$data;
		$dataView->rolPermiso = $this->_rolesPermisosModelRead->asObject()->where('ROLID', session('ROLID'))->findAll();
		$this->_loadView('Folios generados', 'folios', '', $dataView, 'folios');
	}

	/**
	 * Función para generar el reporte XLSX de folios
	 * Recibe por metodo POST los datos del filtro
	 *
	 */
	public function createFoliosXlsx()
	{
		//Datos del filtro

		$data = [
			'MUNICIPIOID' => $this->request->getPost('MUNICIPIOID'),
			'AGENTEATENCIONID' => $this->request->getPost('AGENTEATENCIONID'),
			'STATUS' => $this->request->getPost('STATUS'),
			'TIPODENUNCIA' => $this->request->getPost('TIPODENUNCIA'),
			'fechaInicio' => $this->request->getPost('fechaInicio'),
			'fechaFin' => $this->request->getPost('fechaFin'),
			'horaInicio' => $this->request->getPost('horaInicio'),
			'horaFin' => $this->request->getPost('horaFin')
		];

		$date = date("Y_m_d_h_i_s");

		foreach ($data as $clave => $valor) {
			//Recorre el array y elimina los valores que nulos o vacíos
			if (empty($valor)) unset($data[$clave]);
		}
		//Cuando no hay filtro
		if (count($data) <= 0) {
			$data = [
				'fechaInicio' => date("Y-m-d", strtotime('-1 month')),
				'fechaFin' => date("Y-m-d"),
			];
		}

		//Generacion del filtro
		$resultFilter = $this->_folioModelRead->filterDates($data);

		//Inicio del XLSX
		$spreadSheet = new Spreadsheet();
		$spreadSheet->getProperties()
			->setCreator("Fiscalía General del Estado de Baja California")
			->setLastModifiedBy("Fiscalía General del Estado de Baja California")
			->setTitle("Reporte Folios" . $date)
			->setSubject("Reporte Folios" . $date)
			->setDescription(
				"El presente documento fue generado por el Centro de Denuncia Tecnológica de la Fiscalía General del Estado de Baja California."
			)
			->setKeywords("reporte folios cdtec fgebc")
			->setCategory("Reportes");
		$sheet = $spreadSheet->getActiveSheet();

		//Estilo del header
		$styleHeaders = [
			'font' => [
				'bold' => true,
				'color' => ['argb' => 'FFFFFF'],
				'name' => 'Arial',
				'size' => '10'
			],
			'alignment' => [
				'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
				'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
			],
			'borders' => [
				'allBorders' => [
					'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
					'color' => ['argb' => '000000'],
				],
			],
			'fill' => [
				'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_GRADIENT_LINEAR,
				'rotation' => 90,
				'startColor' => [
					'argb' => '511229',
				],
				'endColor' => [
					'argb' => '511229',
				],
			],
		];

		//Estilo de las celdas
		$styleCells = [
			'font' => [
				'bold' => false,
				'color' => ['argb' => '000000'],
				'name' => 'Arial',
				'size' => '10'
			],
			'alignment' => [
				'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
				'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
			],
			'borders' => [
				'allBorders' => [
					'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
					'color' => ['argb' => '000000'],
				],
			],
			'fill' => [
				'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_GRADIENT_LINEAR,
				'rotation' => 90,
				'startColor' => [
					'argb' => 'FFFFFF',
				],
				'endColor' => [
					'argb' => 'FFFFFF',
				],
			],
		];
		$row = 1;

		$columns = [
			'A', 'B', 'C', 'D', 'E',
			'F', 'G', 'H', 'I', 'J',
			'K', 'L', 'M', 'N', 'O',
			'P', 'Q', 'R', 'S', 'T',
			'U', 'V', 'W', 'X', 'Y', 'Z'
		];
		//Cabeceras
		$headers = [
			'FOLIO',
			'AÑO',
			'MEDIO',
			'EXPEDIENTE',
			'TIPO',
			'FECHA DE SALIDA',
			'NOMBRE DEL DENUNCIANTE',
			'NOMBRE DEL AGENTE',
			'ESTADO DE ATENCIÓN',
			'MUNICIPIO DE ATENCIÓN',
			'ESTATUS DE EXPEDIENTE',
		];

		for ($i = 0; $i < count($headers); $i++) {
			$sheet->setCellValue($columns[$i] . 1, $headers[$i]);
			$sheet->getColumnDimension($columns[$i])->setAutoSize(true);
		}

		$sheet->getRowDimension($row)->setRowHeight(20, 'pt');

		$row++;

		//Rellenado del XLSX
		foreach ($resultFilter->result as $index => $folio) {
			$tipo = '';
			if ($folio->TIPODENUNCIA == 'VD') {
				$tipo = 'VIDEO';
			} else if ($folio->TIPODENUNCIA == 'DA') {
				$tipo = 'ANÓNIMA';
			} else if ($folio->TIPODENUNCIA == 'TE') {
				$tipo = 'TELEFÓNICA';
			} else {
				$tipo = 'ELECTRONICA';
			}

			$fechaSalida = '';

			if ($folio->FECHASALIDA) {
				$fechaSalida = date('d-m-Y H:i:s', strtotime($folio->FECHASALIDA));
			}

			$sheet->setCellValue('A' . $row, $folio->FOLIOID);
			$sheet->setCellValue('B' . $row, $folio->ANO);
			$sheet->setCellValue('C' . $row, $tipo);
			$sheet->setCellValue('D' . $row, $folio->EXPEDIENTEID ? ($folio->EXPEDIENTEID . '/' . $folio->TIPOEXPEDIENTECLAVE) : '');
			$sheet->setCellValue('E' . $row, $folio->TIPOEXPEDIENTECLAVE ? $folio->TIPOEXPEDIENTECLAVE : $folio->STATUS);
			$sheet->setCellValue('F' . $row, $fechaSalida);
			$sheet->setCellValue('G' . $row, $folio->NOMBRE_DENUNCIANTE);
			$sheet->setCellValue('H' . $row, $folio->NOMBRE_AGENTE);
			$sheet->setCellValue('I' . $row, $folio->ESTADODESCR);
			$sheet->setCellValue('J' . $row, $folio->MUNICIPIODESCR);
			$sheet->setCellValue('K' . $row, $folio->STATUS);

			$sheet->getRowDimension($row)->setRowHeight(20, 'pt');

			if (!(($row - 1) >= count($resultFilter->result))) $row++;
		}
		$row++;
		$row++;
		$sheet->setCellValue('A' . $row, 'CANTIDAD DE RESULTADOS:');
		$sheet->setCellValue('B' . $row, count($resultFilter->result));

		$sheet->getStyle('A1:K1')->applyFromArray($styleHeaders);
		$sheet->getStyle('A2:K' . $row)->applyFromArray($styleCells);

		$writer = new Xlsx($spreadSheet);

		$filename = urlencode("Reporte_Folios_" . $date . ".xlsx");
		header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
		header("Content-Disposition: attachment; filename=\"$filename\"");
		header("Content-Transfer-Encoding: binary");
		header("Cache-Control: max-age=0");
		$writer->save("php://output");
	}
	/**
	 * Vista para ingresar a los reportes de constancia 
	 * Se carga con un filtro default
	 *
	 */
	public function getConstancias()
	{
		// Datos del filtro

		$data = [
			'fechaInicio' => date("Y-m-d", strtotime('-1 month')),
			'fechaFin' => date("Y-m-d"),
		];

		foreach ($data as $clave => $valor) {
			//Recorre el array y elimina los valores que nulos o vacíos
			if (empty($valor)) unset($data[$clave]);
		}

		$municipio = $this->_municipiosModelRead->asObject()->where('ESTADOID', 2)->findAll();
		$resultFilter = $this->_constanciaExtravioModelRead->filterDates($data);
		$where = "ROLID = 2 OR ROLID = 3 OR ROLID = 4 OR ROLID = 6 OR ROLID = 7 OR ROLID = 8 OR ROLID = 9 OR ROLID = 10";
		$empleado = $this->_usuariosModelRead->asObject()->where($where)->orderBy('NOMBRE', 'ASC')->findAll();

		$dataView = (object)array();
		$dataView->result = $resultFilter->result;
		$dataView->municipios = $municipio;
		$dataView->empleados = $empleado;
		$dataView->filterParams = (object)$data;
		$dataView->rolPermiso = $this->_rolesPermisosModelRead->asObject()->where('ROLID', session('ROLID'))->findAll();

		$this->_loadView('Constancias generadas', 'constancias', '', $dataView, 'constancias');
	}


	/**
	 * Función para realizar un filtro en reporte de constancias.
	 * Recibe por metodo POST los datos del formulario del filtro
	 *
	 */
	public function postConstancias()
	{
		//Datos del filtro

		$data = [
			'MUNICIPIOID' => $this->request->getPost('municipio'),
			'AGENTEID' => $this->request->getPost('agente'),
			'STATUS' => $this->request->getPost('status'),
			'fechaInicio' => $this->request->getPost('fechaInicio'),
			'fechaFin' => $this->request->getPost('fechaFin'),
			'horaInicio' => $this->request->getPost('horaInicio'),
			'horaFin' => $this->request->getPost('horaFin')
		];

		foreach ($data as $clave => $valor) {
			//Recorre el array y elimina los valores que nulos o vacíos
			if (empty($valor)) unset($data[$clave]);
		}
		//Para cuando se borra el filtro

		if (count($data) <= 0) {
			$data = [
				'fechaInicio' => date("Y-m-d", strtotime('-1 month')),
				'fechaFin' => date("Y-m-d"),
			];
		}

		$municipio = $this->_municipiosModelRead->asObject()->where('ESTADOID', 2)->findAll();
		//Generacion del filtro

		$resultFilter = $this->_constanciaExtravioModelRead->filterDates($data);
		$where = "ROLID = 2 OR ROLID = 3 OR ROLID = 4 OR ROLID = 6 OR ROLID = 7 OR ROLID = 8 OR ROLID = 9 OR ROLID = 10";
		$empleado = $this->_usuariosModelRead->asObject()->where($where)->orderBy('NOMBRE', 'ASC')->findAll();

		if (isset($data['AGENTEID'])) {
			$agente = $this->_usuariosModelRead->asObject()->where('ID', $data['AGENTEID'])->orderBy('NOMBRE', 'ASC')->first();
			$data['AGENTENOMBRE'] = $agente->NOMBRE . ' ' . $agente->APELLIDO_PATERNO . ' ' . $agente->APELLIDO_MATERNO;
		}

		if (isset($data['MUNICIPIOID'])) {
			$mun = $this->_municipiosModelRead->asObject()->where('ESTADOID', 2)->where('MUNICIPIOID', $data['MUNICIPIOID'])->first();
			$data['MUNICIPIONOMBRE'] = $mun->MUNICIPIODESCR;
		}

		$dataView = (object)array();
		$dataView->result = $resultFilter->result;
		$dataView->municipios = $municipio;
		$dataView->empleados = $empleado;
		$dataView->filterParams = (object)$data;
		$dataView->rolPermiso = $this->_rolesPermisosModelRead->asObject()->where('ROLID', session('ROLID'))->findAll();

		$this->_loadView('Constancias generadas', 'constancias', '', $dataView, 'constancias');
	}

	/**
	 * Función para generar el reporte XLSX de constancias
	 * Recibe por metodo POST los datos del filtro
	 *
	 */
	public function createConstanciasXlsx()
	{
		//Datos del filtro
		$data = [
			'MUNICIPIOID' => $this->request->getPost('MUNICIPIOID'),
			'AGENTEID' => $this->request->getPost('AGENTEID'),
			'STATUS' => $this->request->getPost('STATUS'),
			'fechaInicio' => $this->request->getPost('fechaInicio'),
			'fechaFin' => $this->request->getPost('fechaFin'),
			'horaInicio' => $this->request->getPost('horaInicio'),
			'horaFin' => $this->request->getPost('horaFin')
		];

		$date = date("Y_m_d_h_i_s");

		foreach ($data as $clave => $valor) {
			//Recorre el array y elimina los valores que nulos o vacíos
			if (empty($valor)) unset($data[$clave]);
		}
		//Cuando no hay filtro

		if (count($data) <= 0) {
			$data = [
				'fechaInicio' => date("Y-m-d", strtotime('-1 month')),
				'fechaFin' => date("Y-m-d"),

			];
		}

		//Generacion del filtro

		$resultFilter = $this->_constanciaExtravioModelRead->filterDates($data);
		//Inicio del XLSX

		$spreadSheet = new Spreadsheet();
		$spreadSheet->getProperties()
			->setCreator("Fiscalía General del Estado de Baja California")
			->setLastModifiedBy("Fiscalía General del Estado de Baja California")
			->setTitle("Reporte_Constancias " . $date)
			->setSubject("Reporte_Constancias " . $date)
			->setDescription(
				"El presente documento fue generado por el Centro de Denuncia Tecnológica de la Fiscalía General del Estado de Baja California."
			)
			->setKeywords("reporte constancias extravío cdtec fgebc")
			->setCategory("Reportes");
		$sheet = $spreadSheet->getActiveSheet();
		//Estilo del header

		$styleHeaders = [
			'font' => [
				'bold' => true,
				'color' => ['argb' => 'FFFFFF'],
				'name' => 'Arial',
				'size' => '10'
			],
			'alignment' => [
				'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
				'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
			],
			'borders' => [
				'allBorders' => [
					'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
					'color' => ['argb' => '000000'],
				],
			],
			'fill' => [
				'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_GRADIENT_LINEAR,
				'rotation' => 90,
				'startColor' => [
					'argb' => '511229',
				],
				'endColor' => [
					'argb' => '511229',
				],
			],
		];
		//Estilo de las celdas

		$styleCells = [
			'font' => [
				'bold' => false,
				'color' => ['argb' => '000000'],
				'name' => 'Arial',
				'size' => '10'
			],
			'alignment' => [
				'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
				'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
			],
			'borders' => [
				'allBorders' => [
					'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
					'color' => ['argb' => '000000'],
				],
			],
			'fill' => [
				'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_GRADIENT_LINEAR,
				'rotation' => 90,
				'startColor' => [
					'argb' => 'FFFFFF',
				],
				'endColor' => [
					'argb' => 'FFFFFF',
				],
			],
		];
		$row = 1;

		$columns = [
			'A', 'B', 'C', 'D', 'E',
			'F', 'G', 'H', 'I', 'J',
			'K', 'L', 'M', 'N', 'O',
			'P', 'Q', 'R', 'S', 'T',
			'U', 'V', 'W', 'X', 'Y', 'Z'
		];
		//Cabeceras

		$headers = [
			'CONSTANCIA',
			'AÑO',
			'FECHA DE FIRMA',
			'NOMBRE DEL SOLICITANTE',
			'NOMBRE DEL AGENTE',
			'ESTADO DE ATENCIÓN',
			'MUNICIPIO DE ATENCIÓN',
		];

		for ($i = 0; $i < count($headers); $i++) {
			$sheet->setCellValue($columns[$i] . 1, $headers[$i]);
			$sheet->getColumnDimension($columns[$i])->setAutoSize(true);
		}

		$sheet->getRowDimension($row)->setRowHeight(20, 'pt');

		$row++;
		//Rellenado del XLSX

		foreach ($resultFilter->result as $index => $constancia) {

			$sheet->setCellValue('A' . $row, $constancia->CONSTANCIAEXTRAVIOID);
			$sheet->setCellValue('B' . $row, $constancia->ANO);
			$sheet->setCellValue('C' . $row, isset($constancia->FECHAFIRMA) ? $constancia->FECHAFIRMA : '');
			$sheet->setCellValue('D' . $row, $constancia->NOMBRE_DENUNCIANTE);
			$sheet->setCellValue('E' . $row, isset($constancia->NOMBRE_AGENTE) ? $constancia->NOMBRE_AGENTE : 'NO SE HA FIRMADO');
			$sheet->setCellValue('F' . $row, $constancia->ESTADODESCR);
			if ($constancia->MUNICIPIOIDCITA != null) {
				$sheet->setCellValue('G' . $row, $constancia->MUNICIPIODESCRCITA);
			}
			if ($constancia->MUNICIPIOIDCITA == null) {
				$sheet->setCellValue('G' . $row, $constancia->MUNICIPIODESCR);
			}
			$sheet->getRowDimension($row)->setRowHeight(20, 'pt');

			if (!(($row - 1) >= count($resultFilter->result))) $row++;
		}

		$row++;
		$row++;
		$sheet->setCellValue('A' . $row, 'CANTIDAD DE RESULTADOS:');
		$sheet->setCellValue('B' . $row, count($resultFilter->result));

		$sheet->getStyle('A1:G1')->applyFromArray($styleHeaders);
		$sheet->getStyle('A2:G' . $row)->applyFromArray($styleCells);

		$writer = new Xlsx($spreadSheet);

		$filename = urlencode("Reporte_Constancias_" . $date . ".xlsx");
		header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
		header("Content-Disposition: attachment; filename=\"$filename\"");
		header("Content-Transfer-Encoding: binary");
		header("Cache-Control: max-age=0");
		$writer->save("php://output");
	}

	/**
	 * Vista para ingresar a los reportes de reporte diario
	 * Se carga con un filtro default
	 *
	 */
	public function getRegistroDiario()
	{
		// Datos del filtro

		$data = [
			'fechaInicio' => date("Y-m-d"),
			'fechaFin' => date("Y-m-d"),
		];
		foreach ($data as $clave => $valor) {
			//Recorre el array y elimina los valores que nulos o vacíos

			if (empty($valor)) unset($data[$clave]);
		}

		$municipio = $this->_municipiosModelRead->asObject()->where('ESTADOID', 2)->findAll();

		$where = "ROLID = 2 OR ROLID = 3 OR ROLID = 4 OR ROLID = 6 OR ROLID = 7 OR ROLID = 8 OR ROLID = 9 OR ROLID = 10";
		$rolUser = session()->get('rol')->ID;
		if ($rolUser == 1 || $rolUser == 2 || $rolUser == 6 || $rolUser == 7 || $rolUser == 11) {
			$empleado = $this->_usuariosModelRead->asObject()->where($where)->orderBy('NOMBRE', 'ASC')->findAll();
			//$data['AGENTEATENCIONID'] = session('ID');
		} else {
			$empleado = $this->_usuariosModelRead->asObject()->where('ID',	session('ID'))->orderBy('NOMBRE', 'ASC')->findAll();
			$data['AGENTEATENCIONID'] = session('ID');
		}
		$resultFilter = $this->_folioModelRead->filterDatesRegistroDiario($data);

		$dataView = (object)array();
		$dataView->result = $resultFilter->result;
		$dataView->municipios = $municipio;
		$dataView->empleados = $empleado;
		$dataView->filterParams = (object)$data;
		$dataView->rolPermiso = $this->_rolesPermisosModelRead->asObject()->where('ROLID', session('ROLID'))->findAll();

		$this->_loadView('Reporte diario', 'reporte diario', '', $dataView, 'registro_diario');
	}

	/**
	 * Función para realizar un filtro en reporte de reporte diario.
	 * Recibe por metodo POST los datos del formulario del filtro
	 *
	 */
	public function postRegistroDiario()
	{
		//Datos del filtro

		$data = [
			'AGENTEATENCIONID' => $this->request->getPost('agente_registro'),
			'STATUS' => $this->request->getPost('status'),
			'TIPODENUNCIA' => $this->request->getPost('tipo'),
			'fechaInicio' => $this->request->getPost('fechaInicio'),
			'fechaFin' => $this->request->getPost('fechaFin'),
			'horaInicio' => $this->request->getPost('horaInicio'),
			'horaFin' => $this->request->getPost('horaFin')
		];

		foreach ($data as $clave => $valor) {
			//Recorre el array y elimina los valores que nulos o vacíos
			if (empty($valor)) unset($data[$clave]);
		}
		//Para cuando se borra el filtro

		if (count($data) <= 0) {
			$data = [
				'fechaInicio' => date("Y-m-d", strtotime('-1 month')),
				'fechaFin' => date("Y-m-d"),
			];
		}

		//Generacion del filtro
		$resultFilter = $this->_folioModelRead->filterDatesRegistroDiario($data);

		$where = "ROLID = 2 OR ROLID = 3 OR ROLID = 4 OR ROLID = 6 OR ROLID = 7 OR ROLID = 8 OR ROLID = 9 OR ROLID = 10";
		$empleado = $this->_usuariosModelRead->asObject()->where($where)->orderBy('NOMBRE', 'ASC')->findAll();

		if (isset($data['AGENTEATENCIONID'])) {
			$agente = $this->_usuariosModelRead->asObject()->where('ID', $data['AGENTEATENCIONID'])->orderBy('NOMBRE', 'ASC')->first();
			$data['AGENTENOMBRE'] = $agente->NOMBRE . ' ' . $agente->APELLIDO_PATERNO . ' ' . $agente->APELLIDO_MATERNO;
		}

		$dataView = (object)array();
		$dataView->result = $resultFilter->result;
		$dataView->empleados = $empleado;
		$dataView->filterParams = (object)$data;

		$dataView->rolPermiso = $this->_rolesPermisosModelRead->asObject()->where('ROLID', session('ROLID'))->findAll();

		$this->_loadView('Reporte diario', 'reporte diario', '', $dataView, 'registro_diario');
	}
	/**
	 * Función para generar el reporte XLSX de reporte diario
	 * Recibe por metodo POST los datos del filtro
	 *
	 */
	public function createRegistroDiarioXlsx()
	{
		//Datos del filtro

		$data = [
			'AGENTEATENCIONID' => $this->request->getPost('AGENTEATENCIONID'),
			'STATUS' => $this->request->getPost('STATUS'),
			'TIPODENUNCIA' => $this->request->getPost('TIPODENUNCIA'),
			'fechaInicio' => $this->request->getPost('fechaInicio'),
			'fechaFin' => $this->request->getPost('fechaFin'),
			'horaInicio' => $this->request->getPost('horaInicio'),
			'horaFin' => $this->request->getPost('horaFin')
		];
		$date = date("Y_m_d_h_i_s");

		foreach ($data as $clave => $valor) {
			//Recorre el array y elimina los valores que nulos o vacíos
			if (empty($valor)) unset($data[$clave]);
		}

		//Cuando no hay filtro
		if (count($data) <= 0) {
			$data = [
				'fechaInicio' => date("Y-m-d", strtotime('-1 month')),
				'fechaFin' => date("Y-m-d"),
			];
		}

		//Generacion del filtro
		$resultFilter = $this->_folioModelRead->filterDatesRegistroDiario($data);

		$spreadSheet = new Spreadsheet();
		$spreadSheet->getProperties()
			->setCreator("Fiscalía General del Estado de Baja California")
			->setLastModifiedBy("Fiscalía General del Estado de Baja California")
			->setTitle("REGISTRO_DIARIO_" . $date)
			->setSubject("REGISTRO_DIARIO_" . $date)
			->setDescription(
				"El presente documento fue generado por el Centro de Denuncia Tecnológica de la Fiscalía General del Estado de Baja California."
			)
			->setKeywords("reporte diario cdtec fgebc")
			->setCategory("Reportes");
		$sheet = $spreadSheet->getActiveSheet();

		//Estilo del header
		$styleHeaders = [
			'font' => [
				'bold' => true,
				'color' => ['argb' => 'FFFFFF'],
				'name' => 'Arial',
				'size' => '10'
			],
			'alignment' => [
				'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
				'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
			],
			'borders' => [
				'allBorders' => [
					'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
					'color' => ['argb' => '000000'],
				],
			],
			'fill' => [
				'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_GRADIENT_LINEAR,
				'rotation' => 90,
				'startColor' => [
					'argb' => '511229',
				],
				'endColor' => [
					'argb' => '511229',
				],
			],
		];

		//Estilo de las celdas
		$styleCab = [
			'font' => [
				'bold' => true,
				'color' => ['argb' => '000000'],
				'name' => 'Arial',
				'size' => '12'
			],
			'alignment' => [
				'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,

			],

		];

		$styleCells = [
			'font' => [
				'bold' => false,
				'color' => ['argb' => '000000'],
				'name' => 'Arial',
				'size' => '10'
			],
			'alignment' => [
				'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
				'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
			],
			'borders' => [
				'allBorders' => [
					'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
					'color' => ['argb' => '000000'],
				],
			],
			'fill' => [
				'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_GRADIENT_LINEAR,
				'rotation' => 90,
				'startColor' => [
					'argb' => 'FFFFFF',
				],
				'endColor' => [
					'argb' => 'FFFFFF',
				],
			],
		];
		$row = 4;

		$columns = [
			'A', 'B', 'C', 'D', 'E',
			'F', 'G', 'H', 'I', 'J',
			'K', 'L', 'M', 'N', 'O',
			'P', 'Q', 'R', 'S', 'T',
			'U', 'V', 'W', 'X', 'Y', 'Z'
		];

		//Cabeceras
		$headers = [
			'NO.',
			'FOLIO',
			'AÑO',
			'FECHA RECEPCIÓN',
			'FECHA ATENCIÓN',
			'HORA ATENCIÓN',
			'INICIO',
			'CONCLUSIÓN',
			'DURACIÓN DE ATENCION',
			'TIPO DE ATENCIÓN',
			'MUNICIPIO',
			'NOMBRE (S)',
			'APELLIDO PATERNO',
			'APELLIDO MATERNO',
			'GENÉRO',
			'TELEFONO',
			'CORREO ELECTRÓNICO',
			'DELITOS',
			'SERVIDOR PÚBLICO QUE ATIENDE',
			'TIPO DE EXPEDIENTE GENERADO',
			'NO. EXPEDIENTE GENERADO',
			'REMISIÓN',
			'PRIORIDAD DE ATENCIÓN',
		];

		for ($i = 0; $i < count($headers); $i++) {
			$sheet->setCellValue($columns[$i] . 4, $headers[$i]);
			$sheet->getColumnDimension($columns[$i])->setAutoSize(true);
		}

		$sheet->getRowDimension($row)->setRowHeight(20, 'pt');

		$row++;

		//Rellenado del XLSX
		foreach ($resultFilter->result as $index => $folio) {
			$inicio = '';
			$fin = '';
			$duracion = '';
			$duracion_total = '';
			$horas = '';
			$segundos = '';
			$minutos = '';
			$prioridad = '';

			if ($folio->TIPOEXPEDIENTEID == 1 || $folio->TIPOEXPEDIENTEID == 4) {
				$remision = $folio->OFICINA_EMP;
			} else if ($folio->TIPOEXPEDIENTEID == 5) {
				$remision = $folio->REMISION_RAC;
			} else if ($folio->STATUS == "DERIVADO") {
				$remision = $folio->REMISION_DERIVACION;
			} else if ($folio->STATUS == "CANALIZADO") {
				$remision = $folio->REMISION_CANALIZACION;
			}

			// Información del las llamadas por folio
			$infoCall = $this->_videoCallModelRead->getReporteDiarioInfoByFolio($folio->FOLIOID, $folio->ANO);

			if (count($infoCall) > 0) {
				$infoCall = (object)$infoCall[0];
				$inicio = $this->stringToTime($infoCall->sessionStartedAt);

				if ($infoCall->sessionFinishedAt) {
					$fin = $this->stringToTime($infoCall->sessionFinishedAt);
				}

				$duracion = $infoCall->duration;
				$horas = floor($duracion / 3600);
				$minutos = floor(($duracion - ($horas * 3600)) / 60);
				$segundos = $duracion - ($horas * 3600) - ($minutos * 60);
				$duracion_total = $this->stringToTime(strval($horas)  . ':' . $minutos . ':' . number_format($segundos, 0));
				$prioridad = $infoCall->priority;
			}

			$fecharegistro = strtotime($folio->FECHAREGISTRO);
			$fechasalida = strtotime($folio->FECHASALIDA);
			$dateregistro = date('d-m-Y', $fecharegistro);
			$datesalida = date('d-m-Y', $fechasalida);
			$horaregistro = date('H:i:s', $fecharegistro);
			$sheet->setCellValue('A1', "CENTRO TELEFÓNICO Y EN LÍNEA DE ATENCIÓN Y ORIENTACIÓN TEMPRANA");
			$sheet->setCellValue('A2', "REGISTRO ESTATAL DE PRE DENUNCIA TELEFÓNICA Y EN LÍNEA");
			$tipo = '';
			if ($folio->TIPODENUNCIA == 'VD') {
				$tipo = 'VIDEO';
			} else if ($folio->TIPODENUNCIA == 'DA') {
				$tipo = 'ANÓNIMA';
			} else if ($folio->TIPODENUNCIA == 'TE') {
				$tipo = 'TELEFÓNICA';
			} else {
				$tipo = 'ELECTRONICA';
			}

			$sheet->setCellValue('A' . $row, $row - 4);
			$sheet->setCellValue('B' . $row, $folio->FOLIOID);
			$sheet->setCellValue('C' . $row, $folio->ANO);
			$sheet->setCellValue('D' . $row, $dateregistro);
			$sheet->setCellValue('E' . $row, $datesalida);
			$sheet->setCellValue('F' . $row, $horaregistro);
			$sheet->setCellValue('G' . $row, $inicio != '' ? $inicio : '');
			$sheet->setCellValue('H' . $row, isset($fin) ? $fin : '');
			$sheet->setCellValue('I' . $row, $duracion_total != '' ? $duracion_total : 'NO HAY VIDEO');
			$sheet->setCellValue('J' . $row, $tipo);
			$sheet->setCellValue('K' . $row, $folio->MUNICIPIODESCR);
			$sheet->setCellValue('L' . $row, $folio->N_DENUNCIANTE);
			$sheet->setCellValue('M' . $row, $folio->APP_DENUNCIANTE);
			$sheet->setCellValue('N' . $row, $folio->APM_DENUNCIANTE);
			$sheet->setCellValue('O' . $row, $folio->GENERO == "F" ? "FEMENINO" : "MASCULINO");
			$sheet->setCellValue('P' . $row, $folio->TELEFONODENUNCIANTE);
			$sheet->setCellValue('Q' . $row, $folio->CORREODENUNCIANTE);
			$sheet->setCellValue('R' . $row, isset($folio->DELITOMODALIDADDESCR) ? $folio->DELITOMODALIDADDESCR : 'NO EXISTE');
			$sheet->setCellValue('S' . $row, $folio->N_AGENT . ' ' . $folio->APP_AGENT . ' ' . $folio->APM_AGENT);
			$sheet->setCellValue('T' . $row, isset($folio->TIPOEXPEDIENTECLAVE) ? $folio->TIPOEXPEDIENTECLAVE : $folio->STATUS);
			if (isset($folio->EXPEDIENTEID)) {
				$arrayExpediente = str_split($folio->EXPEDIENTEID);
				$expedienteid = $arrayExpediente[1] . $arrayExpediente[2] . $arrayExpediente[4] . $arrayExpediente[5] . '-' . $arrayExpediente[6] . $arrayExpediente[7] . $arrayExpediente[8] . $arrayExpediente[9] . '-' . $arrayExpediente[10] . $arrayExpediente[11] . $arrayExpediente[12] . $arrayExpediente[13] . $arrayExpediente[14];
			}
			$sheet->setCellValue('U' . $row, $folio->EXPEDIENTEID ? $expedienteid . '/' . $folio->TIPOEXPEDIENTECLAVE : ($folio->FOLIOID . '/' . $folio->ANO));
			$sheet->setCellValue('V' . $row, $remision); //remision
			$sheet->setCellValue('W' . $row, $prioridad == '' ? 1 : $prioridad);
			$sheet->getRowDimension($row)->setRowHeight(20, 'pt');
			if (!(($row - 4) >= count($resultFilter->result))) $row++;
		}
		$row++;
		$row++;
		$sheet->setCellValue('A' . $row, 'CANTIDAD DE RESULTADOS: ');
		$sheet->setCellValue('B' . $row, count($resultFilter->result));

		$sheet->getStyle('A1:W1')->applyFromArray($styleCab);
		$sheet->getStyle('A2:W2')->applyFromArray($styleCab);

		$sheet->getStyle('A4:W4')->applyFromArray($styleHeaders);
		$sheet->getStyle('A5:W' . $row)->applyFromArray($styleCells);

		$sheet->mergeCells('A1:W1');
		$sheet->mergeCells('A2:W2');
		$drawing = new \PhpOffice\PhpSpreadsheet\Worksheet\Drawing();
		$drawing->setName('FGEBC');
		$drawing->setDescription('LOGO');
		$drawing->setPath(FCPATH . 'assets/img/FGEBC_recortada.png'); // put your path and image here
		$drawing->setHeight(60);
		$drawing->setCoordinates('A1');
		$drawing->setOffsetX(10);
		$drawing->setWorksheet($spreadSheet->getActiveSheet());
		// $drawing2 = new \PhpOffice\PhpSpreadsheet\Worksheet\Drawing();
		// $drawing2->setName('FGEBC');
		// $drawing2->setDescription('LOGO');
		// $drawing2->setPath(FCPATH . 'assets/img/logo_sejap.jpg'); // put your path and image here
		// $drawing2->setHeight(45);
		// $drawing2->setCoordinates('T1');
		// $drawing2->setOffsetX(-30);
		// $drawing2->setWorksheet($spreadSheet->getActiveSheet());
		// $drawing->setOffsetX(110);
		// $drawing->setRotation(25);
		$writer = new Xlsx($spreadSheet);

		$filename = urlencode("Registro_Diario_" . session('NOMBRE') . ".xlsx");
		$filename = str_replace(array(" ", "+"), '_', $filename);
		header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
		header("Content-Disposition: attachment; filename=\"$filename\"");
		header("Content-Transfer-Encoding: binary");
		header("Cache-Control: max-age=0");
		$writer->save("php://output");
	}
	/**
	 * Vista para ingresar a los reportes de firmas FIEL
	 *
	 */
	public function getFielReport()
	{
		$data = (object) array();
		if (!$this->permisos('USUARIOS')) {
			return redirect()->back()->with('message_error', 'Acceso denegado, no tienes los permisos necesarios.');
		}
		//Query ROL-USUARIO
		$data->usuario = $this->_usuariosModelRead->asObject()
			->select('USUARIOS.*, ROLES.NOMBRE_ROL, ZONAS_USUARIOS.NOMBRE_ZONA, MUNICIPIO.MUNICIPIODESCR,OFICINA.OFICINADESCR')
			->join('ROLES', 'ROLES.ID = USUARIOS.ROLID', 'LEFT')
			->join('ZONAS_USUARIOS', 'ZONAS_USUARIOS.ID_ZONA = USUARIOS.ZONAID', 'LEFT')
			->join('MUNICIPIO', 'MUNICIPIO.MUNICIPIOID = USUARIOS.MUNICIPIOID AND MUNICIPIO.ESTADOID = 2', 'LEFT')
			->join('OFICINA', 'OFICINA.OFICINAID = USUARIOS.OFICINAID AND OFICINA.MUNICIPIOID = USUARIOS.MUNICIPIOID AND OFICINA.ESTADOID = 2', 'LEFT')
			->where('ROLID !=', 1)
			->orderBy('ROLES.NOMBRE_ROL', 'ASC')
			->orderBy('USUARIOS.NOMBRE', 'ASC')
			->findAll();
		$data->rolPermiso = $this->_rolesPermisosModelRead->asObject()->where('ROLID', session('ROLID'))->findAll();

		$this->_loadView('Reporte FIEL', 'fiel', '', $data, 'fiel');
	}
	/**
	 * Vista para ingresar a los reportes de llamadas
	 * Se carga con un filtro default
	 *
	 */
	public function getReporteLlamadas()
	{

		//Conexion al servicio de videollamda
		$endpoint = $this->urlApi . "call-records?pageSize=0";
		$response = $this->_curlGetService($endpoint);
		if ($response->statusCode == "success") {
			$dataView = (object)array();
			$dataView->llamadas = $response->data;
			$dataView->rolPermiso = $this->_rolesPermisosModelRead->asObject()->where('ROLID', session('ROLID'))->findAll();
			$empleado = array();
			$llamadas = array();

			//Filtro
			foreach ($response->data as $key => $conexion) {
				array_push($empleado, (object)['ID' => $conexion->agentConnectionId->agent->uuid, 'NOMBRE' => $conexion->agentConnectionId->agent->fullName]);
				// $conexion->Fecha = date("Y-m-d H:i:s", strtotime('-2 hour', strtotime($conexion->Fecha)));
				// $conexion->Inicio = date("Y-m-d H:i:s", strtotime('-2 hour', strtotime($conexion->Inicio)));
				// $conexion->Fin = date("Y-m-d H:i:s", strtotime('-2 hour', strtotime($conexion->Fin)));
				array_push($llamadas, $conexion);
				// $promedio += strtotime($value->Duración) - strtotime("TODAY");

			}

			$dataView->empleados = array_unique($empleado, SORT_REGULAR);
			$dataView->llamadas = array_unique($llamadas, SORT_REGULAR);


			$this->_loadView('Reporte llamadas', 'reportes_llamadas', '', $dataView, 'reportes_llamadas');
		}
	}

	/**
	 * Función para realizar un filtro en reporte de llamadas.
	 * Recibe por metodo POST los datos del formulario del filtro
	 *
	 */
	public function postReporteLlamadas()
	{
		$dataPost = (object) [
			'sessionStartedAt' => $this->request->getPost('fechaInicio')  != '' ? date('Y-m-d\TH:i:s\Z', strtotime($this->request->getPost('fechaInicio') . '+7 hours')) : date('Y-m-d\TH:i:s\Z', strtotime('2000-01-01' . '+7 hours')),
			'sessionFinishedAt' => $this->request->getPost('fechaFin') != '' ? date('Y-m-d\TH:i:s\Z', strtotime($this->request->getPost('fechaFin') . '+7 hours')) : date('Y-m-d\TH:i:s\Z'),
			'agentUuid' => $this->request->getPost('agenteId'),
		];

		//Conexion al servicio de videollamada
		$endpoint = $this->urlApi . "call-records?pageSize=0&agentUuid=" . $dataPost->agentUuid . '&sessionStartedFrom=' . $dataPost->sessionStartedAt . '&sessionStartedTo=' . $dataPost->sessionFinishedAt;
		$response = $this->_curlGetService($endpoint);
		// var_dump($endpoint);
		// exit;
		$endpointAll = $this->urlApi . "call-records?pageSize=0";
		$responseAll = $this->_curlGetService($endpointAll);
		if ($responseAll->statusCode == "success") {
			$dataView = (object)array();
			$empleado = array();
			$llamadas = array();

			// Filtro
			foreach ($responseAll->data as $key => $conexionAll) {
				array_push($empleado, (object)['ID' => $conexionAll->agentConnectionId->agent->uuid, 'NOMBRE' => $conexionAll->agentConnectionId->agent->fullName]);
			}
			if ($response != null) {
				foreach ($response->data as $key => $conexion) {

					array_push($llamadas, $conexion);
				}
			}


			$dataView->empleados = array_unique($empleado, SORT_REGULAR);
			$dataView->llamadas = array_unique($llamadas, SORT_REGULAR);
			$dataView->rolPermiso = $this->_rolesPermisosModelRead->asObject()->where('ROLID', session('ROLID'))->findAll();
			$dataView->filterParams = $dataPost;

			$this->_loadView('Reporte llamadas', 'reportes_llamadas', '', $dataView, 'reportes_llamadas');
		}
	}
	/**
	 * Función para generar el reporte XLSX de reporte de llamadas
	 * Recibe por metodo POST los datos del filtro

	 */
	public function createLlamadasXlsx()
	{
		//Datos del formulario
		$dataPost = (object) [
			'sessionStartedAt' => $this->request->getPost('fechaInicio')  != '' ? date('Y-m-d\TH:i:s\Z', strtotime($this->request->getPost('fechaInicio') . '+7 hours')) : date('Y-m-d\TH:i:s\Z', strtotime('2000-01-01' . '+7 hours')),
			'sessionFinishedAt' => $this->request->getPost('fechaFin') != '' ? date('Y-m-d\TH:i:s\Z', strtotime($this->request->getPost('fechaFin') . '+7 hours')) : date('Y-m-d\TH:i:s\Z'),
			'agentUuid' => $this->request->getPost('agentUuid'),
		];

		//Conexion al servicio de videollamada
		$endpoint = $this->urlApi . "call-records?pageSize=0&agentUuid=" . $dataPost->agentUuid . '&sessionStartedFrom=' . $dataPost->sessionStartedAt . '&sessionStartedTo=' . $dataPost->sessionFinishedAt;
		$response = $this->_curlGetService($endpoint);
		$endpointAll = $this->urlApi . "call-records?pageSize=0";
		$responseAll = $this->_curlGetService($endpointAll);
		$date = date("Y_m_d_h_i_s");

		if ($responseAll->statusCode == "success") {
			$dataView = (object)array();
			$empleado = array();
			$llamadas = array();

			// Filtro
			foreach ($responseAll->data as $key => $conexionAll) {
				array_push($empleado, (object)['ID' => $conexionAll->agentConnectionId->agent->uuid, 'NOMBRE' => $conexionAll->agentConnectionId->agent->fullName]);
			}
			if ($response != null) {
				foreach ($response->data as $key => $conexion) {

					array_push($llamadas, $conexion);
				}
			}
			//Inicio de XLSX
			$spreadSheet = new Spreadsheet();
			$spreadSheet->getProperties()
				->setCreator("Fiscalía General del Estado de Baja California")
				->setLastModifiedBy("Fiscalía General del Estado de Baja California")
				->setTitle("REGISTRO_LLAMADAS " . $date)
				->setSubject("REGISTRO_LLAMADAS " . $date)
				->setDescription(
					"El presente documento fue generado por el Centro de Denuncia Tecnológica de la Fiscalía General del Estado de Baja California."
				)
				->setKeywords("registro llamadas cdtec fgebc")
				->setCategory("Reportes");
			$sheet = $spreadSheet->getActiveSheet();
			//Estilos y caracteristicas
			$styleHeaders = [
				'font' => [
					'bold' => true,
					'color' => ['argb' => 'FFFFFF'],
					'name' => 'Arial',
					'size' => '10'
				],
				'alignment' => [
					'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
					'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
				],
				'borders' => [
					'allBorders' => [
						'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
						'color' => ['argb' => '000000'],
					],
				],
				'fill' => [
					'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_GRADIENT_LINEAR,
					'rotation' => 90,
					'startColor' => [
						'argb' => '511229',
					],
					'endColor' => [
						'argb' => '511229',
					],
				],
			];

			$styleCab = [
				'font' => [
					'bold' => true,
					'color' => ['argb' => '000000'],
					'name' => 'Arial',
					'size' => '12'
				],
				'alignment' => [
					'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,

				],

			];

			$styleCells = [
				'font' => [
					'bold' => false,
					'color' => ['argb' => '000000'],
					'name' => 'Arial',
					'size' => '10'
				],
				'alignment' => [
					'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
					'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
				],
				'borders' => [
					'allBorders' => [
						'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
						'color' => ['argb' => '000000'],
					],
				],
				'fill' => [
					'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_GRADIENT_LINEAR,
					'rotation' => 90,
					'startColor' => [
						'argb' => 'FFFFFF',
					],
					'endColor' => [
						'argb' => 'FFFFFF',
					],
				],
			];
			$row = 4;

			$columns = [
				'A', 'B', 'C', 'D', 'E',
				'F', 'G', 'H', 'I', 'J',
				'K', 'L', 'M', 'N', 'O',
				'P', 'Q', 'R', 'S', 'T',
				'U', 'V', 'W', 'X', 'Y', 'Z'
			];
			$headers = [
				"Fecha",
				"Folio",
				"Inicio",
				"Fin",
				"Agente",
				"Cliente",
				// "Espera",
				// "Duración",
				// "Estatus"
			];

			for ($i = 0; $i < count($headers); $i++) {
				$sheet->setCellValue($columns[$i] . 4, $headers[$i]);
				$sheet->getColumnDimension($columns[$i])->setAutoSize(true);
			}

			$sheet->getRowDimension($row)->setRowHeight(20, 'pt');

			$row++;
			$idAgente = 'id Agente';
			//Llenado
			foreach ($llamadas as $index => $llamada) {

				$sheet->setCellValue('A1', "CENTRO TELEFÓNICO Y EN LÍNEA DE ATENCIÓN Y ORIENTACIÓN TEMPRANA");
				$sheet->setCellValue('A2', "REGISTRO ESTATAL DE PRE DENUNCIA TELEFÓNICA Y EN LÍNEA");


				$sheet->setCellValue('A' . $row, date('d-m-Y', strtotime($llamada->sessionStartedAt)));
				$sheet->setCellValue('B' . $row, $llamada->guestConnectionId->folio);
				$sheet->setCellValue('C' . $row, date('d-m-Y H:i:s', strtotime($llamada->sessionStartedAt)));
				$sheet->setCellValue('D' . $row, $llamada->sessionFinishedAt != null ? date('d-m-Y H:i:s', strtotime($llamada->sessionFinishedAt)) : '-');
				$sheet->setCellValue('E' . $row, $llamada->agentConnectionId->agent->fullName);
				$sheet->setCellValue('F' . $row, $llamada->guestConnectionId->uuid->details->NOMBRE . ' ' . $llamada->guestConnectionId->uuid->details->APELLIDO_PATERNO);
				// $sheet->setCellValue('G' . $row, $llamada->Espera);
				// $sheet->setCellValue('H' . $row, $llamada->Duración);
				// $sheet->setCellValue('I' . $row, $llamada->Estatus);

				$sheet->setCellValue('G' . $row, '');

				$sheet->getRowDimension($row)->setRowHeight(20, 'pt');

				if (!(($row - 4) >= count($llamadas))) $row++;
			}
			$sheet->getStyle('A1:F1')->applyFromArray($styleCab);
			$sheet->getStyle('A2:F2')->applyFromArray($styleCab);

			$sheet->getStyle('A4:F4')->applyFromArray($styleHeaders);
			$sheet->getStyle('A5:F' . $row)->applyFromArray($styleCells);

			$sheet->mergeCells('A1:F1');
			$sheet->mergeCells('A2:F2');
			$drawing = new \PhpOffice\PhpSpreadsheet\Worksheet\Drawing();
			$drawing->setName('FGEBC');
			$drawing->setDescription('LOGO');
			$drawing->setPath(FCPATH . 'assets/img/FGEBC_recortada.png'); // put your path and image here
			$drawing->setHeight(60);
			$drawing->setCoordinates('A1');
			$drawing->setOffsetX(10);
			$drawing->setWorksheet($spreadSheet->getActiveSheet());
			// $drawing2 = new \PhpOffice\PhpSpreadsheet\Worksheet\Drawing();
			// $drawing2->setName('FGEBC');
			// $drawing2->setDescription('LOGO');
			// $drawing2->setPath(FCPATH . 'assets/img/logo_sejap.jpg'); // put your path and image here
			// $drawing2->setHeight(45);
			// $drawing2->setCoordinates('O1');
			// $drawing2->setOffsetX(-30);
			// $drawing2->setWorksheet($spreadSheet->getActiveSheet());
			// $drawing->setOffsetX(110);
			// $drawing->setRotation(25);
			$writer = new Xlsx($spreadSheet);

			$filename = urlencode("Registro_Llamadas_" . $date . ".xlsx");
			header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
			header("Content-Disposition: attachment; filename=\"$filename\"");
			header("Content-Transfer-Encoding: binary");
			header("Cache-Control: max-age=0");
			$writer->save("php://output");
		}
	}
	/**
	 * Vista para ingresar a los reportes de conavim 
	 * Se carga con un filtro default
	 *
	 */
	public function getRegistroConavim()
	{
		// Datos del filtro

		$dataPost = [
			'fechaInicio' => date("Y-m-d", strtotime('-1 month')),
			'fechaFin' => date("Y-m-d")
		];
		//Filtro

		$documentos = $this->_plantillasModelRead->filtro_ordenes_proteccion($dataPost);
		//  var_dump($documentos);
		//  exit();
		$municipio = $this->_municipiosModelRead->asObject()->where('ESTADOID', 2)->findAll();
		$where = "ROLID = 2 OR ROLID = 3 OR ROLID = 4 OR ROLID = 6 OR ROLID = 7 OR ROLID = 8 OR ROLID = 9 OR ROLID = 10";
		$empleado = $this->_usuariosModelRead->asObject()->where($where)->orderBy('NOMBRE', 'ASC')->findAll();
		$tiposOrden = $this->_plantillasModelRead->get_tipos_orden();


		$dataView = (object)array();
		$dataView->rolPermiso = $this->_rolesPermisosModelRead->asObject()->where('ROLID', session('ROLID'))->findAll();
		$dataView->municipios = $municipio;
		$dataView->empleados = $empleado;
		$dataView->tiposOrden = (object)$tiposOrden;
		$dataView->dataOrdenes = $documentos;
		$dataView->filterParams = (object)$dataPost;

		$this->_loadView('Reporte CONAVIM', 'registro_conavim', '', $dataView, 'registro_conavim');
	}
	/**
	 * Función para realizar un filtro en reporte de registro conavim.
	 * Recibe por metodo POST los datos del formulario del filtro
	 *
	 */
	public function postRegistroConavim()
	{
		//Datos del filtro

		$dataPost = [
			'MUNICIPIOID' => $this->request->getPost('MUNICIPIOID'),
			'AGENTEATENCIONID' => $this->request->getPost('AGENTEATENCIONID'),
			'GENERO' => $this->request->getPost('GENERO'),
			'TIPOORDEN' => $this->request->getPost('TIPOORDEN'),

			'fechaInicio' => $this->request->getPost('fechaInicio'),
			'fechaFin' => $this->request->getPost('fechaFin'),
			'horaInicio' => $this->request->getPost('horaInicio'),
			'horaFin' => $this->request->getPost('horaFin'),

			'nombreAgente' => '',
			'municipioDescr' => ''
		];

		$municipio = $this->_municipiosModelRead->asObject()->where('ESTADOID', 2)->findAll();
		$where = "ROLID = 2 OR ROLID = 3 OR ROLID = 4 OR ROLID = 6 OR ROLID = 7 OR ROLID = 8 OR ROLID = 9 OR ROLID = 10";
		$empleado = $this->_usuariosModelRead->asObject()->where($where)->orderBy('NOMBRE', 'ASC')->findAll();
		$tiposOrden = $this->_plantillasModelRead->get_tipos_orden();
		$documentos = $this->_plantillasModelRead->filtro_ordenes_proteccion($dataPost);
		if (!empty($dataPost['AGENTEATENCIONID'])) {
			foreach ($empleado as $index => $dato) {
				//var_dump('info empleado', $dato);
				if ($dato->ID == $dataPost['AGENTEATENCIONID']) {
					//var_dump('info empleado', $dato);
					$dataPost['nombreAgente'] = $dato->NOMBRE . ' ' . $dato->APELLIDO_PATERNO . ' ' . $dato->APELLIDO_MATERNO;
				}
			}
		}
		if (!empty($dataPost['MUNICIPIOID'])) {
			foreach ($municipio as $index => $dato) {
				///var_dump('info municipio', $dato);
				if ($dato->MUNICIPIOID == $dataPost['MUNICIPIOID']) {
					$dataPost['municipioDescr'] = $dato->MUNICIPIODESCR;
				}
			}
		}


		$dataView = (object)array();
		$dataView->rolPermiso = $this->_rolesPermisosModelRead->asObject()->where('ROLID', session('ROLID'))->findAll();
		$dataView->municipios = $municipio;
		$dataView->empleados = $empleado;
		$dataView->tiposOrden = (object)$tiposOrden;
		$dataView->dataOrdenes = $documentos;
		$dataView->filterParams = (object)$dataPost;

		$this->_loadView('Reporte CONAVIM', 'registro_conavim', '', $dataView, 'registro_conavim');
	}
	/**
	 * Función para generar el reporte XLSX de conavim
	 * Recibe por metodo POST los datos del filtro
	 *
	 */
	public function createOrdenXlsx()
	{
		//Datos del filtro

		$dataPost = [
			'MUNICIPIOID' => $this->request->getPost('MUNICIPIOID'),
			'AGENTEATENCIONID' => $this->request->getPost('AGENTEATENCIONID'),
			'GENERO' => $this->request->getPost('GENERO'),

			'fechaInicio' => $this->request->getPost('fechaInicio'),
			'fechaFin' => $this->request->getPost('fechaFin'),
			'horaInicio' => $this->request->getPost('horaInicio'),
			'horaFin' => $this->request->getPost('horaFin'),
		];

		foreach ($dataPost as $clave => $valor) {
			//Recorre el array y elimina los valores que nulos o vacíos
			if (empty($valor)) unset($dataPost[$clave]);
		}
		//Cuando no hay filtro

		if (count($dataPost) <= 0) {
			$dataPost = [
				'fechaInicio' => date("Y-m-d", strtotime('-1 month')),
				'fechaFin' => date("Y-m-d"),
			];
		}
		//Generacion del filtro

		$documentos = $this->_plantillasModelRead->filtro_ordenes_proteccion($dataPost);
		$date = date("Y_m_d_h_i_s");
		//Inicio del XLSX

		$spreadSheet = new Spreadsheet();
		$spreadSheet->getProperties()
			->setCreator("Fiscalía General del Estado de Baja California")
			->setLastModifiedBy("Fiscalía General del Estado de Baja California")
			->setTitle("REPORTE_CONAVIM" . $date)
			->setSubject("REPORTE_CONAVIM" . $date)
			->setDescription(
				"El presente documento fue generado por el Centro de Denuncia Tecnológica de la Fiscalía General del Estado de Baja California."
			)
			->setKeywords("reporte conavim cdtec fgebc")
			->setCategory("Reportes");
		$sheet = $spreadSheet->getActiveSheet();

		//Estilo del header

		$styleHeaders = [
			'font' => [
				'bold' => true,
				'color' => ['argb' => 'FFFFFF'],
				'name' => 'Arial',
				'size' => '10'
			],
			'alignment' => [
				'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
				'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
			],
			'borders' => [
				'allBorders' => [
					'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
					'color' => ['argb' => '000000'],
				],
			],
			'fill' => [
				'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_GRADIENT_LINEAR,
				'rotation' => 90,
				'startColor' => [
					'argb' => '511229',
				],
				'endColor' => [
					'argb' => '511229',
				],
			],
		];

		$styleCab = [
			'font' => [
				'bold' => true,
				'color' => ['argb' => '000000'],
				'name' => 'Arial',
				'size' => '12'
			],
			'alignment' => [
				'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,

			],

		];
		//Estilo de las celdas

		$styleCells = [
			'font' => [
				'bold' => false,
				'color' => ['argb' => '000000'],
				'name' => 'Arial',
				'size' => '10'
			],
			'alignment' => [
				'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
				'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
			],
			'borders' => [
				'allBorders' => [
					'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
					'color' => ['argb' => '000000'],
				],
			],
			'fill' => [
				'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_GRADIENT_LINEAR,
				'rotation' => 90,
				'startColor' => [
					'argb' => 'FFFFFF',
				],
				'endColor' => [
					'argb' => 'FFFFFF',
				],
			],
		];
		$row = 4;

		$columns = [
			'A', 'B', 'C', 'D', 'E',
			'F', 'G', 'H', 'I', 'J',
			'K', 'L', 'M', 'N', 'O',
			'P', 'Q', 'R', 'S', 'T',
			'U', 'V', 'W', 'X', 'Y', 'Z'
		];
		//Cabeceras

		$headers = [
			"No.",
			"Folio",
			"FECHA DE EXPEDICIÓN",
			"NO. EXPEDIENTE",
			"MODULO QUE EXPIDE",
			"MUNICIPIO QUE ATIENDE",
			"SERVIDOR PUBLICO SOLICITANTE",
			"DELITO",
			"TIPO DE ORDEN DE PROTECCIÓN",
			"VICTIMA/OFENDIDO",
			"GÉNERO",
			"VÍCTIMA LESIONADA",
		];

		for ($i = 0; $i < count($headers); $i++) {
			$sheet->setCellValue($columns[$i] . 4, $headers[$i]);
			$sheet->getColumnDimension($columns[$i])->setAutoSize(true);
		}

		$sheet->getRowDimension($row)->setRowHeight(20, 'pt');

		$row++;
		$num = 1;
		//Rellenado del XLSX

		foreach ($documentos as $index => $orden) {
			$this->separarExpID($orden->EXPEDIENTEID);


			$sheet->setCellValue('A1', "CENTRO TELEFÓNICO Y EN LÍNEA DE ATENCIÓN Y ORIENTACIÓN TEMPRANA");
			$sheet->setCellValue('A2', "REGISTRO ORDENES DE PROTECCIÓN");


			$sheet->setCellValue('A' . $row, $num);
			$sheet->setCellValue('B' . $row, $orden->FOLIOID);
			$sheet->setCellValue('C' . $row, $this->formatFecha($orden->FECHAFIRMA));
			$sheet->setCellValue('D' . $row, $this->separarExpID($orden->EXPEDIENTEID));
			$sheet->setCellValue('E' . $row, 'CENTRO DE DENUNCIA TECNÓLOGICA');
			$sheet->setCellValue('F' . $row,  $orden->MUNICIPIODESCR);
			$sheet->setCellValue('G' . $row,  $orden->NOMBRE_MP);
			$sheet->setCellValue('H' . $row,  $orden->DELITOMODALIDADDESCR);
			$sheet->setCellValue('I' . $row,  $orden->TIPODOC);
			$sheet->setCellValue('J' . $row,  $orden->NOMBRE_VTM);
			$sheet->setCellValue('K' . $row, ($orden->SEXO == 'M' ? 'MASCULINO' : ($orden->SEXO == 'F' ? 'FEMENINO' : '')));
			$sheet->setCellValue('L' . $row,  $orden->LESIONES);
			$sheet->setCellValue('M' . $row, '');

			$sheet->getRowDimension($row)->setRowHeight(20, 'pt');

			if (!(($row - 4) >= count($documentos))) $row++;
			$num++;
		}
		$sheet->getStyle('A1:L1')->applyFromArray($styleCab);
		$sheet->getStyle('A2:L2')->applyFromArray($styleCab);

		$sheet->getStyle('A4:L4')->applyFromArray($styleHeaders);
		$sheet->getStyle('A5:L' . $row)->applyFromArray($styleCells);

		$sheet->mergeCells('A1:R1');
		$sheet->mergeCells('A2:R2');
		$drawing = new \PhpOffice\PhpSpreadsheet\Worksheet\Drawing();
		$drawing->setName('FGEBC');
		$drawing->setDescription('LOGO');
		$drawing->setPath(FCPATH . 'assets/img/FGEBC_recortada.png'); // put your path and image here
		$drawing->setHeight(60);
		$drawing->setCoordinates('A1');
		$drawing->setOffsetX(10);
		$drawing->setWorksheet($spreadSheet->getActiveSheet());
		// $drawing2 = new \PhpOffice\PhpSpreadsheet\Worksheet\Drawing();
		// $drawing2->setName('FGEBC');
		// $drawing2->setDescription('LOGO');
		// $drawing2->setPath(FCPATH . 'assets/img/logo_sejap.jpg'); // put your path and image here
		// $drawing2->setHeight(45);
		// $drawing2->setCoordinates('O1');
		// $drawing2->setOffsetX(-30);
		// $drawing2->setWorksheet($spreadSheet->getActiveSheet());
		// $drawing->setOffsetX(110);
		// $drawing->setRotation(25);
		$writer = new Xlsx($spreadSheet);

		$filename = urlencode("Reporte_Conavim_" . $date . ".xlsx");
		header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
		header("Content-Disposition: attachment; filename=\"$filename\"");
		header("Content-Transfer-Encoding: binary");
		header("Cache-Control: max-age=0");
		$writer->save("php://output");
	}
	/**
	 * Vista para ingresar a los reportes de candev 
	 * Se carga con un filtro default
	 *
	 */
	public function getRegistroCanDev()
	{
		// Datos del filtro

		$dataPost = [
			'fechaInicio' => date("Y-m-d", strtotime('-1 month')),
			'fechaFin' => date("Y-m-d")
		];

		$municipio = $this->_municipiosModelRead->asObject()->where('ESTADOID', 2)->findAll();
		$where = "ROLID = 2 OR ROLID = 3 OR ROLID = 4 OR ROLID = 6 OR ROLID = 7 OR ROLID = 8 OR ROLID = 9 OR ROLID = 10";
		$empleado = $this->_usuariosModelRead->asObject()->where($where)->orderBy('NOMBRE', 'ASC')->findAll();
		$dataInfo = $this->_folioModelRead->filtro_canalizaciones_derivaciones($dataPost);

		if (!empty($dataPost['AGENTEATENCIONID'])) {
			foreach ($empleado as $index => $dato) {
				//var_dump('info empleado', $dato);
				if ($dato->ID == $dataPost['AGENTEATENCIONID']) {
					//var_dump('info empleado', $dato);
					$dataPost['nombreAgente'] = $dato->NOMBRE . ' ' . $dato->APELLIDO_PATERNO . ' ' . $dato->APELLIDO_MATERNO;
				}
			}
		}
		if (!empty($dataPost['MUNICIPIOID'])) {
			foreach ($municipio as $index => $dato) {
				///var_dump('info municipio', $dato);
				if ($dato->MUNICIPIOID == $dataPost['MUNICIPIOID']) {
					$dataPost['municipioDescr'] = $dato->MUNICIPIODESCR;
				}
			}
		}


		$dataView = (object)array();
		$dataView->rolPermiso = $this->_rolesPermisosModelRead->asObject()->where('ROLID', session('ROLID'))->findAll();
		$dataView->municipios = $municipio;
		$dataView->empleados = $empleado;
		$dataView->dataInfo = $dataInfo;
		$dataView->filterParams = (object)$dataPost;

		$this->_loadView('Reporte Canalización y Derivación', 'registro_candev', '', $dataView, 'registro_candev');
	}

	/**
	 * Función para realizar un filtro en reporte de candev.
	 * Recibe por metodo POST los datos del formulario del filtro
	 *
	 */
	public function postRegistroCanDev()
	{
		//Datos del filtro

		$dataPost = [
			'MUNICIPIOID' => $this->request->getPost('MUNICIPIOID'),
			'AGENTEATENCIONID' => $this->request->getPost('AGENTEATENCIONID'),
			'SALIDA' => $this->request->getPost('SALIDA'),

			'fechaInicio' => $this->request->getPost('fechaInicio'),
			'fechaFin' => $this->request->getPost('fechaFin'),
			'horaInicio' => $this->request->getPost('horaInicio'),
			'horaFin' => $this->request->getPost('horaFin'),

			'nombreAgente' => '',
			'municipioDescr' => ''
		];

		$municipio = $this->_municipiosModelRead->asObject()->where('ESTADOID', 2)->findAll();
		$where = "ROLID = 2 OR ROLID = 3 OR ROLID = 4 OR ROLID = 6 OR ROLID = 7 OR ROLID = 8 OR ROLID = 9 OR ROLID = 10";
		$empleado = $this->_usuariosModelRead->asObject()->where($where)->orderBy('NOMBRE', 'ASC')->findAll();
		//Generacion del filtro

		$dataInfo = $this->_folioModelRead->filtro_canalizaciones_derivaciones($dataPost);

		if (!empty($dataPost['AGENTEATENCIONID'])) {
			foreach ($empleado as $index => $dato) {
				//var_dump('info empleado', $dato);
				if ($dato->ID == $dataPost['AGENTEATENCIONID']) {
					//var_dump('info empleado', $dato);
					$dataPost['nombreAgente'] = $dato->NOMBRE . ' ' . $dato->APELLIDO_PATERNO . ' ' . $dato->APELLIDO_MATERNO;
				}
			}
		}
		if (!empty($dataPost['MUNICIPIOID'])) {
			foreach ($municipio as $index => $dato) {
				///var_dump('info municipio', $dato);
				if ($dato->MUNICIPIOID == $dataPost['MUNICIPIOID']) {
					$dataPost['municipioDescr'] = $dato->MUNICIPIODESCR;
				}
			}
		}


		$dataView = (object)array();
		$dataView->rolPermiso = $this->_rolesPermisosModelRead->asObject()->where('ROLID', session('ROLID'))->findAll();
		$dataView->municipios = $municipio;
		$dataView->empleados = $empleado;
		$dataView->dataInfo = $dataInfo;
		$dataView->filterParams = (object)$dataPost;

		$this->_loadView('Reporte Canalización y Derivación', 'registro_candev', '', $dataView, 'registro_candev');
	}
	/**
	 * Función para generar el reporte XLSX de candev
	 * Recibe por metodo POST los datos del filtro
	 *
	 */
	public function createCanaDevXlsx()
	{
		//Datos del filtro

		$dataPost = [
			'MUNICIPIOID' => $this->request->getPost('MUNICIPIOID'),
			'AGENTEATENCIONID' => $this->request->getPost('AGENTEATENCIONID'),
			'GENERO' => $this->request->getPost('GENERO'),

			'fechaInicio' => $this->request->getPost('fechaInicio'),
			'fechaFin' => $this->request->getPost('fechaFin'),
			'horaInicio' => $this->request->getPost('horaInicio'),
			'horaFin' => $this->request->getPost('horaFin'),
		];

		foreach ($dataPost as $clave => $valor) {
			//Recorre el array y elimina los valores que nulos o vacíos
			if (empty($valor)) unset($dataPost[$clave]);
		}
		//Cuando no hay filtro

		if (count($dataPost) <= 0) {
			$dataPost = [
				'fechaInicio' => date("Y-m-d", strtotime('-1 month')),
				'fechaFin' => date("Y-m-d"),
			];
		}
		//Generacion del filtro

		$dataInfo = $this->_folioModelRead->filtro_canalizaciones_derivaciones($dataPost);

		$date = date("Y_m_d_h_i_s");
		//Inicio del XLSX

		$spreadSheet = new Spreadsheet();
		$spreadSheet->getProperties()
			->setCreator("Fiscalía General del Estado de Baja California")
			->setLastModifiedBy("Fiscalía General del Estado de Baja California")
			->setTitle("REPORTE_CEEAIV" . $date)
			->setSubject("REPORTE_CEEAIV" . $date)
			->setDescription(
				"El presente documento fue generado por el Centro de Denuncia Tecnológica de la Fiscalía General del Estado de Baja California."
			)
			->setKeywords("reporte ceeaiv cdtec fgebc")
			->setCategory("Reportes");
		$sheet = $spreadSheet->getActiveSheet();
		//Estilo del header


		$styleHeaders = [
			'font' => [
				'bold' => true,
				'color' => ['argb' => 'FFFFFF'],
				'name' => 'Arial',
				'size' => '10'
			],
			'alignment' => [
				'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
				'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
			],
			'borders' => [
				'allBorders' => [
					'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
					'color' => ['argb' => '000000'],
				],
			],
			'fill' => [
				'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_GRADIENT_LINEAR,
				'rotation' => 90,
				'startColor' => [
					'argb' => '511229',
				],
				'endColor' => [
					'argb' => '511229',
				],
			],
		];

		$styleCab = [
			'font' => [
				'bold' => true,
				'color' => ['argb' => '000000'],
				'name' => 'Arial',
				'size' => '12'
			],
			'alignment' => [
				'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,

			],

		];
		//Estilo de las celdas

		$styleCells = [
			'font' => [
				'bold' => false,
				'color' => ['argb' => '000000'],
				'name' => 'Arial',
				'size' => '10'
			],
			'alignment' => [
				'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
				'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
			],
			'borders' => [
				'allBorders' => [
					'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
					'color' => ['argb' => '000000'],
				],
			],
			'fill' => [
				'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_GRADIENT_LINEAR,
				'rotation' => 90,
				'startColor' => [
					'argb' => 'FFFFFF',
				],
				'endColor' => [
					'argb' => 'FFFFFF',
				],
			],
		];
		$row = 4;

		$columns = [
			'A', 'B', 'C', 'D', 'E',
			'F', 'G', 'H', 'I', 'J',
			'K', 'L', 'M', 'N', 'O',
			'P', 'Q', 'R', 'S', 'T',
			'U', 'V', 'W', 'X', 'Y', 'Z'
		];
		//Cabeceras

		$headers = [
			"NO.",
			"FOLIO",
			"FECHA DE ATENCIÓN",
			"NO. EXPEDIENTE",
			"MODULO QUE EXPIDE",
			"MUNICIPIO QUE ATIENDE",
			"SERVIDOR PUBLICO SOLICITANTE",
			"DELITO",
			"VICTIMA/OFENDIDO",
			"SALIDA",
		];

		for ($i = 0; $i < count($headers); $i++) {
			$sheet->setCellValue($columns[$i] . 4, $headers[$i]);
			$sheet->getColumnDimension($columns[$i])->setAutoSize(true);
		}

		$sheet->getRowDimension($row)->setRowHeight(20, 'pt');

		$row++;
		$num = 1;
		//Rellenado del XLSX

		foreach ($dataInfo as $index => $orden) {
			//$this->separarExpID($orden->EXPEDIENTEID);


			$sheet->setCellValue('A1', "CENTRO TELEFÓNICO Y EN LÍNEA DE ATENCIÓN Y ORIENTACIÓN TEMPRANA");
			$sheet->setCellValue('A2', "REGISTRO DE CANALIZACIONES Y DERIVACIONES");

			$sheet->setCellValue('A' . $row, $num);
			$sheet->setCellValue('B' . $row, $orden->FOLIOID . '/' . $orden->ANO);
			$sheet->setCellValue('C' . $row, $this->formatFecha($orden->HECHOFECHA));
			$sheet->setCellValue('D' . $row, (isset($orden->EXPEDIENTEID)) ? $this->separarExpID($orden->EXPEDIENTEID) : ($orden->FOLIOID . '/' . $orden->ANO));
			$sheet->setCellValue('E' . $row, 'CENTRO DE DENUNCIA TECNÓLOGICA');
			$sheet->setCellValue('F' . $row,  $orden->MUNICIPIODESCR);
			$sheet->setCellValue('G' . $row,  $orden->AGENTE_NOMBRE);
			$sheet->setCellValue('H' . $row,  $orden->DELITOMODALIDADDESCR);
			$sheet->setCellValue('I' . $row,  $orden->NOMBRE_VTM);
			$sheet->setCellValue('J' . $row,  $orden->STATUS);

			$sheet->getRowDimension($row)->setRowHeight(20, 'pt');

			if (!(($row - 4) >= count($dataInfo))) $row++;
			$num++;
		}
		$sheet->getStyle('A1:L1')->applyFromArray($styleCab);
		$sheet->getStyle('A2:L2')->applyFromArray($styleCab);

		$sheet->getStyle('A4:L4')->applyFromArray($styleHeaders);
		$sheet->getStyle('A5:L' . $row)->applyFromArray($styleCells);

		$sheet->mergeCells('A1:L1');
		$sheet->mergeCells('A2:L2');
		$drawing = new \PhpOffice\PhpSpreadsheet\Worksheet\Drawing();
		$drawing->setName('FGEBC');
		$drawing->setDescription('LOGO');
		$drawing->setPath(FCPATH . 'assets/img/FGEBC_recortada.png'); // put your path and image here
		$drawing->setHeight(60);
		$drawing->setCoordinates('A1');
		$drawing->setOffsetX(10);
		$drawing->setWorksheet($spreadSheet->getActiveSheet());
		// $drawing2 = new \PhpOffice\PhpSpreadsheet\Worksheet\Drawing();
		// $drawing2->setName('FGEBC');
		// $drawing2->setDescription('LOGO');
		// $drawing2->setPath(FCPATH . 'assets/img/logo_sejap.jpg'); // put your path and image here
		// $drawing2->setHeight(45);
		// $drawing2->setCoordinates('O1');
		// $drawing2->setOffsetX(-30);
		// $drawing2->setWorksheet($spreadSheet->getActiveSheet());
		// $drawing->setOffsetX(110);
		// $drawing->setRotation(25);
		$writer = new Xlsx($spreadSheet);

		$filename = urlencode("Registro_Canalizaciones_Derivaciones_" . $date . ".xlsx");
		header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
		header("Content-Disposition: attachment; filename=\"$filename\"");
		header("Content-Transfer-Encoding: binary");
		header("Cache-Control: max-age=0");
		$writer->save("php://output");
	}

	/**
	 * Vista para ingresar a los reportes de registro de atenciones
	 * Se carga con un filtro default
	 *
	 */
	public function getRegistroAtenciones()
	{
		// Datos del filtro

		$data = [
			'fechaInicio' => date("Y-m-d", strtotime('-1 month')),
			'fechaFin' => date("Y-m-d")
		];
		$municipio = $this->_municipiosModelRead->asObject()->where('ESTADOID', 2)->findAll();

		$where = "ROLID = 2 OR ROLID = 3 OR ROLID = 4 OR ROLID = 6 OR ROLID = 7 OR ROLID = 8 OR ROLID = 9 OR ROLID = 10";
		$rolUser = session()->get('rol')->ID;
		//Filtro de agentes dependiendo del rol
		if ($rolUser == 1 || $rolUser == 2 || $rolUser == 6 || $rolUser == 7 || $rolUser == 11) {
			$empleado = $this->_usuariosModelRead->asObject()->where($where)->orderBy('NOMBRE', 'ASC')->findAll();
			//$data['AGENTEATENCIONID'] = session('ID');
		} else {
			$empleado = $this->_usuariosModelRead->asObject()->where('ID',	session('ID'))->orderBy('NOMBRE', 'ASC')->findAll();
			$data['AGENTEATENCIONID'] = session('ID');
		}
		//Filtro

		$resultFilter = $this->_folioModelRead->filterRegistroAtenciones($data);
		$dataView = (object)array();
		$dataView->result = $resultFilter->result;
		$dataView->municipios = $municipio;
		$dataView->empleados = $empleado;
		$dataView->filterParams = (object)$data;
		$dataView->rolPermiso = $this->_rolesPermisosModelRead->asObject()->where('ROLID', session('ROLID'))->findAll();
		$this->_loadView('Reporte de atenciones', 'Registro de atenciones', '', $dataView, 'registro_atenciones');
	}
	/**
	 * Función para realizar un filtro en reporte de registro de atenciones.
	 * Recibe por metodo POST los datos del formulario del filtro
	 *
	 */
	public function postRegistroAtenciones()
	{
		//Datos del filtro

		$data = [
			'MUNICIPIOID' => $this->request->getPost('municipio'),
			'AGENTEATENCIONID' => $this->request->getPost('agente'),
			'STATUS' => $this->request->getPost('status'),
			'TIPODENUNCIA' => $this->request->getPost('tipo'),
			'fechaInicio' => $this->request->getPost('fechaInicio'),
			'fechaFin' => $this->request->getPost('fechaFin'),
			'horaInicio' => $this->request->getPost('horaInicio'),
			'horaFin' => $this->request->getPost('horaFin')
		];
		foreach ($data as $clave => $valor) {
			//Recorre el array y elimina los valores que nulos o vacíos
			if (empty($valor)) unset($data[$clave]);
		}
		//Para cuando se borra el filtro

		if (count($data) <= 0) {
			$data = [
				'fechaInicio' => date("Y-m-d", strtotime('-1 month')),
				'fechaFin' => date("Y-m-d"),
			];
		}
		$municipio = $this->_municipiosModelRead->asObject()->where('ESTADOID', 2)->findAll();
		//Generacion del filtro

		$resultFilter = $this->_folioModelRead->filterRegistroAtenciones($data);
		$where = "ROLID = 2 OR ROLID = 3 OR ROLID = 4 OR ROLID = 6 OR ROLID = 7 OR ROLID = 8 OR ROLID = 9 OR ROLID = 10";
		$empleado = $this->_usuariosModelRead->asObject()->where($where)->orderBy('NOMBRE', 'ASC')->findAll();

		if (isset($data['AGENTEID'])) {
			$agente = $this->_usuariosModelRead->asObject()->where('ID', $data['AGENTEID'])->orderBy('NOMBRE', 'ASC')->first();
			$data['AGENTENOMBRE'] = $agente->NOMBRE . ' ' . $agente->APELLIDO_PATERNO . ' ' . $agente->APELLIDO_MATERNO;
		}

		if (isset($data['MUNICIPIOID'])) {
			$mun = $this->_municipiosModelRead->asObject()->where('ESTADOID', 2)->where('MUNICIPIOID', $data['MUNICIPIOID'])->first();
			$data['MUNICIPIONOMBRE'] = $mun->MUNICIPIODESCR;
		}
		$dataView = (object)array();
		$dataView->result = $resultFilter->result;
		$dataView->municipios = $municipio;
		$dataView->empleados = $empleado;
		$dataView->filterParams = (object)$data;
		$dataView->rolPermiso = $this->_rolesPermisosModelRead->asObject()->where('ROLID', session('ROLID'))->findAll();
		$this->_loadView('Reporte de atenciones', 'Registro de atenciones', '', $dataView, 'registro_atenciones');
	}
	/**
	 * Función para generar el reporte XLSX de registro de atenciones
	 * Recibe por metodo POST los datos del filtro
	 *
	 */
	public function createRegistroAtencionesXlsx()
	{
		//Datos del filtro

		$data = [
			'MUNICIPIOID' => $this->request->getPost('MUNICIPIOID'),
			'AGENTEATENCIONID' => $this->request->getPost('AGENTEATENCIONID'),
			'STATUS' => $this->request->getPost('STATUS'),
			'TIPODENUNCIA' => $this->request->getPost('TIPODENUNCIA'),
			'fechaInicio' => $this->request->getPost('fechaInicio'),
			'fechaFin' => $this->request->getPost('fechaFin'),
			'horaInicio' => $this->request->getPost('horaInicio'),
			'horaFin' => $this->request->getPost('horaFin')
		];
		$date = date("Y_m_d_h_i_s");
		foreach ($data as $clave => $valor) {
			//Recorre el array y elimina los valores que nulos o vacíos

			if (empty($valor)) unset($data[$clave]);
		}
		//Cuando no hay filtro

		if (count($data) <= 0) {
			$data = [
				'fechaInicio' => date("Y-m-d", strtotime('-1 month')),
				'fechaFin' => date("Y-m-d"),
			];
		}
		//Generacion del filtro

		$resultFilter = $this->_folioModelRead->filterRegistroAtenciones($data);
		//Inicio del XLSX

		$spreadSheet = new Spreadsheet();
		$spreadSheet->getProperties()
			->setCreator("Fiscalía General del Estado de Baja California")
			->setLastModifiedBy("Fiscalía General del Estado de Baja California")
			->setTitle("BITACORA_REGISTRO_DE_ATENCIONES" . $date)
			->setSubject("BITACORA_REGISTRO_DE_ATENCIONES" . $date)
			->setDescription(
				"El presente documento fue generado por el Centro de Denuncia Tecnológica de la Fiscalía General del Estado de Baja California."
			)
			->setKeywords("registro atenciones cdtec fgebc")
			->setCategory("Reportes");
		$sheet = $spreadSheet->getActiveSheet();


		$styleHeaders = [
			'font' => [
				'bold' => true,
				'color' => ['argb' => 'FFFFFF'],
				'name' => 'Arial',
				'size' => '10'
			],
			'alignment' => [
				'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
				'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
			],
			'borders' => [
				'allBorders' => [
					'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
					'color' => ['argb' => '000000'],
				],
			],
			'fill' => [
				'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_GRADIENT_LINEAR,
				'rotation' => 90,
				'startColor' => [
					'argb' => '511229',
				],
				'endColor' => [
					'argb' => '511229',
				],
			],
		];

		$styleCab = [
			'font' => [
				'bold' => true,
				'color' => ['argb' => '000000'],
				'name' => 'Arial',
				'size' => '12'
			],
			'alignment' => [
				'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,

			],

		];

		$styleCells = [
			'font' => [
				'bold' => false,
				'color' => ['argb' => '000000'],
				'name' => 'Arial',
				'size' => '10'
			],
			'alignment' => [
				'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
				'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
			],
			'borders' => [
				'allBorders' => [
					'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
					'color' => ['argb' => '000000'],
				],
			],
			'fill' => [
				'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_GRADIENT_LINEAR,
				'rotation' => 90,
				'startColor' => [
					'argb' => 'FFFFFF',
				],
				'endColor' => [
					'argb' => 'FFFFFF',
				],
			],
		];
		$row = 4;

		$columns = [
			'A', 'B', 'C', 'D', 'E',
			'F', 'G', 'H', 'I', 'J',
			'K', 'L', 'M', 'N', 'O',
			'P', 'Q', 'R', 'S', 'T',
			'U', 'V', 'W', 'X', 'Y', 'Z'
		];
		$headers = [
			'NO.',
			'FECHA RECEPCIÓN',
			'FOLIO',
			'HORA',
			'CONCLUSIÓN',
			'DURACIÓN DE ATENCION',
			'TIPO DE ATENCIÓN',
			'MUNICIPIO',
			'NOMBRE (S)',
			'APELLIDO PATERNO',
			'APELLIDO MATERNO',
			'GENÉRO',
			'TELEFONO',
			'CORREO ELECTRÓNICO',
			'DELITO',
			'SERVIDOR PÚBLICO QUE ATIENDE',
			'TIPO DE EXPEDIENTE GENERADO',
			'NO. EXPEDIENTE GENERADO',
			'REMISIÓN',
			'PRIORIDAD DE ATENCIÓN',
		];

		for ($i = 0; $i < count($headers); $i++) {
			$sheet->setCellValue($columns[$i] . 4, $headers[$i]);
			$sheet->getColumnDimension($columns[$i])->setAutoSize(true);
		}

		$sheet->getRowDimension($row)->setRowHeight(20, 'pt');

		$row++;

		//Rellenado del XLSX

		foreach ($resultFilter->result as $index => $folio) {

			$inicio = '';
			$fin = '';
			$duracion = '';
			$horas = '';
			$segundos = '';
			$minutos = '';
			$remision = '';

			if ($folio->TIPOEXPEDIENTEID == 1 || $folio->TIPOEXPEDIENTEID == 4) {
				$remision = $folio->OFICINA_EMP;
			} else if ($folio->TIPOEXPEDIENTEID == 5) {
				$remision = $folio->REMISION_RAC;
			} else if ($folio->STATUS == "DERIVADO") {
				$remision = $folio->REMISION_DERIVACION;
			} else if ($folio->STATUS == "CANALIZADO") {
				$remision = $folio->REMISION_CANALIZACION;
			}

			$endpointFolio = $this->urlApi . 'recordings/folio?folio=' . $folio->FOLIOID . '/' . $folio->ANO;

			$responseFolio = $this->_curlGetService($endpointFolio);
			if ($responseFolio != null) {
				foreach ($responseFolio as $key => $videoDuration) {
					if ($videoDuration != '') {

						$timestampInicio = strtotime($videoDuration->callRecordId->sessionStartedAt);
						$inicio = date('H:i:s', $timestampInicio);

						if ($videoDuration->callRecordId->sessionFinishedAt) {
							$timestampFin = strtotime($videoDuration->callRecordId->sessionFinishedAt);
							$fin = date('H:i:s', $timestampFin);
						}
					}
					$duracion = $videoDuration->duration;
					$horas = floor($duracion / 3600);
					$minutos = floor(($duracion - ($horas * 3600)) / 60);
					$segundos = $duracion - ($horas * 3600) - ($minutos * 60);
				}
			}
			$fecharegistro = strtotime($folio->FECHAREGISTRO);
			$dateregistro = date('d-m-Y', $fecharegistro);
			$sheet->setCellValue('A1', "CENTRO DE DENUNCIA TECNOLÓGICA");
			$sheet->setCellValue('A2', "REGISTRO DE ATENCIONES");
			$tipo = '';
			if ($folio->TIPODENUNCIA == 'VD') {
				$tipo = 'VIDEO DENUNCIA';
			} else if ($folio->TIPODENUNCIA == 'DA') {
				$tipo = 'ANÓNIMA';
			} else if ($folio->TIPODENUNCIA == 'TE') {
				$tipo = 'TELEFÓNICA';
			} else {
				$tipo = 'ELECTRONICA';
			}

			$sheet->setCellValue('A' . $row, $row - 4);
			$sheet->setCellValue('B' . $row, $dateregistro);
			$sheet->setCellValue('C' . $row, $folio->FOLIOID);
			$sheet->setCellValue('D' . $row, $inicio != '' ? $inicio : '');
			$sheet->setCellValue('E' . $row, isset($fin) ? $fin : '');
			$sheet->setCellValue('F' . $row,  $horas != '' ? strval($horas)  . ':' . $minutos . ':' . number_format($segundos, 0) : 'NO HAY VIDEO GRABADO');
			$sheet->setCellValue('G' . $row, $tipo);
			$sheet->setCellValue('H' . $row, $folio->MUNICIPIODESCR);
			$sheet->setCellValue('I' . $row, $folio->N_DENUNCIANTE);
			$sheet->setCellValue('J' . $row, $folio->APP_DENUNCIANTE);
			$sheet->setCellValue('K' . $row, $folio->APM_DENUNCIANTE);
			$sheet->setCellValue('L' . $row, $folio->GENERO == "F" ? "FEMENINO" : "MASCULINO");
			$sheet->setCellValue('M' . $row, $folio->TELEFONODENUNCIANTE);
			$sheet->setCellValue('N' . $row, $folio->CORREODENUNCIANTE);
			$sheet->setCellValue('O' . $row, isset($folio->DELITOMODALIDADDESCR) ? $folio->DELITOMODALIDADDESCR : 'NO EXISTE');
			$sheet->setCellValue('P' . $row, $folio->N_AGENT . ' ' . $folio->APP_AGENT . ' ' . $folio->APM_AGENT);
			$sheet->setCellValue('Q' . $row, isset($folio->TIPOEXPEDIENTEDESCR) ? $folio->TIPOEXPEDIENTEDESCR : $folio->STATUS);
			if (isset($folio->EXPEDIENTEID)) {
				$arrayExpediente = str_split($folio->EXPEDIENTEID);
				$expedienteid = $arrayExpediente[1] . $arrayExpediente[2] . $arrayExpediente[4] . $arrayExpediente[5] . '-' . $arrayExpediente[6] . $arrayExpediente[7] . $arrayExpediente[8] . $arrayExpediente[9] . '-' . $arrayExpediente[10] . $arrayExpediente[11] . $arrayExpediente[12] . $arrayExpediente[13] . $arrayExpediente[14];
			}
			$sheet->setCellValue('R' . $row, $folio->EXPEDIENTEID ? $expedienteid . '/' . $folio->TIPOEXPEDIENTECLAVE : "SIN EXPEDIENTE");
			$sheet->setCellValue('S' . $row, $remision); //remision
			$sheet->setCellValue('T' . $row, "");

			$sheet->getRowDimension($row)->setRowHeight(20, 'pt');

			if (!(($row - 4) >= count($resultFilter->result))) $row++;
		}
		$sheet->getStyle('A1:T1')->applyFromArray($styleCab);
		$sheet->getStyle('A2:T2')->applyFromArray($styleCab);

		$sheet->getStyle('A4:T4')->applyFromArray($styleHeaders);
		$sheet->getStyle('A5:T' . $row)->applyFromArray($styleCells);

		$sheet->mergeCells('A1:T1');
		$sheet->mergeCells('A2:T2');
		$drawing = new \PhpOffice\PhpSpreadsheet\Worksheet\Drawing();
		$drawing->setName('FGEBC');
		$drawing->setDescription('LOGO');
		$drawing->setPath(FCPATH . 'assets/img/FGEBC_recortada.png'); // put your path and image here
		$drawing->setHeight(60);
		$drawing->setCoordinates('A1');
		$drawing->setOffsetX(10);
		$drawing->setWorksheet($spreadSheet->getActiveSheet());
		$writer = new Xlsx($spreadSheet);

		$filename = urlencode("BITACORA_REGISTROS_DE_ATENCIONES.xlsx");
		header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
		header("Content-Disposition: attachment; filename=\"$filename\"");
		header("Content-Transfer-Encoding: binary");
		header("Cache-Control: max-age=0");
		$writer->save("php://output");
	}

	/**
	 * Vista para ingresar a los reportes de ceeiav 
	 * Se carga con un filtro default
	 *
	 */
	public function getComisionEstatal()
	{
		// Datos del filtro

		$dataPost = [
			'fechaInicio' => date("Y-m-d", strtotime('-1 month')),
			'fechaFin' => date("Y-m-d")
		];
		//Filtro

		$documentos = $this->_plantillasModelRead->filtro_comision_estatal($dataPost);
		$municipio = $this->_municipiosModelRead->asObject()->where('ESTADOID', 2)->findAll();
		$where = "ROLID = 2 OR ROLID = 3 OR ROLID = 4 OR ROLID = 6 OR ROLID = 7 OR ROLID = 8 OR ROLID = 9 OR ROLID = 10";
		$empleado = $this->_usuariosModelRead->asObject()->where($where)->orderBy('NOMBRE', 'ASC')->findAll();


		$dataView = (object)array();
		$dataView->rolPermiso = $this->_rolesPermisosModelRead->asObject()->where('ROLID', session('ROLID'))->findAll();
		$dataView->municipios = $municipio;
		$dataView->empleados = $empleado;
		$dataView->dataDocumentos = $documentos;
		$dataView->filterParams = (object)$dataPost;

		$this->_loadView('Reporte CEEIAV', 'registro_ceeiav', '', $dataView, 'registro_ceeiav');
	}
	/**
	 * Función para realizar un filtro en reporte de ceeiav.
	 * Recibe por metodo POST los datos del formulario del filtro
	 *
	 */
	public function postComisionEstatal()
	{
		//Datos del filtro

		$dataPost = [
			'MUNICIPIOID' => $this->request->getPost('MUNICIPIOID'),
			'AGENTEATENCIONID' => $this->request->getPost('AGENTEATENCIONID'),

			'fechaInicio' => $this->request->getPost('fechaInicio'),
			'fechaFin' => $this->request->getPost('fechaFin'),
			'horaInicio' => $this->request->getPost('horaInicio'),
			'horaFin' => $this->request->getPost('horaFin'),

			'nombreAgente' => '',
			'municipioDescr' => ''
		];

		$municipio = $this->_municipiosModelRead->asObject()->where('ESTADOID', 2)->findAll();
		$where = "ROLID = 2 OR ROLID = 3 OR ROLID = 4 OR ROLID = 6 OR ROLID = 7 OR ROLID = 8 OR ROLID = 9 OR ROLID = 10";
		$empleado = $this->_usuariosModelRead->asObject()->where($where)->orderBy('NOMBRE', 'ASC')->findAll();
		//Generacion del filtro

		$documentos = $this->_plantillasModelRead->filtro_comision_estatal($dataPost);

		if (!empty($dataPost['AGENTEATENCIONID'])) {
			foreach ($empleado as $index => $dato) {
				//var_dump('info empleado', $dato);
				if ($dato->ID == $dataPost['AGENTEATENCIONID']) {
					//var_dump('info empleado', $dato);
					$dataPost['nombreAgente'] = $dato->NOMBRE . ' ' . $dato->APELLIDO_PATERNO . ' ' . $dato->APELLIDO_MATERNO;
				}
			}
		}
		if (!empty($dataPost['MUNICIPIOID'])) {
			foreach ($municipio as $index => $dato) {
				///var_dump('info municipio', $dato);
				if ($dato->MUNICIPIOID == $dataPost['MUNICIPIOID']) {
					$dataPost['municipioDescr'] = $dato->MUNICIPIODESCR;
				}
			}
		}


		$dataView = (object)array();
		$dataView->rolPermiso = $this->_rolesPermisosModelRead->asObject()->where('ROLID', session('ROLID'))->findAll();
		$dataView->municipios = $municipio;
		$dataView->empleados = $empleado;
		$dataView->dataDocumentos = $documentos;
		$dataView->filterParams = (object)$dataPost;

		$this->_loadView('Reporte CEEIAV', 'registro_ceeiav', '', $dataView, 'registro_ceeiav');
	}
	/**
	 * Función para generar el reporte XLSX de ceeiav
	 * Recibe por metodo POST los datos del filtro
	 *
	 */
	public function createComisionEstatalXlsx()
	{
		//Datos del filtro

		$dataPost = [
			'MUNICIPIOID' => $this->request->getPost('MUNICIPIOID'),
			'AGENTEATENCIONID' => $this->request->getPost('AGENTEATENCIONID'),

			'fechaInicio' => $this->request->getPost('fechaInicio'),
			'fechaFin' => $this->request->getPost('fechaFin'),
			'horaInicio' => $this->request->getPost('horaInicio'),
			'horaFin' => $this->request->getPost('horaFin'),
		];

		foreach ($dataPost as $clave => $valor) {
			//Recorre el array y elimina los valores que nulos o vacíos
			if (empty($valor)) unset($dataPost[$clave]);
		}
		//Cuando no hay filtro

		if (count($dataPost) <= 0) {
			$dataPost = [
				'fechaInicio' => date("Y-m-d", strtotime('-1 month')),
				'fechaFin' => date("Y-m-d"),
			];
		}
		//Generacion del filtro

		$documentos = $this->_plantillasModelRead->filtro_comision_estatal($dataPost);

		$date = date("Y_m_d_h_i_s");

		$spreadSheet = new Spreadsheet();
		$spreadSheet->getProperties()
			->setCreator("Fiscalía General del Estado de Baja California")
			->setLastModifiedBy("Fiscalía General del Estado de Baja California")
			->setTitle("REPORTE_CEEAIV" . $date)
			->setSubject("REPORTE_CEEAIV" . $date)
			->setDescription(
				"El presente documento fue generado por el Centro de Denuncia Tecnológica de la Fiscalía General del Estado de Baja California."
			)
			->setKeywords("reporte ceeiav cdtec fgebc")
			->setCategory("Reportes");
		$sheet = $spreadSheet->getActiveSheet();

		//Estilos y caracteristicas
		$styleHeaders = [
			'font' => [
				'bold' => true,
				'color' => ['argb' => 'FFFFFF'],
				'name' => 'Arial',
				'size' => '10'
			],
			'alignment' => [
				'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
				'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
			],
			'borders' => [
				'allBorders' => [
					'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
					'color' => ['argb' => '000000'],
				],
			],
			'fill' => [
				'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_GRADIENT_LINEAR,
				'rotation' => 90,
				'startColor' => [
					'argb' => '511229',
				],
				'endColor' => [
					'argb' => '511229',
				],
			],
		];

		$styleCab = [
			'font' => [
				'bold' => true,
				'color' => ['argb' => '000000'],
				'name' => 'Arial',
				'size' => '12'
			],
			'alignment' => [
				'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,

			],

		];

		$styleCells = [
			'font' => [
				'bold' => false,
				'color' => ['argb' => '000000'],
				'name' => 'Arial',
				'size' => '10'
			],
			'alignment' => [
				'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
				'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
			],
			'borders' => [
				'allBorders' => [
					'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
					'color' => ['argb' => '000000'],
				],
			],
			'fill' => [
				'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_GRADIENT_LINEAR,
				'rotation' => 90,
				'startColor' => [
					'argb' => 'FFFFFF',
				],
				'endColor' => [
					'argb' => 'FFFFFF',
				],
			],
		];
		$row = 4;

		$columns = [
			'A', 'B', 'C', 'D', 'E',
			'F', 'G', 'H', 'I', 'J',
			'K', 'L', 'M', 'N', 'O',
			'P', 'Q', 'R', 'S', 'T',
			'U', 'V', 'W', 'X', 'Y', 'Z'
		];
		$headers = [
			"No.",
			"Folio",
			"FECHA DE EXPEDICIÓN",
			"NO. EXPEDIENTE",
			"MODULO QUE EXPIDE",
			"MUNICIPIO DE CANALIZACION",
			"SERVIDOR PUBLICO SOLICITANTE",
			"DELITO",
			"VICTIMA/OFENDIDO",
		];

		for ($i = 0; $i < count($headers); $i++) {
			$sheet->setCellValue($columns[$i] . 4, $headers[$i]);
			$sheet->getColumnDimension($columns[$i])->setAutoSize(true);
		}

		$sheet->getRowDimension($row)->setRowHeight(20, 'pt');

		$row++;
		$num = 1;
		//Rellenado del XLSX

		foreach ($documentos as $index => $orden) {
			$this->separarExpID($orden->EXPEDIENTEID);


			$sheet->setCellValue('A1', "CENTRO TELEFÓNICO Y EN LÍNEA DE ATENCIÓN Y ORIENTACIÓN TEMPRANA");
			$sheet->setCellValue('A2', "REGISTRO DE CANALIZACIONES A LA COMISIÓN EJECUTIVA ESTATAL DE ATENCIÓN INTEGRAL A VÍCTIMAS");

			$sheet->setCellValue('A' . $row, $num);
			$sheet->setCellValue('B' . $row, $orden->FOLIOID . "/" . $orden->ANO);
			$sheet->setCellValue('C' . $row, $this->formatFecha($orden->FECHAFIRMA));
			$sheet->setCellValue('D' . $row, $this->separarExpID($orden->EXPEDIENTEID));
			$sheet->setCellValue('E' . $row, 'CENTRO DE DENUNCIA TECNÓLOGICA');
			$sheet->setCellValue('F' . $row,  $orden->MUNICIPIODESCR);
			$sheet->setCellValue('G' . $row,  $orden->NOMBRE_MP);
			$sheet->setCellValue('H' . $row,  $orden->DELITOMODALIDADDESCR);
			$sheet->setCellValue('I' . $row,  $orden->NOMBRE_VTM);
			$sheet->setCellValue('J' . $row, '');

			$sheet->getRowDimension($row)->setRowHeight(20, 'pt');

			if (!(($row - 4) >= count($documentos))) $row++;
			$num++;
		}
		$sheet->getStyle('A1:J1')->applyFromArray($styleCab);
		$sheet->getStyle('A2:I2')->applyFromArray($styleCab);

		$sheet->getStyle('A4:J4')->applyFromArray($styleHeaders);
		$sheet->getStyle('A5:J' . $row)->applyFromArray($styleCells);

		$sheet->mergeCells('A1:J1');
		$sheet->mergeCells('A2:J2');
		$drawing = new \PhpOffice\PhpSpreadsheet\Worksheet\Drawing();
		$drawing->setName('FGEBC');
		$drawing->setDescription('LOGO');
		$drawing->setPath(FCPATH . 'assets/img/FGEBC_recortada.png'); // put your path and image here
		$drawing->setHeight(60);
		$drawing->setCoordinates('A1');
		$drawing->setOffsetX(10);
		$drawing->setWorksheet($spreadSheet->getActiveSheet());
		// $drawing2 = new \PhpOffice\PhpSpreadsheet\Worksheet\Drawing();
		// $drawing2->setName('FGEBC');
		// $drawing2->setDescription('LOGO');
		// $drawing2->setPath(FCPATH . 'assets/img/logo_sejap.jpg'); // put your path and image here
		// $drawing2->setHeight(45);
		// $drawing2->setCoordinates('O1');
		// $drawing2->setOffsetX(-30);
		// $drawing2->setWorksheet($spreadSheet->getActiveSheet());
		// $drawing->setOffsetX(110);
		// $drawing->setRotation(25);
		$writer = new Xlsx($spreadSheet);

		$filename = urlencode("Reporte_Ceeaiv_" . $date . ".xlsx");
		header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
		header("Content-Disposition: attachment; filename=\"$filename\"");
		header("Content-Transfer-Encoding: binary");
		header("Cache-Control: max-age=0");
		$writer->save("php://output");
	}
	/**
	 * Función CURL GET para el serivicio de videollamada 
	 *
	 * @param  mixed $endpoint
	 */
	private function _curlGetService($endpoint)
	{
		$ch = curl_init();

		curl_setopt($ch, CURLOPT_URL, $endpoint);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

		$headers = array(
			'Content-Type: application/json',
			'Access-Control-Allow-Origin: *',
			'Access-Control-Allow-Credentials: true',
			'Access-Control-Allow-Headers: Content-Type',
			'X-API-KEY:' . X_API_KEY
		);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

		$result = curl_exec($ch);

		return json_decode(curl_exec($ch));
		if ($result === false) {
			$result = "{
                'status' => 401,
                'error' => 'Curl failed: '" . curl_error($ch) . "
            }";
		}
		curl_close($ch);

		return json_decode($result);
	}
	/**
	 * Función CURL POST a Justicia sin encriptacion
	 *
	 * @param  mixed $endpoint
	 * @param  mixed $data
	 */
	private function _curlPost($endpoint, $data)
	{
		$ch = curl_init();

		curl_setopt($ch, CURLOPT_URL, $endpoint);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
		$headers = array(
			'Content-Type: application/json',
			'Access-Control-Allow-Origin: *',
			'Access-Control-Allow-Credentials: true',
			'Access-Control-Allow-Headers: Content-Type',
			'Hash-API: ' . password_hash(TOKEN_API, PASSWORD_BCRYPT)
		);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

		$result = curl_exec($ch);

		if ($result === false) {
			$result = "{
                'status' => 401,
                'error' => 'Curl failed: '" . curl_error($ch) . "
            }";
		}
		curl_close($ch);

		return json_decode($result);
	}

	/**
	 * Función para cargar cualquier vista en cualquier función.
	 *
	 * @param  mixed $title
	 * @param  mixed $menu
	 * @param  mixed $submenu
	 * @param  mixed $data
	 * @param  mixed $view
	 */
	private function _loadView($title, $menu, $submenu, $data, $view)
	{
		$data2 = [
			'header_data' => (object)['title' => $title, 'menu' => $menu, 'submenu' => $submenu],
			'body_data' => $data
		];

		echo view("admin/dashboard/reportes/$view", $data2);
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
	 * Funcion para separar el expediente en formato SEJAp
	 *
	 * @param  mixed $expId
	 */
	public function separarExpID($expId)
	{
		$array = str_split($expId);
		return $array[2] . $array[4] . $array[5] . '-' . $array[6] . $array[7] . $array[8] . $array[9] . '-' . $array[10] . $array[11] . $array[12] . $array[13] . $array[14];
	}

	/**
	 * Funcion para formatear fecha en d/m/y
	 *
	 * @param  mixed $date
	 */
	public function formatFecha($date)
	{
		return date("d/m/Y", strtotime($date));
	}

	/**
	 * Funcion para formatear string a hora en formato hora:minutos:segundos
	 *
	 * @param  mixed $string
	 */
	function stringToTime($string)
	{
		$tiempo = strtotime($string);
		if ($tiempo === false) {
			return '';
		}

		return date('H:i:s', $tiempo);
	}
}
