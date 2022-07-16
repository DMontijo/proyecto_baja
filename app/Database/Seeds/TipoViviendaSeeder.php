<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class TipoViviendaSeeder extends Seeder
{
	public function run()
	{
		$data = [
			array('TIPOVIVIENDADESCR' => 'CASA PROPIA'),
			array('TIPOVIVIENDADESCR' => 'CASA O DEPTO EN RENTA'),
			array('TIPOVIVIENDADESCR' => 'CASA O DEPTO EN PRESTAMO'),
			array('TIPOVIVIENDADESCR' => 'IRREGULAR'),
			array('TIPOVIVIENDADESCR' => 'SIN DOMICILIO'),

		];
		$this->db->table('TIPOVIVIENDA')->insertBatch($data);
	}
}
