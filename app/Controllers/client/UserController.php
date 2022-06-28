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
		$this->_loadView('Denuncia', $data, 'index');
	}

	public function create()
	{
		$password = $this->_generatePassword(6);

		$foto_des = $this->request->getPost('documento_text');
		// list($type, $foto_des) = explode(';', $foto_des);
		// list(, $extension) = explode('/', $type);
		// list(, $foto_des) = explode(',', $foto_des);

		$firma = $this->request->getPost('firma_url');
		// list($type, $firma) = explode(';', $firma);
		// list(, $extension) = explode('/', $type);
		// list(, $firma) = explode(',', $firma);

		$data = [
			'NOMBRE' => $this->request->getPost('nombre'),
			'APELLIDO_PATERNO' => $this->request->getPost('apellido_paterno'),
			'APELLIDO_MATERNO' => $this->request->getPost('apellido_materno'),
			'CORREO' => $this->request->getPost('correo'),
			'PASSWORD' => hashPassword($password),
			'FECHA_DE_NACIMIENTO' => $this->request->getPost('fecha_nacimiento'),
			'EDAD' => $this->request->getPost('edad'),
			'SEXO' => $this->request->getPost('sexo'),
			'CODIGO_POSTAL' => $this->request->getPost('cp'),
			'PAIS' => $this->request->getPost('pais_select'),
			'ESTADOID' => (int)$this->request->getPost('estado_select'),
			'MUNICIPIOID' => (int)$this->request->getPost('municipio_select'),
			'LOCALIDADID' => (int)$this->request->getPost('localidad_select'),
			'COLONIAID' => (int)$this->request->getPost('colonia_select'),
			'COLONIA' => $this->request->getPost('colonia'),
			'CALLE' => $this->request->getPost('calle'),
			'NUM_EXT' => $this->request->getPost('exterior'),
			'NUM_INT' => $this->request->getPost('interior'),
			'TELEFONO' => $this->request->getPost('telefono'),
			'TELEFONO2' => $this->request->getPost('telefono2'),
			'CODIGO_PAIS' => $this->request->getPost('codigo_pais'),
			'CODIGO_PAIS2' => $this->request->getPost('codigo_pais_2'),
			'TIPO_DE_IDENTIFICACION' => $this->request->getPost('identificacion'),
			'NUMERO_DE_IDENTIFICACION' => $this->request->getPost('numero_ide'),
			'ESTADO_CIVIL' => $this->request->getPost('e_civil'),
			'OCUPACION' => $this->request->getPost('ocupacion'),
			'IDENTIDAD_DE_GENERO' => $this->request->getPost('iden_genero'),
			'DISCAPACIDAD' => $this->request->getPost('discapacidad'),
			'NACIONALIDAD_ID' => (int)$this->request->getPost('nacionalidad'),
			'ESCOLARIDAD' => $this->request->getPost('escolaridad'),
			'FACEBOOK' => $this->request->getPost('facebook'),
			'INSTAGRAM' => $this->request->getPost('instagram'),
			'TWITTER' => $this->request->getPost('twitter'),
			'IDIOMAID' => (int)$this->request->getPost('idioma'),
			'NOTIFICACIONES' => $this->request->getPost('notificaciones_check') == 'on' ? 'S' : 'N',
			'DOCUMENTO' => $foto_des,
			'FIRMA' => $firma,
		];

		if ($this->validate(['correo' => 'required|is_unique[DENUNCIANTES.CORREO]'])) {
			$this->_denunciantesModel->insert($data);
			$this->_sendEmailPassword($data['CORREO'], $password);
			return redirect()->to(base_url('/denuncia'))->with('created', 'Inicia sesión con la contraseña que llegará a tu correo y comienza tu denuncia');
		} else {
			return redirect()->back()->with('message', 'Hubo un error en los datos o puede que ya exista un registro con el mismo correo');
		}
	}

	public function getMunicipiosByEstado()
	{
		$estadoID = $this->request->getPost('estado_id');
		$data = $this->_municipiosModel->asObject()->where('ESTADOID', $estadoID)->findAll();
		return json_encode((object)['data' => $data]);
	}

	public function getLocalidadesByMunicipio()
	{
		$estadoID = $this->request->getPost('estado_id');
		$municipioID = $this->request->getPost('municipio_id');
		$data = $this->_localidadesModel->asObject()->where('ESTADOID', $estadoID)->where('MUNICIPIOID', $municipioID)->findAll();
		return json_encode((object)['data' => $data]);
	}

	public function getColoniasByEstadoAndMunicipio()
	{
		$estadoID = $this->request->getPost('estado_id');
		$municipioID = $this->request->getPost('municipio_id');
		$data = $this->_coloniasModel->asObject()->where('ESTADOID', $estadoID)->where('MUNICIPIOID', $municipioID)->findAll();
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
		$data = $this->_folioModel->asObject()->where('STATUS', 'ABIERTO')->where('DENUNCIANTEID', $id)->findAll();
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
}

/* End of file RegistroController.php */
/* Location: ./app/Controllers/client/RegistroController.php */
