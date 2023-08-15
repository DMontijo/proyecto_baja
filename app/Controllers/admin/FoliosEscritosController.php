<?php

namespace App\Controllers\admin;

use App\Controllers\BaseController;
use App\Models\FolioModel;
use App\Models\BitacoraActividadModel;

class FoliosEscritosController extends BaseController
{

	
	private $_bitacoraActividadModel;
	private $db_read;
	private $_usuariosModelRead;
	private $_folioModelRead;
	private $_rolesPermisosModelRead;
	private $_municipiosModelRead;
	private $_tipoExpedienteModelRead;
	public function __construct()
	{
		//Conexion de lectura
		$this->db_read = ENVIRONMENT == 'production' ? db_connect('default_read') : db_connect('development_read');

		//Models writer
		$this->_bitacoraActividadModel = new BitacoraActividadModel();

		//Models reader
		$this->_usuariosModelRead = model('UsuariosModel', true, $this->db_read);
		$this->_folioModelRead = model('FolioModel', true, $this->db_read);
		$this->_rolesPermisosModelRead = model('RolesPermisosModel', true, $this->db_read);
		$this->_municipiosModelRead = model('MunicipiosModel', true, $this->db_read);
		$this->_tipoExpedienteModelRead = model('TipoExpedienteModel', true, $this->db_read);
	
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
		if (!$this->permisos('LIGACIONES')) {
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
		$where = "ROLID = 2 OR ROLID = 3 OR ROLID = 4 OR ROLID = 6 OR ROLID = 7";
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
