<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class ZonasUsuariosSeeder extends Seeder
{
	public function run()
	{
		$data = [
			array('NOMBRE_ZONA' => 'SUPERUSUARIO'),
			array('NOMBRE_ZONA' => 'DIRECCION GENERAL DE SEJAP'),
			array('NOMBRE_ZONA' => 'CDT'),
			array('NOMBRE_ZONA' => 'ZONA COSTA - LA MESA'),
			array('NOMBRE_ZONA' => 'ZONA COSTA - MARIANO'),
			array('NOMBRE_ZONA' => 'ZONA ENSENADA'),
			array('NOMBRE_ZONA' => 'ZONA MEXICALI'),
		];
		$this->db->table('ZONAS_USUARIOS')->insertBatch($data);
	}
}
