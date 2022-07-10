<?php

namespace App\Controllers\admin;

use App\Controllers\BaseController;
use App\Models\DenunciantesModel;

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
use App\Models\OficinasModel;
use App\Models\EmpleadosModel;
use App\Models\PersonaCalidadJuridicaModel;

use App\Models\MunicipiosModel;
use App\Models\LocalidadesModel;
use App\Models\ColoniasModel;
use App\Models\ConexionesDBModel;


class DashboardController extends BaseController
{

	function __construct()
	{
		//Models
		$this->_denunciantesModel = new DenunciantesModel();

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
		$this->_oficinasModel = new OficinasModel();
		$this->_empleadosModel = new EmpleadosModel();
		$this->_folioPersonaCalidadJuridica = new PersonaCalidadJuridicaModel();

		$this->_municipiosModel = new MunicipiosModel();
		$this->_localidadesModel = new LocalidadesModel();
		$this->_coloniasModel = new ColoniasModel();

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
		$data->cantidad_folios = count($this->_folioModel->asObject()->findAll());
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
		$data->zonas = $this->_zonasUsuariosModel->asObject()->findAll();
		$data->roles = $this->_rolesUsuariosModel->asObject()->findAll();
		$this->_loadView('Nuevo usuario', 'registrarusuario', '', $data, 'new_user');
	}

	public function denuncia_anonima()
	{
		$data = (object)array();
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
			'CERTIFICADOFIRMA' => $this->request->getPost('cer'),
			'KEYFIRMA' => $this->request->getPost('key'),
			'FRASEFIRMA' => $this->request->getPost('frase'),
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
		$numfolio = $this->request->getPost('folio');
		$data->folio = $this->_folioModel->asObject()->where('FOLIOID', $numfolio)->first();

		if ($data->folio) {
			if ($data->folio->STATUS == 'ABIERTO') {
				$data->status = 1;
				$data->preguntas_iniciales = $this->_folioPreguntasModel->where('FOLIOID', $numfolio)->first();
				$data->personas = $this->_folioPersonaFisicaModel->join('PERSONACALIDADJURIDICA', 'PERSONACALIDADJURIDICA.PERSONACALIDADJURIDICAID = FOLIOPERSONAFISICA.CALIDADJURIDICAID')->where('FOLIOID', $numfolio)->orderBy('PERSONAFISICAID', 'asc')->findAll();
				$data->domicilios = $this->_folioPersonaFisicaDomicilioModel->where('FOLIOID', $numfolio)->findAll();
				$data->vehiculos = $this->_folioVehiculoModel->where('FOLIOID', $numfolio)->findAll();

				$data->folioMunicipio = $this->_municipiosModel->asObject()->where('ESTADOID', 2)->where('MUNICIPIOID', $data->folio->HECHOMUNICIPIOID)->first();
				$data->folioColonia = $this->_coloniasModel->asObject()->where('ESTADOID', 2)->where('MUNICIPIOID', $data->folio->HECHOMUNICIPIOID)->where('COLONIAID', $data->folio->HECHOCOLONIAID)->first();
				$data->folioLugar = $this->_folioModel->join('CATEGORIA_HECHOLUGAR', 'CATEGORIA_HECHOLUGAR.HECHOLUGARID = FOLIO.HECHOLUGARID')->where('FOLIOID', $numfolio)->first();

				return json_encode($data);
			} else {
				$agente = $this->_usuariosModel->asObject()->where('ID', $data->folio->AGENTEATENCIONID)->first();
				return json_encode(['status' => 2, 'motivo' => $data->folio->STATUS, 'agente' => $agente->NOMBRE . ' ' . $agente->APELLIDO_PATERNO . ' ' . $agente->APELLIDO_MATERNO]);
			}
		} else {
			return json_encode(['status' => 0]);
		}
	}

	public function findPersonaFisicaById()
	{
		$data = (object)array();
		$id = $this->request->getPost('id');
		$folio = $this->request->getPost('folio');
		$idcalidad = $this->request->getPost('idcalidad');
		$data->personaid = $this->_folioPersonaFisicaModel->where('FOLIOID', $folio)->where('PERSONAFISICAID', $id)->first();

		// $data['data'] = $data;
		$data->calidadjuridica = $this->_folioPersonaFisicaModel->join('PERSONACALIDADJURIDICA', 'PERSONACALIDADJURIDICA.PERSONACALIDADJURIDICAID =FOLIOPERSONAFISICA.CALIDADJURIDICAID')->where('FOLIOID', $folio)->where('PERSONAFISICAID', $id)->where('CALIDADJURIDICAID', $idcalidad)->first();
		$data->tipoidentificacion = $this->_folioPersonaFisicaModel->join('CATEGORIA_PERSONATIPOIDENTIFICACION', 'CATEGORIA_PERSONATIPOIDENTIFICACION.PERSONATIPOIDENTIFICACIONID =FOLIOPERSONAFISICA.TIPOIDENTIFICACIONID')->where('FOLIOID', $folio)->where('PERSONAFISICAID', $id)->first();
		$data->edocivil = $this->_folioPersonaFisicaModel->join('CATEGORIA_PERSONAEDOCIVIL', 'CATEGORIA_PERSONAEDOCIVIL.PERSONAESTADOCIVILID =FOLIOPERSONAFISICA.ESTADOCIVILID')->where('FOLIOID', $folio)->where('PERSONAFISICAID', $id)->first();
		$data->idioma = $this->_folioPersonaFisicaModel->join('CATEGORIA_PERSONAIDIOMA', 'CATEGORIA_PERSONAIDIOMA.PERSONAIDIOMAID  =FOLIOPERSONAFISICA.PERSONAIDIOMAID')->where('FOLIOID', $folio)->where('PERSONAFISICAID', $id)->first();

		$data->nacionalidad = $this->_folioPersonaFisicaModel->join('CATEGORIA_PERSONANACIONALIDAD', 'CATEGORIA_PERSONANACIONALIDAD.PERSONANACIONALIDADID =FOLIOPERSONAFISICA.NACIONALIDADID')->where('FOLIOID', $folio)->where('PERSONAFISICAID', $id)->first();
		$data->personaDesaparecida = $this->_folioPersonaFisicaDesaparecidaModel->where('FOLIOID', $folio)->where('PERSONAFISICAID', $id)->findAll();

		//	return view('admin/dashboard/video_denuncia_modals/info_folio_modal', $data);
		return json_encode($data);
	}
	public function joinFisico()
	{
		$data =  $this->_folioPersonaFisicaModel->join('PERSONACALIDADJURIDICA', 'PERSONACALIDADJURIDICA.PERSONACALIDADJURIDICAID =FOLIOPERSONAFISICA.CALIDADJURIDICAID')
			->where('FOLIOID', 402004202200001)->where('PERSONAFISICAID', 1)->first();
		return json_encode($data);
	}
	public function findPersonadDomicilioById()
	{
		$data = (object)array();
		$id = $this->request->getPost('id');
		$folio = $this->request->getPost('folio');
		$idestado = $this->request->getPost('idestado');
		$idmunicipio = $this->request->getPost('idmunicipio');

		$data->persondom = $this->_folioPersonaFisicaDomicilioModel->where('FOLIOID', $folio)->where('PERSONAFISICAID', $id)->first();
		$data->estado = $this->_folioPersonaFisicaDomicilioModel->join('CATEGORIA_ESTADO', 'CATEGORIA_ESTADO.ESTADOID =FOLIOPERSONAFISDOMICILIO.ESTADOID')->where('FOLIOID', $folio)->where('PERSONAFISICAID', $id)->first();
		$data->municipio = $this->_folioPersonaFisicaDomicilioModel->join('CATEGORIA_MUNICIPIO', 'CATEGORIA_MUNICIPIO.MUNICIPIOID =FOLIOPERSONAFISDOMICILIO.MUNICIPIOID')->where('FOLIOID', $folio)->where('PERSONAFISICAID', $id)->first();
		$data->localidad = $this->_folioPersonaFisicaDomicilioModel->join('CATEGORIA_LOCALIDAD', 'CATEGORIA_LOCALIDAD.LOCALIDADID =FOLIOPERSONAFISDOMICILIO.LOCALIDADID')->where('FOLIOID', $folio)->where('PERSONAFISICAID', $id)->first();

		return json_encode($data);
	}
	public function findPersonadVehiculoById()
	{
		$data = (object)array();
		$id = $this->request->getPost('id');
		$folio = $this->request->getPost('folio');
		$data->vehiculo = $this->_folioVehiculoModel->where('FOLIOID', $folio)->first();
		$data->color = $this->_folioVehiculoModel->join('CATEGORIA_VEHICULOCOLOR', 'CATEGORIA_VEHICULOCOLOR.VEHICULOCOLORID  =FOLIOVEHICULO.PRIMERCOLORID')->where('FOLIOID', $folio)->first();
		$data->estadov = $this->_folioVehiculoModel->join('CATEGORIA_ESTADO', 'CATEGORIA_ESTADO.ESTADOID  =FOLIOVEHICULO.ESTADOIDPLACA')->where('FOLIOID', $folio)->first();
		$data->tipov = $this->_folioVehiculoModel->join('CATEGORIA_VEHICULOTIPO', 'CATEGORIA_VEHICULOTIPO.VEHICULOTIPOID   =FOLIOVEHICULO.TIPOID')->where('FOLIOID', $folio)->first();

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
		// $data->var= $this->enviarFolio();
		$data->folio = $this->request->getGet('folio');
		// $data->folios = $this->_folioModel->asObject()->where('FOLIOID', $data->folio)->first();
		// $data->domicilio = $this->_folioPersonaFisicaDomicilioModel->asObject()->where('FOLIOID', $data->folio)->first();

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

	public function saveInJusticia()
	{
		$folio = $this->request->getPost('folio');
		$municipio = $this->request->getPost('municipio');
		$estado = empty($this->request->getPost('estado')) ? 2 : $this->request->getPost('estado');
		$notas = $this->request->getPost('notas');
		$oficina = $this->request->getPost('oficina');
		$empleado = $this->request->getPost('empleado');

		if (!empty($folio) && !empty($municipio) && !empty($estado) && !empty($notas) && !empty($oficina) && !empty($empleado)) {
			$folioRow = $this->_folioModel->where('FOLIOID', $folio)->first();
			$empleadoRow = $this->_empleadosModel->asObject()->where('MUNICIPIOID', $municipio)->where('OFICINAID', $oficina)->where('EMPLEADOID', $empleado)->first();
			$personas = $this->_folioPersonaFisicaModel->where('FOLIOID', $folioRow['FOLIOID'])->orderBy('PERSONAFISICAID', 'asc')->findAll();
			$narracion = $folioRow['HECHONARRACION'];
			$fecha = $folioRow['HECHOFECHA'];

			$folioRow['MUNICIPIOID'] = $municipio;
			$folioRow['ESTADOID'] = $estado;
			$folioRow['OFICINAIDRESPONSABLE'] = $oficina;
			$folioRow['EMPLEADOIDREGISTRO'] = $empleado;
			$folioRow['AREAIDREGISTRO'] = $empleadoRow->AREAID;
			$folioRow['AREAIDRESPONSABLE'] = $empleadoRow->AREAID;
			$folioRow['ESTADOJURIDICOEXPEDIENTEID'] = (string)2;
			$folioRow['HECHOMEDIOCONOCIMIENTOID'] = (string)5;
			$folioRow['NOTASAGENTE'] = $notas;
			$folioRow['STATUS'] = 'EXPEDIENTE';
			$folioRow['AGENTEATENCIONID'] = session('ID');
			$folioRow['AGENTEFIRMAID'] = session('ROLID') != '5' ? session('ID') : NULL;

			$update = $this->_folioModel->set($folioRow)->where('FOLIOID', $folio)->update();

			$folioRow['HECHOFECHA'] = $folioRow['HECHOFECHA'] . ' ' . $folioRow['HECHOHORA'];
			$folioRow['HECHONARRACION'] = $notas;

			$expedienteCreado = $this->createExpediente($folioRow);

			$folioRow['HECHONARRACION'] = $narracion;
			$folioRow['HECHOFECHA'] = $fecha;

			foreach ($personas as $key => $persona) {
				$_persona = $this->createPersonaFisica($expedienteCreado->EXPEDIENTEID, $persona, $folioRow['MUNICIPIOID']);
				$domicilios = $this->_folioPersonaFisicaDomicilioModel->where('FOLIOID', $folioRow['FOLIOID'])->where('PERSONAFISICAID', $persona['PERSONAFISICAID'])->findAll();
				if ($persona['CALIDADJURIDICAID'] == '2') {
					$this->createExpImputado($expedienteCreado->EXPEDIENTEID, $_persona->PERSONAFISICAID, $folioRow['MUNICIPIOID']);
				}

				foreach ($domicilios as $key => $domicilio) {
					$this->createDomicilioPersonaFisica($expedienteCreado->EXPEDIENTEID, $_persona->PERSONAFISICAID, $domicilio, $folioRow['MUNICIPIOID']);
				}
			}

			if ($expedienteCreado->status == 201) {
				$folioRow['EXPEDIENTEID'] = $expedienteCreado->EXPEDIENTEID;
				$update2 = $this->_folioModel->set($folioRow)->where('FOLIOID', $folio)->update();
				if ($update && $update2) {
					$denunciante = $this->_denunciantesModel->asObject()->where('ID_DENUNCIANTE', $folioRow['DENUNCIANTEID'])->first();
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
			return json_encode(['status' => 0, 'error' => 'No existe alguna de las variables']);
		}
	}

	private function createExpediente($folioRow)
	{
		// header('Content-Type: application/json');
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

		return $this->curlPost($endpoint, $data);
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

		$response = $this->curlPost($endpoint, $data);

		return json_encode($response);
	}
}

/* End of file DashboardController.php */
/* Location: ./app/Controllers/admin/DashboardController.php */
