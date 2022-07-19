<?php

namespace App\Controllers\admin;

use App\Controllers\BaseController;
use App\Models\DenunciantesModel;

use App\Models\EstadosModel;
use App\Models\MunicipiosModel;
use App\Models\LocalidadesModel;
use App\Models\ColoniasModel;
use App\Models\HechoLugarModel;
use App\Models\VehiculoColorModel;
use App\Models\VehiculoTipoModel;
use App\Models\PaisesModel;
use App\Models\DelitosUsuariosModel;
use App\Models\PersonaIdiomaModel;

use App\Models\FolioPreguntasModel;
use App\Models\FolioModel;
use App\Models\FolioPersonaFisicaModel;
use App\Models\FolioPersonaFisicaDomicilioModel;
use App\Models\FolioPersonaFisicaDesaparecidaModel;
use App\Models\FolioVehiculoModel;
use App\Models\UsuariosModel;
use App\Models\ZonasUsuariosModel;
use App\Models\RolesUsuariosModel;
use App\Models\OficinasModel;
use App\Models\EmpleadosModel;
use App\Models\PersonaCalidadJuridicaModel;
use App\Models\PersonaTipoIdentificacionModel;

use App\Models\EscolaridadModel;
use App\Models\OcupacionModel;
use App\Models\PersonaEstadoCivilModel;
use App\Models\PersonaNacionalidadModel;

use App\Models\ConexionesDBModel;

class DashboardController extends BaseController
{

	function __construct()
	{
		//Models
		$this->_denunciantesModel = new DenunciantesModel();

		$this->_paisesModel = new PaisesModel();
		$this->_estadosModel = new EstadosModel();
		$this->_municipiosModel = new MunicipiosModel();
		$this->_localidadesModel = new LocalidadesModel();
		$this->_coloniasModel = new ColoniasModel();
		$this->_hechoLugarModel = new HechoLugarModel();
		$this->_coloresVehiculoModel = new VehiculoColorModel();
		$this->_tipoVehiculoModel = new VehiculoTipoModel();
		$this->_delitosUsuariosModel = new DelitosUsuariosModel();
		$this->_denunciantesModel = new DenunciantesModel();
		$this->_idiomaModel = new PersonaIdiomaModel();

		$this->_folioModel = new FolioModel();
		$this->_folioPreguntasModel = new FolioPreguntasModel();
		$this->_folioPersonaFisicaModel = new FolioPersonaFisicaModel();
		$this->_folioPersonaFisicaDomicilioModel = new FolioPersonaFisicaDomicilioModel();
		$this->_folioPersonaFisicaDesaparecidaModel = new FolioPersonaFisicaDesaparecidaModel();
		$this->_folioVehiculoModel = new FolioVehiculoModel();

		$this->_usuariosModel = new UsuariosModel();
		$this->_zonasUsuariosModel = new ZonasUsuariosModel();
		$this->_rolesUsuariosModel = new RolesUsuariosModel();
		$this->_oficinasModel = new OficinasModel();
		$this->_empleadosModel = new EmpleadosModel();
		$this->_folioPersonaCalidadJuridica = new PersonaCalidadJuridicaModel();
		$this->_tipoIdentificacionModel = new PersonaTipoIdentificacionModel();

		$this->_municipiosModel = new MunicipiosModel();
		$this->_localidadesModel = new LocalidadesModel();
		$this->_coloniasModel = new ColoniasModel();

		$this->_escolaridadModel = new EscolaridadModel();
		$this->_ocupacionModel = new OcupacionModel();
		$this->_estadoCivilModel = new PersonaEstadoCivilModel();
		$this->_nacionalidadModel = new PersonaNacionalidadModel();

		$this->_conexionesDBModel = new ConexionesDBModel();

		// $this->protocol = 'http://';
		// $this->ip = "10.144.244.223";
		$this->protocol = 'https://';
		$this->ip = "ws.fgebc.gob.mx";
		$this->endpoint = $this->protocol . $this->ip . '/wsJusticia';
	}

	public function index()
	{
		$data = (object)array();
		$agente = $this->_usuariosModel->asObject()->where('ID', session('ID'))->first();
		$roles = [1, 3];
		if (in_array($agente->ROLID, $roles)) {
			$data->cantidad_folios = count($this->_folioModel->asObject()->findAll());
			$data->cantidad_abiertos = count($this->_folioModel->asObject()->where('STATUS', 'ABIERTO')->findAll());
			$data->cantidad_derivados = count($this->_folioModel->asObject()->where('STATUS', 'DERIVADO')->findAll());
			$data->cantidad_canalizados = count($this->_folioModel->asObject()->where('STATUS', 'CANALIZADO')->findAll());
			$data->cantidad_expedientes = count($this->_folioModel->asObject()->where('EXPEDIENTEID !=', NULL)->where('AGENTEATENCIONID !=', NULL)->where('AGENTEFIRMAID !=', NULL)->findAll());
			$data->cantidad_expedientes_no_firmados = count($this->_folioModel->asObject()->where('EXPEDIENTEID !=', NULL)->where('AGENTEATENCIONID !=', NULL)->where('AGENTEFIRMAID', NULL)->findAll());
		} else {
			$data->cantidad_folios = count($this->_folioModel->asObject()->where('AGENTEATENCIONID', session('ID'))->findAll());
			$data->cantidad_abiertos = count($this->_folioModel->asObject()->where('AGENTEATENCIONID', session('ID'))->where('STATUS', 'ABIERTO')->findAll());
			$data->cantidad_derivados = count($this->_folioModel->asObject()->where('AGENTEATENCIONID', session('ID'))->where('STATUS', 'DERIVADO')->findAll());
			$data->cantidad_canalizados = count($this->_folioModel->asObject()->where('AGENTEATENCIONID', session('ID'))->where('STATUS', 'CANALIZADO')->findAll());
			$data->cantidad_expedientes = count($this->_folioModel->asObject()->where('AGENTEATENCIONID', session('ID'))->where('EXPEDIENTEID !=', NULL)->where('AGENTEATENCIONID !=', NULL)->where('AGENTEFIRMAID !=', NULL)->findAll());
			$data->cantidad_expedientes_no_firmados = count($this->_folioModel->asObject()->where('EXPEDIENTEID !=', NULL)->where('AGENTEATENCIONID !=', NULL)->where('AGENTEFIRMAID', NULL)->findAll());
		}
		$this->_loadView('Principal', 'dashboard', '', $data, 'index');
	}

	public function usuarios()
	{
		$data = (object)array();
		$data = $this->_usuariosModel->asObject()->join('ROLES', 'ROLES.ID = USUARIOS.ROLID')->join('ZONAS_USUARIOS', 'ZONAS_USUARIOS.ID_ZONA = USUARIOS.ZONAID')->where('ROLID !=', 1)->orderBy('ROLID')->findAll();
		$this->_loadView('Registrar usuario', 'registrarusuario', '', $data, 'users');
	}

	public function firmas()
	{
		$data = (object)array();
		$data = $this->_usuariosModel->asObject()->join('ROLES', 'ROLES.ID = USUARIOS.ROLID')->join('ZONAS_USUARIOS', 'ZONAS_USUARIOS.ID_ZONA = USUARIOS.ZONAID')->findAll();
		// var_dump($data);
		$this->_loadView('Firmar documentos', 'firmar', '', $data, 'signs');
	}

	public function nuevo_usuario()
	{
		$data = (object)array();
		$data->zonas = $this->_zonasUsuariosModel->asObject()->where('NOMBRE_ZONA !=', 'SUPERUSUARIO')->findAll();
		$data->roles = $this->_rolesUsuariosModel->asObject()->where('NOMBRE_ROL !=', 'SUPERUSUARIO')->findAll();
		$this->_loadView('Nuevo usuario', 'registrarusuario', '', $data, 'new_user');
	}

	public function denuncia_anonima()
	{
		$data = (object)array();
		$data->paises = $this->_paisesModel->asObject()->findAll();
		$data->estados = $this->_estadosModel->asObject()->findAll();
		$data->municipios = $this->_municipiosModel->asObject()->where('ESTADOID', '2')->findAll();
		$data->localidades = $this->_localidadesModel->asObject()->findAll();
		$data->colonias = $this->_coloniasModel->asObject()->findAll();
		$data->lugares = $this->_hechoLugarModel->asObject()->findAll();
		$data->colorVehiculo = $this->_coloresVehiculoModel->asObject()->findAll();
		$data->tipoVehiculo = $this->_tipoVehiculoModel->asObject()->orderBy('VEHICULOTIPODESCR', 'ASC')->findAll();
		$data->delitosUsuarios = $this->_delitosUsuariosModel->asObject()->orderBy('DELITO', 'ASC')->findAll();
		$this->_loadView('Denuncia anónima', 'denuncia_anonima', '', $data, 'denuncia_anonima');
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
			'CERTIFICADOFIRMA' => NULL,
			'KEYFIRMA' => NULL,
			'FRASEFIRMA' => NULL,
		];

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

	public function perfil()
	{
		$data = (object)array();
		$data->zonas = $this->_zonasUsuariosModel->asObject()->findAll();
		$data->roles = $this->_rolesUsuariosModel->asObject()->findAll();
		$this->_loadView('Perfil', 'perfil', '', $data, 'perfil');
	}

	public function update_password()
	{
		$password = $this->request->getPost('password');
		$data = [
			'PASSWORD' => hashPassword($password),
		];
		$this->_usuariosModel->set($data)->where('ID', session('ID'))->update();
		$session = session();
		$session->destroy();
		return redirect()->to(base_url('admin'));
	}

	public function getFolioInformation()
	{
		$data = (object)array();
		$numfolio = trim($this->request->getPost('folio'));
		$year = trim($this->request->getPost('year'));
		$data->folio = $this->_folioModel->asObject()->where('ANO', $year)->where('FOLIOID', $numfolio)->first();

		if ($data->folio) {
			if ($data->folio->STATUS == 'ABIERTO') {
				$data->status = 1;
				$data->preguntas_iniciales = $this->_folioPreguntasModel->where('FOLIOID', $numfolio)->first();
				$data->personas = $this->_folioPersonaFisicaModel->join('PERSONACALIDADJURIDICA', 'PERSONACALIDADJURIDICA.PERSONACALIDADJURIDICAID = FOLIOPERSONAFISICA.CALIDADJURIDICAID')->where('FOLIOID', $numfolio)->orderBy('DENUNCIANTE', 'asc')->findAll();
				$data->vehiculos = $this->_folioVehiculoModel->where('FOLIOID', $numfolio)->findAll();

				$data->folioMunicipio = $this->_municipiosModel->asObject()->where('ESTADOID', 2)->where('MUNICIPIOID', $data->folio->HECHOMUNICIPIOID)->first();
				$data->folioColonia = $this->_coloniasModel->asObject()->where('ESTADOID', 2)->where('MUNICIPIOID', $data->folio->HECHOMUNICIPIOID)->where('COLONIAID', $data->folio->HECHOCOLONIAID)->first();
				$data->folioLugar = $this->_folioModel->join('HECHOLUGAR', 'HECHOLUGAR.HECHOLUGARID = FOLIO.HECHOLUGARID')->where('FOLIOID', $numfolio)->first();

				return json_encode($data);
			} else {
				$agente = $this->_usuariosModel->asObject()->where('ID', $data->folio->AGENTEATENCIONID)->first();
				return json_encode(['status' => 2, 'motivo' => $data->folio->STATUS, 'agente' => $agente->NOMBRE . ' ' . $agente->APELLIDO_PATERNO . ' ' . $agente->APELLIDO_MATERNO]);
			}
		} else {
			return json_encode(['status' => 0]);
		}
	}

	public function getPersonaFisicaById()
	{
		$id = trim($this->request->getPost('id'));
		$folio = trim($this->request->getPost('folio'));
		$year = trim($this->request->getPost('year'));
		$idcalidad = trim($this->request->getPost('calidadId'));

		$data = (object)array();
		$data2 = (object)array();
		$data->personaid = $this->_folioPersonaFisicaModel->where('FOLIOID', $folio)->where('ANO', $year)->where('PERSONAFISICAID', $id)->where('CALIDADJURIDICAID', $idcalidad)->first();

		if ($data->personaid) {
			$data->calidadjuridica = $this->_folioPersonaCalidadJuridica->where('PERSONACALIDADJURIDICAID', $idcalidad)->first();
			$data->tipoidentificacion = $this->_tipoIdentificacionModel->where('PERSONATIPOIDENTIFICACIONID', $data->personaid['TIPOIDENTIFICACIONID'])->first();
			$data->edocivil = $this->_estadoCivilModel->where('PERSONAESTADOCIVILID', $data->personaid['ESTADOCIVILID'])->first();
			$data->idioma = $this->_idiomaModel->where('PERSONAIDIOMAID', $data->personaid['PERSONAIDIOMAID'])->first();
			$data->nacionalidad = $this->_nacionalidadModel->where('PERSONANACIONALIDADID', $data->personaid['NACIONALIDADID'])->first();
			$data->personaDesaparecida = $this->_folioPersonaFisicaDesaparecidaModel->where('ANO', $year)->where('FOLIOID', $folio)->where('PERSONAFISICAID', $id)->findAll();
			$data->estadoOrigen = $this->_estadosModel->where('ESTADOID', $data->personaid['ESTADOORIGENID'])->first();
			$data->municipioOrigen = $this->_municipiosModel->where('ESTADOID', $data->personaid['ESTADOORIGENID'])->where('MUNICIPIOID', $data->personaid['MUNICIPIOORIGENID'])->first();
			$data->escolaridad = $this->_escolaridadModel->where('PERSONAESCOLARIDADID', $data->personaid['ESCOLARIDADID'])->first();
			$data->ocupacion = $this->_ocupacionModel->where('PERSONAOCUPACIONID', $data->personaid['OCUPACIONID'])->first();

			$data2->persondom = $this->_folioPersonaFisicaDomicilioModel->where('ANO', $year)->where('FOLIOID', $folio)->where('PERSONAFISICAID', $id)->first();
			if ($data2->persondom) {
				$data2->estado = $this->_estadosModel->where('ESTADOID', $data2->persondom['ESTADOID'])->asObject()->first();
				$data2->municipio = $this->_municipiosModel->asObject()->where('ESTADOID', $data2->persondom['ESTADOID'])->where('MUNICIPIOID', $data2->persondom['MUNICIPIOID'])->first();
				$data2->localidad = $this->_localidadesModel->asObject()->where('ESTADOID', $data2->persondom['ESTADOID'])->where('MUNICIPIOID', $data2->persondom['MUNICIPIOID'])->where('LOCALIDADID', $data2->persondom['LOCALIDADID'])->first();
				$data2->colonia = $this->_coloniasModel->asObject()->where('ESTADOID', $data2->persondom['ESTADOID'])->where('MUNICIPIOID', $data2->persondom['MUNICIPIOID'])->where('COLONIAID', $data2->persondom['COLONIAID'])->first();
			}
			$data->domicilio = $data2;
			$data->status = 1;

			return json_encode($data);
		} else {
			$data2 = ['status' => 0];
			return json_encode($data2);
		}
	}

	public function joinFisico()
	{
		$data =  $this->_folioPersonaFisicaModel->join('PERSONACALIDADJURIDICA', 'PERSONACALIDADJURIDICA.PERSONACALIDADJURIDICAID =FOLIOPERSONAFISICA.CALIDADJURIDICAID')
			->where('FOLIOID', 402004202200001)->where('PERSONAFISICAID', 1)->first();
		return json_encode($data);
	}

	public function findPersonadDomicilioById()
	{
		$id = $this->request->getPost('id');
		$folio = $this->request->getPost('folio');

		$data = (object)array();

		$data->persondom = $this->_folioPersonaFisicaDomicilioModel->where('FOLIOID', $folio)->where('PERSONAFISICAID', $id)->first();
		$data->estado = $this->_estadosModel->where('ESTADOID', 2)->asObject()->first();
		$data->municipio = $this->_municipiosModel->asObject()->where('ESTADOID', 2)->where('MUNICIPIOID', $data->persondom['MUNICIPIOID'])->first();
		$data->localidad = $this->_localidadesModel->asObject()->where('ESTADOID', 2)->where('MUNICIPIOID', $data->persondom['MUNICIPIOID'])->where('LOCALIDADID', $data->persondom['LOCALIDADID'])->first();
		$data->colonia = $this->_coloniasModel->asObject()->where('ESTADOID', 2)->where('MUNICIPIOID', $data->persondom['MUNICIPIOID'])->where('COLONIAID', $data->persondom['COLONIAID'])->first();

		return json_encode($data);
	}

	public function findPersonadVehiculoById()
	{
		$data = (object)array();
		$id = $this->request->getPost('id');
		$folio = $this->request->getPost('folio');
		$data->vehiculo = $this->_folioVehiculoModel->where('FOLIOID', $folio)->first();
		$data->color = $this->_folioVehiculoModel->join('VEHICULOCOLOR', 'VEHICULOCOLOR.VEHICULOCOLORID  =FOLIOVEHICULO.PRIMERCOLORID')->where('FOLIOID', $folio)->first();
		$data->estadov = $this->_folioVehiculoModel->join('ESTADO', 'ESTADO.ESTADOID  =FOLIOVEHICULO.ESTADOIDPLACA')->where('FOLIOID', $folio)->first();
		$data->tipov = $this->_folioVehiculoModel->join('VEHICULOTIPO', 'VEHICULOTIPO.VEHICULOTIPOID   =FOLIOVEHICULO.TIPOID')->where('FOLIOID', $folio)->first();

		return json_encode($data);
	}

	public function enviarFolio()
	{
		$data = (object)array();
		$data->folioIn = $this->request->getPost('folioIn');
		return json_encode($data);
	}

	public function video_denuncia()
	{
		$data = (object)array();
		$data->folio = $this->request->getGet('folio');
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

	private function _sendEmailDerivacionCanalizacion($to, $folio, $motivo)
	{
		$email = \Config\Services::email();
		$email->setTo($to);
		$email->setSubject('Folio atendido');
		$body = view('email_template/folio_der_can_email_template.php', ['folio' => $folio, 'motivo' => $motivo]);
		$email->setMessage($body);
		if ($email->send()) {
			return true;
		} else {
			return false;
		}
	}

	private function _sendEmailExpediente($to, $folio, $expedienteId)
	{
		$email = \Config\Services::email();
		$email->setTo($to);
		$email->setSubject('Nuevo expediente creado');
		$body = view('email_template/expediente_email_template.php', ['expediente' => $expedienteId]);
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

	public function getOficinasByMunicipio()
	{
		$municipio = $this->request->getPost('municipio');

		if (!empty($municipio)) {
			$data = $this->_oficinasModel->asObject()->where('MUNICIPIOID', $municipio)->findAll();
			return json_encode($data);
		} else {
			$data = $this->_oficinasModel->asObject()->findAll();
			return json_encode($data);
		}
	}

	public function getEmpleadosByMunicipioAndOficina()
	{
		$municipio = $this->request->getPost('municipio');
		$oficina = $this->request->getPost('oficina');

		if (!empty($municipio) && !empty($municipio)) {
			$data = $this->_empleadosModel->asObject()->where('MUNICIPIOID', $municipio)->where('OFICINAID', $oficina)->findAll();
			return json_encode($data);
		} else {
			$data = $this->_empleadosModel->asObject()->findAll();
			return json_encode($data);
		}
	}

	public function updateStatusFolio()
	{
		$status = $this->request->getPost('status');
		$motivo = $this->request->getPost('motivo');
		$folio = $this->request->getPost('folio');
		$year = $this->request->getPost('year');
		$agenteId = session('ID') ? session('ID') : 1;

		$data = [
			'STATUS' => $status == 'ATENDIDA' ? 'CANALIZADO' : $status,
			'NOTASAGENTE' => $motivo,
			'AGENTEATENCIONID' => $agenteId,
		];
		if (!empty($status) && !empty($motivo) && !empty($year) && !empty($folio) && !empty($agenteId)) {
			$folioRow = $this->_folioModel->where('ANO', $year)->where('FOLIOID', $folio)->where('STATUS', 'ABIERTO')->first();
			if ($folioRow) {
				$update = $this->_folioModel->set($data)->where('FOLIOID', $folio)->update();
				if ($update) {
					$folio = $this->_folioModel->asObject()->where('FOLIOID', $folio)->first();
					$denunciante = $this->_denunciantesModel->asObject()->where('DENUNCIANTEID', $folio->DENUNCIANTEID)->first();
					if ($this->_sendEmailDerivacionCanalizacion($denunciante->CORREO, $folio->FOLIOID, $status)) {
						return json_encode(['status' => 1]);
					} else {
						return json_encode(['status' => 1]);
					}
				} else {
					return json_encode(['status' => 0, 'error' => 'No hizo el update']);
				}
			} else {
				return json_encode(['status' => 0, 'error' => 'Ya fue atendido el folio']);
			}
		} else {
			return json_encode(['status' => 0, 'error' => 'No existe alguna de las variables']);
		}
	}

	public function saveInJusticia()
	{
		$folio = $this->request->getPost('folio');
		$year = $this->request->getPost('year');
		$municipio = $this->request->getPost('municipio');
		$estado = empty($this->request->getPost('estado')) ? 2 : $this->request->getPost('estado');
		$notas = $this->request->getPost('notas');
		$oficina = $this->request->getPost('oficina');
		$empleado = $this->request->getPost('empleado');

		if (!empty($folio) && !empty($municipio) && !empty($estado) && !empty($notas) && !empty($oficina) && !empty($empleado)) {
			$folioRow = $this->_folioModel->where('ANO', $year)->where('FOLIOID', $folio)->where('STATUS', 'ABIERTO')->first();
			if ($folioRow) {
				$empleadoRow = $this->_empleadosModel->asObject()->where('MUNICIPIOID', $municipio)->where('OFICINAID', $oficina)->where('EMPLEADOID', $empleado)->first();
				$personas = $this->_folioPersonaFisicaModel->where('FOLIOID', $folioRow['FOLIOID'])->orderBy('PERSONAFISICAID', 'asc')->findAll();
				$narracion = $folioRow['HECHONARRACION'];
				$fecha = $folioRow['HECHOFECHA'];

				$folioRow['HECHOMUNICIPIOID'] = $municipio;
				$folioRow['HECHOESTADOID'] = $estado;
				$folioRow['HECHOMEDIOCONOCIMIENTOID'] = (string)6;
				$folioRow['NOTASAGENTE'] = $notas;
				$folioRow['STATUS'] = 'EXPEDIENTE';
				$folioRow['AGENTEATENCIONID'] = session('ID') ? session('ID') : 1;
				$folioRow['AGENTEFIRMAID'] = session('ID') ? session('ID') : 1;

				$update = $this->_folioModel->set($folioRow)->where('FOLIOID', $folio)->update();

				$folioRow['HECHOFECHA'] = $folioRow['HECHOFECHA'] . ' ' . $folioRow['HECHOHORA'];
				$folioRow['HECHONARRACION'] = $notas;

				$folioRow['OFICINAIDRESPONSABLE'] = $oficina;
				$folioRow['EMPLEADOIDREGISTRO'] = $empleado;
				$folioRow['AREAIDREGISTRO'] = $empleadoRow->AREAID;
				$folioRow['AREAIDRESPONSABLE'] = $empleadoRow->AREAID;
				$folioRow['ESTADOJURIDICOEXPEDIENTEID'] = (string)2;
				$folioRow['MUNICIPIOID'] = $municipio;
				$folioRow['ESTADOID'] = $estado;
				$folioRow['TIPOEXPEDIENTEID'] = 4;

				$expedienteCreado = $this->createExpediente($folioRow);

				unset($folioRow['OFICINAIDRESPONSABLE']);
				unset($folioRow['EMPLEADOIDREGISTRO']);
				unset($folioRow['AREAIDREGISTRO']);
				unset($folioRow['AREAIDRESPONSABLE']);
				unset($folioRow['ESTADOJURIDICOEXPEDIENTEID']);
				unset($folioRow['MUNICIPIOID']);
				unset($folioRow['ESTADOID']);
				unset($folioRow['TIPOEXPEDIENTEID']);

				$folioRow['HECHONARRACION'] = $narracion;
				$folioRow['HECHOFECHA'] = $fecha;

				foreach ($personas as $key => $persona) {
					$_persona = $this->createPersonaFisica($expedienteCreado->EXPEDIENTEID, $persona, $folioRow['HECHOMUNICIPIOID']);
					$domicilios = $this->_folioPersonaFisicaDomicilioModel->where('FOLIOID', $folioRow['FOLIOID'])->where('PERSONAFISICAID', $persona['PERSONAFISICAID'])->findAll();
					if ($persona['CALIDADJURIDICAID'] == '2') {
						$_imputado = $this->createExpImputado($expedienteCreado->EXPEDIENTEID, $_persona->PERSONAFISICAID, $folioRow['HECHOMUNICIPIOID']);
					}

					foreach ($domicilios as $key => $domicilio) {
						$_domicilio = $this->createDomicilioPersonaFisica($expedienteCreado->EXPEDIENTEID, 1, $domicilio, $folioRow['HECHOMUNICIPIOID']);
					}
				}

				if ($expedienteCreado->status == 201) {
					$update2 = $this->_folioModel->set(['EXPEDIENTEID' => $expedienteCreado->EXPEDIENTEID])->where('FOLIOID', $folio)->update();
					if ($update && $update2) {
						$denunciante = $this->_denunciantesModel->asObject()->where('DENUNCIANTEID', $folioRow['DENUNCIANTEID'])->first();
						if ($this->_sendEmailExpediente($denunciante->CORREO, $folio, $folioRow['EXPEDIENTEID'])) {
							return json_encode(['status' => 1, 'expediente' => $expedienteCreado->EXPEDIENTEID]);
						} else {
							return json_encode(['status' => 1, 'expediente' => $expedienteCreado->EXPEDIENTEID]);
						}
					} else {
						return json_encode(['status' => 0, 'error' => 'No hizo el update']);
					}
				} else {
					return json_encode(['status' => 0, 'error' => 'No se creo el expediente']);
				}
			} else {
				return json_encode(['status' => 0, 'error' => 'Ya fue atendido el folio']);
			}
		} else {
			return json_encode(['status' => 0, 'error' => 'No existe alguna de las variables']);
		}
	}

	private function createExpediente($folioRow)
	{
		$function = '/expediente.php?process=crear';
		$endpoint = $this->endpoint . $function;
		// $conexion = $this->_conexionesDBModel->asObject()->where('ESTADOID', 2)->where('MUNICIPIOID', (int)$folioRow['MUNICIPIOID'])->where('TYPE', !getenv('CI_ENVIRONMENT') ? 'production' : getenv('CI_ENVIRONMENT'))->first();
		$conexion = $this->_conexionesDBModel->asObject()->where('ESTADOID', 2)->where('MUNICIPIOID', (int)$folioRow['MUNICIPIOID'])->where('TYPE', 'production')->first();
		$array = [
			"ESTADOID",
			"MUNICIPIOID",
			"ANO",
			"HECHOMEDIOCONOCIMIENTOID",
			"HECHOFECHA",
			"HECHOLUGARID",
			"HECHOESTADOID",
			"HECHOMUNICIPIOID",
			"HECHOLOCALIDADID",
			"HECHODELEGACIONID",
			"HECHOZONA",
			"HECHOCOLONIAID",
			"HECHOCOLONIADESCR",
			"HECHOCALLE",
			"HECHONUMEROCASA",
			"HECHONUMEROCASAINT",
			"HECHOREFERENCIA",
			"HECHONARRACION",
			"TIPOEXPEDIENTEID",
			"PARTICIPAESTADO",
			"EMPLEADOIDREGISTRO",
			"OFICINAIDRESPONSABLE",
			"CONFIDENCIAL",
			"ESTADOJURIDICOEXPEDIENTEID",
			"RELACIONDOCUMENTOS",
			"HECHOCOORDENADAX",
			"HECHOCOORDENADAY",
			"PARTENUMERO",
			"PARTEFECHA",
			"PARTEAUTORIDADID",
			"PARTEAREADOID",
			"PARTEEMPLEADOID",
			"EXHORTONUMERO",
			"EXHORTOESTADOID",
			"EXHORTOMUNICIPIOID",
			"EXHORTOOFICINAID",
			"AREAIDREGISTRO",
			"AREAIDRESPONSABLE",
			"LOCALIZACIONPERSONA",
			"CONCLUIDO",
			"EXHORTOAUTORIDADID",
			"HECHOCLASIFICACIONLUGARID",
			"HECHOVIALIDADID"
		];

		$data = $folioRow;

		foreach ($data as $clave => $valor) {
			if (empty($valor)) unset($data[$clave]);
		}
		foreach ($data as $clave => $valor) {
			if (!in_array($clave, $array)) unset($data[$clave]);
		}

		$data['userDB'] = $conexion->USER;
		$data['pwdDB'] = $conexion->PASSWORD;
		$data['instance'] = $conexion->IP . '/' . $conexion->INSTANCE;
		$data['schema'] = $conexion->SCHEMA;

		return $this->curlPost($endpoint, $data);
	}

	private function createPersonaFisica($expedienteId, $personaFisica, $municipio)
	{
		$function = '/personaFisica.php?process=crear';
		$array = [
			'EXPEDIENTEID',
			'CALIDADJURIDICAID',
			'RESERVARIDENTIDAD',
			'DENUNCIANTE',
			'VIVA',
			'TIPOIDENTIFICACIONID',
			'NUMEROIDENTIFICACION',
			'APODO',
			'NOMBRE',
			'PRIMERAPELLIDO',
			'SEGUNDOAPELLIDO',
			'NUMEROIDENTIDAD',
			'ESTADOORIGENID',
			'MUNICIPIOORIGENID',
			'FECHANACIMIENTO',
			'SEXO',
			'TELEFONO',
			'CORREO',
			'EDADCANTIDAD',
			'EDADTIEMPO',
			'NACIONALIDADID',
			'ESTADOCIVILID',
			'ESTADOJURIDICOIMPUTADOID',
			'DESAPARECIDA',
			'PERSONATIPOMUERTEID',
			'PERSONARELIGIONID',
			'TIPOVIVIENDAID',
			'LUGARFRECUENTA',
			'VESTUARIO',
			'AFECTOBEBIDA',
			'BEBIDAS',
			'AFECTODROGA',
			'DROGAS',
			'SOLICITANTEASESORIA',
			'INGRESOS',
			'PERSONAIDIOMAID',
			'TIEMPORESIDEANOS',
			'TIEMPORESIDEMESES',
			'TIEMPORESIDEDIAS'
		];
		$endpoint = $this->endpoint . $function;
		// $conexion = $this->_conexionesDBModel->asObject()->where('ESTADOID', 2)->where('MUNICIPIOID', (int)$municipio)->where('TYPE', !getenv('CI_ENVIRONMENT') ? 'production' : getenv('CI_ENVIRONMENT'))->first();
		$conexion = $this->_conexionesDBModel->asObject()->where('ESTADOID', 2)->where('MUNICIPIOID', (int)$municipio)->where('TYPE', 'production')->first();
		$data = $personaFisica;

		foreach ($data as $clave => $valor) {
			if (empty($valor)) unset($data[$clave]);
		}
		foreach ($data as $clave => $valor) {
			if (!in_array($clave, $array)) unset($data[$clave]);
		}

		$data['EXPEDIENTEID'] = $expedienteId;
		$data['userDB'] = $conexion->USER;
		$data['pwdDB'] = $conexion->PASSWORD;
		$data['instance'] = $conexion->IP . '/' . $conexion->INSTANCE;
		$data['schema'] = $conexion->SCHEMA;

		return $this->curlPost($endpoint, $data);
	}

	private function createExpImputado($expedienteId, $personaFisicaId, $municipio)
	{
		$function = '/imputado.php?process=crear';
		$endpoint = $this->endpoint . $function;
		// $conexion = $this->_conexionesDBModel->asObject()->where('ESTADOID', 2)->where('MUNICIPIOID', (int)$municipio)->where('TYPE', !getenv('CI_ENVIRONMENT') ? 'production' : getenv('CI_ENVIRONMENT'))->first();
		$conexion = $this->_conexionesDBModel->asObject()->where('ESTADOID', 2)->where('MUNICIPIOID', (int)$municipio)->where('TYPE', 'production')->first();
		$data = array();

		$data['EXPEDIENTEID'] = $expedienteId;
		$data['PERSONAFISICAID'] = $personaFisicaId;
		$data['DETENIDO'] = 'N';
		$data['ESTADOJURIDICOIMPUTADOID'] = 1;
		$data['ETAPAIMPUTADOID'] = 1;
		$data['INDIVIDUALIZADO'] = 'N';

		$data['userDB'] = $conexion->USER;
		$data['pwdDB'] = $conexion->PASSWORD;
		$data['instance'] = $conexion->IP . '/' . $conexion->INSTANCE;
		$data['schema'] = $conexion->SCHEMA;

		foreach ($data as $clave => $valor) {
			if (empty($valor)) unset($data[$clave]);
		}

		return $this->curlPost($endpoint, $data);
	}

	private function createDomicilioPersonaFisica($expedienteId, $personaFisicaId, $domicilioPersonaFisica, $municipio)
	{
		$function = '/domicilio.php?process=crear';
		$array = [
			"EXPEDIENTEID",
			"PERSONAFISICAID",
			"TIPODOMICILIO",
			"ESTADOID",
			"MUNICIPIOID",
			"LOCALIDADID",
			"DELEGACIONID",
			"ZONA",
			"COLONIAID",
			"COLONIADESCR",
			"CALLE",
			"NUMEROCASA",
			"REFERENCIA",
			"NUMEROINTERIOR"
		];
		$endpoint = $this->endpoint . $function;
		// $conexion = $this->_conexionesDBModel->asObject()->where('ESTADOID', 2)->where('MUNICIPIOID', (int)$municipio)->where('TYPE', !getenv('CI_ENVIRONMENT') ? 'production' : getenv('CI_ENVIRONMENT'))->first();
		$conexion = $this->_conexionesDBModel->asObject()->where('ESTADOID', 2)->where('MUNICIPIOID', (int)$municipio)->where('TYPE', 'production')->first();
		$data = $domicilioPersonaFisica;

		$data['EXPEDIENTEID'] = $expedienteId;
		$data['PERSONAFISICAID'] = $personaFisicaId;
		if ($data['COLONIAID'] != 0) {
			unset($data['COLONIADESCR']);
		}
		unset($data['DOMICILIOID']);

		foreach ($data as $clave => $valor) {
			if (empty($valor)) unset($data[$clave]);
		}
		foreach ($data as $clave => $valor) {
			if (!in_array($clave, $array)) unset($data[$clave]);
		}
		$data['userDB'] = $conexion->USER;
		$data['pwdDB'] = $conexion->PASSWORD;
		$data['instance'] = $conexion->IP . '/' . $conexion->INSTANCE;
		$data['schema'] = $conexion->SCHEMA;

		$ch = curl_init();

		curl_setopt($ch, CURLOPT_URL, $endpoint);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

		$headers = array();
		$headers[] = 'Content-Type: application/json';
		$headers[] = 'Access-Control-Allow-Origin: *';
		$headers[] = 'Access-Control-Allow-Credentials: true';
		$headers[] = 'Access-Control-Allow-Headers: Content-Type';

		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

		$result = curl_exec($ch);

		if ($result === FALSE) {
			die('Curl failed: ' . curl_error($ch));
		}

		curl_close($ch);

		return $result;
	}

	private function curlPost($endpoint, $data)
	{
		$ch = curl_init();

		curl_setopt($ch, CURLOPT_URL, $endpoint);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

		$headers = array();
		$headers[] = 'Content-Type: application/json';
		$headers[] = 'Access-Control-Allow-Origin: *';
		$headers[] = 'Access-Control-Allow-Credentials: true';
		$headers[] = 'Access-Control-Allow-Headers: Content-Type';

		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

		$result = curl_exec($ch);

		if ($result === FALSE) {
			die('Curl failed: ' . curl_error($ch));
		}

		curl_close($ch);

		return json_decode($result);
	}

	public function getVideoLink()
	{
		$folio = $this->request->getPost('folio');
		$endpoint = 'https://videodenunciaserver1.fgebc.gob.mx/api/vc';
		$data = array();
		$data['u'] = '24';
		$data['token'] = '198429b7cc8a2a5733d97bc13153227dd5017555';
		$data['a'] = 'getRepo';
		$data['folio'] = $folio;
		$data['min'] = !empty($this->request->getPost('min')) ? $this->request->getPost('min') : '2000-01-01';
		$data['max'] = !empty($this->request->getPost('max')) ? $this->request->getPost('max') : date("Y-m-d");

		$response = $this->curlPost($endpoint, $data);

		return json_encode($response);
	}
	public function restoreFolio()
	{
		$folio = $this->request->getPost('folio');

		if (!empty($folio)) {
			$folioRow = $this->_folioModel->where('FOLIOID', $folio)->first();
			$folioRow['ESTADOID'] = 2;
			$folioRow['OFICINAIDRESPONSABLE'] = NULL;
			$folioRow['EMPLEADOIDREGISTRO'] = NULL;
			$folioRow['AREAIDREGISTRO'] = NULL;
			$folioRow['AREAIDRESPONSABLE'] = NULL;
			$folioRow['ESTADOJURIDICOEXPEDIENTEID'] = NULL;
			$folioRow['HECHOMEDIOCONOCIMIENTOID'] = NULL;
			$folioRow['NOTASAGENTE'] = NULL;
			$folioRow['STATUS'] = 'ABIERTO';
			$folioRow['EXPEDIENTEID'] = NULL;
			$folioRow['AGENTEATENCIONID'] = NULL;
			$folioRow['AGENTEFIRMAID'] = NULL;

			$this->_folioModel->set($folioRow)->where('FOLIOID', $folio)->update();

			return json_encode(['status' => 1]);
		}
	}
}

/* End of file DashboardController.php */
/* Location: ./app/Controllers/admin/DashboardController.php */
