<?php

namespace App\Controllers\admin;

use App\Controllers\BaseController;
use App\Models\BandejaRacModel;
use App\Models\CabelloColorModel;
use App\Models\CabelloEstiloModel;
use App\Models\CabelloTamanoModel;
use App\Models\CejaFormaModel;
use App\Models\ColoniasModel;
use App\Models\ConexionesDBModel;
use App\Models\DelitosUsuariosModel;
use App\Models\DenunciantesModel;
use App\Models\EmpleadosModel;
use App\Models\EscolaridadModel;
use App\Models\EstadosModel;
use App\Models\FiguraModel;
use App\Models\FolioModel;
use App\Models\FolioPersonaFisicaDomicilioModel;
use App\Models\FolioPersonaFisicaMediaFiliacionModel;
use App\Models\FolioPersonaFisicaModel;
use App\Models\FolioPreguntasModel;
use App\Models\FolioVehiculoModel;
use App\Models\FrenteFormaModel;
use App\Models\HechoLugarModel;
use App\Models\LocalidadesModel;
use App\Models\MunicipiosModel;
use App\Models\OcupacionModel;
use App\Models\OficinasModel;
use App\Models\OjoColorModel;
use App\Models\PaisesModel;
use App\Models\ParentescoModel;
use App\Models\PersonaCalidadJuridicaModel;
use App\Models\PersonaEstadoCivilModel;
use App\Models\PersonaFisicaParentescoModel;
use App\Models\PersonaIdiomaModel;
use App\Models\PersonaNacionalidadModel;
use App\Models\PersonaTipoIdentificacionModel;
use App\Models\PielColorModel;
use App\Models\BarbaPeculiarModel;

use App\Models\RolesUsuariosModel;
use App\Models\UsuariosModel;
use App\Models\VehiculoColorModel;
use App\Models\VehiculoTipoModel;
use App\Models\ZonasUsuariosModel;
use App\Models\FrenteAlturaModel;
use App\Models\FrenteAnchuraModel;
use App\Models\FrentePeculiarModel;
use App\Models\HombroGrosorModel;
use App\Models\HombroLongitudModel;
use App\Models\HombroPosicionModel;
use App\Models\LabioGrosorModel;
use App\Models\LabioLongitudModel;
use App\Models\LabioPeculiarModel;
use App\Models\LabioPosicionModel;
use App\Models\NarizBaseModel;
use App\Models\NarizPeculiarModel;
use App\Models\NarizTamanoModel;
use App\Models\NarizTipoModel;
use App\Models\OjoColocacionModel;
use App\Models\OjoFormaModel;
use App\Models\OjoPeculiarModel;
use App\Models\OjoTamanoModel;
use App\Models\OrejaFormaModel;
use App\Models\OrejaLobuloModel;
use App\Models\OrejaTamanoModel;
use App\Models\PersonaEtniaModel;
use App\Models\BarbaTamanoModel;
use App\Models\BarbillaTamanoModel;
use App\Models\BarbillaFormaModel;
use App\Models\BarbillaInclinacionModel;
use App\Models\BarbillaPeculiarModel;
use App\Models\BigoteFormaModel;
use App\Models\BigoteGrosorModel;
use App\Models\BigotePeculiarModel;
use App\Models\BigoteTamanoModel;
use App\Models\BitacoraActividadModel;
use App\Models\BocaPeculiarModel;
use App\Models\BocaTamanoModel;
use App\Models\CaraFormaModel;
use App\Models\CaraTamanoModel;
use App\Models\CaraTezModel;
use App\Models\CejaColocacionModel;
use App\Models\CejaContexturaModel;
use App\Models\CejaGrosorModel;
use App\Models\CejaTamanoModel;

use App\Models\CuelloGrosorModel;
use App\Models\CuelloPeculiarModel;
use App\Models\CuelloTamanoModel;

use App\Models\DientePeculiarModel;
use App\Models\DienteTamanoModel;
use App\Models\DienteTipoModel;
use App\Models\EstomagoModel;
use App\Models\CabelloPeculiarModel;
use App\Models\CanalizacionesModel;
use App\Models\DelitoModalidadModel;
use App\Models\DerivacionesModel;
use App\Models\EstadoExtranjeroModel;
use App\Models\FolioArchivoExternoModel;
use App\Models\FolioConsecutivoModel;
use App\Models\FolioDocModel;
use App\Models\FolioObjetoModel;
use App\Models\FolioPersonaFisImpDelitoModel;
use App\Models\FolioRelacionFisFisModel;
use App\Models\ObjetoClasificacionModel;
use App\Models\ObjetoSubclasificacionModel;
use App\Models\PermisosModel;
use App\Models\PlantillasModel;
use App\Models\RelacionFolioDocExpDocModel;
use App\Models\RelacionFolioDocModel;
use App\Models\RolesPermisosModel;
use App\Models\TipoExpedienteModel;
use App\Models\TipoMonedaModel;
use App\Models\VehiculoDistribuidorModel;
use App\Models\VehiculoMarcaModel;
use App\Models\VehiculoModeloModel;
use App\Models\VehiculoServicioModel;
use App\Models\VehiculoVersionModel;

use \Mpdf\Mpdf;
use RtfHtmlPhp\Document;
use RtfHtmlPhp\Html\HtmlFormatter;
use PHPRtfLite;
use PHPRtfLite_Font;
use PHPRtfLite_ParFormat;

class DashboardController extends BaseController
{

	private $_paisesModel;
	private $_estadosModel;
	private $_municipiosModel;
	private $_localidadesModel;
	private $_coloniasModel;
	private $_hechoLugarModel;
	private $_coloresVehiculoModel;
	private $_tipoVehiculoModel;
	private $_delitosUsuariosModel;
	private $_denunciantesModel;
	private $_idiomaModel;
	private $_folioModel;
	private $_folioPreguntasModel;
	private $_folioPersonaFisicaModel;
	private $_folioPersonaFisicaDomicilioModel;
	private $_folioVehiculoModel;
	private $_usuariosModel;
	private $_zonasUsuariosModel;
	private $_rolesUsuariosModel;
	private $_oficinasModel;
	private $_empleadosModel;
	private $_folioPersonaCalidadJuridica;
	private $_tipoIdentificacionModel;
	private $_escolaridadModel;
	private $_ocupacionModel;
	private $_estadoCivilModel;
	private $_nacionalidadModel;
	private $_folioMediaFiliacion;
	private $_parentescoPersonaFisicaModel;
	private $_figuraModel;
	private $_cejaContexturaModel;
	private $_caraFormaModel;
	private $_caraTamanoModel;
	private $_caraTezModel;
	private $_orejaLobuloModel;
	private $_orejaFomaModel;
	private $_orejaTamanoModel;
	private $_cabelloColorModel;
	private $_cabelloEstiloModel;
	private $_cabelloTamanoModel;
	private $_cabelloPeculiarModel;
	private $_frenteAlturaModel;
	private $_frenteAnchuraModel;
	private $_frenteFormaModel;
	private $_frentePeculiarModel;
	private $_cejaColocacionModel;
	private $_cejaFormaModel;
	private $_cejaTamanoModel;
	private $_cejaGrosorModel;
	private $_ojoColocacionModel;
	private $_ojoFormaModel;
	private $_ojoTamanoModel;
	private $_ojoColorModel;
	private $_ojoPeculiarModel;
	private $_narizTipoModel;
	private $_narizTamanoModel;
	private $_narizBaseModel;
	private $_narizPeculiarModel;
	private $_bigoteFormaModel;
	private $_bigoteTamanoModel;
	private $_bigoteGrosorModel;
	private $_bigotePeculiarModel;
	private $_bocaTamanoModel;
	private $_bocaPeculiarModel;
	private $_labioGrosorModel;
	private $_labioLongitudModel;
	private $_labioPeculiarModel;
	private $_labioPosicionModel;
	private $_dienteTamanoModel;
	private $_dienteTipoModel;
	private $_dientePeculiarModel;
	private $_barbillaFormaModel;
	private $_barbillaTamanoModel;
	private $_barbillaInclinacionModel;
	private $_barbillaPeculiarModel;
	private $_barbaTamanoModel;
	private $_barbaPeculiarModel;
	private $_cuelloTamanoModel;
	private $_cuelloGrosorModel;
	private $_cuelloPeculiarModel;
	private $_hombroPosicionModel;
	private $_hombroLongitudModel;
	private $_hombroGrosorModel;
	private $_estomagoModel;
	private $_etniaModel;
	private $_parentescoModel;
	private $_pielColorModel;
	private $_conexionesDBModel;
	private $_bitacoraActividadModel;
	private $_delitoModalidadModel;
	private $_imputadoDelitoModel;
	private $_relacionIDOModel;
	private $_archivoExternoModel;
	private $_objetoClasificacionModel;
	private $_objetoSubclasificacionModel;
	private $_folioObjetoInvolucradoModel;
	private $_tipoMonedaModel;
	private $_plantillasModel;
	private $_folioDocModel;
	private $_tipoExpedienteModel;
	private $_relacionFolioDocModel;
	private $_vehiculoDistribuidorModel;
	private $_vehiculoMarcaModel;
	private $_vehiculoModeloModel;
	private $_vehiculoVersionModel;
	private $_vehiculoServicioModel;
	private $_estadosExtranjeros;
	private $_rolesPermisosModel;
	private $_permisosModel;
	private $_folioConsecutivoModel;
	private $_relacionFolioDocExpDoc;
	private $_derivacionesAtencionesModel;
	private $_canalizacionesAtencionesModel;
	private $_bandejaRacModel;

	private $protocol;
	private $ip;
	private $endpoint;

	public function __construct()
	{
		//Models
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
		$this->_folioVehiculoModel = new FolioVehiculoModel();

		$this->_usuariosModel = new UsuariosModel();
		$this->_zonasUsuariosModel = new ZonasUsuariosModel();
		$this->_rolesUsuariosModel = new RolesUsuariosModel();
		$this->_oficinasModel = new OficinasModel();
		$this->_empleadosModel = new EmpleadosModel();
		$this->_folioPersonaCalidadJuridica = new PersonaCalidadJuridicaModel();
		$this->_tipoIdentificacionModel = new PersonaTipoIdentificacionModel();

		$this->_escolaridadModel = new EscolaridadModel();
		$this->_ocupacionModel = new OcupacionModel();
		$this->_estadoCivilModel = new PersonaEstadoCivilModel();
		$this->_nacionalidadModel = new PersonaNacionalidadModel();
		$this->_folioMediaFiliacion = new FolioPersonaFisicaMediaFiliacionModel();

		$this->_parentescoPersonaFisicaModel = new PersonaFisicaParentescoModel();
		$this->_figuraModel = new FiguraModel();
		$this->_cejaContexturaModel = new CejaContexturaModel();
		$this->_caraFormaModel = new CaraFormaModel();
		$this->_caraTamanoModel = new CaraTamanoModel();
		$this->_caraTezModel = new CaraTezModel();
		$this->_orejaLobuloModel = new OrejaLobuloModel();
		$this->_orejaFomaModel = new OrejaFormaModel();
		$this->_orejaTamanoModel = new OrejaTamanoModel();
		$this->_cabelloColorModel = new CabelloColorModel();
		$this->_cabelloEstiloModel = new CabelloEstiloModel();
		$this->_cabelloTamanoModel = new CabelloTamanoModel();
		$this->_cabelloPeculiarModel = new CabelloPeculiarModel();
		$this->_frenteAlturaModel = new FrenteAlturaModel();
		$this->_frenteAnchuraModel = new FrenteAnchuraModel();
		$this->_frenteFormaModel = new FrenteFormaModel();
		$this->_frentePeculiarModel = new FrentePeculiarModel();
		$this->_cejaColocacionModel = new CejaColocacionModel();
		$this->_cejaFormaModel = new CejaFormaModel();
		$this->_cejaTamanoModel = new CejaTamanoModel();
		$this->_cejaGrosorModel = new CejaGrosorModel();
		$this->_ojoColocacionModel = new OjoColocacionModel();
		$this->_ojoFormaModel = new OjoFormaModel();
		$this->_ojoTamanoModel = new OjoTamanoModel();
		$this->_ojoColorModel = new OjoColorModel();
		$this->_ojoPeculiarModel = new OjoPeculiarModel();
		$this->_narizTipoModel = new NarizTipoModel();
		$this->_narizTamanoModel = new NarizTamanoModel();
		$this->_narizBaseModel = new NarizBaseModel();
		$this->_narizPeculiarModel = new NarizPeculiarModel();
		$this->_bigoteFormaModel = new BigoteFormaModel();
		$this->_bigoteTamanoModel = new BigoteTamanoModel();
		$this->_bigoteGrosorModel = new BigoteGrosorModel();
		$this->_bigotePeculiarModel = new BigotePeculiarModel();
		$this->_bocaTamanoModel = new BocaTamanoModel();
		$this->_bocaPeculiarModel = new BocaPeculiarModel();
		$this->_labioGrosorModel = new LabioGrosorModel();
		$this->_labioLongitudModel = new LabioLongitudModel();
		$this->_labioPeculiarModel = new LabioPeculiarModel();
		$this->_labioPosicionModel = new LabioPosicionModel();
		$this->_dienteTamanoModel = new DienteTamanoModel();
		$this->_dienteTipoModel = new DienteTipoModel();
		$this->_dientePeculiarModel = new DientePeculiarModel();
		$this->_barbillaFormaModel = new BarbillaFormaModel();
		$this->_barbillaTamanoModel = new BarbillaTamanoModel();
		$this->_barbillaInclinacionModel = new BarbillaInclinacionModel();
		$this->_barbillaPeculiarModel = new BarbillaPeculiarModel();
		$this->_barbaTamanoModel = new BarbaTamanoModel();
		$this->_barbaPeculiarModel = new BarbaPeculiarModel();
		$this->_cuelloTamanoModel = new CuelloTamanoModel();
		$this->_cuelloGrosorModel = new CuelloGrosorModel();
		$this->_cuelloPeculiarModel = new CuelloPeculiarModel();
		$this->_hombroPosicionModel = new HombroPosicionModel();
		$this->_hombroLongitudModel = new HombroLongitudModel();
		$this->_hombroGrosorModel = new HombroGrosorModel();
		$this->_estomagoModel = new EstomagoModel();
		$this->_etniaModel = new PersonaEtniaModel();
		$this->_parentescoModel = new ParentescoModel();
		$this->_pielColorModel = new PielColorModel();
		$this->_conexionesDBModel = new ConexionesDBModel();
		$this->_bitacoraActividadModel = new BitacoraActividadModel();
		$this->_delitoModalidadModel = new DelitoModalidadModel();
		$this->_imputadoDelitoModel = new FolioPersonaFisImpDelitoModel();
		$this->_relacionIDOModel = new FolioRelacionFisFisModel();
		$this->_archivoExternoModel = new FolioArchivoExternoModel();
		$this->_objetoClasificacionModel = new ObjetoClasificacionModel();
		$this->_objetoSubclasificacionModel = new ObjetoSubclasificacionModel();
		$this->_folioObjetoInvolucradoModel = new FolioObjetoModel();
		$this->_tipoMonedaModel = new TipoMonedaModel();

		$this->_plantillasModel = new PlantillasModel();
		$this->_folioDocModel = new FolioDocModel();
		$this->_tipoExpedienteModel = new TipoExpedienteModel();
		$this->_relacionFolioDocModel = new RelacionFolioDocModel();
		$this->_vehiculoDistribuidorModel = new VehiculoDistribuidorModel();
		$this->_vehiculoMarcaModel = new VehiculoMarcaModel();
		$this->_vehiculoModeloModel = new VehiculoModeloModel();
		$this->_vehiculoVersionModel = new VehiculoVersionModel();
		$this->_vehiculoServicioModel = new VehiculoServicioModel();
		$this->_estadosExtranjeros = new EstadoExtranjeroModel();
		$this->_rolesPermisosModel = new RolesPermisosModel();
		$this->_permisosModel = new PermisosModel();

		$this->_folioConsecutivoModel = new FolioConsecutivoModel();
		$this->_relacionFolioDocExpDoc = new RelacionFolioDocExpDocModel();

		$this->_derivacionesAtencionesModel = new DerivacionesModel();
		$this->_canalizacionesAtencionesModel = new CanalizacionesModel();

		$this->_bandejaRacModel = new BandejaRacModel();

		// $this->protocol = 'http://';
		// $this->ip = "10.144.244.223";
		// $this->endpoint = $this->protocol . $this->ip . '/webServiceVD';
		$this->protocol = 'https://';
		$this->ip = "ws.fgebc.gob.mx";
		$this->endpoint = $this->protocol . $this->ip . '/webServiceVD';
	}

	public function index()
	{
		$data = (object) array();
		$agente = $this->_usuariosModel->asObject()->where('ID', session('ID'))->first();
		$roles = [1, 2, 6, 7, 8, 9, 10, 11];

		if (in_array($agente->ROLID, $roles)) {
			$data->cantidad_folios = count($this->_folioModel->asObject()->findAll());
			$data->cantidad_abiertos = count($this->_folioModel->asObject()->where('STATUS', 'ABIERTO')->findAll());
			$data->cantidad_derivados = count($this->_folioModel->asObject()->where('STATUS', 'DERIVADO')->findAll());
			$data->cantidad_canalizados = count($this->_folioModel->asObject()->where('STATUS', 'CANALIZADO')->findAll());
			$data->cantidad_expedientes = count($this->_folioModel->asObject()->where('EXPEDIENTEID !=', null)->where('AGENTEATENCIONID !=', null)->where('AGENTEFIRMAID !=', null)->findAll());
			$data->cantidad_expedientes_no_firmados = count($this->_folioModel->asObject()->where('EXPEDIENTEID !=', null)->where('AGENTEATENCIONID !=', null)->where('AGENTEFIRMAID', null)->findAll());
			$data->rolPermiso = $this->_rolesPermisosModel->asObject()->where('ROLID', session('ROLID'))->findAll();
		} else {
			$data->cantidad_folios = count($this->_folioModel->asObject()->where('AGENTEATENCIONID', session('ID'))->findAll());
			$data->cantidad_abiertos = count($this->_folioModel->asObject()->where('AGENTEATENCIONID', session('ID'))->where('STATUS', 'ABIERTO')->findAll());
			$data->cantidad_derivados = count($this->_folioModel->asObject()->where('AGENTEATENCIONID', session('ID'))->where('STATUS', 'DERIVADO')->findAll());
			$data->cantidad_canalizados = count($this->_folioModel->asObject()->where('AGENTEATENCIONID', session('ID'))->where('STATUS', 'CANALIZADO')->findAll());
			$data->cantidad_expedientes = count($this->_folioModel->asObject()->where('AGENTEATENCIONID', session('ID'))->where('EXPEDIENTEID !=', null)->where('AGENTEATENCIONID !=', null)->where('AGENTEFIRMAID !=', null)->findAll());
			$data->cantidad_expedientes_no_firmados = count($this->_folioModel->asObject()->where('EXPEDIENTEID !=', null)->where('AGENTEATENCIONID !=', null)->where('AGENTEFIRMAID', null)->findAll());
			$data->rolPermiso = $this->_rolesPermisosModel->asObject()->where('ROLID', session('ROLID'))->findAll();
		}
		$this->_loadView('Principal', 'dashboard', '', $data, 'index');
	}

	public function usuarios()
	{
		$data = (object) array();
		if (!$this->permisos('USUARIOS')) {
			return redirect()->back()->with('message_error', 'Acceso denegado, no tienes los permisos necesarios.');
		}
		$data->usuario = $this->_usuariosModel->asObject()
			->select('USUARIOS.*, ROLES.NOMBRE_ROL, ZONAS_USUARIOS.NOMBRE_ZONA, MUNICIPIO.MUNICIPIODESCR,OFICINA.OFICINADESCR')
			->join('ROLES', 'ROLES.ID = USUARIOS.ROLID', 'LEFT')
			->join('ZONAS_USUARIOS', 'ZONAS_USUARIOS.ID_ZONA = USUARIOS.ZONAID', 'LEFT')
			->join('MUNICIPIO', 'MUNICIPIO.MUNICIPIOID = USUARIOS.MUNICIPIOID AND MUNICIPIO.ESTADOID = 2', 'LEFT')
			->join('OFICINA', 'OFICINA.OFICINAID = USUARIOS.OFICINAID AND OFICINA.MUNICIPIOID = USUARIOS.MUNICIPIOID AND OFICINA.ESTADOID = 2', 'LEFT')
			->where('ROLID !=', 1)
			->findAll();
		$data->rolPermiso = $this->_rolesPermisosModel->asObject()->where('ROLID', session('ROLID'))->findAll();

		$this->_loadView('Usuarios', 'usuarios', '', $data, 'users/users');
	}

	public function asignacion_permisos()
	{
		$data = (object) array();

		if (!$this->permisos('ROLES')) {
			return redirect()->back()->with('message_error', 'Acceso denegado, no tienes los permisos necesarios.');
		}
		$data->rolPermiso = $this->_rolesPermisosModel->asObject()->where('ROLID', session('ROLID'))->findAll();

		$data->rolPermisoDescr = $this->_rolesPermisosModel->get_rol_permiso();

		$data->roles = $this->_rolesUsuariosModel->asObject()->findAll();
		$data->permisos = $this->_permisosModel->asObject()->findAll();

		$this->_loadView('Asignación de permisos', 'asignacion de permisos', '', $data, 'roles/asignacion_permisos');
	}

	public function nuevo_asignacion_permiso()
	{
		$data = (object) array();
		$data->rolPermiso = $this->_rolesPermisosModel->asObject()->where('ROLID', session('ROLID'))->findAll();
		$data->roles = $this->_rolesUsuariosModel->asObject()->findAll();
		$data->permisos = $this->_permisosModel->asObject()->findAll();
		$this->_loadView('Nuevo asignacion de permisos', '', '', $data, 'roles/nueva_asignacion_rol');
	}

	public function nuevo_rol()
	{
		$data = (object) array();
		$data->rolPermiso = $this->_rolesPermisosModel->asObject()->where('ROLID', session('ROLID'))->findAll();
		$data->roles = $this->_rolesUsuariosModel->asObject()->findAll();

		$data->permisos = $this->_permisosModel->asObject()->findAll();
		$this->_loadView('Nuevo rol', '', '', $data, 'roles/nuevo_rol');
	}

	public function usuarios_activos()
	{
		$data = (object) array();
		$data->rolPermiso = $this->_rolesPermisosModel->asObject()->where('ROLID', session('ROLID'))->findAll();

		$this->_loadView('Usuarios activos', 'usuarios_activos', '', $data, 'usuarios_activos');
	}

	public function firmas()
	{
		$data = (object) array();
		$data = $this->_usuariosModel->asObject()->join('ROLES', 'ROLES.ID = USUARIOS.ROLID')->join('ZONAS_USUARIOS', 'ZONAS_USUARIOS.ID_ZONA = USUARIOS.ZONAID')->findAll();
		$data->rolPermiso = $this->_rolesPermisosModel->asObject()->where('ROLID', session('ROLID'))->findAll();

		$this->_loadView('Firmar documentos', 'firmar', '', $data, 'signs');
	}

	public function nuevo_usuario()
	{
		$data = (object) array();
		$data->zonas = $this->_zonasUsuariosModel->asObject()->where('NOMBRE_ZONA !=', 'SUPERUSUARIO')->findAll();
		$data->roles = $this->_rolesUsuariosModel->asObject()->where('NOMBRE_ROL !=', 'SUPERUSUARIO')->findAll();
		$data->municipios = $this->_municipiosModel->asObject()->where('ESTADOID', 2)->findAll();
		$data->rolPermiso = $this->_rolesPermisosModel->asObject()->where('ROLID', session('ROLID'))->findAll();

		$this->_loadView('Nuevo usuario', '', '', $data, 'users/new_user');
	}

	public function create_asignacion_permiso()
	{
		$data = (object) array();
		$data = [
			'ROLID' => $this->request->getPost('rol_usuario'),
			'PERMISOID' => $this->request->getPost('permiso_rol'),
		];
		$datosBitacora = [
			'ACCION' => 'Ha creado una nueva asignacion de permisos',
			'NOTAS' => 'ROL CREADO: ' . $this->request->getPost('rol_usuario') . 'PERMISO: ' .  $this->request->getPost('permiso_rol'),
		];
		$rolesPermiso = $this->_rolesPermisosModel->where('ROLID', $this->request->getPost('rol_usuario'))->where('PERMISOID', $this->request->getPost('permiso_rol'))->first();
		if ($rolesPermiso) {
			return redirect()->to(base_url('/admin/dashboard/nuevo_asignacion_permisos'))->with('message_error', 'Esta asignación de permisos ya existe.');
		}
		$insert = $this->_rolesPermisosModel->insert($data);
		if (!$insert) {
			$this->_bitacoraActividad($datosBitacora);
			$dataView = (object) array();
			$dataView->rolPermiso = $this->_rolesPermisosModel->asObject()->where('ROLID', session('ROLID'))->findAll();
			$dataView->rolPermisoDescr = $this->_rolesPermisosModel->get_rol_permiso();
			$dataView->roles = $this->_rolesUsuariosModel->asObject()->findAll();
			$dataView->permisos = $this->_permisosModel->asObject()->findAll();
			return redirect()->to(base_url('/admin/dashboard/asignacion_permisos'))->with('message_success', 'Asignación de permisos creado correctamente.');
		} else {
			return redirect()->to(base_url('/admin/dashboard/asignacion_permisos'))->with('message_error', 'Asignación de permisos no creado.');
		}
	}

	public function create_rol()
	{
		$data = (object) array();
		$data = [
			'NOMBRE_ROL' => $this->request->getPost('rol_input'),
		];
		$datosBitacora = [
			'ACCION' => 'Ha creado una nuevo rol',
			'NOTAS' => 'ROL CREADO: ' . $this->request->getPost('rol_input'),
		];
		$roles = $this->_rolesUsuariosModel->where('NOMBRE_ROL', $this->request->getPost('rol_input'))->first();

		if ($roles) {
			return redirect()->to(base_url('/admin/dashboard/nuevo_rol'))->with('message_error', 'Rol ya existe.');
		}
		$insert = $this->_rolesUsuariosModel->insert($data);

		if ($insert) {
			$this->_bitacoraActividad($datosBitacora);
			$dataView = (object) array();
			$dataView->rolPermiso = $this->_rolesPermisosModel->asObject()->where('ROLID', session('ROLID'))->findAll();
			$dataView->rolPermisoDescr = $this->_rolesPermisosModel->get_rol_permiso();
			$dataView->roles = $this->_rolesUsuariosModel->asObject()->findAll();
			$dataView->permisos = $this->_permisosModel->asObject()->findAll();
			return redirect()->to(base_url('/admin/dashboard/asignacion_permisos'))->with('message_success', 'Rol creado correctamente.');
		} else {
			return redirect()->to(base_url('/admin/dashboard/asignacion_permisos'))->with('message_error', 'Rol no creado.');
		}
	}

	public function eliminar_asignacion_permiso()
	{
		$rolid = $this->request->getGet('rol');
		$permisoid = $this->request->getGet('permiso');
		$deleteRol = $this->_rolesPermisosModel->where('ROLID', $rolid)->where('PERMISOID', $permisoid)->delete();
		if ($deleteRol) {
			$datosBitacora = [
				'ACCION' => 'Ha eliminado un asignacion de permiso',
				'NOTAS' => 'ROL ELIMINADO: ' . $rolid . 'PERMISO: ' . $permisoid,
			];
			$this->_bitacoraActividad($datosBitacora);
			$dataView = (object) array();
			$dataView->rolPermiso = $this->_rolesPermisosModel->asObject()->where('ROLID', session('ROLID'))->findAll();
			$dataView->roles = $this->_rolesUsuariosModel->asObject()->findAll();
			$dataView->permisos = $this->_permisosModel->asObject()->findAll();
			$dataView->rolPermisoDescr = $this->_rolesPermisosModel->get_rol_permiso();

			return redirect()->to(base_url('/admin/dashboard/asignacion_permisos'))->with('message_success', 'Rol eliminado correctamente.');
		} else {
			return redirect()->to(base_url('/admin/dashboard/asignacion_permisos'))->with('message_error', 'Rol no eliminado.');
		}
	}

	public function editar_usuario()
	{
		$id = $this->request->getGet('id');
		if (!$id) {
			return redirect()->back()->with('message_error', 'No se envío el parámeto id.');
		}
		$data = (object) array();
		$data->zonas = $this->_zonasUsuariosModel->asObject()->where('NOMBRE_ZONA !=', 'SUPERUSUARIO')->findAll();
		$data->roles = $this->_rolesUsuariosModel->asObject()->where('NOMBRE_ROL !=', 'SUPERUSUARIO')->findAll();
		$data->municipios = $this->_municipiosModel->asObject()->where('ESTADOID', 2)->findAll();
		$data->usuario = $this->_usuariosModel->asObject()->where('ID', $id)->first();
		if (!$data->usuario) {
			return redirect()->back()->with('message_error', 'No existe el usuario a editar.');
		}
		$data->oficinas = $this->_oficinasModel->asObject()->where('MUNICIPIOID', $data->usuario->MUNICIPIOID)->orderBy('OFICINADESCR', 'asc')->findAll();
		$data->rolPermiso = $this->_rolesPermisosModel->asObject()->where('ROLID', session('ROLID'))->findAll();

		$this->_loadView('Editar usuario', '', '', $data, 'users/edit_user');
	}

	public function denuncia_anonima()
	{
		if (!$this->permisos('DENUNCIA ANONIMA')) {
			return redirect()->back()->with('message_error', 'Acceso denegado, no tienes los permisos necesarios.');
		}
		$data = (object) array();
		$data->delitosUsuarios = $this->_delitosUsuariosModel->asObject()->orderBy('DELITO', 'ASC')->findAll();
		$lugares = $this->_hechoLugarModel->orderBy('HECHODESCR', 'ASC')->findAll();
		$lugares_sin = [];
		$lugares_fuego = [];
		$lugares_blanca = [];
		foreach ($lugares as $lugar) {
			if (strpos($lugar['HECHODESCR'], 'ARMA DE FUEGO')) {
				array_push($lugares_fuego, (object) $lugar);
			}
			if (strpos($lugar['HECHODESCR'], 'ARMA BLANCA')) {
				array_push($lugares_blanca, (object) $lugar);
			}
			if (!strpos($lugar['HECHODESCR'], 'ARMA BLANCA') && !strpos($lugar['HECHODESCR'], 'ARMA DE FUEGO')) {
				array_push($lugares_sin, (object) $lugar);
			}
		}
		$data->lugares = [];
		$data->lugares = (object) array_merge($lugares_sin, $lugares_blanca, $lugares_fuego);

		$data->edoCiviles = $this->_estadoCivilModel->asObject()->findAll();
		$data->nacionalidades = $this->_nacionalidadModel->asObject()->findAll();
		$data->calidadJuridica = $this->_folioPersonaCalidadJuridica->asObject()->findAll();
		$data->idiomas = $this->_idiomaModel->asObject()->findAll();
		$data->municipios = $this->_municipiosModel->asObject()->where('ESTADOID', 2)->findAll();
		$data->paises = $this->_paisesModel->asObject()->findAll();
		$data->estados = $this->_estadosModel->asObject()->findAll();
		$data->estadosExtranjeros = $this->_estadosExtranjeros->asObject()->findAll();

		$data->tiposIdentificaciones = $this->_tipoIdentificacionModel->asObject()->findAll();
		$data->escolaridades = $this->_escolaridadModel->asObject()->findAll();
		$data->ocupaciones = $this->_ocupacionModel->asObject()->findAll();
		$data->colorVehiculo = $this->_coloresVehiculoModel->asObject()->findAll();
		$data->tipoVehiculo = $this->_tipoVehiculoModel->asObject()->orderBy('VEHICULOTIPODESCR', 'ASC')->findAll();

		$data->parentesco = $this->_parentescoModel->asObject()->findAll();
		$data->figura = $this->_figuraModel->asObject()->findAll();

		$data->cejaContextura = $this->_cejaContexturaModel->asObject()->findAll();
		$data->caraForma = $this->_caraFormaModel->asObject()->findAll();
		$data->caraTamano = $this->_caraTamanoModel->asObject()->findAll();
		$data->caraTez = $this->_caraTezModel->asObject()->findAll();
		$data->orejaLobulo = $this->_orejaLobuloModel->asObject()->findAll();
		$data->orejaForma = $this->_orejaFomaModel->asObject()->findAll();
		$data->orejaTamano = $this->_orejaTamanoModel->asObject()->findAll();
		$data->cabelloColor = $this->_cabelloColorModel->asObject()->findAll();
		$data->cabelloEstilo = $this->_cabelloEstiloModel->asObject()->findAll();
		$data->cabelloTamano = $this->_cabelloTamanoModel->asObject()->findAll();
		$data->cabelloPeculiar = $this->_cabelloPeculiarModel->asObject()->findAll();
		$data->frenteAltura = $this->_frenteAlturaModel->asObject()->findAll();
		$data->frenteAnchura = $this->_frenteAnchuraModel->asObject()->findAll();
		$data->frenteForma = $this->_frenteFormaModel->asObject()->findAll();
		$data->frentePeculiar = $this->_frentePeculiarModel->asObject()->findAll();
		$data->cejaColocacion = $this->_cejaColocacionModel->asObject()->findAll();
		$data->cejaForma = $this->_cejaFormaModel->asObject()->findAll();
		$data->cejaTamano = $this->_cejaTamanoModel->asObject()->findAll();
		$data->cejaGrosor = $this->_cejaGrosorModel->asObject()->findAll();
		$data->ojoColocacion = $this->_ojoColocacionModel->asObject()->findAll();
		$data->ojoForma = $this->_ojoFormaModel->asObject()->findAll();
		$data->ojoTamano = $this->_ojoTamanoModel->asObject()->findAll();
		$data->ojoColor = $this->_ojoColorModel->asObject()->findAll();
		$data->ojoPeculiar = $this->_ojoPeculiarModel->asObject()->findAll();
		$data->narizTipo = $this->_narizTipoModel->asObject()->findAll();
		$data->narizTamano = $this->_narizTamanoModel->asObject()->findAll();
		$data->narizBase = $this->_narizBaseModel->asObject()->findAll();
		$data->narizPeculiar = $this->_narizPeculiarModel->asObject()->findAll();
		$data->bigoteForma = $this->_bigoteFormaModel->asObject()->findAll();
		$data->bigoteTamano = $this->_bigoteTamanoModel->asObject()->findAll();
		$data->bigoteGrosor = $this->_bigoteGrosorModel->asObject()->findAll();
		$data->bigotePeculiar = $this->_bigotePeculiarModel->asObject()->findAll();
		$data->bocaTamano = $this->_bocaTamanoModel->asObject()->findAll();
		$data->bocaPeculiar = $this->_bocaPeculiarModel->asObject()->findAll();
		$data->labioGrosor = $this->_labioGrosorModel->asObject()->findAll();
		$data->labioLongitud = $this->_labioLongitudModel->asObject()->findAll();
		$data->labioPeculiar = $this->_labioPeculiarModel->asObject()->findAll();
		$data->labioPosicion = $this->_labioPosicionModel->asObject()->findAll();
		$data->dienteTamano = $this->_dienteTamanoModel->asObject()->findAll();
		$data->dienteTipo = $this->_dienteTipoModel->asObject()->findAll();
		$data->dientePeculiar = $this->_dientePeculiarModel->asObject()->findAll();
		$data->barbillaForma = $this->_barbillaFormaModel->asObject()->findAll();
		$data->barbillaTamano = $this->_barbillaTamanoModel->asObject()->findAll();
		$data->barbillaInclinacion = $this->_barbillaInclinacionModel->asObject()->findAll();
		$data->barbillaPeculiar = $this->_barbillaPeculiarModel->asObject()->findAll();
		$data->barbaTamano = $this->_barbaTamanoModel->asObject()->findAll();
		$data->barbaPeculiar = $this->_barbaPeculiarModel->asObject()->findAll();
		$data->cuelloTamano = $this->_cuelloTamanoModel->asObject()->findAll();
		$data->cuelloGrosor = $this->_cuelloGrosorModel->asObject()->findAll();
		$data->cuelloPeculiar = $this->_cuelloPeculiarModel->asObject()->findAll();
		$data->hombroPosicion = $this->_hombroPosicionModel->asObject()->findAll();
		$data->hombroLongitud = $this->_hombroLongitudModel->asObject()->findAll();
		$data->hombroGrosor = $this->_hombroGrosorModel->asObject()->findAll();
		$data->estomago = $this->_estomagoModel->asObject()->findAll();
		$data->pielColor = $this->_pielColorModel->asObject()->findAll();
		$data->etnia = $this->_etniaModel->asObject()->findAll();
		$data->parentesco = $this->_parentescoModel->asObject()->findAll();
		$data->objetoclasificacion = $this->_objetoClasificacionModel->asObject()->findAll();
		$data->objetosubclasificacion = $this->_objetoSubclasificacionModel->asObject()->findAll();
		$data->tipomoneda = $this->_tipoMonedaModel->asObject()->findAll();

		$data->plantillas = $this->_plantillasModel->asObject()->where('TITULO !=', 'CONSTANCIA DE EXTRAVIO')->findAll();
		$data->tipoExpediente = $this->_tipoExpedienteModel->asObject()->like('TIPOEXPEDIENTECLAVE', 'NUC')->orLike('TIPOEXPEDIENTECLAVE', 'NAC')->orLike('TIPOEXPEDIENTECLAVE', 'RAC')->findAll();
		$data->derivaciones = $this->_derivacionesAtencionesModel->asObject()->findAll();

		$data->distribuidorVehiculo = $this->_vehiculoDistribuidorModel->asObject()->findAll();
		$data->marcaVehiculo = $this->_vehiculoMarcaModel->asObject()->findAll();
		$data->lineaVehiculo = $this->_vehiculoModeloModel->asObject()->findAll();
		$data->versionVehiculo = $this->_vehiculoVersionModel->asObject()->findAll();
		$data->tipoVehiculo = $this->_tipoVehiculoModel->asObject()->findAll();
		$data->servicioVehiculo = $this->_vehiculoServicioModel->asObject()->findAll();
		$data->colorVehiculo = $this->_coloresVehiculoModel->asObject()->findAll();
		$data->rolPermiso = $this->_rolesPermisosModel->asObject()->where('ROLID', session('ROLID'))->findAll();
		$data->delitosModalidad = $this->_delitoModalidadModel->asObject()->orderBy('DELITOMODALIDADDESCR', 'ASC')->where('DELITOMODALIDADDESCR IS NOT NULL')->findAll();


		$this->_loadView('Denuncia anónima', 'denuncia_anonima', '', $data, 'denuncia_anonima');
	}

	public function crear_usuario()
	{
		$data = [
			'NOMBRE' => $this->request->getPost('nombre_usuario'),
			'APELLIDO_PATERNO' => $this->request->getPost('apellido_paterno_usuario'),
			'APELLIDO_MATERNO' => $this->request->getPost('apellido_materno_usuario'),
			'CORREO' => $this->request->getPost('correo_usuario'),
			'PASSWORD' => hashPassword($this->request->getPost('password_usuario')),
			'SEXO' => $this->request->getPost('sexo_usuario'),
			'ROLID' => $this->request->getPost('rol_usuario'),
			'ZONAID' => $this->request->getPost('zona_usuario'),
			'MUNICIPIOID' => $this->request->getPost('municipio'),
			'OFICINAID' => $this->request->getPost('oficina'),
		];

		$datosBitacora = [
			'ACCION' => 'Ha creado un usuario',
			'NOTAS' => 'NUEVO USUARIO CREADO: ' . $this->request->getPost('correo'),
		];

		if ($this->validate(['correo_usuario' => 'required|valid_email|is_unique[USUARIOS.CORREO]'])) {
			try {
				$usuario = ($this->_getUnusedUsersVideo())[0];
				$videoUser = $this->_updateUserVideo($usuario->ID, 'LIC. ' . $data['NOMBRE'], $data['APELLIDO_PATERNO'] . ' ' . $data['APELLIDO_MATERNO'], $data['CORREO'], $data['SEXO'], 'agente');
			} catch (\Throwable $th) {
				return redirect()->back()->with('message_error', 'Usuario no creado, hubo un error.');
			}

			$data['USUARIOVIDEO'] = $videoUser->ID;
			$data['TOKENVIDEO'] = $videoUser->Token;
			try {
				$usuario = $this->_usuariosModel->insert($data);
			} catch (\Throwable $th) {
				return redirect()->back()->with('message_error', 'Usuario no creado, ya existe el correo ingresado.');
			}

			$this->_bitacoraActividad($datosBitacora);
			$this->_sendEmailPassword($data['CORREO'], $this->request->getPost('password'));
			return redirect()->to(base_url('/admin/dashboard/usuarios'))->with('message_success', 'Usuario registrado correctamente.');
		} else {
			return redirect()->back()->with('message_error', 'Usuario no creado, ya existe el correo ingresado.');
		}
	}

	public function update_usuario()
	{
		$id = $this->request->getPost('id');
		$usuario = $this->_usuariosModel->asObject()->where('ID', $id)->first();
		$data = [
			'NOMBRE' => trim($this->request->getPost('nombre_usuario')),
			'APELLIDO_PATERNO' => trim($this->request->getPost('apellido_paterno_usuario')),
			'APELLIDO_MATERNO' => trim($this->request->getPost('apellido_materno_usuario')),
			'CORREO' => trim($this->request->getPost('correo_usuario')),
			'SEXO' => trim($this->request->getPost('sexo_usuario')),
			'ROLID' => trim($this->request->getPost('rol_usuario')),
			'ZONAID' => trim($this->request->getPost('zona_usuario')),
			'MUNICIPIOID' => trim($this->request->getPost('municipio')),
			'OFICINAID' => trim($this->request->getPost('oficina')),
		];

		if (!($data['CORREO'] === $usuario->CORREO)) {
			if (!$this->validate(['correo_usuario' => 'required|valid_email|is_unique[USUARIOS.CORREO]'])) {
				return redirect()->back()->with('message_error', 'Usuario no actualizado, el correo electrónico ya existe.');
			}
		}

		if ($usuario) {
			try {
				$videoUser = $this->_updateUserVideo($usuario->USUARIOVIDEO, 'LIC. ' . $data['NOMBRE'], $data['APELLIDO_PATERNO'] . ' ' . $data['APELLIDO_MATERNO'], $data['CORREO'], $data['SEXO'], 'agente');
				if ($videoUser) {
					$data['USUARIOVIDEO'] = $videoUser->ID;
					$data['TOKENVIDEO'] = $videoUser->Token;
					try {
						$this->_usuariosModel->set($data)->where('ID', $id)->update();
					} catch (\Throwable $th) {
						$videoUser = $this->_updateUserVideo($usuario->USUARIOVIDEO, 'LIC. ' . $usuario->NOMBRE, $usuario->APELLIDO_PATERNO . ' ' . $usuario->APELLIDO_MATERNO, $usuario->CORREO, $usuario->SEXO, 'agente');
						throw new \Exception('No se actualizo en base de datos.');
					}
				} else {
					throw new \Exception('No se actualizo en servidor de videodenuncia');
				}
			} catch (\Throwable $th) {
				return redirect()->back()->with('message_error', 'Usuario no actualizado.');
			}

			return redirect()->to(base_url('/admin/dashboard/usuarios'))->with('message_success', 'Usuario actualizado correctamente.');
		} else {
			return redirect()->back()->with('message_error', 'Usuario no actualizado.');
		}
	}

	public function editar_password()
	{
		$id = $this->request->getPost('id');
		$password = trim($this->request->getPost('password'));
		$data = [
			'PASSWORD' => hashPassword($password),
		];
		$this->_usuariosModel->set($data)->where('ID', $id)->update();
		$datosBitacora = [
			'ACCION' => 'Edito la contraseña del usuario ' . $id,
		];
		$this->_bitacoraActividad($datosBitacora);

		return redirect()->back()->with('message_success', 'Contraseña actualizada correctamente');
	}

	public function folios()
	{
		$data = (object) array();
		$data = $this->_folioModel->asObject()->findAll();
		$data = (object) $data;
		$data->rolPermiso = $this->_rolesPermisosModel->asObject()->where('ROLID', session('ROLID'))->findAll();

		$this->_loadView('Folios no atendidos', 'folios', '', $data, 'folios');
	}

	public function perfil()
	{
		$data = (object) array();
		$data->zonas = $this->_zonasUsuariosModel->asObject()->findAll();
		$data->roles = $this->_rolesUsuariosModel->asObject()->findAll();
		$data->rolPermiso = $this->_rolesPermisosModel->asObject()->where('ROLID', session('ROLID'))->findAll();

		$this->_loadView('Perfil', 'perfil', '', $data, 'perfil');
	}

	public function update_password()
	{
		$password = $this->request->getPost('password');
		$data = [
			'PASSWORD' => hashPassword($password),
		];
		$this->_usuariosModel->set($data)->where('ID', session('ID'))->update();
		$datosBitacora = [
			'ACCION' => 'Ha cambiado su contraseña',
		];
		$this->_bitacoraActividad($datosBitacora);


		$session = session();
		$session->destroy();
		return redirect()->to(base_url('admin'));
	}

	public function charge_fiel()
	{
		$key_fiel = $this->request->getFile('key');
		$cer_fiel = $this->request->getFile('cer');
		$user_id = session('ID');

		$directory = FCPATH . 'uploads/FIEL/' . $user_id;
		$file_key = $user_id . '_key.key';
		$file_cer = $user_id . '_cer.cer';

		if ($key_fiel->isValid() && $cer_fiel->isValid()) {
			if (!file_exists($directory)) {
				mkdir($directory, 0777);
			}

			if (file_exists($directory . '/' . $file_key)) {
				unlink($directory . '/' . $file_key);
			}

			if (file_exists($directory . '/' . $file_cer)) {
				unlink($directory . '/' . $file_cer);
			}

			$key_fiel->move($directory, $file_key);
			$cer_fiel->move($directory, $file_cer);
			$datosBitacora = [
				'ACCION' => 'Ha cargado la firma FIEL',

			];

			$this->_bitacoraActividad($datosBitacora);

			return redirect()->back()->with('message_success', 'FIEL cargada correctamente.');
		} else {
			return redirect()->back()->with('message_error', 'No seleccionaste los archivos necesarios.');
		}
	}

	public function getFolioInformation()
	{


		$data = (object) array();
		$numfolio = trim($this->request->getPost('folio'));
		$year = trim($this->request->getPost('year'));
		$search = $this->request->getPost('search');

		if ($search != 'true') {
			$data->folio = $this->_folioModel->asObject()->where('ANO', $year)->where('FOLIOID', $numfolio)->first();

			if ($data->folio) {
				if ($data->folio->STATUS == 'ABIERTO') {
					$data->status = 1;
					$data->folioDenunciantes = $this->_folioModel->get_folio_denunciante($data->folio->DENUNCIANTEID);
					$data->preguntas_iniciales = $this->_folioPreguntasModel->where('FOLIOID', $numfolio)->where('ANO', $year)->first();
					$data->personas = $this->_folioPersonaFisicaModel->get_by_folio($numfolio, $year);
					$data->correos = $this->_folioPersonaFisicaModel->get_correos_persona($numfolio, $year);
					$data->parentescoRelacion = $this->_parentescoPersonaFisicaModel->where('FOLIOID', $numfolio)->where('ANO', $year)->findAll();
					$data->personaiduno = $this->_parentescoPersonaFisicaModel->get_personaFisicaUno($numfolio, $year);
					$data->personaidDos = $this->_parentescoPersonaFisicaModel->get_personaFisicaDos($numfolio, $year);
					$data->parentesco = $this->_parentescoPersonaFisicaModel->get_Parentesco($numfolio, $year);
					$data->relacionFisFis = $this->_relacionIDOModel->get_by_folio($numfolio, $year);
					$data->vehiculos = $this->_folioVehiculoModel->get_by_folio($numfolio, $year);
					$data->fisicaImpDelito = $this->_imputadoDelitoModel->get_by_folio($numfolio, $year);
					$data->delitosModalidadFiltro = $this->_delitoModalidadModel->get_delitodescr($numfolio, $year);
					$data->objetos = $this->_folioObjetoInvolucradoModel->get_descripcion($numfolio, $year);
					$data->documentos = $this->_folioDocModel->get_by_folio($numfolio, $year);
					$data->archivosexternos = $this->_archivoExternoModel->asObject()->where('FOLIOID', $numfolio)->where('ANO', $year)->findAll();


					if ($data->archivosexternos) {
						foreach ($data->archivosexternos as $key => $archivos) {
							$file_info = new \finfo(FILEINFO_MIME_TYPE);
							$type = $file_info->buffer($archivos->ARCHIVO);

							$archivos->ARCHIVO = 'data:' . $type . ';base64,' . base64_encode($archivos->ARCHIVO);
						}
					}


					// $data->personafisica = $this->_folioPersonaFisicaModel->asObject()->where('FOLIOID', $data->folio)->where('ANO', $year)->findAll();
					$data->imputados = $this->_folioPersonaFisicaModel->get_imputados($numfolio, $year);
					$data->victimas = $this->_folioPersonaFisicaModel->get_victimas($numfolio, $year);
					$this->_folioModel->set(['STATUS' => 'EN PROCESO', 'AGENTEATENCIONID' => session('ID')])->where('ANO', $year)->where('FOLIOID', $numfolio)->update();
					$datosBitacora = [
						'ACCION' => 'Está atendiendo un folio',
						'NOTAS' => 'FOLIO: ' . $numfolio . ' AÑO: ' . $year,
					];
					$this->_bitacoraActividad($datosBitacora);
					// var_dump($data);exit;
					return json_encode($data);
				} else if ($data->folio->STATUS == 'EN PROCESO' && $data->folio->TIPODENUNCIA == "VD") {
					return json_encode(['status' => 2, 'motivo' => 'EL FOLIO YA ESTA SIENDO ATENDIDO']);
				} else if ($data->folio->STATUS == 'EN PROCESO' && $data->folio->TIPODENUNCIA == "DA") {
					$data->status = 1;
					return json_encode($data);
				} else {
					$agente = $this->_usuariosModel->asObject()->where('ID', $data->folio->AGENTEATENCIONID)->first();
					return json_encode(['status' => 3, 'motivo' => $data->folio->STATUS, 'expediente' => $data->folio->EXPEDIENTEID, 'agente' => $agente->NOMBRE . ' ' . $agente->APELLIDO_PATERNO . ' ' . $agente->APELLIDO_MATERNO]);
				}
			} else {
				return json_encode(['status' => 0]);
			}
		} else {
			$data->folio = $this->_folioModel->asObject()->where('ANO', $year)->where('FOLIOID', $numfolio)->first();

			if ($data->folio) {
				$data->status = 1;
				$data->preguntas_iniciales = $this->_folioPreguntasModel->where('FOLIOID', $numfolio)->where('ANO', $year)->first();
				$data->personas = $this->_folioPersonaFisicaModel->get_by_folio($numfolio, $year);
				$data->vehiculos = $this->_folioVehiculoModel->get_by_folio($numfolio, $year);
				$data->parentescoRelacion = $this->_parentescoPersonaFisicaModel->where('FOLIOID', $numfolio)->where('ANO', $year)->findAll();
				$data->personaiduno = $this->_parentescoPersonaFisicaModel->get_personaFisicaUno($numfolio, $year);
				$data->personaidDos = $this->_parentescoPersonaFisicaModel->get_personaFisicaDos($numfolio, $year);
				$data->parentesco = $this->_parentescoPersonaFisicaModel->get_Parentesco($numfolio, $year);
				$data->relacionFisFis = $this->_relacionIDOModel->get_by_folio($numfolio, $year);
				$data->vehiculos = $this->_folioVehiculoModel->get_by_folio($numfolio, $year);
				$data->fisicaImpDelito = $this->_imputadoDelitoModel->get_by_folio($numfolio, $year);
				$data->delitosModalidadFiltro = $this->_delitoModalidadModel->get_delitodescr($numfolio, $year);
				$data->objetos = $this->_folioObjetoInvolucradoModel->get_descripcion($numfolio, $year);
				$data->archivosexternos = $this->_archivoExternoModel->get_by_folio($numfolio, $year);
				$data->folioDenunciantes = $this->_folioModel->get_folio_denunciante($data->folio->DENUNCIANTEID);

				// $data->personafisica = $this->_folioPersonaFisicaModel->asObject()->where('FOLIOID', $data->folio)->where('ANO', $year)->findAll();
				$data->imputados = $this->_folioPersonaFisicaModel->get_imputados($numfolio, $year);
				$data->victimas = $this->_folioPersonaFisicaModel->get_victimas($numfolio, $year);

				if ($data->folio->STATUS == 'ABIERTO' || $data->folio->STATUS == 'EN PROCESO') {
					$data->agente = $this->_usuariosModel->asObject()->where('ID', $data->folio->AGENTEATENCIONID)->first();
				} else if ($data->folio->STATUS == 'EN PROCESO' && $data->folio->TIPODENUNCIA == "DA") {
					$data->status = 1;
					return json_encode($data);
				}
				return json_encode($data);
			} else {
				return json_encode(['status' => 0, 'motivo' => 'El folio ' . $numfolio . ' del año ' . $year . ' no existe.']);
			}
		}
	}

	public function getFolioInformationDenunciaAnonima()
	{
		$data = (object) array();
		$numfolio = trim($this->request->getPost('folio'));
		$year = trim($this->request->getPost('year'));

		$data->folio = $this->_folioModel->asObject()->where('ANO', $year)->where('FOLIOID', $numfolio)->first();
		if ($data->folio) {
			$data->status = 1;
			return json_encode($data);
		} else {
			return json_encode(['status' => 0]);
		}
	}

	public function getPersonaFisicaById()
	{
		$id = trim($this->request->getPost('id'));
		$folio = trim($this->request->getPost('folio'));
		$year = trim($this->request->getPost('year'));

		$data = (object) array();
		$data->personaFisica = $this->_folioPersonaFisicaModel->where('FOLIOID', $folio)->where('ANO', $year)->where('PERSONAFISICAID', $id)->first();

		if ($data->personaFisica) {
			$data->personaFisicaDomicilio = $this->_folioPersonaFisicaDomicilioModel->where('ANO', $year)->where('FOLIOID', $folio)->where('PERSONAFISICAID', $id)->first();

			$data->personaFisicaMediaFiliacion = $this->_folioMediaFiliacion->where('ANO', $year)->where('FOLIOID', $folio)->where('PERSONAFISICAID', $id)->first();
			$data->folio = $this->_folioModel->where('FOLIOID', $folio)->where('ANO', $year)->first();
			// if ($data->personaFisica['DESAPARECIDA'] == 'S') {

			//     $data->parentescoRelacion = $this->_parentescoPersonaFisicaModel->where('FOLIOID', $folio)->where('ANO', $year)->where('PERSONAFISICAID2', $data->personaFisicaMediaFiliacion['PERSONAFISICAID'])->first();
			//     $data->parentesco = $this->_parentescoModel->where('PERSONAPARENTESCOID', $data->parentescoRelacion['PARENTESCOID'])->first();
			// }
			// $data->parentescoRelacion = $this->_parentescoPersonaFisicaModel->where('FOLIOID', $folio)->where('ANO', $year)->where('PERSONAFISICAID2', $id)->first();
			// $data->parentescoRelacion = $this->_parentescoPersonaFisicaModel->where('FOLIOID', $folio)->where('ANO', $year)->findAll();

			// if ($data->parentescoRelacion) {
			//     $data->parentesco = $this->_parentescoModel->where('PERSONAPARENTESCOID', $data->parentescoRelacion['PARENTESCOID'])->first();
			// } else {
			//     $data->parentesco = '';
			// }
			$data->idPersonaFisica = $id;
			if ($data->personaFisica['FOTO']) {
				$file_info = new \finfo(FILEINFO_MIME_TYPE);
				$type = $file_info->buffer($data->personaFisica['FOTO']);
				$data->personaFisica['FOTO'] = 'data:' . $type . ';base64,' . base64_encode($data->personaFisica['FOTO']);
			}

			$data->status = 1;
			return json_encode($data);
		} else {
			$data = (object)['status' => 0];
			return json_encode($data);
		}
	}

	public function getRelacionParentesco()
	{
		$id = trim($this->request->getPost('personafisica1'));
		$folio = trim($this->request->getPost('folio'));
		$year = trim($this->request->getPost('year'));

		$data = (object) array();
		$data->parentescoRelacion = $this->_parentescoPersonaFisicaModel->where('FOLIOID', $folio)->where('ANO', $year)->where('PERSONAFISICAID1', $id)->first();

		if ($data->parentescoRelacion) {
			$data->parentesco = $this->_parentescoModel->where('PERSONAPARENTESCOID', $data->parentescoRelacion['PARENTESCOID'])->first();
			// $data->parentescoRelacion = $this->_parentescoPersonaFisicaModel->where('FOLIOID', $folio)->where('ANO', $year)->where('PERSONAFISICAID2', $id)->first();
			// $data->parentescoRelacion = $this->_parentescoPersonaFisicaModel->where('FOLIOID', $folio)->where('ANO', $year)->findAll();

			// if ($data->parentescoRelacion) {
			//     $data->parentesco = $this->_parentescoModel->where('PERSONAPARENTESCOID', $data->parentescoRelacion['PARENTESCOID'])->first();
			// } else {
			//     $data->parentesco = '';
			// }
			$data->idPersonaFisica = $id;

			$data->status = 1;
			return json_encode($data);
		} else {
			$data = (object)['status' => 0];
			return json_encode($data);
		}
	}

	public function getImputadoDelito()
	{
		$id = trim($this->request->getPost('personafisica'));
		$folio = trim($this->request->getPost('folio'));
		$year = trim($this->request->getPost('year'));
		$delitomodalidadid = trim($this->request->getPost('delito'));

		$data = (object) array();
		$data->imputado_delito = $this->_imputadoDelitoModel->where('FOLIOID', $folio)->where('ANO', $year)->where('PERSONAFISICAID', $id)->where('DELITOMODALIDADID', $delitomodalidadid)->first();
		if ($data->imputado_delito) {

			$data->status = 1;
			return json_encode($data);
		} else {
			$data = (object)['status' => 0];
			return json_encode($data);
		}
	}

	public function findPersonadDomicilioById()
	{
		$id = $this->request->getPost('id');
		$folio = $this->request->getPost('folio');
		$year = $this->request->getPost('year');

		$data = (object) array();

		$data->persondom = $this->_folioPersonaFisicaDomicilioModel->where('FOLIOID', $folio)->where('ANO', $year)->where('PERSONAFISICAID', $id)->first();
		$data->estado = $this->_estadosModel->where('ESTADOID', 2)->asObject()->first();
		$data->municipio = $this->_municipiosModel->asObject()->where('ESTADOID', 2)->where('MUNICIPIOID', $data->persondom['MUNICIPIOID'])->first();
		$data->localidad = $this->_localidadesModel->asObject()->where('ESTADOID', 2)->where('MUNICIPIOID', $data->persondom['MUNICIPIOID'])->where('LOCALIDADID', $data->persondom['LOCALIDADID'])->first();
		$data->colonia = $this->_coloniasModel->asObject()->where('ESTADOID', 2)->where('MUNICIPIOID', $data->persondom['MUNICIPIOID'])->where('COLONIAID', $data->persondom['COLONIAID'])->first();

		return json_encode($data);
	}


	public function refreshArchivosExternos()
	{
		$folio = $this->request->getPost('folio');
		$year = $this->request->getPost('year');

		$data = (object) array();

		$data->archivosexternos = $this->_archivoExternoModel->asObject()->where('FOLIOID', $folio)->where('ANO', $year)->findAll();
		if ($data->archivosexternos) {
			foreach ($data->archivosexternos as $key => $archivos) {
				$file_info = new \finfo(FILEINFO_MIME_TYPE);
				$type = $file_info->buffer($archivos->ARCHIVO);

				$archivos->ARCHIVO = 'data:' . $type . ';base64,' . base64_encode($archivos->ARCHIVO);
			}
		}
		return json_encode($data);
	}

	public function findPersonadVehiculoById()
	{
		$data = (object) array();
		$id = $this->request->getPost('id');
		$folio = $this->request->getPost('folio');
		$year = $this->request->getPost('year');

		$data->vehiculo = $this->_folioVehiculoModel->where('FOLIOID', $folio)->where('ANO', $year)->where('VEHICULOID', $id)->first();

		if ($data->vehiculo) {
			try {
				if ($data->vehiculo['FOTO']) {
					$file_info = new \finfo(FILEINFO_MIME_TYPE);
					$type = $file_info->buffer($data->vehiculo['FOTO']);
					$data->vehiculo['FOTO'] = 'data:' . $type . ';base64,' . base64_encode($data->vehiculo['FOTO']);
				}
				if ($data->vehiculo['DOCUMENTO']) {
					$file_info = new \finfo(FILEINFO_MIME_TYPE);
					$type = $file_info->buffer($data->vehiculo['DOCUMENTO']);
					$data->vehiculo['DOCUMENTO'] = 'data:' . $type . ';base64,' . base64_encode($data->vehiculo['DOCUMENTO']);
				}

				$data->color = $this->_coloresVehiculoModel->where('VEHICULOCOLORID', $data->vehiculo['PRIMERCOLORID'])->first();
				$data->tipov = $this->_tipoVehiculoModel->where('VEHICULOTIPOID', $data->vehiculo['TIPOID'])->first();
				$data->distribuidorVehiculo = $this->_vehiculoDistribuidorModel->where('VEHICULODISTRIBUIDORID', $data->vehiculo['VEHICULODISTRIBUIDORID'])->first();
				$data->marcaVehiculo = $this->_vehiculoMarcaModel->where('VEHICULODISTRIBUIDORID', $data->vehiculo['VEHICULODISTRIBUIDORID'])->where('VEHICULOMARCAID', $data->vehiculo['MARCAID'])->first();
				$data->lineaVehiculo = $this->_vehiculoModeloModel->where('VEHICULODISTRIBUIDORID', $data->vehiculo['VEHICULODISTRIBUIDORID'])->where('VEHICULOMARCAID', $data->vehiculo['MARCAID'])->where('VEHICULOMODELOID', $data->vehiculo['MODELOID'])->first();
				$data->versionVehiculo = $this->_vehiculoVersionModel->where('VEHICULODISTRIBUIDORID', $data->vehiculo['VEHICULODISTRIBUIDORID'])->where('VEHICULOMARCAID', $data->vehiculo['MARCAID'])->where('VEHICULOMODELOID', $data->vehiculo['MODELOID'])->where('VEHICULOVERSIONID', $data->vehiculo['VEHICULOVERSIONID'])->first();
				$data->status = 1;
				return json_encode($data);
			} catch (\Exception $e) {
				return json_encode(['status' => 0]);
			}
		} else {
			return json_encode(['status' => 0]);
		}
	}

	public function bandeja_salida()
	{
		if (!$this->permisos('BANDEJA')) {
			return redirect()->back()->with('message_error', 'Acceso denegado, no tienes los permisos necesarios.');
		}
		$data = (object) array();
		$data->ensenada = $this->_folioModel->bandeja_salida(1);
		$data->mexicali = $this->_folioModel->bandeja_salida(2);
		$data->tecate = $this->_folioModel->bandeja_salida(3);
		$data->tijuana = $this->_folioModel->bandeja_salida(4);
		$data->rosarito = $this->_folioModel->bandeja_salida(5);
		// var_dump($data->mexicali);
		// exit;
		$data->rolPermiso = $this->_rolesPermisosModel->asObject()->where('ROLID', session('ROLID'))->findAll();
		$this->_loadView('Bandeja de remisión', 'bandeja de remision', '', $data, 'bandeja/bandeja_salida');
	}

	public function bandeja_remision()
	{
		if (!$this->permisos('BANDEJA')) {
			return redirect()->back()->with('message_error', 'Acceso denegado, no tienes los permisos necesarios.');
		}
		$data = (object) array();
		$data->municipio = $this->request->getGet('municipioasignado');
		$data->folio = $this->request->getGet('folio');
		$data->year = $this->request->getGet('year');
		$data->expedienteid = $this->request->getGet('expediente');
		$data->oficinas = $this->_oficinasModel->asObject()->where('MUNICIPIOID', $data->municipio)->orderBy('OFICINADESCR', 'asc')->findAll();

		$data->expediente = $this->_folioModel->where('FOLIOID', $data->folio)->where('ANO', $data->year)->where('MUNICIPIOASIGNADOID', $data->municipio)->where('EXPEDIENTEID', $data->expedienteid)->first();

		if (!$data->expediente) {
			return redirect()->back()->with('message_error', 'No se encontro el folio a remitir.');
		}
		$data->rolPermiso = $this->_rolesPermisosModel->asObject()->where('ROLID', session('ROLID'))->findAll();

		if ($data->expediente['TIPOEXPEDIENTEID'] == 5) {
			$this->_loadView('Bandeja remisión', 'remision', '', $data, 'bandeja/bandeja_rac');
		} else {
			$this->_loadView('Bandeja remisión', 'remision', '', $data, 'bandeja/bandeja_remision');
		}
	}
	public function bandeja_remision_post()
	{
		try {

			$expediente = trim($this->request->getPost('expediente'));
			$oficina = trim($this->request->getPost('oficina'));
			$empleado = trim($this->request->getPost('empleado'));
			$municipio = trim($this->request->getPost('municipio'));

			$area = $this->_empleadosModel->asObject()->where('EMPLEADOID', $empleado)->where('MUNICIPIOID', $municipio)->first();
			$documents = $this->_folioDocModel->asObject()->where('NUMEROEXPEDIENTE', $expediente . '1')->findAll();
			$status = 2;

			foreach ($documents as $key => $document) {
				if (
					$document->TIPODOC == 'CRITERIO DE OPORTUNIDAD' ||
					$document->TIPODOC == 'FACULTAD DE ABSTENERSE DE INVESTIGAR (NO DELITO)' ||
					$document->TIPODOC == 'FACULTAD DE ABSTENERSE DE INVESTIGAR (PRESCRIPCION)'
				) {
					$status = 4;
				}
			}

			$dataFolio = array(
				'AGENTEASIGNADOID' => $empleado,
				'OFICINAASIGNADOID' => $oficina,
				'AREAASIGNADOID' => $area->AREAID
			);
			$dataFolioDoc = array(
				'AGENTEID' => $empleado,
				'OFICINAID' => $oficina,
			);
			$dataFolioArc = array(
				'AUTOR' => $empleado,
				'OFICINAID' => $oficina,
			);

			$update = $this->_folioModel->set($dataFolio)->where('EXPEDIENTEID', $expediente)->update();
			$updateDoc = $this->_folioDocModel->set($dataFolioDoc)->where('NUMEROEXPEDIENTE', $expediente)->update();


			if ($update) {
				$datosBitacora = [
					'ACCION' => 'Remitio un expediente.',
					'NOTAS' => 'Exp: ' . $expediente . ' oficina: ' . $oficina . ' empleado:' . $empleado . ' area:' . $area->AREAID,
				];

				$bandeja = $this->_folioModel->where('EXPEDIENTEID', $expediente)->first();
				$updateExpediente = $this->_updateExpedienteByBandeja($expediente, $municipio, $oficina, $empleado, $area->AREAID, $status);
				$updateArch = $this->_archivoExternoModel->set($dataFolioArc)->where('FOLIOID', $bandeja['FOLIOID'])->where('ANO', $bandeja['ANO'])->update();

				$_bandeja_creada = $this->_createBandeja($bandeja);
				$this->_bitacoraActividad($datosBitacora);
				$subirArchivos = $this->subirArchivosRemision($bandeja['FOLIOID'], $bandeja['ANO'], $expediente);
				$folioDoc = $this->_folioDocModel->where('NUMEROEXPEDIENTE', $expediente)->where('STATUS', 'FIRMADO')->join('RELACIONFOLIODOCEXPDOC', 'FOLIODOC.NUMEROEXPEDIENTE = RELACIONFOLIODOCEXPDOC.EXPEDIENTEID  AND FOLIODOC.FOLIODOCID = RELACIONFOLIODOCEXPDOC.FOLIODOCID')->orderBy('FOLIODOC.FOLIODOCID', 'asc')->like('TIPODOC', 'SOLICITUD DE PERITAJE')->findAll();
				if ($folioDoc) {
					foreach ($folioDoc as $key => $doc) {
						$solicitudp = array();
						$solicitudp['ESTADOID'] = 2;
						$solicitudp['MUNICIPIOID'] = $municipio;
						$solicitudp['EMPLEADOIDREGISTRO'] = $empleado;
						$solicitudp['OFICINAIDREGISTRO'] = $oficina;
						$solicitudp['AREAIDREGISTRO'] = $area;
						$solicitudp['ANO'] = $doc['ANO'];
						$solicitudp['TITULO'] = $doc['TIPODOC'];

						$_solicitudPericial = $this->_createSolicitudesPericiales($solicitudp);
						if ($_solicitudPericial->status == 201) {
							$_solicitudDocto = $this->_createSolicitudDocto($expediente, $_solicitudPericial->SOLICITUDID, $doc['EXPEDIENTEDOCID'], $bandeja['MUNICIPIOASIGNADOID']);
							if ($_solicitudDocto->status == 201) {
								$_solicitudExpediente = $this->_createSolicitudExpediente($expediente, $_solicitudPericial->SOLICITUDID, $municipio);
								$plantilla = (object) array();

								$plantilla = $this->_plantillasModel->where('TITULO',  $doc['TIPODOC'])->first();
								if ($municipio == 1 ||  $municipio == 6) {
									$intervencion = $plantilla['INTERVENCIONENSENADAID'];
								} else if ($municipio == 2 || $municipio == 3 || $municipio == 7) {
									$intervencion = $plantilla['INTERVENCIONMEXICALIID'];
								} else if ($municipio == 4 || $municipio == 5) {
									$intervencion = $plantilla['INTERVENCIONTIJUANAID'];
								}
								$dataInter =  array('SOLICITUDID' => $_solicitudPericial->SOLICITUDID, 'INTERVENCIONID' => $intervencion);

								$_intervencionPericial = $this->_createIntervencionPericial($dataInter, $municipio);
								$datosBitacora = [
									'ACCION' => 'Se envio una solicitud perital.',
									'NOTAS' => 'Exp: ' . $expediente . ' Solicitud: ' . $_solicitudPericial->SOLICITUDID . 'Intervencion' . $intervencion,
								];
								$this->_bitacoraActividad($datosBitacora);
							}
						}
					}
				}

				if ($_bandeja_creada->status == 201) {
					return redirect()->to(base_url('/admin/dashboard/bandeja'))->with('message_success', 'Remitido correctamente');
				}
			} else {
				return redirect()->to(base_url('/admin/dashboard/bandeja'))->with('message_error', 'No se actualizo el folio');
			}
		} catch (\Exception $e) {
			return redirect()->to(base_url('/admin/dashboard/bandeja'))->with('message_error', 'Hubo un error en la remisión, verifica el expediente en justicia.');
		}
	}

	public function bandeja_rac()
	{
		try {

			$expediente = trim($this->request->getPost('expediente'));
			$modulo = trim($this->request->getPost('modulo'));
			$procedimiento = trim($this->request->getPost('procedimiento'));
			$municipio = trim($this->request->getPost('municipio'));

			$documents = $this->_folioDocModel->asObject()->where('NUMEROEXPEDIENTE', $expediente . '1')->findAll();

			// $updateDoc = $this->_folioDocModel->set($dataFolioDoc)->where('NUMEROEXPEDIENTE', $expediente)->update();

			$bandeja = $this->_folioModel->where('EXPEDIENTEID', $expediente)->first();
			$getMediador = $this->getMediador($municipio, $modulo);

			$_bandeja_rac = $this->_createJusticiaAlterna($expediente, $procedimiento, $municipio);


			if ($_bandeja_rac->status == 201) {
				$dataBandeja = array(
					'FOLIOID'=>	$bandeja['FOLIOID'],
					'ANO'=>	$bandeja['ANO'],
					'EXPEDIENTEID'=>$expediente,
					'TIPOPROCEDIMIENTOID' => $procedimiento,
					'MODULOID' => $modulo,
					'MEDIADORID' => $getMediador->data->EMPLEADOID_MEDIADOR
				);
			
	
				$bandejaRac = $this->_bandejaRacModel->insert($dataBandeja);

				if (!$bandejaRac) {
					return redirect()->to(base_url('/admin/dashboard/bandeja'))->with('message_success', 'Remitido correctamente');
				}
				// $subirArchivos = $this->subirArchivosRemision($bandeja['FOLIOID'], $bandeja['ANO'], $expediente);
				// $folioDoc = $this->_folioDocModel->where('NUMEROEXPEDIENTE', $expediente)->where('STATUS', 'FIRMADO')->join('RELACIONFOLIODOCEXPDOC', 'FOLIODOC.NUMEROEXPEDIENTE = RELACIONFOLIODOCEXPDOC.EXPEDIENTEID  AND FOLIODOC.FOLIODOCID = RELACIONFOLIODOCEXPDOC.FOLIODOCID')->orderBy('FOLIODOC.FOLIODOCID', 'asc')->like('TIPODOC', 'SOLICITUD DE PERITAJE')->findAll();
				// if ($folioDoc) {
				// 	foreach ($folioDoc as $key => $doc) {
				// 		$solicitudp = array();
				// 		$solicitudp['ESTADOID'] = 2;
				// 		$solicitudp['MUNICIPIOID'] = $municipio;
				// 		$solicitudp['EMPLEADOIDREGISTRO'] = $_bandeja_rac->empleado;
				// 		$solicitudp['OFICINAIDREGISTRO'] = $oficina;
				// 		$solicitudp['AREAIDREGISTRO'] = $area;
				// 		$solicitudp['ANO'] = $doc['ANO'];
				// 		$solicitudp['TITULO'] = $doc['TIPODOC'];

				// 		$_solicitudPericial = $this->_createSolicitudesPericiales($solicitudp);
				// 		if ($_solicitudPericial->status == 201) {
				// 			$_solicitudDocto = $this->_createSolicitudDocto($expediente, $_solicitudPericial->SOLICITUDID, $doc['EXPEDIENTEDOCID'], $bandeja['MUNICIPIOASIGNADOID']);
				// 			if ($_solicitudDocto->status == 201) {
				// 				$_solicitudExpediente = $this->_createSolicitudExpediente($expediente, $_solicitudPericial->SOLICITUDID, $municipio);
				// 				$plantilla = (object) array();

				// 				$plantilla = $this->_plantillasModel->where('TITULO',  $doc['TIPODOC'])->first();
				// 				if ($municipio == 1 ||  $municipio == 6) {
				// 					$intervencion = $plantilla['INTERVENCIONENSENADAID'];
				// 				} else if ($municipio == 2 || $municipio == 3 || $municipio == 7) {
				// 					$intervencion = $plantilla['INTERVENCIONMEXICALIID'];
				// 				} else if ($municipio == 4 || $municipio == 5) {
				// 					$intervencion = $plantilla['INTERVENCIONTIJUANAID'];
				// 				}
				// 				$dataInter =  array('SOLICITUDID' => $_solicitudPericial->SOLICITUDID, 'INTERVENCIONID' => $intervencion);

				// 				$_intervencionPericial = $this->_createIntervencionPericial($dataInter, $municipio);
				// 				$datosBitacora = [
				// 					'ACCION' => 'Se envio una solicitud perital.',
				// 					'NOTAS' => 'Exp: ' . $expediente . ' Solicitud: ' . $_solicitudPericial->SOLICITUDID . 'Intervencion' . $intervencion,
				// 				];
				// 				$this->_bitacoraActividad($datosBitacora);
				// 			}
				// 		}
				// 	}
				// }
			}
		} catch (\Exception $e) {
			return redirect()->to(base_url('/admin/dashboard/bandeja'))->with('message_error', 'Hubo un error en la remisión, verifica el expediente en justicia.');
		}
	}


	public function video_denuncia()
	{
		$data = (object) array();
		$data->folio = $this->request->getGet('folio');
		$year = date('Y');

		// Catálogos
		$data->delitosUsuarios = $this->_delitosUsuariosModel->asObject()->orderBy('DELITO', 'ASC')->findAll();
		$lugares = $this->_hechoLugarModel->orderBy('HECHODESCR', 'ASC')->findAll();
		$lugares_sin = [];
		$lugares_fuego = [];
		$lugares_blanca = [];
		foreach ($lugares as $lugar) {
			if (strpos($lugar['HECHODESCR'], 'ARMA DE FUEGO')) {
				array_push($lugares_fuego, (object) $lugar);
			}
			if (strpos($lugar['HECHODESCR'], 'ARMA BLANCA')) {
				array_push($lugares_blanca, (object) $lugar);
			}
			if (!strpos($lugar['HECHODESCR'], 'ARMA BLANCA') && !strpos($lugar['HECHODESCR'], 'ARMA DE FUEGO')) {
				array_push($lugares_sin, (object) $lugar);
			}
		}
		$data->lugares = [];
		$data->lugares = (object) array_merge($lugares_sin, $lugares_blanca, $lugares_fuego);

		$data->edoCiviles = $this->_estadoCivilModel->asObject()->findAll();
		$data->nacionalidades = $this->_nacionalidadModel->asObject()->findAll();
		$data->calidadJuridica = $this->_folioPersonaCalidadJuridica->asObject()->findAll();
		$data->idiomas = $this->_idiomaModel->asObject()->findAll();
		$data->municipios = $this->_municipiosModel->asObject()->where('ESTADOID', 2)->findAll();
		$data->paises = $this->_paisesModel->asObject()->findAll();
		$data->estados = $this->_estadosModel->asObject()->findAll();
		$data->estadosExtranjeros = $this->_estadosExtranjeros->asObject()->findAll();

		$data->tiposIdentificaciones = $this->_tipoIdentificacionModel->asObject()->findAll();
		$data->escolaridades = $this->_escolaridadModel->asObject()->findAll();
		$data->ocupaciones = $this->_ocupacionModel->asObject()->findAll();
		$data->colorVehiculo = $this->_coloresVehiculoModel->asObject()->findAll();
		$data->tipoVehiculo = $this->_tipoVehiculoModel->asObject()->orderBy('VEHICULOTIPODESCR', 'ASC')->findAll();

		$data->parentesco = $this->_parentescoModel->asObject()->findAll();
		$data->figura = $this->_figuraModel->asObject()->findAll();

		$data->cejaContextura = $this->_cejaContexturaModel->asObject()->findAll();
		$data->caraForma = $this->_caraFormaModel->asObject()->findAll();
		$data->caraTamano = $this->_caraTamanoModel->asObject()->findAll();
		$data->caraTez = $this->_caraTezModel->asObject()->findAll();
		$data->orejaLobulo = $this->_orejaLobuloModel->asObject()->findAll();
		$data->orejaForma = $this->_orejaFomaModel->asObject()->findAll();
		$data->orejaTamano = $this->_orejaTamanoModel->asObject()->findAll();
		$data->cabelloColor = $this->_cabelloColorModel->asObject()->findAll();
		$data->cabelloEstilo = $this->_cabelloEstiloModel->asObject()->findAll();
		$data->cabelloTamano = $this->_cabelloTamanoModel->asObject()->findAll();
		$data->cabelloPeculiar = $this->_cabelloPeculiarModel->asObject()->findAll();
		$data->frenteAltura = $this->_frenteAlturaModel->asObject()->findAll();
		$data->frenteAnchura = $this->_frenteAnchuraModel->asObject()->findAll();
		$data->frenteForma = $this->_frenteFormaModel->asObject()->findAll();
		$data->frentePeculiar = $this->_frentePeculiarModel->asObject()->findAll();
		$data->cejaColocacion = $this->_cejaColocacionModel->asObject()->findAll();
		$data->cejaForma = $this->_cejaFormaModel->asObject()->findAll();
		$data->cejaTamano = $this->_cejaTamanoModel->asObject()->findAll();
		$data->cejaGrosor = $this->_cejaGrosorModel->asObject()->findAll();
		$data->ojoColocacion = $this->_ojoColocacionModel->asObject()->findAll();
		$data->ojoForma = $this->_ojoFormaModel->asObject()->findAll();
		$data->ojoTamano = $this->_ojoTamanoModel->asObject()->findAll();
		$data->ojoColor = $this->_ojoColorModel->asObject()->findAll();
		$data->ojoPeculiar = $this->_ojoPeculiarModel->asObject()->findAll();
		$data->narizTipo = $this->_narizTipoModel->asObject()->findAll();
		$data->narizTamano = $this->_narizTamanoModel->asObject()->findAll();
		$data->narizBase = $this->_narizBaseModel->asObject()->findAll();
		$data->narizPeculiar = $this->_narizPeculiarModel->asObject()->findAll();
		$data->bigoteForma = $this->_bigoteFormaModel->asObject()->findAll();
		$data->bigoteTamano = $this->_bigoteTamanoModel->asObject()->findAll();
		$data->bigoteGrosor = $this->_bigoteGrosorModel->asObject()->findAll();
		$data->bigotePeculiar = $this->_bigotePeculiarModel->asObject()->findAll();
		$data->bocaTamano = $this->_bocaTamanoModel->asObject()->findAll();
		$data->bocaPeculiar = $this->_bocaPeculiarModel->asObject()->findAll();
		$data->labioGrosor = $this->_labioGrosorModel->asObject()->findAll();
		$data->labioLongitud = $this->_labioLongitudModel->asObject()->findAll();
		$data->labioPeculiar = $this->_labioPeculiarModel->asObject()->findAll();
		$data->labioPosicion = $this->_labioPosicionModel->asObject()->findAll();
		$data->dienteTamano = $this->_dienteTamanoModel->asObject()->findAll();
		$data->dienteTipo = $this->_dienteTipoModel->asObject()->findAll();
		$data->dientePeculiar = $this->_dientePeculiarModel->asObject()->findAll();
		$data->barbillaForma = $this->_barbillaFormaModel->asObject()->findAll();
		$data->barbillaTamano = $this->_barbillaTamanoModel->asObject()->findAll();
		$data->barbillaInclinacion = $this->_barbillaInclinacionModel->asObject()->findAll();
		$data->barbillaPeculiar = $this->_barbillaPeculiarModel->asObject()->findAll();
		$data->barbaTamano = $this->_barbaTamanoModel->asObject()->findAll();
		$data->barbaPeculiar = $this->_barbaPeculiarModel->asObject()->findAll();
		$data->cuelloTamano = $this->_cuelloTamanoModel->asObject()->findAll();
		$data->cuelloGrosor = $this->_cuelloGrosorModel->asObject()->findAll();
		$data->cuelloPeculiar = $this->_cuelloPeculiarModel->asObject()->findAll();
		$data->hombroPosicion = $this->_hombroPosicionModel->asObject()->findAll();
		$data->hombroLongitud = $this->_hombroLongitudModel->asObject()->findAll();
		$data->hombroGrosor = $this->_hombroGrosorModel->asObject()->findAll();
		$data->estomago = $this->_estomagoModel->asObject()->findAll();
		$data->pielColor = $this->_pielColorModel->asObject()->findAll();
		$data->etnia = $this->_etniaModel->asObject()->findAll();
		$data->parentesco = $this->_parentescoModel->asObject()->findAll();
		$data->objetoclasificacion = $this->_objetoClasificacionModel->asObject()->findAll();
		$data->objetosubclasificacion = $this->_objetoSubclasificacionModel->asObject()->findAll();
		$data->tipomoneda = $this->_tipoMonedaModel->asObject()->findAll();
		$data->personafisica = $this->_folioPersonaFisicaModel->asObject()->where('FOLIOID', $data->folio)->where('ANO', $year)->findAll();
		$data->imputados = $this->_folioPersonaFisicaModel->asObject()->where('FOLIOID', $data->folio)->where('ANO', $year)->where('CALIDADJURIDICAID', 2)->findAll();
		$data->victimas = $this->_folioPersonaFisicaModel->asObject()->where('FOLIOID', $data->folio)->where('ANO', $year)->where('CALIDADJURIDICAID= 1 OR CALIDADJURIDICAID=6')->findAll();
		$data->plantillas = $this->_plantillasModel->asObject()->where('TITULO !=', 'CONSTANCIA DE EXTRAVIO')->findAll();
		$data->tipoExpediente = $this->_tipoExpedienteModel->asObject()->like('TIPOEXPEDIENTECLAVE', 'NUC')->orLike('TIPOEXPEDIENTECLAVE', 'NAC')->orLike('TIPOEXPEDIENTECLAVE', 'RAC')->findAll();

		$data->distribuidorVehiculo = $this->_vehiculoDistribuidorModel->asObject()->findAll();
		$data->marcaVehiculo = $this->_vehiculoMarcaModel->asObject()->findAll();
		$data->lineaVehiculo = $this->_vehiculoModeloModel->asObject()->findAll();
		$data->versionVehiculo = $this->_vehiculoVersionModel->asObject()->findAll();
		$data->tipoVehiculo = $this->_tipoVehiculoModel->asObject()->findAll();
		$data->servicioVehiculo = $this->_vehiculoServicioModel->asObject()->findAll();
		$data->colorVehiculo = $this->_coloresVehiculoModel->asObject()->findAll();
		$data->rolPermiso = $this->_rolesPermisosModel->asObject()->where('ROLID', session('ROLID'))->findAll();
		$data->delitosModalidad = $this->_delitoModalidadModel->asObject()->orderBy('DELITOMODALIDADDESCR', 'ASC')->where('DELITOMODALIDADDESCR IS NOT NULL')->findAll();
		$this->_loadView('Video denuncia', 'videodenuncia', '', $data, 'video_denuncia');
	}

	private function _loadView($title, $menu, $submenu, $data, $view)
	{
		$data2 = [
			'header_data' => (object) ['title' => $title, 'menu' => $menu, 'submenu' => $submenu],
			'body_data' => $data,
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
		if ($data == null) {
			return json_encode((object) ['exist' => 0]);
		} else if (count($data) > 0) {
			return json_encode((object) ['exist' => 1]);
		} else {
			return json_encode((object) ['exist' => 0]);
		}
	}

	public function getOficinasByMunicipio()
	{
		$municipio = $this->request->getPost('municipio');

		if (!empty($municipio)) {
			$data = $this->_oficinasModel->asObject()->where('MUNICIPIOID', $municipio)->orderBy('OFICINADESCR', 'asc')->findAll();
			return json_encode($data);
		} else {
			$data = $this->_oficinasModel->asObject()->orderBy('OFICINADESCR', 'asc')->findAll();
			return json_encode($data);
		}
	}


	public function getDerivacionByMunicipio()
	{
		$municipio = $this->request->getPost('municipio');
		$data = $this->_derivacionesAtencionesModel->asObject()->where('MUNICIPIOID', $municipio)->orderBy('INSTITUCIONREMISIONDESCR', 'asc')->findAll();
		return json_encode($data);
	}
	public function getDelitosModalidad()
	{
		$folio = $this->request->getPost('folio');
		$year = $this->request->getPost('year');
		$data =  $this->_relacionIDOModel->get_by_folio($folio, $year);

		return json_encode($data);
	}


	public function getCanalizacionByMunicipio()
	{
		$municipio = $this->request->getPost('municipio');
		$data = $this->_canalizacionesAtencionesModel->asObject()->where('MUNICIPIOID', $municipio)->orderBy('INSTITUCIONREMISIONDESCR', 'asc')->findAll();
		return json_encode($data);
	}
	public function getEmpleadosByMunicipioAndOficina()
	{
		$municipio = $this->request->getPost('municipio');
		$oficina = $this->request->getPost('oficina');

		if (!empty($municipio) && !empty($municipio)) {
			$data = $this->_empleadosModel->asObject()->where('MUNICIPIOID', $municipio)->where('OFICINAID', $oficina)->orderBy('NOMBRE', 'asc')->findAll();
			return json_encode($data);
		} else {
			$data = [];
			return json_encode($data);
		}
	}

	public function updateStatusFolio()
	{
		$status = $this->request->getPost('status');
		$motivo = $this->request->getPost('motivo');
		$folio = $this->request->getPost('folio');
		$year = $this->request->getPost('year');
		$institutomunicipio = $this->request->getPost('institutomunicipio');
		$institutoremision = $this->request->getPost('institutoremision');


		$agenteId = session('ID') ? session('ID') : 1;

		if ($status == 'DERIVADO' || $status == 'CANALIZADO') {
			$data = [
				'STATUS' => $status,
				'NOTASAGENTE' => $motivo,
				'AGENTEATENCIONID' => $agenteId,
				'FECHASALIDA' => date('Y-m-d H:i:s'),
				'INSTITUCIONREMISIONMUNICIPIOID' => $institutomunicipio,
				'INSTITUCIONREMISIONID' => $institutoremision
			];
		} else {
			$data = [
				'STATUS' => $status == 'ATENDIDA' ? 'CANALIZADO' : $status,
				'NOTASAGENTE' => $motivo,
				'AGENTEATENCIONID' => $agenteId,
				'FECHASALIDA' => date('Y-m-d H:i:s'),
			];
		}

		if (!empty($status) && !empty($motivo) && !empty($year) && !empty($folio) && !empty($agenteId)) {
			$folioRow = $this->_folioModel->where('ANO', $year)->where('FOLIOID', $folio)->where('STATUS', 'EN PROCESO')->first();
			if ($folioRow) {
				$update = $this->_folioModel->set($data)->where('ANO', $year)->where('FOLIOID', $folio)->update();

				if ($update) {
					$datosBitacora = [
						'ACCION' => 'Ha actualizado el status del folio',
						'NOTAS' => 'FOLIO: ' . $folio . ' AÑO: ' . $year . ' STATUS: ' . $status == 'ATENDIDA' ? 'CANALIZADO' : $status,
					];

					$this->_bitacoraActividad($datosBitacora);

					$folio = $this->_folioModel->asObject()->where('FOLIOID', $folio)->where('ANO', $year)->first();
					$denunciante = $this->_denunciantesModel->asObject()->where('DENUNCIANTEID', $folio->DENUNCIANTEID)->first();
					if ($folio->TIPODENUNCIA == 'VD') {

						if ($this->_sendEmailDerivacionCanalizacion($denunciante->CORREO, $folio->FOLIOID, $status)) {
							return json_encode(['status' => 1]);
						} else {
							return json_encode(['status' => 1]);
						}
					} else if ($folio->TIPODENUNCIA == 'DA') {
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
		$tiposExpedienteId = $this->request->getPost('tipo_expediente');

		try {
			if (!empty($tiposExpedienteId) && !empty($folio) && !empty($municipio) && !empty($estado) && !empty($notas)) {
				$folioRow = $this->_folioModel->where('ANO', $year)->where('FOLIOID', $folio)->where('STATUS', 'EN PROCESO')->first();

				if ($folioRow) {
					$personas = $this->_folioPersonaFisicaModel->where('FOLIOID', $folioRow['FOLIOID'])->where('ANO', $year)->orderBy('PERSONAFISICAID', 'asc')->findAll();
					$fisImpDelito = $this->_imputadoDelitoModel->where('FOLIOID', $folioRow['FOLIOID'])->where('ANO', $year)->findAll();
					$relacionFisFis = $this->_relacionIDOModel->where('FOLIOID', $folioRow['FOLIOID'])->where('ANO', $year)->findAll();
					$parentescos = $this->_parentescoPersonaFisicaModel->where('FOLIOID', $folioRow['FOLIOID'])->where('ANO', $year)->findAll();
					$vehiculos = $this->_folioVehiculoModel->where('FOLIOID', $folioRow['FOLIOID'])->where('ANO', $year)->findAll();


					$imputados_con_delito = array();
					$imputados = $this->_folioPersonaFisicaModel->where('FOLIOID', $folioRow['FOLIOID'])->where('ANO', $year)->orderBy('PERSONAFISICAID', 'asc')->where('CALIDADJURIDICAID', 2)->findAll();

					if (($folioRow['HECHOMUNICIPIOID'] == 1 || $folioRow['HECHOMUNICIPIOID'] == 6) &&
						!($municipio == 1 || $municipio == 6)
					) {
						throw new \Exception('Solo puedes dar salida a Ensenada o San Quintín por el municipio del hecho.');
					} else if (($folioRow['HECHOMUNICIPIOID'] == 2 || $folioRow['HECHOMUNICIPIOID'] == 3 || $folioRow['HECHOMUNICIPIOID'] == 7) &&
						!($municipio == 2 || $municipio == 3 || $municipio == 7)
					) {
						throw new \Exception('Solo puedes dar salida a Tecate, Mexicali y San Felipe por el municipio del hecho.');
					} else if (($folioRow['HECHOMUNICIPIOID'] == 4 || $folioRow['HECHOMUNICIPIOID'] == 5) &&
						!($municipio == 4 || $municipio == 5)
					) {
						throw new \Exception('Solo puedes dar salida a Tijuana o Playas de Rosarito por el municipio del hecho.');
					}

					foreach ($fisImpDelito as $value) {
						if (!in_array($value['PERSONAFISICAID'], $imputados_con_delito)) {
							array_push($imputados_con_delito, $value['PERSONAFISICAID']);
						}
					}

					if (count($imputados_con_delito) != count($imputados)) {
						throw new \Exception('Todos los imputados deben tener al menos 1 delito asignado');
					}


					$narracion = $folioRow['HECHONARRACION'];
					$fecha = $folioRow['HECHOFECHA'];

					$folioRow['MUNICIPIOID'] = $municipio;
					$folioRow['ESTADOID'] = $estado;
					$folioRow['HECHOMEDIOCONOCIMIENTOID'] = (string) 6;
					$folioRow['NOTASAGENTE'] = $notas;
					$folioRow['STATUS'] = 'EXPEDIENTE';
					$folioRow['AGENTEATENCIONID'] = session('ID') ? session('ID') : 1;
					$folioRow['AGENTEFIRMAID'] = session('ID') ? session('ID') : 1;

					$folioRow['HECHOFECHA'] = $folioRow['HECHOFECHA'] . ' ' . $folioRow['HECHOHORA'];
					$folioRow['HECHONARRACION'] = $notas;

					$folioRow['ESTADOJURIDICOEXPEDIENTEID'] = (string) 13;
					$folioRow['TIPOEXPEDIENTEID'] = (int)$tiposExpedienteId;

					$expedienteCreado = $this->_createExpediente($folioRow);
					// var_dump($expedienteCreado);exit;

					// $expedienteCreado = (object)array(
					// 	'status' => 201,
					// 	'EXPEDIENTEID' => '402002202200323'
					// );
					// return json_encode(['info' => $expedienteCreado]);

					unset($folioRow['OFICINAIDRESPONSABLE']);
					unset($folioRow['EMPLEADOIDREGISTRO']);
					unset($folioRow['AREAIDREGISTRO']);
					unset($folioRow['AREAIDRESPONSABLE']);
					unset($folioRow['ESTADOJURIDICOEXPEDIENTEID']);
					// unset($folioRow['TIPOEXPEDIENTEID']);

					$folioRow['HECHONARRACION'] = $narracion;
					$folioRow['HECHOFECHA'] = $fecha;
					$folioRow['MUNICIPIOASIGNADOID'] = $municipio;

					if ($expedienteCreado->status == 201) {
						$folioRow['EXPEDIENTEID'] = $expedienteCreado->EXPEDIENTEID;
						$folioRow['FECHASALIDA'] = date('Y-m-d H:i:s');

						$update = $this->_folioModel->set($folioRow)->where('FOLIOID', $folio)->where('ANO', $year)->update();
						$personasRelacionMysqlOracle = array();
						try {
							foreach ($personas as $key => $persona) {

								$_persona = $this->_createPersonaFisica($expedienteCreado->EXPEDIENTEID, $persona, $municipio);
								if ($_persona->status == 201) {

									$domicilios = $this->_folioPersonaFisicaDomicilioModel->where('FOLIOID', $folioRow['FOLIOID'])->where('ANO', $year)->where('PERSONAFISICAID', $persona['PERSONAFISICAID'])->findAll();
									$mediaFiliacion = $this->_folioMediaFiliacion->where('FOLIOID', $folioRow['FOLIOID'])->where('ANO', $year)->where('PERSONAFISICAID', $persona['PERSONAFISICAID'])->first();

									$personasRelacionMysqlOracle[$persona['PERSONAFISICAID']] = ['calidad' => $persona['CALIDADJURIDICAID'], 'id_mysql' => $persona['PERSONAFISICAID'], 'id_oracle' => $_persona->PERSONAFISICAID];

									if ($persona['CALIDADJURIDICAID'] == '2') {
										$_imputado = $this->_createExpImputado($expedienteCreado->EXPEDIENTEID, $_persona->PERSONAFISICAID, $municipio);
									}

									foreach ($domicilios as $key => $domicilio) {
										$_domicilio = $this->_createDomicilioPersonaFisica($expedienteCreado->EXPEDIENTEID, $_persona->PERSONAFISICAID, $domicilio, $municipio);
									}

									$_mediaFiliacion = $this->_createPersonaFisicaMediaFilicacion($expedienteCreado->EXPEDIENTEID, $_persona->PERSONAFISICAID, $mediaFiliacion, $municipio);
								}
							}

							//Relacion Persona Física Imputado delito
							if (count($fisImpDelito) > 0) {
								foreach ($fisImpDelito as $imputadodelito) {
									try {
										$relacion = $personasRelacionMysqlOracle[$imputadodelito['PERSONAFISICAID']];
										$_fisimpdelito = $this->_createFisImpDelito($expedienteCreado->EXPEDIENTEID, $imputadodelito, $relacion['id_oracle'], $municipio);
									} catch (\Error $e) {
									}
								}
							}

							//Relacion Victima Imputado
							if (count($relacionFisFis) > 0) {
								foreach ($relacionFisFis as $fisFis) {
									try {
										$victima = $personasRelacionMysqlOracle[$fisFis['PERSONAFISICAIDVICTIMA']];
										$imputado = $personasRelacionMysqlOracle[$fisFis['PERSONAFISICAIDIMPUTADO']];
										$_relacionFisFis = $this->_createRelacionFisFis($expedienteCreado->EXPEDIENTEID, $fisFis, $victima['id_oracle'], $imputado['id_oracle'], $municipio);
										// Expediente vehiculo
										if ($fisFis['DELITOMODALIDADID'] == 178 || $fisFis['DELITOMODALIDADID'] == 179) {
											if (count($vehiculos) > 0) {
												foreach ($vehiculos as $vehiculo) {
													try {
														$_expedienteVehiculo = $this->_createExpVehiculo($expedienteCreado->EXPEDIENTEID, $vehiculo, $municipio);
													} catch (\Error $e) {
													}
												}
											}
										}
									} catch (\Error $e) {
									}
								}
							}

							// Relacion Persona Física Imputado delito
							if (count($parentescos) > 0) {
								foreach ($parentescos as $parentesco) {
									try {
										$persona1 = $personasRelacionMysqlOracle[$parentesco['PERSONAFISICAID1']];
										$persona2 = $personasRelacionMysqlOracle[$parentesco['PERSONAFISICAID2']];
										$_relacionParentesco = $this->_createRelacionParentesco($expedienteCreado->EXPEDIENTEID, $parentesco, $persona1['id_oracle'], $persona2['id_oracle'], $municipio);
									} catch (\Error $e) {
									}
								}
							}
						} catch (\Exception $e) {
							throw new \Exception($e->getMessage());
						}

						if ($update) {
							if ($folioRow['TIPODENUNCIA'] == 'VD') {
								$denunciante = $this->_denunciantesModel->asObject()->where('DENUNCIANTEID', $folioRow['DENUNCIANTEID'])->first();
								if ($this->_sendEmailExpediente($denunciante->CORREO, $folio, $expedienteCreado->EXPEDIENTEID)) {
									return json_encode(['status' => 1, 'expediente' => $expedienteCreado->EXPEDIENTEID]);
								} else {
									return json_encode(['status' => 1, 'expediente' => $expedienteCreado->EXPEDIENTEID, 'message' => 'Correo no enviado']);
								}
							} else if ($folioRow['TIPODENUNCIA'] == 'DA') {
								return json_encode(['status' => 1, 'expediente' => $expedienteCreado->EXPEDIENTEID]);
							}
						} else {
							throw new \Exception('No hizo el update.');
						}
					} else {
						throw new \Exception($expedienteCreado->error);
					}
				} else {
					throw new \Exception('Ya fue atendido el folio');
				}
			} else {
				throw new \Exception('No se enviarón todas las variables necesarias.');
			}
		} catch (\Exception $e) {
			return json_encode(['status' => 0, 'error' => $e->getMessage()]);
		}
	}


	public function crearArchivo()
	{
		$folio = $this->request->getPost('folio');
		$year = $this->request->getPost('year');
		$expediente = $this->request->getPost('expediente');

		$folioDocSinFirmar = $this->_folioDocModel->where('FOLIOID', $folio)->where('ANO', $year)->where('NUMEROEXPEDIENTE', $expediente)->where('STATUS', 'ABIERTO')->orderBy('FOLIODOCID', 'asc')->findAll();
		$foliovd = $this->_folioModel->where('FOLIOID', $folio)->where('ANO', $year)->where('EXPEDIENTEID', $expediente)->where('STATUS', 'EXPEDIENTE')->first();

		if ($folioDocSinFirmar) {
			return json_encode((object)['status' => 4]);
		}

		$folioDoc = $this->_folioDocModel->where('FOLIOID', $folio)->where('ANO', $year)->where('NUMEROEXPEDIENTE', $expediente)->where('STATUS', 'FIRMADO')->orderBy('FOLIODOCID', 'asc')->findAll();
		$archivosExternosVD = $this->_archivoExternoModel->where('FOLIOID', $folio)->where('ANO', $year)->findAll();
		$folioDocPeritaje = $this->_folioDocModel->where('NUMEROEXPEDIENTE', $expediente)->where('STATUS', 'FIRMADO')->orderBy('FOLIODOC.FOLIODOCID', 'asc')->like('TIPODOC', 'SOLICITUD DE PERITAJE')->findAll();

		if ($archivosExternosVD) {
			try {

				foreach ($archivosExternosVD as $key => $arch) {
					$relacionDocArc = $this->_relacionFolioDocModel->where('FOLIOID', $arch['FOLIOID'])->where('ANO', $arch['ANO'])->where('FOLIODOCID', $arch['FOLIOARCHIVOID'])->where('TIPO', 'ARCHIVO')->orderBy('FOLIODOCID', 'asc')->first();
					if ($relacionDocArc == NULL) {
						$municipioid = $foliovd['MUNICIPIOID'] ? $foliovd['MUNICIPIOID'] : NULL;

						try {
							if (ENVIRONMENT == 'development') {
								if ($foliovd['MUNICIPIOASIGNADOID'] == 1) {
									$autor = 8944;
									$oficina = 792;
								} else if ($foliovd['MUNICIPIOASIGNADOID'] == 2 || $foliovd['MUNICIPIOASIGNADOID'] == 3) {
									$autor = 3947;
									$oficina = 394;
								} else if ($foliovd['MUNICIPIOASIGNADOID'] == 4 || $foliovd['MUNICIPIOASIGNADOID'] == 5) {
									$autor = 10710;
									$oficina = 924;
								}
							}

							if (ENVIRONMENT == 'production') {
								if ($foliovd['MUNICIPIOASIGNADOID'] == 1) {
									$autor = 8947;
									$oficina = 793;
								} else if ($foliovd['MUNICIPIOASIGNADOID'] == 2 || $foliovd['MUNICIPIOASIGNADOID'] == 3) {
									$autor = 4101;
									$oficina = 409;
								} else if ($foliovd['MUNICIPIOASIGNADOID'] == 4 || $foliovd['MUNICIPIOASIGNADOID'] == 5) {

									$autor = 10721;
									$oficina = 924;
								}
							}
							$_archivo = $this->_createArchivosExternos($expediente, $folio, $year,  $municipioid, 53, $arch['ARCHIVODESCR'], $arch['ARCHIVO'], $arch['EXTENSION'], $autor, $oficina);
							if ($_archivo->status == 201) {
								$datosRelacionFolio = [
									'FOLIODOCID' => $arch['FOLIOARCHIVOID'],
									'FOLIOID' =>  $arch['FOLIOID'],
									'ANO' => $arch['ANO'],
									'EXPEDIENTEID' => $_archivo->EXPEDIENTEID,
									'EXPEDIENTEARCHIVOID' => $_archivo->ARCHIVOID,
									'TIPO' => 'ARCHIVO',

								];
								$this->_relacionFolioDocModel->insert($datosRelacionFolio);
							}
						} catch (\Exception $e) {
						}
					}
				}
			} catch (\Throwable $th) {
			}
		}
		if ($folioDoc) {
			try {
				foreach ($folioDoc as $key => $doc) {
					$relacionDocArc = $this->_relacionFolioDocModel->where('FOLIOID', $doc['FOLIOID'])->where('ANO', $doc['ANO'])->where('FOLIODOCID', $doc['FOLIODOCID'])->where('TIPO', 'ARCHIVO DOC')->orderBy('FOLIODOCID', 'asc')->first();
					if ($relacionDocArc == NULL) {
						$municipioid = $foliovd['MUNICIPIOID'] ? $foliovd['MUNICIPIOID'] : NULL;

						try {
							if (ENVIRONMENT == 'development') {
								if ($foliovd['MUNICIPIOASIGNADOID'] == 1) {
									$autor = 8944;
									$oficina = 792;
								} else if ($foliovd['MUNICIPIOASIGNADOID'] == 2 || $foliovd['MUNICIPIOASIGNADOID'] == 3) {
									$autor = 3947;
									$oficina = 394;
								} else if ($foliovd['MUNICIPIOASIGNADOID'] == 4 || $foliovd['MUNICIPIOASIGNADOID'] == 5) {
									$autor = 10710;
									$oficina = 924;
								}
							}

							if (ENVIRONMENT == 'production') {
								if ($foliovd['MUNICIPIOASIGNADOID'] == 1) {
									$autor = 8947;
									$oficina = 793;
								} else if ($foliovd['MUNICIPIOASIGNADOID'] == 2 || $foliovd['MUNICIPIOASIGNADOID'] == 3) {
									$autor = 4101;
									$oficina = 409;
								} else if ($foliovd['MUNICIPIOASIGNADOID'] == 4 || $foliovd['MUNICIPIOASIGNADOID'] == 5) {

									$autor = 10721;
									$oficina = 924;
								}
							}
							$_archivo = $this->_createArchivosExternos($expediente, $folio, $year,  $municipioid, 53,  $doc['TIPODOC'], $doc['PDF'], 'pdf', $autor, $oficina);
							// $_archivo = $this->_createArchivosExternos($expediente, $folio, $year,  $municipioid, 53, $doc['TIPODOC'], $doc['PDF'], 'pdf', 3947,  394);
							if ($_archivo->status == 201) {
								$datosRelacionFolio = [
									'FOLIODOCID' => $doc['FOLIODOCID'],
									'FOLIOID' =>  $doc['FOLIOID'],
									'ANO' => $doc['ANO'],
									'EXPEDIENTEID' => $_archivo->EXPEDIENTEID,
									'EXPEDIENTEARCHIVOID' => $_archivo->ARCHIVOID,
									'TIPO' => 'ARCHIVO DOC',

								];
								$this->_relacionFolioDocModel->insert($datosRelacionFolio);
							}
						} catch (\Exception $e) {
						}
					}
				}
			} catch (\Exception $e) {
				return json_encode(['status' => 0, 'error' => $e->getMessage()]);
			}
		}
		if ($folioDocPeritaje) {
			try {

				foreach ($folioDocPeritaje as $key => $docP) {
					// $relacionDoc = $this->_relacionFolioDocModel->where('FOLIOID', $docP['FOLIOID'])->where('ANO', $docP['ANO'])->where('EXPEDIENTEID', $docP['NUMEROEXPEDIENTE'])->where('FOLIODOCID', $docP['FOLIODOCID'])->where('TIPO', 'DOCUMENTO PERITAJE')->orderBy('FOLIODOCID', 'asc')->first();

					// if ($relacionDoc == NULL) {
					// 	$municipioid = $docP['MUNICIPIOID'] ? $docP['MUNICIPIOID'] : NULL;

					// 	try {
					// 		$_archivo = $this->_createArchivosExternos($expediente, $folio, $year,  $municipioid, $docP['CLASIFICACIONDOCTOID'], $docP['TIPODOC'], $docP['PDF'], 'pdf');
					// 		if ($_archivo->status == 201) {
					// 			$datosRelacionFolio = [
					// 				'FOLIODOCID' => $docP['FOLIODOCID'],
					// 				'FOLIOID' =>  $docP['FOLIOID'],
					// 				'ANO' => $docP['ANO'],
					// 				'EXPEDIENTEID' => $_archivo->EXPEDIENTEID,
					// 				'EXPEDIENTEARCHIVOID' => $_archivo->ARCHIVOID,
					// 				'TIPO' => 'DOCUMENTO PERITAJE',

					// 			];
					// 			$this->_relacionFolioDocModel->insert($datosRelacionFolio);
					// 		}
					// 	} catch (\Exception $e) {
					// 	}
					// }
					$relacionDocExpDoc = $this->_relacionFolioDocExpDoc->where('FOLIOID', $docP['FOLIOID'])->where('ANO', $docP['ANO'])->where('EXPEDIENTEID', $docP['NUMEROEXPEDIENTE'])->where('FOLIODOCID', $docP['FOLIODOCID'])->orderBy('FOLIODOCID', 'asc')->first();

					if ($relacionDocExpDoc == null) {

						try {
							PHPRtfLite::registerAutoloader();
							// instancia de documento rtf 
							$rtf = new PHPRtfLite();
							$sect = $rtf->addSection();
							$docP['PLACEHOLDER'] = str_replace('</p>', '<br>', $docP['PLACEHOLDER']);

							$sinetiqueta = strip_tags($docP['PLACEHOLDER'], ['strong', 'br']); //placeolder sin etiquetas html
							//escribe el texto del rtf
							$sect->writeText($sinetiqueta, new PHPRtfLite_Font(11, 'Arial'), new PHPRtfLite_ParFormat(PHPRtfLite_ParFormat::TEXT_ALIGN_JUSTIFY));
							// save rtf document
							$rtf->save('assets/' . $docP['NUMEROEXPEDIENTE'] . '_' . $docP['FOLIODOCID'] . '.rtf');
							$tarjet = FCPATH  . 'assets/' . $docP['NUMEROEXPEDIENTE'] . "_" . $docP['FOLIODOCID'] . ".rtf";
							//contenido del rtf guardado
							$data = file_get_contents($tarjet);
							//creacion del documento rtf
							$document = new Document($data);
							$espacio = implode(chr(0), str_split($data));
							// fwrite($fh, $espacio) or die("No se pudo escribir en el archivo");
							// $data2 = file_get_contents($tarjet2);
							// fwrite($tarjet2, $espacio);
							$plantilla = (object) array();

							$plantilla = $this->_plantillasModel->where('TITULO', $docP['TIPODOC'])->first();

							$documentos = array();
							$documentos['DOCUMENTO'] = base64_encode($espacio);
							$documentos['DOCTODESCR'] = $docP['TIPODOC'];

							if (ENVIRONMENT == 'development') {
								if ($foliovd['MUNICIPIOASIGNADOID'] == 1) {
									$documentos['AUTOR'] = 8944;
									$documentos['OFICINAIDAUTOR'] = 792;
								} else if ($foliovd['MUNICIPIOASIGNADOID'] == 2 || $foliovd['MUNICIPIOASIGNADOID'] == 3) {
									$documentos['AUTOR'] = 3947;
									$documentos['OFICINAIDAUTOR'] = 394;
								} else if ($foliovd['MUNICIPIOASIGNADOID'] == 4 || $foliovd['MUNICIPIOASIGNADOID'] == 5) {
									$documentos['AUTOR'] = 10710;
									$documentos['OFICINAIDAUTOR'] = 924;
								}
							}
							if (ENVIRONMENT == 'production') {
								if ($foliovd['MUNICIPIOASIGNADOID'] == 1) {
									$documentos['AUTOR'] = 8947;
									$documentos['OFICINAIDAUTOR'] = 793;
								} else if ($foliovd['MUNICIPIOASIGNADOID'] == 2 || $foliovd['MUNICIPIOASIGNADOID'] == 3) {
									$documentos['AUTOR'] = 4101;
									$documentos['OFICINAIDAUTOR'] = 409;
								} else if ($foliovd['MUNICIPIOASIGNADOID'] == 4 || $foliovd['MUNICIPIOASIGNADOID'] == 5) {
									$documentos['AUTOR'] = 10721;
									$documentos['OFICINAIDAUTOR'] = 924;
								}
							}
							// $documentos['AUTOR'] = 3947;
							// $documentos['OFICINAIDAUTOR'] = 394;


							$documentos['STATUSDOCUMENTOID'] = 4;
							if ($foliovd['MUNICIPIOASIGNADOID'] == 1) {
								$documentos['CLASIFICACIONDOCTOID'] = $plantilla['CLASIFICACIONDOCTOENSENADAID'];
								$documentos['PLANTILLAID'] = $plantilla['PLANTILLAJUSTICIAENSENADAID'];
							} else if ($foliovd['MUNICIPIOASIGNADOID'] == 2) {
								$documentos['CLASIFICACIONDOCTOID'] = $plantilla['CLASIFICACIONDOCTOMEXICALIID'];
								$documentos['PLANTILLAID'] = $plantilla['PLANTILLAJUSTICIAMEXICALIID'];
							} else if ($foliovd['MUNICIPIOASIGNADOID'] == 3) {
								$documentos['CLASIFICACIONDOCTOID'] = $plantilla['CLASIFICACIONDOCTOMEXICALIID'];
								$documentos['PLANTILLAID'] = $plantilla['PLANTILLAJUSTICIAMEXICALIID'];
							} else if ($foliovd['MUNICIPIOASIGNADOID'] == 4) {
								$documentos['CLASIFICACIONDOCTOID'] = $plantilla['CLASIFICACIONDOCTOTIJUANAID'];
								$documentos['PLANTILLAID'] = $plantilla['PLANTILLAJUSTICIATIJUANAID'];
							} else if ($foliovd['MUNICIPIOASIGNADOID'] == 5) {
								$documentos['CLASIFICACIONDOCTOID'] = $plantilla['CLASIFICACIONDOCTOTIJUANAID'];
								$documentos['PLANTILLAID'] = $plantilla['PLANTILLAJUSTICIATIJUANAID'];
							} else if ($foliovd['MUNICIPIOASIGNADOID'] == 6) {
								$documentos['CLASIFICACIONDOCTOID'] = $plantilla['CLASIFICACIONDOCTOENSENADAID'];
								$documentos['PLANTILLAID'] = $plantilla['PLANTILLAJUSTICIAENSENADAID'];
							} else if ($foliovd['MUNICIPIOASIGNADOID'] == 7) {
								$documentos['CLASIFICACIONDOCTOID'] = $plantilla['CLASIFICACIONDOCTOMEXICALIID'];
								$documentos['PLANTILLAID'] = $plantilla['pLANTILLAJUSTICIAMEXICALIID'];
							}

							$expedienteDocumento = $this->_createFolioDocumentos($expediente, $documentos, $docP['MUNICIPIOID']);

							if ($expedienteDocumento->status == 201) {
								unlink(FCPATH  . 'assets/' . $docP['NUMEROEXPEDIENTE'] . "_" . $docP['FOLIODOCID'] . ".rtf");
								// unlink(FCPATH  . 'assets/' . $doc['NUMEROEXPEDIENTE'] . "_" . $doc['FOLIODOCID'] . ".bin");	
								$datosRelacionFolioExpDoc = [
									'FOLIODOCID' => $docP['FOLIODOCID'],
									'FOLIOID' =>  $docP['FOLIOID'],
									'ANO' => $docP['ANO'],
									'EXPEDIENTEID' => $expedienteDocumento->EXPEDIENTEID,
									'EXPEDIENTEDOCID' => $expedienteDocumento->DOCUMENTOID,
								];

								$this->_relacionFolioDocExpDoc->insert($datosRelacionFolioExpDoc);
							}
						} catch (\Throwable $th) {
						}
					}
				}

				return json_encode(['status' => 1]);
			} catch (\Exception $e) {
				return json_encode(['status' => 0, 'error' => $e->getMessage()]);
			}
		} else {
			return json_encode(['status' => 1]);
		}
	}


	public function subirArchivosRemision($folio, $year, $expediente)
	{

		$folioDocSinFirmar = $this->_folioDocModel->where('FOLIOID', $folio)->where('ANO', $year)->where('NUMEROEXPEDIENTE', $expediente)->where('STATUS', 'ABIERTO')->orderBy('FOLIODOCID', 'asc')->findAll();
		$foliovd = $this->_folioModel->where('FOLIOID', $folio)->where('ANO', $year)->where('EXPEDIENTEID', $expediente)->where('STATUS', 'EXPEDIENTE')->first();

		if ($folioDocSinFirmar) {
			return json_encode((object)['status' => 4]);
		}

		$folioDoc = $this->_folioDocModel->where('FOLIOID', $folio)->where('ANO', $year)->where('NUMEROEXPEDIENTE', $expediente)->where('STATUS', 'FIRMADO')->orderBy('FOLIODOCID', 'asc')->findAll();
		$archivosExternosVD = $this->_archivoExternoModel->where('FOLIOID', $folio)->where('ANO', $year)->findAll();
		$folioDocPeritaje = $this->_folioDocModel->where('NUMEROEXPEDIENTE', $expediente)->where('STATUS', 'FIRMADO')->orderBy('FOLIODOC.FOLIODOCID', 'asc')->like('TIPODOC', 'SOLICITUD DE PERITAJE')->findAll();

		if ($archivosExternosVD) {
			try {

				foreach ($archivosExternosVD as $key => $arch) {
					$relacionDocArc = $this->_relacionFolioDocModel->where('FOLIOID', $arch['FOLIOID'])->where('ANO', $arch['ANO'])->where('FOLIODOCID', $arch['FOLIOARCHIVOID'])->where('TIPO', 'ARCHIVO')->orderBy('FOLIODOCID', 'asc')->first();
					if ($relacionDocArc == NULL) {
						$municipioid = $foliovd['MUNICIPIOID'] ? $foliovd['MUNICIPIOID'] : NULL;

						try {
							if (ENVIRONMENT == 'development') {
								if ($foliovd['MUNICIPIOASIGNADOID'] == 1) {
									$autor = 8944;
									$oficina = 792;
								} else if ($foliovd['MUNICIPIOASIGNADOID'] == 2 || $foliovd['MUNICIPIOASIGNADOID'] == 3) {
									$autor = 3947;
									$oficina = 394;
								} else if ($foliovd['MUNICIPIOASIGNADOID'] == 4 || $foliovd['MUNICIPIOASIGNADOID'] == 5) {
									$autor = 10710;
									$oficina = 924;
								}
							}

							if (ENVIRONMENT == 'production') {
								if ($foliovd['MUNICIPIOASIGNADOID'] == 1) {
									$autor = 8947;
									$oficina = 793;
								} else if ($foliovd['MUNICIPIOASIGNADOID'] == 2 || $foliovd['MUNICIPIOASIGNADOID'] == 3) {
									$autor = 4101;
									$oficina = 409;
								} else if ($foliovd['MUNICIPIOASIGNADOID'] == 4 || $foliovd['MUNICIPIOASIGNADOID'] == 5) {

									$autor = 10721;
									$oficina = 924;
								}
							}

							$_archivo = $this->_createArchivosExternos($expediente, $folio, $year,  $municipioid, 53, $arch['ARCHIVODESCR'], $arch['ARCHIVO'], $arch['EXTENSION'], $autor, $oficina);
							if ($_archivo->status == 201) {
								$datosRelacionFolio = [
									'FOLIODOCID' => $arch['FOLIOARCHIVOID'],
									'FOLIOID' =>  $arch['FOLIOID'],
									'ANO' => $arch['ANO'],
									'EXPEDIENTEID' => $_archivo->EXPEDIENTEID,
									'EXPEDIENTEARCHIVOID' => $_archivo->ARCHIVOID,
									'TIPO' => 'ARCHIVO',

								];
								$this->_relacionFolioDocModel->insert($datosRelacionFolio);
							}
						} catch (\Exception $e) {
						}
					}
				}
			} catch (\Throwable $th) {
			}
		}
		if ($folioDoc) {
			try {
				foreach ($folioDoc as $key => $doc) {
					$relacionDocArc = $this->_relacionFolioDocModel->where('FOLIOID', $doc['FOLIOID'])->where('ANO', $doc['ANO'])->where('FOLIODOCID', $doc['FOLIODOCID'])->where('TIPO', 'ARCHIVO DOC')->orderBy('FOLIODOCID', 'asc')->first();
					if ($relacionDocArc == NULL) {
						$municipioid = $foliovd['MUNICIPIOID'] ? $foliovd['MUNICIPIOID'] : NULL;

						try {
							if (ENVIRONMENT == 'development') {
								if ($foliovd['MUNICIPIOASIGNADOID'] == 1) {
									$autor = 8944;
									$oficina = 792;
								} else if ($foliovd['MUNICIPIOASIGNADOID'] == 2 || $foliovd['MUNICIPIOASIGNADOID'] == 3) {
									$autor = 3947;
									$oficina = 394;
								} else if ($foliovd['MUNICIPIOASIGNADOID'] == 4 || $foliovd['MUNICIPIOASIGNADOID'] == 5) {
									$autor = 10710;
									$oficina = 924;
								}
							}

							if (ENVIRONMENT == 'production') {
								if ($foliovd['MUNICIPIOASIGNADOID'] == 1) {
									$autor = 8947;
									$oficina = 793;
								} else if ($foliovd['MUNICIPIOASIGNADOID'] == 2 || $foliovd['MUNICIPIOASIGNADOID'] == 3) {
									$autor = 4101;
									$oficina = 409;
								} else if ($foliovd['MUNICIPIOASIGNADOID'] == 4 || $foliovd['MUNICIPIOASIGNADOID'] == 5) {

									$autor = 10721;
									$oficina = 924;
								}
							}
							$_archivo = $this->_createArchivosExternos($expediente, $folio, $year,  $municipioid, 53,  $doc['TIPODOC'], $doc['PDF'], 'pdf', $autor, $oficina);

							// $_archivo = $this->_createArchivosExternos($expediente, $folio, $year,  $municipioid, 53, $doc['TIPODOC'], $doc['PDF'], 'pdf',$doc['AGENTEID'],  $doc['OFICINAID']);
							if ($_archivo->status == 201) {
								$datosRelacionFolio = [
									'FOLIODOCID' => $doc['FOLIODOCID'],
									'FOLIOID' =>  $doc['FOLIOID'],
									'ANO' => $doc['ANO'],
									'EXPEDIENTEID' => $_archivo->EXPEDIENTEID,
									'EXPEDIENTEARCHIVOID' => $_archivo->ARCHIVOID,
									'TIPO' => 'ARCHIVO DOC',

								];
								$this->_relacionFolioDocModel->insert($datosRelacionFolio);
							}
						} catch (\Exception $e) {
						}
					}
				}
			} catch (\Exception $e) {
				// return json_encode(['status' => 0, 'error' => $e->getMessage()]);
			}
		}
		if ($folioDocPeritaje) {
			try {

				foreach ($folioDocPeritaje as $key => $docP) {

					$relacionDocExpDoc = $this->_relacionFolioDocExpDoc->where('FOLIOID', $docP['FOLIOID'])->where('ANO', $docP['ANO'])->where('EXPEDIENTEID', $docP['NUMEROEXPEDIENTE'])->where('FOLIODOCID', $docP['FOLIODOCID'])->orderBy('FOLIODOCID', 'asc')->first();

					if ($relacionDocExpDoc == null) {

						try {
							PHPRtfLite::registerAutoloader();
							// instancia de documento rtf 
							$rtf = new PHPRtfLite();
							$sect = $rtf->addSection();
							$docP['PLACEHOLDER'] = str_replace('</p>', '<br>', $docP['PLACEHOLDER']);

							$sinetiqueta = strip_tags($docP['PLACEHOLDER'], ['strong', 'br']); //placeolder sin etiquetas html
							//escribe el texto del rtf
							$sect->writeText($sinetiqueta, new PHPRtfLite_Font(11, 'Arial'), new PHPRtfLite_ParFormat(PHPRtfLite_ParFormat::TEXT_ALIGN_JUSTIFY));
							// save rtf document
							$rtf->save('assets/' . $docP['NUMEROEXPEDIENTE'] . '_' . $docP['FOLIODOCID'] . '.rtf');
							$tarjet = FCPATH  . 'assets/' . $docP['NUMEROEXPEDIENTE'] . "_" . $docP['FOLIODOCID'] . ".rtf";
							//contenido del rtf guardado
							$data = file_get_contents($tarjet);
							//creacion del documento rtf
							$document = new Document($data);
							$espacio = implode(chr(0), str_split($data));
							// fwrite($fh, $espacio) or die("No se pudo escribir en el archivo");
							// $data2 = file_get_contents($tarjet2);
							// fwrite($tarjet2, $espacio);
							$plantilla = (object) array();

							$plantilla = $this->_plantillasModel->where('TITULO', $docP['TIPODOC'])->first();
							$documentos = array();
							$documentos['DOCUMENTO'] = base64_encode($espacio);
							$documentos['DOCTODESCR'] = $docP['TIPODOC'];
							if (ENVIRONMENT == 'development') {
								if ($foliovd['MUNICIPIOASIGNADOID'] == 1) {
									$documentos['AUTOR'] = 8944;
									$documentos['OFICINAIDAUTOR'] = 792;
								} else if ($foliovd['MUNICIPIOASIGNADOID'] == 2 || $foliovd['MUNICIPIOASIGNADOID'] == 3) {
									$documentos['AUTOR'] = 3947;
									$documentos['OFICINAIDAUTOR'] = 394;
								} else if ($foliovd['MUNICIPIOASIGNADOID'] == 4 || $foliovd['MUNICIPIOASIGNADOID'] == 5) {
									$documentos['AUTOR'] = 10710;
									$documentos['OFICINAIDAUTOR'] = 924;
								}
							}
							if (ENVIRONMENT == 'production') {
								if ($foliovd['MUNICIPIOASIGNADOID'] == 1) {
									$documentos['AUTOR'] = 8947;
									$documentos['OFICINAIDAUTOR'] = 793;
								} else if ($foliovd['MUNICIPIOASIGNADOID'] == 2 || $foliovd['MUNICIPIOASIGNADOID'] == 3) {
									$documentos['AUTOR'] = 4101;
									$documentos['OFICINAIDAUTOR'] = 409;
								} else if ($foliovd['MUNICIPIOASIGNADOID'] == 4 || $foliovd['MUNICIPIOASIGNADOID'] == 5) {
									$documentos['AUTOR'] = 10721;
									$documentos['OFICINAIDAUTOR'] = 924;
								}
							}

							$documentos['STATUSDOCUMENTOID'] = 4;
							if ($foliovd['MUNICIPIOASIGNADOID'] == 1) {
								$documentos['CLASIFICACIONDOCTOID'] = $plantilla['CLASIFICACIONDOCTOENSENADAID'];
								$documentos['PLANTILLAID'] = $plantilla['PLANTILLAJUSTICIAENSENADAID'];
							} else if ($foliovd['MUNICIPIOASIGNADOID'] == 2) {
								$documentos['CLASIFICACIONDOCTOID'] = $plantilla['CLASIFICACIONDOCTOMEXICALIID'];
								$documentos['PLANTILLAID'] = $plantilla['PLANTILLAJUSTICIAMEXICALIID'];
							} else if ($foliovd['MUNICIPIOASIGNADOID'] == 3) {
								$documentos['CLASIFICACIONDOCTOID'] = $plantilla['CLASIFICACIONDOCTOMEXICALIID'];
								$documentos['PLANTILLAID'] = $plantilla['PLANTILLAJUSTICIAMEXICALIID'];
							} else if ($foliovd['MUNICIPIOASIGNADOID'] == 4) {
								$documentos['CLASIFICACIONDOCTOID'] = $plantilla['CLASIFICACIONDOCTOTIJUANAID'];
								$documentos['PLANTILLAID'] = $plantilla['PLANTILLAJUSTICIATIJUANAID'];
							} else if ($foliovd['MUNICIPIOASIGNADOID'] == 5) {
								$documentos['CLASIFICACIONDOCTOID'] = $plantilla['CLASIFICACIONDOCTOTIJUANAID'];
								$documentos['PLANTILLAID'] = $plantilla['PLANTILLAJUSTICIATIJUANAID'];
							} else if ($foliovd['MUNICIPIOASIGNADOID'] == 6) {
								$documentos['CLASIFICACIONDOCTOID'] = $plantilla['CLASIFICACIONDOCTOENSENADAID'];
								$documentos['PLANTILLAID'] = $plantilla['PLANTILLAJUSTICIAENSENADAID'];
							} else if ($foliovd['MUNICIPIOASIGNADOID'] == 7) {
								$documentos['CLASIFICACIONDOCTOID'] = $plantilla['CLASIFICACIONDOCTOMEXICALIID'];
								$documentos['PLANTILLAID'] = $plantilla['pLANTILLAJUSTICIAMEXICALIID'];
							}




							$expedienteDocumento = $this->_createFolioDocumentos($expediente, $documentos, $docP['MUNICIPIOID']);

							if ($expedienteDocumento->status == 201) {
								unlink(FCPATH  . 'assets/' . $docP['NUMEROEXPEDIENTE'] . "_" . $docP['FOLIODOCID'] . ".rtf");
								// unlink(FCPATH  . 'assets/' . $doc['NUMEROEXPEDIENTE'] . "_" . $doc['FOLIODOCID'] . ".bin");	
								$datosRelacionFolioExpDoc = [
									'FOLIODOCID' => $docP['FOLIODOCID'],
									'FOLIOID' =>  $docP['FOLIOID'],
									'ANO' => $docP['ANO'],
									'EXPEDIENTEID' => $expedienteDocumento->EXPEDIENTEID,
									'EXPEDIENTEDOCID' => $expedienteDocumento->DOCUMENTOID,
								];

								$this->_relacionFolioDocExpDoc->insert($datosRelacionFolioExpDoc);
							}
						} catch (\Throwable $th) {
						}
					}
				}

				// return json_encode(['status' => 1]);
			} catch (\Exception $e) {
				// return json_encode(['status' => 0, 'error' => $e->getMessage()]);
			}
		} else {
			// return json_encode(['status' => 1]);
		}
	}

	private function _createExpediente($folioRow)
	{
		$function = '/expediente.php?process=crear';
		$endpoint = $this->endpoint . $function;
		$conexion = $this->_conexionesDBModel->asObject()->where('ESTADOID', 2)->where('MUNICIPIOID', (int) $folioRow['MUNICIPIOID'])->where('TYPE', ENVIRONMENT)->first();
		// $conexion = $this->_conexionesDBModel->asObject()->where('ESTADOID', 2)->where('MUNICIPIOID', (int)$folioRow['MUNICIPIOID'])->where('TYPE', 'production')->first();
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
			// "EMPLEADOIDREGISTRO",
			// "OFICINAIDRESPONSABLE",
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
			// "AREAIDREGISTRO",
			// "AREAIDRESPONSABLE",
			"LOCALIZACIONPERSONA",
			"CONCLUIDO",
			"EXHORTOAUTORIDADID",
			"HECHOCLASIFICACIONLUGARID",
			"HECHOVIALIDADID",
		];

		$data = $folioRow;

		foreach ($data as $clave => $valor) {
			if (empty($valor)) {
				unset($data[$clave]);
			}
		}
		foreach ($data as $clave => $valor) {
			if (!in_array($clave, $array)) {
				unset($data[$clave]);
			}
		}

		$data['userDB'] = $conexion->USER;
		$data['pwdDB'] = $conexion->PASSWORD;
		$data['instance'] = $conexion->IP . '/' . $conexion->INSTANCE;
		$data['schema'] = $conexion->SCHEMA;

		return $this->_curlPostDataEncrypt($endpoint, $data);
	}

	private function _createPersonaFisica($expedienteId, $personaFisica, $municipio)
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
			'TIEMPORESIDEDIAS',
			"FOTO",
		];
		$endpoint = $this->endpoint . $function;
		$conexion = $this->_conexionesDBModel->asObject()->where('ESTADOID', 2)->where('MUNICIPIOID', (int) $municipio)->where('TYPE', ENVIRONMENT)->first();
		$data = $personaFisica;

		$data['PERSONAESCOLARIDADID'] = $data['ESCOLARIDADID'];

		if (!empty($data['FECHANACIMIENTO'])) {
			if ($data['FECHANACIMIENTO'] == '0000-00-00' || $data['FECHANACIMIENTO'] == null || $data['FECHANACIMIENTO'] == null || $data['FECHANACIMIENTO'] == 'NULL' || $data['FECHANACIMIENTO'] == 'null') {
				$data['FECHANACIMIENTO'] = null;
			}
		}

		if ($data['DESAPARECIDA'] = "N") {
			$data['FOTO'] = null;
		}

		foreach ($data as $clave => $valor) {
			if (empty($valor)) {
				unset($data[$clave]);
			}
		}

		foreach ($data as $clave => $valor) {
			if (!in_array($clave, $array)) {
				unset($data[$clave]);
			}
		}

		$data['EXPEDIENTEID'] = $expedienteId;
		$data['userDB'] = $conexion->USER;
		$data['pwdDB'] = $conexion->PASSWORD;
		$data['instance'] = $conexion->IP . '/' . $conexion->INSTANCE;
		$data['schema'] = $conexion->SCHEMA;

		return $this->_curlPostDataEncrypt($endpoint, $data);
	}

	private function _createDomicilioPersonaFisica($expedienteId, $personaFisicaId, $domicilioPersonaFisica, $municipio)
	{
		if ($domicilioPersonaFisica['ESTADOID'] && $domicilioPersonaFisica['MUNICIPIOID'] && $domicilioPersonaFisica['LOCALIDADID']) {

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
				"NUMEROINTERIOR",
			];
			$endpoint = $this->endpoint . $function;
			$conexion = $this->_conexionesDBModel->asObject()->where('ESTADOID', 2)->where('MUNICIPIOID', (int) $municipio)->where('TYPE', ENVIRONMENT)->first();
			$data = $domicilioPersonaFisica;

			$data['EXPEDIENTEID'] = $expedienteId;
			$data['PERSONAFISICAID'] = $personaFisicaId;
			// if ($data['COLONIAID'] != 0) {
			// 	unset($data['COLONIADESCR']);
			// }
			unset($data['DOMICILIOID']);

			foreach ($data as $clave => $valor) {
				if (empty($valor)) {
					unset($data[$clave]);
				}
			}

			foreach ($data as $clave => $valor) {
				if (!in_array($clave, $array)) {
					unset($data[$clave]);
				}
			}
			$data['userDB'] = $conexion->USER;
			$data['pwdDB'] = $conexion->PASSWORD;
			$data['instance'] = $conexion->IP . '/' . $conexion->INSTANCE;
			$data['schema'] = $conexion->SCHEMA;

			return $this->_curlPostDataEncrypt($endpoint, $data);
		} else {
			return false;
		}
	}

	private function _createPersonaFisicaMediaFilicacion($expedienteId, $personaFisicaId, $personaFisicaMediaFiliacion, $municipio)
	{
		$function = '/mediaFiliacion.php?process=crear';
		$array = [
			'EXPEDIENTEID',
			'PERSONAFISICAID',
			'OCUPACIONID',
			'ESTATURA',
			'PESO',
			'SENASPARTICULARES',
			'PIELCOLORID',
			'FIGURAID',
			'CONTEXTURAID',
			'CARAFORMAID',
			'CARATAMANOID',
			'CARATEZID',
			'OREJALOBULOID',
			'OREJAFORMAID',
			'OREJATAMANOID',
			'OREJASEPARACIONID',
			'CABEZAFORMAID',
			'CABEZATAMANOID',
			'CABELLOCOLORID',
			'CABELLOESTILOID',
			'CABELLOTAMANOID',
			'CABELLOPECULIARID',
			'CABELLODESCR',
			'FRENTEALTURAID',
			'FRENTEANCHURAID',
			'FRENTEFORMAID',
			'FRENTEPECULIARID',
			'CEJACOLOCACIONID',
			'CEJAFORMAID',
			'CEJATAMANOID',
			'CEJAGROSORID',
			'OJOCOLOCACIONID',
			'OJOFORMAID',
			'OJOTAMANOID',
			'OJOCOLORID',
			'OJOPECULIARID',
			'NARIZTIPOID',
			'NARIZTAMANOID',
			'NARIZBASEID',
			'NARIZPECULIARID',
			'NARIZDESCR',
			'BIGOTEFORMAID',
			'BIGOTETAMANOID',
			'BIGOTEGROSORID',
			'BIGOTEPECULIARID',
			'BIGOTEDESCR',
			'BOCATAMANOID',
			'BOCAPECULIARID',
			'LABIOGROSORID',
			'LABIOLONGITUDID',
			'LABIOPOSICIONID',
			'LABIOPECULIARID',
			'DIENTETAMANOID',
			'DIENTETIPOID',
			'DIENTEPECULIARID',
			'DIENTEDESCR',
			'BARBILLAFORMAID',
			'BARBILLATAMANOID',
			'BARBILLAINCLINACIONID',
			'BARBILLAPECULIARID',
			'BARBILLADESCR',
			'BARBATAMANOID',
			'BARBAPECULIARID',
			'BARBADESCR',
			'CUELLOTAMANOID',
			'CUELLOGROSORID',
			'CUELLOPECULIARID',
			'CUELLODESCR',
			'HOMBROPOSICIONID',
			'HOMBROLONGITUDID',
			'HOMBROGROSORID',
			'ESTOMAGOID',
			'PERSONAESCOLARIDADID',
			'PERSONAETNIAID',
			'ESTOMAGODESCR',
		];
		$endpoint = $this->endpoint . $function;
		$conexion = $this->_conexionesDBModel->asObject()->where('ESTADOID', 2)->where('MUNICIPIOID', (int) $municipio)->where('TYPE', ENVIRONMENT)->first();
		$data = $personaFisicaMediaFiliacion;

		foreach ($data as $clave => $valor) {
			if (empty($valor)) {
				unset($data[$clave]);
			}
		}

		foreach ($data as $clave => $valor) {
			if (!in_array($clave, $array)) {
				unset($data[$clave]);
			}
		}

		$data['EXPEDIENTEID'] = $expedienteId;
		$data['PERSONAFISICAID'] = $personaFisicaId;
		$data['userDB'] = $conexion->USER;
		$data['pwdDB'] = $conexion->PASSWORD;
		$data['instance'] = $conexion->IP . '/' . $conexion->INSTANCE;
		$data['schema'] = $conexion->SCHEMA;

		return $this->_curlPostDataEncrypt($endpoint, $data);
	}

	private function _createExpImputado($expedienteId, $personaFisicaId, $municipio)
	{
		$function = '/imputado.php?process=crear';
		$endpoint = $this->endpoint . $function;
		$conexion = $this->_conexionesDBModel->asObject()->where('ESTADOID', 2)->where('MUNICIPIOID', (int) $municipio)->where('TYPE', ENVIRONMENT)->first();
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
			if (empty($valor)) {
				unset($data[$clave]);
			}
		}

		return $this->_curlPostDataEncrypt($endpoint, $data);
	}

	private function _createRelacionParentesco($expedienteId, $relacionparentesco, $personafisica1, $personafisica2, $municipio)
	{
		$function = '/relacionParentesco.php?process=crear';
		$array = [
			'EXPEDIENTEID',
			'PERSONAFISICAID1',
			'PARENTESCOID',
			'PERSONAFISICAID2'
		];
		$endpoint = $this->endpoint . $function;
		$conexion = $this->_conexionesDBModel->asObject()->where('ESTADOID', 2)->where('MUNICIPIOID', (int) $municipio)->where('TYPE', ENVIRONMENT)->first();
		$data = $relacionparentesco;
		foreach ($data as $clave => $valor) {
			if (empty($valor)) {
				unset($data[$clave]);
			}
		}

		foreach ($data as $clave => $valor) {
			if (!in_array($clave, $array)) {
				unset($data[$clave]);
			}
		}
		$data['EXPEDIENTEID'] = $expedienteId;
		$data['PERSONAFISICAID1'] = $personafisica1;
		$data['PERSONAFISICAID2'] = $personafisica2;

		$data['userDB'] = $conexion->USER;
		$data['pwdDB'] = $conexion->PASSWORD;
		$data['instance'] = $conexion->IP . '/' . $conexion->INSTANCE;
		$data['schema'] = $conexion->SCHEMA;

		return $this->_curlPostDataEncrypt($endpoint, $data);
	}

	private function _createRelacionFisFis($expedienteId, $relacionff, $victima, $imputado, $municipio)
	{
		$function = '/relacionfisfis.php?process=crear';
		$array = [
			'EXPEDIENTEID',
			'PERSONAFISICAIDVICTIMA',
			'DELITOMODALIDADID',
			'PERSONAFISICAIDIMPUTADO',
			'GRADOPARTICIPACIONID',
			'TENTATIVA',
			'CONVIOLENCIA',
		];
		$endpoint = $this->endpoint . $function;
		$conexion = $this->_conexionesDBModel->asObject()->where('ESTADOID', 2)->where('MUNICIPIOID', (int) $municipio)->where('TYPE', ENVIRONMENT)->first();
		$data = $relacionff;
		foreach ($data as $clave => $valor) {
			if (empty($valor)) {
				unset($data[$clave]);
			}
		}

		foreach ($data as $clave => $valor) {
			if (!in_array($clave, $array)) {
				unset($data[$clave]);
			}
		}
		$data['EXPEDIENTEID'] = $expedienteId;
		$data['PERSONAFISICAIDVICTIMA'] = $victima;
		$data['PERSONAFISICAIDIMPUTADO'] = $imputado;
		$data['userDB'] = $conexion->USER;
		$data['pwdDB'] = $conexion->PASSWORD;
		$data['instance'] = $conexion->IP . '/' . $conexion->INSTANCE;
		$data['schema'] = $conexion->SCHEMA;

		return $this->_curlPostDataEncrypt($endpoint, $data);
	}

	private function _createArchivosExternos($expedienteId, $folioid, $ano, $municipioid, $clasificaciondoctoid, $tipodoc, $archivo, $extension, $autor, $oficina)
	{
		if ($archivo != '' && $archivo) {
			$function = '/archivoExt.php?process=crear';
			$array = [
				'EXPEDIENTEID',
				'EXPEDIENTEARCHIVOID',
				'ARCHIVODESCR',
				'ARCHIVO',
				'EXTENSION',
				'FECHAACTUALIZACION',
				'AUTOR',
				'OFICINAIDAUTOR',
				'CLASIFICACIONDOCTOID',
				'ESTADOACCESO',
				'PUBLICADO',
				'RUTAALMACENAMIENTOID',
				'STATUSALMACENID',
				'EXPORTAR',
			];
			$endpoint = $this->endpoint . $function;
			$folioRow = $this->_folioModel->where('ANO', $ano)->where('FOLIOID', $folioid)->first();
			$conexion = $this->_conexionesDBModel->asObject()->where('ESTADOID', 2)->where('MUNICIPIOID', (int) $municipioid != '' ? $municipioid : $folioRow['MUNICIPIOID'])->where('TYPE', ENVIRONMENT)->first();

			$data = array();
			$data['EXPEDIENTEID'] = $expedienteId;
			$data['EXTENSION'] = '.' . $extension;
			// $data['AUTOR'] = isset($archivos['AGENTEID']) ? $archivos['AGENTEID'] : session('ID');
			// $data['OFICINAIDAUTOR'] = isset($archivos['OFICINAID']) ? $archivos['OFICINAID'] : '394';
			$data['CLASIFICACIONDOCTOID'] = $clasificaciondoctoid ? $clasificaciondoctoid : 53;
			$data['ESTADOACCESO'] = 'M';
			$data['PUBLICADO'] = 'N';
			$data['EXPORTAR'] = 'NNEW';
			$data['ARCHIVODESCR'] = $tipodoc;
			$data['AUTOR'] = $autor;
			$data['OFICINAIDAUTOR'] = $oficina;
			$data['ARCHIVO'] = base64_encode($archivo);

			$data['userDB'] = $conexion->USER;
			$data['pwdDB'] = $conexion->PASSWORD;
			$data['instance'] = $conexion->IP . '/' . $conexion->INSTANCE;
			$data['schema'] = $conexion->SCHEMA;
			return $this->_curlPostDataEncrypt($endpoint, $data);
		}
	}

	private function _createFolioDocumentos($expedienteId, $documentos, $municipio)
	{
		$function = '/documento.php?process=crear';
		$array = [
			'EXPEDIENTEID',
			'EXPEDIENTEDOCTOID',
			'DOCTODESCR',
			'DOCUMENTO',
			'FECHAACTUALIZACION',
			'FECHACREACION',
			'FECHAIMPRESODEFINITIVA',
			'CLASIFICACIONDOCTOID',
			'AUTOR',
			'OFICINAIDAUTOR',
			'STATUSDOCUMENTOID',
			'PLANTILLAID',
			'CALIFICACION',
			'ESTADOACCESO',
			'EMPLEADORESPONSABLE',
			'EXPAREAIDRESPONSABLE',
			'EXPEMPIDRESPONSABLE',
			'PUBLICADO',
			'RUTAALMACENAMIENTOID',
			'STATUSALMACENID',
			'EXPORTAR',

		];
		$endpoint = $this->endpoint . $function;
		$conexion = $this->_conexionesDBModel->asObject()->where('ESTADOID', 2)->where('MUNICIPIOID', (int) $municipio)->where('TYPE', ENVIRONMENT)->first();
		$data = $documentos;
		foreach ($data as $clave => $valor) {
			if (empty($valor)) {
				unset($data[$clave]);
			}
		}

		foreach ($data as $clave => $valor) {
			if (!in_array($clave, $array)) {
				unset($data[$clave]);
			}
		}
		$data['EXPEDIENTEID'] = $expedienteId;
		$data['userDB'] = $conexion->USER;
		$data['pwdDB'] = $conexion->PASSWORD;
		$data['instance'] = $conexion->IP . '/' . $conexion->INSTANCE;
		$data['schema'] = $conexion->SCHEMA;

		return $this->_curlPostDataEncrypt($endpoint, $data);
	}

	private function _createIntervencionPericial($solicitud, $municipio)
	{
		$function = '/testing/intervencionPericial.php?process=crear';
		$array = [
			'SOLICITUDID',
			'INTERVENCIONID',
			'CANTIDAD',
			'PERSONAFISICAID',
			'VEHICULOID',
			'OBJETOID',
			'EDOINTPERID',
			'OFICINAIDRESPONSABLE',
			'AREAIDRESPONSABLE',
			'FECHAASIGNACIONPERITO'

		];
		$endpoint = $this->endpoint . $function;
		$conexion = $this->_conexionesDBModel->asObject()->where('ESTADOID', 2)->where('MUNICIPIOID', (int) $municipio)->where('TYPE', ENVIRONMENT)->first();
		$data = $solicitud;
		foreach ($data as $clave => $valor) {
			if (empty($valor)) {
				unset($data[$clave]);
			}
		}

		foreach ($data as $clave => $valor) {
			if (!in_array($clave, $array)) {
				unset($data[$clave]);
			}
		}
		$data['userDB'] = $conexion->USER;
		$data['pwdDB'] = $conexion->PASSWORD;
		$data['instance'] = $conexion->IP . '/' . $conexion->INSTANCE;
		$data['schema'] = $conexion->SCHEMA;
		return $this->_curlPostDataEncrypt($endpoint, $data);
	}
	private function _createSolicitudesPericiales($solicitud)
	{
		$function = '/solicitudPericial.php?process=crear';
		$array = [
			'SOLICITUDID',
			'ESTADOID',
			'MUNICIPIOID',
			'ANO',
			'CORRELATIVO',
			'FECHAREGISTRO',
			'EMPLEADOIDREGISTRO',
			'OFICINAIDRESPONSABLE',
			'ESTADOSOLICITUDPERICIALID',
			'CORRELATIVOSERVICIO',
			'OFICINAIDREGISTRO',
			'AREAIDREGISTRO',
			'FECHAASIGNACIONCOORDINACION',
			'TIPOREGISTRO',
			'TITULO',
			'DESCRIPCION',
			'NOMBREENTREGA',
			'OBSERVACIONESENTREGA'
		];
		$endpoint = $this->endpoint . $function;
		$conexion = $this->_conexionesDBModel->asObject()->where('ESTADOID', 2)->where('MUNICIPIOID', (int) $solicitud['MUNICIPIOID'])->where('TYPE', ENVIRONMENT)->first();
		$data = $solicitud;
		foreach ($data as $clave => $valor) {
			if (empty($valor)) {
				unset($data[$clave]);
			}
		}

		foreach ($data as $clave => $valor) {
			if (!in_array($clave, $array)) {
				unset($data[$clave]);
			}
		}
		$data['userDB'] = $conexion->USER;
		$data['pwdDB'] = $conexion->PASSWORD;
		$data['instance'] = $conexion->IP . '/' . $conexion->INSTANCE;
		$data['schema'] = $conexion->SCHEMA;
		return $this->_curlPostDataEncrypt($endpoint, $data);
	}

	private function _createSolicitudExpediente($expedienteId, $solicitudExp, $municipio)
	{
		$function = '/solicitudPericial.php?process=solicitudExpediente';
		$array = [
			'SOLICITUDID',
			'EXPEDIENTEID',

		];
		$endpoint = $this->endpoint . $function;
		$conexion = $this->_conexionesDBModel->asObject()->where('ESTADOID', 2)->where('MUNICIPIOID', (int) $municipio)->where('TYPE', ENVIRONMENT)->first();
		$data = array();

		$data['EXPEDIENTEID'] = $expedienteId;
		$data['SOLICITUDID'] = $solicitudExp;
		// var_dump($data);exit;
		$data['userDB'] = $conexion->USER;
		$data['pwdDB'] = $conexion->PASSWORD;
		$data['instance'] = $conexion->IP . '/' . $conexion->INSTANCE;
		$data['schema'] = $conexion->SCHEMA;
		return $this->_curlPostDataEncrypt($endpoint, $data);
	}

	private function _createSolicitudDocto($expedienteId, $solicitudid, $solicitudDocto, $municipio)
	{

		$function = '/solicitudPericial.php?process=solicitudDocto';
		$array = [
			'SOLICITUDID',
			'EXPEDIENTEID',
			'DOCTOID',
			'MAPSBC',

		];

		$endpoint = $this->endpoint . $function;
		$conexion = $this->_conexionesDBModel->asObject()->where('ESTADOID', 2)->where('MUNICIPIOID', (int) $municipio)->where('TYPE', ENVIRONMENT)->first();
		$data = array();

		// foreach ($data as $clave => $valor) {
		// 	if (empty($valor)) {
		// 		unset($data[$clave]);
		// 	}
		// }

		// foreach ($data as $clave => $valor) {
		// 	if (!in_array($clave, $array)) {
		// 		unset($data[$clave]);
		// 	}
		// }
		$data['EXPEDIENTEID'] = $expedienteId;
		$data['SOLICITUDID'] = $solicitudid;
		$data['DOCTOID'] = $solicitudDocto;
		$data['userDB'] = $conexion->USER;
		$data['pwdDB'] = $conexion->PASSWORD;
		$data['instance'] = $conexion->IP . '/' . $conexion->INSTANCE;
		$data['schema'] = $conexion->SCHEMA;

		return $this->_curlPostDataEncrypt($endpoint, $data);
	}

	private function _createJusticiaAlterna($expedienteId, $procedimientoid, $municipio)
	{
		$function = '/testing/justiciaAlterna.php?process=crear';
		$array = [
			'EXPEDIENTEID',
			'TIPOPROCEDIMIENTOID',
			'VALIDADO',
			'EMPLEADOIDVALIDO',
			'AREAIDVALIDO',
			'FECHAVALIDADO',


		];
		$endpoint = $this->endpoint . $function;
		$conexion = $this->_conexionesDBModel->asObject()->where('ESTADOID', 2)->where('MUNICIPIOID', (int) $municipio)->where('TYPE', ENVIRONMENT)->first();

		$data['EXPEDIENTEID'] = $expedienteId;
		$data['TIPOPROCEDIMIENTOID'] = $procedimientoid;
		$data['userDB'] = $conexion->USER;
		$data['pwdDB'] = $conexion->PASSWORD;
		$data['instance'] = $conexion->IP . '/' . $conexion->INSTANCE;
		$data['schema'] = $conexion->SCHEMA;
		return $this->_curlPostDataEncrypt($endpoint, $data);
	}
	
	public function getModulos()
	{
		$municipio = $this->request->getPost('municipio');
		$function = '/testing/consumoVistas.php?process=mediacion';
		$endpoint = $this->endpoint . $function;
		$conexion = $this->_conexionesDBModel->asObject()->where('ESTADOID', 2)->where('MUNICIPIOID', (int) $municipio)->where('TYPE', ENVIRONMENT)->first();
		$data['MUNICIPIOID'] = $municipio;
		$data['userDB'] = $conexion->USER;
		$data['pwdDB'] = $conexion->PASSWORD;
		$data['instance'] = $conexion->IP . '/' . $conexion->INSTANCE;
		$data['schema'] = $conexion->SCHEMA;
		return json_encode($this->_curlPostDataEncrypt($endpoint, $data)->data);
	}
	private function getMediador($municipio, $modulo){
		$function = '/testing/consumoVistas.php?process=getMediador';
		$endpoint = $this->endpoint . $function;
		$conexion = $this->_conexionesDBModel->asObject()->where('ESTADOID', 2)->where('MUNICIPIOID', (int) $municipio)->where('TYPE', ENVIRONMENT)->first();
		$data['MUNICIPIOID'] = $municipio;
		$data['AREA_MP_MEDIADOR'] = $modulo;
		$data['userDB'] = $conexion->USER;
		$data['pwdDB'] = $conexion->PASSWORD;
		$data['instance'] = $conexion->IP . '/' . $conexion->INSTANCE;
		$data['schema'] = $conexion->SCHEMA;
		return $this->_curlPostDataEncrypt($endpoint, $data);

	}
	private function _createFisImpDelito($expedienteId, $fisimpdelito, $imputado, $municipio)
	{
		$function = '/imputadoDelito.php?process=crear';
		$array = [
			'EXPEDIENTEID',
			'PERSONAFISICAID',
			'DELITOMODALIDADID',
			'DELITOCARACTERISTICAID',
			'TENTATIVA',
		];
		$endpoint = $this->endpoint . $function;
		$conexion = $this->_conexionesDBModel->asObject()->where('ESTADOID', 2)->where('MUNICIPIOID', (int) $municipio)->where('TYPE', ENVIRONMENT)->first();
		$data = $fisimpdelito;
		foreach ($data as $clave => $valor) {
			if (empty($valor)) {
				unset($data[$clave]);
			}
		}

		foreach ($data as $clave => $valor) {
			if (!in_array($clave, $array)) {
				unset($data[$clave]);
			}
		}
		$data['EXPEDIENTEID'] = $expedienteId;
		$data['PERSONAFISICAID'] = $imputado;

		$data['userDB'] = $conexion->USER;
		$data['pwdDB'] = $conexion->PASSWORD;
		$data['instance'] = $conexion->IP . '/' . $conexion->INSTANCE;
		$data['schema'] = $conexion->SCHEMA;

		return $this->_curlPostDataEncrypt($endpoint, $data);
	}

	private function _createExpVehiculo($expedienteId, $vehiculos, $municipio)
	{

		$function = '/expVehiculo.php?process=crear';
		$array = [
			'EXPEDIENTEID',
			'SITUACION',
			'TIPOID',
			'MARCAID',
			'MARCADESCR',
			'MODELOID',
			'MODELODESCR',
			'ANO',
			'PLACAS',
			'NUMEROSERIE',
			'NUMEROMOTOR',
			'NUMEROCHASIS',
			'TRANSMISION',
			'TRACCION',
			'PRIMERCOLORID',
			'SEGUNDOCOLORID',
			'SENASPARTICULARES',
			'PERSONAFISICAIDPROPIETARIO',
			'PERSONAMORALIDPROPIETARIO',
			'FOTO',
			'PARTICIPAESTADO',
			'TIPOPLACA',
			'ESTADOIDPLACA',
			'ESTADOEXTRANJEROIDPLACA',
			'VEHICULODISTRIBUIDORID',
			'VEHICULOVERSIONID',
			'VEHICULOSERVICIOID',
			'VEHICULOSTATUSID',
			'FECHAREGISTRO',
			'PROVIENEPADRON',
			'SEGUROVIGENTE',

		];

		$endpoint = $this->endpoint . $function;
		$conexion = $this->_conexionesDBModel->asObject()->where('ESTADOID', 2)->where('MUNICIPIOID', (int) $municipio)->where('TYPE', ENVIRONMENT)->first();
		$data = $vehiculos;

		foreach ($data as $clave => $valor) {
			if (empty($valor)) {
				unset($data[$clave]);
			}
		}
		foreach ($data as $clave => $valor) {
			if (!in_array($clave, $array)) {
				unset($data[$clave]);
			}
		}

		$data['EXPEDIENTEID'] = $expedienteId;
		$data['ANO'] = $vehiculos['ANOVEHICULO'];

		isset($vehiculos['FOTO'])
			? $data['FOTO'] = base64_encode($vehiculos['FOTO'])
			: null;
		if (isset($vehiculos['FOTO'])) {
			$f = finfo_open();
			$mime_type = finfo_buffer($f, $vehiculos['FOTO'], FILEINFO_MIME_TYPE);
			$extension = explode('/', $mime_type)[1];
			try {
				$_archivosExternos = $this->_createArchivosExternos($expedienteId, $vehiculos['FOLIOID'], $vehiculos['ANO'], '', 53, 'ROBO DE VEHÍCULO',  $vehiculos['FOTO'], $extension, 3947,  394);
			} catch (\Throwable $th) {
			}
		}
		if (isset($vehiculos['DOCUMENTO'])) {
			$f = finfo_open();
			$mime_type = finfo_buffer($f, $vehiculos['DOCUMENTO'], FILEINFO_MIME_TYPE);
			$extension = explode('/', $mime_type)[1];
			try {
				$_archivosExternos = $this->_createArchivosExternos($expedienteId, $vehiculos['FOLIOID'], $vehiculos['ANO'], '', 53, 'ROBO DE VEHÍCULO', $vehiculos['DOCUMENTO'], $extension, 3947,  394);
			} catch (\Throwable $th) {
			}
		}
		$data['userDB'] = $conexion->USER;
		$data['pwdDB'] = $conexion->PASSWORD;
		$data['instance'] = $conexion->IP . '/' . $conexion->INSTANCE;
		$data['schema'] = $conexion->SCHEMA;
		// return $data;
		return $this->_curlPostDataEncrypt($endpoint, $data);
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
			'Hash-API: ' . password_hash(TOKEN_API, PASSWORD_BCRYPT)
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

	private function _curlPostDataEncrypt($endpoint, $data)
	{
		// var_dump($data);exit;
		$ch = curl_init();

		curl_setopt($ch, CURLOPT_URL, $endpoint);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $this->_encriptar(json_encode($data), KEY_128));
		$headers = array(
			'Content-Type: application/json',
			'Access-Control-Allow-Origin: *',
			'Access-Control-Allow-Credentials: true',
			'Access-Control-Allow-Headers: Content-Type',
			'Hash-API: ' . password_hash(TOKEN_API, PASSWORD_BCRYPT),
			'Key: ' . KEY_128
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
		// var_dump($data);
		// var_dump($result);exit;
		// return $result;
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

		$response = $this->_curlPost($endpoint, $data);

		return json_encode($response);
	}

	public function getActiveUsers()
	{
		$endpoint = 'https://videodenunciaserver1.fgebc.gob.mx/api/user';
		$data = array();
		$data['u'] = '24';
		$data['token'] = '198429b7cc8a2a5733d97bc13153227dd5017555';
		$data['a'] = 'status';

		$response = $this->_curlPost($endpoint, $data);
		$active_users = array();

		foreach ($response as $key => $user) {
			if ($user->log == 'online') {
				array_push($active_users, $user);
			}
		}
		return json_encode(['users' => $active_users, 'count' => count($active_users)]);
	}

	private function _getUnusedUsersVideo()
	{
		$endpoint = 'https://videodenunciaserver1.fgebc.gob.mx/api/user';
		$data = array();
		$data['u'] = '24';
		$data['token'] = '198429b7cc8a2a5733d97bc13153227dd5017555';
		$data['a'] = 'list';

		$response = $this->_curlPost($endpoint, $data);
		$unused_users = array();

		foreach ($response->data as $key => $user) {
			if (strtoupper($user->Nombre) == 'USUARIO') {
				array_push($unused_users, $user);
			}
		}

		sort($unused_users);
		return $unused_users;
	}

	function clearUsersVideo()
	{
		$endpoint = 'https://videodenunciaserver1.fgebc.gob.mx/api/user';
		$data = array();
		$data['u'] = '24';
		$data['token'] = '198429b7cc8a2a5733d97bc13153227dd5017555';
		$data['a'] = 'list';
		$response = $this->_curlPost($endpoint, $data);
		$response = $response->data;
		sort($response);

		for ($i = 149; $i <= 175; $i++) {
			try {
				$update = $this->_updateUserVideo($i, 'USUARIO', '-', 'agente_' . $i . '@usuario.com', 'M', 'agente');
				var_dump($update);
			} catch (\Exception $e) {
			}
		}
		var_dump('Termino');
	}

	private function _updateUserVideo($id, $nombre, $apellido, $email, $genero, $perfil)
	{
		if ($id && $nombre && $apellido && $email && $genero && $perfil) {
			$endpoint = 'https://videodenunciaserver1.fgebc.gob.mx/api/user';
			$data = array();
			$data['u'] = '24';
			$data['token'] = '198429b7cc8a2a5733d97bc13153227dd5017555';
			$data['a'] = 'setPars';
			$data['id'] = $id;
			$data['nombre'] = $nombre;
			$data['apellido'] = $apellido;
			$data['email'] = $email;
			$data['genero'] = $genero;
			$data['perfil'] = $perfil;
			$data['contra'] = 'Fgebc$123456';
			$data['rol'] = 'mp';
			$data['st'] = 'r';

			$response = $this->_curlPost($endpoint, $data);
			return $response;
		} else {
			return false;
		}
	}

	public function restoreFolio()
	{
		$folio = $this->request->getPost('folio');
		$year = $this->request->getPost('year');

		if (!empty($folio)) {
			$folioRow = $this->_folioModel->where('ANO', $year)->where('FOLIOID', $folio)->first();
			$folioRow['HECHOMEDIOCONOCIMIENTOID'] = null;
			$folioRow['NOTASAGENTE'] = null;
			$folioRow['STATUS'] = 'ABIERTO';
			$folioRow['EXPEDIENTEID'] = null;
			$folioRow['AGENTEATENCIONID'] = null;
			$folioRow['AGENTEFIRMAID'] = null;

			$update = $this->_folioModel->set($folioRow)->where('ANO', $year)->where('FOLIOID', $folio)->update();

			$datosBitacora = [
				'ACCION' => 'Ha restaurado un folio',
				'NOTAS' => 'FOLIO: ' . $folio . ' AÑO: ' . $year . ' STATUS: ABIERTO',
			];

			$this->_bitacoraActividad($datosBitacora);


			return json_encode(['status' => 1, 'message' => $update]);
		}
	}

	public function restoreFolioProcess()
	{
		$folio = $this->request->getPost('folio');
		$year = $this->request->getPost('year');

		if (!empty($folio)) {
			$folioRow = $this->_folioModel->where('ANO', $year)->where('FOLIOID', $folio)->first();
			$folioRow['HECHOMEDIOCONOCIMIENTOID'] = null;
			$folioRow['NOTASAGENTE'] = null;
			$folioRow['STATUS'] = 'EN PROCESO';
			$folioRow['EXPEDIENTEID'] = null;
			// $folioRow['AGENTEATENCIONID'] = NULL;
			$folioRow['AGENTEFIRMAID'] = null;

			$update = $this->_folioModel->set($folioRow)->where('ANO', $year)->where('FOLIOID', $folio)->update();
			$datosBitacora = [
				'ACCION' => 'Está en proceso un folio',
				'NOTAS' => 'FOLIO: ' . $folio . ' AÑO:' . $year . ' STATUS: EN PROCESO',
			];

			$this->_bitacoraActividad($datosBitacora);


			return json_encode(['status' => 1, 'message' => $update]);
		}
	}

	public function updateFolio()
	{
		$colonia = $this->_coloniasModel->asObject()->where('ESTADOID', 2)->where('MUNICIPIOID', $this->request->getPost('municipio_delito'))->where('LOCALIDADID', $this->request->getPost('localidad_delito'))->where('COLONIAID', $this->request->getPost('colonia_delito_select'))->first();
		try {


			$folio = trim($this->request->getPost('folio'));
			$year = trim($this->request->getPost('year'));
			$dataFolio = array(
				'HECHOFECHA' => $this->request->getPost('fecha_delito'),
				'HECHOHORA' => $this->request->getPost('hora_delito'),
				'HECHOLUGARID' => $this->request->getPost('lugar_delito'),
				'ESTADOID' => 2,
				'MUNICIPIOID' => $this->request->getPost('municipio_delito'),
				'HECHOESTADOID' => 2,
				'HECHOMUNICIPIOID' => $this->request->getPost('municipio_delito'),
				'HECHOLOCALIDADID' => $this->request->getPost('localidad_delito'),
				'HECHOCOLONIAID' => $this->request->getPost('colonia_delito_select'),
				'HECHOCOLONIADESCR' => $this->request->getPost('colonia_delito'),
				'HECHOCALLE' => $this->request->getPost('calle_delito'),
				'HECHONUMEROCASA' => $this->request->getPost('exterior_delito'),
				'HECHONUMEROCASAINT' => $this->request->getPost('interior_delito'),
				'HECHONARRACION' => $this->request->getPost('narracion_delito'),
				'HECHODELITO' => $this->request->getPost('delito_delito'),
			);

			if ($dataFolio['HECHOCOLONIAID'] == '0') {
				$dataFolio['HECHOCOLONIAID'] = null;
				$dataFolio['HECHOCOLONIADESCR'] = $this->request->getPost('colonia_delito');
				$localidad = $this->_localidadesModel->asObject()->where('ESTADOID', 2)->where('MUNICIPIOID', $this->request->getPost('municipio_delito'))->where('LOCALIDADID', $this->request->getPost('localidad_delito'))->first();
				$dataFolio['HECHOZONA'] = $localidad->ZONA;
			} else {
				$dataFolio['HECHOCOLONIAID'] = (int) $this->request->getPost('colonia_delito_select');
				$dataFolio['HECHOCOLONIADESCR'] = $colonia->COLONIADESCR;
				$dataFolio['HECHOZONA'] = $colonia->ZONA;
			}
			$update = $this->_folioModel->set($dataFolio)->where('FOLIOID', $folio)->where('ANO', $year)->update();
			if ($update) {
				$datosBitacora = [
					'ACCION' => 'Ha actualizado un folio',
					'NOTAS' => 'FOLIO: ' . $folio . ' AÑO: ' . $year,
				];

				$this->_bitacoraActividad($datosBitacora);

				return json_encode(['status' => 1]);
			} else {
				return json_encode(['status' => 0]);
			}
		} catch (\Exception $e) {
			return json_encode(['status' => 0]);
		}
	}

	public function updateFolioDenuncia()
	{

		$colonia = $this->_coloniasModel->asObject()->where('ESTADOID', 2)->where('MUNICIPIOID', $this->request->getPost('municipio_delito'))->where('LOCALIDADID', $this->request->getPost('localidad_delito'))->where('COLONIAID', $this->request->getPost('colonia_delito_select'))->first();
		try {


			$folio = trim($this->request->getPost('folio'));
			$year = trim($this->request->getPost('year'));
			$dataFolio = array(
				'HECHOFECHA' => $this->request->getPost('fecha_delito'),
				'HECHOHORA' => $this->request->getPost('hora_delito'),
				'HECHOLUGARID' => $this->request->getPost('lugar_delito'),
				'ESTADOID' => 2,
				'MUNICIPIOID' => $this->request->getPost('municipio_delito'),
				'HECHOESTADOID' => 2,
				'HECHOMUNICIPIOID' => $this->request->getPost('municipio_delito'),
				'HECHOLOCALIDADID' => $this->request->getPost('localidad_delito'),
				'HECHOCOLONIAID' => $this->request->getPost('colonia_delito_select'),
				'HECHOCOLONIADESCR' => $this->request->getPost('colonia_delito'),
				'HECHOCALLE' => $this->request->getPost('calle_delito'),
				'HECHONUMEROCASA' => $this->request->getPost('exterior_delito'),
				'HECHONUMEROCASAINT' => $this->request->getPost('interior_delito'),
				'HECHONARRACION' => $this->request->getPost('narracion_delito'),
			);

			if ($dataFolio['HECHOCOLONIAID'] == '0') {
				$dataFolio['HECHOCOLONIAID'] = null;
				$dataFolio['HECHOCOLONIADESCR'] = $this->request->getPost('colonia_delito');
				$localidad = $this->_localidadesModel->asObject()->where('ESTADOID', 2)->where('MUNICIPIOID', $this->request->getPost('municipio_delito'))->where('LOCALIDADID', $this->request->getPost('localidad_delito'))->first();
				$dataFolio['HECHOZONA'] = $localidad->ZONA;
			} else {
				$dataFolio['HECHOCOLONIAID'] = (int) $this->request->getPost('colonia_delito_select');
				$dataFolio['HECHOCOLONIADESCR'] = $colonia->COLONIADESCR;
				$dataFolio['HECHOZONA'] = $colonia->ZONA;
			}
			$update = $this->_folioModel->set($dataFolio)->where('FOLIOID', $folio)->where('ANO', $year)->update();
			if ($update) {
				$datosBitacora = [
					'ACCION' => 'Ha actualizado un folio',
					'NOTAS' => 'FOLIO: ' . $folio . ' AÑO: ' . $year,
				];

				$this->_bitacoraActividad($datosBitacora);

				return json_encode(['status' => 1]);
			} else {
				return json_encode(['status' => 0]);
			}
		} catch (\Exception $e) {
			return json_encode(['status' => 0]);
		}
	}

	// public function updateFolioSalida()
	// {

	// 	if ($this->request->getPost('municipio_empleado') != null) {
	// 		$municipio_empleado = $this->request->getPost('municipio_empleado');
	// 	} else {
	// 		$municipio_empleado = null;
	// 	}
	// 	try {


	// 		$folio = trim($this->request->getPost('folio'));
	// 		$year = trim($this->request->getPost('year'));
	// 		$dataFolio = array(
	// 			'MUNICIPIOASIGNADOID' => $municipio_empleado,
	// 		);

	// 		$update = $this->_folioModel->set($dataFolio)->where('FOLIOID', $folio)->where('ANO', $year)->update();
	// 		if ($update) {
	// 			$datosBitacora = [
	// 				'ACCION' => 'Ha actualizado un folio',
	// 				'NOTAS' => 'FOLIO: ' . $folio . ' AÑO: ' . $year,
	// 			];

	// 			$this->_bitacoraActividad($datosBitacora);

	// 			return json_encode(['status' => 1]);
	// 		} else {
	// 			return json_encode(['status' => 0]);
	// 		}
	// 	} catch (\Exception $e) {
	// 		return json_encode(['status' => 0]);
	// 	}
	// }

	public function updateFolioAsignacion()
	{
		try {
			$expediente = trim($this->request->getPost('expediente'));
			$oficina = trim($this->request->getPost('oficina'));
			$empleado = trim($this->request->getPost('empleado'));

			$area = $this->_empleadosModel->asObject()->where('EMPLEADOID', $empleado)->first();
			$dataFolio = array(
				'AGENTEASIGNADOID' => $empleado,
				'OFICINAASIGNADOID' => $oficina,
				'AREAASIGNADOID' => $area->AREAID
			);

			$update = $this->_folioModel->set($dataFolio)->where('EXPEDIENTEID', $expediente)->update();
			if ($update) {

				$datosBitacora = [
					'ACCION' => 'Ha actualizado un folio para su asignacion',
					'NOTAS' => 'Exp: ' . $expediente . ' oficina: ' . $oficina,
				];

				$this->_bitacoraActividad($datosBitacora);
				$bandeja = $this->_folioModel->where('EXPEDIENTEID', $expediente)->first();
				$_bandeja_creada = $this->_createBandeja($bandeja);


				if ($_bandeja_creada->status == 201) {
					return json_encode(['status' => 1]);
				}
			} else {
				return json_encode(['status' => 0]);
			}
		} catch (\Exception $e) {
			return json_encode(['status' => 0]);
		}
	}

	private function _updateExpedienteByBandeja($expediente, $municipio, $oficina, $empleado, $area, $estadojuridicoid = null)
	{
		$function = '/expediente.php?process=updateArea';
		$endpoint = $this->endpoint . $function;
		$conexion = $this->_conexionesDBModel->asObject()->where('ESTADOID', 2)->where('MUNICIPIOID', (int) $municipio)->where('TYPE', ENVIRONMENT)->first();
		$array = [
			'EMPLEADOIDREGISTRO',
			'EXPEDIENTEID',
			'OFICINAIDRESPONSABLE',
			'AREAIDREGISTRO',
			'AREAIDRESPONSABLE',
			'ESTADOJURIDICOEXPEDIENTEID'
		];

		$data = array();
		$data['OFICINAIDRESPONSABLE'] = $oficina;
		$data['EMPLEADOIDREGISTRO'] = $empleado;
		$data['AREAIDREGISTRO'] = $area;
		if ($oficina == 394 || $oficina == 792 || $oficina == 924) {
			$data['AREAIDRESPONSABLE'] = $area;
		} else {
			$data['AREAIDRESPONSABLE'] = null;
		}
		$data['EXPEDIENTEID'] = $expediente;
		$data['ESTADOJURIDICOEXPEDIENTEID'] = (string) $estadojuridicoid;

		foreach ($data as $clave => $valor) {
			if (empty($valor)) {
				unset($data[$clave]);
			}
		}
		foreach ($data as $clave => $valor) {
			if (!in_array($clave, $array)) {
				unset($data[$clave]);
			}
		}
		// var_dump($data);exit;
		$data['userDB'] = $conexion->USER;
		$data['pwdDB'] = $conexion->PASSWORD;
		$data['instance'] = $conexion->IP . '/' . $conexion->INSTANCE;
		$data['schema'] = $conexion->SCHEMA;

		return $this->_curlPostDataEncrypt($endpoint, $data);
	}

	private function _createBandeja($bandeja)
	{
		$function = '/expediente.php?process=bandeja';
		$endpoint = $this->endpoint . $function;
		$conexion = $this->_conexionesDBModel->asObject()->where('ESTADOID', 2)->where('MUNICIPIOID', (int) $bandeja['MUNICIPIOASIGNADOID'])->where('TYPE', ENVIRONMENT)->first();
		$array = [
			"AREAIDREGISTRO",
			"EXPEDIENTEID"
		];

		$data = $bandeja;

		foreach ($data as $clave => $valor) {
			if (empty($valor)) {
				unset($data[$clave]);
			}
		}
		foreach ($data as $clave => $valor) {
			if (!in_array($clave, $array)) {
				unset($data[$clave]);
			}
		}

		$data['AREAIDREGISTRO'] = $bandeja['AREAASIGNADOID'];
		$data['EXPEDIENTEID'] = $bandeja['EXPEDIENTEID'];
		$data['userDB'] = $conexion->USER;
		$data['pwdDB'] = $conexion->PASSWORD;
		$data['instance'] = $conexion->IP . '/' . $conexion->INSTANCE;
		$data['schema'] = $conexion->SCHEMA;

		return $this->_curlPostDataEncrypt($endpoint, $data);
	}

	public function updatePreguntasIniciales()
	{
		try {
			$folio = trim($this->request->getPost('folio'));
			$year = trim($this->request->getPost('year'));
			$dataPreguntas = array(
				'ES_MENOR' => $this->request->getPost('es_menor'),
				'ES_TERCERA_EDAD' => $this->request->getPost('es_tercera_edad'),
				'TIENE_DISCAPACIDAD' => $this->request->getPost('tiene_discapacidad'),
				'ES_GRUPO_VULNERABLE' => $this->request->getPost('es_vulnerable'),
				'ES_GRUPO_VULNERABLE_DESCR' => $this->request->getPost('vulnerable_descripcion'),
				'FUE_CON_ARMA' => $this->request->getPost('fue_con_arma'),
				'LESIONES' => $this->request->getPost('lesiones'),
				'LESIONES_VISIBLES' => $this->request->getPost('lesiones_visibles'),
				'ESTA_DESAPARECIDO' => $this->request->getPost('esta_desaparecido'),
			);

			$update = $this->_folioPreguntasModel->set($dataPreguntas)->where('FOLIOID', $folio)->where('ANO', $year)->update();

			if ($update) {
				$datosBitacora = [
					'ACCION' => 'Ha actualizado las preguntas iniciales de un folio',
					'NOTAS' => 'FOLIO: ' . $folio . ' AÑO' . $year,
				];

				$this->_bitacoraActividad($datosBitacora);

				return json_encode(['status' => 1]);
			} else {
				return json_encode(['status' => 0]);
			}
		} catch (\Exception $e) {
			return json_encode(['status' => 0]);
		}
	}

	public function updatePersonaFisicaById()
	{
		try {
			$id = $this->request->getPost('pf_id');
			$folio = $this->request->getPost('folio');
			$year = $this->request->getPost('year');
			$fotoPersona = $this->request->getFile('subirFotoPersona');
			$fotoP = null;
			if ($_FILES) {
				$fotoP = file_get_contents($fotoPersona);
				$data = array(
					'NOMBRE' => $this->request->getPost('nombre_pf'),
					'PRIMERAPELLIDO' => $this->request->getPost('apellido_paterno_pf'),
					'SEGUNDOAPELLIDO' => $this->request->getPost('apellido_materno_pf'),
					'FECHANACIMIENTO' => $this->request->getPost('fecha_nacimiento_pf'),
					'EDADCANTIDAD' => $this->request->getPost('edad_pf'),
					'SEXO' => $this->request->getPost('sexo_pf'),
					'TELEFONO' => $this->request->getPost('telefono_pf'),
					'TELEFONO2' => $this->request->getPost('telefono_pf_2'),
					'CODIGOPAISTEL' => $this->request->getPost('codigo_pais_pf'),
					'CODIGOPAISTEL2' => $this->request->getPost('codigo_pais_pf_2'),
					'CORREO' => $this->request->getPost('correo_pf'),
					'TIPOIDENTIFICACIONID' => $this->request->getPost('tipo_identificacion_pf'),
					'NUMEROIDENTIFICACION' => $this->request->getPost('numero_identidad_pf'),
					'NACIONALIDADID' => $this->request->getPost('nacionalidad_pf'),
					'PERSONAIDIOMAID' => $this->request->getPost('idioma_pf'),
					'ESCOLARIDADID' => $this->request->getPost('escolaridad_pf'),
					'OCUPACIONID' => $this->request->getPost('ocupacion_pf'),
					'OCUPACIONDESCR' => $this->request->getPost('ocupacion_descr'),
					'ESTADOCIVILID' => $this->request->getPost('edoc_pf'),
					'ESTADOORIGENID' => $this->request->getPost('edoorigen_pf'),
					'MUNICIPIOORIGENID' => $this->request->getPost('munorigen_pf'),
					'CALIDADJURIDICAID' => $this->request->getPost('calidad_juridica_pf'),
					'DESCRIPCION_FISICA' => $this->request->getPost('descripcionFisica_pf'),
					'APODO' => $this->request->getPost('apodo_pf'),
					'DENUNCIANTE' => $this->request->getPost('denunciante_pf'),
					'FACEBOOK' => $this->request->getPost('facebook_pf'),
					'INSTAGRAM' => $this->request->getPost('instagram_pf'),
					'TWITTER' => $this->request->getPost('twitter_pf'),
					'FOTO' =>  $fotoP
				);
			} else {
				$data = array(
					'NOMBRE' => $this->request->getPost('nombre_pf'),
					'PRIMERAPELLIDO' => $this->request->getPost('apellido_paterno_pf'),
					'SEGUNDOAPELLIDO' => $this->request->getPost('apellido_materno_pf'),
					'FECHANACIMIENTO' => $this->request->getPost('fecha_nacimiento_pf'),
					'EDADCANTIDAD' => $this->request->getPost('edad_pf'),
					'SEXO' => $this->request->getPost('sexo_pf'),
					'TELEFONO' => $this->request->getPost('telefono_pf'),
					'TELEFONO2' => $this->request->getPost('telefono_pf_2'),
					'CODIGOPAISTEL' => $this->request->getPost('codigo_pais_pf'),
					'CODIGOPAISTEL2' => $this->request->getPost('codigo_pais_pf_2'),
					'CORREO' => $this->request->getPost('correo_pf'),
					'TIPOIDENTIFICACIONID' => $this->request->getPost('tipo_identificacion_pf'),
					'NUMEROIDENTIFICACION' => $this->request->getPost('numero_identidad_pf'),
					'NACIONALIDADID' => $this->request->getPost('nacionalidad_pf'),
					'PERSONAIDIOMAID' => $this->request->getPost('idioma_pf'),
					'ESCOLARIDADID' => $this->request->getPost('escolaridad_pf'),
					'OCUPACIONID' => $this->request->getPost('ocupacion_pf'),
					'OCUPACIONDESCR' => $this->request->getPost('ocupacion_descr'),
					'ESTADOCIVILID' => $this->request->getPost('edoc_pf'),
					'ESTADOORIGENID' => $this->request->getPost('edoorigen_pf'),
					'MUNICIPIOORIGENID' => $this->request->getPost('munorigen_pf'),
					'CALIDADJURIDICAID' => $this->request->getPost('calidad_juridica_pf'),
					'DESCRIPCION_FISICA' => $this->request->getPost('descripcionFisica_pf'),
					'APODO' => $this->request->getPost('apodo_pf'),
					'DENUNCIANTE' => $this->request->getPost('denunciante_pf'),
					'FACEBOOK' => $this->request->getPost('facebook_pf'),
					'INSTAGRAM' => $this->request->getPost('instagram_pf'),
					'TWITTER' => $this->request->getPost('twitter_pf'),
				);
			}
			// var_dump($data);exit;

			$update = $this->_folioPersonaFisicaModel->set($data)->where('FOLIOID', $folio)->where('ANO', $year)->where('PERSONAFISICAID', $id)->update();

			if ($update) {

				$personas = $this->_folioPersonaFisicaModel->get_by_folio($folio, $year);
				$imputados = $this->_folioPersonaFisicaModel->get_imputados($folio, $year);
				$victimas = $this->_folioPersonaFisicaModel->get_victimas($folio, $year);

				$parentescoRelacion = $this->_parentescoPersonaFisicaModel->where('FOLIOID', $folio)->where('ANO', $year)->findAll();
				$personaiduno = $this->_parentescoPersonaFisicaModel->get_personaFisicaUno($folio, $year);
				$personaidDos = $this->_parentescoPersonaFisicaModel->get_personaFisicaDos($folio, $year);
				$parentesco = $this->_parentescoPersonaFisicaModel->get_Parentesco($folio, $year);
				$fisicaImpDelito = $this->_imputadoDelitoModel->get_by_folio($folio, $year);
				$relacionFisFis = $this->_relacionIDOModel->get_by_folio($folio, $year);


				$datosBitacora = [
					'ACCION' => 'Ha actualizado a una persona fisica',
					'NOTAS' => 'FOLIO: ' . $folio . ' AÑO: ' . $year . ' PERSONAFISICAID: ' . $id,
				];

				$this->_bitacoraActividad($datosBitacora);

				return json_encode(['status' => 1, 'personas' => $personas, 'imputados' => $imputados, 'victimas' => $victimas, 'parentescoRelacion' => $parentescoRelacion, 'personaiduno' => $personaiduno, 'personaidDos' => $personaidDos, 'parentesco' => $parentesco, 'fisicaImpDelito' => $fisicaImpDelito, 'relacionFisFis' => $relacionFisFis]);
			} else {
				return json_encode(['status' => 0]);
			}
		} catch (\Exception $e) {
			return json_encode(['status' => 0]);
		}
	}

	public function updatePersonaFisicaDomicilioById()
	{
		try {
			$id = trim($this->request->getPost('pf_id'));
			$id_domicilio = trim($this->request->getPost('pfd_id'));
			$folio = trim($this->request->getPost('folio'));
			$year = trim($this->request->getPost('year'));
			$interior_pfd = $this->request->getPost('interior_pfd');
			if ($interior_pfd == '') {
				$interior_pfd = NULL;
			}
			$exterior_pfd = $this->request->getPost('exterior_pfd');
			if ($exterior_pfd == '') {
				$exterior_pfd = NULL;
			}
			$data = array(
				'id' => trim($this->request->getPost('pf_id')),
				'folio' => trim($this->request->getPost('folio')),
				'year' => trim($this->request->getPost('year')),
				'CP' => $this->request->getPost('cp_pfd'),
				'PAIS' => $this->request->getPost('pais_pfd'),
				'ESTADOID' => $this->request->getPost('estado_pfd'),
				'MUNICIPIOID' => $this->request->getPost('municipio_pfd'),
				'LOCALIDADID' => $this->request->getPost('localidad_pfd'),
				'COLONIAID' => $this->request->getPost('colonia_pfd_select'),
				'COLONIADESCR' => $this->request->getPost('colonia_pfd'),
				'CALLE' => $this->request->getPost('calle_pfd'),
				'NUMEROCASA' => $this->request->getPost('checkML_pfd') == 'on'  && $exterior_pfd ?  'M.' . $exterior_pfd : $exterior_pfd,
				'NUMEROINTERIOR' => $this->request->getPost('checkML_pfd') == 'on' && $interior_pfd ?  'L.' . $interior_pfd : $interior_pfd,
				'REFERENCIA' => $this->request->getPost('referencia_pfd'),
			);
			if ((int)$data['COLONIAID'] == 0) {
				$data['COLONIAID'] = null;
			}
			if ($this->request->getPost('municipio_pfd') && $this->request->getPost('localidad_pfd') && $this->request->getPost('colonia_pfd_select')) {
				$colonia = $this->_coloniasModel->asObject()->where('ESTADOID', 2)->where('MUNICIPIOID', $this->request->getPost('municipio_pfd'))->where('LOCALIDADID', $this->request->getPost('localidad_pfd'))->where('COLONIAID', $this->request->getPost('colonia_pfd_select'))->first();
				$localidad = $this->_localidadesModel->asObject()->where('ESTADOID', 2)->where('MUNICIPIOID', $this->request->getPost('municipio_pfd'))->where('LOCALIDADID', $this->request->getPost('localidad_pfd'))->first();
				if ((int)$data['COLONIAID'] == 0) {
					$data['COLONIAID'] = null;
					$data['ZONA'] = $localidad->ZONA;
				} else {
					$data['COLONIADESCR'] = $colonia->COLONIADESCR;
					$data['ZONA'] = $colonia->ZONA;
				}
			}

			// var_dump($data);exit;

			$update = $this->_folioPersonaFisicaDomicilioModel->set($data)->where('FOLIOID', $folio)->where('ANO', $year)->where('PERSONAFISICAID', $id)->where('DOMICILIOID', $id_domicilio)->update();

			if ($update) {
				$datosBitacora = [
					'ACCION' => 'Ha actualizado el domicilio de una persona fisica',
					'NOTAS' => 'FOLIO: ' . $folio . ' AÑO: ' . $year . ' PERSONAFISICAID: ' . $id,
				];

				$this->_bitacoraActividad($datosBitacora);

				return json_encode(['status' => 1, 'message' => $id_domicilio]);
			} else {
				return json_encode(['status' => 0, 'message' => $update]);
			}
		} catch (\Exception $e) {
			return json_encode(['status' => 0]);
		}
	}

	public function updateMediaFiliacionById()
	{
		try {
			$id = trim($this->request->getPost('pf_id'));

			$folio = trim($this->request->getPost('folio'));
			$year = trim($this->request->getPost('year'));

			$data = array(
				'OCUPACIONID' => $this->request->getPost('ocupacion_mf') == '0' || empty($this->request->getPost('ocupacion_mf')) ? null : $this->request->getPost('ocupacion_mf'),
				'ESTATURA' => $this->request->getPost('estatura_mf') == '0' || empty($this->request->getPost('estatura_mf')) ? null : $this->request->getPost('estatura_mf'),
				'PESO' => $this->request->getPost('peso_mf') == '0' || empty($this->request->getPost('peso_mf')) ? null : $this->request->getPost('peso_mf'),
				'SENASPARTICULARES' => $this->request->getPost('senas_mf') == '0' || empty($this->request->getPost('senas_mf')) ? null : $this->request->getPost('senas_mf'),
				'PIELCOLORID' => $this->request->getPost('colortez_mf') == '0' || empty($this->request->getPost('colortez_mf')) ? null : $this->request->getPost('colortez_mf'),
				'FIGURAID' => $this->request->getPost('complexion_mf') == '0' || empty($this->request->getPost('complexion_mf')) ? null : $this->request->getPost('complexion_mf'),
				'CONTEXTURAID' => $this->request->getPost('contextura_ceja_mf') == '0' || empty($this->request->getPost('contextura_ceja_mf')) ? null : $this->request->getPost('contextura_ceja_mf'),
				'CARAFORMAID' => $this->request->getPost('cara_forma_mf') == '0' || empty($this->request->getPost('cara_forma_mf')) ? null : $this->request->getPost('cara_forma_mf'),
				'CARATAMANOID' => $this->request->getPost('cara_tamano_mf') == '0' || empty($this->request->getPost('cara_tamano_mf')) ? null : $this->request->getPost('cara_tamano_mf'),
				'CARATEZID' => $this->request->getPost('caratez_mf') == '0' || empty($this->request->getPost('caratez_mf')) ? null : $this->request->getPost('caratez_mf'),
				'OREJALOBULOID' => $this->request->getPost('lobulo_mf') == '0' || empty($this->request->getPost('lobulo_mf')) ? null : $this->request->getPost('lobulo_mf'),
				'OREJAFORMAID' => $this->request->getPost('forma_oreja_mf') == '0' || empty($this->request->getPost('forma_oreja_mf')) ? null : $this->request->getPost('forma_oreja_mf'),
				'OREJATAMANOID' => $this->request->getPost('tamano_oreja_mf') == '0' || empty($this->request->getPost('tamano_oreja_mf')) ? null : $this->request->getPost('tamano_oreja_mf'),
				'CABELLOCOLORID' => $this->request->getPost('colorC_mf') == '0' || empty($this->request->getPost('colorC_mf')) ? null : $this->request->getPost('colorC_mf'),
				'CABELLOESTILOID' => $this->request->getPost('formaC_mf') == '0' || empty($this->request->getPost('formaC_mf')) ? null : $this->request->getPost('formaC_mf'),
				'CABELLOTAMANOID' => $this->request->getPost('tamanoC_mf') == '0' || empty($this->request->getPost('tamanoC_mf')) ? null : $this->request->getPost('tamanoC_mf'),
				'CABELLOPECULIARID' => $this->request->getPost('peculiarC_mf') == '0' || empty($this->request->getPost('peculiarC_mf')) ? null : $this->request->getPost('peculiarC_mf'),
				'CABELLODESCR' => $this->request->getPost('cabello_descr_mf') == '0' || empty($this->request->getPost('cabello_descr_mf')) ? null : $this->request->getPost('cabello_descr_mf'),
				'FRENTEALTURAID' => $this->request->getPost('frente_altura_mf') == '0' || empty($this->request->getPost('frente_altura_mf')) ? null : $this->request->getPost('frente_altura_mf'),
				'FRENTEANCHURAID' => $this->request->getPost('frente_anchura_ms') == '0' || empty($this->request->getPost('frente_anchura_ms')) ? null : $this->request->getPost('frente_anchura_ms'),
				'FRENTEFORMAID' => $this->request->getPost('tipoF_mf') == '0' || empty($this->request->getPost('tipoF_mf')) ? null : $this->request->getPost('tipoF_mf'),
				'FRENTEPECULIARID' => $this->request->getPost('frente_peculiar_mf') == '0' || empty($this->request->getPost('frente_peculiar_mf')) ? null : $this->request->getPost('frente_peculiar_mf'),
				'CEJACOLOCACIONID' => $this->request->getPost('colocacion_ceja_mf') == '0' || empty($this->request->getPost('colocacion_ceja_mf')) ? null : $this->request->getPost('colocacion_ceja_mf'),
				'CEJAFORMAID' => $this->request->getPost('ceja_mf') == '0' || empty($this->request->getPost('ceja_mf')) ? null : $this->request->getPost('ceja_mf'),
				'CEJATAMANOID' => $this->request->getPost('tamano_ceja_mf') == '0' || empty($this->request->getPost('tamano_ceja_mf')) ? null : $this->request->getPost('tamano_ceja_mf'),
				'CEJAGROSORID' => $this->request->getPost('grosor_ceja_mf') == '0' || empty($this->request->getPost('grosor_ceja_mf')) ? null : $this->request->getPost('grosor_ceja_mf'),
				'OJOCOLOCACIONID' => $this->request->getPost('colocacion_ojos_mf') == '0' || empty($this->request->getPost('colocacion_ojos_mf')) ? null : $this->request->getPost('colocacion_ojos_mf'),
				'OJOFORMAID' => $this->request->getPost('forma_ojos_mf') == '0' || empty($this->request->getPost('forma_ojos_mf')) ? null : $this->request->getPost('forma_ojos_mf'),
				'OJOTAMANOID' => $this->request->getPost('tamano_ojos_mf') == '0' || empty($this->request->getPost('tamano_ojos_mf')) ? null : $this->request->getPost('tamano_ojos_mf'),
				'OJOCOLORID' => $this->request->getPost('colorO_mf') == '0' || empty($this->request->getPost('colorO_mf')) ? null : $this->request->getPost('colorO_mf'),
				'OJOPECULIARID' => $this->request->getPost('peculiaridad_ojos_mf') == '0' || empty($this->request->getPost('peculiaridad_ojos_mf')) ? null : $this->request->getPost('peculiaridad_ojos_mf'),
				'NARIZTIPOID' => $this->request->getPost('nariz_tipo_mf') == '0' || empty($this->request->getPost('nariz_tipo_mf')) ? null : $this->request->getPost('nariz_tipo_mf'),
				'NARIZTAMANOID' => $this->request->getPost('nariz_tamano_mf') == '0' || empty($this->request->getPost('nariz_tamano_mf')) ? null : $this->request->getPost('nariz_tamano_mf'),
				'NARIZBASEID' => $this->request->getPost('nariz_base_mf') == '0' || empty($this->request->getPost('nariz_base_mf')) ? null : $this->request->getPost('nariz_base_mf'),
				'NARIZPECULIARID' => $this->request->getPost('nariz_peculiar_mf') == '0' || empty($this->request->getPost('nariz_peculiar_mf')) ? null : $this->request->getPost('nariz_peculiar_mf'),
				'NARIZDESCR' => $this->request->getPost('nariz_descr_mf') == '0' || empty($this->request->getPost('nariz_descr_mf')) ? null : $this->request->getPost('nariz_descr_mf'),
				'BIGOTEFORMAID' => $this->request->getPost('bigote_forma_mf') == '0' || empty($this->request->getPost('bigote_forma_mf')) ? null : $this->request->getPost('bigote_forma_mf'),
				'BIGOTETAMANOID' => $this->request->getPost('bigote_tamaño_mf') == '0' || empty($this->request->getPost('bigote_tamaño_mf')) ? null : $this->request->getPost('bigote_tamaño_mf'),
				'BIGOTEGROSORID' => $this->request->getPost('bigote_grosor_mf') == '0' || empty($this->request->getPost('bigote_grosor_mf')) ? null : $this->request->getPost('bigote_grosor_mf'),
				'BIGOTEPECULIARID' => $this->request->getPost('bigote_peculiar_mf') == '0' || empty($this->request->getPost('bigote_peculiar_mf')) ? null : $this->request->getPost('bigote_peculiar_mf'),
				'BIGOTEDESCR' => $this->request->getPost('bigote_descr_mf') == '0' || empty($this->request->getPost('bigote_descr_mf')) ? null : $this->request->getPost('bigote_descr_mf'),
				'BOCATAMANOID' => $this->request->getPost('boca_tamano_mf') == '0' || empty($this->request->getPost('boca_tamano_mf')) ? null : $this->request->getPost('boca_tamano_mf'),
				'BOCAPECULIARID' => $this->request->getPost('boca_peculiar_mf') == '0' || empty($this->request->getPost('boca_peculiar_mf')) ? null : $this->request->getPost('boca_peculiar_mf'),
				'LABIOGROSORID' => $this->request->getPost('labio_grosor_mf') == '0' || empty($this->request->getPost('labio_grosor_mf')) ? null : $this->request->getPost('labio_grosor_mf'),
				'LABIOLONGITUDID' => $this->request->getPost('labio_longitud_mf') == '0' || empty($this->request->getPost('labio_longitud_mf')) ? null : $this->request->getPost('labio_longitud_mf'),
				'LABIOPOSICIONID' => $this->request->getPost('labio_posicion_mf') == '0' || empty($this->request->getPost('labio_posicion_mf')) ? null : $this->request->getPost('labio_posicion_mf'),
				'LABIOPECULIARID' => $this->request->getPost('labio_peculiar_mf') == '0' || empty($this->request->getPost('labio_peculiar_mf')) ? null : $this->request->getPost('labio_peculiar_mf'),
				'DIENTETAMANOID' => $this->request->getPost('dientes_tamano_mf') == '0' || empty($this->request->getPost('dientes_tamano_mf')) ? null : $this->request->getPost('dientes_tamano_mf'),
				'DIENTETIPOID' => $this->request->getPost('dientes_tipo_mf') == '0' || empty($this->request->getPost('dientes_tipo_mf')) ? null : $this->request->getPost('dientes_tipo_mf'),
				'DIENTEPECULIARID' => $this->request->getPost('dientes_peculiar_mf') == '0' || empty($this->request->getPost('dientes_peculiar_mf')) ? null : $this->request->getPost('dientes_peculiar_mf'),
				'DIENTEDESCR' => $this->request->getPost('dientes_descr_mf') == '0' || empty($this->request->getPost('dientes_descr_mf')) ? null : $this->request->getPost('dientes_descr_mf'),
				'BARBILLAFORMAID' => $this->request->getPost('barbilla_forma_mf') == '0' || empty($this->request->getPost('barbilla_forma_mf')) ? null : $this->request->getPost('barbilla_forma_mf'),
				'BARBILLATAMANOID' => $this->request->getPost('barbilla_tamano_mf') == '0' || empty($this->request->getPost('barbilla_tamano_mf')) ? null : $this->request->getPost('barbilla_tamano_mf'),
				'BARBILLAINCLINACIONID' => $this->request->getPost('barbilla_inclinacion_mf') == '0' || empty($this->request->getPost('barbilla_inclinacion_mf')) ? null : $this->request->getPost('barbilla_inclinacion_mf'),
				'BARBILLAPECULIARID' => $this->request->getPost('barbilla_peculiar_mf') == '0' || empty($this->request->getPost('barbilla_peculiar_mf')) ? null : $this->request->getPost('barbilla_peculiar_mf'),
				'BARBILLADESCR' => $this->request->getPost('barbilla_descr_mf') == '0' || empty($this->request->getPost('barbilla_descr_mf')) ? null : $this->request->getPost('barbilla_descr_mf'),
				'BARBATAMANOID' => $this->request->getPost('barba_tamano_mf') == '0' || empty($this->request->getPost('barba_tamano_mf')) ? null : $this->request->getPost('barba_tamano_mf'),
				'BARBAPECULIARID' => $this->request->getPost('barba_peculiar_mf') == '0' || empty($this->request->getPost('barba_peculiar_mf')) ? null : $this->request->getPost('barba_peculiar_mf'),
				'BARBADESCR' => $this->request->getPost('barba_descr_mf') == '0' || empty($this->request->getPost('barba_descr_mf')) ? null : $this->request->getPost('barba_descr_mf'),
				'CUELLOTAMANOID' => $this->request->getPost('cuello_tamano_mf') == '0' || empty($this->request->getPost('cuello_tamano_mf')) ? null : $this->request->getPost('cuello_tamano_mf'),
				'CUELLOGROSORID' => $this->request->getPost('cuello_grosor_mf') == '0' || empty($this->request->getPost('cuello_grosor_mf')) ? null : $this->request->getPost('cuello_grosor_mf'),
				'CUELLOPECULIARID' => $this->request->getPost('cuello_peculiar_mf') == '0' || empty($this->request->getPost('cuello_peculiar_mf')) ? null : $this->request->getPost('cuello_peculiar_mf'),
				'CUELLODESCR' => $this->request->getPost('cuello_descr_mf') == '0' || empty($this->request->getPost('cuello_descr_mf')) ? null : $this->request->getPost('cuello_descr_mf'),
				'HOMBROPOSICIONID' => $this->request->getPost('hombro_posicion_mf') == '0' || empty($this->request->getPost('hombro_posicion_mf')) ? null : $this->request->getPost('hombro_posicion_mf'),
				'HOMBROLONGITUDID' => $this->request->getPost('hombro_tamano_mf') == '0' || empty($this->request->getPost('hombro_tamano_mf')) ? null : $this->request->getPost('hombro_tamano_mf'),
				'HOMBROGROSORID' => $this->request->getPost('hombro_grosor_mf') == '0' || empty($this->request->getPost('hombro_grosor_mf')) ? null : $this->request->getPost('hombro_grosor_mf'),
				'ESTOMAGOID' => $this->request->getPost('estomago_mf') == '0' || empty($this->request->getPost('estomago_mf')) ? null : $this->request->getPost('estomago_mf'),
				'PERSONAESCOLARIDADID' => $this->request->getPost('escolaridad_mf') == '0' || empty($this->request->getPost('escolaridad_mf')) ? null : $this->request->getPost('escolaridad_mf'),
				'PERSONAETNIAID' => $this->request->getPost('etnia_mf') == '0' || empty($this->request->getPost('etnia_mf')) ? null : $this->request->getPost('etnia_mf'),
				'ESTOMAGODESCR' => $this->request->getPost('estomago_descr_mf') == '0' || empty($this->request->getPost('estomago_descr_mf')) ? null : $this->request->getPost('estomago_descr_mf'),
				'DISCAPACIDADDESCR' => $this->request->getPost('discapacidad_mf') == '0' || empty($this->request->getPost('discapacidad_mf')) ? null : $this->request->getPost('discapacidad_mf'),
				'FECHADESAPARICION' => $this->request->getPost('diaDesaparicion') == '0' || empty($this->request->getPost('diaDesaparicion')) ? null : $this->request->getPost('diaDesaparicion'),
				'LUGARDESAPARICION' => $this->request->getPost('lugarDesaparicion') == '0' || empty($this->request->getPost('lugarDesaparicion')) ? null : $this->request->getPost('lugarDesaparicion'),
				'VESTIMENTADESCR' => $this->request->getPost('vestimenta_mf') == '0' || empty($this->request->getPost('vestimenta_mf')) ? null : $this->request->getPost('vestimenta_mf'),
			);
			$dataPersonaFisica = array(
				'OCUPACIONID' => $this->request->getPost('ocupacion_mf') == '0' || empty($this->request->getPost('ocupacion_mf')) ? null : $this->request->getPost('ocupacion_mf'),
				'ESCOLARIDADID' => $this->request->getPost('escolaridad_mf') == '0' || empty($this->request->getPost('escolaridad_mf')) ? null : $this->request->getPost('escolaridad_mf'),
			);
			$dataRelacionParentesco = array(
				'PARENTESCOID' => $this->request->getPost('parentesco_mf') == '0' || empty($this->request->getPost('parentesco_mf')) ? null : $this->request->getPost('parentesco_mf'),
			);


			$denunciante = $this->_folioPersonaFisicaModel->asObject()->where('FOLIOID', $folio)->where('ANO', $year)->where('PERSONAFISICAID', $id)->first()->DENUNCIANTE;

			$updateMediaFiliacion = $this->_folioMediaFiliacion->set($data)->where('FOLIOID', $folio)->where('ANO', $year)->where('PERSONAFISICAID', $id)->update();
			$updatePersonaFisica = $this->_folioPersonaFisicaModel->set($dataPersonaFisica)->where('FOLIOID', $folio)->where('ANO', $year)->where('PERSONAFISICAID', $id)->update();

			$updateRelacionParentesco = $this->_parentescoPersonaFisicaModel->set($dataRelacionParentesco)->where('FOLIOID', $folio)->where('ANO', $year)->where('PERSONAFISICAID2', $id)->update();

			//  var_dump($personaFisica);
			// exit;

			// // $this->_parentescoPersonaFisica($dataRelacionParentesco, $folio, $desaparecido, $year);


			if ($updateMediaFiliacion && $updatePersonaFisica && $updateRelacionParentesco) {
				$datosBitacora = [
					'ACCION' => 'Ha actualizado la media filiación de una persona fisica',
					'NOTAS' => 'FOLIO: ' . $folio . ' AÑO: ' . $year . ' PERSONAFISICAID: ' . $id,
				];

				$this->_bitacoraActividad($datosBitacora);
				return json_encode(['status' => 1, 'datosRecibidos' => $data, 'id_recibido' => $id]);
			} else {
				return json_encode(['status' => 0]);
			}
		} catch (\Exception $e) {
			return json_encode(['status' => 0]);
		}
	}

	public function updateVehiculoByFolio()
	{

		$folio = $this->request->getPost('folio');
		$year = $this->request->getPost('year');
		$document_file = $this->request->getFile('subirDoc');
		$docV = null;

		$foto_file = $this->request->getFile('subirFotoV');
		$fotoV = null;



		$distribuidorpost = trim($this->request->getPost('distribuidor_vehiculo_ad'));
		$marcapost = trim($this->request->getPost('marca_ad'));
		$modelopost = trim($this->request->getPost('linea_vehiculo_ad'));

		$modelodescr = $this->_vehiculoModeloModel->asObject()->where('VEHICULODISTRIBUIDORID', $distribuidorpost)->where('VEHICULOMARCAID', $marcapost)->where('VEHICULOMODELOID', $modelopost)->first();
		$marcadescr = $this->_vehiculoMarcaModel->asObject()->where('VEHICULODISTRIBUIDORID', $distribuidorpost)->where('VEHICULOMARCAID', $marcapost)->first();

		if (isset($document_file) && isset($foto_file)) {

			try {
				$fotoV = file_get_contents($foto_file);
				$docV = file_get_contents($document_file);
				$data = array(
					'folio' => trim($this->request->getPost('folio')),
					'year' => trim($this->request->getPost('year')),
					'TIPOID' => $this->request->getPost('tipo_vehiculo') != '' ? $this->request->getPost('tipo_vehiculo') : NULL,
					'PRIMERCOLORID' => $this->request->getPost('color_vehiculo') != '' ? $this->request->getPost('color_vehiculo') : NULL,
					'SENASPARTICULARES' => $this->request->getPost('description_vehiculo') != '' ? $this->request->getPost('description_vehiculo') : NULL,
					'TIPOPLACA' => $this->request->getPost('tipo_placas_vehiculo') != '' ? $this->request->getPost('tipo_placas_vehiculo') : NULL,
					'PLACAS' => $this->request->getPost('placas_vehiculo') ? $this->request->getPost('placas_vehiculo') : NULL,
					'ESTADOIDPLACA' => $this->request->getPost('estado_vehiculo_ad') ? $this->request->getPost('estado_vehiculo_ad') : NULL,
					'ESTADOEXTRANJEROIDPLACA' => $this->request->getPost('estado_extranjero_vehiculo_ad') ? $this->request->getPost('estado_extranjero_vehiculo_ad') : NULL,
					'NUMEROSERIE' => $this->request->getPost('serie_vehiculo') ? $this->request->getPost('serie_vehiculo') : NULL,
					'VEHICULODISTRIBUIDORID' => $this->request->getPost('distribuidor_vehiculo_ad') ? $this->request->getPost('distribuidor_vehiculo_ad') : NULL,
					'MARCAID' => $this->request->getPost('marca_ad') ? $this->request->getPost('marca_ad') : NULL,
					'MARCADESCR' => isset($marcadescr->VEHICULOMARCADESCR) ? $marcadescr->VEHICULOMARCADESCR : NULL,
					'MARCADEXAC' => $this->request->getPost('marca_exacta') ? $this->request->getPost('marca_exacta') : NULL,
					'MODELODESCR' => isset($modelodescr->VEHICULOMODELODESCR) ? $modelodescr->VEHICULOMODELODESCR : NULL,
					'MODELOID' => $this->request->getPost('linea_vehiculo_ad') ? $this->request->getPost('linea_vehiculo_ad') : NULL,
					'VEHICULOVERSIONID' => $this->request->getPost('version_vehiculo_ad') ? $this->request->getPost('version_vehiculo_ad') : NULL,
					'VEHICULOSERVICIOID' => $this->request->getPost('servicio_vehiculo_ad') ? $this->request->getPost('servicio_vehiculo_ad') : NULL,
					'SEGUROVIGENTE' => $this->request->getPost('seguro_vigente_vehiculo') ? $this->request->getPost('seguro_vigente_vehiculo') : NULL,
					'TRANSMISION' => $this->request->getPost('transmision_vehiculo') ? $this->request->getPost('transmision_vehiculo') : NULL,
					'TRACCION' => $this->request->getPost('traccion_vehiculo') ? $this->request->getPost('traccion_vehiculo') : NULL,
					'NUMEROCHASIS' => $this->request->getPost('num_chasis_vehiculo') ? $this->request->getPost('num_chasis_vehiculo') : NULL,
					'SEGUNDOCOLORID' => $this->request->getPost('color_tapiceria_vehiculo') ? $this->request->getPost('color_tapiceria_vehiculo') : NULL,
					'ANOVEHICULO' => $this->request->getPost('modelo_vehiculo') ? $this->request->getPost('modelo_vehiculo') : NULL,
					'FOTO' => $fotoV,
					'DOCUMENTO' => $docV,
				);
			} catch (\Exception $e) {
			}
		}

		if (isset($document_file) && empty($foto_file)) {
			try {
				$docV = file_get_contents($document_file);
				$data = array(
					'folio' => trim($this->request->getPost('folio')),
					'year' => trim($this->request->getPost('year')),
					'TIPOID' => $this->request->getPost('tipo_vehiculo') != '' ? $this->request->getPost('tipo_vehiculo') : NULL,
					'PRIMERCOLORID' => $this->request->getPost('color_vehiculo') != '' ? $this->request->getPost('color_vehiculo') : NULL,
					'SENASPARTICULARES' => $this->request->getPost('description_vehiculo') != '' ? $this->request->getPost('description_vehiculo') : NULL,
					'TIPOPLACA' => $this->request->getPost('tipo_placas_vehiculo') != '' ? $this->request->getPost('tipo_placas_vehiculo') : NULL,
					'PLACAS' => $this->request->getPost('placas_vehiculo') ? $this->request->getPost('placas_vehiculo') : NULL,
					'ESTADOIDPLACA' => $this->request->getPost('estado_vehiculo_ad') ? $this->request->getPost('estado_vehiculo_ad') : NULL,
					'ESTADOEXTRANJEROIDPLACA' => $this->request->getPost('estado_extranjero_vehiculo_ad') ? $this->request->getPost('estado_extranjero_vehiculo_ad') : NULL,
					'NUMEROSERIE' => $this->request->getPost('serie_vehiculo') ? $this->request->getPost('serie_vehiculo') : NULL,
					'VEHICULODISTRIBUIDORID' => $this->request->getPost('distribuidor_vehiculo_ad') ? $this->request->getPost('distribuidor_vehiculo_ad') : NULL,
					'MARCAID' => $this->request->getPost('marca_ad') ? $this->request->getPost('marca_ad') : NULL,
					'MARCADESCR' => isset($marcadescr->VEHICULOMARCADESCR) ? $marcadescr->VEHICULOMARCADESCR : NULL,
					'MODELODESCR' => isset($modelodescr->VEHICULOMODELODESCR) ? $modelodescr->VEHICULOMODELODESCR : NULL,
					'MARCADEXAC' => $this->request->getPost('marca_exacta') ? $this->request->getPost('marca_exacta') : NULL,
					'MODELOID' => $this->request->getPost('linea_vehiculo_ad') ? $this->request->getPost('linea_vehiculo_ad') : NULL,
					'VEHICULOVERSIONID' => $this->request->getPost('version_vehiculo_ad') ? $this->request->getPost('version_vehiculo_ad') : NULL,
					'VEHICULOSERVICIOID' => $this->request->getPost('servicio_vehiculo_ad') ? $this->request->getPost('servicio_vehiculo_ad') : NULL,
					'SEGUROVIGENTE' => $this->request->getPost('seguro_vigente_vehiculo') ? $this->request->getPost('seguro_vigente_vehiculo') : NULL,
					'TRANSMISION' => $this->request->getPost('transmision_vehiculo') ? $this->request->getPost('transmision_vehiculo') : NULL,
					'TRACCION' => $this->request->getPost('traccion_vehiculo') ? $this->request->getPost('traccion_vehiculo') : NULL,
					'NUMEROCHASIS' => $this->request->getPost('num_chasis_vehiculo') ? $this->request->getPost('num_chasis_vehiculo') : NULL,
					'SEGUNDOCOLORID' => $this->request->getPost('color_tapiceria_vehiculo') ? $this->request->getPost('color_tapiceria_vehiculo') : NULL,
					'ANOVEHICULO' => $this->request->getPost('modelo_vehiculo') ? $this->request->getPost('modelo_vehiculo') : NULL,
					'DOCUMENTO' => $docV,

				);
			} catch (\Exception $e) {
			}
		} elseif (isset($foto_file) && empty($document_file)) {
			try {
				$fotoV = file_get_contents($foto_file);
				$data = array(
					'folio' => trim($this->request->getPost('folio')),
					'year' => trim($this->request->getPost('year')),
					'TIPOID' => $this->request->getPost('tipo_vehiculo') != '' ? $this->request->getPost('tipo_vehiculo') : NULL,
					'PRIMERCOLORID' => $this->request->getPost('color_vehiculo') != '' ? $this->request->getPost('color_vehiculo') : NULL,
					'SENASPARTICULARES' => $this->request->getPost('description_vehiculo') != '' ? $this->request->getPost('description_vehiculo') : NULL,
					'TIPOPLACA' => $this->request->getPost('tipo_placas_vehiculo') != '' ? $this->request->getPost('tipo_placas_vehiculo') : NULL,
					'PLACAS' => $this->request->getPost('placas_vehiculo') ? $this->request->getPost('placas_vehiculo') : NULL,
					'ESTADOIDPLACA' => $this->request->getPost('estado_vehiculo_ad') ? $this->request->getPost('estado_vehiculo_ad') : NULL,
					'ESTADOEXTRANJEROIDPLACA' => $this->request->getPost('estado_extranjero_vehiculo_ad') ? $this->request->getPost('estado_extranjero_vehiculo_ad') : NULL,
					'NUMEROSERIE' => $this->request->getPost('serie_vehiculo') ? $this->request->getPost('serie_vehiculo') : NULL,
					'VEHICULODISTRIBUIDORID' => $this->request->getPost('distribuidor_vehiculo_ad') ? $this->request->getPost('distribuidor_vehiculo_ad') : NULL,
					'MARCAID' => $this->request->getPost('marca_ad') ? $this->request->getPost('marca_ad') : NULL,
					'MARCADESCR' => isset($marcadescr->VEHICULOMARCADESCR) ? $marcadescr->VEHICULOMARCADESCR : NULL,
					'MODELODESCR' => isset($modelodescr->VEHICULOMODELODESCR) ? $modelodescr->VEHICULOMODELODESCR : NULL,
					'MARCADEXAC' => $this->request->getPost('marca_exacta') ? $this->request->getPost('marca_exacta') : NULL,
					'MODELOID' => $this->request->getPost('linea_vehiculo_ad') ? $this->request->getPost('linea_vehiculo_ad') : NULL,
					'VEHICULOVERSIONID' => $this->request->getPost('version_vehiculo_ad') ? $this->request->getPost('version_vehiculo_ad') : NULL,
					'VEHICULOSERVICIOID' => $this->request->getPost('servicio_vehiculo_ad') ? $this->request->getPost('servicio_vehiculo_ad') : NULL,
					'SEGUROVIGENTE' => $this->request->getPost('seguro_vigente_vehiculo') ? $this->request->getPost('seguro_vigente_vehiculo') : NULL,
					'TRANSMISION' => $this->request->getPost('transmision_vehiculo') ? $this->request->getPost('transmision_vehiculo') : NULL,
					'TRACCION' => $this->request->getPost('traccion_vehiculo') ? $this->request->getPost('traccion_vehiculo') : NULL,
					'NUMEROCHASIS' => $this->request->getPost('num_chasis_vehiculo') ? $this->request->getPost('num_chasis_vehiculo') : NULL,
					'SEGUNDOCOLORID' => $this->request->getPost('color_tapiceria_vehiculo') ? $this->request->getPost('color_tapiceria_vehiculo') : NULL,
					'ANOVEHICULO' => $this->request->getPost('modelo_vehiculo') ? $this->request->getPost('modelo_vehiculo') : NULL,
					'FOTO' => $fotoV,

				);
			} catch (\Exception $e) {
			}
		} elseif (empty($document_file) && empty($foto_file)) {
			$data = array(
				'folio' => trim($this->request->getPost('folio')),
				'year' => trim($this->request->getPost('year')),
				'TIPOID' => $this->request->getPost('tipo_vehiculo') != '' ? $this->request->getPost('tipo_vehiculo') : NULL,
				'PRIMERCOLORID' => $this->request->getPost('color_vehiculo') != '' ? $this->request->getPost('color_vehiculo') : NULL,
				'SENASPARTICULARES' => $this->request->getPost('description_vehiculo') != '' ? $this->request->getPost('description_vehiculo') : NULL,
				'TIPOPLACA' => $this->request->getPost('tipo_placas_vehiculo') != '' ? $this->request->getPost('tipo_placas_vehiculo') : NULL,
				'PLACAS' => $this->request->getPost('placas_vehiculo') ? $this->request->getPost('placas_vehiculo') : NULL,
				'ESTADOIDPLACA' => $this->request->getPost('estado_vehiculo_ad') ? $this->request->getPost('estado_vehiculo_ad') : NULL,
				'ESTADOEXTRANJEROIDPLACA' => $this->request->getPost('estado_extranjero_vehiculo_ad') ? $this->request->getPost('estado_extranjero_vehiculo_ad') : NULL,
				'NUMEROSERIE' => $this->request->getPost('serie_vehiculo') ? $this->request->getPost('serie_vehiculo') : NULL,
				'VEHICULODISTRIBUIDORID' => $this->request->getPost('distribuidor_vehiculo_ad') ? $this->request->getPost('distribuidor_vehiculo_ad') : NULL,
				'MARCAID' => $this->request->getPost('marca_ad') ? $this->request->getPost('marca_ad') : NULL,
				'MARCADESCR' => isset($marcadescr->VEHICULOMARCADESCR) ? $marcadescr->VEHICULOMARCADESCR : NULL,
				'MODELODESCR' => isset($modelodescr->VEHICULOMODELODESCR) ? $modelodescr->VEHICULOMODELODESCR : NULL,
				'MARCADEXAC' => $this->request->getPost('marca_exacta') ? $this->request->getPost('marca_exacta') : NULL,
				'MODELOID' => $this->request->getPost('linea_vehiculo_ad') ? $this->request->getPost('linea_vehiculo_ad') : NULL,
				'VEHICULOVERSIONID' => $this->request->getPost('version_vehiculo_ad') ? $this->request->getPost('version_vehiculo_ad') : NULL,
				'VEHICULOSERVICIOID' => $this->request->getPost('servicio_vehiculo_ad') ? $this->request->getPost('servicio_vehiculo_ad') : NULL,
				'SEGUROVIGENTE' => $this->request->getPost('seguro_vigente_vehiculo') ? $this->request->getPost('seguro_vigente_vehiculo') : NULL,
				'TRANSMISION' => $this->request->getPost('transmision_vehiculo') ? $this->request->getPost('transmision_vehiculo') : NULL,
				'TRACCION' => $this->request->getPost('traccion_vehiculo') ? $this->request->getPost('traccion_vehiculo') : NULL,
				'NUMEROCHASIS' => $this->request->getPost('num_chasis_vehiculo') ? $this->request->getPost('num_chasis_vehiculo') : NULL,
				'SEGUNDOCOLORID' => $this->request->getPost('color_tapiceria_vehiculo') ? $this->request->getPost('color_tapiceria_vehiculo') : NULL,
				'ANOVEHICULO' => $this->request->getPost('modelo_vehiculo') ? $this->request->getPost('modelo_vehiculo') : NULL,
			);
		}


		$update = $this->_folioVehiculoModel->set($data)->where('FOLIOID', $folio)->where('ANO', $year)->update();

		if ($update) {
			$vehiculos = $this->_folioVehiculoModel->get_by_folio($folio, $year);

			$datosBitacora = [
				'ACCION' => 'Ha actualizado el vehículo de una persona fisica',
				'NOTAS' => 'FOLIO: ' . $folio . ' AÑO: ' . $year,
			];

			$this->_bitacoraActividad($datosBitacora);

			return json_encode(['status' => 1, 'vehiculos' => $vehiculos]);
		} else {
			return json_encode(['status' => 0, 'message' => $update]);
		}
		// } catch (\Exception $e) {
		// 	return json_encode(['status' => 0]);
		// }
	}

	public function createVehiculoByFolio()
	{

		// var_dump($_POST);exit;
		$folio = trim($this->request->getPost('folio'));
		$year = trim($this->request->getPost('year'));
		$distribuidorpost = trim($this->request->getPost('distribuidor_vehiculo_ad'));
		$marcapost = trim($this->request->getPost('marca_ad'));
		$modelopost = trim($this->request->getPost('linea_vehiculo_ad'));

		$modelodescr = $this->_vehiculoModeloModel->asObject()->where('VEHICULODISTRIBUIDORID', $distribuidorpost)->where('VEHICULOMARCAID', $marcapost)->where('VEHICULOMODELOID', $modelopost)->first();
		$marcadescr = $this->_vehiculoMarcaModel->asObject()->where('VEHICULODISTRIBUIDORID', $distribuidorpost)->where('VEHICULOMARCAID', $marcapost)->first();
		$document_file = $this->request->getFile('subirDoc');
		$docV = null;

		$foto_file = $this->request->getFile('subirFotoV');
		$fotoV = null;

		if (isset($document_file) && isset($foto_file)) {

			try {
				$fotoV = file_get_contents($foto_file);
				$docV = file_get_contents($document_file);
				$data = array(
					'folio' => trim($this->request->getPost('folio')),
					'year' => trim($this->request->getPost('year')),
					'TIPOID' => $this->request->getPost('tipo_vehiculo') != '' ? $this->request->getPost('tipo_vehiculo') : NULL,
					'PRIMERCOLORID' => $this->request->getPost('color_vehiculo') != '' ? $this->request->getPost('color_vehiculo') : NULL,
					'SENASPARTICULARES' => $this->request->getPost('description_vehiculo') != '' ? $this->request->getPost('description_vehiculo') : NULL,
					'TIPOPLACA' => $this->request->getPost('tipo_placas_vehiculo') != '' ? $this->request->getPost('tipo_placas_vehiculo') : NULL,
					'PLACAS' => $this->request->getPost('placas_vehiculo') ? $this->request->getPost('placas_vehiculo') : NULL,
					'ESTADOIDPLACA' => $this->request->getPost('estado_vehiculo_ad') ? $this->request->getPost('estado_vehiculo_ad') : NULL,
					'ESTADOEXTRANJEROIDPLACA' => $this->request->getPost('estado_extranjero_vehiculo_ad') ? $this->request->getPost('estado_extranjero_vehiculo_ad') : NULL,
					'NUMEROSERIE' => $this->request->getPost('serie_vehiculo') ? $this->request->getPost('serie_vehiculo') : NULL,
					'VEHICULODISTRIBUIDORID' => $this->request->getPost('distribuidor_vehiculo_ad') ? $this->request->getPost('distribuidor_vehiculo_ad') : NULL,
					'MARCAID' => $this->request->getPost('marca_ad') ? $this->request->getPost('marca_ad') : NULL,
					'MARCADEXAC' => $this->request->getPost('marca_exacta') ? $this->request->getPost('marca_exacta') : NULL,
					'MARCADESCR' => isset($marcadescr->VEHICULOMARCADESCR) ? $marcadescr->VEHICULOMARCADESCR : NULL,
					'MODELODESCR' => isset($modelodescr->VEHICULOMODELODESCR) ? $modelodescr->VEHICULOMODELODESCR : NULL,
					'MODELOID' => $this->request->getPost('linea_vehiculo_ad') ? $this->request->getPost('linea_vehiculo_ad') : NULL,
					'VEHICULOVERSIONID' => $this->request->getPost('version_vehiculo_ad') ? $this->request->getPost('version_vehiculo_ad') : NULL,
					'VEHICULOSERVICIOID' => $this->request->getPost('servicio_vehiculo_ad') ? $this->request->getPost('servicio_vehiculo_ad') : NULL,
					'SEGUROVIGENTE' => $this->request->getPost('seguro_vigente_vehiculo') ? $this->request->getPost('seguro_vigente_vehiculo') : NULL,
					'TRANSMISION' => $this->request->getPost('transmision_vehiculo') ? $this->request->getPost('transmision_vehiculo') : NULL,
					'TRACCION' => $this->request->getPost('traccion_vehiculo') ? $this->request->getPost('traccion_vehiculo') : NULL,
					'NUMEROCHASIS' => $this->request->getPost('num_chasis_vehiculo') ? $this->request->getPost('num_chasis_vehiculo') : NULL,
					'SEGUNDOCOLORID' => $this->request->getPost('color_tapiceria_vehiculo') ? $this->request->getPost('color_tapiceria_vehiculo') : NULL,
					'ANOVEHICULO' => $this->request->getPost('modelo_vehiculo') ? $this->request->getPost('modelo_vehiculo') : NULL,
					'FOTO' => $fotoV,
					'DOCUMENTO' => $docV,

				);
			} catch (\Exception $e) {
			}
		}

		if (isset($document_file) && empty($foto_file)) {
			try {
				$docV = file_get_contents($document_file);
				$data = array(
					'folio' => trim($this->request->getPost('folio')),
					'year' => trim($this->request->getPost('year')),
					'TIPOID' => $this->request->getPost('tipo_vehiculo') != '' ? $this->request->getPost('tipo_vehiculo') : NULL,
					'PRIMERCOLORID' => $this->request->getPost('color_vehiculo') != '' ? $this->request->getPost('color_vehiculo') : NULL,
					'SENASPARTICULARES' => $this->request->getPost('description_vehiculo') != '' ? $this->request->getPost('description_vehiculo') : NULL,
					'TIPOPLACA' => $this->request->getPost('tipo_placas_vehiculo') != '' ? $this->request->getPost('tipo_placas_vehiculo') : NULL,
					'PLACAS' => $this->request->getPost('placas_vehiculo') ? $this->request->getPost('placas_vehiculo') : NULL,
					'ESTADOIDPLACA' => $this->request->getPost('estado_vehiculo_ad') ? $this->request->getPost('estado_vehiculo_ad') : NULL,
					'ESTADOEXTRANJEROIDPLACA' => $this->request->getPost('estado_extranjero_vehiculo_ad') ? $this->request->getPost('estado_extranjero_vehiculo_ad') : NULL,
					'NUMEROSERIE' => $this->request->getPost('serie_vehiculo') ? $this->request->getPost('serie_vehiculo') : NULL,
					'VEHICULODISTRIBUIDORID' => $this->request->getPost('distribuidor_vehiculo_ad') ? $this->request->getPost('distribuidor_vehiculo_ad') : NULL,
					'MARCAID' => $this->request->getPost('marca_ad') ? $this->request->getPost('marca_ad') : NULL,
					'MARCADESCR' => isset($marcadescr->VEHICULOMARCADESCR) ? $marcadescr->VEHICULOMARCADESCR : NULL,
					'MODELODESCR' => isset($modelodescr->VEHICULOMODELODESCR) ? $modelodescr->VEHICULOMODELODESCR : NULL,
					'MARCADEXAC' => $this->request->getPost('marca_exacta') ? $this->request->getPost('marca_exacta') : NULL,
					'MODELOID' => $this->request->getPost('linea_vehiculo_ad') ? $this->request->getPost('linea_vehiculo_ad') : NULL,
					'VEHICULOVERSIONID' => $this->request->getPost('version_vehiculo_ad') ? $this->request->getPost('version_vehiculo_ad') : NULL,
					'VEHICULOSERVICIOID' => $this->request->getPost('servicio_vehiculo_ad') ? $this->request->getPost('servicio_vehiculo_ad') : NULL,
					'SEGUROVIGENTE' => $this->request->getPost('seguro_vigente_vehiculo') ? $this->request->getPost('seguro_vigente_vehiculo') : NULL,
					'TRANSMISION' => $this->request->getPost('transmision_vehiculo') ? $this->request->getPost('transmision_vehiculo') : NULL,
					'TRACCION' => $this->request->getPost('traccion_vehiculo') ? $this->request->getPost('traccion_vehiculo') : NULL,
					'NUMEROCHASIS' => $this->request->getPost('num_chasis_vehiculo') ? $this->request->getPost('num_chasis_vehiculo') : NULL,
					'SEGUNDOCOLORID' => $this->request->getPost('color_tapiceria_vehiculo') ? $this->request->getPost('color_tapiceria_vehiculo') : NULL,
					'ANOVEHICULO' => $this->request->getPost('modelo_vehiculo') ? $this->request->getPost('modelo_vehiculo') : NULL,
					'DOCUMENTO' => $docV,

				);
			} catch (\Exception $e) {
			}
		} elseif (isset($foto_file) && empty($document_file)) {
			try {
				$fotoV = file_get_contents($foto_file);
				$data = array(
					'folio' => trim($this->request->getPost('folio')),
					'year' => trim($this->request->getPost('year')),
					'TIPOID' => $this->request->getPost('tipo_vehiculo') != '' ? $this->request->getPost('tipo_vehiculo') : NULL,
					'PRIMERCOLORID' => $this->request->getPost('color_vehiculo') != '' ? $this->request->getPost('color_vehiculo') : NULL,
					'SENASPARTICULARES' => $this->request->getPost('description_vehiculo') != '' ? $this->request->getPost('description_vehiculo') : NULL,
					'TIPOPLACA' => $this->request->getPost('tipo_placas_vehiculo') != '' ? $this->request->getPost('tipo_placas_vehiculo') : NULL,
					'PLACAS' => $this->request->getPost('placas_vehiculo') ? $this->request->getPost('placas_vehiculo') : NULL,
					'ESTADOIDPLACA' => $this->request->getPost('estado_vehiculo_ad') ? $this->request->getPost('estado_vehiculo_ad') : NULL,
					'ESTADOEXTRANJEROIDPLACA' => $this->request->getPost('estado_extranjero_vehiculo_ad') ? $this->request->getPost('estado_extranjero_vehiculo_ad') : NULL,
					'NUMEROSERIE' => $this->request->getPost('serie_vehiculo') ? $this->request->getPost('serie_vehiculo') : NULL,
					'VEHICULODISTRIBUIDORID' => $this->request->getPost('distribuidor_vehiculo_ad') ? $this->request->getPost('distribuidor_vehiculo_ad') : NULL,
					'MARCAID' => $this->request->getPost('marca_ad') ? $this->request->getPost('marca_ad') : NULL,
					'MARCADESCR' => isset($marcadescr->VEHICULOMARCADESCR) ? $marcadescr->VEHICULOMARCADESCR : NULL,
					'MODELODESCR' => isset($modelodescr->VEHICULOMODELODESCR) ? $modelodescr->VEHICULOMODELODESCR : NULL,
					'MARCADEXAC' => $this->request->getPost('marca_exacta') ? $this->request->getPost('marca_exacta') : NULL,
					'MODELOID' => $this->request->getPost('linea_vehiculo_ad') ? $this->request->getPost('linea_vehiculo_ad') : NULL,
					'VEHICULOVERSIONID' => $this->request->getPost('version_vehiculo_ad') ? $this->request->getPost('version_vehiculo_ad') : NULL,
					'VEHICULOSERVICIOID' => $this->request->getPost('servicio_vehiculo_ad') ? $this->request->getPost('servicio_vehiculo_ad') : NULL,
					'SEGUROVIGENTE' => $this->request->getPost('seguro_vigente_vehiculo') ? $this->request->getPost('seguro_vigente_vehiculo') : NULL,
					'TRANSMISION' => $this->request->getPost('transmision_vehiculo') ? $this->request->getPost('transmision_vehiculo') : NULL,
					'TRACCION' => $this->request->getPost('traccion_vehiculo') ? $this->request->getPost('traccion_vehiculo') : NULL,
					'NUMEROCHASIS' => $this->request->getPost('num_chasis_vehiculo') ? $this->request->getPost('num_chasis_vehiculo') : NULL,
					'SEGUNDOCOLORID' => $this->request->getPost('color_tapiceria_vehiculo') ? $this->request->getPost('color_tapiceria_vehiculo') : NULL,
					'ANOVEHICULO' => $this->request->getPost('modelo_vehiculo') ? $this->request->getPost('modelo_vehiculo') : NULL,
					'FOTO' => $fotoV,

				);
			} catch (\Exception $e) {
			}
		} elseif (empty($document_file) && empty($foto_file)) {

			$data = array(
				'folio' => trim($this->request->getPost('folio')),
				'year' => trim($this->request->getPost('year')),
				'TIPOID' => $this->request->getPost('tipo_vehiculo') != '' ? $this->request->getPost('tipo_vehiculo') : NULL,
				'PRIMERCOLORID' => $this->request->getPost('color_vehiculo') != '' ? $this->request->getPost('color_vehiculo') : NULL,
				'SENASPARTICULARES' => $this->request->getPost('description_vehiculo') != '' ? $this->request->getPost('description_vehiculo') : NULL,
				'TIPOPLACA' => $this->request->getPost('tipo_placas_vehiculo') != '' ? $this->request->getPost('tipo_placas_vehiculo') : NULL,
				'PLACAS' => $this->request->getPost('placas_vehiculo') ? $this->request->getPost('placas_vehiculo') : NULL,
				'ESTADOIDPLACA' => $this->request->getPost('estado_vehiculo_ad') ? $this->request->getPost('estado_vehiculo_ad') : NULL,
				'ESTADOEXTRANJEROIDPLACA' => $this->request->getPost('estado_extranjero_vehiculo_ad') ? $this->request->getPost('estado_extranjero_vehiculo_ad') : NULL,
				'NUMEROSERIE' => $this->request->getPost('serie_vehiculo') ? $this->request->getPost('serie_vehiculo') : NULL,
				'VEHICULODISTRIBUIDORID' => $this->request->getPost('distribuidor_vehiculo_ad') ? $this->request->getPost('distribuidor_vehiculo_ad') : NULL,
				'MARCAID' => $this->request->getPost('marca_ad') ? $this->request->getPost('marca_ad') : NULL,
				'MARCADESCR' => isset($marcadescr->VEHICULOMARCADESCR) ? $marcadescr->VEHICULOMARCADESCR : NULL,
				'MODELODESCR' => isset($modelodescr->VEHICULOMODELODESCR) ? $modelodescr->VEHICULOMODELODESCR : NULL,
				'MARCADEXAC' => $this->request->getPost('marca_exacta') ? $this->request->getPost('marca_exacta') : NULL,
				'MODELOID' => $this->request->getPost('linea_vehiculo_ad') ? $this->request->getPost('linea_vehiculo_ad') : NULL,
				'VEHICULOVERSIONID' => $this->request->getPost('version_vehiculo_ad') ? $this->request->getPost('version_vehiculo_ad') : NULL,
				'VEHICULOSERVICIOID' => $this->request->getPost('servicio_vehiculo_ad') ? $this->request->getPost('servicio_vehiculo_ad') : NULL,
				'SEGUROVIGENTE' => $this->request->getPost('seguro_vigente_vehiculo') ? $this->request->getPost('seguro_vigente_vehiculo') : NULL,
				'TRANSMISION' => $this->request->getPost('transmision_vehiculo') ? $this->request->getPost('transmision_vehiculo') : NULL,
				'TRACCION' => $this->request->getPost('traccion_vehiculo') ? $this->request->getPost('traccion_vehiculo') : NULL,
				'NUMEROCHASIS' => $this->request->getPost('num_chasis_vehiculo') ? $this->request->getPost('num_chasis_vehiculo') : NULL,
				'SEGUNDOCOLORID' => $this->request->getPost('color_tapiceria_vehiculo') ? $this->request->getPost('color_tapiceria_vehiculo') : NULL,
				'ANOVEHICULO' => $this->request->getPost('modelo_vehiculo') ? $this->request->getPost('modelo_vehiculo') : NULL,
			);
		}
		// $insert = $this->_folioVehiculoModel->insert($data);
		// $update = $this->_folioVehiculoModel->set($data)->where('FOLIOID', $folio)->where('ANO', $year)->update();
		$insert = $this->_folioVehiculo($data, $folio, $year);

		if (!$insert) {
			$vehiculos = $this->_folioVehiculoModel->get_by_folio($folio, $year);

			$datosBitacora = [
				'ACCION' => 'Ha agregado el vehículo de una persona fisica',
				'NOTAS' => 'FOLIO: ' . $folio . ' AÑO: ' . $year,
			];

			$this->_bitacoraActividad($datosBitacora);

			return json_encode(['status' => 1, 'vehiculos' => $vehiculos]);
		} else {
			return json_encode(['status' => 0, 'message' => $insert]);
		}
	}

	public function updateParentescoByFolio()
	{
		try {
			$idp1 = trim($this->request->getPost('personaFisica1'));
			$idp2 = trim($this->request->getPost('personaFisica2'));

			$folio = trim($this->request->getPost('folio'));
			$year = trim($this->request->getPost('year'));
			$dataRelacionParentesco = array(
				'FOLIO' => trim($this->request->getPost('folio')),
				'ANO' => trim($this->request->getPost('year')),
				'PERSONAFISICAID1' => $this->request->getPost('personaFisica1'),
				'PERSONAFISICAID2' => $this->request->getPost('personaFisica2'),
				'PARENTESCOID' => $this->request->getPost('parentesco_mf'),
			);

			$updateRelacionParentesco = $this->_parentescoPersonaFisicaModel->set($dataRelacionParentesco)->where('FOLIOID', $folio)->where('ANO', $year)->where('PERSONAFISICAID1', $idp1)->where('PERSONAFISICAID2', $idp2)->update();

			if ($updateRelacionParentesco) {
				$parentescoRelacion = $this->_parentescoPersonaFisicaModel->where('FOLIOID', $folio)->where('ANO', $year)->findAll();
				$personaiduno = $this->_parentescoPersonaFisicaModel->get_personaFisicaUno($folio, $year);
				$personaidDos = $this->_parentescoPersonaFisicaModel->get_personaFisicaDos($folio, $year);
				$parentesco = $this->_parentescoPersonaFisicaModel->get_Parentesco($folio, $year);
				$datosBitacora = [
					'ACCION' => 'Ha actualizado el parentesco de una persona fisica',
					'NOTAS' => 'FOLIO: ' . $folio . ' AÑO: ' . $year,
				];

				$this->_bitacoraActividad($datosBitacora);

				return json_encode(['status' => 1, 'parentescoRelacion' => $parentescoRelacion, 'personaiduno' => $personaiduno, 'personaidDos' => $personaidDos, 'parentesco' => $parentesco]);
			} else {
				return json_encode(['status' => 0, 'message' => $updateRelacionParentesco]);
			}
		} catch (\Exception $e) {
			return json_encode(['status' => 0]);
		}
	}

	public function deleteParentescoById()
	{

		try {
			$idp1 = $this->request->getPost('personafisica1');
			$idp2 = $this->request->getPost('personafisica2');

			$folio = $this->request->getPost('folio');
			$year = $this->request->getPost('year');
			$parentescoid = $this->request->getPost('parentesco_mf');

			$deleteRelacionParentesco = $this->_parentescoPersonaFisicaModel->where('FOLIOID', $folio)->where('ANO', $year)->where('PERSONAFISICAID1', $idp1)->where('PERSONAFISICAID2', $idp2)->where('PARENTESCOID', $parentescoid)->delete();
			if ($deleteRelacionParentesco) {
				$parentescoRelacion = $this->_parentescoPersonaFisicaModel->where('FOLIOID', $folio)->where('ANO', $year)->findAll();
				$personaiduno = $this->_parentescoPersonaFisicaModel->get_personaFisicaUno($folio, $year);
				$personaidDos = $this->_parentescoPersonaFisicaModel->get_personaFisicaDos($folio, $year);
				$parentesco = $this->_parentescoPersonaFisicaModel->get_Parentesco($folio, $year);

				$datosBitacora = [
					'ACCION' => 'Ha eliminado una relación de parenteso',
					'NOTAS' => 'FOLIO: ' . $folio . ' AÑO: ' . $year,
				];

				$this->_bitacoraActividad($datosBitacora);

				return json_encode(['status' => 1, 'parentescoRelacion' => $parentescoRelacion, 'personaiduno' => $personaiduno, 'personaidDos' => $personaidDos, 'parentesco' => $parentesco, 'post' => $_POST]);
			} else {
				return json_encode(['status' => 0]);
			}
		} catch (\Exception $e) {
			return json_encode(['status' => 0]);
		}
	}

	public function createParentescoByFolio()
	{
		$folio = trim($this->request->getPost('folio'));
		$year = trim($this->request->getPost('year'));
		$persona1 = $this->request->getPost('personaFisica1');
		$persona2 = $this->request->getPost('personaFisica2');
		$parentescoid = $this->request->getPost('parentesco_mf');
		$dataRelacionParentesco = array(
			'FOLIOID' => $this->request->getPost('folio'),
			'ANO' => $this->request->getPost('year'),
			'PERSONAFISICAID1' => $this->request->getPost('personaFisica1'),
			'PARENTESCOID' => $this->request->getPost('parentesco_mf'),
			'PERSONAFISICAID2' => $this->request->getPost('personaFisica2'),
		);
		$checarParentesco = $this->_parentescoPersonaFisicaModel->where('FOLIOID', $folio)->where('ANO', $year)->where('PERSONAFISICAID1', $persona1)->where('PERSONAFISICAID2', $persona2)->first();
		if (isset($checarParentesco)) {
			return json_encode(['status' => 3]);
		}
		$insertRelacionParentesco = $this->_parentescoPersonaFisicaModel->insert($dataRelacionParentesco);

		if (!$insertRelacionParentesco) {
			$personas = $this->_folioPersonaFisicaModel->get_by_folio($folio, $year);

			$parentescoRelacion = $this->_parentescoPersonaFisicaModel->where('FOLIOID', $folio)->where('ANO', $year)->findAll();
			$personaiduno = $this->_parentescoPersonaFisicaModel->get_personaFisicaUno($folio, $year);
			$personaidDos = $this->_parentescoPersonaFisicaModel->get_personaFisicaDos($folio, $year);
			$parentesco = $this->_parentescoPersonaFisicaModel->get_Parentesco($folio, $year);
			$datosBitacora = [
				'ACCION' => 'Ha ingresado un nuevo parentesco a una persona fisica',
				'NOTAS' => 'FOLIO: ' . $folio . ' AÑO: ' . $year,
			];

			$this->_bitacoraActividad($datosBitacora);

			return json_encode(['status' => 1, 'personas' => $personas, 'parentescoRelacion' => $parentescoRelacion, 'personaiduno' => $personaiduno, 'personaidDos' => $personaidDos, 'parentesco' => $parentesco]);
		} else {
			return json_encode(['status' => 0]);
		}
	}

	public function getPersonaFisicaFiltro()
	{

		$data = (object) array();

		$folio = $this->request->getPost('folio');
		$year = $this->request->getPost('year');
		$idPersonaFisica = $this->request->getPost('id');

		$data->personaFisicaFiltro = $this->_folioPersonaFisicaModel->get_by_persona_fisica_filtro($folio, $year, $idPersonaFisica);

		if ($data->personaFisicaFiltro) {
			return json_encode(['status' => 1, 'personaFiltro' => $data->personaFisicaFiltro]);
		} else {
			return json_encode(['status' => 0]);
		}
	}

	public function createPersonaFisicaByFolio()
	{
		$folio = trim($this->request->getPost('folio'));
		$year = trim($this->request->getPost('year'));
		$dataNewPersonaFisica = array(
			'FOLIOID' => $this->request->getPost('folio'),
			'ANO' => $this->request->getPost('year'),
			'NOMBRE' => $this->request->getPost('nombre'),
			'PRIMERAPELLIDO' => $this->request->getPost('primer_apellido'),
			'SEGUNDOAPELLIDO' => $this->request->getPost('segundo_apellido'),
			'FECHANACIMIENTO' => $this->request->getPost('fecha_nacimiento'),
			'EDADCANTIDAD' => $this->request->getPost('edad'),
			'SEXO' => $this->request->getPost('sexo') != null ?  $this->request->getPost('sexo') : NULL,
			'TELEFONO' => $this->request->getPost('telefono'),
			'TELEFONO2' => $this->request->getPost('telefono_adicional'),
			'CALIDADJURIDICAID' => $this->request->getPost('calidad_juridica'),
			'TIPOIDENTIFICACIONID' => $this->request->getPost('identificacion'),
			'CODIGOPAISTEL' => $this->request->getPost('codigo_pais_pfc'),
			'CODIGOPAISTEL2' => $this->request->getPost('codigo_pais_pfc_2'),
			'NUMEROIDENTIFICACION' => $this->request->getPost('numero_identificacion'),
			'NACIONALIDADID' => $this->request->getPost('nacionalidad_origen'),
			'PERSONAIDIOMAID' => $this->request->getPost('idioma'),
			'ESCOLARIDADID' => $this->request->getPost('escolaridad'),
			'OCUPACIONID' => $this->request->getPost('ocupacion'),
			'ESTADOCIVILID' => $this->request->getPost('estado_civil'),
			'ESTADOORIGENID' => $this->request->getPost('estado_origen'),
			'MUNICIPIOORIGENID' => $this->request->getPost('municipio_origen'),
			'FACEBOOK' => $this->request->getPost('facebook'),
			'INSTAGRAM' => $this->request->getPost('instagram'),
			'TWITTER' => $this->request->getPost('twitter'),
			'LEER' => $this->request->getPost('leer'),
			'ESCRIBIR' => $this->request->getPost('escribir'),
			'PAIS' => $this->request->getPost('pais_actual'),
			'CORREO' => $this->request->getPost('correo'),
			'DESAPARECIDA' => $this->request->getPost('desaparecida'),

		);
		$interior_new = $this->request->getPost('num_interior');
		if ($interior_new == '') {
			$interior_new = NULL;
		}
		$exterior_new = $this->request->getPost('num_exterior');
		if ($exterior_new == '') {
			$exterior_new = NULL;
		}
		$dataNewPersonaFisicaDomicilio = array(
			'PAIS' => $this->request->getPost('pais_actual'),
			'ESTADOID' => $this->request->getPost('estado_actual'),
			'MUNICIPIOID' => $this->request->getPost('municipio_actual'),
			'LOCALIDADID' => $this->request->getPost('localidad_actual'),
			'COLONIAID' => $this->request->getPost('colonia_actual'),
			'COLONIADESCR' => $this->request->getPost('colonia_actual_descr'),
			'CALLE' => $this->request->getPost('calle'),
			'NUMEROCASA' => $this->request->getPost('checkML_new') == 'on'  && $exterior_new ?  'M.' . $exterior_new : $exterior_new,
			'NUMEROINTERIOR' => $this->request->getPost('checkML_new') == 'on' && $interior_new ?  'L.' . $interior_new : $interior_new,
			'CP' => $this->request->getPost('codigo_postal'),

		);
		if ((int)$this->request->getPost('ocupacion') == 999) {
			$dataNewPersonaFisica['OCUPACIONID'] = (int)$this->request->getPost('ocupacion');
			$dataNewPersonaFisica['OCUPACIONDESCR'] = $this->request->getPost('ocupacion_descr');
		} else {
			$dataNewPersonaFisica['OCUPACIONID'] = (int)$this->request->getPost('ocupacion');
			$dataNewPersonaFisica['OCUPACIONDESCR'] = NULL;
		}
		// var_dump($dataNewPersonaFisicaDomicilio);exit;
		$personaFisica = $this->_folioPersonaFisica($dataNewPersonaFisica, $folio, $year);
		$mediaFiliacion = $this->_folioPersonaFisicaMediaFiliacion($dataNewPersonaFisica, $folio, $personaFisica, $year);
		$domicilio = $this->_folioPersonaFisicaDomicilio($dataNewPersonaFisicaDomicilio, $folio, $personaFisica, $year);


		if ($personaFisica) {
			$personas = $this->_folioPersonaFisicaModel->get_by_folio($folio, $year);
			$personaFisicaID = $this->_folioPersonaFisicaModel->asObject()->where('FOLIOID', $folio)->where('ANO', $year)->orderBy('PERSONAFISICAID', 'desc')->first();
			$imputados = $this->_folioPersonaFisicaModel->get_imputados($folio, $year);
			$victimas = $this->_folioPersonaFisicaModel->get_victimas($folio, $year);
			$delitosModalidadFiltro = $this->_delitoModalidadModel->get_delitodescr($folio, $year);

			$datosBitacora = [
				'ACCION' => 'Ha ingresado una nueva persona fisica',
				'NOTAS' => 'FOLIO: ' . $folio . ' AÑO: ' . $year,
			];

			$this->_bitacoraActividad($datosBitacora);

			return json_encode(['status' => 1, 'personas' => $personas, 'ultimoRegistro' => $personaFisicaID, 'imputados' => $imputados, 'victimas' => $victimas, 'delitosModalidadFiltro' => $delitosModalidadFiltro]);
		} else {
			return json_encode(['status' => 0, 'message' => $_POST]);
		}
	}

	public function createPersonaFisicaByDenunciaAnonima()
	{

		if ($this->request->getPost('victima_conocido') == 1) {
			$nombre = $this->request->getPost('nombre');
			if ($nombre == null) {
				$nombre = 'QRO';
			}
		} else if ($this->request->getPost('victima_conocido') == 2) {
			$nombre = 'QRO';
		}
		if ($this->request->getPost('imputado_conocido') == 1) {
			$nombre = $this->request->getPost('nombre');
			if ($nombre == null) {
				$nombre = 'QRR';
			}
		} else if ($this->request->getPost('imputado_conocido') == 2) {
			$nombre = 'QRR';
		}

		$folio = trim($this->request->getPost('folio'));
		$year = trim($this->request->getPost('year'));
		$dataNewPersonaFisica = array(
			'FOLIOID' => $this->request->getPost('folio'),
			'ANO' => $this->request->getPost('year'),
			'NOMBRE' => $nombre,
			'PRIMERAPELLIDO' => $this->request->getPost('primer_apellido'),
			'SEGUNDOAPELLIDO' => $this->request->getPost('segundo_apellido'),
			'FECHANACIMIENTO' => $this->request->getPost('fecha_nacimiento'),
			'EDADCANTIDAD' => $this->request->getPost('edad'),
			'SEXO' => $this->request->getPost('sexo') != null ?  $this->request->getPost('sexo') : NULL,
			'TELEFONO' => $this->request->getPost('telefono'),
			'TELEFONO2' => $this->request->getPost('telefono_adicional'),
			'CALIDADJURIDICAID' => $this->request->getPost('calidad_juridica'),
			'TIPOIDENTIFICACIONID' => $this->request->getPost('identificacion'),
			'CODIGOPAISTEL' => $this->request->getPost('codigo_pais_pfc'),
			'CODIGOPAISTEL2' => $this->request->getPost('codigo_pais_pfc_2'),
			'NUMEROIDENTIFICACION' => $this->request->getPost('numero_identificacion'),
			'NACIONALIDADID' => $this->request->getPost('nacionalidad_origen'),
			'PERSONAIDIOMAID' => $this->request->getPost('idioma'),
			'ESCOLARIDADID' => $this->request->getPost('escolaridad'),
			'OCUPACIONID' => $this->request->getPost('ocupacion'),
			'ESTADOCIVILID' => $this->request->getPost('estado_civil'),
			'ESTADOORIGENID' => $this->request->getPost('estado_origen'),
			'MUNICIPIOORIGENID' => $this->request->getPost('municipio_origen'),
			'FACEBOOK' => $this->request->getPost('facebook'),
			'INSTAGRAM' => $this->request->getPost('instagram'),
			'TWITTER' => $this->request->getPost('twitter'),
			'LEER' => $this->request->getPost('leer'),
			'ESCRIBIR' => $this->request->getPost('escribir'),
			'PAIS' => $this->request->getPost('pais_actual'),
			'CORREO' => $this->request->getPost('correo'),
			'DESAPARECIDA' => $this->request->getPost('desaparecida'),

		);

		$dataNewPersonaFisicaDomicilio = array(
			'PAIS' => $this->request->getPost('pais_actual'),
			'ESTADOID' => $this->request->getPost('estado_actual'),
			'MUNICIPIOID' => $this->request->getPost('municipio_actual'),
			'LOCALIDADID' => $this->request->getPost('localidad_actual'),
			'COLONIAID' => $this->request->getPost('colonia_actual'),
			'COLONIADESCR' => $this->request->getPost('colonia_actual_descr'),
			'CALLE' => $this->request->getPost('calle'),
			'NUMEROCASA' => $this->request->getPost('num_exterior'),
			'NUMEROINTERIOR' => $this->request->getPost('num_interior'),
			'CP' => $this->request->getPost('codigo_postal'),
		);
		$dataNewPersonaFisicaMediaFiliacion = [
			'OCUPACIONID' => $this->request->getPost('ocupacion_mf') == '0' || empty($this->request->getPost('ocupacion_mf')) ? null : $this->request->getPost('ocupacion_mf'),
			'ESTATURA' => $this->request->getPost('estatura_mf') == '0' || empty($this->request->getPost('estatura_mf')) ? null : $this->request->getPost('estatura_mf'),
			'PESO' => $this->request->getPost('peso_mf') == '0' || empty($this->request->getPost('peso_mf')) ? null : $this->request->getPost('peso_mf'),
			'SENASPARTICULARES' => $this->request->getPost('senas_mf') == '0' || empty($this->request->getPost('senas_mf')) ? null : $this->request->getPost('senas_mf'),
			'PIELCOLORID' => $this->request->getPost('colortez_mf') == '0' || empty($this->request->getPost('colortez_mf')) ? null : $this->request->getPost('colortez_mf'),
			'FIGURAID' => $this->request->getPost('complexion_mf') == '0' || empty($this->request->getPost('complexion_mf')) ? null : $this->request->getPost('complexion_mf'),
			'CONTEXTURAID' => $this->request->getPost('contextura_ceja_mf') == '0' || empty($this->request->getPost('contextura_ceja_mf')) ? null : $this->request->getPost('contextura_ceja_mf'),
			'CARAFORMAID' => $this->request->getPost('cara_forma_mf') == '0' || empty($this->request->getPost('cara_forma_mf')) ? null : $this->request->getPost('cara_forma_mf'),
			'CARATAMANOID' => $this->request->getPost('cara_tamano_mf') == '0' || empty($this->request->getPost('cara_tamano_mf')) ? null : $this->request->getPost('cara_tamano_mf'),
			'CARATEZID' => $this->request->getPost('caratez_mf') == '0' || empty($this->request->getPost('caratez_mf')) ? null : $this->request->getPost('caratez_mf'),
			'OREJALOBULOID' => $this->request->getPost('lobulo_mf') == '0' || empty($this->request->getPost('lobulo_mf')) ? null : $this->request->getPost('lobulo_mf'),
			'OREJAFORMAID' => $this->request->getPost('forma_oreja_mf') == '0' || empty($this->request->getPost('forma_oreja_mf')) ? null : $this->request->getPost('forma_oreja_mf'),
			'OREJATAMANOID' => $this->request->getPost('tamano_oreja_mf') == '0' || empty($this->request->getPost('tamano_oreja_mf')) ? null : $this->request->getPost('tamano_oreja_mf'),
			'CABELLOCOLORID' => $this->request->getPost('colorC_mf') == '0' || empty($this->request->getPost('colorC_mf')) ? null : $this->request->getPost('colorC_mf'),
			'CABELLOESTILOID' => $this->request->getPost('formaC_mf') == '0' || empty($this->request->getPost('formaC_mf')) ? null : $this->request->getPost('formaC_mf'),
			'CABELLOTAMANOID' => $this->request->getPost('tamanoC_mf') == '0' || empty($this->request->getPost('tamanoC_mf')) ? null : $this->request->getPost('tamanoC_mf'),
			'CABELLOPECULIARID' => $this->request->getPost('peculiarC_mf') == '0' || empty($this->request->getPost('peculiarC_mf')) ? null : $this->request->getPost('peculiarC_mf'),
			'CABELLODESCR' => $this->request->getPost('cabello_descr_mf') == '0' || empty($this->request->getPost('cabello_descr_mf')) ? null : $this->request->getPost('cabello_descr_mf'),
			'FRENTEALTURAID' => $this->request->getPost('frente_altura_mf') == '0' || empty($this->request->getPost('frente_altura_mf')) ? null : $this->request->getPost('frente_altura_mf'),
			'FRENTEANCHURAID' => $this->request->getPost('frente_anchura_ms') == '0' || empty($this->request->getPost('frente_anchura_ms')) ? null : $this->request->getPost('frente_anchura_ms'),
			'FRENTEFORMAID' => $this->request->getPost('tipoF_mf') == '0' || empty($this->request->getPost('tipoF_mf')) ? null : $this->request->getPost('tipoF_mf'),
			'FRENTEPECULIARID' => $this->request->getPost('frente_peculiar_mf') == '0' || empty($this->request->getPost('frente_peculiar_mf')) ? null : $this->request->getPost('frente_peculiar_mf'),
			'CEJACOLOCACIONID' => $this->request->getPost('colocacion_ceja_mf') == '0' || empty($this->request->getPost('colocacion_ceja_mf')) ? null : $this->request->getPost('colocacion_ceja_mf'),
			'CEJAFORMAID' => $this->request->getPost('ceja_mf') == '0' || empty($this->request->getPost('ceja_mf')) ? null : $this->request->getPost('ceja_mf'),
			'CEJATAMANOID' => $this->request->getPost('tamano_ceja_mf') == '0' || empty($this->request->getPost('tamano_ceja_mf')) ? null : $this->request->getPost('tamano_ceja_mf'),
			'CEJAGROSORID' => $this->request->getPost('grosor_ceja_mf') == '0' || empty($this->request->getPost('grosor_ceja_mf')) ? null : $this->request->getPost('grosor_ceja_mf'),
			'OJOCOLOCACIONID' => $this->request->getPost('colocacion_ojos_mf') == '0' || empty($this->request->getPost('colocacion_ojos_mf')) ? null : $this->request->getPost('colocacion_ojos_mf'),
			'OJOFORMAID' => $this->request->getPost('forma_ojos_mf') == '0' || empty($this->request->getPost('forma_ojos_mf')) ? null : $this->request->getPost('forma_ojos_mf'),
			'OJOTAMANOID' => $this->request->getPost('tamano_ojos_mf') == '0' || empty($this->request->getPost('tamano_ojos_mf')) ? null : $this->request->getPost('tamano_ojos_mf'),
			'OJOCOLORID' => $this->request->getPost('colorO_mf') == '0' || empty($this->request->getPost('colorO_mf')) ? null : $this->request->getPost('colorO_mf'),
			'OJOPECULIARID' => $this->request->getPost('peculiaridad_ojos_mf') == '0' || empty($this->request->getPost('peculiaridad_ojos_mf')) ? null : $this->request->getPost('peculiaridad_ojos_mf'),
			'NARIZTIPOID' => $this->request->getPost('nariz_tipo_mf') == '0' || empty($this->request->getPost('nariz_tipo_mf')) ? null : $this->request->getPost('nariz_tipo_mf'),
			'NARIZTAMANOID' => $this->request->getPost('nariz_tamano_mf') == '0' || empty($this->request->getPost('nariz_tamano_mf')) ? null : $this->request->getPost('nariz_tamano_mf'),
			'NARIZBASEID' => $this->request->getPost('nariz_base_mf') == '0' || empty($this->request->getPost('nariz_base_mf')) ? null : $this->request->getPost('nariz_base_mf'),
			'NARIZPECULIARID' => $this->request->getPost('nariz_peculiar_mf') == '0' || empty($this->request->getPost('nariz_peculiar_mf')) ? null : $this->request->getPost('nariz_peculiar_mf'),
			'NARIZDESCR' => $this->request->getPost('nariz_descr_mf') == '0' || empty($this->request->getPost('nariz_descr_mf')) ? null : $this->request->getPost('nariz_descr_mf'),
			'BIGOTEFORMAID' => $this->request->getPost('bigote_forma_mf') == '0' || empty($this->request->getPost('bigote_forma_mf')) ? null : $this->request->getPost('bigote_forma_mf'),
			'BIGOTETAMANOID' => $this->request->getPost('bigote_tamaño_mf') == '0' || empty($this->request->getPost('bigote_tamaño_mf')) ? null : $this->request->getPost('bigote_tamaño_mf'),
			'BIGOTEGROSORID' => $this->request->getPost('bigote_grosor_mf') == '0' || empty($this->request->getPost('bigote_grosor_mf')) ? null : $this->request->getPost('bigote_grosor_mf'),
			'BIGOTEPECULIARID' => $this->request->getPost('bigote_peculiar_mf') == '0' || empty($this->request->getPost('bigote_peculiar_mf')) ? null : $this->request->getPost('bigote_peculiar_mf'),
			'BIGOTEDESCR' => $this->request->getPost('bigote_descr_mf') == '0' || empty($this->request->getPost('bigote_descr_mf')) ? null : $this->request->getPost('bigote_descr_mf'),
			'BOCATAMANOID' => $this->request->getPost('boca_tamano_mf') == '0' || empty($this->request->getPost('boca_tamano_mf')) ? null : $this->request->getPost('boca_tamano_mf'),
			'BOCAPECULIARID' => $this->request->getPost('boca_peculiar_mf') == '0' || empty($this->request->getPost('boca_peculiar_mf')) ? null : $this->request->getPost('boca_peculiar_mf'),
			'LABIOGROSORID' => $this->request->getPost('labio_grosor_mf') == '0' || empty($this->request->getPost('labio_grosor_mf')) ? null : $this->request->getPost('labio_grosor_mf'),
			'LABIOLONGITUDID' => $this->request->getPost('labio_longitud_mf') == '0' || empty($this->request->getPost('labio_longitud_mf')) ? null : $this->request->getPost('labio_longitud_mf'),
			'LABIOPOSICIONID' => $this->request->getPost('labio_posicion_mf') == '0' || empty($this->request->getPost('labio_posicion_mf')) ? null : $this->request->getPost('labio_posicion_mf'),
			'LABIOPECULIARID' => $this->request->getPost('labio_peculiar_mf') == '0' || empty($this->request->getPost('labio_peculiar_mf')) ? null : $this->request->getPost('labio_peculiar_mf'),
			'DIENTETAMANOID' => $this->request->getPost('dientes_tamano_mf') == '0' || empty($this->request->getPost('dientes_tamano_mf')) ? null : $this->request->getPost('dientes_tamano_mf'),
			'DIENTETIPOID' => $this->request->getPost('dientes_tipo_mf') == '0' || empty($this->request->getPost('dientes_tipo_mf')) ? null : $this->request->getPost('dientes_tipo_mf'),
			'DIENTEPECULIARID' => $this->request->getPost('dientes_peculiar_mf') == '0' || empty($this->request->getPost('dientes_peculiar_mf')) ? null : $this->request->getPost('dientes_peculiar_mf'),
			'DIENTEDESCR' => $this->request->getPost('dientes_descr_mf') == '0' || empty($this->request->getPost('dientes_descr_mf')) ? null : $this->request->getPost('dientes_descr_mf'),
			'BARBILLAFORMAID' => $this->request->getPost('barbilla_forma_mf') == '0' || empty($this->request->getPost('barbilla_forma_mf')) ? null : $this->request->getPost('barbilla_forma_mf'),
			'BARBILLATAMANOID' => $this->request->getPost('barbilla_tamano_mf') == '0' || empty($this->request->getPost('barbilla_tamano_mf')) ? null : $this->request->getPost('barbilla_tamano_mf'),
			'BARBILLAINCLINACIONID' => $this->request->getPost('barbilla_inclinacion_mf') == '0' || empty($this->request->getPost('barbilla_inclinacion_mf')) ? null : $this->request->getPost('barbilla_inclinacion_mf'),
			'BARBILLAPECULIARID' => $this->request->getPost('barbilla_peculiar_mf') == '0' || empty($this->request->getPost('barbilla_peculiar_mf')) ? null : $this->request->getPost('barbilla_peculiar_mf'),
			'BARBILLADESCR' => $this->request->getPost('barbilla_descr_mf') == '0' || empty($this->request->getPost('barbilla_descr_mf')) ? null : $this->request->getPost('barbilla_descr_mf'),
			'BARBATAMANOID' => $this->request->getPost('barba_tamano_mf') == '0' || empty($this->request->getPost('barba_tamano_mf')) ? null : $this->request->getPost('barba_tamano_mf'),
			'BARBAPECULIARID' => $this->request->getPost('barba_peculiar_mf') == '0' || empty($this->request->getPost('barba_peculiar_mf')) ? null : $this->request->getPost('barba_peculiar_mf'),
			'BARBADESCR' => $this->request->getPost('barba_descr_mf') == '0' || empty($this->request->getPost('barba_descr_mf')) ? null : $this->request->getPost('barba_descr_mf'),
			'CUELLOTAMANOID' => $this->request->getPost('cuello_tamano_mf') == '0' || empty($this->request->getPost('cuello_tamano_mf')) ? null : $this->request->getPost('cuello_tamano_mf'),
			'CUELLOGROSORID' => $this->request->getPost('cuello_grosor_mf') == '0' || empty($this->request->getPost('cuello_grosor_mf')) ? null : $this->request->getPost('cuello_grosor_mf'),
			'CUELLOPECULIARID' => $this->request->getPost('cuello_peculiar_mf') == '0' || empty($this->request->getPost('cuello_peculiar_mf')) ? null : $this->request->getPost('cuello_peculiar_mf'),
			'CUELLODESCR' => $this->request->getPost('cuello_descr_mf') == '0' || empty($this->request->getPost('cuello_descr_mf')) ? null : $this->request->getPost('cuello_descr_mf'),
			'HOMBROPOSICIONID' => $this->request->getPost('hombro_posicion_mf') == '0' || empty($this->request->getPost('hombro_posicion_mf')) ? null : $this->request->getPost('hombro_posicion_mf'),
			'HOMBROLONGITUDID' => $this->request->getPost('hombro_tamano_mf') == '0' || empty($this->request->getPost('hombro_tamano_mf')) ? null : $this->request->getPost('hombro_tamano_mf'),
			'HOMBROGROSORID' => $this->request->getPost('hombro_grosor_mf') == '0' || empty($this->request->getPost('hombro_grosor_mf')) ? null : $this->request->getPost('hombro_grosor_mf'),
			'ESTOMAGOID' => $this->request->getPost('estomago_mf') == '0' || empty($this->request->getPost('estomago_mf')) ? null : $this->request->getPost('estomago_mf'),
			'PERSONAESCOLARIDADID' => $this->request->getPost('escolaridad_mf') == '0' || empty($this->request->getPost('escolaridad_mf')) ? null : $this->request->getPost('escolaridad_mf'),
			'PERSONAETNIAID' => $this->request->getPost('etnia_mf') == '0' || empty($this->request->getPost('etnia_mf')) ? null : $this->request->getPost('etnia_mf'),
			'ESTOMAGODESCR' => $this->request->getPost('estomago_descr_mf') == '0' || empty($this->request->getPost('estomago_descr_mf')) ? null : $this->request->getPost('estomago_descr_mf'),
			'DISCAPACIDADDESCR' => $this->request->getPost('discapacidad_mf') == '0' || empty($this->request->getPost('discapacidad_mf')) ? null : $this->request->getPost('discapacidad_mf'),
			'FECHADESAPARICION' => $this->request->getPost('diaDesaparicion') == '0' || empty($this->request->getPost('diaDesaparicion')) ? null : $this->request->getPost('diaDesaparicion'),
			'LUGARDESAPARICION' => $this->request->getPost('lugarDesaparicion') == '0' || empty($this->request->getPost('lugarDesaparicion')) ? null : $this->request->getPost('lugarDesaparicion'),
			'VESTIMENTADESCR' => $this->request->getPost('vestimenta_mf') == '0' || empty($this->request->getPost('vestimenta_mf')) ? null : $this->request->getPost('vestimenta_mf'),
		];

		$personaFisica = $this->_folioPersonaFisica($dataNewPersonaFisica, $folio, $year);
		$mediaFiliacion = $this->_folioPersonaFisicaMediaFiliacion($dataNewPersonaFisicaMediaFiliacion, $folio, $personaFisica, $year);
		$domicilio = $this->_folioPersonaFisicaDomicilio($dataNewPersonaFisicaDomicilio, $folio, $personaFisica, $year);


		if ($personaFisica) {
			$personas = $this->_folioPersonaFisicaModel->get_by_folio($folio, $year);
			$personaFisicaID = $this->_folioPersonaFisicaModel->asObject()->where('FOLIOID', $folio)->where('ANO', $year)->orderBy('PERSONAFISICAID', 'desc')->first();
			$imputados = $this->_folioPersonaFisicaModel->get_imputados($folio, $year);
			$victimas = $this->_folioPersonaFisicaModel->get_victimas($folio, $year);
			$delitosModalidadFiltro = $this->_delitoModalidadModel->get_delitodescr($folio, $year);

			$datosBitacora = [
				'ACCION' => 'Ha ingresado una nueva persona fisica',
				'NOTAS' => 'FOLIO: ' . $folio . ' AÑO: ' . $year,
			];

			$this->_bitacoraActividad($datosBitacora);

			return json_encode(['status' => 1, 'personas' => $personas, 'ultimoRegistro' => $personaFisicaID, 'imputados' => $imputados, 'victimas' => $victimas, 'delitosModalidadFiltro' => $delitosModalidadFiltro]);
		} else {
			return json_encode(['status' => 0, 'message' => $_POST]);
		}
	}

	private function _folioPersonaFisica($data, $folio, $year)
	{
		$data = $data;
		$data['FOLIOID'] = $folio;
		$data['ANO'] = $year;
		if ($data['FECHANACIMIENTO'] == '' || $data['FECHANACIMIENTO'] == null || $data['FECHANACIMIENTO'] == '0000-00-00') {
			$data['FECHANACIMIENTO'] = null;
		}

		$personaFisica = $this->_folioPersonaFisicaModel->asObject()->where('FOLIOID', $folio)->where('ANO', $year)->orderBy('PERSONAFISICAID', 'desc')->first();

		if ($personaFisica) {
			$data['PERSONAFISICAID'] = ((int) $personaFisica->PERSONAFISICAID) + 1;
			$personaFisica = $this->_folioPersonaFisicaModel->insert($data);
			return $data['PERSONAFISICAID'];
		} else {
			$data['PERSONAFISICAID'] = 1;
			$personaFisica = $this->_folioPersonaFisicaModel->insert($data);
			return $data['PERSONAFISICAID'];
		}
	}

	private function _folioPersonaFisicaDomicilio($data, $folio, $personaFisicaID, $year)
	{
		$data = $data;
		$data['FOLIOID'] = $folio;
		$data['ANO'] = $year;
		$data['PERSONAFISICAID'] = $personaFisicaID;

		$colonia = $this->_coloniasModel->asObject()->where('ESTADOID', 2)->where('MUNICIPIOID', $data['MUNICIPIOID'])->where('LOCALIDADID',  $data['LOCALIDADID'])->where('COLONIAID', $data['COLONIAID'])->first();
		// if ((int) $data['COLONIAID'] == 0 || $data['COLONIAID'] == null) {

		// if ($data['COLONIAID'] == null) {
		// 	$data['LOCALIDADID'] = null;
		// }
		if ((int) $data['COLONIAID'] == 0) {
			$data['COLONIAID'] = null;
			$data['COLONIADESCR'] = $data['COLONIADESCR'];
		} else {
			$data['COLONIAID'] = $colonia->COLONIAID;
			$data['COLONIADESCR'] = $colonia->COLONIADESCR;
		};

		if ($data['COLONIAID'] != null) {

			if ($data['MUNICIPIOID']) {
				try {
					$colonia ? $data['LOCALIDADID'] = $colonia->LOCALIDADID : $data['LOCALIDADID'] = null;
				} catch (\Exception $e) {
					$data['LOCALIDADID'] = null;
				}
			} else {
				$data['LOCALIDADID'] = null;
			}
		}

		if ($data['LOCALIDADID'] != null) {
			if ($data['MUNICIPIOID']) {
				try {
					$localidad = $this->_localidadesModel->asObject()->where('ESTADOID', 2)->where('MUNICIPIOID', $data['MUNICIPIOID'])->where('LOCALIDADID', $data['LOCALIDADID'])->first();
					$localidad ? $data['ZONA'] = $localidad->ZONA : null;
				} catch (\Exception $e) {
				}
			}
		}



		$personaDomicilio = $this->_folioPersonaFisicaDomicilioModel->asObject()->where('FOLIOID', $folio)->where('ANO', $year)->where('PERSONAFISICAID', $personaFisicaID)->orderBy('DOMICILIOID', 'desc')->first();

		if ($personaDomicilio) {
			$data['DOMICILIOID'] = ((int) $personaDomicilio->DOMICILIOID) + 1;
			$this->_folioPersonaFisicaDomicilioModel->insert($data);
			return $data['DOMICILIOID'];
		} else {
			$data['DOMICILIOID'] = 1;
			$this->_folioPersonaFisicaDomicilioModel->insert($data);
			return $data['DOMICILIOID'];
		}
	}

	private function _folioPersonaFisicaMediaFiliacion($data, $folio, $personaFisicaID, $year)
	{
		$data = $data;
		$data['FOLIOID'] = $folio;
		$data['ANO'] = $year;
		$data['PERSONAFISICAID'] = $personaFisicaID;
		if (empty($data['FECHADESAPARICION'])) {
			$data['FECHADESAPARICION'] = null;
		}
		if ($data['FECHADESAPARICION'] == '0000-00-00') {
			$data['FECHADESAPARICION'] = null;
		}
		$this->_folioMediaFiliacion->insert($data);
	}

	public function createRelacionIDOByFolio()
	{
		$folio = trim($this->request->getPost('folio'));
		$year = trim($this->request->getPost('year'));
		$datoRelacionFisfis = array(
			'FOLIOID' => $this->request->getPost('folio'),
			'ANO' => $this->request->getPost('year'),
			'PERSONAFISICAIDVICTIMA' => $this->request->getPost('victima'),
			'DELITOMODALIDADID' => $this->request->getPost('delito'),
			'PERSONAFISICAIDIMPUTADO' => $this->request->getPost('imputado'),
			'TENTATIVA' => $this->request->getPost('tentativa') != null ? $this->request->getPost('tentativa') : NULL,
			'CONVIOLENCIA' => $this->request->getPost('conviolencia') != null ? $this->request->getPost('conviolencia') : NULL,

		);
		$checarDelito = $this->_relacionIDOModel->where('FOLIOID', $folio)->where('ANO', $year)->where('PERSONAFISICAIDVICTIMA', $this->request->getPost('victima'))->where('PERSONAFISICAIDIMPUTADO', $this->request->getPost('imputado'))->where('DELITOMODALIDADID', $this->request->getPost('delito'))->first();
		if (isset($checarDelito)) {
			return json_encode(['status' => 3]);
		}
		$insertRelacionIDO = $this->_relacionIDOModel->insert($datoRelacionFisfis);

		if (isset($insertRelacionIDO)) {
			$relacionFisFis = $this->_relacionIDOModel->get_by_folio($folio, $year);
			$delitosModalidadFiltro = $this->_delitoModalidadModel->get_delitodescr($folio, $year);

			$datosBitacora = [
				'ACCION' => 'Ha ingresado una nuevo arbol delictual',
				'NOTAS' => 'FOLIO: ' . $folio . ' AÑO: ' . $year,
			];

			$this->_bitacoraActividad($datosBitacora);

			return json_encode(['status' => 1, 'relacionFisFis' => $relacionFisFis]);
		} else {
			return json_encode(['status' => 0, 'message' => $_POST]);
		}
	}

	public function deleteArbolByFolio()
	{
		try {
			$folio = trim($this->request->getPost('folio'));
			$year = trim($this->request->getPost('year'));
			$personafisicavictima = trim($this->request->getPost('personafisicavictima'));
			$delitomodalidad = trim($this->request->getPost('delito'));
			$personafisicaimputado = trim($this->request->getPost('personafisicaimputado'));

			$countImpDelito = $this->_imputadoDelitoModel->count_delitos($folio, $year, $delitomodalidad);
			$countdelitoFisFis = $this->_relacionIDOModel->count_delitosFisFis($folio, $year, $delitomodalidad, $personafisicaimputado);
			$deleteArbol = $this->_relacionIDOModel->where('FOLIOID', $folio)->where('ANO', $year)->where('PERSONAFISICAIDVICTIMA', $personafisicavictima)->where('DELITOMODALIDADID', $delitomodalidad)->where('PERSONAFISICAIDIMPUTADO', $personafisicaimputado)->delete();

			if ($countdelitoFisFis[0]->DELITOMODALIDADID == 1) {
				return json_encode(['status' => 3, 'count' => $countImpDelito[0]->DELITOMODALIDADID]);
			}
			// if ($countdelitoFisFis[0]->DELITOMODALIDADID == 1) {
			//     $deleteImpDelito = $this->_imputadoDelitoModel->where('FOLIOID', $folio)->where('ANO', $year)->where('PERSONAFISICAID', $personafisicaimputado)->where('DELITOMODALIDADID', $delitomodalidad)->delete();
			//     if ($deleteImpDelito) {
			//         $relacionFisFis = $this->_relacionIDOModel->get_by_folio($folio, $year);
			//         $fisicaImpDelito = $this->_imputadoDelitoModel->get_by_folio($folio, $year);

			//         $datosBitacora = [
			//             'ACCION' => 'Ha eliminado un delito del imputado',
			//             'NOTAS' => 'FOLIO: ' . $folio . ' AÑO: ' . $year,
			//         ];

			//         $this->_bitacoraActividad($datosBitacora);

			//         return json_encode(['status' => 1, 'relacionFisFis' => $relacionFisFis, 'fisicaImpDelito' => $fisicaImpDelito]);
			//     } else {
			//         return json_encode(['status' => 0]);
			//     }
			// } else 
			if ($countdelitoFisFis[0]->DELITOMODALIDADID > 1) {
				if ($deleteArbol) {
					$relacionFisFis = $this->_relacionIDOModel->get_by_folio($folio, $year);
					$fisicaImpDelito = $this->_imputadoDelitoModel->get_by_folio($folio, $year);

					$datosBitacora = [
						'ACCION' => 'Ha eliminado un árbol delictivo',
						'NOTAS' => 'FOLIO: ' . $folio . ' AÑO: ' . $year,
					];

					$this->_bitacoraActividad($datosBitacora);

					return json_encode(['status' => 1, 'relacionFisFis' => $relacionFisFis, 'fisicaImpDelito' => $fisicaImpDelito]);
				} else {
					return json_encode(['status' => 0]);
				}
			}
		} catch (\Exception $e) {
			return json_encode(['status' => 0]);
		}
	}

	public function deleteImpDelitoByFolio()
	{
		try {
			$folio = trim($this->request->getPost('folio'));
			$year = trim($this->request->getPost('year'));
			$personafisicavictima = trim($this->request->getPost('personafisicavictima'));
			$delitomodalidad = trim($this->request->getPost('delito'));
			$personafisicaimputado = trim($this->request->getPost('personafisicaimputado'));

			$deleteImpDelito = $this->_imputadoDelitoModel->where('FOLIOID', $folio)->where('ANO', $year)->where('PERSONAFISICAID', $personafisicaimputado)->where('DELITOMODALIDADID', $delitomodalidad)->delete();
			$deleteArbol = $this->_relacionIDOModel->where('FOLIOID', $folio)->where('ANO', $year)->where('PERSONAFISICAIDVICTIMA', $personafisicavictima)->where('DELITOMODALIDADID', $delitomodalidad)->where('PERSONAFISICAIDIMPUTADO', $personafisicaimputado)->delete();

			if ($deleteImpDelito && $deleteArbol) {
				$fisicaImpDelito = $this->_imputadoDelitoModel->get_by_folio($folio, $year);
				$relacionFisFis = $this->_relacionIDOModel->get_by_folio($folio, $year);

				$datosBitacora1 = [
					'ACCION' => 'Ha eliminado el delito de un imputado',
					'NOTAS' => 'FOLIO: ' . $folio . ' AÑO: ' . $year,
				];

				$datosBitacora2 = [
					'ACCION' => 'Ha eliminado un árbol delictivo',
					'NOTAS' => 'FOLIO: ' . $folio . ' AÑO: ' . $year,
				];

				$this->_bitacoraActividad($datosBitacora1);
				$this->_bitacoraActividad($datosBitacora2);


				return json_encode(['status' => 1, 'fisicaImpDelito' => $fisicaImpDelito, 'relacionFisFis' => $relacionFisFis]);
			} else {
				return json_encode(['status' => 0]);
			}
		} catch (\Exception $e) {
			return json_encode(['status' => 0]);
		}
	}

	public function createFisImpDelitoByFolio()
	{
		$folio = trim($this->request->getPost('folio'));
		$year = trim($this->request->getPost('year'));
		$datoFisImpDelito = array(
			'FOLIOID' => $this->request->getPost('folio'),
			'ANO' => $this->request->getPost('year'),
			'PERSONAFISICAID' => $this->request->getPost('imputado'),
			'DELITOMODALIDADID' => $this->request->getPost('delito'),
		);
		$checarDelito = $this->_imputadoDelitoModel->where('FOLIOID', $folio)->where('ANO', $year)->where('DELITOMODALIDADID', $this->request->getPost('delito'))->where('PERSONAFISICAID', $this->request->getPost('imputado'))->first();
		if (isset($checarDelito)) {
			return json_encode(['status' => 3]);
		}
		$insertFisImpDelito = $this->_imputadoDelitoModel->insert($datoFisImpDelito);

		if (isset($insertFisImpDelito)) {
			$fisicaImpDelito = $this->_imputadoDelitoModel->get_by_folio($folio, $year);
			// $delitosModalidadFiltro = $this->_delitoModalidadModel->get_delitodescr($folio, $year);
			$datosBitacora = [
				'ACCION' => 'Ha ingresado una nuevo delito en un imputado',
				'NOTAS' => 'FOLIO: ' . $folio . ' AÑO: ' . $year,
			];

			$this->_bitacoraActividad($datosBitacora);

			return json_encode(['status' => 1, 'fisicaImpDelito' => $fisicaImpDelito]);
		} else {
			return json_encode(['status' => 0]);
		}
	}

	public function getObjetoSubclasificacion()
	{
		$data = (object) array();
		$clasificacionID = $this->request->getPost('objeto_clasificacion_id');

		$data->objetoSubclasificacion = $this->_objetoSubclasificacionModel->asObject()->where('OBJETOCLASIFICACIONID', $clasificacionID)->orderBy('OBJETOSUBCLASIFICACIONDESCR', 'asc')->findAll();

		if ($data->objetoSubclasificacion) {
			return json_encode(['status' => 1, 'objetoSub' => $data->objetoSubclasificacion]);
		} else {
			return json_encode(['status' => 0]);
		}
	}

	public function createObjetoInvolucradoByFolio()
	{

		$folio = trim($this->request->getPost('folio'));
		$year = trim($this->request->getPost('year'));

		$dataObjetoInvolucrado = array(
			'FOLIOID' => $this->request->getPost('folio'),
			'ANO' => $this->request->getPost('year'),
			'SITUACION' => $this->request->getPost('situacion'),
			'CLASIFICACIONID' => $this->request->getPost('clasificacionid'),
			'SUBCLASIFICACIONID' => $this->request->getPost('subclasificacionid'),
			'MARCA' => $this->request->getPost('marca'),
			'NUMEROSERIE' => $this->request->getPost('numserie'),
			'CANTIDAD' => $this->request->getPost('cantidad'),
			'VALOR' => $this->request->getPost('valor'),
			'TIPOMONEDAID' => $this->request->getPost('moneda'),
			'DESCRIPCIONDETALLADA' => $this->request->getPost('descripciondetallada'),
			'PERSONAFISICAIDPROPIETARIO' => $this->request->getPost('propietario'),
			'PARTICIPAESTADO' => $this->request->getPost('participaestado'),
		);
		$objetoInvolucrado = $this->_folioObjetoInvolucrado($dataObjetoInvolucrado, $folio, $year);
		if ($objetoInvolucrado) {
			$objetos = $this->_folioObjetoInvolucradoModel->get_descripcion($folio, $year);
			$personas = $this->_folioPersonaFisicaModel->get_by_folio($folio, $year);

			$datosBitacora = [
				'ACCION' => 'Ha ingresado un nuevo objeto involucrado',
				'NOTAS' => 'FOLIO: ' . $folio . ' AÑO: ' . $year,
			];

			$this->_bitacoraActividad($datosBitacora);
			return json_encode(['status' => 1, 'objetos' => $objetos, 'personas' => $personas]);
		}
	}

	public function deleteObjetoInvolucrado()
	{

		try {
			$folio = trim($this->request->getPost('folio'));
			$year = trim($this->request->getPost('year'));
			$objetoid = trim($this->request->getPost('objetoid'));

			$deleteObjetoInvolucrado = $this->_folioObjetoInvolucradoModel->where('FOLIOID', $folio)->where('ANO', $year)->where('OBJETOID', $objetoid)->delete();

			if ($deleteObjetoInvolucrado) {
				$objetos = $this->_folioObjetoInvolucradoModel->get_descripcion($folio, $year);

				$datosBitacora1 = [
					'ACCION' => 'Ha eliminado un objeto involucrado',
					'NOTAS' => 'FOLIO: ' . $folio . ' AÑO: ' . $year,
				];

				$this->_bitacoraActividad($datosBitacora1);

				return json_encode(['status' => 1, 'objetos' => $objetos]);
			} else {
				return json_encode(['status' => 0]);
			}
		} catch (\Exception $e) {
			return json_encode(['status' => 0]);
		}
	}

	public function getObjetoInvolucrado()
	{
		$objetoid = trim($this->request->getPost('objetoid'));
		$folio = trim($this->request->getPost('folio'));
		$year = trim($this->request->getPost('year'));

		$data = (object) array();
		$data->objetoInvolucrado = $this->_folioObjetoInvolucradoModel->where('FOLIOID', $folio)->where('ANO', $year)->where('OBJETOID', $objetoid)->first();
		$data->objetosub = $this->_folioObjetoInvolucradoModel->get_objetosub($folio, $year, $objetoid, $data->objetoInvolucrado['CLASIFICACIONID']);
		if ($data->objetoInvolucrado) {
			$data->status = 1;
			return json_encode($data);
		} else {
			$data = (object)['status' => 0];
			return json_encode($data);
		}
	}

	public function updateObjetosInvolucradosById()
	{
		try {
			$objetoid = trim($this->request->getPost('objetoid'));
			$folio = trim($this->request->getPost('folio'));
			$year = trim($this->request->getPost('year'));
			$dataObjetoInvolucrado = array(
				'FOLIO' => trim($this->request->getPost('folio')),
				'ANO' => trim($this->request->getPost('year')),
				'OBJETOID' => $this->request->getPost('objetoid'),
				'SITUACION' => $this->request->getPost('situacion'),
				'CLASIFICACIONID' => $this->request->getPost('clasificacionid'),
				'SUBCLASIFICACIONID' => $this->request->getPost('subclasificacionid'),
				'MARCA' => $this->request->getPost('marca'),
				'NUMEROSERIE' => $this->request->getPost('numserie'),
				'CANTIDAD' => $this->request->getPost('cantidad'),
				'VALOR' => $this->request->getPost('valor'),
				'TIPOMONEDAID' => $this->request->getPost('moneda'),
				'DESCRIPCIONDETALLADA' => $this->request->getPost('descripciondetallada'),
				'PERSONAFISICAIDPROPIETARIO' => $this->request->getPost('propietario'),
				'PARTICIPAESTADO' => $this->request->getPost('participaestado'),
			);

			$updateObjetoInvolucrado = $this->_folioObjetoInvolucradoModel->set($dataObjetoInvolucrado)->where('FOLIOID', $folio)->where('ANO', $year)->where('OBJETOID', $objetoid)->update();

			if ($updateObjetoInvolucrado) {
				$objetos = $this->_folioObjetoInvolucradoModel->get_descripcion($folio, $year);


				$datosBitacora = [
					'ACCION' => 'Ha actualizado el objeto involucrado',
					'NOTAS' => 'FOLIO: ' . $folio . ' AÑO: ' . $year . 'OBJETOID: ' . $objetoid,
				];

				$this->_bitacoraActividad($datosBitacora);

				return json_encode(['status' => 1, 'objetos' => $objetos]);
			} else {
				return json_encode(['status' => 0]);
			}
		} catch (\Exception $e) {
			return json_encode(['status' => 0]);
		}
	}

	private function _folioObjetoInvolucrado($data, $folio, $year)
	{
		$data = $data;
		$data['FOLIOID'] = $folio;
		$data['ANO'] = $year;

		$objetoInvolucrado = $this->_folioObjetoInvolucradoModel->asObject()->where('FOLIOID', $folio)->where('ANO', $year)->orderBy('OBJETOID', 'desc')->first();

		if ($objetoInvolucrado) {
			$data['OBJETOID'] = ((int) $objetoInvolucrado->OBJETOID) + 1;
			$objetoInvolucrado = $this->_folioObjetoInvolucradoModel->insert($data);
			return $data['OBJETOID'];
		} else {
			$data['OBJETOID'] = 1;
			$objetoInvolucrado = $this->_folioObjetoInvolucradoModel->insert($data);
			return $data['OBJETOID'];
		}
	}

	public function get_Plantillas()
	{

		$meses = array("ENERO", "FEBRERO", "MARZO", "ABRIL", "MAYO", "JUNIO", "JULIO", "AGOSTO", "SEPTIEMBRE", "OCTUBRE", "NOVIEMBRE", "DICIEMBRE");
		$expediente = $this->request->getPost('expediente');
		$year = $this->request->getPost('year');
		$titulo = $this->request->getPost('titulo');
		$victima = $this->request->getPost('victima');
		$imputado = $this->request->getPost('imputado');
		$folio = $this->request->getPost('folio');

		if (empty($expediente) && isset($year) && isset($titulo) && isset($victima) && isset($imputado) && isset($folio)) {
			$data = (object) array();
			$data->folio = $this->_folioModel->asObject()->where('ANO', $year)->where('FOLIOID', $folio)->first();
			$data->denunciantes = $this->_folioModel->get_denunciante($folio, $year);
			$data->estado = $this->_estadosModel->asObject()->where('ESTADOID', $data->folio->ESTADOID)->first();
			$data->plantilla = $this->_plantillasModel->where('TITULO', $titulo)->first();
			$data->folioDoc = $this->_folioDocModel->get_by_folio($folio, $data->folio->ANO);
			$data->lugar_hecho = $data->folio->HECHOLUGARID ? $this->_hechoLugarModel->asObject()->where('HECHOLUGARID', $data->folio->HECHOLUGARID)->first() : (object)['HECHOLUGARDESCR' => 'NO ESPECIFICADO'];
			$data->derivacion = $this->_derivacionesAtencionesModel->asObject()->where('MUNICIPIOID', $data->folio->INSTITUCIONREMISIONMUNICIPIOID)->where('INSTITUCIONREMISIONID',  $data->folio->INSTITUCIONREMISIONID)->first();
			$data->canalizacion = $this->_canalizacionesAtencionesModel->asObject()->where('MUNICIPIOID', $data->folio->INSTITUCIONREMISIONMUNICIPIOID)->where('INSTITUCIONREMISIONID',  $data->folio->INSTITUCIONREMISIONID)->first();

			$data->municipios = $this->_municipiosModel->asObject()->where('ESTADOID', '2')->where('MUNICIPIOID',  $data->folio->MUNICIPIOID)->first();
			$data->victima = $this->_folioPersonaFisicaModel->get_by_personas($data->folio->FOLIOID, $data->folio->ANO, $victima);
			$data->imputado = $this->_folioPersonaFisicaModel->asObject()->where('FOLIOID', $data->folio->FOLIOID)->where('ANO', $data->folio->ANO)->where('PERSONAFISICAID', $imputado)->first();
			$data->victimaDom = $this->_folioPersonaFisicaDomicilioModel->asObject()->where('FOLIOID', $data->folio->FOLIOID)->where('ANO', $data->folio->ANO)->where('PERSONAFISICAID', $victima)->first();
			$data->estadoVictima = $this->_estadosModel->asObject()->where('ESTADOID',  $data->victimaDom->ESTADOID)->first();
			$data->tipoIdentificacionVictima = $this->_tipoIdentificacionModel->asObject()->where('PERSONATIPOIDENTIFICACIONID',   $data->victima[0]['TIPOIDENTIFICACIONID'])->first();
			$data->ocupacionVictima = $this->_ocupacionModel->asObject()->where('PERSONAOCUPACIONID',   $data->victima[0]['OCUPACIONID'])->first();
			$data->nacionalidadVictima = $this->_nacionalidadModel->asObject()->where('PERSONANACIONALIDADID',   $data->victima[0]['NACIONALIDADID'])->first();
			$data->edoCivilVictima = $this->_estadoCivilModel->asObject()->where('PERSONAESTADOCIVILID',   $data->victima[0]['ESTADOCIVILID'])->first();
			$relacionfisfis = $this->_relacionIDOModel->asObject()->where('FOLIOID', $data->folio->FOLIOID)->where('ANO', $data->folio->ANO)->where('PERSONAFISICAIDVICTIMA', $victima)->where('PERSONAFISICAIDIMPUTADO', $imputado)->first();

			if ($relacionfisfis != null) {
				$data->relacion_delitodescr = $this->_delitoModalidadModel->asObject()->where('DELITOMODALIDADID', $relacionfisfis->DELITOMODALIDADID)->first();
				$data->plantilla = str_replace('[DELITO]',  $data->relacion_delitodescr->DELITOMODALIDADDESCR ?  $data->relacion_delitodescr->DELITOMODALIDADDESCR : '-', $data->plantilla);
				$data->plantilla = str_replace('[NUMERO_DELITO]',  $data->relacion_delitodescr->DELITOMODALIDADARTICULO  ?  $data->relacion_delitodescr->DELITOMODALIDADARTICULO : '-', $data->plantilla);
				$data->plantilla = str_replace('[RELACION_DELITO]',  $data->relacion_delitodescr->DELITOMODALIDADDESCR ?  $data->relacion_delitodescr->DELITOMODALIDADDESCR : '-', $data->plantilla);
				$data->plantilla = str_replace('[</span>RELACION_DELITO]',  $data->relacion_delitodescr->DELITOMODALIDADDESCR ?  $data->relacion_delitodescr->DELITOMODALIDADDESCR : '-', $data->plantilla);
				$data->plantilla = str_replace('[DELITO_NOMBRE]',  $data->relacion_delitodescr->DELITOMODALIDADDESCR ?  $data->relacion_delitodescr->DELITOMODALIDADDESCR : '-', $data->plantilla);
				$data->plantilla = str_replace('[NUMERO_CODIGO_PENAL]', ($data->relacion_delitodescr->DELITOMODALIDADARTICULO ?  $data->relacion_delitodescr->DELITOMODALIDADARTICULO : '-'), $data->plantilla);
			}
			// CARTA DERIVACION
			if ($data->derivacion) {
				$data->plantilla = str_replace('[FOLIO_ATENCION]', $folio . '/' . $year, $data->plantilla);
				$data->plantilla = str_replace('[DENUNCIANTE_NOMBRE]', $data->denunciantes->NOMBRE . ' ' . ($data->denunciantes->APELLIDO_PATERNO ? $data->denunciantes->APELLIDO_PATERNO : '') . ' ' . ($data->denunciantes->APELLIDO_MATERNO ? $data->denunciantes->APELLIDO_MATERNO : ''), $data->plantilla);
				$data->plantilla = str_replace('[OFICINA_NOMBRE]', $data->derivacion->INSTITUCIONREMISIONDESCR, $data->plantilla);
				$data->plantilla = str_replace('[OFICINA_DOMICILIO]', $data->derivacion->DOMICILIO, $data->plantilla);
			} else if ($data->canalizacion) {
				$data->plantilla = str_replace('[FOLIO_ATENCION]', $folio . '/' . $year, $data->plantilla);
				$data->plantilla = str_replace('[DENUNCIANTE_NOMBRE]', $data->denunciantes->NOMBRE . ' ' . ($data->denunciantes->APELLIDO_PATERNO ? $data->denunciantes->APELLIDO_PATERNO : '') . ' ' . ($data->denunciantes->APELLIDO_MATERNO ? $data->denunciantes->APELLIDO_MATERNO : ''), $data->plantilla);
				$data->plantilla = str_replace('[OFICINA_NOMBRE]', $data->canalizacion->INSTITUCIONREMISIONDESCR, $data->plantilla);
				$data->plantilla = str_replace('[OFICINA_DOMICILIO]', $data->canalizacion->DOMICILIO, $data->plantilla);
			}


			$data->plantilla = str_replace('[DOCUMENTO_FECHA]', date('d') . ' DE ' . $meses[date('n') - 1] . " DEL " . date('Y'), $data->plantilla);


			$data->plantilla = str_replace('[EXPEDIENTE_NUMERO]', $folio, $data->plantilla);
			$data->plantilla = str_replace('[DOCUMENTO_MUNICIPIO]', $data->municipios->MUNICIPIODESCR, $data->plantilla);
			$data->plantilla = str_replace('[DOCUMENTO_CIUDAD]', $data->municipios->MUNICIPIODESCR, $data->plantilla);
			$data->plantilla = str_replace('DOCUMENTO_MUNICIPIO', $data->municipios->MUNICIPIODESCR, $data->plantilla);
			$data->plantilla = str_replace('[VICTIMA]', $data->victima[0]['NOMBRE'] . ' ' . ($data->victima[0]['PRIMERAPELLIDO'] ? $data->victima[0]['PRIMERAPELLIDO'] : '') . ' ' . ($data->victima[0]['SEGUNDOAPELLIDO'] ? $data->victima[0]['SEGUNDOAPELLIDO'] : ''), $data->plantilla);
			$data->plantilla = str_replace('[VICTIMA_NOMBRE]', $data->victima[0]['NOMBRE'] . ' ' . ($data->victima[0]['PRIMERAPELLIDO'] ? $data->victima[0]['PRIMERAPELLIDO'] : '') . ' ' . ($data->victima[0]['SEGUNDOAPELLIDO'] ? $data->victima[0]['SEGUNDOAPELLIDO'] : ''), $data->plantilla);
			$data->plantilla = str_replace('[</span>VICTIMA_NOMBRE]', $data->victima[0]['NOMBRE'] . ' ' . ($data->victima[0]['PRIMERAPELLIDO'] ? $data->victima[0]['PRIMERAPELLIDO'] : '') . ' ' . ($data->victima[0]['SEGUNDOAPELLIDO'] ? $data->victima[0]['SEGUNDOAPELLIDO'] : ''), $data->plantilla);
			$data->plantilla = str_replace('[VICTIMAS_NOMBRE]', $data->victima[0]['NOMBRE'] . ' ' . ($data->victima[0]['PRIMERAPELLIDO'] ? $data->victima[0]['PRIMERAPELLIDO'] : '') . ' ' . ($data->victima[0]['SEGUNDOAPELLIDO'] ? $data->victima[0]['SEGUNDOAPELLIDO'] : ''), $data->plantilla);
			$data->plantilla = str_replace('[VICTIMA_EDAD]', $data->victima[0]['EDADCANTIDAD'] ? $data->victima[0]['EDADCANTIDAD'] : '-', $data->plantilla);
			$data->plantilla = str_replace('[VICTIMA_TELEFONO]', $data->victima[0]['TELEFONO'] ? $data->victima[0]['TELEFONO'] : '-', $data->plantilla);
			$data->plantilla = str_replace('[VICTIMA_CORREO]', $data->victima[0]['CORREO'] ? $data->victima[0]['CORREO'] : '-', $data->plantilla);
			$data->plantilla = str_replace('[VICTIMA_SEXO]', $data->victima[0]['SEXO'] ? ($data->victima[0]['SEXO'] == 'F' ? 'FEMENINO' : 'MASCULINO') : '-', $data->plantilla);
			$data->plantilla = str_replace('[</span>VICTIMA_TELEFONO]', $data->victima[0]['TELEFONO'] ? $data->victima[0]['TELEFONO'] : '-', $data->plantilla);
			$data->plantilla = str_replace('[PERSONA]', $data->imputado->NOMBRE . ' ' . ($data->imputado->PRIMERAPELLIDO ? $data->imputado->PRIMERAPELLIDO : '') . ' ' . ($data->imputado->SEGUNDOAPELLIDO ? $data->imputado->SEGUNDOAPELLIDO : ''), $data->plantilla);
			$data->plantilla = str_replace('[IMPUTADO_NOMBRE]', $data->imputado->NOMBRE . ' ' . ($data->imputado->PRIMERAPELLIDO ? $data->imputado->PRIMERAPELLIDO : '') . ' ' . ($data->imputado->SEGUNDOAPELLIDO ? $data->imputado->SEGUNDOAPELLIDO : ''), $data->plantilla);
			$data->plantilla = str_replace('[IMPUTADO_EDAD]', $data->imputado->EDADCANTIDAD ? $data->imputado->EDADCANTIDAD : '-', $data->plantilla);
			$data->plantilla = str_replace('[DIA]', date('d'), $data->plantilla);
			$data->plantilla = str_replace('[MES]', $meses[date('n') - 1], $data->plantilla);
			$data->plantilla = str_replace('[ANO]', date('Y'), $data->plantilla);
			$data->plantilla = str_replace('[HORA]', date('H'), $data->plantilla);
			$data->plantilla = str_replace('[MINUTOS]', date('i'), $data->plantilla);
			$data->plantilla = str_replace('[ESTADO]', $data->municipios->MUNICIPIODESCR, $data->plantilla);
			$data->plantilla = str_replace('[HECHO]', $data->folio->HECHONARRACION ? $data->folio->HECHONARRACION : 'SIN NARRACIÓN', $data->plantilla);
			$data->plantilla = str_replace('[HECHO_LUGAR]', $data->lugar_hecho->HECHODESCR ? $data->lugar_hecho->HECHODESCR : '-', $data->plantilla);
			$data->plantilla = str_replace('[HECHO_FECHA]', $data->folio->HECHOFECHA ? $data->folio->HECHOFECHA : '-', $data->plantilla);
			$data->plantilla = str_replace('[HECHO_HORA]', $data->folio->HECHOHORA ? $data->folio->HECHOHORA : '-', $data->plantilla);
			$data->plantilla = str_replace('[DETALLE_INTERVENCIONES]', $data->folio->HECHONARRACION ? $data->folio->HECHONARRACION : 'SIN NARRACIÓN', $data->plantilla);
			$data->plantilla = str_replace('[HECHO_NARRACION]', $data->folio->HECHONARRACION ? $data->folio->HECHONARRACION : 'SIN NARRACIÓN', $data->plantilla);
			$data->plantilla = str_replace('[ZONA_SEJAP]',  'CENTRO DE DENUNCIA TECNOLÓGICA', $data->plantilla);
			$data->plantilla = str_replace('[VICTIMA_DOMICILIO]', 'en la calle: ' . $data->victimaDom->CALLE . ' en la colonia: ' . $data->victimaDom->COLONIADESCR, $data->plantilla);
			$data->plantilla = str_replace('[VICTIMA_DOMICILIO_COMPLETO]', ($data->victimaDom->CALLE ? $data->victimaDom->CALLE : 'DESCONOCIDO') . ' EXT. ' . ($data->victimaDom->NUMEROCASA ? $data->victimaDom->NUMEROCASA : '') . ' INT. ' . ($data->victimaDom->NUMEROINTERIOR ? $data->victimaDom->NUMEROINTERIOR : '') . ' ' . $data->victimaDom->COLONIADESCR, $data->plantilla);
			$data->plantilla = str_replace('[VICTIMA_TIPO_IDENTIFICACION]', isset($data->tipoIdentificacionVictima) == true ? $data->tipoIdentificacionVictima->PERSONATIPOIDENTIFICACIONDESCR : 'SIN TIPO DE IDENTIFICACIÓN', $data->plantilla);
			$data->plantilla = str_replace('[VICTIMA_NUMERO_IDENTIFICACION]', $data->victima[0]['NUMEROIDENTIFICACION'] ? $data->victima[0]['NUMEROIDENTIFICACION'] : 'SIN NÚMERO DE IDENTIFICACIÓN', $data->plantilla);
			$data->plantilla = str_replace('[VICTIMA_TELEFONO_CELULAR]', $data->victima[0]['TELEFONO'] ? $data->victima[0]['TELEFONO'] : 'SIN TELEFONO REGISTRADO', $data->plantilla);
			$data->plantilla = str_replace('[VICTIMA_OCUPACION]', isset($data->ocupacionVictima) == true ? $data->ocupacionVictima->PERSONAOCUPACIONDESCR : 'SIN OCUPACIÓN REGISTRADA', $data->plantilla);
			$data->plantilla = str_replace('[VICTIMA_NACIONALIDAD]', isset($data->nacionalidadVictima) == true ? $data->nacionalidadVictima->PERSONANACIONALIDADDESCR : 'SIN NACIONALIDAD REGISTRADA', $data->plantilla);
			$data->plantilla = str_replace('[VICTIMA_ESTADO_CIVIL]', isset($data->edoCivilVictima) == true ? $data->edoCivilVictima->PERSONAESTADOCIVILDESCR : 'SIN ESTADO CIVIL', $data->plantilla);

			$hecho_info = '<p><b>FOLIO:</b> ' . $data->folio->FOLIOID . '</p><p><b>AÑO:</b> ' . $data->folio->ANO . '</p><p><b>FECHA DEL HECHO:</b> ' . $data->folio->HECHOFECHA . '</p><p><b>HORA DEL HECHO:</b> ' . $data->folio->HECHOHORA . '</p><p><b>CALLE DEL HECHO:</b> ' . $data->folio->HECHOCALLE . ' EXT.' . $data->folio->HECHONUMEROCASA . ' INT.' . $data->folio->HECHONUMEROCASAINT . ' ' . $data->municipios->MUNICIPIODESCR . '</p><p><b>NARRACIÓN DEL HECHO:</b> ' . $data->folio->HECHONARRACION . '</p><p><b>NOTAS DEL AGENTE:</b> ' . $data->folio->NOTASAGENTE . '</p>';

			$data->plantilla = str_replace('[INFORMACION_DEL_HECHO]', $hecho_info, $data->plantilla);
			if ($data->plantilla) {
				return json_encode(['status' => 1, 'plantilla' => $data->plantilla]);
			} else {
				$data = (object)['status' => 0];
				return json_encode($data);
			}
		}
		if (empty($expediente) || empty($year) || empty($titulo) || empty($victima) || empty($imputado)) {
			return json_encode((object)['status' => 0]);
		} else {

			$data = (object) array();
			$data->expediente = $this->_folioModel->asObject()->where('ANO', $year)->where('EXPEDIENTEID', $expediente)->first();
			$data->estado = $this->_estadosModel->asObject()->where('ESTADOID', $data->expediente->ESTADOID)->first();
			$data->plantilla = $this->_plantillasModel->where('TITULO', $titulo)->first();
			$data->folioDoc = $this->_folioDocModel->get_by_expediente($expediente, $data->expediente->ANO);
			$data->tipoExpediente = $this->_tipoExpedienteModel->asObject()->where('TIPOEXPEDIENTEID',  $data->expediente->TIPOEXPEDIENTEID)->first();
			$data->lugar_hecho = $data->expediente->HECHOLUGARID ? $this->_hechoLugarModel->asObject()->where('HECHOLUGARID', $data->expediente->HECHOLUGARID)->first() : (object)['HECHOLUGARDESCR' => 'NO ESPECIFICADO'];

			$data->municipios = $this->_municipiosModel->asObject()->where('ESTADOID', '2')->where('MUNICIPIOID',  $data->expediente->MUNICIPIOID)->first();
			$data->victima = $this->_folioPersonaFisicaModel->get_by_personas($data->expediente->FOLIOID, $data->expediente->ANO, $victima);
			$data->imputado = $this->_folioPersonaFisicaModel->asObject()->where('FOLIOID', $data->expediente->FOLIOID)->where('ANO', $data->expediente->ANO)->where('PERSONAFISICAID', $imputado)->first();
			$data->victimaDom = $this->_folioPersonaFisicaDomicilioModel->asObject()->where('FOLIOID', $data->expediente->FOLIOID)->where('ANO', $data->expediente->ANO)->where('PERSONAFISICAID', $victima)->first();
			$data->estadoVictima = $this->_estadosModel->asObject()->where('ESTADOID',  $data->victimaDom->ESTADOID)->first();
			$data->tipoIdentificacionVictima = $this->_tipoIdentificacionModel->asObject()->where('PERSONATIPOIDENTIFICACIONID',   $data->victima[0]['TIPOIDENTIFICACIONID'])->first();
			$data->ocupacionVictima = $this->_ocupacionModel->asObject()->where('PERSONAOCUPACIONID',   $data->victima[0]['OCUPACIONID'])->first();
			$data->nacionalidadVictima = $this->_nacionalidadModel->asObject()->where('PERSONANACIONALIDADID',   $data->victima[0]['NACIONALIDADID'])->first();
			$data->edoCivilVictima = $this->_estadoCivilModel->asObject()->where('PERSONAESTADOCIVILID',   $data->victima[0]['ESTADOCIVILID'])->first();
			$relacionfisfis = $this->_relacionIDOModel->asObject()->where('FOLIOID', $data->expediente->FOLIOID)->where('ANO', $data->expediente->ANO)->where('PERSONAFISICAIDVICTIMA', $victima)->where('PERSONAFISICAIDIMPUTADO', $imputado)->first();

			if ($relacionfisfis != null) {
				$data->relacion_delitodescr = $this->_delitoModalidadModel->asObject()->where('DELITOMODALIDADID', $relacionfisfis->DELITOMODALIDADID)->first();
				$data->plantilla = str_replace('[DELITO]',  $data->relacion_delitodescr->DELITOMODALIDADDESCR ?  $data->relacion_delitodescr->DELITOMODALIDADDESCR : '-', $data->plantilla);
				$data->plantilla = str_replace('[NUMERO_DELITO]',  $data->relacion_delitodescr->DELITOMODALIDADARTICULO  ?  $data->relacion_delitodescr->DELITOMODALIDADARTICULO : '-', $data->plantilla);
				$data->plantilla = str_replace('[RELACION_DELITO]',  $data->relacion_delitodescr->DELITOMODALIDADDESCR ?  $data->relacion_delitodescr->DELITOMODALIDADDESCR : '-', $data->plantilla);
				$data->plantilla = str_replace('[</span>RELACION_DELITO]',  $data->relacion_delitodescr->DELITOMODALIDADDESCR ?  $data->relacion_delitodescr->DELITOMODALIDADDESCR : '-', $data->plantilla);
				$data->plantilla = str_replace('[DELITO_NOMBRE]',  $data->relacion_delitodescr->DELITOMODALIDADDESCR ?  $data->relacion_delitodescr->DELITOMODALIDADDESCR : '-', $data->plantilla);
				$data->plantilla = str_replace('[NUMERO_CODIGO_PENAL]', ($data->relacion_delitodescr->DELITOMODALIDADARTICULO ?  $data->relacion_delitodescr->DELITOMODALIDADARTICULO : '-'), $data->plantilla);
			}

			// if (empty($data->folioDoc) || empty($data->folioDoc[0]['RAZONSOCIALFIRMA'])) {
			// } else {
			// 	$data->plantilla = str_replace('[EXPEDIENTE_NOMBRE_DEL_RESPONSABLE]', $data->folioDoc[0]['RAZONSOCIALFIRMA'], $data->plantilla);
			// 	$data->plantilla = str_replace('EXPEDIENTE_NOMBRE_DEL_RESPONSABLE', $data->folioDoc[0]['RAZONSOCIALFIRMA'], $data->plantilla);
			// 	$data->plantilla = str_replace('[NOMBRE_LICENCIADO]', $data->folioDoc[0]['RAZONSOCIALFIRMA'], $data->plantilla);
			// 	$data->plantilla = str_replace('[EXPEDIENTE_NOMBRE_MP_RESPONSABLE]', $data->folioDoc[0]['RAZONSOCIALFIRMA'], $data->plantilla);
			// }

			$arrayExpediente = str_split($data->expediente->EXPEDIENTEID);
			$expedienteConsecutivo = $arrayExpediente[10] . $arrayExpediente[11] . $arrayExpediente[12] . $arrayExpediente[13] . $arrayExpediente[14];
			$expedienteConsecutivo = str_split($expedienteConsecutivo);

			unset($arrayExpediente[0]);

			$expedienteMunicipioEstado = $arrayExpediente[1] . $arrayExpediente[2] . '-' . $arrayExpediente[3] . $arrayExpediente[4] . $arrayExpediente[5];
			$expedienteYear = $arrayExpediente[6] . $arrayExpediente[7] . $arrayExpediente[8] . $arrayExpediente[9];
			$expedienteid = $expedienteMunicipioEstado . '-' . $expedienteYear . '-' . implode($expedienteConsecutivo);

			$data->plantilla = str_replace('[DOCUMENTO_FECHA]', date('d') . ' DE ' . $meses[date('n') - 1] . " DEL " . date('Y'), $data->plantilla);
			$data->plantilla = str_replace('[EXPEDIENTE_NUMERO]', $expedienteid, $data->plantilla);
			$data->plantilla = str_replace('[DOCUMENTO_MUNICIPIO]', $data->municipios->MUNICIPIODESCR, $data->plantilla);
			$data->plantilla = str_replace('[DOCUMENTO_CIUDAD]', $data->municipios->MUNICIPIODESCR, $data->plantilla);
			$data->plantilla = str_replace('DOCUMENTO_MUNICIPIO', $data->municipios->MUNICIPIODESCR, $data->plantilla);
			$data->plantilla = str_replace('[VICTIMA]', $data->victima[0]['NOMBRE'] . ' ' . ($data->victima[0]['PRIMERAPELLIDO'] ? $data->victima[0]['PRIMERAPELLIDO'] : '') . ' ' . ($data->victima[0]['SEGUNDOAPELLIDO'] ? $data->victima[0]['SEGUNDOAPELLIDO'] : ''), $data->plantilla);
			$data->plantilla = str_replace('[VICTIMA_NOMBRE]', $data->victima[0]['NOMBRE'] . ' ' . ($data->victima[0]['PRIMERAPELLIDO'] ? $data->victima[0]['PRIMERAPELLIDO'] : '') . ' ' . ($data->victima[0]['SEGUNDOAPELLIDO'] ? $data->victima[0]['SEGUNDOAPELLIDO'] : ''), $data->plantilla);
			$data->plantilla = str_replace('[</span>VICTIMA_NOMBRE]', $data->victima[0]['NOMBRE'] . ' ' . ($data->victima[0]['PRIMERAPELLIDO'] ? $data->victima[0]['PRIMERAPELLIDO'] : '') . ' ' . ($data->victima[0]['SEGUNDOAPELLIDO'] ? $data->victima[0]['SEGUNDOAPELLIDO'] : ''), $data->plantilla);
			$data->plantilla = str_replace('[VICTIMAS_NOMBRE]', $data->victima[0]['NOMBRE'] . ' ' . ($data->victima[0]['PRIMERAPELLIDO'] ? $data->victima[0]['PRIMERAPELLIDO'] : '') . ' ' . ($data->victima[0]['SEGUNDOAPELLIDO'] ? $data->victima[0]['SEGUNDOAPELLIDO'] : ''), $data->plantilla);
			$data->plantilla = str_replace('[VICTIMA_EDAD]', $data->victima[0]['EDADCANTIDAD'] ? $data->victima[0]['EDADCANTIDAD'] : '-', $data->plantilla);
			$data->plantilla = str_replace('[VICTIMA_TELEFONO]', $data->victima[0]['TELEFONO'] ? $data->victima[0]['TELEFONO'] : '-', $data->plantilla);
			$data->plantilla = str_replace('[VICTIMA_CORREO]', $data->victima[0]['CORREO'] ? $data->victima[0]['CORREO'] : '-', $data->plantilla);
			$data->plantilla = str_replace('[VICTIMA_SEXO]', $data->victima[0]['SEXO'] ? ($data->victima[0]['SEXO'] == 'F' ? 'FEMENINO' : 'MASCULINO') : '-', $data->plantilla);
			$data->plantilla = str_replace('[</span>VICTIMA_TELEFONO]', $data->victima[0]['TELEFONO'] ? $data->victima[0]['TELEFONO'] : '-', $data->plantilla);
			$data->plantilla = str_replace('[PERSONA]', $data->imputado->NOMBRE . ' ' . ($data->imputado->PRIMERAPELLIDO ? $data->imputado->PRIMERAPELLIDO : '') . ' ' . ($data->imputado->SEGUNDOAPELLIDO ? $data->imputado->SEGUNDOAPELLIDO : ''), $data->plantilla);
			$data->plantilla = str_replace('[IMPUTADO_NOMBRE]', $data->imputado->NOMBRE . ' ' . ($data->imputado->PRIMERAPELLIDO ? $data->imputado->PRIMERAPELLIDO : '') . ' ' . ($data->imputado->SEGUNDOAPELLIDO ? $data->imputado->SEGUNDOAPELLIDO : ''), $data->plantilla);
			$data->plantilla = str_replace('[IMPUTADO_EDAD]', $data->imputado->EDADCANTIDAD ? $data->imputado->EDADCANTIDAD : '-', $data->plantilla);
			$data->plantilla = str_replace('[DIA]', date('d'), $data->plantilla);
			$data->plantilla = str_replace('[MES]', $meses[date('n') - 1], $data->plantilla);
			$data->plantilla = str_replace('[ANO]', date('Y'), $data->plantilla);
			$data->plantilla = str_replace('[HORA]', date('H'), $data->plantilla);
			$data->plantilla = str_replace('[MINUTOS]', date('i'), $data->plantilla);
			$data->plantilla = str_replace('[ESTADO]', $data->municipios->MUNICIPIODESCR, $data->plantilla);
			$data->plantilla = str_replace('[HECHO]', $data->expediente->HECHONARRACION ? $data->expediente->HECHONARRACION : 'SIN NARRACIÓN', $data->plantilla);
			$data->plantilla = str_replace('[HECHO_LUGAR]', $data->lugar_hecho->HECHODESCR ? $data->lugar_hecho->HECHODESCR : '-', $data->plantilla);
			$data->plantilla = str_replace('[HECHO_FECHA]', $data->expediente->HECHOFECHA ? $data->expediente->HECHOFECHA : '-', $data->plantilla);
			$data->plantilla = str_replace('[HECHO_HORA]', $data->expediente->HECHOHORA ? $data->expediente->HECHOHORA : '-', $data->plantilla);
			$data->plantilla = str_replace('[DETALLE_INTERVENCIONES]', $data->expediente->HECHONARRACION ? $data->expediente->HECHONARRACION : 'SIN NARRACIÓN', $data->plantilla);
			$data->plantilla = str_replace('[HECHO_NARRACION]', $data->expediente->HECHONARRACION ? $data->expediente->HECHONARRACION : 'SIN NARRACIÓN', $data->plantilla);
			$data->plantilla = str_replace('[TIPO_EXPEDIENTE]',  $data->tipoExpediente->TIPOEXPEDIENTECLAVE, $data->plantilla);
			$data->plantilla = str_replace('[ZONA_SEJAP]',  'CENTRO DE DENUNCIA TECNOLÓGICA', $data->plantilla);
			$data->plantilla = str_replace('[VICTIMA_DOMICILIO]', 'en la calle: ' . $data->victimaDom->CALLE . ' en la colonia: ' . $data->victimaDom->COLONIADESCR, $data->plantilla);
			$data->plantilla = str_replace('[VICTIMA_DOMICILIO_COMPLETO]', ($data->victimaDom->CALLE ? $data->victimaDom->CALLE : 'DESCONOCIDO') . ' EXT. ' . ($data->victimaDom->NUMEROCASA ? $data->victimaDom->NUMEROCASA : '') . ' INT. ' . ($data->victimaDom->NUMEROINTERIOR ? $data->victimaDom->NUMEROINTERIOR : '') . ' ' . $data->victimaDom->COLONIADESCR, $data->plantilla);
			$data->plantilla = str_replace('[VICTIMA_TIPO_IDENTIFICACION]', isset($data->tipoIdentificacionVictima) == true ? $data->tipoIdentificacionVictima->PERSONATIPOIDENTIFICACIONDESCR : 'SIN TIPO DE IDENTIFICACIÓN', $data->plantilla);
			$data->plantilla = str_replace('[VICTIMA_NUMERO_IDENTIFICACION]', $data->victima[0]['NUMEROIDENTIFICACION'] ? $data->victima[0]['NUMEROIDENTIFICACION'] : 'SIN NÚMERO DE IDENTIFICACIÓN', $data->plantilla);
			$data->plantilla = str_replace('[VICTIMA_TELEFONO_CELULAR]', $data->victima[0]['TELEFONO'] ? $data->victima[0]['TELEFONO'] : 'SIN TELEFONO REGISTRADO', $data->plantilla);
			$data->plantilla = str_replace('[VICTIMA_OCUPACION]', isset($data->ocupacionVictima) == true ? $data->ocupacionVictima->PERSONAOCUPACIONDESCR : 'SIN OCUPACIÓN REGISTRADA', $data->plantilla);
			$data->plantilla = str_replace('[VICTIMA_NACIONALIDAD]', isset($data->nacionalidadVictima) == true ? $data->nacionalidadVictima->PERSONANACIONALIDADDESCR : 'SIN NACIONALIDAD REGISTRADA', $data->plantilla);
			$data->plantilla = str_replace('[VICTIMA_ESTADO_CIVIL]', isset($data->edoCivilVictima) == true ? $data->edoCivilVictima->PERSONAESTADOCIVILDESCR : 'SIN ESTADO CIVIL', $data->plantilla);

			switch ($data->expediente->MUNICIPIOASIGNADOID) {
				case '1':
					$data->plantilla = str_replace('[DIRECCION_NOMBRE]', 'DIRECTOR DE SEGURIDAD PÚBLICA MUNICIPAL', $data->plantilla);
					break;
				case '2':
					$data->plantilla = str_replace('[DIRECCION_NOMBRE]', 'DIRECCIÓN DE SEGURIDAD PÚBLICA MUNICIPAL', $data->plantilla);
					break;
				case '3':
					$data->plantilla = str_replace('[DIRECCION_NOMBRE]', 'DIRECCIÓN DE SEGURIDAD CIUDADANA Y TRÁNSITO MUNICIPAL', $data->plantilla);
					break;
				case '4':
					$data->plantilla = str_replace('[DIRECCION_NOMBRE]', 'SECRETARIO DE SEGURIDAD Y PROTECCIÓN CIUDADANA MUNICIPAL', $data->plantilla);
					break;
				case '5':
					$data->plantilla = str_replace('[DIRECCION_NOMBRE]', 'SECRETARÍA DE SEGURIDAD Y PROTECCIÓN CIUDADANA', $data->plantilla);
					break;
				default:
					$data->plantilla = str_replace('[DIRECCION_NOMBRE]', 'SEGURIDAD PUBLICA MUNICIPAL', $data->plantilla);
					break;
			}
			$hecho_info = '<p><b>FOLIO:</b> ' . $data->expediente->FOLIOID . '</p><p><b>AÑO:</b> ' . $data->expediente->ANO . '</p><p><b>FECHA DEL HECHO:</b> ' . $data->expediente->HECHOFECHA . '</p><p><b>HORA DEL HECHO:</b> ' . $data->expediente->HECHOHORA . '</p><p><b>CALLE DEL HECHO:</b> ' . $data->expediente->HECHOCALLE . ' EXT.' . $data->expediente->HECHONUMEROCASA . ' INT.' . $data->expediente->HECHONUMEROCASAINT . ' ' . $data->municipios->MUNICIPIODESCR . '</p><p><b>NARRACIÓN DEL HECHO:</b> ' . $data->expediente->HECHONARRACION . '</p><p><b>NOTAS DEL AGENTE:</b> ' . $data->expediente->NOTASAGENTE . '</p>';

			$data->plantilla = str_replace('[INFORMACION_DEL_HECHO]', $hecho_info, $data->plantilla);
			if ($data->plantilla) {
				return json_encode(['status' => 1, 'plantilla' => $data->plantilla]);
			} else {
				$data = (object)['status' => 0];
				return json_encode($data);
			}
		}
	}

	public function insertFolioDoc()
	{

		$expediente = $this->request->getPost('expediente');
		$folio = $this->request->getPost('folio');
		$year = $this->request->getPost('year');
		$placeholder = $this->request->getPost('placeholder');
		$municipio = $this->request->getPost('municipio');

		$plantilla = $this->_plantillasModel->where('TITULO', $this->request->getPost('titulo'))->first();
		$folioRow = $this->_folioModel->where('ANO', $year)->where('FOLIOID', $folio)->first();

		if ($folioRow) {
			$clasificaciondoctoid = '';

			switch ($municipio) {
				case '1':
					$clasificaciondoctoid = $plantilla['CLASIFICACIONDOCTOENSENADAID'];
					break;
				case '2':
					$clasificaciondoctoid = $plantilla['CLASIFICACIONDOCTOMEXICALIID'];
					break;
				case '3':
					$clasificaciondoctoid = $plantilla['CLASIFICACIONDOCTOMEXICALIID'];
					break;
				case '4':
					$clasificaciondoctoid = $plantilla['CLASIFICACIONDOCTOTIJUANAID'];
					break;
				case '5':
					$clasificaciondoctoid = $plantilla['CLASIFICACIONDOCTOTIJUANAID'];
					break;
				default:
					$clasificaciondoctoid = $plantilla['CLASIFICACIONDOCTOMEXICALIID'];
					break;
			}


			$dataFolioDoc = array(
				'FOLIOID' => $folio,
				'NUMEROEXPEDIENTE' => $expediente ? $expediente : null,
				'ANO' => $year,
				'PLACEHOLDER' => $placeholder,
				'STATUS' => 'ABIERTO',
				'MUNICIPIOID' => $folioRow['MUNICIPIOASIGNADOID'],
				'ESTADOID' => 2,
				'TIPODOC' => $this->request->getPost('titulo'),
				'STATUSENVIO' => $this->request->getPost('statusenvio'),
				'ENVIADO' => 'N',
				'CLASIFICACIONDOCTOID' => $clasificaciondoctoid
			);

			$foliodoc = $this->_folioDoc($dataFolioDoc, $expediente ? $expediente : null, $year);

			if ($foliodoc) {
				$documentos = $this->_folioDocModel->get_by_folio($folio, $year);

				return json_encode(['status' => 1, 'documentos' => $documentos]);
			} else {
				return json_encode(['status' => 0]);
			}
		} else {
			return json_encode(['status' => 0]);
		}
	}

	private function _folioDoc($data, $expediente, $year)
	{
		$data = $data;
		$data['NUMEROEXPEDIENTE'] = $expediente;
		$data['ANO'] = $year;

		$foliodoc = $this->_folioDocModel->asObject()->where('NUMEROEXPEDIENTE', $expediente)->where('ANO', $year)->orderBy('FOLIODOCID', 'desc')->first();

		if ($foliodoc) {
			$data['FOLIODOCID'] = ((int) $foliodoc->FOLIODOCID) + 1;
			$foliodoc = $this->_folioDocModel->insert($data);
			return $data['FOLIODOCID'];
		} else {
			$data['FOLIODOCID'] = 1;
			$foliodoc = $this->_folioDocModel->insert($data);
			return $data['FOLIODOCID'];
		}
	}

	public function updateDocumentoByFolio()
	{
		try {
			$docid = trim($this->request->getPost('foliodocid'));
			$folio = trim($this->request->getPost('folio'));
			$year = trim($this->request->getPost('year'));
			$placeholder = $this->request->getPost('placeholder');
			$dataDocumento = array(
				'PLACEHOLDER' => $placeholder,

			);

			$updateDocumento = $this->_folioDocModel->set($dataDocumento)->where('FOLIOID', $folio)->where('ANO', $year)->where('FOLIODOCID', $docid)->update();

			if ($updateDocumento) {
				$documentos = $this->_folioDocModel->get_by_folio($folio, $year);

				$datosBitacora = [
					'ACCION' => 'Ha actualizado el documento',
					'NOTAS' => 'FOLIO: ' . $folio . ' AÑO: ' . $year,
				];

				$this->_bitacoraActividad($datosBitacora);

				return json_encode(['status' => 1, 'documentos' => $documentos]);
			} else {
				return json_encode(['status' => 0, 'message' => $updateDocumento]);
			}
		} catch (\Exception $e) {
			return json_encode(['status' => 0]);
		}
	}

	public function getDocumentoById()
	{
		$docid = trim($this->request->getPost('docid'));
		$folio = trim($this->request->getPost('folio'));
		$year = trim($this->request->getPost('year'));

		$data = (object) array();
		$data->documento = $this->_folioDocModel->get_folio_by_first($folio, $year, $docid);

		if ($data->documento) {
			$documentos = $this->_folioDocModel->get_by_folio($folio, $year);

			$data->status = 1;
			return json_encode(['status' => 1, 'documentos' => $documentos, 'documentoporid' => $data->documento]);
		} else {
			return json_encode(['status' => 0]);
		}
	}

	public function getFolioDenunciante()
	{
		$folio = trim($this->request->getPost('folio'));
		$year = trim($this->request->getPost('year'));
		$data = (object) array();
		$data->folioDenunciante = $this->_folioModel->asObject()->where('FOLIOID', $folio)->where('ANO', $year)->first();

		if ($data->folioDenunciante) {
			return json_encode(['status' => 1, 'folioDenunciante' => $data->folioDenunciante]);
		} else {
			return json_encode(['status' => 0]);
		}
	}

	private function _bitacoraActividad($data)
	{
		$data = $data;
		$data['ID'] = uniqid();
		$data['USUARIOID'] = session('ID');

		$this->_bitacoraActividadModel->insert($data);
	}

	private function _encriptar($plaintext, $key128)
	{
		$iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length('aes-128-cbc'));
		$cipherText = openssl_encrypt($plaintext, 'AES-128-CBC', hex2bin($key128), 1, $iv);
		return base64_encode($iv . $cipherText);
	}

	private function _desencriptar($encodedInitialData, $key128)
	{
		$encodedInitialData = base64_decode($encodedInitialData);
		$iv = substr($encodedInitialData, 0, 16);
		$encodedInitialData = substr($encodedInitialData, 16);
		$decrypted = openssl_decrypt($encodedInitialData, 'AES-128-CBC', hex2bin($key128), 1, $iv);
		return $decrypted;
	}

	private function permisos($permiso)
	{
		return in_array($permiso, session('permisos'));
	}

	public function crearFolioDenunciaAnonima()
	{

		list($FOLIOID, $year) = $this->_folioConsecutivoModel->get_consecutivo();
		$dataFolio = [
			'FOLIOID' => $FOLIOID,
			'DENUNCIANTEID' => 1,
			'ANO' => $year,
			'HECHOFECHA' => $this->request->getPost('fecha_delito'),
			'HECHOHORA' => $this->request->getPost('hora_delito'),
			'HECHOLUGARID' => $this->request->getPost('lugar_delito'),
			'ESTADOID' => 2,
			'MUNICIPIOID' => $this->request->getPost('municipio_delito'),
			'HECHOESTADOID' => 2,
			'HECHOMUNICIPIOID' => $this->request->getPost('municipio_delito'),
			'HECHOLOCALIDADID' => $this->request->getPost('localidad_delito'),
			'HECHOCOLONIAID' => $this->request->getPost('colonia_delito_select'),
			'HECHOCOLONIADESCR' => $this->request->getPost('colonia_delito'),
			'HECHOCALLE' => $this->request->getPost('calle_delito'),
			'HECHONUMEROCASA' => $this->request->getPost('exterior_delito'),
			'HECHONUMEROCASAINT' => $this->request->getPost('interior_delito'),
			'HECHONARRACION' => $this->request->getPost('narracion_delito'),
			// 'HECHODELITO' => $this->request->getPost('delito_cometido'),
			'HECHOREFERENCIA' => $this->request->getPost('referencia_delito'),
			'AGENTEATENCIONID' => session('ID'),
			'TIPODENUNCIA' => 'DA',
			'STATUS' => 'EN PROCESO',
		];

		$colonia = $this->_coloniasModel->asObject()->where('ESTADOID', 2)->where('MUNICIPIOID', $this->request->getPost('municipio_delito'))->where('LOCALIDADID', $this->request->getPost('localidad_delito'))->where('COLONIAID', $this->request->getPost('colonia_delito_select'))->first();

		if ((int) $this->request->getPost('colonia_delito_select') == 0) {
			$dataFolio['HECHOCOLONIAID'] = null;
			$dataFolio['HECHOCOLONIADESCR'] = $this->request->getPost('colonia_delito');
			$localidad = $this->_localidadesModel->asObject()->where('ESTADOID', 2)->where('MUNICIPIOID', $dataFolio['HECHOMUNICIPIOID'])->where('LOCALIDADID', $dataFolio['HECHOLOCALIDADID'])->first();
			$dataFolio['HECHOZONA'] = $localidad->ZONA;
		} else {
			$dataFolio['HECHOCOLONIAID'] = (int) $this->request->getPost('colonia_delito_select');
			$dataFolio['HECHOCOLONIADESCR'] = $colonia->COLONIADESCR;
			$dataFolio['HECHOZONA'] = $colonia->ZONA;
		}
		if ($this->_folioModel->save($dataFolio)) {
			return json_encode(['status' => 1, 'folio' => $FOLIOID, 'year' => $year]);
		} else {
			return json_encode(['status' => 1]);
		}
	}

	public function videos_expediente()
	{
		$data = (object) array();
		$data->folio = $this->_folioModel->asObject()->where('EXPEDIENTEID !=', null)->where('AGENTEATENCIONID !=', null)->where('FOLIO.TIPOEXPEDIENTEID !=', null)->where('AGENTEFIRMAID !=', null)->where('TIPODENUNCIA', 'VD')->join('USUARIOS', 'USUARIOS.ID = FOLIO.AGENTEATENCIONID', 'left')->join('ROLES', 'ROLES.ID = USUARIOS.ROLID', 'left')->join('TIPOEXPEDIENTE', 'TIPOEXPEDIENTE.TIPOEXPEDIENTEID = FOLIO.TIPOEXPEDIENTEID', 'left')->findAll();
		$data->rolPermiso = $this->_rolesPermisosModel->asObject()->where('ROLID', session('ROLID'))->findAll();

		$this->_loadView('Videos expediente', 'videos', '', $data, 'videos_expediente');
	}

	private function _folioVehiculo($data, $folio, $year)
	{
		$data = $data;
		$data['FOLIOID'] = $folio;
		$data['ANO'] = $year;

		$vehiculo = $this->_folioVehiculoModel->asObject()->where('FOLIOID', $folio)->where('ANO', $year)->orderBy('VEHICULOID', 'desc')->first();

		if ($vehiculo) {
			$data['VEHICULOID'] = ((int) $vehiculo->VEHICULOID) + 1;
			$this->_folioVehiculoModel->insert($data);
		} else {
			$data['VEHICULOID'] = 1;
			$this->_folioVehiculoModel->insert($data);
		}
	}
}

/* End of file DashboardController.php */
/* Location: ./app/Controllers/admin/DashboardController.php */
