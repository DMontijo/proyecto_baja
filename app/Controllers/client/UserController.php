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

class UserController extends BaseController
{
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
		$password = $this->_generatePassword(6);

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
			'NUM_EXT' => $this->request->getPost('exterior'),
			'NUM_INT' => $this->request->getPost('interior'),
			'TELEFONO' => $this->request->getPost('telefono'),
			'TELEFONO2' => $this->request->getPost('telefono2'),
			'CODIGO_PAIS' => $this->request->getPost('codigo_pais'),
			'CODIGO_PAIS2' => $this->request->getPost('codigo_pais_2'),
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

		if ($this->validate(['correo' => 'required|is_unique[DENUNCIANTES.CORREO]'])) {
			$this->_denunciantesModel->insert($data);
			$this->_sendEmailPassword($data['CORREO'], $password);
			session()->setFlashdata('message', 'Inicia sesión con la contraseña que llegará a tu correo electrónico');
			return redirect()->to(base_url('/denuncia'))->with('message_success', 'Inicia sesión con la contraseña que llegará a tu correo electrónico y comienza tu denuncia');
		} else {
			return redirect()->back()->with('message', 'Hubo un error en los datos o puede que ya exista un registro con el mismo correo');
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

		$data = [
			'CODIGOPOSTAL' => $this->request->getPost('cp'),
			'PAIS' => $this->request->getPost('pais_select'),
			'ESTADOID' => (int)$this->request->getPost('estado_select'),
			'ESTADOORIGENID' => (int)$this->request->getPost('estado_select_origen'),
			'MUNICIPIOID' => (int)$this->request->getPost('municipio_select'),
			'MUNICIPIOORIGENID' => (int)$this->request->getPost('municipio_select_origen'),
			'LOCALIDADID' => (int)$this->request->getPost('localidad_select'),
			'CALLE' => $this->request->getPost('calle'),
			'NUM_EXT' => $this->request->getPost('exterior'),
			'NUM_INT' => $this->request->getPost('interior'),
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

		try {
			if (!session()->has('DENUNCIANTEID')) throw new \Exception();
			$update = $this->_denunciantesModel->set($data)->where('DENUNCIANTEID', session('DENUNCIANTEID'))->update();
			if (!$update) throw new \Exception();
			session()->set('TIPO', '1');
			return redirect()->to(base_url('/denuncia/dashboard'));
		} catch (\Exception $e) {
			var_dump($data);
			exit;
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
		$data = $this->_folioModel->asObject()->where('DENUNCIANTEID', $id)->where('STATUS', 'ABIERTO')->orWhere('STATUS', 'EN PROCESO')->findAll();
		return json_encode($data);
	}

	private function _sendEmailPassword($to, $password)
	{
		$email = \Config\Services::email();
		$email->setTo($to);
		$email->setSubject('Te estamos atendiendo');
		$body = view('email_template/password_email_template.php', ['email' => $to, 'password' => $password]);
		$email->setMessage($body);

		if ($email->send()) {
			return true;
		} else {
			return false;
		}
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
}

/* End of file RegistroController.php */
/* Location: ./app/Controllers/client/RegistroController.php */
