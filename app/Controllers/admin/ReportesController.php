<?php

namespace App\Controllers\admin;
use App\Models\FolioModel;
use App\Controllers\BaseController;
use App\Models\MunicipiosModel;
use App\Models\UsuariosModel;

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
        
        //var_dump($dataView);
        $this->_loadView('Folios generados', 'folios', '', $dataView,'folios' );
    }
    public function getConstancias(){
        $this->_loadView('Constancias generadas', 'constancias', '', '','constancias' );
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