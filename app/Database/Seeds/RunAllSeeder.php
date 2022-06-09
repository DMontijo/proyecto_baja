<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class RunAllSeeder extends Seeder
{
	public function run()
	{
		$this->call('EstadosSeeder');
		$this->call('MunicipioSeeder');
		$this->call('LocalidadSeeder');
		$this->call('ColoniaSeeder');
		$this->call('OficinaSeeder');
		$this->call('AreaSeeder');
		$this->call('ClasificacionDoctoSeeder');
		$this->call('PlantillaSeeder');
		$this->call('DelitoModalidadSeeder');
		$this->call('MedioConocimientoSeeder');
		$this->call('PersonaCalidadJuridicaSeeder');
		$this->call('PersonaEdoCivilSeeder ');
		$this->call('PersonaIdiomaSeeder  ');
		$this->call('PersonaNacionalidadSeeder');
		$this->call('PersonaReligionSeeder');
		$this->call('PersonaTipoIdentificacionSeeder');
		$this->call('TipoExpedienteSeeder  ');
		$this->call('TipoViviendaSeeder ');
		$this->call('VehiculoColorSeeder');
		$this->call('VehiculoTipoSeeder ');
		$this->call('VehiculoMarcaSeeder');
		$this->call('VehiculoModeloSeeder');
		$this->call('DerivacionesAtencionSeeder');
		$this->call('RolesusuariosSeeder');
		$this->call('ZonasUsuariosSeeder');
		$this->call('PerfilesUsuariosSeeder');
		$this->call('UsuariosSeeder');
		$this->call('HechoLugarSeeder');
		$this->call('PaisesSeeder');
		$this->call('DelitosUsuariosSeeder');
		$this->call('FileOriginalesSeeder');
	}
}
