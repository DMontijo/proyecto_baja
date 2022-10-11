<?php

namespace App\Controllers\admin;

use Dompdf\Dompdf;
use Dompdf\Options;
use App\Controllers\BaseController;
use App\Models\FolioDocModel;
use App\Models\PlantillasModel;

class DocumentosController extends BaseController
{
    function __construct()
    {
        $this->_folioDocModel = new FolioDocModel();
        $this->_plantillasModel = new PlantillasModel();
    }
    public function index()
    {
        $data = (object)array();

        $data->abiertas = count($this->_folioDocModel->asObject()->where('STATUS', 'ABIERTO')->findAll());
        $data->expediente = count($this->_folioDocModel->asObject()->where('STATUS', 'FIRMADO')->where('NUMEROEXPEDIENTE <>', null)->findAll());

        $this->_loadView('Documentos', $data, 'index');
    }
    public function documentos_abiertas()
    {
        $data = (object)array();
        // $data = $this->_folioDocModel->asObject()->where('STATUS', 'ABIERTO')->distinct('NUMEROEXPEDIENTE')->first();
        $data = $this->_folioDocModel->get_folio_abierto();
        $this->_loadView('Documentos abiertos', $data, 'documentos_abiertas');
    }
    public function documentos_firmados()
    {
        $data = (object)array();
        // $data = $this->_folioDocModel->asObject()->where('STATUS', 'ABIERTO')->distinct('NUMEROEXPEDIENTE')->first();
        $data = $this->_folioDocModel->get_folio_firmado();
        $this->_loadView('Documentos abiertos', $data, 'documentos_firmados');
    }

    public function documentos_show()
    {
        $data = (object)array();
        $data->folio = $this->request->getGet('folio');
        $data->expediente = $this->request->getGet('expediente');

        $data->foliodoc = $this->request->getGet('foliodoc');
        $data->tipodoc = $this->request->getGet('tipodoc');
        $data->year = $this->request->getGet('year');
        // $data->documento = $this->_plantillasModel->asObject()->where('TITULO', $data->tipodoc)->first();
        $data->documentos = $this->_folioDocModel->asObject()->where('NUMEROEXPEDIENTE', $data->expediente)->where('ANO', $data->year)->findAll();
        $data->plantillas = $this->_plantillasModel->asObject()->findAll();

        $data2 = [
            'header_data' => (object)['title' => 'DOCUMENTOS'],
            'body_data' => $data
        ];
        echo view("admin/dashboard/documentos/documentos_generados", $data2);
    }
    public function obtenPlantillas(){
        var_dump($this->request->getGet('folio'));
        exit;
        $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
      
        $titulo =$this->request->getPost('titulo');
       

        $data = (object) array();


        $data->plantilla = $this->_plantillasModel->where('TITULO', $titulo)->first();
       


        if ($data->plantilla) {
            $data->status = 1;
            return json_encode($data);
        } else {
            $data = (object)['status' => 0];
            return json_encode($data);
        }
    }
    private function _loadView($title, $data, $view)
    {
        $data = [
            'header_data' => (object)['title' => $title],
            'body_data' => $data
        ];

        echo view("admin/dashboard/wyswyg/$view", $data);
    }
}
