<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class ZonasUsuariosSeeder extends Seeder
{
	public function run()
	{
		$data = [
			array('NOMBRE_ZONA' => 'CDT TIJUANA'),
			array('NOMBRE_ZONA' => 'CDT MEXICALI'),
			array('NOMBRE_ZONA' => 'CDT ENSENADA'),
		];
		$this->db->table('ZONAS_USUARIOS')->insertBatch($data);
	}
}
