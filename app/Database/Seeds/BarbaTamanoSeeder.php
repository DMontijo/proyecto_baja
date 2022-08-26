<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class BarbaTamanoSeeder extends Seeder
{
    public function run()
    {
       
        $data = [
			array('BARBATAMANODESCR' => 'CORTA'),
			array('BARBATAMANODESCR' => 'LARGA'),
			array('BARBATAMANODESCR' => 'MEDIANA'),
			array('BARBATAMANODESCR' => 'NINGUNA'),

		
		];
		$this->db->table('BARBATAMANO')->insertBatch($data);
    }
}
