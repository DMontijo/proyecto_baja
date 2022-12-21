<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class DenunciantesSeeder extends Seeder
{
	public function run()
	{

		$data = [
			array('NOMBRE' => 'QRO', 'APELLIDO_PATERNO' => 'ANONIMO', 'APELLIDO_MATERNO' => 'ANONIMO', 'CORREO' => null, 'TIPO' => 2),

		];
		$this->db->table('DENUNCIANTES')->insertBatch($data);
	}
}
