<?php

namespace App\Controllers\client;

use App\Controllers\BaseController;

use App\Models\DenuncianteModel;
use App\Models\PersonaNacionalidadModel;
use \CodeIgniter\Exceptions\PageNotFoundException;


class UserController extends BaseController
{

	public function index()
	{
		$data = (object) array();
		echo session('message');
		$this->_loadView('Denuncia', $data, 'index');
	}

	public function new()
	{
		$nacionalidadModel = new PersonaNacionalidadModel();
		$data = (object) array();
		$data->nacionalidades = $nacionalidadModel->asObject()->findAll();
		$this->_loadView('Denuncia', $data, 'index');
	}

	public function create()
	{
		$denuncianteModel = new DenuncianteModel();
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
			'correo' => 'required|is_unique[CIUDADANOS.CORREO]'
		])) {
			$this->$denuncianteModel->insert($data);
			return redirect()->to(base_url() . "/denuncia")->with('message', 'Denunciante creado con éxito.');
		} else {
			return redirect()->back()->with('message', 'Hubo un error en los datos');
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
