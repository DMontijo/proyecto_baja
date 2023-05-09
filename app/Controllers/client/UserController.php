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

class UserController extends BaseController
{

	private $_nacionalidadModel;
	private $_estadosCivilesModel;
	private $_personaIdiomaModel;
	private $_estadosModel;
	private $_municipiosModel;
	private $_localidadesModel;
	private $_coloniasModel;
	private $_denunciantesModel;
	private $_tipoIdentificacionModel;
	private $_paisesModel;
	private $_clasificacionLugarModel;
	private $_folioModel;
	private $_escolaridadModel;
	private $_ocupacionModel;
	private $urlApi;

	function __construct()
	{
		//Models
		$this->_nacionalidadModel = new PersonaNacionalidadModel();
		$this->_estadosCivilesModel = new PersonaEstadoCivilModel();
		$this->_personaIdiomaModel = new PersonaIdiomaModel();
		$this->_estadosModel = new EstadosModel();
		$this->_municipiosModel = new MunicipiosModel();
		$this->_localidadesModel = new LocalidadesModel();
		$this->_coloniasModel = new ColoniasModel();
		$this->_denunciantesModel = new DenunciantesModel();
		$this->_tipoIdentificacionModel = new PersonaTipoIdentificacionModel();
		$this->_paisesModel = new PaisesModel();
		$this->_clasificacionLugarModel = new HechoClasificacionLugarModel();
		$this->_folioModel = new FolioModel();
		$this->_escolaridadModel = new EscolaridadModel();
		$this->_ocupacionModel = new OcupacionModel();
		$this->urlApi = VIDEOCALL_URL . "guests/";
	}

	public function index()
	{
		$data = (object) array();
		$this->_loadView('Denuncia', $data, 'index');
	}

	public function new()
	{
		$data = (object) array();
		$data->nacionalidades = $this->_nacionalidadModel->asObject()->findAll();
		$data->edoCiviles = $this->_estadosCivilesModel->asObject()->findAll();
		$data->idiomas = $this->_personaIdiomaModel->asObject()->findAll();
		$data->paises = $this->_paisesModel->asObject()->findAll();
		$data->estados = $this->_estadosModel->asObject()->findAll();
		$data->tiposIdentificaciones = $this->_tipoIdentificacionModel->asObject()->findAll();
		$data->escolaridades = $this->_escolaridadModel->asObject()->findAll();
		$data->ocupaciones = $this->_ocupacionModel->asObject()->findAll();
		$this->_loadView('Denuncia', $data, 'index');
	}

	public function create()
	{
		try {
			$password = $this->_generatePassword(6);

			$documento = $this->request->getPost('documento_text');
			if ($documento) {
				list($type, $documento) = explode(';', $documento);
				list(, $extension) = explode('/', $type);
				list(, $documento) = explode(',', $documento);
				$documento = base64_decode($documento);
			} else {
				$documento = NULL;
			}

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

			if ($this->validate(['correo' => 'required|is_unique[DENUNCIANTES.CORREO]'])) {

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
				if ($response->uuid) {
					$this->_denunciantesModel->insert($data);
					$this->_sendEmailPassword($data['CORREO'], $password);
					session()->setFlashdata('message', 'Inicia sesión con tu correo y la contraseña que llegará a tus mensajes SMS.');
					return redirect()->to(base_url('/denuncia'))->with('message_success', 'Inicia sesión con la contraseña que llegará tus mensajes SMS y comienza tu denuncia');
				}
			} else {
				return redirect()->back()->with('message', 'Hubo un error en los datos o puede que ya exista un registro con el mismo correo');
			}
		} catch (\Throwable $th) {
			return redirect()->to(base_url('/denuncia/denunciante/new'))->with('message', 'Hubo un error, no fue posioble crear tu registro.');
		}
	}

	public function updateDenuncianteInfo()
	{
		$data = (object) array();
		$data->nacionalidades = $this->_nacionalidadModel->asObject()->findAll();
		$data->edoCiviles = $this->_estadosCivilesModel->asObject()->findAll();
		$data->idiomas = $this->_personaIdiomaModel->asObject()->findAll();
		$data->paises = $this->_paisesModel->asObject()->findAll();
		$data->estados = $this->_estadosModel->asObject()->findAll();
		$data->tiposIdentificaciones = $this->_tipoIdentificacionModel->asObject()->findAll();
		$data->escolaridades = $this->_escolaridadModel->asObject()->findAll();
		$data->ocupaciones = $this->_ocupacionModel->asObject()->findAll();
		$this->_loadViewDashboard('Denuncia', $data, 'dash_register_update/index');
	}

	public function updateDenuncianteInfoPost()
	{
		$documento = $this->request->getPost('documento_text');
		list($type, $documento) = explode(';', $documento);
		list(, $extension) = explode('/', $type);
		list(, $documento) = explode(',', $documento);
		$documento = base64_decode($documento);

		$firma = $this->request->getPost('firma_url');
		list($type, $firma) = explode(';', $firma);
		list(, $extension) = explode('/', $type);
		list(, $firma) = explode(',', $firma);
		$firma = base64_decode($firma);

		$interior = $this->request->getPost('interior');
		if ($interior == '') {
			$interior = NULL;
		}

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
			$denunciante = $this->_denunciantesModel->asObject()->where('DENUNCIANTEID', session('DENUNCIANTEID'))->first();
			$endpoint = $this->urlApi . $denunciante->UUID;
			$dataApi = array('languages' => [(int)$this->request->getPost('idioma')]);
			$response = $this->_curlPatch($endpoint, $dataApi);
			if ($response->status == "sucess") {
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

	public function getMunicipiosByEstado()
	{
		$estadoID = $this->request->getPost('estado_id');
		$data = $this->_municipiosModel->asObject()->where('ESTADOID', $estadoID)->orderBy('MUNICIPIODESCR', 'asc')->findAll();
		return json_encode((object)['data' => $data]);
	}

	public function getLocalidadesByMunicipio()
	{
		$estadoID = $this->request->getPost('estado_id');
		$municipioID = $this->request->getPost('municipio_id');
		$data = $this->_localidadesModel->asObject()->where('ESTADOID', $estadoID)->where('MUNICIPIOID', $municipioID)->orderBy('LOCALIDADDESCR', 'asc')->findAll();
		return json_encode((object)['data' => $data]);
	}

	public function getColoniasByEstadoAndMunicipio()
	{
		$estadoID = $this->request->getPost('estado_id');
		$municipioID = $this->request->getPost('municipio_id');
		$data = $this->_coloniasModel->asObject()->where('ESTADOID', $estadoID)->where('MUNICIPIOID', $municipioID)->orderBy('COLONIADESCR', 'asc')->findAll();
		return json_encode((object)['data' => $data]);
	}

	public function getColoniasByEstadoMunicipioLocalidad()
	{
		$estadoID = $this->request->getPost('estado_id');
		$municipioID = $this->request->getPost('municipio_id');
		$localidadID = $this->request->getPost('localidad_id');
		$data = $this->_coloniasModel->asObject()->where('ESTADOID', $estadoID)->where('MUNICIPIOID', $municipioID)->where('LOCALIDADID', $localidadID)->orderBy('COLONIADESCR', 'asc')->findAll();
		return json_encode((object)['data' => $data]);
	}

	public function getClasificacionByLugar()
	{
		$lugar_id = $this->request->getPost('lugar_id');
		$data = $this->_clasificacionLugarModel->asObject()->where('HECHOLUGARID', $lugar_id)->findAll();
		return json_encode((object)['data' => $data]);
	}

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

	public function existEmail()
	{
		$email = $this->request->getPost('email');
		$data = $this->_denunciantesModel->where('CORREO', $email)->first();
		if ($data == NULL) {
			return json_encode((object)['exist' => 0]);
		} else if (count($data) > 0) {
			return json_encode((object)['exist' => 1]);
		} else {
			return json_encode((object)['exist' => 0]);
		}
	}

	public function getFoliosAbiertosById()
	{
		$id = $this->request->getPost('id');
		$data = (object)array();
		$data->abiertos = $this->_folioModel->asObject()->where('STATUS', 'ABIERTO')->where('DENUNCIANTEID', $id)->findAll();
		$data->proceso = $this->_folioModel->asObject()->where('STATUS', 'EN PROCESO')->where('DENUNCIANTEID', $id)->findAll();
		return json_encode($data);
	}

	private function _sendEmailPassword($to, $password)
	{
		// $email = \Config\Services::email();
		$user = $this->_denunciantesModel->asObject()->where('CORREO', $to)->first();
		// $email->setTo($to);
		// $email->setSubject('Te estamos atendiendo');
		$body = view('email_template/password_email_template.php', ['email' => $to, 'password' => $password]);
		// $email->setMessage($body);
		// $email->setAltMessage('Usted ha generado un nuevo registro en el Centro de Denuncia Tecnológica. Para acceder debes ingresar los siguientes datos. USUARIO: ' .$to .'CONTRASEÑA' . $password );
		// $sendSMS = $this->sendSMS("Te estamos atendiendo", $user->TELEFONO, 'Notificaciones FGE/Estimado usuario, tu contraseña es: ' . $password );

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
			->setText('Usted ha generado un nuevo registro en el Centro de Denuncia Tecnológica. Para acceder debes ingresar los siguientes datos. USUARIO: ' .$to .'CONTRASEÑA' . $password)
			->setReplyTo('notificacionfgebc@fgebc.gob.mx')
			->setReplyToName('FGEBC');
		$result = $mailersend->email->send($emailParams);

		if ($result){
			return true;
		} else {
			return false;
		}
		// // if ($email->send()) {
		// 	if ($sendSMS == "") {
		// 		return true;
		// 	}else {
		// 		return false;
		// 	}
		// } else {
		// 	if ($sendSMS == "") {
		// 		return true;
		// 	} else {
		// 		return false;
		// 	}
		// }
	}

	private function _loadView($title, $data, $view)
	{
		$data = [
			'header_data' => (object)['title' => $title],
			'body_data' => $data
		];

		echo view("client/register/$view", $data);
	}

	private function _loadViewDashboard($title, $data, $view)
	{
		$data = [
			'header_data' => (object)['title' => $title],
			'body_data' => $data
		];
		echo view("client/dashboard/$view", $data);
	}
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
	public function sendSMS($tipo, $celular, $mensaje)
	{

		$endpoint = "http://enviosms.ddns.net/API/";
		$data = array();
		$data['UsuarioID'] = 1;
		$data['Nombre'] = $tipo;
		$lstMensajes = array();
		$obj = array("Celular" =>  $celular, "Mensaje" => $mensaje);
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
}

/* End of file RegistroController.php */
/* Location: ./app/Controllers/client/RegistroController.php */
