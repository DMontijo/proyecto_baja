<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class RolesUsuariosSeeder extends Seeder
{
	public function run()
	{
		$data = [
			array('NOMBRE_ROL' => 'SUPERUSUARIO'),
			array('NOMBRE_ROL' => 'AGENTE DEL MINISTERIO PÚBLICO'),
			array('NOMBRE_ROL' => 'FACILITADOR'),
			array('NOMBRE_ROL' => 'NOTIFICADOR'),
			array('NOMBRE_ROL' => 'SECRETARIO DE ACUERDOS'),
			array('NOMBRE_ROL' => 'AGENTE DEL MINISTERIO PÚBLICO EXTERNO'),
		];
		$this->db->table('ROLES')->insertBatch($data);
	}
}
