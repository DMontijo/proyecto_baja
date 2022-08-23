<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class OficinaTestingSeeder extends Seeder
{
	public function run()
	{
		$data = [
			array('OFICINAID' => '792', 'OFICINADESCR' => 'CDT - ENSENADA', 'ESTADOID' => '2', 'MUNICIPIOID' => '1'),
			array('OFICINAID' => '394', 'OFICINADESCR' => 'CDT - MEXICALI', 'ESTADOID' => '2', 'MUNICIPIOID' => '2'),
			array('OFICINAID' => '394', 'OFICINADESCR' => 'CDT - TECATE', 'ESTADOID' => '2', 'MUNICIPIOID' => '3'),
			array('OFICINAID' => '924', 'OFICINADESCR' => 'CDT - TIJUANA', 'ESTADOID' => '2', 'MUNICIPIOID' => '4'),
			array('OFICINAID' => '924', 'OFICINADESCR' => 'CDT - PLAYAS DE ROSARITO', 'ESTADOID' => '2', 'MUNICIPIOID' => '5'),
		];
		$this->db->table("OFICINA")->insertBatch($data);
	}
}
