<?php

namespace App\Controllers\client;

use App\Controllers\BaseController;

use App\Models\DenunciantesModel;
use App\Models\EstadosModel;
use App\Models\MunicipiosModel;
use App\Models\LocalidadesModel;
use App\Models\ColoniasModel;
use App\Models\Datos_adultoModel;
use App\Models\FolioDenunciaModel;
use App\Models\HechoLugarModel;
use App\Models\FoliosAtencionModel;
use App\Models\VehiculoColorModel;
use App\Models\VehiculoMarcaModel;
use App\Models\VehiculoModeloModel;
use App\Models\VehiculoTipoModel;
use App\Models\PaisesModel;
use App\Models\DelitosUsuariosModel;
use App\Models\PersonaIdiomaModel;

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
		$this->_datosdeldelitoModel = new FolioDenunciaModel();
		$this->_datosdeladultoModel = new Datos_adultoModel();
		$this->_hechoLugarModel = new HechoLugarModel();
		$this->_foliosAtencionModel = new FoliosAtencionModel();
		$this->_coloresVehiculoModel = new VehiculoColorModel();
		$this->_marcaVehiculoModel = new VehiculoMarcaModel();
		$this->_lineaVehiculoModel = new VehiculoModeloModel();
		$this->_tipoVehiculoModel = new VehiculoTipoModel();
		$this->_delitosUsuariosModel = new DelitosUsuariosModel();
		$this->_denunciantesModel = new DenunciantesModel();
		$this->_personaIdiomaModel = new PersonaIdiomaModel();

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
		$data = (object)array();
		$data->paises = $this->_paisesModel->asObject()->findAll();
		$data->estados = $this->_estadosModel->asObject()->findAll();
		$data->municipios = $this->_municipiosModel->asObject()->where('ESTADOID', '2')->findAll();
		$data->localidades = $this->_localidadesModel->asObject()->findAll();
		$data->colonias = $this->_coloniasModel->asObject()->findAll();
		$data->lugares = $this->_hechoLugarModel->asObject()->orderBy('HECHODESCR', 'asc')->findAll();
		$data->colorVehiculo = $this->_coloresVehiculoModel->asObject()->findAll();
		$data->marcaVehiculo = $this->_marcaVehiculoModel->asObject()->orderBy('VEHICULOMARCADESCR', 'ASC')->findAll();
		$data->lineaVehiculo = $this->_lineaVehiculoModel->asObject()->orderBy('VEHICULOMODELODESCR', 'ASC')->findAll();
		$data->tipoVehiculo = $this->_tipoVehiculoModel->asObject()->orderBy('VEHICULOTIPODESCR', 'ASC')->findAll();
		$data->delitosUsuarios = $this->_delitosUsuariosModel->asObject()->orderBy('DELITO', 'ASC')->findAll();
		$this->_loadView('Dashboard', 'dashboard', '', $data, 'index');
	}

	public function video_denuncia()
	{
		$data = (object)[
			'folio' => $this->request->getGet('folio'),
			'delito' => $this->request->getGet('delito'),
			'descripcion' => $this->request->getGet('descripcion'),
			'idioma' => $this->request->getGet('idioma'),
			'edad' => $this->request->getGet('edad'),
			'perfil' => $this->request->getGet('perfil'),
			'sexo' => $this->request->getGet('sexo'),
			'prioridad' => $this->request->getGet('prioridad'),
		];

		if ($data->folio) {
			$this->_loadView('Video denuncia', 'video-denuncia', '', $data, 'video_denuncia');
		} else {
			return redirect()->back();
		}
	}

	public function denuncias()
	{
		$session = session();
		$data = (object)array();
		$data->folios = $this->_folioModel->asObject()->where('DENUNCIANTEID', $session->get('ID_DENUNCIANTE'))->findAll();
		$this->_loadView('Mis denuncias', 'denuncias', '', $data, 'lista_denuncias');
	}

	public function create()
	{
		$session = session();

		$FOLIOID = $this->_correlativo($this->request->getPost('municipio'), 4);
		$CORRELATIVO = (int)substr($FOLIOID, -5);

		$dataFolio = [
			'DENUNCIANTEID' => $session->get('ID_DENUNCIANTE'),
			'STATUS' => 'ABIERTO',
			'ESTADOID' => 2,
			'ANO' => (int)date("Y"),
			'MUNICIPIOID' => $this->request->getPost('municipio'),
			'CORRELATIVO' => $CORRELATIVO,
			'HECHOFECHA' => $this->request->getPost('fecha'),
			'HECHOHORA' => $this->request->getPost('hora'),
			'HECHOLUGARID' => $this->request->getPost('lugar'),
			'HECHOESTADOID' => 2,
			'HECHOMUNICIPIOID' => $this->request->getPost('municipio'),
			'HECHOCOLONIAID' => $this->request->getPost('colonia_select'),
			'HECHOCOLONIADESCR' => $this->request->getPost('colonia'),
			'HECHOCALLE' => $this->request->getPost('calle'),
			'HECHONUMEROCASA' => $this->request->getPost('exterior'),
			'HECHONUMEROCASAINT' => $this->request->getPost('interior'),
			'HECHONARRACION' => $this->request->getPost('descripcion_breve'),
			'TIPOEXPEDIENTEID' => 4,
			'DELITODENUNCIA' => $this->request->getPost('delito')
		];

		$dataPreguntas = array(
			'ES_MENOR' => $this->request->getPost('es_menor'),
			'ERES_TU' => $this->request->getPost('eres_tu'),
			'ES_TERCERA_EDAD' => $this->request->getPost('es_tercera_edad'),
			'TIENE_DISCAPACIDAD' => $this->request->getPost('tiene_discapacidad'),
			'FUE_CON_ARMA' => $this->request->getPost('fue_con_arma'),
			'ESTA_DESAPARECIDO' => $this->request->getPost('esta_desaparecido'),
			'LESIONES' => $this->request->getPost('lesiones'),
			'LESIONES_VISIBLES' => $this->request->getPost('lesiones_visibles'),
		);

		$dataImputado = array(
			'NOMBRE' => $this->request->getPost('nombre_imputado'),
			'PRIMERAPELLIDO' => $this->request->getPost('primer_apellido_imputado'),
			'SEGUNDOAPELLIDO' => $this->request->getPost('segundo_apellido_imputado'),
			'APODO' => $this->request->getPost('alias_imputado'),
			'MUNICIPIOORIGENID' => $this->request->getPost('municipio_imputado'),
			'TELEFONO' => $this->request->getPost('tel_imputado'),
			'FECHA_NACIMIENTO' => $this->request->getPost('fecha_nac_imputado'),
			'SEXO' => $this->request->getPost('sexo_imputado'),
			'ESCOLARIDAD' => $this->request->getPost('escolaridad_imputado'),
			'DESCRIPCION_FISICA' => $this->request->getPost('description_fisica_imputado'),
		);

		$dataImputadoDomicilio = array(
			'CALLE' => $this->request->getPost('calle_imputado'),
			'NO_EXT' => $this->request->getPost('numero_ext_imputado'),
			'NO_INT' => $this->request->getPost('numero_int_imputado'),
		);

		$this->_folio($dataFolio, $FOLIOID);
		$this->_folioPreguntasIniciales($dataPreguntas, $FOLIOID);
		$imputadoId = $this->_folioPersonaFisica($dataImputado, $FOLIOID, 2);
		$this->_folioPersonaFisicaDomicilio($dataImputadoDomicilio, $FOLIOID, $imputadoId);

		$session = session();
		$denunciante = $this->_denunciantesModel->asObject()->where('ID_DENUNCIANTE', $session->get('ID_DENUNCIANTE'))->first();

		$dataOfendido = array(
			'NOMBRE' => $denunciante->NOMBRE,
			'PRIMERAPELLIDO' => $denunciante->APELLIDO_PATERNO,
			'SEGUNDOAPELLIDO' => $denunciante->APELLIDO_MATERNO,
			'FECHANACIMIENTO' => $denunciante->FECHA_NACIMIENTO,
			'EDAD' => $denunciante->EDAD,
			'EDADCANTIDAD' => $denunciante->EDAD,
			'SEXO' => $denunciante->SEXO,
			'TELEFONO' => $denunciante->TELEFONO,
			'TELEFONO2' => $denunciante->TELEFONO2,
			'CODIGOPAISTEL' => $denunciante->CODIGOPAIS,
			'CODIGOPAISTEL2' => $denunciante->CODIGOPAIS2,
			'CORREO' => $denunciante->CORREO,
			'TIPOIDENTIFICACIONID' => $denunciante->TIPO_DE_IDENTIFICACION,
			'NUMEROIDENTIFICACION' => $denunciante->NUMERO_DE_IDENTIFICACION,
			'NACIONALIDADID' => $denunciante->NACIONALIDAD_ID,
			'PERSONAIDIOMAID' => $denunciante->IDIOMA_ID,
			'ESCOLARIDAD' => $denunciante->ESCOLARIDAD,
			'ESTADOCIVILID' => $denunciante->ESTADO_CIVIL,
			'ESTADOORIGENID' => $denunciante->ESTADO_ID,
			'MUNICIPIOORIGENID' => $denunciante->MUNICIPIO_ID,
		);

		$dataOfendidoDomicilio = array(
			'PAIS' => $denunciante->CODIGO_PAIS,
			'ESTADOID' => $denunciante->ESTADO_ID,
			'MUNICIPIOID' => $denunciante->MUNICIPIO_ID,
			'LOCALIDADID' => $denunciante->LOCALIDAD_ID,
			'COLONIAID' => $denunciante->COLONIA,
			'COLONIADESCR' => $denunciante->COLONIA,
			'CALLE' => $denunciante->CALLE,
			'NUMEROCASA' => $denunciante->NUM_EXT,
			'NUMEROINTERIOR' => $denunciante->NUM_INT,
			'CP' => $denunciante->CODIGO_POSTAL,
		);

		$menor = $this->_folioPersonaFisica($dataOfendido, $FOLIOID, 1);
		$this->_folioPersonaFisicaDomicilio($dataOfendidoDomicilio, $FOLIOID, $menor);

		if ($this->request->getPost('eres_tu') == "SI") {
			$dataAdulto = array(
				//DATOS ADULTO
				'NOMBRE' => $this->request->getPost('nombre_adulto'),
				'PRIMERAPELLIDO' => $this->request->getPost('ape_paterno_adulto'),
				'SEGUNDOAPELLIDO' => $this->request->getPost('ape_materno_adulto'),
				'FECHA_NACIMIENTO' => $this->request->getPost('fecha_nac_adulto'),
				'EDAD' => $this->request->getPost('edad_adulto'),
				'EDADCANTIDAD' => $this->request->getPost('edad_adulto'),
				'SEXO' => $this->request->getPost('sexo_adulto')
			);

			$dataAdultoDomicilio = array(
				'PAIS' => $this->request->getPost('pais_adulto'),
				'ESTADOID' => $this->request->getPost('estado_adulto'),
				'MUNICIPIOID' => $this->request->getPost('municipio_adulto'),
				'CALLE' => $this->request->getPost('calle_adulto'),
				'NUMEROCASA' => $this->request->getPost('numero_ext_adulto'),
				'NUMEROINTERIOR' => $this->request->getPost('numero_int_adulto'),
				'CP' => $this->request->getPost('cp_adulto'),
			);

			$adulto = $this->_folioPersonaFisica($dataAdulto, $FOLIOID, 4);
			$this->_folioPersonaFisicaDomicilio($dataAdultoDomicilio, $FOLIOID, $adulto);
		}

		if ($this->request->getPost('es_menor') === "SI" && $this->request->getPost('eres_tu') === "NO") {

			$dataMenor = array(
				'NOMBRE' => $this->request->getPost('nombre_menor'),
				'PRIMERAPELLIDO' => $this->request->getPost('apellido_paterno_menor'),
				'SEGUNDOAPELLIDO' => $this->request->getPost('apellido_materno_menor'),
				'FECHA_NACIMIENTO' => $this->request->getPost('fecha_nacimiento_menor'),
				'EDAD' => $this->request->getPost('edad_menor'),
				'EDADCANTIDAD' => $this->request->getPost('edad_menor'),
				'SEXO' => $this->request->getPost('sexo_menor')
			);

			$dataMenorDomicilio = array(
				'PAIS' => $this->request->getPost('pais_menor'),
				'ESTADOID' => $this->request->getPost('estado_menor'),
				'MUNICIPIOID' => $this->request->getPost('municipio_menor'),
				'COLONIAID' => $this->request->getPost('colonia_menor_select'),
				'COLONIADESCR' => $this->request->getPost('colonia_menor'),
				'CALLE' => $this->request->getPost('calle_menor'),
				'NUMEROCASA' => $this->request->getPost('numero_ext_menor'),
				'NUMEROINTERIOR' => $this->request->getPost('numero_int_menor'),
				'CP' => $this->request->getPost('cp_menor'),
			);

			$menor = $this->_folioPersonaFisica($dataMenor, $FOLIOID, 6);
			$this->_folioPersonaFisicaDomicilio($dataMenorDomicilio, $FOLIOID, $menor);
		}

		if ($this->request->getPost('esta_desaparecido')  == "SI") {
			$dataDesaparecido = array(
				// PERSONA DESAPARECIDA
				'NOMBRE' => $this->request->getPost('nombre_des'),
				'PRIMERAPELLIDO' => $this->request->getPost('apellido_paterno_des'),
				'SEGUNDOAPELLIDO' => $this->request->getPost('apellido_materno_des'),
				'ESTATURA' => $this->request->getPost('estatura_des'),
				'FECHANACIMIENTO' => $this->request->getPost('fecha_nacimiento_des'),
				'EDAD' => $this->request->getPost('edad_des'),
				'EDADCANTIDAD' => $this->request->getPost('edad_des'),
				'PESO' => $this->request->getPost('peso_des'),
				'COMPLEXION' => $this->request->getPost('complexion_des'),
				'COLOR_TEZ' => $this->request->getPost('color_des'),
				'SEXO' => $this->request->getPost('sexo_des'),
				'SENAS' => $this->request->getPost('señas_des'),
				'IDENTIDAD' => $this->request->getPost('identidad_des'),
				'COLOR_CABELLO' => $this->request->getPost('color_cabello_des'),
				'TAM_CABELLO' => $this->request->getPost('tam_cabello_des'),
				'FORMA_CABELLO' => $this->request->getPost('form_cabello_des'),
				'COLOR_OJOS' => $this->request->getPost('color_ojos_des'),
				'FRENTE' => $this->request->getPost('frente_des'),
				'CEJA' => $this->request->getPost('ceja_des'),
				'DISCAPACIDAD' => $this->request->getPost('discapacidad_des'),
				'ORIGEN' => $this->request->getPost('origen_des'),
				'DIA_DESAPARICION' => $this->request->getPost('dia_des'),
				'LUGAR_DESAPARICION' => $this->request->getPost('lugar_des'),
				'VESTIMENTA' => $this->request->getPost('vestimenta_des'),
				'PARENTESCO' => $this->request->getPost('parentesco_des'),
				'FOTO' => $this->request->getPost('foto_des'),
				'AUTORIZA_FOTO' => $this->request->getPost('autorization_photo_des'),
				'DESAPARECIDA' => 'S',
			);
			var_dump($dataPreguntas);
			echo '<br><br><br>';
			var_dump($dataDesaparecido);
			echo '<br><br><br>';
			var_dump($dataMenor);
			echo '<br><br><br>';
			$desaparecido = $this->_folioPersonaFisica($dataDesaparecido, $FOLIOID, 1);
			$this->_folioPersonaFisicaDesaparecida($dataDesaparecido, $FOLIOID, $desaparecido);
		}

		if ($this->request->getPost('delito') == "ROBO DE VEHÍCULO" || $this->request->getPost('delito') == "ROBO DE VEHÍCULO CON VIOLENCIA") {
			$dataVehiculo = array(
				'TIPOPLACA' => $this->request->getPost('tipo_placas_vehiculo'),
				'PLACAS' => $this->request->getPost('placas_vehiculo'),
				'ESTADOIDPLACA' => $this->request->getPost('estado_vehiculo'),
				'NUMEROSERIE' => $this->request->getPost('serie_vehiculo'),
				'VEHICULODISTRIBUIDORID' => $this->request->getPost('distribuidor_vehiculo'),
				'MARCAID' => $this->request->getPost('marca'),
				'LINEA' => $this->request->getPost('linea_vehiculo'),
				'VEHICULOVERSIONID' => $this->request->getPost('version_vehiculo'),
				'TIPO_VEHICULO' => $this->request->getPost('tipo_vehiculo'),
				'VEHICULOSERVICIOID' => $this->request->getPost('servicio_vehiculo'),
				'MODELO' => $this->request->getPost('modelo_vehiculo'),
				'SEGUROVIGENTE' => $this->request->getPost('seguro_vigente_vehiculo'),
				'PRIMERCOLORID' => $this->request->getPost('color_vehiculo'),
				'SEGUNDOCOLORID' => $this->request->getPost('color_tapiceria_vehiculo'),
				'NUMEROCHASIS' => $this->request->getPost('num_chasis_vehiculo'),
				'TRANSMISION' => $this->request->getPost('transmision_vehiculo'),
				'TRACCION' => $this->request->getPost('traccion_vehiculo'),
				'FOTO_VEHICULO' => $this->request->getPost('foto_vehiculo'),
				'SENASPARTICULARES' => $this->request->getPost('description_vehiculo'),
			);
			var_dump($dataVehiculo);
			echo '<br><br><br>';

			$this->_folioVehiculo($dataVehiculo, $FOLIOID);
		}

		$denunciante = $this->_denunciantesModel->asObject()->where('ID_DENUNCIANTE', $session->get('ID_DENUNCIANTE'))->first();
		$idioma = $this->_personaIdiomaModel->asObject()->where('PERSONAIDIOMAID', $denunciante->IDIOMA_ID)->first();
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
			'edad' => $session->get('EDAD'),
			'perfil' => $this->request->getPost('delito') == 'VIOLENCIA FAMILIAR' ? 1 : 0,
			'sexo' => $this->request->getPost('delito') == 'VIOLENCIA FAMILIAR' ? 2 : 0,
		];

		$url = "/denuncia/dashboard/video-denuncia?folio=" . $FOLIOID . "&delito=" . $data->delito . "&descripcion=" . $data->descripcion . "&idioma=" . $data->idioma . "&edad=" . $data->edad . "&perfil=" . $data->perfil . "&sexo=" . $data->sexo . "&prioridad=" . $prioridad;

		if ($this->_sendEmailFolio($session->get('CORREO'), $FOLIOID)) {
			return redirect()->to(base_url($url));
		} else {
			return redirect()->to(base_url($url));
		}
	}


	private function _correlativo($municipio, $tipoExpediente)
	{
		$data = [
			'ESTADOID' => (int)2,
			'MUNICIPIOID' => (int)$municipio,
			'TIPOEXPEDIENTEID' => (int)4,
			'ANO' => (int)date("Y"),
		];

		$correlativo = $this->_folioCorrelativoModel->asObject()->where('ANO', date("Y"))->orderBy('ID', 'desc')->first();

		if ($correlativo) {
			$data = [
				'ESTADOID' => (int)2,
				'MUNICIPIOID' => (int)$municipio,
				'TIPOEXPEDIENTEID' => (int)$tipoExpediente,
				'ANO' => (int)date("Y"),
				'CORRELATIVO' => ((int)$correlativo->CORRELATIVO) + 1
			];
			$this->_folioCorrelativoModel->insert($data);
			return $tipoExpediente . str_pad(2, 2, "0", STR_PAD_LEFT) . str_pad((int)$municipio, 3, "0", STR_PAD_LEFT) . $data['ANO'] . str_pad((int)$data['CORRELATIVO'], 5, "0", STR_PAD_LEFT);
		} else {
			$data = [
				'ESTADOID' => (int)2,
				'MUNICIPIOID' => (int)$municipio,
				'TIPOEXPEDIENTEID' => (int)$tipoExpediente,
				'ANO' => (int)date("Y"),
				'CORRELATIVO' => 1
			];
			$this->_folioCorrelativoModel->insert($data);
			return $tipoExpediente . str_pad(2, 2, "0", STR_PAD_LEFT) . str_pad((int)$municipio, 3, "0", STR_PAD_LEFT) . $data['ANO'] . str_pad((int)$data['CORRELATIVO'], 5, "0", STR_PAD_LEFT);
		}
	}

	private function _folio($data, $folio)
	{
		$data = $data;
		$data['FOLIOID'] = $folio;
		$this->_folioModel->insert($data);
	}

	private function _folioPreguntasIniciales($data, $folio)
	{
		$data = (object)$data;
		$datos = [
			'FOLIOID' => $folio,
			'ES_MENOR' => $data->ES_MENOR,
			'ERES_TU' => $data->ERES_TU,
			'ES_TERCERA_EDAD' => $data->ES_TERCERA_EDAD,
			'TIENE_DISCAPACIDAD' => $data->TIENE_DISCAPACIDAD,
			'FUE_CON_ARMA' => $data->FUE_CON_ARMA,
			'ESTA_DESAPARECIDO' => $data->ESTA_DESAPARECIDO,
			'LESIONES' => $data->LESIONES,
			'LESIONES_VISIBLES' => $data->LESIONES_VISIBLES,
		];
		$this->_folioPreguntasModel->insert($datos);
	}

	private function _folioPersonaFisica($data, $folio, $calidadJuridica)
	{
		$data = $data;
		$data['FOLIOID'] = $folio;
		$data['CALIDADJURIDICAID'] = $calidadJuridica;

		$personaFisica = $this->_folioPersonaFisicaModel->asObject()->where('FOLIOID', $folio)->orderBy('PERSONAFISICAID', 'desc')->first();

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

	private function _folioPersonaFisicaDomicilio($data, $folio, $personaFisicaID)
	{
		$data = $data;
		$data['FOLIOID'] = $folio;
		$data['PERSONAFISICAID'] = $personaFisicaID;

		$personaDomicilio = $this->_folioPersonaFisicaDomicilioModel->asObject()->where('FOLIOID', $folio)->where('PERSONAFISICAID', $personaFisicaID)->orderBy('DOMICILIOID', 'desc')->first();

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

	private function _folioPersonaFisicaDesaparecida($data, $folio, $personaFisicaID)
	{
		$data = $data;
		$data['FOLIOID'] = $folio;
		$data['PERSONAFISICAID'] = $personaFisicaID;

		$this->_folioPersonaFisicaDesaparecidaModel->insert($data);
	}

	private function _folioVehiculo($data, $folio)
	{
		$data = $data;
		$data['FOLIOID'] = $folio;

		$vehiculo = $this->_folioVehiculoModel->asObject()->where('FOLIOID', $folio)->orderBy('VEHICULOID', 'desc')->first();

		if ($vehiculo) {
			$data['VEHICULOID'] = ((int)$vehiculo->VEHICULOID) + 1;
			$this->_folioVehiculoModel->insert($data);
		} else {
			$data['VEHICULOID'] = 1;
			$this->_folioVehiculoModel->insert($data);
		}
	}

	private function _folioPersonaFisicaImputadoDelito($data, $folio)
	{
		$data = [
			'FOLIOID' => $folio,
			'PERSONAFISICAID' => $data->PERSONAFISICAID,
			'DELITOMODALIDADID' => $data->DELITOMODALIDADID,
			'DELITOCARACTERISTICAID' => $data->DELITOCARACTERISTICAID,
			'TENTATIVA' => $data->TENTATIVA,
		];
	}

	private function _folioPersonaFisicaImputado($data, $folio)
	{
		$data = [
			'FOLIOID' => $folio,
			'PERSONAFISICAID' => $data->PERSONAFISICAID,
			'DETENIDO' => $data->DETENIDO,
			'ESTADOJURIDICOIMPUTADOID' => $data->ESTADOJURIDICOIMPUTADOID,
			'ETAPAIMPUTADOID' => $data->ETAPAIMPUTADOID,
			'INDIVIDUALIZADO' => $data->INDIVIDUALIZADO,
		];
	}

	private function _folioRelacionFisicaFisica($data, $folio)
	{
		$data = [
			'FOLIOID' => $folio,
			'PERSONAFISICAIDVICTIMA' => $data->PERSONAFISICAIDVICTIMA,
			'DELITOMODALIDADID' => $data->DELITOMODALIDADID,
			'PERSONAFISICAIDIMPUTADO' => $data->PERSONAFISICAIDIMPUTADO,
			'GRADOPARTICIPACIONID' => $data->GRADOPARTICIPACIONID,
			'TENTATIVA' => $data->TENTATIVA,
			'CONVIOLENCIA' => $data->CONVIOLENCIA,
		];
	}

	private function _folioObjeto($data, $folio)
	{
		$data = [
			'FOLIOID' => $folio,
			'OBJETOID' => $data->OBJETOID,
			'SITUACION' => $data->SITUACION,
			'CLASIFICACIONID' => $data->CLASIFICACIONID,
			'SUBCLASIFICACIONID' => $data->SUBCLASIFICACIONID,
			'MARCA' => $data->MARCA,
			'NUMEROSERIE' => $data->NUMEROSERIE,
			'CANTIDAD' => $data->CANTIDAD,
			'VALOR' => $data->VALOR,
			'TIPOMONEDAID' => $data->TIPOMONEDAID,
			'DESCRIPCION' => $data->DESCRIPCION,
			'DESCRIPCIONDETALLADA' => $data->DESCRIPCIONDETALLADA,
			'PERSONAFISICAIDPROPIETARIO' => $data->PERSONAFISICAIDPROPIETARIO,
			'PERSONAMORALIDPROPIETARIO' => $data->PERSONAMORALIDPROPIETARIO,
			'FOTO' => $data->FOTO,
			'PARTICIPAESTADO' => $data->PARTICIPAESTADO,
		];
	}

	private function _folioArchivosExterno($data, $folio)
	{
		$data = [
			'FOLIOID' => $folio,
			'FOLIOARCHIVOID' => $data->FOLIOARCHIVOID,
			'ARCHIVODESCR' => $data->ARCHIVODESCR,
			'CLASIFICACIONID' => $data->CLASIFICACIONID,
			'ARCHIVO' => $data->ARCHIVO,
			'EXTENSION' => $data->EXTENSION,
			'FECHAACTUALIZACION' => $data->FECHAACTUALIZACION,
			'AUTOR' => $data->AUTOR,
			'OFICINAIDAUTOR' => $data->OFICINAIDAUTOR,
			'CLASIFICACIONDOCTOID' => $data->CLASIFICACIONDOCTOID,
			'ESTADOACCESO' => $data->ESTADOACCESO,
			'PUBLICADO' => $data->PUBLICADO,
			'RUTAALMACENAMIENTOID' => $data->RUTAALMACENAMIENTOID,
			'STATUSALMACENID' => $data->STATUSALMACENID,
			'EXPORTAR' => $data->EXPORTAR,
		];
	}

	private function _folioDocumento($data, $folio)
	{
		$data = [
			'FOLIOID' => $folio,
			'FOLIODOCTOID' => $data->FOLIODOCTOID,
			'DOCTODESCR' => $data->DOCTODESCR,
			'DOCUMENTO' => $data->DOCUMENTO,
			'FECHAIMPRESODEFINITIVA' => $data->FECHAIMPRESODEFINITIVA,
			'CLASIFICACIONDOCTOID' => $data->CLASIFICACIONDOCTOID,
			'AUTOR' => $data->AUTOR,
			'OFICINAIDAUTOR' => $data->OFICINAIDAUTOR,
			'STATUSDOCUMENTOID' => $data->STATUSDOCUMENTOID,
			'PLANTILLAID' => $data->PLANTILLAID,
			'CALIFICACION' => $data->CALIFICACION,
			'ESTADOACCESO' => $data->ESTADOACCESO,
			'EMPLEADORESPONSABLE' => $data->EMPLEADORESPONSABLE,
			'EXPAREAIDRESPONSABLE' => $data->EXPAREAIDRESPONSABLE,
			'EXPEMPIDRESPONSABLE' => $data->EXPEMPIDRESPONSABLE,
			'PUBLICADO' => $data->PUBLICADO,
			'RUTAALMACENAMIENTOID' => $data->RUTAALMACENAMIENTOID,
			'STATUSALMACENID' => $data->STATUSALMACENID,
			'EXPORTAR' => $data->EXPORTAR,
		];
	}

	private function _sendEmailFolio($to, $folio)
	{
		$email = \Config\Services::email();
		$email->setTo($to);
		$email->setFrom('andrea.solorzano@yocontigo-it.com', 'FGEBC');
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
}

/* End of file DashboardController.php */
/* Location: ./app/Controllers/client/DashboardController.php */
