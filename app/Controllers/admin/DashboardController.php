<?php

namespace App\Controllers\admin;

use App\Controllers\BaseController;

use App\Models\FoliosAtencionModel;
use App\Models\DenunciantesModel;
use App\Models\FolioDenunciaModel;
use App\Models\Datos_del_responsableModel;
use App\Models\Datos_adultoModel;
use App\Models\Datos_menorModel;
use App\Models\Datos_desaparecidoModel;
use App\Models\Datos_vehiculoModel;

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
use App\Models\UsuariosModel;
use App\Models\ZonasUsuariosModel;
use App\Models\RolesUsuariosModel;

class DashboardController extends BaseController
{
	function __construct()
	{
		//Models
		$this->_foliosAtencionModel = new FoliosAtencionModel();
		$this->_denunciantesModel = new DenunciantesModel();
		$this->_datosDelitoModel = new FolioDenunciaModel();
		$this->_datosResponsablesModel = new Datos_del_responsableModel();
		$this->_datosAdultoModel = new Datos_adultoModel;
		$this->_datosMenorModel = new Datos_menorModel;
		$this->_datosDesaparecidoModel = new Datos_desaparecidoModel;
		$this->_datosVehiculoModel = new Datos_vehiculoModel;

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

		$this->_usuariosModel = new UsuariosModel();
		$this->_zonasUsuariosModel = new ZonasUsuariosModel();
		$this->_rolesUsuariosModel = new RolesUsuariosModel();
	}

	public function index()
	{
		$data = (object)array();
		$data->cantidad_folios = count($this->_folioModel->asObject()->findAll());
		$this->_loadView('Principal', 'dashboard', '', $data, 'index');
	}

	public function usuarios()
	{
		$data = (object)array();
		$data = $this->_usuariosModel->asObject()->join('ROLES', 'ROLES.ID = USUARIOS.ROLID')->join('ZONAS_USUARIOS', 'ZONAS_USUARIOS.ID_ZONA = USUARIOS.ZONAID')->findAll();
		// var_dump($data);
		$this->_loadView('Registrar usuario', 'registrarusuario', '', $data, 'users');
	}

	public function nuevo_usuario()
	{
		$data = (object)array();
		$data->zonas = $this->_zonasUsuariosModel->asObject()->findAll();
		$data->roles = $this->_rolesUsuariosModel->asObject()->findAll();
		$this->_loadView('Nuevo usuario', 'registrarusuario', '', $data, 'new_user');
	}

	public function crear_usuario()
	{

		$data = [
			'NOMBRE' => $this->request->getPost('nombre'),
			'APELLIDO_PATERNO' => $this->request->getPost('apellido_paterno'),
			'APELLIDO_MATERNO' => $this->request->getPost('apellido_materno'),
			'CORREO' => $this->request->getPost('correo'),
			'PASSWORD' => hashPassword($this->request->getPost('password')),
			'SEXO' => $this->request->getPost('sexo'),
			'ROLID' => $this->request->getPost('rol'),
			'ZONAID' => $this->request->getPost('zona'),
			'HUELLA_DIGITAL' => NULL,
			'CERTIFICADOFIRMA' => $this->request->getPost('cer'),
			'KEYFIRMA' => $this->request->getPost('key'),
			'FRASEFIRMA' => $this->request->getPost('frase'),
		];

		var_dump($data);
		if ($this->validate(['correo' => 'required|is_unique[USUARIOS.CORREO]'])) {
			$this->_usuariosModel->insert($data);
			$this->_sendEmailPassword($data['CORREO'], $this->request->getPost('password'));
			return redirect()->to(base_url('/admin/dashboard/usuarios'));
		} else {
			return redirect()->back();
		}
	}

	public function folios()
	{
		$data = (object)array();
		$data = $this->_folioModel->asObject()->findAll();
		$this->_loadView('Folios no atendidos', 'folios', '', $data, 'folios');
	}

	public function getFolioInformation()
	{
		$data = (object)array();
		$numfolio = $this->request->getPost('folio');
		$data->folio = $this->_folioModel->asObject()->where('FOLIOID', $numfolio)->first();
		if ($data->folio) {
			if ($data->folio->STATUS == 'ABIERTO') {
				$data->status = 1;
				$data->preguntas_iniciales = $this->_folioPreguntasModel->where('FOLIOID', $numfolio)->first();
				$data->personas = $this->_folioPersonaFisicaModel->where('FOLIOID', $numfolio)->findAll();
				$data->domicilio = $this->_folioPersonaFisicaDomicilioModel->where('FOLIOID', $numfolio)->findAll();
				$data->vehiculos = $this->_folioVehiculoModel->where('FOLIOID', $numfolio)->findAll();
				return json_encode($data);
			} else {
				$agente = $this->_usuariosModel->asObject()->where('ID', $data->folio->AGENTEATENCIONID)->first();
				return json_encode(['status' => 2, 'motivo' => $data->folio->STATUS, 'agente' => $agente->NOMBRE . ' ' . $agente->APELLIDO_PATERNO . ' ' . $agente->APELLIDO_MATERNO]);
			}
		} else {
			return json_encode(['status' => 0]);
		}
	}

	public function video_denuncia()
	{
		$data = array();
		$this->_loadView('Video denuncia', 'videodenuncia', '', $data, 'video_denuncia');
	}

	private function _loadView($title, $menu, $submenu, $data, $view)
	{
		$data2 = [
			'header_data' => (object)['title' => $title, 'menu' => $menu, 'submenu' => $submenu],
			'body_data' => $data
		];

		echo view("admin/dashboard/$view", $data2);
	}

	public function updateStatusFolio()
	{
		$status = $this->request->getPost('status');
		$motivo = $this->request->getPost('motivo');
		$folio = $this->request->getPost('folio');
		$agenteId = $this->request->getPost('agenteId');

		$data = [
			'STATUS' => $status,
			'NOTASAGENTE' => $motivo,
			'AGENTEATENCIONID' => $agenteId,
			'FOLIOID' => $folio
		];
		if (!empty($status) && !empty($motivo) && !empty($folio) && !empty($agenteId)) {
			$update = $this->_folioModel->set($data)->where('FOLIOID', $folio)->update();
			if ($update) {
				$folio = $this->_folioModel->asObject()->where('FOLIOID', $folio)->first();
				$denunciante = $this->_denunciantesModel->asObject()->where('ID_DENUNCIANTE', $folio->DENUNCIANTEID)->first();
				if ($this->_sendEmailDerivacionCanalizacion($denunciante->CORREO, $folio->FOLIOID, $status)) {
					return json_encode(['status' => 1]);
				} else {
					return json_encode(['status' => 1]);
				}
			} else {
				return json_encode(['status' => 0, 'error' => 'No hizo el update']);
			}
		} else {
			return json_encode(['status' => 0, 'error' => 'No existe alguna de las variables']);
		}
	}

	private function _sendEmailDerivacionCanalizacion($to, $folio, $motivo)
	{
		$email = \Config\Services::email();
		$email->setTo($to);
		$email->setFrom('andrea.solorzano@yocontigo-it.com', 'FGEBC');
		$email->setSubject('Folio atendido');
		$body = view('email_template/folio_der_can_email_template.php', ['folio' => $folio, 'motivo' => $motivo]);
		$email->setMessage($body);
		if ($email->send()) {
			return true;
		} else {
			return false;
		}
	}

	private function _sendEmailPassword($to, $password)
	{
		$email = \Config\Services::email();
		$email->setTo($to);
		$email->setFrom('andrea.solorzano@yocontigo-it.com', 'FGEBC');
		$email->setSubject('Nueva cuenta creada');
		$body = view('email_template/password_email_admin_template.php', ['email' => $to, 'password' => $password]);
		$email->setMessage($body);

		if ($email->send()) {
			return true;
		} else {
			return false;
		}
	}

	public function existEmailAdmin()
	{
		$email = $this->request->getPost('email');
		$data = $this->_usuariosModel->where('CORREO', $email)->first();
		if ($data == NULL) {
			return json_encode((object)['exist' => 0]);
		} else if (count($data) > 0) {
			return json_encode((object)['exist' => 1]);
		} else {
			return json_encode((object)['exist' => 0]);
		}
	}

	public function findPersonaFisicaById()
	{
		$id = $this->request->getPost('id');
		$folio = $this->request->getPost('folio');
		$data = $this->_folioPersonaFisicaModel->where('FOLIOID', $folio)->where('PERSONAFISICAID', $id)->first();
		return json_encode($data);
	}
}

/* End of file DashboardController.php */
/* Location: ./app/Controllers/admin/DashboardController.php */
