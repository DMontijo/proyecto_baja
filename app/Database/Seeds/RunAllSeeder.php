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
	}
}
