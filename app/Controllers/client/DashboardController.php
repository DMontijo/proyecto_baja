<?php

namespace App\Controllers\client;

use App\Controllers\BaseController;

use App\Models\DenunciantesModel;
use App\Models\EstadosModel;
use App\Models\MunicipiosModel;
use App\Models\LocalidadesModel;
use App\Models\ColoniasModel;
use App\Models\FolioDenunciaModel;
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
		$data->distribuidorVehiculo = $this->_distribuidorVehiculoModel->asObject()->orderBy('VEHICULODISTRIBUIDORDESCR', 'ASC')->findAll();
		$data->versionVehiculo = $this->_versionVehiculoModel->asObject()->orderBy('VEHICULOVERSIONDESCR', 'ASC')->findAll();
		$data->servicioVehiculo = $this->_servicioVehiculoModel->asObject()->orderBy('VEHICULOSERVICIODESCR', 'ASC')->findAll();
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
			'sexo_denunciante' => $this->request->getGet('sexo_denunciante') == 'F' ? 'FEMENINO' : 'MASCULINO',
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
		$CORRELATIVO = (int)substr($FOLIOID, -6);

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
		$this->_folio($dataFolio, $FOLIOID);

		$dataPreguntas = array(
			'ES_MENOR' => $this->request->getPost('es_menor'),
			'ES_TERCERA_EDAD' => $this->request->getPost('es_tercera_edad'),
			'ES_OFENDIDO' => $this->request->getPost('es_ofendido'),
			'TIENE_DISCAPACIDAD' => $this->request->getPost('tiene_discapacidad'),
			'FUE_CON_ARMA' => $this->request->getPost('fue_con_arma'),
			'LESIONES' => $this->request->getPost('lesiones'),
			'LESIONES_VISIBLES' => $this->request->getPost('lesiones_visibles'),
			'ESTA_DESAPARECIDO' => $this->request->getPost('esta_desaparecido'),
		);
		$this->_folioPreguntasIniciales($dataPreguntas, $FOLIOID);

		// foreach ($dataFolio as $key => $value) {
		// 	var_dump($key, $value);
		// 	echo '<br>';
		// }
		// echo '<br>';
		// echo '<br>';
		// foreach ($dataPreguntas as $key => $value) {
		// 	var_dump($key, $value);
		// 	echo '<br>';
		// }

		//DATOS DESAPARECIDO
		if ($this->request->getPost('esta_desaparecido')  == "SI") {
			$dataDesaparecido = array(
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
				'AUTORIZA_FOTO' => $this->request->getPost('autorization_photo_des') == 'on' ? 'S' : 'N',
				'DESAPARECIDA' => 'S',
			);

			$datadataDesaparecidoDomicilio = array(
				'PAIS' => $this->request->getPost('pais_des'),
				'ESTADOID' => $this->request->getPost('estado_des'),
				'MUNICIPIOID' => $this->request->getPost('municipio_des'),
				'COLONIAID' => $this->request->getPost('colonia_des_select'),
				'COLONIADESCR' => $this->request->getPost('colonia_des'),
				'CALLE' => $this->request->getPost('calle_des'),
				'NUMEROCASA' => $this->request->getPost('numero_ext_des'),
				'NUMEROINTERIOR' => $this->request->getPost('numero_int_des'),
				'CP' => $this->request->getPost('cp_des'),
			);

			echo '<br>';
			echo '<br>';
			foreach ($dataDesaparecido as $key => $value) {
				var_dump($key, $value);
				echo '<br>';
			}
			echo '<br>';
			echo '<br>';
			foreach ($datadataDesaparecidoDomicilio as $key => $value) {
				var_dump($key, $value);
				echo '<br>';
			}
			$desaparecido = $this->_folioPersonaFisica($dataDesaparecido, $FOLIOID, 1);
			$this->_folioPersonaFisicaDesaparecida($dataDesaparecido, $FOLIOID, $desaparecido);
			$this->_folioPersonaFisicaDomicilio($datadataDesaparecidoDomicilio, $FOLIOID, $desaparecido);
		}


		//DATOS DEL MENOR DE EDAD
		if ($this->request->getPost('es_menor') === "SI" && $this->request->getPost('esta_desaparecido') === "NO") {

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

			// echo '<br>';
			// echo '<br>';
			// foreach ($dataMenor as $key => $value) {
			// 	var_dump($key, $value);
			// 	echo '<br>';
			// }
			// foreach ($dataMenorDomicilio as $key => $value) {
			// 	var_dump($key, $value);
			// 	echo '<br>';
			// }

			$menor = $this->_folioPersonaFisica($dataMenor, $FOLIOID, 1);
			$this->_folioPersonaFisicaDomicilio($dataMenorDomicilio, $FOLIOID, $menor);
		}

		//DATOS DEL DENUNCIANTE
		$denunciante = $this->_denunciantesModel->asObject()->where('ID_DENUNCIANTE', $session->get('ID_DENUNCIANTE'))->first();

		$dataDenunciante = array(
			'NOMBRE' => $denunciante->NOMBRE,
			'PRIMERAPELLIDO' => $denunciante->APELLIDO_PATERNO,
			'SEGUNDOAPELLIDO' => $denunciante->APELLIDO_MATERNO,
			'FECHANACIMIENTO' => $denunciante->FECHA_DE_NACIMIENTO,
			'EDAD' => $denunciante->EDAD,
			'EDADCANTIDAD' => $denunciante->EDAD,
			'SEXO' => $denunciante->SEXO,
			'TELEFONO' => $denunciante->TELEFONO,
			'TELEFONO2' => $denunciante->TELEFONO2,
			'CODIGOPAISTEL' => $denunciante->CODIGO_PAIS,
			'CODIGOPAISTEL2' => $denunciante->CODIGO_PAIS2,
			'CORREO' => $denunciante->CORREO,
			'TIPOIDENTIFICACIONID' => $denunciante->TIPO_DE_IDENTIFICACION,
			'NUMEROIDENTIFICACION' => $denunciante->NUMERO_DE_IDENTIFICACION,
			'NACIONALIDADID' => $denunciante->NACIONALIDAD_ID,
			'PERSONAIDIOMAID' => $denunciante->IDIOMAID,
			'ESCOLARIDAD' => $denunciante->ESCOLARIDAD,
			'ESTADOCIVILID' => $denunciante->ESTADO_CIVIL,
			'ESTADOORIGENID' => $denunciante->ESTADOID,
			'MUNICIPIOORIGENID' => $denunciante->MUNICIPIOID,
			'FOTO' => $denunciante->DOCUMENTO,
			'DENUNCIANTE' => 'S', 1
		);

		$dataDenuncianteDomicilio = array(
			'PAIS' => $denunciante->CODIGO_PAIS,
			'ESTADOID' => $denunciante->ESTADOID,
			'MUNICIPIOID' => $denunciante->MUNICIPIOID,
			'LOCALIDADID' => $denunciante->LOCALIDADID,
			'COLONIAID' => $denunciante->COLONIAID,
			'COLONIADESCR' => $denunciante->COLONIA,
			'CALLE' => $denunciante->CALLE,
			'NUMEROCASA' => $denunciante->NUM_EXT,
			'NUMEROINTERIOR' => $denunciante->NUM_INT,
			'CP' => $denunciante->CODIGO_POSTAL,
		);
		// echo '<br>';
		// echo '<br>';
		// foreach ($dataDenunciante as $key => $value) {
		// 	var_dump($key, $value);
		// 	echo '<br>';
		// }
		// foreach ($dataDenuncianteDomicilio as $key => $value) {
		// 	var_dump($key, $value);
		// 	echo '<br>';
		// }
		$denuncianteCalidad = $this->request->getPost('es_menor') == "SI" || $this->request->getPost('esta_desaparecido') == "SI" || $this->request->getPost('es_ofendido') === "NO" ? 3 : 1;
		$denuncinateIdPersona = $this->_folioPersonaFisica($dataDenunciante, $FOLIOID, $denuncianteCalidad);
		$this->_folioPersonaFisicaDomicilio($dataDenuncianteDomicilio, $FOLIOID, $denuncinateIdPersona);

		//DATOS DEL POSIBLE RESPONSABLE
		if (!empty($this->request->getPost('responsable')) && $this->request->getPost('responsable') == 'SI') {
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

			$imputadoId = $this->_folioPersonaFisica($dataImputado, $FOLIOID, 2);
			$this->_folioPersonaFisicaDomicilio($dataImputadoDomicilio, $FOLIOID, $imputadoId);

			// echo '<br>';
			// echo '<br>';
			// foreach ($dataImputado as $key => $value) {
			// 	var_dump($key, $value);
			// 	echo '<br>';
			// }
			// foreach ($dataImputadoDomicilio as $key => $value) {
			// 	var_dump($key, $value);
			// 	echo '<br>';
			// }
		}

		if ($this->request->getPost('delito') == "ROBO DE VEHÍCULO") {
			$dataVehiculo = array(
				'TIPO_VEHICULO' => $this->request->getPost('tipo_vehiculo'),
				'PRIMERCOLORID' => $this->request->getPost('color_vehiculo'),
				'SENASPARTICULARES' => $this->request->getPost('description_vehiculo'),
				'FOTO' => $this->request->getPost('foto_vehiculo'),
				'DOCUMENTO' => $this->request->getPost('foto_vehiculo'),
			);

			// echo '<br>';
			// echo '<br>';
			// foreach ($dataVehiculo as $key => $value) {
			// 	var_dump($key, $value);
			// 	echo '<br>';
			// }
			$this->_folioVehiculo($dataVehiculo, $FOLIOID);
		}

		$denunciante = $this->_denunciantesModel->asObject()->where('ID_DENUNCIANTE', $session->get('ID_DENUNCIANTE'))->first();
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
			'edad' => $session->get('EDAD'),
			'perfil' => $this->request->getPost('delito') == 'VIOLENCIA FAMILIAR' ? 1 : 0,
			'sexo' => $this->request->getPost('delito') == 'VIOLENCIA FAMILIAR' ? 2 : 0,
		];

		$sexo_denunciante = $session->get('SEXO') == 'F' ? 'FEMENINO' : 'MASCULINO';
		$url = "/denuncia/dashboard/video-denuncia?folio=" . $FOLIOID . "&delito=" . $data->delito . "&descripcion=" . $data->descripcion . "&idioma=" . $data->idioma . "&edad=" . $data->edad . "&perfil=" . $data->perfil . "&sexo=" . $data->sexo . "&prioridad=" . $prioridad . "&sexo_denunciante=" . $sexo_denunciante;

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
			return $tipoExpediente . str_pad(2, 2, "0", STR_PAD_LEFT) . str_pad((int)$municipio, 3, "0", STR_PAD_LEFT) . $data['ANO'] . str_pad((int)$data['CORRELATIVO'], 6, "0", STR_PAD_LEFT);
		} else {
			$data = [
				'ESTADOID' => (int)2,
				'MUNICIPIOID' => (int)$municipio,
				'TIPOEXPEDIENTEID' => (int)$tipoExpediente,
				'ANO' => (int)date("Y"),
				'CORRELATIVO' => 1
			];
			$this->_folioCorrelativoModel->insert($data);
			return $tipoExpediente . str_pad(2, 2, "0", STR_PAD_LEFT) . str_pad((int)$municipio, 3, "0", STR_PAD_LEFT) . $data['ANO'] . str_pad((int)$data['CORRELATIVO'], 6, "0", STR_PAD_LEFT);
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
			'ES_TERCERA_EDAD' => $data->ES_TERCERA_EDAD,
			'ES_OFENDIDO' => $data->ES_OFENDIDO,
			'TIENE_DISCAPACIDAD' => $data->TIENE_DISCAPACIDAD,
			'FUE_CON_ARMA' => $data->FUE_CON_ARMA,
			'LESIONES' => $data->LESIONES,
			'LESIONES_VISIBLES' => $data->LESIONES_VISIBLES,
			'ESTA_DESAPARECIDO' => $data->ESTA_DESAPARECIDO,
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
		$FOLIOID = $this->request->getPost('folio');
		$IDDENUNCIANTE = $this->request->getPost('id');
		$EDAD = $this->request->getPost('edad');
		$SEXO_DENUNCIANTE = $this->request->getPost('sexo_denunciante');
		$folio = $this->_folioModel->asObject()->where('FOLIOID', $FOLIOID,)->first();

		if ($FOLIOID && $folio && $EDAD && $IDDENUNCIANTE && $SEXO_DENUNCIANTE) {

			$preguntas = $this->_folioPreguntasModel->asObject()->where('FOLIOID', $FOLIOID)->first();
			$denunciante = $this->_denunciantesModel->asObject()->where('ID_DENUNCIANTE', $IDDENUNCIANTE)->first();
			$idioma = $this->_personaIdiomaModel->asObject()->where('PERSONAIDIOMAID', $denunciante->IDIOMAID)->first();
			$delito = $this->_delitosUsuariosModel->asObject()->where('DELITO', $folio->DELITODENUNCIA)->first();
			$prioridad = 1;

			if ($preguntas->ES_MENOR == 'SI' || $preguntas->ES_TERCERA_EDAD == 'SI' || $preguntas->TIENE_DISCAPACIDAD == 'SI' || $preguntas->FUE_CON_ARMA == 'SI' || $preguntas->ESTA_DESAPARECIDO == 'SI') {
				$prioridad = 3;
			} else {
				$prioridad = $delito->IMPORTANCIA;
			}

			$data = (object)[
				'delito' => $folio->DELITODENUNCIA,
				'descripcion' => $folio->HECHONARRACION,
				'idioma' => $idioma->PERSONAIDIOMADESCR ? $idioma->PERSONAIDIOMADESCR : 'DESCONOCIDO',
				'edad' => $EDAD,
				'perfil' => $folio->DELITODENUNCIA == 'VIOLENCIA FAMILIAR' ? 1 : 0,
				'sexo' => $folio->DELITODENUNCIA == 'VIOLENCIA FAMILIAR' ? 2 : 0,
				'sexo_denunciante' => $SEXO_DENUNCIANTE == 'F' ? 'FEMENINO' : 'MASCULINO',
			];

			$url = base_url() . "/denuncia/dashboard/video-denuncia?folio=" . $FOLIOID . "&delito=" . $data->delito . "&descripcion=" . $data->descripcion . "&idioma=" . $data->idioma . "&edad=" . $data->edad . "&perfil=" . $data->perfil . "&sexo=" . $data->sexo . "&prioridad=" . $prioridad . "&sexo_denunciante=" . $data->sexo_denunciante;

			return json_encode((object)['status' => 1, 'url' => $url]);
		} else {
			return json_encode((object)['status' => 0, 'error' => 'No hay data disponible']);
		}
	}
}

/* End of file DashboardController.php */
/* Location: ./app/Controllers/client/DashboardController.php */
