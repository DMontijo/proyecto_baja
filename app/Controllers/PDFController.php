<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\DOCUMENTOSCONVERT;
use Dompdf\Dompdf;
use Dompdf\Options;
use App\Models\FileOriginalesModel;
use App\Models\FolioModel;
use App\Models\UsuariosModel;
use App\Models\DenunciantesModel;
use App\Models\HechoLugarModel;
use App\Models\MunicipiosModel;
use App\Models\EstadosModel;

use App\Models\ConstanciaExtraviadoModel;

use PHPRtfLite;
use PHPRtfLite_Font;
use PHPRtfLite_ParFormat;
class PDFController extends BaseController
{
    function __construct()
	{
		$this->_fileOriginalModel = new FileOriginalesModel();
		$this->_folioModel = new FolioModel();
		$this->_usuariosModel = new UsuariosModel();
		$this->_denunciantesModel = new DenunciantesModel();
		$this->_hechoLugarModel = new HechoLugarModel();
		$this->_municipiosModel = new MunicipiosModel();
		$this->_estadosModel = new EstadosModel();
		$this->_constanciaExtravioModel= new ConstanciaExtraviadoModel();


		$this->db = \Config\Database::connect();
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
	public function constanciaExtravio()
	{
		$data = (object)array();
		$datos= $this->db->table("files_originales")->get()->getResult();
		$data->folio = $this->request->getGet('folio');
		$data->constanciaExtravio = $this->_fileOriginalModel->asObject()->where('TITULO', 'CONSTANCIA DE EXTRAVÍO')->first();
		// $numfolio = $_POST['input_folio_atencion'];
		$folios = $this->_constanciaExtravioModel->asObject()->where('IDCERTIFICADOEXTRAVIADO', $data->folio)->first();

		$agente = $this->_usuariosModel->asObject()->where('ID', session('ID'))->first();
		$denunciante = $this->_denunciantesModel->asObject()->where('ID_DENUNCIANTE', $folios->DENUNCIANTEID)->first();
		$lugar = $this->_hechoLugarModel->asObject()->where('HECHOLUGARID', $folios->HECHOLUGARID)->first();
		$municipio = $this->_municipiosModel->asObject()->where('MUNICIPIOID', $folios->MUNICIPIOID)->where('ESTADOID', $folios->ESTADOID)->first();
		$estado = $this->_estadosModel->asObject()->where('ESTADOID', $folios->ESTADOID)->first();
		$timestamp = strtotime($folios->HECHOFECHA);
		$dia = date('d', $timestamp);
		$meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
		$mes = $meses[date('n')-1];
	

		$data->constanciaExtravio->PLACEHOLDER = str_replace('[FOLIO_NUMERO]', $folios->IDCERTIFICADOEXTRAVIADO, $data->constanciaExtravio->PLACEHOLDER);
		$data->constanciaExtravio->PLACEHOLDER = str_replace('[NOMBRE_AGENTE]', $agente->NOMBRE ." ". $agente->APELLIDO_PATERNO . " ". $agente->APELLIDO_MATERNO, $data->constanciaExtravio->PLACEHOLDER);
		$data->constanciaExtravio->PLACEHOLDER = str_replace('[NOMBRE_CERTIFICADO]', $folios->EXTRAVIO, $data->constanciaExtravio->PLACEHOLDER);
		$data->constanciaExtravio->PLACEHOLDER = str_replace('[NOMBRE_PERSONA]', $denunciante->NOMBRE ." ". $denunciante->APELLIDO_PATERNO . " ". $denunciante->APELLIDO_MATERNO, $data->constanciaExtravio->PLACEHOLDER);
		$data->constanciaExtravio->PLACEHOLDER = str_replace('[LUGAR_EXTRAVIO]', $lugar->HECHODESCR, $data->constanciaExtravio->PLACEHOLDER);
		$data->constanciaExtravio->PLACEHOLDER = str_replace('[DESCRIPCION_EXTRAVIO]', $folios->DESCRIPCION_EXTRAVIO, $data->constanciaExtravio->PLACEHOLDER);
		$data->constanciaExtravio->PLACEHOLDER = str_replace('[NOMBRE_CIUDAD]', $municipio->MUNICIPIODESCR .", ". $estado->ESTADODESCR , $data->constanciaExtravio->PLACEHOLDER);
		$data->constanciaExtravio->PLACEHOLDER = str_replace('[FECHA_EXTRAVIO]', $folios->HECHOFECHA, $data->constanciaExtravio->PLACEHOLDER);

		$data->constanciaExtravio->PLACEHOLDER = str_replace('[DIA]', $dia, $data->constanciaExtravio->PLACEHOLDER);
		$data->constanciaExtravio->PLACEHOLDER = str_replace('[MES]', strtoupper($mes), $data->constanciaExtravio->PLACEHOLDER);
		$data->constanciaExtravio->PLACEHOLDER = str_replace('[ANIO]', $folios->ANO, $data->constanciaExtravio->PLACEHOLDER);
		$data->constanciaExtravio->PLACEHOLDER = str_replace('[HORA]', $folios->HECHOHORA, $data->constanciaExtravio->PLACEHOLDER);

		$this->_loadView('Documentos', $data, 'constanciaExtravio');
	}
	
	function PDFExtravio()
	{
		$data = (object)array();
		$options = new Options();
		$options->set('isRemoteEnabled', true);
		$dompdf = new Dompdf($options);
		$data = $this->db->table("files_originales")->get()->getResult();
		//var_dump($data[5]->PLACEHOLDER);
		$numfolio = $_POST['input_folio_atencion'];
		$folio = $this->_constanciaExtravioModel->asObject()->where('IDCERTIFICADOEXTRAVIADO', $numfolio)->first();
		$agente = $this->_usuariosModel->asObject()->where('ID', session('ID'))->first();
		$denunciante = $this->_denunciantesModel->asObject()->where('ID_DENUNCIANTE', $folio->DENUNCIANTEID)->first();
		$lugar = $this->_hechoLugarModel->asObject()->where('HECHOLUGARID', $folio->HECHOLUGARID)->first();
		$municipio = $this->_municipiosModel->asObject()->where('MUNICIPIOID', $folio->MUNICIPIOID)->where('ESTADOID', $folio->ESTADOID)->first();
		$estado = $this->_estadosModel->asObject()->where('ESTADOID', $folio->ESTADOID)->first();
		$timestamp = strtotime($folio->HECHOFECHA);
		$dia = date('d', $timestamp);
		$meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
		$mes = $meses[date('n')-1];
		

		$data[5]->PLACEHOLDER = str_replace('[FOLIO_NUMERO]', $folio->IDCERTIFICADOEXTRAVIADO, $data[5]->PLACEHOLDER);
		$data[5]->PLACEHOLDER = str_replace('[NOMBRE_AGENTE]', $agente->NOMBRE ." ". $agente->APELLIDO_PATERNO . " ". $agente->APELLIDO_MATERNO, $data[5]->PLACEHOLDER);
		$data[5]->PLACEHOLDER = str_replace('[NOMBRE_CERTIFICADO]', $folio->EXTRAVIO, $data[5]->PLACEHOLDER);
		$data[5]->PLACEHOLDER = str_replace('[NOMBRE_PERSONA]', $denunciante->NOMBRE ." ". $denunciante->APELLIDO_PATERNO . " ". $denunciante->APELLIDO_MATERNO, $data[5]->PLACEHOLDER);
		$data[5]->PLACEHOLDER = str_replace('[LUGAR_EXTRAVIO]', $lugar->HECHODESCR, $data[5]->PLACEHOLDER);
		$data[5]->PLACEHOLDER = str_replace('[DESCRIPCION_EXTRAVIO]', $folio->DESCRIPCION_EXTRAVIO, $data[5]->PLACEHOLDER);
		$data[5]->PLACEHOLDER = str_replace('[NOMBRE_CIUDAD]', $municipio->MUNICIPIODESCR .", ". $estado->ESTADODESCR , $data[5]->PLACEHOLDER);
		$data[5]->PLACEHOLDER = str_replace('[FECHA_EXTRAVIO]', $folio->HECHOFECHA, $data[5]->PLACEHOLDER);

		$data[5]->PLACEHOLDER = str_replace('[DIA]', $dia, $data[5]->PLACEHOLDER);
		$data[5]->PLACEHOLDER = str_replace('[MES]', strtoupper($mes), $data[5]->PLACEHOLDER);
		$data[5]->PLACEHOLDER = str_replace('[ANIO]', $folio->ANO, $data[5]->PLACEHOLDER);
		$data[5]->PLACEHOLDER = str_replace('[HORA]', $folio->HECHOHORA, $data[5]->PLACEHOLDER);

		// $data[5]->PLACEHOLDER = str_replace('[FOLIO_NUMERO]', 1, $data[5]->PLACEHOLDER);
		// $data[5]->PLACEHOLDER = str_replace('[FOLIO_NUMERO]', 1, $data[5]->PLACEHOLDER);
		// $data[5]->PLACEHOLDER = str_replace('[FOLIO_NUMERO]', 1, $data[5]->PLACEHOLDER);
		// $data[5]->PLACEHOLDER = str_replace('[FOLIO_NUMERO]', 1, $data[5]->PLACEHOLDER);
		// $data[5]->PLACEHOLDER = str_replace('[FOLIO_NUMERO]', 1, $data[5]->PLACEHOLDER);
		// $data[5]->PLACEHOLDER = str_replace('[FOLIO_NUMERO]', 1, $data[5]->PLACEHOLDER);
		// $data[5]->PLACEHOLDER = str_replace('[FOLIO_NUMERO]', 1, $data[5]->PLACEHOLDER);
		// $data[5]->PLACEHOLDER = str_replace('[FOLIO_NUMERO]', 1, $data[5]->PLACEHOLDER);

		$dompdf->loadHtml(view('pdf/constanciaE', ["certificadoMedico" => $data]));
		// setting paper to portrait, also we have landscape
		$dompdf->setPaper('A4', 'portrait');
		$dompdf->render();
		
		// Download pdf
		$dompdf->stream();
		// to give pdf file name
		// $dompdf->stream("myfile");
		return redirect()->to(base_url('admin/dashboard'));
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