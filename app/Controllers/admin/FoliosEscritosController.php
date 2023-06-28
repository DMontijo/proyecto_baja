<?php

namespace App\Controllers\admin;

use App\Controllers\BaseController;
use App\Models\FolioModel;
use App\Models\BitacoraActividadModel;

class FoliosEscritosController extends BaseController
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
	/* Vista de Bandeja de Folios Escritos
	* Retorna las cantidades visualizadas al ingresar a bandeja de folios de acuerdo al ROL
	*/
	public function index()
	{
		$data = (object) array();
		$agente = $this->_usuariosModelRead->asObject()->where('ID', session('ID'))->first();
		$roles = [1, 2, 6, 7, 9, 11];

		if (!$this->permisos('FOLIOS')) {
			return redirect()->back()->with('message_error', 'Acceso denegado, no tienes los permisos necesarios.');
		}
		$data->rolPermiso = $this->_rolesPermisosModelRead->asObject()->where('ROLID', session('ROLID'))->findAll();

		$this->_loadView('Folios escritos', 'folios escritos', '', $data, 'index');
	}
	/**
	 * Vista de consulta de folios litigantes.
	 * Su filtro es el default para traer todos los folios de un mes atras en adelante
	 *
	 */
	public function getAllFoliosLitigante()
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
		$resultFilter = $this->_folioModelRead->filterAllDatesLitigante($data);

		$dataView = (object) array();
		$dataView->result = $resultFilter->result;
		$dataView->municipios = $municipio;
		$dataView->empleados = $empleado;
		$dataView->tipoExpediente = $tipoExpediente;
		$dataView->filterParams = (object) $data;
		$dataView->rolPermiso = $this->_rolesPermisosModelRead->asObject()->where('ROLID', session('ROLID'))->findAll();

		$this->_loadView('Buscar folio litigante', 'folios', '', $dataView, 'buscar_folio_litigantes');
	}

	/**
	 * Función para filtrar los folios en consulta de folios
	 * Se recibe por metodo POST el formulario de filtros
	 *
	 */
	public function getFilterFoliosLitigante()
	{
		//Datos del filtro que requiren buscar

		$data = (object) array();
		$data = [
			'FOLIOID' => $this->request->getPost('folio'),
			'ANO' => $this->request->getPost('year'),
			'MUNICIPIOID' => $this->request->getPost('municipio'),
			'AGENTEATENCIONID' => $this->request->getPost('agente'),
			'STATUS' => $this->request->getPost('status'),
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
		$resultFilter = $this->_folioModelRead->filterAllDatesLitigante($data);
		$empleado = $this->_usuariosModelRead->asObject()->orderBy('NOMBRE', 'ASC')->findAll();
		$tipoExpediente = $this->_tipoExpedienteModelRead->asObject()->like('TIPOEXPEDIENTECLAVE', 'NUC')->orLike('TIPOEXPEDIENTECLAVE', 'NAC')->orLike('TIPOEXPEDIENTECLAVE', 'RAC')->findAll();

		$dataView = (object) array();
		$dataView->result = $resultFilter->result;
		$dataView->municipios = $municipio;
		$dataView->empleados = $empleado;
		$dataView->tipoExpediente = $tipoExpediente;
		$dataView->filterParams = (object) $data;
		$dataView->rolPermiso = $this->_rolesPermisosModelRead->asObject()->where('ROLID', session('ROLID'))->findAll();

		$this->_loadView('Buscar folio litigante', 'folios', '', $dataView, 'buscar_folio_litigantes');
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

		echo view("admin/dashboard/folios_escritos/$view", $data2);
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
