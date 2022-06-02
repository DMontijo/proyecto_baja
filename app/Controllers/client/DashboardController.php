<?php

namespace App\Controllers\client;

use App\Controllers\BaseController;

use App\Models\EstadosModel;
use App\Models\MunicipiosModel;
use App\Models\LocalidadesModel;
use App\Models\ColoniasModel;
use App\Models\DenunciaModel;
use App\Models\Datos_adultoModel;
use App\Models\Datos_del_delitoModel;
use App\Models\Datos_del_responsableModel;
use App\Models\Datos_desaparecidoModel;
use App\Models\Datos_menorModel;
use App\Models\Datos_vehiculoModel;
use App\Models\HechoLugarModel;
use App\Models\FoliosAtencionModel;


class DashboardController extends BaseController
{
	function __construct()
	{
		//Models
		$this->_estadosModel = new EstadosModel();
		$this->_municipiosModel = new MunicipiosModel();
		$this->_localidadesModel = new LocalidadesModel();
		$this->_coloniasModel = new ColoniasModel();
		$this->_denunciaModel = new DenunciaModel();
		$this->_datosdeldelitoModel = new Datos_del_delitoModel();
		$this->_datosdelresponsableModel = new Datos_del_responsableModel();
		$this->_datosdeladultoModel = new Datos_adultoModel();
		$this->_datosdelmenorModel = new Datos_menorModel();
		$this->_datosdesaparecidoModel = new Datos_desaparecidoModel();
		$this->_datosvehiculoModel = new Datos_vehiculoModel();
		$this->_hechoLugarModel = new HechoLugarModel();
		$this->_foliosAtencionModel = new FoliosAtencionModel();
	}

	public function index()
	{
		$data = (object)array();
		$data->estados = $this->_estadosModel->asObject()->findAll();
		$data->municipios = $this->_municipiosModel->asObject()->where('ESTADOID', '2')->findAll();
		$data->localidades = $this->_localidadesModel->asObject()->findAll();
		$data->colonias = $this->_coloniasModel->asObject()->findAll();
		$data->lugares = $this->_hechoLugarModel->asObject()->orderBy('HECHODESCR', 'asc')->findAll();
		$this->_loadView('Dashboard', 'dashboard', '', $data, 'index');
	}

	public function video_denuncia()
	{
		$data = array();
		$this->_loadView('Video denuncia', 'video-denuncia', '', $data, 'video_denuncia');
	}

	public function denuncias()
	{
		$data = array();
		$this->_loadView('Mis denuncias', 'denuncias', '', $data, 'lista_denuncias');
	}

	public function create()
	{
		$dataPreguntas = array(
			//PREGUNTAS
			'ES_MENOR' => $this->request->getPost('es_menor'),
			'ERES_TU' => $this->request->getPost('eres_tu'),
			'ES_TERCERA_EDAD' => $this->request->getPost('es_tercera_edad'),
			'TIENE_DISCAPACIDAD' => $this->request->getPost('tiene_discapacidad'),
			'FUE_CON_ARMA' => $this->request->getPost('fue_con_arma'),
			'ESTA_DESAPARECIDO' => $this->request->getPost('esta_desaparecido'),
		);

		$dataDelito = array(
			//FORM_DELITO
			'DELITO' => $this->request->getPost('delito'),
			'MUNICIPIO' => $this->request->getPost('municipio'),
			'CALLE' => $this->request->getPost('calle'),
			'NO_EXTERIOR' => $this->request->getPost('exterior'),
			'NO_INTERIOR' => $this->request->getPost('interior'),
			'COLONIA' => $this->request->getPost('colonia'),
			'LUGAR' => $this->request->getPost('lugar'),
			'CLASIFICACION' => $this->request->getPost('clasificacion'),
			'FECHA' => $this->request->getPost('fecha'),
			'HORA' => $this->request->getPost('hora'),
			'RESPONSABLE' => $this->request->getPost('responsable'),
		);

		$dataImputado = array(
			//IMPUTADO O POSIBLE RESPONSABLE
			'NOMBRE_IMPUTADO' => $this->request->getPost('nombre_imputado'),
			'ALIAS' => $this->request->getPost('alias_imputado'),
			'PRIMER_APELLIDO' => $this->request->getPost('primer_apellido_imputado'),
			'SEGUNDO_APELLIDO' => $this->request->getPost('segundo_apellido_imputado'),
			'MUNICIPIO_IMPUTADO' => $this->request->getPost('municipio_imputado'),
			'CALLE' => $this->request->getPost('calle_imputado'),
			'NO_EXT_IMPUTADO' => $this->request->getPost('numero_ext_imputado'),
			'NO_INT_IMPUTADO' => $this->request->getPost('numero_int_imputado'),
			'TELEFONO' => $this->request->getPost('tel_imputado'),
			'FECHA_NACIMIENTO' => $this->request->getPost('fecha_nac_imputado'),
			'SEXO' => $this->request->getPost('sexo_imputado'),
			'ESCOLARIDAD' => $this->request->getPost('escolaridad_imputado'),
			'DESCRIPCION_FISICA' => $this->request->getPost('description_fisica_imputado'),
		);

		$dataAdulto = array(
			//DATOS ADULTO
			'NOMBRE' => $this->request->getPost('nombre_adulto'),
			'APE_PATERNO' => $this->request->getPost('ape_paterno_adulto'),
			'APE_MATERNO' => $this->request->getPost('ape_materno_adulto'),
			'PAIS' => $this->request->getPost('pais_adulto'),
			'ESTADO' => $this->request->getPost('estado_adulto'),
			'MUNICIPIO' => $this->request->getPost('municipio_adulto'),
			'CALLE' => $this->request->getPost('calle_adulto'),
			'NO_EXTERIOR' => $this->request->getPost('numero_ext_adulto'),
			'NO_INTERIOR' => $this->request->getPost('numero_int_adulto'),
			'CP' => $this->request->getPost('cp_adulto'),
			'FECHA_NACIMIENTO' => $this->request->getPost('fecha_nac_adulto'),
			'EDAD' => $this->request->getPost('edad_adulto'),
		);

		$dataMenor = array(
			//DATOS MENOR
			'NOMBRE' => $this->request->getPost('nombre_menor'),
			'APE_PATERNO' => $this->request->getPost('apellido_paterno_menor'),
			'APE_MATERNO' => $this->request->getPost('apellido_materno_menor'),
			'PAIS' => $this->request->getPost('pais_menor'),
			'ESTADO' => $this->request->getPost('estado_menor'),
			'MUNICIPIO' => $this->request->getPost('municipio_menor'),
			'CALLE' => $this->request->getPost('calle_menor'),
			'NO_EXTERIOR' => $this->request->getPost('numero_ext_menor'),
			'NO_INTERIOR' => $this->request->getPost('numero_int_menor'),
			'CP' => $this->request->getPost('cp_menor'),
			'FECHA_NACIMIENTO' => $this->request->getPost('fecha_nacimiento_menor'),
			'EDAD' => $this->request->getPost('edad_menor'),
		);

		$dataDesaparecido = array(
			// PERSONA DESAPARECIDA
			'NOMBRE' => $this->request->getPost('nombre_des'),
			'APE_PATERNO' => $this->request->getPost('apellido_paterno_des'),
			'APE_MATERNO' => $this->request->getPost('apellido_materno_des'),
			'ESTATURA' => $this->request->getPost('estatura_des'),
			'FECHA_NACIMIENTO' => $this->request->getPost('fecha_nacimiento_des'),
			'EDAD' => $this->request->getPost('edad_des'),
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
			'FOTOGRAFIA' => $this->request->getPost('foto_des'),
			'AUTORIZA_FOTO' => $this->request->getPost('autorization_photo_des'),
		);

		$dataVehiculo = array(
			// ROBO DE VEHICULO
			'TIPO_PLACAS' => $this->request->getPost('tipo_placas_vehiculo'),
			'PLACAS' => $this->request->getPost('placas_vehiculo'),
			'CONFIRM_PLACAS' => $this->request->getPost('confirm_placas_vehiculo'),
			'ESTADO' => $this->request->getPost('estado_vehiculo'),
			'SERIE' => $this->request->getPost('serie_vehiculo'),
			'CONFIRM_SERIE' => $this->request->getPost('confirm_serie_vehiculo'),
			'DISTRIBUIDOR' => $this->request->getPost('distribuidor_vehiculo'),
			'MARCA' => $this->request->getPost('marca'),
			'LINEA' => $this->request->getPost('linea_vehiculo'),
			'VERSION' => $this->request->getPost('version_vehiculo'),
			'TIPO_VEHICULO' => $this->request->getPost('tipo_vehiculo'),
			'SERVICIO' => $this->request->getPost('servicio_vehiculo'),
			'MODELO' => $this->request->getPost('modelo_vehiculo'),
			'SEGURO_VIGENTE' => $this->request->getPost('seguro_vigente_vehiculo'),
			'COLOR_VEHICULO' => $this->request->getPost('color_vehiculo'),
			'COLOR_TAPICERIA' => $this->request->getPost('color_tapiceria_vehiculo'),
			'NUM_CHASIS' => $this->request->getPost('num_chasis_vehiculo'),
			'TRANSMISION' => $this->request->getPost('transmision_vehiculo'),
			'TRACCION_VEHICULO' => $this->request->getPost('traccion_vehiculo'),
			'FOTO_VEHICULO' => $this->request->getPost('foto_vehiculo'),
			'DESCRIPCION_VEHICULO' => $this->request->getPost('description_vehiculo'),
			'DERECHOS_IMPUTADO' => $this->request->getPost('derechos_victima_ofendido'),
		);
		$session = session();

		$year = date("Y");
		$month = date("m");
		$day = date("d");

		$dataFolio = [
			'FOLIO' => $year . $month . $day,
			'FECHA_HORA',
			'IDMUNICIPIO',
			'IDCIUDADANO' => $session->get('ID_DENUNCIANTE'),
			'IDEXPEDIENTE',
			'IDDERIVACION',
			'IDAGENTE',
			'ID_DENUNCIA' => $this->_denunciaModel->insert($dataPreguntas),
			'ID_DATOS_DELITO' => $this->_datosdeldelitoModel->insert($dataDelito),
			'ID_DATOS_DEL_RESPONSABLE' => $this->_datosdelresponsableModel->insert($dataImputado),
			'ID_DATOS_ADULTO_ACOMPANANTE' => $this->_datosdeladultoModel->insert($dataAdulto),
			'ID_DATOS_MENOR_EDAD' => $this->_datosdelmenorModel->insert($dataMenor),
			'ID_DATOS_PERSONA_DESAPARECIDA' => $this->_datosdesaparecidoModel->insert($dataDesaparecido),
			'ID_DATOS_ROBO_VEHICULO' => $this->_datosvehiculoModel->insert($dataVehiculo),
			'ID_MODULO_SEJAP',
			'NOTAS',
		];
		$this->_foliosAtencionModel->insert($dataFolio);

		$this->_loadView('Video denuncia', 'video-denuncia', '', $dataFolio, 'video_denuncia');
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
