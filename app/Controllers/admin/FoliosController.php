<?php

namespace App\Controllers\admin;

use App\Controllers\BaseController;
use App\Database\Migrations\DELITOMODALIDAD;
use App\Database\Seeds\EstadoExtranjeroSeeder;
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
use App\Models\ConstanciaExtravioModel;
use App\Models\DelitoModalidadModel;
use App\Models\EstadoExtranjeroModel;
use App\Models\FolioArchivoExternoModel;
use App\Models\FolioDocumentoModel;
use App\Models\FolioPersonaFisImpDelitoModel;
use App\Models\FolioRelacionFisFisModel;
use App\Models\ObjetoClasificacionModel;
use App\Models\ObjetoSubclasificacionModel;
use App\Models\RolesPermisosModel;
use App\Models\TipoExpedienteModel;
use App\Models\TipoMonedaModel;
use App\Models\VehiculoDistribuidorModel;
use App\Models\VehiculoMarcaModel;
use App\Models\VehiculoModeloModel;
use App\Models\VehiculoServicioModel;
use App\Models\VehiculoVersionModel;

class FoliosController extends BaseController
{
    public function __construct()
    {
        //Models
        $this->_constanciaExtravioModel = new ConstanciaExtravioModel();

        $this->_usuariosModel = new UsuariosModel();
        $this->_zonasUsuariosModel = new ZonasUsuariosModel();
        $this->_rolesUsuariosModel = new RolesUsuariosModel();

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
        $this->_bitacoraActividadModel = new BitacoraActividadModel();

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


        $this->_objetoClasificacionModel = new ObjetoClasificacionModel();
        $this->_objetoSubclasificacionModel = new ObjetoSubclasificacionModel();
        $this->_tipoMonedaModel = new TipoMonedaModel();
        $this->_vehiculoDistribuidorModel = new VehiculoDistribuidorModel();
		$this->_vehiculoMarcaModel = new VehiculoMarcaModel();
		$this->_vehiculoModeloModel = new VehiculoModeloModel();
		$this->_vehiculoVersionModel = new VehiculoVersionModel();
		$this->_vehiculoServicioModel = new VehiculoServicioModel();
        $this->_estadosExtranjeros = new EstadoExtranjeroModel();
        $this->_tipoExpedienteModel = new TipoExpedienteModel();
        $this->_rolesPermisosModel = new RolesPermisosModel();


    }

    public function index()
    {
        $data = (object) array();
        $agente = $this->_usuariosModel->asObject()->where('ID', session('ID'))->first();
        $roles = [1, 3];
        $data->abiertos = count($this->_folioModel->where('STATUS', 'ABIERTO')->findAll());
        if (in_array($agente->ROLID, $roles)) {
            $data->derivados = count($this->_folioModel->asObject()->where('STATUS', 'DERIVADO')->findAll());
            $data->canalizados = count($this->_folioModel->asObject()->where('STATUS', 'CANALIZADO')->findAll());
            $data->expedientes = count($this->_folioModel->asObject()->where('EXPEDIENTEID !=', null)->where('AGENTEATENCIONID !=', null)->where('AGENTEFIRMAID !=', null)->findAll());
            $data->proceso = count($this->_folioModel->asObject()->where('STATUS', 'EN PROCESO')->findAll());
            $data->expedientes_no_firmados = count($this->_folioModel->asObject()->where('EXPEDIENTEID !=', null)->where('AGENTEATENCIONID !=', null)->where('AGENTEFIRMAID', null)->findAll());
            $data->rolPermiso = $this->_rolesPermisosModel->asObject()->where('ROLID', session('ROLID'))->findAll();

        } else {
            
            $data->derivados = count($this->_folioModel->asObject()->where('AGENTEATENCIONID', session('ID'))->where('STATUS', 'DERIVADO')->findAll());
            $data->canalizados = count($this->_folioModel->asObject()->where('AGENTEATENCIONID', session('ID'))->where('STATUS', 'CANALIZADO')->findAll());
            $data->expedientes = count($this->_folioModel->asObject()->where('AGENTEATENCIONID', session('ID'))->where('EXPEDIENTEID !=', null)->where('AGENTEATENCIONID !=', null)->where('AGENTEFIRMAID !=', null)->findAll());
            $data->proceso = count($this->_folioModel->asObject()->where('STATUS', 'EN PROCESO')->findAll());
            $data->expedientes_no_firmados = count($this->_folioModel->asObject()->where('AGENTEATENCIONID', session('ID'))->where('EXPEDIENTEID !=', null)->where('AGENTEATENCIONID !=', null)->where('AGENTEFIRMAID', null)->findAll());
            $data->rolPermiso = $this->_rolesPermisosModel->asObject()->where('ROLID', session('ROLID'))->findAll();

        }

        $this->_loadView('Folios', 'folios', '', $data, 'index');
    }

    public function folios_abiertos()
    {
        $data = (object) array();
        $data->folio = $this->_folioModel->asObject()->where('STATUS', 'ABIERTO')->join('DENUNCIANTES', 'DENUNCIANTES.DENUNCIANTEID = FOLIO.DENUNCIANTEID')->findAll();
        $data->rolPermiso = $this->_rolesPermisosModel->asObject()->where('ROLID', session('ROLID'))->findAll();

        $this->_loadView('Folios abiertos', 'folios', '', $data, 'folios_abiertos');
    }

    public function folios_derivados()
    {
        $data = (object) array();
        $agente = $this->_usuariosModel->asObject()->where('ID', session('ID'))->first();
        $roles = [1, 3];
        if (in_array($agente->ROLID, $roles)) {
            $data->folio = $this->_folioModel->asObject()->where('STATUS', 'DERIVADO')->join('USUARIOS', 'USUARIOS.ID = FOLIO.AGENTEATENCIONID')->join('ROLES', 'ROLES.ID = USUARIOS.ROLID')->findAll();
        } else {
            $data->folio = $this->_folioModel->asObject()->where('STATUS', 'DERIVADO')->where('AGENTEATENCIONID', session('ID'))->join('USUARIOS', 'USUARIOS.ID = FOLIO.AGENTEATENCIONID')->join('ROLES', 'ROLES.ID = USUARIOS.ROLID')->findAll();
        }
        $data->rolPermiso = $this->_rolesPermisosModel->asObject()->where('ROLID', session('ROLID'))->findAll();

        $this->_loadView('Folios derivados', 'folios', '', $data, 'folios_derivados');
    }

    public function folios_canalizados()
    {
        $data = (object) array();
        $agente = $this->_usuariosModel->asObject()->where('ID', session('ID'))->first();
        $roles = [1, 3];
        if (in_array($agente->ROLID, $roles)) {
            $data->folio = $this->_folioModel->asObject()->where('STATUS', 'CANALIZADO')->join('USUARIOS', 'USUARIOS.ID = FOLIO.AGENTEATENCIONID')->join('ROLES', 'ROLES.ID = USUARIOS.ROLID')->findAll();
        } else {
            $data->folio = $this->_folioModel->asObject()->where('STATUS', 'CANALIZADO')->where('AGENTEATENCIONID', session('ID'))->join('USUARIOS', 'USUARIOS.ID = FOLIO.AGENTEATENCIONID')->join('ROLES', 'ROLES.ID = USUARIOS.ROLID')->findAll();
        }
        $data->rolPermiso = $this->_rolesPermisosModel->asObject()->where('ROLID', session('ROLID'))->findAll();

        $this->_loadView('Folios canalizados', 'folios', '', $data, 'folios_canalizados');
    }

    public function folios_en_proceso()
    {
        $data = (object) array();
        $data->folio = $this->_folioModel->asObject()->where('STATUS', 'EN PROCESO')->join('USUARIOS', 'USUARIOS.ID = FOLIO.AGENTEATENCIONID')->findAll();
        $data->rolPermiso = $this->_rolesPermisosModel->asObject()->where('ROLID', session('ROLID'))->findAll();

        $this->_loadView('Folios en proceso', 'folios', '', $data, 'folios_en_proceso');
    }

    public function liberar_folio()
    {
        $folio = $this->request->getVar('folio');
        $year = $this->request->getVar('year');

        $data = ['EXPEDIENTEID' => null, 'AGENTEATENCIONID' => null, 'AGENTEFIRMAID' => null, 'STATUS' => 'ABIERTO'];
        $this->_folioModel->set($data)->where('FOLIOID', $folio)->where('ANO', $year)->update();
        $datosBitacora = [
            'ACCION' => 'Ha liberado un folio',
            'NOTAS' => 'FOLIO: ' . $folio . ' AÑO: ' . $year
        ];
        $this->_bitacoraActividad($datosBitacora);
        return redirect()->to(base_url('/admin/dashboard/folios_en_proceso'));
    }

    public function folios_expediente()
    {
        $data = (object) array();
        $agente = $this->_usuariosModel->asObject()->where('ID', session('ID'))->first();
        $roles = [1, 3];
        if (in_array($agente->ROLID, $roles)) {
            $data->folio = $this->_folioModel->asObject()->where('EXPEDIENTEID !=', null)->where('AGENTEATENCIONID !=', null)->where('AGENTEFIRMAID !=', null)->join('USUARIOS', 'USUARIOS.ID = FOLIO.AGENTEATENCIONID')->join('ROLES', 'ROLES.ID = USUARIOS.ROLID')->findAll();
        } else {
            $data->folio = $this->_folioModel->asObject()->where('EXPEDIENTEID !=', null)->where('AGENTEATENCIONID', session('ID'))->where('AGENTEFIRMAID !=', null)->join('USUARIOS', 'USUARIOS.ID = FOLIO.AGENTEATENCIONID')->join('ROLES', 'ROLES.ID = USUARIOS.ROLID')->findAll();
        }
        $data->rolPermiso = $this->_rolesPermisosModel->asObject()->where('ROLID', session('ROLID'))->findAll();

        $this->_loadView('Folios expediente', 'folios', '', $data, 'folios_expediente');
    }

    public function folios_sin_firma()
    {
        $data = (object) array();
        $data->folio = $this->_folioModel->asObject()->where('EXPEDIENTEID !=', null)->where('AGENTEATENCIONID !=', null)->where('AGENTEFIRMAID', null)->join('USUARIOS', 'USUARIOS.ID = FOLIO.AGENTEATENCIONID')->join('ROLES', 'ROLES.ID = USUARIOS.ROLID')->findAll();
        $data->rolPermiso = $this->_rolesPermisosModel->asObject()->where('ROLID', session('ROLID'))->findAll();

        $this->_loadView('Expedientes sin firmar', 'folios', '', $data, 'folios_sin_firma');
    }

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

    public function getAllFolios()
    {
        $data = (object) array();
        $data = [
            'fechaInicio' => date("Y-m-d", strtotime('-1 month')),
            'fechaFin' => date("Y-m-d"),
        ];

        foreach ($data as $clave => $valor) {
            if (empty($valor)) {
                unset($data[$clave]);
            }
        }

        $municipio = $this->_municipiosModel->asObject()->where('ESTADOID', 2)->findAll();
        $resultFilter = $this->_folioModel->filterAllDates($data);
        $empleado = $this->_usuariosModel->asObject()->where('ROLID', 2)->orderBy('NOMBRE', 'ASC')->findAll();

        $dataView = (object) array();
        $dataView->result = $resultFilter->result;
        $dataView->municipios = $municipio;
        $dataView->empleados = $empleado;
        $dataView->filterParams = (object) $data;
        $dataView->rolPermiso = $this->_rolesPermisosModel->asObject()->where('ROLID', session('ROLID'))->findAll();


        $this->_loadView('Folios', 'folios', '', $dataView, 'buscar_folio');
    }

    public function getFilterFolios()
    {
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
        ];

        foreach ($data as $clave => $valor) {
            if (empty($valor)) {
                unset($data[$clave]);
            }
        }
        if (count($data) <= 0) {
            $data = [
                'fechaInicio' => date("Y-m-d", strtotime('-1 month')),
                'fechaFin' => date("Y-m-d"),
            ];
        }

        $municipio = $this->_municipiosModel->asObject()->where('ESTADOID', 2)->findAll();
        $resultFilter = $this->_folioModel->filterAllDates($data);
        $empleado = $this->_usuariosModel->asObject()->where('ROLID', 2)->orderBy('NOMBRE', 'ASC')->findAll();

        $dataView = (object) array();
        $dataView->result = $resultFilter->result;
        $dataView->municipios = $municipio;
        $dataView->empleados = $empleado;
        $dataView->filterParams = (object) $data;
        $dataView->rolPermiso = $this->_rolesPermisosModel->asObject()->where('ROLID', session('ROLID'))->findAll();

        $this->_loadView('Folios', 'folios', '', $dataView, 'buscar_folio');
    }

    public function viewFolio()
    {
        $data = (object) array();
        $data->folio = $this->request->getPost('folio');

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
        $data->tiposIdentificaciones = $this->_tipoIdentificacionModel->asObject()->findAll();
        $data->escolaridades = $this->_escolaridadModel->asObject()->findAll();
        $data->ocupaciones = $this->_ocupacionModel->asObject()->findAll();
        $data->colorVehiculo = $this->_coloresVehiculoModel->asObject()->findAll();
        $data->tipoVehiculo = $this->_tipoVehiculoModel->asObject()->orderBy('VEHICULOTIPODESCR', 'ASC')->findAll();
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
        $data->tipoExpediente = $this->_tipoExpedienteModel->asObject()->findAll();
		$data->distribuidorVehiculo = $this->_vehiculoDistribuidorModel->asObject()->findAll();
		$data->marcaVehiculo = $this->_vehiculoMarcaModel->asObject()->findAll();
		$data->lineaVehiculo = $this->_vehiculoModeloModel->asObject()->findAll();
		$data->versionVehiculo = $this->_vehiculoVersionModel->asObject()->findAll();
		$data->servicioVehiculo = $this->_vehiculoServicioModel->asObject()->findAll();
        $data->estadosExtranjeros = $this->_estadosExtranjeros->asObject()->findAll();
        $data->rolPermiso = $this->_rolesPermisosModel->asObject()->where('ROLID', session('ROLID'))->findAll();

        $this->_loadView('Video denuncia', 'videodenuncia', '', $data, 'ver_folio');
    }

    private function _loadView($title, $menu, $submenu, $data, $view)
    {
        $data2 = [
            'header_data' => (object) ['title' => $title, 'menu' => $menu, 'submenu' => $submenu],
            'body_data' => $data,
        ];

        echo view("admin/dashboard/folios/$view", $data2);
    }
    private function _bitacoraActividad($data)
    {
        $data = $data;
        $data['ID'] = uniqid();
        $data['USUARIOID'] = session('ID');


        $this->_bitacoraActividadModel->insert($data);
    }
}

/* End of file FoliosController.php */
/* Location: ./app/Controllers/admin/FoliosController.php */
