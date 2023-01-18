<?php

namespace App\Controllers\admin;

use App\Models\FolioModel;
use App\Controllers\BaseController;
use App\Models\ConstanciaExtravioModel;
use App\Models\MunicipiosModel;
use App\Models\RolesPermisosModel;
use App\Models\UsuariosModel;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;


class ReportesController extends BaseController
{
	private $_folioModel;
	private $_municipiosModel;
	private $_usuariosModel;
	private $_constanciaExtravioModel;
	private $_rolesPermisosModel;
	
	function __construct()
	{
		$this->_folioModel = new FolioModel();
		$this->_municipiosModel = new MunicipiosModel();
		$this->_usuariosModel = new UsuariosModel();
		$this->_constanciaExtravioModel = new ConstanciaExtravioModel();
		$this->_rolesPermisosModel = new RolesPermisosModel();
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
		$where = "ROLID = 2 OR ROLID = 3 OR ROLID = 4 OR ROLID = 6 OR ROLID = 7";
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
		$where = "ROLID = 2 OR ROLID = 3 OR ROLID = 4 OR ROLID = 6 OR ROLID = 7";
		$empleado = $this->_usuariosModel->asObject()->where($where)->orderBy('NOMBRE', 'ASC')->findAll();

		if (isset($data['AGENTEATENCIONID'])) {
			$agente = $this->_usuariosModel->asObject()->where('ROLID', 2)->where('ID', $data['AGENTEATENCIONID'])->orderBy('NOMBRE', 'ASC')->first();
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
			->setTitle("Reporte_Folios_' . $date")
			->setSubject("Reporte_Folios_' . $date")
			->setDescription(
				"El presente documento fue generado por el Centro de Denuncia Tecnológica de la Fiscalía General del Estado de Baja California."
			)
			->setKeywords("reporte folios cdt fgebc 2022")
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
			'TIPO',
			'EXPEDIENTE',
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
			$sheet->setCellValue('A' . $row, $folio->FOLIOID);
			$sheet->setCellValue('B' . $row, $folio->ANO);
			$sheet->setCellValue('C' . $row, $folio->TIPODENUNCIA == 'VD' ? 'CDT': 'ANÓNIMA');
			$sheet->setCellValue('D' . $row, $folio->EXPEDIENTEID);
			$sheet->setCellValue('E' . $row, $folio->FECHASALIDA);
			$sheet->setCellValue('F' . $row, $folio->N_DENUNCIANTE . ' ' . $folio->APP_DENUNCIANTE . ' ' . $folio->APM_DENUNCIANTE);
			$sheet->setCellValue('G' . $row, $folio->N_AGENT . ' ' . $folio->APP_AGENT . ' ' . $folio->APM_AGENT);
			$sheet->setCellValue('H' . $row, $folio->ESTADODESCR);
			$sheet->setCellValue('I' . $row, $folio->MUNICIPIODESCR);
			$sheet->setCellValue('J' . $row, $folio->STATUS);

			$sheet->getRowDimension($row)->setRowHeight(20, 'pt');

			if (!(($row - 1) >= count($resultFilter->result))) $row++;
		}

		$sheet->getStyle('A1:J1')->applyFromArray($styleHeaders);
		$sheet->getStyle('A2:J' . $row)->applyFromArray($styleCells);

		$writer = new Xlsx($spreadSheet);

		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment; filename="Reporte_Folios_' . $date . '.xls"');
		header('Cache-Control: max-age=0');
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
		$where = "ROLID = 2 OR ROLID = 3 OR ROLID = 4 OR ROLID = 6 OR ROLID = 7";
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
		$where = "ROLID = 2 OR ROLID = 3 OR ROLID = 4 OR ROLID = 6 OR ROLID = 7";
		$empleado = $this->_usuariosModel->asObject()->where($where)->orderBy('NOMBRE', 'ASC')->findAll();

		if (isset($data['AGENTEID'])) {
			$agente = $this->_usuariosModel->asObject()->where('ROLID', 2)->where('ID', $data['AGENTEID'])->orderBy('NOMBRE', 'ASC')->first();
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
			'STATUS' => $_POST["STATUS"],
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
			->setTitle("Reporte_Constancias_' . $date")
			->setSubject("Reporte_Constancias_' . $date")
			->setDescription(
				"El presente documento fue generado por el Centro de Denuncia Tecnológica de la Fiscalía General del Estado de Baja California."
			)
			->setKeywords("reporte constancias extravío cdt fgebc 2022")
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

		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment; filename="Reporte_Constancias_' . $date . '.xls"');
		header('Cache-Control: max-age=0');
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
		$resultFilter = $this->_folioModel->filterDatesRegistroDiario($data);
		$empleado = $this->_usuariosModel->asObject()->where('ID',	session('ID'))->orderBy('NOMBRE', 'ASC')->findAll();

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
			'AGENTEATENCIONID' => session('ID'),
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

		$empleado = $this->_usuariosModel->asObject()->where('ID',	session('ID'))->orderBy('NOMBRE', 'ASC')->findAll();

		// if (isset($data['AGENTEATENCIONID'])) {
		// 	$agente = $this->_usuariosModel->asObject()->where('ROLID', 2)->where('ID', $data['AGENTEATENCIONID'])->orderBy('NOMBRE', 'ASC')->first();
		// 	$data['AGENTENOMBRE'] = $agente->NOMBRE . ' ' . $agente->APELLIDO_PATERNO . ' ' . $agente->APELLIDO_MATERNO;
		// }


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
			'AGENTEATENCIONID' => session('ID'),
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
		if (count($data) <= 0) {
			$data = [
				'fechaInicio' => date("Y-m-d", strtotime('-1 month')),
				'fechaFin' => date("Y-m-d"),
			];
		}

		$resultFilter = $this->_folioModel->filterDatesRegistroDiario($data);
		// var_dump($resultFilter);
		// exit;
		$spreadSheet = new Spreadsheet();
		$spreadSheet->getProperties()
			->setCreator("Fiscalía General del Estado de Baja California")
			->setLastModifiedBy("Fiscalía General del Estado de Baja California")
			->setTitle("REGISTRO_DIARIO . $date")
			->setSubject("REGISTRO_DIARIO' . $date")
			->setDescription(
				"El presente documento fue generado por el Centro de Denuncia Tecnológica de la Fiscalía General del Estado de Baja California."
			)
			->setKeywords("registro diario cdt fgebc 2022")
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
			'HORA',
			'FOLIO WEB',
			'TELEFÓNICA / ELECTRÓNICA',
			'MUNICIPIO',
			'NOMBRE (S)',
			'APELLIDO PATERNO',
			'APELLIDO MATERNO',
			'TELEFONO',
			'CORREO ELECTRÓNICO',
			'DELITO',
			'SERVIDOR PÚBLICO QUE ATIENDE',
			'OBSERVACIONES CENTRO TELEFÓNICO',
			'RESULTADO CENTRO TELEFÓNICO',
			'EXPEDIENTE GENERADO CT',
			'FECHA DE ASIGNACIÓN',
			'PRIORIDAD DE ATENCIÓN',
		];

		for ($i = 0; $i < count($headers); $i++) {
			$sheet->setCellValue($columns[$i] . 4, $headers[$i]);
			$sheet->getColumnDimension($columns[$i])->setAutoSize(true);
		}

		$sheet->getRowDimension($row)->setRowHeight(20, 'pt');

		$row++;


		foreach ($resultFilter->result as $index => $folio) {
			// var_dump($folio);
			// exit;
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

			$sheet->setCellValue('A' . $row, $row - 4);

			$sheet->setCellValue('B' . $row, $dateregistro);
			$sheet->setCellValue('C' . $row, $horaregistro);
			$sheet->setCellValue('D' . $row, $folio->FOLIOID);
			$sheet->setCellValue('E' . $row, $folio->TIPODENUNCIA == 'DA' ? 'ANÓNIMA': 'CDT');
			$sheet->setCellValue('F' . $row, $folio->MUNICIPIODESCR);
			$sheet->setCellValue('G' . $row, $folio->N_DENUNCIANTE);
			$sheet->setCellValue('H' . $row, $folio->APP_DENUNCIANTE);
			$sheet->setCellValue('I' . $row, $folio->APM_DENUNCIANTE);
			$sheet->setCellValue('J' . $row, $folio->TELEFONODENUNCIANTE);
			$sheet->setCellValue('K' . $row, $folio->CORREODENUNCIANTE);
			$sheet->setCellValue('L' . $row, isset($folio->DELITOMODALIDADDESCR)? $folio->DELITOMODALIDADDESCR : 'NO EXISTE');
			$sheet->setCellValue('M' . $row, $folio->N_AGENT . ' ' . $folio->APP_AGENT . ' ' . $folio->APM_AGENT);
			$sheet->setCellValue('N' . $row, $folio->NOTASAGENTE);
			$sheet->setCellValue('O' . $row, isset($folio->TIPOEXPEDIENTEDESCR) ? $folio->TIPOEXPEDIENTEDESCR : $folio->STATUS);
			$sheet->setCellValue('P' . $row, $folio->EXPEDIENTEID);
			$sheet->setCellValue('Q' . $row, $datesalida);
			$sheet->setCellValue('R' . $row, '');

			$sheet->getRowDimension($row)->setRowHeight(20, 'pt');

			if (!(($row - 4) >= count($resultFilter->result))) $row++;
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
		$drawing2 = new \PhpOffice\PhpSpreadsheet\Worksheet\Drawing();
		$drawing2->setName('FGEBC');
		$drawing2->setDescription('LOGO');
		$drawing2->setPath(FCPATH . 'assets/img/logo_sejap.jpg'); // put your path and image here
		$drawing2->setHeight(45);
		$drawing2->setCoordinates('R1');
		$drawing2->setOffsetX(-30);
		$drawing2->setWorksheet($spreadSheet->getActiveSheet());
		// $drawing->setOffsetX(110);
		// $drawing->setRotation(25);
		$writer = new Xlsx($spreadSheet);

		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment; filename="REGISTRO_DIARIO_' . session('NOMBRE') . '.xls"');
		header('Cache-Control: max-age=0');
		$writer->save("php://output");
	}

	public function getFielReport(){
		$data = (object) array();
		if (!$this->permisos('USUARIOS')) {
			return redirect()->back()->with('message_error', 'Acceso denegado, no tienes los permisos necesarios.');
		}
		$data->usuario = $this->_usuariosModel->asObject()
			->select('USUARIOS.*, ROLES.NOMBRE_ROL, ZONAS_USUARIOS.NOMBRE_ZONA, MUNICIPIO.MUNICIPIODESCR,OFICINA.OFICINADESCR')
			->join('ROLES', 'ROLES.ID = USUARIOS.ROLID','LEFT')
			->join('ZONAS_USUARIOS', 'ZONAS_USUARIOS.ID_ZONA = USUARIOS.ZONAID','LEFT')
			->join('MUNICIPIO', 'MUNICIPIO.MUNICIPIOID = USUARIOS.MUNICIPIOID AND MUNICIPIO.ESTADOID = 2','LEFT')
			->join('OFICINA', 'OFICINA.OFICINAID = USUARIOS.OFICINAID AND OFICINA.MUNICIPIOID = USUARIOS.MUNICIPIOID AND OFICINA.ESTADOID = 2','LEFT')
			->where('ROLID !=', 1)
			->orderBy('ROLES.NOMBRE_ROL', 'ASC')
			->orderBy('USUARIOS.NOMBRE', 'ASC')
			->findAll();
		$data->rolPermiso = $this->_rolesPermisosModel->asObject()->where('ROLID', session('ROLID'))->findAll();

		$this->_loadView('FIEL', 'fiel', '', $data, 'fiel');
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
}