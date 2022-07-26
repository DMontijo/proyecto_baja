<?php

namespace App\Controllers\extravio;

use App\Controllers\BaseController;

use App\Models\DenunciantesModel;
use App\Models\EstadosModel;
use App\Models\MunicipiosModel;
use App\Models\LocalidadesModel;
use App\Models\ColoniasModel;
use App\Models\HechoLugarModel;
use App\Models\VehiculoColorModel;
use App\Models\VehiculoMarcaModel;
use App\Models\VehiculoModeloModel;
use App\Models\VehiculoTipoModel;
use App\Models\PaisesModel;
use App\Models\DelitosUsuariosModel;
use App\Models\PersonaIdiomaModel;
use App\Models\VehiculoDistribuidorModel;
use App\Models\VehiculoVersionModel;
use App\Models\VehiculoServicioModel;
use App\Models\PersonaTipoIdentificacionModel;
use App\Models\ConstanciaExtraviadoModel;

use App\Models\FolioPreguntasModel;
use App\Models\FolioCorrelativoModel;
use App\Models\FolioModel;
use App\Models\FolioPersonaFisicaModel;
use App\Models\FolioPersonaFisicaDomicilioModel;
use App\Models\FolioPersonaFisicaDesaparecidaModel;
use App\Models\FolioPersonaFisicaImputadoDelitoModel;
use App\Models\FolioPersonaFisicaImputadoModel;
use App\Models\FolioRelacionFisicaFisicaModel;
use App\Models\FolioObjetoModel;
use App\Models\FolioVehiculoModel;
use App\Models\FolioDocumentoModel;
use App\Models\FolioArchivoExternoModel;

class DashboardController extends BaseController
{
	function __construct()
	{
		//Models
		$this->_paisesModel = new PaisesModel();
		$this->_estadosModel = new EstadosModel();
		$this->_municipiosModel = new MunicipiosModel();
		$this->_localidadesModel = new LocalidadesModel();
		$this->_coloniasModel = new ColoniasModel();
		$this->_hechoLugarModel = new HechoLugarModel();
		$this->_coloresVehiculoModel = new VehiculoColorModel();
		$this->_marcaVehiculoModel = new VehiculoMarcaModel();
		$this->_lineaVehiculoModel = new VehiculoModeloModel();
		$this->_tipoVehiculoModel = new VehiculoTipoModel();
		$this->_distribuidorVehiculoModel = new VehiculoDistribuidorModel();
		$this->_versionVehiculoModel = new VehiculoVersionModel();
		$this->_servicioVehiculoModel = new VehiculoServicioModel();
		$this->_delitosUsuariosModel = new DelitosUsuariosModel();
		$this->_denunciantesModel = new DenunciantesModel();
		$this->_personaIdiomaModel = new PersonaIdiomaModel();
		$this->_personaIdentificacionModel = new PersonaTipoIdentificacionModel();
		$this->_constanciaExtravioModel= new ConstanciaExtraviadoModel();
		$this->_folioCorrelativoModel = new FolioCorrelativoModel();
		$this->_folioModel = new FolioModel();
		$this->_folioPreguntasModel = new FolioPreguntasModel();
		$this->_folioPersonaFisicaModel = new FolioPersonaFisicaModel();
		$this->_folioPersonaFisicaDomicilioModel = new FolioPersonaFisicaDomicilioModel();
		$this->_folioPersonaFisicaDesaparecidaModel = new FolioPersonaFisicaDesaparecidaModel();
		$this->_folioPersonaFisicaImputadoDelitoModel = new FolioPersonaFisicaImputadoDelitoModel();
		$this->_folioPersonaFisicaImputadoModel = new FolioPersonaFisicaImputadoModel();
		$this->_folioRelacionFisicaFisicaModel = new FolioRelacionFisicaFisicaModel();
		$this->_folioObjetoModel = new FolioObjetoModel();
		$this->_folioVehiculoModel = new FolioVehiculoModel();
		$this->_folioDocumentoModel = new FolioDocumentoModel();
		$this->_folioArchivoExternoModel = new FolioArchivoExternoModel();
	}

	public function index()
	{
		$session = session();
		$data = (object)array();
		$data->estados = $this->_estadosModel->asObject()->findAll();
		$data->municipios = $this->_municipiosModel->asObject()->findAll();
		$data->lugares = $this->_hechoLugarModel->asObject()->orderBy('HECHODESCR', 'asc')->findAll();
		$data->marca = $this->_marcaVehiculoModel->asObject()->orderBy('VEHICULOMARCADESCR', 'asc')->findAll();
		$data->modelo = $this->_lineaVehiculoModel->asObject()->orderBy('VEHICULOMODELODESCR', 'asc')->findAll();
		$data->identificacion = $this->_personaIdentificacionModel->asObject()->orderBy('PERSONATIPOIDENTIFICACIONDESCR', 'asc')->findAll();

		$data->denunciante = $this->_denunciantesModel->asObject()->where('ID_DENUNCIANTE', $session->get('ID_DENUNCIANTE'))->first();
		$this->_loadView('Datos personales', $data, 'index');
	}
	private function _loadView($title, $data, $view)
	{
		$data = [
			'header_data' => (object)['title' => $title],
			'body_data' => $data
		];
		echo view("constancia_extravio/dashboard/$view", $data);
	}

	public function solicitar_constancia()
	{
		$session = session();
		$data = [
			'DENUNCIANTEID' =>$session->get('ID_DENUNCIANTE'),
			'MUNICIPIOID' => $this->request->getPost('municipio'),
			'ESTADOID'=>$this->request->getPost('estado'),
			'EXTRAVIO'=>$this->request->getPost('extravio'),
			'DESCRIPCION_EXTRAVIO'=>$this->request->getPost('descripcion'),

			'DOMICILIO' => $this->request->getPost('domicilio'),
			'HECHOLUGARID' => $this->request->getPost('lugar'),
			'HECHOFECHA' =>  $this->request->getPost('fecha'),
			'ANO' => (int)date("Y"),
			'HECHOHORA' => $this->request->getPost('hora'),

            'NBOLETO'=> $this->request->getPost('noboletos'),
			'NTALON' => $this->request->getPost('notalon'),
			'NOMBRESORTEO' => $this->request->getPost('nombreSorteo'),
			'SORTEOFECHA' => $this->request->getPost('fechaSorteo'),
            'PERMISOGOBERNACION'=> $this->request->getPost('permisoGobernacion'),
			'PERMISOGOBCOLABORADORES' => $this->request->getPost('permisoGColaboradores'),

			'TIPODOCUMENTO' => $this->request->getPost('tipodoc'),
			'NDOCUMENTO' => $this->request->getPost('nodocumento'),
            'DUENONOMBREDOC'=> $this->request->getPost('duenonamedoc'),
			'DUENOAPELLIDOPDOC' => $this->request->getPost('duenoapdoc'),
			'DUENOAPELLIDOMDOC' => $this->request->getPost('duenoamdoc'),

			'SERIEVEHICULO' => $this->request->getPost('serieV'),
			'NPLACA' => $this->request->getPost('noplaca'),
			'POSICIONPLACA' => $this->request->getPost('posicionPlaca'),
			'DISTRIBUIDORVEHICULO' => $this->request->getPost('distribuidor'),
			'MARCAID' => $this->request->getPost('marca'),
			'MODELOID' => $this->request->getPost('modelo'),
			'ANIOVEHICULO' => $this->request->getPost('anio'),

			'STATUS' => 'open',
		];
		// var_dump($data);
		// exit;
		$insert = $this->_constanciaExtravioModel->insert($data);
		if ($insert) {
			return redirect()->to(base_url('/constancia_extravio/dashboard'))->with('peticion', 'Se ha enviado tu petición');
		} else {
			return redirect()->back()->with('message', 'Hubo un error en los datos.');
		}
	}
}

/* End of file DashboardController.php */
/* Location: ./app/Controllers/client/DashboardController.php */
