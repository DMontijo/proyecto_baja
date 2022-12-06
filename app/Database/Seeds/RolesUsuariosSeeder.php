<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class RolesUsuariosSeeder extends Seeder
{
	public function run()
	{
		$data = [
			array('NOMBRE_ROL' => 'SUPERUSUARIO'),
			array('NOMBRE_ROL' => 'DIRECTOR SEJAP'),
			array('NOMBRE_ROL' => 'AGENTE DEL MINISTERIO PÚBLICO'),
			array('NOMBRE_ROL' => 'AUXILIAR DE MINISTERIO PÚBLICO'),
			array('NOMBRE_ROL' => 'AGENTE DEL MINISTERIO PÚBLICO EXTERNO'),
			array('NOMBRE_ROL' => 'ENCARGADO TURNO'),
			array('NOMBRE_ROL' => 'COORDINADOR'),
			array('NOMBRE_ROL' => 'FACILITADOR'),
			array('NOMBRE_ROL' => 'NOTIFICADOR'),
			array('NOMBRE_ROL' => 'SECRETARIO DE ACUERDOS'),
			array('NOMBRE_ROL' => 'INFORMATICA'),
		];
		$this->db->table('ROLES')->insertBatch($data);
	}
}
