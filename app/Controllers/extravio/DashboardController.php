<?php

namespace App\Controllers\extravio;

use App\Controllers\BaseController;
use App\Models\ColoniasModel;
use App\Models\ConstanciaExtravioConsecutivoModel;
use App\Models\ConstanciaExtravioModel;
use App\Models\DelitosUsuariosModel;
use App\Models\DenunciantesModel;
use App\Models\DocumentosExtravioTipoModel;
use App\Models\EstadosModel;
use App\Models\FolioModel;
use App\Models\FolioPersonaFisicaDomicilioModel;
use App\Models\FolioPersonaFisicaModel;
use App\Models\FolioPreguntasModel;
use App\Models\FolioVehiculoModel;
use App\Models\HechoLugarModel;
use App\Models\LocalidadesModel;
use App\Models\MunicipiosModel;
use App\Models\PaisesModel;
use App\Models\PersonaIdiomaModel;
use App\Models\PlantillasModel;
use App\Models\UsuariosModel;
use App\Models\VehiculoColorModel;
use App\Models\VehiculoTipoModel;

class DashboardController extends BaseController
{

	private $_paisesModel;
	private $_estadosModel;
	private $_municipiosModel;
	private $_localidadesModel;
	private $_coloniasModel;
	private $_hechoLugarModel;
	private $_coloresVehiculoModel;
	private $_tipoVehiculoModel;
	private $_delitosUsuariosModel;
	private $_denunciantesModel;
	private $_personaIdiomaModel;
	private $_documentosExtravioTipoModel;
	private $_folioModel;
	private $_folioPreguntasModel;
	private $_folioPersonaFisicaModel;
	private $_folioPersonaFisicaDomicilioModel;
	private $_folioVehiculoModel;
	private $_constanciaExtravioModel;
	private $_plantillasModel;
	private $_usuariosModel;
	private $_constanciaExtravioConsecutivoModel;

	public function __construct()
	{
		//Models
		$this->_paisesModel = new PaisesModel();
		$this->_estadosModel = new EstadosModel();
		$this->_municipiosModel = new MunicipiosModel();
		$this->_localidadesModel = new LocalidadesModel();
		$this->_coloniasModel = new ColoniasModel();
		$this->_hechoLugarModel = new HechoLugarModel();
		$this->_coloresVehiculoModel = new VehiculoColorModel();
		$this->_tipoVehiculoModel = new VehiculoTipoModel();
		$this->_delitosUsuariosModel = new DelitosUsuariosModel();
		$this->_denunciantesModel = new DenunciantesModel();
		$this->_personaIdiomaModel = new PersonaIdiomaModel();
		$this->_documentosExtravioTipoModel = new DocumentosExtravioTipoModel();
		$this->_folioModel = new FolioModel();
		$this->_folioPreguntasModel = new FolioPreguntasModel();
		$this->_folioPersonaFisicaModel = new FolioPersonaFisicaModel();
		$this->_folioPersonaFisicaDomicilioModel = new FolioPersonaFisicaDomicilioModel();
		$this->_folioVehiculoModel = new FolioVehiculoModel();
		$this->_constanciaExtravioModel = new ConstanciaExtravioModel();
		$this->_plantillasModel = new PlantillasModel();
		$this->_usuariosModel = new UsuariosModel();
		$this->_constanciaExtravioConsecutivoModel = new ConstanciaExtravioConsecutivoModel();
	}

	public function index()
	{
		$data = (object) array();
		$data->estados = $this->_estadosModel->asObject()->findAll();
		$data->municipios = $this->_municipiosModel->asObject()->where('ESTADOID', '2')->findAll();
		$data->lugares = $this->_hechoLugarModel->asObject()->orderBy('HECHODESCR', 'asc')->findAll();
		$data->identificacion = $this->_documentosExtravioTipoModel->asObject()->orderBy('DOCUMENTOEXTRAVIOTIPODESCR', 'asc')->where('VISIBLE', '1')->findAll();
		$data->denunciante = $this->_denunciantesModel->asObject()->where('DENUNCIANTEID', session('DENUNCIANTEID'))->first();
		$this->_loadView('Generar constancias', $data, 'index');
	}

	public function solicitar_constancia()
	{
		$data = [
			'DENUNCIANTEID' => session('DENUNCIANTEID'),

			'EXTRAVIO' => $this->request->getPost('extravio'),

			'ESTADOID' => 2,
			'MUNICIPIOID' => $this->request->getPost('municipio'),
			'MUNICIPIOIDCITA' => $this->request->getPost('municipio_cita'),
			'DOMICILIO' => $this->request->getPost('domicilio'),
			'HECHOLUGARID' => $this->request->getPost('lugar'),
			'HECHOFECHA' => $this->request->getPost('fecha'),

			'NBOLETO' => $this->request->getPost('noboletos'),
			'NTALON' => $this->request->getPost('notalon'),
			'NOMBRESORTEO' => $this->request->getPost('nombreSorteo'),
			'SORTEOFECHA' => empty($this->request->getPost('fechaSorteo'))?null:$this->request->getPost('fechaSorteo'),
			'PERMISOGOBERNACION' => $this->request->getPost('permisoGobernacion'),
			'PERMISOGOBCOLABORADORES' => $this->request->getPost('permisoGColaboradores'),

			'TIPODOCUMENTO' => $this->request->getPost('tipodoc'),
			'NDOCUMENTO' => $this->request->getPost('nodocumento'),
			'DUENONOMBREDOC' => $this->request->getPost('duenonamedoc') ?$this->request->getPost('duenonamedoc'):null ,
			'DUENOAPELLIDOPDOC' => $this->request->getPost('duenoapdoc') ? $this->request->getPost('duenoapdoc'):null,
			'DUENOAPELLIDOMDOC' => $this->request->getPost('duenoamdoc')? $this->request->getPost('duenoamdoc'):null,
			'DUENOFECHANACIMIENTODOC' => empty($this->request->getPost('fecha_duenodoc'))? null:$this->request->getPost('fecha_duenodoc'),

			'SERIEVEHICULO' => $this->request->getPost('serieV'),
			'NPLACA' => $this->request->getPost('noplaca'),
			'POSICIONPLACA' => $this->request->getPost('posicionPlaca'),
			'DISTRIBUIDORVEHICULO' => $this->request->getPost('distribuidor'),
			'MARCA' => $this->request->getPost('marca'),
			'MODELO' => $this->request->getPost('modelo'),
			'ANIOVEHICULO' => $this->request->getPost('anio'),
			'STATUS' => 'ABIERTO',
		];

		if(isset($data['EXTRAVIO']) && $data['EXTRAVIO']=='DOCUMENTOS' || $data['EXTRAVIO']=='BOLETOS DE SORTEO'){
			$constancias_abiertas = $this->_constanciaExtravioModel->asObject()->where('DENUNCIANTEID',session('DENUNCIANTEID'))->where('TIPODOCUMENTO',$data['TIPODOCUMENTO'])->where('STATUS','ABIERTO')->findAll();
			$constancias_proceso = $this->_constanciaExtravioModel->asObject()->where('DENUNCIANTEID',session('DENUNCIANTEID'))->where('TIPODOCUMENTO',$data['TIPODOCUMENTO'])->where('STATUS','EN PROCESO')->findAll();
			$constancias = (object) array_merge($constancias_abiertas, $constancias_proceso);
			if(isset($constancias) && $constancias){
				foreach ($constancias as $key => $constancia) {
					if($constancia->DUENONOMBREDOC == $data['DUENONOMBREDOC'] && $constancia->DUENOAPELLIDOPDOC == $data['DUENOAPELLIDOPDOC'] && $constancia->DUENOAPELLIDOMDOC == $data['DUENOAPELLIDOMDOC'] && $constancia->DUENOFECHANACIMIENTODOC == $data['DUENOFECHANACIMIENTODOC']){
						return redirect()->to(base_url('/constancia_extravio/dashboard'))->with('message_warning', 'Ya existe una solicitud de "'.$data['TIPODOCUMENTO'].'" con la misma información.');
					};
				}
			}
		}
		
		list($CONSECUTIVO, $year) = $this->_constanciaExtravioConsecutivoModel->get_consecutivo();
		$data['CONSTANCIAEXTRAVIOID'] = $CONSECUTIVO;
		$data['ANO'] = $year;
		if ($this->_constanciaExtravioModel->save($data)) {
			return redirect()->to(base_url('/constancia_extravio/dashboard'))->with('message_success', 'Se ha enviado la solicitud de constancia de extravío.');
		} else {
			return redirect()->back()->with('message_error', 'Hubo un error en los datos y no se guardo, intentalo de nuevo.');
		}
	}

	public function constancias()
	{
		$data = (object) array();
		$data->constancias = $this->_constanciaExtravioModel->asObject()->where('DENUNCIANTEID', session('DENUNCIANTEID'))->orderBy('ANO', 'desc')->orderBy('CONSTANCIAEXTRAVIOID', 'desc')->findAll();
		$this->_loadView('Mis constancias de extravío', $data, 'lista_constancias');
	}

	public function validar_constancia()
	{
		$year = date('Y');
		$folio = $this->request->getGet('folio');
		$year = $this->request->getGet('year');
		$constancia = $this->_constanciaExtravioModel->asObject()->where('CONSTANCIAEXTRAVIOID', base64_decode($folio))->where('ANO', $year)->first();
		if ($constancia) {
			$solicitante = $this->_denunciantesModel->asObject()->where('DENUNCIANTEID', $constancia->DENUNCIANTEID)->first();
			$constancia->NOMBRESOLICITANTE = $solicitante->NOMBRE . ' ' . $solicitante->APELLIDO_PATERNO . ' ' . $solicitante->APELLIDO_MATERNO;
		}
		$data2 = [
			'header_data' => (object) ['title' => 'Validar constancia', 'menu' => 'constancia realizada', 'submenu' => ''],
			'body_data' => (object) ['constancia' => $constancia],
		];
		echo view("constancia_extravio/dashboard/validar_constancia", $data2);
	}

	private function _loadView($title, $data, $view)
	{
		$data = [
			'header_data' => (object) ['title' => $title],
			'body_data' => $data,
		];
		echo view("constancia_extravio/dashboard/$view", $data);
	}

	public function download_constancia_pdf()
	{
		$folio = $this->request->getPost('folio');
		$year = $this->request->getPost('year');

		$constancia = $this->_constanciaExtravioModel->asObject()->where('CONSTANCIAEXTRAVIOID', $folio)->where('ANO', $year)->first();
		header("Content-type: application/pdf");
		header("Content-Disposition: attachment; filename=Constancia_" . $folio . '_' . $year . '.pdf');
		echo $constancia->PDF;
	}

	public function download_constancia_xml()
	{
		$folio = $this->request->getPost('folio');
		$year = $this->request->getPost('year');

		$constancia = $this->_constanciaExtravioModel->asObject()->where('CONSTANCIAEXTRAVIOID', $folio)->where('ANO', $year)->first();
		header("Content-type: application/xml");
		header("Content-Disposition: attachment; filename=Constancia_" . $folio . '_' . $year . '.xml');
		echo $constancia->XML;
	}
}

/* End of file DashboardController.php */
/* Location: ./app/Controllers/extravio/DashboardController.php */