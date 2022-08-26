<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class HombroGrosorSeeder extends Seeder
{
    public function run()
    {
        $data = [
            array('HOMBROGROSORDESCR'=>'ANCHOS'),
            array('HOMBROGROSORDESCR'=>'DELGADOS'),
            array('HOMBROGROSORDESCR'=>'REGULAR'),
            array('HOMBROGROSORDESCR'=>'NINGUNA'),
            

		
		];
		$this->db->table('HOMBROGROSOR')->insertBatch($data);
    }
}
