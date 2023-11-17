<?php

namespace App\Controllers\litigantes;

use App\Controllers\BaseController;
use App\Models\ConstanciaExtravioConsecutivoModel;
use App\Models\ConstanciaExtravioModel;
use App\Models\FolioArchivoExternoModel;
use App\Models\FolioConsecutivoModel;
use App\Models\FolioModel;
use App\Models\FolioPersonaFisicaDomicilioModel;
use App\Models\FolioPersonaFisicaMediaFiliacionModel;
use App\Models\FolioPersonaFisicaModel;
use App\Models\FolioPersonaMoralModel;
use App\Models\FolioVehiculoModel;
use App\Models\PersonaMoralNotificacionesModel;
use App\Models\PersonasMoralesModel;
use App\Models\RelacionFisicaMoralModel;
use App\Models\RelacionPoderLitigante;
use GuzzleHttp\Client;
use MailerSend\MailerSend;
use MailerSend\Helpers\Builder\Recipient;
use MailerSend\Helpers\Builder\EmailParams;
use MailerSend\Exceptions\MailerSendValidationException;
use MailerSend\Exceptions\MailerSendRateLimitException;

class DashboardController extends BaseController
{

	private $db_read;

	private $_constanciaExtravioModel;
	private $_estadosModelRead;
	private $_municipiosModelRead;
	private $_hechoLugarModelRead;
	private $_denunciantesModelRead;
	private $_documentosExtravioTipoModelRead;
	private $_constanciaExtravioModelRead;
	private $_constanciaExtravioConsecutivoModelRead;
	private $_constanciaExtravioConsecutivoModel;
	private $_personasMoralesModel;
	private $_localidadesModelRead;
	private $_coloniasModelRead;
	private $_personasMoralesRead;
	private $_relacionFisicaMoralModel;
	private $_relacionFisicaMoralModelRead;
	private $_estadosExtranjerosRead;
	private $_delitosUsuariosModelRead;
	private $_nacionalidadModelRead;
	private $_personaIdiomaModelRead;
	private $_paisesModelRead;
	private $_escolaridadModelRead;
	private $_ocupacionModelRead;
	private $_coloresVehiculoModelRead;
	private $_tipoVehiculoModelRead;
	private $_figuraModelRead;
	private $_cabelloColorModelRead;
	private $_cabelloEstiloModelRead;
	private $_cabelloTamanoModelRead;
	private $_frenteFormaModelRead;
	private $_cejaFormaModelRead;
	private $_ojoColorModelRead;
	private $_parentescoModelRead;
	private $_pielColorModelRead;
	private $_vehiculoDistribuidorModelRead;
	private $_vehiculoMarcaModelRead;
	private $_vehiculoModeloModelRead;
	private $_vehiculoVersionModelRead;
	private $_vehiculoServicioModelRead;
	private $_folioConsecutivoModel;
	private $_folioModel;
	private $_folioPersonaFisicaModelRead;
	private $_folioPersonaFisicaModel;
	private $_folioPersonaFisicaDomicilioModelRead;
	private $_folioPersonaFisicaDomicilioModel;
	private $_folioMediaFiliacion;
	private $_folioVehiculoModelRead;
	private $_folioVehiculoModel;
	private $_personasMoralesNotificacionesModel;
	private $_personasMoralesNotificacionesModelRead;
	private $_folioPersonaMoralModel;
	private $_folioPersonaMoralModelRead;
	private $_conexionesDBModelRead;
	private $endpoint;
	private $protocol;
	private $ip;
	private $_folioModelRead;
	private $_personaMoralGiroRead;
	private $_relacionMoralPoderRead;
	private $_relacionMoralPoder;
	private $_relacionPoderLitigantes;
	private $_archivoExternoModel;
	private $_archivoExternoModelRead;




	public function __construct()
	{
		$this->db_read = ENVIRONMENT == 'production' ? db_connect('default_read') : db_connect('development_read');
		$this->protocol = 'https://';
		$this->ip = "ws.fgebc.gob.mx";
		$this->endpoint = $this->protocol . $this->ip . '/webServiceVD';

		//Models
		$this->_folioConsecutivoModel = new FolioConsecutivoModel();
		$this->_folioModel = new FolioModel();
		$this->_constanciaExtravioModel = new ConstanciaExtravioModel();
		$this->_constanciaExtravioConsecutivoModel = new ConstanciaExtravioConsecutivoModel();
		$this->_personasMoralesModel = new PersonasMoralesModel();
		$this->_relacionFisicaMoralModel = new RelacionFisicaMoralModel();
		$this->_folioPersonaFisicaModel = new FolioPersonaFisicaModel();
		$this->_folioPersonaFisicaDomicilioModel = new FolioPersonaFisicaDomicilioModel();
		$this->_folioMediaFiliacion = new FolioPersonaFisicaMediaFiliacionModel();
		$this->_folioVehiculoModel = new FolioVehiculoModel();
		$this->_archivoExternoModel = new FolioArchivoExternoModel();
		$this->_personasMoralesNotificacionesModel = new PersonaMoralNotificacionesModel();
		$this->_folioPersonaMoralModel = new FolioPersonaMoralModel();
		$this->_relacionPoderLitigantes = new RelacionPoderLitigante();

		$this->_folioPersonaFisicaModelRead = model('FolioPersonaFisicaModel', true, $this->db_read);
		$this->_folioPersonaFisicaDomicilioModelRead = model('FolioPersonaFisicaDomicilioModel', true, $this->db_read);
		$this->_folioVehiculoModelRead = model('FolioVehiculoModel', true, $this->db_read);
		$this->_personasMoralesNotificacionesModelRead = model('PersonaMoralNotificacionesModel', true, $this->db_read);
		$this->_conexionesDBModelRead = model('ConexionesDBModel', true, $this->db_read);
		$this->_folioModelRead = model('FolioModel', true, $this->db_read);
		$this->_folioPersonaMoralModelRead = model('FolioPersonaMoralModel', true, $this->db_read);
		$this->_hechoLugarModelRead = model('HechoLugarModel', true, $this->db_read);
		$this->_estadosModelRead = model('EstadosModel', true, $this->db_read);
		$this->_municipiosModelRead = model('MunicipiosModel', true, $this->db_read);
		$this->_denunciantesModelRead = model('DenunciantesModel', true, $this->db_read);
		$this->_documentosExtravioTipoModelRead = model('DocumentosExtravioTipoModel', true, $this->db_read);
		$this->_localidadesModelRead = model('LocalidadesModel', true, $this->db_read);
		$this->_coloniasModelRead = model('ColoniasModel', true, $this->db_read);
		$this->_personasMoralesRead = model('PersonasMoralesModel', true, $this->db_read);
		$this->_relacionFisicaMoralModelRead = model('RelacionFisicaMoralModel', true, $this->db_read);
		$this->_paisesModelRead = model('PaisesModel', true, $this->db_read);
		$this->_estadosExtranjerosRead = model('EstadoExtranjeroModel', true, $this->db_read);
		$this->_nacionalidadModelRead = model('PersonaNacionalidadModel', true, $this->db_read);
		$this->_coloresVehiculoModelRead = model('VehiculoColorModel', true, $this->db_read);
		$this->_tipoVehiculoModelRead = model('VehiculoTipoModel', true, $this->db_read);
		$this->_figuraModelRead = model('FiguraModel', true, $this->db_read);
		$this->_cabelloColorModelRead = model('CabelloColorModel', true, $this->db_read);
		$this->_cabelloEstiloModelRead = model('CabelloEstiloModel', true, $this->db_read);
		$this->_cabelloTamanoModelRead = model('CabelloTamanoModel', true, $this->db_read);
		$this->_delitosUsuariosModelRead = model('DelitosUsuariosModel', true, $this->db_read);
		$this->_escolaridadModelRead = model('EscolaridadModel', true, $this->db_read);
		$this->_ocupacionModelRead = model('OcupacionModel', true, $this->db_read);
		$this->_frenteFormaModelRead = model('FrenteFormaModel', true, $this->db_read);
		$this->_ojoColorModelRead = model('OjoColorModel', true, $this->db_read);
		$this->_cejaFormaModelRead = model('CejaFormaModel', true, $this->db_read);
		$this->_pielColorModelRead = model('PielColorModel', true, $this->db_read);
		$this->_parentescoModelRead = model('ParentescoModel', true, $this->db_read);
		$this->_archivoExternoModelRead = model('FolioArchivoExternoModel', true, $this->db_read);

		$this->_vehiculoDistribuidorModelRead = model('VehiculoDistribuidorModel', true, $this->db_read);
		$this->_vehiculoMarcaModelRead = model('VehiculoMarcaModel', true, $this->db_read);
		$this->_vehiculoModeloModelRead = model('VehiculoModeloModel', true, $this->db_read);
		$this->_vehiculoVersionModelRead = model('VehiculoVersionModel', true, $this->db_read);
		$this->_vehiculoServicioModelRead = model('VehiculoServicioModel', true, $this->db_read);
		$this->_personaMoralGiroRead = model('PersonaMoralGiroModel', true, $this->db_read);
		$this->_relacionMoralPoderRead = model('RelacionPoderLitigante', true, $this->db_read);
	}

	/**
	 * Vista principal del modulo litigantes
	 * Carga todos los catalogos para su funcionamiento
	 *
	 */
	public function index()
	{
		$data = (object) array();


		$data->estados = $this->_estadosModelRead->asObject()->findAll();
		$data->giros = $this->_personaMoralGiroRead->asObject()->findAll();
		$data->municipios = $this->_municipiosModelRead->asObject()->where('ESTADOID', '2')->findAll();
		$data->lugares = $this->_hechoLugarModelRead->asObject()->orderBy('HECHODESCR', 'asc')->findAll();
		$data->identificacion = $this->_documentosExtravioTipoModelRead->asObject()->orderBy('DOCUMENTOEXTRAVIOTIPODESCR', 'asc')->where('VISIBLE', '1')->findAll();
		$data->denunciante = $this->_denunciantesModelRead->asObject()->where('DENUNCIANTEID', session('DENUNCIANTEID'))->first();
		$data->paises = $this->_paisesModelRead->asObject()->findAll();
		$data->estados = $this->_estadosModelRead->asObject()->findAll();
		$data->estadosExtranjeros = $this->_estadosExtranjerosRead->asObject()->findAll();

		$data->municipios = $this->_municipiosModelRead->asObject()->where('ESTADOID', '2')->findAll();
		$data->nacionalidades = $this->_nacionalidadModelRead->asObject()->findAll();
		$lugares = $this->_hechoLugarModelRead->orderBy('HECHODESCR', 'ASC')->findAll();

		$lugares_sin = [];
		$lugares_fuego = [];
		$lugares_blanca = [];
		$lugares_peticion = [];

		foreach ($lugares as $lugar) {
			if (strpos($lugar['HECHODESCR'], 'ARMA DE FUEGO')) {
				array_push($lugares_fuego, (object) $lugar);
			}
			if (strpos($lugar['HECHODESCR'], 'ARMA BLANCA')) {
				array_push($lugares_blanca, (object) $lugar);
			}
			if (!strpos($lugar['HECHODESCR'], 'ARMA BLANCA') && !strpos($lugar['HECHODESCR'], 'ARMA DE FUEGO')) {
				array_push($lugares_sin, (object) $lugar);
			}

			if ($lugar['HECHODESCR'] == 'CASA HABITACION' || $lugar['HECHODESCR'] == 'DESPOBLADO' || $lugar['HECHODESCR'] == 'VIA PUBLICA' || $lugar['HECHODESCR'] == 'CENTRO ESCOLAR') {
				array_push($lugares_peticion, (object) $lugar);
			}
		}
		$data->lugares  = [];
		$data->lugares =  (object) array_merge($lugares_peticion, $lugares_sin, $lugares_blanca, $lugares_fuego);
		$lugares_merge = [];
		$lugares_merge =  array_merge($lugares_peticion, $lugares_sin);
		$data->lugares = (object)array_unique($lugares_merge, SORT_REGULAR);
		$data->colorVehiculo = $this->_coloresVehiculoModelRead->asObject()->findAll();
		$data->tipoVehiculo = $this->_tipoVehiculoModelRead->asObject()->orderBy('VEHICULOTIPODESCR', 'ASC')->findAll();
		$data->delitosUsuarios = $this->_delitosUsuariosModelRead->asObject()->orderBy('DELITO', 'ASC')->findAll();
		$data->escolaridades = $this->_escolaridadModelRead->asObject()->findAll();
		$data->ocupaciones = $this->_ocupacionModelRead->asObject()->findAll();
		$data->figura = $this->_figuraModelRead->asObject()->findAll();
		$data->cabelloColor = $this->_cabelloColorModelRead->asObject()->findAll();
		$data->cabelloTamano = $this->_cabelloTamanoModelRead->asObject()->findAll();
		$data->frenteForma = $this->_frenteFormaModelRead->asObject()->findAll();
		$data->ojoColor = $this->_ojoColorModelRead->asObject()->findAll();
		$data->cabelloEstilo = $this->_cabelloEstiloModelRead->asObject()->findAll();
		$data->cejaForma = $this->_cejaFormaModelRead->asObject()->findAll();
		$data->pielColor = $this->_pielColorModelRead->asObject()->findAll();
		$data->parentesco = $this->_parentescoModelRead->asObject()->findAll();
		$this->_loadView('Denuncia litigantes', $data, 'index');
	}
	/**
	 * Vista para ver las opciones de modulo litigantes
	 * Carga todos los catalogos para su funcionamiento
	 *
	 */
	public function modulo_litigantes()
	{
		$data = (object) array();
		$data->empresas = $this->_personasMoralesRead->asObject()->findAll();
		$data->estados = $this->_estadosModelRead->asObject()->findAll();
		$data->giros = $this->_personaMoralGiroRead->asObject()->findAll();
		$data->municipios = $this->_municipiosModelRead->asObject()->where('ESTADOID', '2')->findAll();
		$data->lugares = $this->_hechoLugarModelRead->asObject()->orderBy('HECHODESCR', 'asc')->findAll();
		$data->identificacion = $this->_documentosExtravioTipoModelRead->asObject()->orderBy('DOCUMENTOEXTRAVIOTIPODESCR', 'asc')->where('VISIBLE', '1')->findAll();
		$data->denunciante = $this->_denunciantesModelRead->asObject()->where('DENUNCIANTEID', session('DENUNCIANTEID'))->first();
		$this->_loadView('Denuncia litigantes', $data, 'modulo');
	}
	/**
	 * Vista para ver la pantalla final
	 * Carga todos los catalogos para su funcionamiento
	 *
	 */
	public function pantalla_final()
	{
		$this->_loadView('Denuncia creada', [], 'pantalla_final');
	}
	/**
	 * Funcion para crear una empresa
	 */
	public function crear_empresa()
	{
		$id = session('DENUNCIANTEID');
		$denunciante = $this->_denunciantesModelRead->asObject()->where('DENUNCIANTEID', session('DENUNCIANTEID'))->where('TIPO', 3)->first();
		if ($denunciante) {

			//Datos del formulario
			$data = [
				'RAZONSOCIAL' => $this->request->getPost('razon_social'),
				'MARCACOMERCIAL' => $this->request->getPost('marca_comercial') != "" ? $this->request->getPost('marca_comercial') : NULL,
				'RFC' => $this->request->getPost('rfc'),
				'PERSONAMORALGIROID' => $this->request->getPost('giro_empresa'),
				'ESTADOID' => $this->request->getPost('estado_empresa'),
				'MUNICIPIOID' => $this->request->getPost('municipio_empresa'),
				'LOCALIDADID' => $this->request->getPost('localidad_empresa'),
				'ZONA' => $this->request->getPost('zona_empresa'),
				'COLONIAID' => $this->request->getPost('colonia_select_empresa'),
				'COLONIADESCR' => $this->request->getPost('colonia_input_empresa'),
				'CALLE' => $this->request->getPost('calle_empresa'),
				'NUMERO' => $this->request->getPost('n_empresa'),
				'NUMEROINTERIOR' => $this->request->getPost('ninterior_empresa') != "" ? $this->request->getPost('ninterior_empresa') : NULL,
				'REFERENCIA' => $this->request->getPost('referencia_empresa')  != "" ? $this->request->getPost('referencia_empresa') : NULL,
				'TELEFONO' => $this->request->getPost('telefono_empresa'),
				'CORREO' => $this->request->getPost('correo_empresa'),
			];
			$colonia = $this->_coloniasModelRead->asObject()->where('ESTADOID', $this->request->getPost('estado_empresa'))->where('MUNICIPIOID', $this->request->getPost('municipio_empresa'))->where('LOCALIDADID', $this->request->getPost('localidad_empresa'))->where('COLONIAID', $this->request->getPost('colonia_select_empresa'))->first();

			if ($data['COLONIAID'] == '0' || $data['COLONIAID'] == null) {
				$data['COLONIAID'] = null;
				$data['COLONIADESCR'] = $this->request->getPost('colonia_input_empresa');
				$localidad = $this->_localidadesModelRead->asObject()->where('ESTADOID', $this->request->getPost('estado_empresa'))->where('MUNICIPIOID', $this->request->getPost('municipio_empresa'))->where('LOCALIDADID', $this->request->getPost('localidad_empresa'))->first();
				$data['ZONA'] = $localidad->ZONA;
			} else {
				$data['COLONIAID'] = (int) $this->request->getPost('colonia_select_empresa');
				$data['COLONIADESCR'] = $colonia->COLONIADESCR;
				$data['ZONA'] = $colonia->ZONA;
			}

			if ($this->_personasMoralesModel->save($data)) {
				$data['PERSONAMORALID'] = $this->_personasMoralesModel->getInsertID();
				$this->_personasMoralesNotificacionesModel->save($data);
				return redirect()->to(base_url('/denuncia_litigantes/dashboard/modulo'))->with('message_success', 'Se ha creado la persona moral.');
			} else {
				return redirect()->back()->with('message_error', 'Hubo un error en los datos y no se guardo, intentalo de nuevo.');
			}
		} else {
			return redirect()->to(base_url('/denuncia_litigantes/dashboard'))->with('message_error', 'No tienes privilegios para ligarte a una persona moral');
		}
	}
	/**
	 * Funcion para crear una direccion notificacion
	 */
	public function crear_direccion_notificacion()
	{
		$id = session('DENUNCIANTEID');
		$denunciante = $this->_denunciantesModelRead->asObject()->where('DENUNCIANTEID', session('DENUNCIANTEID'))->where('TIPO', 3)->first();
		if ($denunciante) {

			$personaMoralId =  $this->request->getPost('personamoralid');
			//Datos del formulario
			$data = [
				'PERSONAMORALID' => $personaMoralId,
				'ESTADOID' => $this->request->getPost('estado_empresa_extra'),
				'MUNICIPIOID' => $this->request->getPost('municipio_empresa_extra'),
				'LOCALIDADID' => $this->request->getPost('localidad_empresa_extra'),
				'COLONIAID' => $this->request->getPost('colonia_select_empresa_extra'),
				'COLONIADESCR' => $this->request->getPost('colonia_input_empresa_extra'),
				'CALLE' => $this->request->getPost('calle_empresa_extra'),
				'NUMERO' => $this->request->getPost('n_empresa_extra'),
				'NUMEROINTERIOR' => $this->request->getPost('ninterior_empresa_extra'),
				'REFERENCIA' => $this->request->getPost('referencia_empresa_extra'),
				'TELEFONO' => $this->request->getPost('telefono_empresa_extra'),
				'CORREO' => $this->request->getPost('correo_empresa_extra'),
			];
			$colonia = $this->_coloniasModelRead->asObject()->where('ESTADOID', $this->request->getPost('estado_empresa_extra'))->where('MUNICIPIOID', $this->request->getPost('municipio_empresa_extra'))->where('LOCALIDADID', $this->request->getPost('localidad_empresa_extra'))->where('COLONIAID', $this->request->getPost('colonia_select_empresa_extra'))->first();

			if ($data['COLONIAID'] == '0' || $data['COLONIAID'] == null) {
				$data['COLONIAID'] = null;
				$data['COLONIADESCR'] = $this->request->getPost('colonia_input_empresa_extra');
				$localidad = $this->_localidadesModelRead->asObject()->where('ESTADOID', $this->request->getPost('estado_empresa_extra'))->where('MUNICIPIOID', $this->request->getPost('municipio_empresa_extra'))->where('LOCALIDADID', $this->request->getPost('localidad_empresa_extra'))->first();
				$data['ZONA'] = $localidad->ZONA;
			} else {
				$data['COLONIAID'] = (int) $this->request->getPost('colonia_select_empresa_extra');
				$data['COLONIADESCR'] = $colonia->COLONIADESCR;
				$data['ZONA'] = $colonia->ZONA;
			}

			$notificacionMoral = $this->_personaMoralNotificacion($data, $personaMoralId);
			if ($notificacionMoral) {
				$notificaciones = $this->_personasMoralesNotificacionesModelRead->asObject()->where('PERSONAMORALID', $personaMoralId)->findAll();

				return json_encode(['status' => 1, 'notificaciones' => $notificaciones]);
				// $this->_personasMoralesNotificacionesModel->save($data);
				// return redirect()->to(base_url('/denuncia_litigantes/dashboard'))->with('message_success', 'Se ha creado la empresa.');
			} else {
				return json_encode(['status' => 0]);

				// return redirect()->back()->with('message_error', 'Hubo un error en los datos y no se guardo, intentalo de nuevo.');
			}
		} else {
			return redirect()->to(base_url('/denuncia_litigantes/dashboard'))->with('message_error', 'No tienes privilegios para agregar direcciones a una persona moral');
		}
	}
	/**
	 * Funcion para ligar a un litigante con una empresa
	 * Recibe por metodo POST los datos del formulario
	 *
	 */
	public function ligar_empresa()
	{
		$id = session('DENUNCIANTEID');
		$denunciante = $this->_denunciantesModelRead->asObject()->where('DENUNCIANTEID', session('DENUNCIANTEID'))->where('TIPO', 3)->first();
		if ($denunciante) {

			$poder_archivo = $this->request->getFile('poder_archivo');
			$poder_data = null;
			if ($poder_archivo->isValid()) {
				try {
					$poder_data = file_get_contents($poder_archivo);
				} catch (\Exception $e) {
					$poder_data = null;
				}
			}
			$nombre = explode('.', $poder_archivo->getName())[0];

			if ($_FILES['poder_archivo']['name'] != null) {
				$poder_data = file_get_contents($poder_archivo);
				$data = [
					'PERSONAMORALID' => $this->request->getPost('empresa'),
					'DENUNCIANTEID' => $id,
					'PODERVOLUMEN' => $this->request->getPost('poder_volumen') != "" ? $this->request->getPost('poder_volumen') : NULL,
					'PODERNONOTARIO' => $this->request->getPost('poder_notario') != "" ? $this->request->getPost('poder_notario') : NULL,
					'PODERNOPODER' => $this->request->getPost('poder_no_poder') != "" ? $this->request->getPost('poder_no_poder') : NULL,
					'PODERARCHIVO' => $poder_data,
					'FECHAINICIOPODER' => $this->request->getPost('fecha_inicio_poder') != "" ? $this->request->getPost('fecha_inicio_poder') : NULL,
					'FECHAFINPODER' => $this->request->getPost('fecha_fin_poder') != "" ? $this->request->getPost('fecha_fin_poder') : NULL,
					'CARGO' => $this->request->getPost('cargo'),
					'DESCRIPCIONCARGO' => $this->request->getPost('descr_cargo') != "" ? $this->request->getPost('descr_cargo') : NULL,

				];
			} else {
				$data = [
					'PERSONAMORALID' => $this->request->getPost('empresa'),
					'DENUNCIANTEID' => $id,
					'PODERVOLUMEN' => $this->request->getPost('poder_volumen') != "" ? $this->request->getPost('poder_volumen') : NULL,
					'PODERNONOTARIO' => $this->request->getPost('poder_notario') != "" ? $this->request->getPost('poder_notario') : NULL,
					'PODERNOPODER' => $this->request->getPost('poder_no_poder') != "" ? $this->request->getPost('poder_no_poder') : NULL,
					'FECHAINICIOPODER' => $this->request->getPost('fecha_inicio_poder') != "" ? $this->request->getPost('fecha_inicio_poder') : NULL,
					'FECHAFINPODER' => $this->request->getPost('fecha_fin_poder') != "" ? $this->request->getPost('fecha_fin_poder') : NULL,
					'CARGO' => $this->request->getPost('cargo'),
					'DESCRIPCIONCARGO' => $this->request->getPost('descr_cargo') != "" ? $this->request->getPost('descr_cargo') : NULL,

				];
			}
			$existeRelacion = $this->_relacionFisicaMoralModel->asObject()->where('PERSONAMORALID', $data['PERSONAMORALID'])->where('DENUNCIANTEID', $data['DENUNCIANTEID'])->first();

			if ($existeRelacion) {
				$updateRelacion = $this->_relacionFisicaMoralModel->set($data)->where('PERSONAMORALID', $data['PERSONAMORALID'])->where('DENUNCIANTEID', $data['DENUNCIANTEID'])->update();
				if ($updateRelacion) {
					return redirect()->back()->with('message_success', 'Se ha enviado la solicitud de ligación.');
				} else {
					return redirect()->back()->with('message_error', 'Hubo un error en los datos y no se guardo, intentalo de nuevo.');
				}
			}
			if ($this->_relacionFisicaMoralModel->save($data)) {
				return redirect()->back()->with('message_success', 'Se ha enviado la solicitud de ligación.');
				// return redirect()->to(base_url('/denuncia_litigantes/dashboard'))->with('message_success', 'Se ha enviado la solicitud de ligación.');

			} else {
				return redirect()->back()->with('message_error', 'Hubo un error en los datos y no se guardo, intentalo de nuevo.');
			}
		} else {
			return redirect()->to(base_url('/denuncia_litigantes/dashboard'))->with('message_error', 'No tienes privilegios para ligarte a una persona moral');
		}
	}


	/**
	 * Vista para el listado de Mis ligaciones de acuerdo al litigante en la sesion
	 *
	 */
	public function ligaciones()
	{
		$data = (object) array();
		// $data->ligaciones = $this->_relacionFisicaMoralModelRead->asObject()
		// 	->select('RAZONSOCIAL,MARCACOMERCIAL,RFC,RELACIONAR,RELACIONFISICAMORAL.PERSONAMORALID,RELACIONFISICAMORAL.DENUNCIANTEID,PERSONASMORALES.FECHAFINPODER,DENUNCIANTES.CORREO')
		// 	->join('PERSONASMORALES', 'PERSONASMORALES.PERSONAMORALID = RELACIONFISICAMORAL.PERSONAMORALID')
		// 	->join('DENUNCIANTES', 'DENUNCIANTES.DENUNCIANTEID = RELACIONFISICAMORAL.DENUNCIANTEID')
		// 	->where('RELACIONFISICAMORAL.DENUNCIANTEID', session('DENUNCIANTEID'))
		// 	->findAll();
		$data->ligaciones =
			// $this->_relacionMoralPoderRead->asObject()->select('PERSONASMORALES.RAZONSOCIAL,PERSONASMORALES.MARCACOMERCIAL,PERSONASMORALES.RFC,PERSONASMORALES.PERSONAMORALID,FECHAFINPODER')
			// ->join('PERSONASMORALES', 'PERSONASMORALES.PODERID = RELACIONPODERLITIGANTE.PODERID')
			// ->where('RELACIONPODERLITIGANTE.PERSONAFISICAID', session('DENUNCIANTEID'))
			// ->groupBy('PERSONASMORALES.RFC')
			// ->findAll();

		$this->_folioPersonaMoralModelRead->asObject()
		->select('PERSONASMORALES.RAZONSOCIAL,PERSONASMORALES.MARCACOMERCIAL,PERSONASMORALES.RFC,PERSONASMORALES.PERSONAMORALID,FOLIO.DENUNCIANTEID,RELACIONPODERLITIGANTE.FECHAFINPODER,DENUNCIANTES.CORREO')
			->join('PERSONASMORALES', 'PERSONASMORALES.PERSONAMORALID = FOLIOPERSONAMORAL.PERSONAMORALID')
			->join('RELACIONPODERLITIGANTE', 'RELACIONPODERLITIGANTE.PERSONAMORALID = PERSONASMORALES.PERSONAMORALID')
			->join('FOLIO', 'FOLIO.FOLIOID = FOLIOPERSONAMORAL.FOLIOID')
			->join('DENUNCIANTES', 'DENUNCIANTES.DENUNCIANTEID = FOLIO.DENUNCIANTEID')
			->where('FOLIO.DENUNCIANTEID', session('DENUNCIANTEID'))
			->where('RELACIONPODERLITIGANTE.ACTIVO', 1)
			->groupBy('FOLIOPERSONAMORAL.PERSONAMORALID')
			->findAll();
		$data->empresas = $this->_personasMoralesRead->asObject()->findAll();
		$data->estados = $this->_estadosModelRead->asObject()->findAll();
		$data->giros = $this->_personaMoralGiroRead->asObject()->findAll();
		$data->municipios = $this->_municipiosModelRead->asObject()->where('ESTADOID', '2')->findAll();
		$data->lugares = $this->_hechoLugarModelRead->asObject()->orderBy('HECHODESCR', 'asc')->findAll();
		$data->identificacion = $this->_documentosExtravioTipoModelRead->asObject()->orderBy('DOCUMENTOEXTRAVIOTIPODESCR', 'asc')->where('VISIBLE', '1')->findAll();
		$this->_loadView('Mis ligaduras', $data, 'lista_ligaciones');
	}
	/**
	 * Vista de Dashboard-Denuncia Persona Fisica
	 * Retorna los catálogos necesarios para iniciar la denuncia
	 */
	public function denuncia_persona_fisica()
	{
		$data = (object) array();
		$data->paises = $this->_paisesModelRead->asObject()->findAll();
		$data->estados = $this->_estadosModelRead->asObject()->findAll();
		$data->estadosExtranjeros = $this->_estadosExtranjerosRead->asObject()->findAll();

		$data->municipios = $this->_municipiosModelRead->asObject()->where('ESTADOID', '2')->findAll();
		$data->nacionalidades = $this->_nacionalidadModelRead->asObject()->findAll();
		$lugares = $this->_hechoLugarModelRead->orderBy('HECHODESCR', 'ASC')->findAll();

		$lugares_sin = [];
		$lugares_fuego = [];
		$lugares_blanca = [];
		$lugares_peticion = [];

		foreach ($lugares as $lugar) {
			if (strpos($lugar['HECHODESCR'], 'ARMA DE FUEGO')) {
				array_push($lugares_fuego, (object) $lugar);
			}
			if (strpos($lugar['HECHODESCR'], 'ARMA BLANCA')) {
				array_push($lugares_blanca, (object) $lugar);
			}
			if (!strpos($lugar['HECHODESCR'], 'ARMA BLANCA') && !strpos($lugar['HECHODESCR'], 'ARMA DE FUEGO')) {
				array_push($lugares_sin, (object) $lugar);
			}

			if ($lugar['HECHODESCR'] == 'CASA HABITACION' || $lugar['HECHODESCR'] == 'DESPOBLADO' || $lugar['HECHODESCR'] == 'VIA PUBLICA' || $lugar['HECHODESCR'] == 'CENTRO ESCOLAR') {
				array_push($lugares_peticion, (object) $lugar);
			}
		}
		$data->lugares  = [];
		$data->lugares =  (object) array_merge($lugares_peticion, $lugares_sin, $lugares_blanca, $lugares_fuego);
		$lugares_merge = [];
		$lugares_merge =  array_merge($lugares_peticion, $lugares_sin);
		$data->lugares = (object)array_unique($lugares_merge, SORT_REGULAR);
		$data->colorVehiculo = $this->_coloresVehiculoModelRead->asObject()->findAll();
		$data->tipoVehiculo = $this->_tipoVehiculoModelRead->asObject()->orderBy('VEHICULOTIPODESCR', 'ASC')->findAll();
		$data->delitosUsuarios = $this->_delitosUsuariosModelRead->asObject()->orderBy('DELITO', 'ASC')->findAll();
		$data->escolaridades = $this->_escolaridadModelRead->asObject()->findAll();
		$data->ocupaciones = $this->_ocupacionModelRead->asObject()->findAll();
		$data->figura = $this->_figuraModelRead->asObject()->findAll();
		$data->cabelloColor = $this->_cabelloColorModelRead->asObject()->findAll();
		$data->cabelloTamano = $this->_cabelloTamanoModelRead->asObject()->findAll();
		$data->frenteForma = $this->_frenteFormaModelRead->asObject()->findAll();
		$data->ojoColor = $this->_ojoColorModelRead->asObject()->findAll();
		$data->cabelloEstilo = $this->_cabelloEstiloModelRead->asObject()->findAll();
		$data->cejaForma = $this->_cejaFormaModelRead->asObject()->findAll();
		$data->pielColor = $this->_pielColorModelRead->asObject()->findAll();
		$data->parentesco = $this->_parentescoModelRead->asObject()->findAll();
		// $data->distribuidorVehiculo = $this->_vehiculoDistribuidorModelRead->asObject()->findAll();
		// $data->marcaVehiculo = $this->_vehiculoMarcaModelRead->asObject()->findAll();
		// $data->lineaVehiculo = $this->_vehiculoModeloModelRead->asObject()->findAll();
		// $data->versionVehiculo = $this->_vehiculoVersionModelRead->asObject()->findAll();
		// $data->servicioVehiculo = $this->_vehiculoServicioModelRead->asObject()->findAll();
		$this->_loadViewDenunciaPersonaFisica('Persona física', 'persona física', '', $data, 'index');
	}
	/**
	 * Vista de Dashboard-Denuncia Persona Fisica
	 * Retorna los catálogos necesarios para iniciar la denuncia
	 */
	// public function denuncia_persona_moral()
	// {
	// 	$data = (object) array();
	// 	$data->paises = $this->_paisesModelRead->asObject()->findAll();
	// 	$data->estados = $this->_estadosModelRead->asObject()->findAll();
	// 	$data->estadosExtranjeros = $this->_estadosExtranjerosRead->asObject()->findAll();

	// 	$data->municipios = $this->_municipiosModelRead->asObject()->where('ESTADOID', '2')->findAll();
	// 	$data->nacionalidades = $this->_nacionalidadModelRead->asObject()->findAll();
	// 	$lugares = $this->_hechoLugarModelRead->orderBy('HECHODESCR', 'ASC')->findAll();

	// 	$lugares_sin = [];
	// 	$lugares_fuego = [];
	// 	$lugares_blanca = [];
	// 	$lugares_peticion = [];

	// 	foreach ($lugares as $lugar) {
	// 		if (strpos($lugar['HECHODESCR'], 'ARMA DE FUEGO')) {
	// 			array_push($lugares_fuego, (object) $lugar);
	// 		}
	// 		if (strpos($lugar['HECHODESCR'], 'ARMA BLANCA')) {
	// 			array_push($lugares_blanca, (object) $lugar);
	// 		}
	// 		if (!strpos($lugar['HECHODESCR'], 'ARMA BLANCA') && !strpos($lugar['HECHODESCR'], 'ARMA DE FUEGO')) {
	// 			array_push($lugares_sin, (object) $lugar);
	// 		}

	// 		if ($lugar['HECHODESCR'] == 'CASA HABITACION' || $lugar['HECHODESCR'] == 'DESPOBLADO' || $lugar['HECHODESCR'] == 'VIA PUBLICA' || $lugar['HECHODESCR'] == 'CENTRO ESCOLAR') {
	// 			array_push($lugares_peticion, (object) $lugar);
	// 		}
	// 	}
	// 	$data->lugares  = [];
	// 	$data->lugares =  (object) array_merge($lugares_peticion, $lugares_sin, $lugares_blanca, $lugares_fuego);
	// 	$lugares_merge = [];
	// 	$lugares_merge =  array_merge($lugares_peticion, $lugares_sin);
	// 	$data->lugares = (object)array_unique($lugares_merge, SORT_REGULAR);
	// 	$data->colorVehiculo = $this->_coloresVehiculoModelRead->asObject()->findAll();
	// 	$data->tipoVehiculo = $this->_tipoVehiculoModelRead->asObject()->orderBy('VEHICULOTIPODESCR', 'ASC')->findAll();
	// 	$data->delitosUsuarios = $this->_delitosUsuariosModelRead->asObject()->orderBy('DELITO', 'ASC')->findAll();
	// 	$data->escolaridades = $this->_escolaridadModelRead->asObject()->findAll();
	// 	$data->ocupaciones = $this->_ocupacionModelRead->asObject()->findAll();
	// 	$data->figura = $this->_figuraModelRead->asObject()->findAll();
	// 	$data->cabelloColor = $this->_cabelloColorModelRead->asObject()->findAll();
	// 	$data->cabelloTamano = $this->_cabelloTamanoModelRead->asObject()->findAll();
	// 	$data->frenteForma = $this->_frenteFormaModelRead->asObject()->findAll();
	// 	$data->ojoColor = $this->_ojoColorModelRead->asObject()->findAll();
	// 	$data->cabelloEstilo = $this->_cabelloEstiloModelRead->asObject()->findAll();
	// 	$data->cejaForma = $this->_cejaFormaModelRead->asObject()->findAll();
	// 	$data->pielColor = $this->_pielColorModelRead->asObject()->findAll();
	// 	$data->parentesco = $this->_parentescoModelRead->asObject()->findAll();
	// 	$data->empresas = $this->_relacionFisicaMoralModelRead->asObject()
	// 		->join('PERSONASMORALES', 'PERSONASMORALES.PERSONAMORALID = RELACIONFISICAMORAL.PERSONAMORALID')
	// 		->where('RELACIONFISICAMORAL.DENUNCIANTEID', session('DENUNCIANTEID'))
	// 		->findAll();
	// 	$data->giros = $this->_personaMoralGiroRead->asObject()->findAll();

	// 	// $data->empresas = $this->_personasMoralesRead->asObject()->findAll();


	// 	// $data->distribuidorVehiculo = $this->_vehiculoDistribuidorModelRead->asObject()->findAll();
	// 	// $data->marcaVehiculo = $this->_vehiculoMarcaModelRead->asObject()->findAll();
	// 	// $data->lineaVehiculo = $this->_vehiculoModeloModelRead->asObject()->findAll();
	// 	// $data->versionVehiculo = $this->_vehiculoVersionModelRead->asObject()->findAll();
	// 	// $data->servicioVehiculo = $this->_vehiculoServicioModelRead->asObject()->findAll();
	// 	// $this->_loadViewDenunciaPersonaMoral('Persona moral', 'persona moral', '', $data, 'index');
	// }
	/**
	 * Función para crear denuncias persona fisica
	 * Se recibe a través del metodo POST los datos del formulario
	 *
	 */
	public function create_denuncia_persona_fisica()
	{
		$session = session();
		//Valida los datos requeridos para hacer una denuncia
		if (($this->request->getPost('delito') == null || $this->request->getPost('delito') == '')
			|| ($this->request->getPost('lugar') == null || $this->request->getPost('lugar') == '')
			|| ($this->request->getPost('fecha') == null || $this->request->getPost('fecha') == '')
			|| ($this->request->getPost('hora') == null || $this->request->getPost('hora') == '')
			|| ($this->request->getPost('descripcion_breve') == null || $this->request->getPost('descripcion_breve') == '')
			|| ($this->request->getPost('nombre_ofendido') == null || $this->request->getPost('nombre_ofendido') == '')
		) {
			return redirect()->to(base_url('/denuncia_litigantes/dashboard'))->with('message_error', 'Hubo un error, no subas documentos e imagenes muy grandes, máximo 2MB por documento.');
		}
		//Datos a insertar en folio
		$dataFolio = [
			'DENUNCIANTEID' => $session->get('DENUNCIANTEID'),
			'HECHOFECHA' => $this->request->getPost('fecha') != '' ? $this->request->getPost('fecha') : NULL,
			'HECHOHORA' => $this->request->getPost('hora') != '' ? $this->request->getPost('hora') : NULL,
			'HECHOLUGARID' => $this->request->getPost('lugar'),
			'ESTADOID' => 2,
			'MUNICIPIOID' => $this->request->getPost('municipio'),
			'HECHOESTADOID' => 2,
			'HECHOMUNICIPIOID' => $this->request->getPost('municipio'),
			'HECHOLOCALIDADID' => $this->request->getPost('localidad'),
			'HECHOCOLONIAID' => $this->request->getPost('colonia_select'),
			'HECHOCOLONIADESCR' => $this->request->getPost('colonia') != '' ? $this->request->getPost('colonia') : NULL,
			'HECHOCALLE' => $this->request->getPost('calle') != '' ? $this->request->getPost('calle_moral') : NULL,
			'HECHONUMEROCASA' => $this->request->getPost('exterior') != '' ? $this->request->getPost('exterior') : NULL,
			'HECHONUMEROCASAINT' => $this->request->getPost('interior') != '' ? $this->request->getPost('interior') : NULL,
			'HECHONARRACION' => $this->request->getPost('descripcion_breve') != '' ? strtoupper($this->request->getPost('descripcion_breve')) : NULL,
			'HECHODELITO' => $this->request->getPost('delito'),
			'TIPODENUNCIA' => 'ES',
			'NOTIFICACIONES' => 'S',
			'STATUS' => 'PENDIENTE'
		];

		if ($this->request->getPost('check_ubi') == 'on') {
			$dataFolio['HECHOCOORDENADAX'] = $this->request->getPost('longitud');
			$dataFolio['HECHOCOORDENADAY'] = $this->request->getPost('latitud');
		}

		$colonia = $this->_coloniasModelRead->asObject()->where('ESTADOID', 2)->where('MUNICIPIOID', $this->request->getPost('municipio'))->where('LOCALIDADID', $this->request->getPost('localidad'))->where('COLONIAID', $this->request->getPost('colonia_select'))->first();

		if ($this->request->getPost('colonia_select')) {

			if ((int) $this->request->getPost('colonia_select') == 0) {
				$dataFolio['HECHOCOLONIAID'] = null;
				$dataFolio['HECHOCOLONIADESCR'] = $this->request->getPost('colonia');
				$localidad = $this->_localidadesModelRead->asObject()->where('ESTADOID', 2)->where('MUNICIPIOID', $dataFolio['HECHOMUNICIPIOID'])->where('LOCALIDADID', $dataFolio['HECHOLOCALIDADID'])->first();
				$dataFolio['HECHOZONA'] = $localidad->ZONA;
			} else {
				$dataFolio['HECHOCOLONIAID'] = (int) $this->request->getPost('colonia_select');
				$dataFolio['HECHOCOLONIADESCR'] = $colonia->COLONIADESCR;
				$dataFolio['HECHOZONA'] = $colonia->ZONA;
			}
		}
		if ($dataFolio['HECHODELITO'] == "PERSONA DESAPARECIDA") {
			$dataFolio['LOCALIZACIONPERSONA'] = 'S';
			$dataFolio['LOCALIZACIONPERSONAMEDIOS'] = $this->request->getPost('autorization_photo_des') == 'S';
		}
		// Se obtiene el consecutivo del folio
		list($FOLIOID, $year) = $this->_folioConsecutivoModel->get_consecutivo();
		$dataFolio['FOLIOID'] = $FOLIOID;
		$dataFolio['ANO'] = $year;

		//Se verifica que se inserte correctamente a la tabla
		if ($this->_folioModel->save($dataFolio)) {

			//DATOS DEL DENUNCIANTE
			$denunciante = $this->_denunciantesModelRead->asObject()->where('DENUNCIANTEID', session('DENUNCIANTEID'))->first();
			$fecha = (object) [
				'day' => date('d', strtotime($denunciante->FECHANACIMIENTO)),
				'month' => date('m', strtotime($denunciante->FECHANACIMIENTO)),
				'year' => date('Y', strtotime($denunciante->FECHANACIMIENTO)),
			];

			$hoy = (object) [
				'day' => date('d'),
				'month' => date('m'),
				'year' => date('Y'),
			];

			$edad = $hoy->year - $fecha->year;
			$m = $hoy->month - $fecha->month;

			if ($m < 0) {
				$edad--;
			} else if ($m == 0) {
				if ($hoy->day < (int) $fecha->day) {
					$edad--;
				}
			}
			$dataDenunciante = array(
				'NOMBRE' => $denunciante->NOMBRE,
				'PRIMERAPELLIDO' => $denunciante->APELLIDO_PATERNO,
				'SEGUNDOAPELLIDO' => $denunciante->APELLIDO_MATERNO,
				'FECHANACIMIENTO' => $denunciante->FECHANACIMIENTO,
				'EDADCANTIDAD' => $edad,
				'SEXO' => $denunciante->SEXO,
				'TELEFONO' => $denunciante->TELEFONO,
				'TELEFONO2' => $denunciante->TELEFONO2,
				'CODIGOPAISTEL' => $denunciante->CODIGO_PAIS,
				'CODIGOPAISTEL2' => $denunciante->CODIGO_PAIS2,
				'CORREO' => $denunciante->CORREO,
				'TIPOIDENTIFICACIONID' => $denunciante->TIPOIDENTIFICACIONID,
				'NUMEROIDENTIFICACION' => $denunciante->NUMEROIDENTIFICACION,
				'NACIONALIDADID' => $denunciante->NACIONALIDADID,
				'PERSONAIDIOMAID' => $denunciante->IDIOMAID,
				'ESCOLARIDADID' => $denunciante->ESCOLARIDADID,
				'OCUPACIONID' => $denunciante->OCUPACIONID,
				'OCUPACIONDESCR' => $denunciante->OCUPACIONDESCR,
				'ESTADOCIVILID' => $denunciante->ESTADOCIVILID,
				'ESTADOORIGENID' => $denunciante->ESTADOORIGENID,
				'MUNICIPIOORIGENID' => $denunciante->MUNICIPIOORIGENID,
				'FOTO' => $denunciante->DOCUMENTO,
				'DENUNCIANTE' => 'S',
				'FACEBOOK' => $denunciante->FACEBOOK,
				'PAIS' => $denunciante->PAIS,
				'INSTAGRAM' => $denunciante->INSTAGRAM,
				'TWITTER' => $denunciante->TWITTER,
				'LEER' => $denunciante->LEER,
				'ESCRIBIR' => $denunciante->ESCRIBIR,
				'DISCAPACIDADDESCR' => $denunciante->DISCAPACIDAD,
			);

			$dataDenuncianteDomicilio = array(
				'PAIS' => $denunciante->PAIS,
				'ESTADOID' => $denunciante->ESTADOID,
				'MUNICIPIOID' => $denunciante->MUNICIPIOID,
				'LOCALIDADID' => $denunciante->LOCALIDADID,
				'COLONIAID' => $denunciante->COLONIAID,
				'COLONIADESCR' => $denunciante->COLONIA,
				'CALLE' => $denunciante->CALLE,
				'NUMEROCASA' => $denunciante->NUM_EXT,
				'NUMEROINTERIOR' => $denunciante->NUM_INT,
				'CP' => $denunciante->CODIGOPOSTAL,
			);

			//Insercion de persona fisica, media filiacion y domicilio del denunciante
			$denuncinateIdPersona = $this->_folioPersonaFisica($dataDenunciante, $FOLIOID, 3, $year);
			$this->_folioPersonaFisicaMediaFiliacion($dataDenunciante, $FOLIOID, $denuncinateIdPersona, $year);
			$this->_folioPersonaFisicaDomicilio($dataDenuncianteDomicilio, $FOLIOID, $denuncinateIdPersona, $year);

			//CARTA PODER
			/*$carta_poder = $this->request->getFile('carta_poder');
			$carta_poder_data = null;
			if ($carta_poder->isValid()) {
				try {
					$carta_poder_data = file_get_contents($carta_poder);
				} catch (\Exception $e) {
					$carta_poder_data = null;
				}
			}
			$nombre = explode('.', $carta_poder->getName())[0];

			$dataArchivos = [
				'FOLIOID' => $FOLIOID,
				'ANO' => $year,
				'ARCHIVODESCR' => strtoupper($nombre),
				'ARCHIVO' => $carta_poder_data,
				'EXTENSION' => $carta_poder->getClientExtension(),
			];
			$archivoExterno = $this->_folioExpArchivo($dataArchivos, $FOLIOID, $year);*/

			//DATOS DESAPARECIDO
			if ($dataFolio['HECHODELITO'] == "PERSONA DESAPARECIDA") {

				$foto_des = $this->request->getFile('foto_des');
				$foto_data = null;
				if ($foto_des->isValid()) {
					try {
						$foto_data = file_get_contents($foto_des);
					} catch (\Exception $e) {
						$foto_data = null;
					}
				}

				$interior_des = $this->request->getPost('numero_int_des');
				if ($interior_des == '') {
					$interior_des = NULL;
				}
				$exterior_des = $this->request->getPost('numero_ext_des');
				if ($exterior_des == '') {
					$exterior_des = NULL;
				}

				$dataDesaparecido = array(
					'NOMBRE' => $this->request->getPost('nombre_des'),
					'PRIMERAPELLIDO' => $this->request->getPost('apellido_paterno_des'),
					'SEGUNDOAPELLIDO' => $this->request->getPost('apellido_materno_des'),
					'FECHANACIMIENTO' => $this->request->getPost('fecha_nacimiento_des'),
					'EDADCANTIDAD' => $this->request->getPost('edad_des'),
					'SEXO' => $this->request->getPost('sexo_des'),

					'NACIONALIDADID' => $this->request->getPost('nacionalidad_des'),
					'ESTADOORIGENID' => $this->request->getPost('estado_origen_des'),
					'MUNICIPIOORIGENID' => $this->request->getPost('municipio_origen_des'),

					'ESTATURA' => $this->request->getPost('estatura_des'),
					'PESO' => $this->request->getPost('peso_des'),
					'FIGURAID' => $this->request->getPost('complexion_des'),
					'PIELCOLORID' => $this->request->getPost('color_des'),
					'SENASPARTICULARES' => $this->request->getPost('señas_des'),
					'IDENTIDAD' => $this->request->getPost('identidad_des'),
					'CABELLOCOLORID' => $this->request->getPost('color_cabello_des'),
					'CABELLOTAMANOID' => $this->request->getPost('tam_cabello_des'),
					'CABELLOESTILOID' => $this->request->getPost('form_cabello_des'),
					'OJOCOLORID' => $this->request->getPost('color_ojos_des'),
					'FRENTEFORMAID' => $this->request->getPost('frente_des'),
					'CEJAFORMAID' => $this->request->getPost('forma_ceja_des'),
					'DISCAPACIDADDESCR' => $this->request->getPost('discapacidad_des'),
					'FECHADESAPARICION' => $this->request->getPost('dia_des'),
					'LUGARDESAPARICION' => $this->request->getPost('lugar_des'),
					'VESTIMENTADESCR' => $this->request->getPost('vestimenta_des'),
					'PARENTESCOID' => $this->request->getPost('parentesco_des'),
					'FACEBOOK' => $this->request->getPost('facebook_des'),
					'INSTAGRAM' => $this->request->getPost('instagram_des'),
					'TWITTER' => $this->request->getPost('twitter_des'),
					'FOTO' => $foto_data,
					'FOTOGRAFIA_ACTUAL' => $this->request->getPost('fotografia_actual'),
					'DESAPARECIDA' => 'S',
					'ESCOLARIDADID' => $this->request->getPost('escolaridad_des'),
					'OCUPACIONID' => $this->request->getPost('ocupacion_des'),
				);

				$dataDesaparecidoDomicilio = array(
					'PAIS' => $this->request->getPost('pais_des'),
					'ESTADOID' => $this->request->getPost('estado_des'),
					'MUNICIPIOID' => $this->request->getPost('municipio_des'),
					'LOCALIDADID' => $this->request->getPost('localidad_des'),
					'COLONIAID' => $this->request->getPost('colonia_des'),
					'COLONIADESCR' => $this->request->getPost('colonia_des_input'),
					'CALLE' => $this->request->getPost('calle_des'),
					'NUMEROCASA' => $this->request->getPost('checkML_des') == 'on'  && $exterior_des ?  'M.' . $exterior_des : $exterior_des,
					'NUMEROINTERIOR' => $this->request->getPost('checkML_des') == 'on' && $interior_des ?  'L.' . $interior_des : $exterior_des,
					'CP' => $this->request->getPost('cp_des'),
				);

				if ((int)$this->request->getPost('ocupacion_des') == 999) {
					$dataDesaparecido['OCUPACIONID'] = (int)$this->request->getPost('ocupacion_des');
					$dataDesaparecido['OCUPACIONDESCR'] = $this->request->getPost('ocupacion_descr_des');
				} else {
					$dataDesaparecido['OCUPACIONID'] = (int)$this->request->getPost('ocupacion_des');
					$dataDesaparecido['OCUPACIONDESCR'] = NULL;
				}

				//Insercion de persona, media filiacion y domicilio del desaparecido
				$desaparecido = $this->_folioPersonaFisica($dataDesaparecido, $FOLIOID, 1, $year);
				$this->_folioPersonaFisicaMediaFiliacion($dataDesaparecido, $FOLIOID, $desaparecido, $year);
				$this->_folioPersonaFisicaDomicilio($dataDesaparecidoDomicilio, $FOLIOID, $desaparecido, $year);
			}

			//DATOS DEL OFENDIDO- EMPRESA

			$dataOfendido = array(
				'NOMBRE' => $this->request->getPost('nombre_ofendido') && $this->request->getPost('nombre_ofendido') != "" ? $this->request->getPost('nombre_ofendido') : 'QUIEN RESULTE RESPONSABLE',
				'PRIMERAPELLIDO' => $this->request->getPost('primer_apellido_ofendido'),
				'SEGUNDOAPELLIDO' => $this->request->getPost('segundo_apellido_ofendido'),
				'FECHANACIMIENTO' => $this->request->getPost('fecha_nacimiento_ofendido'),
				'APODO' => $this->request->getPost('alias_ofendido'),
				'TELEFONO' => $this->request->getPost('tel_ofendido'),
				'DESCRIPCION_FISICA' => $this->request->getPost('description_fisica_ofendido'),
				'EDADCANTIDAD' => $this->request->getPost('edad_ofendido'),
				'SEXO' => $this->request->getPost('sexo_ofendido'),
				'FACEBOOK' => $this->request->getPost('facebook_ofendido'),
				'INSTAGRAM' => $this->request->getPost('instagram_ofendido'),
				'TWITTER' => $this->request->getPost('twitter_ofendido'),
				'PAIS' => $this->request->getPost('pais_ofendido'),
				'ESTADOORIGENID' => $this->request->getPost('estado_origen_ofendido'),
				'MUNICIPIOORIGENID' => $this->request->getPost('municipio_origen_ofendido'),
				'NACIONALIDADID' => $this->request->getPost('nacionalidad_ofendido'),
				'ESCOLARIDADID' => $this->request->getPost('escolaridad_ofendido'),
				'OCUPACIONID' => $this->request->getPost('ocupacion_ofendido'),
			);
			$interior_ofendido = $this->request->getPost('numero_int_ofendido');
			if ($interior_ofendido == '') {
				$interior_ofendido = NULL;
			}
			$exterior_ofendido = $this->request->getPost('numero_ext_ofendido');
			if ($exterior_ofendido == '') {
				$exterior_ofendido = NULL;
			}
			$dataOfendidoDomicilio = array(
				'PAIS' => $this->request->getPost('pais_ofendido'),
				'ESTADOID' => $this->request->getPost('estado_ofendido'),
				'MUNICIPIOID' => $this->request->getPost('municipio_ofendido'),
				'LOCALIDADID' => $this->request->getPost('localidad_ofendido'),
				'COLONIAID' => $this->request->getPost('colonia_ofendido'),
				'COLONIADESCR' => $this->request->getPost('colonia_ofendido_input'),
				'CALLE' => $this->request->getPost('calle_ofendido'),
				'NUMEROCASA' => $this->request->getPost('checkML_ofendido') == 'on'  && $exterior_ofendido ?  'M.' . $exterior_ofendido : $exterior_ofendido,
				'NUMEROINTERIOR' => $this->request->getPost('checkML_ofendido') == 'on' && $interior_ofendido ?  'L.' . $interior_ofendido : $interior_ofendido,
				'CP' => $this->request->getPost('cp_ofendido'),
			);
			if ((int)$this->request->getPost('ocupacion_ofendido') == 999) {
				$dataOfendido['OCUPACIONID'] =  (int)$this->request->getPost('ocupacion_ofendido');
				$dataOfendido['OCUPACIONDESCR'] = $this->request->getPost('ocupacion_descr_ofendido');
			} else {
				$dataOfendido['OCUPACIONID'] = (int)$this->request->getPost('ocupacion_ofendido');
				$dataOfendido['OCUPACIONDESCR'] = NULL;
			}

			//Insercion de persona fisica, media filiacion y domicilio del ofendido
			$ofendidoId = $this->_folioPersonaFisica($dataOfendido, $FOLIOID, 1, $year);
			$this->_folioPersonaFisicaMediaFiliacion($dataOfendido, $FOLIOID, $ofendidoId, $year);
			$this->_folioPersonaFisicaDomicilio($dataOfendidoDomicilio, $FOLIOID, $ofendidoId, $year);
			//DATOS DEL POSIBLE RESPONSABLE
			if (!empty($this->request->getPost('responsable')) && $this->request->getPost('responsable') == 'SI') {
				$dataImputado = array(
					'NOMBRE' => $this->request->getPost('nombre_imputado') && $this->request->getPost('nombre_imputado') != "" ? $this->request->getPost('nombre_imputado') : 'QUIEN RESULTE RESPONSABLE',
					'PRIMERAPELLIDO' => $this->request->getPost('primer_apellido_imputado'),
					'SEGUNDOAPELLIDO' => $this->request->getPost('segundo_apellido_imputado'),
					'FECHANACIMIENTO' => $this->request->getPost('fecha_nacimiento_imputado'),
					'APODO' => $this->request->getPost('alias_imputado'),
					'TELEFONO' => $this->request->getPost('tel_imputado'),
					'DESCRIPCION_FISICA' => $this->request->getPost('description_fisica_imputado'),
					'EDADCANTIDAD' => $this->request->getPost('edad_imputado'),
					'SEXO' => $this->request->getPost('sexo_imputado'),
					'FACEBOOK' => $this->request->getPost('facebook_imputado'),
					'INSTAGRAM' => $this->request->getPost('instagram_imputado'),
					'TWITTER' => $this->request->getPost('twitter_imputado'),
					'PAIS' => $this->request->getPost('pais_imputado'),
					'ESTADOORIGENID' => $this->request->getPost('estado_origen_imputado'),
					'MUNICIPIOORIGENID' => $this->request->getPost('municipio_origen_imputado'),
					'NACIONALIDADID' => $this->request->getPost('nacionalidad_imputado'),
					'ESCOLARIDADID' => $this->request->getPost('escolaridad_imputado'),
					'OCUPACIONID' => $this->request->getPost('ocupacion_imputado'),
				);
				$interior_imputado = $this->request->getPost('numero_int_imputado');
				if ($interior_imputado == '') {
					$interior_imputado = NULL;
				}
				$exterior_imputado = $this->request->getPost('numero_ext_imputado');
				if ($exterior_imputado == '') {
					$exterior_imputado = NULL;
				}
				$dataImputadoDomicilio = array(
					'PAIS' => $this->request->getPost('pais_imputado'),
					'ESTADOID' => $this->request->getPost('estado_imputado'),
					'MUNICIPIOID' => $this->request->getPost('municipio_imputado'),
					'LOCALIDADID' => $this->request->getPost('localidad_imputado'),
					'COLONIAID' => $this->request->getPost('colonia_imputado'),
					'COLONIADESCR' => $this->request->getPost('colonia_imputado_input'),
					'CALLE' => $this->request->getPost('calle_imputado'),
					'NUMEROCASA' => $this->request->getPost('checkML_imputado') == 'on'  && $exterior_imputado ?  'M.' . $exterior_imputado : $exterior_imputado,
					'NUMEROINTERIOR' => $this->request->getPost('checkML_imputado') == 'on' && $interior_imputado ?  'L.' . $interior_imputado : $interior_imputado,
					'CP' => $this->request->getPost('cp_imputado'),
				);
				if ((int)$this->request->getPost('ocupacion_imputado') == 999) {
					$dataImputado['OCUPACIONID'] =  (int)$this->request->getPost('ocupacion_imputado');
					$dataImputado['OCUPACIONDESCR'] = $this->request->getPost('ocupacion_descr_imputado');
				} else {
					$dataImputado['OCUPACIONID'] = (int)$this->request->getPost('ocupacion_imputado');
					$dataImputado['OCUPACIONDESCR'] = NULL;
				}
				//Insercion de persona fisica, media filiacion y domicilio del imputado cuando es conocido

				$imputadoId = $this->_folioPersonaFisica($dataImputado, $FOLIOID, 2, $year);
				$this->_folioPersonaFisicaMediaFiliacion($dataImputado, $FOLIOID, $imputadoId, $year);
				$this->_folioPersonaFisicaDomicilio($dataImputadoDomicilio, $FOLIOID, $imputadoId, $year);
			} else {

				//Datos del imputado sin conocer
				$dataImputado = array(
					'NOMBRE' => 'QUIEN RESULTE RESPONSABLE',
					'FECHANACIMIENTO' => null,
				);

				$dataImputadoDomicilio = array(
					'PAIS' => null,
					'ESTADOID' => null,
					'MUNICIPIOID' => null,
					'LOCALIDADID' => null,
					'COLONIAID' => null,
					'COLONIADESCR' => null,
					'CALLE' => null,
					'NUMEROCASA' => null,
					'NUMEROINTERIOR' => null,
					'CP' => null,
				);
				//Insercion de persona fisica, media filiacion y domicilio del imputado

				$imputadoId = $this->_folioPersonaFisica($dataImputado, $FOLIOID, 2, $year);
				$this->_folioPersonaFisicaMediaFiliacion($dataImputado, $FOLIOID, $imputadoId, $year);
				$this->_folioPersonaFisicaDomicilio($dataImputadoDomicilio, $FOLIOID, $imputadoId, $year);
			}
			//Datos del vehiculo
			if ($this->request->getPost('delito') == "ROBO DE VEHÍCULO") {
				if ($_FILES['foto_vehiculo_nc']['name'] != null) {
					$img_file = $this->request->getFile('foto_vehiculo_nc');
				} else {
					$img_file = $this->request->getFile('foto_vehiculo_sp');
				}
				$fotoV = null;
				//Verifica que sea valido el documento
				if ($img_file->isValid()) {
					try {
						$fotoV = file_get_contents($img_file);
					} catch (\Exception $e) {
						$fotoV = null;
					}
				}
				if ($_FILES['documento_vehiculo_nc']['name'] != null) {
					$document_file = $this->request->getFile('documento_vehiculo_nc');
				} else {
					$document_file = $this->request->getFile('documento_vehiculo_sp');
				}
				$docV = null;
				if ($document_file->isValid()) {
					try {
						$docV = file_get_contents($document_file);
					} catch (\Exception $e) {
						$docV = null;
					}
				}

				$dataVehiculo = array(
					'TIPOID' => $this->request->getPost('tipo_vehiculo'),
					'PRIMERCOLORID' => $this->request->getPost('color_vehiculo'),
					'TIPOPLACA' => $this->request->getPost('tipo_placas_vehiculo'),
					'PLACAS' => $this->request->getPost('placas_vehiculo'),
					'NUMEROSERIE' => $this->request->getPost('serie_vehiculo'),
					'SENASPARTICULARES' => $this->request->getPost('description_vehiculo') ? $this->request->getPost('description_vehiculo') : $this->request->getPost('description_vehiculo_sp'),
					'FOTO' => $fotoV,
					'DOCUMENTO' => $docV,
					'SITUACION' => 2,
				);
				//Insercion del vehiculo
				$this->_folioVehiculo($dataVehiculo, $FOLIOID, $year);
			}
			if ($this->_sendEmailFolio($session->get('CORREO'), $FOLIOID, $year)) {
				$url = "/denuncia_litigantes/dashboard/subir_documentos_folio?folio=" . $FOLIOID . "&year=" . $year;
				return redirect()->to(base_url($url))->with('message_success', 'Por favor, sube la denuncia escrita.');
			} else {
				return redirect()->back()->with('message_error', 'Hubo un error en los datos y no se guardo, intentalo de nuevo.');
			}
		} else {
			return redirect()->to(base_url('/denuncia_litigantes/dashboard'))->with('message_error', 'Hubo un error, llena todo correctamente y no subas documentos e imagenes muy grandes.');
		}
	}
	/**
	 * Función para crear denuncias persona moral
	 * Se recibe a través del metodo POST los datos del formulario
	 *
	 */
	public function create_denuncia_persona_moral()
	{
		$session = session();
		//Valida los datos requeridos para hacer una denuncia
		if (($this->request->getPost('delito_moral') == null || $this->request->getPost('delito_moral') == '')
			|| ($this->request->getPost('rfc_empresa') == null || $this->request->getPost('rfc_empresa') == '')
			|| ($this->request->getPost('lugar_moral') == null || $this->request->getPost('lugar_moral') == '')
			|| ($this->request->getPost('fecha_moral') == null || $this->request->getPost('fecha_moral') == '')
			|| ($this->request->getPost('hora_moral') == null || $this->request->getPost('hora_moral') == '')
			|| ($this->request->getPost('descripcion_breve_moral') == null || $this->request->getPost('descripcion_breve_moral') == '')

		) {
			return redirect()->to(base_url('/denuncia_litigantes/dashboard'))->with('message_error', 'Hubo un error, no subas documentos e imagenes muy grandes, máximo 2MB por documento.');
		}

		$rfc = $this->request->getPost('rfc_empresa');
		$personamoralidExist = $this->_personasMoralesRead->select('PERSONAMORALID')->where('RFC', $rfc)->first();
		$poder_archivo = $this->request->getFile('poder_archivo');
		$poder_data = null;
		if ($this->request->getFile('poder_archivo') != null && $poder_archivo->isValid()) {
			try {
				$nombre = explode('.', $poder_archivo->getName())[0];
				$poder_data = file_get_contents($poder_archivo);
			} catch (\Exception $e) {
				$poder_data = null;
			}
		}

		if ($this->request->getFile('poder_archivo') != null && $_FILES['poder_archivo']['name'] != null) {
			$poder_data = file_get_contents($poder_archivo);
		}
		//Datos del formulario nueva empresa
		$dataMoral = [
			'RAZONSOCIAL' => $this->request->getPost('razon_social'),
			'MARCACOMERCIAL' => $this->request->getPost('marca_comercial_d') != "" ? $this->request->getPost('marca_comercial_d') : NULL,
			'RFC' => $this->request->getPost('rfc_empresa'),
			'PERSONAMORALGIROID' => $this->request->getPost('giro_empresa_denuncia'),
			'ESTADOID' => $this->request->getPost('estado_empresa_c'),
			'MUNICIPIOID' => $this->request->getPost('municipio_empresa_c'),
			'LOCALIDADID' => $this->request->getPost('localidad_empresa_c'),
			'COLONIAID' => $this->request->getPost('colonia_select_empresa_c'),
			'COLONIADESCR' => $this->request->getPost('colonia_input_empresa_c'),
			'CALLE' => $this->request->getPost('calle_empresa_c'),
			'NUMERO' => $this->request->getPost('n_empresa_c'),
			'NUMEROINTERIOR' => $this->request->getPost('ninterior_empresa_c') != "" ? $this->request->getPost('ninterior_empresa_c') : NULL,
			'REFERENCIA' => $this->request->getPost('referencia_empresa_c')  != "" ? $this->request->getPost('referencia_empresa_c') : NULL,
			'TELEFONO' => $this->request->getPost('telefono_empresa_c'),
			'CORREO' => $this->request->getPost('correo_empresa_c'),
		];
		$colonia = $this->_coloniasModelRead->asObject()->where('ESTADOID', $this->request->getPost('estado_empresa_c'))->where('MUNICIPIOID', $this->request->getPost('municipio_empresa_c'))->where('LOCALIDADID', $this->request->getPost('localidad_empresa_c'))->where('COLONIAID', $this->request->getPost('colonia_select_empresa_c'))->first();

		if ($dataMoral['COLONIAID'] == '0' || $dataMoral['COLONIAID'] == null) {
			$dataMoral['COLONIAID'] = null;
			$dataMoral['COLONIADESCR'] = $this->request->getPost('colonia_input_empresa_c');
			$localidad = $this->_localidadesModelRead->asObject()->where('ESTADOID', $this->request->getPost('estado_empresa_c'))->where('MUNICIPIOID', $this->request->getPost('municipio_empresa_c'))->where('LOCALIDADID', $this->request->getPost('localidad_empresa_c'))->first();
			$dataMoral['ZONA'] = $localidad->ZONA;
		} else {
			$dataMoral['COLONIAID'] = (int) $this->request->getPost('colonia_select_empresa_c');
			$dataMoral['COLONIADESCR'] = $colonia->COLONIADESCR;
			$dataMoral['ZONA'] = $colonia->ZONA;
		}
		if (!$personamoralidExist) {
			$this->_personasMoralesModel->save($dataMoral);
			$dataNotificacion = [
				'PERSONAMORALID' =>  $this->_personasMoralesModel->getInsertID(),
				'ESTADOID' => $this->request->getPost('estado_empresa'),
				'MUNICIPIOID' => $this->request->getPost('municipio_empresa'),
				'LOCALIDADID' => $this->request->getPost('localidad_empresa'),
				'COLONIAID' => $this->request->getPost('colonia_select_empresa'),
				'COLONIADESCR' => $this->request->getPost('colonia_input_empresa'),
				'CALLE' => $this->request->getPost('calle_empresa'),
				'NUMERO' => $this->request->getPost('n_empresa'),
				'NUMEROINTERIOR' => $this->request->getPost('ninterior_empresa') != "" ? $this->request->getPost('ninterior_empresa') : NULL,
				'REFERENCIA' => $this->request->getPost('referencia_empresa')  != "" ? $this->request->getPost('referencia_empresa') : NULL,
				'TELEFONO' => $this->request->getPost('telefono_empresa'),
				'CORREO' => $this->request->getPost('correo_empresa'),
			];
			$colonia = $this->_coloniasModelRead->asObject()->where('ESTADOID', $this->request->getPost('estado_empresa'))->where('MUNICIPIOID', $this->request->getPost('municipio_empresa'))->where('LOCALIDADID', $this->request->getPost('localidad_empresa'))->where('COLONIAID', $this->request->getPost('colonia_select_empresa'))->first();

			if ($dataNotificacion['COLONIAID'] == '0' || $dataNotificacion['COLONIAID'] == null) {
				$dataNotificacion['COLONIAID'] = null;
				$dataNotificacion['COLONIADESCR'] = $this->request->getPost('colonia_input_empresa');
				$localidad = $this->_localidadesModelRead->asObject()->where('ESTADOID', $this->request->getPost('estado_empresa'))->where('MUNICIPIOID', $this->request->getPost('municipio_empresa'))->where('LOCALIDADID', $this->request->getPost('localidad_empresa'))->first();
				$dataNotificacion['ZONA'] = $localidad->ZONA;
			} else {
				$dataNotificacion['COLONIAID'] = (int) $this->request->getPost('colonia_select_empresa');
				$dataNotificacion['COLONIADESCR'] = $colonia->COLONIADESCR;
				$dataNotificacion['ZONA'] = $colonia->ZONA;
			}

			$this->_personasMoralesNotificacionesModel->save($dataNotificacion);

			$dataPoder = [
				'PERSONAMORALID' => $this->_personasMoralesModel->getInsertID(),
				'ACTIVO' => 1,
				'NOMBREARCHIVO' => strtoupper($nombre),
				'PODERVOLUMEN' => $this->request->getPost('poder_volumen') != "" ? $this->request->getPost('poder_volumen') : NULL,
				'PODERNONOTARIO' => $this->request->getPost('poder_notario') != "" ? $this->request->getPost('poder_notario') : NULL,
				'PODERNOPODER' => $this->request->getPost('poder_no_poder') != "" ? $this->request->getPost('poder_no_poder') : NULL,
				'PODERARCHIVO' => $poder_data,
				'FECHAINICIOPODER' => $this->request->getPost('fecha_inicio_poder') != "" ? $this->request->getPost('fecha_inicio_poder') : NULL,
				'FECHAFINPODER' => $this->request->getPost('fecha_fin_poder') != "" ? $this->request->getPost('fecha_fin_poder') : NULL,
				'CARGO' => $this->request->getPost('cargo'),
				'DESCRIPCIONCARGO' => $this->request->getPost('descr_cargo') != "" ? $this->request->getPost('descr_cargo') : NULL,	
			];

			$this->_relacionPoderLitigantes->save($dataPoder);
		}
		//  else {
		// 	if (!$this->request->getPost('direccion')) {
		// 		$dataMoral['PERSONAMORALID'] = $personamoralidExist;
		// 		$this->_personasMoralesNotificacionesModel->save($dataMoral);
		// 	}

		// }
		$personamoralid = !$personamoralidExist ? $this->_personasMoralesModel->getInsertID() : $personamoralidExist;
		$notificacionid = !$this->request->getPost('direccion') ? $this->_personasMoralesNotificacionesModel->getInsertID() : $this->request->getPost('direccion');
		if ($personamoralid) {
			$poder_existente = $this->_relacionMoralPoderRead->asObject()->where('ACTIVO', 1)->where('PERSONAMORALID', $personamoralid)->first();
			$file_info = new \finfo(FILEINFO_MIME_TYPE);
			$type = $file_info->buffer($poder_existente->PODERARCHIVO);
			$extension = strstr($type, '/');
			$extension = ltrim($extension, '/');
		}


		//Info para la tabla de archivos externos
		$data = [
			'FOLIOID' => $this->request->getPost('folio'),
			'ANO' => $this->request->getPost('year'),
			'ARCHIVODESCR' =>  isset($nombre) ? strtoupper($nombre) : $poder_existente->NOMBREARCHIVO,
			'ARCHIVO' => $poder_data ? $poder_data : $poder_existente->PODERARCHIVO,
			'EXTENSION' => $poder_archivo ? $poder_archivo->getClientExtension() : $extension,
			'TIPO'=> 'PODER'
		];

		$relacionPoder = $this->_relacionMoralPoderRead->asObject()->select('PODERID,PERSONAMORALID, PODERVOLUMEN,PODERNONOTARIO,PODERNOPODER')->where('PERSONAMORALID', $personamoralid)->where('ACTIVO', 1)->first();
		$poderid = !$relacionPoder ? $this->_relacionPoderLitigantes->getInsertID() : $relacionPoder->PODERID;

		$updatePersonaMoral = $this->_personasMoralesModel->set('PODERID', $poderid)->update();


		//Datos a insertar en folio
		$dataFolio = [
			'DENUNCIANTEID' => $session->get('DENUNCIANTEID'),
			'HECHOFECHA' => $this->request->getPost('fecha_moral') != '' ? $this->request->getPost('fecha_moral') : NULL,
			'HECHOHORA' => $this->request->getPost('hora_moral') != '' ? $this->request->getPost('hora_moral') : NULL,
			'HECHOLUGARID' => $this->request->getPost('lugar_moral'),
			'ESTADOID' => 2,
			'MUNICIPIOID' => $this->request->getPost('municipio_moral'),
			'HECHOESTADOID' => 2,
			'HECHOMUNICIPIOID' => $this->request->getPost('municipio_moral'),
			'HECHOLOCALIDADID' => $this->request->getPost('localidad_moral'),
			'HECHOCOLONIAID' => $this->request->getPost('colonia_select_moral'),
			'HECHOCOLONIADESCR' => $this->request->getPost('colonia_moral') != '' ? $this->request->getPost('colonia_moral') : NULL,
			'HECHOCALLE' => $this->request->getPost('calle_moral') != '' ? $this->request->getPost('calle_moral') : NULL,
			'HECHONUMEROCASA' => $this->request->getPost('exterior_moral') != '' ? $this->request->getPost('exterior_moral') : NULL,
			'HECHONUMEROCASAINT' => $this->request->getPost('interior_moral') != '' ? $this->request->getPost('interior_moral') : NULL,
			'HECHONARRACION' => $this->request->getPost('descripcion_breve_moral') != '' ? strtoupper($this->request->getPost('descripcion_breve_moral')) : NULL,
			'HECHODELITO' => $this->request->getPost('delito_moral'),
			'TIPODENUNCIA' => 'ES',
			'NOTIFICACIONES' => 'S',
			'STATUS' => 'PENDIENTE'

		];

		if ($this->request->getPost('check_ubi_moral') == 'on') {
			$dataFolio['HECHOCOORDENADAX'] = $this->request->getPost('longitud_moral');
			$dataFolio['HECHOCOORDENADAY'] = $this->request->getPost('latitud_moral');
		}

		$colonia = $this->_coloniasModelRead->asObject()->where('ESTADOID', 2)->where('MUNICIPIOID', $this->request->getPost('municipio_moral'))->where('LOCALIDADID', $this->request->getPost('localidad_moral'))->where('COLONIAID', $this->request->getPost('colonia_select_moral'))->first();

		if ($this->request->getPost('colonia_select_moral')) {

			if ((int) $this->request->getPost('colonia_select_moral') == 0) {
				$dataFolio['HECHOCOLONIAID'] = null;
				$dataFolio['HECHOCOLONIADESCR'] = $this->request->getPost('colonia_moral');
				$localidad = $this->_localidadesModelRead->asObject()->where('ESTADOID', 2)->where('MUNICIPIOID', $dataFolio['HECHOMUNICIPIOID'])->where('LOCALIDADID', $dataFolio['HECHOLOCALIDADID'])->first();
				$dataFolio['HECHOZONA'] = $localidad->ZONA;
			} else {
				$dataFolio['HECHOCOLONIAID'] = (int) $this->request->getPost('colonia_select_moral');
				$dataFolio['HECHOCOLONIADESCR'] = $colonia->COLONIADESCR;
				$dataFolio['HECHOZONA'] = $colonia->ZONA;
			}
		}
		if ($dataFolio['HECHODELITO'] == "PERSONA DESAPARECIDA") {
			$dataFolio['LOCALIZACIONPERSONA'] = 'S';
			$dataFolio['LOCALIZACIONPERSONAMEDIOS'] = $this->request->getPost('autorization_photo_des') == 'S';
		}
		// Se obtiene el consecutivo del folio
		list($FOLIOID, $year) = $this->_folioConsecutivoModel->get_consecutivo();
		$dataFolio['FOLIOID'] = $FOLIOID;
		$dataFolio['ANO'] = $year;

		//Se verifica que se inserte correctamente a la tabla
		if ($this->_folioModel->save($dataFolio)) {
			$archivoExterno = $this->_folioExpArchivo($data, $FOLIOID, $year);


			//DATOS DEL DENUNCIANTE
			$denunciante = $this->_denunciantesModelRead->asObject()->where('DENUNCIANTEID', session('DENUNCIANTEID'))->first();
			$fecha = (object) [
				'day' => date('d', strtotime($denunciante->FECHANACIMIENTO)),
				'month' => date('m', strtotime($denunciante->FECHANACIMIENTO)),
				'year' => date('Y', strtotime($denunciante->FECHANACIMIENTO)),
			];

			$hoy = (object) [
				'day' => date('d'),
				'month' => date('m'),
				'year' => date('Y'),
			];

			$edad = $hoy->year - $fecha->year;
			$m = $hoy->month - $fecha->month;

			if ($m < 0) {
				$edad--;
			} else if ($m == 0) {
				if ($hoy->day < (int) $fecha->day) {
					$edad--;
				}
			}
			$dataDenunciante = array(
				'NOMBRE' => $denunciante->NOMBRE,
				'PRIMERAPELLIDO' => $denunciante->APELLIDO_PATERNO,
				'SEGUNDOAPELLIDO' => $denunciante->APELLIDO_MATERNO,
				'FECHANACIMIENTO' => $denunciante->FECHANACIMIENTO,
				'EDADCANTIDAD' => $edad,
				'SEXO' => $denunciante->SEXO,
				'TELEFONO' => $denunciante->TELEFONO,
				'TELEFONO2' => $denunciante->TELEFONO2,
				'CODIGOPAISTEL' => $denunciante->CODIGO_PAIS,
				'CODIGOPAISTEL2' => $denunciante->CODIGO_PAIS2,
				'CORREO' => $denunciante->CORREO,
				'TIPOIDENTIFICACIONID' => $denunciante->TIPOIDENTIFICACIONID,
				'NUMEROIDENTIFICACION' => $denunciante->NUMEROIDENTIFICACION,
				'NACIONALIDADID' => $denunciante->NACIONALIDADID,
				'PERSONAIDIOMAID' => $denunciante->IDIOMAID,
				'ESCOLARIDADID' => $denunciante->ESCOLARIDADID,
				'OCUPACIONID' => $denunciante->OCUPACIONID,
				'OCUPACIONDESCR' => $denunciante->OCUPACIONDESCR,
				'ESTADOCIVILID' => $denunciante->ESTADOCIVILID,
				'ESTADOORIGENID' => $denunciante->ESTADOORIGENID,
				'MUNICIPIOORIGENID' => $denunciante->MUNICIPIOORIGENID,
				'FOTO' => $denunciante->DOCUMENTO,
				'DENUNCIANTE' => 'S',
				'FACEBOOK' => $denunciante->FACEBOOK,
				'PAIS' => $denunciante->PAIS,
				'INSTAGRAM' => $denunciante->INSTAGRAM,
				'TWITTER' => $denunciante->TWITTER,
				'LEER' => $denunciante->LEER,
				'ESCRIBIR' => $denunciante->ESCRIBIR,
				'DISCAPACIDADDESCR' => $denunciante->DISCAPACIDAD,
			);

			$dataDenuncianteDomicilio = array(
				'PAIS' => $denunciante->PAIS,
				'ESTADOID' => $denunciante->ESTADOID,
				'MUNICIPIOID' => $denunciante->MUNICIPIOID,
				'LOCALIDADID' => $denunciante->LOCALIDADID,
				'COLONIAID' => $denunciante->COLONIAID,
				'COLONIADESCR' => $denunciante->COLONIA,
				'CALLE' => $denunciante->CALLE,
				'NUMEROCASA' => $denunciante->NUM_EXT,
				'NUMEROINTERIOR' => $denunciante->NUM_INT,
				'CP' => $denunciante->CODIGOPOSTAL,
			);

			//Insercion de persona fisica, media filiacion y domicilio del denunciante
			$denuncinateIdPersona = $this->_folioPersonaFisica($dataDenunciante, $FOLIOID, 3, $year);
			$this->_folioPersonaFisicaMediaFiliacion($dataDenunciante, $FOLIOID, $denuncinateIdPersona, $year);
			$this->_folioPersonaFisicaDomicilio($dataDenuncianteDomicilio, $FOLIOID, $denuncinateIdPersona, $year);

			//CARTA PODER
			// $carta_poder = $this->request->getFile('carta_poder_moral');
			// $carta_poder_data = null;
			// if ($carta_poder->isValid()) {
			// 	try {
			// 		$carta_poder_data = file_get_contents($carta_poder);
			// 	} catch (\Exception $e) {
			// 		$carta_poder_data = null;
			// 	}
			// }
			// $nombre = explode('.', $carta_poder->getName())[0];

			// $dataArchivos = [
			// 	'FOLIOID' => $FOLIOID,
			// 	'ANO' => $year,
			// 	'ARCHIVODESCR' => strtoupper($nombre),
			// 	'ARCHIVO' => $carta_poder_data,
			// 	'EXTENSION' => $carta_poder->getClientExtension(),
			// ];
			// $archivoExterno = $this->_folioExpArchivo($dataArchivos, $FOLIOID, $year);

			//DATOS DESAPARECIDO
			if ($dataFolio['HECHODELITO'] == "PERSONA DESAPARECIDA") {

				$foto_des = $this->request->getFile('foto_des');
				$foto_data = null;
				if ($foto_des->isValid()) {
					try {
						$foto_data = file_get_contents($foto_des);
					} catch (\Exception $e) {
						$foto_data = null;
					}
				}

				$interior_des = $this->request->getPost('numero_int_des');
				if ($interior_des == '') {
					$interior_des = NULL;
				}
				$exterior_des = $this->request->getPost('numero_ext_des');
				if ($exterior_des == '') {
					$exterior_des = NULL;
				}

				$dataDesaparecido = array(
					'NOMBRE' => $this->request->getPost('nombre_des'),
					'PRIMERAPELLIDO' => $this->request->getPost('apellido_paterno_des'),
					'SEGUNDOAPELLIDO' => $this->request->getPost('apellido_materno_des'),
					'FECHANACIMIENTO' => $this->request->getPost('fecha_nacimiento_des'),
					'EDADCANTIDAD' => $this->request->getPost('edad_des'),
					'SEXO' => $this->request->getPost('sexo_des'),

					'NACIONALIDADID' => $this->request->getPost('nacionalidad_des'),
					'ESTADOORIGENID' => $this->request->getPost('estado_origen_des'),
					'MUNICIPIOORIGENID' => $this->request->getPost('municipio_origen_des'),

					'ESTATURA' => $this->request->getPost('estatura_des'),
					'PESO' => $this->request->getPost('peso_des'),
					'FIGURAID' => $this->request->getPost('complexion_des'),
					'PIELCOLORID' => $this->request->getPost('color_des'),
					'SENASPARTICULARES' => $this->request->getPost('señas_des'),
					'IDENTIDAD' => $this->request->getPost('identidad_des'),
					'CABELLOCOLORID' => $this->request->getPost('color_cabello_des'),
					'CABELLOTAMANOID' => $this->request->getPost('tam_cabello_des'),
					'CABELLOESTILOID' => $this->request->getPost('form_cabello_des'),
					'OJOCOLORID' => $this->request->getPost('color_ojos_des'),
					'FRENTEFORMAID' => $this->request->getPost('frente_des'),
					'CEJAFORMAID' => $this->request->getPost('forma_ceja_des'),
					'DISCAPACIDADDESCR' => $this->request->getPost('discapacidad_des'),
					'FECHADESAPARICION' => $this->request->getPost('dia_des'),
					'LUGARDESAPARICION' => $this->request->getPost('lugar_des'),
					'VESTIMENTADESCR' => $this->request->getPost('vestimenta_des'),
					'PARENTESCOID' => $this->request->getPost('parentesco_des'),
					'FACEBOOK' => $this->request->getPost('facebook_des'),
					'INSTAGRAM' => $this->request->getPost('instagram_des'),
					'TWITTER' => $this->request->getPost('twitter_des'),
					'FOTO' => $foto_data,
					'FOTOGRAFIA_ACTUAL' => $this->request->getPost('fotografia_actual'),
					'DESAPARECIDA' => 'S',
					'ESCOLARIDADID' => $this->request->getPost('escolaridad_des'),
					'OCUPACIONID' => $this->request->getPost('ocupacion_des'),
				);

				$dataDesaparecidoDomicilio = array(
					'PAIS' => $this->request->getPost('pais_des'),
					'ESTADOID' => $this->request->getPost('estado_des'),
					'MUNICIPIOID' => $this->request->getPost('municipio_des'),
					'LOCALIDADID' => $this->request->getPost('localidad_des'),
					'COLONIAID' => $this->request->getPost('colonia_des'),
					'COLONIADESCR' => $this->request->getPost('colonia_des_input'),
					'CALLE' => $this->request->getPost('calle_des'),
					'NUMEROCASA' => $this->request->getPost('checkML_des') == 'on'  && $exterior_des ?  'M.' . $exterior_des : $exterior_des,
					'NUMEROINTERIOR' => $this->request->getPost('checkML_des') == 'on' && $interior_des ?  'L.' . $interior_des : $exterior_des,
					'CP' => $this->request->getPost('cp_des'),
				);

				if ((int)$this->request->getPost('ocupacion_des') == 999) {
					$dataDesaparecido['OCUPACIONID'] = (int)$this->request->getPost('ocupacion_des');
					$dataDesaparecido['OCUPACIONDESCR'] = $this->request->getPost('ocupacion_descr_des');
				} else {
					$dataDesaparecido['OCUPACIONID'] = (int)$this->request->getPost('ocupacion_des');
					$dataDesaparecido['OCUPACIONDESCR'] = NULL;
				}

				//Insercion de persona, media filiacion y domicilio del desaparecido
				$desaparecido = $this->_folioPersonaFisica($dataDesaparecido, $FOLIOID, 1, $year);
				$this->_folioPersonaFisicaMediaFiliacion($dataDesaparecido, $FOLIOID, $desaparecido, $year);
				$this->_folioPersonaFisicaDomicilio($dataDesaparecidoDomicilio, $FOLIOID, $desaparecido, $year);
			}

			//DATOS DEL OFENDIDO- EMPRESA


			$dataOfendido = array(
				'PERSONAMORALID' => $personamoralid,
				'NOTIFICACIONID' => $notificacionid,
				'DENOMINACION' => $this->request->getPost('razon_social'),
				'MARCACOMERCIAL' => $this->request->getPost('marca_comercial_d'),
				'PERSONAMORALGIROID' => $this->request->getPost('giro_empresa_denuncia'),
				'ESTADOID' => $this->request->getPost('estado_empresa_c'),
				'MUNICIPIOID' => $this->request->getPost('municipio_empresa_c'),
				'LOCALIDADID' => $this->request->getPost('localidad_empresa_c'),
				'COLONIAID' => $this->request->getPost('colonia_select_empresa_c'),
				'COLONIADESCR' => $this->request->getPost('colonia_input_empresa_c'),
				'CALLE' => $this->request->getPost('calle_empresa_c'),
				'NUMERO' => $this->request->getPost('n_empresa_c'),
				'NUMEROINTERIOR' => $this->request->getPost('ninterior_empresa_c'),
				'REFERENCIA' => $this->request->getPost('referencia_empresa_c'),
				'TELEFONO' => $this->request->getPost('telefono_empresa_c'),
				'CORREO' => $this->request->getPost('correo_empresa_c'),
				'PODERID' => $poderid,
			);

			$colonia = $this->_coloniasModelRead->asObject()->where('ESTADOID', $this->request->getPost('estado_empresa_c'))->where('MUNICIPIOID', $this->request->getPost('municipio_empresa_c'))->where('LOCALIDADID', $this->request->getPost('localidad_empresa_c'))->where('COLONIAID', $this->request->getPost('colonia_select_empresa_c'))->first();

			if ($dataOfendido['COLONIAID'] == '0' || $dataOfendido['COLONIAID'] == null) {
				$dataOfendido['COLONIAID'] = null;
				$dataOfendido['COLONIADESCR'] = $this->request->getPost('colonia_input_empresa_c');
				$localidad = $this->_localidadesModelRead->asObject()->where('ESTADOID', $this->request->getPost('estado_empresa_c'))->where('MUNICIPIOID', $this->request->getPost('municipio_empresa_c'))->where('LOCALIDADID', $this->request->getPost('localidad_empresa_c'))->first();
				$dataOfendido['ZONA'] = $localidad->ZONA;
			} else {
				$dataOfendido['COLONIAID'] = (int) $this->request->getPost('colonia_select_empresa_c');
				$dataOfendido['COLONIADESCR'] = $colonia->COLONIADESCR;
				$dataOfendido['ZONA'] = $colonia->ZONA;
			}
			//Insercion de persona fisica, media filiacion y domicilio del ofendido
			$ofendidoId = $this->_folioPersonaMorales($dataOfendido, $FOLIOID, 1, $year);
			//DATOS DEL POSIBLE RESPONSABLE
			if (!empty($this->request->getPost('responsable_moral')) && $this->request->getPost('responsable_moral') == 'SI') {
				$dataImputado = array(
					'NOMBRE' => $this->request->getPost('nombre_imputado') && $this->request->getPost('nombre_imputado') != "" ? $this->request->getPost('nombre_imputado') : 'QUIEN RESULTE RESPONSABLE',
					'PRIMERAPELLIDO' => $this->request->getPost('primer_apellido_imputado'),
					'SEGUNDOAPELLIDO' => $this->request->getPost('segundo_apellido_imputado'),
					'FECHANACIMIENTO' => $this->request->getPost('fecha_nacimiento_imputado'),
					'APODO' => $this->request->getPost('alias_imputado'),
					'TELEFONO' => $this->request->getPost('tel_imputado'),
					'DESCRIPCION_FISICA' => $this->request->getPost('description_fisica_imputado'),
					'EDADCANTIDAD' => $this->request->getPost('edad_imputado'),
					'SEXO' => $this->request->getPost('sexo_imputado'),
					'FACEBOOK' => $this->request->getPost('facebook_imputado'),
					'INSTAGRAM' => $this->request->getPost('instagram_imputado'),
					'TWITTER' => $this->request->getPost('twitter_imputado'),
					'PAIS' => $this->request->getPost('pais_imputado'),
					'ESTADOORIGENID' => $this->request->getPost('estado_origen_imputado'),
					'MUNICIPIOORIGENID' => $this->request->getPost('municipio_origen_imputado'),
					'NACIONALIDADID' => $this->request->getPost('nacionalidad_imputado'),
					'ESCOLARIDADID' => $this->request->getPost('escolaridad_imputado'),
					'OCUPACIONID' => $this->request->getPost('ocupacion_imputado'),
				);
				$interior_imputado = $this->request->getPost('numero_int_imputado');
				if ($interior_imputado == '') {
					$interior_imputado = NULL;
				}
				$exterior_imputado = $this->request->getPost('numero_ext_imputado');
				if ($exterior_imputado == '') {
					$exterior_imputado = NULL;
				}
				$dataImputadoDomicilio = array(
					'PAIS' => $this->request->getPost('pais_imputado'),
					'ESTADOID' => $this->request->getPost('estado_imputado'),
					'MUNICIPIOID' => $this->request->getPost('municipio_imputado'),
					'LOCALIDADID' => $this->request->getPost('localidad_imputado'),
					'COLONIAID' => $this->request->getPost('colonia_imputado'),
					'COLONIADESCR' => $this->request->getPost('colonia_imputado_input'),
					'CALLE' => $this->request->getPost('calle_imputado'),
					'NUMEROCASA' => $this->request->getPost('checkML_imputado') == 'on'  && $exterior_imputado ?  'M.' . $exterior_imputado : $exterior_imputado,
					'NUMEROINTERIOR' => $this->request->getPost('checkML_imputado') == 'on' && $interior_imputado ?  'L.' . $interior_imputado : $interior_imputado,
					'CP' => $this->request->getPost('cp_imputado'),
				);
				if ((int)$this->request->getPost('ocupacion_imputado') == 999) {
					$dataImputado['OCUPACIONID'] =  (int)$this->request->getPost('ocupacion_imputado');
					$dataImputado['OCUPACIONDESCR'] = $this->request->getPost('ocupacion_descr_imputado');
				} else {
					$dataImputado['OCUPACIONID'] = (int)$this->request->getPost('ocupacion_imputado');
					$dataImputado['OCUPACIONDESCR'] = NULL;
				}
				//Insercion de persona fisica, media filiacion y domicilio del imputado cuando es conocido

				$imputadoId = $this->_folioPersonaFisica($dataImputado, $FOLIOID, 2, $year);
				$this->_folioPersonaFisicaMediaFiliacion($dataImputado, $FOLIOID, $imputadoId, $year);
				$this->_folioPersonaFisicaDomicilio($dataImputadoDomicilio, $FOLIOID, $imputadoId, $year);
			} else {

				//Datos del imputado sin conocer
				$dataImputado = array(
					'NOMBRE' => 'QUIEN RESULTE RESPONSABLE',
					'FECHANACIMIENTO' => null,
				);

				$dataImputadoDomicilio = array(
					'PAIS' => null,
					'ESTADOID' => null,
					'MUNICIPIOID' => null,
					'LOCALIDADID' => null,
					'COLONIAID' => null,
					'COLONIADESCR' => null,
					'CALLE' => null,
					'NUMEROCASA' => null,
					'NUMEROINTERIOR' => null,
					'CP' => null,
				);
				//Insercion de persona fisica, media filiacion y domicilio del imputado

				$imputadoId = $this->_folioPersonaFisica($dataImputado, $FOLIOID, 2, $year);
				$this->_folioPersonaFisicaMediaFiliacion($dataImputado, $FOLIOID, $imputadoId, $year);
				$this->_folioPersonaFisicaDomicilio($dataImputadoDomicilio, $FOLIOID, $imputadoId, $year);
			}
			//Datos del vehiculo
			if ($this->request->getPost('delito') == "ROBO DE VEHÍCULO") {
				if ($_FILES['foto_vehiculo_nc']['name'] != null) {
					$img_file = $this->request->getFile('foto_vehiculo_nc');
				} else {
					$img_file = $this->request->getFile('foto_vehiculo_sp');
				}
				$fotoV = null;
				//Verifica que sea valido el documento
				if ($img_file->isValid()) {
					try {
						$fotoV = file_get_contents($img_file);
					} catch (\Exception $e) {
						$fotoV = null;
					}
				}
				if ($_FILES['documento_vehiculo_nc']['name'] != null) {
					$document_file = $this->request->getFile('documento_vehiculo_nc');
				} else {
					$document_file = $this->request->getFile('documento_vehiculo_sp');
				}
				$docV = null;
				if ($document_file->isValid()) {
					try {
						$docV = file_get_contents($document_file);
					} catch (\Exception $e) {
						$docV = null;
					}
				}

				$dataVehiculo = array(
					'TIPOID' => $this->request->getPost('tipo_vehiculo'),
					'PRIMERCOLORID' => $this->request->getPost('color_vehiculo'),
					'TIPOPLACA' => $this->request->getPost('tipo_placas_vehiculo'),
					'PLACAS' => $this->request->getPost('placas_vehiculo'),
					'NUMEROSERIE' => $this->request->getPost('serie_vehiculo'),
					'SENASPARTICULARES' => $this->request->getPost('description_vehiculo') ? $this->request->getPost('description_vehiculo') : $this->request->getPost('description_vehiculo_sp'),
					'FOTO' => $fotoV,
					'DOCUMENTO' => $docV,
					'SITUACION' => 2,
				);
				//Insercion del vehiculo
				$this->_folioVehiculo($dataVehiculo, $FOLIOID, $year);
			}
			if ($this->_sendEmailFolio($session->get('CORREO'), $FOLIOID, $year)) {
				$url = "/denuncia_litigantes/dashboard/subir_documentos_folio?folio=" . $FOLIOID . "&year=" . $year;
				return redirect()->to(base_url($url))->with('message_success', 'Por favor, sube la denuncia escrita.');
			} else {
				return redirect()->back()->with('message_error', 'Hubo un error en los datos y no se guardo, intentalo de nuevo.');
			}
		} else {
			return redirect()->to(base_url('/denuncia_litigantes/dashboard'))->with('message_error', 'Hubo un error, llena todo correctamente y no subas documentos e imagenes muy grandes.');
		}
	}
	/**
	 * Funcion para direccionar a la vista de subir documentos en persona fisica
	 */
	public function subir_documentos_view()
	{
		$folio = $this->request->getGet('folio');
		$year = $this->request->getGet('year');
		$data = (object) array();
		$folioData = $this->_folioModelRead->asObject()->where('FOLIOID', $folio)->where('ANO', $year)->first();
		$countDocumentos = count($this->_archivoExternoModelRead->asObject()->where('FOLIOID', $folio)->where('ANO', $year)->findAll());
		
		if ($folioData->STATUS == 'PENDIENTE' && $countDocumentos < 2) {
			$data->archivos = $this->_archivoExternoModelRead->asObject()->where('FOLIOID', $folio)->where('ANO', $year)->findAll();
			if ($data->archivos) {
				foreach ($data->archivos as $key => $archivos) {
					$file_info = new \finfo(FILEINFO_MIME_TYPE);
					$type = $file_info->buffer($archivos->ARCHIVO);
					$archivos->ARCHIVO = 'data:' . $type . ';base64,' . base64_encode($archivos->ARCHIVO);
				}
			}
			$data->status = "PENDIENTE";
			$this->_loadViewDenunciaPersonaFisica('Dashboard', 'dashboard', '', $data, 'subir_documentos_denuncia_fisica');
		}else if ($folioData->STATUS == 'ABIERTO' && ($countDocumentos == 2 || $countDocumentos == 1) ) {
			$data->archivos = $this->_archivoExternoModelRead->asObject()->where('FOLIOID', $folio)->where('ANO', $year)->findAll();
			if ($data->archivos) {
				foreach ($data->archivos as $key => $archivos) {
					$file_info = new \finfo(FILEINFO_MIME_TYPE);
					$type = $file_info->buffer($archivos->ARCHIVO);
					$archivos->ARCHIVO = 'data:' . $type . ';base64,' . base64_encode($archivos->ARCHIVO);
				}
			}
			$data->status = "COMPLETADO";
			$this->_loadViewDenunciaPersonaFisica('Dashboard', 'dashboard', '', $data, 'subir_documentos_denuncia_fisica');

		}else {
			return redirect()->to(base_url('/denuncia_litigantes/dashboard/pantalla_final'))->with('message_error', 'No se pueden añadir mas documentos a este folio.');
		}
	}
	/**
	 * Vista de un listado de denuncias que tiene el usuario
	 *
	 */
	public function denuncias()
	{
		$session = session();
		$data = (object) array();
		//Busqueda de folios de ese denunciante
		$data->folios = $this->_folioModelRead->asObject()->join('TIPOEXPEDIENTE', 'FOLIO.TIPOEXPEDIENTEID = TIPOEXPEDIENTE.TIPOEXPEDIENTEID', 'LEFT')->join('MUNICIPIO', 'FOLIO.MUNICIPIOASIGNADOID = MUNICIPIO.MUNICIPIOID AND MUNICIPIO.ESTADOID = 2', 'LEFT')->join('EMPLEADOS', 'FOLIO.OFICINAASIGNADOID = EMPLEADOS.OFICINAID AND FOLIO.AGENTEASIGNADOID = EMPLEADOS.EMPLEADOID AND FOLIO.MUNICIPIOASIGNADOID = EMPLEADOS.MUNICIPIOID', 'LEFT')->where('DENUNCIANTEID', $session->get('DENUNCIANTEID'))->findAll();
		foreach ($data->folios as $key => $folio) {
			$folio->ESTADOENJUSTICIA = '';
			$folio->OFICINAENJUSTICIA = '';
			if ($folio->STATUS == 'EXPEDIENTE') {
				try {
					//Se obtiene el estado del expediente
					$expediente_estado = $this->_getExpedienteStatusOficina($folio->EXPEDIENTEID, $folio->MUNICIPIOASIGNADOID);
					if ($expediente_estado->status == 201) {
						$folio->ESTADOENJUSTICIA = $expediente_estado->data[0]->ESTADOJURIDICOEXPEDIENTEDESCR ? $expediente_estado->data[0]->ESTADOJURIDICOEXPEDIENTEDESCR : '';
						$folio->OFICINAENJUSTICIA = $expediente_estado->data[0]->OFICINADESCR ? $expediente_estado->data[0]->OFICINADESCR : '';
					}
				} catch (\Throwable $th) {
				}
			}
		}
		$this->_loadView('Mis denuncias', $data, 'lista_denuncias');
	}
	/**Funcion para obtener los datos del poder de acuerdo al id */
	public function getPoderById()
	{
		$poderid = $this->request->getPost('poderid');
		$moralid = $this->request->getPost('personamoralid');

		$data = (object) array();
		$data->poder = $this->_relacionMoralPoderRead->asObject()->where('PODERID', $poderid)->where('PERSONAMORALID', $moralid)->where('ACTIVO', 1)->first();
		$data->personaMoral = $this->_personasMoralesRead->asObject()->where('PERSONAMORALID', $moralid)->first();
		if ($data->poder->PODERARCHIVO) {
			$file_info = new \finfo(FILEINFO_MIME_TYPE);
			$type = $file_info->buffer($data->poder->PODERARCHIVO);
			$data->poder->PODERARCHIVO = 'data:' . $type . ';base64,' . base64_encode($data->poder->PODERARCHIVO);
		}
		return json_encode(['poder' => $data->poder, 'personaMoral' => $data->personaMoral]);
	}
	/**
	 * Vista de perfil, carga los datos del denunciante en la vista
	 *
	 */
	public function profile()
	{
		$data = (object) array();
		$data->user = $this->_denunciantesModelRead->asObject()->where('DENUNCIANTEID', session('DENUNCIANTEID'))->first();
		$this->_loadView('Mi perfil', $data, 'perfil');
	}

	/**
	 * Se obtiene el estado del expediente desde el WebService a Justicia
	 *
	 * @param  mixed $expedienteId
	 * @param  mixed $municipio
	 */
	private function _getExpedienteStatusOficina($expedienteId, $municipio)
	{
		$function = '/expediente.php?process=getStatus';
		$endpoint = $this->endpoint . $function;
		$conexion = $this->_conexionesDBModelRead->asObject()->where('ESTADOID', 2)->where('MUNICIPIOID', (int) $municipio)->where('TYPE', ENVIRONMENT)->first();
		$data = array();

		$data['EXPEDIENTEID'] = $expedienteId;
		$data['userDB'] = $conexion->USER;
		$data['pwdDB'] = $conexion->PASSWORD;
		$data['instance'] = $conexion->IP . '/' . $conexion->INSTANCE;
		$data['schema'] = $conexion->SCHEMA;

		return $this->_curlPostDataEncrypt($endpoint, $data);
	}
	/**
	 * Función CURL POST a Justicia encriptados
	 *
	 * @param  mixed $endpoint
	 * @param  mixed $data
	 */
	private function _curlPostDataEncrypt($endpoint, $data)
	{
		$ch = curl_init();

		curl_setopt($ch, CURLOPT_URL, $endpoint);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $this->_encriptar(json_encode($data), KEY_128));
		$headers = array(
			'Content-Type: application/json',
			'Access-Control-Allow-Origin: *',
			'Access-Control-Allow-Credentials: true',
			'Access-Control-Allow-Headers: Content-Type',
			'Hash-API: ' . password_hash(TOKEN_API, PASSWORD_BCRYPT),
			'Key: ' . KEY_128
		);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		$result = curl_exec($ch);

		if ($result === false) {
			$result = "{
                'status' => 401,
                'error' => 'Curl failed: '" . curl_error($ch) . "
            }";
		}
		curl_close($ch);
		// var_dump($data);
		// var_dump($result);exit;
		// return $result;
		return json_decode($result);
	}
	/**
	 * Función para encriptar los datos del metodo POST enviados al WebService de Justicia
	 * @param  mixed $plaintext
	 * @param  mixed $key128
	 */
	private function _encriptar($plaintext, $key128)
	{
		$iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length('aes-128-cbc'));
		$cipherText = openssl_encrypt($plaintext, 'AES-128-CBC', hex2bin($key128), 1, $iv);
		return base64_encode($iv . $cipherText);
	}
	/**
	 * Funcion para subir mas documentos una vez realizada la denuncia
	 */
	public function subir_documentos()
	{
		$folio = $this->request->getPost('folio');
		$year = $this->request->getPost('year');
		$documento_extra = $this->request->getFile('documento_extra_denuncia_escrita');
		$documento_extra_data = null;
		if ($documento_extra->isValid()) {
			try {
				$documento_extra_data = file_get_contents($documento_extra);
			} catch (\Exception $e) {
				$documento_extra_data = null;
			}
		}
		//Se extrae el nombre del documento
		$nombre = explode('.', $documento_extra->getName())[0];
		//Info para la tabla de archivos externos
		$data = [
			'FOLIOID' => $this->request->getPost('folio'),
			'ANO' => $this->request->getPost('year'),
			'ARCHIVODESCR' =>  strtoupper($nombre),
			'ARCHIVO' => $documento_extra_data,
			'EXTENSION' => $documento_extra->getClientExtension(),
			'TIPO'=> 'DENUNCIA ESCRITA'
		];
		$dataFolio = [
			'STATUS' => "ABIERTO",
		];
		//archivoExterno del archivo
		$archivoExterno = $this->_folioExpArchivo($data, $folio, $year);
		$url = "/denuncia_litigantes/dashboard/subir_documentos_folio?folio=" . $folio . "&year=" . $year;
		if ($archivoExterno) {
			$updateFolio = $this->_folioModel->set($dataFolio)->where('FOLIOID', $folio)->where('ANO', $year)->update();
			// $url = "/denuncia_litigantes/dashboard/pantalla_final";
			if ($updateFolio) {
				return redirect()->to(base_url($url))->with('message_success', 'Se ha enviado tu documento.');
			} else {
				return redirect()->to(base_url($url))->with('message_error', 'No se pudo realizar el envio.');
			}
		}else{
			return redirect()->to(base_url($url))->with('message_error', 'No se pudo realizar el envio.');
		}
	}
	/**Funcion para que el agente pueda cambiar el poder actual de la persona moral */
	function cambiarPoderActual()
	{
		$poderid = $this->request->getPost('poderid');
		$moralid = $this->request->getPost('moralid');
		$desactivar = $this->_relacionPoderLitigantes->set('ACTIVO', 0)->where('PERSONAMORALID', $moralid)->update();
		$activar  = $this->_relacionPoderLitigantes->set('ACTIVO', 1)->where('PODERID', $poderid)->update();
		if ($desactivar && $activar) {
			$updateMoral = $this->_personasMoralesModel->set(['PODERID' => $poderid, 'CAMBIO' => 'N'])->where('PERSONAMORALID', $moralid)->update();
			if ($updateMoral) return json_encode(['status' => 1]);
		}
	}
	/**Funcion para actualizar el poder y archivo externo del folio */
	function changePoderArchivo()
	{
		$folio = $this->request->getPost('folio');
		$year = $this->request->getPost('year');

		$folioPM = $this->_folioPersonaMoralModelRead->asObject()->join('RELACIONPODERLITIGANTE', 'RELACIONPODERLITIGANTE.PODERID= FOLIOPERSONAMORAL.PODERID')->where('FOLIOID', $folio)->where('ANO', $year)->first();

		$personasMorales = $this->_personasMoralesRead->asObject()->join('RELACIONPODERLITIGANTE', 'RELACIONPODERLITIGANTE.PODERID= PERSONASMORALES.PODERID')->where('PERSONASMORALES.PERSONAMORALID', $folioPM->PERSONAMORALID)->first();
		if ($personasMorales->ACTIVO == 1) {
			$updateFolioPM = $this->_folioPersonaMoralModel->set('PODERID', $personasMorales->PODERID)->where('FOLIOID', $folio)->where('ANO', $year)->update();
			if ($updateFolioPM) {
				$file_info = new \finfo(FILEINFO_MIME_TYPE);
				$type = $file_info->buffer($personasMorales->PODERARCHIVO);
				$extension = strstr($type, '/');
				$extension = ltrim($extension, '/');
				//Info para la tabla de archivos externos
				$dataArchivo = [
					'ARCHIVODESCR' =>  $personasMorales->NOMBREARCHIVO,
					'ARCHIVO' =>  $personasMorales->PODERARCHIVO,
					'EXTENSION' => $extension,
				];
				$archivos = $this->_archivoExternoModel->set($dataArchivo)->where('FOLIOID', $folio)->where('ANO', $year)->where('TIPO', 'PODER')->update();
				if ($archivos) {
					$data = (object) array();
					$data->archivosexternos = $this->_archivoExternoModelRead->asObject()->where('FOLIOID', $folio)->where('ANO', $year)->findAll();
					if ($data->archivosexternos) {
						foreach ($data->archivosexternos as $key => $archivos) {
							$file_info = new \finfo(FILEINFO_MIME_TYPE);
							$type = $file_info->buffer($archivos->ARCHIVO);
			
							$archivos->ARCHIVO = 'data:' . $type . ';base64,' . base64_encode($archivos->ARCHIVO);
						}
					}
					return json_encode(['status'=>1, 'archivos'=>$data->archivosexternos]);
				}
			}else{
				return json_encode(['status'=>0]);
			}
		}
	}
	/**Funcion para solicitar cambio de informacion de persona moral y agregar nuevo poder */
	function createPoder()
	{
		$personamoralid = $this->request->getPost('personamoralid');
		// $poderes = $this->_relacionMoralPoderRead->asObject()->where('PERSONAFISICAID', session('DENUNCIANTEID'))->where('ACTIVO', 1)->findAll();
		// if ($poderes) {
		// 	$this->_relacionMoralPoderRead->set('ACTIVO', 0)->where('PERSONAFISICAID', session('DENUNCIANTEID'))->update();
		// }

		$data = [
			'CAMBIO' => "S",
		];
		$poder_archivo = $this->request->getFile('archivo');
		$poder_data = null;
		if ($this->request->getFile('archivo') != null && $poder_archivo->isValid()) {
			try {
				$nombre = explode('.', $poder_archivo->getName())[0];
				$poder_data = file_get_contents($poder_archivo);
			} catch (\Exception $e) {
				$poder_data = null;
			}
		}

		$dataPoder = [
			'PERSONAMORALID' => $personamoralid,
			'ACTIVO' => 0,
			'PODERVOLUMEN' => $this->request->getPost('volumen') != "" ? $this->request->getPost('volumen') : NULL,
			'PODERNONOTARIO' => $this->request->getPost('notario') != "" ? $this->request->getPost('notario') : NULL,
			'PODERNOPODER' => $this->request->getPost('poder') != "" ? $this->request->getPost('poder') : NULL,
			'NOMBREARCHIVO' => strtoupper($nombre),
			'PODERARCHIVO' => $poder_data,
			'FECHAINICIOPODER' => $this->request->getPost('fecha_inicio') != "" ? $this->request->getPost('fecha_inicio') : NULL,
			'FECHAFINPODER' => $this->request->getPost('fecha_fin') != "" ? $this->request->getPost('fecha_fin') : NULL,
			'CARGO' => $this->request->getPost('cargo'),
			'DESCRIPCIONCARGO' => $this->request->getPost('descr_cargo') != "" ? $this->request->getPost('descr_cargo') : NULL,
		];
		if ($this->_relacionPoderLitigantes->save($dataPoder)) {
			$updateCambio = $this->_personasMoralesModel->set($data)->where('PERSONAMORALID', $personamoralid)->update();
			if ($updateCambio) {
				$poderes = $this->_relacionMoralPoderRead->asObject()->where('PERSONAMORALID', $personamoralid)->findAll();
				if ($poderes) {
					foreach ($poderes as $key => $poder) {
						if ($poder->PODERARCHIVO) {
							$file_info = new \finfo(FILEINFO_MIME_TYPE);
							$type = $file_info->buffer($poder->PODERARCHIVO);
							$poder->PODERARCHIVO = 'data:' . $type . ';base64,' . base64_encode($poder->PODERARCHIVO);
						}
					}
				}
				return json_encode([
					'status' => 1, 'poder' => $poderes
				]);
			} else {
				return json_encode(['status' => 0]);
			}
		} else {
			return json_encode(['status' => 0]);
		}
	}
	/**
	 * Funcion para obtener el estatus del folio en el modulo de subir archivos de litigantes
	 */
	function getStatusFolio()
	{
		$folio = $this->request->getGet('folio');
		$year = $this->request->getGet('year');

		$data = $this->_folioModelRead->asObject()->where('FOLIOID', $folio)->where('ANO', $year)->first();
		return json_encode((object)['data' => $data]);
	}
	/**
	 * Funcion para obtener la marca comercial de acuerdo a la persona moral
	 */
	public function getMarcaComercialByEmpresa()
	{
		$personaMoralId = $this->request->getPost('personamoralid');
		$data  = (object)array();
		$data->empresas =
			$this->_relacionFisicaMoralModelRead->asObject()
			->select('PERSONASMORALES.PERSONAMORALID, PERSONASMORALES.RFC,PERSONASMORALES.PERSONAMORALGIROID,PERSONASMORALES.RAZONSOCIAL, PERSONASMORALES.MARCACOMERCIAL, PODERNOPODER, PODERNONOTARIO, PODERVOLUMEN, PERSONASMORALES.ESTADOID,PERSONASMORALES.MUNICIPIOID,PERSONASMORALES.LOCALIDADID,PERSONASMORALES.COLONIAID,PERSONASMORALES.COLONIADESCR,PERSONASMORALES.ZONA, PERSONASMORALES.CORREO, PERSONASMORALES.TELEFONO,PERSONASMORALES.NUMERO,PERSONASMORALES.NUMEROINTERIOR,PERSONASMORALES.REFERENCIA')
			->join('PERSONASMORALES', 'PERSONASMORALES.PERSONAMORALID = RELACIONFISICAMORAL.PERSONAMORALID')
			->where('RELACIONFISICAMORAL.DENUNCIANTEID', session('DENUNCIANTEID'))
			->where('PERSONASMORALES.PERSONAMORALID', $personaMoralId)
			->first();
		$data->notificaciones = $this->_personasMoralesNotificacionesModelRead->asObject()->where('PERSONAMORALID', $personaMoralId)->findAll();
		// $data = $this->_personasMoralesRead->asObject()->where('PERSONAMORALID', $personaMoralId)->first();
		return json_encode((object)['data' => $data]);
	}
	/**
	 * Funcion para obtener la marca comercial de acuerdo a la persona moral
	 */
	public function getNotificacionDireccion()
	{
		$notificacionId = $this->request->getPost('notificacionid');
		$personaMoralId = $this->request->getPost('personamoralid');
		$data =
			$this->_personasMoralesNotificacionesModelRead->asObject()
			->where('PERSONAMORALID', $personaMoralId)->where('NOTIFICACIONID', $notificacionId)->first();

		// var_dump($data);
		// exit;
		// $data = $this->_personasMoralesRead->asObject()->where('PERSONAMORALID', $personaMoralId)->first();
		return json_encode((object)['data' => $data]);
	}
	/**
	 * Funcion para obtener los datos de la relacion para poder actualizar
	 */
	public function getRelacionLitigantes()
	{
		$denuncianteId = $this->request->getPost('denuncianteid');
		$personaMoralId = $this->request->getPost('personamoralid');
		$data = $this->_relacionFisicaMoralModelRead->asObject()
			->where('PERSONAMORALID', $personaMoralId)->where('DENUNCIANTEID', $denuncianteId)->first();
		if ($data->PODERARCHIVO) {
			$file_info = new \finfo(FILEINFO_MIME_TYPE);
			$type = $file_info->buffer($data->PODERARCHIVO);
			$data->PODERARCHIVO = 'data:' . $type . ';base64,' . base64_encode($data->PODERARCHIVO);
		}
		return json_encode((object)['data' => $data]);
	}
	/**
	 * Funcíon para sacar si hay registro de personas fisicas e incrementar 1, o si no hay asignar el valor inicial
	 *
	 * @param  mixed $data
	 * @param  mixed $folio
	 * @param  mixed $year
	 */
	private function _folioPersonaFisica($data, $folio, $calidadJuridica, $year)
	{
		$data = $data;
		$data['FOLIOID'] = $folio;
		$data['ANO'] = $year;
		$data['CALIDADJURIDICAID'] = $calidadJuridica;
		if ($data['FECHANACIMIENTO'] == '' || $data['FECHANACIMIENTO'] == null || $data['FECHANACIMIENTO'] == '0000-00-00') {
			$data['FECHANACIMIENTO'] = null;
		}

		$personaFisica = $this->_folioPersonaFisicaModelRead->asObject()->where('FOLIOID', $folio)->where('ANO', $year)->orderBy('PERSONAFISICAID', 'desc')->first();

		if ($personaFisica) {
			$data['PERSONAFISICAID'] = ((int) $personaFisica->PERSONAFISICAID) + 1;
			$personaFisica = $this->_folioPersonaFisicaModel->insert($data);
			return $data['PERSONAFISICAID'];
		} else {
			$data['PERSONAFISICAID'] = 1;
			$personaFisica = $this->_folioPersonaFisicaModel->insert($data);
			return $data['PERSONAFISICAID'];
		}
	}
	/**
	 * Funcíon para sacar si hay registro de personas morales e incrementar 1, o si no hay asignar el valor inicial
	 *
	 * @param  mixed $data
	 * @param  mixed $folio
	 * @param  mixed $year
	 */
	private function _folioPersonaMorales($data, $folio, $calidadJuridica, $year)
	{
		$data = $data;
		$data['FOLIOID'] = $folio;
		$data['ANO'] = $year;
		$data['CALIDADJURIDICAID'] = $calidadJuridica;

		$personaMoral = $this->_folioPersonaMoralModelRead->asObject()->where('FOLIOID', $folio)->where('ANO', $year)->orderBy('PERSONAMORALID', 'desc')->first();
		$insertPersonaMoral = $this->_folioPersonaMoralModel->insert($data);
		return $data['PERSONAMORALID'];

		// if ($personaMoral) {
		// 	$data['PERSONAMORALID'] = ((int) $personaMoral->PERSONAMORALID) + 1;
		// } else {
		// 	$data['PERSONAMORALID'] = 1;
		// 	$personaMoral = $this->_folioPersonaMoralModel->insert($data);
		// 	return $data['PERSONAMORALID'];
		// }
	}


	/**
	 * Funcíon para sacar si hay registro de dirrecion de notifcacion e incrementar 1, o si no hay asignar el valor inicial
	 *
	 * @param  mixed $data
	 * @param  mixed $notificacionid
	 * @param  mixed $personaMoralId
	 */
	private function _personaMoralNotificacion($data, $personaMoralId)
	{
		$data = $data;
		$notificacion = $this->_personasMoralesNotificacionesModelRead->asObject()->where('PERSONAMORALID', $personaMoralId)->orderBy('NOTIFICACIONID', 'desc')->first();

		if ($notificacion) {
			$data['NOTIFICACIONID'] = ((int) $notificacion->NOTIFICACIONID) + 1;
			$notificacion = $this->_personasMoralesNotificacionesModel->insert($data);
			return $data['NOTIFICACIONID'];
		} else {
			$data['NOTIFICACIONID'] = 1;
			$notificacion = $this->_personasMoralesNotificacionesModel->insert($data);
			return $data['NOTIFICACIONID'];
		}
	}
	/**
	 * Funcíon para sacar si hay registro de domicilios e incrementar 1, o si no hay asignar el valor inicial

	 *
	 * @param  mixed $data
	 * @param  mixed $folio
	 * @param  mixed $personaFisicaID
	 * @param  mixed $year
	 * @return void
	 */
	private function _folioPersonaFisicaDomicilio($data, $folio, $personaFisicaID, $year)
	{
		$data = $data;

		$data['FOLIOID'] = $folio;
		$data['ANO'] = $year;
		$data['PERSONAFISICAID'] = $personaFisicaID;
		$colonia = $this->_coloniasModelRead->asObject()->where('ESTADOID', 2)->where('MUNICIPIOID', $data['MUNICIPIOID'])->where('LOCALIDADID',  $data['LOCALIDADID'])->where('COLONIAID', $data['COLONIAID'])->first();

		if ((int) $data['COLONIAID'] == 0 || $data['COLONIAID'] == null) {
			$data['COLONIAID'] = null;
			$data['COLONIADESCR'] = $data['COLONIADESCR'];
		} else {
			$data['COLONIAID'] = $colonia->COLONIAID;
			$data['COLONIADESCR'] = $colonia->COLONIADESCR;
		};
		if ($data['COLONIAID'] != null) {

			if ($data['MUNICIPIOID']) {
				try {
					$colonia = $this->_coloniasModelRead->asObject()->where('ESTADOID', 2)->where('MUNICIPIOID', $data['MUNICIPIOID'])->where('LOCALIDADID',  $data['LOCALIDADID'])->where('COLONIAID', $data['COLONIAID'])->first();
					$colonia ? $data['LOCALIDADID'] = $colonia->LOCALIDADID : $data['LOCALIDADID'] = null;
				} catch (\Exception $e) {
					$data['LOCALIDADID'] = null;
				}
			} else {
				$data['LOCALIDADID'] = null;
			}
		}

		if ($data['LOCALIDADID'] != null) {
			if ($data['MUNICIPIOID']) {
				try {
					$localidad = $this->_localidadesModelRead->asObject()->where('ESTADOID', 2)->where('MUNICIPIOID', $data['MUNICIPIOID'])->where('LOCALIDADID', $data['LOCALIDADID'])->first();
					$localidad ? $data['ZONA'] = $localidad->ZONA : null;
				} catch (\Exception $e) {
				}
			}
		}

		$personaDomicilio = $this->_folioPersonaFisicaDomicilioModelRead->asObject()->where('FOLIOID', $folio)->where('ANO', $year)->where('PERSONAFISICAID', $personaFisicaID)->orderBy('DOMICILIOID', 'desc')->first();

		if ($personaDomicilio) {
			$data['DOMICILIOID'] = ((int) $personaDomicilio->DOMICILIOID) + 1;
			$this->_folioPersonaFisicaDomicilioModel->insert($data);
			return $data['DOMICILIOID'];
		} else {
			$data['DOMICILIOID'] = 1;
			$this->_folioPersonaFisicaDomicilioModel->insert($data);
			return $data['DOMICILIOID'];
		}
	}

	/**
	 * Funcíon para agregar media filiacion a las personas fisícas
	 *
	 * @param  mixed $data
	 * @param  mixed $folio
	 * @param  mixed $personaFisicaID
	 * @param  mixed $year
	 */
	private function _folioPersonaFisicaMediaFiliacion($data, $folio, $personaFisicaID, $year)
	{
		$data = $data;
		$data['FOLIOID'] = $folio;
		$data['ANO'] = $year;
		$data['PERSONAFISICAID'] = $personaFisicaID;
		if (empty($data['FECHADESAPARICION'])) {
			$data['FECHADESAPARICION'] = null;
		}
		if ($data['FECHADESAPARICION'] == '0000-00-00') {
			$data['FECHADESAPARICION'] = null;
		}
		$this->_folioMediaFiliacion->insert($data);
	}
	/**
	 * Funcíon para sacar si hay registro de vehículos e incrementar 1, o si no hay asignar el valor inicial
	 *
	 * @param  mixed $data
	 * @param  mixed $folio
	 * @param  mixed $year
	 */
	private function _folioVehiculo($data, $folio, $year)
	{
		$data = $data;
		$data['FOLIOID'] = $folio;
		$data['ANO'] = $year;

		$vehiculo = $this->_folioVehiculoModelRead->asObject()->where('FOLIOID', $folio)->where('ANO', $year)->orderBy('VEHICULOID', 'desc')->first();

		if ($vehiculo) {
			$data['VEHICULOID'] = ((int) $vehiculo->VEHICULOID) + 1;
			$this->_folioVehiculoModel->insert($data);
		} else {
			$data['VEHICULOID'] = 1;
			$this->_folioVehiculoModel->insert($data);
		}
	}
	/**
	 * Funcíon para sacar si hay registro de archivos externos e incrementar 1, o si no hay asignar el valor inicial
	 *
	 * @param  mixed $data
	 * @param  mixed $folio
	 * @param  mixed $year
	 */
	private function _folioExpArchivo($data, $folio, $year)
	{
		$data = $data;
		$data['FOLIOID'] = $folio;
		$data['ANO'] = $year;


		$archivoExterno = $this->_archivoExternoModelRead->asObject()->where('FOLIOID', $folio)->where('ANO', $year)->orderBy('FOLIOARCHIVOID ', 'desc')->first();

		if ($archivoExterno) {
			$data['FOLIOARCHIVOID'] = ((int) $archivoExterno->FOLIOARCHIVOID) + 1;
			$archivoExterno = $this->_archivoExternoModel->insert($data);
			return $data['FOLIOARCHIVOID'];
		} else {
			$data['FOLIOARCHIVOID'] = 1;
			$archivoExterno = $this->_archivoExternoModel->insert($data);
			return $data['FOLIOARCHIVOID'];
		}
	}
	/**
	 * Funcion para mandar el folio generado por email o sms al denunciante
	 *
	 * @param  mixed $to
	 * @param  mixed $folio
	 * @param  mixed $year
	 */
	private function _sendEmailFolio($to, $folio, $year)
	{
		$user = $this->_denunciantesModelRead->asObject()->where('CORREO', $to)->first();

		$body = view('email_template/folio_email_escrita_template.php', ['folio' => $folio . '/' . $year]);
		$mailersend = new MailerSend(['api_key' => EMAIL_TOKEN]);
		$recipients = [
			new Recipient($to, 'Your Client'),
		];

		$emailParams = (new EmailParams())
			->setFrom('notificacionfgebc@fgebc.gob.mx')
			->setFromName('FGEBC')
			->setRecipients($recipients)
			->setSubject('Nuevo folio generado.')
			->setHtml($body)
			->setText('Se ha generado un nuevo folio. SU FOLIO ES: ' . $folio . '/' . $year . ' Para darle seguimiento a su caso ingrese a su cuenta en el Centro de Denuncia Tecnológica e inicie su video denuncia con el folio generado.')
			->setReplyTo('notificacionfgebc@fgebc.gob.mx')
			->setReplyToName('FGEBC');
		$sendSMS = $this->sendSMS("Nuevo folio generado", $user->TELEFONO, 'Notificaciones FGEBC/Estimado usuario, tu folio es: ' . $folio . '/' . $year);

		try {
			$result = $mailersend->email->send($emailParams);
		} catch (MailerSendValidationException $e) {
			$result = false;
		} catch (MailerSendRateLimitException $e) {
			$result = false;
		}
		if ($result) {
			return true;
		} else {
			if ($sendSMS == "") {
				return true;
			} else {
				return false;
			}
		}
	}
	/**
	 * Función para enviar mensajes SMS
	 *
	 * @param  mixed $tipo
	 * @param  mixed $celular
	 * @param  mixed $mensaje
	 */
	public function sendSMS($tipo, $celular, $mensaje)
	{

		$endpoint = "http://enviosms.ddns.net/API/";
		$data = array();
		$data['UsuarioID'] = 1;
		$data['Nombre'] = $tipo;
		$lstMensajes = array();
		$obj = array("Celular" => $celular, "Mensaje" => $mensaje);
		$lstMensajes[] = $obj;
		$data['lstMensajes'] = $lstMensajes;

		$httpClient = new Client([
			'base_uri' => $endpoint
		]);

		$response = $httpClient->post('campañas/enviarSMS', [
			'json' => $data
		]);

		$respuestaServ = $response->getBody()->getContents();

		return json_decode($respuestaServ);
	}
	/**
	 * Función para cargar cualquier vista en cualquier función.
	 *
	 * @param  mixed $title
	 * @param  mixed $data
	 * @param  mixed $view
	 */
	private function _loadView($title, $data, $view)
	{
		$data = [
			'header_data' => (object) ['title' => $title],
			'body_data' => $data,
		];
		echo view("denuncia_litigantes/dashboard/$view", $data);
	}
	/**
	 * Función para cargar cualquier vista en cualquier función. Denuncia Persona Fisica
	 *
	 * @param  mixed $title
	 * @param  mixed $menu
	 * @param  mixed $submenu
	 * @param  mixed $data
	 * @param  mixed $view
	 */
	private function _loadViewDenunciaPersonaFisica($title, $menu, $submenu, $data, $view)
	{
		$data2 = [
			'header_data' => (object) ['title' => $title, 'menu' => $menu, 'submenu' => $submenu],
			'body_data' => $data,
		];

		echo view("denuncia_litigantes/dashboard/denuncia_fisica/$view", $data2);
	}
	/**
	 * Función para cargar cualquier vista en cualquier función. Denuncia Persona Moral
	 *
	 * @param  mixed $title
	 * @param  mixed $menu
	 * @param  mixed $submenu
	 * @param  mixed $data
	 * @param  mixed $view
	 */
	private function _loadViewDenunciaPersonaMoral($title, $menu, $submenu, $data, $view)
	{
		$data2 = [
			'header_data' => (object) ['title' => $title, 'menu' => $menu, 'submenu' => $submenu],
			'body_data' => $data,
		];

		echo view("denuncia_litigantes/denuncia_moral/$view", $data2);
	}
}

/* End of file DashboardController.php */
/* Location: ./app/Controllers/extravio/DashboardController.php */
