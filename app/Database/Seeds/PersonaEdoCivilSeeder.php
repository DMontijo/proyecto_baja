<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class PersonaEdoCivilSeeder extends Seeder
{
	public function run()
	{
		$data = [
			array('PERSONAESTADOCIVILDESCR' => 'CASADO'),
			array('PERSONAESTADOCIVILDESCR' => 'UNION LIBRE'),
			array('PERSONAESTADOCIVILDESCR' => 'DIVORCIADO'),
			array('PERSONAESTADOCIVILDESCR' => 'SEPARADO'),
			array('PERSONAESTADOCIVILDESCR' => 'NO ESPECIFICADO'),
			array('PERSONAESTADOCIVILDESCR' => 'VIUDO'),
			array('PERSONAESTADOCIVILDESCR' => 'SOLTERO'),

		];
		$this->db->table('CATEGORIA_PERSONAEDOCIVIL')->insertBatch($data);
	}
}
