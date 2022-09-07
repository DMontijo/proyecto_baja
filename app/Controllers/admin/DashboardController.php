<?php

namespace App\Controllers\admin;

use App\Controllers\BaseController;
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


class DashboardController extends BaseController
{

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

        // $this->protocol = 'http://';
        // $this->ip = "10.144.244.223";
        $this->protocol = 'https://';
        $this->ip = "ws.fgebc.gob.mx";
        $this->endpoint = $this->protocol . $this->ip . '/wsJusticia';
    }

    public function index()
    {
        $data = (object) array();
        $agente = $this->_usuariosModel->asObject()->where('ID', session('ID'))->first();
        $roles = [1, 3];

        if (in_array($agente->ROLID, $roles)) {
            $data->cantidad_folios = count($this->_folioModel->asObject()->findAll());
            $data->cantidad_abiertos = count($this->_folioModel->asObject()->where('STATUS', 'ABIERTO')->findAll());
            $data->cantidad_derivados = count($this->_folioModel->asObject()->where('STATUS', 'DERIVADO')->findAll());
            $data->cantidad_canalizados = count($this->_folioModel->asObject()->where('STATUS', 'CANALIZADO')->findAll());
            $data->cantidad_expedientes = count($this->_folioModel->asObject()->where('EXPEDIENTEID !=', null)->where('AGENTEATENCIONID !=', null)->where('AGENTEFIRMAID !=', null)->findAll());
            $data->cantidad_expedientes_no_firmados = count($this->_folioModel->asObject()->where('EXPEDIENTEID !=', null)->where('AGENTEATENCIONID !=', null)->where('AGENTEFIRMAID', null)->findAll());
        } else {
            $data->cantidad_folios = count($this->_folioModel->asObject()->where('AGENTEATENCIONID', session('ID'))->findAll());
            $data->cantidad_abiertos = count($this->_folioModel->asObject()->where('AGENTEATENCIONID', session('ID'))->where('STATUS', 'ABIERTO')->findAll());
            $data->cantidad_derivados = count($this->_folioModel->asObject()->where('AGENTEATENCIONID', session('ID'))->where('STATUS', 'DERIVADO')->findAll());
            $data->cantidad_canalizados = count($this->_folioModel->asObject()->where('AGENTEATENCIONID', session('ID'))->where('STATUS', 'CANALIZADO')->findAll());
            $data->cantidad_expedientes = count($this->_folioModel->asObject()->where('AGENTEATENCIONID', session('ID'))->where('EXPEDIENTEID !=', null)->where('AGENTEATENCIONID !=', null)->where('AGENTEFIRMAID !=', null)->findAll());
            $data->cantidad_expedientes_no_firmados = count($this->_folioModel->asObject()->where('EXPEDIENTEID !=', null)->where('AGENTEATENCIONID !=', null)->where('AGENTEFIRMAID', null)->findAll());
        }
        $this->_loadView('Principal', 'dashboard', '', $data, 'index');
    }

    public function usuarios()
    {
        $data = (object) array();
        $data = $this->_usuariosModel->asObject()
            ->select('USUARIOS.ID,USUARIOS.NOMBRE, USUARIOS.APELLIDO_PATERNO, USUARIOS.APELLIDO_MATERNO, USUARIOS.SEXO, USUARIOS.CORREO, USUARIOS.PASSWORD, USUARIOS.USUARIOVIDEO, USUARIOS.TOKENVIDEO, USUARIOS.HUELLA_DIGITAL, USUARIOS.CERTIFICADOFIRMA, USUARIOS.KEYFIRMA, USUARIOS.FRASEFIRMA, ZONAS_USUARIOS.NOMBRE_ZONA, ROLES.NOMBRE_ROL')
            ->join('ROLES', 'ROLES.ID = USUARIOS.ROLID')
            ->join('ZONAS_USUARIOS', 'ZONAS_USUARIOS.ID_ZONA = USUARIOS.ZONAID')
            ->where('ROLID !=', 1)
            ->findAll();
        $this->_loadView('Usuarios', 'usuarios', '', $data, 'users/users');
    }

    public function usuarios_activos()
    {
        $data = (object) array();
        $this->_loadView('Usuarios activos', 'usuarios_activos', '', $data, 'usuarios_activos');
    }

    public function firmas()
    {
        $data = (object) array();
        $data = $this->_usuariosModel->asObject()->join('ROLES', 'ROLES.ID = USUARIOS.ROLID')->join('ZONAS_USUARIOS', 'ZONAS_USUARIOS.ID_ZONA = USUARIOS.ZONAID')->findAll();
        $this->_loadView('Firmar documentos', 'firmar', '', $data, 'signs');
    }

    public function nuevo_usuario()
    {
        $data = (object) array();
        $data->zonas = $this->_zonasUsuariosModel->asObject()->where('NOMBRE_ZONA !=', 'SUPERUSUARIO')->findAll();
        $data->roles = $this->_rolesUsuariosModel->asObject()->where('NOMBRE_ROL !=', 'SUPERUSUARIO')->findAll();
        $this->_loadView('Nuevo usuario', '', '', $data, 'users/new_user');
    }

    public function editar_usuario()
    {
        $id = $this->request->getGet('id');
        $data = (object) array();
        $data->zonas = $this->_zonasUsuariosModel
            ->asObject()
            ->where('NOMBRE_ZONA !=', 'SUPERUSUARIO')
            ->findAll();
        $data->roles = $this->_rolesUsuariosModel
            ->asObject()
            ->where('NOMBRE_ROL !=', 'SUPERUSUARIO')
            ->findAll();
        $data->usuario = $this->_usuariosModel->asObject()->where('ID', $id)->first();
        $this->_loadView('Nuevo usuario', '', '', $data, 'users/edit_user');
    }

    public function denuncia_anonima()
    {
        $data = (object) array();
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
            'NOMBRE' => $this->request->getPost('nombre_usuario'),
            'APELLIDO_PATERNO' => $this->request->getPost('apellido_paterno_usuario'),
            'APELLIDO_MATERNO' => $this->request->getPost('apellido_materno_usuario'),
            'CORREO' => $this->request->getPost('correo_usuario'),
            'PASSWORD' => hashPassword($this->request->getPost('password_usuario')),
            'SEXO' => $this->request->getPost('sexo_usuario'),
            'ROLID' => $this->request->getPost('rol_usuario'),
            'ZONAID' => $this->request->getPost('zona_usuario'),
            'HUELLA_DIGITAL' => null,
            'CERTIFICADOFIRMA' => null,
            'KEYFIRMA' => null,
            'FRASEFIRMA' => null,
        ];
        $usuario = ($this->_getUnusedUsersVideo())[0];

        $datosBitacora = [
            'ACCION' => 'Ha creado un usuario',
            'NOTAS' => 'CORREO CREADO: ' . $this->request->getPost('correo'),
        ];

        if ($this->validate(['correo_usuario' => 'required|valid_email|is_unique[USUARIOS.CORREO]'])) {
            $videoUser = $this->_updateUserVideo($usuario->ID, 'LIC. ' . $data['NOMBRE'], $data['APELLIDO_PATERNO'] . ' ' . $data['APELLIDO_MATERNO'], $data['CORREO'], $data['SEXO'], 'agente');
            $data['USUARIOVIDEO'] = $videoUser->ID;
            $data['TOKENVIDEO'] = $videoUser->Token;
            $this->_usuariosModel->insert($data);
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
            'NOMBRE' => $this->request->getPost('nombre_usuario'),
            'APELLIDO_PATERNO' => $this->request->getPost('apellido_paterno_usuario'),
            'APELLIDO_MATERNO' => $this->request->getPost('apellido_materno_usuario'),
            'CORREO' => $this->request->getPost('correo_usuario'),
            'SEXO' => $this->request->getPost('sexo_usuario'),
            'ROLID' => $this->request->getPost('rol_usuario'),
            'ZONAID' => $this->request->getPost('zona_usuario'),
        ];

        if ($usuario) {
            $videoUser = $this->_updateUserVideo($usuario->USUARIOVIDEO, 'LIC. ' . $data['NOMBRE'], $data['APELLIDO_PATERNO'] . ' ' . $data['APELLIDO_MATERNO'], $data['CORREO'], $data['SEXO'], 'agente');
            $data['USUARIOVIDEO'] = $videoUser->ID;
            $data['TOKENVIDEO'] = $videoUser->Token;
            $this->_usuariosModel->set($data)->where('ID', $id)->update();
            return redirect()->to(base_url('/admin/dashboard/usuarios'))->with('message_success', 'Usuario actualizado correctamente.');
        } else {
            return redirect()->back()->with('message_error', 'Usuario no actualizado.');
        }
    }

    public function folios()
    {
        $data = (object) array();
        $data = $this->_folioModel->asObject()->findAll();
        $this->_loadView('Folios no atendidos', 'folios', '', $data, 'folios');
    }

    public function perfil()
    {
        $data = (object) array();
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
                    $data->preguntas_iniciales = $this->_folioPreguntasModel->where('FOLIOID', $numfolio)->where('ANO', $year)->first();
                    $data->personas = $this->_folioPersonaFisicaModel->get_by_folio($numfolio, $year);
                    $data->parentescoRelacion = $this->_parentescoPersonaFisicaModel->where('FOLIOID', $numfolio)->where('ANO', $year)->findAll();
                    $data->personaiduno = $this->_parentescoPersonaFisicaModel->get_personaFisicaUno($numfolio, $year);
                    $data->personaidDos = $this->_parentescoPersonaFisicaModel->get_personaFisicaDos($numfolio, $year);
                    $data->parentesco = $this->_parentescoPersonaFisicaModel->get_Parentesco($numfolio, $year);

                    $data->vehiculos = $this->_folioVehiculoModel->get_by_folio($numfolio, $year);

                    $this->_folioModel->set(['STATUS' => 'EN PROCESO', 'AGENTEATENCIONID' => session('ID')])->where('ANO', $year)->where('FOLIOID', $numfolio)->update();
                    $datosBitacora = [
                        'ACCION' => 'Está atendiendo un folio',
                        'NOTAS' => 'FOLIO: ' . $numfolio . ' AÑO: ' . $year,
                    ];
                    $this->_bitacoraActividad($datosBitacora);
                    return json_encode($data);
                } else if ($data->folio->STATUS == 'EN PROCESO') {
                    return json_encode(['status' => 2, 'motivo' => 'EL FOLIO YA ESTA SIENDO ATENDIDO']);
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

                if ($data->folio->STATUS == 'ABIERTO' || $data->folio->STATUS == 'EN PROCESO') {
                    $data->agente = $this->_usuariosModel->asObject()->where('ID', $data->folio->AGENTEATENCIONID)->first();
                }
                return json_encode($data);
            } else {
                return json_encode(['status' => 0, 'motivo' => 'El folio ' . $numfolio . ' del año ' . $year . ' no existe.']);
            }
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

                $data->status = 1;
                return json_encode($data);
            } catch (\Exception $e) {
                return json_encode(['status' => 0]);
            }
        } else {
            return json_encode(['status' => 0]);
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
        $data->personafisica = $this->_folioPersonaFisicaModel->asObject()->where('FOLIOID', $data->folio)->where('ANO', $year)->findAll();


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
        $agenteId = session('ID') ? session('ID') : 1;

        $data = [
            'STATUS' => $status == 'ATENDIDA' ? 'CANALIZADO' : $status,
            'NOTASAGENTE' => $motivo,
            'AGENTEATENCIONID' => $agenteId,
            'FECHASALIDA' => date('Y-m-d H:i:s'),
        ];
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
            $folioRow = $this->_folioModel->where('ANO', $year)->where('FOLIOID', $folio)->where('STATUS', 'EN PROCESO')->first();
            if ($folioRow) {
                $empleadoRow = $this->_empleadosModel->asObject()->where('MUNICIPIOID', $municipio)->where('OFICINAID', $oficina)->where('EMPLEADOID', $empleado)->first();
                $personas = $this->_folioPersonaFisicaModel->where('FOLIOID', $folioRow['FOLIOID'])->where('ANO', $year)->orderBy('PERSONAFISICAID', 'asc')->findAll();
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

                $folioRow['OFICINAIDRESPONSABLE'] = $oficina;
                $folioRow['EMPLEADOIDREGISTRO'] = $empleado;
                $folioRow['AREAIDREGISTRO'] = $empleadoRow->AREAID;
                $folioRow['AREAIDRESPONSABLE'] = $empleadoRow->AREAID;
                $folioRow['ESTADOJURIDICOEXPEDIENTEID'] = (string) 2;
                $folioRow['TIPOEXPEDIENTEID'] = 4;

                $expedienteCreado = $this->createExpediente($folioRow);

                // return json_encode(['info' => $expedienteCreado]);

                unset($folioRow['OFICINAIDRESPONSABLE']);
                unset($folioRow['EMPLEADOIDREGISTRO']);
                unset($folioRow['AREAIDREGISTRO']);
                unset($folioRow['AREAIDRESPONSABLE']);
                unset($folioRow['ESTADOJURIDICOEXPEDIENTEID']);
                unset($folioRow['TIPOEXPEDIENTEID']);

                $folioRow['HECHONARRACION'] = $narracion;
                $folioRow['HECHOFECHA'] = $fecha;

                try {
                    if ($expedienteCreado->status == 201) {
                        $folioRow['EXPEDIENTEID'] = $expedienteCreado->EXPEDIENTEID;
                        $folioRow['FECHASALIDA'] = date('Y-m-d H:i:s');

                        $update = $this->_folioModel->set($folioRow)->where('FOLIOID', $folio)->where('ANO', $year)->update();

                        try {
                            foreach ($personas as $key => $persona) {
                                $_persona = $this->createPersonaFisica($expedienteCreado->EXPEDIENTEID, $persona, $folioRow['HECHOMUNICIPIOID']);

                                $domicilios = $this->_folioPersonaFisicaDomicilioModel->where('FOLIOID', $folioRow['FOLIOID'])->where('ANO', $year)->where('PERSONAFISICAID', $persona['PERSONAFISICAID'])->findAll();
                                if ($persona['CALIDADJURIDICAID'] == '2') {
                                    $_imputado = $this->createExpImputado($expedienteCreado->EXPEDIENTEID, $_persona->PERSONAFISICAID, $folioRow['HECHOMUNICIPIOID']);
                                }

                                foreach ($domicilios as $key => $domicilio) {
                                    $_domicilio = $this->createDomicilioPersonaFisica($expedienteCreado->EXPEDIENTEID, 1, $domicilio, $folioRow['HECHOMUNICIPIOID']);
                                }
                            }
                        } catch (\Exception $e) {
                        }

                        if ($update) {
                            $denunciante = $this->_denunciantesModel->asObject()->where('DENUNCIANTEID', $folioRow['DENUNCIANTEID'])->first();
                            if ($this->_sendEmailExpediente($denunciante->CORREO, $folio, $expedienteCreado->EXPEDIENTEID)) {
                                return json_encode(['status' => 1, 'expediente' => $expedienteCreado->EXPEDIENTEID]);
                            } else {
                                return json_encode(['status' => 1, 'expediente' => $expedienteCreado->EXPEDIENTEID, 'message' => 'Correo no enviado']);
                            }
                        } else {
                            return json_encode(['status' => 0, 'error' => 'No hizo el update']);
                        }
                    } else {
                        return json_encode(['status' => 0, 'error' => 'Expediente no creado']);
                    }
                } catch (\Exception $e) {
                    return json_encode(['status' => 0, 'error' => 'Expediente no creado']);
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
            'TIEMPORESIDEDIAS',
            "PERSONAESCOLARIDADID",
            "OCUPACIONID",
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

        return $this->curlPost($endpoint, $data);
    }

    private function createExpImputado($expedienteId, $personaFisicaId, $municipio)
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

        return $this->curlPost($endpoint, $data);
    }

    private function createDomicilioPersonaFisica($expedienteId, $personaFisicaId, $domicilioPersonaFisica, $municipio)
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
            if ($data['COLONIAID'] != 0) {
                unset($data['COLONIADESCR']);
            }
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

            return $this->curlPost($endpoint, $data);
        } else {
            return false;
        }
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

        if ($result === false) {
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

    public function getActiveUsers()
    {
        $endpoint = 'https://videodenunciaserver1.fgebc.gob.mx/api/user';
        $data = array();
        $data['u'] = '24';
        $data['token'] = '198429b7cc8a2a5733d97bc13153227dd5017555';
        $data['a'] = 'status';

        $response = $this->curlPost($endpoint, $data);
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

        $response = $this->curlPost($endpoint, $data);
        $unused_users = array();

        foreach ($response->data as $key => $user) {
            if (strtoupper($user->Nombre) == 'USUARIO') {
                array_push($unused_users, $user);
            }
        }

        sort($unused_users);
        return $unused_users;
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

            $response = $this->curlPost($endpoint, $data);

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
            } else {
                $dataFolio['HECHOCOLONIAID'] = (int) $this->request->getPost('colonia_delito_select');
                $dataFolio['HECHOCOLONIADESCR'] = null;
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
            $id = trim($this->request->getPost('pf_id'));
            $folio = trim($this->request->getPost('folio'));
            $year = trim($this->request->getPost('year'));

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

            $update = $this->_folioPersonaFisicaModel->set($data)->where('FOLIOID', $folio)->where('ANO', $year)->where('PERSONAFISICAID', $id)->update();

            if ($update) {

                $personas = $this->_folioPersonaFisicaModel->get_by_folio($folio, $year);
                $datosBitacora = [
                    'ACCION' => 'Ha actualizado a una persona fisica',
                    'NOTAS' => 'FOLIO: ' . $folio . ' AÑO: ' . $year . ' PERSONAFISICAID: ' . $id,
                ];

                $this->_bitacoraActividad($datosBitacora);

                return json_encode(['status' => 1, 'personas' => $personas]);
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
            $data = array(
                'id' => trim($this->request->getPost('pf_id')),
                'folio' => trim($this->request->getPost('folio')),
                'year' => trim($this->request->getPost('year')),
                'CP' => $this->request->getPost('cp_pfd'),
                'PAIS' => $this->request->getPost('pais_pfd'),
                'ESTADOID' => $this->request->getPost('estado_pfd'),
                'MUNICIPIOID' => $this->request->getPost('municipio_pfd'),
                'LOCALIDADID' => $this->request->getPost('localidad_pfd'),
                'ZONA' => $this->request->getPost('zona_pfd'),
                'COLONIAID' => $this->request->getPost('colonia_pfd_select'),
                'COLONIADESCR' => $this->request->getPost('colonia_pfd'),
                'CALLE' => $this->request->getPost('calle_pfd'),
                'NUMEROCASA' => $this->request->getPost('exterior_pfd'),
                'NUMEROINTERIOR' => $this->request->getPost('interior_pfd'),
                'REFERENCIA' => $this->request->getPost('referencia_pfd'),
            );
            if ((int)$data['COLONIAID'] == 0) {
                $data['COLONIAID'] = null;
            } else {
                $data['COLONIADESCR'] = null;
            }

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
                    'ACCION' => 'Ha actualizado la media filiacion de una persona fisica',
                    'NOTAS' => 'FOLIO: ' . $folio . ' AÑO: ' . $year . ' PERSONAFISICAID: ' . $id,
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
    public function updateVehiculoByFolio()
    {
        try {

            $folio = trim($this->request->getPost('folio'));
            $year = trim($this->request->getPost('year'));
            $data = array(
                'folio' => trim($this->request->getPost('folio')),
                'year' => trim($this->request->getPost('year')),
                'TIPOID' => $this->request->getPost('tipo_vehiculo'),
                'PRIMERCOLORID' => $this->request->getPost('color_vehiculo'),
                'SENASPARTICULARES' => $this->request->getPost('description_vehiculo'),



            );

            $update = $this->_folioVehiculoModel->set($data)->where('FOLIOID', $folio)->where('ANO', $year)->update();

            if ($update) {
                $datosBitacora = [
                    'ACCION' => 'Ha actualizado el vehículo de una persona fisica',
                    'NOTAS' => 'FOLIO: ' . $folio . ' AÑO: ' . $year,
                ];

                $this->_bitacoraActividad($datosBitacora);

                return json_encode(['status' => 1]);
            } else {
                return json_encode(['status' => 0, 'message' => $update]);
            }
        } catch (\Exception $e) {
            return json_encode(['status' => 0]);
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
    public function createParentescoByFolio()
    {


        $folio = trim($this->request->getPost('folio'));
        $year = trim($this->request->getPost('year'));
        $dataRelacionParentesco = array(
            'FOLIOID' => $this->request->getPost('folio'),
            'ANO' => $this->request->getPost('year'),
            'PERSONAFISICAID1' => $this->request->getPost('personaFisica1'),
            'PARENTESCOID' => $this->request->getPost('parentesco_mf'),
            'PERSONAFISICAID2' => $this->request->getPost('personaFisica2'),

        );

        $insertRelacionParentesco = $this->_parentescoPersonaFisicaModel->insert($dataRelacionParentesco);

        if ($insertRelacionParentesco) {
            $parentescoRelacion = $this->_parentescoPersonaFisicaModel->where('FOLIOID', $folio)->where('ANO', $year)->findAll();
            $personaiduno = $this->_parentescoPersonaFisicaModel->get_personaFisicaUno($folio, $year);
            $personaidDos = $this->_parentescoPersonaFisicaModel->get_personaFisicaDos($folio, $year);
            $parentesco = $this->_parentescoPersonaFisicaModel->get_Parentesco($folio, $year);
            $datosBitacora = [
                'ACCION' => 'Ha ingresado un nuevo parentesco a una persona fisica',
                'NOTAS' => 'FOLIO: ' . $folio . ' AÑO: ' . $year,
            ];

            $this->_bitacoraActividad($datosBitacora);

            return json_encode(['status' => 1, 'parentescoRelacion' => $parentescoRelacion, 'personaiduno' => $personaiduno, 'personaidDos' => $personaidDos, 'parentesco' => $parentesco]);
        } else {
            return json_encode(['status' => 0, 'message' => $_POST]);
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
        }
        return json_encode(['status' => 0]);
    }
    private function _bitacoraActividad($data)
    {
        $data = $data;
        $data['ID'] = uniqid();
        $data['USUARIOID'] = session('ID');


        $this->_bitacoraActividadModel->insert($data);
    }
}

/* End of file DashboardController.php */
/* Location: ./app/Controllers/admin/DashboardController.php */
