<?php

namespace App\Controllers\admin;
use App\Models\FolioModel;
use App\Controllers\BaseController;
use App\Models\MunicipiosModel;
use App\Models\UsuariosModel;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class ReportesController extends BaseController
{
	function __construct()
	{
        $this->_folioModel = new FolioModel(); 
        $this->_municipiosModel = new MunicipiosModel();
        $this->_usuariosModel = new UsuariosModel();
	}

    public function index (){
        $this->_loadView('Reportes', 'Reportes', '', '','index' );
    }

    public function getFolios(){
        $data = (object)array();
		$data = [
            'fechaInicio' => date("Y-m-d", strtotime('-1 month')),
        ];
        $municipio = $this->_municipiosModel->asObject()->where('ESTADOID', (int)'2')->findAll();
        $resultFilter = $this->_folioModel->filterDates($data);
        $empleado = $this->_usuariosModel->asObject()->orderBy('ID', 'DESC')->findAll();
        $dataView = (object)array();
        $dataView->result = $resultFilter->result;
        $dataView->municipios = $municipio;
        $dataView->empleados = $empleado;
        //var_dump($dataView);
        $this->_loadView('Folios generados', 'folios', '', $dataView,'folios' );
    }
    public function postFolios(){
        $data = (object)array();
		$data = [
            'fechaInicio' => $this->request->getPost('fechaInicio'),
            'fechaFin' => $this->request->getPost('fechaFin'),
            'MUNICIPIOID' => $this->request->getPost('MUNICIPIOID'),
            'horaInicio' => $this->request->getPost('horaInicio'), 
            'horaFin' => $this->request->getPost('horaFin'),
            'AGENTEATENCIONID' => $this->request->getPost('AGENTEATENCIONID')
        ];
        //var_dump($data);
        //exit();
        foreach($data as $clave=>$valor){
			//Recorre el array y elimina los valores que nulos o vacíos
			//evita borrar información de la BD
			if(empty($valor)) unset($data[$clave]);
		}
        if(count($data)<=0){
            $data = [
                'fechaInicio' => date("Y-m-d", strtotime('-1 month')),
            ];
        }
            $municipio = $this->_municipiosModel->asObject()->where('ESTADOID', (int)'2')->findAll();
            $resultFilter = $this->_folioModel->filterDates($data);
            $empleado = $this->_usuariosModel->asObject()->orderBy('ID', 'DESC')->findAll();
            $dataView = (object)array();
            $dataView->result = $resultFilter->result;
            $dataView->municipios = $municipio;
            $dataView->empleados = $empleado;
            $this->createXlsx($resultFilter);
        
        //var_dump($dataView);
        $this->_loadView('Folios generados', 'folios', '', $dataView,'folios' );
    }

    public function getConstancias(){
        $this->_loadView('Constancias generadas', 'constancias', '', '','constancias' );
    }

    public function createXlsx ($obj){
        $spreadSheet = new Spreadsheet();
        $sheet = $spreadSheet->getActiveSheet();
        $columns = [
            'A','B','C','D','E',
            'F','G','H','I','J',
            'K','L','M','N','O',
            'P','Q','R','S','T',
            'U','V','W','X','Y','Z'
        ];

        $sheet->setCellValue('A1','ID Folio');
        $sheet->setCellValue('B1','AÑO');
        $sheet->setCellValue('C1','EXPEDIENTE');
        $sheet->setCellValue('D1','FECHA DE SALIDA');
        $sheet->setCellValue('E1','NOMBRE DEL DENUNCIANTE');
        $sheet->setCellValue('F1','NOMBRE DEL AGENTE');
        $sheet->setCellValue('G1','ESTADO DE ATENCION');
        $sheet->setCellValue('H1','MUNICIPIO DE ATENCION');
        $sheet->setCellValue('I1','STATUS DE EXPEDIENTE');
        //var_dump($obj);
        //exit();
        $row = 2;
		foreach ($obj->result as $index => $folio) {
            $sheet->setCellValue('A'.$row, $folio->FOLIOID);
            $sheet->setCellValue('B'.$row, $folio->ANO);
            $sheet->setCellValue('C'.$row, $folio->EXPEDIENTEID);
            $sheet->setCellValue('D'.$row, $folio->FECHASALIDA);
            $sheet->setCellValue('E'.$row, $folio->N_DENUNCIANTE.' '.$folio->APP_DENUNCIANTE.' '.$folio->APM_DENUNCIANTE );
            $sheet->setCellValue('F'.$row, $folio->N_AGENT.' '.$folio->APP_AGENT.' '.$folio->APM_AGENT);
            $sheet->setCellValue('G'.$row, $folio->ESTADODESCR);
            $sheet->setCellValue('H'.$row, $folio->MUNICIPIODESCR);
            $sheet->setCellValue('I'.$row, $folio->STATUS);
            $row++;
        }
        $writer = new Xlsx($spreadSheet);
        $documento = base_url()."/writable/uploads/reporte_folio.xlsx";
        //$writer->save("reporte_folio.xlsx");
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment; filename="reporte_folios_'.date("Y-m-d h:i:s").'.xls"');
        $writer->save("php://output");
    }







    private function _loadView($title, $menu, $submenu, $data, $view)
	{
		$data2 = [
			'header_data' => (object)['title' => $title, 'menu' => $menu, 'submenu' => $submenu],
			'body_data' => $data
		];

		echo view("admin/dashboard/reportes/$view", $data2);
	}


}