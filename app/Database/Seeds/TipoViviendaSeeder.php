<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class TipoViviendaSeeder extends Seeder
{
	public function run()
	{
		$data = [
			array('TIPOVIVIENDAID'=>'1','TIPOVIVIENDADESCR' => 'CASA PROPIA'),
			array('TIPOVIVIENDAID'=>'2','TIPOVIVIENDADESCR' => 'CASA O DEPTO EN RENTA'),
			array('TIPOVIVIENDAID'=>'3','TIPOVIVIENDADESCR' => 'CASA O DEPTO EN PRESTAMO'),
			array('TIPOVIVIENDAID'=>'4','TIPOVIVIENDADESCR' => 'IRREGULAR'),
			array('TIPOVIVIENDAID'=>'99','TIPOVIVIENDADESCR' => 'SIN DOMICILIO'),
		];
		$this->db->table('TIPOVIVIENDA')->insertBatch($data);
	}
}
