<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class RunAllSeeder extends Seeder
{
	public function run()
	{
		$this->call('PaisesSeeder');
		$this->call('EstadosSeeder');
		$this->call('MunicipioSeeder');
		$this->call('LocalidadSeeder');
		$this->call('ColoniaSeeder');
		$this->call('OficinaSeeder');
		$this->call('PersonaCalidadJuridicaSeeder');
		$this->call('PersonaEdoCivilSeeder ');
		$this->call('PersonaIdiomaSeeder  ');
		$this->call('PersonaNacionalidadSeeder');
		$this->call('PersonaTipoIdentificacionSeeder');
		$this->call('TipoExpedienteSeeder  ');
		$this->call('TipoViviendaSeeder ');
		$this->call('VehiculoColorSeeder');
		$this->call('VehiculoTipoSeeder ');
		$this->call('HechoClasificacionLugarSeeder');
		$this->call('DerivacionesAtencionSeeder');
		$this->call('RolesUsuariosSeeder');
		$this->call('ZonasUsuariosSeeder');
		$this->call('UsuariosSeeder');
		$this->call('HechoLugarSeeder');
		$this->call('DelitosUsuariosSeeder');
		$this->call('PlantillasSeeder');
		$this->call('EmpleadosSeeder');
		$this->call('ConexionesDBSeeder');
		$this->call('EscolaridadSeeder');
		$this->call('OcupacionSeeder');
		$this->call('DocumentosExtravioSeeder');
		$this->call('BarbaPeculiarSeeder');
		$this->call('BarbaTamanoSeeder');
		$this->call('BarbillaFormaSeeder');
		$this->call('BarbillaInclinacionSeeder');
		$this->call('BarbillaPeculiarSeeder');
		$this->call('BarbillaTamanoSeeder');
		$this->call('BigoteFormaSeeder');
		$this->call('BigoteGrosorSeeder');
		$this->call('BigotePeculiarSeeder');
		$this->call('BigoteTamanoSeeder');
		$this->call('BocaPeculiarSeeder');
		$this->call('BocaTamanoSeeder');
		$this->call('CabelloColorSeeder');
		$this->call('CabelloEstiloSeeder');
		$this->call('CabelloPeculiarSeeder');
		$this->call('CabelloTamanoSeeder');
		$this->call('CabezaFormaSeeder');
		$this->call('CabezaTamanoSeeder');
		$this->call('CaraFormaSeeder');
		$this->call('CaraTamanoSeeder');
		$this->call('CaraTezSeeder');
		$this->call('CejaColocacionSeeder');
		$this->call('CejaContexturaSeeder');
		$this->call('CejaFormaSeeder');
		$this->call('CejaGrosorSeeder');
		$this->call('CejaTamanoSeeder');
		$this->call('CuelloGrosorSeeder');
		$this->call('CuelloPeculiarSeeder');
		$this->call('CuelloTamanoSeeder');
		$this->call('DientePeculiarSeeder');
		$this->call('DienteTamanoSeeder');
		$this->call('DienteTipoSeeder');
		$this->call('EstomagoSeeder');
		$this->call('FiguraSeeder');
		$this->call('FrenteAlturaSeeder');
		$this->call('FrenteAnchuraSeeder');
		$this->call('FrenteFormaSeeder');
		$this->call('FrentePeculiarSeeder');
		$this->call('HombroGrosorSeeder');
		$this->call('HombroLongitudSeeder');
		$this->call('HombroPosicionSeeder');
		$this->call('LabioLongitudSeeder');
		$this->call('LabioPeculiarSeeder');
		$this->call('LabioPosicionSeeder');
		$this->call('LabiosGrosorSeeder');
		$this->call('NarizBaseSeeder');
		$this->call('NarizPeculiarSeeder');
		$this->call('NarizTamanoSeeder');
		$this->call('NarizTipoSeeder');
		$this->call('OjoColocacionSeeder');
		$this->call('OjoColorSeeder');
		$this->call('OjoFormaSeeder');
		$this->call('OjoPeculiarSeeder');
		$this->call('OjoTamanoSeeder');
		$this->call('OjoFormaSeeder');
		$this->call('OrejaLobuloSeeder');
		$this->call('OrejaSeparacionSeeder');
		$this->call('OrejaTamanoSeeder');
		$this->call('PersonaEtniaSeeder');
		$this->call('PielColorSeeder');
		$this->call('ParentescoSeeder');
		$this->call('ObjetoClasificacionSeeder');
		$this->call('ObjetoSubclasificacionSeeder');
		$this->call('DelitosModalidadSeeder');
		$this->call('TipoMonedaSeeder');
		$this->call('VehiculoDistribuidorSeeder');
		$this->call('VehiculoMarcaSeeder');
		$this->call('VehiculoModeloSeeder');
		$this->call('VehiculoPaisSeeder');
		$this->call('VehiculoServicioSeeder');
		$this->call('VehiculoSituacionSeeder');
		$this->call('VehiculoStatusSeeder');
		$this->call('VehiculoVersionSeeder');
		$this->call('RolesPermisosSeeder');
		$this->call('PermisosSeeder');
		$this->call('EstadoExtranjeroSeeder');
		$this->call('DenunciantesSeeder');

	}
}
