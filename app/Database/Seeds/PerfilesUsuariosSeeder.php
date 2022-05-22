<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class PerfilesUsuariosSeeder extends Seeder
{
	public function run()
	{
		$data = [
			array('NOMBRE_PERFIL' => 'SUPERUSUARIO'),
			array('NOMBRE_PERFIL' => 'AGENTE DEL MINISTERIO PUBLICO'),
			array('NOMBRE_PERFIL' => 'AUXILIAR DEL MINISTERIO PUBLICO'),
			array('NOMBRE_PERFIL' => 'AUXILIAR JUSTICIA ALTERNATIVA'),
			array('NOMBRE_PERFIL' => 'FACILITADOR LIC. EN DERECHO'),
			array('NOMBRE_PERFIL' => 'SECRETARIA DE ACUERDOS'),			
		];
		$this->db->table('PERFILES_USUARIOS')->insertBatch($data);
	}
}
