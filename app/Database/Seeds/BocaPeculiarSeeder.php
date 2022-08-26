<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class BocaPeculiarSeeder extends Seeder
{
    public function run()
    {
        $data = [
			array('BOCAPECULIARDESCR'=>'ABATIDAS'),
array('BOCAPECULIARDESCR'=>'ELEVADAS'),
array('BOCAPECULIARDESCR'=>'SIMETRICAS'),
array('BOCAPECULIARDESCR'=>'ASIMETRICAS'),


		
		];
		$this->db->table('BOCAPECULIAR')->insertBatch($data);

    }
}
