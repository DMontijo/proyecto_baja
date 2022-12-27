<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class RolesPermisosSeeder extends Seeder
{
	public function run()
	{

		$data = [
			//SUPER USUARIO
			array('ROLID' => '1', 'PERMISOID' => '1'),
			array('ROLID' => '1', 'PERMISOID' => '2'),
			array('ROLID' => '1', 'PERMISOID' => '3'),
			array('ROLID' => '1', 'PERMISOID' => '4'),
			array('ROLID' => '1', 'PERMISOID' => '5'),
			array('ROLID' => '1', 'PERMISOID' => '6'),
			array('ROLID' => '1', 'PERMISOID' => '7'),
			array('ROLID' => '1', 'PERMISOID' => '8'),
			array('ROLID' => '1', 'PERMISOID' => '9'),
			array('ROLID' => '1', 'PERMISOID' => '10'),
			array('ROLID' => '1', 'PERMISOID' => '11'),

			//DIRECTOR SEJAP
			array('ROLID' => '2', 'PERMISOID' => '1'),
			array('ROLID' => '2', 'PERMISOID' => '2'),
			array('ROLID' => '2', 'PERMISOID' => '3'),
			array('ROLID' => '2', 'PERMISOID' => '4'),
			array('ROLID' => '2', 'PERMISOID' => '5'),
			array('ROLID' => '2', 'PERMISOID' => '7'),
			array('ROLID' => '2', 'PERMISOID' => '9'),
			array('ROLID' => '2', 'PERMISOID' => '10'),
			array('ROLID' => '2', 'PERMISOID' => '11'),

			//AGENTE DE MINISTERIO PÚBLICO
			array('ROLID' => '3', 'PERMISOID' => '1'),
			array('ROLID' => '3', 'PERMISOID' => '2'),
			array('ROLID' => '3', 'PERMISOID' => '3'),
			array('ROLID' => '3', 'PERMISOID' => '4'),
			array('ROLID' => '3', 'PERMISOID' => '5'),
			array('ROLID' => '3', 'PERMISOID' => '7'),
			array('ROLID' => '3', 'PERMISOID' => '10'),
			array('ROLID' => '3', 'PERMISOID' => '11'),

			//AUXILIAR DE MINISTERIO PÚBLICO
			array('ROLID' => '4', 'PERMISOID' => '1'),
			array('ROLID' => '4', 'PERMISOID' => '2'),
			array('ROLID' => '4', 'PERMISOID' => '3'),
			array('ROLID' => '4', 'PERMISOID' => '4'),
			array('ROLID' => '4', 'PERMISOID' => '5'),
			array('ROLID' => '4', 'PERMISOID' => '7'),
			array('ROLID' => '4', 'PERMISOID' => '10'),
			array('ROLID' => '4', 'PERMISOID' => '11'),

			//AGENTE DE MINISTERIO PÚBLICO EXTERNO
			array('ROLID' => '5', 'PERMISOID' => '9'),

			//ENCARGADO TURNO
			array('ROLID' => '6', 'PERMISOID' => '1'),
			array('ROLID' => '6', 'PERMISOID' => '2'),
			array('ROLID' => '6', 'PERMISOID' => '3'),
			array('ROLID' => '6', 'PERMISOID' => '4'),
			array('ROLID' => '6', 'PERMISOID' => '5'),
			array('ROLID' => '6', 'PERMISOID' => '7'),
			array('ROLID' => '6', 'PERMISOID' => '10'),
			array('ROLID' => '6', 'PERMISOID' => '11'),

			//COORDINADOR
			array('ROLID' => '7', 'PERMISOID' => '1'),
			array('ROLID' => '7', 'PERMISOID' => '2'),
			array('ROLID' => '7', 'PERMISOID' => '3'),
			array('ROLID' => '7', 'PERMISOID' => '4'),
			array('ROLID' => '7', 'PERMISOID' => '5'),
			array('ROLID' => '7', 'PERMISOID' => '7'),
			array('ROLID' => '7', 'PERMISOID' => '9'),
			array('ROLID' => '7', 'PERMISOID' => '10'),
			array('ROLID' => '7', 'PERMISOID' => '11'),

			//FACILITADOR
			array('ROLID' => '8', 'PERMISOID' => '2'),
			array('ROLID' => '8', 'PERMISOID' => '3'),
			array('ROLID' => '8', 'PERMISOID' => '7'),
			array('ROLID' => '8', 'PERMISOID' => '9'),
			array('ROLID' => '8', 'PERMISOID' => '10'),

			//NOTIFICADOR
			array('ROLID' => '9', 'PERMISOID' => '2'),
			array('ROLID' => '9', 'PERMISOID' => '3'),
			array('ROLID' => '9', 'PERMISOID' => '7'),
			array('ROLID' => '9', 'PERMISOID' => '9'),
			array('ROLID' => '9', 'PERMISOID' => '10'),

			//SECREATARIO DE ACUERDOS
			array('ROLID' => '10', 'PERMISOID' => '7'),

			//INFORMATICA
			array('ROLID' => '11', 'PERMISOID' => '2'),
			array('ROLID' => '11', 'PERMISOID' => '3'),
			array('ROLID' => '11', 'PERMISOID' => '6'),
			array('ROLID' => '11', 'PERMISOID' => '7'),
			array('ROLID' => '11', 'PERMISOID' => '8'),
			array('ROLID' => '11', 'PERMISOID' => '9'),
			array('ROLID' => '11', 'PERMISOID' => '10'),
		];
		$this->db->table('ROLESPERMISOS')->insertBatch($data);
	}
}
