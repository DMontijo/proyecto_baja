<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class CabelloEstiloSeeder extends Seeder
{
    public function run()
    {
        $data = [
            array('CABELLOESTILODESCR'=>'CRESPO'),
            array('CABELLOESTILODESCR'=>'LACIO'),
            array('CABELLOESTILODESCR'=>'ONDULADO'),
            array('CABELLOESTILODESCR'=>'RIZADO'),
            

		
		];
		$this->db->table('CABELLOESTILO')->insertBatch($data);

    }
}
