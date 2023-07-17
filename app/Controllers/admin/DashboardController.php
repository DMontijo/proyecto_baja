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
use App\Models\SesionesDenunciantesModel;
use App\Models\SesionesModel;
use App\Models\TipoExpedienteModel;
use App\Models\TipoMonedaModel;
use App\Models\VehiculoDistribuidorModel;
use App\Models\VehiculoMarcaModel;
use App\Models\VehiculoModeloModel;
use App\Models\VehiculoServicioModel;
use App\Models\VehiculoSituacionModel;
use App\Models\VehiculoVersionModel;

use \Mpdf\Mpdf;
use RtfHtmlPhp\Document;
use RtfHtmlPhp\Html\HtmlFormatter;
use PHPRtfLite;
use PHPRtfLite_Font;
use PHPRtfLite_ParFormat;

use Aws\S3\S3Client;
use FFMpeg\FFMpeg;
use FFMpeg\FFProbe;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\InflateStream;
use Dompdf\Dompdf;
use Dompdf\Options;
use stdClass;

use MailerSend\MailerSend;
use MailerSend\Helpers\Builder\Recipient;
use MailerSend\Helpers\Builder\EmailParams;
use MailerSend\Exceptions\MailerSendValidationException;
use MailerSend\Exceptions\MailerSendRateLimitException;

class DashboardController extends BaseController
{
	private $db_read;

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
	private $_situacionVehiculoModel;
	private $_sesionesModel;
	private $_sesionesDenunciantesModel;


	//Reader
	private $_folioModelRead;
	private $_folioDocModelRead;
	private $_sesionesModelRead;
	private $_sesionesDenunciantesModelRead;
	private $_rolesPermisosModelRead;
	private $_usuariosModelRead;
	private $_rolesUsuariosModelRead;
	private $_permisosModelRead;
	private $_archivoExternoModelRead;
	private $_zonasUsuariosModelRead;
	private $_municipiosModelRead;
	private $_oficinasModelRead;

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
	private $_situacionVehiculoModelRead;
	private $_delitoModalidadModelRead;
	private $_plantillasModelRead;
	private $_derivacionesAtencionesModelRead;
	private $_folioPreguntasModelRead;
	private $_folioPersonaFisicaModelRead;
	private $_folioVehiculoModelRead;
	private $_parentescoPersonaFisicaModelRead;
	private $_relacionIDOModelRead;
	private $_imputadoDelitoModelRead;
	private $_folioObjetoInvolucradoModelRead;
	private $_folioPersonaFisicaDomicilioModelRead;
	private $_folioMediaFiliacionRead;
	private $_localidadesModelRead;
	private $_coloniasModelRead;
	private $_empleadosModelRead;
	private $_bandejaRacModelRead;
	private $_denunciantesModelRead;
	private $_canalizacionesAtencionesModelRead;
	private $_relacionFolioDocModelRead;
	private $_relacionFolioDocExpDocRead;
	private $_conexionesDBModelRead;
	private $_folioConsecutivoModelRead;

	private $protocol;
	private $ip;
	private $endpoint;
	private $urlApi;

	public function __construct()
	{
		//Conexion de lectura
		$this->db_read = ENVIRONMENT == 'production' ? db_connect('default_read') : db_connect('development_read');

		//Models writer
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

		$this->_situacionVehiculoModel = new VehiculoSituacionModel();
		$this->_folioConsecutivoModel = new FolioConsecutivoModel();
		$this->_relacionFolioDocExpDoc = new RelacionFolioDocExpDocModel();

		$this->_derivacionesAtencionesModel = new DerivacionesModel();
		$this->_canalizacionesAtencionesModel = new CanalizacionesModel();

		$this->_bandejaRacModel = new BandejaRacModel();
		$this->_sesionesModel = new SesionesModel();
		$this->_sesionesDenunciantesModel = new SesionesDenunciantesModel();

		//Models reader
		$this->_folioModelRead = model('FolioModel', true, $this->db_read);
		$this->_folioDocModelRead = model('FolioDocModel', true, $this->db_read);
		$this->_sesionesModelRead = model('SesionesModel', true, $this->db_read);
		$this->_sesionesDenunciantesModelRead = model('SesionesDenunciantesModel', true, $this->db_read);
		$this->_rolesPermisosModelRead = model('RolesPermisosModel', true, $this->db_read);
		$this->_usuariosModelRead = model('UsuariosModel', true, $this->db_read);
		$this->_rolesUsuariosModelRead = model('RolesUsuariosModel', true, $this->db_read);
		$this->_permisosModelRead = model('PermisosModel', true, $this->db_read);
		$this->_archivoExternoModelRead = model('FolioArchivoExternoModel', true, $this->db_read);
		$this->_zonasUsuariosModelRead = model('ZonasUsuariosModel', true, $this->db_read);
		$this->_municipiosModelRead = model('MunicipiosModel', true, $this->db_read);
		$this->_oficinasModelRead = model('OficinasModel', true, $this->db_read);
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
		$this->_plantillasModelRead = model('PlantillasModel', true, $this->db_read);
		$this->_delitoModalidadModelRead = model('DelitoModalidadModel', true, $this->db_read);
		$this->_derivacionesAtencionesModelRead = model('DerivacionesModel', true, $this->db_read);
		$this->_folioPreguntasModelRead = model('FolioPreguntasModel', true, $this->db_read);
		$this->_folioPersonaFisicaModelRead = model('FolioPersonaFisicaModel', true, $this->db_read);
		$this->_parentescoPersonaFisicaModelRead = model('PersonaFisicaParentescoModel', true, $this->db_read);
		$this->_relacionIDOModelRead = model('FolioRelacionFisFisModel', true, $this->db_read);
		$this->_folioVehiculoModelRead = model('FolioVehiculoModel', true, $this->db_read);
		$this->_imputadoDelitoModelRead = model('FolioPersonaFisImpDelitoModel', true, $this->db_read);
		$this->_folioObjetoInvolucradoModelRead = model('FolioObjetoModel', true, $this->db_read);
		$this->_folioPersonaFisicaDomicilioModelRead = model('FolioPersonaFisicaDomicilioModel', true, $this->db_read);
		$this->_folioMediaFiliacionRead = model('FolioPersonaFisicaMediaFiliacionModel', true, $this->db_read);
		$this->_localidadesModelRead = model('LocalidadesModel', true, $this->db_read);
		$this->_coloniasModelRead = model('ColoniasModel', true, $this->db_read);
		$this->_empleadosModelRead = model('EmpleadosModel', true, $this->db_read);
		$this->_bandejaRacModelRead = model('BandejaRacModel', true, $this->db_read);
		$this->_denunciantesModelRead = model('DenunciantesModel', true, $this->db_read);
		$this->_canalizacionesAtencionesModelRead = model('CanalizacionesModel', true, $this->db_read);
		$this->_relacionFolioDocModelRead = model('RelacionFolioDocModel', true, $this->db_read);
		$this->_relacionFolioDocExpDocRead = model('RelacionFolioDocExpDocModel', true, $this->db_read);
		$this->_conexionesDBModelRead = model('ConexionesDBModel', true, $this->db_read);
		$this->_folioConsecutivoModelRead = model('FolioConsecutivoModel', true, $this->db_read);
		$this->_situacionVehiculoModelRead = model('VehiculoSituacionModel', true, $this->db_read);

		// $this->protocol = 'http://';
		// $this->ip = "10.144.244.223";
		// $this->endpoint = $this->protocol . $this->ip . '/webServiceVD';
		$this->protocol = 'https://';
		$this->ip = "ws.fgebc.gob.mx";
		$this->endpoint = $this->protocol . $this->ip . '/webServiceVD';
		$this->urlApi = VIDEOCALL_URL;
	}

	/**
	 * Vista de Dashboard Admin
	 * Retorna las cantidades visualizadas al inicio de la plataforma.
	 *
	 */
	public function index()
	{
		$data = (object) array();
		$agente = $this->_usuariosModel->asObject()->where('ID', session('ID'))->first();
		$roles = [1, 2, 6, 7, 9, 11];

		if (in_array($agente->ROLID, $roles)) {
			$data->cantidad_folios = count($this->_folioModelRead->asObject()->findAll());
			$data->cantidad_abiertos = count($this->_folioModelRead->asObject()->where('STATUS', 'ABIERTO')->findAll());
			$data->cantidad_derivados = count($this->_folioModelRead->asObject()->where('STATUS', 'DERIVADO')->where('FECHASALIDA BETWEEN "' . date('Y-m-d') . ' 00:00:00' . '" and "' . date('Y-m-d', strtotime("+ 1 day")) . ' 00:00:00' . '"')->findAll());
			$data->cantidad_canalizados = count($this->_folioModelRead->asObject()->where('STATUS', 'CANALIZADO')->where('FECHASALIDA BETWEEN "' . date('Y-m-d') . ' 00:00:00' . '" and "' . date('Y-m-d', strtotime("+ 1 day")) . ' 00:00:00' . '"')->findAll());
			$data->cantidad_expedientes = count($this->_folioModelRead->asObject()->where('EXPEDIENTEID !=', null)->where('AGENTEATENCIONID !=', null)->where('FECHASALIDA BETWEEN "' . date('Y-m-d') . ' 00:00:00' . '" and "' . date('Y-m-d', strtotime("+ 1 day")) . ' 00:00:00' . '"')->findAll());
			$data->cantidad_documentos = $this->_folioDocModelRead->countFoliosAsignados(session('ID'));
			$data->cantidad_expedientes_no_firmados = count($this->_folioModelRead->asObject()->where('EXPEDIENTEID !=', null)->where('AGENTEATENCIONID !=', null)->where('AGENTEFIRMAID', null)->findAll());
			$data->sesiones_admin = count($this->_sesionesModelRead->sesiones_abiertas()->result);
			$data->sesiones_denunciantes = count($this->_sesionesDenunciantesModelRead->sesiones_abiertas()->result);
			$data->rolPermiso = $this->_rolesPermisosModelRead->asObject()->where('ROLID', session('ROLID'))->findAll();
		} else {
			$data->cantidad_folios = count($this->_folioModelRead->asObject()->where('AGENTEATENCIONID', session('ID'))->findAll());
			$data->cantidad_abiertos = count($this->_folioModelRead->asObject()->where('AGENTEATENCIONID', session('ID'))->where('STATUS', 'ABIERTO')->findAll());
			$data->cantidad_derivados = count($this->_folioModelRead->asObject()->where('AGENTEATENCIONID', session('ID'))->where('STATUS', 'DERIVADO')->where('FECHASALIDA BETWEEN "' . date('Y-m-d') . ' 00:00:00' . '" and "' . date('Y-m-d', strtotime("+ 1 day")) . ' 00:00:00' . '"')->findAll());
			$data->cantidad_canalizados = count($this->_folioModelRead->asObject()->where('AGENTEATENCIONID', session('ID'))->where('STATUS', 'CANALIZADO')->where('FECHASALIDA BETWEEN "' . date('Y-m-d') . ' 00:00:00' . '" and "' . date('Y-m-d', strtotime("+ 1 day")) . ' 00:00:00' . '"')->findAll());
			$data->cantidad_expedientes = count($this->_folioModelRead->asObject()->where('AGENTEATENCIONID', session('ID'))->where('EXPEDIENTEID !=', null)->where('AGENTEATENCIONID !=', null)->where('AGENTEFIRMAID !=', null)->where('FECHASALIDA BETWEEN "' . date('Y-m-d') . ' 00:00:00' . '" and "' . date('Y-m-d', strtotime("+ 1 day")) . ' 00:00:00' . '"')->findAll());
			$data->cantidad_expedientes_no_firmados = count($this->_folioModelRead->asObject()->where('EXPEDIENTEID !=', null)->where('AGENTEATENCIONID !=', null)->where('AGENTEFIRMAID', null)->findAll());
			$data->cantidad_documentos = $this->_folioDocModelRead->countFoliosAsignados(session('ID'));
			$data->sesiones_admin = count($this->_sesionesModelRead->sesiones_abiertas()->result);
			$data->sesiones_denunciantes = count($this->_sesionesDenunciantesModelRead->sesiones_abiertas()->result);
			$data->rolPermiso = $this->_rolesPermisosModelRead->asObject()->where('ROLID', session('ROLID'))->findAll();
		}
		$this->_loadView('Principal', 'dashboard', '', $data, 'index');
	}

	/**
	 * Vista de Usuarios Registrados
	 * Retorna los usuarios registrados en CDTEC detallando su perfil.
	 *
	 */
	public function usuarios()
	{
		$data = (object) array();
		if (!$this->permisos('USUARIOS')) {
			return redirect()->back()->with('message_error', 'Acceso denegado, no tienes los permisos necesarios.');
		}
		$data->usuario = $this->_usuariosModelRead->asObject()
			->select('USUARIOS.*, ROLES.NOMBRE_ROL, ZONAS_USUARIOS.NOMBRE_ZONA, MUNICIPIO.MUNICIPIODESCR,OFICINA.OFICINADESCR')
			->join('ROLES', 'ROLES.ID = USUARIOS.ROLID', 'LEFT')
			->join('ZONAS_USUARIOS', 'ZONAS_USUARIOS.ID_ZONA = USUARIOS.ZONAID', 'LEFT')
			->join('MUNICIPIO', 'MUNICIPIO.MUNICIPIOID = USUARIOS.MUNICIPIOID AND MUNICIPIO.ESTADOID = 2', 'LEFT')
			->join('OFICINA', 'OFICINA.OFICINAID = USUARIOS.OFICINAID AND OFICINA.MUNICIPIOID = USUARIOS.MUNICIPIOID AND OFICINA.ESTADOID = 2', 'LEFT')
			->where('ROLID !=', 1)
			->findAll();
		$data->rolPermiso = $this->_rolesPermisosModelRead->asObject()->where('ROLID', session('ROLID'))->findAll();

		$this->_loadView('Usuarios', 'usuarios', '', $data, 'users/users');
	}

	/**
	 * Vista de Roles
	 * Genera los permisos que tienen los diferentes roles en CDTEC.
	 * 
	 */

	public function asignacion_permisos()
	{
		$data = (object) array();

		if (!$this->permisos('ROLES')) {
			return redirect()->back()->with('message_error', 'Acceso denegado, no tienes los permisos necesarios.');
		}
		$data->rolPermiso = $this->_rolesPermisosModelRead->asObject()->where('ROLID', session('ROLID'))->findAll();

		$data->rolPermisoDescr = $this->_rolesPermisosModelRead->get_rol_permiso();

		$data->roles = $this->_rolesUsuariosModelRead->asObject()->findAll();
		$data->permisos = $this->_permisosModelRead->asObject()->findAll();

		$this->_loadView('Asignación de permisos', 'asignacion de permisos', '', $data, 'roles/asignacion_permisos');
	}
	/**
	 * Vista de Sesiones Activas.
	 * Carga todas las sesiones actividas de los usuarios de CDTEC y los denunciantes dentro de ella.
	 *
	 */
	public function sesiones_activas()
	{
		if (!$this->permisos('SESIONES')) {
			return redirect()->back()->with('message_error', 'Acceso denegado, no tienes los permisos necesarios.');
		}
		$data = (object) array();
		$data->sesionesAdmin = $this->_sesionesModelRead->sesiones_abiertas();
		$data->sesionesDenunciantes = $this->_sesionesDenunciantesModelRead->sesiones_abiertas();
		$data->rolPermiso = $this->_rolesPermisosModelRead->asObject()->where('ROLID', session('ROLID'))->findAll();

		$this->_loadView('Sesiones activas', 'sesiones', '', $data, 'sesiones_activas');
	}

	/**
	 * Funcion para cerrar sesiones (Denunciantes y Usuarios de CDTEC)
	 * Recibe por metodo GET el id del denunciante o del usuario y actualiza su tabla respectiva de sesiones para que esta sesión sea cerrada.
	 *
	 */
	public function cerrar_sesiones_general()
	{
		if (isset($_GET['id_denunciante'])) {
			$id_denunciante = $this->request->getGet('id_denunciante');
			$sesion_data = [
				'ACTIVO' => 0,
			];
			$update = $this->_sesionesDenunciantesModel->set($sesion_data)->where('ID_DENUNCIANTE', $id_denunciante)->update();
			if ($update) {
				return redirect()->to(base_url('/admin/dashboard/sesiones_activas'))->with('message_success', 'Se cerró la sesion correctamente');
			}
		}
		if (isset($_GET['id_usuario'])) {
			$id_usuario = $this->request->getGet('id_usuario');
			$sesion_data = [
				'ACTIVO' => 0,
			];
			$update = $this->_sesionesModel->set($sesion_data)->where('ID_USUARIO', $id_usuario)->update();
			if ($update) {
				return redirect()->to(base_url('/admin/dashboard/sesiones_activas'))->with('message_success', 'Se cerró la sesion correctamente');
			}
		}
	}
	/**
	 * Funcion para insertar archivos externos al folio desde el administrador
	 *
	 * Recibe el archivo y valida que no venga vacio, se obtiene las características de este archivo y los manda en un array para poder insertarlos a 
	 * la tabla correspondiente.
	 * Una vez insertados, regresa a la vista la actualizacion de archivos.
	 */
	public function crear_archivos_externos()
	{
		$documento = $this->request->getFile('documentoArchivo');
		if (empty($documento)) {
			return json_encode(['status' => 2]);
		}
		$doc = file_get_contents($documento);
		$f = finfo_open();
		$mime_type = finfo_buffer($f, $doc, FILEINFO_MIME_TYPE);
		$extension = explode('/', $mime_type)[1];

		$archivo = $_FILES['documentoArchivo']['name'];
		$nombre = $this->request->getPost('nombreDocumento');


		$data = (object) array();
		$folio = $this->request->getPost('folio');
		$year = $this->request->getPost('year');
		$data = [
			'FOLIOID' => $this->request->getPost('folio'),
			'ANO' => $this->request->getPost('year'),
			'ARCHIVODESCR' => strtoupper($nombre),
			'ARCHIVO' => $doc,
			'EXTENSION' => $extension,
		];
		$archivoExterno = $this->_folioExpArchivo($data, $folio, $year);
		if ($archivoExterno) {
			$datados = (object) array();

			$datados->archivosexternos = $this->_archivoExternoModelRead->asObject()->where('FOLIOID', $folio)->where('ANO', $year)->findAll();
			if ($datados->archivosexternos) {
				foreach ($datados->archivosexternos as $key => $archivos) {
					$file_info = new \finfo(FILEINFO_MIME_TYPE);
					$type = $file_info->buffer($archivos->ARCHIVO);
					$archivos->ARCHIVO = 'data:' . $type . ';base64,' . base64_encode($archivos->ARCHIVO);
				}
			}
			return json_encode(['status' => 1, 'archivos' => $datados]);
		} else {
			return json_encode(['status' => 0]);
		}
	}

	/**
	 * Funcion Archivos Externos.
	 * Verifica que exista algun archivo dentro de ese folio, si existe incrementa el FOLIOARCHIVOID y si no empieza desde el 1.
	 * * Se utiliza en la funcion crear_archivos_externos
	 *
	 * @param  mixed $data
	 * @param  mixed $folio
	 * @param  mixed $year
	 */
	private function _folioExpArchivo($data, $folio, $year)
	{
		$data = $data;
		$data['FOLIOID'] = $folio;
		$data['ANO'] = $year;


		$archivoExterno = $this->_archivoExternoModelRead->asObject()->where('FOLIOID', $folio)->where('ANO', $year)->orderBy('FOLIOARCHIVOID ', 'desc')->first();

		if ($archivoExterno) {
			$data['FOLIOARCHIVOID'] = ((int) $archivoExterno->FOLIOARCHIVOID) + 1;
			$archivoExterno = $this->_archivoExternoModel->insert($data);
			return $data['FOLIOARCHIVOID'];
		} else {
			$data['FOLIOARCHIVOID'] = 1;
			$archivoExterno = $this->_archivoExternoModel->insert($data);
			return $data['FOLIOARCHIVOID'];
		}
	}
	/**
	 * Vista de para la nueva asignacion de permisos
	 * Carga los roles y los permisos existentes.
	 *
	 */
	public function nuevo_asignacion_permiso()
	{
		$data = (object) array();
		$data->rolPermiso = $this->_rolesPermisosModelRead->asObject()->where('ROLID', session('ROLID'))->findAll();
		$data->roles = $this->_rolesUsuariosModelRead->asObject()->findAll();
		$data->permisos = $this->_permisosModelRead->asObject()->findAll();

		$this->_loadView('Nuevo asignacion de permisos', '', '', $data, 'roles/nueva_asignacion_rol');
	}

	/**
	 * Vista para agregar nuevos roles.
	 * Carga los roles ya existentes para que el usuario vea cuales ya estan y no se repitan.
	 *
	 */
	public function nuevo_rol()
	{
		$data = (object) array();
		$data->rolPermiso = $this->_rolesPermisosModelRead->asObject()->where('ROLID', session('ROLID'))->findAll();
		$data->roles = $this->_rolesUsuariosModelRead->asObject()->findAll();

		$data->permisos = $this->_permisosModelRead->asObject()->findAll();
		$this->_loadView('Nuevo rol', '', '', $data, 'roles/nuevo_rol');
	}

	/**
	 * Vista de usuarios activos para videodenuncia.
	 * Se accede a través del card en la página principal del administrador. (AGENTES ACTIVOS PARA VIDEODENUNCIA)
	 *
	 */
	public function usuarios_activos()
	{
		$data = (object) array();
		$data->rolPermiso = $this->_rolesPermisosModelRead->asObject()->where('ROLID', session('ROLID'))->findAll();

		$this->_loadView('Agentes activos', 'usuarios_activos', '', $data, 'usuarios_activos');
	}

	/**
	 * Vista de usuarios en llamada de videodenuncia.
	 * Se accede a través del card en la página principal del administrador.(AGENTES EN LLAMADA)
	 *	 
	 */
	public function usuarios_en_llamada()
	{
		$data = (object) array();
		$data->rolPermiso = $this->_rolesPermisosModelRead->asObject()->where('ROLID', session('ROLID'))->findAll();

		$this->_loadView('Agentes en llamada', 'usuarios_en_llamada', '', $data, 'usuarios_en_llamada');
	}

	/**
	 * Vista de cola de llamadas.
	 * Se accede a través del card en la página principal del administrador.(LLAMADAS EN FILA)
	 */
	public function lista_prioridad()
	{
		$data = (object) array();
		$data->rolPermiso = $this->_rolesPermisosModelRead->asObject()->where('ROLID', session('ROLID'))->findAll();

		$this->_loadView('Llamadas en fila', 'list_priority', '', $data, 'list_priority');
	}
	/**
	 * Vista de firmas
	 * ! Deprecated method, do not use.
	 *
	 */
	public function firmas()
	{
		$data = (object) array();
		$data->usuarios = $this->_usuariosModelRead->asObject()->join('ROLES', 'ROLES.ID = USUARIOS.ROLID')->join('ZONAS_USUARIOS', 'ZONAS_USUARIOS.ID_ZONA = USUARIOS.ZONAID')->findAll();
		$data->rolPermiso = $this->_rolesPermisosModelRead->asObject()->where('ROLID', session('ROLID'))->findAll();

		$this->_loadView('Firmar documentos', 'firmar', '', $data, 'signs');
	}

	/**
	 * Vista para agregar un nuevo usuario.
	 * Carga las zonas, municipios y roles.
	 *
	 */
	public function nuevo_usuario()
	{
		$data = (object) array();
		$data->zonas = $this->_zonasUsuariosModelRead->asObject()->where('NOMBRE_ZONA !=', 'SUPERUSUARIO')->findAll();
		$data->roles = $this->_rolesUsuariosModelRead->asObject()->where('NOMBRE_ROL !=', 'SUPERUSUARIO')->findAll();
		$data->municipios = $this->_municipiosModelRead->asObject()->where('ESTADOID', 2)->findAll();
		$data->rolPermiso = $this->_rolesPermisosModelRead->asObject()->where('ROLID', session('ROLID'))->findAll();

		$this->_loadView('Nuevo usuario', '', '', $data, 'users/new_user');
	}

	/**
	 * Funcion para asignar permisos a un rol.
	 * Recibe por metodo POST el rol y el permiso que se ligaran. Valida que no exista esa relación (para evitar repetir) y si no existe se insertan.
	 * Regresa los roles y los permisos para retornar a la vista de Permisos Registrados.
	 *
	 */
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
		$rolesPermiso = $this->_rolesPermisosModelRead->where('ROLID', $this->request->getPost('rol_usuario'))->where('PERMISOID', $this->request->getPost('permiso_rol'))->first();
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

	/**
	 * Función para crear roles.
	 * Recibe po metodo POST el nombre del rol, valida que no existe, y si no existe lo agrega.
	 * Regresa los roles y los permisos para retornar a la vista de Permisos Registrados.
	 */
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
		$roles = $this->_rolesUsuariosModelRead->where('NOMBRE_ROL', $this->request->getPost('rol_input'))->first();

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

	/**
	 * Función para eliminar permisos de un rol.
	 * Recibe por metodo GET el ROLID y el PERMISOID para su posterior eliminación
	 * Regresa los roles y los permisos para retornar a la vista de Permisos Registrados.
	 */
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

	/**
	 * Vista para editar un usuario.
	 * Recibe por metodo GET el ID del usuario a editar para cargar el formulario.
	 *
	 */
	public function editar_usuario()
	{
		$id = $this->request->getGet('id');
		if (!$id) {
			return redirect()->back()->with('message_error', 'No se envío el parámeto id.');
		}
		$data = (object) array();
		$data->zonas = $this->_zonasUsuariosModelRead->asObject()->where('NOMBRE_ZONA !=', 'SUPERUSUARIO')->findAll();
		$data->roles = $this->_rolesUsuariosModelRead->asObject()->where('NOMBRE_ROL !=', 'SUPERUSUARIO')->findAll();
		$data->municipios = $this->_municipiosModelRead->asObject()->where('ESTADOID', 2)->findAll();
		$data->usuario = $this->_usuariosModelRead->asObject()->where('ID', $id)->first();
		if (!$data->usuario) {
			return redirect()->back()->with('message_error', 'No existe el usuario a editar.');
		}
		$data->oficinas = $this->_oficinasModelRead->asObject()->where('MUNICIPIOID', $data->usuario->MUNICIPIOID)->orderBy('OFICINADESCR', 'asc')->findAll();
		$data->rolPermiso = $this->_rolesPermisosModelRead->asObject()->where('ROLID', session('ROLID'))->findAll();

		$this->_loadView('Editar usuario', '', '', $data, 'users/edit_user');
	}

	/**
	 * Vista para denuncia anonima.
	 * Regresa todo los catálogos necesarios para el consumo de esta vista.
	 *
	 */
	public function denuncia_anonima()
	{
		if (!$this->permisos('DENUNCIA ANONIMA')) {
			return redirect()->back()->with('message_error', 'Acceso denegado, no tienes los permisos necesarios.');
		}
		$data = (object) array();
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
		$data->estadosExtranjeros = $this->_estadosExtranjerosRead->asObject()->findAll();

		$data->tiposIdentificaciones = $this->_tipoIdentificacionModelRead->asObject()->findAll();
		$data->escolaridades = $this->_escolaridadModelRead->asObject()->findAll();
		$data->ocupaciones = $this->_ocupacionModelRead->asObject()->findAll();
		$data->colorVehiculo = $this->_coloresVehiculoModelRead->asObject()->findAll();
		$data->tipoVehiculo = $this->_tipoVehiculoModelRead->asObject()->orderBy('VEHICULOTIPODESCR', 'ASC')->findAll();

		$data->parentesco = $this->_parentescoModelRead->asObject()->findAll();
		$data->figura = $this->_figuraModelRead->asObject()->findAll();
		$data->situacionVehiculo = $this->_situacionVehiculoModelRead->asObject()->findAll();

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

		$data->plantillas = $this->_plantillasModelRead->asObject()->where('TITULO !=', 'CONSTANCIA DE EXTRAVIO')->where('ACTIVO', 1)->orderBy('TITULO', 'ASC')->findAll();
		$data->tipoExpediente = $this->_tipoExpedienteModelRead->asObject()->like('TIPOEXPEDIENTECLAVE', 'NUC')->orLike('TIPOEXPEDIENTECLAVE', 'NAC')->orLike('TIPOEXPEDIENTECLAVE', 'RAC')->findAll();
		$data->derivaciones = $this->_derivacionesAtencionesModelRead->asObject()->findAll();

		$data->distribuidorVehiculo = $this->_vehiculoDistribuidorModelRead->asObject()->findAll();
		$data->marcaVehiculo = $this->_vehiculoMarcaModelRead->asObject()->findAll();
		$data->lineaVehiculo = $this->_vehiculoModeloModelRead->asObject()->findAll();
		$data->versionVehiculo = $this->_vehiculoVersionModelRead->asObject()->findAll();
		$data->tipoVehiculo = $this->_tipoVehiculoModelRead->asObject()->findAll();
		$data->servicioVehiculo = $this->_vehiculoServicioModelRead->asObject()->findAll();
		$data->colorVehiculo = $this->_coloresVehiculoModelRead->asObject()->findAll();
		$data->rolPermiso = $this->_rolesPermisosModelRead->asObject()->where('ROLID', session('ROLID'))->findAll();
		$data->delitosModalidad = $this->_delitoModalidadModelRead->asObject()->orderBy('DELITOMODALIDADDESCR', 'ASC')->where('DELITOMODALIDADDESCR IS NOT NULL')->where('DELITOMODALIDADDESCR !=', '')->findAll();


		$this->_loadView('Denuncia anónima', 'denuncia_anonima', '', $data, 'denuncia_anonima');
	}

	/**
	 * Función para crear usuarios.
	 * Recibe por metodo POST todos los campos del formulario para la creación de un usuario.
	 * * Si el usuario es diferente de AGENTE DEL MINISTERIO PÚBLICO VISUALIZADOR, este usuario se agregará al servicio de videollamada
	 *
	 */
	public function crear_usuario()
	{

		if ($this->request->getPost('mun') != null) {
			$result = [];

			foreach ($this->request->getPost('ofi') as $datos) {
				// Separar el municipio y la oficina
				$parts = explode(',', $datos);
				$municipio = $parts[0];
				$oficina = $parts[1];

				// Crear un nuevo elemento en el resultado
				$result[] = [
					'MUNICIPIOID' => $municipio,
					'OFICINAID' => $oficina
				];
			}

			$data = [
				'NOMBRE' => $this->request->getPost('nombre_usuario'),
				'APELLIDO_PATERNO' => $this->request->getPost('apellido_paterno_usuario'),
				'APELLIDO_MATERNO' => $this->request->getPost('apellido_materno_usuario'),
				'CORREO' => $this->request->getPost('correo_usuario'),
				'PASSWORD' => hashPassword($this->request->getPost('password_usuario')),
				'SEXO' => $this->request->getPost('sexo_usuario'),
				'ROLID' => $this->request->getPost('rol_usuario'),
				'ZONAID' => $this->request->getPost('zona_usuario'),
				'MUNICIPIOSOFICINASID' => json_encode($result),
			];
		} else {
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
		}

		$datosBitacora = [
			'ACCION' => 'Ha creado un nuevo usuario en cdtec.',
			'NOTAS' => 'NUEVO USUARIO CREADO: ' . $this->request->getPost('correo'),
		];

		if ($this->validate(['correo_usuario' => 'required|valid_email|is_unique[USUARIOS.CORREO]'])) {
			if ($data['ROLID'] != '5') {
				try {
					$dataApi = array();
					$dataApi['names'] = $this->request->getPost('nombre_usuario');
					$dataApi['lastnames'] = $this->request->getPost('apellido_paterno_usuario') . ' ' .  $this->request->getPost('apellido_materno_usuario');
					$dataApi['email'] = $this->request->getPost('correo_usuario');
					$dataApi['role'] = 3;
					$dataApi['sex'] = $this->request->getPost('sexo_usuario') == 'F' ? "FEMALE" : 'MALE';
					$dataApi['languages'] = [22];
					$response = $this->_curlPostService($this->urlApi . 'agent/', $dataApi);
				} catch (\Throwable $th) {
					return redirect()->back()->with('message_error', 'Usuario no creado, hubo un error.');
				}

				if ($response->uuid) {
					$data['TOKENVIDEO'] = $response->uuid;
					try {
						$usuario = $this->_usuariosModel->insert($data);
					} catch (\Throwable $th) {
						return redirect()->back()->with('message_error', 'Usuario no creado, ya existe el correo ingresado.');
					}

					$this->_bitacoraActividad($datosBitacora);
					$this->_sendEmailPassword($data['CORREO'], $this->request->getPost('password'));
					return redirect()->to(base_url('/admin/dashboard/usuarios'))->with('message_success', 'Usuario registrado correctamente.');
				}
			} else {
				$data['TOKENVIDEO'] = NULL;
				try {
					$usuario = $this->_usuariosModel->insert($data);
				} catch (\Throwable $th) {
					return redirect()->back()->with('message_error', 'Usuario no creado.');
				}

				$this->_bitacoraActividad($datosBitacora);
				$this->_sendEmailPassword($data['CORREO'], $this->request->getPost('password'));
				return redirect()->to(base_url('/admin/dashboard/usuarios'))->with('message_success', 'Usuario registrado correctamente.');
			}
		} else {
			return redirect()->back()->with('message_error', 'Usuario no creado, ya existe el correo ingresado.');
		}
	}

	/**
	 * Función para actualizar a un usuario de CDTEC.
	 * Recibe por metodo POST todos los campos del formulario para la actualización de un usuario.
	 * * Si el usuario es diferente de AGENTE DEL MINISTERIO PÚBLICO VISUALIZADOR, este usuario se actualizará en el servicio de videollamada. Si se actualiza en este servicio, se actualizará en VIDEODENUNCIA.
	 */
	public function update_usuario()
	{
		$id = $this->request->getPost('id');
		$usuario = $this->_usuariosModelRead->asObject()->where('ID', $id)->first();
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
			if ($data['ROLID'] != '5') {
				try {
					try {
						$videoUser = $this->_updateUserVideo($usuario->TOKENVIDEO, $data['NOMBRE'], $data['APELLIDO_PATERNO'] . ' ' . $data['APELLIDO_MATERNO'], $data['CORREO'], $data['SEXO'], $data['ROLID']);
					} catch (\Throwable $th) {
						throw new \Exception('No se actualizo o no existe en el servidor de video.');
					}
					if ($videoUser->status == "sucess") {
						try {
							$this->_usuariosModel->set($data)->where('ID', $id)->update();
						} catch (\Throwable $th) {
							$videoUser = $this->_updateUserVideo($usuario->TOKENVIDEO,  $usuario->NOMBRE, $usuario->APELLIDO_PATERNO . ' ' . $usuario->APELLIDO_MATERNO, $usuario->CORREO, $usuario->SEXO, $usuario->ROLID);
							throw new \Exception('No se actualizo en base de datos.');
						}
					} else {
						throw new \Exception('No se actualizo en servidor de videodenuncia');
					}
				} catch (\Throwable $th) {
					return redirect()->back()->with('message_error', 'Usuario no actualizado en el servidor.');
				}

				return redirect()->to(base_url('/admin/dashboard/usuarios'))->with('message_success', 'Usuario actualizado correctamente.');
			} else {
				try {
					try {
						$data['TOKENVIDEO'] = NULL;
						$this->_usuariosModel->set($data)->where('ID', $id)->update();
					} catch (\Throwable $th) {
						throw new \Exception('No se actualizo en base de datos.');
					}
				} catch (\Throwable $th) {
					return redirect()->back()->with('message_error', 'Usuario no actualizado en el servidor.');
				}

				return redirect()->to(base_url('/admin/dashboard/usuarios'))->with('message_success', 'Usuario actualizado correctamente.');
			}
		} else {
			return redirect()->back()->with('message_error', 'Usuario no actualizado.');
		}
	}

	/**
	 * Función para modificar la contraseña de un usuario CDTEC.
	 * Recibe por metodo POST el id del usuario y la nueva contraseña. Esta se hashea para su posterior actualización en la tabla.
	 * * Está función permite que un usuario autorizado modifique la de otro usuario.
	 *
	 */
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
	/**
	 * Vista de folios no atendidos
	 * ! Deprecated method, do not use.
	 *
	 */
	public function folios()
	{
		$data = (object) array();
		$data = $this->_folioModelRead->asObject()->findAll();
		$data = (object) $data;
		$data->rolPermiso = $this->_rolesPermisosModelRead->asObject()->where('ROLID', session('ROLID'))->findAll();

		$this->_loadView('Folios no atendidos', 'folios', '', $data, 'folios');
	}

	/**
	 * Vista de perfil.
	 * Carga las zones, roles y permisos del usuario en sesión.
	 *
	 */
	public function perfil()
	{
		$data = (object) array();
		$data->zonas = $this->_zonasUsuariosModelRead->asObject()->findAll();
		$data->roles = $this->_rolesUsuariosModelRead->asObject()->findAll();
		$data->rolPermiso = $this->_rolesPermisosModelRead->asObject()->where('ROLID', session('ROLID'))->findAll();

		$this->_loadView('Perfil', 'perfil', '', $data, 'perfil');
	}
	/**
	 * Función para modificar la contraseña de un usuario CDTEC.
	 * Recibe por metodo POST la nueva contraseña. Esta se hashea para su posterior actualización en la tabla.
	 * * Está función permite que el usuario modifique su propia contraseña a través de su id
	 *
	 */
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

	/**
	 * Función para carga la firma FIEL.
	 * Recibe los archivos .key y .cer y los sube al sevidor en la carpeta de uploads. Si no existe, se crea el directorio. Y se le asigna el nombre a cada archivo para identificarlo por ID.
	 */
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

	/**
	 * Función para obtener la información del folio.
	 * * Importante para VIDEODENUNCIA Y VER FOLIO. (NO BORRAR)
	 * Recibe por metodo POST el folio, el año y si esta "buscado", cuando $search es diferente de true es para traer los datos del folio en la sección de VIDEODENUNCIA
	 * cuando es true entra en la sección de CONSULTA DE FOLIOS.
	 * Regresa todos los datos del folio a la vista correspondiente.
	 *
	 */
	public function getFolioInformation()
	{
		$data = (object) array();
		$numfolio = trim($this->request->getPost('folio'));
		$year = trim($this->request->getPost('year'));
		$search = $this->request->getPost('search');

		if ($search != 'true') {
			$data->folio = $this->_folioModelRead->asObject()->where('ANO', $year)->where('FOLIOID', $numfolio)->first();

			if ($data->folio) {
				if ($data->folio->STATUS == 'ABIERTO') {
					$data->status = 1;

					$data->respuesta = $this->getDataFolio($numfolio, $year);
					$this->_folioModel->set(['STATUS' => 'EN PROCESO', 'AGENTEATENCIONID' => session('ID')])->where('ANO', $year)->where('FOLIOID', $numfolio)->update();
					$datosBitacora = [
						'ACCION' => 'Solicito la información para atender un folio.',
						'NOTAS' => 'FOLIO: ' . $numfolio . ' AÑO: ' . $year,
					];
					$this->_bitacoraActividad($datosBitacora);
					return json_encode($data);
				} else if ($data->folio->STATUS == 'EN PROCESO' && $data->folio->AGENTEATENCIONID == session('ID')) {
					$data->status = 1;

					$data->respuesta = $this->getDataFolio($numfolio, $year);
					$this->_folioModel->set(['STATUS' => 'EN PROCESO', 'AGENTEATENCIONID' => session('ID')])->where('ANO', $year)->where('FOLIOID', $numfolio)->update();
					$datosBitacora = [
						'ACCION' => 'Solicito la información para atender un folio.',
						'NOTAS' => 'FOLIO: ' . $numfolio . ' AÑO: ' . $year,
					];
					$this->_bitacoraActividad($datosBitacora);
					return json_encode($data);
				} else if ($data->folio->STATUS == 'EN PROCESO' && $data->folio->TIPODENUNCIA == "VD"  && $data->folio->AGENTEATENCIONID != session('ID')) {
					$agente = $this->_usuariosModelRead->asObject()->where('ID', $data->folio->AGENTEATENCIONID)->first();
					return json_encode(['status' => 2, 'motivo' => 'EL FOLIO YA ESTA SIENDO ATENDIDO', 'agente' => $agente->NOMBRE . ' ' . $agente->APELLIDO_PATERNO . ' ' . $agente->APELLIDO_MATERNO]);
				} else if ($data->folio->STATUS == 'EN PROCESO' && $data->folio->TIPODENUNCIA == "DA" && $data->folio->AGENTEATENCIONID == session('ID')) {
					$data->status = 1;
					$data->respuesta = $this->getDataFolio($numfolio, $year);

					$datosBitacora = [
						'ACCION' => 'Solicito la información para atender un folio anónimo.',
						'NOTAS' => 'FOLIO: ' . $numfolio . ' AÑO: ' . $year,
					];
					$this->_bitacoraActividad($datosBitacora);
					return json_encode($data);
				} else {
					$agente = $this->_usuariosModelRead->asObject()->where('ID', $data->folio->AGENTEATENCIONID)->first();
					return json_encode(['status' => 3, 'motivo' => $data->folio->STATUS, 'expediente' => $data->folio->EXPEDIENTEID, 'agente' => $agente->NOMBRE . ' ' . $agente->APELLIDO_PATERNO . ' ' . $agente->APELLIDO_MATERNO]);
				}
			} else {
				return json_encode(['status' => 0]);
			}
		} else {
			$data->folio = $this->_folioModelRead->asObject()->where('ANO', $year)->where('FOLIOID', $numfolio)->first();

			if ($data->folio) {
				$data->status = 1;
				$data->respuesta = $this->getDataFolio($numfolio, $year);


				if ($data->folio->STATUS == 'ABIERTO' || $data->folio->STATUS == 'EN PROCESO') {
					$data->agente = $this->_usuariosModelRead->asObject()->where('ID', $data->folio->AGENTEATENCIONID)->first();
				} else if ($data->folio->STATUS == 'EN PROCESO' && $data->folio->TIPODENUNCIA == "DA") {
					$data->status = 1;
					$data->respuesta = $this->getDataFolio($numfolio, $year);
					return json_encode($data);
				}
				// var_dump($data->archivosexternos);exit;
				return json_encode($data);
			} else {
				return json_encode(['status' => 0, 'motivo' => 'El folio ' . $numfolio . ' del año ' . $year . ' no existe.']);
			}
		}
	}

	/**
	 * Función para obtener los datos de todas las tablas del folio
	 * * Se utiliza en la función de getFolioInformation (NO BORRAR).
	 * 
	 * Recibe por parametros el numero del folio y el año para utilizarlo en todas las consultas de todas las tablas
	 *
	 * @param  mixed $numfolio
	 * @param  mixed $year
	 */
	public function getDataFolio($numfolio, $year)
	{

		$data = (object) array();
		$data->folio = $this->_folioModelRead->asObject()->where('ANO', $year)->where('FOLIOID', $numfolio)->first();
		$data->folioDenunciantes = $this->_folioModelRead->get_folio_denunciante($data->folio->DENUNCIANTEID);
		$data->preguntas_iniciales = $this->_folioPreguntasModelRead->where('FOLIOID', $numfolio)->where('ANO', $year)->first();
		$data->personas = $this->_folioPersonaFisicaModelRead->get_by_folio($numfolio, $year);
		$data->correos = $this->_folioPersonaFisicaModelRead->get_correos_persona($numfolio, $year);
		$data->parentescoRelacion = $this->_parentescoPersonaFisicaModel->getRelacion($numfolio, $year);
		// $data->personaiduno = $this->_parentescoPersonaFisicaModelRead->get_personaFisicaUno($numfolio, $year);
		// $data->personaidDos = $this->_parentescoPersonaFisicaModelRead->get_personaFisicaDos($numfolio, $year);
		// $data->parentesco = $this->_parentescoPersonaFisicaModelRead->get_Parentesco($numfolio, $year);
		$data->relacionFisFis = $this->_relacionIDOModelRead->get_by_folio($numfolio, $year);
		$data->vehiculos = $this->_folioVehiculoModelRead->get_by_folio($numfolio, $year);
		$data->fisicaImpDelito = $this->_imputadoDelitoModelRead->get_by_folio($numfolio, $year);
		$data->delitosModalidadFiltro = $this->_delitoModalidadModelRead->get_delitodescr($numfolio, $year);
		$data->objetos = $this->_folioObjetoInvolucradoModelRead->get_descripcion($numfolio, $year);
		$data->documentos = $this->_folioDocModelRead->get_by_folio($numfolio, $year);
		$data->archivosexternos = $this->_archivoExternoModelRead->asObject()->where('FOLIOID', $numfolio)->where('ANO', $year)->findAll();


		if ($data->archivosexternos) {
			foreach ($data->archivosexternos as $key => $archivos) {
				$file_info = new \finfo(FILEINFO_MIME_TYPE);
				$type = $file_info->buffer($archivos->ARCHIVO);

				$archivos->ARCHIVO = 'data:' . $type . ';base64,' . base64_encode($archivos->ARCHIVO);
			}
		}


		// $data->personafisica = $this->_folioPersonaFisicaModel->asObject()->where('FOLIOID', $data->folio)->where('ANO', $year)->findAll();
		$data->imputados = $this->_folioPersonaFisicaModelRead->get_imputados($numfolio, $year);
		$data->victimas = $this->_folioPersonaFisicaModelRead->get_victimas($numfolio, $year);
		return ($data);
	}
	/**
	 * Función para obtener la información del folio en denuncia anonima para posterior agregar personas.
	 * Se recibe por metodo POST el folio y el año para su consulta.
	 *
	 */
	public function getFolioInformationDenunciaAnonima()
	{
		$data = (object) array();
		$numfolio = trim($this->request->getPost('folio'));
		$year = trim($this->request->getPost('year'));

		$data->folio = $this->_folioModelRead->asObject()->where('ANO', $year)->where('FOLIOID', $numfolio)->first();
		if ($data->folio) {
			$data->status = 1;
			return json_encode($data);
		} else {
			return json_encode(['status' => 0]);
		}
	}

	/**
	 * Función para obtener todas los datos de la persona fisica.
	 * Se recibe por metodo post el ID de la persona, el folio y el año. (Se obtiene MEDIAFILIACION, DOMICILIO y PERSONA FISICA)
	 * *Todos los datos se regresan a la vista correspondiente.
	 *
	 */
	public function getPersonaFisicaById()
	{
		$id = trim($this->request->getPost('id'));
		$folio = trim($this->request->getPost('folio'));
		$year = trim($this->request->getPost('year'));

		$data = (object) array();
		$data->personaFisica = $this->_folioPersonaFisicaModelRead->where('FOLIOID', $folio)->where('ANO', $year)->where('PERSONAFISICAID', $id)->first();

		if ($data->personaFisica) {
			$data->personaFisicaDomicilio = $this->_folioPersonaFisicaDomicilioModelRead->where('ANO', $year)->where('FOLIOID', $folio)->where('PERSONAFISICAID', $id)->first();

			$data->personaFisicaMediaFiliacion = $this->_folioMediaFiliacionRead->where('ANO', $year)->where('FOLIOID', $folio)->where('PERSONAFISICAID', $id)->first();
			$data->folio = $this->_folioModelRead->where('FOLIOID', $folio)->where('ANO', $year)->first();
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
	/**
	 * Función para obtener la relacion de parentesco de una persona y otra.
	 * Se recibe por metodo post el ID de la persona, el folio y el año.
	 * *Todos los datos se regresan a la vista correspondiente.
	 *
	 */
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
	/**
	 * Función para obtener la relacion de imputado y delitos.
	 * Se recibe por metodo post el ID de la persona, el folio, el año y el delito correspondiente.
	 * *Todos los datos se regresan a la vista correspondiente.
	 * ! Deprecated method, do not use.
	 */
	public function getImputadoDelito()
	{
		$id = trim($this->request->getPost('personafisica'));
		$folio = trim($this->request->getPost('folio'));
		$year = trim($this->request->getPost('year'));
		$delitomodalidadid = trim($this->request->getPost('delito'));

		$data = (object) array();
		$data->imputado_delito = $this->_imputadoDelitoModelRead->where('FOLIOID', $folio)->where('ANO', $year)->where('PERSONAFISICAID', $id)->where('DELITOMODALIDADID', $delitomodalidadid)->first();
		if ($data->imputado_delito) {

			$data->status = 1;
			return json_encode($data);
		} else {
			$data = (object)['status' => 0];
			return json_encode($data);
		}
	}
	/**
	 * Función para obtener el domicilio de la persona fisica
	 * Se recibe por metodo post el ID de la persona, el folio y el año.
	 * *Todos los datos se regresan a la vista correspondiente.
	 */
	public function findPersonadDomicilioById()
	{
		$id = $this->request->getPost('id');
		$folio = $this->request->getPost('folio');
		$year = $this->request->getPost('year');

		$data = (object) array();

		$data->persondom = $this->_folioPersonaFisicaDomicilioModelRead->where('FOLIOID', $folio)->where('ANO', $year)->where('PERSONAFISICAID', $id)->first();
		$data->estado = $this->_estadosModelRead->where('ESTADOID', 2)->asObject()->first();
		$data->municipio = $this->_municipiosModelRead->asObject()->where('ESTADOID', 2)->where('MUNICIPIOID', $data->persondom['MUNICIPIOID'])->first();
		$data->localidad = $this->_localidadesModelRead->asObject()->where('ESTADOID', 2)->where('MUNICIPIOID', $data->persondom['MUNICIPIOID'])->where('LOCALIDADID', $data->persondom['LOCALIDADID'])->first();
		$data->colonia = $this->_coloniasModelRead->asObject()->where('ESTADOID', 2)->where('MUNICIPIOID', $data->persondom['MUNICIPIOID'])->where('COLONIAID', $data->persondom['COLONIAID'])->first();

		return json_encode($data);
	}

	/**
	 * Función para refrescar los archivos externos
	 * Se recibe por metodo post el folio y el año.
	 * Sirve cuando el denunciante sube archivos durante de la llamada y el MP refresca para actualizar en tiempo real.
	 * *Todos los archivos se codifican para la visualizacion en la vista.
	 * *Todos los datos se regresan a la vista correspondiente.
	 */
	public function refreshArchivosExternos()
	{
		$folio = $this->request->getPost('folio');
		$year = $this->request->getPost('year');

		$data = (object) array();

		$data->archivosexternos = $this->_archivoExternoModelRead->asObject()->where('FOLIOID', $folio)->where('ANO', $year)->findAll();
		if ($data->archivosexternos) {
			foreach ($data->archivosexternos as $key => $archivos) {
				$file_info = new \finfo(FILEINFO_MIME_TYPE);
				$type = $file_info->buffer($archivos->ARCHIVO);

				$archivos->ARCHIVO = 'data:' . $type . ';base64,' . base64_encode($archivos->ARCHIVO);
			}
		}
		return json_encode($data);
	}
	/**
	 * Función para obtener los datos del vehiculo.
	 * Se recibe por metodo post el ID del vehículo, el folio y el año para todas las consultas relacionadas.
	 * *Todos los archivos se codifican para la visualizacion en la vista.
	 * *Todos los datos se regresan a la vista correspondiente.
	 */
	public function findPersonadVehiculoById()
	{
		$data = (object) array();
		$id = $this->request->getPost('id');
		$folio = $this->request->getPost('folio');
		$year = $this->request->getPost('year');

		$data->vehiculo = $this->_folioVehiculoModelRead->where('FOLIOID', $folio)->where('ANO', $year)->where('VEHICULOID', $id)->first();

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

				$data->color = $this->_coloresVehiculoModelRead->where('VEHICULOCOLORID', $data->vehiculo['PRIMERCOLORID'])->first();
				$data->tipov = $this->_tipoVehiculoModelRead->where('VEHICULOTIPOID', $data->vehiculo['TIPOID'])->first();
				$data->distribuidorVehiculo = $this->_vehiculoDistribuidorModelRead->where('VEHICULODISTRIBUIDORID', $data->vehiculo['VEHICULODISTRIBUIDORID'])->first();
				$data->marcaVehiculo = $this->_vehiculoMarcaModelRead->where('VEHICULODISTRIBUIDORID', $data->vehiculo['VEHICULODISTRIBUIDORID'])->where('VEHICULOMARCAID', $data->vehiculo['MARCAID'])->first();
				$data->lineaVehiculo = $this->_vehiculoModeloModelRead->where('VEHICULODISTRIBUIDORID', $data->vehiculo['VEHICULODISTRIBUIDORID'])->where('VEHICULOMARCAID', $data->vehiculo['MARCAID'])->where('VEHICULOMODELOID', $data->vehiculo['MODELOID'])->first();
				$data->versionVehiculo = $this->_vehiculoVersionModelRead->where('VEHICULODISTRIBUIDORID', $data->vehiculo['VEHICULODISTRIBUIDORID'])->where('VEHICULOMARCAID', $data->vehiculo['MARCAID'])->where('VEHICULOMODELOID', $data->vehiculo['MODELOID'])->where('VEHICULOVERSIONID', $data->vehiculo['VEHICULOVERSIONID'])->first();
				$data->status = 1;
				return json_encode($data);
			} catch (\Exception $e) {
				return json_encode(['status' => 0]);
			}
		} else {
			return json_encode(['status' => 0]);
		}
	}
	/**
	 * Vista para la bandeja de salida
	 * Se realiza un conteo de expedientes para cada municipio.
	 */
	public function bandeja_salida()
	{
		if (!$this->permisos('BANDEJA')) {
			return redirect()->back()->with('message_error', 'Acceso denegado, no tienes los permisos necesarios.');
		}
		$data = (object) array();
		$data->ensenada = $this->_folioModelRead->bandeja_salida(1);
		$data->mexicali = $this->_folioModelRead->bandeja_salida(2);
		$data->tecate = $this->_folioModelRead->bandeja_salida(3);
		$data->tijuana = $this->_folioModelRead->bandeja_salida(4);
		$data->rosarito = $this->_folioModelRead->bandeja_salida(5);
		$data->rolPermiso = $this->_rolesPermisosModelRead->asObject()->where('ROLID', session('ROLID'))->findAll();
		$this->_loadView('Bandeja de remisión', 'bandeja de remision', '', $data, 'bandeja/bandeja_salida');
	}
	/**
	 * Vista para la bandeja de remision
	 * Se recibe por metodo GET el municipio asignado, folio, año y expediente.
	 * Se cargan diferentes vista de acuerdo al tipo de expediente.
	 */
	public function bandeja_remision()
	{
		if (!$this->permisos('BANDEJA')) {
			return redirect()->back()->with('message_error', 'Acceso denegado, no tienes los permisos necesarios.');
		}
		$coordinacion = $this->getCoordinacion();
		$data = (object) array();
		$data->municipio = $this->request->getGet('municipioasignado');
		$data->folio = $this->request->getGet('folio');
		$data->year = $this->request->getGet('year');
		$data->expedienteid = $this->request->getGet('expediente');
		$data->oficinas = $this->_oficinasModelRead->asObject()->where('MUNICIPIOID', $data->municipio)->orderBy('OFICINADESCR', 'asc')->findAll();

		$data->expediente = $this->_folioModelRead->where('FOLIOID', $data->folio)->where('ANO', $data->year)->where('MUNICIPIOASIGNADOID', $data->municipio)->where('EXPEDIENTEID', $data->expedienteid)->first();

		if (!$data->expediente) {
			return redirect()->back()->with('message_error', 'No se encontro el folio a remitir.');
		}

		$data->rolPermiso = $this->_rolesPermisosModel->asObject()->where('ROLID', session('ROLID'))->findAll();
		$data->coordinacion = $coordinacion->data;

		if ($data->expediente['TIPOEXPEDIENTEID'] == 5) {
			$this->_loadView('Bandeja remisión', 'remision', '', $data, 'bandeja/bandeja_rac');
		} else {
			$this->_loadView('Bandeja remisión', 'remision', '', $data, 'bandeja/bandeja_remision');
		}
	}

	/**
	 * Función para asignar bandeja de remisión.
	 * Se obtiene por metodo POST el expediente, la oficina, el empleado asignado y el municipio.
	 */
	public function bandeja_remision_post()
	{
		try {
			$expediente = trim($this->request->getPost('expediente'));
			$oficina = trim($this->request->getPost('oficinaid'));
			$empleado = trim($this->request->getPost('empleadoid'));
			$municipio = trim($this->request->getPost('municipio'));
			$folio = trim($this->request->getPost('folio'));
			$year = trim($this->request->getPost('year'));
			$area =  trim($this->request->getPost('areaid'));
			$tipo = $this->request->getPost('tipoOficina');

			if (($oficina == 0 || $oficina == '') || ($area == 0 || $area == '') || ($empleado == 0 || $empleado == '')) {
				return redirect()->to(base_url('/admin/dashboard/bandeja'))->with('message_error', 'Por favor, completa los campos');
			}

			$documents = $this->_folioDocModel->asObject()->where('FOLIOID', $folio)->where('ANO', $year)->findAll();
			$status = 2;
			// $dataInter =  array('SOLICITUDID' => 9000600, 'INTERVENCIONID' => 98);


			foreach ($documents as $key => $document) {
				if (
					$document->TIPODOC == 'CRITERIO DE OPORTUNIDAD' ||
					$document->TIPODOC == 'FACULTAD DE ABSTENERSE DE INVESTIGAR (NO DELITO)' ||
					$document->TIPODOC == 'FACULTAD DE ABSTENERSE DE INVESTIGAR (PRESCRIPCION)'
				) {
					$status = 4;
				}
			}

			// Datos para actualizar las tablas.
			$dataFolio = array(
				'AGENTEASIGNADOID' => $empleado,
				'OFICINAASIGNADOID' => $oficina,
				'AREAASIGNADOID' => $area
			);

			$dataFolioDoc = array(
				'AGENTEID' => $empleado,
				'OFICINAID' => $oficina,
			);
			$dataFolioArc = array(
				'AUTOR' => $empleado,
				'OFICINAID' => $oficina,
			);

			// Crea conexion al servicio de justicia para actualizar el area asignada
			$updateExpediente = $this->_updateExpedienteByBandeja($expediente, $municipio, $oficina, $empleado, $area, 'REMISION', $tipo, $status);

			if ($updateExpediente->status == 201) {

				//Actualizacion de tablas de VIDEODENUNCIA
				$update = $this->_folioModel->set($dataFolio)->where('EXPEDIENTEID', $expediente)->update();
				$updateDoc = $this->_folioDocModel->set($dataFolioDoc)->where('FOLIOID', $folio)->where('ANO', $year)->update();

				if ($update) {
					$bandeja = $this->_folioModel->where('EXPEDIENTEID', $expediente)->first();
					//Se suben los documentos y archivos externos a Justicia
					$subirArchivos = $this->subirArchivosRemision($bandeja['FOLIOID'], $bandeja['ANO'], $expediente);

					//Se revisa que haya documentos subidos a Justicia de tipo periciales
					$folioDocPericiales = $this->_folioDocModelRead->expedienteDocumentosJusticia($folio, $year);
					if ($folioDocPericiales) {
						foreach ($folioDocPericiales as $key => $doc) {
							$solicitudp = array();
							$solicitudp['ESTADOID'] = 2;
							$solicitudp['MUNICIPIOID'] = $municipio;
							$solicitudp['EMPLEADOIDREGISTRO'] = $empleado;
							$solicitudp['OFICINAIDREGISTRO'] = $oficina;
							$solicitudp['AREAIDREGISTRO'] = $area;
							$solicitudp['ANO'] = $doc->ANO;
							$solicitudp['TITULO'] = $doc->TIPODOC;

							// Se suben los documentos periciales a Justicia.
							$_solicitudPericial = $this->_createSolicitudesPericiales($solicitudp);
							if ($_solicitudPericial->status == 201) {
								//Crea la solicitud pericial a Justicia.
								$_solicitudDocto = $this->_createSolicitudDocto($expediente, $_solicitudPericial->SOLICITUDID, $doc->EXPEDIENTEDOCID, $bandeja['MUNICIPIOASIGNADOID']);

								if ($_solicitudDocto->status == 201) {
									//Crea la solicityd en el expediente a Justicia.
									$_solicitudExpediente = $this->_createSolicitudExpediente($expediente, $_solicitudPericial->SOLICITUDID, $municipio);
									$plantilla = (object) array();

									$plantilla = $this->_plantillasModel->where('TITULO',  $doc->TIPODOC)->first();
									//Se obtiene el id de intervencion de acuerdo al municipio
									if ($municipio == 1 ||  $municipio == 6) {
										$intervencion = $plantilla['INTERVENCIONENSENADAID'];
									} else if ($municipio == 2 || $municipio == 3 || $municipio == 7) {
										$intervencion = $plantilla['INTERVENCIONMEXICALIID'];
									} else if ($municipio == 4 || $municipio == 5) {
										$intervencion = $plantilla['INTERVENCIONTIJUANAID'];
									}
									$dataInter =  array('SOLICITUDID' => $_solicitudPericial->SOLICITUDID, 'INTERVENCIONID' => $intervencion);

									//Se crea la intervención pericial a Justicia.
									$_intervencionPericial = $this->_createIntervencionPericial($dataInter, $municipio);

									if ($_intervencionPericial->status == 201) {
										$datosBitacora = [
											'ACCION' => 'Se envio una solicitud pericial.',
											'NOTAS' => 'Exp: ' . $expediente . ' Solicitud: ' . $_solicitudPericial->SOLICITUDID . 'Intervencion' . $intervencion,
										];
										$this->_bitacoraActividad($datosBitacora);
									}
								}
							}
						}
					}

					//Se crea la bandeja en Justicia.
					$_bandeja_creada = $this->_createBandeja($bandeja);
					$updateArch = $this->_archivoExternoModel->set($dataFolioArc)->where('FOLIOID', $bandeja['FOLIOID'])->where('ANO', $bandeja['ANO'])->update();

					if ($_bandeja_creada->status == 201) {
						$datosBitacora = [
							'ACCION' => 'Remitio un expediente.',
							'NOTAS' => 'Exp: ' . $expediente . ' oficina: ' . $oficina . ' empleado:' . $empleado . ' area:' . $area,
						];
						$this->_bitacoraActividad($datosBitacora);
						return redirect()->to(base_url('/admin/dashboard/bandeja'))->with('message_success', 'Expediente remitido correctamente.');
					} else {
						return redirect()->to(base_url('/admin/dashboard/bandeja'))->with('message_error', 'Se remitio el expediente pero no se creo la bandeja entrada en justicia, de favor comentalo con el área de informática.');
					}
				} else {
					return redirect()->to(base_url('/admin/dashboard/bandeja'))->with('message_error', 'No se actualizo el folio en videodenuncia');
				}
			} else {
				return redirect()->to(base_url('/admin/dashboard/bandeja'))->with('message_error', 'No se actualizo el folio en Justicia Net');
			}
		} catch (\Exception $e) {
			return redirect()->to(base_url('/admin/dashboard/bandeja'))->with('message_error', 'Hubo un error en la remisión, verifica el expediente en Justicia Net.');
		}
	}

	/**
	 * Función para asignar bandeja de remisión de tipo RAC.
	 * Se obtiene por metodo POST el expediente, el modulo, el procedimiento y el municipio.
	 */
	public function bandeja_rac()
	{
		try {
			$expediente = trim($this->request->getPost('expediente'));
			$modulo = trim($this->request->getPost('modulo'));
			$procedimiento = trim($this->request->getPost('procedimiento'));
			$municipio = trim($this->request->getPost('municipio'));
			$folio = trim($this->request->getPost('folio'));
			$year = trim($this->request->getPost('year'));
			//Se verifica que no exista el RAC en Justicia.
			$existRac = $this->_bandejaRacModel->asObject()->where('EXPEDIENTEID', $expediente)->findAll();
			if ($existRac) {
				return redirect()->to(base_url('/admin/dashboard/bandeja'))->with('message_error', 'Ya fue remitido este expediente.');
			}

			$status = 2;
			$bandeja = $this->_folioModel->where('EXPEDIENTEID', $expediente)->first();
			// Obtiene los documentos del folio para asignar un estado juridico.

			$documents = $this->_folioDocModel->asObject()->where('FOLIOID', $folio)->where('ANO', $year)->findAll();
			foreach ($documents as $key => $document) {
				if (
					$document->TIPODOC == 'CRITERIO DE OPORTUNIDAD' ||
					$document->TIPODOC == 'FACULTAD DE ABSTENERSE DE INVESTIGAR (NO DELITO)' ||
					$document->TIPODOC == 'FACULTAD DE ABSTENERSE DE INVESTIGAR (PRESCRIPCION)'
				) {
					$status = 4;
				}
			}

			//Se obtiene el Mediador desde el WebServicice, se le manda el municipio y el modulo
			$getMediador = $this->getMediador($municipio, $modulo);
			// Datos para actualizar las tablas.
			$dataFolio = array(
				'AGENTEASIGNADOID' =>  $getMediador->data->EMPLEADOID_MEDIADOR,
				'OFICINAASIGNADOID' => $getMediador->data->OFICINA_MP_MEDIADOR,
				'AREAASIGNADOID' => $getMediador->data->AREA_MEDIADOR
			);

			try {
				//Se crea la bandeja RAC en Justicia.
				$_bandeja_rac = $this->_createJusticiaAlterna($expediente, $procedimiento, $municipio);

				if ($_bandeja_rac->status == 401) {
					return redirect()->back()->with('message_error', 'Hay un error en la tabla expedientejusticiaalterna por lo tanto no se puede remitir.');
				}
			} catch (\Exception $e) {
				return redirect()->back()->with('message_error', 'No se esta guardando en tabla expedientejusticiaalterna por lo tanto no se puede remitir.');
			}
			try {
				// Crea conexion al servicio de justicia para actualizar el area asignada
				$updateExpediente = $this->_updateExpedienteByBandeja($expediente, $municipio, $getMediador->data->OFICINA_MP_MEDIADOR, $getMediador->data->EMPLEADOID_MEDIADOR, $getMediador->data->AREA_MEDIADOR, 'RAC', $status);
				if ($updateExpediente->status == 401) {
					return redirect()->back()->with('message_error', 'No se actualizo el expediente en justicia por lo tanto no se puede remitir.');
				}
			} catch (\Exception $e) {
				return redirect()->back()->with('message_error', 'No se actualizo el expediente en justicia por lo tanto no se puede remitir.');
			}

			if ($updateExpediente->status == 201 && $_bandeja_rac->status == 201) {
				//Se actualizan las tablas cuando el area y la bandeja hayan sido creadas.

				$this->_folioModel->set($dataFolio)->where('EXPEDIENTEID', $expediente)->update();

				$dataBandeja = array(
					'FOLIOID' =>	$bandeja['FOLIOID'],
					'ANO' =>	$bandeja['ANO'],
					'EXPEDIENTEID' => $expediente,
					'TIPOPROCEDIMIENTOID' => $procedimiento,
					'MODULOID' => $getMediador->data->OFICINA_MP_MEDIADOR,
					'MODULODESCR' => $getMediador->data->AREA_MP_MEDIADOR_DESCR,
					'MEDIADORID' => $getMediador->data->EMPLEADOID_MEDIADOR
				);

				//Se mandan los datos finales del RAC a una tabla de VIDEODENUNCIA para un control.
				$bandejaRac = $this->_bandejaRacModel->insert($dataBandeja);
				//Se suben los archivos y documentos a Justicia.
				$this->subirArchivosRemision($bandeja['FOLIOID'], $bandeja['ANO'], $expediente);

				//Se revisa que haya documentos subidos a Justicia de tipo periciales
				$folioDoc = $this->_folioDocModelRead->expedienteDocumentosJusticia($folio, $year);

				if ($folioDoc) {
					foreach ($folioDoc as $key => $doc) {

						$solicitudp = array();
						$solicitudp['ESTADOID'] = 2;
						$solicitudp['MUNICIPIOID'] = $municipio;
						$solicitudp['EMPLEADOIDREGISTRO'] = $getMediador->data->EMPLEADOID_MEDIADOR;
						$solicitudp['OFICINAIDREGISTRO'] = $getMediador->data->OFICINA_MP_MEDIADOR;
						$solicitudp['AREAIDREGISTRO'] =  $getMediador->data->AREA_MEDIADOR;
						$solicitudp['ANO'] = $doc->ANO;
						$solicitudp['TITULO'] = $doc->TIPODOC;
						// Se suben los documentos periciales a Justicia.
						$_solicitudPericial = $this->_createSolicitudesPericiales($solicitudp);
						if ($_solicitudPericial->status == 201) {
							//Crea la solicitud pericial a Justicia.
							$_solicitudDocto = $this->_createSolicitudDocto($expediente, $_solicitudPericial->SOLICITUDID, $doc->EXPEDIENTEDOCID, $bandeja['MUNICIPIOASIGNADOID']);
							if ($_solicitudDocto->status == 201) {
								//Crea la solicityd en el expediente a Justicia.
								$_solicitudExpediente = $this->_createSolicitudExpediente($expediente, $_solicitudPericial->SOLICITUDID, $municipio);
								$plantilla = (object) array();

								$plantilla = $this->_plantillasModel->where('TITULO',  $doc->TIPODOC)->first();
								//Se obtiene el id de intervencion de acuerdo al municipio
								if ($municipio == 1 ||  $municipio == 6) {
									$intervencion = $plantilla['INTERVENCIONENSENADAID'];
								} else if ($municipio == 2 || $municipio == 3 || $municipio == 7) {
									$intervencion = $plantilla['INTERVENCIONMEXICALIID'];
								} else if ($municipio == 4 || $municipio == 5) {
									$intervencion = $plantilla['INTERVENCIONTIJUANAID'];
								}
								$dataInter =  array('SOLICITUDID' => $_solicitudPericial->SOLICITUDID, 'INTERVENCIONID' => $intervencion);
								//Se crea la intervención pericial a Justicia.
								$_intervencionPericial = $this->_createIntervencionPericial($dataInter, $municipio);
								$datosBitacora = [
									'ACCION' => 'Se envio una solicitud pericial.',
									'NOTAS' => 'Exp: ' . $expediente . ' Solicitud: ' . $_solicitudPericial->SOLICITUDID . 'Intervencion' . $intervencion,
								];
								$this->_bitacoraActividad($datosBitacora);
							}
						}
					}
				}

				if (!$bandejaRac) {
					$datosBitacora = [
						'ACCION' => 'Remitio un expediente RAC.',
						'NOTAS' => 'Exp: ' . $expediente . ' modulo: ' . $modulo . ' empleado:' . $getMediador->data->EMPLEADOID_MEDIADOR  . ' area:' . $getMediador->data->AREA_MEDIADOR,
					];
					$this->_bitacoraActividad($datosBitacora);

					return redirect()->to(base_url('/admin/dashboard/bandeja'))->with('message_success', 'Remitido correctamente');
				}
			} else {
				return redirect()->back()->with('message_error', 'No se actualizo la bandeja RAC o el expediente, verifique con informática.');
			}
		} catch (\Exception $e) {
			return redirect()->to(base_url('/admin/dashboard/bandeja'))->with('message_error', 'Hubo un error en la remisión, verifica el expediente en justicia.');
		}
	}

	/**
	 * Vista para videodenuncia.
	 * Regresa todo los catálogos necesarios para el consumo de esta vista.
	 *
	 */
	public function video_denuncia()
	{
		$data = (object) array();
		$data->folio = $this->request->getGet('folio');
		$year = date('Y');

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
		$data->estadosExtranjeros = $this->_estadosExtranjerosRead->asObject()->findAll();

		$data->tiposIdentificaciones = $this->_tipoIdentificacionModelRead->asObject()->findAll();
		$data->escolaridades = $this->_escolaridadModelRead->asObject()->findAll();
		$data->ocupaciones = $this->_ocupacionModelRead->asObject()->findAll();
		$data->colorVehiculo = $this->_coloresVehiculoModelRead->asObject()->findAll();
		$data->tipoVehiculo = $this->_tipoVehiculoModelRead->asObject()->orderBy('VEHICULOTIPODESCR', 'ASC')->findAll();

		$data->parentesco = $this->_parentescoModelRead->asObject()->findAll();
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
		$data->plantillas = $this->_plantillasModelRead->asObject()->where('TITULO !=', 'CONSTANCIA DE EXTRAVIO')->where('ACTIVO', 1)->orderBy('TITULO', 'ASC')->findAll();
		$data->tipoExpediente = $this->_tipoExpedienteModelRead->asObject()->like('TIPOEXPEDIENTECLAVE', 'NUC')->orLike('TIPOEXPEDIENTECLAVE', 'NAC')->orLike('TIPOEXPEDIENTECLAVE', 'RAC')->findAll();
		$data->situacionVehiculo = $this->_situacionVehiculoModelRead->asObject()->findAll();
		$data->empleados =  $this->_usuariosModelRead->asObject()
			->select('USUARIOS.*, SESIONES.ACTIVO')
			->join('SESIONES', 'USUARIOS.ID= SESIONES.ID_USUARIO')
			->where('ROLID', 3)
			->where('ACTIVO', 1)
			->findAll();
		$data->distribuidorVehiculo = $this->_vehiculoDistribuidorModelRead->asObject()->findAll();
		$data->marcaVehiculo = $this->_vehiculoMarcaModelRead->asObject()->findAll();
		$data->lineaVehiculo = $this->_vehiculoModeloModelRead->asObject()->findAll();
		$data->versionVehiculo = $this->_vehiculoVersionModelRead->asObject()->findAll();
		$data->tipoVehiculo = $this->_tipoVehiculoModelRead->asObject()->findAll();
		$data->servicioVehiculo = $this->_vehiculoServicioModelRead->asObject()->findAll();
		$data->colorVehiculo = $this->_coloresVehiculoModelRead->asObject()->findAll();
		$data->rolPermiso = $this->_rolesPermisosModelRead->asObject()->where('ROLID', session('ROLID'))->findAll();
		$data->encargados =
			$this->_usuariosModelRead->asObject()
			->select('USUARIOS.*, SESIONES.ACTIVO')
			->join('SESIONES', 'USUARIOS.ID= SESIONES.ID_USUARIO')
			->where('ROLID', 6)
			->where('ACTIVO', 1)
			->findAll();
		$data->delitosModalidad = $this->_delitoModalidadModelRead->asObject()->orderBy('DELITOMODALIDADDESCR', 'ASC')->where('DELITOMODALIDADDESCR IS NOT NULL')->where('DELITOMODALIDADDESCR !=', '')->findAll();
		$this->_loadView('Video denuncia', 'videodenuncia', '', $data, 'video_denuncia');
	}

	/**
	 * Función para cargar cualquier vista en cualquier función.
	 *
	 * @param  mixed $title
	 * @param  mixed $menu
	 * @param  mixed $submenu
	 * @param  mixed $data
	 * @param  mixed $view
	 */
	private function _loadView($title, $menu, $submenu, $data, $view)
	{
		$data2 = [
			'header_data' => (object) ['title' => $title, 'menu' => $menu, 'submenu' => $submenu],
			'body_data' => $data,
		];

		echo view("admin/dashboard/$view", $data2);
	}

	/**
	 * Función para enviar mensajes SMS
	 *
	 * @param  mixed $tipo
	 * @param  mixed $celular
	 * @param  mixed $mensaje
	 */
	public function sendSMS($tipo, $celular, $mensaje)
	{

		$endpoint = "http://enviosms.ddns.net/API/";
		$data = array();
		$data['UsuarioID'] = 1;
		$data['Nombre'] = $tipo;
		$lstMensajes = array();
		$obj = array("Celular" =>  $celular, "Mensaje" => $mensaje);
		$lstMensajes[] = $obj;
		$data['lstMensajes'] = $lstMensajes;

		$httpClient = new Client([
			'base_uri' => $endpoint
		]);

		$response = $httpClient->post('campañas/enviarSMS', [
			'json' => $data
		]);

		$respuestaServ = $response->getBody()->getContents();

		return json_decode($respuestaServ);
	}
	/**
	 * Función para enviar email cuando el folio es derivado o canalizado. También se envía SMS.
	 *
	 * @param  mixed $to
	 * @param  mixed $folio
	 * @param  mixed $motivo
	 */
	private function _sendEmailDerivacionCanalizacion($to, $folio, $motivo)
	{
		$year = date('Y');
		$folioM = $this->_folioModelRead->asObject()->where('FOLIOID', $folio)->where('ANO', $year)->first();
		$denunciante = $this->_denunciantesModelRead->asObject()->where('DENUNCIANTEID', $folioM->DENUNCIANTEID)->first();

		$body = view('email_template/folio_der_can_email_template.php', ['folio' => $folio, 'motivo' => $motivo]);
		$mailersend = new MailerSend(['api_key' => EMAIL_TOKEN]);
		$recipients = [
			new Recipient($to, 'Your Client'),
		];

		$emailParams = (new EmailParams())
			->setFrom('notificacionfgebc@fgebc.gob.mx')
			->setFromName('FGEBC')
			->setRecipients($recipients)
			->setSubject('Folio atendido')
			->setHtml($body)
			->setText('EL FOLIO ' . $folio . ' FUE ' . $motivo == 'ATENDIDA' ? 'CANALIZADO' : $motivo)
			->setReplyTo('notificacionfgebc@fgebc.gob.mx')
			->setReplyToName('FGEBC');
		try {
			$result = $mailersend->email->send($emailParams);
		} catch (MailerSendValidationException $e) {
			$result = false;
		} catch (MailerSendRateLimitException $e) {
			$result = false;
		}

		if ($result) {
			return true;
		} else {
			return false;
		}
	}

	/**
	 * Función para enviar email cuando el folio es de tipo expediente. También se envía SMS.
	 *
	 * @param  mixed $to
	 * @param  mixed $folio
	 * @param  mixed $expedienteId
	 */
	private function _sendEmailExpediente($to, $folio, $expedienteId)
	{
		$folioM = $this->_folioModelRead->asObject()->where('EXPEDIENTEID', $expedienteId)->first();
		$denunciante = $this->_denunciantesModelRead->asObject()->where('DENUNCIANTEID', $folioM->DENUNCIANTEID)->first();
		$tipoExpediente = $this->_tipoExpedienteModelRead->asObject()->where('TIPOEXPEDIENTEID',  $folioM->TIPOEXPEDIENTEID)->first();

		$expediente_guiones = '';
		$arrayExpediente = str_split($expedienteId);
		$expediente_guiones =  $arrayExpediente[1] . $arrayExpediente[2] . $arrayExpediente[4] . $arrayExpediente[5] . '-' . $arrayExpediente[6] . $arrayExpediente[7] . $arrayExpediente[8] . $arrayExpediente[9] . '-' . $arrayExpediente[10] . $arrayExpediente[11] . $arrayExpediente[12] . $arrayExpediente[13] . $arrayExpediente[14];

		$mailersend = new MailerSend(['api_key' => EMAIL_TOKEN]);
		$recipients = [
			new Recipient($to, 'Your Client'),
		];

		$body = view('email_template/expediente_email_template.php', ['expediente' => $expedienteId, 'tipoexpediente' => $tipoExpediente->TIPOEXPEDIENTECLAVE]);
		$emailParams = (new EmailParams())
			->setFrom('notificacionfgebc@fgebc.gob.mx')
			->setFromName('FGEBC')
			->setRecipients($recipients)
			->setSubject('Nuevo expediente creado')
			->setHtml($body)
			->setText('Gracias por denunciar, se te ha generado un nuevo expediente ' . $expediente_guiones . '/' . $tipoExpediente->TIPOEXPEDIENTECLAVE)
			->setReplyTo('notificacionfgebc@fgebc.gob.mx')
			->setReplyToName('FGEBC');

		$sendSMS = $this->sendSMS("Nuevo expediente", $denunciante->TELEFONO, 'Notificaciones FGEBC/Estimado usuario, tu numero de expediente es:' . $expediente_guiones . '/' . $tipoExpediente->TIPOEXPEDIENTECLAVE);
		try {
			$result = $mailersend->email->send($emailParams);
		} catch (MailerSendValidationException $e) {
			$result = false;
		} catch (MailerSendRateLimitException $e) {
			$result = false;
		}

		if ($result) {
			return true;
		} else {
			if ($sendSMS == "") {
				return true;
			} else {
				return false;
			}
		}
	}

	/**
	 * Función para enviar email con la contraseña del usuario
	 *
	 * @param  mixed $to
	 * @param  mixed $password
	 */
	private function _sendEmailPassword($to, $password)
	{
		$body = view('email_template/password_email_admin_template.php', ['email' => $to, 'password' => $password]);

		$mailersend = new MailerSend(['api_key' => EMAIL_TOKEN]);

		$recipients = [
			new Recipient($to, 'Your Client'),
		];
		$emailParams = (new EmailParams())
			->setFrom('notificacionfgebc@fgebc.gob.mx')
			->setFromName('FGEBC')
			->setRecipients($recipients)
			->setSubject('Nueva cuenta creada')
			->setHtml($body)
			->setText('Se ha generado un nuevo registro en el Centro de Denuncia Tecnológica.Para acceder debes ingresar los siguientes datos. USUARIO: ' . $to . 'CONTRASEÑA:' . $password)
			->setReplyTo('notificacionfgebc@fgebc.gob.mx')
			->setReplyToName('FGEBC');
		try {
			$result = $mailersend->email->send($emailParams);
		} catch (MailerSendValidationException $e) {
			$result = false;
		} catch (MailerSendRateLimitException $e) {
			$result = false;
		}
		if ($result) {
			return true;
		} else {
			return false;
		}
	}

	/**Funcion para subir todos los documentos a periciales */
	public function subirPericiales()
	{
		// Datos de los objetos
		$datosRegistros = [
			['FOLIOID' => 3265, 'ANO' => 2023, 'MUNICIPIO' => 4, 'EMPLEADO' => 9414, 'OFICINA' => 840, 'AREA' => 3001, 'EXPEDIENTE' => 102004202322421],
			['FOLIOID' => 3330, 'ANO' => 2023, 'MUNICIPIO' => 4, 'EMPLEADO' => 9457, 'OFICINA' => 838, 'AREA' => 2964, 'EXPEDIENTE' => 102004202322655],
			['FOLIOID' => 3401, 'ANO' => 2023, 'MUNICIPIO' => 4, 'EMPLEADO' => 10432, 'OFICINA' => 906, 'AREA' => 4259, 'EXPEDIENTE' => 102004202322663],
			['FOLIOID' => 3431, 'ANO' => 2023, 'MUNICIPIO' => 4, 'EMPLEADO' => 9414, 'OFICINA' => 840, 'AREA' => 3001, 'EXPEDIENTE' => 102004202322717],
			['FOLIOID' => 3573, 'ANO' => 2023, 'MUNICIPIO' => 4, 'EMPLEADO' => 10432, 'OFICINA' => 906, 'AREA' => 4259, 'EXPEDIENTE' => 102004202323001],
			['FOLIOID' => 3599, 'ANO' => 2023, 'MUNICIPIO' => 4, 'EMPLEADO' => 10709, 'OFICINA' => 924, 'AREA' => 4496, 'EXPEDIENTE' => 102004202323049],
			['FOLIOID' => 3621, 'ANO' => 2023, 'MUNICIPIO' => 4, 'EMPLEADO' => 10432, 'OFICINA' => 906, 'AREA' => 4259, 'EXPEDIENTE' => 102004202323079],
			['FOLIOID' => 3689, 'ANO' => 2023, 'MUNICIPIO' => 3, 'EMPLEADO' => 3926, 'OFICINA' => 392, 'AREA' => 3219, 'EXPEDIENTE' => 102003202302198],
			['FOLIOID' => 3723, 'ANO' => 2023, 'MUNICIPIO' => 3, 'EMPLEADO' => 3395, 'OFICINA' => 316, 'AREA' => 2408, 'EXPEDIENTE' => 102003202302200],
			['FOLIOID' => 3757, 'ANO' => 2023, 'MUNICIPIO' => 4, 'EMPLEADO' => 9414, 'OFICINA' => 840, 'AREA' => 3001, 'EXPEDIENTE' => 102004202323472],
			['FOLIOID' => 3762, 'ANO' => 2023, 'MUNICIPIO' => 4, 'EMPLEADO' => 9414, 'OFICINA' => 840, 'AREA' => 3001, 'EXPEDIENTE' => 102004202323497],
			['FOLIOID' => 3847, 'ANO' => 2023, 'MUNICIPIO' => 2, 'EMPLEADO' => 4058, 'OFICINA' => 394, 'AREA' => 3301, 'EXPEDIENTE' => 102002202318930],
			['FOLIOID' => 3851, 'ANO' => 2023, 'MUNICIPIO' => 2, 'EMPLEADO' => 4058, 'OFICINA' => 394, 'AREA' => 3301, 'EXPEDIENTE' => 102002202318936],
			['FOLIOID' => 3861, 'ANO' => 2023, 'MUNICIPIO' => 4, 'EMPLEADO' => 10609, 'OFICINA' => 906, 'AREA' => 4023, 'EXPEDIENTE' => 102004202323491],
			['FOLIOID' => 3866, 'ANO' => 2023, 'MUNICIPIO' => 4, 'EMPLEADO' => 10391, 'OFICINA' => 810, 'AREA' => 2854, 'EXPEDIENTE' => 102004202323490],
			['FOLIOID' => 3892, 'ANO' => 2023, 'MUNICIPIO' => 4, 'EMPLEADO' => 10391, 'OFICINA' => 810, 'AREA' => 2854, 'EXPEDIENTE' => 102004202323580],
			['FOLIOID' => 3899, 'ANO' => 2023, 'MUNICIPIO' => 4, 'EMPLEADO' => 9457, 'OFICINA' => 838, 'AREA' => 2964, 'EXPEDIENTE' => 102004202323639],
			['FOLIOID' => 3999, 'ANO' => 2023, 'MUNICIPIO' => 4, 'EMPLEADO' => 10432, 'OFICINA' => 906, 'AREA' => 4259, 'EXPEDIENTE' => 102004202323873],
			['FOLIOID' => 4005, 'ANO' => 2023, 'MUNICIPIO' => 4, 'EMPLEADO' => 10511, 'OFICINA' => 812, 'AREA' => 2857, 'EXPEDIENTE' => 102004202323833],
			['FOLIOID' => 4035, 'ANO' => 2023, 'MUNICIPIO' => 2, 'EMPLEADO' => 1122, 'OFICINA' => 300, 'AREA' => 2136, 'EXPEDIENTE' => 102002202319169],
			['FOLIOID' => 4066, 'ANO' => 2023, 'MUNICIPIO' => 4, 'EMPLEADO' => 10432, 'OFICINA' => 906, 'AREA' => 4259, 'EXPEDIENTE' => 102004202323871],
			['FOLIOID' => 4093, 'ANO' => 2023, 'MUNICIPIO' => 4, 'EMPLEADO' => 10432, 'OFICINA' => 906, 'AREA' => 4259, 'EXPEDIENTE' => 102004202323977],
			['FOLIOID' => 4118, 'ANO' => 2023, 'MUNICIPIO' => 4, 'EMPLEADO' => 10531, 'OFICINA' => 807, 'AREA' => 3629, 'EXPEDIENTE' => 502004202313477],
			['FOLIOID' => 4187, 'ANO' => 2023, 'MUNICIPIO' => 3, 'EMPLEADO' => 3395, 'OFICINA' => 316, 'AREA' => 2408, 'EXPEDIENTE' => 102003202302262],
			['FOLIOID' => 4210, 'ANO' => 2023, 'MUNICIPIO' => 2, 'EMPLEADO' => 1122, 'OFICINA' => 300, 'AREA' => 2136, 'EXPEDIENTE' => 102002202319431],
			['FOLIOID' => 4264, 'ANO' => 2023, 'MUNICIPIO' => 2, 'EMPLEADO' => 4058, 'OFICINA' => 394, 'AREA' => 3301, 'EXPEDIENTE' => 102002202319470],
			['FOLIOID' => 4308, 'ANO' => 2023, 'MUNICIPIO' => 4, 'EMPLEADO' => 9414, 'OFICINA' => 840, 'AREA' => 3001, 'EXPEDIENTE' => 102004202324453],
			['FOLIOID' => 4355, 'ANO' => 2023, 'MUNICIPIO' => 4, 'EMPLEADO' => 10432, 'OFICINA' => 906, 'AREA' => 4259, 'EXPEDIENTE' => 102004202324410],
			['FOLIOID' => 4402, 'ANO' => 2023, 'MUNICIPIO' => 4, 'EMPLEADO' => 10168, 'OFICINA' => 806, 'AREA' => 2866, 'EXPEDIENTE' => 502004202313696],
			['FOLIOID' => 4408, 'ANO' => 2023, 'MUNICIPIO' => 4, 'EMPLEADO' => 9414, 'OFICINA' => 840, 'AREA' => 3001, 'EXPEDIENTE' => 102004202324554],
			['FOLIOID' => 4419, 'ANO' => 2023, 'MUNICIPIO' => 3, 'EMPLEADO' => 3983, 'OFICINA' => 325, 'AREA' => 2653, 'EXPEDIENTE' => 502003202301596],
			['FOLIOID' => 4421, 'ANO' => 2023, 'MUNICIPIO' => 4, 'EMPLEADO' => 10391, 'OFICINA' => 810, 'AREA' => 2854, 'EXPEDIENTE' => 102004202324815],
			['FOLIOID' => 4448, 'ANO' => 2023, 'MUNICIPIO' => 2, 'EMPLEADO' => 1122, 'OFICINA' => 300, 'AREA' => 2136, 'EXPEDIENTE' => 102002202319729],
			['FOLIOID' => 4451, 'ANO' => 2023, 'MUNICIPIO' => 2, 'EMPLEADO' => 4058, 'OFICINA' => 394, 'AREA' => 3301, 'EXPEDIENTE' => 102002202319738],
			['FOLIOID' => 4539, 'ANO' => 2023, 'MUNICIPIO' => 4, 'EMPLEADO' => 10432, 'OFICINA' => 906, 'AREA' => 4259, 'EXPEDIENTE' => 102004202324839],
			['FOLIOID' => 4590, 'ANO' => 2023, 'MUNICIPIO' => 4, 'EMPLEADO' => 10609, 'OFICINA' => 840, 'AREA' => 4023, 'EXPEDIENTE' => 102004202324888],
			['FOLIOID' => 4710, 'ANO' => 2023, 'MUNICIPIO' => 4, 'EMPLEADO' => 9414, 'OFICINA' => 840, 'AREA' => 3001, 'EXPEDIENTE' => 102004202325128],
			['FOLIOID' => 4787, 'ANO' => 2023, 'MUNICIPIO' => 4, 'EMPLEADO' => 10432, 'OFICINA' => 906, 'AREA' => 4259, 'EXPEDIENTE' => 102004202325315],
			['FOLIOID' => 4852, 'ANO' => 2023, 'MUNICIPIO' => 5, 'EMPLEADO' => 9398, 'OFICINA' => 866, 'AREA' => 3611, 'EXPEDIENTE' => 502005202301326],
			['FOLIOID' => 4887, 'ANO' => 2023, 'MUNICIPIO' => 2, 'EMPLEADO' => 4058, 'OFICINA' => 394, 'AREA' => 3301, 'EXPEDIENTE' => 102002202320390],
			['FOLIOID' => 4893, 'ANO' => 2023, 'MUNICIPIO' => 4, 'EMPLEADO' => 10432, 'OFICINA' => 906, 'AREA' => 4259, 'EXPEDIENTE' => 102004202325543],
			['FOLIOID' => 4905, 'ANO' => 2023, 'MUNICIPIO' => 4, 'EMPLEADO' => 9551, 'OFICINA' => 846, 'AREA' => 3037, 'EXPEDIENTE' => 102004202325551],
			['FOLIOID' => 4964, 'ANO' => 2023, 'MUNICIPIO' => 4, 'EMPLEADO' => 9551, 'OFICINA' => 846, 'AREA' => 3037, 'EXPEDIENTE' => 102004202325871],
			['FOLIOID' => 5016, 'ANO' => 2023, 'MUNICIPIO' => 4, 'EMPLEADO' => 10511, 'OFICINA' => 812, 'AREA' => 2857, 'EXPEDIENTE' => 102004202325801],
			['FOLIOID' => 5024, 'ANO' => 2023, 'MUNICIPIO' => 4, 'EMPLEADO' => 9385, 'OFICINA' => 864, 'AREA' => 3175, 'EXPEDIENTE' => 502004202314424],
			['FOLIOID' => 5039, 'ANO' => 2023, 'MUNICIPIO' => 2, 'EMPLEADO' => 1122, 'OFICINA' => 300, 'AREA' => 2136, 'EXPEDIENTE' => 102002202320633],
			['FOLIOID' => 5059, 'ANO' => 2023, 'MUNICIPIO' => 4, 'EMPLEADO' => 10432, 'OFICINA' => 906, 'AREA' => 4259, 'EXPEDIENTE' => 102004202326043],
			['FOLIOID' => 5100, 'ANO' => 2023, 'MUNICIPIO' => 4, 'EMPLEADO' => 10609, 'OFICINA' => 848, 'AREA' => 4023, 'EXPEDIENTE' => 102004202325995],
			['FOLIOID' => 5157, 'ANO' => 2023, 'MUNICIPIO' => 4, 'EMPLEADO' => 10432, 'OFICINA' => 906, 'AREA' => 4259, 'EXPEDIENTE' => 102004202326102],
			['FOLIOID' => 5182, 'ANO' => 2023, 'MUNICIPIO' => 4, 'EMPLEADO' => 9551, 'OFICINA' => 846, 'AREA' => 3037, 'EXPEDIENTE' => 102004202326167],
			['FOLIOID' => 5270, 'ANO' => 2023, 'MUNICIPIO' => 4, 'EMPLEADO' => 10391, 'OFICINA' => 810, 'AREA' => 2854, 'EXPEDIENTE' => 102004202326306],
			['FOLIOID' => 5278, 'ANO' => 2023, 'MUNICIPIO' => 5, 'EMPLEADO' => 9940, 'OFICINA' => 894, 'AREA' => 4226, 'EXPEDIENTE' => 102005202302671],
			['FOLIOID' => 5325, 'ANO' => 2023, 'MUNICIPIO' => 4, 'EMPLEADO' => 9551, 'OFICINA' => 846, 'AREA' => 3037, 'EXPEDIENTE' => 102004202326428],
			['FOLIOID' => 5375, 'ANO' => 2023, 'MUNICIPIO' => 4, 'EMPLEADO' => 10160, 'OFICINA' => 807, 'AREA' => 3630, 'EXPEDIENTE' => 502004202314672],
			['FOLIOID' => 5415, 'ANO' => 2023, 'MUNICIPIO' => 4, 'EMPLEADO' => 10609, 'OFICINA' => 810, 'AREA' => 4023, 'EXPEDIENTE' => 102004202326610],
			['FOLIOID' => 5449, 'ANO' => 2023, 'MUNICIPIO' => 2, 'EMPLEADO' => 1122, 'OFICINA' => 52, 'AREA' => 2136, 'EXPEDIENTE' => 102002202321445],
			['FOLIOID' => 5453, 'ANO' => 2023, 'MUNICIPIO' => 2, 'EMPLEADO' => 1122, 'OFICINA' => 52, 'AREA' => 2136, 'EXPEDIENTE' => 102002202321393],
			['FOLIOID' => 5524, 'ANO' => 2023, 'MUNICIPIO' => 3, 'EMPLEADO' => 3926, 'OFICINA' => 392, 'AREA' => 3219, 'EXPEDIENTE' => 102003202302519],
			['FOLIOID' => 5561, 'ANO' => 2023, 'MUNICIPIO' => 5, 'EMPLEADO' => 10708, 'OFICINA' => 894, 'AREA' => 4495, 'EXPEDIENTE' => 102005202302731],
			['FOLIOID' => 5565, 'ANO' => 2023, 'MUNICIPIO' => 4, 'EMPLEADO' => 9551, 'OFICINA' => 805, 'AREA' => 3037, 'EXPEDIENTE' => 102004202326934],
			['FOLIOID' => 5578, 'ANO' => 2023, 'MUNICIPIO' => 4, 'EMPLEADO' => 9001, 'OFICINA' => 808, 'AREA' => 2842, 'EXPEDIENTE' => 102004202327189],
			['FOLIOID' => 5581, 'ANO' => 2023, 'MUNICIPIO' => 4, 'EMPLEADO' => 10432, 'OFICINA' => 906, 'AREA' => 4259, 'EXPEDIENTE' => 102004202327187],
			['FOLIOID' => 5593, 'ANO' => 2023, 'MUNICIPIO' => 4, 'EMPLEADO' => 9551, 'OFICINA' => 846, 'AREA' => 3037, 'EXPEDIENTE' => 102004202326953],
			['FOLIOID' => 5602, 'ANO' => 2023, 'MUNICIPIO' => 4, 'EMPLEADO' => 10609, 'OFICINA' => 906, 'AREA' => 4023, 'EXPEDIENTE' => 102004202326964],
			['FOLIOID' => 5622, 'ANO' => 2023, 'MUNICIPIO' => 4, 'EMPLEADO' => 9551, 'OFICINA' => 846, 'AREA' => 3037, 'EXPEDIENTE' => 102004202327965],
			['FOLIOID' => 5648, 'ANO' => 2023, 'MUNICIPIO' => 4, 'EMPLEADO' => 10432, 'OFICINA' => 906, 'AREA' => 4259, 'EXPEDIENTE' => 102004202327050],
			['FOLIOID' => 5660, 'ANO' => 2023, 'MUNICIPIO' => 5, 'EMPLEADO' => 9940, 'OFICINA' => 894, 'AREA' => 4226, 'EXPEDIENTE' => 102005202302742],
			['FOLIOID' => 5666, 'ANO' => 2023, 'MUNICIPIO' => 1, 'EMPLEADO' => 8836, 'OFICINA' => 715, 'AREA' => 2559, 'EXPEDIENTE' => 102001202309169],
			['FOLIOID' => 5701, 'ANO' => 2023, 'MUNICIPIO' => 4, 'EMPLEADO' => 10692, 'OFICINA' => 807, 'AREA' => 3209, 'EXPEDIENTE' => 502004202314960],
			['FOLIOID' => 5740, 'ANO' => 2023, 'MUNICIPIO' => 2, 'EMPLEADO' => 2769, 'OFICINA' => 3, 'AREA' => 25, 'EXPEDIENTE' => 502002202320368],
			['FOLIOID' => 5745, 'ANO' => 2023, 'MUNICIPIO' => 3, 'EMPLEADO' => 3395, 'OFICINA' => 316, 'AREA' => 2408, 'EXPEDIENTE' => 102003202302568],
			['FOLIOID' => 5807, 'ANO' => 2023, 'MUNICIPIO' => 2, 'EMPLEADO' => 1122, 'OFICINA' => 300, 'AREA' => 2136, 'EXPEDIENTE' => 102002202321852],
			['FOLIOID' => 5808, 'ANO' => 2023, 'MUNICIPIO' => 4, 'EMPLEADO' => 10432, 'OFICINA' => 906, 'AREA' => 4259, 'EXPEDIENTE' => 102004202327373],
			['FOLIOID' => 5867, 'ANO' => 2023, 'MUNICIPIO' => 4, 'EMPLEADO' => 9551, 'OFICINA' => 846, 'AREA' => 3037, 'EXPEDIENTE' => 102004202327484],
			['FOLIOID' => 5868, 'ANO' => 2023, 'MUNICIPIO' => 4, 'EMPLEADO' => 9551, 'OFICINA' => 846, 'AREA' => 3037, 'EXPEDIENTE' => 102004202327514],
			['FOLIOID' => 5908, 'ANO' => 2023, 'MUNICIPIO' => 2, 'EMPLEADO' => 2809, 'OFICINA' => 3, 'AREA' => 2875, 'EXPEDIENTE' => 502002202320577],
			['FOLIOID' => 5929, 'ANO' => 2023, 'MUNICIPIO' => 4, 'EMPLEADO' => 9414, 'OFICINA' => 840, 'AREA' => 3001, 'EXPEDIENTE' => 102004202327640],
			['FOLIOID' => 6018, 'ANO' => 2023, 'MUNICIPIO' => 5, 'EMPLEADO' => 9398, 'OFICINA' => 865, 'AREA' => 3611, 'EXPEDIENTE' => 502005202301438],
			['FOLIOID' => 6113, 'ANO' => 2023, 'MUNICIPIO' => 4, 'EMPLEADO' => 9991, 'OFICINA' => 810, 'AREA' => 3107, 'EXPEDIENTE' => 102004202328116],
			['FOLIOID' => 6166, 'ANO' => 2023, 'MUNICIPIO' => 2, 'EMPLEADO' => 2904, 'OFICINA' => 300, 'AREA' => 2159, 'EXPEDIENTE' => 102002202322415],
			['FOLIOID' => 6229, 'ANO' => 2023, 'MUNICIPIO' => 4, 'EMPLEADO' => 10224, 'OFICINA' => 840, 'AREA' => 3015, 'EXPEDIENTE' => 102004202328389],
			['FOLIOID' => 6233, 'ANO' => 2023, 'MUNICIPIO' => 4, 'EMPLEADO' => 9537, 'OFICINA' => 848, 'AREA' => 3054, 'EXPEDIENTE' => 102004202328365],
			['FOLIOID' => 6252, 'ANO' => 2023, 'MUNICIPIO' => 4, 'EMPLEADO' => 9527, 'OFICINA' => 906, 'AREA' => 4260, 'EXPEDIENTE' => 102004202328404],
			['FOLIOID' => 6256, 'ANO' => 2023, 'MUNICIPIO' => 2, 'EMPLEADO' => 2904, 'OFICINA' => 300, 'AREA' => 2159, 'EXPEDIENTE' => 102002202322535],
			['FOLIOID' => 6331, 'ANO' => 2023, 'MUNICIPIO' => 4, 'EMPLEADO' => 9991, 'OFICINA' => 810, 'AREA' => 3107, 'EXPEDIENTE' => 102004202328578],
			['FOLIOID' => 6440, 'ANO' => 2023, 'MUNICIPIO' => 4, 'EMPLEADO' => 10738, 'OFICINA' => 906, 'AREA' => 4260, 'EXPEDIENTE' => 102004202328891],
			['FOLIOID' => 6479, 'ANO' => 2023, 'MUNICIPIO' => 4, 'EMPLEADO' => 10680, 'OFICINA' => 906, 'AREA' => 4264, 'EXPEDIENTE' => 102004202328932],
			['FOLIOID' => 6552, 'ANO' => 2023, 'MUNICIPIO' => 4, 'EMPLEADO' => 10738, 'OFICINA' => 906, 'AREA' => 4260, 'EXPEDIENTE' => 102004202329088],
			['FOLIOID' => 6644, 'ANO' => 2023, 'MUNICIPIO' => 5, 'EMPLEADO' => 9578, 'OFICINA' => 894, 'AREA' => 4380, 'EXPEDIENTE' => 102005202302940],
			['FOLIOID' => 6669, 'ANO' => 2023, 'MUNICIPIO' => 4, 'EMPLEADO' => 9770, 'OFICINA' => 840, 'AREA' => 3624, 'EXPEDIENTE' => 102004202329619],
			['FOLIOID' => 6689, 'ANO' => 2023, 'MUNICIPIO' => 4, 'EMPLEADO' => 10187, 'OFICINA' => 906, 'AREA' => 4261, 'EXPEDIENTE' => 102004202329356],
			['FOLIOID' => 6692, 'ANO' => 2023, 'MUNICIPIO' => 4, 'EMPLEADO' => 9490, 'OFICINA' => 846, 'AREA' => 3038, 'EXPEDIENTE' => 102004202329483],
			['FOLIOID' => 6706, 'ANO' => 2023, 'MUNICIPIO' => 4, 'EMPLEADO' => 9374, 'OFICINA' => 806, 'AREA' => 3618, 'EXPEDIENTE' => 502004202315963],
			['FOLIOID' => 6731, 'ANO' => 2023, 'MUNICIPIO' => 4, 'EMPLEADO' => 10453, 'OFICINA' => 906, 'AREA' => 4263, 'EXPEDIENTE' => 102004202329588],
			['FOLIOID' => 6743, 'ANO' => 2023, 'MUNICIPIO' => 4, 'EMPLEADO' => 10173, 'OFICINA' => 906, 'AREA' => 4341, 'EXPEDIENTE' => 102004202329472],
			['FOLIOID' => 6745, 'ANO' => 2023, 'MUNICIPIO' => 4, 'EMPLEADO' => 10173, 'OFICINA' => 906, 'AREA' => 4341, 'EXPEDIENTE' => 102004202329485],
			['FOLIOID' => 6758, 'ANO' => 2023, 'MUNICIPIO' => 4, 'EMPLEADO' => 10332, 'OFICINA' => 864, 'AREA' => 3823, 'EXPEDIENTE' => 502004202316012],
			['FOLIOID' => 6780, 'ANO' => 2023, 'MUNICIPIO' => 1, 'EMPLEADO' => 8155, 'OFICINA' => 781, 'AREA' => 2568, 'EXPEDIENTE' => 102001202309942],
			['FOLIOID' => 6785, 'ANO' => 2023, 'MUNICIPIO' => 3, 'EMPLEADO' => 2963, 'OFICINA' => 316, 'AREA' => 2427, 'EXPEDIENTE' => 102003202302773],
			['FOLIOID' => 6790, 'ANO' => 2023, 'MUNICIPIO' => 3, 'EMPLEADO' => 2955, 'OFICINA' => 392, 'AREA' => 2409, 'EXPEDIENTE' => 102003202302774],
			['FOLIOID' => 6842, 'ANO' => 2023, 'MUNICIPIO' => 4, 'EMPLEADO' => 10187, 'OFICINA' => 906, 'AREA' => 4261, 'EXPEDIENTE' => 102004202330060],
			['FOLIOID' => 6851, 'ANO' => 2023, 'MUNICIPIO' => 4, 'EMPLEADO' => 10453, 'OFICINA' => 906, 'AREA' => 4263, 'EXPEDIENTE' => 102004202329735],
			['FOLIOID' => 6867, 'ANO' => 2023, 'MUNICIPIO' => 4, 'EMPLEADO' => 10432, 'OFICINA' => 906, 'AREA' => 4259, 'EXPEDIENTE' => 102004202329655],
			['FOLIOID' => 6873, 'ANO' => 2023, 'MUNICIPIO' => 4, 'EMPLEADO' => 10652, 'OFICINA' => 906, 'AREA' => 4405, 'EXPEDIENTE' => 102004202329673],
			['FOLIOID' => 6879, 'ANO' => 2023, 'MUNICIPIO' => 2, 'EMPLEADO' => 2904, 'OFICINA' => 300, 'AREA' => 2159, 'EXPEDIENTE' => 102002202323555],
			['FOLIOID' => 6892, 'ANO' => 2023, 'MUNICIPIO' => 4, 'EMPLEADO' => 8506, 'OFICINA' => 846, 'AREA' => 3073, 'EXPEDIENTE' => 102004202329697],
			['FOLIOID' => 6894, 'ANO' => 2023, 'MUNICIPIO' => 2, 'EMPLEADO' => 2904, 'OFICINA' => 300, 'AREA' => 2159, 'EXPEDIENTE' => 102002202323433],
			['FOLIOID' => 6899, 'ANO' => 2023, 'MUNICIPIO' => 4, 'EMPLEADO' => 9723, 'OFICINA' => 840, 'AREA' => 3028, 'EXPEDIENTE' => 102004202329709],
			['FOLIOID' => 6919, 'ANO' => 2023, 'MUNICIPIO' => 4, 'EMPLEADO' => 9771, 'OFICINA' => 838, 'AREA' => 4244, 'EXPEDIENTE' => 102004202329757],
			['FOLIOID' => 6922, 'ANO' => 2023, 'MUNICIPIO' => 4, 'EMPLEADO' => 10738, 'OFICINA' => 906, 'AREA' => 4260, 'EXPEDIENTE' => 102004202329763],
			['FOLIOID' => 6923, 'ANO' => 2023, 'MUNICIPIO' => 4, 'EMPLEADO' => 3036, 'OFICINA' => 864, 'AREA' => 3608, 'EXPEDIENTE' => 502004202316161],
			['FOLIOID' => 6930, 'ANO' => 2023, 'MUNICIPIO' => 4, 'EMPLEADO' => 10680, 'OFICINA' => 906, 'AREA' => 4264, 'EXPEDIENTE' => 102004202329811],
			['FOLIOID' => 6940, 'ANO' => 2023, 'MUNICIPIO' => 4, 'EMPLEADO' => 9538, 'OFICINA' => 840, 'AREA' => 3001, 'EXPEDIENTE' => 102004202329826],
			['FOLIOID' => 6958, 'ANO' => 2023, 'MUNICIPIO' => 1, 'EMPLEADO' => 8615, 'OFICINA' => 719, 'AREA' => 2566, 'EXPEDIENTE' => 102001202310134],
			['FOLIOID' => 6998, 'ANO' => 2023, 'MUNICIPIO' => 4, 'EMPLEADO' => 10902, 'OFICINA' => 806, 'AREA' => 3679, 'EXPEDIENTE' => 502004202316254],
			['FOLIOID' => 7005, 'ANO' => 2023, 'MUNICIPIO' => 4, 'EMPLEADO' => 10692, 'OFICINA' => 807, 'AREA' => 3209, 'EXPEDIENTE' => 502004202316257],
			['FOLIOID' => 7113, 'ANO' => 2023, 'MUNICIPIO' => 4, 'EMPLEADO' => 10453, 'OFICINA' => 906, 'AREA' => 4263, 'EXPEDIENTE' => 102004202330139],
			['FOLIOID' => 7182, 'ANO' => 2023, 'MUNICIPIO' => 1, 'EMPLEADO' => 8685, 'OFICINA' => 776, 'AREA' => 2866, 'EXPEDIENTE' => 102001202310212],
			['FOLIOID' => 7211, 'ANO' => 2023, 'MUNICIPIO' => 3, 'EMPLEADO' => 3945, 'OFICINA' => 316, 'AREA' => 2412, 'EXPEDIENTE' => 102003202302867],
			['FOLIOID' => 7217, 'ANO' => 2023, 'MUNICIPIO' => 4, 'EMPLEADO' => 10738, 'OFICINA' => 906, 'AREA' => 4260, 'EXPEDIENTE' => 102004202330466],
			['FOLIOID' => 7220, 'ANO' => 2023, 'MUNICIPIO' => 4, 'EMPLEADO' => 9385, 'OFICINA' => 864, 'AREA' => 3175, 'EXPEDIENTE' => 502004202316448],
			['FOLIOID' => 7299, 'ANO' => 2023, 'MUNICIPIO' => 4, 'EMPLEADO' => 10683, 'OFICINA' => 838, 'AREA' => 2968, 'EXPEDIENTE' => 102004202330454],
			['FOLIOID' => 7327, 'ANO' => 2023, 'MUNICIPIO' => 4, 'EMPLEADO' => 10453, 'OFICINA' => 906, 'AREA' => 4263, 'EXPEDIENTE' => 102004202330504],
			['FOLIOID' => 7340, 'ANO' => 2023, 'MUNICIPIO' => 2, 'EMPLEADO' => 2740, 'OFICINA' => 394, 'AREA' => 226, 'EXPEDIENTE' => 102002202324043],
			['FOLIOID' => 7483, 'ANO' => 2023, 'MUNICIPIO' => 4, 'EMPLEADO' => 9553, 'OFICINA' => 906, 'AREA' => 4262, 'EXPEDIENTE' => 102004202330780],
			['FOLIOID' => 7512, 'ANO' => 2023, 'MUNICIPIO' => 4, 'EMPLEADO' => 10832, 'OFICINA' => 924, 'AREA' => 4488, 'EXPEDIENTE' => 102004202330832],
			['FOLIOID' => 7559, 'ANO' => 2023, 'MUNICIPIO' => 3, 'EMPLEADO' => 2955, 'OFICINA' => 317, 'AREA' => 2409, 'EXPEDIENTE' => 102003202302937],
			['FOLIOID' => 7647, 'ANO' => 2023, 'MUNICIPIO' => 2, 'EMPLEADO' => 2600, 'OFICINA' => 306, 'AREA' => 2168, 'EXPEDIENTE' => 102002202324454],
			['FOLIOID' => 7727, 'ANO' => 2023, 'MUNICIPIO' => 4, 'EMPLEADO' => 10511, 'OFICINA' => 812, 'AREA' => 2857, 'EXPEDIENTE' => 102004202331458],
			['FOLIOID' => 7885, 'ANO' => 2023, 'MUNICIPIO' => 4, 'EMPLEADO' => 9551, 'OFICINA' => 846, 'AREA' => 3037, 'EXPEDIENTE' => 102004202331552],
			['FOLIOID' => 7889, 'ANO' => 2023, 'MUNICIPIO' => 4, 'EMPLEADO' => 9410, 'OFICINA' => 845, 'AREA' => 3025, 'EXPEDIENTE' => 102004202331686],
			['FOLIOID' => 7958, 'ANO' => 2023, 'MUNICIPIO' => 1, 'EMPLEADO' => 8615, 'OFICINA' => 720, 'AREA' => 2566, 'EXPEDIENTE' => 102001202310690],
			['FOLIOID' => 8016, 'ANO' => 2023, 'MUNICIPIO' => 4, 'EMPLEADO' => 10747, 'OFICINA' => 843, 'AREA' => 4520, 'EXPEDIENTE' => 102004202331751],

		];

		// Arreglo para almacenar los objetos
		$arreglo = [];

		// Crear y añadir objetos al arreglo
		foreach ($datosRegistros as $datos) {
			$objeto = (object) $datos;
			$arreglo[] = $objeto;
		}


		foreach ($arreglo as $key => $folio) {
			$folioid = $folio->FOLIOID;
			$year = $folio->ANO;
			$expediente = $folio->EXPEDIENTE;
			$municipio = $folio->MUNICIPIO;
			$empleado = $folio->EMPLEADO;
			$oficina = $folio->OFICINA;
			$area = $folio->MUNICIPIO;


			$archivosPericiales = $this->subirArchivosRemision($folioid, $year, $expediente);

			//Se revisa que haya documentos subidos a Justicia de tipo periciales
			$folioDocPericiales = $this->_folioDocModelRead->expedienteDocumentosJusticia($folioid, $year);

			// try {

			if ($folioDocPericiales) {
				foreach ($folioDocPericiales as $key => $doc) {
					$solicitudp = array();
					$solicitudp['ESTADOID'] = 2;
					$solicitudp['MUNICIPIOID'] = $municipio;
					$solicitudp['EMPLEADOIDREGISTRO'] = $empleado;
					$solicitudp['OFICINAIDREGISTRO'] = $oficina;
					$solicitudp['AREAIDREGISTRO'] = $area;
					$solicitudp['ANO'] = $doc->ANO;
					$solicitudp['TITULO'] = $doc->TIPODOC;

					// Se suben los documentos periciales a Justicia.
					$_solicitudPericial = $this->_createSolicitudesPericiales($solicitudp);
					if ($_solicitudPericial->status == 201) {
						//Crea la solicitud pericial a Justicia.
						$_solicitudDocto = $this->_createSolicitudDocto($expediente, $_solicitudPericial->SOLICITUDID, $doc->EXPEDIENTEDOCID, $municipio);

						if ($_solicitudDocto->status == 201) {
							//Crea la solicityd en el expediente a Justicia.
							$_solicitudExpediente = $this->_createSolicitudExpediente($expediente, $_solicitudPericial->SOLICITUDID, $municipio);
							$plantilla = (object) array();

							$plantilla = $this->_plantillasModel->where('TITULO',  $doc->TIPODOC)->first();
							//Se obtiene el id de intervencion de acuerdo al municipio
							if ($municipio == 1 ||  $municipio == 6) {
								$intervencion = $plantilla['INTERVENCIONENSENADAID'];
							} else if ($municipio == 2 || $municipio == 3 || $municipio == 7) {
								$intervencion = $plantilla['INTERVENCIONMEXICALIID'];
							} else if ($municipio == 4 || $municipio == 5) {
								$intervencion = $plantilla['INTERVENCIONTIJUANAID'];
							}
							$dataInter =  array('SOLICITUDID' => $_solicitudPericial->SOLICITUDID, 'INTERVENCIONID' => $intervencion);

							//Se crea la intervención pericial a Justicia.
							$_intervencionPericial = $this->_createIntervencionPericial($dataInter, $municipio);

							if ($_intervencionPericial->status == 201) {
								$datosBitacora = [
									'ACCION' => 'Se envio una solicitud pericial.',
									'NOTAS' => 'Exp: ' . $expediente . ' Solicitud: ' . $_solicitudPericial->SOLICITUDID . 'Intervencion' . $intervencion,
								];
								$this->_bitacoraActividad($datosBitacora);
							}
						}
					}
				}
			}
		}
		return json_encode(['status' => 1, 'message' => 'Se han sincronizado las coordinaciones de los expedientes de CDTEC con Justicia Net correctamente.']);

		// } catch (\Error $e) {
		// 	throw new \Exception('Error en actualizacion en Justicia: ' . $e->getMessage());
		// }
	}
	/**
	 * Función para verificar que el correo no exista
	 * Recibe por metodo POST el email
	 *
	 */
	public function existEmailAdmin()
	{
		$email = $this->request->getPost('email');
		$data = $this->_usuariosModelRead->where('CORREO', $email)->first();
		if ($data == null) {
			return json_encode((object) ['exist' => 0]);
		} else if (count($data) > 0) {
			return json_encode((object) ['exist' => 1]);
		} else {
			return json_encode((object) ['exist' => 0]);
		}
	}

	/**
	 * Función para obtener las oficinas de acuerdo al municipio.
	 * Recibe por metodo POST el municipio
	 *
	 */
	public function getOficinasByMunicipio()
	{
		$municipio = $this->request->getPost('municipio');

		if (!empty($municipio)) {
			if (gettype($municipio) == "array") {
				$data = $this->_oficinasModelRead->asObject()->whereIn('MUNICIPIOID', $municipio)->orderBy('OFICINADESCR', 'asc')->findAll();
				return json_encode($data);
			} else {
				$data = $this->_oficinasModelRead->asObject()->where('MUNICIPIOID', $municipio)->orderBy('OFICINADESCR', 'asc')->findAll();
				return json_encode($data);
			}
		} else {
			$data = $this->_oficinasModelRead->asObject()->orderBy('OFICINADESCR', 'asc')->findAll();
			return json_encode($data);
		}
	}

	/**
	 * Función para obtener todos los documentos
	 * Recibe por metodo POST el folio y el año.
	 */
	public function getDocumentosByFolio()
	{
		$folio = $this->request->getPost('folio');
		$year = $this->request->getPost('year');

		$data = $this->_folioDocModelRead->asObject()->where('FOLIOID', $folio)->where('ANO', $year)->where('AGENTE_ASIGNADO !=', null)->first();
		if ($data) {
			return json_encode(['status' => 1]);
		} else {
			return json_encode(['status' => 0]);
		}
	}

	/**
	 * Función para obtener todas las instituciones de derivaciones de acuerdo al municipio.
	 * Se recibe por metodo POST el municipio
	 *
	 */
	public function getDerivacionByMunicipio()
	{
		$municipio = $this->request->getPost('municipio');
		$data = $this->_derivacionesAtencionesModelRead->asObject()->where('MUNICIPIOID', $municipio)->orderBy('INSTITUCIONREMISIONDESCR', 'asc')->findAll();
		return json_encode($data);
	}

	/**
	 * Función para obtener la relación de personas fisicas y delitos.
	 * Recibe por metodo POST el folio y año.
	 *
	 */
	public function getDelitosModalidad()
	{
		$folio = $this->request->getPost('folio');
		$year = $this->request->getPost('year');
		$data =  $this->_relacionIDOModelRead->get_by_folio($folio, $year);

		return json_encode($data);
	}


	/**
	 * Función para obtener todas las instituciones de canalizaciones de acuerdo al municipio.
	 * Se recibe por metodo POST el municipio
	 *
	 */
	public function getCanalizacionByMunicipio()
	{
		$municipio = $this->request->getPost('municipio');
		$data = $this->_canalizacionesAtencionesModelRead->asObject()->where('MUNICIPIOID', $municipio)->orderBy('INSTITUCIONREMISIONDESCR', 'asc')->findAll();
		return json_encode($data);
	}
	/**
	 * Función para obtener los empleados de acuerdo al municipio y oficina.
	 * Se recibe por metodo POST el municipio y oficina.
	 *
	 */
	public function getEmpleadosByMunicipioAndOficina()
	{
		$municipio = $this->request->getPost('municipio');
		$oficina = $this->request->getPost('oficina');

		if (!empty($municipio) && !empty($municipio)) {
			$data = $this->_empleadosModelRead->asObject()->where('MUNICIPIOID', $municipio)->where('OFICINAID', $oficina)->orderBy('NOMBRE', 'asc')->findAll();
			return json_encode($data);
		} else {
			$data = [];
			return json_encode($data);
		}
	}

	/**
	 * Función para actualizar el status del folio cuando se le da salida de tipo DERIVADO O CANALIZADO.
	 * Recibe por metodo POST el status, notas del agente, folio, año, municipio de institucion, institucion id y el tipo de denuncia (en caso de ser modificado)
	 *
	 */
	public function updateStatusFolio()
	{
		$status = $this->request->getPost('status');
		$motivo = $this->request->getPost('motivo');
		$folio = $this->request->getPost('folio');
		$year = $this->request->getPost('year');
		$institutomunicipio = $this->request->getPost('institutomunicipio');
		$institutoremision = $this->request->getPost('institutoremision');
		$telefonica = $this->request->getPost('denuncia_tel');
		$electronica = $this->request->getPost('denuncia_electronica');

		$agenteId = session('ID') ? session('ID') : 1;

		try {

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
			if ($telefonica == 'S') {
				$data['TIPODENUNCIA'] = 'TE';
			}
			if ($electronica == 'S') {
				$data['TIPODENUNCIA'] = 'EL';
			}
			if (!empty($status) && !empty($motivo) && !empty($year) && !empty($folio) && !empty($agenteId)) {
				$folioRow = $this->_folioModelRead->where('ANO', $year)->where('FOLIOID', $folio)->where('STATUS', 'EN PROCESO')->first();
				$folioVehiculoRow = $this->_folioVehiculoModelRead->where('ANO', $year)->where('FOLIOID', $folio)->findAll();

				if ($folioRow) {
					//Se detecta que en la DB existan todos los campos necesarios para Justicia
					$this->deteccionErrores($folioRow, $folioVehiculoRow);
					$update = $this->_folioModel->set($data)->where('ANO', $year)->where('FOLIOID', $folio)->update();


					if ($update) {
						$datosBitacora = [
							'ACCION' => 'Ha actualizado el status del folio a derivado o canalizado.',
							'NOTAS' => 'FOLIO: ' . $folio . ' AÑO: ' . $year . ' STATUS: ' . $status == 'ATENDIDA' ? 'CANALIZADO' : $status,
						];

						$this->_bitacoraActividad($datosBitacora);

						$folio = $this->_folioModelRead->asObject()->where('FOLIOID', $folio)->where('ANO', $year)->first();
						$denunciante = $this->_denunciantesModelRead->asObject()->where('DENUNCIANTEID', $folio->DENUNCIANTEID)->first();
						if ($folio->TIPODENUNCIA == 'VD' || $folio->TIPODENUNCIA == 'TE' || $folio->TIPODENUNCIA == 'EL') {

							if ($this->_sendEmailDerivacionCanalizacion($denunciante->CORREO, $folio->FOLIOID, $status)) {
								return json_encode(['status' => 1]);
							} else {
								return json_encode(['status' => 1]);
							}
						} else if ($folio->TIPODENUNCIA == 'DA') {
							return json_encode(['status' => 1]);
						}
					} else {
						return json_encode(['status' => 0, 'error' => 'No hizo actualizo el folio.']);
					}
				} else {
					return json_encode(['status' => 0, 'error' => 'Ya fue atendido el folio o alguien lo libero cuando lo estaba trabajando.']);
				}
			} else {
				return json_encode(['status' => 0, 'error' => 'No existe alguna de las variables']);
			}
		} catch (\Exception $e) {
			return json_encode(['status' => 0, 'error' => $e->getMessage()]);
		}
	}

	/**
	 * Función para detectar que todos los campos requeridos en Justicia esten completos.
	 *
	 * @param  mixed $folioRow
	 * @param  mixed $folioVehiculoRow
	 */
	public function deteccionErrores($folioRow, $folioVehiculoRow)
	{

		if ($folioRow['TIPODENUNCIA'] == 'VD' || $folioRow['TIPODENUNCIA'] == 'TE' || $folioRow['TIPODENUNCIA'] == 'EL') {
			$error_messages = array();

			if (($folioRow['MUNICIPIOID'] == '' || $folioRow['MUNICIPIOID'] == NULL)) {
				$error_messages[] = 'Municipio no especificado';
			}
			if (($folioRow['HECHOMUNICIPIOID'] == '' || $folioRow['HECHOMUNICIPIOID'] == NULL)) {
				$error_messages[] = 'Municipio del hecho no especificado';
			}
			if (($folioRow['HECHOLOCALIDADID'] == '' || $folioRow['HECHOLOCALIDADID'] == NULL)) {
				$error_messages[] = 'Localidad del hecho no especificada';
			}
			if (($folioRow['HECHOCOLONIADESCR'] == '' || $folioRow['HECHOCOLONIADESCR'] == NULL)) {
				$error_messages[] = 'Colonia del hecho no especificada';
			}
			if (($folioRow['HECHOCALLE'] == '' || $folioRow['HECHOCALLE'] == NULL)) {
				$error_messages[] = 'Calle del hecho no especificada';
			}
			if (($folioRow['HECHONUMEROCASA'] == '' || $folioRow['HECHONUMEROCASA'] == NULL)) {
				$error_messages[] = 'Número de casa del hecho no especificado';
			}
			if (($folioRow['HECHOLUGARID'] == '' || $folioRow['HECHOLUGARID'] == NULL)) {
				$error_messages[] = 'Lugar del hecho no especificado';
			}
			if (($folioRow['HECHOFECHA'] == '' || $folioRow['HECHOFECHA'] == NULL)) {
				$error_messages[] = 'Fecha del hecho no especificada';
			}
			if (($folioRow['HECHOHORA'] == '' || $folioRow['HECHOHORA'] == NULL)) {
				$error_messages[] = 'Hora del hecho no especificada';
			}
			if (($folioRow['HECHONARRACION'] == '' || $folioRow['HECHONARRACION'] == NULL)) {
				$error_messages[] = 'Narración del hecho no especificada';
			}
			if (($folioRow['HECHODELITO'] == '' || $folioRow['HECHODELITO'] == NULL)) {
				$error_messages[] = 'Tipo de delito del hecho no especificado';
			}

			if (!empty($error_messages)) {
				$error_message = 'Actualiza los campos de información del hecho: ';
				$error_message .= implode(PHP_EOL, $error_messages);
				throw new \Exception($error_message);
			}
		} else {
			$error_messages = array();

			if (($folioRow['MUNICIPIOID'] == '' || $folioRow['MUNICIPIOID'] == NULL)) {
				$error_messages[] = 'Municipio no especificado';
			}
			if (($folioRow['HECHOMUNICIPIOID'] == '' || $folioRow['HECHOMUNICIPIOID'] == NULL)) {
				$error_messages[] = 'Municipio del hecho no especificado';
			}
			if (($folioRow['HECHOLOCALIDADID'] == '' || $folioRow['HECHOLOCALIDADID'] == NULL)) {
				$error_messages[] = 'Localidad del hecho no especificada';
			}
			if (($folioRow['HECHOCOLONIADESCR'] == '' || $folioRow['HECHOCOLONIADESCR'] == NULL)) {
				$error_messages[] = 'Colonia del hecho no especificada';
			}
			if (($folioRow['HECHOCALLE'] == '' || $folioRow['HECHOCALLE'] == NULL)) {
				$error_messages[] = 'Calle del hecho no especificada';
			}
			if (($folioRow['HECHONUMEROCASA'] == '' || $folioRow['HECHONUMEROCASA'] == NULL)) {
				$error_messages[] = 'Número de casa del hecho no especificado';
			}
			if (($folioRow['HECHOLUGARID'] == '' || $folioRow['HECHOLUGARID'] == NULL)) {
				$error_messages[] = 'Lugar del hecho no especificado';
			}
			if (($folioRow['HECHOFECHA'] == '' || $folioRow['HECHOFECHA'] == NULL)) {
				$error_messages[] = 'Fecha del hecho no especificada';
			}
			if (($folioRow['HECHOHORA'] == '' || $folioRow['HECHOHORA'] == NULL)) {
				$error_messages[] = 'Hora del hecho no especificada';
			}
			if (($folioRow['HECHONARRACION'] == '' || $folioRow['HECHONARRACION'] == NULL)) {
				$error_messages[] = 'Narración del hecho no especificada';
			}
			if (!empty($error_messages)) {
				$error_message = 'Actualiza los campos de información del hecho: ';
				$error_message .= implode(PHP_EOL, $error_messages);
				throw new \Exception($error_message);
			}
		}
		foreach ($folioVehiculoRow as $key => $vehiculo) {
			if (($vehiculo['SITUACION'] == '' || $vehiculo['SITUACION'] == NULL)
				|| ($vehiculo['ESTADOIDPLACA'] == '' || $vehiculo['ESTADOIDPLACA'] == NULL)
				|| ($vehiculo['VEHICULODISTRIBUIDORID'] == '' || $vehiculo['VEHICULODISTRIBUIDORID'] == NULL)
				|| ($vehiculo['MARCAID'] == '' || $vehiculo['MARCAID'] == NULL)
				|| ($vehiculo['MODELOID'] == '' || $vehiculo['MODELOID'] == NULL)
				|| ($vehiculo['ANOVEHICULO'] == '' || $vehiculo['ANOVEHICULO'] == NULL)
				|| ($vehiculo['PERSONAFISICAIDPROPIETARIO'] == '' || $vehiculo['PERSONAFISICAIDPROPIETARIO'] == NULL)
			) {
				$mensajeError = 'Faltan los siguientes campos en el vehículo: ';
				if ($vehiculo['SITUACION'] == '' || $vehiculo['SITUACION'] == NULL) {
					$error_messages[] = 'Situación, ';
				}
				if ($vehiculo['ESTADOIDPLACA'] == '' || $vehiculo['ESTADOIDPLACA'] == NULL) {
					$mensajeError .= 'Estado de la placa, ';
				}
				if ($vehiculo['VEHICULODISTRIBUIDORID'] == '' || $vehiculo['VEHICULODISTRIBUIDORID'] == NULL) {
					$mensajeError .= 'Distribuidor, ';
				}
				if ($vehiculo['MARCAID'] == '' || $vehiculo['MARCAID'] == NULL) {
					$mensajeError .= 'Marca, ';
				}
				if ($vehiculo['MODELOID'] == '' || $vehiculo['MODELOID'] == NULL) {
					$mensajeError .= 'Modelo, ';
				}
				if ($vehiculo['ANOVEHICULO'] == '' || $vehiculo['ANOVEHICULO'] == NULL) {
					$mensajeError .= 'Año del vehículo, ';
				}
				if ($vehiculo['PERSONAFISICAIDPROPIETARIO'] == '' || $vehiculo['PERSONAFISICAIDPROPIETARIO'] == NULL) {
					$mensajeError .= 'Propietario, ';
				}
				$mensajeError = rtrim($mensajeError, ', ');
				throw new \Exception($mensajeError);
			}
		}
	}
	/**
	 * Función para dar salida y crear expediente en Justicia.
	 * Se recibe por metodo POST el folio, año, municipio, estado, notas del agente, tipo de expediente, y tipo de denuncia.
	 *
	 */
	public function saveInJusticia()
	{
		$folio = $this->request->getPost('folio');
		$year = $this->request->getPost('year');
		$municipio = $this->request->getPost('municipio');
		$estado = empty($this->request->getPost('estado')) ? 2 : $this->request->getPost('estado');
		$notas = $this->request->getPost('notas');
		$tiposExpedienteId = $this->request->getPost('tipo_expediente');
		$telefonica = $this->request->getPost('denuncia_tel');
		$electronica = $this->request->getPost('denuncia_electronica');

		try {
			if (!empty($tiposExpedienteId) && !empty($folio) && !empty($municipio) && !empty($estado) && !empty($notas)) {
				$folioRow = $this->_folioModelRead->where('ANO', $year)->where('FOLIOID', $folio)->where('STATUS', 'EN PROCESO')->where('EXPEDIENTEID IS NULL')->first();
				$folioVehiculoRow = $this->_folioVehiculoModelRead->where('ANO', $year)->where('FOLIOID', $folio)->findAll();

				if ($folioRow) {
					//Se detecta que en la DB existan todos los campos necesarios para Justicia

					$this->deteccionErrores($folioRow, $folioVehiculoRow);

					//Se consultan los datos a enviar a Justicia.

					$personas = $this->_folioPersonaFisicaModelRead->where('FOLIOID', $folioRow['FOLIOID'])->where('ANO', $year)->orderBy('PERSONAFISICAID', 'asc')->findAll();
					$fisImpDelito = $this->_imputadoDelitoModelRead->where('FOLIOID', $folioRow['FOLIOID'])->where('ANO', $year)->findAll();
					$relacionFisFis = $this->_relacionIDOModelRead->where('FOLIOID', $folioRow['FOLIOID'])->where('ANO', $year)->findAll();
					$parentescos = $this->_parentescoPersonaFisicaModelRead->where('FOLIOID', $folioRow['FOLIOID'])->where('ANO', $year)->findAll();
					$vehiculos = $this->_folioVehiculoModelRead->where('FOLIOID', $folioRow['FOLIOID'])->where('ANO', $year)->findAll();


					$imputados_con_delito = array();
					$imputados = $this->_folioPersonaFisicaModelRead->where('FOLIOID', $folioRow['FOLIOID'])->where('ANO', $year)->orderBy('PERSONAFISICAID', 'asc')->where('CALIDADJURIDICAID', 2)->findAll();

					//Validación para dar salida al municipio correcto
					if (($folioRow['HECHOMUNICIPIOID'] == 1) && !($municipio == 1)) {
						throw new \Exception('Solo puedes dar salida a Ensenada.');
					} else if (($folioRow['HECHOMUNICIPIOID'] == 2) && !($municipio == 2)) {
						throw new \Exception('Solo puedes dar salida a Mexicali.');
					} else if (($folioRow['HECHOMUNICIPIOID'] == 3) && !($municipio == 3)) {
						throw new \Exception('Solo puedes dar salida a Tecate.');
					} else if (($folioRow['HECHOMUNICIPIOID'] == 4) && !($municipio == 4)) {
						throw new \Exception('Solo puedes dar salida a Tijuana.');
					} else if (($folioRow['HECHOMUNICIPIOID'] == 5) && !($municipio == 5)) {
						throw new \Exception('Solo puedes dar salida a Playas de Rosarito.');
					} else if (($folioRow['HECHOMUNICIPIOID'] == 6) && !($municipio == 6)) {
						throw new \Exception('Solo puedes dar salida a San Quintin.');
					} else if (($folioRow['HECHOMUNICIPIOID'] == 7) && !($municipio == 7)) {
						throw new \Exception('Solo puedes dar salida a San Felipe.');
					}

					if ($municipio == 6) {
						$municipio = 1;
					}

					if ($municipio == 7) {
						$municipio = 2;
					}

					// Verificación para que todos los imputados tengan un delito y una relación con el ofendido
					foreach ($fisImpDelito as $value) {
						if (!in_array($value['PERSONAFISICAID'], $imputados_con_delito)) {
							array_push($imputados_con_delito, $value['PERSONAFISICAID']);
						}
					}

					if (count($imputados_con_delito) != count($imputados)) {
						throw new \Exception('Todos los imputados deben tener al menos 1 delito asignado');
					}

					if (count($relacionFisFis) == 0 || count($relacionFisFis) <= 0) {
						throw new \Exception('Todos los imputados deben tener una relación con una persona física');
					}


					$narracion = $folioRow['HECHONARRACION'];
					$fecha = $folioRow['HECHOFECHA'];

					//Asignación de variables para creaar el expediente
					$folioRow['MUNICIPIOID'] = $municipio;
					$folioRow['ESTADOID'] = $estado;
					$folioRow['HECHOMEDIOCONOCIMIENTOID'] = (string) 6;
					$folioRow['NOTASAGENTE'] = strtoupper($notas);
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
					// 	'EXPEDIENTEID' => '102001202305366'
					// );
					// return json_encode(['info' => $expedienteCreado]);

					// Destruye variables 
					unset($folioRow['OFICINAIDRESPONSABLE']);
					unset($folioRow['EMPLEADOIDREGISTRO']);
					unset($folioRow['AREAIDREGISTRO']);
					unset($folioRow['AREAIDRESPONSABLE']);
					unset($folioRow['ESTADOJURIDICOEXPEDIENTEID']);
					// unset($folioRow['TIPOEXPEDIENTEID']);

					$folioRow['HECHONARRACION'] = $narracion;
					$folioRow['HECHOFECHA'] = $fecha;
					$folioRow['MUNICIPIOASIGNADOID'] = $municipio;
					if ($telefonica == 'S') {
						$folioRow['TIPODENUNCIA'] = 'TE';
					}
					if ($electronica == 'S') {
						$folioRow['TIPODENUNCIA'] = 'EL';
					}


					if ($expedienteCreado->status == 201) {
						$folioRow['EXPEDIENTEID'] = $expedienteCreado->EXPEDIENTEID;
						$folioRow['FECHASALIDA'] = date('Y-m-d H:i:s');

						$datosBitacora = [
							'ACCION' => 'Ha creado un expediente.',
							'NOTAS' => 'FOLIO: ' . $folio . ' AÑO: ' . $year . ' EXPEDIENTE: ' . $expedienteCreado->EXPEDIENTEID
						];
						$this->_bitacoraActividad($datosBitacora);


						//Se actualiza la DB en VIDEODENUNCIA
						$update = $this->_folioModel->set($folioRow)->where('FOLIOID', $folio)->where('ANO', $year)->update();
						$personasRelacionMysqlOracle = array();
						try {
							foreach ($personas as $key => $persona) {
								if ($persona['NOMBRE'] == 'QRR') {
									$persona['NOMBRE'] = 'QUIEN RESULTE RESPONSABLE';
								} else if ($persona['NOMBRE'] == 'QRO') {
									$persona['NOMBRE'] = 'QUIEN RESULTE OFENDIDO';
								}

								//Se crean todas las personas fisicas
								$_persona = $this->_createPersonaFisica($expedienteCreado->EXPEDIENTEID, $persona, $municipio);
								if ($_persona->status == 201) {

									//Si es correcto se crea el imputado, domicilios y media filiacion de cada persona.
									$domicilios = $this->_folioPersonaFisicaDomicilioModelRead->where('FOLIOID', $folioRow['FOLIOID'])->where('ANO', $year)->where('PERSONAFISICAID', $persona['PERSONAFISICAID'])->findAll();
									$mediaFiliacion = $this->_folioMediaFiliacionRead->where('FOLIOID', $folioRow['FOLIOID'])->where('ANO', $year)->where('PERSONAFISICAID', $persona['PERSONAFISICAID'])->first();

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

							//Se crea la relacion Persona Física Imputado delito
							if (count($fisImpDelito) > 0) {
								foreach ($fisImpDelito as $imputadodelito) {
									try {
										$relacion = $personasRelacionMysqlOracle[$imputadodelito['PERSONAFISICAID']];
										$_fisimpdelito = $this->_createFisImpDelito($expedienteCreado->EXPEDIENTEID, $imputadodelito, $relacion['id_oracle'], $municipio);
									} catch (\Error $e) {
									}
								}
							}

							//Se crea la relacion Victima Imputado
							if (count($relacionFisFis) > 0) {
								foreach ($relacionFisFis as $fisFis) {
									try {
										$victima = $personasRelacionMysqlOracle[$fisFis['PERSONAFISICAIDVICTIMA']];
										$imputado = $personasRelacionMysqlOracle[$fisFis['PERSONAFISICAIDIMPUTADO']];
										$_relacionFisFis = $this->_createRelacionFisFis($expedienteCreado->EXPEDIENTEID, $fisFis, $victima['id_oracle'], $imputado['id_oracle'], $municipio);
										// Expediente vehiculo
										if ($fisFis['DELITOMODALIDADID'] == 178 || $fisFis['DELITOMODALIDADID'] == 179) {
											//Si el delito asignado es robo de vehiculo se crea el expediente del vehiculo.
											if (count($vehiculos) > 0) {
												foreach ($vehiculos as $vehiculo) {
													if ($vehiculo['PLACAS'] == '') {
														$vehiculo['PLACAS'] = 'VACIO';
													}
													if ($vehiculo['NUMEROSERIE'] == '') {
														$vehiculo['NUMEROSERIE'] = 'VACIO';
													}
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

							// Se crea la relacion Persona Física Imputado delito
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
							$datosBitacora = [
								'ACCION' => 'Ha actualizado el folio con expediente.',
								'NOTAS' => 'FOLIO: ' . $folio . ' AÑO: ' . $year . ' EXPEDIENTE: ' . $expedienteCreado->EXPEDIENTEID
							];
							$this->_bitacoraActividad($datosBitacora);
							if ($folioRow['TIPODENUNCIA'] == 'VD' || $folioRow['TIPODENUNCIA'] == 'TE' || $folioRow['TIPODENUNCIA'] == 'EL') {
								$denunciante = $this->_denunciantesModelRead->asObject()->where('DENUNCIANTEID', $folioRow['DENUNCIANTEID'])->first();
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
					throw new \Exception('Ya fue atendido el folio o alguien lo libero cuando lo estaba trabajando.');
				}
			} else {
				throw new \Exception('No se enviarón todas las variables necesarias.');
			}
		} catch (\Exception $e) {
			return json_encode(['status' => 0, 'error' => $e->getMessage()]);
		}
	}


	/**
	 * Función para subir los archivos y documentos a Justicia antes de remisión
	 * Se recibe por metodo POST el folio, año y expediente
	 */
	public function crearArchivo()
	{
		$folio = $this->request->getPost('folio');
		$year = $this->request->getPost('year');
		$expediente = $this->request->getPost('expediente');

		$folioDocSinFirmar = $this->_folioDocModelRead->where('FOLIOID', $folio)->where('ANO', $year)->where('STATUS', 'ABIERTO')->orderBy('FOLIODOCID', 'asc')->findAll();
		// Se revisa que no hayan documentos sin firmar
		if ($folioDocSinFirmar) {
			return json_encode((object)['status' => 4]);
		}

		$foliovd = $this->_folioModelRead->where('FOLIOID', $folio)->where('ANO', $year)->where('EXPEDIENTEID', $expediente)->where('STATUS', 'EXPEDIENTE')->first();
		$folioDoc = $this->_folioDocModelRead->where('FOLIOID', $folio)->where('ANO', $year)->where('STATUS', 'FIRMADO')->orderBy('FOLIODOCID', 'asc')->findAll();
		$archivosExternosVD = $this->_archivoExternoModelRead->where('FOLIOID', $folio)->where('ANO', $year)->findAll();
		$folioDocPeritaje = $this->_folioDocModelRead->expedienteDocumentos($folio, $year);

		if ($archivosExternosVD) {
			try {

				foreach ($archivosExternosVD as $key => $arch) {
					//Se verifica que los archivos externos no esten subidos en Justicia para no repetirlos
					$relacionDocArc = $this->_relacionFolioDocModelRead->where('FOLIOID', $arch['FOLIOID'])->where('ANO', $arch['ANO'])->where('FOLIODOCID', $arch['FOLIOARCHIVOID'])->where('TIPO', 'ARCHIVO')->orderBy('FOLIODOCID', 'asc')->first();
					if ($relacionDocArc == NULL) {
						$municipioid = $foliovd['MUNICIPIOID'] ? $foliovd['MUNICIPIOID'] : NULL;

						//Se asigna el autor y oficina de acuerdo al .ENV
						try {
							if (ENVIRONMENT == 'development') {
								if ($foliovd['MUNICIPIOASIGNADOID'] == 1) {
									$autor = 8987;
									$oficina = 793;
								} else if ($foliovd['MUNICIPIOASIGNADOID'] == 2 || $foliovd['MUNICIPIOASIGNADOID'] == 3) {
									$autor = 3968;
									$oficina = 394;
								} else if ($foliovd['MUNICIPIOASIGNADOID'] == 4 || $foliovd['MUNICIPIOASIGNADOID'] == 5) {
									$autor = 10872;
									$oficina = 924;
								}
							}

							if (ENVIRONMENT == 'production') {
								if ($foliovd['MUNICIPIOASIGNADOID'] == 1) {
									$autor = 8988;
									$oficina = 793;
								} else if ($foliovd['MUNICIPIOASIGNADOID'] == 2 || $foliovd['MUNICIPIOASIGNADOID'] == 3) {
									$autor = 4179;
									$oficina = 409;
								} else if ($foliovd['MUNICIPIOASIGNADOID'] == 4 || $foliovd['MUNICIPIOASIGNADOID'] == 5) {
									$autor = 10832;
									$oficina = 924;
								}
							}
							// Se suben los archivos externos a Justicia.
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
					//Se verifica que los documentos no esten subidos en Justicia para no repetirlos

					$relacionDocArc = $this->_relacionFolioDocModelRead->where('FOLIOID', $doc['FOLIOID'])->where('ANO', $doc['ANO'])->where('FOLIODOCID', $doc['FOLIODOCID'])->where('TIPO', 'ARCHIVO DOC')->orderBy('FOLIODOCID', 'asc')->first();
					if ($relacionDocArc == NULL) {
						$municipioid = $foliovd['MUNICIPIOID'] ? $foliovd['MUNICIPIOID'] : NULL;
						//Se asigna el autor y oficina de acuerdo al .ENV

						try {
							if (ENVIRONMENT == 'development') {
								if ($foliovd['MUNICIPIOASIGNADOID'] == 1) {
									$autor = 8987;
									$oficina = 793;
								} else if ($foliovd['MUNICIPIOASIGNADOID'] == 2 || $foliovd['MUNICIPIOASIGNADOID'] == 3) {
									$autor = 3968;
									$oficina = 394;
								} else if ($foliovd['MUNICIPIOASIGNADOID'] == 4 || $foliovd['MUNICIPIOASIGNADOID'] == 5) {
									$autor = 10872;
									$oficina = 924;
								}
							}

							if (ENVIRONMENT == 'production') {
								if ($foliovd['MUNICIPIOASIGNADOID'] == 1) {
									$autor = 8988;
									$oficina = 793;
								} else if ($foliovd['MUNICIPIOASIGNADOID'] == 2 || $foliovd['MUNICIPIOASIGNADOID'] == 3) {
									$autor = 4179;
									$oficina = 409;
								} else if ($foliovd['MUNICIPIOASIGNADOID'] == 4 || $foliovd['MUNICIPIOASIGNADOID'] == 5) {
									$autor = 10832;
									$oficina = 924;
								}
							}
							// Se suben los documentos a Justicia.
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
					$relacionDocExpDoc = $this->_relacionFolioDocExpDocRead->where('FOLIOID', $docP->FOLIOID)->where('ANO', $docP->ANO)->where('EXPEDIENTEID', $docP->NUMEROEXPEDIENTE)->where('FOLIODOCID', $docP->FOLIODOCID)->orderBy('FOLIODOCID', 'asc')->first();

					if ($relacionDocExpDoc == null) {
						// Se crean los RTF´s de las solicitudes periciales
						try {
							PHPRtfLite::registerAutoloader();
							// instancia de documento rtf 
							$rtf = new PHPRtfLite();
							$sect = $rtf->addSection();
							$docP->PLACEHOLDER = str_replace('</p>', '<br>', $docP->PLACEHOLDER);

							$sinetiqueta = strip_tags($docP->PLACEHOLDER, ['strong', 'br']); //placeolder sin etiquetas html
							//escribe el texto del rtf
							$sect->writeText($sinetiqueta, new PHPRtfLite_Font(11, 'Arial'), new PHPRtfLite_ParFormat(PHPRtfLite_ParFormat::TEXT_ALIGN_LEFT));
							// save rtf document
							$rtf->save('assets/' . $docP->NUMEROEXPEDIENTE . '_' . $docP->FOLIODOCID . '.rtf');
							$tarjet = FCPATH  . 'assets/' . $docP->NUMEROEXPEDIENTE . "_" . $docP->FOLIODOCID . ".rtf";
							//Blob del rtf guardado
							$data = file_get_contents($tarjet);
							//Convierte el blob a UTF-16LE
							$utf16le = mb_convert_encoding($data, 'UTF-16LE');

							$plantilla = (object) array();
							$plantilla = $this->_plantillasModelRead->where('TITULO', $docP->TIPODOC)->first();
							$documentos = array();

							//Convierte el blob a base64 para enviarlo al webservice.
							$documentos['DOCUMENTO'] = base64_encode($utf16le);
							$documentos['DOCTODESCR'] = $docP->TIPODOC;


							//Se asigna el autor y oficina dependiendo del enviroment
							if (ENVIRONMENT == 'development') {
								if ($foliovd['MUNICIPIOASIGNADOID'] == 1) {
									$documentos['AUTOR'] = 8987;
									$documentos['OFICINAIDAUTOR'] = 793;
								} else if ($foliovd['MUNICIPIOASIGNADOID'] == 2 || $foliovd['MUNICIPIOASIGNADOID'] == 3) {
									$documentos['AUTOR'] = 3968;
									$documentos['OFICINAIDAUTOR'] = 394;
								} else if ($foliovd['MUNICIPIOASIGNADOID'] == 4 || $foliovd['MUNICIPIOASIGNADOID'] == 5) {
									$documentos['AUTOR'] = 10872;
									$documentos['OFICINAIDAUTOR'] = 924;
								}
							}

							if (ENVIRONMENT == 'production') {
								if ($foliovd['MUNICIPIOASIGNADOID'] == 1) {
									$documentos['AUTOR'] = 8988;
									$documentos['OFICINAIDAUTOR'] = 793;
								} else if ($foliovd['MUNICIPIOASIGNADOID'] == 2 || $foliovd['MUNICIPIOASIGNADOID'] == 3) {
									$documentos['AUTOR'] = 4179;
									$documentos['OFICINAIDAUTOR'] = 409;
								} else if ($foliovd['MUNICIPIOASIGNADOID'] == 4 || $foliovd['MUNICIPIOASIGNADOID'] == 5) {
									$documentos['AUTOR'] = 10832;
									$documentos['OFICINAIDAUTOR'] = 924;
								}
							}

							// Se asigna la clasificacion y plantilla de acuerdo al municipio
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


							// Se crean los documentos periciales
							$expedienteDocumento = $this->_createFolioDocumentos($expediente, $documentos, $docP->MUNICIPIOID);
							if ($expedienteDocumento->status == 201) {
								unlink(FCPATH  . 'assets/' . $docP->NUMEROEXPEDIENTE . "_" . $docP->FOLIODOCID . ".rtf");
								// unlink(FCPATH  . 'assets/' . $doc['NUMEROEXPEDIENTE'] . "_" . $doc['FOLIODOCID'] . ".bin");	
								$datosRelacionFolioExpDoc = [
									'FOLIODOCID' => $docP->FOLIODOCID,
									'FOLIOID' =>  $docP->FOLIOID,
									'ANO' => $docP->ANO,
									'EXPEDIENTEID' => $expedienteDocumento->EXPEDIENTEID,
									'EXPEDIENTEDOCID' => $expedienteDocumento->DOCUMENTOID,
								];

								$this->_relacionFolioDocExpDoc->insert($datosRelacionFolioExpDoc);
							}
						} catch (\Throwable $th) {
							return json_encode(['status' => 0, 'error' => $th->getMessage()]);
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


	/**
	 * Función para subir los archivos y documentos a Justicia desde la remisión
	 *
	 * @param  mixed $folio
	 * @param  mixed $year
	 * @param  mixed $expediente
	 */
	public function subirArchivosRemision($folio, $year, $expediente)
	{
		$folioDocSinFirmar = $this->_folioDocModel->where('FOLIOID', $folio)->where('ANO', $year)->where('STATUS', 'ABIERTO')->orderBy('FOLIODOCID', 'asc')->findAll();
		// Se revisa que no hayan documentos sin firmar
		if ($folioDocSinFirmar) {
			return json_encode((object)['status' => 4]);
		}
		$foliovd = $this->_folioModelRead->where('FOLIOID', $folio)->where('ANO', $year)->where('EXPEDIENTEID', $expediente)->where('STATUS', 'EXPEDIENTE')->first();
		$folioDoc = $this->_folioDocModelRead->where('FOLIOID', $folio)->where('ANO', $year)->where('STATUS', 'FIRMADO')->orderBy('FOLIODOCID', 'asc')->findAll();
		$archivosExternosVD = $this->_archivoExternoModelRead->where('FOLIOID', $folio)->where('ANO', $year)->findAll();
		$folioDocPeritaje = $this->_folioDocModelRead->expedienteDocumentos($folio, $year);
		try {

			if ($archivosExternosVD) {
				try {

					foreach ($archivosExternosVD as $key => $arch) {
						//Se verifica que los archivos externos no esten subidos en Justicia para no repetirlos

						$relacionDocArc = $this->_relacionFolioDocModelRead->where('FOLIOID', $arch['FOLIOID'])->where('ANO', $arch['ANO'])->where('FOLIODOCID', $arch['FOLIOARCHIVOID'])->where('TIPO', 'ARCHIVO')->orderBy('FOLIODOCID', 'asc')->first();
						if ($relacionDocArc == NULL) {
							$municipioid = $foliovd['MUNICIPIOID'] ? $foliovd['MUNICIPIOID'] : NULL;
							//Se asigna el autor y oficina de acuerdo al .ENV

							try {
								if (ENVIRONMENT == 'development') {
									if ($foliovd['MUNICIPIOASIGNADOID'] == 1) {
										$autor = 8987;
										$oficina = 793;
									} else if ($foliovd['MUNICIPIOASIGNADOID'] == 2 || $foliovd['MUNICIPIOASIGNADOID'] == 3) {
										$autor = 3968;
										$oficina = 394;
									} else if ($foliovd['MUNICIPIOASIGNADOID'] == 4 || $foliovd['MUNICIPIOASIGNADOID'] == 5) {
										$autor = 10872;
										$oficina = 924;
									}
								}

								if (ENVIRONMENT == 'production') {
									if ($foliovd['MUNICIPIOASIGNADOID'] == 1) {
										$autor = 8988;
										$oficina = 793;
									} else if ($foliovd['MUNICIPIOASIGNADOID'] == 2 || $foliovd['MUNICIPIOASIGNADOID'] == 3) {
										$autor = 4179;
										$oficina = 409;
									} else if ($foliovd['MUNICIPIOASIGNADOID'] == 4 || $foliovd['MUNICIPIOASIGNADOID'] == 5) {
										$autor = 10832;
										$oficina = 924;
									}
								}
								// Se suben los archivos externos a Justicia.


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
						//Se verifica que los documentos no esten subidos en Justicia para no repetirlos

						$relacionDocArc = $this->_relacionFolioDocModelRead->where('FOLIOID', $doc['FOLIOID'])->where('ANO', $doc['ANO'])->where('FOLIODOCID', $doc['FOLIODOCID'])->where('TIPO', 'ARCHIVO DOC')->orderBy('FOLIODOCID', 'asc')->first();
						if ($relacionDocArc == NULL) {
							$municipioid = $foliovd['MUNICIPIOID'] ? $foliovd['MUNICIPIOID'] : NULL;
							//Se asigna el autor y oficina de acuerdo al .ENV

							try {
								if (ENVIRONMENT == 'development') {
									if ($foliovd['MUNICIPIOASIGNADOID'] == 1) {
										$autor = 8987;
										$oficina = 793;
									} else if ($foliovd['MUNICIPIOASIGNADOID'] == 2 || $foliovd['MUNICIPIOASIGNADOID'] == 3) {
										$autor = 3968;
										$oficina = 394;
									} else if ($foliovd['MUNICIPIOASIGNADOID'] == 4 || $foliovd['MUNICIPIOASIGNADOID'] == 5) {
										$autor = 10872;
										$oficina = 924;
									}
								}

								if (ENVIRONMENT == 'production') {
									if ($foliovd['MUNICIPIOASIGNADOID'] == 1) {
										$autor = 8988;
										$oficina = 793;
									} else if ($foliovd['MUNICIPIOASIGNADOID'] == 2 || $foliovd['MUNICIPIOASIGNADOID'] == 3) {
										$autor = 4179;
										$oficina = 409;
									} else if ($foliovd['MUNICIPIOASIGNADOID'] == 4 || $foliovd['MUNICIPIOASIGNADOID'] == 5) {
										$autor = 10832;
										$oficina = 924;
									}
								}
								// Se suben los documentos a Justicia.

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

						$relacionDocExpDoc = $this->_relacionFolioDocExpDocRead->where('FOLIOID', $docP->FOLIOID)->where('ANO', $docP->ANO)->where('EXPEDIENTEID', $docP->NUMEROEXPEDIENTE)->where('FOLIODOCID', $docP->FOLIODOCID)->orderBy('FOLIODOCID', 'asc')->first();

						if ($relacionDocExpDoc == null) {
							// Se crean los RTF´s de las solicitudes periciales

							try {
								// PHPRtfLite::registerAutoloader();
								// instancia de documento rtf 
								$rtf = new PHPRtfLite();
								$sect = $rtf->addSection();
								$docP->PLACEHOLDER = str_replace('</p>', '<br>', $docP->PLACEHOLDER);

								$sinetiqueta = strip_tags($docP->PLACEHOLDER, ['strong', 'br']); //placeolder sin etiquetas html
								//escribe el texto del rtf
								$sect->writeText($sinetiqueta, new PHPRtfLite_Font(11, 'Arial'), new PHPRtfLite_ParFormat(PHPRtfLite_ParFormat::TEXT_ALIGN_JUSTIFY));
								// save rtf document
								$rtf->save('assets/' . $docP->NUMEROEXPEDIENTE . '_' . $docP->FOLIODOCID . '.rtf');
								$tarjet = FCPATH  . 'assets/' . $docP->NUMEROEXPEDIENTE . "_" . $docP->FOLIODOCID . ".rtf";
								//Blob del rtf guardado
								$data = file_get_contents($tarjet);
								//Convierte el blob a UTF-16LE
								$utf16le = mb_convert_encoding($data, 'UTF-16LE');

								$plantilla = (object) array();
								$plantilla = $this->_plantillasModelRead->where('TITULO', $docP->TIPODOC)->first();
								$documentos = array();

								//Convierte el blob a base64 para enviarlo al webservice.
								$documentos['DOCUMENTO'] = base64_encode($utf16le);
								$documentos['DOCTODESCR'] = $docP->TIPODOC;
								//Se asigna el autor y oficina dependiendo del enviroment

								if (ENVIRONMENT == 'development') {
									if ($foliovd['MUNICIPIOASIGNADOID'] == 1) {
										$documentos['AUTOR'] = 8987;
										$documentos['OFICINAIDAUTOR'] = 793;
									} else if ($foliovd['MUNICIPIOASIGNADOID'] == 2 || $foliovd['MUNICIPIOASIGNADOID'] == 3) {
										$documentos['AUTOR'] = 3968;
										$documentos['OFICINAIDAUTOR'] = 394;
									} else if ($foliovd['MUNICIPIOASIGNADOID'] == 4 || $foliovd['MUNICIPIOASIGNADOID'] == 5) {
										$documentos['AUTOR'] = 10872;
										$documentos['OFICINAIDAUTOR'] = 924;
									}
								}
								if (ENVIRONMENT == 'production') {
									if ($foliovd['MUNICIPIOASIGNADOID'] == 1) {
										$documentos['AUTOR'] = 8988;
										$documentos['OFICINAIDAUTOR'] = 793;
									} else if ($foliovd['MUNICIPIOASIGNADOID'] == 2 || $foliovd['MUNICIPIOASIGNADOID'] == 3) {
										$documentos['AUTOR'] = 4179;
										$documentos['OFICINAIDAUTOR'] = 409;
									} else if ($foliovd['MUNICIPIOASIGNADOID'] == 4 || $foliovd['MUNICIPIOASIGNADOID'] == 5) {
										$documentos['AUTOR'] = 10832;
										$documentos['OFICINAIDAUTOR'] = 924;
									}
								}
								// Se asigna la clasificacion y plantilla de acuerdo al municipio

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



								// Se crean los documentos periciales


								$expedienteDocumento = $this->_createFolioDocumentos($expediente, $documentos, $docP->MUNICIPIOID);
								if ($expedienteDocumento->status == 201) {

									unlink(FCPATH  . 'assets/' . $docP->NUMEROEXPEDIENTE . "_" . $docP->FOLIODOCID . ".rtf");
									// unlink(FCPATH  . 'assets/' . $doc['NUMEROEXPEDIENTE'] . "_" . $doc['FOLIODOCID'] . ".bin");	
									$datosRelacionFolioExpDoc = [
										'FOLIODOCID' => $docP->FOLIODOCID,
										'FOLIOID' =>  $docP->FOLIOID,
										'ANO' => $docP->ANO,
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
					return json_encode(['status' => 0, 'error' => $e->getMessage()]);
				}
			} else {
			}
			// return json_encode(['status' => 1]);
		} catch (\Exception $e) {
			return json_encode(['status' => 0, 'error' => $e->getMessage()]);
		}
	}

	/**
	 * Función para crear el expediente en Justicia.
	 *
	 * @param  mixed $folioRow
	 */
	private function _createExpediente($folioRow)
	{
		$function = '/expediente.php?process=crear';
		$endpoint = $this->endpoint . $function;
		//Se crea la conexion de acrdo al municipio y enviroment.
		$conexion = $this->_conexionesDBModelRead->asObject()->where('ESTADOID', 2)->where('MUNICIPIOID', (int) $folioRow['MUNICIPIOID'])->where('TYPE', ENVIRONMENT)->first();
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

		// Se limpian varibles nulas o que no esten en el array definido
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

	/**
	 * Función para crear personas fisicas en Justicia
	 *
	 * @param  mixed $expedienteId
	 * @param  mixed $personaFisica
	 * @param  mixed $municipio
	 */
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
		//Se crea la conexion de acuerdo al municipio y enviroment.

		$conexion = $this->_conexionesDBModelRead->asObject()->where('ESTADOID', 2)->where('MUNICIPIOID', (int) $municipio)->where('TYPE', ENVIRONMENT)->first();
		$data = $personaFisica;

		$data['PERSONAESCOLARIDADID'] = $data['ESCOLARIDADID'];

		if (!empty($data['FECHANACIMIENTO'])) {
			if ($data['FECHANACIMIENTO'] == '0000-00-00' || $data['FECHANACIMIENTO'] == null || $data['FECHANACIMIENTO'] == null || $data['FECHANACIMIENTO'] == 'NULL' || $data['FECHANACIMIENTO'] == 'null') {
				$data['FECHANACIMIENTO'] = null;
			}
		}

		//Se sube la foto cuando la persona es desaparecida
		if ($data['DESAPARECIDA'] == "N") {
			$data['FOTO'] = null;
		} else {
			try {
				$data['FOTO'] = $data['FOTO'] ? base64_encode($data['FOTO']) : null;
			} catch (\Throwable $th) {
			}
		}

		// Se limpian varibles nulas o que no esten en el array definido
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
		$data['EDADTIEMPO'] = 'A';
		$data['userDB'] = $conexion->USER;
		$data['pwdDB'] = $conexion->PASSWORD;
		$data['instance'] = $conexion->IP . '/' . $conexion->INSTANCE;
		$data['schema'] = $conexion->SCHEMA;

		return $this->_curlPostDataEncrypt($endpoint, $data);
	}

	/**
	 * Función para crear domicilios de las personas fisicas en Justicia
	 *
	 * @param  mixed $expedienteId
	 * @param  mixed $personaFisicaId
	 * @param  mixed $domicilioPersonaFisica
	 * @param  mixed $municipio
	 */
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
			//Se crea la conexion de acuerdo al municipio y enviroment.

			$conexion = $this->_conexionesDBModelRead->asObject()->where('ESTADOID', 2)->where('MUNICIPIOID', (int) $municipio)->where('TYPE', ENVIRONMENT)->first();
			$data = $domicilioPersonaFisica;

			$data['EXPEDIENTEID'] = $expedienteId;
			$data['PERSONAFISICAID'] = $personaFisicaId;
			// if ($data['COLONIAID'] != 0) {
			// 	unset($data['COLONIADESCR']);
			// }

			// Se limpian varibles nulas o que no esten en el array definido
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

	/**
	 * Función para crear la media filiacion de las personas fisicas en Justicia.
	 *
	 * @param  mixed $expedienteId
	 * @param  mixed $personaFisicaId
	 * @param  mixed $personaFisicaMediaFiliacion
	 * @param  mixed $municipio
	 */
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
		//Se crea la conexion de acuerdo al municipio y enviroment.

		$conexion = $this->_conexionesDBModelRead->asObject()->where('ESTADOID', 2)->where('MUNICIPIOID', (int) $municipio)->where('TYPE', ENVIRONMENT)->first();
		$data = $personaFisicaMediaFiliacion;

		// Se limpian varibles nulas o que no esten en el array definido
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

	/**
	 * Se crea el expediente del imputado en Justicia
	 *
	 * @param  mixed $expedienteId
	 * @param  mixed $personaFisicaId
	 * @param  mixed $municipio
	 */
	private function _createExpImputado($expedienteId, $personaFisicaId, $municipio)
	{
		$function = '/imputado.php?process=crear';
		$endpoint = $this->endpoint . $function;
		//Se crea la conexion de acuerdo al municipio y enviroment.

		$conexion = $this->_conexionesDBModelRead->asObject()->where('ESTADOID', 2)->where('MUNICIPIOID', (int) $municipio)->where('TYPE', ENVIRONMENT)->first();
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
		// Se limpian varibles nulas o que no esten en el array definido

		foreach ($data as $clave => $valor) {
			if (empty($valor)) {
				unset($data[$clave]);
			}
		}

		return $this->_curlPostDataEncrypt($endpoint, $data);
	}

	/**
	 * Se crea la relacion parentesco en Justicia
	 *
	 * @param  mixed $expedienteId
	 * @param  mixed $relacionparentesco
	 * @param  mixed $personafisica1
	 * @param  mixed $personafisica2
	 * @param  mixed $municipio
	 */
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
		//Se crea la conexion de acuerdo al municipio y enviroment.

		$conexion = $this->_conexionesDBModelRead->asObject()->where('ESTADOID', 2)->where('MUNICIPIOID', (int) $municipio)->where('TYPE', ENVIRONMENT)->first();
		$data = $relacionparentesco;
		// Se limpian varibles nulas o que no esten en el array definido

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

	/**
	 * Se crea la relacion persona fisica a persona fisica en Justicia.
	 *
	 * @param  mixed $expedienteId
	 * @param  mixed $relacionff
	 * @param  mixed $victima
	 * @param  mixed $imputado
	 * @param  mixed $municipio
	 */
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
		//Se crea la conexion de acuerdo al municipio y enviroment.

		$conexion = $this->_conexionesDBModelRead->asObject()->where('ESTADOID', 2)->where('MUNICIPIOID', (int) $municipio)->where('TYPE', ENVIRONMENT)->first();
		$data = $relacionff;
		// Se limpian varibles nulas o que no esten en el array definido

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

	/**
	 * Se crean los archivos externos y documentos en Justicia
	 *
	 * @param  mixed $expedienteId
	 * @param  mixed $folioid
	 * @param  mixed $ano
	 * @param  mixed $municipioid
	 * @param  mixed $clasificaciondoctoid
	 * @param  mixed $tipodoc
	 * @param  mixed $archivo
	 * @param  mixed $extension
	 * @param  mixed $autor
	 * @param  mixed $oficina
	 */
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
			$folioRow = $this->_folioModelRead->where('ANO', $ano)->where('FOLIOID', $folioid)->first();
			//Se crea la conexion de acuerdo al municipio y enviroment.

			$conexion = $this->_conexionesDBModelRead->asObject()->where('ESTADOID', 2)->where('MUNICIPIOID', (int) $municipioid != '' ? $municipioid : $folioRow['MUNICIPIOID'])->where('TYPE', ENVIRONMENT)->first();

			// Se asignan las variables
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

	/**
	 * Función para crear los documentos periciales en Justicia.
	 *
	 * @param  mixed $expedienteId
	 * @param  mixed $documentos
	 * @param  mixed $municipio
	 */
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
		//Se crea la conexion de acuerdo al municipio y enviroment.

		$conexion = $this->_conexionesDBModelRead->asObject()->where('ESTADOID', 2)->where('MUNICIPIOID', (int) $municipio)->where('TYPE', ENVIRONMENT)->first();
		$data = $documentos;
		// Se limpian varibles nulas o que no esten en el array definido

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

	/**
	 * Función para crear las intervenciones periciales en Justicia.
	 *
	 * @param  mixed $solicitud
	 * @param  mixed $municipio
	 */
	private function _createIntervencionPericial($solicitud, $municipio)
	{

		$function = '/intervencionPericial.php?process=crear';
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
		//Se crea la conexion de acuerdo al municipio y enviroment.

		$conexion = $this->_conexionesDBModelRead->asObject()->where('ESTADOID', 2)->where('MUNICIPIOID', (int) $municipio)->where('TYPE', ENVIRONMENT)->first();
		$data = $solicitud;
		// Se limpian varibles nulas o que no esten en el array definido

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
	/**
	 * Función para crear solicitudes periciales en Justicia.
	 *
	 * @param  mixed $solicitud
	 */
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
		//Se crea la conexion de acuerdo al municipio y enviroment.

		$conexion = $this->_conexionesDBModelRead->asObject()->where('ESTADOID', 2)->where('MUNICIPIOID', (int) $solicitud['MUNICIPIOID'])->where('TYPE', ENVIRONMENT)->first();
		$data = $solicitud;
		// Se limpian varibles nulas o que no esten en el array definido

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

	/**
	 * Función para crear las solicitudes periciales en el expediente en Justicia
	 *
	 * @param  mixed $expedienteId
	 * @param  mixed $solicitudExp
	 * @param  mixed $municipio
	 */
	private function _createSolicitudExpediente($expedienteId, $solicitudExp, $municipio)
	{
		$function = '/solicitudPericial.php?process=solicitudExpediente';
		$array = [
			'SOLICITUDID',
			'EXPEDIENTEID',

		];
		$endpoint = $this->endpoint . $function;
		//Se crea la conexion de acuerdo al municipio y enviroment.

		$conexion = $this->_conexionesDBModelRead->asObject()->where('ESTADOID', 2)->where('MUNICIPIOID', (int) $municipio)->where('TYPE', ENVIRONMENT)->first();
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

	/**
	 * Funcion para crear la relacion de la solicitud, expediente y documento en Justicia
	 *
	 * @param  mixed $expedienteId
	 * @param  mixed $solicitudid
	 * @param  mixed $solicitudDocto
	 * @param  mixed $municipio
	 */
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
		//Se crea la conexion de acuerdo al municipio y enviroment.

		$conexion = $this->_conexionesDBModelRead->asObject()->where('ESTADOID', 2)->where('MUNICIPIOID', (int) $municipio)->where('TYPE', ENVIRONMENT)->first();
		$data = array();

		$data['EXPEDIENTEID'] = $expedienteId;
		$data['SOLICITUDID'] = $solicitudid;
		$data['DOCTOID'] = $solicitudDocto;
		$data['userDB'] = $conexion->USER;
		$data['pwdDB'] = $conexion->PASSWORD;
		$data['instance'] = $conexion->IP . '/' . $conexion->INSTANCE;
		$data['schema'] = $conexion->SCHEMA;

		return $this->_curlPostDataEncrypt($endpoint, $data);
	}

	/**
	 * Función para crear la bandeja RAC en Justicia
	 *
	 * @param  mixed $expedienteId
	 * @param  mixed $procedimientoid
	 * @param  mixed $municipio
	 */
	private function _createJusticiaAlterna($expedienteId, $procedimientoid, $municipio)
	{
		$function = '/justiciaAlterna.php?process=crear';

		$array = [
			'EXPEDIENTEID',
			'TIPOPROCEDIMIENTOID',
			'VALIDADO',
			'EMPLEADOIDVALIDO',
			'AREAIDVALIDO',
			'FECHAVALIDADO',
		];

		$endpoint = $this->endpoint . $function;
		//Se crea la conexion de acuerdo al municipio y enviroment.

		$conexion = $this->_conexionesDBModelRead->asObject()->where('ESTADOID', 2)->where('MUNICIPIOID', (int) $municipio)->where('TYPE', ENVIRONMENT)->first();

		$data['EXPEDIENTEID'] = $expedienteId;
		$data['TIPOPROCEDIMIENTOID'] = $procedimientoid;
		$data['userDB'] = $conexion->USER;
		$data['pwdDB'] = $conexion->PASSWORD;
		$data['instance'] = $conexion->IP . '/' . $conexion->INSTANCE;
		$data['schema'] = $conexion->SCHEMA;
		return $this->_curlPostDataEncrypt($endpoint, $data);
	}

	/**
	 * Función para obtener los modulos desde el WebServices
	 *
	 */
	public function getModulos()
	{
		$municipio = $this->request->getPost('municipio');
		$function = '/consumoVistas.php?process=mediacion';
		$endpoint = $this->endpoint . $function;
		//Se crea la conexion de acuerdo al municipio y enviroment.

		$conexion = $this->_conexionesDBModelRead->asObject()->where('ESTADOID', 2)->where('MUNICIPIOID', (int) $municipio)->where('TYPE', ENVIRONMENT)->first();
		$data['MUNICIPIOID'] = $municipio;
		$data['userDB'] = $conexion->USER;
		$data['pwdDB'] = $conexion->PASSWORD;
		$data['instance'] = $conexion->IP . '/' . $conexion->INSTANCE;
		$data['schema'] = $conexion->SCHEMA;
		return json_encode($this->_curlPostDataEncrypt($endpoint, $data)->data);
	}

	public function getCoordinacion()
	{

		$municipio = $this->request->getGet('municipioasignado');
		$function = '/unidades.php?process=coordinacion';
		$endpoint = $this->endpoint . $function;
		$conexion = $this->_conexionesDBModel->asObject()->where('ESTADOID', 2)->where('MUNICIPIOID', 2)->where('TYPE', ENVIRONMENT)->first();
		$data['MUNICIPIOID'] = $municipio;
		$data['userDB'] = $conexion->USER;
		$data['pwdDB'] = $conexion->PASSWORD;
		$data['instance'] = $conexion->IP . '/' . $conexion->INSTANCE;
		$data['schema'] = $conexion->SCHEMA;
		return $this->_curlPostDataEncrypt($endpoint, $data);
	}

	public function getUnidades()
	{
		$municipio = $this->request->getPost('municipio');
		$coordinacion = $this->request->getPost('coordinacion');
		$function = '/unidades.php?process=unidad';
		$endpoint = $this->endpoint . $function;
		$conexion = $this->_conexionesDBModel->asObject()->where('ESTADOID', 2)->where('MUNICIPIOID', (int) $municipio)->where('TYPE', ENVIRONMENT)->first();
		$data['COORD_ID'] = $coordinacion;
		$data['userDB'] = $conexion->USER;
		$data['pwdDB'] = $conexion->PASSWORD;
		$data['instance'] = $conexion->IP . '/' . $conexion->INSTANCE;
		$data['schema'] = $conexion->SCHEMA;
		return json_encode($this->_curlPostDataEncrypt($endpoint, $data));
	}

	public function getAgentByUnidad()
	{
		$municipio = $this->request->getPost('municipio');
		$unidad = $this->request->getPost('unidad');
		$function = '/unidades.php?process=nextUnidad';
		$endpoint = $this->endpoint . $function;
		$conexion = $this->_conexionesDBModel->asObject()->where('ESTADOID', 2)->where('MUNICIPIOID', (int) $municipio)->where('TYPE', ENVIRONMENT)->first();
		$data['OFICINAID_MP'] = $unidad;
		$data['userDB'] = $conexion->USER;
		$data['pwdDB'] = $conexion->PASSWORD;
		$data['instance'] = $conexion->IP . '/' . $conexion->INSTANCE;
		$data['schema'] = $conexion->SCHEMA;
		return json_encode($this->_curlPostDataEncrypt($endpoint, $data));
	}

	public function getEmpleadosByOficina()
	{
		$municipio = $this->request->getPost('municipio');
		$oficina = $this->request->getPost('oficina');
		$function = '/unidades.php?process=empleadoCdtec';
		$endpoint = $this->endpoint . $function;
		$conexion = $this->_conexionesDBModel->asObject()->where('ESTADOID', 2)->where('MUNICIPIOID', (int) $municipio)->where('TYPE', ENVIRONMENT)->first();
		$data['OFICINAID'] = $oficina;
		$data['userDB'] = $conexion->USER;
		$data['pwdDB'] = $conexion->PASSWORD;
		$data['instance'] = $conexion->IP . '/' . $conexion->INSTANCE;
		$data['schema'] = $conexion->SCHEMA;
		return json_encode($this->_curlPostDataEncrypt($endpoint, $data));
	}

	/**
	 * Funcion para actualizar cuando modifican remision en Justicia Net
	 */
	public function getOficinas()
	{
		$municipio = $this->request->getPost('municipio');
		$expediente = $this->request->getPost('expedienteid');
		$year = $this->request->getPost('year');
		$folio = $this->request->getPost('folio');

		$function = '/expediente.php?process=actualizarVD';
		$endpoint = $this->endpoint . $function;
		$conexion = $this->_conexionesDBModel->asObject()->where('ESTADOID', 2)->where('MUNICIPIOID', (int) $municipio)->where('TYPE', ENVIRONMENT)->first();
		$data['EXPEDIENTEID'] = $expediente;
		$data['userDB'] = $conexion->USER;
		$data['pwdDB'] = $conexion->PASSWORD;
		$data['instance'] = $conexion->IP . '/' . $conexion->INSTANCE;
		$data['schema'] = $conexion->SCHEMA;

		$response = $this->_curlPostDataEncrypt($endpoint, $data);
		if ($response->status == 201) {
			$datosUpdate = array(
				'OFICINAASIGNADOID' => $response->data[0]->OFICINAIDRESPONSABLE,
				'AREAASIGNADOID' => $response->data[0]->AREAIDRESPONSABLE,
				'AGENTEASIGNADOID' => $response->data[0]->EMPLEADOIDREGISTRO

			);
			$update = $this->_folioModel->set($datosUpdate)->where('ANO', $year)->where('FOLIOID', $folio)->where('EXPEDIENTEID', $expediente)->update();

			if ($update) {
				return json_encode(['status' => 1]);
			}
		} else {
			return json_encode(['status' => 0]);
		}
	}

	/**Funcion para actualizar las oficinas asignadas de justicia en videodenuncia */
	public function getOficinasByExpediente()
	{
		try {
			$municipios = [1, 2, 3, 4, 5, 6, 7];
			$conexiones = $this->_conexionesDBModel->asObject()->where('ESTADOID', 2)->whereIn('MUNICIPIOID', $municipios)->where('TYPE', ENVIRONMENT)->findAll();
			$function = '/expediente.php?process=getChangesVD';
			$endpoint = $this->endpoint . $function;
			$conexion = $this->_conexionesDBModel->asObject()->where('ESTADOID', 2)->where('MUNICIPIOID', 2)->where('TYPE', ENVIRONMENT)->first();
			$data['userDB'] = $conexion->USER;
			$data['pwdDB'] = $conexion->PASSWORD;
			$data['instance'] = $conexion->IP . '/' . $conexion->INSTANCE;
			$data['schema'] = $conexion->SCHEMA;
			$response = $this->_curlPostDataEncrypt($endpoint, $data);

			//Respuesta de todos los expedientes cambiados desde justicia
			if ($response->status == 201) {
				$expedentesEnJusticia = [];
				$oficinaAsignado = [];
				$municipioAsignado = [];
				if (count($response->data) <= 0) {
					return json_encode(['status' => 1, 'message' => 'No hay expedientes por actualizar']);
				}
				foreach ($response->data as $key => $expedientes) {

					//Se compara con los folios de Videodenuncia
					$foliosVD = $this->_folioModelRead->asObject()->select('EXPEDIENTEID,MUNICIPIOASIGNADOID')->where('EXPEDIENTEID', $expedientes->EXPEDIENTEID)->where('MUNICIPIOASIGNADOID', $expedientes->MUNICIPIOID)->first();
					if (isset($foliosVD)) {
						array_push($expedentesEnJusticia, $foliosVD->EXPEDIENTEID);
						array_push($oficinaAsignado, $expedientes->OFICINAIDCOORD);
						array_push($municipioAsignado,  $foliosVD->MUNICIPIOASIGNADOID);
					}
				}
				$municipio = array(
					'MUNICIPIOASIGNADOID' => $municipioAsignado,
				);
				$datosUpdate = array(
					'OFICINAASIGNADOID' => $oficinaAsignado,
				);
				$updateFoliosVD = false;
				foreach ($datosUpdate['OFICINAASIGNADOID'] as $index => $valor) {
					$updateFoliosVD = $this->_folioModel->set('OFICINAASIGNADOID', $valor)->asObject()->where('EXPEDIENTEID', $expedentesEnJusticia[$index])->update();
					return json_encode(['status' => 1, 'message' => $updateFoliosVD]);
				}
				if ($updateFoliosVD) {
					try {
						$functionUpdate =  '/expediente.php?process=actualizarVD';
						$endpointUpdate = $this->endpoint . $functionUpdate;
						$data['EXPEDIENTEID'] = $expedentesEnJusticia;
						foreach ($municipio['MUNICIPIOASIGNADOID'] as $index => $mun) {
							if ($mun == 1 || $mun == 6) {
								$data['userDB'] = $conexiones[0]->USER;
								$data['pwdDB'] = $conexiones[0]->PASSWORD;
								$data['instance'] = $conexiones[0]->IP . '/' . $conexiones[0]->INSTANCE;
								$data['schema'] = $conexiones[0]->SCHEMA;
							} else if ($mun == 2 || $mun == 3 || $mun == 7) {
								$data['userDB'] = $conexiones[1]->USER;
								$data['pwdDB'] = $conexiones[1]->PASSWORD;
								$data['instance'] = $conexiones[1]->IP . '/' . $conexiones[1]->INSTANCE;
								$data['schema'] = $conexiones[1]->SCHEMA;
							} else if ($mun == 4 || $mun == 5) {
								$data['userDB'] = $conexiones[3]->USER;
								$data['pwdDB'] = $conexiones[3]->PASSWORD;
								$data['instance'] = $conexiones[3]->IP . '/' . $conexiones[3]->INSTANCE;
								$data['schema'] = $conexiones[3]->SCHEMA;
							}
							$responseUpdate = $this->_curlPostDataEncrypt($endpointUpdate, $data);
						}
						if ($responseUpdate->status == 201) {
							return json_encode(['status' => 1, 'message' => 'Se han sincronizado las coordinaciones de los expedientes de CDTEC con Justicia Net correctamente.']);
						} else {
							return json_encode(['status' => 0, 'message' => 'No fue posible sincronizar los expedientes con Justicia Net.']);
						}
					} catch (\Error $e) {
						throw new \Exception('Error en actualizacion en Justicia: ' . $e->getMessage());
					}
				} else {
					return json_encode(['status' => 1, 'message' => 'No hay expedientes por actualizar']);
				}
			} else {
				return json_encode(['status' => 0, 'message' => 'El servicio respondío con error los folios desde Justicia Net.']);
			}
		} catch (\Exception $e) {
			return json_encode(['status' => 0, 'message' => 'Falló algo al intentar actualizar los folios', 'error' => $e->getMessage()]);
		}
	}

	/**
	 * Función para obtener los mediadores desde el WebServices
	 *
	 * @param  mixed $municipio
	 * @param  mixed $modulo
	 */
	private function getMediador($municipio, $modulo)
	{
		$function = '/consumoVistas.php?process=getMediador';
		$endpoint = $this->endpoint . $function;
		//Se crea la conexion de acuerdo al municipio y enviroment.

		$conexion = $this->_conexionesDBModelRead->asObject()->where('ESTADOID', 2)->where('MUNICIPIOID', (int) $municipio)->where('TYPE', ENVIRONMENT)->first();
		$data['MUNICIPIOID'] = $municipio;
		$data['AREA_MP_MEDIADOR'] = $modulo;
		$data['userDB'] = $conexion->USER;
		$data['pwdDB'] = $conexion->PASSWORD;
		$data['instance'] = $conexion->IP . '/' . $conexion->INSTANCE;
		$data['schema'] = $conexion->SCHEMA;
		return $this->_curlPostDataEncrypt($endpoint, $data);
	}
	/**
	 * Función para crear la relación del imputado y del delito en Justicia
	 *
	 * @param  mixed $expedienteId
	 * @param  mixed $fisimpdelito
	 * @param  mixed $imputado
	 * @param  mixed $municipio
	 */
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
		//Se crea la conexion de acuerdo al municipio y enviroment.

		$conexion = $this->_conexionesDBModelRead->asObject()->where('ESTADOID', 2)->where('MUNICIPIOID', (int) $municipio)->where('TYPE', ENVIRONMENT)->first();
		$data = $fisimpdelito;
		// Se limpian varibles nulas o que no esten en el array definido

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

	/**
	 * Función para crear los vehiculos en Justicia
	 *
	 * @param  mixed $expedienteId
	 * @param  mixed $vehiculos
	 * @param  mixed $municipio
	 */
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
		//Se crea la conexion de acuerdo al municipio y enviroment.

		$conexion = $this->_conexionesDBModelRead->asObject()->where('ESTADOID', 2)->where('MUNICIPIOID', (int) $municipio)->where('TYPE', ENVIRONMENT)->first();
		$data = $vehiculos;
		// Se limpian varibles nulas o que no esten en el array definido

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

		//Se suben las fotos y doucmentos de los vehiculos a archivos externos en Justicia

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

	/**
	 * Función CURL POST a Justicia sin encriptacion
	 *
	 * @param  mixed $endpoint
	 * @param  mixed $data
	 */
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

	/**
	 * Función CURL PATCH para actualizar usuarios en el serivicio de videollamada 
	 *
	 * @param  mixed $endpoint
	 * @param  mixed $data
	 */
	private function _curlPatch($endpoint, $data)
	{
		$ch = curl_init();

		curl_setopt($ch, CURLOPT_URL, $endpoint);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PATCH');
		curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
		$headers = array(
			'Content-Type: application/json',
			'Access-Control-Allow-Origin: *',
			'Access-Control-Allow-Credentials: true',
			'Access-Control-Allow-Headers: Content-Type',
			'X-API-KEY: ' . X_API_KEY
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

	/**
	 * Función CURL POST para agregar usuarios en el serivicio de videollamada 
	 *
	 * @param  mixed $endpoint
	 * @param  mixed $data
	 */
	private function _curlPostService($endpoint, $data)
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
			'X-API-KEY:' . X_API_KEY
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

	/**
	 * Función CURL GET para el serivicio de videollamada 
	 *
	 * @param  mixed $endpoint
	 */
	private function _curlGetService($endpoint)
	{
		$ch = curl_init();

		curl_setopt($ch, CURLOPT_URL, $endpoint);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

		$headers = array(
			'Content-Type: application/json',
			'Access-Control-Allow-Origin: *',
			'Access-Control-Allow-Credentials: true',
			'Access-Control-Allow-Headers: Content-Type',
			'X-API-KEY:' . X_API_KEY
		);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

		$result = curl_exec($ch);

		return json_decode(curl_exec($ch));
		if ($result === false) {
			$result = "{
                'status' => 401,
                'error' => 'Curl failed: '" . curl_error($ch) . "
            }";
		}
		curl_close($ch);

		return json_decode($result);
	}


	/**
	 * Función CURL POST a Justicia encriptados
	 *
	 * @param  mixed $endpoint
	 * @param  mixed $data
	 */
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

	public function getTimeVideo()
	{
		// $video = $this->request->getPost('name_video');

		$s3 = new S3Client([
			'version' => 'latest',
			'region'  => 'us-east-1',
			'credentials' => [
				'key'    => 'AKIA4VSIIBT2MZIW5HBN',
				'secret' => '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',
			],
		]);
		// $s3->listBuckets()

		$bucket = 'fgebc-records';
		$key = 'pnx_46_b607792e2c7f837ac04ee95cc607e528_2023-01-26-15-08-07.mp4';

		$result = $s3->getObject(array(
			'Bucket' => $bucket,
			'Key'    => $key,
			'SaveAs' => FCPATH . '/tmp/video.mp4',

		));


		$content = $result['Body'];


		$ffprobe = FFProbe::create([
			'ffmpeg.binaries'  => '/usr/local/bin/ffmpeg', //'C:/ffmpeg/bin/ffmpeg.exe', // the path to the FFMpeg binary
			'ffprobe.binaries' => '/usr/local/bin/ffprobe', //'C:/ffmpeg/bin/ffprobe.exe', // the path to the FFProbe binary
			'timeout'          => 3600, // the timeout for the underlying process
			'ffmpeg.threads'   => 12,   // the number of threads that FFMpeg should use
		]);
		// $client = new Client();

		// // Crea un stream con el contenido del video desde S3
		// $response = $client->request('GET', $s3->getObjectUrl($bucket, $key));
		// $stream = $response->getBody();


		// Obtiene la duración del video
		// $video = $ffprobe->streams($stream)->videos()->first()->get('codec_name');
		$duration = $ffprobe
			->streams('https://fgebc-records.s3.amazonaws.com/pnx_46_b607792e2c7f837ac04ee95cc607e528_2023-01-26-15-08-07.mp4')
			->videos()
			->first()
			->get('duration');
		var_dump($duration);
		exit;
		// $duration = $video->get('duration');

		// $ffmpeg = FFMpeg::create();

		// $video = $ffmpeg->open($content);
		// $duration = $video->get('duration');

		// return json_encode(['tiempo' => $duration]);

	}
	/**
	 * Función para obtener los videos del servicio de videollamada
	 *
	 */
	public function getVideoLink()
	{
		$data = array();
		$folio = $this->request->getPost('folio');
		$data['folio'] = $folio;
		$url = $this->urlApi;

		$endpointFolio = $url . 'recordings/folio?folio=' . $folio;
		$responseFolio = $this->_curlGetService($endpointFolio);
		// return json_encode($responseFolio);
		if ($responseFolio != null) {
			return json_encode(['status' => 1, 'responseVideos' => $responseFolio]);

			foreach ($responseFolio as $key => $conections) {

				if (isset($conections->url) && $conections->url != null) {
					$endpointId = $this->urlApi . 'recordings/' . $conections->id;
					$responseid = $this->_curlGetService($endpointId);
				}
			}
		}
		if (isset($responseid)) {
			return json_encode(['status' => 1, 'responseVideos' => $responseFolio, 'marcasVideo' => $responseid]);
		} else {
			return json_encode(['status' => 1, 'responseVideos' => $responseFolio]);
		}
	}

	/**
	 * Función para obtener el link de la llamada
	 * ! Deprecated method, do not use.
	 */
	public function getLinkFromCall()
	{
		$folio = $this->request->getPost('folio');
		$year = $this->request->getPost('year');

		if ($folio) {
			$endpoint = 'https://videodenunciaserver1.fgebc.gob.mx/api/vc';
			$data = array();
			$data['u'] = '24';
			$data['token'] = '198429b7cc8a2a5733d97bc13153227dd5017555';
			$data['a'] = 'getRepo';
			$data['folio'] = $year . '-' . $folio;
			$data['min'] = !empty($this->request->getPost('min')) ? $this->request->getPost('min') : '2000-01-01';
			$data['max'] = !empty($this->request->getPost('max')) ? $this->request->getPost('max') : date("Y-m-d");

			$response = $this->_curlPost($endpoint, $data);
			$calls = [];

			foreach ($response->data as $call) {
				if ($call->Grabación != '') {
					array_push($calls, $call);
				}
			}

			if (count($calls) == 0) {
				return json_encode(['status' => 1, 'data' => $calls]);
			}
			return json_encode(['status' => 1, 'data' => $calls]);
		} else {
			return json_encode(['status' => 0]);
		}
	}
	/**
	 * Función para los usuarios activos de Jitsi
	 * ! Deprecated method, do not use.
	 */
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
	/**
	 * Función para obtener los usuarios no activos en Jitsi
	 * ! Deprecated method, do not use.
	 */
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
	/**
	 * Función para limpiar los videos en Jitsi
	 * ! Deprecated method, do not use.
	 */
	function clearUsersVideo()
	{
		// $endpoint = 'https://videodenunciaserver1.fgebc.gob.mx/api/user';
		// $data = array();
		// $data['u'] = '24';
		// $data['token'] = '198429b7cc8a2a5733d97bc13153227dd5017555';
		// $data['a'] = 'list';
		// $response = $this->_curlPost($endpoint, $data);
		// $response = $response->data;
		// sort($response);

		// var_dump($response);
		// exit;

		// for ($i = 1; $i <= 175; $i++) {
		// 	try {
		// 		$update = $this->_updateUserVideo($i, 'USUARIO', '-', 'agente_' . $i . '@usuario.com', 'M', 'agente');
		// 		var_dump($update);
		// 	} catch (\Exception $e) {
		// 	}
		// }
	}

	/**
	 * Función para actualizar los usuarios en el servicio de videollamada
	 *
	 * @param  mixed $uuid
	 * @param  mixed $names
	 * @param  mixed $lastnames
	 * @param  mixed $email
	 * @param  mixed $sex
	 * @param  mixed $rolId
	 */
	private function _updateUserVideo($uuid, $names, $lastnames, $email, $sex, $rolId)
	{
		if ($uuid && $names && $lastnames && $email && $sex && $rolId) {
			$data = array();
			$data['names'] = $names;
			$data['lastnames'] = $lastnames;
			$data['email'] = $email;
			$data['sex'] = $sex == 'M' ? 'MALE' : 'FEMALE';
			$data['role'] = $rolId;
			$response = $this->_curlPatch($this->urlApi . 'agent/' . $uuid, $data);
			return $response;
		}
	}

	/**
	 * Función para restaurar folios a abiertos cuando buscan uno nuevo
	 *
	 */
	public function restoreFolio()
	{
		$folio = $this->request->getPost('folio');
		$year = $this->request->getPost('year');

		if (!empty($folio)) {
			$folioRow = $this->_folioModelRead->where('ANO', $year)->where('FOLIOID', $folio)->first();
			$folioRow['HECHOMEDIOCONOCIMIENTOID'] = null;
			$folioRow['NOTASAGENTE'] = null;
			$folioRow['STATUS'] = 'ABIERTO';
			$folioRow['EXPEDIENTEID'] = null;
			$folioRow['AGENTEATENCIONID'] = null;
			$folioRow['AGENTEFIRMAID'] = null;

			$update = $this->_folioModel->set($folioRow)->where('ANO', $year)->where('FOLIOID', $folio)->where('AGENTEATENCIONID', session('ID'))->where('EXPEDIENTEID IS NULL')->update();

			$datosBitacora = [
				'ACCION' => 'Ha restaurado un folio a abierto',
				'NOTAS' => 'FOLIO: ' . $folio . ' AÑO: ' . $year . ' STATUS: ABIERTO',
			];

			$this->_bitacoraActividad($datosBitacora);


			return json_encode(['status' => 1, 'message' => $update]);
		}
	}
	/**
	 * Función para cambiar el status del folio a en proceso cuando lo buscan
	 *
	 */
	public function restoreFolioProcess()
	{
		$folio = $this->request->getPost('folio');
		$year = $this->request->getPost('year');

		if (!empty($folio)) {
			$folioRow = $this->_folioModelRead->where('ANO', $year)->where('FOLIOID', $folio)->first();
			$folioRow['HECHOMEDIOCONOCIMIENTOID'] = null;
			$folioRow['NOTASAGENTE'] = null;
			$folioRow['STATUS'] = 'EN PROCESO';
			$folioRow['EXPEDIENTEID'] = null;
			// $folioRow['AGENTEATENCIONID'] = NULL;
			$folioRow['AGENTEFIRMAID'] = null;

			$update = $this->_folioModel->set($folioRow)->where('ANO', $year)->where('FOLIOID', $folio)->where('EXPEDEINTEID IS NULL')->update();
			$datosBitacora = [
				'ACCION' => 'Ha restaurado un folio a en proceso.',
				'NOTAS' => 'FOLIO: ' . $folio . ' AÑO:' . $year . ' STATUS: EN PROCESO',
			];

			$this->_bitacoraActividad($datosBitacora);


			return json_encode(['status' => 1, 'message' => $update]);
		}
	}

	/**
	 * Función para actualizar la tabla de folio en VIDEODENUNCIA a través del metodo POST
	 *
	 */
	public function updateFolio()
	{
		$colonia = $this->_coloniasModelRead->asObject()->where('ESTADOID', 2)->where('MUNICIPIOID', $this->request->getPost('municipio_delito'))->where('LOCALIDADID', $this->request->getPost('localidad_delito'))->where('COLONIAID', $this->request->getPost('colonia_delito_select'))->first();
		try {


			$folio = trim($this->request->getPost('folio'));
			$year = trim($this->request->getPost('year'));
			if ($this->permisosAgenteAtencion($folio, $year) == null) {
				return json_encode(['status' => 0, 'message' => "El agente no coincide con el agente de atención"]);
			}
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
				'LOCALIZACIONPERSONAMEDIOS' => $this->request->getPost('autoriza_foto'),
				'HECHOCOORDENADAX' => $this->request->getPost('longitud') != '-117.015543' ? $this->request->getPost('longitud') : NULL,
				'HECHOCOORDENADAY' => $this->request->getPost('latitud') != '32.521036' ? $this->request->getPost('latitud') : NULL,
			);

			if ($dataFolio['HECHOCOLONIAID'] == '0') {
				$dataFolio['HECHOCOLONIAID'] = null;
				$dataFolio['HECHOCOLONIADESCR'] = $this->request->getPost('colonia_delito');
				$localidad = $this->_localidadesModelRead->asObject()->where('ESTADOID', 2)->where('MUNICIPIOID', $this->request->getPost('municipio_delito'))->where('LOCALIDADID', $this->request->getPost('localidad_delito'))->first();
				$dataFolio['HECHOZONA'] = $localidad->ZONA;
			} else {
				$dataFolio['HECHOCOLONIAID'] = (int) $this->request->getPost('colonia_delito_select');
				$dataFolio['HECHOCOLONIADESCR'] = $colonia->COLONIADESCR;
				$dataFolio['HECHOZONA'] = $colonia->ZONA;
			}
			$update = $this->_folioModel->set($dataFolio)->where('FOLIOID', $folio)->where('ANO', $year)->update();
			if ($update) {

				$datosBitacora = [
					'ACCION' => 'Ha actualizado la información del hecho.',
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
	/**
	 * Función para actualizar la tabla de folio en DENUNCIA ANONIMA a través del metodo POST
	 *
	 */
	public function updateFolioDenuncia()
	{
		$colonia = $this->_coloniasModelRead->asObject()->where('ESTADOID', 2)->where('MUNICIPIOID', $this->request->getPost('municipio_delito'))->where('LOCALIDADID', $this->request->getPost('localidad_delito'))->where('COLONIAID', $this->request->getPost('colonia_delito_select'))->first();
		try {


			$folio = trim($this->request->getPost('folio'));
			$year = trim($this->request->getPost('year'));
			if ($this->permisosAgenteAtencion($folio, $year) == null) {
				return json_encode(['status' => 0, 'message' => "El agente no coincide con el agente de atención"]);
			}
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
				'HECHONARRACION' => $this->request->getPost('notas'),
				'NOTASAGENTE' => $this->request->getPost('notas'),
				'LOCALIZACIONPERSONAMEDIOS' => $this->request->getPost('autoriza_foto'),

			);

			if ($dataFolio['HECHOCOLONIAID'] == '0') {
				$dataFolio['HECHOCOLONIAID'] = null;
				$dataFolio['HECHOCOLONIADESCR'] = $this->request->getPost('colonia_delito');
				$localidad = $this->_localidadesModelRead->asObject()->where('ESTADOID', 2)->where('MUNICIPIOID', $this->request->getPost('municipio_delito'))->where('LOCALIDADID', $this->request->getPost('localidad_delito'))->first();
				$dataFolio['HECHOZONA'] = $localidad->ZONA;
			} else {
				$dataFolio['HECHOCOLONIAID'] = (int) $this->request->getPost('colonia_delito_select');
				$dataFolio['HECHOCOLONIADESCR'] = $colonia->COLONIADESCR;
				$dataFolio['HECHOZONA'] = $colonia->ZONA;
			}
			$update = $this->_folioModel->set($dataFolio)->where('FOLIOID', $folio)->where('ANO', $year)->update();
			if ($update) {
				$datosBitacora = [
					'ACCION' => 'Ha actualizado la información del hecho.',
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

	/**
	 * Función para actualizar la tabla de folio al asignar una oficina y un empleado por metodo POST
	 *
	 */
	public function updateFolioAsignacion()
	{
		try {
			$expediente = trim($this->request->getPost('expediente'));
			$oficina = trim($this->request->getPost('oficina'));
			$empleado = trim($this->request->getPost('empleado'));

			$area = $this->_empleadosModelRead->asObject()->where('EMPLEADOID', $empleado)->first();
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
				$bandeja = $this->_folioModelRead->where('EXPEDIENTEID', $expediente)->first();
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
	/**
	 * Función para actualizar el area de registro y responsable en Justicia
	 *
	 * @param  mixed $expediente
	 * @param  mixed $municipio
	 * @param  mixed $oficina
	 * @param  mixed $empleado
	 * @param  mixed $area
	 * @param  mixed $tipo
	 * @param  mixed $estadojuridicoid
	 */

	private function _updateExpedienteByBandeja($expediente, $municipio, $oficina, $empleado, $area, $tipo,  $tipoEnvio = null, $estadojuridicoid = null)
	{
		$function = '/expediente.php?process=updateArea';
		$endpoint = $this->endpoint . $function;

		//Se crea la conexion de acrdo al municipio y enviroment.
		$conexion = $this->_conexionesDBModelRead->asObject()->where('ESTADOID', 2)->where('MUNICIPIOID', (int) $municipio)->where('TYPE', ENVIRONMENT)->first();
		// $empleado_select = $this->_empleadosModelRead->asObject()->where('EMPLEADOID', (int) $empleado)->first();

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
		if ($tipo == 'REMISION') {
			$data['AREAIDREGISTRO'] = $area;

			if ($tipoEnvio == 'COORDINACION') {
				$data['AREAIDRESPONSABLE'] = null;
			} else if ($tipoEnvio == 'UNIDAD') {
				$data['AREAIDRESPONSABLE'] = $area;
			} else {
				if (ENVIRONMENT == 'production') {
					if ($oficina == 409 || $oficina == 793 || $oficina == 924) {
						$data['AREAIDRESPONSABLE'] = $area;
					}
				} else {
					if ($oficina == 394 || $oficina == 793 || $oficina == 924) {
						$data['AREAIDRESPONSABLE'] = $area;
					}
				}
			}
		} else {
			$data['AREAIDREGISTRO'] = $area;
			$data['AREAIDRESPONSABLE'] = $area;
		}

		$data['EXPEDIENTEID'] = $expediente;
		$data['ESTADOJURIDICOEXPEDIENTEID'] = (string) $estadojuridicoid;
		// Se limpian varibles nulas o que no esten en el array definido

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

	/**
	 * Se crea la bandeja en Justicia
	 *
	 * @param  mixed $bandeja
	 */
	private function _createBandeja($bandeja)
	{
		$function = '/expediente.php?process=bandeja';
		$endpoint = $this->endpoint . $function;
		//Se crea la conexion de acrdo al municipio y enviroment.

		$conexion = $this->_conexionesDBModelRead->asObject()->where('ESTADOID', 2)->where('MUNICIPIOID', (int) $bandeja['MUNICIPIOASIGNADOID'])->where('TYPE', ENVIRONMENT)->first();
		$array = [
			"AREAIDREGISTRO",
			"EXPEDIENTEID"
		];

		$data = $bandeja;
		// Se limpian varibles nulas o que no esten en el array definido

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

	/**
	 * Función para actualizar las preguntas iniciales en VIDEODENUNCIA a través del metodo PSOT.
	 *
	 */
	public function updatePreguntasIniciales()
	{
		try {
			$folio = trim($this->request->getPost('folio'));
			$year = trim($this->request->getPost('year'));
			if ($this->permisosAgenteAtencion($folio, $year) == null) {
				return json_encode(['status' => 0, 'message' => "El agente no coincide con el agente de atención"]);
			}
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

	/**
	 * Función para actualizar las personas fisicas de acuerdo a su ID a través del metodo POST.
	 * Devuelve todos los datos necesarios para la actualizacion de las tablas visuales.
	 *
	 */
	public function updatePersonaFisicaById()
	{
		try {
			$id = $this->request->getPost('pf_id');
			$folio = $this->request->getPost('folio');
			$year = $this->request->getPost('year');
			$fotoPersona = $this->request->getFile('subirFotoPersona');
			$fotoP = null;
			if ($this->permisosAgenteAtencion($folio, $year) == null) {
				return json_encode(['status' => 0, 'message' => "El agente no coincide con el agente de atención"]);
			}
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
					'DESCRIPCION_FISICA' => $this->request->getPost('descripcionFisica_pf') != '' ? $this->request->getPost('descripcionFisica_pf') : NULL,
					'APODO' => $this->request->getPost('apodo_pf'),
					'DENUNCIANTE' => $this->request->getPost('denunciante_pf'),
					'FACEBOOK' => $this->request->getPost('facebook_pf'),
					'INSTAGRAM' => $this->request->getPost('instagram_pf'),
					'TWITTER' => $this->request->getPost('twitter_pf'),
					'FOTO' =>  $fotoP,
					'FOTOGRAFIA_ACTUAL' => $this->request->getPost('fotografia_actual_pf') != '' ? $this->request->getPost('fotografia_actual_pf') : NULL,
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
					'DESCRIPCION_FISICA' => $this->request->getPost('descripcionFisica_pf') != '' ? $this->request->getPost('descripcionFisica_pf') : NULL,
					'APODO' => $this->request->getPost('apodo_pf'),
					'DENUNCIANTE' => $this->request->getPost('denunciante_pf'),
					'FACEBOOK' => $this->request->getPost('facebook_pf'),
					'INSTAGRAM' => $this->request->getPost('instagram_pf'),
					'TWITTER' => $this->request->getPost('twitter_pf'),
					'FOTOGRAFIA_ACTUAL' => $this->request->getPost('fotografia_actual_pf') != '' ? $this->request->getPost('fotografia_actual_pf') : NULL,
				);
			}

			$update = $this->_folioPersonaFisicaModel->set($data)->where('FOLIOID', $folio)->where('ANO', $year)->where('PERSONAFISICAID', $id)->update();

			if ($update) {

				$personas = $this->_folioPersonaFisicaModel->get_by_folio($folio, $year);
				$imputados = $this->_folioPersonaFisicaModel->get_imputados($folio, $year);
				$victimas = $this->_folioPersonaFisicaModel->get_victimas($folio, $year);

				$parentescoRelacion = $this->_parentescoPersonaFisicaModel->getRelacion($folio, $year);
				// $personaiduno = $this->_parentescoPersonaFisicaModel->get_personaFisicaUno($folio, $year);
				// $personaidDos = $this->_parentescoPersonaFisicaModel->get_personaFisicaDos($folio, $year);
				// $parentesco = $this->_parentescoPersonaFisicaModel->get_Parentesco($folio, $year);
				$fisicaImpDelito = $this->_imputadoDelitoModel->get_by_folio($folio, $year);
				$relacionFisFis = $this->_relacionIDOModel->get_by_folio($folio, $year);


				$datosBitacora = [
					'ACCION' => 'Ha actualizado a una persona fisica',
					'NOTAS' => 'FOLIO: ' . $folio . ' AÑO: ' . $year . ' PERSONAFISICAID: ' . $id,
				];

				$this->_bitacoraActividad($datosBitacora);

				return json_encode(['status' => 1, 'personas' => $personas, 'imputados' => $imputados, 'victimas' => $victimas, 'parentescoRelacion' => $parentescoRelacion,  'fisicaImpDelito' => $fisicaImpDelito, 'relacionFisFis' => $relacionFisFis]);
			} else {
				return json_encode(['status' => 0]);
			}
		} catch (\Exception $e) {
			return json_encode(['status' => 0]);
		}
	}
	/**
	 * Función para actualizar el domicilio de las personas fisicas de acuerdo a su ID a través del metodo POST.
	 * Devuelve todos los datos necesarios para la actualizacion de las tablas visuales.
	 *
	 */
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
			if ($this->permisosAgenteAtencion($folio, $year) == null) {
				return json_encode(['status' => 0, 'message' => "El agente no coincide con el agente de atención"]);
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
				$colonia = $this->_coloniasModelRead->asObject()->where('ESTADOID', 2)->where('MUNICIPIOID', $this->request->getPost('municipio_pfd'))->where('LOCALIDADID', $this->request->getPost('localidad_pfd'))->where('COLONIAID', $this->request->getPost('colonia_pfd_select'))->first();
				$localidad = $this->_localidadesModelRead->asObject()->where('ESTADOID', 2)->where('MUNICIPIOID', $this->request->getPost('municipio_pfd'))->where('LOCALIDADID', $this->request->getPost('localidad_pfd'))->first();
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
	/**
	 * Función para actualizar la media filiacion de las personas fisicas de acuerdo a su ID a través del metodo POST.
	 * Devuelve todos los datos necesarios para la actualizacion de las tablas visuales.
	 *
	 */
	public function updateMediaFiliacionById()
	{
		try {
			$id = trim($this->request->getPost('pf_id'));

			$folio = trim($this->request->getPost('folio'));
			$year = trim($this->request->getPost('year'));
			if ($this->permisosAgenteAtencion($folio, $year) == null) {
				return json_encode(['status' => 0, 'message' => "El agente no coincide con el agente de atención"]);
			}
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


			$denunciante = $this->_folioPersonaFisicaModelRead->asObject()->where('FOLIOID', $folio)->where('ANO', $year)->where('PERSONAFISICAID', $id)->first();

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
	/**
	 * Función para actualizar los vehículos de acuerdo a su ID a través del metodo POST.
	 * Devuelve todos los datos necesarios para la actualizacion de las tablas visuales.
	 *
	 */
	public function updateVehiculoByFolio()
	{

		$folio = $this->request->getPost('folio');
		$year = $this->request->getPost('year');
		$vehiculoid = $this->request->getPost('vehiculoid');

		$document_file = $this->request->getFile('subirDoc');
		$docV = null;

		$foto_file = $this->request->getFile('subirFotoV');
		$fotoV = null;



		$distribuidorpost = trim($this->request->getPost('distribuidor_vehiculo_ad'));
		$marcapost = trim($this->request->getPost('marca_ad'));
		$modelopost = trim($this->request->getPost('linea_vehiculo_ad'));

		$modelodescr = $this->_vehiculoModeloModelRead->asObject()->where('VEHICULODISTRIBUIDORID', $distribuidorpost)->where('VEHICULOMARCAID', $marcapost)->where('VEHICULOMODELOID', $modelopost)->first();
		$marcadescr = $this->_vehiculoMarcaModelRead->asObject()->where('VEHICULODISTRIBUIDORID', $distribuidorpost)->where('VEHICULOMARCAID', $marcapost)->first();
		if ($this->permisosAgenteAtencion($folio, $year) == null) {
			return json_encode(['status' => 0, 'message' => "El agente no coincide con el agente de atención"]);
		}
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
					'SITUACION' => $this->request->getPost('situacion'),
					'PERSONAFISICAIDPROPIETARIO' => $this->request->getPost('propietario_vehiculo'),

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
					'SITUACION' => $this->request->getPost('situacion'),
					'PERSONAFISICAIDPROPIETARIO' => $this->request->getPost('propietario_vehiculo'),


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
					'SITUACION' => $this->request->getPost('situacion'),
					'PERSONAFISICAIDPROPIETARIO' => $this->request->getPost('propietario_vehiculo'),


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
				'SITUACION' => $this->request->getPost('situacion'),
				'PERSONAFISICAIDPROPIETARIO' => $this->request->getPost('propietario_vehiculo'),

			);
		}


		$update = $this->_folioVehiculoModel->set($data)->where('FOLIOID', $folio)->where('ANO', $year)->where('VEHICULOID', $vehiculoid)->update();

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
	/**
	 * Función para agregar vehículos de acuerdo a su folio y año a través del metodo POST.
	 * Devuelve todos los datos necesarios para la actualizacion de las tablas visuales.
	 *
	 */
	public function createVehiculoByFolio()
	{

		// var_dump($_POST);exit;
		$folio = trim($this->request->getPost('folio'));
		$year = trim($this->request->getPost('year'));
		if ($this->permisosAgenteAtencion($folio, $year) == null) {
			return json_encode(['status' => 0, 'message' => "El agente no coincide con el agente de atención"]);
		}
		$distribuidorpost = trim($this->request->getPost('distribuidor_vehiculo_ad'));
		$marcapost = trim($this->request->getPost('marca_ad'));
		$modelopost = trim($this->request->getPost('linea_vehiculo_ad'));

		$modelodescr = $this->_vehiculoModeloModelRead->asObject()->where('VEHICULODISTRIBUIDORID', $distribuidorpost)->where('VEHICULOMARCAID', $marcapost)->where('VEHICULOMODELOID', $modelopost)->first();
		$marcadescr = $this->_vehiculoMarcaModelRead->asObject()->where('VEHICULODISTRIBUIDORID', $distribuidorpost)->where('VEHICULOMARCAID', $marcapost)->first();
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
					'SITUACION' => $this->request->getPost('situacion') ? $this->request->getPost('situacion') : 2,
					'PERSONAFISICAIDPROPIETARIO' => $this->request->getPost('propietario_vehiculo'),

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
					'SITUACION' => $this->request->getPost('situacion') ? $this->request->getPost('situacion') : 2,
					'PERSONAFISICAIDPROPIETARIO' => $this->request->getPost('propietario_vehiculo'),


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
					'SITUACION' => $this->request->getPost('situacion') ? $this->request->getPost('situacion') : 2,
					'PERSONAFISICAIDPROPIETARIO' => $this->request->getPost('propietario_vehiculo'),


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
				'SITUACION' => $this->request->getPost('situacion') ? $this->request->getPost('situacion') : 2,
				'PERSONAFISICAIDPROPIETARIO' => $this->request->getPost('propietario_vehiculo'),

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
	/**
	 * Función para actualizar el parentesco de acuerdo al id de las personas involucradas a través del metodo POST.
	 * Devuelve todos los datos necesarios para la actualizacion de las tablas visuales.
	 *
	 */
	public function updateParentescoByFolio()
	{
		try {
			$idp1 = trim($this->request->getPost('personaFisica1'));
			$idp2 = trim($this->request->getPost('personaFisica2'));

			$folio = trim($this->request->getPost('folio'));
			$year = trim($this->request->getPost('year'));
			if ($this->permisosAgenteAtencion($folio, $year) == null) {
				return json_encode(['status' => 0, 'message' => "El agente no coincide con el agente de atención"]);
			}
			$dataRelacionParentesco = array(
				'FOLIO' => trim($this->request->getPost('folio')),
				'ANO' => trim($this->request->getPost('year')),
				'PERSONAFISICAID1' => $this->request->getPost('personaFisica1'),
				'PERSONAFISICAID2' => $this->request->getPost('personaFisica2'),
				'PARENTESCOID' => $this->request->getPost('parentesco_mf'),
			);

			$updateRelacionParentesco = $this->_parentescoPersonaFisicaModel->set($dataRelacionParentesco)->where('FOLIOID', $folio)->where('ANO', $year)->where('PERSONAFISICAID1', $idp1)->where('PERSONAFISICAID2', $idp2)->update();

			if ($updateRelacionParentesco) {
				$parentescoRelacion = $this->_parentescoPersonaFisicaModel->getRelacion($folio, $year);
				// $personaiduno = $this->_parentescoPersonaFisicaModel->get_personaFisicaUno($folio, $year);
				// $personaidDos = $this->_parentescoPersonaFisicaModel->get_personaFisicaDos($folio, $year);
				// $parentesco = $this->_parentescoPersonaFisicaModel->get_Parentesco($folio, $year);
				$datosBitacora = [
					'ACCION' => 'Ha actualizado el parentesco de una persona fisica',
					'NOTAS' => 'FOLIO: ' . $folio . ' AÑO: ' . $year,
				];

				$this->_bitacoraActividad($datosBitacora);

				return json_encode(['status' => 1, 'parentescoRelacion' => $parentescoRelacion]);
			} else {
				return json_encode(['status' => 0, 'message' => $updateRelacionParentesco]);
			}
		} catch (\Exception $e) {
			return json_encode(['status' => 0]);
		}
	}
	/**
	 * Función para eliminar los parentesco de acuerdo los ID's de las personas involucradas a través del metodo POST.
	 * Devuelve todos los datos necesarios para la actualizacion de las tablas visuales.
	 *
	 */
	public function deleteParentescoById()
	{

		try {
			$idp1 = $this->request->getPost('personafisica1');
			$idp2 = $this->request->getPost('personafisica2');

			$folio = $this->request->getPost('folio');
			$year = $this->request->getPost('year');
			$parentescoid = $this->request->getPost('parentesco_mf');
			if ($this->permisosAgenteAtencion($folio, $year) == null) {
				return json_encode(['status' => 0, 'message' => "El agente no coincide con el agente de atención"]);
			}
			$deleteRelacionParentesco = $this->_parentescoPersonaFisicaModel->where('FOLIOID', $folio)->where('ANO', $year)->where('PERSONAFISICAID1', $idp1)->where('PERSONAFISICAID2', $idp2)->where('PARENTESCOID', $parentescoid)->delete();
			if ($deleteRelacionParentesco) {
				$parentescoRelacion = $this->_parentescoPersonaFisicaModel->getRelacion($folio, $year);
				// $personaiduno = $this->_parentescoPersonaFisicaModel->get_personaFisicaUno($folio, $year);
				// $personaidDos = $this->_parentescoPersonaFisicaModel->get_personaFisicaDos($folio, $year);
				// $parentesco = $this->_parentescoPersonaFisicaModel->get_Parentesco($folio, $year);

				$datosBitacora = [
					'ACCION' => 'Ha eliminado una relación de parenteso',
					'NOTAS' => 'FOLIO: ' . $folio . ' AÑO: ' . $year,
				];

				$this->_bitacoraActividad($datosBitacora);

				return json_encode(['status' => 1, 'parentescoRelacion' => $parentescoRelacion, 'post' => $_POST]);
			} else {
				return json_encode(['status' => 0]);
			}
		} catch (\Exception $e) {
			return json_encode(['status' => 0]);
		}
	}

	/**
	 * Función para eliminar a las personas fisicas de acuerdo a su ID a través del metodo POST.
	 * Devuelve todos los datos necesarios para la actualizacion de las tablas visuales.
	 *
	 */

	public function deletePersonaFisicaById()
	{

		try {
			$personaf_id = $this->request->getPost('personafisica');

			$folio = $this->request->getPost('folio');
			$year = $this->request->getPost('year');
			if ($this->permisosAgenteAtencion($folio, $year) == null) {
				return json_encode(['status' => 0, 'message' => "El agente no coincide con el agente de atención"]);
			}
			$deletePersonaFisica = $this->_folioPersonaFisicaModel->where('FOLIOID', $folio)->where('ANO', $year)->where('PERSONAFISICAID', $personaf_id)->delete();
			$deletePersonaFisicaDom = $this->_folioPersonaFisicaDomicilioModel->where('FOLIOID', $folio)->where('ANO', $year)->where('PERSONAFISICAID', $personaf_id)->delete();
			$deletePersonaFisicaMediaF = $this->_folioMediaFiliacion->where('FOLIOID', $folio)->where('ANO', $year)->where('PERSONAFISICAID', $personaf_id)->delete();

			if ($deletePersonaFisica && $deletePersonaFisicaDom && $deletePersonaFisicaMediaF) {
				$personas = $this->_folioPersonaFisicaModel->get_by_folio($folio, $year);
				$imputados = $this->_folioPersonaFisicaModel->get_imputados($folio, $year);
				$victimas = $this->_folioPersonaFisicaModel->get_victimas($folio, $year);
				$delitosModalidadFiltro = $this->_delitoModalidadModelRead->get_delitodescr($folio, $year);

				$datosBitacora = [
					'ACCION' => 'Ha eliminado una persona fisica',
					'NOTAS' => 'FOLIO: ' . $folio . ' AÑO: ' . $year,
				];

				$this->_bitacoraActividad($datosBitacora);

				return json_encode(['status' => 1, 'personas' => $personas, 'imputados' => $imputados, 'victimas' => $victimas]);
			} else {
				return json_encode(['status' => 0]);
			}
		} catch (\Exception $e) {
			return json_encode(['status' => 0]);
		}
	}
	/**
	 * Función para actualizar los vehículos de acuerdo a su ID a través del metodo POST.
	 * Devuelve todos los datos necesarios para la actualizacion de las tablas visuales.
	 *
	 */
	public function createParentescoByFolio()
	{
		$folio = trim($this->request->getPost('folio'));
		$year = trim($this->request->getPost('year'));
		if ($this->permisosAgenteAtencion($folio, $year) == null) {
			return json_encode(['status' => 0, 'message' => "El agente no coincide con el agente de atención"]);
		}
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
		$checarParentesco = $this->_parentescoPersonaFisicaModelRead->where('FOLIOID', $folio)->where('ANO', $year)->where('PERSONAFISICAID1', $persona1)->where('PERSONAFISICAID2', $persona2)->first();
		if (isset($checarParentesco)) {
			return json_encode(['status' => 3]);
		}
		$insertRelacionParentesco = $this->_parentescoPersonaFisicaModel->insert($dataRelacionParentesco);

		if (!$insertRelacionParentesco) {
			$personas = $this->_folioPersonaFisicaModel->get_by_folio($folio, $year);

			$parentescoRelacion = $this->_parentescoPersonaFisicaModel->getRelacion($folio, $year);
			// $personaiduno = $this->_parentescoPersonaFisicaModel->get_personaFisicaUno($folio, $year);
			// $personaidDos = $this->_parentescoPersonaFisicaModel->get_personaFisicaDos($folio, $year);
			// $parentesco = $this->_parentescoPersonaFisicaModel->get_Parentesco($folio, $year);
			$datosBitacora = [
				'ACCION' => 'Ha ingresado un nuevo parentesco a una persona fisica',
				'NOTAS' => 'FOLIO: ' . $folio . ' AÑO: ' . $year,
			];

			$this->_bitacoraActividad($datosBitacora);

			return json_encode(['status' => 1, 'personas' => $personas, 'parentescoRelacion' => $parentescoRelacion]);
		} else {
			return json_encode(['status' => 0]);
		}
	}

	/**
	 * Función para obtener un filtro de personas fisicas para la selección de relacion fis-fis
	 *
	 */
	public function getPersonaFisicaFiltro()
	{

		$data = (object) array();

		$folio = $this->request->getPost('folio');
		$year = $this->request->getPost('year');
		$idPersonaFisica = $this->request->getPost('id');

		$data->personaFisicaFiltro = $this->_folioPersonaFisicaModelRead->get_by_persona_fisica_filtro($folio, $year, $idPersonaFisica);

		if ($data->personaFisicaFiltro) {
			return json_encode(['status' => 1, 'personaFiltro' => $data->personaFisicaFiltro]);
		} else {
			return json_encode(['status' => 0]);
		}
	}

	/**
	 * Función para crear personas fisicas.
	 * Recibe por metodo POST todos los campos necesarios.
	 * Devuelve todos los datos necesarios para la actualizacion de las tablas visuales.

	 */
	public function createPersonaFisicaByFolio()
	{
		$folio = trim($this->request->getPost('folio'));
		$year = trim($this->request->getPost('year'));
		if ($this->permisosAgenteAtencion($folio, $year) == null) {
			return json_encode(['status' => 0, 'message' => "El agente no coincide con el agente de atención"]);
		}
		$dataNewPersonaFisica = array(
			'FOLIOID' => $this->request->getPost('folio'),
			'ANO' => $this->request->getPost('year'),
			'NOMBRE' => $this->request->getPost('nombre'),
			'PRIMERAPELLIDO' => $this->request->getPost('primer_apellido'),
			'SEGUNDOAPELLIDO' => $this->request->getPost('segundo_apellido'),
			'FECHANACIMIENTO' => $this->request->getPost('fecha_nacimiento'),
			'EDADCANTIDAD' => $this->request->getPost('edad'),
			'SEXO' => $this->request->getPost('sexo') != null ?  $this->request->getPost('sexo') : NULL,
			'TELEFONO' => $this->request->getPost('telefono') != '' ? $this->request->getPost('telefono') : NULL,
			'TELEFONO2' => $this->request->getPost('telefono_adicional') != '' ? $this->request->getPost('telefono_adicional') : NULL,
			'CALIDADJURIDICAID' => $this->request->getPost('calidad_juridica'),
			'TIPOIDENTIFICACIONID' => $this->request->getPost('identificacion') != 0 ? $this->request->getPost('identificacion') : NULL,
			'CODIGOPAISTEL' => $this->request->getPost('codigo_pais_pfc') != '' ? $this->request->getPost('codigo_pais_pfc') : NULL,
			'CODIGOPAISTEL2' => $this->request->getPost('codigo_pais_pfc_2') != '' ? $this->request->getPost('codigo_pais_pfc_2') : NULL,
			'NUMEROIDENTIFICACION' => $this->request->getPost('numero_identificacion'),
			'NACIONALIDADID' => $this->request->getPost('nacionalidad_origen'),
			'PERSONAIDIOMAID' => $this->request->getPost('idioma'),
			'ESCOLARIDADID' => $this->request->getPost('escolaridad'),
			'OCUPACIONID' => $this->request->getPost('ocupacion'),
			'ESTADOCIVILID' => $this->request->getPost('estado_civil') != 0 ? $this->request->getPost('estado_civil') : NULL,
			'ESTADOORIGENID' =>  $this->request->getPost('estado_origen') != 0 ? $this->request->getPost('estado_origen') : NULL,
			'MUNICIPIOORIGENID' =>  $this->request->getPost('municipio_origen') != 0 ? $this->request->getPost('municipio_origen') : NULL,
			'FACEBOOK' => $this->request->getPost('facebook') != '' ? $this->request->getPost('facebook') : NULL,
			'INSTAGRAM' => $this->request->getPost('instagram') != '' ? $this->request->getPost('instagram') : NULL,
			'TWITTER' => $this->request->getPost('twitter') != '' ? $this->request->getPost('twitter') : NULL,
			'LEER' => $this->request->getPost('leer'),
			'ESCRIBIR' => $this->request->getPost('escribir'),
			'PAIS' => $this->request->getPost('pais_actual'),
			'CORREO' => $this->request->getPost('correo') != '' ? $this->request->getPost('correo') : NULL,
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
		//Crea la persona fisica, domicilio y filiación conforme al id consecutivo
		$personaFisica = $this->_folioPersonaFisica($dataNewPersonaFisica, $folio, $year);
		$mediaFiliacion = $this->_folioPersonaFisicaMediaFiliacion($dataNewPersonaFisica, $folio, $personaFisica, $year);
		$domicilio = $this->_folioPersonaFisicaDomicilio($dataNewPersonaFisicaDomicilio, $folio, $personaFisica, $year);


		if ($personaFisica) {
			$personas = $this->_folioPersonaFisicaModelRead->get_by_folio($folio, $year);
			$personaFisicaID = $this->_folioPersonaFisicaModelRead->asObject()->where('FOLIOID', $folio)->where('ANO', $year)->orderBy('PERSONAFISICAID', 'desc')->first();
			$imputados = $this->_folioPersonaFisicaModelRead->get_imputados($folio, $year);
			$victimas = $this->_folioPersonaFisicaModelRead->get_victimas($folio, $year);
			$delitosModalidadFiltro = $this->_delitoModalidadModelRead->get_delitodescr($folio, $year);

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

	/**
	 * Función para crear personas fisícas en denuncia anonima
	 *  Devuelve todos los datos necesarios para la actualizacion de las tablas visuales.
	 * Recibe por metodo POST todos los campos necesarios.

	 */
	public function createPersonaFisicaByDenunciaAnonima()
	{
		$nombre = $this->request->getPost('nombre');

		if ($nombre != null) {
			$nombre = $this->request->getPost('nombre');
		} else {

			if ($this->request->getPost('victima_conocido') == 1 && $this->request->getPost('imputado_conocido') == null) {
				if ($nombre == null) {
					$nombre = 'QUIEN RESULTE OFENDIDO';
				}
			} else if ($this->request->getPost('victima_conocido') == 2 && $this->request->getPost('imputado_conocido') == null) {
				$nombre = 'QUIEN RESULTE OFENDIDO';
			} else if ($this->request->getPost('imputado_conocido') == 1 && $this->request->getPost('victima_conocido') != null) {
				if ($nombre == null) {
					$nombre = 'QUIEN RESULTE RESPONSABLE';
				}
			} else if ($this->request->getPost('imputado_conocido') == 2 && $this->request->getPost('victima_conocido') != null) {
				$nombre = 'QUIEN RESULTE RESPONSABLE';
			}
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
		//Crea la persona fisica, domicilio y filiación conforme al id consecutivo
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

	/**
	 * Funcíon para sacar si hay registro de personas fisicas e incrementar 1, o si no hay asignar el valor inicial
	 *
	 * @param  mixed $data
	 * @param  mixed $folio
	 * @param  mixed $year
	 */
	private function _folioPersonaFisica($data, $folio, $year)
	{
		$data = $data;
		$data['FOLIOID'] = $folio;
		$data['ANO'] = $year;
		if ($data['FECHANACIMIENTO'] == '' || $data['FECHANACIMIENTO'] == null || $data['FECHANACIMIENTO'] == '0000-00-00') {
			$data['FECHANACIMIENTO'] = null;
		}

		$personaFisica = $this->_folioPersonaFisicaModelRead->asObject()->where('FOLIOID', $folio)->where('ANO', $year)->orderBy('PERSONAFISICAID', 'desc')->first();

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

	/**
	 * Funcíon para sacar si hay registro de domicilios e incrementar 1, o si no hay asignar el valor inicial
	 *
	 * @param  mixed $data
	 * @param  mixed $folio
	 * @param  mixed $personaFisicaID
	 * @param  mixed $year
	 */
	private function _folioPersonaFisicaDomicilio($data, $folio, $personaFisicaID, $year)
	{
		$data = $data;
		$data['FOLIOID'] = $folio;
		$data['ANO'] = $year;
		$data['PERSONAFISICAID'] = $personaFisicaID;

		$colonia = $this->_coloniasModelRead->asObject()->where('ESTADOID', 2)->where('MUNICIPIOID', $data['MUNICIPIOID'])->where('LOCALIDADID',  $data['LOCALIDADID'])->where('COLONIAID', $data['COLONIAID'])->first();
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
					$localidad = $this->_localidadesModelRead->asObject()->where('ESTADOID', 2)->where('MUNICIPIOID', $data['MUNICIPIOID'])->where('LOCALIDADID', $data['LOCALIDADID'])->first();
					$localidad ? $data['ZONA'] = $localidad->ZONA : null;
				} catch (\Exception $e) {
				}
			}
		}



		$personaDomicilio = $this->_folioPersonaFisicaDomicilioModelRead->asObject()->where('FOLIOID', $folio)->where('ANO', $year)->where('PERSONAFISICAID', $personaFisicaID)->orderBy('DOMICILIOID', 'desc')->first();

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

	/**
	 * Funcíon para agregar media filiacion a las personas fisícas
	 * @param  mixed $data
	 * @param  mixed $folio
	 * @param  mixed $personaFisicaID
	 * @param  mixed $year
	 */
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

	/**
	 * Función para agregar la relación de delitos, imputado y victima.
	 * Devuelve todos los datos necesarios para la actualizacion de las tablas visuales
	 */
	public function createRelacionIDOByFolio()
	{
		$folio = trim($this->request->getPost('folio'));
		$year = trim($this->request->getPost('year'));
		if ($this->permisosAgenteAtencion($folio, $year) == null) {
			return json_encode(['status' => 0, 'message' => "El agente no coincide con el agente de atención"]);
		}
		$datoRelacionFisfis = array(
			'FOLIOID' => $this->request->getPost('folio'),
			'ANO' => $this->request->getPost('year'),
			'PERSONAFISICAIDVICTIMA' => $this->request->getPost('victima'),
			'DELITOMODALIDADID' => $this->request->getPost('delito'),
			'PERSONAFISICAIDIMPUTADO' => $this->request->getPost('imputado'),
			'TENTATIVA' => $this->request->getPost('tentativa') != null ? $this->request->getPost('tentativa') : NULL,
			'CONVIOLENCIA' => $this->request->getPost('conviolencia') != null ? $this->request->getPost('conviolencia') : NULL,

		);
		// Se revisa que no exista esa relación
		$checarDelito = $this->_relacionIDOModelRead->where('FOLIOID', $folio)->where('ANO', $year)->where('PERSONAFISICAIDVICTIMA', $this->request->getPost('victima'))->where('PERSONAFISICAIDIMPUTADO', $this->request->getPost('imputado'))->where('DELITOMODALIDADID', $this->request->getPost('delito'))->first();
		if (isset($checarDelito)) {
			return json_encode(['status' => 3]);
		}
		// $this->_relacionIDOModel->transStart();
		// $this->_relacionIDOModel->insert($datoRelacionFisfis);
		// $this->_relacionIDOModel->transComplete();
		// if ($this->_relacionIDOModel->transStatus() === false) {
		// 	return json_encode(['status' => 0, 'message' => $_POST]);
		// } else {
		// 	$relacionFisFis = $this->_relacionIDOModelRead->get_by_folio($folio, $year);

		// 	$datosBitacora = [
		// 		'ACCION' => 'Ha ingresado una nueva relación de delito.',
		// 		'NOTAS' => 'FOLIO: ' . $folio . ' AÑO: ' . $year,
		// 	];

		// 	$this->_bitacoraActividad($datosBitacora);

		// 	return json_encode(['status' => 1, 'relacionFisFis' => $relacionFisFis]);
		// }

		$insertRelacionIDO = $this->_relacionIDOModel->insert($datoRelacionFisfis);

		if (isset($insertRelacionIDO)) {
			$relacionFisFis = $this->_relacionIDOModel->get_by_folio($folio, $year);

			$datosBitacora = [
				'ACCION' => 'Ha ingresado una nueva relación de delito.',
				'NOTAS' => 'FOLIO: ' . $folio . ' AÑO: ' . $year,
			];

			$this->_bitacoraActividad($datosBitacora);

			return json_encode(['status' => 1, 'relacionFisFis' => $relacionFisFis]);
		} else {
			return json_encode(['status' => 0, 'message' => $_POST]);
		}
	}

	/**
	 * Función para eliminar el árbol delictual.
	 * Devuelve todos los datos necesarios para la actualizacion de las tablas visuales
	 */
	public function deleteArbolByFolio()
	{
		try {
			$folio = trim($this->request->getPost('folio'));
			$year = trim($this->request->getPost('year'));
			if ($this->permisosAgenteAtencion($folio, $year) == null) {
				return json_encode(['status' => 0, 'message' => "El agente no coincide con el agente de atención"]);
			}
			$personafisicavictima = trim($this->request->getPost('personafisicavictima'));
			$delitomodalidad = trim($this->request->getPost('delito'));
			$personafisicaimputado = trim($this->request->getPost('personafisicaimputado'));

			$countImpDelito = $this->_imputadoDelitoModelRead->count_delitos($folio, $year, $delitomodalidad);
			$countdelitoFisFis = $this->_relacionIDOModelRead->count_delitosFisFis($folio, $year, $delitomodalidad, $personafisicaimputado);
			$deleteArbol = $this->_relacionIDOModel->where('FOLIOID', $folio)->where('ANO', $year)->where('PERSONAFISICAIDVICTIMA', $personafisicavictima)->where('DELITOMODALIDADID', $delitomodalidad)->where('PERSONAFISICAIDIMPUTADO', $personafisicaimputado)->delete();

			// Si solo hay un delito se retorna para que el usuario confirme que va a eliminar
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
						'ACCION' => 'Ha eliminado un árbol delictivo.',
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
	/**
	 * Función para eliminar la relación del delito e imputado
	 * Devuelve todos los datos necesarios para la actualizacion de las tablas visuales
	 */
	public function deleteImpDelitoByFolio()
	{
		try {
			$folio = trim($this->request->getPost('folio'));
			$year = trim($this->request->getPost('year'));
			if ($this->permisosAgenteAtencion($folio, $year) == null) {
				return json_encode(['status' => 0, 'message' => "El agente no coincide con el agente de atención"]);
			}
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
	/**
	 * Función para eliminar archivos externos conforme a su id
	 * Recibe por metodo POST el folio, año y archivo id para su eliminación
	 * Devuelve todos los datos necesarios para la actualizacion de las tablas visuales
	 */
	public function deleteArchivoById()
	{
		try {
			$folio = trim($this->request->getPost('folio'));
			$year = trim($this->request->getPost('year'));
			$archivoid = trim($this->request->getPost('archivoid'));
			if ($this->permisosAgenteAtencion($folio, $year) == null) {
				return json_encode(['status' => 0, 'message' => "El agente no coincide con el agente de atención"]);
			}
			$deletearchivo = $this->_archivoExternoModel->where('FOLIOID', $folio)->where('ANO', $year)->where('FOLIOARCHIVOID', $archivoid)->delete();

			if ($deletearchivo) {
				$datados = (object) array();

				$datados->archivosexternos = $this->_archivoExternoModelRead->asObject()->where('FOLIOID', $folio)->where('ANO', $year)->findAll();
				if ($datados->archivosexternos) {
					foreach ($datados->archivosexternos as $key => $archivos) {
						//Se codifica para que la imagén pueda ser visual
						$file_info = new \finfo(FILEINFO_MIME_TYPE);
						$type = $file_info->buffer($archivos->ARCHIVO);
						$archivos->ARCHIVO = 'data:' . $type . ';base64,' . base64_encode($archivos->ARCHIVO);
					}
				}
				$datosBitacora = [
					'ACCION' => 'Ha eliminado un archivo externo.',
					'NOTAS' => 'FOLIO: ' . $folio . ' AÑO: ' . $year,
				];


				$this->_bitacoraActividad($datosBitacora);


				return json_encode(['status' => 1, 'archivos' => $datados]);
			} else {
				return json_encode(['status' => 0]);
			}
		} catch (\Exception $e) {
			return json_encode(['status' => 0]);
		}
	}
	/**
	 * Función para eliminar vehiculos conforme a su id
	 * Recibe por metodo POST el folio, año y vehiculo id para su eliminación
	 * Devuelve todos los datos necesarios para la actualizacion de las tablas visuales
	 */
	public function deleteVehiculoByFolio()
	{
		try {
			$folio = trim($this->request->getPost('folio'));
			$year = trim($this->request->getPost('year'));
			$vehiculoid = trim($this->request->getPost('vehiculoid'));

			if ($this->permisosAgenteAtencion($folio, $year) == null) {
				return json_encode(['status' => 0, 'message' => "El agente no coincide con el agente de atención"]);
			}
			$deleteVehiculo = $this->_folioVehiculoModel->where('FOLIOID', $folio)->where('ANO', $year)->where('VEHICULOID', $vehiculoid)->delete();

			if ($deleteVehiculo) {
				$vehiculos = $this->_folioVehiculoModel->get_by_folio($folio, $year);


				$datosBitacora = [
					'ACCION' => 'Ha eliminado un vehiculo',
					'NOTAS' => 'FOLIO: ' . $folio . ' AÑO: ' . $year,
				];


				$this->_bitacoraActividad($datosBitacora);


				return json_encode(['status' => 1, 'vehiculos' => $vehiculos]);
			} else {
				return json_encode(['status' => 0]);
			}
		} catch (\Exception $e) {
			return json_encode(['status' => 0]);
		}
	}

	/**
	 * Función para crear la relación imputado-delito
	 * Recibe por metodo POST los datos del formulario
	 * Devuelve todos los datos necesarios para la actualizacion de las tablas visuales
	 */
	public function createFisImpDelitoByFolio()
	{
		$folio = trim($this->request->getPost('folio'));
		$year = trim($this->request->getPost('year'));
		if ($this->permisosAgenteAtencion($folio, $year) == null) {
			return json_encode(['status' => 0, 'message' => "El agente no coincide con el agente de atención"]);
		}
		$datoFisImpDelito = array(
			'FOLIOID' => $this->request->getPost('folio'),
			'ANO' => $this->request->getPost('year'),
			'PERSONAFISICAID' => $this->request->getPost('imputado'),
			'DELITOMODALIDADID' => $this->request->getPost('delito'),
		);
		// Se revisa que no exista esa relación
		$checarDelito = $this->_imputadoDelitoModelRead->where('FOLIOID', $folio)->where('ANO', $year)->where('DELITOMODALIDADID', $this->request->getPost('delito'))->where('PERSONAFISICAID', $this->request->getPost('imputado'))->first();
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
	/**
	 * Función para obtener la subclasificación de los objetos involucrados
	 * Recibe por metodo POST el id de la clasificacion del objeto
	 * Devuelve todos los datos necesarios para la actualizacion de las tablas visuales
	 */
	public function getObjetoSubclasificacion()
	{
		$data = (object) array();
		$clasificacionID = $this->request->getPost('objeto_clasificacion_id');

		$data->objetoSubclasificacion = $this->_objetoSubclasificacionModelRead->asObject()->where('OBJETOCLASIFICACIONID', $clasificacionID)->orderBy('OBJETOSUBCLASIFICACIONDESCR', 'asc')->findAll();

		if ($data->objetoSubclasificacion) {
			return json_encode(['status' => 1, 'objetoSub' => $data->objetoSubclasificacion]);
		} else {
			return json_encode(['status' => 0]);
		}
	}
	/**
	 * Función para crear objetos involucrados
	 * Recibe por metodo POST los datos del formulario
	 * Devuelve todos los datos necesarios para la actualizacion de las tablas visuales
	 */
	public function createObjetoInvolucradoByFolio()
	{

		$folio = trim($this->request->getPost('folio'));
		$year = trim($this->request->getPost('year'));
		if ($this->permisosAgenteAtencion($folio, $year) == null) {
			return json_encode(['status' => 0, 'message' => "El agente no coincide con el agente de atención"]);
		}
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
	/**
	 * Función para eliminar objetos involucrados
	 * Recibe por metodo POST los datos del formulario
	 * Devuelve todos los datos necesarios para la actualizacion de las tablas visuales
	 */
	public function deleteObjetoInvolucrado()
	{

		try {
			$folio = trim($this->request->getPost('folio'));
			$year = trim($this->request->getPost('year'));
			$objetoid = trim($this->request->getPost('objetoid'));
			if ($this->permisosAgenteAtencion($folio, $year) == null) {
				return json_encode(['status' => 0, 'message' => "El agente no coincide con el agente de atención"]);
			}
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
	/**
	 * Función para obtener todos los datos del objetos involucrado conforme a su id
	 * Recibe por metodo POST el folio, año y objeto id.
	 * Devuelve todos los datos necesarios para la actualizacion de las tablas visuales
	 */
	public function getObjetoInvolucrado()
	{
		$objetoid = trim($this->request->getPost('objetoid'));
		$folio = trim($this->request->getPost('folio'));
		$year = trim($this->request->getPost('year'));

		$data = (object) array();
		$data->objetoInvolucrado = $this->_folioObjetoInvolucradoModelRead->where('FOLIOID', $folio)->where('ANO', $year)->where('OBJETOID', $objetoid)->first();
		$data->objetosub = $this->_folioObjetoInvolucradoModelRead->get_objetosub($folio, $year, $objetoid, $data->objetoInvolucrado['CLASIFICACIONID']);
		if ($data->objetoInvolucrado) {
			$data->status = 1;
			return json_encode($data);
		} else {
			$data = (object)['status' => 0];
			return json_encode($data);
		}
	}
	/**
	 * Función para actualizar objetos involucrados conforme a su id
	 * Recibe por metodo POST los datos del formulario
	 * Devuelve todos los datos necesarios para la actualizacion de las tablas visuales
	 */
	public function updateObjetosInvolucradosById()
	{
		try {
			$objetoid = trim($this->request->getPost('objetoid'));
			$folio = trim($this->request->getPost('folio'));
			$year = trim($this->request->getPost('year'));
			if ($this->permisosAgenteAtencion($folio, $year) == null) {
				return json_encode(['status' => 0, 'message' => "El agente no coincide con el agente de atención"]);
			}
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
					'ACCION' => 'Ha actualizado un objeto involucrado.',
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

	/**
	 * Funcíon para sacar si hay registro de objetos involucrados e incrementar 1, o si no hay asignar el valor inicial	 *
	 * @param  mixed $data
	 * @param  mixed $folio
	 * @param  mixed $year
	 */
	private function _folioObjetoInvolucrado($data, $folio, $year)
	{
		$data = $data;
		$data['FOLIOID'] = $folio;
		$data['ANO'] = $year;

		$objetoInvolucrado = $this->_folioObjetoInvolucradoModelRead->asObject()->where('FOLIOID', $folio)->where('ANO', $year)->orderBy('OBJETOID', 'desc')->first();

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

	/**
	 * Función para rellenar la plantilla solicitada
	 * Recibe por metodo POST el folio, año, titulo de la plantilla, victima, imputado. En dado caso; umas, notificacion, procesos.
	 *
	 */
	public function get_Plantillas()
	{
		$meses = array("ENERO", "FEBRERO", "MARZO", "ABRIL", "MAYO", "JUNIO", "JULIO", "AGOSTO", "SEPTIEMBRE", "OCTUBRE", "NOVIEMBRE", "DICIEMBRE");
		$year = $this->request->getPost('year');
		$titulo = $this->request->getPost('titulo');
		$victima = $this->request->getPost('victima');
		$imputado = $this->request->getPost('imputado');
		$folio = $this->request->getPost('folio');
		$uma =  $this->request->getPost('uma');
		$notificacion =  $this->request->getPost('notificacion');
		$proceso =  $this->request->getPost('proceso');

		$expediente = '';

		// try {

		if (!isset($year) || !isset($titulo) || !isset($victima) || !isset($imputado) || !isset($folio)) {
			return json_encode((object)['status' => 0]);
		}

		$data = (object) array();


		/*
		**Se obtiene todos los datos de las diferentes tablas para completar el rellenado
		**/
		$data->folio = $this->_folioModelRead->asObject()->where('ANO', $year)->where('FOLIOID', $folio)->first();
		$data->plantilla = $this->_plantillasModelRead->where('TITULO', $titulo)->first();

		$data->folioDoc = $this->_folioDocModelRead->get_by_folio($folio, $data->folio->ANO);
		$data->lugar_hecho = $data->folio->HECHOLUGARID ? $this->_hechoLugarModelRead->asObject()->where('HECHOLUGARID', $data->folio->HECHOLUGARID)->first() : (object)['HECHOLUGARDESCR' => 'NO ESPECIFICADO'];
		$data->derivacion = $this->_derivacionesAtencionesModelRead->asObject()->where('MUNICIPIOID', $data->folio->INSTITUCIONREMISIONMUNICIPIOID)->where('INSTITUCIONREMISIONID',  $data->folio->INSTITUCIONREMISIONID)->first();
		$data->canalizacion = $this->_canalizacionesAtencionesModelRead->asObject()->where('MUNICIPIOID', $data->folio->INSTITUCIONREMISIONMUNICIPIOID)->where('INSTITUCIONREMISIONID',  $data->folio->INSTITUCIONREMISIONID)->first();
		$data->bandejaRac = $this->_bandejaRacModelRead->asObject()->where('ANO', $year)->where('FOLIOID', $folio)->first();
		$data->municipios = $this->_municipiosModelRead->asObject()->where('ESTADOID', '2')->where('MUNICIPIOID',  $data->folio->MUNICIPIOID)->first();
		$data->localidad = $this->_localidadesModelRead->asObject()->where('ESTADOID',  $data->folio->HECHOESTADOID)->where('MUNICIPIOID',  $data->folio->HECHOMUNICIPIOID)->where('LOCALIDADID', $data->folio->HECHOLOCALIDADID)->first();

		//Delito
		$data->delitosModalidadFiltro = $this->_delitoModalidadModelRead->get_delitodescr($folio, $year);
		$data->municipio_delito = $this->_municipiosModelRead->asObject()->where('ESTADOID',  $data->folio->HECHOESTADOID)->where('MUNICIPIOID',  $data->folio->HECHOMUNICIPIOID)->first();
		$data->lugar_delito = $this->_hechoLugarModelRead->asObject()->where('HECHOLUGARID', $data->folio->HECHOLUGARID)->first();

		//Info victima
		$data->victima = $this->_folioPersonaFisicaModelRead->get_by_personas($data->folio->FOLIOID, $data->folio->ANO, $victima);
		$data->victimaDom = $this->_folioPersonaFisicaDomicilioModelRead->asObject()->where('FOLIOID', $data->folio->FOLIOID)->where('ANO', $data->folio->ANO)->where('PERSONAFISICAID', $victima)->first();
		$data->estadoVictima = $this->_estadosModelRead->asObject()->where('ESTADOID',  $data->victimaDom->ESTADOID)->first();
		$data->municipioVictima = $this->_municipiosModelRead->asObject()->where('ESTADOID',  $data->victimaDom->ESTADOID)->where('MUNICIPIOID',  $data->victimaDom->MUNICIPIOID)->first();
		$data->tipoIdentificacionVictima = $this->_tipoIdentificacionModelRead->asObject()->where('PERSONATIPOIDENTIFICACIONID',   $data->victima[0]['TIPOIDENTIFICACIONID'])->first();
		$data->ocupacionVictima = $this->_ocupacionModelRead->asObject()->where('PERSONAOCUPACIONID',   $data->victima[0]['OCUPACIONID'])->first();
		$data->nacionalidadVictima = $this->_nacionalidadModelRead->asObject()->where('PERSONANACIONALIDADID',   $data->victima[0]['NACIONALIDADID'])->first();
		$data->edoCivilVictima = $this->_estadoCivilModelRead->asObject()->where('PERSONAESTADOCIVILID',   $data->victima[0]['ESTADOCIVILID'])->first();
		//Rasgos de la victima
		$data->mediaFiliacionVictima = $this->_folioMediaFiliacionRead->asObject()->where('FOLIOID', $folio)->where('PERSONAFISICAID', $victima)->first();

		//Info imputado
		$data->imputado = $this->_folioPersonaFisicaModelRead->asObject()->where('FOLIOID', $data->folio->FOLIOID)->where('ANO', $data->folio->ANO)->where('PERSONAFISICAID', $imputado)->first();
		$data->imputadoDom = $this->_folioPersonaFisicaDomicilioModelRead->asObject()->where('FOLIOID', $data->folio->FOLIOID)->where('ANO', $data->folio->ANO)->where('PERSONAFISICAID', $imputado)->first();
		$data->imputados_da = $this->_folioPersonaFisicaModelRead->asObject()->where('FOLIOID', $data->folio->FOLIOID)->where('ANO', $data->folio->ANO)->where('CALIDADJURIDICAID', 2)->findAll();
		$data->vehiculos_da = $this->_folioVehiculoModelRead->asObject()->where('FOLIOID', $data->folio->FOLIOID)->where('ANO', $data->folio->ANO)->findAll();
		$data->municipio_imp = $this->_municipiosModelRead->asObject()->where('ESTADOID',  $data->imputadoDom->ESTADOID)->where('MUNICIPIOID',  $data->imputadoDom->MUNICIPIOID)->first();
		$data->estado_imp = $this->_estadosModelRead->asObject()->where('ESTADOID',  $data->imputadoDom->ESTADOID)->first();
		$data->desaparecidos_da = $this->_folioPersonaFisicaModelRead->asObject()->where('FOLIOID', $data->folio->FOLIOID)->where('ANO', $data->folio->ANO)->where('DESAPARECIDA', 'S')->findAll();

		//Info denunciante
		$data->denunciante = $this->_folioPersonaFisicaModelRead->asObject()->where('FOLIOID', $data->folio->FOLIOID)->where('ANO', $data->folio->ANO)->where('DENUNCIANTE', 'S')->first();
		if (!$data->denunciante) {
			$data->denunciante = $this->_folioPersonaFisicaModelRead->asObject()->where('FOLIOID', $data->folio->FOLIOID)->where('ANO', $data->folio->ANO)->where('PERSONAFISICAID', $victima)->first();
		}
		$data->denuncianteDomicilio = $this->_folioPersonaFisicaDomicilioModelRead->asObject()->where('FOLIOID', $data->folio->FOLIOID)->where('ANO', $data->folio->ANO)->where('PERSONAFISICAID', $data->denunciante->PERSONAFISICAID)->first();
		$data->denuncianteMunicipio = $this->_municipiosModelRead->asObject()->where('ESTADOID',  $data->denuncianteDomicilio->ESTADOID)->where('MUNICIPIOID', $data->denuncianteDomicilio->MUNICIPIOID)->first();
		$data->denuncianteEstado = $this->_estadosModelRead->asObject()->where('ESTADOID',  $data->denuncianteDomicilio->ESTADOID)->first();
		$data->denuncianteTipoIdentificacion = $this->_tipoIdentificacionModelRead->asObject()->where('PERSONATIPOIDENTIFICACIONID',   $data->denunciante->TIPOIDENTIFICACIONID)->first();
		$data->denuncianteOcupacion = $this->_ocupacionModelRead->asObject()->where('PERSONAOCUPACIONID',   $data->denunciante->OCUPACIONID)->first();
		$data->denuncianteNacionalidad = $this->_nacionalidadModelRead->asObject()->where('PERSONANACIONALIDADID',   $data->denunciante->NACIONALIDADID)->first();
		$data->denuncianteEdoCivil = $this->_estadoCivilModelRead->asObject()->where('PERSONAESTADOCIVILID',   $data->denunciante->ESTADOCIVILID)->first();
		$data->denuncianteMunicipioNac = $this->_municipiosModelRead->asObject()->where('ESTADOID',  $data->denunciante->ESTADOORIGENID)->where('MUNICIPIOID', $data->denunciante->MUNICIPIOORIGENID)->first();
		$data->denuncianteEstadoNac = $this->_estadosModelRead->asObject()->where('ESTADOID',  $data->denunciante->ESTADOORIGENID)->first();
		//Replaces denunciante
		$data->plantilla = str_replace('[DENUNCIANTE_NOMBRE]', $data->denunciante->NOMBRE . ' ' . ($data->denunciante->PRIMERAPELLIDO ? $data->denunciante->PRIMERAPELLIDO : '') . ' ' . ($data->denunciante->SEGUNDOAPELLIDO ? $data->denunciante->SEGUNDOAPELLIDO : ''), $data->plantilla);
		$data->plantilla = str_replace('[DENUNCIANTE_CORREO]', $data->denunciante->CORREO ? $data->denunciante->CORREO : 'DESCONOCIDO', $data->plantilla);
		$data->plantilla = str_replace('[DENUNCIANTE_EDAD]', $data->denunciante->EDADCANTIDAD ? $data->denunciante->EDADCANTIDAD : 'DESCONOCIDO', $data->plantilla);
		$data->plantilla = str_replace('[DENUNCIANTE_TELEFONO]', $data->denunciante->TELEFONO ? $data->denunciante->TELEFONO : 'DESCONOCIDO', $data->plantilla);
		$data->plantilla = str_replace('[DENUNCIANTE_IDENTIFICACION_NUMERO]', $data->denunciante->NUMEROIDENTIFICACION ? $data->denunciante->NUMEROIDENTIFICACION : '', $data->plantilla);
		$data->plantilla = str_replace('[DENUNCIANTE_IDENTIFICACION]', isset($data->denuncianteTipoIdentificacion) == true ? $data->denuncianteTipoIdentificacion->PERSONATIPOIDENTIFICACIONDESCR : 'NINGUNO', $data->plantilla);
		$data->plantilla = str_replace('[DENUNCIANTE_OCUPACION]', isset($data->denuncianteOcupacion) == true ? $data->denuncianteOcupacion->PERSONAOCUPACIONDESCR : 'DESCONOCIDO', $data->plantilla);
		$data->plantilla = str_replace('[DENUNCIANTE_NACIONALIDAD]', isset($data->denuncianteNacionalidad) == true ? $data->denuncianteNacionalidad->PERSONANACIONALIDADDESCR : 'DESCONOCIDA', $data->plantilla);
		$data->plantilla = str_replace('[DENUNCIANTE_ESTADO_CIVIL]', isset($data->denuncianteEdoCivil) == true ? $data->denuncianteEdoCivil->PERSONAESTADOCIVILDESCR : 'DESCONOCIDO', $data->plantilla);
		$data->plantilla = str_replace('[DENUNCIANTE_DOMICILIO]', ($data->denuncianteDomicilio->CALLE ? $data->denuncianteDomicilio->CALLE : 'DESCONOCIDO') . ($data->denuncianteDomicilio->NUMEROCASA ? ' Ext. ' . $data->denuncianteDomicilio->NUMEROCASA : '') . ($data->denuncianteDomicilio->NUMEROINTERIOR ? ' Int. ' . $data->denuncianteDomicilio->NUMEROINTERIOR : '') . ($data->denuncianteDomicilio->COLONIADESCR ? ' ' . $data->denuncianteDomicilio->COLONIADESCR : '') . (isset($data->denuncianteMunicipio) == true ? ' ' . $data->denuncianteMunicipio->MUNICIPIODESCR : '') . (isset($data->denuncianteEstado) == true ? ' ' . $data->denuncianteEstado->ESTADODESCR : ''), $data->plantilla);

		//Expediente
		$expediente = $data->folio->EXPEDIENTEID ? $data->folio->EXPEDIENTEID : null;

		if ($data->victima[0]['DESAPARECIDA'] == 'S' && $data->mediaFiliacionVictima) {
			//Victima media filiación
			$colorOjos = $this->_ojoColorModelRead->asObject()->where('OJOCOLORID', $data->mediaFiliacionVictima->OJOCOLORID)->first();
			$colorCabello = $this->_cabelloColorModelRead->asObject()->where('CABELLOCOLORID', $data->mediaFiliacionVictima->CABELLOCOLORID)->first();
			$complexion = $this->_figuraModelRead->asObject()->where('FIGURAID', $data->mediaFiliacionVictima->FIGURAID)->first();
			$colorPiel = $this->_pielColorModelRead->asObject()->where('PIELCOLORID', $data->mediaFiliacionVictima->PIELCOLORID)->first();
			$cejasForma = $this->_cejaFormaModelRead->asObject()->where('CEJAFORMAID', $data->mediaFiliacionVictima->CEJAFORMAID)->first();
			$cabelloTamano = $this->_cabelloTamanoModelRead->asObject()->where('CABELLOTAMANOID', $data->mediaFiliacionVictima->CABELLOTAMANOID)->first();

			$data->plantilla = str_replace('[NOMBRE_DESAPARECIDO]', $data->victima[0]['NOMBRE'] . ' ' . ($data->victima[0]['PRIMERAPELLIDO'] ? $data->victima[0]['PRIMERAPELLIDO'] : '') . ' ' . ($data->victima[0]['SEGUNDOAPELLIDO'] ? $data->victima[0]['SEGUNDOAPELLIDO'] : ''), $data->plantilla);
			$data->plantilla = str_replace('[ANOS_DESAPARECIDO]', $data->victima[0]['EDADCANTIDAD'] ? $data->victima[0]['EDADCANTIDAD'] : '-', $data->plantilla);
			$data->plantilla = str_replace('[DIA_DESAPARICION]', $data->mediaFiliacionVictima->FECHADESAPARICION ? date('d', strtotime($data->mediaFiliacionVictima->FECHADESAPARICION)) : '-', $data->plantilla);
			$data->plantilla = str_replace('[MES_DESAPARICION]', $data->mediaFiliacionVictima->FECHADESAPARICION ? $meses[date('n', strtotime($data->mediaFiliacionVictima->FECHADESAPARICION)) - 1] : '', $data->plantilla);
			$data->plantilla = str_replace('[ANO_DESAPARICION]', $data->mediaFiliacionVictima->FECHADESAPARICION ? date('Y', strtotime($data->mediaFiliacionVictima->FECHADESAPARICION)) : '', $data->plantilla);
			$data->plantilla = str_replace('[LUGAR_DESAPARICION]',  $data->mediaFiliacionVictima->LUGARDESAPARICION ?  $data->mediaFiliacionVictima->LUGARDESAPARICION : '-', $data->plantilla);

			$data->plantilla = str_replace('[ESTATURA_DESAPARECIDO]',  $data->mediaFiliacionVictima->ESTATURA ?  (float)(((float)$data->mediaFiliacionVictima->ESTATURA) / 100) : '-', $data->plantilla);
			$data->plantilla = str_replace('[COMPLEXION_DESAPARECIDO]',  $complexion ?  $complexion->FIGURADESCR : '-', $data->plantilla);
			$data->plantilla = str_replace('[PESO_DESAPARECIDO]',  $data->mediaFiliacionVictima->PESO ?  $data->mediaFiliacionVictima->PESO : '-', $data->plantilla);
			$data->plantilla = str_replace('[TEZ_DESAPARECIDO]',  $colorPiel ?  $colorPiel->PIELCOLORDESCR : '-', $data->plantilla);
			$data->plantilla = str_replace('[OJOSCOLOR_DESAPARECIDO]',  $colorOjos ?  $colorOjos->OJOCOLORDESCR : '-', $data->plantilla);
			$data->plantilla = str_replace('[COLORCABELLO_DESAPARECIDO]',  $colorCabello ?  $colorCabello->CABELLOCOLORDESCR : '-', $data->plantilla);
			$data->plantilla = str_replace('[TIPOCEJA_DESAPARECIDO]',  $cejasForma ?  $cejasForma->CEJAFORMADESCR : '-', $data->plantilla);
			$data->plantilla = str_replace('[SENAS_PARTICULARES_DESAPARECIDO]',  $data->mediaFiliacionVictima->SENASPARTICULARES ?  $data->mediaFiliacionVictima->SENASPARTICULARES : '-', $data->plantilla);
			$data->plantilla = str_replace('[TAMANOCABELLO_DESAPARECIDO]',  $cabelloTamano ?  $cabelloTamano->CABELLOTAMANODESCR : '-', $data->plantilla);

			if ($data->victima[0]['FOTO']) {
				$file_info = new \finfo(FILEINFO_MIME_TYPE);
				$type = $file_info->buffer($data->victima[0]['FOTO']);
				$data->victima[0]['FOTO'] = 'data:' . $type . ';base64,' . base64_encode($data->victima[0]['FOTO']);
				if ($type == 'image/png' || $type == 'image/jpg' || $type == 'image/jpeg') {
					$data->plantilla = str_replace('[IMAGEN_DESAPARECIDO]',  "<img src='" . $data->victima[0]['FOTO'] . "' style='max-width:170px;'></img>", $data->plantilla);
				}
			}
		}

		if ($data->mediaFiliacionVictima) {
			//Victima media filiación
			$colorOjos = $this->_ojoColorModelRead->asObject()->where('OJOCOLORID', $data->mediaFiliacionVictima->OJOCOLORID)->first();
			$colorCabello = $this->_cabelloColorModelRead->asObject()->where('CABELLOCOLORID', $data->mediaFiliacionVictima->CABELLOCOLORID)->first();
			$complexion = $this->_figuraModelRead->asObject()->where('FIGURAID', $data->mediaFiliacionVictima->FIGURAID)->first();
			$colorPiel = $this->_pielColorModelRead->asObject()->where('PIELCOLORID', $data->mediaFiliacionVictima->PIELCOLORID)->first();
			$cejasForma = $this->_cejaFormaModelRead->asObject()->where('CEJAFORMAID', $data->mediaFiliacionVictima->CEJAFORMAID)->first();
			$cabelloTamano = $this->_cabelloTamanoModelRead->asObject()->where('CABELLOTAMANOID', $data->mediaFiliacionVictima->CABELLOTAMANOID)->first();

			$data->plantilla = str_replace('[VICTIMA_ESTATURA]',  $data->mediaFiliacionVictima->ESTATURA ?  $data->mediaFiliacionVictima->ESTATURA : '-', $data->plantilla);
			$data->plantilla = str_replace('[VICTIMA_PIEL]',  $colorPiel ?  $colorPiel->PIELCOLORDESCR : '-', $data->plantilla);
			$data->plantilla = str_replace('[VICTIMA_COLOR_OJOS]',  $colorOjos ?  $colorOjos->OJOCOLORDESCR : '-', $data->plantilla);
			$data->plantilla = str_replace('[VICTIMA_COLOR_CABELLO]',  $colorCabello ?  $colorCabello->CABELLOCOLORDESCR : '-', $data->plantilla);
			$data->plantilla = str_replace('[VICTIMA_CEJAS_FORMAS]',  $cejasForma ?  $cejasForma->CEJAFORMADESCR : '-', $data->plantilla);
			$data->plantilla = str_replace('[VICTIMA_SENAS]',  $data->mediaFiliacionVictima->SENASPARTICULARES ?  $data->mediaFiliacionVictima->SENASPARTICULARES : '-', $data->plantilla);
		}

		$relacionfisfis = $this->_relacionIDOModelRead->asObject()->where('FOLIOID', $data->folio->FOLIOID)->where('ANO', $data->folio->ANO)->where('PERSONAFISICAIDVICTIMA', $victima)->where('PERSONAFISICAIDIMPUTADO', $imputado)->first();
		if ($data->plantilla['TITULO'] == 'DENUNCIA ANONIMA') {
			$data->plantilla = str_replace('[FOLIO]',  $data->folio->FOLIOID . '/' . $data->folio->ANO, $data->plantilla);
			$data->plantilla = str_replace('[USUARIO_ID]',  $data->folio->AGENTEATENCIONID, $data->plantilla);
			$data->plantilla = str_replace('[NOTAS]',  $data->folio->NOTASAGENTE, $data->plantilla);
			$data->plantilla = str_replace('[HORA_NOTAS]',  date('H:i:s', strtotime($data->folio->FECHASALIDA)), $data->plantilla);
			$data->plantilla = str_replace('[ARMAS]', '', $data->plantilla);

			// Se crean tablas iterativas de los vehiculos existentes
			if ($data->vehiculos_da) {
				foreach ($data->vehiculos_da as $key => $vehiculos) {
					$estadoV = $this->_estadosModelRead->asObject()->where('ESTADOID',  $vehiculos->ESTADOIDPLACA)->first();
					$linea = $this->_vehiculoVersionModelRead->asObject()->where('VEHICULOVERSIONID',  $vehiculos->VEHICULOVERSIONID)->first();
					$color = $this->_coloresVehiculoModelRead->asObject()->where('VEHICULOCOLORID',  $vehiculos->PRIMERCOLORID)->first();
					$tipo = $this->_tipoVehiculoModelRead->asObject()->where('VEHICULOTIPOID',  $vehiculos->TIPOID)->first();

					$data->plantilla = str_replace(
						'[TABLA_VEHICULOS]',
						'[TABLA_VEHICULOS]' . $key,
						$data->plantilla
					);
					if ($vehiculos == end($data->vehiculos_da)) {
						$data->plantilla = str_replace(
							'[TABLA_VEHICULOS]' . $key,
							'<hr></hr><table width="100%" border="0" cellspacing="0" cellpadding="0" >
								<tbody>
									<tr>
									 <td>
										<p>
											<span style="color: rgb(0, 0, 0);">Placas:</span>
											<span style="color: rgb(0, 0, 0);text-decoration: underline;">[VEHICULO_PLACAS] </span>
										</p>
									</td>
									<td>
										<p>
											<span style="color: rgb(0, 0, 0);">Serie:</span>
											<span style="color: rgb(0, 0, 0);text-decoration: underline;">[VEHICULO_SERIE]</span>
										</p>
									</td>
									<td>
										<p>
											<span style="color: rgb(0, 0, 0);">Marca:</span>
											<span style="color: rgb(0, 0, 0);text-decoration: underline;">[VEHICULO_MARCA]</span>
										</p>
									</td>
								</tr>
								
								<tr>
									<td>
										<p>
											<span style="color: rgb(0, 0, 0);">Modelo:</span>
											<span style="color: rgb(0, 0, 0);text-decoration: underline;">[VEHICULO_MODELO] </span>
										</p>
									</td>
									<td>
										<p>
											<span style="color: rgb(0, 0, 0);">Estado procedencia:</span>
											<span style="color: rgb(0, 0, 0);text-decoration: underline;">[VEHICULO_ESTADO]</span>
										</p>
									</td>
									<td>
										<p>
											<span style="color: rgb(0, 0, 0);">Linea:</span>
											<span style="color: rgb(0, 0, 0);text-decoration: underline;">[VEHICULO_LINEA]</span>
										</p>
									</td>
								</tr>
								<tr>
								 <td>
									<p>
										<span style="color: rgb(0, 0, 0);">Color:</span>
										<span style="color: rgb(0, 0, 0);text-decoration: underline;">[VEHICULO_COLOR] </span>
									</p>
								</td>
								<td>
									<p>
										<span style="color: rgb(0, 0, 0);">Comentarios:</span>
										<span style="color: rgb(0, 0, 0);text-decoration: underline;">[VEHICULO_COMENTARIOS]</span>
									</p>
								</td>
								</tr>
								<tr>
									<td>
										<p>
											<span style="color: rgb(0, 0, 0);">Clase:</span>
											<span style="color: rgb(0, 0, 0);text-decoration: underline;">[VEHICULO_CLASE] </span>
										</p>
									</td>
								
								</tr>
								<tr>
									<td>
										<p>
											<span style="color: rgb(0, 0, 0);">Tipo:</span>
											<span style="color: rgb(0, 0, 0);text-decoration: underline;">[VEHICULO_TIPO] </span>
										</p>
									</td>
								
								</tr>
								</tbody>
								</table><hr></hr>',
							$data->plantilla
						);
					} else {
						$data->plantilla = str_replace(
							'[TABLA_VEHICULOS]' . $key,
							'<hr></hr><table width="100%" border="0" cellspacing="0" cellpadding="0" >
								<tbody>
									<tr>
									 <td>
										<p>
											<span style="color: rgb(0, 0, 0);">Placas:</span>
											<span style="color: rgb(0, 0, 0);text-decoration: underline;">[VEHICULO_PLACAS] </span>
										</p>
									</td>
									<td>
										<p>
											<span style="color: rgb(0, 0, 0);">Serie:</span>
											<span style="color: rgb(0, 0, 0);text-decoration: underline;">[VEHICULO_SERIE]</span>
										</p>
									</td>
									<td>
										<p>
											<span style="color: rgb(0, 0, 0);">Marca:</span>
											<span style="color: rgb(0, 0, 0);text-decoration: underline;">[VEHICULO_MARCA]</span>
										</p>
									</td>
								</tr>
								
								<tr>
									<td>
										<p>
											<span style="color: rgb(0, 0, 0);">Modelo:</span>
											<span style="color: rgb(0, 0, 0);text-decoration: underline;">[VEHICULO_MODELO] </span>
										</p>
									</td>
									<td>
										<p>
											<span style="color: rgb(0, 0, 0);">Estado procedencia:</span>
											<span style="color: rgb(0, 0, 0);text-decoration: underline;">[VEHICULO_ESTADO]</span>
										</p>
									</td>
									<td>
										<p>
											<span style="color: rgb(0, 0, 0);">Linea:</span>
											<span style="color: rgb(0, 0, 0);text-decoration: underline;">[VEHICULO_LINEA]</span>
										</p>
									</td>
								</tr>
								<tr>
								 <td>
									<p>
										<span style="color: rgb(0, 0, 0);">Color:</span>
										<span style="color: rgb(0, 0, 0);text-decoration: underline;">[VEHICULO_COLOR] </span>
									</p>
								</td>
								<td>
									<p>
										<span style="color: rgb(0, 0, 0);">Comentarios:</span>
										<span style="color: rgb(0, 0, 0);text-decoration: underline;">[VEHICULO_COMENTARIOS]</span>
									</p>
								</td>
								</tr>
								<tr>
									<td>
										<p>
											<span style="color: rgb(0, 0, 0);">Clase:</span>
											<span style="color: rgb(0, 0, 0);text-decoration: underline;">[VEHICULO_CLASE] </span>
										</p>
									</td>
								
								</tr>
								<tr>
									<td>
										<p>
											<span style="color: rgb(0, 0, 0);">Tipo:</span>
											<span style="color: rgb(0, 0, 0);text-decoration: underline;">[VEHICULO_TIPO] </span>
										</p>
									</td>
								
								</tr>
								</tbody>
								</table> [TABLA_VEHICULOS]',
							$data->plantilla
						);
					}
					$data->plantilla = str_replace('[VEHICULO_PLACAS]', $vehiculos->PLACAS ? $vehiculos->PLACAS : '-', $data->plantilla);
					$data->plantilla = str_replace('[VEHICULO_SERIE]',  $vehiculos->NUMEROSERIE ? $vehiculos->NUMEROSERIE : '-', $data->plantilla);
					$data->plantilla = str_replace('[VEHICULO_MARCA]', $vehiculos->MARCADESCR ? $vehiculos->MARCADESCR : '-', $data->plantilla);
					$data->plantilla = str_replace('[VEHICULO_MODELO]',  $vehiculos->MODELODESCR ? $vehiculos->MODELODESCR : '-', $data->plantilla);
					$data->plantilla = str_replace('[VEHICULO_ESTADO]', $estadoV ? $estadoV->ESTADODESCR : '-', $data->plantilla);
					$data->plantilla = str_replace('[VEHICULO_LINEA]',  $vehiculos->ANOVEHICULO ? $vehiculos->ANOVEHICULO : '-', $data->plantilla);
					$data->plantilla = str_replace('[VEHICULO_COLOR]', $color ? $color->VEHICULOCOLORDESCR : '-', $data->plantilla);
					$data->plantilla = str_replace('[VEHICULO_COMENTARIOS]',  $vehiculos->SENASPARTICULARES ? $vehiculos->SENASPARTICULARES : '-', $data->plantilla);
					$data->plantilla = str_replace('[VEHICULO_CLASE]', $linea ? $linea->VEHICULOVERSIONDESCR : '-', $data->plantilla);
					$data->plantilla = str_replace('[VEHICULO_TIPO]',  $tipo ? $tipo->VEHICULOTIPODESCR : '-', $data->plantilla);
				}
			} else {
				$data->plantilla = str_replace(
					'[TABLA_VEHICULOS]',
					'NO HAY VEHÍCULOS SOSPECHOSOS',
					$data->plantilla
				);
			}
			// Se crean tablas iterativas de los delitos involucrados
			if ($data->delitosModalidadFiltro) {
				foreach ($data->delitosModalidadFiltro as $key => $delitos) {
					$data->plantilla = str_replace(
						'[TABLA_DELITOS]',
						'[TABLA_DELITOS]' . $key,
						$data->plantilla
					);
					if ($delitos == end($data->delitosModalidadFiltro)) {
						$data->plantilla = str_replace(
							'[TABLA_DELITOS]' . $key,
							'<hr></hr><table width="100%" border="0" cellspacing="0" cellpadding="0" >
							<tbody>
								<tr>
								 <td>
									<p>
										<span style="color: rgb(0, 0, 0);text-decoration: underline;">[DELITO_DESCR] </span>
									</p>
								</td>
							
							
							
							</tr>
							</tbody>
							</table><hr></hr>',
							$data->plantilla
						);
					} else {
						$data->plantilla = str_replace(
							'[TABLA_DELITOS]' . $key,
							'<hr></hr><table width="100%" border="0" cellspacing="0" cellpadding="0" >
							<tbody>
								<tr>
								 <td>
									<p>
										<span style="color: rgb(0, 0, 0);text-decoration: underline;">[DELITO_DESCR] </span>
									</p>
								</td>
							
							
							</tr>
							</tbody>
							</table>[TABLA_DELITOS] ',
							$data->plantilla
						);
					}
					$data->plantilla = str_replace('[DELITO_DESCR]',  $delitos['DELITOMODALIDADDESCR'] ?   $delitos['DELITOMODALIDADDESCR'] : '-', $data->plantilla);
					$data->plantilla = str_replace('[ESTATUS_DELITO]',  '-', $data->plantilla);
				}
			}
			// Se crean tablas iterativas de los imputados registrados

			if ($data->imputados_da) {
				foreach ($data->imputados_da as $key => $imputados) {
					$data->mediaFiiacionImp = $this->_folioMediaFiliacionRead->asObject()->where('FOLIOID', $folio)->where('PERSONAFISICAID', $imputados->PERSONAFISICAID)->first();
					$colorOjos = $this->_ojoColorModelRead->asObject()->where('OJOCOLORID', $data->mediaFiiacionImp->OJOCOLORID)->first();
					$colorCabello = $this->_cabelloColorModelRead->asObject()->where('CABELLOCOLORID', $data->mediaFiiacionImp->CABELLOCOLORID)->first();
					$complexion = $this->_figuraModelRead->asObject()->where('FIGURAID', $data->mediaFiiacionImp->FIGURAID)->first();
					$colorPiel = $this->_pielColorModelRead->asObject()->where('PIELCOLORID', $data->mediaFiiacionImp->PIELCOLORID)->first();
					$data->plantilla = str_replace(
						'[TABLA_IMPUTADOS]',
						'[TABLA_IMPUTADOS]' . $key,
						$data->plantilla
					);

					if ($imputados == end($data->imputados_da)) {
						$data->plantilla = str_replace(
							'[TABLA_IMPUTADOS]' . $key,
							'<hr></hr><table width="100%" border="0" cellspacing="0" cellpadding="0" >
							<tbody>
								<tr>
								 <td colspan="2">
									<p>
										<span style="color: rgb(0, 0, 0);">Nombre:</span>
										<span style="color: rgb(0, 0, 0);text-decoration: underline;">[IMPUTADO_NOMBRE_DA] </span>
									</p>
								</td>
								<td colspan="2">
									<p >
										<span style="color: rgb(0, 0, 0);">Apodo:</span>
										<span style="color: rgb(0, 0, 0);text-decoration: underline;">[IMPUTADO_APODO]</span>
									</p>
								</td>
							</tr>
							
							<tr>
							 <td>
								<p>
									<span style="color: rgb(0, 0, 0);">Alias:</span>
									<span style="color: rgb(0, 0, 0);text-decoration: underline;">[IMPUTADO_ALIAS] </span>
								</p>
							</td>
							<td>
								<p>
									<span style="color: rgb(0, 0, 0);">Estatura:</span>
									<span style="color: rgb(0, 0, 0);text-decoration: underline;">[IMPUTADO_ESTATURA]</span>
								</p>
							</td>
							<td>
								<p>
									<span style="color: rgb(0, 0, 0);">Sexo:</span>
									<span style="color: rgb(0, 0, 0);text-decoration: underline;">[IMPUTADO_SEXO]</span>
								</p>
							</td>
							<td>
								<p>
									<span style="color: rgb(0, 0, 0);">Usa anteojos:</span>
									<span style="color: rgb(0, 0, 0);text-decoration: underline;">[IMPUTADO_ANTEOJOS]</span>
								</p>
							</td>
							</tr>
							<tr>
							 <td>
								<p>
									<span style="color: rgb(0, 0, 0);">Color Ojos:</span>
									<span style="color: rgb(0, 0, 0);text-decoration: underline;">[IMPUTADO_COLOR_OJOS] </span>
								</p>
							</td>
							<td>
								<p>
									<span style="color: rgb(0, 0, 0);">Color Cabello:</span>
									<span style="color: rgb(0, 0, 0);text-decoration: underline;">[IMPUTADO_COLOR_CABELLO]</span>
								</p>
							</td>
							<td>
								<p>
									<span style="color: rgb(0, 0, 0);">Complexión:</span>
									<span style="color: rgb(0, 0, 0);text-decoration: underline;">[IMPUTADO_COMPLEXION]</span>
								</p>
							</td>
								<td >
									<p>
										<span style="color: rgb(0, 0, 0);">Edad:</span>
										<span style="color: rgb(0, 0, 0);text-decoration: underline;">[IMPUTADO_EDAD_DA]</span>
									</p>
								</td>
							</tr>
							<tr>
							 <td colspan="2">
								<p>
									<span style="color: rgb(0, 0, 0);">Desc. Fisica:</span>
									<span style="color: rgb(0, 0, 0);text-decoration: underline;">[IMPUTADO_DESCRIPCION] </span>
								</p>
							</td>
							<td colspan="2">
								<p>
									<span style="color: rgb(0, 0, 0);">Color Piel:</span>
									<span style="color: rgb(0, 0, 0);text-decoration: underline;">[IMPUTADO_COLOR_PIEL] </span>
								</p>
							</td>
							</tr>
							<tr>
							
								<td>
									<p>
										<span style="color: rgb(0, 0, 0);">Localización:</span>
										<span style="color: rgb(0, 0, 0);text-decoration: underline;">[IMPUTADO_LOCALIZACION]</span>
									</p>
								</td>
							</tr>
							</tbody>
							</table><hr></hr>',
							$data->plantilla
						);
					} else {

						$data->plantilla = str_replace(
							'[TABLA_IMPUTADOS]' . $key,
							'<hr></hr><table width="100%" border="0" cellspacing="0" cellpadding="0">
						<tbody>
							<tr>
							 <td colspan="2">
								<p>
									<span style="color: rgb(0, 0, 0);">Nombre:</span>
									<span style="color: rgb(0, 0, 0);text-decoration: underline;">[IMPUTADO_NOMBRE_DA] </span>
								</p>
							</td>
							<td colspan="2">
								<p >
									<span style="color: rgb(0, 0, 0);">Apodo:</span>
									<span style="color: rgb(0, 0, 0);text-decoration: underline;">[IMPUTADO_APODO]</span>
								</p>
							</td>
						</tr>
						
						<tr>
						 <td>
							<p>
								<span style="color: rgb(0, 0, 0);">Alias:</span>
								<span style="color: rgb(0, 0, 0);text-decoration: underline;">[IMPUTADO_ALIAS] </span>
							</p>
						</td>
						<td>
							<p>
								<span style="color: rgb(0, 0, 0);">Estatura:</span>
								<span style="color: rgb(0, 0, 0);text-decoration: underline;">[IMPUTADO_ESTATURA]</span>
							</p>
						</td>
						<td>
							<p>
								<span style="color: rgb(0, 0, 0);">Sexo:</span>
								<span style="color: rgb(0, 0, 0);text-decoration: underline;">[IMPUTADO_SEXO]</span>
							</p>
						</td>
						<td>
							<p>
								<span style="color: rgb(0, 0, 0);">Usa anteojos:</span>
								<span style="color: rgb(0, 0, 0);text-decoration: underline;">[IMPUTADO_ANTEOJOS]</span>
							</p>
						</td>
						</tr>
						<tr>
						 <td>
							<p>
								<span style="color: rgb(0, 0, 0);">Color Ojos:</span>
								<span style="color: rgb(0, 0, 0);text-decoration: underline;">[IMPUTADO_COLOR_OJOS] </span>
							</p>
						</td>
						<td>
							<p>
								<span style="color: rgb(0, 0, 0);">Color Cabello:</span>
								<span style="color: rgb(0, 0, 0);text-decoration: underline;">[IMPUTADO_COLOR_CABELLO]</span>
							</p>
						</td>
						<td>
							<p>
								<span style="color: rgb(0, 0, 0);">Complexión:</span>
								<span style="color: rgb(0, 0, 0);text-decoration: underline;">[IMPUTADO_COMPLEXION]</span>
							</p>
						</td>
						  
							<td >
								<p>
									<span style="color: rgb(0, 0, 0);">Edad:</span>
									<span style="color: rgb(0, 0, 0);text-decoration: underline;">[IMPUTADO_EDAD_DA]</span>
								</p>
							</td>
						</tr>
						<tr>
						 <td colspan="2">
							<p>
								<span style="color: rgb(0, 0, 0);">Desc. Fisica:</span>
								<span style="color: rgb(0, 0, 0);text-decoration: underline;">[IMPUTADO_DESCRIPCION] </span>
							</p>
						</td>
						<td colspan="2">
							<p>
								<span style="color: rgb(0, 0, 0);">Color Piel:</span>
								<span style="color: rgb(0, 0, 0);text-decoration: underline;">[IMPUTADO_COLOR_PIEL] </span>
							</p>
						</td>
						</tr>
						<tr>
						
							<td>
								<p>
									<span style="color: rgb(0, 0, 0);">Localización:</span>
									<span style="color: rgb(0, 0, 0);text-decoration: underline;">[IMPUTADO_LOCALIZACION]</span>
								</p>
							</td>
						</tr>
						</tbody>
						</table>
						[TABLA_IMPUTADOS]',
							$data->plantilla
						);
					}
					$data->plantilla = str_replace('[IMPUTADO_NOMBRE_DA]',  $imputados->NOMBRE, $data->plantilla);
					$data->plantilla = str_replace('[IMPUTADO_APODO]',  $imputados->APODO ? $imputados->APODO : '', $data->plantilla);
					$data->plantilla = str_replace('[IMPUTADO_ALIAS]',  $imputados->APODO ? $imputados->APODO : '', $data->plantilla);
					$data->plantilla = str_replace('[IMPUTADO_ESTATURA]',  $data->mediaFiiacionImp->ESTATURA ? $data->mediaFiiacionImp->ESTATURA : '', $data->plantilla);
					$data->plantilla = str_replace('[IMPUTADO_SEXO]',  $imputados->SEXO ? $imputados->SEXO : '', $data->plantilla);
					$data->plantilla = str_replace('[IMPUTADO_ANTEOJOS]', 'S/N', $data->plantilla);
					$data->plantilla = str_replace('[IMPUTADO_COLOR_OJOS]',  $colorOjos ? $colorOjos->OJOCOLORDESCR : '', $data->plantilla);
					$data->plantilla = str_replace('[IMPUTADO_COLOR_CABELLO]',  $colorCabello != null ? $colorCabello->CABELLOCOLORDESCR : '', $data->plantilla);
					$data->plantilla = str_replace('[IMPUTADO_COMPLEXION]',  $complexion ? $complexion->FIGURADESCR : '', $data->plantilla);
					$data->plantilla = str_replace('[IMPUTADO_EDAD_DA]',  $imputados->EDADCANTIDAD ? $imputados->EDADCANTIDAD : '', $data->plantilla);
					$data->plantilla = str_replace('[IMPUTADO_DESCRIPCION]',  '', $data->plantilla);
					$data->plantilla = str_replace('[IMPUTADO_COLOR_PIEL]',  $colorPiel ? $colorPiel->PIELCOLORDESCR : '', $data->plantilla);
					$data->plantilla = str_replace('[IMPUTADO_LOCALIZACION]',  '', $data->plantilla);
					// $plantilla =  $this->_plantillasModel->where('TITULO', $titulo)->first();
					// $com =	array_push($data->plantilla, $plantilla);
				}
			}
		}

		// Info de los delitos registrados
		if ($relacionfisfis != null) {
			$data->relacion_delitodescr = $this->_delitoModalidadModelRead->asObject()->where('DELITOMODALIDADID', $relacionfisfis->DELITOMODALIDADID)->first();
			$data->plantilla = str_replace('[DELITO_NOMBRE]',  $data->relacion_delitodescr->DELITOMODALIDADDESCR ?  $data->relacion_delitodescr->DELITOMODALIDADDESCR : '-', $data->plantilla);
			$data->plantilla = str_replace('[NUMERO_CODIGO_PENAL]', ($data->relacion_delitodescr->DELITOMODALIDADARTICULO ?  $data->relacion_delitodescr->DELITOMODALIDADARTICULO : '[NUMERO_CODIGO_PENAL]'), $data->plantilla);
		}

		//Info de las umas registradas
		if ($uma == 'MEXICALI - CD MORELOS') {
			$data->plantilla = str_replace('[DOMICILIO_INSTALACION]', 'CALZADA LÁZARO CÁRDENAS S/N. A UN COSTADO DE WELTON, EN CIUDAD MORELOS.', $data->plantilla);
			$data->plantilla = str_replace('[TELEFONO_UJAP]', '(658) 514-84-74 EXT. 7530, 7531, 7532, 7533, 7534 Y 7535.(658) 514-83-60 EXT. 7558, 7562, 7568, 7569 Y 7570', $data->plantilla);
		} else if ($uma == 'MEXICALI - GPE VICTORIA') {
			$data->plantilla = str_replace('[DOMICILIO_INSTALACION]', 'LOCAL 11 Y 12 DE LA PLAZA DEL CARMEN DE AVENIDA HÉROES DE CHAPULTEPEC Y CALLE 10, GUADALUPE VICTORIA.', $data->plantilla);
			$data->plantilla = str_replace('[TELEFONO_UJAP]', '(658) 516-43-79', $data->plantilla);
		} else if ($uma == 'MEXICALI - ORIENTE') {
			$data->plantilla = str_replace('[DOMICILIO_INSTALACION]', 'CENTRO DE JUSTICIA ORIENTE, ANKERITA Y ORTOZA S/N FRAC. PEDREGAL TURQUEZA.', $data->plantilla);
			$data->plantilla = str_replace('[TELEFONO_UJAP]', '(686) 689-00-30 EXT 7446, 7406, 7447', $data->plantilla);
		} else if ($uma == 'MEXICALI - PONIENTE (ANAHUAC)') {
			$data->plantilla = str_replace('[DOMICILIO_INSTALACION]', 'CALZADA HÉCTOR TERÁN TERÁN Y BOULEVARD ANÁHUAC S/N.', $data->plantilla);
			$data->plantilla = str_replace('[TELEFONO_UJAP]', '(686) 904-66-00 EXT 7754', $data->plantilla);
		} else if ($uma == 'MEXICALI - RIO NUEVO') {
			$data->plantilla = str_replace('[DOMICILIO_INSTALACION]', 'CALZADA DE LOS PRESIDENTES #1185, FRACC. RIO NUEVO.', $data->plantilla);
			$data->plantilla = str_replace('[TELEFONO_UJAP]', '(686) 904-66-01, EXT: 4612, 4703, 4710, 4770, 8782, 4789.', $data->plantilla);
		} else if ($uma == 'MEXICALI - SAN FELIPE') {
			$data->plantilla = str_replace('[DOMICILIO_INSTALACION]', 'AVENIDA MAR DE CORTES Y CALLE MANZANILLO SIN NUMERO, ZONA CENTRO, SAN FELIPE, BAJA CALIFORNIA.', $data->plantilla);
			$data->plantilla = str_replace('[TELEFONO_UJAP]', '(686) 577-17-63 EXT: 7477, 4705, 4770, 4702', $data->plantilla);
		} else if ($uma == 'ENSENADA - SAN QUINTIN') {
			$data->plantilla = str_replace('[DOMICILIO_INSTALACION]', 'CALLE DECIMA NUMERO 131, FRACC. CIUDAD DE SAN QUINTIN.', $data->plantilla);
			$data->plantilla = str_replace('[TELEFONO_UJAP]', '616 165 2915 EXT. 3910', $data->plantilla);
		} else if ($uma == 'ENSENADA - PRADERAS DEL CIPRES') {
			$data->plantilla = str_replace('[DOMICILIO_INSTALACION]', 'AVENIDA MANUEL AVILA CAMACHO S/N PRADERAS DEL CIPRES (ATRAS DE EDIFICIO DE GOBIERNO DEL ESTADO).', $data->plantilla);
			$data->plantilla = str_replace('[TELEFONO_UJAP]', '646 152 27 00 EXT 3854', $data->plantilla);
		} else if ($uma == 'ZONA COSTA - LA MESA') {
			$data->plantilla = str_replace('[DOMICILIO_INSTALACION]', 'AV.MURUA MARTINEZ S/N FRACC. CHAPULTEPEC COL. ALAMAR (a un costado de Central Camionera).', $data->plantilla);
			$data->plantilla = str_replace('[TELEFONO_UJAP]', '(664)104-76-00 Y (664)104-76-02 correo electrónico: umacosta@fgebc.gob.mx', $data->plantilla);
		} else if ($uma == 'ZONA COSTA - MARIANO MATAMOROS') {
			$data->plantilla = str_replace('[DOMICILIO_INSTALACION]', 'RUTA MARIANO MATAMOROS Y CATALINA GONZALEZ S/N COL. MARIANO MATAMOROS.', $data->plantilla);
			$data->plantilla = str_replace('[TELEFONO_UJAP]', '(664)902-18-18 UMA.COSTA@FGEBC.GOB.MX', $data->plantilla);
		} else if ($uma == 'ZONA COSTA - PLAYAS ROSARITO') {
			$data->plantilla = str_replace('[DOMICILIO_INSTALACION]', 'JOSE HAROZ AGUILAR ENTRE EDIFICIO CENTRO DE GOB., FRACC. VILLA TURISTICA.', $data->plantilla);
			$data->plantilla = str_replace('[TELEFONO_UJAP]', '', $data->plantilla);
		} else if ($uma == 'ZONA COSTA - TECATE') {
			$data->plantilla = str_replace('[DOMICILIO_INSTALACION]', 'MISION SANTA ROSALIA S/N COL. DESCANSO.', $data->plantilla);
			$data->plantilla = str_replace('[TELEFONO_UJAP]', '(665)655-04-27', $data->plantilla);
		} else if ($uma == 'ZONA COSTA - ZONA RIO') {
			$data->plantilla = str_replace('[DOMICILIO_INSTALACION]', 'BLVD. GRAL. RODOLFO SÁNCHEZ TABOADA NO. 10127, ESQUINA CON AV. RÍO TIJUANA. ZONA URBANA RÍO TIJUANA. (EDIFICIO DE CRISTALES NEGROS, PRIMER PISO).', $data->plantilla);
			$data->plantilla = str_replace('[TELEFONO_UJAP]', '664-736-52-96, correo electrónico: umacosta@fgebc.gob.mx', $data->plantilla);
		}

		//Info de la notificacion y proceso
		if ($notificacion || $proceso) {
			$data->plantilla = str_replace('[TIPO_PROCESO]',  $proceso ?  $proceso : '-', $data->plantilla);
			$data->plantilla = str_replace('[TIPO_NOTIFICACION]',  $notificacion ?  $notificacion : '-', $data->plantilla);
		}

		$relacionfisfis = $this->_relacionIDOModelRead->asObject()->where('FOLIOID', $data->folio->FOLIOID)->where('ANO', $data->folio->ANO)->where('PERSONAFISICAIDVICTIMA', $victima)->where('PERSONAFISICAIDIMPUTADO', $imputado)->first();

		if ($relacionfisfis != null) {
			//Info del delito seleccionado por el MP
			$data->relacion_delitodescr = $this->_delitoModalidadModelRead->asObject()->where('DELITOMODALIDADID', $relacionfisfis->DELITOMODALIDADID)->first();

			$data->plantilla = str_replace('[DELITO_NOMBRE]',  $data->relacion_delitodescr->DELITOMODALIDADDESCR ?  $data->relacion_delitodescr->DELITOMODALIDADDESCR : '-', $data->plantilla);
			$data->plantilla = str_replace('[NUMERO_CODIGO_PENAL]', ($data->relacion_delitodescr->DELITOMODALIDADARTICULO ?  $data->relacion_delitodescr->DELITOMODALIDADARTICULO : '[NUMERO_CODIGO_PENAL]'), $data->plantilla);
		}

		/**
		 * Informacion del folio y personas fisicas
		 */
		$data->estado = $this->_estadosModelRead->asObject()->where('ESTADOID', $data->folio->ESTADOID)->first();
		$data->lugar_hecho = $data->folio->HECHOLUGARID ? $this->_hechoLugarModelRead->asObject()->where('HECHOLUGARID', $data->folio->HECHOLUGARID)->first() : (object)['HECHOLUGARDESCR' => 'NO ESPECIFICADO'];
		$data->derivacion = $this->_derivacionesAtencionesModelRead->asObject()->where('MUNICIPIOID', $data->folio->INSTITUCIONREMISIONMUNICIPIOID)->where('INSTITUCIONREMISIONID',  $data->folio->INSTITUCIONREMISIONID)->first();
		$data->canalizacion = $this->_canalizacionesAtencionesModelRead->asObject()->where('MUNICIPIOID', $data->folio->INSTITUCIONREMISIONMUNICIPIOID)->where('INSTITUCIONREMISIONID',  $data->folio->INSTITUCIONREMISIONID)->first();
		$data->bandejaRac = $this->_bandejaRacModelRead->asObject()->where('ANO', $year)->where('FOLIOID', $folio)->first();
		$data->municipios = $this->_municipiosModelRead->asObject()->where('ESTADOID', '2')->where('MUNICIPIOID',  $data->folio->MUNICIPIOID)->first();
		$data->victima = $this->_folioPersonaFisicaModelRead->get_by_personas($data->folio->FOLIOID, $data->folio->ANO, $victima);
		$data->imputado = $this->_folioPersonaFisicaModelRead->asObject()->where('FOLIOID', $data->folio->FOLIOID)->where('ANO', $data->folio->ANO)->where('PERSONAFISICAID', $imputado)->first();
		$data->victimaDom = $this->_folioPersonaFisicaDomicilioModelRead->asObject()->where('FOLIOID', $data->folio->FOLIOID)->where('ANO', $data->folio->ANO)->where('PERSONAFISICAID', $victima)->first();
		$data->imputadoDom = $this->_folioPersonaFisicaDomicilioModelRead->asObject()->where('FOLIOID', $data->folio->FOLIOID)->where('ANO', $data->folio->ANO)->where('PERSONAFISICAID', $imputado)->first();
		$data->estadoVictima = $this->_estadosModelRead->asObject()->where('ESTADOID',  $data->victimaDom->ESTADOID)->first();
		$data->tipoIdentificacionVictima = $this->_tipoIdentificacionModelRead->asObject()->where('PERSONATIPOIDENTIFICACIONID',   $data->victima[0]['TIPOIDENTIFICACIONID'])->first();
		$data->ocupacionVictima = $this->_ocupacionModelRead->asObject()->where('PERSONAOCUPACIONID',   $data->victima[0]['OCUPACIONID'])->first();
		$data->nacionalidadVictima = $this->_nacionalidadModelRead->asObject()->where('PERSONANACIONALIDADID',   $data->victima[0]['NACIONALIDADID'])->first();
		$data->edoCivilVictima = $this->_estadoCivilModelRead->asObject()->where('PERSONAESTADOCIVILID',   $data->victima[0]['ESTADOCIVILID'])->first();
		$data->municipio_imp = $this->_municipiosModelRead->asObject()->where('ESTADOID',  $data->imputadoDom->ESTADOID)->where('MUNICIPIOID',  $data->imputadoDom->MUNICIPIOID)->first();
		$data->estado_imp = $this->_estadosModelRead->asObject()->where('ESTADOID',  $data->imputadoDom->ESTADOID)->first();

		//CITATORIO
		if ($data->bandejaRac) {
			if ($data->bandejaRac->TIPOPROCEDIMIENTOID == 1) {
				$data->plantilla = str_replace('[TIPO_PROCESO]', 'MEDIACIÓN', $data->plantilla);
			} else if ($data->bandejaRac->TIPOPROCEDIMIENTOID == 2) {
				$data->plantilla = str_replace('[TIPO_PROCESO]', 'CONCILIACIÓN', $data->plantilla);
			} else {
				$data->plantilla = str_replace('[TIPO_PROCESO]', 'JUSTICIA RESTAURATIVA', $data->plantilla);
			}
		}

		//Replace consumiendo los datos anteriores
		$data->plantilla = str_replace('[DOCUMENTO_FECHA]', date('d') . ' DE ' . $meses[date('n') - 1] . " DEL " . date('Y'), $data->plantilla);
		$data->plantilla = str_replace('[DOCUMENTO_CIUDAD]', $data->municipios->MUNICIPIODESCR, $data->plantilla);
		$data->plantilla = str_replace('[VICTIMA_NOMBRE]', $data->victima[0]['NOMBRE'] . ' ' . ($data->victima[0]['PRIMERAPELLIDO'] ? $data->victima[0]['PRIMERAPELLIDO'] : '') . ' ' . ($data->victima[0]['SEGUNDOAPELLIDO'] ? $data->victima[0]['SEGUNDOAPELLIDO'] : ''), $data->plantilla);
		$data->plantilla = str_replace('[VICTIMA_EDAD]', $data->victima[0]['EDADCANTIDAD'] ? $data->victima[0]['EDADCANTIDAD'] : '-', $data->plantilla);
		$data->plantilla = str_replace('[VICTIMA_TELEFONO]', ($data->victima[0]['TELEFONO'] ? $data->victima[0]['TELEFONO'] : '-') . ($data->victima[0]['TELEFONO2'] ? ' y con teléfono secundario ' . $data->victima[0]['TELEFONO2'] : ''), $data->plantilla);
		$data->plantilla = str_replace('[VICTIMA_CORREO]', $data->victima[0]['CORREO'] ? $data->victima[0]['CORREO'] : '-', $data->plantilla);
		$data->plantilla = str_replace('[VICTIMA_SEXO]', $data->victima[0]['SEXO'] ? ($data->victima[0]['SEXO'] == 'F' ? 'FEMENINO' : 'MASCULINO') : '-', $data->plantilla);

		$data->plantilla = str_replace('[IMPUTADO_NOMBRE]', $data->imputado->NOMBRE . ' ' . ($data->imputado->PRIMERAPELLIDO ? $data->imputado->PRIMERAPELLIDO : '') . ' ' . ($data->imputado->SEGUNDOAPELLIDO ? $data->imputado->SEGUNDOAPELLIDO : ''), $data->plantilla);
		$data->plantilla = str_replace('[IMPUTADO_EDAD]', $data->imputado->EDADCANTIDAD ? $data->imputado->EDADCANTIDAD : '-', $data->plantilla);
		$data->plantilla = str_replace('[DIA]', date('d'), $data->plantilla);
		$data->plantilla = str_replace('[MES]', $meses[date('n') - 1], $data->plantilla);
		$data->plantilla = str_replace('[ANO]', date('Y'), $data->plantilla);
		$data->plantilla = str_replace('[HORA]', date('H'), $data->plantilla);
		$data->plantilla = str_replace('[MINUTOS]', date('i'), $data->plantilla);

		$data->plantilla = str_replace('[ESTADO]', $data->municipios->MUNICIPIODESCR, $data->plantilla);
		$data->plantilla = str_replace('[MUNICIPIO_DELITO]', $data->municipio_delito ? $data->municipio_delito->MUNICIPIODESCR : '', $data->plantilla);
		$data->plantilla = str_replace('[LOCALIDAD_DELITO]', $data->localidad ? $data->localidad->LOCALIDADDESCR : '', $data->plantilla);
		$data->plantilla = str_replace('[COLONIA_DELITO]', $data->folio->HECHOCOLONIADESCR ? $data->folio->HECHOCOLONIADESCR : 'SIN COLONIA', $data->plantilla);
		$data->plantilla = str_replace('[REFERENCIAS]', $data->folio->HECHOREFERENCIA ? $data->folio->HECHOREFERENCIA : 'SIN DATOS DE REFERENCIA', $data->plantilla);
		$data->plantilla = str_replace('[CALLE]', $data->folio->HECHOCALLE ? $data->folio->HECHOCALLE : 'SIN CALLE', $data->plantilla);

		$data->plantilla = str_replace('[EXTERIOR]', $data->folio->HECHONUMEROCASA ? $data->folio->HECHONUMEROCASA : 'S/N', $data->plantilla);

		$data->plantilla = str_replace(
			'[DIRECCION]',
			($data->folio->HECHOCALLE ? $data->folio->HECHOCALLE : 'SIN CALLE') . ' ' .
				($data->folio->HECHONUMEROCASA ? $data->folio->HECHONUMEROCASA : 'S/N')  . ',' .
				($data->folio->HECHOCOLONIADESCR ? $data->folio->HECHOCOLONIADESCR : 'SIN COLONIA') . ',' .
				(isset($data->localidad) ? $data->localidad->LOCALIDADDESCR : 'SIN LOCALIDAD') . ',' .
				(isset($data->municipio_delito) ? $data->municipio_delito->MUNICIPIODESCR : 'SIN MUNICIPIO'),
			$data->plantilla
		);
		$data->plantilla = str_replace(
			'[DIRECCION]',
			($data->folio->HECHOCALLE ? $data->folio->HECHOCALLE : 'SIN CALLE') . ' ' .
				($data->folio->HECHONUMEROCASA ? $data->folio->HECHONUMEROCASA : 'S/N')  . ',' .
				($data->folio->HECHOCOLONIADESCR ? $data->folio->HECHOCOLONIADESCR : 'SIN COLONIA') . ',' .
				(isset($data->localidad) ? $data->localidad->LOCALIDADDESCR : 'SIN LOCALIDAD') . ',' .
				(isset($data->municipio_delito) ? $data->municipio_delito->MUNICIPIODESCR : 'SIN MUNICIPIO'),
			$data->plantilla
		);

		$data->plantilla = str_replace('[LUGAR_HECHO]', $data->lugar_delito->HECHODESCR, $data->plantilla);

		$data->plantilla = str_replace('[HECHO]', $data->folio->HECHONARRACION ? $data->folio->HECHONARRACION : 'SIN NARRACIÓN', $data->plantilla);

		$data->plantilla = str_replace('[HECHO_LUGAR]', $data->lugar_hecho->HECHODESCR ? $data->lugar_hecho->HECHODESCR : '-', $data->plantilla);
		$data->plantilla = str_replace('[HECHO_FECHA]', $data->folio->HECHOFECHA ? $data->folio->HECHOFECHA : '-', $data->plantilla);
		$data->plantilla = str_replace('[HECHO_HORA]', $data->folio->HECHOHORA ? $data->folio->HECHOHORA : '-', $data->plantilla);
		$data->plantilla = str_replace('[DETALLE_INTERVENCIONES]', $data->folio->HECHONARRACION ? $data->folio->HECHONARRACION : 'SIN NARRACIÓN', $data->plantilla);
		$data->plantilla = str_replace('[HECHO_NARRACION]', $data->folio->HECHONARRACION ? $data->folio->HECHONARRACION : 'SIN NARRACIÓN', $data->plantilla);
		$data->plantilla = str_replace('[ZONA_JAP]',  'CENTRO DE DENUNCIA TECNOLÓGICA', $data->plantilla);

		$data->plantilla = str_replace('[VICTIMA_DOMICILIO]', 'en: ' . ($data->victimaDom->CALLE ? $data->victimaDom->CALLE : 'DESCONOCIDO') . ($data->victimaDom->NUMEROCASA ? ' Ext. ' . $data->victimaDom->NUMEROCASA : '') . ($data->victimaDom->NUMEROINTERIOR ? ' Int. ' . $data->victimaDom->NUMEROINTERIOR : '') . ($data->victimaDom->COLONIADESCR ? ' ' . $data->victimaDom->COLONIADESCR : '') . (isset($data->municipioVictima) == true ? ' ' . $data->municipioVictima->MUNICIPIODESCR : '') . (isset($data->estadoVictima) == true ? ' ' . $data->estadoVictima->ESTADODESCR : ''), $data->plantilla);
		$data->plantilla = str_replace('[VICTIMA_DOMICILIO_COMPLETO]', ($data->victimaDom->CALLE ? $data->victimaDom->CALLE : 'DESCONOCIDO') . ($data->victimaDom->NUMEROCASA ? ' Ext. ' . $data->victimaDom->NUMEROCASA : '') . ($data->victimaDom->NUMEROINTERIOR ? ' Int. ' . $data->victimaDom->NUMEROINTERIOR : '') . ($data->victimaDom->COLONIADESCR ? ' ' . $data->victimaDom->COLONIADESCR : '') . (isset($data->municipioVictima) == true ? ' ' . $data->municipioVictima->MUNICIPIODESCR : '') . (isset($data->estadoVictima) == true ? ' ' . $data->estadoVictima->ESTADODESCR : ''), $data->plantilla);
		$data->plantilla = str_replace('[VICTIMA_TIPO_IDENTIFICACION]', isset($data->tipoIdentificacionVictima) == true ? $data->tipoIdentificacionVictima->PERSONATIPOIDENTIFICACIONDESCR : 'DESCONOCIDO', $data->plantilla);
		$data->plantilla = str_replace('[VICTIMA_NUMERO_IDENTIFICACION]', $data->victima[0]['NUMEROIDENTIFICACION'] ? $data->victima[0]['NUMEROIDENTIFICACION'] : '', $data->plantilla);
		$data->plantilla = str_replace('[VICTIMA_TELEFONO_CELULAR]', $data->victima[0]['TELEFONO'] ? $data->victima[0]['TELEFONO'] : 'DESCONOCIDO', $data->plantilla);
		$data->plantilla = str_replace('[VICTIMA_OCUPACION]', isset($data->ocupacionVictima) == true ? $data->ocupacionVictima->PERSONAOCUPACIONDESCR : 'DESCONOCIDO', $data->plantilla);
		$data->plantilla = str_replace('[VICTIMA_NACIONALIDAD]', isset($data->nacionalidadVictima) == true ? $data->nacionalidadVictima->PERSONANACIONALIDADDESCR : 'DESCONOCIDO', $data->plantilla);
		$data->plantilla = str_replace('[VICTIMA_ESTADO_CIVIL]', isset($data->edoCivilVictima) == true ? $data->edoCivilVictima->PERSONAESTADOCIVILDESCR : 'DESCONOCIDO', $data->plantilla);
		$data->plantilla = str_replace('[IMPUTADO_DOMICILIO_COMPLETO]', ($data->imputadoDom->CALLE ? $data->imputadoDom->CALLE : 'DESCONOCIDO') . ' EXT. ' . ($data->imputadoDom->NUMEROCASA ? $data->imputadoDom->NUMEROCASA : '') . ' INT. ' . ($data->imputadoDom->NUMEROINTERIOR ? $data->imputadoDom->NUMEROINTERIOR : '') . ' ' . $data->imputadoDom->COLONIADESCR . ($data->municipio_imp ? $data->municipio_imp->MUNICIPIODESCR : '') . ' ' . ($data->estado_imp ? $data->estado_imp->ESTADODESCR : ''), $data->plantilla);
		$hecho_info = '<p><b>FOLIO:</b> ' . $data->folio->FOLIOID . '</p><p><b>AÑO:</b> ' . $data->folio->ANO . '</p><p><b>FECHA DEL HECHO:</b> ' . $data->folio->HECHOFECHA . '</p><p><b>HORA DEL HECHO:</b> ' . $data->folio->HECHOHORA . '</p><p><b>CALLE DEL HECHO:</b> ' . $data->folio->HECHOCALLE . ' EXT.' . $data->folio->HECHONUMEROCASA . ' INT.' . $data->folio->HECHONUMEROCASAINT . ' ' . $data->municipios->MUNICIPIODESCR . '</p><p><b>NARRACIÓN DEL HECHO:</b> ' . $data->folio->HECHONARRACION . '</p><p><b>NOTAS DEL AGENTE:</b> ' . $data->folio->NOTASAGENTE . '</p>';
		$hecho_info = $hecho_info .
			'<br><p><b>DENUNCIANTE: </b> ' .
			'</p><p><b> NOMBRE: </b> ' . $data->denunciante->NOMBRE . ' ' . ($data->denunciante->PRIMERAPELLIDO ? $data->denunciante->PRIMERAPELLIDO : '') . ' ' . ($data->denunciante->SEGUNDOAPELLIDO ? $data->denunciante->SEGUNDOAPELLIDO : '') .
			'<b> FECHA DE NACIMIENTO: </b> ' . ($data->denunciante->FECHANACIMIENTO ? $data->denunciante->FECHANACIMIENTO  : '-') .
			'<b> LUGAR DE NACIMIENTO: </b>' .  (isset($data->denuncianteMunicipioNac) == true ? ' ' . $data->denuncianteMunicipioNac->MUNICIPIODESCR : '') . (isset($data->denuncianteEstadoNac) == true ? ' ' . $data->denuncianteEstadoNac->ESTADODESCR : '') .
			'<b> TELÉFONO: </b> ' . ($data->denunciante->TELEFONO ? $data->denunciante->TELEFONO  : '-') .
			'<b> CORREO: </b> ' . ($data->denunciante->CORREO ? $data->denunciante->CORREO  : '-') .
			'<b> TIPO DE IDENTIFICACIÓN: </b> ' . ($data->denuncianteTipoIdentificacion ? $data->denuncianteTipoIdentificacion->PERSONATIPOIDENTIFICACIONDESCR  : '-') .
			'<b> NÚMERO DE IDENTIFICACIÓN: </b> ' . ($data->denunciante->NUMEROIDENTIFICACION ? $data->denunciante->NUMEROIDENTIFICACION  : '-') . '</p>';

		if ($data->desaparecidos_da) {
			foreach ($data->desaparecidos_da as $key => $desaparecidos) {
				$data->mediaFiliacionDesaparecidos = $this->_folioMediaFiliacionRead->asObject()->where('FOLIOID', $folio)->where('PERSONAFISICAID', $desaparecidos->PERSONAFISICAID)->first();

				//Victima media filiación
				$colorOjos = $this->_ojoColorModelRead->asObject()->where('OJOCOLORID', $data->mediaFiliacionDesaparecidos->OJOCOLORID)->first();
				$colorCabello = $this->_cabelloColorModelRead->asObject()->where('CABELLOCOLORID', $data->mediaFiliacionDesaparecidos->CABELLOCOLORID)->first();
				$complexion = $this->_figuraModelRead->asObject()->where('FIGURAID', $data->mediaFiliacionDesaparecidos->FIGURAID)->first();
				$colorPiel = $this->_pielColorModelRead->asObject()->where('PIELCOLORID', $data->mediaFiliacionDesaparecidos->PIELCOLORID)->first();
				$cejasForma = $this->_cejaFormaModelRead->asObject()->where('CEJAFORMAID', $data->mediaFiliacionDesaparecidos->CEJAFORMAID)->first();
				$cabelloTamano = $this->_cabelloTamanoModelRead->asObject()->where('CABELLOTAMANOID', $data->mediaFiliacionDesaparecidos->CABELLOTAMANOID)->first();

				$hecho_info = $hecho_info .
					'<br><p><b>MEDIA FILIACIÓN DE PERSONA DESAPARECIDA: </b> ' . ($key + 1) .
					'</p><p><b> NOMBRE: </b> ' . $desaparecidos->NOMBRE . ' ' . ($desaparecidos->PRIMERAPELLIDO ? $desaparecidos->PRIMERAPELLIDO : '') . ' ' . ($desaparecidos->SEGUNDOAPELLIDO ? $desaparecidos->SEGUNDOAPELLIDO : '') .
					'<b> EDAD: </b> ' . ($desaparecidos->EDADCANTIDAD ? $desaparecidos->EDADCANTIDAD : '-') .
					'<b> FECHA DE DESAPARICIÓN: </b>' .  ($data->mediaFiliacionDesaparecidos->FECHADESAPARICION ? $data->mediaFiliacionDesaparecidos->FECHADESAPARICION : '-') .
					'<b> LUGAR DE DESAPARICIÓN: </b> ' . ($data->mediaFiliacionDesaparecidos->LUGARDESAPARICION ? $data->mediaFiliacionDesaparecidos->LUGARDESAPARICION : '') .
					'<b> ESTATURA: </b> ' . ($data->mediaFiliacionDesaparecidos->ESTATURA ?  (float)(((float)$data->mediaFiliacionDesaparecidos->ESTATURA) / 100) : '-') .
					'<b> COMPLEXIÓN: </b> ' . ($complexion ?  $complexion->FIGURADESCR : '-') .
					'<b> PESO: </b> ' . ($data->mediaFiliacionDesaparecidos->PESO ?  $data->mediaFiliacionDesaparecidos->PESO : '-') .
					'<b> TEZ: </b> ' . ($colorPiel ?  $colorPiel->PIELCOLORDESCR : '-') .
					'<b> COLOR DE OJOS: </b> ' . ($colorOjos ?  $colorOjos->OJOCOLORDESCR : '-') .
					'<b> TIPO CEJA: </b> ' . ($cejasForma ?  $cejasForma->CEJAFORMADESCR : '-') .
					'<b> SEÑAS PARTICULARES: </b> ' . ($data->mediaFiliacionDesaparecidos->SENASPARTICULARES ?  $data->mediaFiliacionDesaparecidos->SENASPARTICULARES : '-') .
					'<b> TAMAÑO DEL CABELLO: </b> ' . ($cabelloTamano ?  $cabelloTamano->CABELLOTAMANODESCR : '-')
					. '</p>';
			}
		}
		if ($data->vehiculos_da) {
			foreach ($data->vehiculos_da as $key => $vehiculos) {
				$estadoV = $this->_estadosModelRead->asObject()->where('ESTADOID',  $vehiculos->ESTADOIDPLACA)->first();
				$linea = $this->_vehiculoVersionModelRead->asObject()->where('VEHICULOVERSIONID',  $vehiculos->VEHICULOVERSIONID)->first();
				$color = $this->_coloresVehiculoModelRead->asObject()->where('VEHICULOCOLORID',  $vehiculos->PRIMERCOLORID)->first();
				$tipo = $this->_tipoVehiculoModelRead->asObject()->where('VEHICULOTIPOID',  $vehiculos->TIPOID)->first();
				$hecho_info = $hecho_info .
					'<br><p><b>VEHÍCULO: </b> ' . ($key + 1) .
					'</p><p><b> PLACAS: </b> ' . ($vehiculos->PLACAS ? $vehiculos->PLACAS : '-') .
					'<b> SERIE: </b> ' . ($vehiculos->NUMEROSERIE ? $vehiculos->NUMEROSERIE : '-') .
					'<b> MARCA: </b>' . ($vehiculos->MARCADESCR ? $vehiculos->MARCADESCR : '-') .
					'<b> MODELO: </b> ' . ($vehiculos->MODELODESCR ? $vehiculos->MODELODESCR : '-') .
					'<b> ESTADO: </b> ' . ($estadoV ? $estadoV->ESTADODESCR : '-') .
					'<b> LINEA: </b> ' . ($vehiculos->ANOVEHICULO ? $vehiculos->ANOVEHICULO : '-') .
					'<b> COLOR: </b> ' . ($color ? $color->VEHICULOCOLORDESCR  : '-') .
					'<br><b> SEÑAS PARTICULARES: </b> ' .  ($vehiculos->SENASPARTICULARES ? $vehiculos->SENASPARTICULARES : '-') .
					'<br><b> CLASE: </b> ' . ($linea ? $linea->VEHICULOVERSIONDESCR : '-') .
					'<b> TIPO: </b> ' .  ($tipo ? $tipo->VEHICULOTIPODESCR : '-' . '</p>');
			}
		}

		$data->plantilla = str_replace('[INFORMACION_DEL_HECHO]', $hecho_info, $data->plantilla);

		$data->plantilla = str_replace('[FOLIO_ATENCION]', $data->folio->FOLIOID . '/' . $data->folio->ANO, $data->plantilla);

		if (($expediente == null || $expediente == '') && ($data->folio->STATUS == 'CANALIZADO' || $data->folio->STATUS == 'DERIVADO')) {

			//CARTA DERIVACION
			if ($data->derivacion && $data->folio->STATUS == 'DERIVADO') {
				$data->plantilla = str_replace('[OFICINA_NOMBRE]', $data->derivacion->INSTITUCIONREMISIONDESCR, $data->plantilla);
				$data->plantilla = str_replace('[OFICINA_DOMICILIO]', $data->derivacion->DOMICILIO, $data->plantilla);
			} else if ($data->canalizacion && $data->folio->STATUS == 'CANALIZADO') {
				$data->plantilla = str_replace('[OFICINA_NOMBRE]', $data->canalizacion->INSTITUCIONREMISIONDESCR, $data->plantilla);
				$data->plantilla = str_replace('[OFICINA_DOMICILIO]', $data->canalizacion->DOMICILIO, $data->plantilla);
			}

			$data->plantilla = str_replace('[EXPEDIENTE_NUMERO]', $data->folio->FOLIOID . '/' . $data->folio->ANO, $data->plantilla);
			$data->plantilla = str_replace('[TIPO_EXPEDIENTE]',  $data->folio->STATUS == "DERIVADO" ? "DERIVACIÓN" : "CANALIZACIÓN", $data->plantilla);
			return json_encode(['status' => 1, 'plantilla' => $data->plantilla]);
		} else {
			//Replaces cuando hay expedientes

			$data->tipoExpediente = $this->_tipoExpedienteModel->asObject()->where('TIPOEXPEDIENTEID',  $data->folio->TIPOEXPEDIENTEID)->first();
			$arrayExpediente = str_split($data->folio->EXPEDIENTEID);
			$expedienteid =  $arrayExpediente[1] . $arrayExpediente[2] . $arrayExpediente[4] . $arrayExpediente[5] . '-' . $arrayExpediente[6] . $arrayExpediente[7] . $arrayExpediente[8] . $arrayExpediente[9] . '-' . $arrayExpediente[10] . $arrayExpediente[11] . $arrayExpediente[12] . $arrayExpediente[13] . $arrayExpediente[14] . '/' . ($data->tipoExpediente->TIPOEXPEDIENTECLAVE ? $data->tipoExpediente->TIPOEXPEDIENTECLAVE : '-');;

			//VICTIMA RASGOS PERSONA DESAPARECIDA
			$data->mediaFiliacionVictima = $this->_folioMediaFiliacionRead->asObject()->where('FOLIOID', $folio)->where('PERSONAFISICAID', $victima)->first();
			if ($data->victima[0]['DESAPARECIDA'] == 'S' && $data->mediaFiliacionVictima) {
				$colorOjos = $this->_ojoColorModelRead->asObject()->where('OJOCOLORID', $data->mediaFiliacionVictima->OJOCOLORID)->first();
				$colorCabello = $this->_cabelloColorModelRead->asObject()->where('CABELLOCOLORID', $data->mediaFiliacionVictima->CABELLOCOLORID)->first();
				$complexion = $this->_figuraModelRead->asObject()->where('FIGURAID', $data->mediaFiliacionVictima->FIGURAID)->first();
				$colorPiel = $this->_pielColorModelRead->asObject()->where('PIELCOLORID', $data->mediaFiliacionVictima->PIELCOLORID)->first();
				$cejasForma = $this->_cejaFormaModelRead->asObject()->where('CEJAFORMAID', $data->mediaFiliacionVictima->CEJAFORMAID)->first();
				$cabelloTamano = $this->_cabelloTamanoModelRead->asObject()->where('CABELLOTAMANOID', $data->mediaFiliacionVictima->CABELLOTAMANOID)->first();

				$data->plantilla = str_replace('[NOMBRE_DESAPARECIDO]', $data->victima[0]['NOMBRE'] . ' ' . ($data->victima[0]['PRIMERAPELLIDO'] ? $data->victima[0]['PRIMERAPELLIDO'] : '') . ' ' . ($data->victima[0]['SEGUNDOAPELLIDO'] ? $data->victima[0]['SEGUNDOAPELLIDO'] : ''), $data->plantilla);
				$data->plantilla = str_replace('[ANOS_DESAPARECIDO]', $data->victima[0]['EDADCANTIDAD'] ? $data->victima[0]['EDADCANTIDAD'] : '-', $data->plantilla);
				$data->plantilla = str_replace('[DIA_DESAPARICION]', $data->mediaFiliacionVictima->FECHADESAPARICION ? date('d', strtotime($data->mediaFiliacionVictima->FECHADESAPARICION)) : '-', $data->plantilla);
				$data->plantilla = str_replace('[MES_DESAPARICION]', $data->mediaFiliacionVictima->FECHADESAPARICION ? $meses[date('n', strtotime($data->mediaFiliacionVictima->FECHADESAPARICION)) - 1] : '', $data->plantilla);
				$data->plantilla = str_replace('[ANO_DESAPARICION]', $data->mediaFiliacionVictima->FECHADESAPARICION ? date('Y', strtotime($data->mediaFiliacionVictima->FECHADESAPARICION)) : '', $data->plantilla);
				$data->plantilla = str_replace('[LUGAR_DESAPARICION]',  $data->mediaFiliacionVictima->LUGARDESAPARICION ?  $data->mediaFiliacionVictima->LUGARDESAPARICION : '-', $data->plantilla);

				$data->plantilla = str_replace('[ESTATURA_DESAPARECIDO]',  $data->mediaFiliacionVictima->ESTATURA ?  $data->mediaFiliacionVictima->ESTATURA : '-', $data->plantilla);
				$data->plantilla = str_replace('[COMPLEXION_DESAPARECIDO]',  $complexion ?  $complexion->FIGURADESCR : '-', $data->plantilla);
				$data->plantilla = str_replace('[PESO_DESAPARECIDO]',  $data->mediaFiliacionVictima->ESTATURA ?  $data->mediaFiliacionVictima->ESTATURA : '-', $data->plantilla);
				$data->plantilla = str_replace('[TEZ_DESAPARECIDO]',  $colorPiel ?  $colorPiel->PIELCOLORDESCR : '-', $data->plantilla);
				$data->plantilla = str_replace('[OJOSCOLOR_DESAPARECIDO]',  $colorOjos ?  $colorOjos->OJOCOLORDESCR : '-', $data->plantilla);
				$data->plantilla = str_replace('[COLORCABELLO_DESAPARECIDO]',  $colorCabello ?  $colorCabello->CABELLOCOLORDESCR : '-', $data->plantilla);
				$data->plantilla = str_replace('[TIPOCEJA_DESAPARECIDO]',  $cejasForma ?  $cejasForma->CEJAFORMADESCR : '-', $data->plantilla);
				$data->plantilla = str_replace('[SENAS_PARTICULARES_DESAPARECIDO]',  $data->mediaFiliacionVictima->SENASPARTICULARES ?  $data->mediaFiliacionVictima->SENASPARTICULARES : '-', $data->plantilla);
				$data->plantilla = str_replace('[TAMANOCABELLO_DESAPARECIDO]',  $cabelloTamano ?  $cabelloTamano->CABELLOTAMANODESCR : '-', $data->plantilla);

				if ($data->victima[0]['FOTO']) {
					$file_info = new \finfo(FILEINFO_MIME_TYPE);
					$type = $file_info->buffer($data->victima[0]['FOTO']);
					$data->victima[0]['FOTO'] = 'data:' . $type . ';base64,' . base64_encode($data->victima[0]['FOTO']);
					if ($type == 'image/png' || $type == 'image/jpg' || $type == 'image/jpeg') {
						$data->plantilla = str_replace('[IMAGEN_DESAPARECIDO]',  "<img src='" . $data->victima[0]['FOTO'] . "' style='max-width:170px;'></img>", $data->plantilla);
					}
				}
			}

			// Victima rasgos
			if ($data->mediaFiliacionVictima) {
				$colorOjos = $this->_ojoColorModelRead->asObject()->where('OJOCOLORID', $data->mediaFiliacionVictima->OJOCOLORID)->first();
				$colorCabello = $this->_cabelloColorModelRead->asObject()->where('CABELLOCOLORID', $data->mediaFiliacionVictima->CABELLOCOLORID)->first();
				$complexion = $this->_figuraModelRead->asObject()->where('FIGURAID', $data->mediaFiliacionVictima->FIGURAID)->first();
				$colorPiel = $this->_pielColorModelRead->asObject()->where('PIELCOLORID', $data->mediaFiliacionVictima->PIELCOLORID)->first();
				$cejasForma = $this->_cejaFormaModelRead->asObject()->where('CEJAFORMAID', $data->mediaFiliacionVictima->CEJAFORMAID)->first();

				$data->plantilla = str_replace('[VICTIMA_ESTATURA]',  $data->mediaFiliacionVictima->ESTATURA ?  $data->mediaFiliacionVictima->ESTATURA : '-', $data->plantilla);
				$data->plantilla = str_replace('[VICTIMA_PIEL]',  $colorPiel ?  $colorPiel->PIELCOLORDESCR : '-', $data->plantilla);
				$data->plantilla = str_replace('[VICTIMA_COLOR_OJOS]',  $colorOjos ?  $colorOjos->OJOCOLORDESCR : '-', $data->plantilla);
				$data->plantilla = str_replace('[VICTIMA_COLOR_CABELLO]',  $colorCabello ?  $colorCabello->CABELLOCOLORDESCR : '-', $data->plantilla);
				$data->plantilla = str_replace('[VICTIMA_CEJAS_FORMAS]',  $cejasForma ?  $cejasForma->CEJAFORMADESCR : '-', $data->plantilla);
				$data->plantilla = str_replace('[VICTIMA_SENAS]',  $data->mediaFiliacionVictima->SENASPARTICULARES ?  $data->mediaFiliacionVictima->SENASPARTICULARES : '-', $data->plantilla);
			}

			$data->plantilla = str_replace('[EXPEDIENTE_NUMERO]', $expedienteid, $data->plantilla);

			$data->plantilla = str_replace('[DOCUMENTO_CIUDAD]', $data->municipios->MUNICIPIODESCR, $data->plantilla);
			$data->plantilla = str_replace('[VICTIMA_NOMBRE]', $data->victima[0]['NOMBRE'] . ' ' . ($data->victima[0]['PRIMERAPELLIDO'] ? $data->victima[0]['PRIMERAPELLIDO'] : '') . ' ' . ($data->victima[0]['SEGUNDOAPELLIDO'] ? $data->victima[0]['SEGUNDOAPELLIDO'] : ''), $data->plantilla);
			$data->plantilla = str_replace('[VICTIMA_EDAD]', $data->victima[0]['EDADCANTIDAD'] ? $data->victima[0]['EDADCANTIDAD'] : '-', $data->plantilla);
			$data->plantilla = str_replace('[VICTIMA_TELEFONO]', $data->victima[0]['TELEFONO'] ? $data->victima[0]['TELEFONO'] : '-', $data->plantilla);
			$data->plantilla = str_replace('[VICTIMA_CORREO]', $data->victima[0]['CORREO'] ? $data->victima[0]['CORREO'] : '-', $data->plantilla);
			$data->plantilla = str_replace('[VICTIMA_SEXO]', $data->victima[0]['SEXO'] ? ($data->victima[0]['SEXO'] == 'F' ? 'FEMENINO' : 'MASCULINO') : '-', $data->plantilla);
			$data->plantilla = str_replace('[IMPUTADO_NOMBRE]', $data->imputado->NOMBRE . ' ' . ($data->imputado->PRIMERAPELLIDO ? $data->imputado->PRIMERAPELLIDO : '') . ' ' . ($data->imputado->SEGUNDOAPELLIDO ? $data->imputado->SEGUNDOAPELLIDO : ''), $data->plantilla);
			$data->plantilla = str_replace('[IMPUTADO_EDAD]', $data->imputado->EDADCANTIDAD ? $data->imputado->EDADCANTIDAD : '-', $data->plantilla);
			$data->plantilla = str_replace('[DIA]', date('d'), $data->plantilla);
			$data->plantilla = str_replace('[MES]', $meses[date('n') - 1], $data->plantilla);
			$data->plantilla = str_replace('[ANO]', date('Y'), $data->plantilla);
			$data->plantilla = str_replace('[HORA]', date('H'), $data->plantilla);
			$data->plantilla = str_replace('[MINUTOS]', date('i'), $data->plantilla);
			$data->plantilla = str_replace('[ESTADO]', $data->municipios->MUNICIPIODESCR, $data->plantilla);
			$data->plantilla = str_replace('[EXTERIOR]', $data->folio->HECHONUMEROCASA ? $data->folio->HECHONUMEROCASA : 'S/N', $data->plantilla);
			$data->plantilla = str_replace(
				'[DIRECCION]',
				($data->folio->HECHOCALLE ? $data->folio->HECHOCALLE : 'SIN CALLE') . ' ' .
					($data->folio->HECHONUMEROCASA ? $data->folio->HECHONUMEROCASA : 'S/N')  . ',' .
					($data->folio->HECHOCOLONIADESCR ? $data->folio->HECHOCOLONIADESCR : 'SIN COLONIA') . ',' .
					(isset($data->localidad) ? $data->localidad->LOCALIDADDESCR : 'SIN LOCALIDAD') . ',' .
					(isset($data->municipio_delito) ? $data->municipio_delito->MUNICIPIODESCR : 'SIN MUNICIPIO'),
				$data->plantilla
			);

			$data->plantilla = str_replace(
				'[DIRECCION]',
				($data->folio->HECHOCALLE ? $data->folio->HECHOCALLE : 'SIN CALLE') . ' ' .
					($data->folio->HECHONUMEROCASA ? $data->folio->HECHONUMEROCASA : 'S/N')  . ',' .
					($data->folio->HECHOCOLONIADESCR ? $data->folio->HECHOCOLONIADESCR : 'SIN COLONIA') . ',' .
					(isset($data->localidad) ? $data->localidad->LOCALIDADDESCR : 'SIN LOCALIDAD') . ',' .
					(isset($data->municipio_delito) ? $data->municipio_delito->MUNICIPIODESCR : 'SIN MUNICIPIO'),
				$data->plantilla
			);

			$data->plantilla = str_replace('[LUGAR_HECHO]', $data->lugar_delito->HECHODESCR, $data->plantilla);

			$data->plantilla = str_replace('[MUNICIPIO_DELITO]', $data->municipio_delito ? $data->municipio_delito->MUNICIPIODESCR : '', $data->plantilla);
			$data->plantilla = str_replace('[LOCALIDAD_DELITO]', $data->localidad ? $data->localidad->LOCALIDADDESCR : '', $data->plantilla);
			$data->plantilla = str_replace('[COLONIA_DELITO]', $data->folio->HECHOCOLONIADESCR ? $data->folio->HECHOCOLONIADESCR : '', $data->plantilla);
			$data->plantilla = str_replace('[REFERENCIAS]', $data->folio->HECHOREFERENCIA ? $data->folio->HECHOREFERENCIA : 'SIN DATOS DE REFERENCIA', $data->plantilla);
			$data->plantilla = str_replace('[CALLE]', $data->folio->HECHOCALLE ? $data->folio->HECHOCALLE : 'SIN CALLE', $data->plantilla);
			$data->plantilla = str_replace('[HECHO]', $data->folio->HECHONARRACION ? $data->folio->HECHONARRACION : 'SIN NARRACIÓN', $data->plantilla);
			$data->plantilla = str_replace('[HECHO_LUGAR]', $data->lugar_hecho->HECHODESCR ? $data->lugar_hecho->HECHODESCR : '-', $data->plantilla);
			$data->plantilla = str_replace('[HECHO_FECHA]', $data->folio->HECHOFECHA ? $data->folio->HECHOFECHA : '-', $data->plantilla);
			$data->plantilla = str_replace('[HECHO_HORA]', $data->folio->HECHOHORA ? $data->folio->HECHOHORA : '-', $data->plantilla);
			$data->plantilla = str_replace('[DETALLE_INTERVENCIONES]', $data->folio->HECHONARRACION ? $data->folio->HECHONARRACION : 'SIN NARRACIÓN', $data->plantilla);
			$data->plantilla = str_replace('[HECHO_NARRACION]', $data->folio->HECHONARRACION ? $data->folio->HECHONARRACION : 'SIN NARRACIÓN', $data->plantilla);
			$data->plantilla = str_replace('[TIPO_EXPEDIENTE]',  $data->tipoExpediente->TIPOEXPEDIENTECLAVE, $data->plantilla);
			$data->plantilla = str_replace('[nomenclatura, año, consecutivo, tipo de expediente]', $expedienteid . '/' . $data->tipoExpediente->TIPOEXPEDIENTECLAVE, $data->plantilla);

			$data->plantilla = str_replace('[ZONA_JAP]',  'CENTRO DE DENUNCIA TECNOLÓGICA', $data->plantilla);
			$data->plantilla = str_replace('[VICTIMA_DOMICILIO]', 'en: ' . ($data->victimaDom->CALLE ? $data->victimaDom->CALLE : 'DESCONOCIDO') . ($data->victimaDom->NUMEROCASA ? ' Ext. ' . $data->victimaDom->NUMEROCASA : '') . ($data->victimaDom->NUMEROINTERIOR ? ' Int. ' . $data->victimaDom->NUMEROINTERIOR : '') . ($data->victimaDom->COLONIADESCR ? ' ' . $data->victimaDom->COLONIADESCR : '') . (isset($data->municipioVictima) == true ? ' ' . $data->municipioVictima->MUNICIPIODESCR : '') . (isset($data->estadoVictima) == true ? ' ' . $data->estadoVictima->ESTADODESCR : ''), $data->plantilla);
			$data->plantilla = str_replace('[VICTIMA_DOMICILIO_COMPLETO]', ($data->victimaDom->CALLE ? $data->victimaDom->CALLE : 'DESCONOCIDO') . ($data->victimaDom->NUMEROCASA ? ' Ext. ' . $data->victimaDom->NUMEROCASA : '') . ($data->victimaDom->NUMEROINTERIOR ? ' Int. ' . $data->victimaDom->NUMEROINTERIOR : '') . ($data->victimaDom->COLONIADESCR ? ' ' . $data->victimaDom->COLONIADESCR : '') . (isset($data->municipioVictima) == true ? ' ' . $data->municipioVictima->MUNICIPIODESCR : '') . (isset($data->estadoVictima) == true ? ' ' . $data->estadoVictima->ESTADODESCR : ''), $data->plantilla);
			$data->plantilla = str_replace('[VICTIMA_TIPO_IDENTIFICACION]', isset($data->tipoIdentificacionVictima) == true ? $data->tipoIdentificacionVictima->PERSONATIPOIDENTIFICACIONDESCR : 'DESCONOCIDO', $data->plantilla);
			$data->plantilla = str_replace('[VICTIMA_NUMERO_IDENTIFICACION]', $data->victima[0]['NUMEROIDENTIFICACION'] ? $data->victima[0]['NUMEROIDENTIFICACION'] : '', $data->plantilla);
			$data->plantilla = str_replace('[VICTIMA_TELEFONO_CELULAR]', $data->victima[0]['TELEFONO'] ? $data->victima[0]['TELEFONO'] : 'DESCONOCIDO', $data->plantilla);
			$data->plantilla = str_replace('[VICTIMA_OCUPACION]', isset($data->ocupacionVictima) == true ? $data->ocupacionVictima->PERSONAOCUPACIONDESCR : 'DESCONOCIDO', $data->plantilla);
			$data->plantilla = str_replace('[VICTIMA_NACIONALIDAD]', isset($data->nacionalidadVictima) == true ? $data->nacionalidadVictima->PERSONANACIONALIDADDESCR : 'DESCONOCIDO', $data->plantilla);
			$data->plantilla = str_replace('[VICTIMA_ESTADO_CIVIL]', isset($data->edoCivilVictima) == true ? $data->edoCivilVictima->PERSONAESTADOCIVILDESCR : 'DESCONOCIDO', $data->plantilla);

			// Replaces del municipio asignado
			switch ($data->folio->MUNICIPIOASIGNADOID) {
				case '1':
					$data->plantilla = str_replace('[DIRECCION_NOMBRE]', 'C. DAVID ARMANDO SÁNCHEZ GONZÁLEZ,<br>MAYOR DE INFANTERÍA DIRECTOR DE SEGURIDAD PÚBLICO MUNICIPAL', $data->plantilla);
					$data->plantilla = str_replace('[REMISION_DOMICILIO]', 'Av Manuel Ávila Camacho S/N, Praderas del Ciprés Edificio A Planta Baja.<br>Tel: 646-152-2728 - 646-152-2793', $data->plantilla);
					break;
				case '2':
					$data->plantilla = str_replace('[DIRECCION_NOMBRE]', 'DIRECCIÓN DE SEGURIDAD PÚBLICA MUNICIPAL', $data->plantilla);
					$data->plantilla = str_replace('[REMISION_DOMICILIO]', 'Av. Obregón 541 Centro de la Ciudad, Cp 21000, Mexicali Baja California.<br>(Atrás del centro comercial ABSA)<br>Tel: 686 104 1603 - 686 596 4701.', $data->plantilla);
					break;
				case '3':
					$data->plantilla = str_replace('[DIRECCION_NOMBRE]', 'DIRECCIÓN DE SEGURIDAD CIUDADANA Y TRÁNSITO MUNICIPAL', $data->plantilla);
					$data->plantilla = str_replace('[REMISION_DOMICILIO]', 'Carretera Tecate-Tijuana km 1.5 colonia Paso del Águila, Tecate, B.C.<br>(Edificio de Fiscalía Regional)', $data->plantilla);
					break;
				case '4':
					$data->plantilla = str_replace('[DIRECCION_NOMBRE]', 'SECRETARIO DE SEGURIDAD Y PROTECCIÓN CIUDADANA MUNICIPAL', $data->plantilla);
					$data->plantilla = str_replace('[REMISION_DOMICILIO]', 'Av. Instituto Politécnico Nacional No. 1351 Col. Garita de Otay, Delegación Centenario C.P. 22430 Tijuana Baja California (segundo piso de oficinas de INDIVI)', $data->plantilla);
					break;
				case '5':
					$data->plantilla = str_replace('[DIRECCION_NOMBRE]', 'SECRETARÍA DE SEGURIDAD Y PROTECCIÓN CIUDADANA', $data->plantilla);
					$data->plantilla = str_replace('[REMISION_DOMICILIO]', 'Jose Haroz Aguilar, parcela 39, Fracc. Villa Turistica, CP 22710 Playas de Rosarito', $data->plantilla);
					break;
				case '6':
					$data->plantilla = str_replace('[DIRECCION_NOMBRE]', 'LICENCIADO MARIO MARTÍNEZ MARTÍNEZ,<br>DIRECTOR DE SEGURIDAD PUBLICA MUNICIPAL SAN QUINTÍN', $data->plantilla);
					$data->plantilla = str_replace('[REMISION_DOMICILIO]', 'Av. Obregón 541 Centro de la Ciudad, Cp 21000, Mexicali Baja California.<br>(Atrás del centro comercial ABSA)<br>Tel: 686 104 1603 - 686 596 4701.', $data->plantilla);
					break;
				case '7':
					$data->plantilla = str_replace('[DIRECCION_NOMBRE]', 'DIRECTOR DE SEGURIDAD PÚBLICA SAN FELIPE', $data->plantilla);
					$data->plantilla = str_replace('[REMISION_DOMICILIO]', 'Av Manuel Ávila Camacho S/N, Praderas del Ciprés Edificio A Planta Baja.<br>Tel: 646-152-2728 - 646-152-2793', $data->plantilla);
					break;
				default:
					$data->plantilla = str_replace('[DIRECCION_NOMBRE]', 'SEGURIDAD PUBLICA MUNICIPAL', $data->plantilla);
					break;
			}

			//Info de las umas registradas

			if ($uma == 'MEXICALI - CD MORELOS') {
				$data->plantilla = str_replace('[DOMICILIO_INSTALACION]', 'CALZADA LÁZARO CÁRDENAS S/N. A UN COSTADO DE WELTON, EN CIUDAD MORELOS.', $data->plantilla);
				$data->plantilla = str_replace('[TELEFONO_UJAP]', '(658) 514-84-74 EXT. 7530, 7531, 7532, 7533, 7534 Y 7535.(658) 514-83-60 EXT. 7558, 7562, 7568, 7569 Y 7570', $data->plantilla);
			} else if ($uma == 'MEXICALI - GPE VICTORIA') {
				$data->plantilla = str_replace('[DOMICILIO_INSTALACION]', 'LOCAL 11 Y 12 DE LA PLAZA DEL CARMEN DE AVENIDA HÉROES DE CHAPULTEPEC Y CALLE 10, GUADALUPE VICTORIA.', $data->plantilla);
				$data->plantilla = str_replace('[TELEFONO_UJAP]', '(658) 516-43-79', $data->plantilla);
			} else if ($uma == 'MEXICALI - ORIENTE') {
				$data->plantilla = str_replace('[DOMICILIO_INSTALACION]', 'CENTRO DE JUSTICIA ORIENTE, ANKERITA Y ORTOZA S/N FRAC. PEDREGAL TURQUEZA.', $data->plantilla);
				$data->plantilla = str_replace('[TELEFONO_UJAP]', '(686) 689-00-30 EXT 7446, 7406, 7447', $data->plantilla);
			} else if ($uma == 'MEXICALI - PONIENTE (ANAHUAC)') {
				$data->plantilla = str_replace('[DOMICILIO_INSTALACION]', 'CALZADA HÉCTOR TERÁN TERÁN Y BOULEVARD ANÁHUAC S/N.', $data->plantilla);
				$data->plantilla = str_replace('[TELEFONO_UJAP]', '(686) 904-66-00 EXT 7754', $data->plantilla);
			} else if ($uma == 'MEXICALI - RIO NUEVO') {
				$data->plantilla = str_replace('[DOMICILIO_INSTALACION]', 'CALZADA DE LOS PRESIDENTES #1185, FRACC. RIO NUEVO.', $data->plantilla);
				$data->plantilla = str_replace('[TELEFONO_UJAP]', '(686) 904-66-01, EXT: 4612, 4703, 4710, 4770, 8782, 4789.', $data->plantilla);
			} else if ($uma == 'MEXICALI - SAN FELIPE') {
				$data->plantilla = str_replace('[DOMICILIO_INSTALACION]', 'AVENIDA MAR DE CORTES Y CALLE MANZANILLO SIN NUMERO, ZONA CENTRO, SAN FELIPE, BAJA CALIFORNIA.', $data->plantilla);
				$data->plantilla = str_replace('[TELEFONO_UJAP]', '(686) 577-17-63 EXT: 7477, 4705, 4770, 4702', $data->plantilla);
			} else if ($uma == 'ENSENADA - SAN QUINTIN') {
				$data->plantilla = str_replace('[DOMICILIO_INSTALACION]', 'CALLE DECIMA NUMERO 131, FRACC. CIUDAD DE SAN QUINTIN.', $data->plantilla);
				$data->plantilla = str_replace('[TELEFONO_UJAP]', '616 165 2915 EXT. 3910', $data->plantilla);
			} else if ($uma == 'ENSENADA - PRADERAS DEL CIPRES') {
				$data->plantilla = str_replace('[DOMICILIO_INSTALACION]', 'AVENIDA MANUEL AVILA CAMACHO S/N PRADERAS DEL CIPRES (ATRAS DE EDIFICIO DE GOBIERNO DEL ESTADO).', $data->plantilla);
				$data->plantilla = str_replace('[TELEFONO_UJAP]', '646 152 27 00 EXT 3854', $data->plantilla);
			} else if ($uma == 'ZONA COSTA - LA MESA') {
				$data->plantilla = str_replace('[DOMICILIO_INSTALACION]', 'AV.MURUA MARTINEZ S/N FRACC. CHAPULTEPEC COL. ALAMAR (a un costado de Central Camionera).', $data->plantilla);
				$data->plantilla = str_replace('[TELEFONO_UJAP]', '(664)104-76-00 Y (664)104-76-02 correo electrónico: umacosta@fgebc.gob.mx', $data->plantilla);
			} else if ($uma == 'ZONA COSTA - MARIANO MATAMOROS') {
				$data->plantilla = str_replace('[DOMICILIO_INSTALACION]', 'RUTA MARIANO MATAMOROS Y CATALINA GONZALEZ S/N COL. MARIANO MATAMOROS.', $data->plantilla);
				$data->plantilla = str_replace('[TELEFONO_UJAP]', '(664)902-18-18 UMA.COSTA@FGEBC.GOB.MX', $data->plantilla);
			} else if ($uma == 'ZONA COSTA - PLAYAS ROSARITO') {
				$data->plantilla = str_replace('[DOMICILIO_INSTALACION]', 'JOSE HAROZ AGUILAR ENTRE EDIFICIO CENTRO DE GOB., FRACC. VILLA TURISTICA.', $data->plantilla);
				$data->plantilla = str_replace('[TELEFONO_UJAP]', '', $data->plantilla);
			} else if ($uma == 'ZONA COSTA - TECATE') {
				$data->plantilla = str_replace('[DOMICILIO_INSTALACION]', 'MISION SANTA ROSALIA S/N COL. DESCANSO.', $data->plantilla);
				$data->plantilla = str_replace('[TELEFONO_UJAP]', '(665)655-04-27', $data->plantilla);
			} else if ($uma == 'ZONA COSTA - ZONA RIO') {
				$data->plantilla = str_replace('[DOMICILIO_INSTALACION]', 'BLVD. GRAL. RODOLFO SÁNCHEZ TABOADA NO. 10127, ESQUINA CON AV. RÍO TIJUANA. ZONA URBANA RÍO TIJUANA. (EDIFICIO DE CRISTALES NEGROS, PRIMER PISO).', $data->plantilla);
				$data->plantilla = str_replace('[TELEFONO_UJAP]', '664-736-52-96, correo electrónico: umacosta@fgebc.gob.mx', $data->plantilla);
			}

			$data->plantilla = str_replace('[IMPUTADO_DOMICILIO_COMPLETO]', ($data->imputadoDom->CALLE ? $data->imputadoDom->CALLE : 'DESCONOCIDO') . ' EXT. ' . ($data->imputadoDom->NUMEROCASA ? $data->imputadoDom->NUMEROCASA : '') . ' INT. ' . ($data->imputadoDom->NUMEROINTERIOR ? $data->imputadoDom->NUMEROINTERIOR : '') . ' ' . $data->imputadoDom->COLONIADESCR . ($data->municipio_imp ? $data->municipio_imp->MUNICIPIODESCR : '') . ' ' . ($data->estado_imp ? $data->estado_imp->ESTADODESCR : ''), $data->plantilla);

			$hecho_info = '<p><b>FOLIO:</b> ' . $data->folio->FOLIOID . '</p><p><b>AÑO:</b> ' . $data->folio->ANO . '</p><p><b>FECHA DEL HECHO:</b> ' . $data->folio->HECHOFECHA . '</p><p><b>HORA DEL HECHO:</b> ' . $data->folio->HECHOHORA . '</p><p><b>CALLE DEL HECHO:</b> ' . $data->folio->HECHOCALLE . ' EXT.' . $data->folio->HECHONUMEROCASA . ' INT.' . $data->folio->HECHONUMEROCASAINT . ' ' . $data->municipios->MUNICIPIODESCR . '</p><p><b>NARRACIÓN DEL HECHO:</b> ' . $data->folio->HECHONARRACION . '</p><p><b>NOTAS DEL AGENTE:</b> ' . $data->folio->NOTASAGENTE . '</p>';
			$hecho_info = $hecho_info .
				'<br><p><b>DENUNCIANTE: </b> ' .
				'</p><p><b> NOMBRE: </b> ' . $data->denunciante->NOMBRE . ' ' . ($data->denunciante->PRIMERAPELLIDO ? $data->denunciante->PRIMERAPELLIDO : '') . ' ' . ($data->denunciante->SEGUNDOAPELLIDO ? $data->denunciante->SEGUNDOAPELLIDO : '') .
				'<b> FECHA DE NACIMIENTO: </b> ' . ($data->denunciante->FECHANACIMIENTO ? $data->denunciante->FECHANACIMIENTO  : '-') .
				'<b> LUGAR DE NACIMIENTO: </b>' .  (isset($data->denuncianteMunicipioNac) == true ? ' ' . $data->denuncianteMunicipioNac->MUNICIPIODESCR : '') . (isset($data->denuncianteEstadoNac) == true ? ' ' . $data->denuncianteEstadoNac->ESTADODESCR : '') .
				'<b> TELÉFONO: </b> ' . ($data->denunciante->TELEFONO ? $data->denunciante->TELEFONO  : '-') .
				'<b> CORREO: </b> ' . ($data->denunciante->CORREO ? $data->denunciante->CORREO  : '-') .
				'<b> TIPO DE IDENTIFICACIÓN: </b> ' . ($data->denuncianteTipoIdentificacion ? $data->denuncianteTipoIdentificacion->PERSONATIPOIDENTIFICACIONDESCR  : '-') .
				'<b> NÚMERO DE IDENTIFICACIÓN: </b> ' . ($data->denunciante->NUMEROIDENTIFICACION ? $data->denunciante->NUMEROIDENTIFICACION  : '-') . '</p>';

			if ($data->desaparecidos_da) {
				foreach ($data->desaparecidos_da as $key => $desaparecidos) {
					$data->mediaFiliacionDesaparecidos = $this->_folioMediaFiliacionRead->asObject()->where('FOLIOID', $folio)->where('PERSONAFISICAID', $desaparecidos->PERSONAFISICAID)->first();

					//Victima media filiación
					$colorOjos = $this->_ojoColorModelRead->asObject()->where('OJOCOLORID', $data->mediaFiliacionDesaparecidos->OJOCOLORID)->first();
					$colorCabello = $this->_cabelloColorModelRead->asObject()->where('CABELLOCOLORID', $data->mediaFiliacionDesaparecidos->CABELLOCOLORID)->first();
					$complexion = $this->_figuraModelRead->asObject()->where('FIGURAID', $data->mediaFiliacionDesaparecidos->FIGURAID)->first();
					$colorPiel = $this->_pielColorModelRead->asObject()->where('PIELCOLORID', $data->mediaFiliacionDesaparecidos->PIELCOLORID)->first();
					$cejasForma = $this->_cejaFormaModelRead->asObject()->where('CEJAFORMAID', $data->mediaFiliacionDesaparecidos->CEJAFORMAID)->first();
					$cabelloTamano = $this->_cabelloTamanoModelRead->asObject()->where('CABELLOTAMANOID', $data->mediaFiliacionDesaparecidos->CABELLOTAMANOID)->first();

					$hecho_info = $hecho_info .
						'<br><p><b>MEDIA FILIACIÓN DE PERSONA DESAPARECIDA: </b> ' . ($key + 1) .
						'</p><p><b> NOMBRE: </b> ' . $desaparecidos->NOMBRE . ' ' . ($desaparecidos->PRIMERAPELLIDO ? $desaparecidos->PRIMERAPELLIDO : '') . ' ' . ($desaparecidos->SEGUNDOAPELLIDO ? $desaparecidos->SEGUNDOAPELLIDO : '') .
						'<b> EDAD: </b> ' . ($desaparecidos->EDADCANTIDAD ? $desaparecidos->EDADCANTIDAD : '-') .
						'<b> FECHA DE DESAPARICIÓN: </b>' .  ($data->mediaFiliacionDesaparecidos->FECHADESAPARICION ? $data->mediaFiliacionDesaparecidos->FECHADESAPARICION : '-') .
						'<b> LUGAR DE DESAPARICIÓN: </b> ' . ($data->mediaFiliacionDesaparecidos->LUGARDESAPARICION ? $data->mediaFiliacionDesaparecidos->LUGARDESAPARICION : '') .
						'<b> ESTATURA: </b> ' . ($data->mediaFiliacionDesaparecidos->ESTATURA ?  (float)(((float)$data->mediaFiliacionDesaparecidos->ESTATURA) / 100) : '-') .
						'<b> COMPLEXIÓN: </b> ' . ($complexion ?  $complexion->FIGURADESCR : '-') .
						'<b> PESO: </b> ' . ($data->mediaFiliacionDesaparecidos->PESO ?  $data->mediaFiliacionDesaparecidos->PESO : '-') .
						'<b> TEZ: </b> ' . ($colorPiel ?  $colorPiel->PIELCOLORDESCR : '-') .
						'<b> COLOR DE OJOS: </b> ' . ($colorOjos ?  $colorOjos->OJOCOLORDESCR : '-') .
						'<b> TIPO CEJA: </b> ' . ($cejasForma ?  $cejasForma->CEJAFORMADESCR : '-') .
						'<b> SEÑAS PARTICULARES: </b> ' . ($data->mediaFiliacionDesaparecidos->SENASPARTICULARES ?  $data->mediaFiliacionDesaparecidos->SENASPARTICULARES : '-') .
						'<b> TAMAÑO DEL CABELLO: </b> ' . ($cabelloTamano ?  $cabelloTamano->CABELLOTAMANODESCR : '-')
						. '</p>';
				}
			}
			if ($data->vehiculos_da) {
				foreach ($data->vehiculos_da as $key => $vehiculos) {
					$estadoV = $this->_estadosModelRead->asObject()->where('ESTADOID',  $vehiculos->ESTADOIDPLACA)->first();
					$linea = $this->_vehiculoVersionModelRead->asObject()->where('VEHICULOVERSIONID',  $vehiculos->VEHICULOVERSIONID)->first();
					$color = $this->_coloresVehiculoModelRead->asObject()->where('VEHICULOCOLORID',  $vehiculos->PRIMERCOLORID)->first();
					$tipo = $this->_tipoVehiculoModelRead->asObject()->where('VEHICULOTIPOID',  $vehiculos->TIPOID)->first();
					$hecho_info = $hecho_info .
						'<br><p><b>VEHÍCULO: </b> ' . ($key + 1) .
						'</p><p><b> PLACAS: </b> ' . ($vehiculos->PLACAS ? $vehiculos->PLACAS : '-') .
						'<b> SERIE: </b> ' . ($vehiculos->NUMEROSERIE ? $vehiculos->NUMEROSERIE : '-') .
						'<b> MARCA: </b>' . ($vehiculos->MARCADESCR ? $vehiculos->MARCADESCR : '-') .
						'<b> MODELO: </b> ' . ($vehiculos->MODELODESCR ? $vehiculos->MODELODESCR : '-') .
						'<b> ESTADO: </b> ' . ($estadoV ? $estadoV->ESTADODESCR : '-') .
						'<b> LINEA: </b> ' . ($vehiculos->ANOVEHICULO ? $vehiculos->ANOVEHICULO : '-') .
						'<b> COLOR: </b> ' . ($color ? $color->VEHICULOCOLORDESCR  : '-') .
						'<br><b> SEÑAS PARTICULARES: </b> ' .  ($vehiculos->SENASPARTICULARES ? $vehiculos->SENASPARTICULARES : '-') .
						'<br><b> CLASE: </b> ' . ($linea ? $linea->VEHICULOVERSIONDESCR : '-') .
						'<b> TIPO: </b> ' .  ($tipo ? $tipo->VEHICULOTIPODESCR : '-' . '</p>');
				}
			}
			$data->plantilla = str_replace('[INFORMACION_DEL_HECHO]', $hecho_info, $data->plantilla);

			if ($data->plantilla) {
				return json_encode(['status' => 1, 'plantilla' => $data->plantilla]);
			}
		}
		// } catch (\Exception $e) {
		// 	return json_encode((object)['status' => 0]);
		// }
	}

	/**
	 * Función para agregar documentos en VIDEODENUNCIA
	 * Recibe por metodo POST el expediente, folio, año, placeholder y municipio
	 * Devuelve todos los datos necesarios para la actualizacion de las tablas visuales.
	 *
	 */
	public function insertFolioDoc()
	{
		$expediente = $this->request->getPost('expediente');
		$folio = $this->request->getPost('folio');
		$year = $this->request->getPost('year');
		$placeholder = $this->request->getPost('placeholder');
		$municipio = $this->request->getPost('municipio');
		if ($this->permisosAgenteAtencion($folio, $year) == null) {
			return json_encode(['status' => 0, 'message' => "El agente no coincide con el agente de atención"]);
		}
		$plantilla = $this->_plantillasModelRead->where('TITULO', $this->request->getPost('titulo'))->first();
		$folioRow = $this->_folioModelRead->where('ANO', $year)->where('FOLIOID', $folio)->first();

		//Se verifica que las victimas e imputados no vengan vacios
		if (($this->request->getPost('victimaid') == '' || $this->request->getPost('victimaid') == null || $this->request->getPost('victimaid') == 0) || $this->request->getPost('imputado') == '' || $this->request->getPost('imputado') == null || $this->request->getPost('imputado') == 0) {
			return json_encode(['status' => 0]);
		}

		if ($folioRow) {


			$clasificaciondoctoid = '';

			// Se obtiene la clasificación del documento conforme a su municipio
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

			$documentos_folio = $this->_folioDocModelRead->asObject()->where('FOLIOID', $folio)->where('ANO', $year)->where('AGENTE_ASIGNADO !=', null)->first();

			if ($documentos_folio) {
				$dataFolioDoc = array(
					'FOLIOID' => $folio,
					'NUMEROEXPEDIENTE' => $expediente ? $expediente : null,
					'ANO' => $year,
					'PLACEHOLDER' => $placeholder,
					'STATUS' => 'ABIERTO',
					'MUNICIPIOID' => $folioRow['MUNICIPIOASIGNADOID'],
					'ESTADOID' => 2,
					'TIPODOC' => $this->request->getPost('titulo'),
					'PLANTILLAID' => $plantilla['ID'],
					'STATUSENVIO' => $this->request->getPost('statusenvio'),
					'VICTIMAID' => $this->request->getPost('victimaid'),
					'IMPUTADOID' => $this->request->getPost('imputado'),
					'ENVIADO' => 'N',
					'CLASIFICACIONDOCTOID' => $clasificaciondoctoid,
					'AGENTE_ASIGNADO' =>  $documentos_folio->AGENTE_ASIGNADO,
					'AGENTE_REGISTRO' =>  session('ID')

				);
				if ($this->request->getPost('titulo') == "DENUNCIA ANONIMA" || $this->request->getPost('titulo') == "FICHA PERSONA DESAPARECIDA") {
					$this->request->getPost('titulo') == "DENUNCIA ANONIMA" ? $pdf = $this->_generatePDF($placeholder) : $pdf = $this->_generatePDFPersonaFisica($placeholder);
					$dataFolioDoc = array(
						'FOLIOID' => $folio,
						'NUMEROEXPEDIENTE' => $expediente ? $expediente : null,
						'ANO' => $year,
						'PLACEHOLDER' => $placeholder,
						'STATUS' => 'FIRMADO',
						'MUNICIPIOID' => $folioRow['MUNICIPIOASIGNADOID'],
						'ESTADOID' => 2,
						'TIPODOC' => $this->request->getPost('titulo'),
						'PLANTILLAID' => $plantilla['ID'],
						'STATUSENVIO' => $this->request->getPost('statusenvio'),
						'VICTIMAID' => $this->request->getPost('victimaid'),
						'IMPUTADOID' => $this->request->getPost('imputado'),
						'ENVIADO' => 'N',
						'CLASIFICACIONDOCTOID' => $clasificaciondoctoid,
						'AGENTE_ASIGNADO' =>  $documentos_folio->AGENTE_ASIGNADO,
						'AGENTE_REGISTRO' =>  session('ID'),
						'PDF' => $pdf

					);
				}
				$foliodoc = $this->_folioDoc($dataFolioDoc, $expediente ? $expediente : null, $year);
			} else {
				$dataFolioDoc = array(
					'FOLIOID' => $folio,
					'NUMEROEXPEDIENTE' => $expediente ? $expediente : null,
					'ANO' => $year,
					'PLACEHOLDER' => $placeholder,
					'STATUS' => 'ABIERTO',
					'MUNICIPIOID' => $folioRow['MUNICIPIOASIGNADOID'],
					'ESTADOID' => 2,
					'TIPODOC' => $this->request->getPost('titulo'),
					'PLANTILLAID' => $plantilla['ID'],
					'STATUSENVIO' => $this->request->getPost('statusenvio'),
					'VICTIMAID' => $this->request->getPost('victimaid'),
					'IMPUTADOID' => $this->request->getPost('imputado'),
					'ENVIADO' => 'N',
					'CLASIFICACIONDOCTOID' => $clasificaciondoctoid,
					'AGENTE_ASIGNADO' =>  $this->request->getPost('agente_asignado') != '' ?  $this->request->getPost('agente_asignado') : null,
					'AGENTE_REGISTRO' =>  session('ID')

				);

				if ($this->request->getPost('titulo') == "DENUNCIA ANONIMA" || $this->request->getPost('titulo') == "FICHA PERSONA DESAPARECIDA") {
					$this->request->getPost('titulo') == "DENUNCIA ANONIMA" ? $pdf = $this->_generatePDF($placeholder) : $pdf = $this->_generatePDFPersonaFisica($placeholder);
					$dataFolioDoc = array(
						'FOLIOID' => $folio,
						'NUMEROEXPEDIENTE' => $expediente ? $expediente : null,
						'ANO' => $year,
						'PLACEHOLDER' => $placeholder,
						'STATUS' => 'FIRMADO',
						'PDF' => $pdf,
						'MUNICIPIOID' => $folioRow['MUNICIPIOASIGNADOID'],
						'ESTADOID' => 2,
						'TIPODOC' => $this->request->getPost('titulo'),
						'PLANTILLAID' => $plantilla['ID'],
						'STATUSENVIO' => $this->request->getPost('statusenvio'),
						'VICTIMAID' => $this->request->getPost('victimaid'),
						'IMPUTADOID' => $this->request->getPost('imputado'),
						'ENVIADO' => 'N',
						'CLASIFICACIONDOCTOID' => $clasificaciondoctoid,
						'AGENTE_ASIGNADO' =>  $this->request->getPost('agente_asignado') != '' ?  $this->request->getPost('agente_asignado') : null,
						'AGENTE_REGISTRO' =>  session('ID')

					);
				}
				$foliodoc = $this->_folioDoc($dataFolioDoc, $expediente ? $expediente : null, $year);
			}


			if ($foliodoc) {
				if (session('ROLID') == 4 || session('ROLID') == 8 || session('ROLID') == 10) {
					$dataFolio = array(
						'AGENTEFIRMAID' => $this->request->getPost('agente_asignado') != '' ?  $this->request->getPost('agente_asignado') : null,
					);
					$update = $this->_folioModel->set($dataFolio)->where('FOLIOID', $folio)->where('ANO', $year)->update();
				}
				$documentos = $this->_folioDocModel->get_by_folio($folio, $year);
				$datosBitacora = [
					'ACCION' => 'Ha agregado un nuevo documento',
					'NOTAS' => 'FOLIO: ' . $folio . ' AÑO: ' . $year . ' PLANTILLAID: ' .  $plantilla['ID'],
				];
				$this->_bitacoraActividad($datosBitacora);

				return json_encode(['status' => 1, 'documentos' => $documentos]);
			} else {
				return json_encode(['status' => 0]);
			}
		} else {
			return json_encode(['status' => 0]);
		}
	}

	/**
	 * Función para cambiar el estado de envio del documento conforme a su id. 
	 * Se reciben los datos por metodo POST
	 * Devuelve todos los datos necesarios para la actualizacion de las tablas visuales.
	 */
	public function changeStatusDoc()
	{
		try {
			$docid = trim($this->request->getPost('status_doc_id'));
			$folio = trim($this->request->getPost('folio_id_doc'));
			$year = trim($this->request->getPost('ano_doc'));
			$status_doc_envio = $this->request->getPost('status_doc_envio');
			$status_req_envio = $this->request->getPost('status_req_envio');

			$dataDocumento = array(
				'STATUSENVIO' => $status_doc_envio,
				'ENVIADO' => $status_req_envio,
			);

			$updateDocumento = $this->_folioDocModel->set($dataDocumento)->where('FOLIOID', $folio)->where('ANO', $year)->where('FOLIODOCID', $docid)->update();
			if ($updateDocumento) {
				$documentos = $this->_folioDocModel->get_by_folio($folio, $year);

				$datosBitacora = [
					'ACCION' => 'Ha actualizado el estatus de un documento',
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
	/**
	 *  Funcíon para sacar si hay registro de documentos e incrementar 1, o si no hay asignar el valor inicial

	 *
	 * @param  mixed $data
	 * @param  mixed $expediente
	 * @param  mixed $year
	 */
	private function _folioDoc($data, $expediente, $year)
	{
		$data = $data;
		$folio = $data['FOLIOID'];
		$year = $data['ANO'];

		$data['NUMEROEXPEDIENTE'] = $expediente;
		$data['ANO'] = $year;

		$foliodoc = $this->_folioDocModelRead->asObject()->where('FOLIOID', $folio)->where('ANO', $year)->orderBy('FOLIODOCID', 'desc')->first();

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

	/**
	 * Función para actualizar el placeholder del documento a partir de su id
	 * Devuelve todos los datos necesarios para la actualizacion de las tablas visuales.
	 *
	 */
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
					'ACCION' => 'Ha actualizado un documento.',
					'NOTAS' => 'FOLIO: ' . $folio . ' AÑO: ' . $year . ' DOCUMENTO: ' . $docid,
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

	/**
	 * Función para visualizar el documento conforme a su id
	 *
	 */
	public function getDocumentoById()
	{
		$docid = trim($this->request->getPost('docid'));
		$folio = trim($this->request->getPost('folio'));
		$year = trim($this->request->getPost('year'));

		$data = (object) array();
		$data->documento = $this->_folioDocModelRead->get_folio_by_first($folio, $year, $docid);

		if ($data->documento) {
			$documentos = $this->_folioDocModelRead->get_by_folio($folio, $year);

			$data->status = 1;
			return json_encode(['status' => 1, 'documentos' => $documentos, 'documentoporid' => $data->documento]);
		} else {
			return json_encode(['status' => 0]);
		}
	}

	/**
	 * ! Deprecated method, do not use.
	 *
	 */
	public function getFolioDenunciante()
	{
		$folio = trim($this->request->getPost('folio'));
		$year = trim($this->request->getPost('year'));
		$data = (object) array();
		$data->folioDenunciante = $this->_folioModelRead->asObject()->where('FOLIOID', $folio)->where('ANO', $year)->first();

		if ($data->folioDenunciante) {
			return json_encode(['status' => 1, 'folioDenunciante' => $data->folioDenunciante]);
		} else {
			return json_encode(['status' => 0]);
		}
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
	 * Función para encriptar los datos del metodo POST enviados al WebService de Justicia
	 * @param  mixed $plaintext
	 * @param  mixed $key128
	 */
	private function _encriptar($plaintext, $key128)
	{
		$iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length('aes-128-cbc'));
		$cipherText = openssl_encrypt($plaintext, 'AES-128-CBC', hex2bin($key128), 1, $iv);
		return base64_encode($iv . $cipherText);
	}

	/**
	 * Función para desencriptar los datos del metodo POST enviados al WebService de Justicia
	 * ! Deprecated method, do not use.
	 * @param  mixed $encodedInitialData
	 * @param  mixed $key128
	 */
	private function _desencriptar($encodedInitialData, $key128)
	{
		$encodedInitialData = base64_decode($encodedInitialData);
		$iv = substr($encodedInitialData, 0, 16);
		$encodedInitialData = substr($encodedInitialData, 16);
		$decrypted = openssl_decrypt($encodedInitialData, 'AES-128-CBC', hex2bin($key128), 1, $iv);
		return $decrypted;
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

	/**
	 * Función para validar que solo el agente de atención sea el eque agregue, elimine o actualice informacion del folio
	 */
	private function permisosAgenteAtencion($folio, $year)
	{
		$validacionAgenteAtencion = $this->_folioModelRead->asObject()->where('FOLIOID', $folio)->where('ANO', $year)->where('AGENTEATENCIONID', session('ID'))->first();

		return $validacionAgenteAtencion;
	}


	/**
	 * Función para crear el folio desde denuncia anonima
	 *
	 */
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
			'HECHONARRACION' => $this->request->getPost('notas'),
			'NOTASAGENTE' => $this->request->getPost('notas'),

			// 'HECHODELITO' => $this->request->getPost('delito_cometido'),
			'HECHOREFERENCIA' => $this->request->getPost('referencia_delito'),
			'AGENTEATENCIONID' => session('ID'),
			'TIPODENUNCIA' => 'DA',
			'STATUS' => 'EN PROCESO',
		];

		$colonia = $this->_coloniasModelRead->asObject()->where('ESTADOID', 2)->where('MUNICIPIOID', $this->request->getPost('municipio_delito'))->where('LOCALIDADID', $this->request->getPost('localidad_delito'))->where('COLONIAID', $this->request->getPost('colonia_delito_select'))->first();

		if ((int) $this->request->getPost('colonia_delito_select') == 0) {
			$dataFolio['HECHOCOLONIAID'] = null;
			$dataFolio['HECHOCOLONIADESCR'] = $this->request->getPost('colonia_delito');
			$localidad = $this->_localidadesModelRead->asObject()->where('ESTADOID', 2)->where('MUNICIPIOID', $dataFolio['HECHOMUNICIPIOID'])->where('LOCALIDADID', $dataFolio['HECHOLOCALIDADID'])->first();
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

	/**
	 * Vista de videos expedientes. Restringidos al ROL del usuario
	 *
	 */
	public function videos_expediente()
	{
		$data = (object) array();
		if (session('ROLID') == 11 || session('ROLID') == 1 || session('ROLID') == 6 || session('ROLID') == 7 || session('ROLID') == 2) {
			$data->folio = $this->_folioModelRead->videos_expediente_model(1);
		} else if (session('ROLID') == 3 || session('ROLID') == 4 || session('ROLID') == 8 || session('ROLID') == 9 || session('ROLID') == 10) {
			$data->folio = $this->_folioModelRead->videos_expediente_model(4);
		} else if (session('ROLID') == 12) {
			// VISUALIZADOR RAC
			$data->folio = $this->_folioModelRead->videos_expediente_model(3);
		} else if (session('ROLID') == 13) {
			//VISUALIZADOR ESTATAL
			$data->folio = $this->_folioModelRead->videos_expediente_model(5);
		} else {
			$data->folio = $this->_folioModelRead->videos_expediente_model(2);
		}
		$data->rolPermiso = $this->_rolesPermisosModelRead->asObject()->where('ROLID', session('ROLID'))->findAll();

		$this->_loadView('Videos de expedientes', 'videos', '', $data, 'videos_expediente');
	}
	/**
	 * Funcíon para sacar si hay registro de vehículos e incrementar 1, o si no hay asignar el valor inicial
	 *
	 * @param  mixed $data
	 * @param  mixed $folio
	 * @param  mixed $year
	 */
	private function _folioVehiculo($data, $folio, $year)
	{
		$data = $data;
		$data['FOLIOID'] = $folio;
		$data['ANO'] = $year;

		$vehiculo = $this->_folioVehiculoModelRead->asObject()->where('FOLIOID', $folio)->where('ANO', $year)->orderBy('VEHICULOID', 'desc')->first();

		if ($vehiculo) {
			$data['VEHICULOID'] = ((int) $vehiculo->VEHICULOID) + 1;
			$this->_folioVehiculoModel->insert($data);
		} else {
			$data['VEHICULOID'] = 1;
			$this->_folioVehiculoModel->insert($data);
		}
	}

	/**
	 * Genera el PDF cuando la plantilla es Denuncia Anonima
	 *
	 * @param  mixed $placeholder
	 */
	private function _generatePDF($placeholder)
	{
		$arrContextOptions = array(
			"ssl" => array(
				"verify_peer" => false,
				"verify_peer_name" => false,
			),
		);

		$data = (object)array();
		$data->placeholder = $placeholder;
		$data->image1 = base64_encode(file_get_contents(base_url('assets/img/logo_fgebc.jpg'), false, stream_context_create($arrContextOptions)));
		$data->image2 = base64_encode(file_get_contents(base_url('assets/img/logo_sejap.jpg'), false, stream_context_create($arrContextOptions)));

		$options = new Options();
		$options->set('isRemoteEnabled', true);
		$options->set('isPhpEnabled', true);
		// $options->set('defaultFont', 'Arial');
		$dompdf = new Dompdf($options);
		$dompdf->loadHtml(view('doc_template/template_documents_only_placeholder', ['data' => $data]));
		$dompdf->setPaper('A4', 'portrait');
		$dompdf->render();
		$canvas = $dompdf->getCanvas();

		$canvas->page_script(function ($pageNumber, $pageCount, $canvas, $fontMetrics) {
			$font = $fontMetrics->getFont('arial', 'regular');
			$text = "PÁGINA $pageNumber DE $pageCount";
			$size = 8;
			$x = $canvas->get_width();
			$y = $canvas->get_height();
			$width = $fontMetrics->getTextWidth($text, $font, $size);
			$canvas->text($x - 60 - $width, $y - 50, $text, $font, $size, array(0, 0, 0));
		});
		return $dompdf->output();
	}
	/**
	 * Genera el PDF cuando la plantilla es persona desaparecida (Cambia el template)
	 *
	 * @param  mixed $placeholder
	 */
	private function _generatePDFPersonaFisica($placeholder)
	{
		$arrContextOptions = array(
			"ssl" => array(
				"verify_peer" => false,
				"verify_peer_name" => false,
			),
		);

		$data = (object)array();
		$data->placeholder = $placeholder;
		$data->image1 = base64_encode(file_get_contents(base_url('assets/img/header_desaparecidos.png'), false, stream_context_create($arrContextOptions)));

		$options = new Options();
		$options->set('isRemoteEnabled', true);
		$options->set('isPhpEnabled', true);
		// $options->set('defaultFont', 'Arial');
		$dompdf = new Dompdf($options);
		$dompdf->loadHtml(view('doc_template/desaparecido_template', ['data' => $data]));
		$dompdf->setPaper('A4', 'landscape');
		$dompdf->render();
		return $dompdf->output();
	}
}

/* End of file DashboardController.php */
/* Location: ./app/Controllers/admin/DashboardController.php */
