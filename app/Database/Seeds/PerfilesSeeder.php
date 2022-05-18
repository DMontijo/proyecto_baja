<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class PerfilesSeeder extends Seeder
{
	public function run()
	{
		$data = [
			array('NOMBRE_PERFIL' => 'ADMINISTRADOR'),
			array('NOMBRE_PERFIL' => 'COORDINADOR DEL CENTRO'),
			array('NOMBRE_PERFIL' => 'MINISTERIOS PÚBLICOS'),
			array('NOMBRE_PERFIL' => 'AUXILIARES'),
		];
		$this->db->table('CATEGORIA_PERFILES')->insertBatch($data);
	}
}
