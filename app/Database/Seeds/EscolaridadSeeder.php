<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class EscolaridadSeeder extends Seeder
{
	public function run()
	{
		$data = [
			array('PERSONAESCOLARIDADID' => 1, 'PERSONAESCOLARIDADDESCR' => 'PRIMARIA'),
			array('PERSONAESCOLARIDADID' => 2, 'PERSONAESCOLARIDADDESCR' => 'SECUNDARIA'),
			array('PERSONAESCOLARIDADID' => 3, 'PERSONAESCOLARIDADDESCR' => 'BACHILLERATO'),
			array('PERSONAESCOLARIDADID' => 4, 'PERSONAESCOLARIDADDESCR' => 'CARRERA TECNICA'),
			array('PERSONAESCOLARIDADID' => 5, 'PERSONAESCOLARIDADDESCR' => 'CARRERA COMERCIAL'),
			array('PERSONAESCOLARIDADID' => 6, 'PERSONAESCOLARIDADDESCR' => 'LICENCIATURA'),
			array('PERSONAESCOLARIDADID' => 7, 'PERSONAESCOLARIDADDESCR' => 'POSTGRADO'),
			array('PERSONAESCOLARIDADID' => 8, 'PERSONAESCOLARIDADDESCR' => 'MAESTRIA'),
			array('PERSONAESCOLARIDADID' => 9, 'PERSONAESCOLARIDADDESCR' => 'DOCTORADO'),
			array('PERSONAESCOLARIDADID' => 10, 'PERSONAESCOLARIDADDESCR' => 'OTRO'),
			array('PERSONAESCOLARIDADID' => 99, 'PERSONAESCOLARIDADDESCR' => 'NINGUNA'),
		];
		$this->db->table('ESCOLARIDAD')->insertBatch($data);
	}
}
