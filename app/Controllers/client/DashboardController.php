<?php

namespace App\Controllers\client;

use App\Controllers\BaseController;

use App\Models\DenunciantesModel;
use App\Models\EstadosModel;
use App\Models\MunicipiosModel;
use App\Models\LocalidadesModel;
use App\Models\ColoniasModel;
use App\Models\HechoLugarModel;
use App\Models\VehiculoColorModel;
use App\Models\VehiculoTipoModel;
use App\Models\PaisesModel;
use App\Models\DelitosUsuariosModel;
use App\Models\PersonaIdiomaModel;
use App\Models\PersonaNacionalidadModel;

use App\Models\FolioPreguntasModel;
use App\Models\FolioModel;
use App\Models\FolioConsecutivoModel;
use App\Models\FolioPersonaFisicaModel;
use App\Models\FolioPersonaFisicaDomicilioModel;
use App\Models\FolioPersonaFisicaDesaparecidaModel;
use App\Models\FolioVehiculoModel;

use App\Models\CabelloColorModel;
use App\Models\CabelloEstiloModel;
use App\Models\CabelloTamanoModel;
use App\Models\CejaFormaModel;

use App\Models\EscolaridadModel;
use App\Models\FolioPersonaFisicaMediaFiliacionModel;
use App\Models\OcupacionModel;
use App\Models\FiguraModel;
use App\Models\FrenteFormaModel;
use App\Models\OjoColorModel;
use App\Models\ParentescoModel;
use App\Models\PersonaFisicaParentescoModel;
use App\Models\PielColorModel;

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
		$this->_tipoVehiculoModel = new VehiculoTipoModel();
		$this->_delitosUsuariosModel = new DelitosUsuariosModel();
		$this->_denunciantesModel = new DenunciantesModel();
		$this->_personaIdiomaModel = new PersonaIdiomaModel();
		$this->_nacionalidadModel = new PersonaNacionalidadModel();

		$this->_folioModel = new FolioModel();
		$this->_folioConsecutivoModel = new FolioConsecutivoModel();
		$this->_folioPreguntasModel = new FolioPreguntasModel();
		$this->_folioPersonaFisicaModel = new FolioPersonaFisicaModel();
		$this->_folioPersonaFisicaDomicilioModel = new FolioPersonaFisicaDomicilioModel();
		$this->_folioPersonaFisicaDesaparecidaModel = new FolioPersonaFisicaDesaparecidaModel();
		$this->_folioVehiculoModel = new FolioVehiculoModel();
		$this->_folioMediaFiliacion = new FolioPersonaFisicaMediaFiliacionModel();

		$this->_escolaridadModel = new EscolaridadModel();
		$this->_ocupacionModel = new OcupacionModel();

		$this->_cabelloColorModel = new CabelloColorModel();
		$this->_cabelloTamanoModel = new CabelloTamanoModel();
		$this->_cabelloEstiloModel = new CabelloEstiloModel();
		$this->_frenteFormaModel = new FrenteFormaModel();
		$this->_ojoColorModel = new OjoColorModel();
		$this->_cejaFormaModel = new CejaFormaModel();
		$this->_figuraModel = new FiguraModel();
		$this->_pielColorModel = new PielColorModel();
		$this->_parentescoModel = new ParentescoModel();
		$this->_parentescoPersonaFisicaModel = new PersonaFisicaParentescoModel();
	}

	public function index()
	{
		$data = (object)array();
		$data->paises = $this->_paisesModel->asObject()->findAll();
		$data->estados = $this->_estadosModel->asObject()->findAll();
		$data->municipios = $this->_municipiosModel->asObject()->where('ESTADOID', '2')->findAll();
		$data->nacionalidades = $this->_nacionalidadModel->asObject()->findAll();
		$lugares = $this->_hechoLugarModel->orderBy('HECHODESCR', 'ASC')->findAll();

		$lugares_sin = [];
		$lugares_fuego = [];
		$lugares_blanca = [];
		foreach ($lugares as $lugar) {
			if (strpos($lugar['HECHODESCR'], 'ARMA DE FUEGO')) {
				array_push($lugares_fuego, (object)$lugar);
			}
			if (strpos($lugar['HECHODESCR'], 'ARMA BLANCA')) {
				array_push($lugares_blanca, (object)$lugar);
			}
			if (!strpos($lugar['HECHODESCR'], 'ARMA BLANCA') && !strpos($lugar['HECHODESCR'], 'ARMA DE FUEGO')) {
				array_push($lugares_sin, (object)$lugar);
			}
		}
		$data->lugares = [];
		$data->lugares = (object)array_merge($lugares_sin, $lugares_blanca, $lugares_fuego);

		$data->colorVehiculo = $this->_coloresVehiculoModel->asObject()->findAll();
		$data->tipoVehiculo = $this->_tipoVehiculoModel->asObject()->orderBy('VEHICULOTIPODESCR', 'ASC')->findAll();
		$data->delitosUsuarios = $this->_delitosUsuariosModel->asObject()->orderBy('DELITO', 'ASC')->findAll();
		$data->escolaridades = $this->_escolaridadModel->asObject()->findAll();
		$data->ocupaciones = $this->_ocupacionModel->asObject()->findAll();
		$data->figura = $this->_figuraModel->asObject()->findAll();
		$data->cabelloColor = $this->_cabelloColorModel->asObject()->findAll();
		$data->cabelloTamano = $this->_cabelloTamanoModel->asObject()->findAll();
		$data->frenteForma = $this->_frenteFormaModel->asObject()->findAll();
		$data->ojoColor = $this->_ojoColorModel->asObject()->findAll();
		$data->cabelloEstilo = $this->_cabelloEstiloModel->asObject()->findAll();
		$data->cejaForma = $this->_cejaFormaModel->asObject()->findAll();
		$data->pielColor = $this->_pielColorModel->asObject()->findAll();
		$data->parentesco = $this->_parentescoModel->asObject()->findAll();

		$this->_loadView('Dashboard', 'dashboard', '', $data, 'index');
	}

	public function video_denuncia()
	{
		$data = (object)[
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
		];

		$array = explode("-", $data->folio);

		$folio = $this->_folioModel->where('ANO', $data->year)->where('FOLIOID', $array[1])->where('STATUS', 'ABIERTO')->first();

		if ($folio) {
			$this->_loadView('Video denuncia', 'video-denuncia', '', $data, 'video_denuncia');
		} else {
			return redirect()->to(base_url('denuncia/dashboard'));
		}
	}

	public function denuncias()
	{
		$session = session();
		$data = (object)array();
		$data->folios = $this->_folioModel->asObject()->where('DENUNCIANTEID', $session->get('DENUNCIANTEID'))->findAll();
		$this->_loadView('Mis denuncias', 'denuncias', '', $data, 'lista_denuncias');
	}

	public function create()
	{
		$session = session();
		list($FOLIOID, $year) = $this->_folioConsecutivoModel->get_consecutivo();

		$dataFolio = [
			'FOLIOID' => $FOLIOID,
			'ANO' => $year,
			'DENUNCIANTEID' => $session->get('DENUNCIANTEID'),
			'HECHOFECHA' => $this->request->getPost('fecha'),
			'HECHOHORA' => $this->request->getPost('hora'),
			'HECHOLUGARID' => $this->request->getPost('lugar'),
			'ESTADOID' => 2,
			'MUNICIPIOID' => $this->request->getPost('municipio'),
			'HECHOESTADOID' => 2,
			'HECHOMUNICIPIOID' => $this->request->getPost('municipio'),
			'HECHOLOCALIDADID' => $this->request->getPost('localidad'),
			'HECHOCOLONIAID' => $this->request->getPost('colonia_select'),
			'HECHOCOLONIADESCR' => $this->request->getPost('colonia'),
			'HECHOCALLE' => $this->request->getPost('calle'),
			'HECHONUMEROCASA' => $this->request->getPost('exterior'),
			'HECHONUMEROCASAINT' => $this->request->getPost('interior'),
			'HECHONARRACION' => $this->request->getPost('descripcion_breve'),
			'HECHODELITO' => $this->request->getPost('delito')
		];

		if ((int)$this->request->getPost('colonia_select') == 0) {
			$dataFolio['HECHOCOLONIAID'] = NULL;
			$dataFolio['HECHOCOLONIADESCR'] = $this->request->getPost('colonia');
		} else {
			$dataFolio['HECHOCOLONIAID'] = (int)$this->request->getPost('colonia_select');
			$dataFolio['HECHOCOLONIADESCR'] = NULL;
		}
		if ($this->request->getPost('esta_desaparecido')  == "SI") $dataFolio['LOCALIZACIONPERSONA'] = 'S';

		$localidad = $this->_localidadesModel->asObject()->where('ESTADOID', 2)->where('MUNICIPIOID', $dataFolio['HECHOMUNICIPIOID'])->where('LOCALIDADID', $dataFolio['HECHOLOCALIDADID'])->first();
		$localidad ? $dataFolio['HECHOZONA'] = $localidad->ZONA : $dataFolio['HECHOZONA'] = NULL;

		if ($this->_folioModel->save($dataFolio)) {
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

			$this->_folioPreguntasIniciales($dataPreguntas, $FOLIOID, $year);

			
			//DATOS DESAPARECIDO
			if ($this->request->getPost('esta_desaparecido')  == "SI") {

				$foto_des = $this->request->getFile('foto_des');
				$foto_data = NULL;
				if ($foto_des) {
					try {
						$foto_data = file_get_contents($foto_des);
					} catch (\Exception $e) {
						$foto_data = NULL;
					}
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
					'VESTIMENTA' => $this->request->getPost('vestimenta_des'),
					'PARENTESCOID' => $this->request->getPost('parentesco_des'),
					'FACEBOOK' => $this->request->getPost('facebook_des'),
					'INSTAGRAM' => $this->request->getPost('instagram_des'),
					'TWITTER' => $this->request->getPost('twitter_des'),
					'FOTO' => $foto_data,
					'AUTORIZAMEDIOS' => $this->request->getPost('autorization_photo_des') == 'on' ? 'S' : 'N',
					'DESAPARECIDA' => 'S',

					'ESCOLARIDADID' => $this->request->getPost('escolaridad_des'),
					'OCUPACIONID' => $this->request->getPost('ocupacion_des'),
				);
				// var_dump($_POST);
				//  var_dump($dataDesaparecido);
				// exit;

				$dataDesaparecidoDomicilio = array(
					'PAIS' => $this->request->getPost('pais_des'),
					'ESTADOID' => $this->request->getPost('estado_des'),
					'MUNICIPIOID' => $this->request->getPost('municipio_des'),
					'LOCALIDADID' => $this->request->getPost('localidad_des'),
					'COLONIAID' => $this->request->getPost('colonia_des'),
					'COLONIADESCR' => $this->request->getPost('colonia_des_input'),
					'CALLE' => $this->request->getPost('calle_des'),
					'NUMEROCASA' => $this->request->getPost('numero_ext_des'),
					'NUMEROINTERIOR' => $this->request->getPost('numero_int_des'),
					'CP' => $this->request->getPost('cp_des'),
				);

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

				$dataMenorDomicilio = array(
					'PAIS' => $this->request->getPost('pais_menor'),
					'ESTADOID' => $this->request->getPost('estado_menor'),
					'MUNICIPIOID' => $this->request->getPost('municipio_menor'),
					'LOCALIDADID' => $this->request->getPost('localidad_menor'),
					'COLONIAID' => $this->request->getPost('colonia_menor'),
					'COLONIADESCR' => $this->request->getPost('colonia_menor_input'),
					'CALLE' => $this->request->getPost('calle_menor'),
					'NUMEROCASA' => $this->request->getPost('numero_ext_menor'),
					'NUMEROINTERIOR' => $this->request->getPost('numero_int_menor'),
					'CP' => $this->request->getPost('cp_menor'),
				);

				$menor = $this->_folioPersonaFisica($dataMenor, $FOLIOID, 1, $year);
				$this->_folioPersonaFisicaMediaFiliacion($dataMenor, $FOLIOID, $menor, $year);
				$this->_folioPersonaFisicaDomicilio($dataMenorDomicilio, $FOLIOID, $menor, $year);
			}

			if ($this->request->getPost('es_menor') === "NO" && $this->request->getPost('es_ofendido') === "NO" && $this->request->getPost('esta_desaparecido') === "NO") {
				$dataOfendido = array(
					'NOMBRE' => 'QRO',
					'FECHANACIMIENTO' => NULL
				);

				$dataOfendidoDomicilio = array(
					'PAIS' => NULL,
					'ESTADOID' => NULL,
					'MUNICIPIOID' => NULL,
					'LOCALIDADID' => NULL,
					'COLONIAID' => NULL,
					'COLONIADESCR' => NULL,
					'CALLE' => NULL,
					'NUMEROCASA' => NULL,
					'NUMEROINTERIOR' => NULL,
					'CP' => NULL,
				);

				$ofendidoId = $this->_folioPersonaFisica($dataOfendido, $FOLIOID, 1, $year);
				$this->_folioPersonaFisicaMediaFiliacion($dataOfendido, $FOLIOID, $ofendidoId, $year);
				$this->_folioPersonaFisicaDomicilio($dataOfendidoDomicilio, $FOLIOID, $ofendidoId, $year);
			}

			//DATOS DEL DENUNCIANTE
			$denunciante = $this->_denunciantesModel->asObject()->where('DENUNCIANTEID', $session->get('DENUNCIANTEID'))->first();

			$fecha = (object)[
				'day' => date('d', strtotime($denunciante->FECHANACIMIENTO)),
				'month' => date('m', strtotime($denunciante->FECHANACIMIENTO)),
				'year' => date('Y', strtotime($denunciante->FECHANACIMIENTO)),
			];

			$hoy = (object)[
				'day' => date('d'),
				'month' => date('m'),
				'year' => date('Y'),
			];

			$edad = $hoy->year - $fecha->year;
			$m = $hoy->month - $fecha->month;

			if ($m < 0) {
				$edad--;
			} else if ($m == 0) {
				if ($hoy->day < (int)$fecha->day) {
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

			$denuncianteCalidad = $this->request->getPost('es_menor') == "SI" || $this->request->getPost('esta_desaparecido') == "SI" || $this->request->getPost('es_ofendido') === "NO" ? 3 : 1;
			$denuncinateIdPersona = $this->_folioPersonaFisica($dataDenunciante, $FOLIOID, $denuncianteCalidad, $year);
			$this->_folioPersonaFisicaMediaFiliacion($dataDenunciante, $FOLIOID, $denuncinateIdPersona, $year);
			$this->_folioPersonaFisicaDomicilio($dataDenuncianteDomicilio, $FOLIOID, $denuncinateIdPersona, $year);

			if ($this->request->getPost('esta_desaparecido')  == "SI") {
				$this->_parentescoPersonaFisica($dataDesaparecido, $FOLIOID, $denuncinateIdPersona, $desaparecido, $year);
			}

			//DATOS DEL POSIBLE RESPONSABLE
			if (!empty($this->request->getPost('responsable')) && $this->request->getPost('responsable') == 'SI') {
				$dataImputado = array(
					'NOMBRE' => $this->request->getPost('nombre_imputado') ? $this->request->getPost('nombre_imputado') : 'QRR',
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

				$dataImputadoDomicilio = array(
					'PAIS' => $this->request->getPost('pais_imputado'),
					'ESTADOID' => $this->request->getPost('estado_imputado'),
					'MUNICIPIOID' => $this->request->getPost('municipio_imputado'),
					'LOCALIDADID' => $this->request->getPost('localidad_imputado'),
					'COLONIAID' => $this->request->getPost('colonia_imputado'),
					'COLONIADESCR' => $this->request->getPost('colonia_imputado_input'),
					'CALLE' => $this->request->getPost('calle_imputado'),
					'NUMEROCASA' => $this->request->getPost('numero_ext_imputado'),
					'NUMEROINTERIOR' => $this->request->getPost('numero_int_imputado'),
					'CP' => $this->request->getPost('cp_imputado'),
				);

				$imputadoId = $this->_folioPersonaFisica($dataImputado, $FOLIOID, 2, $year);
				$this->_folioPersonaFisicaMediaFiliacion($dataImputado, $FOLIOID, $imputadoId, $year);
				$this->_folioPersonaFisicaDomicilio($dataImputadoDomicilio, $FOLIOID, $imputadoId, $year);
			} else {
				$dataImputado = array(
					'NOMBRE' => 'QRR',
					'FECHANACIMIENTO' => NULL
				);

				$dataImputadoDomicilio = array(
					'PAIS' => NULL,
					'ESTADOID' => NULL,
					'MUNICIPIOID' => NULL,
					'LOCALIDADID' => NULL,
					'COLONIAID' => NULL,
					'COLONIADESCR' => NULL,
					'CALLE' => NULL,
					'NUMEROCASA' => NULL,
					'NUMEROINTERIOR' => NULL,
					'CP' => NULL,
				);

				$imputadoId = $this->_folioPersonaFisica($dataImputado, $FOLIOID, 2, $year);
				$this->_folioPersonaFisicaMediaFiliacion($dataImputado, $FOLIOID, $imputadoId, $year);
				$this->_folioPersonaFisicaDomicilio($dataImputadoDomicilio, $FOLIOID, $imputadoId, $year);
			}

			if ($this->request->getPost('delito') == "ROBO DE VEHÍCULO") {
				$img_file = $this->request->getFile('foto_vehiculo');
				$fotoV = NULL;
				if ($img_file) {
					try {
						$fotoV = file_get_contents($img_file);
					} catch (\Exception $e) {
						$fotoV = NULL;
					}
				}
				$document_file = $this->request->getFile('documento_vehiculo');
				$docV = NULL;
				if ($document_file) {
					try {
						$docV = file_get_contents($document_file);
					} catch (\Exception $e) {
						$docV = NULL;
					}
				}

				$dataVehiculo = array(
					'TIPOID' => $this->request->getPost('tipo_vehiculo'),
					'PRIMERCOLORID' => $this->request->getPost('color_vehiculo'),
					'SENASPARTICULARES' => $this->request->getPost('description_vehiculo'),
					'FOTO' => $fotoV,
					'DOCUMENTO' => $docV
				);

				$this->_folioVehiculo($dataVehiculo, $FOLIOID, $year);
			}

			$denunciante = $this->_denunciantesModel->asObject()->where('DENUNCIANTEID', $session->get('DENUNCIANTEID'))->first();
			$idioma = $this->_personaIdiomaModel->asObject()->where('PERSONAIDIOMAID', $denunciante->IDIOMAID)->first();
			$delito = $this->_delitosUsuariosModel->asObject()->where('DELITO', $this->request->getPost('delito'))->first();
			$prioridad = 1;

			if ($this->request->getPost('es_menor') == 'SI' || $this->request->getPost('es_tercera_edad') == 'SI' || $this->request->getPost('tiene_discapacidad') == 'SI' || $this->request->getPost('fue_con_arma') == 'SI' || $this->request->getPost('esta_desaparecido') == 'SI') {
				$prioridad = 3;
			} else {
				$prioridad = $delito->IMPORTANCIA;
			}

			$data = (object)[
				'delito' => $this->request->getPost('delito'),
				'descripcion' => $this->request->getPost('descripcion_breve'),
				'idioma' => $idioma->PERSONAIDIOMADESCR ? $idioma->PERSONAIDIOMADESCR : 'DESCONOCIDO',
				'edad' => $edad,
				'perfil' => $this->request->getPost('delito') == 'VIOLENCIA FAMILIAR' ? 1 : 0,
				'sexo' => $this->request->getPost('delito') == 'VIOLENCIA FAMILIAR' ? 2 : 0,
			];

			$sexo_denunciante = $denunciante->SEXO == 'F' ? 'FEMENINO' : 'MASCULINO';
			$url = "/denuncia/dashboard/video-denuncia?folio=" . $year . '-' . $FOLIOID . "&year=" . $year . "&delito=" . $data->delito . "&descripcion=" . $data->descripcion . "&idioma=" . $data->idioma . "&edad=" . $data->edad . "&perfil=" . $data->perfil . "&sexo=" . $data->sexo . "&prioridad=" . $prioridad . "&sexo_denunciante=" . $sexo_denunciante;

			if ($this->_sendEmailFolio($session->get('CORREO'), $FOLIOID)) {
				return redirect()->to(base_url($url));
			} else {
				return redirect()->to(base_url($url));
			}
		} else {
			return redirect()->to(base_url('/denuncia/dashboard'));
		}
	}

	private function _folioUpdate($id, $data, $year)
	{
		$this->_folioModel->set($data)->where('FOLIOID', $id)->where('ANO', $year)->update();
	}

	private function _folioPreguntasIniciales($data, $folio, $year)
	{
		$data = (object)$data;
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

	private function _folioPersonaFisica($data, $folio, $calidadJuridica, $year)
	{
		$data = $data;
		$data['FOLIOID'] = $folio;
		$data['ANO'] = $year;
		$data['CALIDADJURIDICAID'] = $calidadJuridica;
		if ($data['FECHANACIMIENTO'] == '' || $data['FECHANACIMIENTO'] == NULL || $data['FECHANACIMIENTO'] == '0000-00-00') {
			$data['FECHANACIMIENTO'] = NULL;
		}

		$personaFisica = $this->_folioPersonaFisicaModel->asObject()->where('FOLIOID', $folio)->where('ANO', $year)->orderBy('PERSONAFISICAID', 'desc')->first();

		if ($personaFisica) {
			$data['PERSONAFISICAID'] = ((int)$personaFisica->PERSONAFISICAID) + 1;
			$personaFisica = $this->_folioPersonaFisicaModel->insert($data);
			return $data['PERSONAFISICAID'];
		} else {
			$data['PERSONAFISICAID'] = 1;
			$personaFisica = $this->_folioPersonaFisicaModel->insert($data);
			return $data['PERSONAFISICAID'];
		}
	}

	private function _folioPersonaFisicaDomicilio($data, $folio, $personaFisicaID, $year)
	{
		$data = $data;
		$data['FOLIOID'] = $folio;
		$data['ANO'] = $year;
		$data['PERSONAFISICAID'] = $personaFisicaID;

		if ((int)$data['COLONIAID'] == 0 || $data['COLONIAID'] == NULL) {
			$data['COLONIAID'] = NULL;
			$data['COLONIADESCR'] = $data['COLONIADESCR'];
		} else {
			$data['COLONIAID'] = $data['COLONIAID'];
			$data['COLONIADESCR'] = NULL;
		}

		if ($data['COLONIAID'] = NULL) {
			$data['LOCALIDADID'] = NULL;
		} else {
			if ($data['MUNICIPIOID']) {
				try {
					$colonia = $this->_coloniasModel->asObject()->where('ESTADOID', 2)->where('MUNICIPIOID', $data['MUNICIPIOID'])->first();
					$colonia ? $data['LOCALIDADID'] = $colonia->LOCALIDADID : $data['LOCALIDADID'] = NULL;
				} catch (\Exception $e) {
					$data['LOCALIDADID'] = NULL;
				}
			} else {
				$data['LOCALIDADID'] = NULL;
			}
		}

		if ($data['LOCALIDADID'] != NULL) {
			if ($data['MUNICIPIOID']) {
				try {
					$localidad = $this->_localidadesModel->asObject()->where('ESTADOID', 2)->where('MUNICIPIOID', $data['MUNICIPIOID'])->where('LOCALIDADID', $data['LOCALIDADID'])->first();
					$localidad ? $data['ZONA'] = $localidad->ZONA : NULL;
				} catch (\Exception $e) {
				}
			}
		}

		$personaDomicilio = $this->_folioPersonaFisicaDomicilioModel->asObject()->where('FOLIOID', $folio)->where('ANO', $year)->where('PERSONAFISICAID', $personaFisicaID)->orderBy('DOMICILIOID', 'desc')->first();

		if ($personaDomicilio) {
			$data['DOMICILIOID'] = ((int)$personaDomicilio->DOMICILIOID) + 1;
			$this->_folioPersonaFisicaDomicilioModel->insert($data);
			return $data['DOMICILIOID'];
		} else {
			$data['DOMICILIOID'] = 1;
			$this->_folioPersonaFisicaDomicilioModel->insert($data);
			return $data['DOMICILIOID'];
		}
	}

	private function _folioPersonaFisicaMediaFiliacion($data, $folio, $personaFisicaID, $year)
	{
		$data = $data;
		$data['FOLIOID'] = $folio;
		$data['ANO'] = $year;
		$data['PERSONAFISICAID'] = $personaFisicaID;
		if (empty($data['FECHADESAPARICION'])) {
			$data['FECHADESAPARICION'] = NULL;
		}

		$this->_folioMediaFiliacion->insert($data);
	}
	private function _parentescoPersonaFisica($data, $folio, $personaFisicaID1, $personaFisicaID2,  $year)
	{
		$data = $data;
		$data['FOLIOID'] = $folio;
		$data['ANO'] = $year;
		$data['PERSONAFISICAID1'] = $personaFisicaID1;
		$data['PERSONAFISICAID2'] = $personaFisicaID2;

		$this->_parentescoPersonaFisicaModel->insert($data);
	}
	private function _folioVehiculo($data, $folio, $year)
	{
		$data = $data;
		$data['FOLIOID'] = $folio;
		$data['ANO'] = $year;

		$vehiculo = $this->_folioVehiculoModel->asObject()->where('FOLIOID', $folio)->where('ANO', $year)->orderBy('VEHICULOID', 'desc')->first();

		if ($vehiculo) {
			$data['VEHICULOID'] = ((int)$vehiculo->VEHICULOID) + 1;
			$this->_folioVehiculoModel->insert($data);
		} else {
			$data['VEHICULOID'] = 1;
			$this->_folioVehiculoModel->insert($data);
		}
	}

	private function _sendEmailFolio($to, $folio)
	{
		$email = \Config\Services::email();
		$email->setTo($to);
		$email->setSubject('Nuevo folio generado.');
		$body = view('email_template/folio_email_template.php', ['folio' => $folio]);
		$email->setMessage($body);

		if ($email->send()) {
			return true;
		} else {
			return false;
		}
	}

	private function _loadView($title, $menu, $submenu, $data, $view)
	{
		$data2 = [
			'header_data' => (object)['title' => $title, 'menu' => $menu, 'submenu' => $submenu],
			'body_data' => $data
		];

		echo view("client/dashboard/$view", $data2);
	}

	public function getLinkVideodenuncia()
	{
		$folioId = $this->request->getPost('folio');
		$denuncianteId = $this->request->getPost('id');
		$year = $this->request->getPost('year');
		$folio = $this->_folioModel->asObject()->where('FOLIOID', $folioId,)->where('ANO', $year)->first();

		if ($folioId && $folio && $denuncianteId && $year) {

			$preguntas = $this->_folioPreguntasModel->asObject()->where('FOLIOID', $folioId)->where('ANO', $year)->first();
			$denunciante = $this->_denunciantesModel->asObject()->where('DENUNCIANTEID', $denuncianteId)->first();
			$idioma = $this->_personaIdiomaModel->asObject()->where('PERSONAIDIOMAID', $denunciante->IDIOMAID)->first();
			$delito = $this->_delitosUsuariosModel->asObject()->where('DELITO', $folio->HECHODELITO)->first();
			$fecha = (object)[
				'day' => date('d', strtotime($denunciante->FECHANACIMIENTO)),
				'month' => date('m', strtotime($denunciante->FECHANACIMIENTO)),
				'year' => date('Y', strtotime($denunciante->FECHANACIMIENTO)),
			];
			$hoy = (object)[
				'day' => date('d'),
				'month' => date('m'),
				'year' => date('Y'),
			];
			$edad = $hoy->year - $fecha->year;
			$m = $hoy->month - $fecha->month;
			if ($m < 0) {
				$edad--;
			} else if ($m == 0) {
				if ($hoy->day < (int)$fecha->day) {
					$edad--;
				}
			}
			$sexoDenunciante = $denunciante->SEXO;
			$prioridad = 1;

			if ($preguntas) {
				if ($preguntas->ES_MENOR == 'SI' || $preguntas->ES_TERCERA_EDAD == 'SI' || $preguntas->TIENE_DISCAPACIDAD == 'SI' || $preguntas->FUE_CON_ARMA == 'SI' || $preguntas->ESTA_DESAPARECIDO == 'SI') {
					$prioridad = 3;
				} else {
					$prioridad = $delito->IMPORTANCIA;
				}
			}

			$data = (object)[
				'delito' => $folio->HECHODELITO,
				'descripcion' => $folio->HECHONARRACION,
				'idioma' => $idioma->PERSONAIDIOMADESCR ? $idioma->PERSONAIDIOMADESCR : 'DESCONOCIDO',
				'edad' => $edad,
				'perfil' => $folio->HECHODELITO == 'VIOLENCIA FAMILIAR' ? 1 : 0,
				'sexo' => $folio->HECHODELITO == 'VIOLENCIA FAMILIAR' ? 2 : 0,
				'sexo_denunciante' => $sexoDenunciante == 'F' ? 'FEMENINO' : 'MASCULINO',
			];

			$url = base_url() . "/denuncia/dashboard/video-denuncia?folio=" . $year . '-' . $folioId . "&year=" . $year . "&delito=" . $data->delito . "&descripcion=" . $data->descripcion . "&idioma=" . $data->idioma . "&edad=" . $data->edad . "&perfil=" . $data->perfil . "&sexo=" . $data->sexo . "&prioridad=" . $prioridad . "&sexo_denunciante=" . $data->sexo_denunciante;

			return json_encode((object)['status' => 1, 'url' => $url]);
		} else {
			return json_encode((object)['status' => 0, 'error' => 'No hay data disponible']);
		}
	}

	private function imprimirArray($array)
	{
		foreach ($array as $key => $value) {
			var_dump($key . ' = ' . $array[$key]);
			echo '<br>';
		}
		echo '<br>';
		echo '<br>';
	}
}

/* End of file DashboardController.php */
/* Location: ./app/Controllers/client/DashboardController.php */
