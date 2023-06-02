<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class RolesUsuariosSeeder extends Seeder
{
	public function run()
	{
		$data = [
			array('NOMBRE_ROL' => 'SUPERUSUARIO'),
			array('NOMBRE_ROL' => 'DIRECTOR JAP'),
			array('NOMBRE_ROL' => 'AGENTE DEL MINISTERIO PÚBLICO'),
			array('NOMBRE_ROL' => 'AUXILIAR DE MINISTERIO PÚBLICO'),
			array('NOMBRE_ROL' => 'AGENTE DEL MINISTERIO PÚBLICO VISUALIZADOR'),
			array('NOMBRE_ROL' => 'ENCARGADO AREA'),
			array('NOMBRE_ROL' => 'COORDINADOR'),
			array('NOMBRE_ROL' => 'FACILITADOR'),
			array('NOMBRE_ROL' => 'NOTIFICADOR'),
			array('NOMBRE_ROL' => 'SECRETARIO DE ACUERDOS'),
			array('NOMBRE_ROL' => 'INFORMATICA'),
			array('NOMBRE_ROL' => 'AGENTE DEL MINISTERIO PÚBLICO VISUALIZADOR - JAP'),
			array('NOMBRE_ROL' => 'VISUALIZADOR ESTATAL'),
		];
		$this->db->table('ROLES')->insertBatch($data);
	}
}
