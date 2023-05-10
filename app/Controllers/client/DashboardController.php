<?php

namespace App\Controllers\client;

use App\Controllers\BaseController;
use App\Models\DenunciantesModel;
use App\Models\FolioConsecutivoModel;
use App\Models\FolioModel;
use App\Models\FolioPersonaFisicaDomicilioModel;
use App\Models\FolioPersonaFisicaMediaFiliacionModel;
use App\Models\FolioPersonaFisicaModel;
use App\Models\FolioPreguntasModel;
use App\Models\FolioVehiculoModel;
use GuzzleHttp\Client;

class DashboardController extends BaseController
{

	private $_denunciantesModel;

	private $_folioModel;
	private $_folioPreguntasModel;
	private $_folioPersonaFisicaModel;
	private $_folioPersonaFisicaDomicilioModel;
	private $_folioVehiculoModel;
	private $_folioMediaFiliacion;

	private $_parentescoPersonaFisicaModel;

	private $_archivoExternoModel;


	private $protocol;
	private $ip;
	private $endpoint;
	private $db_read;
	private $urlApi;

	private $_folioModelRead;

	private $_archivoExternoModelRead;
	private $_municipiosModelRead;

	private $_delitosUsuariosModelRead;
	private $_hechoLugarModelRead;
	private $_nacionalidadModelRead;
	private $_personaIdiomaModelRead;
	private $_paisesModelRead;
	private $_estadosModelRead;
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
	private $_estadosExtranjerosRead;
	private $_folioPreguntasModelRead;
	private $_folioPersonaFisicaModelRead;
	private $_folioVehiculoModelRead;
	private $_folioPersonaFisicaDomicilioModelRead;
	private $_localidadesModelRead;
	private $_coloniasModelRead;
	private $_denunciantesModelRead;
	private $_conexionesDBModelRead;
	private $_folioConsecutivoModelRead;
	private $_folioConsecutivoModel;

	public function __construct()
	{
		$this->db_read = ENVIRONMENT == 'production' ? db_connect('default_read') : db_connect('development_read');

		//Models

		$this->_denunciantesModel = new DenunciantesModel();

		$this->_folioModel = new FolioModel();
		$this->_folioPreguntasModel = new FolioPreguntasModel();
		$this->_folioPersonaFisicaModel = new FolioPersonaFisicaModel();
		$this->_folioPersonaFisicaDomicilioModel = new FolioPersonaFisicaDomicilioModel();
		$this->_folioVehiculoModel = new FolioVehiculoModel();
		$this->_folioMediaFiliacion = new FolioPersonaFisicaMediaFiliacionModel();
		$this->_folioConsecutivoModel = new FolioConsecutivoModel();

		//Models reader
		$this->_folioModelRead = model('FolioModel', true, $this->db_read);

		$this->_archivoExternoModelRead = model('FolioArchivoExternoModel', true, $this->db_read);
		$this->_municipiosModelRead = model('MunicipiosModel', true, $this->db_read);

		$this->_delitosUsuariosModelRead = model('DelitosUsuariosModel', true, $this->db_read);
		$this->_hechoLugarModelRead = model('HechoLugarModel', true, $this->db_read);
		$this->_nacionalidadModelRead = model('PersonaNacionalidadModel', true, $this->db_read);
		$this->_personaIdiomaModelRead = model('PersonaIdiomaModel', true, $this->db_read);
		$this->_paisesModelRead = model('PaisesModel', true, $this->db_read);
		$this->_estadosModelRead = model('EstadosModel', true, $this->db_read);
		$this->_escolaridadModelRead = model('EscolaridadModel', true, $this->db_read);
		$this->_ocupacionModelRead = model('OcupacionModel', true, $this->db_read);
		$this->_coloresVehiculoModelRead = model('VehiculoColorModel', true, $this->db_read);
		$this->_tipoVehiculoModelRead = model('VehiculoTipoModel', true, $this->db_read);
		$this->_figuraModelRead = model('FiguraModel', true, $this->db_read);

		$this->_cabelloColorModelRead = model('CabelloColorModel', true, $this->db_read);
		$this->_cabelloEstiloModelRead = model('CabelloEstiloModel', true, $this->db_read);
		$this->_cabelloTamanoModelRead = model('CabelloTamanoModel', true, $this->db_read);

		$this->_cejaFormaModelRead = model('CejaFormaModel', true, $this->db_read);

		$this->_ojoColorModelRead = model('OjoColorModel', true, $this->db_read);
		$this->_parentescoModelRead = model('ParentescoModel', true, $this->db_read);
		$this->_pielColorModelRead = model('PielColorModel', true, $this->db_read);

		$this->_vehiculoDistribuidorModelRead = model('VehiculoDistribuidorModel', true, $this->db_read);
		$this->_vehiculoMarcaModelRead = model('VehiculoMarcaModel', true, $this->db_read);
		$this->_vehiculoModeloModelRead = model('VehiculoModeloModel', true, $this->db_read);
		$this->_vehiculoVersionModelRead = model('VehiculoVersionModel', true, $this->db_read);
		$this->_vehiculoServicioModelRead = model('VehiculoServicioModel', true, $this->db_read);
		$this->_estadosExtranjerosRead = model('EstadoExtranjeroModel', true, $this->db_read);

		$this->_folioPreguntasModelRead = model('FolioPreguntasModel', true, $this->db_read);
		$this->_folioPersonaFisicaModelRead = model('FolioPersonaFisicaModel', true, $this->db_read);

		$this->_folioVehiculoModelRead = model('FolioVehiculoModel', true, $this->db_read);

		$this->_folioPersonaFisicaDomicilioModelRead = model('FolioPersonaFisicaDomicilioModel', true, $this->db_read);
		$this->_localidadesModelRead = model('LocalidadesModel', true, $this->db_read);
		$this->_coloniasModelRead = model('ColoniasModel', true, $this->db_read);

		$this->_denunciantesModelRead = model('DenunciantesModel', true, $this->db_read);

		$this->_conexionesDBModelRead = model('ConexionesDBModel', true, $this->db_read);
		$this->_frenteFormaModelRead = model('FrenteFormaModel', true, $this->db_read);

		$this->_folioConsecutivoModelRead = model('FolioConsecutivoModel', true, $this->db_read);
		// $this->protocol = 'http://';
		// $this->ip = "10.144.244.223";
		// $this->endpoint = $this->protocol . $this->ip . '/webServiceVD';
		$this->protocol = 'https://';
		$this->ip = "ws.fgebc.gob.mx";
		$this->endpoint = $this->protocol . $this->ip . '/webServiceVD';
		$this->urlApi = VIDEOCALL_URL . "guests/";
	}
	/**
	 * Vista de Dashboard-Denuncia
	 * Retorna los catálogos necesarios para iniciar la denuncia
	 */
	public function index()
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
		// $data->lugares  = [];
		// $data->lugares =  (object) array_merge($lugares_peticion, $lugares_sin, $lugares_blanca, $lugares_fuego);
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
		$data->distribuidorVehiculo = $this->_vehiculoDistribuidorModelRead->asObject()->findAll();
		$data->marcaVehiculo = $this->_vehiculoMarcaModelRead->asObject()->findAll();
		$data->lineaVehiculo = $this->_vehiculoModeloModelRead->asObject()->findAll();
		$data->versionVehiculo = $this->_vehiculoVersionModelRead->asObject()->findAll();
		$data->servicioVehiculo = $this->_vehiculoServicioModelRead->asObject()->findAll();
		$this->_loadView('Dashboard', 'dashboard', '', $data, 'index');
	}

	/**
	 * Vista para la vinculación de videodenuncia con el agente
	 *
	 */
	public function video_denuncia()
	{
		$denunciante = $this->_denunciantesModelRead->asObject()->where('DENUNCIANTEID', session('DENUNCIANTEID'))->first();
		//Datos que recibe de la url generada
		$data = (object) [
			'folio' => $this->request->getGet('folio'),
			'year' => $this->request->getGet('year'),
			'delito' => $this->request->getGet('delito'),
			'descripcion' => $this->request->getGet('descripcion'),
			'idioma' => $this->request->getGet('idioma'),
			'edad' => $this->request->getGet('edad'),
			'perfil' => $this->request->getGet('perfil'),
			'sexo' => $this->request->getGet('sexo'),
			'prioridad' => $this->request->getGet('prioridad'),
			'sexo_denunciante' => $this->request->getGet('sexo_denunciante') == 'F' ? 'FEMENINO' : 'MASCULINO',
			'UUID' => $denunciante->UUID
		];
		$array = explode("-", $data->folio);

		$folio = $this->_folioModelRead->where('ANO', $data->year)->where('FOLIOID', $array[1])->where('STATUS', 'ABIERTO')->first();

		if ($folio) {
			$this->_loadView('Video denuncia', 'video-denuncia', '', $data, 'video_denuncia');
		} else {
			return redirect()->to(base_url('denuncia/dashboard'));
		}
	}

	/**
	 * Función para subir archivos externos durante la videollamada
	 * Recibe un file, folio y año.
	 *
	 */
	public function crear_archivos_externos()
	{

		$documento = $this->request->getFile('documentoArchivo');
		//Verifica que este vacío el documento
		if (empty($documento)) {
			return json_encode(['status' => 2]);
		}
		$doc = file_get_contents($documento);
		$f = finfo_open();
		$mime_type = finfo_buffer($f, $doc, FILEINFO_MIME_TYPE);
		//Se extrae la extension del archivos
		$extension = explode('/', $mime_type)[1];

		$archivo = $_FILES['documentoArchivo']['name'];
		//Se extrae el nombre del documento
		$nombre = explode('.', $archivo)[0];


		$data = (object) array();
		$folio = $this->request->getPost('folio');
		$year = $this->request->getPost('year');
		//Info para la tabla de archivos externos
		$data = [
			'FOLIOID' => $this->request->getPost('folio'),
			'ANO' => $this->request->getPost('year'),
			'ARCHIVODESCR' => strtoupper($nombre),
			'ARCHIVO' => $doc,
			'EXTENSION' => $extension,
		];
		//Insercion del archivo
		$archivoExterno = $this->_folioExpArchivo($data, $folio, $year);
		if ($archivoExterno) {
			$datados = (object) array();

			$datados->archivosexternos = $this->_archivoExternoModelRead->asObject()->where('FOLIOID', $folio)->where('ANO', $year)->findAll();
			if ($datados->archivosexternos) {
				foreach ($datados->archivosexternos as $key => $archivos) {
					//Codificacion del archivo para visualizarse
					$file_info = new \finfo(FILEINFO_MIME_TYPE);
					$type = $file_info->buffer($archivos->ARCHIVO);
					$archivos->ARCHIVO = 'data:' . $type . ';base64,' . base64_encode($archivos->ARCHIVO);
				}
			}
			return json_encode(['status' => 1, $datados]);
		} else {
			return json_encode(['status' => 0]);
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
		$this->_loadView('Mis denuncias', 'denuncias', '', $data, 'lista_denuncias');
	}

	/**
	 * Vista cuando finalizan llamada con el agente
	 *
	 */
	public function endVideoCall()
	{
		$session = session();
		$data = (object) array();
		$this->_loadView('Denuncia finalizada', 'endcall', '', $data, 'end_videocall');
	}

	/**
	 * Función para crear denuncias
	 * Se recibe a través del metodo POST los datos del formulario
	 *
	 */
	public function create()
	{
		$session = session();
		$folioDenunciante = $this->_folioModelRead->countFolioDenunciante(session('DENUNCIANTEID'));
		//Verifica que no tenga folios el denunciante
		if ($folioDenunciante->folios_pendientes == 1) {
			return redirect()->to(base_url('/denuncia/dashboard'))->with('message_error', 'Ya tienes un folio, no puedes generar una nueva denuncia.');
		}

		//Valida los datos requeridos para hacer una denuncia
		if (($this->request->getPost('es_menor') == null || $this->request->getPost('es_menor') == '')
			|| ($this->request->getPost('es_tercera_edad') == null || $this->request->getPost('es_tercera_edad') == '')
			|| ($this->request->getPost('es_ofendido') == null || $this->request->getPost('es_ofendido') == '')
			|| ($this->request->getPost('tiene_discapacidad') == null || $this->request->getPost('tiene_discapacidad') == '')
			|| ($this->request->getPost('fue_con_arma') == null || $this->request->getPost('fue_con_arma') == '')
			|| ($this->request->getPost('lesiones') == null || $this->request->getPost('lesiones') == '')
			|| ($this->request->getPost('esta_desaparecido') == null || $this->request->getPost('esta_desaparecido') == '')
			|| ($this->request->getPost('delito') == null || $this->request->getPost('delito') == '')
			|| ($this->request->getPost('lugar') == null || $this->request->getPost('lugar') == '')
			|| ($this->request->getPost('fecha') == null || $this->request->getPost('fecha') == '')
			|| ($this->request->getPost('hora') == null || $this->request->getPost('hora') == '')
			|| ($this->request->getPost('descripcion_breve') == null || $this->request->getPost('descripcion_breve') == '')
		) {
			return redirect()->to(base_url('/denuncia/dashboard'))->with('message_error', 'Hubo un error, no subas documentos e imagenes muy grandes, máximo 2MB por documento.');
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
			'HECHOCALLE' => $this->request->getPost('calle') != '' ? $this->request->getPost('calle') : NULL,
			'HECHONUMEROCASA' => $this->request->getPost('exterior') != '' ? $this->request->getPost('exterior') : NULL,
			'HECHONUMEROCASAINT' => $this->request->getPost('interior') != '' ? $this->request->getPost('interior') : NULL,
			'HECHONARRACION' => $this->request->getPost('descripcion_breve') != '' ? strtoupper($this->request->getPost('descripcion_breve')) : NULL,
			'HECHODELITO' => $this->request->getPost('delito'),
			'TIPODENUNCIA' => 'VD',
			'NOTIFICACIONES' => 'S'
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
		if ($this->request->getPost('esta_desaparecido') == "SI") {
			$dataFolio['LOCALIZACIONPERSONA'] = 'S';
			$dataFolio['LOCALIZACIONPERSONAMEDIOS'] = $this->request->getPost('autorization_photo_des') == 'S';
		}

		// Se obtiene el consecutivo del folio
		list($FOLIOID, $year) = $this->_folioConsecutivoModel->get_consecutivo();
		$dataFolio['FOLIOID'] = $FOLIOID;
		$dataFolio['ANO'] = $year;

		//Se verifica que se inserte correctamente a la tabla
		if ($this->_folioModel->save($dataFolio)) {
			//Datos a insertar en la tabla de preguntas.
			$dataPreguntas = array(
				'ES_MENOR' => $this->request->getPost('es_menor'),
				'ES_TERCERA_EDAD' => $this->request->getPost('es_tercera_edad'),
				'ES_OFENDIDO' => $this->request->getPost('es_ofendido'),
				'TIENE_DISCAPACIDAD' => $this->request->getPost('tiene_discapacidad'),
				'FUE_CON_ARMA' => $this->request->getPost('fue_con_arma'),
				'LESIONES' => $this->request->getPost('lesiones'),
				'LESIONES_VISIBLES' => $this->request->getPost('lesiones_visibles'),
				'ES_GRUPO_VULNERABLE' => $this->request->getPost('es_vulnerable'),
				'ES_GRUPO_VULNERABLE_DESCR' => $this->request->getPost('vulnerable_descripcion'),
				'ESTA_DESAPARECIDO' => $this->request->getPost('esta_desaparecido'),
			);

			//Insercion de preguntas iniciales
			$this->_folioPreguntasIniciales($dataPreguntas, $FOLIOID, $year);

			//DATOS DESAPARECIDO
			if ($this->request->getPost('esta_desaparecido') == "SI") {

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

			//DATOS DEL MENOR DE EDAD
			if ($this->request->getPost('es_menor') === "SI" && $this->request->getPost('esta_desaparecido') === "NO") {

				$dataMenor = array(
					'NOMBRE' => $this->request->getPost('nombre_menor'),
					'PRIMERAPELLIDO' => $this->request->getPost('apellido_paterno_menor'),
					'SEGUNDOAPELLIDO' => $this->request->getPost('apellido_materno_menor'),
					'FECHANACIMIENTO' => $this->request->getPost('fecha_nacimiento_menor'),
					'EDADCANTIDAD' => $this->request->getPost('edad_menor'),
					'SEXO' => $this->request->getPost('sexo_menor'),
					'FACEBOOK' => $this->request->getPost('facebook_menor'),
					'INSTAGRAM' => $this->request->getPost('instagram_menor'),
					'TWITTER' => $this->request->getPost('twitter_menor'),
					'PAIS' => $this->request->getPost('pais_menor'),
					'ESTADOORIGENID' => $this->request->getPost('estado_origen_menor'),
					'MUNICIPIOORIGENID' => $this->request->getPost('municipio_origen_menor'),
					'NACIONALIDADID' => $this->request->getPost('nacionalidad_menor'),
					'ESCOLARIDADID' => $this->request->getPost('escolaridad_menor'),
					'OCUPACIONID' => $this->request->getPost('ocupacion_menor'),
				);
				$interior_menor = $this->request->getPost('numero_int_menor');
				if ($interior_menor == '') {
					$interior_menor = NULL;
				}
				$exterior_menor = $this->request->getPost('numero_ext_menor');
				if ($exterior_menor == '') {
					$exterior_menor = NULL;
				}
				$dataMenorDomicilio = array(
					'PAIS' => $this->request->getPost('pais_menor'),
					'ESTADOID' => $this->request->getPost('estado_menor'),
					'MUNICIPIOID' => $this->request->getPost('municipio_menor'),
					'LOCALIDADID' => $this->request->getPost('localidad_menor'),
					'COLONIAID' => $this->request->getPost('colonia_menor'),
					'COLONIADESCR' => $this->request->getPost('colonia_menor_input'),
					'CALLE' => $this->request->getPost('calle_menor'),
					'NUMEROCASA' => $this->request->getPost('checkML_menor') == 'on'  && $exterior_menor ?  'M.' . $exterior_menor : $exterior_menor,
					'NUMEROINTERIOR' => $this->request->getPost('checkML_menor') == 'on' && $interior_menor ?  'L.' . $interior_menor : $interior_menor,
					'CP' => $this->request->getPost('cp_menor'),
				);
				if ((int)$this->request->getPost('ocupacion_menor') == 999) {
					$dataMenor['OCUPACIONID'] = (int)$this->request->getPost('ocupacion_menor');
					$dataMenor['OCUPACIONDESCR'] = $this->request->getPost('ocupacion_descr_menor');
				} else {
					$dataMenor['OCUPACIONID'] = (int)$this->request->getPost('ocupacion_menor');
					$dataMenor['OCUPACIONDESCR'] = NULL;
				}
				//Insercion de persona, media filiacion y domicilio del desaparecido

				$menor = $this->_folioPersonaFisica($dataMenor, $FOLIOID, 1, $year);
				$this->_folioPersonaFisicaMediaFiliacion($dataMenor, $FOLIOID, $menor, $year);
				$this->_folioPersonaFisicaDomicilio($dataMenorDomicilio, $FOLIOID, $menor, $year);
			}

			//Datos del ofendido cuando no es el denunciante
			if ($this->request->getPost('es_menor') === "NO" && $this->request->getPost('es_ofendido') === "NO" && $this->request->getPost('esta_desaparecido') === "NO") {
				$dataOfendido = array(
					'NOMBRE' => 'QUIEN RESULTE OFENDIDO',
					'FECHANACIMIENTO' => null,
				);

				$dataOfendidoDomicilio = array(
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

				// Insercion de ofendido
				$ofendidoId = $this->_folioPersonaFisica($dataOfendido, $FOLIOID, 1, $year);
				$this->_folioPersonaFisicaMediaFiliacion($dataOfendido, $FOLIOID, $ofendidoId, $year);
				$this->_folioPersonaFisicaDomicilio($dataOfendidoDomicilio, $FOLIOID, $ofendidoId, $year);
			}

			//DATOS DEL DENUNCIANTE
			$denunciante = $this->_denunciantesModelRead->asObject()->where('DENUNCIANTEID', $session->get('DENUNCIANTEID'))->first();

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
			$denuncianteCalidad = $this->request->getPost('es_menor') == "SI" || $this->request->getPost('esta_desaparecido') == "SI" || $this->request->getPost('es_ofendido') === "NO" ? 3 : 1;
			$denuncinateIdPersona = $this->_folioPersonaFisica($dataDenunciante, $FOLIOID, $denuncianteCalidad, $year);
			$this->_folioPersonaFisicaMediaFiliacion($dataDenunciante, $FOLIOID, $denuncinateIdPersona, $year);
			$this->_folioPersonaFisicaDomicilio($dataDenuncianteDomicilio, $FOLIOID, $denuncinateIdPersona, $year);

			if ($this->request->getPost('esta_desaparecido') == "SI" && $dataDesaparecido['PARENTESCOID']) {
				$this->_parentescoPersonaFisica($dataDesaparecido, $FOLIOID, $denuncinateIdPersona, $desaparecido, $year);
			}

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

			//ARCHIVOS CARGADOS POR EL DENUNCIANTE
			// $documentosArchivosExternos = $this->request->getFiles();
			// $archivos_data = null;

			// if ($documentosArchivosExternos['documentosArchivo'][0]->isValid()) {
			// 	foreach ($documentosArchivosExternos['documentosArchivo'] as $key => $docArc) {

			// 		$doc = file_get_contents($docArc);
			// 		$f = finfo_open();
			// 		$mime_type = finfo_buffer($f, $doc, FILEINFO_MIME_TYPE);
			// 		$extension = explode('/', $mime_type)[1];
			// 		$archivoNombre = $docArc->getName();
			// 		$nombre = explode('.', $archivoNombre)[0];
			// 		if ($docArc->isValid()) {
			// 			try {
			// 				$archivos_data = file_get_contents($docArc);
			// 			} catch (\Exception $e) {
			// 				$archivos_data = null;
			// 			}
			// 		}
			// 		$data = [
			// 			'FOLIOID' => $FOLIOID,
			// 			'ANO' => $year,
			// 			'ARCHIVODESCR' => strtoupper($nombre),
			// 			'ARCHIVO' => $archivos_data,
			// 			'EXTENSION' => $extension,
			// 		];
			// 		$archivoExterno = $this->_folioExpArchivo($data, $FOLIOID, $year);
			// 		if ($archivoExterno) {
			// 			$datados = (object) array();
			// 			$datados->archivosexternos = $this->_archivoExternoModel->asObject()->where('FOLIOID', $FOLIOID)->where('ANO', $year)->findAll();
			// 			if ($datados->archivosexternos) {
			// 				foreach ($datados->archivosexternos as $key => $archivos) {
			// 					$file_info = new \finfo(FILEINFO_MIME_TYPE);
			// 					$type = $file_info->buffer($archivos->ARCHIVO);
			// 					$archivos->ARCHIVO = 'data:' . $type . ';base64,' . base64_encode($archivos->ARCHIVO);
			// 				}
			// 			}
			// 		}
			// 	}
			// }

			$denunciante = $this->_denunciantesModelRead->asObject()->where('DENUNCIANTEID', session('DENUNCIANTEID'))->first();
			$idioma = $this->_personaIdiomaModelRead->asObject()->where('PERSONAIDIOMAID', $denunciante->IDIOMAID)->first();
			$delito = $this->_delitosUsuariosModelRead->asObject()->where('DELITO', $this->request->getPost('delito'))->first();
			$prioridad = 1;

			//Prioridad conforme al delito
			if ($this->request->getPost('es_menor') == 'SI' || $this->request->getPost('es_tercera_edad') == 'SI' || $this->request->getPost('tiene_discapacidad') == 'SI' || $this->request->getPost('fue_con_arma') == 'SI' || $this->request->getPost('esta_desaparecido') == 'SI') {
				$prioridad = 3;
			} else {
				$prioridad = $delito->IMPORTANCIA ? $delito->IMPORTANCIA : 1;
			}

			//Datos para la URL
			$data = (object) [
				'delito' => $this->request->getPost('delito'),
				'descripcion' => $this->request->getPost('descripcion_breve'),
				'idioma' => $idioma->PERSONAIDIOMADESCR ? $idioma->PERSONAIDIOMADESCR : 'DESCONOCIDO',
				'edad' => $edad,
				'perfil' => $this->request->getPost('delito') == 'VIOLENCIA FAMILIAR' ? 1 : 0,
				'sexo' => $this->request->getPost('delito') == 'VIOLENCIA FAMILIAR' ? 2 : 0,
			];

			$sexo_denunciante = $denunciante->SEXO == 'F' ? 'FEMENINO' : 'MASCULINO';
			$url = "/denuncia/dashboard/video-denuncia?folio=" . $year . '-' . $FOLIOID . "&year=" . $year . "&delito=" . $data->delito . "&descripcion=" . $data->descripcion . "&idioma=" . $data->idioma . "&edad=" . $data->edad . "&perfil=" . $data->perfil . "&sexo=" . $data->sexo . "&prioridad=" . $prioridad . "&sexo_denunciante=" . $sexo_denunciante;

			if ($this->_sendEmailFolio($session->get('CORREO'), $FOLIOID, $year)) {
				return redirect()->to(base_url($url));
			} else {
				return redirect()->to(base_url($url));
			}
		} else {
			return redirect()->to(base_url('/denuncia/dashboard'))->with('message_error', 'Hubo un error, llena todo correctamente y no subas documentos e imagenes muy grandes.');
		}
	}

	private function _folioUpdate($id, $data, $year)
	{
		$this->_folioModel->set($data)->where('FOLIOID', $id)->where('ANO', $year)->update();
	}

	/**
	 * Función para insertar las preguntas iniciales
	 *
	 * @param  mixed $data
	 * @param  mixed $folio
	 * @param  mixed $year
	 */
	private function _folioPreguntasIniciales($data, $folio, $year)
	{
		$data = (object) $data;
		$datos = [
			'FOLIOID' => $folio,
			'ANO' => $year,
			'ES_MENOR' => $data->ES_MENOR,
			'ES_TERCERA_EDAD' => $data->ES_TERCERA_EDAD,
			'ES_OFENDIDO' => $data->ES_OFENDIDO,
			'TIENE_DISCAPACIDAD' => $data->TIENE_DISCAPACIDAD,
			'FUE_CON_ARMA' => $data->FUE_CON_ARMA,
			'LESIONES' => $data->LESIONES,
			'LESIONES_VISIBLES' => $data->LESIONES_VISIBLES,
			'ES_GRUPO_VULNERABLE' => $data->ES_GRUPO_VULNERABLE,
			'ES_GRUPO_VULNERABLE_DESCR' => $data->ES_GRUPO_VULNERABLE_DESCR,
			'ESTA_DESAPARECIDO' => $data->ESTA_DESAPARECIDO,
		];
		$this->_folioPreguntasModel->insert($datos);
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
	 * Funcion para insertar los parentesco de las personas fisicas
	 *
	 * @param  mixed $data
	 * @param  mixed $folio
	 * @param  mixed $personaFisicaID1
	 * @param  mixed $personaFisicaID2
	 * @param  mixed $year
	 */
	private function _parentescoPersonaFisica($data, $folio, $personaFisicaID1, $personaFisicaID2, $year)
	{
		$data = $data;
		$data['FOLIOID'] = $folio;
		$data['ANO'] = $year;
		$data['PERSONAFISICAID1'] = $personaFisicaID1;
		$data['PERSONAFISICAID2'] = $personaFisicaID2;

		$this->_parentescoPersonaFisicaModel->insert($data);
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
	 * Funcion para mandar el folio generado por email o sms al denunciante
	 *
	 * @param  mixed $to
	 * @param  mixed $folio
	 * @param  mixed $year
	 */
	private function _sendEmailFolio($to, $folio, $year)
	{
		$user = $this->_denunciantesModelRead->asObject()->where('CORREO', $to)->first();

		// $email = \Config\Services::email();
		// $email->setTo($to);
		// $email->setSubject('Nuevo folio generado.');
		// $body = view('email_template/folio_email_template.php', ['folio' => $folio . '/' . $year]);
		// $email->setAltMessage('Se ha generado un nuevo folio. SU FOLIO ES: ' . $folio . '/' . $year .' Para darle seguimiento a su caso ingrese a su cuenta en el Centro de Denuncia Tecnológica e inicie su video denuncia con el folio generado.' );
		$sendSMS = $this->sendSMS("Nuevo folio generado", $user->TELEFONO, 'Notificaciones FGE/Estimado usuario, tu folio es: ' . $folio . '/' . $year);

		// $email->setMessage($body);

		// if ($email->send()) {
		if ($sendSMS == "") {
			return true;
		} else {
			return false;
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
	 * @param  mixed $menu
	 * @param  mixed $submenu
	 * @param  mixed $data
	 * @param  mixed $view
	 */
	private function _loadView($title, $menu, $submenu, $data, $view)
	{
		$data2 = [
			'header_data' => (object) ['title' => $title, 'menu' => $menu, 'submenu' => $submenu],
			'body_data' => $data,
		];

		echo view("client/dashboard/$view", $data2);
	}

	/**
	 * Funcion para obtener el link de una denuncia al hacer click sobre el boton (cuando hay folios abiertos en el denunciante)
	 * Se obtiene por metodo POST el folio,año y id del denunciante
	 *
	 */
	public function getLinkVideodenuncia()
	{
		$folioId = $this->request->getPost('folio');
		$denuncianteId = $this->request->getPost('id');
		$year = $this->request->getPost('year');
		//Info del folio
		$folio = $this->_folioModelRead->asObject()->where('FOLIOID', $folioId,)->where('ANO', $year)->where('STATUS', 'ABIERTO')->where('DENUNCIANTEID', $denuncianteId)->first();

		if ($folioId && $folio && $denuncianteId && $year) {

			//Info de la denuncia
			$preguntas = $this->_folioPreguntasModelRead->asObject()->where('FOLIOID', $folioId)->where('ANO', $year)->first();
			$denunciante = $this->_denunciantesModelRead->asObject()->where('DENUNCIANTEID', $denuncianteId)->first();
			$idioma = $this->_personaIdiomaModelRead->asObject()->where('PERSONAIDIOMAID', $denunciante->IDIOMAID)->first();
			$delito = $this->_delitosUsuariosModelRead->asObject()->where('DELITO', $folio->HECHODELITO)->first();
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
			$sexoDenunciante = $denunciante->SEXO;
			//Prioridad de la denuncia
			$prioridad = 1;

			if ($preguntas) {
				if ($preguntas->ES_MENOR == 'SI' || $preguntas->ES_TERCERA_EDAD == 'SI' || $preguntas->TIENE_DISCAPACIDAD == 'SI' || $preguntas->FUE_CON_ARMA == 'SI' || $preguntas->ESTA_DESAPARECIDO == 'SI') {
					$prioridad = 3;
				} else {
					$prioridad = $delito->IMPORTANCIA;
				}
			}

			//Datos del lik de la denuncia
			$data = (object) [
				'delito' => $folio->HECHODELITO,
				'descripcion' => $folio->HECHONARRACION,
				'idioma' => $idioma->PERSONAIDIOMADESCR ? $idioma->PERSONAIDIOMADESCR : 'DESCONOCIDO',
				'edad' => $edad,
				'perfil' => $folio->HECHODELITO == 'VIOLENCIA FAMILIAR' ? 1 : 0,
				'sexo' => $folio->HECHODELITO == 'VIOLENCIA FAMILIAR' ? 2 : 0,
				'sexo_denunciante' => $sexoDenunciante == 'F' ? 'FEMENINO' : 'MASCULINO',
			];

			$url = base_url() . "/denuncia/dashboard/video-denuncia?folio=" . $year . '-' . $folioId . "&year=" . $year . "&delito=" . $data->delito . "&descripcion=" . $data->descripcion . "&idioma=" . $data->idioma . "&edad=" . $data->edad . "&perfil=" . $data->perfil . "&sexo=" . $data->sexo . "&prioridad=" . $prioridad . "&sexo_denunciante=" . $data->sexo_denunciante;

			return json_encode((object) ['status' => 1, 'url' => $url]);
		} else {
			$url = base_url() . "/denuncia/dashboard";
			return json_encode((object) ['status' => 1, 'url' => $url]);
		}
	}
	/**
	 * Funcion para obtener el catalogo de marcas dependiendo del distribuidor del vehiculo
	 * Recibe por metodo POST el distribuidor
	 *
	 */
	public function getMarcaByDist()
	{
		$distribuidor = trim($this->request->getPost('distribuidor_vehiculo'));
		$marca = $this->_vehiculoMarcaModelRead->asObject()->where('VEHICULODISTRIBUIDORID', $distribuidor)->findAll();
		return json_encode((object) ['data' => $marca]);
	}
	/**
	 * Funcion para obtener el catalogo de modelos dependiendo del distribuidor del vehiculo y la marca
	 * Recibe por metodo POST el distribuidor y la marca
	 *
	 */
	public function getModeloByMarca()
	{
		$distribuidor = trim($this->request->getPost('dist'));
		$marca = trim($this->request->getPost('marca'));
		$modelo = $this->_vehiculoModeloModelRead->asObject()->where('VEHICULODISTRIBUIDORID', $distribuidor)->where('VEHICULOMARCAID', $marca)->findAll();
		return json_encode((object) ['data' => $modelo]);
	}
	/**
	 * Funcion para obtener el catalogo de versio  dependiendo del distribuidor del vehiculo, marca y modelo
	 * Recibe por metodo POST el distribuidor, marca y modelo
	 *
	 */
	public function getVersionByModelo()
	{
		$distribuidor = trim($this->request->getPost('dist'));
		$marca = trim($this->request->getPost('marca'));
		$modelo = trim($this->request->getPost('linea_vehiculo'));
		$version = $this->_vehiculoVersionModelRead->asObject()->where('VEHICULODISTRIBUIDORID', $distribuidor)->where('VEHICULOMARCAID', $marca)->where('VEHICULOMODELOID', $modelo)->findAll();
		return json_encode((object) ['data' => $version]);
	}

	/**
	 * Funcion para tomar un arreglo como parámetro y muestra por pantalla el contenido del arreglo
	 * ! Deprecated method, do not use.

	 * @param  mixed $array
	 */
	private function imprimirArray($array)
	{
		foreach ($array as $key => $value) {
			var_dump($key . ' = ' . $array[$key]);
			echo '<br>';
		}
		echo '<br>';
		echo '<br>';
	}

	/**
	 * Vista de perfil, carga los datos del denunciante en la vista
	 *
	 */
	public function profile()
	{
		$data = (object) array();
		$data->user = $this->_denunciantesModelRead->asObject()->where('DENUNCIANTEID', session('DENUNCIANTEID'))->first();
		$this->_loadView('Perfil', '', '', $data, 'perfil/perfil');
	}

	/**
	 * Funcion para actualizar el perfil del denunciante.
	 * El formulario es recibido por metodo POST
	 *
	 */
	public function update_profile()
	{
		$session = session();
		$data = [
			'NOMBRE' => $this->request->getPost('nombre'),
			'APELLIDO_PATERNO' => $this->request->getPost('apellido_paterno'),
			'APELLIDO_MATERNO' => $this->request->getPost('apellido_materno'),
			'TELEFONO' => $this->request->getPost('telefono'),
			'TELEFONO2' => $this->request->getPost('telefono2'),
			'FECHANACIMIENTO' => $this->request->getPost('fecha_nacimiento'),
			'SEXO' => $this->request->getPost('sexo'),
		];
		$update = $this->_denunciantesModel->set($data)->where('DENUNCIANTEID', session('DENUNCIANTEID'))->update();
		if ($update) {
			$session->set('NOMBRE', $data['NOMBRE']);
			$session->set('APELLIDO_PATERNO', $data['APELLIDO_PATERNO']);
			$session->set('APELLIDO_MATERNO', $data['APELLIDO_MATERNO']);
			$session->set('TELEFONO', $data['TELEFONO']);
			$session->set('TELEFONO2', $data['TELEFONO2']);
			$session->set('FECHANACIMIENTO', $data['FECHANACIMIENTO']);
			$session->set('SEXO', $data['SEXO']);
			return redirect()->back()->with('message_success', 'Actualizado correctamente.');
		}
		return redirect()->back()->with('message_error', 'No se pudo actualizar el registro.');
	}

	/**
	 * Función para actualizar la contraseña del denunciante
	 * Se recibe la contraseña por metodo POST
	 *
	 */
	public function update_password()
	{
		$password = trim($this->request->getPost('password'));
		$data = [
			'PASSWORD' => hashPassword($password),
		];
		$this->_denunciantesModel->set($data)->where('DENUNCIANTEID', session('DENUNCIANTEID'))->update();

		return redirect()->back()->with('message_success', 'Contraseña actualizada correctamente');
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
		// var_dump($data);exit;
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
	 * Función CURL POST a Justicia sin encriptacion
	 *
	 * @param  mixed $endpoint
	 * @param  mixed $data
	 */
	private function _curlPost($endpoint, $data)
	{
		$ch = curl_init();

		curl_setopt($ch, CURLOPT_URL, $endpoint);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
		$headers = array(
			'Content-Type: application/json',
			'Access-Control-Allow-Origin: *',
			'Access-Control-Allow-Credentials: true',
			'Access-Control-Allow-Headers: Content-Type',
			'X-API-KEY:' . X_API_KEY
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

		return json_decode($result);
	}
}

/* End of file DashboardController.php */
/* Location: ./app/Controllers/client/DashboardController.php */
