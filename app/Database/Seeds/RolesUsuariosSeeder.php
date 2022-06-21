<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class RolesUsuariosSeeder extends Seeder
{
	public function run()
	{
		$data = [
			array('NOMBRE_ROL' => 'SUPERUSUARIO'),
			array('NOMBRE_ROL' => 'DIRECTORA GENERAL DE SEJAP'),
			array('NOMBRE_ROL' => 'COORDINADOR'),
			array('NOMBRE_ROL' => 'SUPERVISOR'),
			array('NOMBRE_ROL' => 'OPERADOR MP'),
			array('NOMBRE_ROL' => 'OPERADOR'),
		];
		$this->db->table('ROLES')->insertBatch($data);
	}
}
