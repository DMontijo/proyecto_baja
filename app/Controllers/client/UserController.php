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
		$data = [
			'NOMBRE' => $this->request->getPost('nombre'),
			'APELLIDO_PATERNO' => $this->request->getPost('apellido_paterno'),
			'APELLIDO_MATERNO' => $this->request->getPost('apellido_materno'),
			'CORREO' => $this->request->getPost('correo'),
			'PASSWORD' => $this->_generatePassword(6),
			'CREADO' => date('m-d-Y h:i:s a', time()),
		];

		if ($this->validate([
			'nombre' => 'required|max_length[100]',
			'apellido_paterno' => 'required|max_length[100]',
			'correo' => 'required|is_unique[DENUNCIANTES.CORREO]'
		])) {
			$this->_denunciantesModel->insert($data);
			return redirect()->to(base_url() . "/denuncia")->with('message', 'Denunciante creado con éxito.');
		} else {
			return redirect()->back()->with('message', 'Hubo un error en los datos');
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
