<?php

namespace App\Controllers\client;

use App\Controllers\BaseController;

use App\Models\DenunciantesModel;
use App\Models\PersonaNacionalidadModel;
use App\Models\PersonaEstadoCivilModel;
use App\Models\PersonaIdiomaModel;
use App\Models\EstadosModel;
use App\Models\MunicipiosModel;
use App\Models\LocalidadesModel;
use App\Models\ColoniasModel;
use App\Models\PersonaTipoIdentificacionModel;
use App\Models\PaisesModel;
use App\Models\HechoClasificacionLugarModel;
use App\Models\FolioModel;

use App\Models\EscolaridadModel;
use App\Models\OcupacionModel;
use GuzzleHttp\Client;

use MailerSend\MailerSend;
use MailerSend\Helpers\Builder\Recipient;
use MailerSend\Helpers\Builder\EmailParams;
use MailerSend\Exceptions\MailerSendValidationException;
use MailerSend\Exceptions\MailerSendRateLimitException;

class UserController extends BaseController
{
	private $db_read;

	private $_nacionalidadModelRead;
	private $_estadosCivilesModelRead;
	private $_personaIdiomaModelRead;
	private $_estadosModelRead;
	private $_municipiosModelRead;
	private $_localidadesModelRead;
	private $_coloniasModelRead;
	private $_denunciantesModel;
	private $_tipoIdentificacionModelRead;
	private $_paisesModelRead;
	private $_clasificacionLugarModelRead;
	private $_folioModel;
	private $_folioModelRead;

	private $_escolaridadModelRead;
	private $_denunciantesModelRead;

	private $_ocupacionModelRead;
	private $urlApi;

	function __construct()
	{
		$this->db_read = ENVIRONMENT == 'production' ? db_connect('default_read') : db_connect('development_read');

		//Models
		$this->_nacionalidadModelRead = model('PersonaNacionalidadModel', true, $this->db_read);
		$this->_estadosCivilesModelRead = model('PersonaEstadoCivilModel', true, $this->db_read);
		$this->_personaIdiomaModelRead = model('PersonaIdiomaModel', true, $this->db_read);
		$this->_estadosModelRead = model('EstadosModel', true, $this->db_read);
		$this->_municipiosModelRead = model('MunicipiosModel', true, $this->db_read);
		$this->_localidadesModelRead = model('LocalidadesModel', true, $this->db_read);
		$this->_coloniasModelRead = model('ColoniasModel', true, $this->db_read);
		$this->_denunciantesModel = new DenunciantesModel();
		$this->_tipoIdentificacionModelRead = model('PersonaTipoIdentificacionModel', true, $this->db_read);
		$this->_paisesModelRead = model('PaisesModel', true, $this->db_read);
		$this->_clasificacionLugarModelRead = model('HechoClasificacionLugarModel', true, $this->db_read);
		$this->_denunciantesModelRead = model('DenunciantesModel', true, $this->db_read);
		$this->_folioModel = new FolioModel();
		$this->_escolaridadModelRead = model('EscolaridadModel', true, $this->db_read);
		$this->_ocupacionModelRead = model('OcupacionModel', true, $this->db_read);
		$this->_folioModelRead = model('FolioModel', true, $this->db_read);

		$this->urlApi = VIDEOCALL_URL . "guests/";
	}

	/**
	 * ! Deprecated method, do not use.
	 *
	 */
	public function index()
	{
		$data = (object) array();
		$this->_loadView('Denuncia', $data, 'index');
	}

	/**
	 * Vista para crear un nuevo denunciante. Se cargan todos los catalogos necesarios para el registro.
	 *
	 */
	public function new()
	{
		$data = (object) array();
		$data->nacionalidades = $this->_nacionalidadModelRead->asObject()->findAll();
		$data->edoCiviles = $this->_estadosCivilesModelRead->asObject()->findAll();
		$data->idiomas = $this->_personaIdiomaModelRead->asObject()->findAll();
		$data->paises = $this->_paisesModelRead->asObject()->findAll();
		$data->estados = $this->_estadosModelRead->asObject()->findAll();
		$data->tiposIdentificaciones = $this->_tipoIdentificacionModelRead->asObject()->findAll();
		$data->escolaridades = $this->_escolaridadModelRead->asObject()->findAll();
		$data->ocupaciones = $this->_ocupacionModelRead->asObject()->findAll();
		$this->_loadView('Denuncia', $data, 'index');
	}

	/**
	 * Función para crear un nuevo denunciante
	 * Recibe con metodo POST los datos del formulario
	 *
	 */
	public function create()
	{
		try {
			//Genera contraseña para el usuario
			$password = $this->_generatePassword(6);

			//Lista la foto de identificacion
			$documento = $this->request->getPost('documento_text');
			if ($documento) {
				list($type, $documento) = explode(';', $documento);
				list(, $extension) = explode('/', $type);
				list(, $documento) = explode(',', $documento);
				$documento = base64_decode($documento);
			} else {
				$documento = NULL;
			}
			//Lista la firma que ingresó

			$firma = $this->request->getPost('firma_url');
			if ($firma) {
				list($type, $firma) = explode(';', $firma);
				list(, $extension) = explode('/', $type);
				list(, $firma) = explode(',', $firma);
				$firma = base64_decode($firma);
			} else {
				$firma = NULL;
			}


			$interior = $this->request->getPost('interior');
			if ($interior == '') {
				$interior = NULL;
			}

			//Datos del denunciante
			$data = [
				'NOMBRE' => $this->request->getPost('nombre'),
				'APELLIDO_PATERNO' => $this->request->getPost('apellido_paterno'),
				'APELLIDO_MATERNO' => $this->request->getPost('apellido_materno'),
				'CORREO' => $this->request->getPost('correo'),
				'PASSWORD' => hashPassword($password),
				'FECHANACIMIENTO' => $this->request->getPost('fecha_nacimiento'),
				'SEXO' => $this->request->getPost('sexo'),
				'CODIGOPOSTAL' => $this->request->getPost('cp'),
				'PAIS' => $this->request->getPost('pais_select'),
				'ESTADOID' => (int)$this->request->getPost('estado_select'),
				'ESTADOORIGENID' => (int)$this->request->getPost('estado_select_origen'),
				'MUNICIPIOID' => (int)$this->request->getPost('municipio_select'),
				'MUNICIPIOORIGENID' => (int)$this->request->getPost('municipio_select_origen'),
				'LOCALIDADID' => (int)$this->request->getPost('localidad_select'),
				'CALLE' => $this->request->getPost('calle'),
				'NUM_EXT' =>  $this->request->getPost('checkML') == 'on' ?  'M.' . $this->request->getPost('exterior') : $this->request->getPost('exterior'),
				'NUM_INT' =>  $this->request->getPost('checkML') == 'on' && $interior ?  'L.' . $this->request->getPost('interior') : $interior,
				'TELEFONO' => $this->request->getPost('telefono'),
				'TELEFONO2' => $this->request->getPost('telefono2'),
				'CODIGO_PAIS' => $this->request->getPost('codigo_pais'),
				'CODIGO_PAIS2' => $this->request->getPost('codigo_pais_2'),
				'TIPOIDENTIFICACIONID' => $this->request->getPost('identificacion'),
				'NUMEROIDENTIFICACION' => $this->request->getPost('numero_ide'),
				'ESTADOCIVILID' => $this->request->getPost('e_civil'),
				'OCUPACIONID' => $this->request->getPost('ocupacion'),
				'OCUPACIONDESCR' => $this->request->getPost('ocupacion_descr'),
				'IDENTIDADGENERO' => $this->request->getPost('iden_genero'),
				'DISCAPACIDAD' => $this->request->getPost('discapacidad'),
				'NACIONALIDADID' => (int)$this->request->getPost('nacionalidad'),
				'ESCOLARIDADID' => $this->request->getPost('escolaridad'),
				'FACEBOOK' => $this->request->getPost('facebook'),
				'INSTAGRAM' => $this->request->getPost('instagram'),
				'TWITTER' => $this->request->getPost('twitter'),
				'IDIOMAID' => (int)$this->request->getPost('idioma'),
				'NOTIFICACIONES' => $this->request->getPost('notificaciones_check') == 'on' ? 'S' : 'N',
				'DOCUMENTO' => $documento,
				'FIRMA' => $firma,
				'TIPO' => 1,
			];

			if ((int)$this->request->getPost('colonia_select') == 0) {
				$data['COLONIAID'] = NULL;
				$data['COLONIA'] = $this->request->getPost('colonia');
			} else {
				$data['COLONIAID'] = (int)$this->request->getPost('colonia_select');
				$data['COLONIA'] = NULL;
			}
			if ((int)$this->request->getPost('ocupacion') == 999) {
				$data['OCUPACIONID'] = NULL;
				$data['OCUPACIONDESCR'] = $this->request->getPost('ocupacion_descr');
			} else {
				$data['OCUPACIONID'] = (int)$this->request->getPost('ocupacion');
				$data['OCUPACIONDESCR'] = NULL;
			}

			//Verifica que el correo sea unico
			if ($this->validate(['correo' => 'required|is_unique[DENUNCIANTES.CORREO]'])) {

				//Datos para el servicio de videollamada
				$dataApi2 = [
					'NOMBRE' => $this->request->getPost('nombre'),
					'APELLIDO_PATERNO' => $this->request->getPost('apellido_paterno'),
					'APELLIDO_MATERNO' => $this->request->getPost('apellido_materno'),
					'CORREO' => $this->request->getPost('correo'),
				];
				$dataApi = array();
				$dataApi['name'] = $this->request->getPost('nombre') . ' ' . $this->request->getPost('apellido_paterno');
				$dataApi['details'] = $dataApi2;
				$dataApi['gender'] = $this->request->getPost('sexo') == 'F' ? "FEMALE" : 'MALE';
				$dataApi['languages'] = [(int)$this->request->getPost('idioma')];
				$response = $this->_curlPost($this->urlApi, $dataApi);
				$data['UUID'] = $response->uuid;
				//Respuesta del servicio de videollamada
				if ($response->uuid) {
					//Insercion de datos
					$this->_denunciantesModel->insert($data);
					//Envio de contraseña
					$this->_sendEmailPassword($data['CORREO'], $data['CODIGO_PAIS'] . $data['TELEFONO'], $password);
					session()->setFlashdata('message', 'Inicia sesión con tu correo y la contraseña que llegará a tu correo electrónico y/o mensajes SMS.');
					return redirect()->to(base_url('/denuncia'))->with('message_success', 'Inicia sesión con la contraseña que llegará a tu correo electrónico y/o mensajes SMS y comienza tu denuncia.');
				}
			} else {
				return redirect()->back()->with('message', 'Hubo un error en los datos o puede que ya exista un registro con el mismo correo');
			}
		} catch (\Throwable $th) {
			return redirect()->to(base_url('/denuncia/denunciante/new'))->with('message', 'Hubo un error, no fue posioble crear tu registro.');
		}
	}

	/**
	 * Vista para actualizar los datos del denunciante.Se cargan todos los catalogos necesarios para la actualizacion.
	 * *Usado cuando pasan de constancia de extravio a videodenuncia
	 *
	 */
	public function updateDenuncianteInfo()
	{
		$data = (object) array();
		$data->nacionalidades = $this->_nacionalidadModelRead->asObject()->findAll();
		$data->edoCiviles = $this->_estadosCivilesModelRead->asObject()->findAll();
		$data->idiomas = $this->_personaIdiomaModelRead->asObject()->findAll();
		$data->paises = $this->_paisesModelRead->asObject()->findAll();
		$data->estados = $this->_estadosModelRead->asObject()->findAll();
		$data->tiposIdentificaciones = $this->_tipoIdentificacionModelRead->asObject()->findAll();
		$data->escolaridades = $this->_escolaridadModelRead->asObject()->findAll();
		$data->ocupaciones = $this->_ocupacionModelRead->asObject()->findAll();
		$this->_loadViewDashboard('Denuncia', $data, 'dash_register_update/index');
	}

	/**
	 * Función para actualizar los datos del denunciante faltante
	 *
	 * @return void
	 */
	public function updateDenuncianteInfoPost()
	{			//Lista la foto de identificacion

		$documento = $this->request->getPost('documento_text');
		list($type, $documento) = explode(';', $documento);
		list(, $extension) = explode('/', $type);
		list(, $documento) = explode(',', $documento);
		$documento = base64_decode($documento);
		//Lista la firma que ingresó

		$firma = $this->request->getPost('firma_url');
		list($type, $firma) = explode(';', $firma);
		list(, $extension) = explode('/', $type);
		list(, $firma) = explode(',', $firma);
		$firma = base64_decode($firma);

		$interior = $this->request->getPost('interior');
		if ($interior == '') {
			$interior = NULL;
		}
		//Datos del denunciante

		$data = [
			'CODIGOPOSTAL' => $this->request->getPost('cp'),
			'PAIS' => $this->request->getPost('pais_select'),
			'ESTADOID' => (int)$this->request->getPost('estado_select'),
			'ESTADOORIGENID' => (int)$this->request->getPost('estado_select_origen'),
			'MUNICIPIOID' => (int)$this->request->getPost('municipio_select'),
			'MUNICIPIOORIGENID' => (int)$this->request->getPost('municipio_select_origen'),
			'LOCALIDADID' => (int)$this->request->getPost('localidad_select'),
			'CALLE' => $this->request->getPost('calle'),
			'NUM_EXT' =>  $this->request->getPost('checkML') == 'on' ?  'M.' . $this->request->getPost('exterior') : $this->request->getPost('exterior'),
			'NUM_INT' =>  $this->request->getPost('checkML') == 'on' && $interior ?  'L.' . $this->request->getPost('interior') : $interior,
			'TIPOIDENTIFICACIONID' => $this->request->getPost('identificacion'),
			'NUMEROIDENTIFICACION' => $this->request->getPost('numero_ide'),
			'ESTADOCIVILID' => $this->request->getPost('e_civil'),
			'OCUPACIONID' => $this->request->getPost('ocupacion'),
			'IDENTIDADGENERO' => $this->request->getPost('iden_genero'),
			'DISCAPACIDAD' => $this->request->getPost('discapacidad'),
			'NACIONALIDADID' => (int)$this->request->getPost('nacionalidad'),
			'ESCOLARIDADID' => $this->request->getPost('escolaridad'),
			'FACEBOOK' => $this->request->getPost('facebook'),
			'INSTAGRAM' => $this->request->getPost('instagram'),
			'TWITTER' => $this->request->getPost('twitter'),
			'IDIOMAID' => (int)$this->request->getPost('idioma'),
			'NOTIFICACIONES' => $this->request->getPost('notificaciones_check') == 'on' ? 'S' : 'N',
			'DOCUMENTO' => $documento,
			'FIRMA' => $firma,
			'TIPO' => 1,
		];

		if ((int)$this->request->getPost('colonia_select') == 0) {
			$data['COLONIAID'] = NULL;
			$data['COLONIA'] = $this->request->getPost('colonia');
		} else {
			$data['COLONIAID'] = (int)$this->request->getPost('colonia_select');
			$data['COLONIA'] = NULL;
		}

		if ((int)$this->request->getPost('ocupacion') == 999) {
			$data['OCUPACIONID'] = NULL;
			$data['OCUPACIONDESCR'] = $this->request->getPost('ocupacion_descr');
		} else {
			$data['OCUPACIONID'] = (int)$this->request->getPost('ocupacion');
			$data['OCUPACIONDESCR'] = NULL;
		}
		try {
			if (!session()->has('DENUNCIANTEID')) throw new \Exception();
			$denunciante = $this->_denunciantesModelRead->asObject()->where('DENUNCIANTEID', session('DENUNCIANTEID'))->first();
			// Actualiazacion del usuario en el servicio de videollamada
			$endpoint = $this->urlApi . $denunciante->UUID;
			$dataApi = array('languages' => [(int)$this->request->getPost('idioma')]);
			$response = $this->_curlPatch($endpoint, $dataApi);
			if ($response->status == "sucess") {
				//Actualizacion de los datos
				$update = $this->_denunciantesModel->set($data)->where('DENUNCIANTEID', session('DENUNCIANTEID'))->update();
				if (!$update) throw new \Exception();
				session()->set('TIPO', '1');
				return redirect()->to(base_url('/denuncia/dashboard'));
			}
		} catch (\Exception $e) {
			// var_dump($data);
			// exit;
			session()->destroy;
			return redirect()->to(base_url('/denuncia'))->with('message_error', 'No se pudo actualizar el registro, ingresa e intentalo de nuevo.');
		}
	}

	/**
	 * Función para obtener los municipios de un estado
	 * Se recibe por metodo POST el estado
	 *
	 */
	public function getMunicipiosByEstado()
	{
		$estadoID = $this->request->getPost('estado_id');
		$data = $this->_municipiosModelRead->asObject()->where('ESTADOID', $estadoID)->orderBy('MUNICIPIODESCR', 'asc')->findAll();
		return json_encode((object)['data' => $data]);
	}
	/**
	 * Función para obtener las localidades de un municipio
	 * Se recibe por metodo POST el estado y municipio
	 *
	 */
	public function getLocalidadesByMunicipio()
	{
		$estadoID = $this->request->getPost('estado_id');
		$municipioID = $this->request->getPost('municipio_id');
		$data = $this->_localidadesModelRead->asObject()->where('ESTADOID', $estadoID)->where('MUNICIPIOID', $municipioID)->orderBy('LOCALIDADDESCR', 'asc')->findAll();
		return json_encode((object)['data' => $data]);
	}
	/**
	 * Función para obtener los colonias de un municipio
	 * Se recibe por metodo POST el estado y municipio
	 *
	 */
	public function getColoniasByEstadoAndMunicipio()
	{
		$estadoID = $this->request->getPost('estado_id');
		$municipioID = $this->request->getPost('municipio_id');
		$data = $this->_coloniasModelRead->asObject()->where('ESTADOID', $estadoID)->where('MUNICIPIOID', $municipioID)->orderBy('COLONIADESCR', 'asc')->findAll();
		return json_encode((object)['data' => $data]);
	}
	/**
	 * Función para obtener los colonias de una localidad
	 * Se recibe por metodo POST el estado, municipio y localidad
	 *
	 */
	public function getColoniasByEstadoMunicipioLocalidad()
	{
		$estadoID = $this->request->getPost('estado_id');
		$municipioID = $this->request->getPost('municipio_id');
		$localidadID = $this->request->getPost('localidad_id');
		$data = $this->_coloniasModelRead->asObject()->where('ESTADOID', $estadoID)->where('MUNICIPIOID', $municipioID)->where('LOCALIDADID', $localidadID)->orderBy('COLONIADESCR', 'asc')->findAll();
		return json_encode((object)['data' => $data]);
	}
	/**
	 * Función para obtener la clasificacion del lugar
	 * Se recibe por metodo POST el id del lugar
	 *
	 */
	public function getClasificacionByLugar()
	{
		$lugar_id = $this->request->getPost('lugar_id');
		$data = $this->_clasificacionLugarModelRead->asObject()->where('HECHOLUGARID', $lugar_id)->findAll();
		return json_encode((object)['data' => $data]);
	}

	/**
	 * Funcion para generar contraseña, de acuerdo al tamaño indicado
	 *
	 * @param  mixed $length
	 */
	private function _generatePassword($length)
	{
		$password = "";
		$pattern = "1234567890abcdefghijklmnopqrstuvwxyz";
		$max = strlen($pattern) - 1;
		for ($i = 0; $i < $length; $i++) {
			$password .= substr($pattern, mt_rand(0, $max), 1);
		}
		return $password;
	}

	/**
	 * Función para verificar si este el email para evitar duplicidad en registro
	 */
	public function existEmail()
	{
		$email = $this->request->getPost('email');
		$data = $this->_denunciantesModelRead->where('CORREO', $email)->first();
		if ($data == NULL) {
			return json_encode((object)['exist' => 0]);
		} else if (count($data) > 0) {
			return json_encode((object)['exist' => 1]);
		} else {
			return json_encode((object)['exist' => 0]);
		}
	}

	/**
	 * Función para obtner los folios abiertos o cerrados del denunciante.
	 * Permite abrir el modal y no generar otro registro
	 *
	 */
	public function getFoliosAbiertosById()
	{
		$id = $this->request->getPost('id');
		$data = (object)array();
		$data->abiertos = $this->_folioModelRead->asObject()->where('STATUS', 'ABIERTO')->where('DENUNCIANTEID', $id)->findAll();
		$data->proceso = $this->_folioModelRead->asObject()->where('STATUS', 'EN PROCESO')->where('DENUNCIANTEID', $id)->findAll();
		return json_encode($data);
	}

	/**
	 * Función para enviar un correo con la contraseña generada al denunciante
	 *
	 * @param  mixed $to
	 * @param  mixed $password
	 */
	private function _sendEmailPassword($to, $telefono, $password)
	{
		$body = view('email_template/password_email_template.php', ['email' => $to, 'password' => $password]);
		$mailersend = new MailerSend(['api_key' => EMAIL_TOKEN]);
		$recipients = [
			new Recipient($to, 'Your Client'),
		];

		$emailParams = (new EmailParams()) //check envio
			->setFrom('notificacionfgebc@fgebc.gob.mx')
			->setFromName('FGEBC')
			->setRecipients($recipients)
			->setSubject('Te estamos atendiendo')
			->setHtml($body)
			->setText('Usted ha generado un nuevo registro en el Centro de Denuncia Tecnológica. Para acceder debes ingresar los siguientes datos. USUARIO: ' . $to . 'CONTRASEÑA' . $password)
			->setReplyTo('notificacionfgebc@fgebc.gob.mx')
			->setReplyToName('FGEBC');
		$sendSMS = $this->sendSMS("PASSWORD", $telefono, 'Notificaciones FGEBC/Estimado usuario, tu contraseña es: ' . $password);

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
			if ($sendSMS->status == 200) {
				return true;
			} else {
				return false;
			}
		}
	}

	/**
	 * Función para cargar cualquier vista en cualquier función de la carpeta register.
	 *
	 * @param  mixed $title
	 * @param  mixed $data
	 * @param  mixed $view
	 */
	private function _loadView($title, $data, $view)
	{
		$data = [
			'header_data' => (object)['title' => $title],
			'body_data' => $data
		];

		echo view("client/register/$view", $data);
	}
	/**
	 * Función para cargar cualquier vista en cualquier función de la carpeta dashboard.
	 *
	 * @param  mixed $title
	 * @param  mixed $data
	 * @param  mixed $view
	 */
	private function _loadViewDashboard($title, $data, $view)
	{
		$data = [
			'header_data' => (object)['title' => $title],
			'body_data' => $data
		];
		echo view("client/dashboard/$view", $data);
	}
	/**
	 * Función CURL POST a Justicia encriptados
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
			'X-API-KEY: ' . X_API_KEY
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
	/**
	 * Función CURL PATCH al servicio de videollamada
	 *
	 * @param  mixed $endpoint
	 * @param  mixed $data
	 */
	private function _curlPatch($endpoint, $data)
	{
		$ch = curl_init();

		curl_setopt($ch, CURLOPT_URL, $endpoint);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PATCH');
		curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
		$headers = array(
			'Content-Type: application/json',
			'Access-Control-Allow-Origin: *',
			'Access-Control-Allow-Credentials: true',
			'Access-Control-Allow-Headers: Content-Type',
			'X-API-KEY: ' . X_API_KEY
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
	/**
	 * Función para enviar mensajes SMS
	 *
	 * @param  mixed $tipo
	 * @param  mixed $celular
	 * @param  mixed $mensaje
	 */
	public function sendSMS($tipo, $celular, $mensaje)
	{
		$endpoint = "https://tess-track.vercel.app/api/sms/send";
		$headers = array(
			'Content-Type: application/json',
			'Access-Control-Allow-Origin: *',
			'Access-Control-Allow-Credentials: true',
			'Access-Control-Allow-Headers: Content-Type',
			'Authorization: Bearer ' . TOKEN_SMS
		);

		$data = array();
		$data['name'] = $tipo;
		$lstMensajes = array();
		$obj = array("message" => $mensaje, "phone" =>  $celular);
		$lstMensajes[] = $obj;
		$data['messages'] = $lstMensajes;

		$ch = curl_init();

		curl_setopt($ch, CURLOPT_URL, $endpoint);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		$result = curl_exec($ch);

		if ($result === false) {
			$result = array(
				'status' => 401,
				'error' => 'Curl failed: ' . curl_error($ch)
			);
		} else {
			$result = json_decode($result, true);
		}

		curl_close($ch);

		return $result;
	}
}

/* End of file RegistroController.php */
/* Location: ./app/Controllers/client/RegistroController.php */
