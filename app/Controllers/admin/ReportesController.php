<?php

namespace App\Controllers\admin;

use App\Models\FolioModel;
use App\Controllers\BaseController;
use App\Models\ConstanciaExtravioModel;
use App\Models\MunicipiosModel;
use App\Models\RolesPermisosModel;
use App\Models\UsuariosModel;
use App\Models\PlantillasModel;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
// use Aws\S3\S3Client;
// use FFMpeg\FFMpeg;
// use FFMpeg\FFProbe;
// use DateTime;
// use DateTimeZone;

class ReportesController extends BaseController
{
	private $_folioModel;
	private $_municipiosModel;
	private $_usuariosModel;
	private $_constanciaExtravioModel;
	private $_rolesPermisosModel;
	private $_plantillasModel;
	private $urlApi;

	function __construct()
	{
		$this->_folioModel = new FolioModel();
		$this->_municipiosModel = new MunicipiosModel();
		$this->_usuariosModel = new UsuariosModel();
		$this->_constanciaExtravioModel = new ConstanciaExtravioModel();
		$this->_rolesPermisosModel = new RolesPermisosModel();
		$this->_plantillasModel = new PlantillasModel();
		$this->urlApi = VIDEOCALL_URL;
	}

	public function index()
	{
		if (!$this->permisos('REPORTES')) {
			return redirect()->back()->with('message_error', 'Acceso denegado, no tienes los permisos necesarios.');
		}
		$dataView = (object)array();
		$dataView->rolPermiso = $this->_rolesPermisosModel->asObject()->where('ROLID', session('ROLID'))->findAll();

		$this->_loadView('Reportes', 'Reportes', '', $dataView, 'index');
	}

	public function getFolios()
	{
		$data = [
			'fechaInicio' => date("Y-m-d", strtotime('-1 month')),
			'fechaFin' => date("Y-m-d"),
		];

		$municipio = $this->_municipiosModel->asObject()->where('ESTADOID', 2)->findAll();
		$resultFilter = $this->_folioModel->filterDates($data);
		$where = "ROLID = 2 OR ROLID = 3 OR ROLID = 4 OR ROLID = 6 OR ROLID = 7 OR ROLID = 8 OR ROLID = 9 OR ROLID = 10";
		$empleado = $this->_usuariosModel->asObject()->where($where)->orderBy('NOMBRE', 'ASC')->findAll();

		$dataView = (object)array();
		$dataView->result = $resultFilter->result;
		$dataView->municipios = $municipio;
		$dataView->empleados = $empleado;
		$dataView->filterParams = (object)$data;
		$dataView->rolPermiso = $this->_rolesPermisosModel->asObject()->where('ROLID', session('ROLID'))->findAll();

		$this->_loadView('Folios generados', 'folios', '', $dataView, 'folios');
	}

	public function postFolios()
	{
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
		if (count($data) <= 0) {
			$data = [
				'fechaInicio' => date("Y-m-d", strtotime('-1 month')),
				'fechaFin' => date("Y-m-d"),
			];
		}

		$municipio = $this->_municipiosModel->asObject()->where('ESTADOID', 2)->findAll();
		$resultFilter = $this->_folioModel->filterDates($data);
		$where = "ROLID = 2 OR ROLID = 3 OR ROLID = 4 OR ROLID = 6 OR ROLID = 7 OR ROLID = 8 OR ROLID = 9 OR ROLID = 10";
		$empleado = $this->_usuariosModel->asObject()->where($where)->orderBy('NOMBRE', 'ASC')->findAll();

		if (isset($data['AGENTEATENCIONID'])) {
			$agente = $this->_usuariosModel->asObject()->where('ID', $data['AGENTEATENCIONID'])->orderBy('NOMBRE', 'ASC')->first();
			$data['AGENTENOMBRE'] = $agente->NOMBRE . ' ' . $agente->APELLIDO_PATERNO . ' ' . $agente->APELLIDO_MATERNO;
		}

		if (isset($data['MUNICIPIOID'])) {
			$mun = $this->_municipiosModel->asObject()->where('ESTADOID', 2)->where('MUNICIPIOID', $data['MUNICIPIOID'])->first();
			$data['MUNICIPIONOMBRE'] = $mun->MUNICIPIODESCR;
		}

		$dataView = (object)array();
		$dataView->result = $resultFilter->result;
		$dataView->municipios = $municipio;
		$dataView->empleados = $empleado;
		$dataView->filterParams = (object)$data;
		$dataView->rolPermiso = $this->_rolesPermisosModel->asObject()->where('ROLID', session('ROLID'))->findAll();

		$this->_loadView('Folios generados', 'folios', '', $dataView, 'folios');
	}

	public function createFoliosXlsx()
	{
		$data = [
			'MUNICIPIOID' => $this->request->getPost('municipio'),
			'AGENTEATENCIONID' => $this->request->getPost('agente'),
			'STATUS' => $this->request->getPost('status'),
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
		if (count($data) <= 0) {
			$data = [
				'fechaInicio' => date("Y-m-d", strtotime('-1 month')),
				'fechaFin' => date("Y-m-d"),
			];
		}

		$resultFilter = $this->_folioModel->filterDates($data);

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

		foreach ($resultFilter->result as $index => $folio) {
			$tipo = '';
			if ($folio->TIPODENUNCIA == 'VD') {
				$tipo = 'VIDEO';
			} else if ($folio->TIPODENUNCIA == 'DA') {
				$tipo = 'ANÓNIMA';
			} else {
				$tipo = 'TELEFÓNICA';
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
			$sheet->setCellValue('G' . $row, $folio->N_DENUNCIANTE . ' ' . $folio->APP_DENUNCIANTE . ' ' . $folio->APM_DENUNCIANTE);
			$sheet->setCellValue('H' . $row, $folio->N_AGENT . ' ' . $folio->APP_AGENT . ' ' . $folio->APM_AGENT);
			$sheet->setCellValue('I' . $row, $folio->ESTADODESCR);
			$sheet->setCellValue('J' . $row, $folio->MUNICIPIODESCR);
			$sheet->setCellValue('K' . $row, $folio->STATUS);

			$sheet->getRowDimension($row)->setRowHeight(20, 'pt');

			if (!(($row - 1) >= count($resultFilter->result))) $row++;
		}

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

	public function getConstancias()
	{
		$data = [
			'fechaInicio' => date("Y-m-d", strtotime('-1 month')),
			'fechaFin' => date("Y-m-d"),
		];

		foreach ($data as $clave => $valor) {
			if (empty($valor)) unset($data[$clave]);
		}

		$municipio = $this->_municipiosModel->asObject()->where('ESTADOID', 2)->findAll();
		$resultFilter = $this->_constanciaExtravioModel->filterDates($data);
		$where = "ROLID = 2 OR ROLID = 3 OR ROLID = 4 OR ROLID = 6 OR ROLID = 7 OR ROLID = 8 OR ROLID = 9 OR ROLID = 10";
		$empleado = $this->_usuariosModel->asObject()->where($where)->orderBy('NOMBRE', 'ASC')->findAll();

		$dataView = (object)array();
		$dataView->result = $resultFilter->result;
		$dataView->municipios = $municipio;
		$dataView->empleados = $empleado;
		$dataView->filterParams = (object)$data;
		$dataView->rolPermiso = $this->_rolesPermisosModel->asObject()->where('ROLID', session('ROLID'))->findAll();

		$this->_loadView('Constancias generadas', 'constancias', '', $dataView, 'constancias');
	}


	public function postConstancias()
	{
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
		if (count($data) <= 0) {
			$data = [
				'fechaInicio' => date("Y-m-d", strtotime('-1 month')),
				'fechaFin' => date("Y-m-d"),
			];
		}

		$municipio = $this->_municipiosModel->asObject()->where('ESTADOID', 2)->findAll();
		$resultFilter = $this->_constanciaExtravioModel->filterDates($data);
		$where = "ROLID = 2 OR ROLID = 3 OR ROLID = 4 OR ROLID = 6 OR ROLID = 7 OR ROLID = 8 OR ROLID = 9 OR ROLID = 10";
		$empleado = $this->_usuariosModel->asObject()->where($where)->orderBy('NOMBRE', 'ASC')->findAll();

		if (isset($data['AGENTEID'])) {
			$agente = $this->_usuariosModel->asObject()->where('ID', $data['AGENTEID'])->orderBy('NOMBRE', 'ASC')->first();
			$data['AGENTENOMBRE'] = $agente->NOMBRE . ' ' . $agente->APELLIDO_PATERNO . ' ' . $agente->APELLIDO_MATERNO;
		}

		if (isset($data['MUNICIPIOID'])) {
			$mun = $this->_municipiosModel->asObject()->where('ESTADOID', 2)->where('MUNICIPIOID', $data['MUNICIPIOID'])->first();
			$data['MUNICIPIONOMBRE'] = $mun->MUNICIPIODESCR;
		}

		$dataView = (object)array();
		$dataView->result = $resultFilter->result;
		$dataView->municipios = $municipio;
		$dataView->empleados = $empleado;
		$dataView->filterParams = (object)$data;
		$dataView->rolPermiso = $this->_rolesPermisosModel->asObject()->where('ROLID', session('ROLID'))->findAll();

		$this->_loadView('Constancias generadas', 'constancias', '', $dataView, 'constancias');
	}


	public function createConstanciasXlsx()
	{
		$data = [
			'MUNICIPIOID' => $this->request->getPost('municipio'),
			'AGENTEID' => $this->request->getPost('agente'),
			'STATUS' => $this->request->getPost('status'),
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
		if (count($data) <= 0) {
			$data = [
				'fechaInicio' => date("Y-m-d", strtotime('-1 month')),
				'fechaFin' => date("Y-m-d"),

			];
		}


		$resultFilter = $this->_constanciaExtravioModel->filterDates($data);

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
		$headers = [
			'CONSTANCIA',
			'AÑO',
			'FECHA DE FIRMA',
			'NOMBRE DEL SOLICITANTE',
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

		foreach ($resultFilter->result as $index => $constancia) {

			$sheet->setCellValue('A' . $row, $constancia->CONSTANCIAEXTRAVIOID);
			$sheet->setCellValue('B' . $row, $constancia->ANO);
			$sheet->setCellValue('C' . $row, isset($constancia->FECHAFIRMA) ? $constancia->FECHAFIRMA : '');
			$sheet->setCellValue('D' . $row, $constancia->N_SOLICITANTE . ' ' . $constancia->APP_SOLICITANTE . ' ' . $constancia->APM_SOLICITANTE);
			$sheet->setCellValue('E' . $row, isset($constancia->N_AGENT) ? $constancia->N_AGENT . ' ' . $constancia->APP_AGENT . ' ' . $constancia->APM_AGENT : 'NO SE HA FIRMADO');
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

		$sheet->getStyle('A1:H1')->applyFromArray($styleHeaders);
		$sheet->getStyle('A2:H' . $row)->applyFromArray($styleCells);
		$sheet->setCellValue('H' . $row, $constancia->STATUS);

		$writer = new Xlsx($spreadSheet);

		$filename = urlencode("Reporte_Constancias_" . $date . ".xlsx");
		header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
		header("Content-Disposition: attachment; filename=\"$filename\"");
		header("Content-Transfer-Encoding: binary");
		header("Cache-Control: max-age=0");
		$writer->save("php://output");
	}

	public function getRegistroDiario()
	{
		$data = [
			'fechaInicio' => date("Y-m-d"),
			'fechaFin' => date("Y-m-d"),
		];
		foreach ($data as $clave => $valor) {
			if (empty($valor)) unset($data[$clave]);
		}

		$municipio = $this->_municipiosModel->asObject()->where('ESTADOID', 2)->findAll();

		$where = "ROLID = 2 OR ROLID = 3 OR ROLID = 4 OR ROLID = 6 OR ROLID = 7 OR ROLID = 8 OR ROLID = 9 OR ROLID = 10";
		$rolUser = session()->get('rol')->ID;
		if ($rolUser == 1 || $rolUser == 2 || $rolUser == 6 || $rolUser == 7 || $rolUser == 11) {
			$empleado = $this->_usuariosModel->asObject()->where($where)->orderBy('NOMBRE', 'ASC')->findAll();
			//$data['AGENTEATENCIONID'] = session('ID');
		} else {
			$empleado = $this->_usuariosModel->asObject()->where('ID',	session('ID'))->orderBy('NOMBRE', 'ASC')->findAll();
			$data['AGENTEATENCIONID'] = session('ID');
		}
		$resultFilter = $this->_folioModel->filterDatesRegistroDiario($data);

		$dataView = (object)array();
		$dataView->result = $resultFilter->result;
		$dataView->municipios = $municipio;
		$dataView->empleados = $empleado;
		$dataView->filterParams = (object)$data;
		$dataView->rolPermiso = $this->_rolesPermisosModel->asObject()->where('ROLID', session('ROLID'))->findAll();

		$this->_loadView('Registro diario', 'registro diario', '', $dataView, 'registro_diario');
	}

	public function postRegistroDiario()
	{
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
		if (count($data) <= 0) {
			$data = [
				'fechaInicio' => date("Y-m-d", strtotime('-1 month')),
				'fechaFin' => date("Y-m-d"),
			];
		}

		$resultFilter = $this->_folioModel->filterDatesRegistroDiario($data);
		///var_dump($data);
		$where = "ROLID = 2 OR ROLID = 3 OR ROLID = 4 OR ROLID = 6 OR ROLID = 7 OR ROLID = 8 OR ROLID = 9 OR ROLID = 10";
		$empleado = $this->_usuariosModel->asObject()->where($where)->orderBy('NOMBRE', 'ASC')->findAll();

		if (isset($data['AGENTEATENCIONID'])) {
			$agente = $this->_usuariosModel->asObject()->where('ID', $data['AGENTEATENCIONID'])->orderBy('NOMBRE', 'ASC')->first();
			$data['AGENTENOMBRE'] = $agente->NOMBRE . ' ' . $agente->APELLIDO_PATERNO . ' ' . $agente->APELLIDO_MATERNO;
		}



		$dataView = (object)array();
		$dataView->result = $resultFilter->result;
		$dataView->empleados = $empleado;
		$dataView->filterParams = (object)$data;

		$dataView->rolPermiso = $this->_rolesPermisosModel->asObject()->where('ROLID', session('ROLID'))->findAll();

		$this->_loadView('Registro diario', 'registro diario', '', $dataView, 'registro_diario');
	}

	public function createRegistroDiarioXlsx()
	{

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
		//var_dump($data);
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

		$resultFilter = $this->_folioModel->filterDatesRegistroDiario($data);
		//var_dump($resultFilter);
		//exit;
		$spreadSheet = new Spreadsheet();
		$spreadSheet->getProperties()
			->setCreator("Fiscalía General del Estado de Baja California")
			->setLastModifiedBy("Fiscalía General del Estado de Baja California")
			->setTitle("REGISTRO_DIARIO" . $date)
			->setSubject("REGISTRO_DIARIO" . $date)
			->setDescription(
				"El presente documento fue generado por el Centro de Denuncia Tecnológica de la Fiscalía General del Estado de Baja California."
			)
			->setKeywords("registro diario cdtec fgebc")
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


		foreach ($resultFilter->result as $index => $folio) {
			// $endpoint = 'https://videodenunciaserver1.fgebc.gob.mx/api/vc';
			// $data = array();
			// $data['u'] = '24';
			// $data['token'] = '198429b7cc8a2a5733d97bc13153227dd5017555';
			// $data['a'] = 'getRepo';
			// $data['folio'] = $folio->ANO . '-' . $folio->FOLIOID;
			// $data['min'] = '2022-01-01';
			// $data['max'] = date('Y-m-d');
			// $duracion = '';
			$inicio = '';
			$fin = '';
			// $remision = '';
			// $grabacion = '';
			$duracion = '';
			$horas = '';
			$segundos = '';
			$minutos = '';
			$timestamp = '';

			// $response = $this->_curlPost($endpoint, $data);
			// if ($response->data > 0) {
			// 	$array = array_reverse($response->data);
			// 	foreach ($array as $key => $api) {
			// 		$duracion = $api->Duración;
			// 		$inicio = $api->Inicio;
			// 		$fin = $api->Fin;
			// 		if ($api->Grabación != '') {
			// 			$grabacion = $api->Grabación;
			// 		}
			// 	}
			// }
			if ($folio->TIPOEXPEDIENTEID == 1 || $folio->TIPOEXPEDIENTEID == 4) {
				$remision = $folio->OFICINA_EMP;
			} else if ($folio->TIPOEXPEDIENTEID == 5) {
				$remision = $folio->REMISION_RAC;
			} else if ($folio->STATUS == "DERIVADO") {
				$remision = $folio->REMISION_DERIVACION;
			} else if ($folio->STATUS == "CANALIZADO") {
				$remision = $folio->REMISION_CANALIZACION;
			}


			// $ffprobe = FFProbe::create([
			// 	'ffmpeg.binaries'  => 'C:/ffmpeg/bin/ffmpeg.exe', // the path to the FFMpeg binary
			// 	'ffprobe.binaries' => 'C:/ffmpeg/bin/ffprobe.exe', // the path to the FFProbe binary
			// 	'timeout'          => 3600, // the timeout for the underlying process
			// 	'ffmpeg.threads'   => 12,   // the number of threads that FFMpeg should use
			// ]);
			// if ($response->data > 0 && $grabacion != '') {
			// 	$duration = $ffprobe
			// 		->streams('https://fgebc-records.s3.amazonaws.com/' . $grabacion)
			// 		->videos()
			// 		->first()
			// 		->get('duration');
			// } else if ($response->data[0]->Grabación) {
			// 	$duration = $ffprobe
			// 		->streams('https://fgebc-records.s3.amazonaws.com/' . $response->data[0]->Grabación)
			// 		->videos()
			// 		->first()
			// 		->get('duration');
			// }

			$endpointFolio = $this->urlApi . 'recordings/folio?folio=' . $folio->FOLIOID . '/' . $folio->ANO;

			$responseFolio = $this->_curlGetService($endpointFolio);
			// return json_encode($responseFolio);

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
				// return json_encode($responseFolio);
				// if ($duration != '') {
				// 	$horas = floor($duration / 3600);
				// 	$minutos = floor(($duration - ($horas * 3600)) / 60);
				// 	$segundos = $duration - ($horas * 3600) - ($minutos * 60);
				// }
			}
			// $row++;
			// if(isset($folio->DELITOMODALIDADDESCR)){
			// 	foreach ($folio->DELITOMODALIDADDESCR as $key => $delito){
			// 		var_dump($delito);
			// 		exit;
			// 	}
			// }
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
			} else {
				$tipo = 'TELEFÓNICA';
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
		header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
		header("Content-Disposition: attachment; filename=\"$filename\"");
		header("Content-Transfer-Encoding: binary");
		header("Cache-Control: max-age=0");
		$writer->save("php://output");
	}

	public function getFielReport()
	{
		$data = (object) array();
		if (!$this->permisos('USUARIOS')) {
			return redirect()->back()->with('message_error', 'Acceso denegado, no tienes los permisos necesarios.');
		}
		$data->usuario = $this->_usuariosModel->asObject()
			->select('USUARIOS.*, ROLES.NOMBRE_ROL, ZONAS_USUARIOS.NOMBRE_ZONA, MUNICIPIO.MUNICIPIODESCR,OFICINA.OFICINADESCR')
			->join('ROLES', 'ROLES.ID = USUARIOS.ROLID', 'LEFT')
			->join('ZONAS_USUARIOS', 'ZONAS_USUARIOS.ID_ZONA = USUARIOS.ZONAID', 'LEFT')
			->join('MUNICIPIO', 'MUNICIPIO.MUNICIPIOID = USUARIOS.MUNICIPIOID AND MUNICIPIO.ESTADOID = 2', 'LEFT')
			->join('OFICINA', 'OFICINA.OFICINAID = USUARIOS.OFICINAID AND OFICINA.MUNICIPIOID = USUARIOS.MUNICIPIOID AND OFICINA.ESTADOID = 2', 'LEFT')
			->where('ROLID !=', 1)
			->orderBy('ROLES.NOMBRE_ROL', 'ASC')
			->orderBy('USUARIOS.NOMBRE', 'ASC')
			->findAll();
		$data->rolPermiso = $this->_rolesPermisosModel->asObject()->where('ROLID', session('ROLID'))->findAll();

		$this->_loadView('FIEL', 'fiel', '', $data, 'fiel');
	}

	public function getReporteLlamadas()
	{

		$endpoint = $this->urlApi . "call-records?pageSize=0";
		$response = $this->_curlGetService($endpoint);
		// var_dump($response->data);exit;
		if ($response->statusCode == "success") {
			$dataView = (object)array();
			$dataView->llamadas = $response->data;
			$dataView->rolPermiso = $this->_rolesPermisosModel->asObject()->where('ROLID', session('ROLID'))->findAll();
			$empleado = array();
			$llamadas = array();

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


			$this->_loadView('Reportes llamadas', 'reportes_llamadas', '', $dataView, 'reportes_llamadas');
		}
	}
	// $endpoint = 'https://videodenunciaserver1.fgebc.gob.mx/api/vc';
	// $data = array();
	// $data['u'] = '24';
	// $data['token'] = '198429b7cc8a2a5733d97bc13153227dd5017555';
	// $data['a'] = 'getRepo';
	// $data['min'] = '2022-01-01';
	// $data['max'] = date('Y-m-d');

	// $response = $this->_curlPost($endpoint, $data);
	// $llamadas = array();
	// $empleado = array();
	// $promedio = 0;
	// foreach ($response->data as $key => $value) {
	// 	// foreach ($value as $array => $data) {
	// 	//iterar datos de cada una de las llamadas
	// 	// }
	// 	if ($value->Estatus == 'Terminada' && $value->Grabación) {
	// 		$idAgente = 'id Agente';
	// 		array_push($empleado, (object)['ID' => $value->$idAgente, 'NOMBRE' => $value->Agente]);
	// 		$value->Fecha = date("Y-m-d H:i:s", strtotime('-2 hour', strtotime($value->Fecha)));
	// 		$value->Inicio = date("Y-m-d H:i:s", strtotime('-2 hour', strtotime($value->Inicio)));
	// 		$value->Fin = date("Y-m-d H:i:s", strtotime('-2 hour', strtotime($value->Fin)));
	// 		array_push($llamadas, $value);
	// 		$promedio += strtotime($value->Duración) - strtotime("TODAY");
	// 	}
	// }



	public function postReporteLlamadas()
	{
		$dataPost = (object) [
			'sessionStartedAt' => $this->request->getPost('fechaInicio')  != '' ? date('Y-m-d\TH:i:s\Z', strtotime($this->request->getPost('fechaInicio') . '+7 hours')) : date('Y-m-d\TH:i:s\Z', strtotime('2000-01-01' . '+7 hours')),
			'sessionFinishedAt' => $this->request->getPost('fechaFin') != '' ? date('Y-m-d\TH:i:s\Z', strtotime($this->request->getPost('fechaFin') . '+7 hours')) : date('Y-m-d\TH:i:s\Z'),
			'agentUuid' => $this->request->getPost('agenteId'),
		];

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

			foreach ($responseAll->data as $key => $conexionAll) {
				array_push($empleado, (object)['ID' => $conexionAll->agentConnectionId->agent->uuid, 'NOMBRE' => $conexionAll->agentConnectionId->agent->fullName]);
				// $conexion->Fecha = date("Y-m-d H:i:s", strtotime('-2 hour', strtotime($conexion->Fecha)));
				// $conexion->Inicio = date("Y-m-d H:i:s", strtotime('-2 hour', strtotime($conexion->Inicio)));
				// $conexion->Fin = date("Y-m-d H:i:s", strtotime('-2 hour', strtotime($conexion->Fin)));
				// $promedio += strtotime($value->Duración) - strtotime("TODAY");

			}
			if ($response != null) {
				foreach ($response->data as $key => $conexion) {

					array_push($llamadas, $conexion);
				}
			}


			$dataView->empleados = array_unique($empleado, SORT_REGULAR);
			$dataView->llamadas = array_unique($llamadas, SORT_REGULAR);
			$dataView->rolPermiso = $this->_rolesPermisosModel->asObject()->where('ROLID', session('ROLID'))->findAll();
			$dataView->filterParams = $dataPost;

			$this->_loadView('Reportes llamadas', 'reportes_llamadas', '', $dataView, 'reportes_llamadas');
		}
		// $endpoint = 'https://videodenunciaserver1.fgebc.gob.mx/api/vc';
		// $data = array();
		// $data['u'] = '24';
		// $data['token'] = '198429b7cc8a2a5733d97bc13153227dd5017555';
		// $data['a'] = 'getRepo';
		// $data['min'] = $dataPost->fechaInicio ? $dataPost->fechaInicio : '2000-01-01';
		// $data['max'] = $dataPost->fechaFin ? $dataPost->fechaFin : date("Y-m-d");

		// $response = $this->_curlPost($endpoint, $data);
		// $llamadas = array();
		// $empleado = array();
		// $promedio = 0;
		// if (!isset($dataPost->agenteId)) {
		// 	foreach ($response->data as $key => $value) {
		// 		// foreach ($value as $array => $data) {
		// 		//iterar datos de cada una de las llamadas
		// 		// }
		// 		if ($value->Estatus == 'Terminada' && $value->Grabación) {
		// 			$idAgente = 'id Agente';
		// 			array_push($empleado, (object)['ID' => $value->$idAgente, 'NOMBRE' => $value->Agente]);
		// 			$value->Fecha = date("Y-m-d H:i:s", strtotime('-2 hour', strtotime($value->Fecha)));
		// 			$value->Inicio = date("Y-m-d H:i:s", strtotime('-2 hour', strtotime($value->Inicio)));
		// 			$value->Fin = date("Y-m-d H:i:s", strtotime('-2 hour', strtotime($value->Fin)));
		// 			array_push($llamadas, $value);
		// 			$promedio = date('H:i:s', strtotime($value->Duración));
		// 		}
		// 	}
		// 	//var_dump('promedio de tiempo en llamada', ($promedio));
		// }
		// if (isset($dataPost->agenteId)) {
		// 	$idAgente = 'id Agente';
		// 	foreach ($response->data as $key => $value) {
		// 		// foreach ($value as $array => $data) {
		// 		//iterar datos de cada una de las llamadas
		// 		// }
		// 		array_push($empleado, (object)['ID' => $value->$idAgente, 'NOMBRE' => $value->Agente]);
		// 		if ($value->Estatus == 'Terminada' && $value->Grabación && $value->$idAgente == $dataPost->agenteId) {
		// 			$dataPost->nombreAgente = $value->Agente;
		// 			array_push($llamadas, $value);
		// 			$promedio += strtotime($value->Duración) - strtotime("TODAY");
		// 		}
		// 	}
		// }

		// $dataView = (object)array();
		// $dataView->llamadas = $llamadas;
		// $dataView->rolPermiso = $this->_rolesPermisosModel->asObject()->where('ROLID', session('ROLID'))->findAll();
		// $dataView->empleados = array_unique($empleado, SORT_REGULAR);
		// $dataView->filterParams = $dataPost;
		// $dataView->promedio = (count($llamadas) > 0) ? gmdate('H:i:s', ($promedio / count($llamadas))) : '00:00:00';

		// $this->_loadView('Reportes llamadas', 'reportes_llamadas', '', $dataView, 'reportes_llamadas');
	}

	public function createLlamadasXlsx()
	{
		$dataPost = [
			'fechaInicio' => $this->request->getPost('fechaInicio'),
			'fechaFin' => $this->request->getPost('fechaFin'),
			'horaInicio' => $this->request->getPost('horaInicio'),
			'horaFin' => $this->request->getPost('horaFin'),
			'agenteId' => $this->request->getPost('agenteId'),
		];
		$date = date("Y_m_d_h_i_s");

		foreach ($dataPost as $clave => $valor) {
			//Recorre el array y elimina los valores que nulos o vacíos
			if (empty($valor)) unset($dataPost[$clave]);
		}
		if (count($dataPost) <= 0) {
			$dataPost = [
				'fechaInicio' => date("Y-m-d", strtotime('-1 month')),
				'fechaFin' => date("Y-m-d"),
			];
		}

		$endpoint = 'https://videodenunciaserver1.fgebc.gob.mx/api/vc';
		$data = array();
		$data['u'] = '24';
		$data['token'] = '198429b7cc8a2a5733d97bc13153227dd5017555';
		$data['a'] = 'getRepo';
		$data['min'] = isset($dataPost['fechaInicio']) ? $dataPost['fechaInicio'] : '2000-01-01';
		$data['max'] = isset($dataPost['fechaFin']) ? $dataPost['fechaFin'] : date("Y-m-d");

		$response = $this->_curlPost($endpoint, $data);
		$llamadas = array();
		$promedio = 0;
		if (!isset($dataPost['agenteId'])) {
			foreach ($response->data as $key => $value) {
				// foreach ($value as $array => $data) {
				//iterar datos de cada una de las llamadas
				// }
				if ($value->Estatus == 'Terminada' && $value->Grabación) {
					$idAgente = 'id Agente';
					$value->Fecha = date("Y-m-d H:i:s", strtotime('-2 hour', strtotime($value->Fecha)));
					$value->Inicio = date("Y-m-d H:i:s", strtotime('-2 hour', strtotime($value->Inicio)));
					$value->Fin = date("Y-m-d H:i:s", strtotime('-2 hour', strtotime($value->Fin)));
					array_push($llamadas, $value);
					$promedio = date('H:i:s', strtotime($value->Duración));
				}
			}
			//var_dump('promedio de tiempo en llamada', ($promedio));
		}
		if (isset($dataPost['agenteId'])) {
			$idAgente = 'id Agente';
			foreach ($response->data as $key => $value) {
				// foreach ($value as $array => $data) {
				//iterar datos de cada una de las llamadas
				// }
				if ($value->Estatus == 'Terminada' && $value->Grabación && $value->$idAgente == $dataPost['agenteId']) {
					//array_push($empleado, (object)['ID'=>$value->$idAgente, 'NOMBRE' => $value->Agente]);
					$value->Fecha = date("Y-m-d H:i:s", strtotime('-2 hour', strtotime($value->Fecha)));
					$value->Inicio = date("Y-m-d H:i:s", strtotime('-2 hour', strtotime($value->Inicio)));
					$value->Fin = date("Y-m-d H:i:s", strtotime('-2 hour', strtotime($value->Fin)));
					array_push($llamadas, $value);
					$promedio += strtotime($value->Duración) - strtotime("TODAY");
				}
			}
		}
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
			"Espera",
			"Duración",
			"Estatus"
		];

		for ($i = 0; $i < count($headers); $i++) {
			$sheet->setCellValue($columns[$i] . 4, $headers[$i]);
			$sheet->getColumnDimension($columns[$i])->setAutoSize(true);
		}

		$sheet->getRowDimension($row)->setRowHeight(20, 'pt');

		$row++;
		$idAgente = 'id Agente';

		foreach ($llamadas as $index => $llamada) {

			$sheet->setCellValue('A1', "CENTRO TELEFÓNICO Y EN LÍNEA DE ATENCIÓN Y ORIENTACIÓN TEMPRANA");
			$sheet->setCellValue('A2', "REGISTRO ESTATAL DE PRE DENUNCIA TELEFÓNICA Y EN LÍNEA");


			$sheet->setCellValue('A' . $row, $llamada->Fecha);
			$sheet->setCellValue('B' . $row, $llamada->Folio);
			$sheet->setCellValue('C' . $row, $llamada->Inicio);
			$sheet->setCellValue('D' . $row, $llamada->Fin);
			$sheet->setCellValue('E' . $row, $llamada->Agente);
			$sheet->setCellValue('F' . $row, $llamada->Cliente);
			$sheet->setCellValue('G' . $row, $llamada->Espera);
			$sheet->setCellValue('H' . $row, $llamada->Duración);
			$sheet->setCellValue('I' . $row, $llamada->Estatus);

			$sheet->setCellValue('J' . $row, '');

			$sheet->getRowDimension($row)->setRowHeight(20, 'pt');

			if (!(($row - 4) >= count($llamadas))) $row++;
		}
		$sheet->getStyle('A1:R1')->applyFromArray($styleCab);
		$sheet->getStyle('A2:R2')->applyFromArray($styleCab);

		$sheet->getStyle('A4:R4')->applyFromArray($styleHeaders);
		$sheet->getStyle('A5:R' . $row)->applyFromArray($styleCells);

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

		$filename = urlencode("Registro_Llamadas_" . $date . ".xlsx");
		header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
		header("Content-Disposition: attachment; filename=\"$filename\"");
		header("Content-Transfer-Encoding: binary");
		header("Cache-Control: max-age=0");
		$writer->save("php://output");
	}

	public function getRegistroConavim()
	{
		$dataPost = [
			'fechaInicio' => date("Y-m-d", strtotime('-1 month')),
			'fechaFin' => date("Y-m-d")
		];
		$documentos = $this->_plantillasModel->filtro_ordenes_proteccion($dataPost);
		$municipio = $this->_municipiosModel->asObject()->where('ESTADOID', 2)->findAll();
		$where = "ROLID = 2 OR ROLID = 3 OR ROLID = 4 OR ROLID = 6 OR ROLID = 7 OR ROLID = 8 OR ROLID = 9 OR ROLID = 10";
		$empleado = $this->_usuariosModel->asObject()->where($where)->orderBy('NOMBRE', 'ASC')->findAll();
		$tiposOrden = $this->_plantillasModel->get_tipos_orden();


		$dataView = (object)array();
		$dataView->rolPermiso = $this->_rolesPermisosModel->asObject()->where('ROLID', session('ROLID'))->findAll();
		$dataView->municipios = $municipio;
		$dataView->empleados = $empleado;
		$dataView->tiposOrden = (object)$tiposOrden;
		$dataView->dataOrdenes = $documentos;
		$dataView->filterParams = (object)$dataPost;

		$this->_loadView('Registro CONAVIM', 'registro_conavim', '', $dataView, 'registro_conavim');
	}

	public function postRegistroConavim()
	{

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

		$municipio = $this->_municipiosModel->asObject()->where('ESTADOID', 2)->findAll();
		$where = "ROLID = 2 OR ROLID = 3 OR ROLID = 4 OR ROLID = 6 OR ROLID = 7 OR ROLID = 8 OR ROLID = 9 OR ROLID = 10";
		$empleado = $this->_usuariosModel->asObject()->where($where)->orderBy('NOMBRE', 'ASC')->findAll();
		$tiposOrden = $this->_plantillasModel->get_tipos_orden();
		$documentos = $this->_plantillasModel->filtro_ordenes_proteccion($dataPost);

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
		$dataView->rolPermiso = $this->_rolesPermisosModel->asObject()->where('ROLID', session('ROLID'))->findAll();
		$dataView->municipios = $municipio;
		$dataView->empleados = $empleado;
		$dataView->tiposOrden = (object)$tiposOrden;
		$dataView->dataOrdenes = $documentos;
		$dataView->filterParams = (object)$dataPost;

		$this->_loadView('Registro CONAVIM', 'registro_conavim', '', $dataView, 'registro_conavim');
	}

	public function createOrdenXlsx()
	{
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
		if (count($dataPost) <= 0) {
			$dataPost = [
				'fechaInicio' => date("Y-m-d", strtotime('-1 month')),
				'fechaFin' => date("Y-m-d"),
			];
		}
		$documentos = $this->_plantillasModel->filtro_ordenes_proteccion($dataPost);
		$date = date("Y_m_d_h_i_s");

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
			"Folio",
			"FECHA DE EXPEDICIÓN",
			"NO. EXPEDIENTE",
			"MODULO QUE EXPIDE",
			"MUNICIPIO QUE ATIENDE",
			"SERVIDOR PUBLICO SOLICITANTE",
			"DELITO",
			"NOMBRE DE LA VICTIMA/OFENDIDO",
			"APELLIDO PATERNO",
			"APELLIDO MATERNO",
			"GENERO",
			"EDAD",
			"TIPO DE ORDEN DE PROTECCIÓN",
			"VÍCTIMA LESIONADA",
		];

		for ($i = 0; $i < count($headers); $i++) {
			$sheet->setCellValue($columns[$i] . 4, $headers[$i]);
			$sheet->getColumnDimension($columns[$i])->setAutoSize(true);
		}

		$sheet->getRowDimension($row)->setRowHeight(20, 'pt');

		$row++;

		foreach ($documentos as $index => $orden) {
			$this->separarExpID($orden->EXPEDIENTEID);


			$sheet->setCellValue('A1', "CENTRO TELEFÓNICO Y EN LÍNEA DE ATENCIÓN Y ORIENTACIÓN TEMPRANA");
			$sheet->setCellValue('A2', "REGISTRO ORDENES DE PROTECCIÓN");


			$sheet->setCellValue('A' . $row, $orden->FOLIOID);
			$sheet->setCellValue('B' . $row, $this->formatFecha($orden->FECHAFIRMA));
			$sheet->setCellValue('C' . $row, $this->separarExpID($orden->EXPEDIENTEID));
			$sheet->setCellValue('D' . $row, 'CENTRO DE DENUNCIA TECNÓLOGICA');
			$sheet->setCellValue('E' . $row,  $orden->MUNICIPIODESCR);
			$sheet->setCellValue('F' . $row,  $orden->NOMBRE_MP . ' ' . $orden->APATERNO_MP . ' ' . $orden->AMATERNO_MP);
			$sheet->setCellValue('G' . $row,  $orden->HECHODELITO);
			$sheet->setCellValue('H' . $row,  $orden->NOMBRE);
			$sheet->setCellValue('I' . $row,  $orden->PRIMERAPELLIDO);
			$sheet->setCellValue('J' . $row,  $orden->SEGUNDOAPELLIDO);
			$sheet->setCellValue('K' . $row,  $orden->SEXO);
			$sheet->setCellValue('L' . $row,  $orden->EDADCANTIDAD);
			$sheet->setCellValue('M' . $row,  $orden->TIPODOC);
			$sheet->setCellValue('N' . $row,  $orden->LESIONES);
			$sheet->setCellValue('O' . $row, '');

			$sheet->getRowDimension($row)->setRowHeight(20, 'pt');

			if (!(($row - 4) >= count($documentos))) $row++;
		}
		$sheet->getStyle('A1:R1')->applyFromArray($styleCab);
		$sheet->getStyle('A2:R2')->applyFromArray($styleCab);

		$sheet->getStyle('A4:R4')->applyFromArray($styleHeaders);
		$sheet->getStyle('A5:R' . $row)->applyFromArray($styleCells);

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

	public function getRegistroCanDev()
	{

		$dataPost = [
			'fechaInicio' => date("Y-m-d", strtotime('-1 month')),
			'fechaFin' => date("Y-m-d")
		];

		$municipio = $this->_municipiosModel->asObject()->where('ESTADOID', 2)->findAll();
		$where = "ROLID = 2 OR ROLID = 3 OR ROLID = 4 OR ROLID = 6 OR ROLID = 7 OR ROLID = 8 OR ROLID = 9 OR ROLID = 10";
		$empleado = $this->_usuariosModel->asObject()->where($where)->orderBy('NOMBRE', 'ASC')->findAll();
		$dataInfo = $this->_folioModel->filtro_canalizaciones_derivaciones($dataPost);

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
		$dataView->rolPermiso = $this->_rolesPermisosModel->asObject()->where('ROLID', session('ROLID'))->findAll();
		$dataView->municipios = $municipio;
		$dataView->empleados = $empleado;
		$dataView->dataInfo = $dataInfo;
		$dataView->filterParams = (object)$dataPost;

		$this->_loadView('Registro Canalizaciones Derivaciones', 'registro_candev', '', $dataView, 'registro_candev');
	}

	public function postRegistroCanDev()
	{
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

		$municipio = $this->_municipiosModel->asObject()->where('ESTADOID', 2)->findAll();
		$where = "ROLID = 2 OR ROLID = 3 OR ROLID = 4 OR ROLID = 6 OR ROLID = 7 OR ROLID = 8 OR ROLID = 9 OR ROLID = 10";
		$empleado = $this->_usuariosModel->asObject()->where($where)->orderBy('NOMBRE', 'ASC')->findAll();
		$dataInfo = $this->_folioModel->filtro_canalizaciones_derivaciones($dataPost);

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
		$dataView->rolPermiso = $this->_rolesPermisosModel->asObject()->where('ROLID', session('ROLID'))->findAll();
		$dataView->municipios = $municipio;
		$dataView->empleados = $empleado;
		$dataView->dataInfo = $dataInfo;
		$dataView->filterParams = (object)$dataPost;

		$this->_loadView('Registro Canalizaciones Derivaciones', 'registro_candev', '', $dataView, 'registro_candev');
	}

	public function createCanaDevXlsx()
	{
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
		if (count($dataPost) <= 0) {
			$dataPost = [
				'fechaInicio' => date("Y-m-d", strtotime('-1 month')),
				'fechaFin' => date("Y-m-d"),
			];
		}
		$dataInfo = $this->_folioModel->filtro_canalizaciones_derivaciones($dataPost);

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
			->setKeywords("reporte ceeaiv cdtec fgebc")
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
			"Folio",
			"FECHA DE ATENCIÓN",
			"NO. EXPEDIENTE",
			"MODULO QUE EXPIDE",
			"MUNICIPIO QUE ATIENDE",
			"SERVIDOR PUBLICO SOLICITANTE",
			"DELITO",
			"NOMBRE DE LA VICTIMA/OFENDIDO",
			"APELLIDO PATERNO",
			"APELLIDO MATERNO",
			"SALIDA",
		];

		for ($i = 0; $i < count($headers); $i++) {
			$sheet->setCellValue($columns[$i] . 4, $headers[$i]);
			$sheet->getColumnDimension($columns[$i])->setAutoSize(true);
		}

		$sheet->getRowDimension($row)->setRowHeight(20, 'pt');

		$row++;

		foreach ($dataInfo as $index => $orden) {
			//$this->separarExpID($orden->EXPEDIENTEID);


			$sheet->setCellValue('A1', "CENTRO TELEFÓNICO Y EN LÍNEA DE ATENCIÓN Y ORIENTACIÓN TEMPRANA");
			$sheet->setCellValue('A2', "REGISTRO DE CANALIZACIONES Y DERIVACIONES");


			$sheet->setCellValue('A' . $row, $orden->FOLIOID);
			$sheet->setCellValue('B' . $row, $this->formatFecha($orden->HECHOFECHA));
			$sheet->setCellValue('C' . $row, (isset($orden->EXPEDIENTEID)) ? $this->separarExpID($orden->EXPEDIENTEID) : '');
			$sheet->setCellValue('D' . $row, 'CENTRO DE DENUNCIA TECNÓLOGICA');
			$sheet->setCellValue('E' . $row,  $orden->MUNICIPIODESCR);
			$sheet->setCellValue('F' . $row,  $orden->NOMBRE_MP . ' ' . $orden->APATERNO_MP . ' ' . $orden->AMATERNO_MP);
			$sheet->setCellValue('G' . $row,  $orden->HECHODELITO);
			$sheet->setCellValue('H' . $row,  $orden->NOMBRE);
			$sheet->setCellValue('I' . $row,  $orden->PRIMERAPELLIDO);
			$sheet->setCellValue('J' . $row,  $orden->SEGUNDOAPELLIDO);
			$sheet->setCellValue('K' . $row,  $orden->STATUS);
			$sheet->setCellValue('L' . $row, '');

			$sheet->getRowDimension($row)->setRowHeight(20, 'pt');

			if (!(($row - 4) >= count($dataInfo))) $row++;
		}
		$sheet->getStyle('A1:R1')->applyFromArray($styleCab);
		$sheet->getStyle('A2:R2')->applyFromArray($styleCab);

		$sheet->getStyle('A4:R4')->applyFromArray($styleHeaders);
		$sheet->getStyle('A5:R' . $row)->applyFromArray($styleCells);

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

		$filename = urlencode("Registro_Canalizaciones_Derivaciones_" . $date . ".xlsx");
		header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
		header("Content-Disposition: attachment; filename=\"$filename\"");
		header("Content-Transfer-Encoding: binary");
		header("Cache-Control: max-age=0");
		$writer->save("php://output");
	}

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

	private function _loadView($title, $menu, $submenu, $data, $view)
	{
		$data2 = [
			'header_data' => (object)['title' => $title, 'menu' => $menu, 'submenu' => $submenu],
			'body_data' => $data
		];

		echo view("admin/dashboard/reportes/$view", $data2);
	}

	private function permisos($permiso)
	{
		return in_array($permiso, session('permisos'));
	}

	public function separarExpID($expId)
	{
		$array = str_split($expId);
		return $array[2] . $array[4] . $array[5] . '-' . $array[6] . $array[7] . $array[8] . $array[9] . '-' . $array[10] . $array[11] . $array[12] . $array[13] . $array[14];
	}

	public function formatFecha($date)
	{
		return date("d/m/Y", strtotime($date));
	}
}
