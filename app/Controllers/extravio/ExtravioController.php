<?php

namespace App\Controllers\extravio;

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


class ExtravioController extends BaseController
{


	function __construct()
	{
		$this->_denunciantesModel = new DenunciantesModel();
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
        
		if ($this->_isAuth()) {
			return redirect()->to(base_url('/constancia_extravio/dashboard'));
		} else {
			session()->destroy;
			$this->_loadView('Login', [], 'index');
		}
	}
    public function login()
	{
    
			$this->_loadView('Login', [], 'login');
		
	}
    public function login_auth()
	{
		$session = session();
		$email = $this->request->getPost('correo');
		$password = $this->request->getPost('password');
		$data = $this->_denunciantesModel->where('CORREO', $email)->first();
		if ($data) {
			if (validatePassword($password, $data['PASSWORD'])) {
				$data['logged_in'] = TRUE;
				$data['type'] = 'user';
				$session->set($data);
				return redirect()->to(base_url('/constancia_extravio/dashboard'));
			} else {
				$session->setFlashdata('message', 'La contraseña es incorrecta.');
				return redirect()->back();
			}
		} else {
			$session->setFlashdata('message', 'El correo no está registrado.');
			return redirect()->back();
		}
	}

	public function logout()
	{
		$session = session();
		$session->destroy();
		return redirect()->to(base_url());
	}

    public function create()
	{

		$password = $this->_generatePassword(6);

		$data = [
			'NOMBRE' => $this->request->getPost('nombre'),
			'APELLIDO_PATERNO' => $this->request->getPost('apellido_paterno'),
			'APELLIDO_MATERNO' => $this->request->getPost('apellido_materno'),
			'CORREO' => $this->request->getPost('correo'),
			'PASSWORD' => hashPassword($password),
            'TELEFONO'=> $this->request->getPost('telefono'),
			'FECHA_DE_NACIMIENTO' => $this->request->getPost('fecha_nacimiento'),
			'SEXO' => $this->request->getPost('sexo'),
			
		];
		if ($this->validate(['correo' => 'required|is_unique[DENUNCIANTES.CORREO]'])) {
			$this->_denunciantesModel->insert($data);
			$this->_sendEmailPassword($data['CORREO'], $password);
			return redirect()->to(base_url('/constancia_extravio/login'))->with('created', 'Inicia sesión con la contraseña que llegará a tu correo y comienza tu denuncia');
		} else {
			return redirect()->back()->with('message', 'Hubo un error en los datos o puede que ya exista un registro con el mismo correo');
		}
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
    private function _isAuth()
	{
		if (session('logged_in') && session('type') == 'user') {
			return true;
		};
	}
    private function _loadView($title, $data, $view)
	{
		$data = [
			'header_data' => (object)['title' => $title],
			'body_data' => $data
		];
		echo view("constancia_extravio/register/$view", $data);
	}
}