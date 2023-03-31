<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class DenunciantesSeeder extends Seeder
{
	public function run()
	{
		$data = [
			array('NOMBRE' => 'QUIEN RESULTE OFENDIDO', 'APELLIDO_PATERNO' => 'ANONIMO', 'APELLIDO_MATERNO' => 'ANONIMO', 'CORREO' => 'notificacion@fgebc.gob.mx', 'TIPO' => 2),
		];

		$this->db->table('DENUNCIANTES')->insertBatch($data);
	}
}
