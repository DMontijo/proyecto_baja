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
		$this->call('PerfilesSeeder');
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
		$this->call('UsersSeeder');
		$this->call('DerivacionesAtencion');
	}
}
