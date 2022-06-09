<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use Dompdf\Dompdf;
use App\Models\FileOriginalesModel;
class PDFController extends BaseController
{
    function __construct()
	{
		$this->_fileOriginalModel = new FileOriginalesModel();
	}
    public function certificadoMedico()
	{
		$data = (object) array();
        $data->certificadoMedico = $this->_fileOriginalModel->asObject()->findAll();
		$this->_loadView('Documentos', $data, 'certificadoMedico');
	}
    public function constanciaVideoDenuncia()
	{
		$data = (object) array();
        $data->constanciaVideoD = $this->_fileOriginalModel->asObject()->findAll();
		$this->_loadView('Documentos', $data, 'constanciaVideoDenuncia');
	}
    public function proteccionAlbergue()
	{
		$data = (object) array();
        $data->constanciaAlbergue = $this->_fileOriginalModel->asObject()->findAll();
		$this->_loadView('Documentos', $data, 'proteccionAlbergue');
	}
    public function proteccionPertenencia()
	{
		$data = (object) array();
        $data->constanciaPertenencia = $this->_fileOriginalModel->asObject()->findAll();
		$this->_loadView('Documentos', $data, 'proteccionPertenencia');
	}
    public function proteccionRondines()
	{
		$data = (object) array();
        $data->constanciaRondines = $this->_fileOriginalModel->asObject()->findAll();
		$this->_loadView('Documentos', $data, 'proteccionRondines');
	}
    private function _loadView($title, $data, $view)
	{
		$data = [
			'header_data' => (object)['title' => $title],
			'body_data' => $data
		];

		echo view("documentos/$view", $data);
	}
   /* public function generatePDF()
    {
        
        $dompdf= new Dompdf();
        $dompdf->loadHTML('<h1>HOLA</h1>');
        $dompdf->setPaper('A4','portrait');
        $dompdf->render();
        $dompdf->stream();
    }*/

}