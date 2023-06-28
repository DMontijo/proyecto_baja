<?php

namespace App\Controllers\admin;

use App\Controllers\BaseController;
use App\Models\FolioModel;
use App\Models\BitacoraActividadModel;

class FoliosController extends BaseController
{

	
	private $_folioModel;
	private $_bitacoraActividadModel;
	private $db_read;
	private $_usuariosModelRead;
	private $_folioModelRead;
	private $_rolesPermisosModelRead;
	private $_municipiosModelRead;
	private $_tipoExpedienteModelRead;
	private $_delitosUsuariosModelRead;
	private $_hechoLugarModelRead;
	private $_estadoCivilModelRead;
	private $_nacionalidadModelRead;
	private $_folioPersonaCalidadJuridicaRead;
	private $_idiomaModelRead;
	private $_paisesModelRead;
	private $_estadosModelRead;
	private $_tipoIdentificacionModelRead;
	private $_escolaridadModelRead;
	private $_ocupacionModelRead;
	private $_coloresVehiculoModelRead;
	private $_tipoVehiculoModelRead;
	private $_figuraModelRead;
	private $_cejaContexturaModelRead;
	private $_caraFormaModelRead;
	private $_caraTamanoModelRead;
	private $_caraTezModelRead;
	private $_orejaLobuloModelRead;
	private $_orejaFomaModelRead;
	private $_orejaTamanoModelRead;
	private $_cabelloColorModelRead;
	private $_cabelloEstiloModelRead;
	private $_cabelloTamanoModelRead;
	private $_cabelloPeculiarModelRead;
	private $_frenteAlturaModelRead;
	private $_frenteAnchuraModelRead;
	private $_frenteFormaModelRead;
	private $_frentePeculiarModelRead;
	private $_cejaColocacionModelRead;
	private $_cejaFormaModelRead;
	private $_cejaTamanoModelRead;
	private $_cejaGrosorModelRead;
	private $_ojoColocacionModelRead;
	private $_ojoFormaModelRead;
	private $_ojoTamanoModelRead;
	private $_ojoColorModelRead;
	private $_ojoPeculiarModelRead;
	private $_narizTipoModelRead;
	private $_narizTamanoModelRead;
	private $_narizBaseModelRead;
	private $_narizPeculiarModelRead;
	private $_bigoteFormaModelRead;
	private $_bigoteTamanoModelRead;
	private $_bigoteGrosorModelRead;
	private $_bigotePeculiarModelRead;
	private $_bocaTamanoModelRead;
	private $_bocaPeculiarModelRead;
	private $_labioGrosorModelRead;
	private $_labioLongitudModelRead;
	private $_labioPeculiarModelRead;
	private $_labioPosicionModelRead;
	private $_dienteTamanoModelRead;
	private $_dienteTipoModelRead;
	private $_dientePeculiarModelRead;
	private $_barbillaFormaModelRead;
	private $_barbillaTamanoModelRead;
	private $_barbillaInclinacionModelRead;
	private $_barbillaPeculiarModelRead;
	private $_barbaTamanoModelRead;
	private $_barbaPeculiarModelRead;
	private $_cuelloTamanoModelRead;
	private $_cuelloGrosorModelRead;
	private $_cuelloPeculiarModelRead;
	private $_hombroPosicionModelRead;
	private $_hombroLongitudModelRead;
	private $_hombroGrosorModelRead;
	private $_estomagoModelRead;
	private $_etniaModelRead;
	private $_parentescoModelRead;
	private $_pielColorModelRead;
	private $_objetoClasificacionModelRead;
	private $_objetoSubclasificacionModelRead;
	private $_tipoMonedaModelRead;
	private $_vehiculoDistribuidorModelRead;
	private $_vehiculoMarcaModelRead;
	private $_vehiculoModeloModelRead;
	private $_vehiculoVersionModelRead;
	private $_vehiculoServicioModelRead;
	private $_estadosExtranjerosRead;
	public function __construct()
	{
		//Conexion de lectura
		$this->db_read = ENVIRONMENT == 'production' ? db_connect('default_read') : db_connect('development_read');

		//Models writer
		$this->_folioModel = new FolioModel();
		$this->_bitacoraActividadModel = new BitacoraActividadModel();

		//Models reader
		$this->_usuariosModelRead = model('UsuariosModel', true, $this->db_read);
		$this->_folioModelRead = model('FolioModel', true, $this->db_read);
		$this->_rolesPermisosModelRead = model('RolesPermisosModel', true, $this->db_read);
		$this->_municipiosModelRead = model('MunicipiosModel', true, $this->db_read);
		$this->_tipoExpedienteModelRead = model('TipoExpedienteModel', true, $this->db_read);
		$this->_delitosUsuariosModelRead = model('DelitosUsuariosModel', true, $this->db_read);
		$this->_hechoLugarModelRead = model('HechoLugarModel', true, $this->db_read);
		$this->_estadoCivilModelRead = model('PersonaEstadoCivilModel', true, $this->db_read);
		$this->_nacionalidadModelRead = model('PersonaNacionalidadModel', true, $this->db_read);
		$this->_folioPersonaCalidadJuridicaRead = model('PersonaCalidadJuridicaModel', true, $this->db_read);
		$this->_idiomaModelRead = model('PersonaIdiomaModel', true, $this->db_read);
		$this->_paisesModelRead = model('PaisesModel', true, $this->db_read);
		$this->_estadosModelRead = model('EstadosModel', true, $this->db_read);
		$this->_tipoIdentificacionModelRead = model('PersonaTipoIdentificacionModel', true, $this->db_read);
		$this->_escolaridadModelRead = model('EscolaridadModel', true, $this->db_read);
		$this->_ocupacionModelRead = model('OcupacionModel', true, $this->db_read);
		$this->_coloresVehiculoModelRead = model('VehiculoColorModel', true, $this->db_read);
		$this->_tipoVehiculoModelRead = model('VehiculoTipoModel', true, $this->db_read);
		$this->_figuraModelRead = model('FiguraModel', true, $this->db_read);
		$this->_cejaContexturaModelRead = model('CejaContexturaModel', true, $this->db_read);
		$this->_caraFormaModelRead = model('CaraFormaModel', true, $this->db_read);
		$this->_caraTamanoModelRead = model('CaraTamanoModel', true, $this->db_read);
		$this->_caraTezModelRead = model('CaraTezModel', true, $this->db_read);
		$this->_orejaLobuloModelRead = model('OrejaLobuloModel', true, $this->db_read);
		$this->_orejaFomaModelRead = model('OrejaFormaModel', true, $this->db_read);
		$this->_orejaTamanoModelRead = model('OrejaTamanoModel', true, $this->db_read);
		$this->_cabelloColorModelRead = model('CabelloColorModel', true, $this->db_read);
		$this->_cabelloEstiloModelRead = model('CabelloEstiloModel', true, $this->db_read);
		$this->_cabelloTamanoModelRead = model('CabelloTamanoModel', true, $this->db_read);
		$this->_cabelloPeculiarModelRead = model('CabelloPeculiarModel', true, $this->db_read);
		$this->_frenteAlturaModelRead = model('FrenteAlturaModel', true, $this->db_read);
		$this->_frenteAnchuraModelRead = model('FrenteAnchuraModel', true, $this->db_read);
		$this->_frenteFormaModelRead = model('FrenteFormaModel', true, $this->db_read);
		$this->_frentePeculiarModelRead = model('FrentePeculiarModel', true, $this->db_read);
		$this->_cejaColocacionModelRead = model('CejaColocacionModel', true, $this->db_read);
		$this->_cejaFormaModelRead = model('CejaFormaModel', true, $this->db_read);
		$this->_cejaTamanoModelRead = model('CejaTamanoModel', true, $this->db_read);
		$this->_cejaGrosorModelRead = model('CejaGrosorModel', true, $this->db_read);
		$this->_ojoColocacionModelRead = model('OjoColocacionModel', true, $this->db_read);
		$this->_ojoFormaModelRead = model('OjoFormaModel', true, $this->db_read);
		$this->_ojoTamanoModelRead = model('OjoTamanoModel', true, $this->db_read);
		$this->_ojoColorModelRead = model('OjoColorModel', true, $this->db_read);
		$this->_ojoPeculiarModelRead = model('OjoPeculiarModel', true, $this->db_read);
		$this->_narizTipoModelRead = model('NarizTipoModel', true, $this->db_read);
		$this->_narizTamanoModelRead = model('NarizTamanoModel', true, $this->db_read);
		$this->_narizBaseModelRead = model('NarizBaseModel', true, $this->db_read);
		$this->_narizPeculiarModelRead = model('NarizPeculiarModel', true, $this->db_read);
		$this->_bigoteFormaModelRead = model('BigoteFormaModel', true, $this->db_read);
		$this->_bigoteTamanoModelRead = model('BigoteTamanoModel', true, $this->db_read);
		$this->_bigoteGrosorModelRead = model('BigoteGrosorModel', true, $this->db_read);
		$this->_bigotePeculiarModelRead = model('BigotePeculiarModel', true, $this->db_read);
		$this->_bocaTamanoModelRead = model('BocaTamanoModel', true, $this->db_read);
		$this->_bocaPeculiarModelRead = model('BocaPeculiarModel', true, $this->db_read);
		$this->_labioGrosorModelRead = model('LabioGrosorModel', true, $this->db_read);
		$this->_labioLongitudModelRead = model('LabioLongitudModel', true, $this->db_read);
		$this->_labioPeculiarModelRead = model('LabioPeculiarModel', true, $this->db_read);
		$this->_labioPosicionModelRead = model('LabioPosicionModel', true, $this->db_read);
		$this->_dienteTamanoModelRead = model('DienteTamanoModel', true, $this->db_read);
		$this->_dienteTipoModelRead = model('DienteTipoModel', true, $this->db_read);
		$this->_dientePeculiarModelRead = model('DientePeculiarModel', true, $this->db_read);
		$this->_barbillaFormaModelRead = model('BarbillaFormaModel', true, $this->db_read);
		$this->_barbillaTamanoModelRead = model('BarbillaTamanoModel', true, $this->db_read);
		$this->_barbillaInclinacionModelRead = model('BarbillaInclinacionModel', true, $this->db_read);
		$this->_barbillaPeculiarModelRead = model('BarbillaPeculiarModel', true, $this->db_read);
		$this->_barbaTamanoModelRead = model('BarbaTamanoModel', true, $this->db_read);
		$this->_barbaPeculiarModelRead = model('BarbaPeculiarModel', true, $this->db_read);
		$this->_cuelloTamanoModelRead = model('CuelloTamanoModel', true, $this->db_read);
		$this->_cuelloGrosorModelRead = model('CuelloGrosorModel', true, $this->db_read);
		$this->_cuelloPeculiarModelRead = model('CuelloPeculiarModel', true, $this->db_read);
		$this->_hombroPosicionModelRead = model('HombroPosicionModel', true, $this->db_read);
		$this->_hombroLongitudModelRead = model('HombroLongitudModel', true, $this->db_read);
		$this->_hombroGrosorModelRead = model('HombroGrosorModel', true, $this->db_read);
		$this->_estomagoModelRead = model('EstomagoModel', true, $this->db_read);
		$this->_etniaModelRead = model('PersonaEtniaModel', true, $this->db_read);
		$this->_parentescoModelRead = model('ParentescoModel', true, $this->db_read);
		$this->_pielColorModelRead = model('PielColorModel', true, $this->db_read);
		$this->_objetoClasificacionModelRead = model('ObjetoClasificacionModel', true, $this->db_read);
		$this->_objetoSubclasificacionModelRead = model('ObjetoSubclasificacionModel', true, $this->db_read);
		$this->_tipoMonedaModelRead = model('TipoMonedaModel', true, $this->db_read);
		$this->_vehiculoDistribuidorModelRead = model('VehiculoDistribuidorModel', true, $this->db_read);
		$this->_vehiculoMarcaModelRead = model('VehiculoMarcaModel', true, $this->db_read);
		$this->_vehiculoModeloModelRead = model('VehiculoModeloModel', true, $this->db_read);
		$this->_vehiculoVersionModelRead = model('VehiculoVersionModel', true, $this->db_read);
		$this->_vehiculoServicioModelRead = model('VehiculoServicioModel', true, $this->db_read);
		$this->_estadosExtranjerosRead = model('EstadoExtranjeroModel', true, $this->db_read);
		
	}
	/* Vista de Bandeja de Folios
	* Retorna las cantidades visualizadas al ingresar a bandeja de folios de acuerdo al ROL
	*/
	public function index()
	{
		$data = (object) array();
		$agente = $this->_usuariosModelRead->asObject()->where('ID', session('ID'))->first();
		$roles = [1, 2, 6, 7, 9, 11];
		$data->abiertos = count($this->_folioModelRead->where('STATUS', 'ABIERTO')->findAll());
		if (!$this->permisos('FOLIOS')) {
			return redirect()->back()->with('message_error', 'Acceso denegado, no tienes los permisos necesarios.');
		}
		if (in_array($agente->ROLID, $roles)) {
			$data->derivados = count($this->_folioModelRead->asObject()->where('STATUS', 'DERIVADO')->where('FECHASALIDA BETWEEN "' . date('Y-m-d') . ' 00:00:00' . '" and "' . date('Y-m-d', strtotime("+ 1 day")) . ' 00:00:00' . '"')->findAll());
			$data->canalizados = count($this->_folioModelRead->asObject()->where('STATUS', 'CANALIZADO')->where('FECHASALIDA BETWEEN "' . date('Y-m-d') . ' 00:00:00' . '" and "' . date('Y-m-d', strtotime("+ 1 day")) . ' 00:00:00' . '"')->findAll());
			$data->expedientes = count($this->_folioModelRead->asObject()->where('EXPEDIENTEID !=', null)->where('AGENTEATENCIONID !=', null)->where('AGENTEFIRMAID !=', null)->where('AGENTEASIGNADOID  !=', null)->where('FECHASALIDA BETWEEN "' . date('Y-m-d') . ' 00:00:00' . '" and "' . date('Y-m-d', strtotime("+ 1 day")) . ' 00:00:00' . '"')->findAll());
			$data->proceso = count($this->_folioModelRead->asObject()->where('STATUS', 'EN PROCESO')->findAll());
			$data->expedientes_no_firmados = count($this->_folioModelRead->asObject()->where('EXPEDIENTEID !=', null)->where('AGENTEATENCIONID !=', null)->where('AGENTEFIRMAID', null)->findAll());
			$data->rolPermiso = $this->_rolesPermisosModelRead->asObject()->where('ROLID', session('ROLID'))->findAll();
		} else {
			$data->derivados = count($this->_folioModelRead->asObject()->where('AGENTEATENCIONID', session('ID'))->where('STATUS', 'DERIVADO')->where('FECHASALIDA BETWEEN "' . date('Y-m-d') . ' 00:00:00' . '" and "' . date('Y-m-d', strtotime("+ 1 day")) . ' 00:00:00' . '"')->findAll());
			$data->canalizados = count($this->_folioModelRead->asObject()->where('AGENTEATENCIONID', session('ID'))->where('STATUS', 'CANALIZADO')->where('FECHASALIDA BETWEEN "' . date('Y-m-d') . ' 00:00:00' . '" and "' . date('Y-m-d', strtotime("+ 1 day")) . ' 00:00:00' . '"')->findAll());
			$data->expedientes = count($this->_folioModelRead->asObject()->where('AGENTEATENCIONID', session('ID'))->where('EXPEDIENTEID !=', null)->where('AGENTEATENCIONID !=', null)->where('AGENTEFIRMAID !=', null)->where('FECHASALIDA BETWEEN "' . date('Y-m-d') . ' 00:00:00' . '" and "' . date('Y-m-d', strtotime("+ 1 day")) . ' 00:00:00' . '"')->findAll());
			$data->proceso = count($this->_folioModelRead->asObject()->where('STATUS', 'EN PROCESO')->findAll());
			$data->expedientes_no_firmados = count($this->_folioModelRead->asObject()->where('AGENTEATENCIONID', session('ID'))->where('EXPEDIENTEID !=', null)->where('AGENTEATENCIONID !=', null)->where('AGENTEFIRMAID', null)->findAll());
			$data->rolPermiso = $this->_rolesPermisosModelRead->asObject()->where('ROLID', session('ROLID'))->findAll();
		}
		$this->_loadView('Folios', 'folios', '', $data, 'index');
	}

	/**
	 * Vista para visualizar los folios abiertos
	 *
	 */
	public function folios_abiertos()
	{
		if (!$this->permisos('FOLIOS')) {
			return redirect()->back()->with('message_error', 'Acceso denegado, no tienes los permisos necesarios.');
		}
		$data = (object) array();
		// $data->folio = $this->_folioModel->asObject()->where('STATUS', 'ABIERTO')->join('DENUNCIANTES', 'DENUNCIANTES.DENUNCIANTEID = FOLIO.DENUNCIANTEID')->findAll();
		//Query folios abiertos
		$data->folio = $this->_folioModelRead->get_folios_abiertos();
		$data->rolPermiso = $this->_rolesPermisosModelRead->asObject()->where('ROLID', session('ROLID'))->findAll();

		$this->_loadView('Folios abiertos', 'folios', '', $data, 'folios_abiertos');
	}
	/**
	 * Vista para visualizar los folios derivados
	 * Se visualizan diferentes folios de acuerdo al rol del usuario
	 */
	public function folios_derivados()
	{
		if (!$this->permisos('FOLIOS')) {
			return redirect()->back()->with('message_error', 'Acceso denegado, no tienes los permisos necesarios.');
		}
		$data = (object) array();
		$agente = $this->_usuariosModelRead->asObject()->where('ID', session('ID'))->first();
		$roles = [1, 2, 6, 7, 9, 11];
		if (in_array($agente->ROLID, $roles)) {
			$data->folio = $this->_folioModelRead->asObject()->where('STATUS', 'DERIVADO')
				->join('USUARIOS', 'USUARIOS.ID = FOLIO.AGENTEATENCIONID')
				->join('ROLES', 'ROLES.ID = USUARIOS.ROLID')->where('FECHASALIDA BETWEEN "' . date('Y-m-d') . ' 00:00:00' . '" and "' . date('Y-m-d', strtotime("+ 1 day")) . ' 00:00:00' . '"')->findAll();
		} else {
			$data->folio = $this->_folioModelRead->asObject()->where('STATUS', 'DERIVADO')->where('AGENTEATENCIONID', session('ID'))->where('FECHASALIDA BETWEEN "' . date('Y-m-d') . ' 00:00:00' . '" and "' . date('Y-m-d', strtotime("+ 1 day")) . ' 00:00:00' . '"')
				->join('USUARIOS', 'USUARIOS.ID = FOLIO.AGENTEATENCIONID')
				->join('ROLES', 'ROLES.ID = USUARIOS.ROLID')->findAll();
		}
		$data->rolPermiso = $this->_rolesPermisosModelRead->asObject()->where('ROLID', session('ROLID'))->findAll();

		$this->_loadView('Folios derivados', 'folios', '', $data, 'folios_derivados');
	}
	/**
	 * Vista para visualizar los folios canalizados
	 * Se visualizan diferentes folios de acuerdo al rol del usuario
	 */
	public function folios_canalizados()
	{
		if (!$this->permisos('FOLIOS')) {
			return redirect()->back()->with('message_error', 'Acceso denegado, no tienes los permisos necesarios.');
		}
		$data = (object) array();
		$agente = $this->_usuariosModelRead->asObject()->where('ID', session('ID'))->first();
		$roles = [1, 2, 6, 7, 9, 11];
		if (in_array($agente->ROLID, $roles)) {
			$data->folio = $this->_folioModelRead->asObject()
				->join('USUARIOS', 'USUARIOS.ID = FOLIO.AGENTEATENCIONID', 'LEFT')
				->join('ROLES', 'ROLES.ID = USUARIOS.ROLID', 'LEFT')
				->where('STATUS', 'CANALIZADO')
				->where('FECHASALIDA BETWEEN "' . date('Y-m-d') . ' 00:00:00' . '" and "' . date('Y-m-d', strtotime("+ 1 day")) . ' 00:00:00' . '"')
				->findAll();
		} else {
			$data->folio = $this->_folioModelRead->asObject()
				->join('USUARIOS', 'USUARIOS.ID = FOLIO.AGENTEATENCIONID', 'LEFT')
				->join('ROLES', 'ROLES.ID = USUARIOS.ROLID', 'LEFT')
				->where('STATUS', 'CANALIZADO')
				->where('AGENTEATENCIONID', session('ID'))
				->where('FECHASALIDA BETWEEN "' . date('Y-m-d') . ' 00:00:00' . '" and "' . date('Y-m-d', strtotime("+ 1 day")) . ' 00:00:00' . '"')
				->findAll();
		}
		$data->rolPermiso = $this->_rolesPermisosModelRead->asObject()->where('ROLID', session('ROLID'))->findAll();

		$this->_loadView('Folios canalizados', 'folios', '', $data, 'folios_canalizados');
	}
	/**
	 * Vista para visualizar los folios en proceso
	 *
	 */
	public function folios_en_proceso()
	{
		if (!$this->permisos('FOLIOS')) {
			return redirect()->back()->with('message_error', 'Acceso denegado, no tienes los permisos necesarios.');
		}
		$data = (object) array();
		$data->folio = $this->_folioModelRead->asObject()
		->select('FOLIO.*, USUARIOS.*, DENUNCIANTES.NOMBRE AS NOMBREDENUNCIANTE,DENUNCIANTES.APELLIDO_PATERNO AS APPDENUNCIANTE, DENUNCIANTES.APELLIDO_MATERNO AS APMDENUNCIANTE')
		->where('STATUS', 'EN PROCESO')
		->join('USUARIOS', 'USUARIOS.ID = FOLIO.AGENTEATENCIONID')
		->join('DENUNCIANTES', 'DENUNCIANTES.DENUNCIANTEID = FOLIO.DENUNCIANTEID')

		->findAll();
		$data->rolPermiso = $this->_rolesPermisosModelRead->asObject()->where('ROLID', session('ROLID'))->findAll();

		$this->_loadView('Folios en proceso', 'folios', '', $data, 'folios_en_proceso');
	}

	/**
	 * Función para liberar los folios en proceso
	 *
	 */
	public function liberar_folio()
	{
		$folio = $this->request->getVar('folio');
		$year = $this->request->getVar('year');

		$data = ['EXPEDIENTEID' => null, 'AGENTEATENCIONID' => null, 'AGENTEFIRMAID' => null, 'STATUS' => 'ABIERTO'];
		$this->_folioModel->set($data)->where('FOLIOID', $folio)->where('ANO', $year)->where('EXPEDIENTEID IS NULL')->update();
		$datosBitacora = [
			'ACCION' => 'Ha liberado un folio desde folios en proceso.',
			'NOTAS' => 'FOLIO: ' . $folio . ' AÑO: ' . $year
		];
		$this->_bitacoraActividad($datosBitacora);
		return redirect()->to(base_url('/admin/dashboard/folios_en_proceso'));
	}
	/**
	 * Vista para visualizar los folios con expediente
	 * Se visualizan diferentes folios de acuerdo al rol del usuario
	 */
	public function folios_expediente()
	{
		if (!$this->permisos('FOLIOS')) {
			return redirect()->back()->with('message_error', 'Acceso denegado, no tienes los permisos necesarios.');
		}
		$data = (object) array();
		$agente = $this->_usuariosModelRead->asObject()->where('ID', session('ID'))->first();
		$roles = [1, 2, 6, 7, 9, 11];
		if (in_array($agente->ROLID, $roles)) {
			// $data->folio = $this->_folioModel->asObject()->where('EXPEDIENTEID !=', null)->where('AGENTEATENCIONID !=', null)->where('AGENTEFIRMAID !=', null)->join('USUARIOS', 'USUARIOS.ID = FOLIO.AGENTEATENCIONID')->join('ROLES', 'ROLES.ID = USUARIOS.ROLID')->join('TIPOEXPEDIENTE', 'TIPOEXPEDIENTE.TIPOEXPEDIENTEID = FOLIO.TIPOEXPEDIENTEID')->join('EMPLEADOS', 'EMPLEADOS.EMPLEADOID = FOLIO.AGENTEASIGNADOID AND EMPLEADOS.MUNICIPIOID = FOLIO.MUNICIPIOASIGNADOID')->findAll();
			$data->folio = $this->_folioModelRead->asObject()
				->select('FOLIO.*,USUARIOS.*,USUARIOS.NOMBRE AS USUARIONOMBRE,ROLES.*,EMPLEADOS.*,TIPOEXPEDIENTE.*')
				->join('USUARIOS', 'USUARIOS.ID = FOLIO.AGENTEATENCIONID', 'LEFT')
				->join('ROLES', 'ROLES.ID = USUARIOS.ROLID', 'LEFT')
				->join('EMPLEADOS', 'EMPLEADOS.EMPLEADOID = FOLIO.AGENTEASIGNADOID AND EMPLEADOS.MUNICIPIOID = FOLIO.MUNICIPIOASIGNADOID', 'LEFT')
				->join('TIPOEXPEDIENTE', 'TIPOEXPEDIENTE.TIPOEXPEDIENTEID = FOLIO.TIPOEXPEDIENTEID', 'LEFT')
				->where('EXPEDIENTEID !=', null)->where('AGENTEATENCIONID !=', null)
				->where('FECHASALIDA BETWEEN "' . date('Y-m-d') . ' 00:00:00' . '" and "' . date('Y-m-d', strtotime("+ 1 day")) . ' 00:00:00' . '"')
				->findAll();
		} else {
			// $data->folio = $this->_folioModel->asObject()->where('EXPEDIENTEID !=', null)->where('AGENTEATENCIONID', session('ID'))->where('AGENTEFIRMAID !=', null)->join('USUARIOS', 'USUARIOS.ID = FOLIO.AGENTEATENCIONID')->join('ROLES', 'ROLES.ID = USUARIOS.ROLID')->join('TIPOEXPEDIENTE', 'TIPOEXPEDIENTE.TIPOEXPEDIENTEID = FOLIO.TIPOEXPEDIENTEID')->join('EMPLEADOS', 'EMPLEADOS.EMPLEADOID = FOLIO.AGENTEASIGNADOID AND EMPLEADOS.MUNICIPIOID = FOLIO.MUNICIPIOASIGNADOID')->findAll();
			$data->folio = $this->_folioModelRead->asObject()
				->select('FOLIO.*,USUARIOS.*,USUARIOS.NOMBRE AS USUARIONOMBRE,ROLES.*,EMPLEADOS.*,TIPOEXPEDIENTE.*')
				->join('USUARIOS', 'USUARIOS.ID = FOLIO.AGENTEATENCIONID', 'LEFT')
				->join('ROLES', 'ROLES.ID = USUARIOS.ROLID', 'LEFT')
				->join('EMPLEADOS', 'EMPLEADOS.EMPLEADOID = FOLIO.AGENTEASIGNADOID AND EMPLEADOS.MUNICIPIOID = FOLIO.MUNICIPIOASIGNADOID', 'LEFT')
				->join('TIPOEXPEDIENTE', 'TIPOEXPEDIENTE.TIPOEXPEDIENTEID = FOLIO.TIPOEXPEDIENTEID', 'LEFT')
				->where('EXPEDIENTEID !=', null)->where('AGENTEATENCIONID', session('ID'))
				->where('FECHASALIDA BETWEEN "' . date('Y-m-d') . ' 00:00:00' . '" and "' . date('Y-m-d', strtotime("+ 1 day")) . ' 00:00:00' . '"')
				->findAll();
		}
		$data->rolPermiso = $this->_rolesPermisosModelRead->asObject()->where('ROLID', session('ROLID'))->findAll();

		$this->_loadView('Folios expediente', 'folios', '', $data, 'folios_expediente');
	}

	/**
	 * Vista para visualizar los folios sin firmar
	 *  ! Deprecated method, do not use.
	 */
	public function folios_sin_firma()
	{
		if (!$this->permisos('FOLIOS')) {
			return redirect()->back()->with('message_error', 'Acceso denegado, no tienes los permisos necesarios.');
		}
		$data = (object) array();
		$data->folio = $this->_folioModelRead->asObject()->where('EXPEDIENTEID !=', null)->where('AGENTEATENCIONID !=', null)->where('AGENTEFIRMAID', null)->join('USUARIOS', 'USUARIOS.ID = FOLIO.AGENTEATENCIONID')->join('ROLES', 'ROLES.ID = USUARIOS.ROLID')->findAll();
		$data->rolPermiso = $this->_rolesPermisosModelRead->asObject()->where('ROLID', session('ROLID'))->findAll();

		$this->_loadView('Expedientes sin firmar', 'folios', '', $data, 'folios_sin_firma');
	}

	/**
	 * Funcion para firmar folios  en folios sin firma
	 *  ! Deprecated method, do not use.
	 */
	public function firmar_folio()
	{
		$folio = $this->request->getVar('folio');
		$data = ['AGENTEFIRMAID' => session('ID')];
		$this->_folioModel->set($data)->where('FOLIOID', $folio)->update();
		$datosBitacora = [
			'ACCION' => 'Ha firmado un folio',
			'NOTAS' =>   'FOLIO: ' . $folio,
		];
		$this->_bitacoraActividad($datosBitacora);
		return redirect()->to(base_url('/admin/dashboard/folios_sin_firma'));
	}

	/**
	 * Vista de consulta de folios.
	 * Su filtro es el default para traer todos los folios de un mes atras en adelante
	 *
	 */
	public function getAllFolios()
	{
		if (!$this->permisos('BUSQUEDA DE FOLIO')) {
			return redirect()->back()->with('message_error', 'Acceso denegado, no tienes los permisos necesarios.');
		}

		//Datos del filtro por default
		$data = (object) array();
		$data = [
			'fechaInicio' => date("Y-m-d", strtotime('-1 month')),
			'fechaFin' => date("Y-m-d"),
		];
		// Se limpian varibles nulas o que no esten en el array definido
		foreach ($data as $clave => $valor) {
			if (empty($valor)) {
				unset($data[$clave]);
			}
		}

		// Info para la tabla visual
		$municipio = $this->_municipiosModelRead->asObject()->where('ESTADOID', 2)->findAll();
		$where = "ROLID = 2 OR ROLID = 3 OR ROLID = 4 OR ROLID = 6 OR ROLID = 7 OR ROLID = 8 OR ROLID = 9 OR ROLID = 10";
		$empleado = $this->_usuariosModelRead->asObject()->where($where)->orderBy('NOMBRE', 'ASC')->findAll();
		$tipoExpediente = $this->_tipoExpedienteModelRead->asObject()->like('TIPOEXPEDIENTECLAVE', 'NUC')->orLike('TIPOEXPEDIENTECLAVE', 'NAC')->orLike('TIPOEXPEDIENTECLAVE', 'RAC')->findAll();

		// Filtro
		$resultFilter = $this->_folioModelRead->filterAllDates($data);

		$dataView = (object) array();
		$dataView->result = $resultFilter->result;
		$dataView->municipios = $municipio;
		$dataView->empleados = $empleado;
		$dataView->tipoExpediente = $tipoExpediente;
		$dataView->filterParams = (object) $data;
		$dataView->rolPermiso = $this->_rolesPermisosModelRead->asObject()->where('ROLID', session('ROLID'))->findAll();

		$this->_loadView('Buscar folio', 'folios', '', $dataView, 'buscar_folio');
	}

	
	/**
	 * Función para filtrar los folios en consulta de folios
	 * Se recibe por metodo POST el formulario de filtros
	 *
	 */
	public function getFilterFolios()
	{
		//Datos del filtro que requiren buscar

		$data = (object) array();
		$data = [
			'FOLIOID' => $this->request->getPost('folio'),
			'ANO' => $this->request->getPost('year'),
			'MUNICIPIOID' => $this->request->getPost('municipio'),
			'AGENTEATENCIONID' => $this->request->getPost('agente'),
			'STATUS' => $this->request->getPost('status'),
			'TIPODENUNCIA' => $this->request->getPost('tipo'),
			'fechaInicio' => $this->request->getPost('fecha_inicio'),
			'fechaFin' => $this->request->getPost('fecha_fin'),
			'horaInicio' => $this->request->getPost('horaInicio'),
			'horaFin' => $this->request->getPost('horaFin'),
			'TIPOEXPEDIENTEID' => $this->request->getPost('tipo_salida'),
		];
		// Se limpian varibles nulas o que no esten en el array definido

		foreach ($data as $clave => $valor) {
			if (empty($valor)) {
				unset($data[$clave]);
			}
		}

		//Cuando se borra el filtro
		if (count($data) <= 0) {
			$data = [
				'fechaInicio' => date("Y-m-d", strtotime('-1 month')),
				'fechaFin' => date("Y-m-d"),
			];
		}

		$municipio = $this->_municipiosModelRead->asObject()->where('ESTADOID', 2)->findAll();
		$resultFilter = $this->_folioModelRead->filterAllDates($data);
		$empleado = $this->_usuariosModelRead->asObject()->orderBy('NOMBRE', 'ASC')->findAll();
		$tipoExpediente = $this->_tipoExpedienteModelRead->asObject()->like('TIPOEXPEDIENTECLAVE', 'NUC')->orLike('TIPOEXPEDIENTECLAVE', 'NAC')->orLike('TIPOEXPEDIENTECLAVE', 'RAC')->findAll();

		$dataView = (object) array();
		$dataView->result = $resultFilter->result;
		$dataView->municipios = $municipio;
		$dataView->empleados = $empleado;
		$dataView->tipoExpediente = $tipoExpediente;
		$dataView->filterParams = (object) $data;
		$dataView->rolPermiso = $this->_rolesPermisosModelRead->asObject()->where('ROLID', session('ROLID'))->findAll();

		$this->_loadView('Buscar folio', 'folios', '', $dataView, 'buscar_folio');
	}

	
	/**
	 * Función cuando abren un expediente desde consulta de folios o para abrir los folios atendidos de ese denuniante desde VIDEODENUNCIA
	 * Recibe por metodo POST el folio y año, o GET en casod e ser desde VIDEODENUNCIA.
	 *
	 */
	public function viewFolio()
	{
		if (!$this->permisos('BUSQUEDA DE FOLIO')) {
			return redirect()->back()->with('message_error', 'Acceso denegado, no tienes los permisos necesarios.');
		}

		$data = (object) array();
		if ($this->request->getPost('folio')) {
			$data->folio = $this->request->getPost('folio');
		} else {
			$data->folio = $this->request->getGet('folio');
		}
		if ($this->request->getPost('ano')) {
			$data->year = $this->request->getPost('year');
		} else {
			$data->year = $this->request->getGet('year');
		}

		// Catálogos
		$data->delitosUsuarios = $this->_delitosUsuariosModelRead->asObject()->orderBy('DELITO', 'ASC')->findAll();
		$lugares = $this->_hechoLugarModelRead->orderBy('HECHODESCR', 'ASC')->findAll();
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

		$data->edoCiviles = $this->_estadoCivilModelRead->asObject()->findAll();
		$data->nacionalidades = $this->_nacionalidadModelRead->asObject()->findAll();
		$data->calidadJuridica = $this->_folioPersonaCalidadJuridicaRead->asObject()->findAll();
		$data->idiomas = $this->_idiomaModelRead->asObject()->findAll();

		$data->municipios = $this->_municipiosModelRead->asObject()->where('ESTADOID', 2)->findAll();

		$data->paises = $this->_paisesModelRead->asObject()->findAll();
		$data->estados = $this->_estadosModelRead->asObject()->findAll();
		$data->tiposIdentificaciones = $this->_tipoIdentificacionModelRead->asObject()->findAll();
		$data->escolaridades = $this->_escolaridadModelRead->asObject()->findAll();
		$data->ocupaciones = $this->_ocupacionModelRead->asObject()->findAll();
		$data->colorVehiculo = $this->_coloresVehiculoModelRead->asObject()->findAll();
		$data->tipoVehiculo = $this->_tipoVehiculoModelRead->asObject()->orderBy('VEHICULOTIPODESCR', 'ASC')->findAll();
		$data->figura = $this->_figuraModelRead->asObject()->findAll();

		$data->cejaContextura = $this->_cejaContexturaModelRead->asObject()->findAll();
		$data->caraForma = $this->_caraFormaModelRead->asObject()->findAll();
		$data->caraTamano = $this->_caraTamanoModelRead->asObject()->findAll();
		$data->caraTez = $this->_caraTezModelRead->asObject()->findAll();
		$data->orejaLobulo = $this->_orejaLobuloModelRead->asObject()->findAll();
		$data->orejaForma = $this->_orejaFomaModelRead->asObject()->findAll();
		$data->orejaTamano = $this->_orejaTamanoModelRead->asObject()->findAll();
		$data->cabelloColor = $this->_cabelloColorModelRead->asObject()->findAll();
		$data->cabelloEstilo = $this->_cabelloEstiloModelRead->asObject()->findAll();
		$data->cabelloTamano = $this->_cabelloTamanoModelRead->asObject()->findAll();
		$data->cabelloPeculiar = $this->_cabelloPeculiarModelRead->asObject()->findAll();
		$data->frenteAltura = $this->_frenteAlturaModelRead->asObject()->findAll();
		$data->frenteAnchura = $this->_frenteAnchuraModelRead->asObject()->findAll();
		$data->frenteForma = $this->_frenteFormaModelRead->asObject()->findAll();
		$data->frentePeculiar = $this->_frentePeculiarModelRead->asObject()->findAll();
		$data->cejaColocacion = $this->_cejaColocacionModelRead->asObject()->findAll();
		$data->cejaForma = $this->_cejaFormaModelRead->asObject()->findAll();
		$data->cejaTamano = $this->_cejaTamanoModelRead->asObject()->findAll();
		$data->cejaGrosor = $this->_cejaGrosorModelRead->asObject()->findAll();
		$data->ojoColocacion = $this->_ojoColocacionModelRead->asObject()->findAll();
		$data->ojoForma = $this->_ojoFormaModelRead->asObject()->findAll();
		$data->ojoTamano = $this->_ojoTamanoModelRead->asObject()->findAll();
		$data->ojoColor = $this->_ojoColorModelRead->asObject()->findAll();
		$data->ojoPeculiar = $this->_ojoPeculiarModelRead->asObject()->findAll();
		$data->narizTipo = $this->_narizTipoModelRead->asObject()->findAll();
		$data->narizTamano = $this->_narizTamanoModelRead->asObject()->findAll();
		$data->narizBase = $this->_narizBaseModelRead->asObject()->findAll();
		$data->narizPeculiar = $this->_narizPeculiarModelRead->asObject()->findAll();
		$data->bigoteForma = $this->_bigoteFormaModelRead->asObject()->findAll();
		$data->bigoteTamano = $this->_bigoteTamanoModelRead->asObject()->findAll();
		$data->bigoteGrosor = $this->_bigoteGrosorModelRead->asObject()->findAll();
		$data->bigotePeculiar = $this->_bigotePeculiarModelRead->asObject()->findAll();
		$data->bocaTamano = $this->_bocaTamanoModelRead->asObject()->findAll();
		$data->bocaPeculiar = $this->_bocaPeculiarModelRead->asObject()->findAll();
		$data->labioGrosor = $this->_labioGrosorModelRead->asObject()->findAll();
		$data->labioLongitud = $this->_labioLongitudModelRead->asObject()->findAll();
		$data->labioPeculiar = $this->_labioPeculiarModelRead->asObject()->findAll();
		$data->labioPosicion = $this->_labioPosicionModelRead->asObject()->findAll();
		$data->dienteTamano = $this->_dienteTamanoModelRead->asObject()->findAll();
		$data->dienteTipo = $this->_dienteTipoModelRead->asObject()->findAll();
		$data->dientePeculiar = $this->_dientePeculiarModelRead->asObject()->findAll();
		$data->barbillaForma = $this->_barbillaFormaModelRead->asObject()->findAll();
		$data->barbillaTamano = $this->_barbillaTamanoModelRead->asObject()->findAll();
		$data->barbillaInclinacion = $this->_barbillaInclinacionModelRead->asObject()->findAll();
		$data->barbillaPeculiar = $this->_barbillaPeculiarModelRead->asObject()->findAll();
		$data->barbaTamano = $this->_barbaTamanoModelRead->asObject()->findAll();
		$data->barbaPeculiar = $this->_barbaPeculiarModelRead->asObject()->findAll();
		$data->cuelloTamano = $this->_cuelloTamanoModelRead->asObject()->findAll();
		$data->cuelloGrosor = $this->_cuelloGrosorModelRead->asObject()->findAll();
		$data->cuelloPeculiar = $this->_cuelloPeculiarModelRead->asObject()->findAll();
		$data->hombroPosicion = $this->_hombroPosicionModelRead->asObject()->findAll();
		$data->hombroLongitud = $this->_hombroLongitudModelRead->asObject()->findAll();
		$data->hombroGrosor = $this->_hombroGrosorModelRead->asObject()->findAll();
		$data->estomago = $this->_estomagoModelRead->asObject()->findAll();
		$data->pielColor = $this->_pielColorModelRead->asObject()->findAll();
		$data->etnia = $this->_etniaModelRead->asObject()->findAll();
		$data->parentesco = $this->_parentescoModelRead->asObject()->findAll();
		$data->objetoclasificacion = $this->_objetoClasificacionModelRead->asObject()->findAll();
		$data->objetosubclasificacion = $this->_objetoSubclasificacionModelRead->asObject()->findAll();
		$data->tipomoneda = $this->_tipoMonedaModelRead->asObject()->findAll();

		$data->tipoExpediente = $this->_tipoExpedienteModelRead->asObject()->where('TIPOEXPEDIENTEID <= 5')->findAll();

		$data->distribuidorVehiculo = $this->_vehiculoDistribuidorModelRead->asObject()->findAll();
		$data->marcaVehiculo = $this->_vehiculoMarcaModelRead->asObject()->findAll();
		$data->lineaVehiculo = $this->_vehiculoModeloModelRead->asObject()->findAll();
		$data->versionVehiculo = $this->_vehiculoVersionModelRead->asObject()->findAll();
		$data->servicioVehiculo = $this->_vehiculoServicioModelRead->asObject()->findAll();
		$data->estadosExtranjeros = $this->_estadosExtranjerosRead->asObject()->findAll();

		//Datos del folio
		$data->datosFolio = $this->_folioModelRead->asObject()->where('FOLIOID', $data->folio)->where('ANO', $data->year)->first();

		// Cuando se le abrio expediente
		if ($data->datosFolio->MUNICIPIOASIGNADOID  && $data->datosFolio->TIPOEXPEDIENTEID) {
			$data->datosFolio = $this->_folioModelRead->asObject()->where('FOLIOID', $data->folio)->where('ANO', $data->year)->join('MUNICIPIO', 'FOLIO.MUNICIPIOASIGNADOID = MUNICIPIO.MUNICIPIOID AND MUNICIPIO.ESTADOID =2')->join('TIPOEXPEDIENTE', 'FOLIO.TIPOEXPEDIENTEID = TIPOEXPEDIENTE.TIPOEXPEDIENTEID')->first();
		}
		//Cuando estan remitidos
		if ($data->datosFolio->AGENTEASIGNADOID) {
			$data->datosFolio = $this->_folioModelRead->asObject()->where('FOLIOID', $data->folio)->where('ANO', $data->year)->join('MUNICIPIO', 'FOLIO.MUNICIPIOASIGNADOID = MUNICIPIO.MUNICIPIOID AND MUNICIPIO.ESTADOID =2')->join('EMPLEADOS', 'EMPLEADOS.EMPLEADOID = FOLIO.AGENTEASIGNADOID')->join('TIPOEXPEDIENTE', 'FOLIO.TIPOEXPEDIENTEID = TIPOEXPEDIENTE.TIPOEXPEDIENTEID')->first();
			if ($data->datosFolio) {
				$data->datosFolio = $this->_folioModelRead->asObject()->where('FOLIOID', $data->folio)->where('ANO', $data->year)->join('MUNICIPIO', 'FOLIO.MUNICIPIOASIGNADOID = MUNICIPIO.MUNICIPIOID AND MUNICIPIO.ESTADOID =2')->join('EMPLEADOS', 'EMPLEADOS.EMPLEADOID = FOLIO.AGENTEASIGNADOID AND EMPLEADOS.MUNICIPIOID = FOLIO.MUNICIPIOASIGNADOID')->join('TIPOEXPEDIENTE', 'FOLIO.TIPOEXPEDIENTEID = TIPOEXPEDIENTE.TIPOEXPEDIENTEID')->first();
			} else {
				$data->datosFolio = $this->_folioModelRead->asObject()->where('FOLIO.FOLIOID', $data->folio)->where('FOLIO.ANO', $data->year)->join('MUNICIPIO', 'FOLIO.MUNICIPIOASIGNADOID = MUNICIPIO.MUNICIPIOID AND MUNICIPIO.ESTADOID =2')->join('BANDEJARAC', 'BANDEJARAC.MEDIADORID = FOLIO.AGENTEASIGNADOID AND BANDEJARAC.FOLIOID = FOLIO.FOLIOID AND BANDEJARAC.ANO = FOLIO.ANO')->join('TIPOEXPEDIENTE', 'FOLIO.TIPOEXPEDIENTEID = TIPOEXPEDIENTE.TIPOEXPEDIENTEID')->first();
			}
		}

		//Cuando es derivado
		if ($data->datosFolio->INSTITUCIONREMISIONMUNICIPIOID && $data->datosFolio->STATUS == 'DERIVADO') {
			$data->datosFolio = $this->_folioModelRead->asObject()->where('FOLIOID', $data->folio)->where('ANO', $data->year)->join('MUNICIPIO', 'FOLIO.INSTITUCIONREMISIONMUNICIPIOID = MUNICIPIO.MUNICIPIOID AND MUNICIPIO.ESTADOID =2')->join('DERIVACIONES', 'FOLIO.INSTITUCIONREMISIONID = DERIVACIONES.INSTITUCIONREMISIONID AND FOLIO.INSTITUCIONREMISIONMUNICIPIOID = DERIVACIONES.MUNICIPIOID')->first();
		}
		//Cuando es canalizado
		if ($data->datosFolio->INSTITUCIONREMISIONMUNICIPIOID && $data->datosFolio->STATUS == 'CANALIZADO') {
			$data->datosFolio = $this->_folioModelRead->asObject()->where('FOLIOID', $data->folio)->where('ANO', $data->year)->join('MUNICIPIO', 'FOLIO.INSTITUCIONREMISIONMUNICIPIOID = MUNICIPIO.MUNICIPIOID AND MUNICIPIO.ESTADOID =2')->join('CANALIZACIONES', 'FOLIO.INSTITUCIONREMISIONID = CANALIZACIONES.INSTITUCIONREMISIONID AND FOLIO.INSTITUCIONREMISIONMUNICIPIOID = CANALIZACIONES.MUNICIPIOID')->first();
		}

		$data->rolPermiso = $this->_rolesPermisosModelRead->asObject()->where('ROLID', session('ROLID'))->findAll();

		// var_dump($data);exit;
		$this->_loadView('Video denuncia', 'videodenuncia', '', $data, 'ver_folio');
	}

	/**
	 * Función para cargar cualquier vista en cualquier función.
	 *
	 * @param  mixed $title
	 * @param  mixed $menu
	 * @param  mixed $submenu
	 * @param  mixed $data
	 * @param  mixed $view
	 * @return void
	 */
	private function _loadView($title, $menu, $submenu, $data, $view)
	{
		$data2 = [
			'header_data' => (object) ['title' => $title, 'menu' => $menu, 'submenu' => $submenu],
			'body_data' => $data,
		];

		echo view("admin/dashboard/folios/$view", $data2);
	}
	/**
	 * Función para agregar información a la bitacora diaria.
	 *
	 * @param  mixed $data
	 */
	private function _bitacoraActividad($data)
	{
		$data = $data;
		$data['ID'] = uniqid();
		$data['USUARIOID'] = session('ID');


		if ($data['USUARIOID']) {
			$this->_bitacoraActividadModel->insert($data);
		}
	}
	/**
	 * Función para revisar los permisos que tienen los usuarios y poder restringir el acceso
	 *
	 * @param  mixed $permiso
	 */
	private function permisos($permiso)
	{
		return in_array($permiso, session('permisos'));
	}
}

/* End of file FoliosController.php */
/* Location: ./app/Controllers/admin/FoliosController.php */
