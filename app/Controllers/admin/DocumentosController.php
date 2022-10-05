<?php

namespace App\Controllers\admin;

use Dompdf\Dompdf;
use Dompdf\Options;
use App\Controllers\BaseController;
use App\Models\FolioDocModel;

class DocumentosController extends BaseController
{
    function __construct()
    {
        $this->_folioDocModel = new FolioDocModel();
    }
    public function index()
    {		$data = (object)array();

		$data->abiertas = count($this->_folioDocModel->asObject()->where('STATUS', 'ABIERTO')->findAll());

        $this->_loadView('Documentos',$data, 'index');
    }
    public function documentos_abiertas()
	{
		$data = (object)array();
		// $data = $this->_folioDocModel->asObject()->where('STATUS', 'ABIERTO')->distinct('NUMEROEXPEDIENTE')->first();
        $data = $this->_folioDocModel->get_folio_abierto();
        $this->_loadView('Documentos abiertos', $data, 'documentos_abiertas');

	}
    public function documentos_show()
	{
        $data = (object)array();
        $data->folio = $this->request->getGet('folio');
		$data->foliodoc = $this->request->getGet('foliodoc');
        $data->tipodoc = $this->request->getGet('tipodoc');
		$data->year = $this->request->getGet('year');
        // $data->documento = $this->_plantillasModel->asObject()->where('TITULO', $data->tipodoc)->first();
        $data->documentos = $this->_folioDocModel->asObject()->where('NUMEROEXPEDIENTE', $data->folio)->where('ANO', $data->year)->findAll();

        $data2 = [
			'header_data' => (object)['title' => 'DOCUMENTOS'],
			'body_data' => $data
		];
		echo view("admin/dashboard/documentos/documentos_generados", $data2);

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
