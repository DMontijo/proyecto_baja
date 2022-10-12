<?php

namespace App\Controllers\admin;

use Dompdf\Dompdf;
use Dompdf\Options;
use App\Controllers\BaseController;
use App\Models\FolioDocModel;
use App\Models\FolioPersonaFisicaModel;
use App\Models\PlantillasModel;

class DocumentosController extends BaseController
{
    function __construct()
    {
        $this->_folioDocModel = new FolioDocModel();
        $this->_plantillasModel = new PlantillasModel();
        $this->_folioPersonaFisicaModel = new FolioPersonaFisicaModel();

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

        $data->plantillas = $this->_plantillasModel->asObject()->where('TITULO !=','CONSTANCIA DE EXTRAVÍO')->findAll();

        $data2 = [
            'header_data' => (object)['title' => 'DOCUMENTOS'],
            'body_data' => $data
        ];
        echo view("admin/dashboard/documentos/documentos_generados", $data2);
    }
    public function obtenDocumentos()
    {
        $expediente = trim($this->request->getPost('expediente'));
        $folio = trim($this->request->getPost('folio'));
        $year = trim($this->request->getPost('year'));
        if ($expediente) {
            $documentos = $this->_folioDocModel->get_by_folio($folio, $year);
            $imputados = $this->_folioPersonaFisicaModel->get_imputados($folio, $year);
            $victimas = $this->_folioPersonaFisicaModel->get_victimas($folio, $year);
            $correos = $this->_folioPersonaFisicaModel->get_correos_persona($folio, $year);

            return json_encode(['status' => 1,'documentos'=> $documentos, 'victimas'=>$victimas, "imputados"=>$imputados, 'correos'=>$correos]);
        }else{
            return json_encode(['status' => 0]);
        }
    }
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
            return json_encode(['status' => 1, 'documentos'=> $documentos, 'documentoporid'=> $data->documento]);
        } else {
            return json_encode(['status' => 0]);

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
