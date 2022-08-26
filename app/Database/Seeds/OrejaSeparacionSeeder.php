<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class OrejaSeparacionSeeder extends Seeder
{
    public function run()
    {
        $data = [
            array('OREJASEPARACIONDESCR'=>'PEGADAS'),
            array('OREJASEPARACIONDESCR'=>'SOBRESALIENTES'),
            array('OREJASEPARACIONDESCR'=>'NINGUNA'),
            

		
		];
		$this->db->table('OREJASEPARACION')->insertBatch($data);

    }
}
