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
		$data = $this->_folioDocModel->asObject()->where('STATUS', 'ABIERTO')->findAll();
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
        $data->documento = $this->_folioDocModel->asObject()->where('FOLIOID', $data->folio)->where('FOLIODOCID', $data->foliodoc)->where('ANO', $data->year)->first();

        $data2 = [
			'header_data' => (object)['title' => 'DOCUMENTOS'],
			'body_data' => $data
		];
		echo view("admin/dashboard/documentos/documentos_generados", $data2);

    }
    public function insertFolioDoc()
    {
        $folio = trim($this->request->getPost('folio'));
        $year = trim($this->request->getPost('year'));
        $dataFolioDoc = array(
            'FOLIOID' => $this->request->getPost('folio'),
            'ANO' => $this->request->getPost('year'),
            'PLACEHOLDER' => $this->request->getPost('placeholder'),
            'STATUS'=> 'ABIERTO',
            'TIPODOC'=>$this->request->getPost('titulo'),
        );
        $foliodoc = $this->_folioDoc($dataFolioDoc, $folio, $year);

        if ($foliodoc) {
            return json_encode(['status' => 1]);
        }else{
            return json_encode(['status' => 0]);

        }
    }
    private function _folioDoc($data, $folio, $year)
    {
        $data = $data;
        $data['FOLIOID'] = $folio;
        $data['ANO'] = $year;
        $pdf = $this->_generatePDF($this->request->getPost('placeholder'));
        $data['PDF']= $pdf;

        $foliodoc = $this->_folioDocModel->asObject()->where('FOLIOID', $folio)->where('ANO', $year)->orderBy('FOLIODOCID', 'desc')->first();

        if ($foliodoc) {
            $data['FOLIODOCID'] = ((int) $foliodoc->FOLIODOCID) + 1;
            $foliodoc = $this->_folioDocModel->insert($data);
            return $data['FOLIODOCID'];
        } else {
            $data['FOLIODOCID'] = 1;
            $foliodoc = $this->_folioDocModel->insert($data);
            return $data['FOLIODOCID'];
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
    private function _generatePDF($placeholder)
    {
        $arrContextOptions = array(
            "ssl" => array(
                "verify_peer" => false,
                "verify_peer_name" => false,
            ),
        );

        $data = (object)array();
        $data->placeholder = $placeholder;
        $data->image1 = base64_encode(file_get_contents(base_url('assets/img/logo_fgebc.jpg'), false, stream_context_create($arrContextOptions)));
        $data->image2 = base64_encode(file_get_contents(base_url('assets/img/logo_sejap.jpg'), false, stream_context_create($arrContextOptions)));

        $options = new Options();
        $options->set('isRemoteEnabled', true);
        $options->set('isPhpEnabled', true);
        $options->set('defaultFont', 'Arial');
        $dompdf = new Dompdf($options);
        $dompdf->loadHtml(view('doc_template/document', ['data' => $data]));
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        $canvas = $dompdf->getCanvas();

        $canvas->page_script(function ($pageNumber, $pageCount, $canvas, $fontMetrics) {
            $font = $fontMetrics->getFont('arial', 'regular');
            $text = "PÁGINA $pageNumber DE $pageCount";
            $size = 8;
            $x = $canvas->get_width();
            $y = $canvas->get_height();
            $width = $fontMetrics->getTextWidth($text, $font, $size);
            $canvas->text($x - 60 - $width, $y - 50, $text, $font, $size, array(0, 0, 0));
        });
        return $dompdf->output();
    }
}
