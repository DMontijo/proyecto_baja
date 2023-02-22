<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class ZonasUsuariosSeeder extends Seeder
{
	public function run()
	{
		$data = [
			array('NOMBRE_ZONA' => 'CDTEC TIJUANA'),
			array('NOMBRE_ZONA' => 'CDTEC MEXICALI'),
			array('NOMBRE_ZONA' => 'CDTEC ENSENADA'),
		];
		$this->db->table('ZONAS_USUARIOS')->insertBatch($data);
	}
}
